<?php
namespace App\Models;

use App\Database;
use App\Utils\LocaleManager;
use PDO;

class CustomField
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
     * Fetch all custom fields
     */
    public static function fetchAllByContentTypeCode(string $code, bool $decode = false): array
    {
        $pdo = self::pdo();
        try {
            $stmt = $pdo->prepare("SELECT * FROM custom_field WHERE content_type_code = :code ORDER BY ordno");
            $stmt->execute([':code' => $code]);
            $customFields = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($decode && !empty($customFields)) {
                $customFields = LocaleManager::decodeTranslations($customFields);
            }

            return $customFields;
        } catch (\Throwable $e) {
            return [];
        }

        return [];
    }


    /**
     * Fetch single custom field by code and content type code
     */
    public static function fetchByCode(string $ctCode, string $code): ?array
    {
        try {
            $pdo = self::pdo();
            $stmt = $pdo->prepare("SELECT * FROM custom_field WHERE `content_type_code` = :ctcode AND `code` = :code ORDER BY type desc");
            $stmt->execute([
                ':ctcode' => $ctCode,
                ':code' => $code,
            ]);
            $r = $stmt->fetch(PDO::FETCH_ASSOC);

            return $r ?? null;
        } catch (\Throwable $_) {
            return null;
        }
    }

    /**
     * Isolate main category custom field from all the others
     */
    public static function isolateMainCategory(array $customFields): ?array
    {
        $mainCategoryCF = array_filter($customFields, fn($item) => $item['code'] == 'main_category');
        if (count($mainCategoryCF) == 1)  {
            return reset($mainCategoryCF);
        }

        return [];
    }

    public function create(string $ctCode, array $field, int $ordno): void
    {
        if (empty($field['name'])) {
            throw new \Exception('Custom Field bez code-a!!');
        }

        $stmt = $this->pdo->prepare("INSERT INTO custom_field
            (`content_type_code`, `code`, `type`, `ordno`, `input_type`,
            `placeholder`,`required`, `name`, `translations`)
            values (:ctcode, :code, :type, :ordno, :inputType,
            :placeholder, :required, :name, :translations)
        ");

        $code = $field['name'];
        $type = self::decideCFType($field['type']);
        $inputType = $field['type'] ?? 'text';
        $placeholder = !empty($field['placeholder']) ? [
            'sr' => $field['placeholder']['sr'] ?? '',
            'sr-Cyrl' => $field['placeholder']['sr-Cyrl'] ?? '',
            'en' => $field['placeholder']['en'] ?? '',
        ] : [];
        $required = array_key_exists('required', $field) ? filter_var($field['required'], FILTER_VALIDATE_BOOLEAN) : false;
        $name = $field['label']['sr'] ?? '';
        $translations = [
            'sr' => $field['label']['sr'] ?? '',
            'sr-Cyrl' => $field['label']['sr-Cyrl'] ?? '',
            'en' => $field['label']['en'] ?? '',
        ];

        /*
            `content` varchar(5000) DEFAULT NULL,
            `yesno` int DEFAULT NULL,
            `date` datetime DEFAULT NULL,
            `created_at` datetime DEFAULT CURRENT_TIMESTAMP,

            */
        $stmt->bindValue(':ctcode', $ctCode);
        $stmt->bindValue(':code', $code);
        $stmt->bindValue(':type', $type);
        $stmt->bindValue(':ordno', $ordno);
        $stmt->bindValue(':inputType', $inputType);
        $stmt->bindValue(':placeholder', json_encode($placeholder));
        $stmt->bindValue(':required', (int) $required);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':translations', json_encode($translations));
        $stmt->execute();
    }

    public function update(string $ctCode, array $field, int $ordno): void
    {
        if (empty($field['name'])) {
            throw new \Exception('Custom field bez code-a!!');
        }

        $stmt = $this->pdo->prepare("UPDATE custom_field
            SET `name` = :name, `type` = :type, `ordno` = :ordno, `translations` = :translations,
            `input_type` = :inputType, `placeholder` = :placeholder, `required` = :required
            WHERE `content_type_code` = :ctcode AND `code` = :code
        ");

        $code = $field['name'];
        $type = self::decideCFType($field['type']);
        $inputType = $field['type'] ?? 'text';
        $placeholder = !empty($field['placeholder']) ? [
            'sr' => $field['placeholder']['sr'] ?? '',
            'sr-Cyrl' => $field['placeholder']['sr-Cyrl'] ?? '',
            'en' => $field['placeholder']['en'] ?? '',
        ] : [];
        $required = array_key_exists('required', $field) ? filter_var($field['required'], FILTER_VALIDATE_BOOLEAN) : false;
        $name = $field['label']['sr'] ?? '';
        $translations = [
            'sr' => $field['label']['sr'] ?? '',
            'sr-Cyrl' => $field['label']['sr-Cyrl'] ?? '',
            'en' => $field['label']['en'] ?? '',
        ];

        $stmt->bindValue(':ctcode', $ctCode);
        $stmt->bindValue(':code', $code);
        $stmt->bindValue(':type', $type);
        $stmt->bindValue(':ordno', $ordno);
        $stmt->bindValue(':inputType', $inputType);
        $stmt->bindValue(':placeholder', json_encode($placeholder));
        $stmt->bindValue(':required', (int) $required);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':translations', json_encode($translations));
        $stmt->execute();
    }

    public function deleteByCode(string $ctCode, string $code): void
    {
        $stmt = $this->pdo->prepare("DELETE FROM custom_field cf WHERE cf.content_type_code = :ctcode AND cf.code = :code");
        $stmt->execute([
            ':ctcode' => $ctCode,
            ':code' => $code,
        ]);
    }

    public static function decideColumnBasedOnCFtype(string $cfType): ?string
    {
        if (empty($cfType)) {
            return null;
        }

        switch ($cfType) {
            case 'text':
            case 'textarea':
            case 'url':
            case 'email':
            case 'time':
                return 'content';
                break;
            case 'date':
                return 'date';
                break;
            case 'options':
            case 'categories':
                return 'option';
                break;
            case 'boolean':
                return 'yesno';
                break;
            case 'file':
                return 'ordno';
                break;
            default:
                throw new \Exception ("ColumnSelector: nepoznat Custom Field type!");
        }
    }

    private function decideCFType(string $inputType): string
    {
        if (empty($inputType)) {
            return 'text';
        }

        switch ($inputType) {
            case 'text':
            case 'textarea':
                return 'text';
                break;
            case 'url':
                return 'url';
                break;
            case 'email':
                return 'email';
                break;
            case 'date':
                return 'date';
                break;
            case 'categories':
                return 'options';
                break;
            case 'boolean':
                return 'boolean';
                break;
            case 'time':
                return 'time';
                break;
            case 'file':
                return 'file';
                break;
            default:
                throw new \Exception ("Nepoznat Custom Field type!");
        }
    }
}
