<?php
namespace App\Utils;

use App\Controllers\LanguageMapperController;
use PDO;

class TextHelper
{
    /**
     * Generiše jezičke varijante (ćirilica/latinica za srpski) za dati tekst.
     * Vrati niz [lang => content]
     */
    public static function transliterateVariants(string $text, string $locale): array
    {
        $mapper = new LanguageMapperController();
        if ($locale === 'sr-Cyrl') {
            return ['sr-Cyrl' => $text, 'sr' => $mapper->cyrillic_to_latin($text)];
        }
        if ($locale === 'sr' || $locale === 'sr-Latn') {
            return ['sr' => $text, 'sr-Cyrl' => $mapper->latin_to_cyrillic($text)];
        }
        return [$locale => $text];
    }

    /**
     * Insert tekstualnih zapisa (jedan prepared stmt, više izvršavanja).
     * $sourceTable default 'document' da bude generički helper.
     */
    public static function insertTextEntries(PDO $pdo, int $sourceId, string $fieldName, array $variants, string $sourceTable = 'document'): void
    {
        $sql = "
            INSERT INTO text (source_id, source_table, field_name, lang, content)
            VALUES (:source_id, :source_table, :field_name, :lang, :content)
        ";
        $stmt = $pdo->prepare($sql);

        foreach ($variants as $lang => $content) {
            $content = trim((string) $content);
            if ($content === '')
                continue;
            $stmt->execute([
                ':source_id' => $sourceId,
                ':source_table' => $sourceTable,
                ':field_name' => $fieldName,
                ':lang' => $lang,
                ':content' => $content,
            ]);
        }
    }

    /**
     * Upsert (insert ili update) tekstualnih zapisa - koristi ON DUPLICATE KEY UPDATE.
     */
    public static function updateTextEntries(PDO $pdo, int $sourceId, string $fieldName, array $variants, string $sourceTable = 'document'): void
    {
        $sql = "
            INSERT INTO text (source_id, source_table, field_name, lang, content)
            VALUES (:source_id, :source_table, :field_name, :lang, :content)
            ON DUPLICATE KEY UPDATE content = :content_update
        ";
        $stmt = $pdo->prepare($sql);

        foreach ($variants as $lang => $content) {
            $content = trim((string) $content);
            if ($content === '')
                continue;
            $stmt->execute([
                ':source_id' => $sourceId,
                ':source_table' => $sourceTable,
                ':field_name' => $fieldName,
                ':lang' => $lang,
                ':content' => $content,
                ':content_update' => $content,
            ]);
        }
    }

    /**
     * Obriši sve text zapise za dati source_id i source_table.
     */
    public static function deleteTextEntries(PDO $pdo, int $sourceId, string $sourceTable = 'document'): void
    {
        $sql = "
            DELETE FROM text
            WHERE source_id = :source_id
              AND source_table = :source_table
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':source_id' => $sourceId,
            ':source_table' => $sourceTable,
        ]);
    }
}
