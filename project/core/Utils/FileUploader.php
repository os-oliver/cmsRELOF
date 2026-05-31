<?php
// src/Utils/FileUploader.php
namespace App\Utils;

class FileUploader
{
    protected string $uploadDir;
    protected array $allowedMime;
    protected int $maxFileSize;

    public function __construct(
        string $uploadDir,
        array $allowedMime = [
            'image/webp',
            'image/jpeg',
            'image/png',
            'image/gif',
            'application/pdf',
            'text/csv',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ],
        ?int $maxFileSize = null // default to php.ini limits
    ) {
        $this->uploadDir = rtrim($uploadDir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
        $this->allowedMime = $allowedMime;
        $this->maxFileSize = $maxFileSize ?? self::getIniUploadLimit();

        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0775, true);
        }
    }

    public static function formatBytes(int $bytes): string
    {
        if ($bytes <= 0) {
            return '0 B';
        }

        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $power = (int) floor(log($bytes, 1024));
        $power = min($power, count($units) - 1);

        $value = $bytes / (1024 ** $power);
        return number_format($value, $power === 0 ? 0 : 2) . ' ' . $units[$power];
    }

    public static function parseIniSize(string $value): int
    {
        if ($value === '') {
            return 0;
        }

        $trimmed = trim($value);
        $last = strtolower(substr($trimmed, -1));
        $number = (float) $trimmed;

        return match ($last) {
            'g' => (int) ($number * 1024 * 1024 * 1024),
            'm' => (int) ($number * 1024 * 1024),
            'k' => (int) ($number * 1024),
            default => (int) $number,
        };
    }

    public static function getIniUploadLimit(): int
    {
        $fallback = 200 * 1024 * 1024; // 200MB default fallback
        $limits = [];

        $uploadMax = ini_get('upload_max_filesize');
        $postMax = ini_get('post_max_size');

        if ($uploadMax !== false) {
            $limits[] = self::parseIniSize((string) $uploadMax);
        }

        if ($postMax !== false) {
            $limits[] = self::parseIniSize((string) $postMax);
        }

        // Use the smallest non-zero positive limit
        $limits = array_filter($limits, fn ($v) => $v > 0);
        if (empty($limits)) {
            return $fallback;
        }

        return (int) min($limits);
    }

    protected function describeAllowedTypes(): string
    {
        $labels = [
            'image/webp' => 'WEBP',
            'image/jpeg' => 'JPG/JPEG',
            'image/png' => 'PNG',
            'image/gif' => 'GIF',
            'application/pdf' => 'PDF',
            'text/csv' => 'CSV',
            'application/msword' => 'DOC',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'DOCX',
            'application/vnd.ms-excel' => 'XLS',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'XLSX',
        ];

        $friendly = [];
        foreach ($this->allowedMime as $mime) {
            $friendly[] = $labels[$mime] ?? $mime;
        }

        return implode(', ', array_unique($friendly));
    }

    public static function getUploadErrorMessage(int $error): string
    {
        $iniLimit = ini_get('upload_max_filesize');

        return match ($error) {
            UPLOAD_ERR_INI_SIZE => "The file is larger than the server limit ({$iniLimit}). Please choose a smaller file or contact an administrator.",
            UPLOAD_ERR_FORM_SIZE => 'The file exceeds the maximum size allowed by the form.',
            UPLOAD_ERR_PARTIAL => 'The file was only partially uploaded. Please try again.',
            UPLOAD_ERR_NO_FILE => 'No file was uploaded.',
            UPLOAD_ERR_NO_TMP_DIR => 'Upload failed because the temporary folder is missing on the server.',
            UPLOAD_ERR_CANT_WRITE => 'Upload failed because the file could not be written to disk.',
            UPLOAD_ERR_EXTENSION => 'A server extension stopped the upload. Please contact an administrator.',
            default => "Unexpected upload error (code {$error}). Please try again.",
        };
    }

    /**
     * @param  array $file   The $_FILES['fieldname'] array
     * @return string|null   The new filename, or null if no file was provided
     * @throws \RuntimeException on any error
     */
    public function upload(array $file): ?string
    {
        // Ensure this method is used for a single file (not the multi-file $_FILES structure)
        if (isset($file['error']) && is_array($file['error'])) {
            // Caller passed a multi-file structure; require caller to pass single-file entries.
            throw new \RuntimeException('Expected single file array, got multi-file structure.');
        }

        // Safely log basic file info (avoid concatenating arrays which triggers notices)
        $info = [
            'name' => $file['name'] ?? null,
            'type' => $file['type'] ?? null,
            'size' => isset($file['size']) ? (int) $file['size'] : null,
            'error' => $file['error'] ?? null,
        ];
        error_log('file: ' . json_encode($info, JSON_UNESCAPED_UNICODE));
        // no file uploaded
        $error = $file['error'] ?? UPLOAD_ERR_NO_FILE;
        if ($error === UPLOAD_ERR_NO_FILE) {
            return null;
        }

        if ($error !== UPLOAD_ERR_OK) {
            // Log the full file array safely for debugging
            error_log('Upload error file data: ' . json_encode($file, JSON_UNESCAPED_UNICODE));
            $message = self::getUploadErrorMessage((int) $error);
            throw new \RuntimeException($message);
        }

        $size = isset($file['size']) ? (int) $file['size'] : 0;
        if ($size > $this->maxFileSize) {
            error_log("File too large: {$size}");
            $maxHuman = $this->formatBytes($this->maxFileSize);
            $currentHuman = $this->formatBytes($size);
            throw new \RuntimeException("File is too large ({$currentHuman}). Maximum allowed size is {$maxHuman}.");
        }

        $type = $file['type'] ?? '';
        if (!in_array($type, $this->allowedMime, true)) {
            $allowedList = $this->describeAllowedTypes();
            throw new \RuntimeException("Unsupported file type. Allowed types: {$allowedList}.");
        }

        $tmp = $file['tmp_name'] ?? null;
        if (!$tmp || !is_uploaded_file($tmp)) {
            throw new \RuntimeException("Server did not receive a valid uploaded file. Please try again.");
        }
        // get original filename without extension
        $originalName = pathinfo($file['name'], PATHINFO_FILENAME);
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

        // replace spaces with underscores
        $originalName = str_replace(' ', '_', $originalName);

        // remove any character that is NOT a letter (any language), number, dash or underscore
        $originalName = preg_replace('/[^\p{L}\p{N}_-]/u', '', $originalName);

        // rebuild filename
        $filename = $originalName . '.' . $ext;
        $target = $this->uploadDir . $filename;


        // If file exists, add random suffix
        while (file_exists($target)) {
            $randomPart = bin2hex(random_bytes(4)); // 8 chars
            $filename = $originalName . '_' . $randomPart . '.' . $ext;
            $target = $this->uploadDir . $filename;
        }

        // Move uploaded file
        if (!move_uploaded_file($file['tmp_name'], $target)) {
            throw new \RuntimeException("The file was uploaded but could not be saved. Please try again.");
        }

        error_log("uploaded filename: {$filename} ext: {$ext}");

        return $filename;
    }

}
