<?php
namespace App\Models;

use App\Database;
use App\Utils\TextHelper;
use App\Utils\Pivoter;
use GuzzleHttp\Psr7\Query;
use InvalidArgumentException;
use OverflowException;
use PDO;

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

    public function getCategories(): array
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
            AND t.source_table = 'subcategory_document';

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
        // parametri koji će se bind-ovati (jezik se koristi u podupitima za text)
        $params = [
            ':lang_doc' => $lang,
            ':lang_cat' => $lang,
        ];

        // --- WHERE delovi (pripremamo bez prefiksa "AND") ---
        $whereParts = [];

        // Ako postoji search, koristimo d.id IN (SELECT ... WHERE t.content LIKE :search)
        if ($search !== '') {
            $whereParts[] = "d.id IN (
            SELECT DISTINCT t.source_id
            FROM text t
            WHERE t.source_table = 'document'
              AND t.content LIKE :search
        )";
            $params[':search'] = '%' . $search . '%';
        }

        if ($category !== '') {
            $whereParts[] = "d.subcategory_id = :category";
            $params[':category'] = (int) $category;
        }
        if ($status !== '') {
            $whereParts[] = "d.status = :status";
            $params[':status'] = $status;
        }

        $whereSql = $whereParts ? 'WHERE ' . implode(' AND ', $whereParts) : '';

        // --- VALIDACIJA offset/limit i Overflow detekcija ---
        try {
            if (!is_numeric($offset) || !is_numeric($limit)) {
                throw new InvalidArgumentException('Offset i limit moraju biti numerički.');
            }
            $offsetFloat = (float) $offset;
            $limitFloat = (float) $limit;

            if ($offsetFloat > PHP_INT_MAX || $limitFloat > PHP_INT_MAX) {
                throw new OverflowException('Offset ili limit prelazi dozvoljeni opseg integera.');
            }

            $offsetInt = (int) $offsetFloat;
            $limitInt = (int) $limitFloat;

            $maxLimit = 10000;
            if ($limitInt < 0)
                $limitInt = 0;
            if ($offsetInt < 0)
                $offsetInt = 0;
            if ($limitInt > $maxLimit)
                $limitInt = $maxLimit;

        } catch (OverflowException $oe) {
            $offsetInt = 0;
            $limitInt = 100;
        } catch (Exception $e) {
            $offsetInt = 0;
            $limitInt = 100;
        }

        // --- DYNAMIC SORT MAP ---
        $sortMap = [
            'date_desc' => 'd.datetime DESC',
            'date_asc' => 'd.datetime ASC',
            'filesize_desc' => 'd.fileSize DESC',
            'filesize_asc' => 'd.fileSize ASC',
            'id_desc' => 'd.id DESC',
            'id_asc' => 'd.id ASC',
        ];
        $orderByInner = $sortMap[$sort] ?? $sortMap['date_desc'];
        // Outer order: isto, pa dodajemo te.field_name kao tie-breaker
        $orderByOuter = $orderByInner . ', te.field_name';

        // --- GLAVNI UPIT: prvo limitiramo dokumente po id-u, pa joinujemo ostalo (preslikava tvoju želju) ---
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
  (SELECT id FROM document d
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

        try {
            error_log("SQL: " . $sql);
            error_log("PARAMS: " . print_r($params, true));
            $stmt = $this->pdo->prepare($sql);

            // bind-ujemo parametre za glavni upit
            foreach ($params as $k => $v) {
                $type = is_int($v) ? PDO::PARAM_INT : PDO::PARAM_STR;
                $stmt->bindValue($k, $v, $type);
            }

            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log('Query failed: ' . $e->getMessage());
            $rows = [];
        }

        // ukupno (broj dokumenata posle filtera, bez limit-a) — boljе za paginaciju
        try {
            $countSql = "SELECT COUNT(*) FROM document d {$whereSql}";
            $countStmt = $this->pdo->prepare($countSql);
            // Bind only parameters that are actually present in the COUNT SQL
            foreach ($params as $k => $v) {
                if (strpos($countSql, $k) === false) {
                    // this parameter (e.g. :lang_doc or :lang_cat) is not used in the COUNT query
                    continue;
                }
                $type = is_int($v) ? PDO::PARAM_INT : PDO::PARAM_STR;
                $countStmt->bindValue($k, $v, $type);
            }
            $countStmt->execute();
            $total = (int) $countStmt->fetchColumn();
        } catch (\PDOException $e) {
            error_log('Count failed: ' . $e->getMessage());
            $total = 0;
        }

        return [$this->pivoter->pivot($rows), $total];
    }



    public function insert(array $data): bool
    {
        try {
            $this->pdo->beginTransaction();

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
            $locale = $_SESSION['locale'] ?? 'sr-Cyrl';

            // koristi TextHelper koji uključuje transliteraciju
            $titleVariants = TextHelper::transliterateVariants((string) ($data['title'] ?? ''), $locale);
            $descVariants = TextHelper::transliterateVariants((string) ($data['description'] ?? ''), $locale);

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
