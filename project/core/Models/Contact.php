<?php
namespace App\Models;

use App\Database;
use PDO;
use PDOException;

class Contact
{
    private PDO $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->GetPDO();
    }

    public function list(int $limit = 10, int $offset = 0): array
    {
        $sql = "SELECT SQL_CALC_FOUND_ROWS id, ime, prezime, email, phone, naslov, poruka, created_at
                FROM contacts
                ORDER BY created_at DESC
                LIMIT :limit OFFSET :offset";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $total = (int) $this->pdo->query("SELECT FOUND_ROWS()")->fetchColumn();

        return [$data, $total];
    }
    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM contacts WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
    public function create(array $data): bool
    {
        $sql = "INSERT INTO contacts (ime, prezime, email, phone, naslov, poruka)
                VALUES (:ime, :prezime, :email, :phone, :naslov, :poruka)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':ime' => $data['ime'],
            ':prezime' => $data['prezime'],
            ':email' => $data['email'],
            ':phone' => $data['phone'] ?? null, // handle nullable field
            ':naslov' => $data['naslov'],
            ':poruka' => $data['poruka'],
        ]);
    }

    public function count(): int
    {
        $sql = $this->pdo->query("SELECT COUNT(*) as total FROM contacts");
        $row = $sql->fetch(PDO::FETCH_ASSOC);

        return (int) $row['total'];
    }
}
