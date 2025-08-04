<?php
namespace App\Controllers;

class VisitCounterController
{
    private string $file;
    private array $data;

    public function __construct(string $file = 'counter.json')
    {
        $this->file = $file;
        $this->loadData();
    }

    // Load the JSON data or initialize it
    private function loadData(): void
    {
        if (file_exists($this->file)) {
            $json = file_get_contents($this->file);
            $this->data = json_decode($json, true);

            if (!isset($this->data['visits'])) {
                $this->data['visits'] = 0;
            }
        } else {
            $this->data = ['visits' => 0];
        }
    }

    // Increment the visit count and save
    public function incrementVisit(): void
    {
        $this->data['visits']++;
        error_log("vidi me:" . $this->data['visits']);
        $this->saveData();
    }

    // Save JSON data back to file
    private function saveData(): void
    {
        file_put_contents($this->file, json_encode($this->data, JSON_PRETTY_PRINT), LOCK_EX);
    }

    // Get current visit count
    public function getVisitCount(): int
    {
        return $this->data['visits'];
    }
}
