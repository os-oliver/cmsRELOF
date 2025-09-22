<?php
namespace App\Utils;

class Pivoter
{
    private string $pivotColumn;
    private string $valueColumn;
    private string $idColumn;

    public function __construct(
        string $pivotColumn = 'field_name',
        string $valueColumn = 'content',
        string $idColumn = 'id'
    ) {
        $this->pivotColumn = $pivotColumn;
        $this->valueColumn = $valueColumn;
        $this->idColumn = $idColumn;
    }

    /**
     * Pivotira niz redova iz baze u "široku" tabelu
     *
     * @param array $rows
     * @param bool $clean Remove pivotColumn & valueColumn iz rezultata
     * @return array
     */
    public function pivot(array $rows, bool $clean = true): array
    {
        error_log('Pivoter radi');
        error_log(json_encode($rows, JSON_PRETTY_PRINT));
        $result = [];
        foreach ($rows as $row) {
            $id = $row[$this->idColumn];

            // Ako ne postoji, inicijalizuj
            if (!isset($result[$id])) {
                $result[$id] = $row;
            }

            // Dodaj pivotirano polje
            $result[$id][$row[$this->pivotColumn]] = $row[$this->valueColumn];
        }

        // Ako hoćemo čiste rezultate (bez field_name i content)
        if ($clean) {
            foreach ($result as &$row) {
                unset($row[$this->pivotColumn], $row[$this->valueColumn]);
            }
        }

        return array_values($result);
    }
}
