<?php
namespace App\Models;
use App\Database;

class Document
{
    private $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->GetPDO();
    }

    /**
     * Dohvati sve kategorije sa poljem 'name' iz text tabele (staticki element: name)
     * Vraća niz asoc. nizova: id, color_code, name
     */
    public function getCategories(string $lang = 'sr'): array
    {
        $sql = "
            SELECT
                c.id,
                c.color_code,
                MAX(CASE WHEN t.field_name = 'name' THEN t.content END) AS name
            FROM category_document c
            LEFT JOIN text t
              ON t.source_table = 'category_document'
              AND t.source_id = c.id
              AND t.field_name = 'name'
              AND t.lang = :lang
            GROUP BY c.id
            ORDER BY c.id ASC
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':lang', $lang, \PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC) ?: [];
    }

    /**
     * Lista dokumenata. Svaki dokument sadrži sada direktno:
     * - title
     * - description
     * - category_id
     * - category_name (iz text table za category_document.field_name = 'name')
     * - category_color_code
     *
     * Vraća [ $documentsArray, $totalCount ]
     */
    public function list(
        string $lang = 'sr',
        int $limit = 10,
        int $offset = 0,
        string $search = '',
        string $category = '',
        string $status = '',
        string $sort = 'date_desc'
    ): array {
        // WHERE delovi i parametri (za COUNT i za glavni upit)
        $where = [];
        $having = '';
        $params = [];

        if ($search !== '') {
            // Pretražujemo u text.content za dokument
            $having = "having title like :sss";
            $params[':sss'] = $search;
        }
        if ($category !== '') {
            $where[] = "d.category_id = :category";
            $params[':category'] = $category;
        }
        if ($status !== '') {
            $where[] = "d.status = :status";
            $params[':status'] = $status;
        }

        $order = match ($sort) {
            'date_asc' => "ORDER BY d.datetime ASC",
            'title' => "ORDER BY COALESCE(MAX(CASE WHEN td.field_name = 'title' THEN td.content END), d.title) ASC",
            default => "ORDER BY d.datetime DESC",
        };

        $whereSql = $where ? ' WHERE ' . implode(' AND ', $where) : '';

        // COUNT (ukupno dokumenata sa istim WHERE uslovima)
        $countSql = "SELECT COUNT(*) FROM document d" . $whereSql;
        $countStmt = $this->pdo->prepare($countSql);
        // bind count params
        foreach ($params as $k => $v) {
            $countStmt->bindValue($k, $v, \PDO::PARAM_STR);
        }
        $countStmt->execute();
        $total = (int) $countStmt->fetchColumn();

        // Glavni upit: pivotujemo title/description iz text-a i dohvatimo category_name iz text-a za kategoriju
        $sql = "
            SELECT
                d.*,
                -- title i description iz text tabele (ako postoje), fallback na kolone u document ako su prazni
                MAX(CASE WHEN td.field_name = 'title' THEN td.content END) AS title,
                MAX(CASE WHEN td.field_name = 'description' THEN td.content END) AS description,
                c.id AS category_id,
                c.color_code AS category_color_code,
                MAX(CASE WHEN tc.field_name = 'name' THEN tc.content END) AS category_name
            FROM document d
            LEFT JOIN text td
              ON td.source_table = 'document'
              AND td.source_id = d.id
              AND td.lang = :lang_doc
            LEFT JOIN category_document c
              ON c.id = d.category_id
            LEFT JOIN text tc
              ON tc.source_table = 'category_document'
              AND tc.source_id = c.id
              AND tc.field_name = 'name'
              AND tc.lang = :lang_cat
            GROUP BY d.id
            {$having}
            {$order}
            LIMIT :limit OFFSET :offset
        ";

        $stmt = $this->pdo->prepare($sql);

        // bind where params (string params)
        foreach ($params as $k => $v) {
            $stmt->bindValue($k, $v, \PDO::PARAM_STR);
        }

        // bind language params za dokument i za kategoriju
        $stmt->bindValue(':lang_doc', $lang, \PDO::PARAM_STR);
        $stmt->bindValue(':lang_cat', $lang, \PDO::PARAM_STR);

        // bind limit/offset kao integer
        $stmt->bindValue(':limit', (int) $limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int) $offset, \PDO::PARAM_INT);

        $stmt->execute();
        $documents = $stmt->fetchAll(\PDO::FETCH_ASSOC) ?: [];
        return [$documents, $total];
    }
}
