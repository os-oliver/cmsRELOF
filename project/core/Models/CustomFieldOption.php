<?php
namespace App\Models;

use App\Database;
use PDO;
use App\Controllers\LanguageMapperController;

class CustomFieldOption
{
    private PDO $pdo;
    private LanguageMapperController $mapper;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->GetPDO();
        $this->mapper = new LanguageMapperController();
    }

    private static function pdo(): PDO
    {
        return (new Database())->GetPDO();
    }

    /**
     * Fetch all custom field options
     */
    public static function fetchAllByCustomFieldId(int $id): array
    {
        $pdo = self::pdo();
        try {
            $stmt = $pdo->prepare("SELECT * FROM custom_field_option WHERE custom_field_id = :id");
            $stmt->execute([':id' => $id]);
            $options = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $options;
        } catch (\Throwable $e) {
            return [];
        }

        return [];
    }


    /**
     * Fetch single custom field option by custom field id and option value (code)
     */
    public static function fetchByOptionValue(int $cfId, string $optionValue): ?array
    {
        try {
            $pdo = self::pdo();
            $stmt = $pdo->prepare("SELECT * FROM custom_field_option WHERE `custom_field_id` = :id AND `option_value` = :optionValue");
            $stmt->execute([
                ':id' => $cfId,
                ':optionValue' => $optionValue,
            ]);
            $r = $stmt->fetch(PDO::FETCH_ASSOC);

            return $r ?? null;
        } catch (\Throwable $_) {
            return null;
        }
    }

    public function create(int $cfId, array $codedOption, int $ordno): void
    {
        if (empty($codedOption['code'])) {
            throw new \Exception('Custom Field Option bez vrednosti (code-a)!');
        }

        $stmt = $this->pdo->prepare("INSERT INTO custom_field_option
            (`custom_field_id`, `translations`, `option_value`, `ordno`)
            values (:cfid, :translations, :optionValue, :ordno)
        ");

        $optionValue = $codedOption['code'];
        $translations = $codedOption['translations'] ?? [
            'sr' => $codedOption['code'],
            'sr-Cyrl' => $this->mapper->latin_to_cyrillic($codedOption['code']),
            'en' => $codedOption['code'],
        ];

        $stmt->bindValue(':cfid', $cfId);
        $stmt->bindValue(':optionValue', $optionValue);
        $stmt->bindValue(':translations', json_encode($translations));
        $stmt->bindValue(':ordno', $ordno);
        $stmt->execute();
    }

    public function update(int $cfId, array $codedOption, int $ordno): void
    {
        if (empty($codedOption['code'])) {
            throw new \Exception('Custom Field Option bez vrednosti (code-a)!');
        }

        $stmt = $this->pdo->prepare("UPDATE custom_field_option
            SET `translations` = :translations, `ordno` = :ordno
            WHERE `custom_field_id` = :cfid AND `option_value` = :optionValue
        ");

        $optionValue = $codedOption['code'];
        $translations = $codedOption['translations'] ?? [
            'sr' => $codedOption['code'],
            'sr-Cyrl' => $this->mapper->latin_to_cyrillic($codedOption['code']),
            'en' => $codedOption['code'],
        ];

        $stmt->bindValue(':cfid', $cfId);
        $stmt->bindValue(':optionValue', $optionValue);
        $stmt->bindValue(':translations', json_encode($translations));
        $stmt->bindValue(':ordno', $ordno);
        $stmt->execute();
    }

    public function deleteByOptionValue(int $cfId, string $optionValue): void
    {
        $stmt = $this->pdo->prepare("DELETE FROM custom_field_option WHERE custom_field_id = :cfid AND option_value = :optionValue");
        $stmt->execute([
            ':cfid' => $cfId,
            ':optionValue' => $optionValue,
        ]);
    }

}
