<?php
namespace App\Controllers;

use App\Database;
use App\Utils\Pivoter;
use App\Utils\TextHelper;
use App\Utils\FileUploader;
use PDO;

use App\Controllers\AuthController;
use App\Models\Employee;
use App\Models\AboutUs;

session_start();

class ContentController
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
    /**
     * Insert content based on posted fields and uploaded files.
     *
     * @param array $post The $_POST data (must include 'type')
     * @param array $files The $_FILES data
     * @return bool
     */
    public function insert(array $post, array $files = [], bool $debug = false): void
    {
        // Obrati pažnju: ne sme biti nikakvog output-a pre headera
        header('Content-Type: application/json; charset=utf-8');
        try {
            $this->pdo->beginTransaction();

            if (!isset($post['type']) || empty($post['type'])) {
                throw new \InvalidArgumentException('Missing type in data');
            }

            $type = $post['type'];

            // detect update vs create
            $isUpdate = isset($post['id']) && ((int) $post['id'] > 0);
            if ($isUpdate) {
                $contentID = (int) $post['id'];
                // update type if it changed
                $ust = $this->pdo->prepare("UPDATE generic_element SET type = :type WHERE id = :id");
                $ust->execute([':type' => $type, ':id' => $contentID]);
            } else {
                $stmt = $this->pdo->prepare("INSERT INTO generic_element (type) VALUES (:type)");
                $stmt->execute([':type' => $type]);
                $contentID = (int) $this->pdo->lastInsertId();
            }

            $locale = $_SESSION['locale'] ?? 'sr-Cyrl';

            // load structure.json to determine field types
            $structurePath = __DIR__ . '/../../public/structure.json';
            $structure = [];
            if (is_file($structurePath)) {
                $json = file_get_contents($structurePath);
                $parsed = json_decode($json, true);
                if (is_array($parsed) && count($parsed) > 0) {
                    $structure = $parsed[0] ?? [];
                }
            }

            $config = $structure[$type] ?? null;
            $fields = $config['fields'] ?? [];

            // prepare uploader (uploads go to public/uploads)
            $uploadDir = realpath(__DIR__ . '/../../public') . DIRECTORY_SEPARATOR . 'uploads';
            $uploader = new FileUploader($uploadDir);

            foreach ($fields as $fieldDef) {
                $fieldName = $fieldDef['name'] ?? null;
                $fieldType = $fieldDef['type'] ?? 'text';
                if (!$fieldName) {
                    continue;
                }

                if ($fieldType === 'file') {
                    // support explicit remove flag during update
                    $removeFlag = $isUpdate && !empty($post['remove_' . $fieldName]);
                    if ($removeFlag) {
                        // remove stored entries for this field
                        TextHelper::deleteFieldEntries($this->pdo, $contentID, $fieldName, 'generic_element');
                    }

                    // handle new file upload if present during edit or create
                    if (isset($files[$fieldName]) && $files[$fieldName]['error'] !== UPLOAD_ERR_NO_FILE) {
                        $uploadedFilename = $uploader->upload($files[$fieldName]);
                        $publicPath = '/uploads/' . $uploadedFilename;
                        $variants = [$locale => $publicPath];
                        if ($isUpdate) {
                            TextHelper::updateTextEntries(
                                $this->pdo,
                                $contentID,
                                $fieldName,
                                $variants,
                                'generic_element'
                            );
                        } else {
                            TextHelper::insertTextEntries(
                                $this->pdo,
                                $contentID,
                                $fieldName,
                                $variants,
                                'generic_element'
                            );
                        }
                    } else {
                        // no new file uploaded: for create do nothing; for update if removeFlag was set we've already deleted entries, otherwise preserve existing file(s)
                    }
                } else {
                    // treat as text-like field
                    $value = $post[$fieldName] ?? '';
                    $variants = TextHelper::transliterateVariants((string) $value, $locale);
                    if ($isUpdate) {
                        TextHelper::updateTextEntries(
                            $this->pdo,
                            $contentID,
                            $fieldName,
                            $variants,
                            'generic_element'
                        );
                    } else {
                        TextHelper::insertTextEntries(
                            $this->pdo,
                            $contentID,
                            $fieldName,
                            $variants,
                            'generic_element'
                        );
                    }
                }
            }

            $this->pdo->commit();

            // Success: return JSON with ID and message
            if ($isUpdate) {
                http_response_code(200);
                echo json_encode([
                    'success' => true,
                    'id' => $contentID,
                    'message' => 'Updated',
                ], JSON_UNESCAPED_UNICODE);
            } else {
                http_response_code(201);
                echo json_encode([
                    'success' => true,
                    'id' => $contentID,
                    'message' => 'Created',
                ], JSON_UNESCAPED_UNICODE);
            }
            exit;
        } catch (\InvalidArgumentException $e) {
            // problem sa ulaznim podacima
            try {
                $this->pdo->rollBack();
            } catch (\Throwable $_) {
            }
            error_log('Insert failed (client error): ' . $e->getMessage());

            http_response_code(400);
            $resp = [
                'success' => false,
                'message' => 'Invalid request',
            ];
            if ($debug)
                $resp['error'] = $e->getMessage();
            echo json_encode($resp, JSON_UNESCAPED_UNICODE);
            exit;
        } catch (\Throwable $e) {
            // serverska greška
            try {
                $this->pdo->rollBack();
            } catch (\Throwable $_) {
            }
            error_log('Insert failed (server error): ' . $e->getMessage());

            http_response_code(500);
            $resp = [
                'success' => false,
                'message' => 'Internal server error',
            ];
            if ($debug)
                $resp['error'] = $e->getMessage();
            echo json_encode($resp, JSON_UNESCAPED_UNICODE);
            exit;
        }
    }


    /**
     * HTTP handler used by /editor/insert route: reads PHP globals and returns JSON
     */
    public function createFromRequest(): void
    {
        try {
            $ok = $this->insert($_POST, $_FILES);
            header('Content-Type: application/json');
            echo json_encode(['success' => $ok]);
        } catch (\Throwable $e) {
            header('Content-Type: application/json', true, 500);
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    /**
     * List generic elements for a given type with search and pagination.
     * Query params: type (required), q (optional search term), page (1-based), per (items per page)
     */
    public function listFromRequest(): void
    {
        // Use fetchListData to retrieve and echo JSON
        header('Content-Type: application/json; charset=utf-8');
        $type = $_GET['type'] ?? null;
        $q = trim((string) ($_GET['q'] ?? ''));
        $page = max(1, (int) ($_GET['page'] ?? 1));
        $per = max(1, min(100, (int) ($_GET['per'] ?? 10)));

        if (!$type) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Missing type']);
            return;
        }

        try {
            $data = $this->fetchListData($type, $q, $page, $per);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        } catch (\Throwable $e) {
            http_response_code(500);
            error_log('List failed: ' . $e->getMessage());
            echo json_encode(['success' => false, 'message' => 'Server error'], JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * Return list data array for given params (no headers, no output).
     */
    public function fetchListData(string $type, string $q = '', int $page = 1, int $per = 10): array
    {
        $q = trim((string) $q);
        $page = max(1, $page);
        $per = max(1, min(100, $per));
        $offset = ($page - 1) * $per;

        // Build base query
        $baseSql = "SELECT id FROM generic_element WHERE type = :type";
        $params = [':type' => $type];
        if ($q !== '') {
            $baseSql = "SELECT distinct ge.id FROM generic_element ge JOIN text t ON t.source_id = ge.id AND t.source_table = 'generic_element' WHERE ge.type = :type AND t.content LIKE :q";
            $params[':q'] = '%' . $q . '%';
        }

        // total
        $countStmt = $this->pdo->prepare("SELECT COUNT(*) FROM (" . $baseSql . ") AS ccount");
        $countStmt->execute($params);
        $total = (int) $countStmt->fetchColumn();

        // fetch ids
        $listSql = $baseSql . " ORDER BY id DESC LIMIT :lim OFFSET :off";
        $stmt = $this->pdo->prepare($listSql);
        foreach ($params as $k => $v) {
            if ($k === ':q')
                $stmt->bindValue($k, $v, PDO::PARAM_STR);
            else
                $stmt->bindValue($k, $v);
        }
        $stmt->bindValue(':lim', $per, PDO::PARAM_INT);
        $stmt->bindValue(':off', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $ids = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

        $items = [];
        if (count($ids) > 0) {
            $in = implode(',', array_fill(0, count($ids), '?'));
            $sql = "SELECT source_id, field_name, lang, content FROM text WHERE source_table = 'generic_element' AND source_id IN ($in)";
            $tstmt = $this->pdo->prepare($sql);
            foreach ($ids as $i => $idv)
                $tstmt->bindValue($i + 1, $idv, PDO::PARAM_INT);
            $tstmt->execute();
            $rows = $tstmt->fetchAll(PDO::FETCH_ASSOC);

            $texts = [];
            foreach ($rows as $r) {
                $sid = (int) $r['source_id'];
                $fn = $r['field_name'];
                $lang = $r['lang'];
                $content = $r['content'];
                $texts[$sid][$fn][$lang] = $content;
            }

            foreach ($ids as $idv) {
                $items[] = [
                    'id' => (int) $idv,
                    'type' => $type,
                    'fields' => $texts[$idv] ?? [],
                ];
            }
        }

        return [
            'success' => true,
            'total' => $total,
            'page' => $page,
            'per' => $per,
            'items' => $items,
        ];
    }

    /**
     * Fetch a single generic element by id (no output, returns array)
     */
    public function fetchItem(int $id): array
    {
        $id = (int) $id;
        if ($id <= 0) {
            return ['success' => false, 'message' => 'Invalid id'];
        }

        $sql = "SELECT source_id, field_name, lang, content FROM text WHERE source_table = 'generic_element' AND source_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $fields = [];
        foreach ($rows as $r) {
            $fn = $r['field_name'];
            $lang = $r['lang'];
            $content = $r['content'];
            $fields[$fn][$lang] = $content;
        }

        return ['success' => true, 'item' => ['id' => $id, 'fields' => $fields]];
    }

    /**
     * HTTP handler to return a single item as JSON (expects ?id=)
     */
    public function getItemFromRequest(): void
    {
        header('Content-Type: application/json; charset=utf-8');
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        if ($id <= 0) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Missing id']);
            return;
        }

        try {
            $data = $this->fetchItem($id);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        } catch (\Throwable $e) {
            http_response_code(500);
            error_log('Get item failed: ' . $e->getMessage());
            echo json_encode(['success' => false, 'message' => 'Server error'], JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * Delete a generic element and its text entries. Expects POST: id
     */
    public function deleteFromRequest(): void
    {
        header('Content-Type: application/json; charset=utf-8');
        $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
        if ($id <= 0) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid id']);
            return;
        }

        try {
            $this->pdo->beginTransaction();
            // delete text rows
            $t = $this->pdo->prepare("DELETE FROM text WHERE source_table = 'generic_element' AND source_id = :id");
            $t->execute([':id' => $id]);
            // delete generic element
            $g = $this->pdo->prepare("DELETE FROM generic_element WHERE id = :id");
            $g->execute([':id' => $id]);
            $this->pdo->commit();

            echo json_encode(['success' => true], JSON_UNESCAPED_UNICODE);
        } catch (\Throwable $e) {
            try {
                $this->pdo->rollBack();
            } catch (\Throwable $_) {
            }
            http_response_code(500);
            error_log('Delete failed: ' . $e->getMessage());
            echo json_encode(['success' => false, 'message' => 'Server error'], JSON_UNESCAPED_UNICODE);
        }
    }


}
