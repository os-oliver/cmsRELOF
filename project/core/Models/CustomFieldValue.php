<?php
namespace App\Models;

use App\Database;
use PDO;

class CustomFieldValue
{
    private PDO $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->GetPDO();
    }

    private static function pdo(): PDO
    {
        return (new Database())->GetPDO();
    }

    /**
     * Fetch all custom field values
     */
    public static function fetchAllByContentId(int $contentId, ?string $locale = null): array
    {
        $withLocale = '';
        if ($locale) {
            $withLocale = ' AND (language = :lang OR language IS NULL)';
        }

        $pdo = self::pdo();
        try {
            $stmt = $pdo->prepare("SELECT * FROM custom_field_value WHERE content_id = :id" . $withLocale);
            $params = [
                ':id' => $contentId,
            ];
            if ($locale) {
                $params[':lang'] = $locale;
            }

            $stmt->execute($params);
            $cfValues = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $cfValues;
        } catch (\Throwable $e) {
            return [];
        }

        return [];
    }

    /**
     * Fetch single custom field value by content ID and CF id
     */
    public static function fetchByContentAndCustomField(string $contentId, string $cfId): ?array
    {
        try {
            $pdo = self::pdo();
            $stmt = $pdo->prepare("SELECT * FROM custom_field_value WHERE `content_id` = :contentId AND `custom_field_id` = :cfId");
            $stmt->execute([
                ':content_id' => $contentId,
                ':cfId' => $cfId,
            ]);
            $r = $stmt->fetch(PDO::FETCH_ASSOC);

            return $r ?? null;
        } catch (\Throwable $e) {
            return null;
        }
    }

    public static function deleteCFV(string $id): void
    {
        try {
            $pdo = self::pdo();
            $stmt = $pdo->prepare("DELETE FROM custom_field_value WHERE id = :id");
            $stmt->execute([
                ':id' => $id,
            ]);
        } catch (\Throwable $e) {
            return;
        }
    }

    public static function findImageCFVByContentIdAndPath(int $contentId, string $path): ?int
    {
        try {
            $pdo = self::pdo();
            $stmt = $pdo->prepare("SELECT id FROM custom_field_value WHERE content_id = :content_id AND filepath = :path LIMIT 1");
            $stmt->execute([
                ':content_id' => $contentId,
                ':path' => $path
            ]);
            $result = $stmt->fetchColumn();

            return $result ? (int) $result : null;
        } catch (\Throwable $e) {
            return null;
        }
    }

    public static function findFileCFVsByContentId(int $contentId): ?array
    {
        try {
            $pdo = self::pdo();
            $stmt = $pdo->prepare("SELECT cfv.* FROM custom_field_value cfv INNER JOIN custom_field cf ON cf.id = cfv.custom_field_id WHERE cfv.content_id = :content_id AND cf.type = :type ORDER BY custom_field_id, ordno ASC");
            $stmt->execute([
                ':content_id' => $contentId,
                ':type' => 'file',
            ]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result ?? [];
        } catch (\Throwable $e) {
            var_dump($e->getMessage());
            return null;
        }
    }
}
