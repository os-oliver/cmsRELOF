<?php
namespace App\Models;

use App\Database;
use PDO;
use App\Controllers\LanguageMapperController;
use App\Utils\LocaleManager;

class ContentTypeCategory
{
    private PDO $pdo;
    private LanguageMapperController $mapper;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->GetPDO();
        $this->mapper = new LanguageMapperController();
    }

    private static function pdo(): PDO
    {
        return (new Database())->GetPDO();
    }

    /**
     * Fetch all content type categories
     */
    public static function fetchAllByContentTypeCode(string $contentTypeCode, bool $decode = false): array
    {
        $pdo = self::pdo();
        try {
            $stmt = $pdo->prepare("SELECT * FROM content_type_category WHERE content_type_code = :code ORDER BY ordno ASC");
            $stmt->execute([':code' => $contentTypeCode]);
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($decode && !empty($categories)) {
                $categories = LocaleManager::decodeTranslations($categories);
            }
            return $categories;
        } catch (\Throwable $e) {
            return [];
        }

        return [];
    }


    /**
     * Fetch single content type category by content type code and category code
     */
    public static function fetchByCode(string $contentTypeCode, string $code, bool $decode = false): ?array
    {
        try {
            $pdo = self::pdo();
            $stmt = $pdo->prepare("SELECT * FROM content_type_category WHERE `content_type_code` = :ctcode AND `code` = :code");
            $stmt->execute([
                ':ctcode' => $contentTypeCode,
                ':code' => $code,
            ]);
            $r = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($decode && !empty($r)) {
                $r = LocaleManager::decodeTranslations($r);
            }

            return $r ?? null;
        } catch (\Throwable $_) {
            return null;
        }
    }

    /**
     * Fetch single content type category by content type code and category code
     */
    public static function fetchByContentTypeCodeAndCode(string $contentTypeCode, string $code, bool $decode = false): ?array
    {
        try {
            $pdo = self::pdo();
            $stmt = $pdo->prepare("SELECT * FROM content_type_category WHERE `content_type_code` = :ctcode AND `code` = :code");
            $stmt->execute([
                ':ctcode' => $contentTypeCode,
                ':code' => $code,
            ]);
            $r = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($decode && !empty($r)) {
                $r = LocaleManager::decodeTranslations($r);
            }

            return $r ?? null;
        } catch (\Throwable $_) {
            return null;
        }
    }

    public function create(string $contentTypeCode, array $category, int $ordno): void
    {
        if (empty($category['code'])) {
            throw new \Exception('Content Type Category bez code-a!');
        }

        $stmt = $this->pdo->prepare("INSERT INTO content_type_category
            (`content_type_code`, `code`, `ordno`, `translations`)
            values (:contentTypeCode, :code, :ordno, :translations)
        ");

        $code = $category['code'];
        $translations = $category['translations'] ?? [
            'sr' => $category['code'],
            'sr-Cyrl' => $this->mapper->latin_to_cyrillic($category['code']),
            'en' => $category['code'],
        ];

        $stmt->bindValue(':contentTypeCode', $contentTypeCode);
        $stmt->bindValue(':code', $code);
        $stmt->bindValue(':ordno', $ordno);
        $stmt->bindValue(':translations', json_encode($translations));
        $stmt->execute();
    }

    public function update(string $contentTypeCode, array $category, int $ordno): void
    {
        if (empty($category['code'])) {
            throw new \Exception('Content Type Category bez code-a!');
        }

        $stmt = $this->pdo->prepare("UPDATE content_type_category
            SET `translations` = :translations, `ordno` = :ordno
            WHERE `content_type_code` = :contentTypeCode AND `code` = :code
        ");

        $code = $category['code'];
        $translations = $category['translations'] ?? [
            'sr' => $category['code'],
            'sr-Cyrl' => $this->mapper->latin_to_cyrillic($category['code']),
            'en' => $category['code'],
        ];

        $stmt->bindValue(':contentTypeCode', $contentTypeCode);
        $stmt->bindValue(':code', $code);
        $stmt->bindValue(':translations', json_encode($translations));
        $stmt->bindValue(':ordno', $ordno);
        $stmt->execute();
    }

    public function deleteByCode(string $contentTypeCode, string $code): void
    {
        $stmt = $this->pdo->prepare("DELETE FROM content_type_category WHERE content_type_code = :contentTypeCode AND code = :code");
        $stmt->execute([
            ':contentTypeCode' => $contentTypeCode,
            ':code' => $code,
        ]);
    }
}
