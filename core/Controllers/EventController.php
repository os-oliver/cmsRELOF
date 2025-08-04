<?php
// src/Controllers/EventController.php

namespace App\Controllers;
session_start();

if (empty($_SESSION['user_id'])) {
    echo "autentification: -1 BLEHHH";
    exit;
}

use App\Models\Event;
use App\Utils\FileUploader;

class EventController
{
    private \PDO $pdo;


    public function list()
    {


        header('Content-Type: application/json');
        echo json_encode((new Event)->all());
    }

    public function show($id)
    {
        $event = (new Event)->find((int) $id);
        if (!$event) {
            http_response_code(404);
            echo json_encode(['error' => 'Event not found']);
            return;
        }
        echo json_encode($event);
    }

    public function create()
    {
        $data = $_POST;
        $file = $_FILES['file'] ?? null;
        $uploader = new FileUploader(dirname(__DIR__) . '/../public/uploads/images');
        if (!$this->validate($data)) {
            http_response_code(422);
            echo json_encode(['error' => 'Validation failed']);
            return;
        }

        error_log($_FILES['file'] . "cocococ");
        try {
            $imageFilename = $file != null ? $uploader->upload($file) : 'NULL';
        } catch (\RuntimeException $e) {
            echo json_encode(['error' => $e->getMessage()]);
            exit;
        }

        $data['filepath'] = $imageFilename;
        $id = (new Event)->create($data);
        http_response_code(201);
        echo json_encode(['id' => $id]);
    }

    public function update($id)
    {
        $raw = file_get_contents("php://input");
        $data = json_decode($raw, true);


        foreach ($data as $key => $value) {
            error_log('fajl:' . $key . ':' . $value);
        }
        $id = (int) $id;
        if ((new Event())->update($id, $data)) {
            echo json_encode(['success' => true]);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Update failed']);
        }
    }

    public function delete($id)
    {
        if ((new Event)->delete((int) $id)) {
            echo json_encode(['success' => true]);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Delete failed']);
        }
    }

    private function validate(array $data): bool
    {
        return isset($data['category'], $data['title'], $data['description'], $data['date'], $data['time'])
            && !empty($data['title']) && !empty($data['date']) && !empty($data['time']);
    }
}
