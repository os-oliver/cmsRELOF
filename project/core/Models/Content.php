<?php
namespace App\Models;

use App\Database;
use App\Utils\Config;
use App\Utils\Pivoter;
use App\Utils\TextHelper;
use App\Utils\FileUploader;
use DateTime;
use Exception;
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

    public static function fetchById(int $id)
    {
        $content = new self;
        try {
            $stmt = $content->pdo->prepare("SELECT * FROM content WHERE id = :id");
            $stmt->execute([':id' => $id]);
            $content = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $content[0];
        } catch (\Throwable $e) {
            return [];
        }

        return [];
    }

    // ============================================================
    // PUBLIC API
    // ============================================================

    public function saveContentOld(array $post, array $files = [], string $locale = 'sr-Cyrl', bool $debug = false): array
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
                ? $this->updateContentRecordOld((int) $post['id'], $type)
                : $this->insertContentRecordOld($type);

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

    public function saveContent(array $post, array $files = [], string $locale = 'sr-Cyrl', bool $debug = false): array
    {
        if (empty($post['type'])) {
            throw new InvalidArgumentException('Missing type in data');
        }

        $type = $post['type'];
        $isUpdate = isset($post['id']) && ((int) $post['id'] > 0);
        if ($isUpdate) {
            $existing = Content::fetchById($post['id']);
            if (empty($existing)) {
                $isUpdate = false;
            }
        }

        if (!Config::hasType($type)) {
            throw new RuntimeException("No config found for type: {$type}");
        }

        $this->pdo->beginTransaction();
        try {
            $contentId = $isUpdate
                ? $this->updateContentRecord((int) $post['id'], $type)
                : $this->insertContentRecord($type);

            $this->processFields($contentId, $type, $post, $files, $locale, $isUpdate);

            $this->pdo->commit();

            return [
                'success' => true,
                'id' => $contentId,
                'message' => $isUpdate ? 'Updated' : 'Created',
            ];
        } catch (Throwable $e) {
            $this->rollbackTransaction();
            throw $e;
        }
    }

    public function fetchListDataOld(
        string $type,
        string $q = '',
        int $page = 1,
        int $per = 10,
        int|string|null $categoryId = null, // ✅ can be id or name
        string $lang = 'sr'
    ): array {
        $q = trim((string) $q);
        $page = max(1, $page);
        $per = max(1, min(100, $per));
        $offset = ($page - 1) * $per;

        $where = "ge.type = :type";
        $params = [':type' => $type];

        error_log(json_encode($categoryId));
        // ✅ Handle both int and string category
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
        if ($q !== '') {
            $joinText = "JOIN text t ON t.source_table = 'generic_element' AND t.source_id = ge.id AND t.content LIKE :q";
            $params[':q'] = '%' . $q . '%';
        }

        $total = $this->fetchTotalCount($where, $joinText, $params);
        $ids = $this->fetchContentIds($where, $joinText, $params, $per, $offset);

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

    public function fetchListData(
        string $type,
        string $q = '',
        int $page = 1,
        int $per = 10,
        int|string|null $categoryId = null, // ✅ can be id or name
        string $lang = 'sr',
        string $orderingFieldCode = 'title',
        string $sortingDirection = 'DESC'
    ): array {
        $q = trim((string) $q);
        $page = max(1, $page);
        $per = max(1, min(100, $per));
        $offset = ($page - 1) * $per;

        $where = "c.content_type_code = :type";
        $params = [':type' => $type];
        $whereForCFV = $where; // we don't need to filter by option here

        if ($categoryId !== null) {

            if (is_numeric($categoryId)) {
                // if it's an integer, use directly
                $where .= " AND cfv.option = :category_id";
                $params[':category_id'] = (int) $categoryId;
            } else {
                // if it's a string, resolve it to numeric id first
                $resolvedId = ContentType::fetchCategoryByContentTypeCodeAndCode($type, $categoryId);
                if ($resolvedId !== null) {
                    $where .= " AND cfv.option = :category_id";
                    $params[':category_id'] = $resolvedId['id'];
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

        $joinText = "INNER JOIN custom_field_value cfv ON cfv.content_id = c.id";
        if ($q !== '') {
            $joinText = " AND cfv.content LIKE :q";
            $params[':q'] = '%' . $q . '%';
        }

        $customField = CustomField::fetchByCode($type, $orderingFieldCode);
        $orderingColumn = CustomField::decideColumnBasedOnCFtype($customField['type'] ?? '');

        $total = $this->fetchTotalCountNew($where, $joinText, $params);
        $contentIds = $this->fetchContentIdsNew($where, $joinText, $params, $per, $offset, $orderingColumn, $sortingDirection);
        $cfvs = $this->fetchContentCFVsNew($contentIds, $whereForCFV, $joinText, $params, $lang);

        if (empty($cfvs)) {
            return [
                'success' => true,
                'total' => $total,
                'page' => $page,
                'per' => $per,
                'items' => []
            ];
        }

        $customFields = CustomField::fetchAllByContentTypeCode($type, true);
        $allOptions = CustomFieldOption::fetchAllByContentTypeCode($type, true);

        $items = $this->assembleItemsNew($cfvs, $type, $customFields, $allOptions, $lang);

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


    public function fetchItemNew(int $id, $locale = null): array
    {
        $id = (int) $id;
        if ($id <= 0) {
            return ['success' => false, 'message' => 'Invalid id'];
        }
        error_log("Fetching item with id: $id");
        $content = Content::fetchById($id);
        $contentTypeCode = $content['content_type_code'];
        $cfvs = CustomFieldValue::fetchAllByContentId($id, $locale);
        $customFields = CustomField::fetchAllByContentTypeCode($contentTypeCode, true);
        $allOptions = CustomFieldOption::fetchAllByContentTypeCode($contentTypeCode, true);

        $mainCategoryCF = CustomField::isolateMainCategory($customFields);
        $mainCategoryOptions = ContentType::fetchMainCategoriesByContentTypeCode($contentTypeCode, true);

        if ($mainCategoryCF) {
            foreach ($cfvs as $cfv) {
                if ($cfv['custom_field_id'] == $mainCategoryCF['id']) {
                    $mainCategoryTextValue = $this->getTextValue($cfv, 'options', $mainCategoryOptions, $locale);
                }
            }
        }        

        $items = $this->assembleItemsNew($cfvs, $contentTypeCode, $customFields, $allOptions, $locale);
        $item = reset($items);

        return [
            'success' => true,
            'item' => [
                'id' => $id,
                'category_id' => $mainCategoryCF['code'] ?? null, // mozda option?
                'category_code' => $mainCategoryCF['code'] ?? '',
                'type' => $mainCategoryTextValue ?? 'Nepoznat tip sadržaja!',
                'fields' => $item
            ]
        ];
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

    public static function addImagesToContent(int $contentId, array $imageField, array $images): void
    {
        if (empty($images)) {
            return;
        }

        foreach ($images as $key => $imagePath) {
            (new Content())->insertImageCFV($contentId, $imageField['id'], $imagePath, ($key + 1));
        }
    }

    // ============================================================
    // INSERT / UPDATE HELPERS
    // ============================================================

    private function insertContentRecord(string $type): int
    {
        $stmt = $this->pdo->prepare("SELECT * FROM content WHERE content_type_code = :type ORDER BY ordno DESC LIMIT 1");
        $stmt->execute([':type' => $type]);

        $result = $stmt->fetchColumn();
        if ($result === false) {
            $ordno = 1;
        } else {
            $ordno = (int) $result + 1;
        }

        $stmt = $this->pdo->prepare("INSERT INTO content (content_type_code, ordno) VALUES (:type, :ordno)");
        $stmt->execute([':type' => $type, ':ordno' => $ordno]);
        return (int) $this->pdo->lastInsertId();
    }

    private function updateContentRecord(int $id, string $type): int
    {
        return $id;
    }

    private function insertContentRecordOld(string $type): int
    {
        $stmt = $this->pdo->prepare("INSERT INTO generic_element (type) VALUES (:type)");
        $stmt->execute([':type' => $type]);
        return (int) $this->pdo->lastInsertId();
    }

    private function updateContentRecordOld(int $id, string $type): int
    {
        $stmt = $this->pdo->prepare("UPDATE generic_element SET type = :type WHERE id = :id");
        $stmt->execute([':type' => $type, ':id' => $id]);
        return $id;
    }

    // ============================================================
    // FIELD PROCESSING
    // ============================================================

    private function processFields(int $contentId, string $contentCode, array $post, array $files, string $locale, bool $isUpdate): void
    {
        $customFields = CustomField::fetchAllByContentTypeCode($contentCode);
        $customFieldValues = CustomFieldValue::fetchAllByContentId($contentId);

        foreach ($customFields as $customField) {
            $fieldCode = $customField['code'] ?? null;
            $fieldType = $customField['type'] ?? 'text';

            $cfValueVariants = [];
            foreach ($customFieldValues as $existingCFV) {
                if ($existingCFV['custom_field_id'] == $customField['id']) {
                    $cfValueVariants[] = $existingCFV;
                }
            }

            if ($fieldType === 'options') {
                $this->processCategoryField($contentId, $customField, $cfValueVariants, $post[$fieldCode] ?? null);
                continue;
            }

            if ($fieldType === 'time') {
                $this->processTimeField($contentId, $customField, $cfValueVariants, $post[$fieldCode] ?? null);
                continue;
            }

            if ($fieldType === 'date') {
                $this->processDateField($contentId, $customField, $cfValueVariants, $post[$fieldCode] ?? null, 'Y-m-d');
                continue;
            }

            if (in_array($fieldType, ['file', 'multifile'], true)) {
                $this->processFileField($contentId, $customField, $cfValueVariants, $post, $files, $isUpdate);
                continue;
            }

            if ($fieldType === 'text' || $fieldType === 'textarea') {
                $this->processTextField($contentId, $customField, $cfValueVariants, $post[$fieldCode] ?? '', $locale);
                continue;
            }
        }
    }

    private function processCategoryField(int $contentId, array $customField, array | null $cfValueVariants, string $categoryCode, ): void
    {
        $category = ContentType::fetchCategoryByContentTypeCodeAndCode($customField['content_type_code'], $categoryCode, true);
        if (empty($category)) {
            throw new Exception('Invalid category chosen!');
            return;
        }

        if (empty($cfValueVariants)) {
            $stmt = $this->pdo->prepare("INSERT INTO custom_field_value (content_id, custom_field_id, `option`) VALUES (:content_id, :custom_field_id, :option)");
            $stmt->execute([
                ':content_id' => $contentId,
                ':custom_field_id' => $customField['id'],
                ':option' => $category['id']
            ]);
        } else {
            $stmt = $this->pdo->prepare("UPDATE custom_field_value SET `option` = :optionId WHERE id = :id");
            foreach ($cfValueVariants as $cfValue) {
                $stmt->execute([
                    ':id' => $cfValue['id'],
                    ':optionId' => $category['id']
                ]);
            }
        }
    }

    private function processTimeField(int $contentId, array $customField, array | null $cfValueVariants, string $timeValue): void
    {
        if (empty($cfValueVariants)) {
            $stmt = $this->pdo->prepare("INSERT INTO custom_field_value (content_id, custom_field_id, content) VALUES (:content_id, :custom_field_id, :timeValue)");
            $stmt->execute([
                ':content_id' => $contentId,
                ':custom_field_id' => $customField['id'],
                ':timeValue' => $timeValue
            ]);
        } else {
            $stmt = $this->pdo->prepare("UPDATE custom_field_value SET content = :timeValue WHERE id = :id");
            // there should always be only one element in this array, otherwise there was some error in the database
            foreach ($cfValueVariants as $cfValue) {
                $stmt->execute([
                    ':id' => $cfValue['id'],
                    ':timeValue' => $timeValue,
                ]);
            }
        }
    }

    private function processDateField(int $contentId, array $customField, array | null $cfValueVariants, string $dateString, string $format = ''): void
    {
        try {
            if (empty($format)) {
                $date = new \DateTime($dateString);
            } else {
                $date = \DateTime::createFromFormat($format, $dateString);
            }

            if (!$date) {
                throw new \Exception("Invalid date string or format: '$dateString'");
            }
        } catch (\Throwable $e) {
            $date = null;
        }

        if ($date) {
            $date = $date->format('Y-m-d');
        }

        if (empty($cfValueVariants)) {
            $stmt = $this->pdo->prepare("INSERT INTO custom_field_value (content_id, custom_field_id, date) VALUES (:content_id, :custom_field_id, :dateValue)");
            $stmt->execute([
                ':content_id' => $contentId,
                ':custom_field_id' => $customField['id'],
                ':dateValue' => $date
            ]);
        } else {
            $stmt = $this->pdo->prepare("UPDATE custom_field_value SET date = :dateValue WHERE id = :id");
            // there should always be only one element in this array, otherwise there was some error in the database
            foreach ($cfValueVariants as $cfValue) {
                $stmt->execute([
                    ':id' => $cfValue['id'],
                    ':dateValue' => $date,
                ]);
            }
        }
    }

    private function processTextField(int $contentId, array $customField, array | null $cfValueVariants, string $value, string $locale): void
    {
        // error_log("Processing text field: $fieldName with value: $value for locale: $locale");
        $nonTranslatableTypes = ['url', 'email'];
        if (in_array($customField['type'], $nonTranslatableTypes)) {
            $variants = [
                'sr' => $value,
                'sr-Cyrl' => $value,
                'en' => $value
            ];
        } else {
            $variants = TextHelper::transliterateVariants($value, $locale);
            $variants['en'] = $variants['sr'];
        }

        if (empty($cfValueVariants)) {
            $stmt = $this->pdo->prepare("INSERT INTO custom_field_value (content_id, custom_field_id, language, content) VALUES (:content_id, :custom_field_id, :language, :content)");
            foreach ($variants as $lang => $value) {
                $stmt->execute([
                    ':content_id' => $contentId,
                    ':custom_field_id' => $customField['id'],
                    ':language' => $lang,
                    ':content' => $value,
                ]);
            }
        } else {
            $stmt = $this->pdo->prepare("UPDATE custom_field_value SET content = :content WHERE id = :id");
            foreach ($cfValueVariants as $cfValue) {
                if (array_key_exists($cfValue['language'], $variants)) {
                    $stmt->execute([
                        ':id' => $cfValue['id'],
                        ':content' => $variants[$cfValue['language']],
                    ]);
                }
            }
        }
    }

    private function processFileField(int $contentId, array $customField, array | null $cfValueVariants, array $post, array $files, bool $isUpdate): void
    {
        $fieldCode = $customField['code'];
        $fieldType = $customField['type'];
        $isMultipleField = $fieldType === 'multifile';

        // Handle file removals
        if ($isUpdate) {
            $this->handleFileRemoval($contentId, $post['remove_' . $fieldCode] ?? []);
        }

        // Handle new file uploads
        if (isset($files[$fieldCode]) && $files[$fieldCode]['error'] !== UPLOAD_ERR_NO_FILE) {
            $this->handleFileUpload($contentId, $files[$fieldCode], $customField, $cfValueVariants, $isMultipleField, $isUpdate);
        }
    }

    // ============================================================
    // FILE HANDLING
    // ============================================================

    private function handleFileRemoval(int $contentId, $removeValues): void
    {
        if (empty($removeValues) || !is_array($removeValues)) {
            return;
        }

        foreach ($removeValues as $filePath) {
            $filePath = trim((string) $filePath);
            if ($filePath === '') {
                continue;
            }

            $cfvId = CustomFieldValue::findImageCFVByContentIdAndPath($contentId, $filePath);

            if ($cfvId) {
                CustomFieldValue::deleteCFV($cfvId);
            }

            $this->deletePhysicalFile($filePath);
        }
    }

    private function handleFileUpload(int $contentId, array $fileField, array $customField, array $existingCFV, bool $isMultiple, bool $isUpdate): void
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

                if (!$isMultiple && count($existingCFV) > 0) {
                    $this->deletePhysicalFile($existingCFV[0]['filepath']);
                    $this->updateImageCFV($existingCFV[0], $publicPath);
                } else {
                    self::insertImageCFV($contentId, $customField['id'], $publicPath, ($k + 1));
                }


                // if ($isMultiple) {
                // } else {
                //     $this->replaceSingleImage($contentId, $publicPath, $isUpdate);
                // }
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

    private function insertImageCFV(int $contentId, int $customFieldId, string $publicPath, int $ordno): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO custom_field_value (content_id, custom_field_id, filepath, ordno) VALUES (:content_id, :custom_field_id, :filepath, :ordno)");
        $stmt->execute([
            ':content_id' => $contentId,
            ':custom_field_id' => $customFieldId,
            ':filepath' => $publicPath,
            ':ordno' => $ordno,
        ]);
    }

    private function updateImageCFV(array $customFieldValue, string $publicPath): void
    {
        $stmt = $this->pdo->prepare("UPDATE custom_field_value SET filepath = :new_path WHERE id = :id");
        $stmt->execute([
            ':id' => $customFieldValue['id'],
            ':new_path' => $publicPath,
        ]);
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

    private function fetchTotalCountNew(string $where, string $joinText, array $params): int
    {
        $sql = "SELECT COUNT(DISTINCT c.id) FROM content c {$joinText} WHERE {$where}";
        $stmt = $this->pdo->prepare($sql);

        foreach ($params as $k => $v) {
            $stmt->bindValue($k, $v, $k === ':q' ? PDO::PARAM_STR : (is_int($v) ? PDO::PARAM_INT : PDO::PARAM_STR));
        }

        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    private function fetchContentIdsNew(string $where, string $joinText, array $params, int $limit, int $offset, string $orderColumn, string $direction = 'DESC'): array
    {
        $fullOrdering = 'c.id ' . $direction;
        $grouping = 'cfv.content_id';

        if (!empty($orderColumn)) {
            $fullOrdering = 'cfv.' . $orderColumn . ' ' . $direction;
            $grouping = 'cfv.' . $orderColumn;
        }

        $sql = "SELECT c.id, {$grouping} FROM content c {$joinText} WHERE {$where} GROUP BY c.id, {$grouping} ORDER BY {$fullOrdering} LIMIT :lim OFFSET :off";

        $stmt = $this->pdo->prepare($sql);

        foreach ($params as $k => $v) {
            $stmt->bindValue($k, $v, $k === ':q' ? PDO::PARAM_STR : (is_int($v) ? PDO::PARAM_INT : PDO::PARAM_STR));
        }

        $stmt->bindValue(':lim', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':off', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    private function fetchContentCFVsNew(array $contentIds, string $where, string $joinText, array $params, string $locale): array
    {
        if (count($contentIds) <= 0) {
            return [];
        }

        $ids = [];
        for ($i = 0; $i < count($contentIds); $i++) {
            $ids[] = ':id_' . $i;
        }

        $sql = "SELECT cfv.* FROM content c {$joinText} WHERE {$where}
            AND (cfv.language = :lang OR cfv.language IS NULL) AND c.id IN (".join(',', $ids).") ORDER BY FIELD(c.id, ".join(',', $ids).")";
        $stmt = $this->pdo->prepare($sql);

        foreach ($params as $k => $v) {
            $stmt->bindValue($k, $v, $k === ':q' ? PDO::PARAM_STR : (is_int($v) ? PDO::PARAM_INT : PDO::PARAM_STR));
        }

        foreach ($ids as $index => $id) {
            $stmt->bindValue($id, $contentIds[$index], PDO::PARAM_INT);
        }

        $stmt->bindValue(':lang', $locale, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

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

    private function fetchContentIds(string $where, string $joinText, array $params, int $limit, int $offset): array
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

    private function fetchCategoriesNew(string $type): array
    {
        $sql = "SELECT * FROM custom_field_option WHERE content_type_code = :ctcode";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['ctcode' => $type]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
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

    private function assembleItemsNew(array $cfvs, string $type, array $customFields, array $options, string $lang): array
    {
        $customFields = $this->remapById($customFields);
        $items = [];

        foreach ($cfvs as $cfv) {
            $cfType = $customFields[$cfv['custom_field_id']]['type'];
            $cfLabel = $customFields[$cfv['custom_field_id']]['translations'][$lang] ?? 'nepoznat naziv';

            $item = [
                'content_id' => $cfv['content_id'],
                'id' => $cfv['id'],
                'code' => $customFields[$cfv['custom_field_id']]['code'],
                'label' => $cfLabel,
                'textValue' => $this->getTextValue($cfv, $cfType, $options, $lang),
            ];

            // dodatni atributi za neke specijalne slucajeve
            if ($cfType == 'options') {
                $options = $this->remapById($options);
                $option = $options[$cfv['option']]['option_value'] ?? '';

                $item['option_value'] = $option;
            }

            if ($cfType == 'date') {
                if (!empty($cfv['date'])) {
                    $item['timestamp'] = date_timestamp_get(new \DateTime($cfv['date']));
                }
            }

            if ($cfType == 'file') {
                if (!empty($cfv['filepath'])) {
                    $item['imageUrl'] = $cfv['filepath'];
                }
            }

            $items[] = $item;
        }

        $itemsGroupedByContentId = [];
        foreach ($items as $item) {
            $itemsGroupedByContentId[$item['content_id']][] = $item;
        }

        return $itemsGroupedByContentId;
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

    private function remapById(array $items)
    {
        return array_column($items, null, 'id');
    }

    private function getTextValue(array $cfv, string $cfvType, array $options, string $lang)
    {
        $options = $this->remapById($options);

        switch ($cfvType) {
            case 'text':
            case 'time':
            case 'url':
            case 'email':
                return $cfv['content'];
            case 'date':
                if (!empty($cfv['date'])) {
                    return date_format(new DateTime($cfv['date']), 'd/m/Y');
                } else {
                    return '';
                }
            case 'yesno':
                return (bool) $cfv['yesno'];
            case 'options':
                $option = $options[$cfv['option']] ?? '';
                if (empty($option)) {
                    return 'nepoznata opcija';
                }
                return $option['translations'][$lang] ?? 'nepoznat jezik';
            case 'file':
                return $cfv['filepath'];
            default:
                return $cfv['content'];
        }
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