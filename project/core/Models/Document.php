<?php
namespace App\Models;

use App\Database;
use App\Utils\LocaleManager;
use App\Utils\TextHelper;
use App\Utils\Pivoter;
use GuzzleHttp\Psr7\Query;
use InvalidArgumentException;
use OverflowException;
use PDO;
use Exception;

class Document
{
    private PDO $pdo;
    private Pivoter $pivoter;

    public function __construct()
    {
        $this->pdo = (new Database())->GetPDO();
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
        $this->pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf8mb4");


        $this->pivoter = new Pivoter('field_name', 'content', 'id');
    }
    public function getCategories(string $lang): array
    {
        $sql = "
        SELECT 
            c.*, 
            t.field_name,
            t.content,
            t.id AS text_id
        FROM category_document c
        LEFT JOIN text t
            ON t.source_id = c.id
            AND t.lang = :lang
            AND t.source_table = 'category_document';
    ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':lang' => $lang]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $this->pivoter->pivot($rows);
    }
    public function getSubCategories(string $lang): array
    {
        $sql = "
        SELECT 
            sc.*, 
            t.field_name,
            t.content,
            t.id AS text_id
        FROM subcategory_document sc
        LEFT JOIN text t
            ON t.source_id = sc.id
            AND t.lang = :lang
            AND t.source_table = 'subcategory_document';
    ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':lang' => $lang]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $this->pivoter->pivot($rows);
    }


    public function list(
        int $limit = 10,
        int $offset = 0,
        string $search = '',
        array $categories = [],
        string $status = '',
        string $sort = 'date_desc',
        string $lang = 'sr-Cyrl'
    ): array {
        // --- parametri koji će se bind-ovati ---
        $params = [
            ':lang_doc' => $lang,
            ':lang_cat' => $lang,
        ];

        // --- WHERE delovi ---
        $whereParts = [];

        // Search filter
        if ($search !== '') {
            $whereParts[] = "d.id IN (
            SELECT DISTINCT t.source_id
            FROM text t
            WHERE t.source_table = 'document'
              AND t.content LIKE :search
        )";
            $params[':search'] = '%' . $search . '%';
            error_log("DEBUG: Applying search filter with :search = {$params[':search']}");
        }

        // Categories filter
        if (!empty($categories)) {
            $categoryPlaceholders = [];
            foreach ($categories as $i => $cat) {
                $placeholder = ":category{$i}";
                $categoryPlaceholders[] = $placeholder;
                $params[$placeholder] = (int) $cat;
            }
            $whereParts[] = "s.category_id IN (" . implode(", ", $categoryPlaceholders) . ")";
            error_log("DEBUG: Applying categories filter with placeholders: " . implode(", ", $categoryPlaceholders));
        }

        // Status filter
        if ($status !== '') {
            $whereParts[] = "d.status = :status";
            $params[':status'] = $status;
            error_log("DEBUG: Applying status filter with :status = {$status}");
        }

        $whereSql = $whereParts ? 'WHERE ' . implode(' AND ', $whereParts) : '';
        error_log("DEBUG: WHERE SQL = {$whereSql}");

        // --- VALIDACIJA offset/limit ---
        try {
            if (!is_numeric($offset) || !is_numeric($limit)) {
                throw new InvalidArgumentException('Offset i limit moraju biti numerički.');
            }
            $offsetInt = max(0, min(PHP_INT_MAX, (int) $offset));
            $limitInt = max(0, min(10000, (int) $limit));
        } catch (\Exception $e) {
            error_log("DEBUG: Invalid offset/limit, using defaults. Exception: " . $e->getMessage());
            $offsetInt = 0;
            $limitInt = 100;
        }
        error_log("DEBUG: Using OFFSET = {$offsetInt}, LIMIT = {$limitInt}");

        // --- SORT MAP ---
        $sortMap = [
            'date_desc' => 'd.datetime DESC',
            'date_asc' => 'd.datetime ASC',
            'filesize_desc' => 'd.fileSize DESC',
            'filesize_asc' => 'd.fileSize ASC',
            'id_desc' => 'd.id DESC',
            'id_asc' => 'd.id ASC',
        ];
        $orderByInner = $sortMap[$sort] ?? $sortMap['date_desc'];
        $orderByOuter = $orderByInner . ', te.field_name';
        error_log("DEBUG: ORDER BY INNER = {$orderByInner}, OUTER = {$orderByOuter}");

        // --- GLAVNI UPIT ---
        $sql = "
