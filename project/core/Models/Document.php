<?php
namespace App\Models;

use App\Database;
use App\Utils\TextHelper;
use App\Utils\Pivoter;
use PDO;

class Document
{
    private PDO $pdo;
    private Pivoter $pivoter;

    public function __construct()
    {
        $this->pdo = (new Database())->GetPDO();
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);

        $this->pivoter = new Pivoter('field_name', 'content', 'id');
    }

    public function getCategories(): array
    {
        $sql = "
            SELECT cd.*, t.field_name, t.content, t.id AS text_id
            FROM category_document cd
            LEFT JOIN text t 
                ON t.source_id = cd.id 
                AND t.source_table = 'category_document';
        ";
        $rows = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $this->pivoter->pivot($rows);
    }

    public function list(
        int $limit = 10,
        int $offset = 0,
        string $search = '',
        string $category = '',
        string $status = '',
        string $sort = 'date_desc',
        string $lang = 'sr-Cyrl'
    ): array {
        $params = [
            ':lang' => $lang,
            ':lang1' => $lang,
            ':offset' => $offset,
            ':limit' => $limit,
        ];

        $where = [];
        if ($search !== '') {
            $where[] = "te.content LIKE :search";
            $params[':search'] = "%{$search}%";
        }
        if ($category !== '') {
            $where[] = "d.category_id = :category";
            $params[':category'] = (int) $category;
        }
        if ($status !== '') {
            $where[] = "d.status = :status";
            $params[':status'] = $status;
        }
        $whereClause = $where ? ' AND ' . implode(' AND ', $where) : '';

        $sql = "
            SELECT d.id, d.category_id, d.filepath, d.extension, d.datetime, d.fileSize,
                   te.field_name, te.content, tc.content AS name, k.color_code
            FROM (
                SELECT id
                FROM document
                ORDER BY datetime DESC
                LIMIT :offset, :limit
            ) AS page_docs
            JOIN document d ON d.id = page_docs.id
            JOIN text te ON te.source_id = d.id
                AND te.source_table = 'document'
                AND (te.lang = :lang) COLLATE utf8mb4_unicode_ci
            JOIN category_document k ON k.id = d.category_id
            JOIN text tc ON tc.source_id = k.id
                AND tc.source_table = 'category_document'
                AND (tc.lang = :lang1 OR tc.lang = 'sr-Cyrl') COLLATE utf8mb4_unicode_ci
            {$whereClause}
            ORDER BY d.datetime DESC
        ";

        $stmt = $this->pdo->prepare($sql);
        foreach ($params as $k => $v) {
            $stmt->bindValue($k, $v, is_int($v) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $total = (int) $this->pdo->query("SELECT COUNT(*) FROM document;")->fetchColumn();

        return [$this->pivoter->pivot($rows), $total];
    }

    public function insert(array $data): bool
    {
        try {
            $this->pdo->beginTransaction();

            $stmt = $this->pdo->prepare("
                INSERT INTO document (filepath, extension, fileSize, category_id, datetime)
                VALUES (:filepath, :extension, :fileSize, :category, NOW())
            ");
            $stmt->execute([
                ':filepath' => $data['filepath'] ?? '',
                ':extension' => $data['extension'] ?? '',
                ':fileSize' => $data['fileSize'] ?? 0,
                ':category' => $data['category'] ?? null,
            ]);

            $documentId = (int) $this->pdo->lastInsertId();
            $locale = $_SESSION['locale'] ?? 'sr-Cyrl';

            // koristi TextHelper koji uključuje transliteraciju
            TextHelper::insertTextEntries(
                $this->pdo,
                $documentId,
                'title',
                TextHelper::transliterateVariants((string) ($data['title'] ?? ''), $locale)
            );
            TextHelper::insertTextEntries(
                $this->pdo,
                $documentId,
                'description',
                TextHelper::transliterateVariants((string) ($data['description'] ?? ''), $locale)
            );

            $this->pdo->commit();
            return true;
        } catch (\PDOException $e) {
            $this->pdo->rollBack();
            error_log('Insert failed: ' . $e->getMessage());
            return false;
        }
    }

    public function update(int $id, array $data): bool
    {
        try {
            $this->pdo->beginTransaction();

            $stmt = $this->pdo->prepare("UPDATE document SET category_id = :category WHERE id = :id");
            $stmt->execute([
                ':category' => $data['category'] ?? null,
                ':id' => $id
            ]);

            $locale = $_SESSION['locale'] ?? 'sr-Cyrl';

            TextHelper::upsertTextEntries(
                $this->pdo,
                $id,
                'title',
                TextHelper::transliterateVariants((string) ($data['title'] ?? ''), $locale)
            );
            TextHelper::upsertTextEntries(
                $this->pdo,
                $id,
                'description',
                TextHelper::transliterateVariants((string) ($data['description'] ?? ''), $locale)
            );

            $this->pdo->commit();
            return true;
        } catch (\PDOException $e) {
            $this->pdo->rollBack();
            error_log('Update failed: ' . $e->getMessage());
            return false;
        }
    }

    public function delete(int $documentId): bool
    {
        try {
            $this->pdo->beginTransaction();

            // obriši text zapise preko TextHelper-a
            TextHelper::deleteTextEntries($this->pdo, $documentId, 'document');

            // obriši fajl sa diska, ako postoji
            $stmtFile = $this->pdo->prepare("SELECT filepath FROM document WHERE id = :id");
            $stmtFile->execute([':id' => $documentId]);
            $filepath = $stmtFile->fetchColumn();
            if ($filepath) {
                $fullPath = __DIR__ . '/../../public/uploads/documents/' . basename($filepath);
                if (file_exists($fullPath)) {
                    @unlink($fullPath);
                }
            }

            // obriši dokument
            $this->pdo->prepare("DELETE FROM document WHERE id = :id")->execute([':id' => $documentId]);

            $this->pdo->commit();
            return true;
        } catch (\Exception $e) {
            $this->pdo->rollBack();
            error_log('Delete failed: ' . $e->getMessage());
            return false;
        }
    }
}
