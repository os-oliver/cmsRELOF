<?php
// src/Database.php

namespace App;

use PDO;
use PDOException;
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
use RuntimeException;
class Database
{
    private PDO $pdo;

    public function __construct()
    {



        $host = $_ENV['DB_HOST'] ?? getenv('DB_HOST');
        $port = $_ENV['DB_PORT'] ?? getenv('DB_PORT') ?: 3306;
        $db = $_ENV['DB_NAME'] ?? getenv('DB_NAME');
        $user = $_ENV['DB_USER'] ?? getenv('DB_USER');
        $pass = $_ENV['DB_PASS'] ?? getenv('DB_PASS');

        $dsn = "mysql:host={$host};port={$port};dbname={$db};charset=utf8mb4";
        error_log("dns:" . $dsn);
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $user, $pass, $options);
        } catch (PDOException $e) {
            error_log('
            DB connection error: ' . $e->getMessage());
            throw new RuntimeException('Database connection failed.');
        }
    }

    public function GetPDO(): PDO
    {
        return $this->pdo;
    }

    public function query(string $sql, array $params = []): \PDOStatement
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function getAllEvents(): array
    {
        return $this->pdo
            ->query("SELECT * FROM events")
            ->fetchAll(PDO::FETCH_ASSOC);
    }

}
