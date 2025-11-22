<?php
namespace App\Controllers;

use App\Models\User;

class UserController
{
    /**
     * POST /users
     */
    public function create(): void
    {
        header('Content-Type: application/json');

        // 1) Read the raw request body and decode JSON
        $payload = json_decode(file_get_contents('php://input'), true) ?: [];

        // 2) Pull out your fields, with sane defaults
        $data = [
            'username' => $payload['username'] ?? '',
            'password' => $payload['password'] ?? '',
            'name' => $payload['name'] ?? '',
            'surname' => $payload['surname'] ?? '',
            'role' => $payload['role'] ?? User::ROLE_EDITOR,
        ];

        // 3) Call your model and echo JSON back
        $model = new User();
        $result = $model->create($data);
        echo json_encode($result);
    }


    /**
     * PUT /users/{id}
     *
     * @param array $args FastRoute params, expects ['id' => int]
     */
    public function update(int $id): void
    {
        // PHP doesn’t populate $_POST on PUT; grab the raw JSON body:
        $payload = json_decode(file_get_contents('php://input'), true) ?: [];

        $data = [
            'name' => $payload['name'] ?? '',
            'surname' => $payload['surname'] ?? '',
            'username' => $payload['username'] ?? null,
            'password' => $payload['password'] ?? null,
            'role' => $payload['role'] ?? null,
        ];

        $model = new User();
        $result = $model->update($id, $data);

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    /**
     * DELETE /users/{id}
     *
     * @param array $args FastRoute params, expects ['id' => int]
     */
    public function delete(int $id): void
    {
        $model = new User();
        $result = $model->delete($id);

        header('Content-Type: application/json');
        echo json_encode($result);
    }
}
