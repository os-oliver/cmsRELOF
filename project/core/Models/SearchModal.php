<?php

namespace App\Models;

use App\Database;
use PDO;

class SearchModal
{
    private PDO $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->GetPDO();
    }

    /**
     * Pretraga kroz translations tabelu za dati jezik
     * Vraća rezultate grupisane po source_table
     */
    public function searchTranslations(string $term, string $lang): array
    {
        $allowedTables = [ 'aboutus', 'employee', 'gallery', 'document', 'userdefinedpages' ];
        $ids = '';
        foreach ($allowedTables as $key => $tableName) {
            $ids .= $ids ? ',' : '';
            $ids .= ':t' . $key;
        }

        $search = '%' . $term . '%';

        $sql = "SELECT
                    t.id,
                    t.source_id,
                    t.source_table,
                    t.field_name,
                    t.lang,
                    t.content,
                    t.label
                FROM text t
                WHERE t.lang = :lang
                AND (
                    t.content LIKE :search1
                    OR t.label LIKE :search2
                )
                AND t.source_table IN ($ids)
                ORDER BY t.source_table, t.source_id, t.field_name";

        $stmt = $this->pdo->prepare($sql);
        foreach ($allowedTables as $key => $tableName) {
            $id = ':t'.$key;
            $stmt->bindValue($id, $tableName, PDO::PARAM_STR);
        }
        $stmt->bindValue(':lang', $lang, PDO::PARAM_STR);
        $stmt->bindValue(':search1', $search, PDO::PARAM_STR);
        $stmt->bindValue(':search2', $search, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Grupise rezultate po source_table i source_id
     * Vraća struktuiranu hijerarhiju: [table => [id => [fields]]]
     */
    public function groupTranslationResults(array $translations): array
    {
        $grouped = [];

        foreach ($translations as $trans) {
            $table = $trans['source_table'];
            $sourceId = $trans['source_id'];

            if (!isset($grouped[$table])) {
                $grouped[$table] = [];
            }

            if (!isset($grouped[$table][$sourceId])) {
                $grouped[$table][$sourceId] = [
                    'source_id' => $sourceId,
                    'fields' => []
                ];
            }

            $grouped[$table][$sourceId]['fields'][] = [
                'field_name' => $trans['field_name'],
                'content' => $trans['content'],
                'label' => $trans['label']
            ];
        }

        return $grouped;
    }

    public function searchCustomFieldValues(string $term, string $lang): array
    {
        $search = '%' . $term . '%';

        $sql = "SELECT
                    DISTINCT c.id,
                    c.content_type_code,
                    ct.translations AS ct_translations,
                    cfv.content
                FROM content c
                INNER JOIN custom_field_value cfv ON c.id = cfv.content_id
                INNER JOIN content_type ct ON ct.code = c.content_type_code
                WHERE cfv.language = :lang
                AND cfv.content LIKE :search
                ORDER BY c.content_type_code";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':lang', $lang, PDO::PARAM_STR);
        $stmt->bindValue(':search', $search, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function groupByContentType(array $cfContent, string $language): array
    {
        $grouped = [];

        foreach ($cfContent as $item) {
            $code = $item['content_type_code'];
            if (!isset($grouped[$code])) {
                $grouped[$code] = [];
            }

            $translations = json_decode($item['ct_translations'], true);
            $grouped[$code][] = [
                'id' => $item['id'],
                'type' => $code,
                'label' => $translations[$language],
                'content' => $item['content']
            ];
        }

        return $grouped;
    }

    /**
     * Dobija originalni red iz source tabele
     */
    public function getSourceRecord(string $table, int $sourceId): ?array
    {
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $table)) {
            throw new \InvalidArgumentException('Invalid table name');
        }

        // Proveri da li tabela postoji
        $checkTable = $this->pdo->query("SHOW TABLES LIKE '{$table}'");
        if ($checkTable->rowCount() === 0) {
            return null;
        }

        $sql = "SELECT * FROM `{$table}` WHERE id = :id LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $sourceId, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    /**
     * Merge-uje prevedeni sadržaj sa originalnim redom
     */
    public function mergeTranslationsIntoRecord(array $originalRecord, array $translatedFields): array
    {
        $merged = $originalRecord;

        foreach ($translatedFields as $field) {
            $fieldName = $field['field_name'];
            if (isset($merged[$fieldName]) && !empty($field['content'])) {
                $merged[$fieldName] = $field['content'];
            }
        }

        return $merged;
    }

    /**
     * Dobija sve dostupne tabele iz baze (osim sistema tabela)
     */
    public function getAvailableTables(): array
    {
        $sql = "SHOW TABLES";
        $stmt = $this->pdo->query($sql);
        $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

        // Filtrira sistem tabele
        $systemTables = ['translations', 'users', 'sessions', 'migrations'];
        return array_diff($tables, $systemTables);
    }

    /**
     * Dobija čitljiv naziv tabele za prikaz
     */
    public function getTableDisplayName(string $table): string
    {
        $displayNames = [
            'aboutus' => 'O nama',
            'document' => 'Dokumenti',
            'events' => 'Događaji',
            'gallery' => 'Galerija',
            'employee' => 'Zaposleni',
            'news' => 'Vesti',
            'services' => 'Usluge',
            'contacts' => 'Kontakti'
        ];

        return $displayNames[$table] ?? ucfirst($table);
    }

    /**
     * Dobija ikonicu za tabelu
     */
    public function getTableIcon(string $table): string
    {
        $icons = [
            'aboutus' => '🏢',
            'document' => '📄',
            'events' => '📅',
            'dogadjaji' => '📅',
            'gallery' => '🖼️',
            'employee' => '👥',
            'news' => '📰',
            'vesti' => '📰',
            'services' => '⚙️',
            'contacts' => '📞'
        ];

        return $icons[$table] ?? '📋';
    }
}