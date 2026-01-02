<?php
namespace App\Models;

use App\Database;
use App\Utils\Config;
use App\Utils\Pivoter;
use App\Utils\TextHelper;
use App\Utils\FileUploader;
use PDO;
use Throwable;
use RuntimeException;
use InvalidArgumentException;

class Content
{
    private PDO $pdo;
    private Pivoter $pivoter;
    private FileUploader $uploader;
    private bool $genericHasImageId;

    public function __construct(?PDO $pdo = null)
    {
        if ($pdo === null) {
            $this->pdo = (new Database())->GetPDO();
            $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
            $this->pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf8mb4");
        } else {
            $this->pdo = $pdo;
        }

        $this->pivoter = new Pivoter('field_name', 'content', 'id');
        $uploadDir = realpath(__DIR__ . '/../../public/uploads');
        $this->uploader = new FileUploader($uploadDir);
        $this->genericHasImageId = $this->checkGenericHasImageId();
    }

    // ============================================================
    // PUBLIC API
    // ============================================================

    public function saveContent(array $post, array $files = [], string $locale = 'sr-Cyrl', bool $debug = false): array
    {
        if (empty($post['type'])) {
            throw new InvalidArgumentException('Missing type in data');
        }

        $type = $post['type'];
        $isUpdate = isset($post['id']) && ((int) $post['id'] > 0);

        if (!Config::hasType($type)) {
            throw new RuntimeException("No config found for type: {$type}");
        }

        $this->pdo->beginTransaction();
        try {
            $contentID = $isUpdate
                ? $this->updateContentRecord((int) $post['id'], $type)
                : $this->insertContentRecord($type);

            $fields = Config::getFields($type);
            $this->processFields($contentID, $fields, $post, $files, $locale, $isUpdate);

            $this->pdo->commit();

            return [
                'success' => true,
                'id' => $contentID,
                'message' => $isUpdate ? 'Updated' : 'Created',
            ];
        } catch (Throwable $e) {
            $this->rollbackTransaction();
            throw $e;
        }
    }

    public function fetchListData(
        string $type,
        string $q = '',
        int $page = 1,
        int $per = 10,
        int|string|null $categoryId = null, 
        string $lang = 'sr',
        int|null $fromYear = null,
        int|null $toYear = null
    ): array {
        $q = trim((string) $q);
        $page = max(1, $page);
        $per = max(1, min(100, $per));
        $offset = ($page - 1) * $per;

        $where = "ge.type = :type";
        $params = [':type' => $type];

        if ($fromYear !== null && $fromYear > 0) {
            $where .= " AND CAST(SUBSTRING(t_year.content, 1, 4) AS UNSIGNED) >= :from_year";
            $params[':from_year'] = $fromYear;
        }

        if ($toYear !== null && $toYear > 0) {
            $where .= " AND CAST(SUBSTRING(t_year.content, 1, 4) AS UNSIGNED) <= :to_year";
            $params[':to_year'] = $toYear;
        }

        error_log(json_encode($categoryId));
        if ($categoryId !== null) {

            if (is_numeric($categoryId)) {
                // if it's an integer, use directly
                $where .= " AND ge.category_id = :category_id";
                $params[':category_id'] = (int) $categoryId;
            } else {
                // if it's a string, resolve it to numeric id first
                $resolvedId = $this->fetchCategoryIdByName((string) $categoryId);
                error_log($resolvedId);
                if ($resolvedId !== null) {
                    $where .= " AND ge.category_id = :category_id";
                    $params[':category_id'] = $resolvedId;
                } else {
                    // if no such category found, return empty result
                    return [
                        'success' => true,
                        'total' => 0,
                        'page' => $page,
                        'per' => $per,
                        'items' => []
                    ];
                }
            }
        }

        $joinText = "";
        if ($q !== '' || $fromYear !== null || $toYear !== null) {
            $joinText = "JOIN text t ON t.source_table = 'generic_element' AND t.source_id = ge.id AND t.content LIKE :q";
            $params[':q'] = '%' . $q . '%';
            
            // Add year field join if year filtering is needed
            if ($fromYear !== null || $toYear !== null) {
                $joinText .= " JOIN text t_year ON t_year.source_table = 'generic_element' AND t_year.source_id = ge.id AND t_year.field_name = 'godina'";
            }
        }

        $total = $this->fetchTotalCount($where, $joinText, $params);
        $ids = $this->fetchContentIds($where, $joinText, $params, $per, $offset, $type);

        if (empty($ids)) {
            return [
                'success' => true,
                'total' => $total,
                'page' => $page,
                'per' => $per,
                'items' => []
            ];
        }

        $texts = $this->fetchTextFields($ids);
        $categories = $this->fetchCategories($ids, $lang);
        $imagesByElement = $this->fetchImages($ids);

        $items = $this->assembleItems($ids, $type, $texts, $categories, $imagesByElement);

        return [
            'success' => true,
            'total' => $total,
            'page' => $page,
            'per' => $per,
            'items' => $items
        ];
    }

