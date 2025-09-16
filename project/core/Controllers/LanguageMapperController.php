<?php

namespace App\Controllers;

class LanguageMapperController
{

    private array $map = [
        // Digraphs & trigraphs first (important for correct replacement)
        'Dž' => 'Џ',
        'dž' => 'џ',
        'Dz' => 'Џ',
        'dz' => 'џ',
        'Nj' => 'Њ',
        'nj' => 'њ',
        'Lj' => 'Љ',
        'lj' => 'љ',
        'Dj' => 'Ђ',
        'dj' => 'ђ',

        // Single letters
        'A' => 'А',
        'B' => 'Б',
        'V' => 'В',
        'G' => 'Г',
        'D' => 'Д',
        'Đ' => 'Ђ',
        'E' => 'Е',
        'Ž' => 'Ж',
        'Z' => 'З',
        'I' => 'И',
        'J' => 'Ј',
        'K' => 'К',
        'L' => 'Л',
        'M' => 'М',
        'N' => 'Н',
        'O' => 'О',
        'P' => 'П',
        'R' => 'Р',
        'S' => 'С',
        'T' => 'Т',
        'Ć' => 'Ћ',
        'U' => 'У',
        'F' => 'Ф',
        'H' => 'Х',
        'C' => 'Ц',
        'Č' => 'Ч',
        'Š' => 'Ш',

        'a' => 'а',
        'b' => 'б',
        'v' => 'в',
        'g' => 'г',
        'd' => 'д',
        'đ' => 'ђ',
        'e' => 'е',
        'ž' => 'ж',
        'z' => 'з',
        'i' => 'и',
        'j' => 'ј',
        'k' => 'к',
        'l' => 'л',
        'm' => 'м',
        'n' => 'н',
        'o' => 'о',
        'p' => 'п',
        'r' => 'р',
        's' => 'с',
        't' => 'т',
        'ć' => 'ћ',
        'u' => 'у',
        'f' => 'ф',
        'h' => 'х',
        'c' => 'ц',
        'č' => 'ч',
        'š' => 'ш'
    ];

    public function latin_to_cyrillic(string $text): string
    {
        return strtr($text, $this->map);
    }

    public function cyrillic_to_latin(string $text): string
    {
        return strtr($text, array_flip($this->map));
    }

    public function latin_to_cyrillic_array(array $data): array
    {
        return $this->mapArray($data, [$this, 'latin_to_cyrillic']);
    }

    public function cyrillic_to_latin_array(array $data): array
    {
        return $this->mapArray($data, [$this, 'cyrillic_to_latin']);
    }

    private function mapArray(array $data, callable $mapper): array
    {
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $data[$key] = $mapper($value);
            } elseif (is_array($value)) {
                $data[$key] = $this->mapArray($value, $mapper);
            }
        }
        return $data;
    }

    public function detectScript(string $text): string
    {
        return preg_match('/\p{Cyrillic}/u', $text) ? 'cyrillic' : 'latin';
    }
}
