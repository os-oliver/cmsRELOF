<?php
namespace App\Models;

use App\Database;
use App\Utils\LocaleManager;
use PDO;

class ContentType
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
     * Fetch all content types
     */
    public static function fetchAll(): array
    {
        $pdo = self::pdo();
        try {
            $stmt = $pdo->prepare("SELECT * FROM content_type");
            $stmt->execute([]);
            $contentTypes = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $contentTypes;

            /*
            // Dohvati imena kategorija sa željenim jezikom, fallback na sr-Cyrl
            $ids = array_column($categories, 'id');
            $inQuery = implode(',', array_fill(0, count($ids), '?'));

            $stmtText = $pdo->prepare("
            SELECT source_id, content, lang
            FROM text
            WHERE source_table = 'generic_category'
              AND source_id IN ($inQuery)
              AND field_name = 'name'
              AND lang IN (?, 'sr-Cyrl')
            ORDER BY FIELD(lang, ?, 'sr-Cyrl')
        ");

            // Bind values: svi id-evi + jezik + jezik za FIELD()
            $stmtText->execute(array_merge($ids, [$lang, $lang]));
            $texts = $stmtText->fetchAll(PDO::FETCH_ASSOC);

            // Mapiraj imena po kategoriji, uz fallback
            $names = [];
            foreach ($texts as $text) {
                if (!isset($names[$text['source_id']])) {
                    $names[$text['source_id']] = $text['content'];
                }
            }

            // Dodaj name u rezultat
            foreach ($categories as &$cat) {
                $cat['name'] = $names[$cat['id']] ?? null;
            }

            return $categories;
            */

        } catch (\Throwable $e) {
            return [];
        }

        return [];
    }


    /**
     * Fetch single content type by code
     */
    public static function fetchByCode(string $code, bool $decode = false): ?array
    {
        try {
            $pdo = self::pdo();
            $stmt = $pdo->prepare("SELECT * FROM content_type c WHERE code = :code");
            $stmt->execute([':code' => $code]);
            $r = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($decode && !empty($r)) {
                $r = LocaleManager::decodeTranslations($r);
            }

            return $r ?? null;
        } catch (\Throwable $_) {
            return null;
        }
    }

    public static function fetchMainCategoriesByContentTypeCode(string $contentTypeCode, bool $decode = false): array
    {
        $pdo = self::pdo();
        try {
            $stmt = $pdo->prepare("SELECT cfo.* FROM custom_field_option cfo INNER JOIN custom_field cf ON cf.id = cfo.custom_field_id WHERE cf.content_type_code = :code AND cf.code = :mainCat ORDER BY cfo.ordno ASC");
            $stmt->execute([
                ':mainCat' => 'main_category',
                ':code' => $contentTypeCode
            ]);
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
     * Fetch single content type by code
     */
    public static function fetchCategoryByContentTypeCodeAndCode(string $contentTypeCode, string $code, bool $decode = false): array
    {
        $pdo = self::pdo();
        try {
            $stmt = $pdo->prepare("SELECT cfo.* FROM custom_field_option cfo INNER JOIN custom_field cf ON cf.id = cfo.custom_field_id WHERE cf.content_type_code = :ctcode AND cfo.option_value = :option");
            $stmt->execute([
                ':ctcode' => $contentTypeCode,
                ':option' => $code
            ]);
            $category = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($decode && !empty($category)) {
                $category = LocaleManager::decodeTranslations([$category]);
                $category = $category[0];
            }

            if (empty($category)) {
                $category = null;
            }

            return $category;
        } catch (\Throwable $e) {
            return [];
        }

        return [];
    }

    public function create(array $contentType): void
    {
        if (empty($contentType['code'])) {
            throw new \Exception('Content Type bez code-a!!');
        }

        $stmt = $this->pdo->prepare("INSERT INTO content_type
            (`code`, `name`, `icon`, `translations`)
            values (:code, :name, :icon, :translations)
        ");

        $code = $contentType['code'];
        $name = $contentType['sr'] ?? '';
        $icon = $contentType['icon'] ?? '';
        $translations = [
            'sr' => $contentType['sr'] ?? '',
            'sr-Cyrl' => $contentType['sr-Cyrl'] ?? '',
            'en' => $contentType['en'] ?? '',
        ];

        $stmt->bindValue(':code', $code);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':icon', $icon);
        $stmt->bindValue(':translations', json_encode($translations));
        $stmt->execute();
    }

    public function update(array $contentType): void
    {
        if (empty($contentType['code'])) {
            throw new \Exception('Content Type bez code-a!!');
        }

        $stmt = $this->pdo->prepare("UPDATE content_type
            SET `name` = :name, `icon` = :icon, `translations` = :translations
            WHERE code = :code
        ");

        $code = $contentType['code'];
        $name = $contentType['sr'] ?? '';
        $icon = $contentType['icon'] ?? '';
        $translations = [
            'sr' => $contentType['sr'] ?? '',
            'sr-Cyrl' => $contentType['sr-Cyrl'] ?? '',
            'en' => $contentType['en'] ?? '',
        ];

        $stmt->bindValue(':code', $code);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':icon', $icon);
        $stmt->bindValue(':translations', json_encode($translations));
        $stmt->execute();
    }

    public function deleteByCode(string $code): void
    {
        $stmt = $this->pdo->prepare("DELETE FROM content_type WHERE code = :code");
        $stmt->execute([
            ':code' => $code,
        ]);
    }
}