SELECT
  d.id,
  d.subcategory_id,
  d.filepath,
  d.extension,
  d.datetime,
  d.fileSize,
  te.field_name,
  te.content,
  sc_text.content AS name,
  c.color_code
FROM
  (SELECT d.id FROM document d
    JOIN subcategory_document s ON s.id = d.subcategory_id
    {$whereSql}
    ORDER BY {$orderByInner}
    LIMIT {$offsetInt}, {$limitInt}
  ) pd
JOIN document d ON d.id = pd.id
LEFT JOIN (
    SELECT t.source_id, t.field_name,
      COALESCE(
        MAX(CASE WHEN t.lang = :lang_doc THEN t.content END),
        MAX(CASE WHEN t.lang = 'sr-Cyrl' THEN t.content END)
      ) AS content
    FROM text t
    WHERE t.source_table = 'document' AND t.lang IN (:lang_doc, 'sr-Cyrl')
    GROUP BY t.source_id, t.field_name
) te ON te.source_id = d.id
LEFT JOIN subcategory_document s ON s.id = d.subcategory_id
LEFT JOIN category_document c ON c.id = s.category_id
LEFT JOIN (
    SELECT t.source_id,
      COALESCE(
        MAX(CASE WHEN t.lang = :lang_cat THEN t.content END),
        MAX(CASE WHEN t.lang = 'sr-Cyrl' THEN t.content END)
      ) AS content
    FROM text t
    WHERE t.source_table = 'subcategory_document' AND t.lang IN (:lang_cat, 'sr-Cyrl')
    GROUP BY t.source_id
) sc_text ON sc_text.source_id = s.id
ORDER BY {$orderByOuter};
";

        error_log("DEBUG: Full SQL = {$sql}");
        error_log("DEBUG: Params = " . print_r($params, true));

        // --- EXECUTE ---
        try {
            $stmt = $this->pdo->prepare($sql);
            foreach ($params as $k => $v) {
                $type = is_int($v) ? PDO::PARAM_INT : PDO::PARAM_STR;
                $stmt->bindValue($k, $v, $type);
            }
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            error_log("DEBUG: Number of rows fetched = " . count($rows));
        } catch (\PDOException $e) {
            error_log('Query failed: ' . $e->getMessage() . ' | SQLSTATE: ' . $e->getCode());
            $rows = [];
        }

        // --- COUNT for pagination ---
        try {
            $countSql = "SELECT COUNT(*) FROM document d JOIN subcategory_document s ON s.id = d.subcategory_id {$whereSql}";
            $countStmt = $this->pdo->prepare($countSql);
            foreach ($params as $k => $v) {
                if (strpos($countSql, $k) === false)
                    continue;
                $type = is_int($v) ? PDO::PARAM_INT : PDO::PARAM_STR;
                $countStmt->bindValue($k, $v, $type);
            }
            $countStmt->execute();
            $total = (int) $countStmt->fetchColumn();
            error_log("DEBUG: Total count after filters = {$total}");
        } catch (\PDOException $e) {
            error_log('Count failed: ' . $e->getMessage() . ' | SQLSTATE: ' . $e->getCode());
            $total = 0;
        }

        $result = $this->pivoter->pivot($rows);

        // Ako je sortiranje po imenu
        if (isset($sort) && $sort === 'ime') {
            usort($result, function ($a, $b) {
                return strcmp($a['title'] ?? '', $b['title'] ?? '');
            });
        }

        return [$result, $total];
    }




    public function insert(array $data): bool
    {
        try {
            $this->pdo->beginTransaction();
            error_log('Transaction started');

            $stmt = $this->pdo->prepare("
            INSERT INTO document (filepath, extension, fileSize, subcategory_id, datetime)
            VALUES (:filepath, :extension, :fileSize, :category, NOW())
        ");

            $stmt->execute([
                ':filepath' => $data['filepath'] ?? '',
                ':extension' => $data['extension'] ?? '',
                ':fileSize' => $data['fileSize'] ?? 0,
                ':category' => $data['category'] ?? null,
            ]);

            $documentId = (int) $this->pdo->lastInsertId();
            error_log("Inserted document ID: $documentId");

            if (!$documentId) {
                throw new \Exception('Document ID not returned after insert');
            }

            $locale = $_SESSION['locale'] ?? 'sr-Cyrl';
            error_log("Locale: $locale");

            // koristi TextHelper koji uključuje transliteraciju
            TextHelper::insertTextEntries(
                $this->pdo,
                $documentId,
                'title',
                TextHelper::transliterateVariants((string) ($data['title'] ?? ''), $locale)
            );
            error_log("Title inserted");

            TextHelper::insertTextEntries(
                $this->pdo,
                $documentId,
                'description',
                TextHelper::transliterateVariants((string) ($data['description'] ?? ''), $locale)
            );
            error_log("Description inserted");

            $this->pdo->commit();
            error_log("Transaction committed successfully");
            return true;

        } catch (\PDOException $e) {
            $this->pdo->rollBack();
            error_log('PDOException: ' . $e->getMessage() . ' | Code: ' . $e->getCode());
            return false;
        } catch (\Exception $e) {
            $this->pdo->rollBack();
            error_log('General Exception: ' . $e->getMessage());
            return false;
        }
    }

    public function update(int $documentId, array $data): bool
    {
        try {
            $this->pdo->beginTransaction();

            // Zaključaj red da bismo bili sigurni da postoji i da niko drugi ne menja istovremeno
            $sel = $this->pdo->prepare("SELECT id FROM document WHERE id = :id FOR UPDATE");
            $sel->execute([':id' => $documentId]);
            if ($sel->fetchColumn() === false) {
                // dokument ne postoji
                $this->pdo->rollBack();
                return false;
            }

            $stmt = $this->pdo->prepare("
            UPDATE document
            SET
               
                subcategory_id = :category,
                datetime = NOW()
            WHERE id = :id
        ");
            $stmt->execute([

                ':category' => $data['category'] ?? null,
                ':id' => $documentId,
            ]);

            // locale iz sesije (isto kao u insert)
            $locale = LocaleManager::get();
            session_start();
            error_log("Locale for update: $locale");
            // koristi TextHelper koji uključuje transliteraciju
            $titleVariants = TextHelper::transliterateVariants((string) ($data['title'] ?? ''), $locale);
            $descVariants = TextHelper::transliterateVariants((string) ($data['description'] ?? ''), $locale);
            error_log("Title variants: " . print_r($titleVariants, true));
            // Ako postoji metoda za update u TextHelper, koristi je — inače obriši postojeće i ubaci nove
            if (method_exists(TextHelper::class, 'updateTextEntries')) {
                TextHelper::updateTextEntries(
                    $this->pdo,
                    $documentId,
                    'title',
                    $titleVariants
                );
                TextHelper::updateTextEntries(
                    $this->pdo,
                    $documentId,
                    'description',
                    $descVariants
                );
            } else {
                // Pokušaj najpre da obrišeš stare vrednosti koristeći TextHelper ako ima delete metodu
                if (method_exists(TextHelper::class, 'deleteTextEntries')) {
                    TextHelper::deleteTextEntries($this->pdo, $documentId, 'title');
                    TextHelper::deleteTextEntries($this->pdo, $documentId, 'description');
                } else {
                    // Fallback: obriši direktno iz pretpostavljene tabele dokument-teksta
                    // (ako tvoja struktura tabele ima drugačije ime/kolone, prilagodi)
                    $del = $this->pdo->prepare("DELETE FROM document_text WHERE document_id = :id AND field = :field");
                    $del->execute([':id' => $documentId, ':field' => 'title']);
                    $del->execute([':id' => $documentId, ':field' => 'description']);
                }

                // Ponovo ubaci tekstualne zapise
                TextHelper::insertTextEntries($this->pdo, $documentId, 'title', $titleVariants);
                TextHelper::insertTextEntries($this->pdo, $documentId, 'description', $descVariants);
            }

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
    public function countDistinctSubcategories(): int
    {
        $stmt = $this->pdo->query("SELECT COUNT(DISTINCT subcategory_id) FROM document");
        return (int) $stmt->fetchColumn();
    }
}
