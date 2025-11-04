<?php
namespace App\Controllers;

use App\Models\User;

class AuthController
{
    public function auth()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $data = (new User())->auth(data: $data);
        http_response_code(201);
        echo json_encode($data);
    }
    public static function getUserInfo(): array
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        foreach ($_SESSION as $key => $value) {
            error_log('' . $key . ':' . $value);
        }
        $name = $_SESSION['name'] ?? null;
        $surname = $_SESSION['surname'] ?? null;
        $role = $_SESSION['role'] ?? null;
        if ($name && $surname && $role) {
            return [
                $name,
                $surname,
                $role
            ];
        } else {
            return ['', '', ''];
        }
    }
    public static function logout(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        // Unset all session variables
        $_SESSION = [];

        // Destroy the session
        session_destroy();

        // Optionally clear the session cookie
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        // Redirect after logout
        header("Location: /login");
        exit;
    }

    protected static function requireRole(array $allowedRoles): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $role = $_SESSION['role'] ?? null;
        if (!in_array($role, $allowedRoles, true)) {
            http_response_code(403);
            exit(include dirname(__DIR__) . '/../public/pages/forbidden.html');
        }
    }

    public static function requireAdmin(): void
    {
        self::requireRole([User::ROLE_ADMIN]);
    }


    public static function requireEditor(): void
    {
        self::requireRole([User::ROLE_EDITOR, User::ROLE_ADMIN]);
    }
}
