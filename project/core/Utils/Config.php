<?php
namespace App\Utils;

use RuntimeException;

final class Config
{
    private static ?array $structure = null;
    private static string $defaultStructurePath = dirname(__DIR__, 2) . '/public/assets/data/structure.json';

    private function __construct()
    {
    }

    private static function resolvePath(): string
    {
        $real = realpath(self::$defaultStructurePath);
        if ($real === false)
            throw new RuntimeException("structure.json not found at: " . self::$defaultStructurePath);
        return $real;
    }

    public static function loadStructure(): array
    {
        if (self::$structure !== null)
            return self::$structure;

        $path = self::resolvePath();
        $json = @file_get_contents($path);
        if ($json === false)
            throw new RuntimeException("Failed to read structure file: {$path}");

        $parsed = json_decode($json, true);
        if (!is_array($parsed))
            throw new RuntimeException("structure.json is malformed or not an array: {$path}");

        self::$structure = $parsed;
        return self::$structure;
    }

    public static function clearCache(): void
    {
        self::$structure = null;
    }

    public static function reload(): array
    {
        self::clearCache();
        return self::loadStructure();
    }

    public static function getTypeConfig(string $type): ?array
    {
        $structure = self::loadStructure();
        foreach ($structure as $entry) {
            if (!is_array($entry))
                continue;
            foreach ($entry as $key => $val) {
                if (strcasecmp((string) $key, $type) === 0)
                    return is_array($val) ? $val : null;
            }
        }
        return null;
    }

    public static function getFields(string $type): array
    {
        $cfg = self::getTypeConfig($type);
        return is_array($cfg) && isset($cfg['fields']) && is_array($cfg['fields']) ? $cfg['fields'] : [];
    }

    public static function getFieldNames(string $type): array
    {
        $fields = self::getFields($type);
        $names = [];
        foreach ($fields as $f)
            if (isset($f['name']))
                $names[] = (string) $f['name'];
        return array_values($names);
    }

    public static function findField(string $type, string $fieldName): ?array
    {
        $fields = self::getFields($type);
        foreach ($fields as $f)
            if (isset($f['name']) && (string) $f['name'] === $fieldName)
                return $f;
        return null;
    }

    public static function hasType(string $type): bool
    {
        return self::getTypeConfig($type) !== null;
    }
}
