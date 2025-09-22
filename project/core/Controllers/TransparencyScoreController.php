<?php
namespace App\Controllers;

use App\Models\Document;
use App\Models\Subcategory;

class TransparencyScoreController
{
    
    public function getTransparencyScore() {
        // Fetch all subcategories present in documents
        $documentModel = new Document();
        $numberOfDistinctSubcategoriesInDocuments = $documentModel->countDistinctSubcategories();

        error_log("Broj razlicitih podkategorija u dokumentima: " . $numberOfDistinctSubcategoriesInDocuments);

        // Fetch all possible subcategories
        $subcategoryModel = new Subcategory();
        $numberOfSubcategories = $subcategoryModel->countDistinctSubcategories();

        error_log("Ukupan broj podkategorija: " . $numberOfSubcategories);

        if ($numberOfSubcategories === 0) {
            return 0;
        }

        $percentage = ((float)$numberOfDistinctSubcategoriesInDocuments / $numberOfSubcategories) * 100;
        error_log($percentage);

        return $percentage;
    }

}