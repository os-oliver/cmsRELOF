<?php

namespace App\Utils;

use App\Models\ContentType;
// use App\Models\ContentTypeCategory;
use App\Models\CustomField;
use App\Models\CustomFieldOption;
use Exception;

class ContentTypeManager
{
    public function __construct(

    ) {

    }

    public static function collectTypes(string $typeOfInstitution): array
    {
        $jsonPath = __DIR__ . "/../../templates/" . $typeOfInstitution . "/json/data_definition.json";
        $globalJsonPath = __DIR__ . "/../../templates/globalDefinitions.json";

        if (!file_exists($jsonPath)) {
            throw new \Exception("JSON file not found: $jsonPath");
        }

        $jsonData = json_decode(file_get_contents($jsonPath), true);
        if (!is_array($jsonData)) {
            throw new \Exception("Failed to decode JSON: $jsonPath");
        }

        if (isset($jsonData[0]) && is_array($jsonData[0])) {
            $jsonData = $jsonData[0];
        }

        $globalData = [];
        if (file_exists($globalJsonPath)) {
            $globalData = json_decode(file_get_contents($globalJsonPath), true);
            if (!is_array($globalData)) {
                $globalData = [];
            }

            if (isset($globalData[0]) && is_array($globalData[0])) {
                $globalData = $globalData[0];
            }
        }

        $dataArray = array_merge($globalData, $jsonData);

        // Wrap the merged data in an array to ensure JSON starts with []
        file_put_contents(
            __DIR__ . "/../../public/assets/data/structure.json",
            json_encode([$dataArray], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
        );

        foreach ($dataArray as $contentType) {
            if (empty($contentType['code'])) {
                throw new \Exception('Content Type bez code-a!!!');
            }
        }
        return $dataArray;
    }

    public static function createTypes($typeOfInstitution): void
    {
        $contentTypes = self::collectTypes($typeOfInstitution);

        self::updateContentTypes($contentTypes);
    }

    public static function updateContentTypes(array $contentTypes): void
    {
        $ctype = new ContentType();
        $updatedCodes = [];
        foreach ($contentTypes as $type) {
            $existing = $ctype->fetchByCode($type['code']);
            if (empty($existing)) {
                $ctype->create($type);
            } else {
                $ctype->update($type);
            }
            $updatedCodes[] = $type['code'];

            // if (array_key_exists('coded_categories', $type)) {
            //     self::updateContentTypeCategories($type);
            // }
            self::updateCustomFields($type);
        }

        $all = $ctype->fetchAll();
        foreach ($all as $type) {
            if (!in_array($type['code'], $updatedCodes)) {
                $ctype->deleteByCode($type['code']);
            }
        }
    }

    /*
    public static function updateContentTypeCategories(array $contentType): void
    {
        $ctCategory = new ContentTypeCategory();
        $updatedCodes = [];
        $categories = $contentType['coded_categories'];
        $ordno = 1;
        foreach ($categories as $category) {
            $existing = $ctCategory->fetchByCode($contentType['code'], $category['code']);
            if (empty($existing)) {
                $ctCategory->create($contentType['code'], $category, $ordno);
            } else {
                $ctCategory->update($contentType['code'], $category, $ordno);
            }
            $updatedCodes[] = $category['code'];
            $ordno++;
        }

        $all = $ctCategory->fetchAllByContentTypeCode($contentType['code']);

        foreach ($all as $category) {
            if (!in_array($category['code'], $updatedCodes)) {
                $ctCategory->deleteByCode($contentType['code'], $category['code']);
            }
        }
    }
    */

    public static function updateCustomFields(array $contentType): void
    {
        $cfield = new CustomField();
        $updatedCodes = [];
        $fields = $contentType['fields'];
        $ordno = 1;
        foreach ($fields as $field) {
            $existing = $cfield->fetchByCode($contentType['code'], $field['name']);
            if (empty($existing)) {
                $cfield->create($contentType['code'], $field, $ordno);
            } else {
                $cfield->update($contentType['code'], $field, $ordno);
            }
            $updatedCodes[] = $field['name'];
            $ordno++;

            if (!empty($field['options'])) {
                $dbCustomField = $cfield->fetchByCode($contentType['code'], $field['name']);
                self::updateCustomFieldOptions($dbCustomField, $field);
            }
        }

        $all = $cfield->fetchAllByContentTypeCode($contentType['code']);

        foreach ($all as $customField) {
            if (!in_array($customField['code'], $updatedCodes)) {
                $cfield->deleteByCode($contentType['code'], $customField['code']);
            }
        }
    }

    public static function updateCustomFieldOptions(array $dbCustomField, array $customField): void
    {
        $cfOption = new CustomFieldOption();

        $ordno = 1;
        foreach ($customField['coded_options'] as $option) {
            $existing = $cfOption->fetchByOptionValue($dbCustomField['id'], $option['code']);
            if (empty($existing)) {
                $cfOption->create($dbCustomField['id'], $option, $ordno);
            } else {
                $cfOption->update($dbCustomField['id'], $option, $ordno);
            }

            $updatedOptions[] = $option['code'];
            $ordno++;
        }

        $all = $cfOption->fetchAllByCustomFieldId($dbCustomField['id']);

        foreach ($all as $option) {
            if (!in_array($option['option_value'], $updatedOptions)) {
                $cfOption->deleteByOptionValue($dbCustomField['id'], $option['option_value']);
            }
        }
    }

}