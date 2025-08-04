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
        int $maxFileSize = 5 * 1024 * 1024 * 1024 // 1GB
    ) {
        $this->uploadDir = rtrim($uploadDir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
        $this->allowedMime = $allowedMime;
        $this->maxFileSize = $maxFileSize;

        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0755, true);
        }
    }

    /**
     * @param  array $file   The $_FILES['fieldname'] array
     * @return string|null   The new filename, or null if no file was provided
     * @throws \RuntimeException on any error
     */
    public function upload(array $file): ?string
    {
        error_log("file:" . $file);
        // no file uploaded
        if ($file['error'] === UPLOAD_ERR_NO_FILE) {
            return null;
        }

        if ($file['error'] !== UPLOAD_ERR_OK) {
            foreach ($file as $key => $value) {
                error_log('' . $key . ':' . $value);
            }
            throw new \RuntimeException("Upload error code: {$file['error']}");
        }

        if ($file['size'] > $this->maxFileSize) {
            error_log("caoo:." . $file['size']);
            throw new \RuntimeException("File exceeds max size of {$this->maxFileSize} bytes.");
        }

        if (!in_array($file['type'], $this->allowedMime, true)) {
            throw new \RuntimeException("Invalid MIME type: {$file['type']}");
        }

        if (!is_uploaded_file($file['tmp_name'])) {
            throw new \RuntimeException("Possible file upload attack.");
        }

        // generate unique name
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $basename = bin2hex(random_bytes(8)); // 16 chars
        $filename = $basename . '.' . $ext;
        error_log("okej sam" . $filename . ":" . $ext . "");
        $target = $this->uploadDir . $filename;
        if (!move_uploaded_file($file['tmp_name'], $target)) {
            throw new \RuntimeException("Failed to move uploaded file.");
        }

        return $filename;
    }
}


?>