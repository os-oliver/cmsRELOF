<?php
namespace App\Models;

use App\Database;
use PDO;

class Image
{
    /**
     * Return PDO instance
     */
    private static function pdo(): PDO
    {
        return (new Database())->GetPDO();
    }

    /**
     * Detect whether image table has element_id column
     */
    public static function hasElementColumn(): bool
    {
        return self::elementColumnName() !== null;
    }

    /**
     * Return the column name used by image table to reference generic element.
     * Supports 'element_id' and 'generic_element_id' and returns null if none.
     */
    public static function elementColumnName(): ?string
    {
        static $col = '__unset__';
        if ($col !== '__unset__') {
            return $col;
        }
        $col = null;
        try {
            $pdo = self::pdo();
            $c = $pdo->query("SHOW COLUMNS FROM image LIKE 'element_id'");
            if ($c && $c->rowCount() > 0) {
                $col = 'element_id';
            } else {
                $c2 = $pdo->query("SHOW COLUMNS FROM image LIKE 'generic_element_id'");
                if ($c2 && $c2->rowCount() > 0) {
                    $col = 'generic_element_id';
                }
            }
        } catch (\Throwable $_) {
            $col = null;
        }
        return $col;
    }

    /**
     * Detect the primary key column name for the image table.
     * Caches result in a static to avoid repeated SHOW queries.
     */
    private static function imagePrimaryKey(): string
    {
        static $pk = null;
        if ($pk !== null) {
            return $pk;
        }
        $pk = 'id';
        try {
            $pdo = self::pdo();
            $cols = $pdo->query("SHOW COLUMNS FROM image");
            if ($cols) {
                $colRows = $cols->fetchAll(PDO::FETCH_ASSOC);
                foreach ($colRows as $cr) {
                    if (!empty($cr['Key']) && strtoupper($cr['Key']) === 'PRI') {
                        $pk = $cr['Field'];
                        break;
                    }
                }
            }
        } catch (\Throwable $_) {
            // leave default 'id'
        }
        return $pk;
    }

    /**
     * Public wrapper exposing the detected primary key column name for image table.
     */
    public static function primaryKeyName(): string
    {
        return self::imagePrimaryKey();
    }

    /**
     * Fetch all images for an element (by image.element_id if present)
     * Returns array of ['id'=>..., 'file_path'=>...]
     */
    public static function fetchByElement(int $elementId): array
    {
        try {
            $pdo = self::pdo();
            $elemCol = self::elementColumnName();
            if ($elemCol) {
                $pk = self::imagePrimaryKey();
                // return results with 'id' key for compatibility
                $s = $pdo->prepare("SELECT {$pk} AS id, file_path FROM image WHERE {$elemCol} = :id ORDER BY {$pk} ASC");
                $s->execute([':id' => $elementId]);
                return $s->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (\Throwable $_) {
        }
        return [];
    }

    /**
     * Return array of file_path strings for an element id.
     * If the image table stores a per-element FK (e.g. 'element_id' or
     * 'generic_element_id') this will be used and may return multiple rows.
     */
    public static function fetchFilePathsForElement(int $elementId): array
    {
        try {
            $pdo = self::pdo();
            // prefer direct image.element_id linkage
            $pk = self::imagePrimaryKey();
            $elemCol = self::elementColumnName();
            if ($elemCol) {
                $s = $pdo->prepare("SELECT file_path FROM image WHERE {$elemCol} = :id ORDER BY {$pk} ASC");
                $s->execute([':id' => $elementId]);
                $rows = $s->fetchAll(PDO::FETCH_COLUMN, 0);
                return $rows ?: [];
            }

            // No element FK present and no reliable generic_element->image FK
            // found; return empty and let callers handle the absence.
        } catch (\Throwable $_) {
            // swallow and return empty — callers should handle empty list
        }
        return [];
    }

    /**
     * Simple helper to return single file_path for an image id (image.id) or null.
     */
    public static function fetchFilePathByImageId($imageId): ?string
    {
        try {
            $r = self::fetchByImageId($imageId);
            return $r['file_path'] ?? null;
        } catch (\Throwable $_) {
            return null;
        }
    }

    /**
     * Fetch image by image.id (not the auto PK 'uid')
     */
    public static function fetchByImageId($imageId): ?array
    {
        try {
            $pdo = self::pdo();
            $pk = self::imagePrimaryKey();
            $s = $pdo->prepare("SELECT * FROM image WHERE {$pk} = :id LIMIT 1");
            $s->execute([':id' => $imageId]);
            $r = $s->fetch(PDO::FETCH_ASSOC);
            return $r ?: null;
        } catch (\Throwable $_) {
            return null;
        }
    }

    /**
     * Delete image by image.id and return file_path that was deleted (or null)
     */
    public static function deleteByImageId($imageId): ?string
    {
        try {
            $pdo = self::pdo();
            $pk = self::imagePrimaryKey();
            $s = $pdo->prepare("SELECT file_path FROM image WHERE {$pk} = :id LIMIT 1");
            $s->execute([':id' => $imageId]);
            $row = $s->fetch(PDO::FETCH_ASSOC);
            $path = $row['file_path'] ?? null;
            $d = $pdo->prepare("DELETE FROM image WHERE {$pk} = :id");
            $d->execute([':id' => $imageId]);
            return $path;
        } catch (\Throwable $_) {
            return null;
        }
    }

    /**
     * Insert image row. If elementId provided and column exists, sets element_id.
     * Returns lastInsertId (uid) or null.
     */
    public static function insertImage(string $filePath, ?int $elementId = null): ?int
    {
        try {
            $pdo = self::pdo();
            $elemCol = self::elementColumnName();
            if ($elementId !== null && $elemCol) {
                $ins = $pdo->prepare("INSERT INTO image (file_path, {$elemCol}) VALUES (:path, :element)");
                $ins->execute([':path' => $filePath, ':element' => $elementId]);
            } else {
                $ins = $pdo->prepare("INSERT INTO image (file_path) VALUES (:path)");
                $ins->execute([':path' => $filePath]);
            }
            return (int) $pdo->lastInsertId();
        } catch (\Throwable $_) {
            return null;
        }
    }
}
