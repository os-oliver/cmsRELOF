<?php
namespace App\Controllers;

use App\Controllers\AuthController;
use App\Database;
use App\Models\Content;
use App\Models\ContentType;
use App\Models\CustomField;
use App\Models\GenericCategory;
use \PDO;


class MigrateController
{
    private \PDO $pdo;

    public function __construct()
    {
        AuthController::requireAdmin();
        $db = new Database();
        $this->pdo = $db->GetPDO();
    }

    public function migrations(): void
    {
        $stmt = $this->pdo->prepare("SELECT id FROM text WHERE lang=:en AND content=:resource");
        $stmt->execute([
            ':en' => 'en',
            ':resource' => 'General decisions',
        ]);

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($rows)) {
            die('Already migrated');
        }

        try {
            /* General decisions main category */

            $stmt = $this->pdo->prepare("INSERT INTO category_document (color_code) VALUES (:code)");
            $stmt->execute([
                ':code' => 'red-500',
            ]);

            $opsteOdlukeId = $this->pdo->lastInsertId();

            $stmt = $this->pdo->prepare("INSERT INTO text (source_id, source_table, field_name, lang, content)
                VALUES (:source_id, :source_table, :field_name, :lang, :content)
            ");

            $translations = [
                'sr' => 'Opšte odluke',
                'sr-Cyrl' => 'Опште одлуке',
                'en'  => 'General decisions',
            ];

            foreach ($translations as $lang => $content) {
                $stmt->execute([
                    ':source_id' => $opsteOdlukeId,
                    ':source_table' => 'category_document',
                    ':field_name' => 'name',
                    ':lang' => $lang,
                    ':content' => $content,
                ]);
            }
        } catch (\PDOException $e) {
            die ("General decisions category failed");
        }

        try {
            /* Site resource main category */

            $stmt = $this->pdo->prepare("INSERT INTO category_document (color_code) VALUES (:code)");
            $stmt->execute([
                ':code' => 'yellow-700',
            ]);

            $siteResourcesId = $this->pdo->lastInsertId();

            $stmt = $this->pdo->prepare("INSERT INTO text (source_id, source_table, field_name, lang, content)
                VALUES (:source_id, :source_table, :field_name, :lang, :content)
            ");

            $translations = [
                'sr' => 'Resurs sajta',
                'sr-Cyrl' => 'Ресурс сајта',
                'en'  => 'Site resource',
            ];

            foreach ($translations as $lang => $content) {
                $stmt->execute([
                    ':source_id' => $siteResourcesId,
                    ':source_table' => 'category_document',
                    ':field_name' => 'name',
                    ':lang' => $lang,
                    ':content' => $content,
                ]);
            }

        } catch (\PDOException $e) {
            die ("Site resource category failed");
        }

        try {
            /* Decisions subcategory */

            $stmt = $this->pdo->prepare("INSERT INTO subcategory_document (category_id) VALUES (:catId)");
            $stmt->execute([
                ':catId' => $opsteOdlukeId,
            ]);

            $decisionsSubId = $this->pdo->lastInsertId();

            $stmt = $this->pdo->prepare("INSERT INTO text (source_id, source_table, field_name, lang, content)
                VALUES (:source_id, :source_table, :field_name, :lang, :content)
            ");

            $translations = [
                'sr' => 'Odluke',
                'sr-Cyrl' => 'Одлуке',
                'en'  => 'Decisions',
            ];

            foreach ($translations as $lang => $content) {
                $stmt->execute([
                    ':source_id' => $decisionsSubId,
                    ':source_table' => 'subcategory_document',
                    ':field_name' => 'name',
                    ':lang' => $lang,
                    ':content' => $content,
                ]);
            }

        } catch (\PDOException $e) {
            die ("Decisions subcategory failed");
        }

        try {
            /* Magazine subcategory */

            $stmt = $this->pdo->prepare("INSERT INTO subcategory_document (category_id) VALUES (:catId)");
            $stmt->execute([
                ':catId' => $siteResourcesId,
            ]);

            $siteResourcesSubId = $this->pdo->lastInsertId();

            $stmt = $this->pdo->prepare("INSERT INTO text (source_id, source_table, field_name, lang, content)
                VALUES (:source_id, :source_table, :field_name, :lang, :content)
            ");

            $translations = [
                'sr' => 'Časopis',
                'sr-Cyrl' => 'Часопис',
                'en'  => 'Magazine',
            ];

            foreach ($translations as $lang => $content) {
                $stmt->execute([
                    ':source_id' => $siteResourcesSubId,
                    ':source_table' => 'subcategory_document',
                    ':field_name' => 'name',
                    ':lang' => $lang,
                    ':content' => $content,
                ]);
            }

        } catch (\PDOException $e) {
            die ("Magazine subcategory failed");
        }

        echo '<h1>Nove kategorije ugradjene!</h1>';
    }

    public function migrations2(): void
    {
        $stmt = $this->pdo->prepare("SELECT 1 FROM information_schema.COLUMNS WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME = 'content_type'");
        $stmt->execute([]);

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // if (!empty($rows)) {
        //     die('Already migrated');
        // }

        $sql = "CREATE TABLE IF NOT EXISTS `content_type` (
            `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `code` varchar(255) DEFAULT NULL,
            `name` varchar(255) DEFAULT NULL,
            `icon` varchar(255) DEFAULT NULL,
            `translations` json DEFAULT NULL,
            INDEX IDX_content_type_code (code)
            )
            DEFAULT CHARSET=utf8mb4
            COLLATE=utf8mb4_unicode_ci
            ENGINE=InnoDB
        ";

        $this->pdo->exec($sql);

        $sql = "CREATE TABLE IF NOT EXISTS custom_field (
            `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `content_type_code` varchar(255) NOT NULL,
            `code` varchar(255) DEFAULT NULL,
            `type` varchar(255) DEFAULT NULL,
            `ordno` int DEFAULT NULL,
            `input_type` varchar(255) DEFAULT NULL,
            `placeholder` json DEFAULT NULL,
            `required` int(1) DEFAULT 0,
            `name` varchar(255) DEFAULT NULL,
            `translations` json DEFAULT NULL,
            `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
            INDEX IDX_cf_content_type_code (content_type_code),
            CONSTRAINT FK_content_type_code FOREIGN KEY (content_type_code) REFERENCES content_type (code) ON DELETE CASCADE
            )
            DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ENGINE=InnoDB
        ";

        $this->pdo->exec($sql);

        $sql = "CREATE TABLE IF NOT EXISTS content (
            `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `content_type_code` varchar(255) NOT NULL,
            `ordno` int DEFAULT NULL,
            `translations` json DEFAULT NULL,
            `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
            INDEX IDX_content_content_type_code(content_type_code),
            CONSTRAINT FK_content_content_type_code FOREIGN KEY (content_type_code) REFERENCES content_type (code) ON DELETE RESTRICT
            )
            DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ENGINE=InnoDB
        ";

        $this->pdo->exec($sql);

        $sql = "CREATE TABLE IF NOT EXISTS custom_field_value (
            `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `content_id` int NOT NULL,
            `custom_field_id` int NOT NULL,
            `language` varchar(10) DEFAULT NULL,
            `content` varchar(5000) DEFAULT NULL,
            `yesno` int DEFAULT NULL,
            `date` datetime DEFAULT NULL,
            `option` varchar(255) DEFAULT NULL,
            `filepath` varchar(255) DEFAULT NULL,
            `ordno` int DEFAULT NULL,
            `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
            `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
            INDEX IDX_cfv_custom_field_id (custom_field_id),
            INDEX IDX_cfv_content_id (content_id),
            CONSTRAINT FK_cfv_custom_field_id FOREIGN KEY (custom_field_id) REFERENCES custom_field (id) ON DELETE CASCADE,
            CONSTRAINT FK_cfv_content_id FOREIGN KEY (content_id) REFERENCES content (id) ON DELETE CASCADE
            )
            DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ENGINE=InnoDB
        ";

        $this->pdo->exec($sql);

        $sql = "CREATE TABLE IF NOT EXISTS custom_field_option (
            `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `custom_field_id` int NOT NULL,
            `translations` json DEFAULT NULL,
            `option_value` varchar(255) DEFAULT NULL,
            `ordno` int DEFAULT NULL,
            `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
            INDEX IDX_cfo_custom_field_id (custom_field_id),
            CONSTRAINT FK_cfo_custom_field_id FOREIGN KEY (custom_field_id) REFERENCES custom_field (id) ON DELETE CASCADE
            )
            DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ENGINE=InnoDB
        ";

        $this->pdo->exec($sql);

        echo '<h1>Custom field tables created!</h1>';
    }

    public function convertCustomFields(): void
    {
        $definitionsPath = dirname(__DIR__, 2) . '/public/assets/data/structure.json';
        if (!is_file($definitionsPath)) {
            die('ne postoji structure.json!');
        }
        $structure = json_decode(file_get_contents($definitionsPath), true);
        if (empty($structure)) {
            die('nema definicija u structure.json!');
        }
        
        $oldTypes = array_keys($structure[0]);
        foreach($oldTypes as $oldSlug) {   
            $items = (new Content())->fetchListDataOld($oldSlug, '', 1, 1000);
            if ($items['total'] > 0) {
                $this->convertOldContent($items['items'], $oldSlug, $structure[0][$oldSlug]);
            }
        }

        echo '<h3>Conversion done!</h3>';
    }
    
    
    /**** converting functions ****/
    
    private function convertOldContent(array $items, string $oldSlug, array $jsonItem): void
    {
        $contentTypeCode = $jsonItem['code'];
        $locale = 'sr';
        $categories = GenericCategory::fetchAll($oldSlug, $locale);
        $contentType = ContentType::fetchByCode($contentTypeCode);
        $customFields = CustomField::fetchAllByContentTypeCode($contentTypeCode);
        $mainCategories = ContentType::fetchMainCategoriesByContentTypeCode($contentTypeCode, true);

        // get file CF
        $imageField = null;
        foreach ($customFields as $customField) {
            if ($customField['type'] == 'file') {
                $imageField = $customField;
                break;
            }
        }

        foreach ($items as $item) {
            $content = [];
            $content['type'] = $contentType['code'];
            foreach ($item['fields'] as $key => $field) {
                if (!empty($field['sr'])) {
                    $content[$key] = $field['sr'];
                }
            }

            if (empty($item['category']['id'])) {
                $content['main_category'] = $mainCategories[0]['option_value'];
            } else {
                $content['main_category'] = $this->remapCategory($item['category'], $mainCategories);
            }

            $savedContent = (new Content())->saveContent($content, [], 'sr');
            Content::addImagesToContent($savedContent['id'], $imageField, $item['images']);
        }
    }

    private function remapCategory(array $oldCategory, array $mainCategories): string
    {
        foreach ($mainCategories as $mainCategory) {
            foreach ($mainCategory['translations'] as $languageVariant) {
                if ($languageVariant == $oldCategory['content']) {
                    return $mainCategory['option_value'];
                }
            }
        }

        return '';
    }

}
