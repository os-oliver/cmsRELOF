<?php
namespace App\Utils;

class HashMapTransformer
{
    // Define allowed file extensions
    private static array $fileExtensions = ['pdf', 'xls', 'xlsx', 'doc', 'docx'];

    public static function transform(array $rawEvents, string $locale): array
    {
        return array_map(function ($item) use ($locale) {
            $fields = [];
            $files = [];

            if (isset($item['fields']) && is_array($item['fields'])) {
                foreach ($item['fields'] as $key => $value) {
                    if (is_array($value)) {
                        $fields[$key] = $value[$locale] ?? $value['sr-Cyrl'] ?? '';
                    } else {
                        $fields[$key] = $value;
                    }

                    // Check if value is a file link
                    if (is_string($value)) {
                        $ext = strtolower(pathinfo($value, PATHINFO_EXTENSION));
                        if (in_array($ext, self::$fileExtensions)) {
                            $files[] = $value;
                        }
                    }
                }
            }

            $category = null;
            if (isset($item['category']['content'])) {
                $catValue = $item['category']['content'];
                $category = is_array($catValue) ? ($catValue[$locale] ?? $catValue['sr-Cyrl'] ?? '') : $catValue;
            }

            return (object) array_merge(
                ['id' => $item['id'], 'type' => $item['type']],
                $fields,
                [
                    'image' => $item['image'] ?? null,
                    'images' => $item['images'] ?? [],
                    'naziv' => $category,
                    'files' => $files
                ]
            );
        }, $rawEvents);
    }
}
