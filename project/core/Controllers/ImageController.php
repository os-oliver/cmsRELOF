<?php
namespace App\Controllers;

use App\Models\Image;

class ImageController
{
    /**
     * Return array of file_path strings for an element id
     */
    public function getImagesForElement(int $elementId): array
    {
        $rows = Image::fetchByElement($elementId);
        $out = [];
        foreach ($rows as $r) {
            if (!empty($r['file_path']))
                $out[] = $r['file_path'];
        }
        return $out;
    }

    /**
     * Return one image path for generic_element.image_id
     */
    public function getImageByImageId($imageId): ?string
    {
        $r = Image::fetchByImageId($imageId);
        return $r['file_path'] ?? null;
    }

    /**
     * Delete image by image.id and optionally unlink file
     */
    public function deleteImageById($imageId): ?string
    {
        return Image::deleteByImageId($imageId);
    }
}
