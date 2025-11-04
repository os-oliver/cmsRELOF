<?php
namespace App\Models;

use App\Database;

class User
{
    public const ROLE_ADMIN = 'admin';
    public const ROLE_EDITOR = 'editor';

    private \PDO $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->GetPDO();
    }

    public static function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function update(int $id, array $data): array
    {
        $fields = [];
        $params = [':id' => $id];

        if (!empty($data['username'])) {
            $fields[] = 'username = :username';
            $params[':username'] = $data['username'];
        }

        if (!empty($data['password'])) {
            $fields[] = 'password = :password';
            $params[':password'] = self::hashPassword($data['password']);
        }

        if (!empty($data['role'])) {
            $fields[] = 'role = :role';
            $params[':role'] = $data['role'];
        }

        if (!empty($data['name'])) {
            $fields[] = 'name = :name';
            $params[':name'] = $data['name'];
        }

        if (!empty($data['surname'])) {
            $fields[] = 'surname = :surname';
            $params[':surname'] = $data['surname'];
        }

        if (empty($fields)) {
            return [
                'success' => false,
                'message' => 'No fields provided to update.',
            ];
        }

        $sql = 'UPDATE users SET ' . implode(', ', $fields) . ' WHERE id = :id';

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);

            return [
                'success' => true,
                'message' => 'User updated successfully.',
            ];
        } catch (\PDOException $e) {
            return [
                'success' => false,
                'message' => 'Error updating user: ' . $e->getMessage(),
            ];
        }
    }

    public function delete(int $id): array
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = :id");
            $stmt->execute([':id' => $id]);

            if ($stmt->rowCount() === 0) {
                return [
                    'success' => false,
                    'message' => 'No user found with that ID.',
                ];
            }

            return [
                'success' => true,
                'message' => 'User deleted successfully.',
            ];
        } catch (\PDOException $e) {
            return [
                'success' => false,
                'message' => 'Error deleting user: ' . $e->getMessage(),
            ];
        }
    }
    public function create(array $data): array
    {
        $username = $data['username'] ?? '';
        $password = $data['password'] ?? '';
        $name = $data['name'] ?? '';
        $surname = $data['surname'] ?? '';
        $role = $data['role'] ?? self::ROLE_EDITOR;

        // Hash the password
        $hashed = self::hashPassword($password);

        try {
            $stmt = $this->pdo->prepare("
                INSERT INTO users (username, password, role,created_at,name,surname)
                VALUES (:username, :password, :role,NOW(),:name,:surname)
            ");
            $stmt->execute([
                ':username' => $username,
                ':password' => $hashed,
                ':role' => $role,
                ':name' => $name,
                ':surname' => $surname,

            ]);

            return [
                'success' => true,
                'message' => 'User created successfully.',
                'user_id' => (int) $this->pdo->lastInsertId(),
            ];
        } catch (\PDOException $e) {
            // You might want to check $e->getCode() === '23000' for duplicate username
            return [
                'success' => false,
                'message' => 'Error creating user: ' . $e->getMessage(),
                'user_id' => null,
            ];
        }
    }
    public function list(
        int $limit = 10,
        int $offset = 0,
        string $search = '',
        string $sort = 'date_desc'
    ): array {
        $sql = "SELECT SQL_CALC_FOUND_ROWS id, username, role, name, surname, created_at"
            . " FROM users"
            . " WHERE 1=1";

        $params = [':limit' => $limit, ':offset' => $offset];

        if ($search !== '') {
            $sql .= " AND (username LIKE :search OR name LIKE :search OR surname LIKE :search)";
            $params[':search'] = "%{$search}%";
        }

        $sql .= match ($sort) {
            'date_asc' => " ORDER BY created_at ASC",
            'username' => " ORDER BY username ASC",
            'name' => " ORDER BY name ASC",
            default => " ORDER BY created_at DESC",
        };

        $sql .= " LIMIT :limit OFFSET :offset";

        $stmt = $this->pdo->prepare($sql);
        foreach ($params as $key => $val) {
            $type = in_array($key, [':limit', ':offset']) ? \PDO::PARAM_INT : \PDO::PARAM_STR;
            $stmt->bindValue($key, $val, $type);
        }

        $stmt->execute();
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $total = (int) $this->pdo->query("SELECT FOUND_ROWS()")->fetchColumn();

        return [$data, $total];
    }

    public function auth(array $data): array
    {
        $username = $data['username'] ?? '';
        $password = $data['password'] ?? '';

        // Fetch user row
        $stmt = $this->pdo->prepare(
            'SELECT id, password, role,name, surname
         FROM users 
         WHERE username = :username'
        );
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$user) {
            return [
                'success' => false,
                'message' => 'Invalid username or password.',
            ];
        }

        if (!password_verify($password, $user['password'])) {
            return [
                'success' => false,
                'message' => 'Invalid username or password.',
            ];
        }

        // Set session cookie params BEFORE starting the session
        session_set_cookie_params([
            'lifetime' => 86400,
            'path' => '/',
            'httponly' => true,
            'samesite' => 'Strict',
        ]);

        session_start();
        session_regenerate_id(true);

        $_SESSION['user_id'] = (int) $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['surname'] = $user['surname'];

        return [
            'success' => true,
            'user_id' => (int) $user['id'],
            'role' => $user['role'],
        ];
    }

    public static function isAdmin(): bool
    {
        return isset($_SESSION['role'])
            && $_SESSION['role'] === self::ROLE_ADMIN;
    }

    public static function isEditor(): bool
    {
        return isset($_SESSION['role'])
            && $_SESSION['role'] === self::ROLE_EDITOR;
    }


}
?>