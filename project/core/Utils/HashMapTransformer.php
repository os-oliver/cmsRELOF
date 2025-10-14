<?php
namespace App\Utils;

class HashMapTransformer
{
    public static function transform(array $rawEvents, string $locale): array
    {
        return array_map(function ($item) use ($locale) {
            $fields = [];
            foreach ($item['fields'] as $key => $value) {
                $fields[$key] = is_array($value) && isset($value[$locale]) ? $value[$locale] : $value;
            }

            // Include category content if exists
            $category = isset($item['category']['content']) ? $item['category']['content'] : null;

            return (object) array_merge(
                ['id' => $item['id'], 'type' => $item['type']],
                $fields,
                [
                    'image' => $item['image'] ?? null,
                    'images' => $item['images'] ?? [],
                    'naziv' => $category
                ]
            );
        }, $rawEvents);
    }
}
