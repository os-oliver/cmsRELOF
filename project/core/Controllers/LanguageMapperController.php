<?php

namespace App\Controllers;
//use Stichoza\GoogleTranslate\GoogleTranslate;

class LanguageMapperController {

    protected $translate;

    /*
    public function __construct() {
        $this->translate = new GoogleTranslate();
        $this->translate->setSource('sr');
        $this->translate->setTarget('en');
    }
    */
    
    function latin_to_cyrillic($text) {
        $latin = [
            'Nj', 'Lj', 'Dž', 'nj', 'lj', 'dž', 
            'A','B','V','G','D','Đ','E','Ž','Z','I','J','K','L','M','N','O','P','R','S','T','Ć','U','F','H','C','Č','Š','a','b','v','g','d','đ','e','ž','z','i','j','k','l','m','n','o','p','r','s','t','ć','u','f','h','c','č','š'
        ];
        $cyrillic = [
            'Њ', 'Љ', 'Џ', 'њ', 'љ', 'џ', 
            'А','Б','В','Г','Д','Ђ','Е','Ж','З','И','Ј','К','Л','М','Н','О','П','Р','С','Т','Ћ','У','Ф','Х','Ц','Ч','Ш','а','б','в','г','д','ђ','е','ж','з','и','ј','к','л','м','н','о','п','р','с','т','ћ','у','ф','х','ц','ч','ш'
        ];
        return str_replace($latin, $cyrillic, $text);
    }

    function cyrillic_to_latin($text) {
        $cyrillic = [
            'Њ', 'Љ', 'Џ', 'њ', 'љ', 'џ', 
            'А','Б','В','Г','Д','Ђ','Е','Ж','З','И','Ј','К','Л','М','Н','О','П','Р','С','Т','Ћ','У','Ф','Х','Ц','Ч','Ш','а','б','в','г','д','ђ','е','ж','з','и','ј','к','л','м','н','о','п','р','с','т','ћ','у','ф','х','ц','ч','ш'
        ];
        $latin = [
            'Nj', 'Lj', 'Dž', 'nj', 'lj', 'dž', 
            'A','B','V','G','D','Đ','E','Ž','Z','I','J','K','L','M','N','O','P','R','S','T','Ć','U','F','H','C','Č','Š','a','b','v','g','d','đ','e','ž','z','i','j','k','l','m','n','o','p','r','s','t','ć','u','f','h','c','č','š'
        ];
        return str_replace($cyrillic, $latin, $text);
    }

    public function cyrillic_to_latin_array(array $data): array {
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $data[$key] = $this->cyrillic_to_latin($value);
            } elseif (is_array($value)) {
                $data[$key] = $this->cyrillic_to_latin_array($value);
            }
        }
        return $data;
    }

    public function latin_to_cyrillic_array(array $data): array {
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $data[$key] = $this->latin_to_cyrillic($value);
            } elseif (is_array($value)) {
                $data[$key] = $this->latin_to_cyrillic_array($value);
            }
        }
        return $data;
    }

    public function detectScript($text): string {
        if (preg_match('/\p{Cyrillic}/u', $text)) {
            return 'cyrillic';
        }
        return 'latin';
    }

    /*
    public function translateToEng($text): string {
        return $this->translate->translate($text);
    }
    */
}