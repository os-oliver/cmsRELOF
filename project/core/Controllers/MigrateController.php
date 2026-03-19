<?php
namespace App\Controllers;

use App\Database;
use \PDO;

class MigrateController
{
    private \PDO $pdo;

    public function __construct()
    {
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

    }

}