    private function fetchCategoryIdByName(string $categoryName): ?int
    {
        // Trim to avoid accidental spaces
        $categoryName = trim($categoryName);

        if ($categoryName === '') {
            return null;
        }

        $sql = "
        SELECT generic_category.id
        FROM generic_category
        JOIN text
            ON text.source_id = generic_category.id
            AND text.source_table = 'generic_category'
            AND text.lang = 'sr'
        WHERE text.content = :categoryName
        LIMIT 1
    ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':categoryName', $categoryName, PDO::PARAM_STR);
        $stmt->execute();

        $id = $stmt->fetchColumn();

        return $id !== false ? (int) $id : null;
    }


    public function fetchItem(int $id, $locale = null): array
    {
        $id = (int) $id;
        if ($id <= 0) {
            return ['success' => false, 'message' => 'Invalid id'];
        }
        error_log("Fetching item with id: $locale");
        $fields = $this->fetchItemFields($id, $locale);
        $meta = $this->fetchItemMeta($id);

        if (!$meta) {
            return ['success' => false, 'message' => 'Item not found'];
        }

        return [
            'success' => true,
            'item' => [
                'id' => $id,
                'category_id' => $meta['category_id'],
                'type' => $meta['type'],
                'fields' => $fields
            ]
        ];
    }

    public function deleteById(int $id): array
    {
        $id = (int) $id;
        if ($id <= 0) {
            return ['success' => false, 'message' => 'Invalid id'];
        }

        try {
            $this->pdo->beginTransaction();
            $this->deleteTextEntries($id);
            $this->deleteContentRecord($id);
            $this->pdo->commit();
            return ['success' => true];
        } catch (Throwable $e) {
            $this->rollbackTransaction();
            throw $e;
        }
    }

    // ============================================================
    // INSERT / UPDATE HELPERS
    // ============================================================

    private function insertContentRecord(string $type): int
    {
        $stmt = $this->pdo->prepare("INSERT INTO generic_element (type) VALUES (:type)");
        $stmt->execute([':type' => $type]);
        return (int) $this->pdo->lastInsertId();
    }

    private function updateContentRecord(int $id, string $type): int
    {
        $stmt = $this->pdo->prepare("UPDATE generic_element SET type = :type WHERE id = :id");
        $stmt->execute([':type' => $type, ':id' => $id]);
        return $id;
    }

    // ============================================================
    // FIELD PROCESSING
    // ============================================================

    private function processFields(int $contentID, array $fields, array $post, array $files, string $locale, bool $isUpdate): void
    {
        foreach ($fields as $fieldDef) {
            $fieldName = $fieldDef['name'] ?? null;
            $fieldType = $fieldDef['type'] ?? 'text';

            if (!$fieldName) {
                continue;
            }

            if ($fieldType === 'categories') {
                $this->processCategoryField($contentID, $post[$fieldName] ?? null);
                continue;
            }

            if (in_array($fieldType, ['file', 'multifile'], true)) {
                $this->processFileField($contentID, $fieldDef, $post, $files, $isUpdate);
                continue;
            }

            $this->processTextField($contentID, $fieldName, $post[$fieldName] ?? '', $locale, $isUpdate, $fieldType);
        }
    }

    private function processTextField(int $contentID, string $fieldName, string $value, string $locale, bool $isUpdate, string $type = ''): void
    {
        error_log("Processing text field: $fieldName with value: $value for locale: $locale");
        if ($fieldName === 'link' || $type == 'email') {
            $variants = [
                'sr' => $value,
                'sr-Cyrl' => $value,
                'en' => $value
            ];
        } else {
            $variants = TextHelper::transliterateVariants($value, $locale);

        }

        if ($isUpdate) {
            TextHelper::updateTextEntries($this->pdo, $contentID, $fieldName, $variants, 'generic_element');
        } else {
            TextHelper::insertTextEntries($this->pdo, $contentID, $fieldName, $variants, 'generic_element');
        }
    }

    private function processCategoryField(int $contentID, $categoryValue): void
    {
        $value = $categoryValue !== null ? (int) $categoryValue : null;
        $stmt = $this->pdo->prepare("UPDATE generic_element SET category_id = :cat WHERE id = :id");
        $stmt->execute([':cat' => $value, ':id' => $contentID]);
    }

    private function processFileField(int $contentID, array $fieldDef, array $post, array $files, bool $isUpdate): void
    {
        $fieldName = $fieldDef['name'];
        $fieldType = $fieldDef['type'];
        $isMultipleField = $fieldType === 'multifile';

        // Handle file removals
        if ($isUpdate) {
            $this->handleFileRemoval($contentID, $post['remove_' . $fieldName] ?? []);
        }

        // Handle new file uploads
        if (isset($files[$fieldName]) && $files[$fieldName]['error'] !== UPLOAD_ERR_NO_FILE) {
            $this->handleFileUpload($contentID, $files[$fieldName], $isMultipleField, $isUpdate);
        }
    }

    // ============================================================
    // FILE HANDLING
    // ============================================================

    private function handleFileRemoval(int $contentID, $removeValues): void
    {
        if (empty($removeValues) || !is_array($removeValues)) {
            return;
        }

        $imageIdCol = Image::primaryKeyName();

        foreach ($removeValues as $filePath) {
            $filePath = trim((string) $filePath);
            if ($filePath === '') {
                continue;
            }

            $imgId = $this->findImageIdByPath($filePath);

            if ($imgId) {
                $this->deleteImageRecord($imgId);
                $this->clearGenericElementImageLink($contentID, $imgId);
            }

            $this->deletePhysicalFile($filePath);
        }
    }

    private function handleFileUpload(int $contentID, array $fileField, bool $isMultiple, bool $isUpdate): void
    {
        if (!is_array($fileField['name'])) {
            return;
        }

        $count = count($fileField['name']);
        for ($k = 0; $k < $count; $k++) {
            if ($fileField['error'][$k] === UPLOAD_ERR_NO_FILE) {
                continue;
            }

            $single = [
                'name' => $fileField['name'][$k],
                'type' => $fileField['type'][$k],
                'tmp_name' => $fileField['tmp_name'][$k],
                'error' => $fileField['error'][$k],
                'size' => $fileField['size'][$k],
            ];

            $uploadedFilename = $this->uploader->upload($single);

            if ($uploadedFilename) {
                $publicPath = '/uploads/' . $uploadedFilename;

                if ($isMultiple) {
                    $this->insertImageRecord($contentID, $publicPath);
                } else {
                    $this->replaceSingleImage($contentID, $publicPath, $isUpdate);
                }
            }
        }
    }

    private function replaceSingleImage(int $contentID, string $publicPath, bool $isUpdate): void
    {
        $newImgId = $this->insertImageRecord($contentID, $publicPath);

        if ($isUpdate && $this->genericHasImageId) {
            $oldImageId = $this->fetchOldImageId($contentID);
            if ($oldImageId) {
                $this->deleteImageRecord($oldImageId);
            }
        }

        if ($this->genericHasImageId) {
            $this->updateGenericElementImageId($contentID, $newImgId);
        }
    }

    // ============================================================
    // IMAGE DATABASE OPERATIONS
    // ============================================================

    private function insertImageRecord(int $contentID, string $publicPath): int
    {
        $imageElementCol = Image::elementColumnName();

        if ($imageElementCol) {
            $stmt = $this->pdo->prepare("INSERT INTO image (file_path, {$imageElementCol}) VALUES (:path, :element)");
            $stmt->execute([':path' => $publicPath, ':element' => $contentID]);
        } else {
            $stmt = $this->pdo->prepare("INSERT INTO image (file_path) VALUES (:path)");
            $stmt->execute([':path' => $publicPath]);
        }

        return (int) $this->pdo->lastInsertId();
    }

    private function findImageIdByPath(string $filePath): ?int
    {
        $imageIdCol = Image::primaryKeyName();
        $stmt = $this->pdo->prepare("SELECT {$imageIdCol} FROM image WHERE file_path = :path LIMIT 1");
        $stmt->execute([':path' => $filePath]);
        $result = $stmt->fetchColumn();
        return $result ? (int) $result : null;
    }

    private function deleteImageRecord(int $imageId): void
    {
        $imageIdCol = Image::primaryKeyName();
        $stmt = $this->pdo->prepare("DELETE FROM image WHERE {$imageIdCol} = :id");
        $stmt->execute([':id' => $imageId]);
    }

    private function clearGenericElementImageLink(int $contentID, int $imageId): void
    {
        if ($this->genericHasImageId) {
            $stmt = $this->pdo->prepare("UPDATE generic_element SET image_id = NULL WHERE id = :id AND image_id = :img");
            $stmt->execute([':id' => $contentID, ':img' => $imageId]);
        }
    }

    private function fetchOldImageId(int $contentID): ?int
    {
        $stmt = $this->pdo->prepare("SELECT image_id FROM generic_element WHERE id = :id");
        $stmt->execute([':id' => $contentID]);
        $result = $stmt->fetchColumn();
        return $result ? (int) $result : null;
    }

    private function updateGenericElementImageId(int $contentID, int $imageId): void
    {
        $stmt = $this->pdo->prepare("UPDATE generic_element SET image_id = :img WHERE id = :id");
        $stmt->execute([':img' => $imageId, ':id' => $contentID]);
    }

    private function deletePhysicalFile(string $relativePath): void
    {
        $fullPath = realpath(__DIR__ . '/../../public') . DIRECTORY_SEPARATOR . ltrim($relativePath, '/');
        if (is_file($fullPath)) {
            @unlink($fullPath);
        }
    }

    // ============================================================
    // FETCH HELPERS
    // ============================================================

    private function fetchTotalCount(string $where, string $joinText, array $params): int
    {
        $sql = "SELECT COUNT(DISTINCT ge.id) FROM generic_element ge {$joinText} WHERE {$where}";
        $stmt = $this->pdo->prepare($sql);

        foreach ($params as $k => $v) {
            $stmt->bindValue($k, $v, $k === ':q' ? PDO::PARAM_STR : (is_int($v) ? PDO::PARAM_INT : PDO::PARAM_STR));
        }

        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    private function fetchContentIds(string $where, string $joinText, array $params, int $limit, int $offset, string $type=''): array
    {
        $sql = "SELECT DISTINCT ge.id FROM generic_element ge {$joinText} WHERE {$where} ORDER BY ge.id DESC LIMIT :lim OFFSET :off";
        $stmt = $this->pdo->prepare($sql);
        
        foreach ($params as $k => $v) {
            $stmt->bindValue($k, $v, $k === ':q' ? PDO::PARAM_STR : (is_int($v) ? PDO::PARAM_INT : PDO::PARAM_STR));
        }

        $stmt->bindValue(':lim', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':off', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
    }

    private function fetchTextFields(array $ids): array
    {
        $in = implode(',', array_fill(0, count($ids), '?'));
        $sql = "SELECT source_id, field_name, lang, content FROM text WHERE source_table = 'generic_element' AND source_id IN ($in)";
        $stmt = $this->pdo->prepare($sql);

        foreach ($ids as $i => $id) {
            $stmt->bindValue($i + 1, (int) $id, PDO::PARAM_INT);
        }

        $stmt->execute();
        $texts = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $sid = (int) $row['source_id'];
            $texts[$sid][$row['field_name']][$row['lang']] = $row['content'];
        }

        return $texts;
    }

    private function fetchCategories(array $ids, string $lang): array
    {
        $in = implode(',', array_fill(0, count($ids), '?'));
        $sql = "
            SELECT
                ge.id AS element_id,
                gc.id AS category_id,
                gc.type AS category_type,
                COALESCE(txt.content, txt_fallback.content) AS category_content
            FROM generic_element ge
            LEFT JOIN generic_category gc ON ge.category_id = gc.id
            LEFT JOIN text txt ON txt.source_table = 'generic_category' AND txt.source_id = gc.id AND txt.lang = ?
            LEFT JOIN text txt_fallback ON txt_fallback.source_table = 'generic_category' AND txt_fallback.source_id = gc.id AND txt_fallback.lang = 'sr-Cyrl'
            WHERE ge.id IN ($in)
        ";

        $stmt = $this->pdo->prepare($sql);
        error_log(
            "vesti:" . $lang
        );
        $stmt->bindValue(1, $lang, PDO::PARAM_STR);

        $pos = 2;
        foreach ($ids as $id) {
            $stmt->bindValue($pos++, (int) $id, PDO::PARAM_INT);
        }

        $stmt->execute();
        $categories = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $categories[(int) $row['element_id']] = [
                'id' => $row['category_id'] ? (int) $row['category_id'] : null,
                'type' => $row['category_type'] ?? null,
                'content' => $row['category_content'] ?? null
            ];
        }

        return $categories;
    }

    private function fetchImages(array $ids): array
    {
        $elemCol = Image::elementColumnName();
        $imgPk = Image::primaryKeyName();

        if ($elemCol) {
            return $this->fetchImagesByElementColumn($ids, $elemCol, $imgPk);
        }

        if ($this->genericHasImageId) {
            return $this->fetchImagesByGenericElementLink($ids, $imgPk);
        }

        return [];
    }

    private function fetchImagesByElementColumn(array $ids, string $elemCol, string $imgPk): array
    {
        $in = implode(',', array_fill(0, count($ids), '?'));
        $sql = "SELECT file_path, {$elemCol} AS element FROM image WHERE {$elemCol} IN ($in) ORDER BY {$imgPk} ASC";
        $stmt = $this->pdo->prepare($sql);

        foreach ($ids as $i => $id) {
            $stmt->bindValue($i + 1, (int) $id, PDO::PARAM_INT);
        }

        $stmt->execute();
        $images = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $images[(int) $row['element']][] = $row['file_path'];
        }

        return $images;
    }

    private function fetchImagesByGenericElementLink(array $ids, string $imgPk): array
    {
        $in = implode(',', array_fill(0, count($ids), '?'));
        $sql = "SELECT id, image_id FROM generic_element WHERE id IN ($in)";
        $stmt = $this->pdo->prepare($sql);

        foreach ($ids as $i => $id) {
            $stmt->bindValue($i + 1, (int) $id, PDO::PARAM_INT);
        }

        $stmt->execute();
        $imageIds = [];
        $geToImg = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $gid = (int) $row['id'];
            $iid = $row['image_id'] ? (int) $row['image_id'] : null;

            if ($iid) {
                $imageIds[] = $iid;
                $geToImg[$gid] = $iid;
            }
        }

        if (empty($imageIds)) {
            return [];
        }

        return $this->mapImageIdsToElements($imageIds, $geToImg, $imgPk);
    }

    private function mapImageIdsToElements(array $imageIds, array $geToImg, string $imgPk): array
    {
        $in = implode(',', array_fill(0, count($imageIds), '?'));
        $sql = "SELECT {$imgPk} AS imgid, file_path FROM image WHERE {$imgPk} IN ($in)";
        $stmt = $this->pdo->prepare($sql);

        foreach ($imageIds as $i => $iid) {
            $stmt->bindValue($i + 1, (int) $iid, PDO::PARAM_INT);
        }

        $stmt->execute();
        $imgById = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $imgById[(int) $row['imgid']] = $row['file_path'];
        }

        $result = [];
        foreach ($geToImg as $ge => $imgid) {
            if (isset($imgById[$imgid])) {
                $result[$ge][] = $imgById[$imgid];
            }
        }

        return $result;
    }

    private function assembleItems(array $ids, string $type, array $texts, array $categories, array $imagesByElement): array
    {
        $items = [];

        foreach ($ids as $id) {
            $id = (int) $id;
            $imgs = $imagesByElement[$id] ?? [];

            $items[] = [
                'id' => $id,
                'type' => $type,
                'fields' => $texts[$id] ?? [],
                'images' => array_values($imgs),
                'image' => $imgs[0] ?? null,
                'category' => $categories[$id] ?? null,
            ];
        }

        return $items;
    }

    private function fetchItemFields(int $id, $lang = null): array
    {
        $sql = "SELECT field_name, lang, content
            FROM text
            WHERE source_table = 'generic_element' AND source_id = ?";

        // If a specific language is provided, add it to the WHERE clause
        if ($lang !== null) {
            $sql .= " AND lang = ?";
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);

        if ($lang !== null) {
            $stmt->bindValue(2, $lang, PDO::PARAM_STR);
        }

        $stmt->execute();

        $fields = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            error_log("Fetched field: " . $row['field_name'] . " lang: " . $row['lang']);
            $fields[$row['field_name']][$row['lang']] = $row['content'];
        }

        return $fields;
    }


    private function fetchItemMeta(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT category_id, type FROM generic_element WHERE id = ?");
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    // ============================================================
    // DELETE HELPERS
    // ============================================================

    private function deleteTextEntries(int $id): void
    {
        $stmt = $this->pdo->prepare("DELETE FROM text WHERE source_table = 'generic_element' AND source_id = :id");
        $stmt->execute([':id' => $id]);
    }

    private function deleteContentRecord(int $id): void
    {
        $stmt = $this->pdo->prepare("DELETE FROM generic_element WHERE id = :id");
        $stmt->execute([':id' => $id]);
    }

    // ============================================================
    // UTILITIES
    // ============================================================

    private function checkGenericHasImageId(): bool
    {
        try {
            $stmt = $this->pdo->query("SHOW COLUMNS FROM generic_element LIKE 'image_id'");
            return $stmt && $stmt->rowCount() > 0;
        } catch (Throwable $_) {
            return false;
        }
    }

    private function rollbackTransaction(): void
    {
        try {
            $this->pdo->rollBack();
        } catch (Throwable $_) {
        }
    }
}