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
        int $maxFileSize = 200 * 1024 * 1024 // 200 MB
    ) {
        $this->uploadDir = rtrim($uploadDir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
        $this->allowedMime = $allowedMime;
        $this->maxFileSize = $maxFileSize;

        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0775, true);
        }
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
            throw new \RuntimeException("Upload error code: {$error}");
        }

        $size = isset($file['size']) ? (int) $file['size'] : 0;
        if ($size > $this->maxFileSize) {
            error_log("File too large: {$size}");
            throw new \RuntimeException("File exceeds max size of {$this->maxFileSize} bytes.");
        }

        $type = $file['type'] ?? '';
        if (!in_array($type, $this->allowedMime, true)) {
            throw new \RuntimeException("Invalid MIME type: {$type}");
        }

        $tmp = $file['tmp_name'] ?? null;
        if (!$tmp || !is_uploaded_file($tmp)) {
            throw new \RuntimeException("Possible file upload attack or missing tmp_name.");
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
            throw new \RuntimeException("Failed to move uploaded file.");
        }

        error_log("uploaded filename: {$filename} ext: {$ext}");

        return $filename;
    }

}