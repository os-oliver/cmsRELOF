<?php
namespace App\Models;

use App\Database;
use App\Utils\TextHelper;
use PDO;

class GenericCategory
{
    /**
     * Return PDO instance
     */
    private static function pdo(): PDO
    {
        return (new Database())->GetPDO();
    }

    /**
     * Fetch all categories
     */
    public static function fetchAll(string $type, string $lang = 'sr-Cyrl'): array
    {
        try {
            $pdo = self::pdo();

            // Dohvat svih kategorija po tipu
            $stmt = $pdo->prepare("SELECT id, type FROM generic_category WHERE type = :type ORDER BY id ASC");
            $stmt->execute([':type' => $type]);
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!$categories) {
                return [];
            }

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

        } catch (\Throwable $e) {
            return [];
        }
    }


    /**
     * Fetch single category by ID
     */
    public static function fetchById(int $id): ?array
    {
        try {
            $pdo = self::pdo();
            $stmt = $pdo->prepare("SELECT id, name, type FROM category WHERE id = :id LIMIT 1");
            $stmt->execute([':id' => $id]);
            $r = $stmt->fetch(PDO::FETCH_ASSOC);
            return $r ?: null;
        } catch (\Throwable $_) {
            return null;
        }
    }

    /**
     * Insert a new category (returns lastInsertId)
     */
    /**
     * Briše sve postojeće kategorije i unosi novi set podataka.
     * Sve se izvršava unutar jedne transakcije.
     *
     * @param array $categories Niz kategorija, gde je svaki element asocijativni niz npr. ['name' => 'Naziv', 'type' => 'Tip']
     * @return bool Da li je operacija uspela.
     */
    public static function replaceAllCategories(array $categories): bool
    {
        $pdo = null;
        try {
            $pdo = self::pdo();

            // --- ZAPOČINJEMO JEDNU TRANSAKCIJU ZA SVE ---
            $pdo->beginTransaction();

            // Korak 1: Brisanje postojećih podataka (samo jednom)
            $pdo->exec("DELETE FROM text WHERE source_table = 'generic_category'");
            $pdo->exec("DELETE FROM generic_category");
            $pdo->exec("ALTER TABLE generic_category AUTO_INCREMENT = 1");

            // Pripremamo upite pre petlje radi boljih performansi
            $stmtCategory = $pdo->prepare("INSERT INTO generic_category (type) VALUES (:type)");
            $locale = 'sr';

            // Korak 2: Unos svih novih kategorija u petlji
            foreach ($categories as $category) {
                if (!isset($category['name']) || !isset($category['type'])) {
                    // Preskoči ako format nije dobar, ili baci izuzetak
                    continue;
                }

                // Unos u generic_category
                $stmtCategory->execute([':type' => $category['type']]);
                $categoryId = (int) $pdo->lastInsertId();

                // Unos tekstualnih varijanti
                $variants = TextHelper::transliterateVariants((string) $category['name'], $locale);
                TextHelper::insertTextEntries(
                    $pdo,
                    $categoryId,
                    'name',
                    $variants,
                    'generic_category'
                );
            }

            // --- POTVRĐUJEMO SVE PROMENE ODJEDNOM ---
            $pdo->commit();

            return true;

        } catch (\Throwable $e) {
            // Ako bilo šta pukne, poništavamo SVE
            if ($pdo && $pdo->inTransaction()) {
                $pdo->rollBack();
            }
            error_log("replaceAllCategories failed: " . $e->getMessage());
            return false;
        }
    }


    /**
     * Update a category
     */
    public static function updateCategory(int $id, string $name, ?string $type = null): bool
    {
        try {
            $pdo = self::pdo();
            $stmt = $pdo->prepare("UPDATE category SET name = :name, type = :type WHERE id = :id");
            return $stmt->execute([
                ':name' => $name,
                ':type' => $type,
                ':id' => $id
            ]);
        } catch (\Throwable $_) {
            return false;
        }
    }

    /**
     * Delete a category by ID
     */
    public static function deleteCategory(int $id): bool
    {
        try {
            $pdo = self::pdo();
            $stmt = $pdo->prepare("DELETE FROM category WHERE id = :id");
            return $stmt->execute([':id' => $id]);
        } catch (\Throwable $_) {
            return false;
        }
    }

    /**
     * Fetch all elements that belong to a specific category
     */
    public static function fetchElementsByCategory(int $categoryId, $lang): array
    {
        try {
            $pdo = self::pdo();
            $sql = "
            
                SELECT ge.id, ge.type 
                FROM generic_element AS ge
                WHERE ge.category_id = :categoryId
                ORDER BY ge.id ASC
            ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':categoryId' => $categoryId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $_) {
            return [];
        }
    }
}
