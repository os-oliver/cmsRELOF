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

    public function list(
        int $limit = 10,
        int $offset = 0,
        ?string $sortColumn = 'created_at',
        string $sortDirection = 'DESC',
        array $filters = []
    ): array {
        // Dozvoljene kolone za sortiranje
        $allowedSortColumns = ['id', 'ime', 'prezime', 'email', 'phone', 'naslov', 'created_at'];
        $sortColumn = in_array($sortColumn, $allowedSortColumns) ? $sortColumn : 'created_at';
        $sortDirection = strtoupper($sortDirection) === 'ASC' ? 'ASC' : 'DESC';

        // Osnovni SQL upit
        $sql = "SELECT SQL_CALC_FOUND_ROWS id, ime, prezime, email, phone, naslov, poruka, created_at
            FROM contacts
            WHERE 1=1";

        // Dinamično dodavanje filtera
        $params = [];
        $conditions = [];
        $params = [];

        if (!empty($filters['ime'])) {
            $conditions[] = "ime LIKE :ime";
            $params[':ime'] = '%' . $filters['ime'] . '%';
        }
        if (!empty($filters['prezime'])) {
            $conditions[] = "prezime LIKE :prezime";
            $params[':prezime'] = '%' . $filters['prezime'] . '%';
        }
        if (!empty($filters['email'])) {
            $conditions[] = "email LIKE :email";
            $params[':email'] = '%' . $filters['email'] . '%';
        }

        if (!empty($conditions)) {
            $sql .= " AND (" . implode(" OR ", $conditions) . ")";
        }


        // Sortiranje i paginacija
        $sql .= " ORDER BY $sortColumn $sortDirection
              LIMIT :limit OFFSET :offset";

        $stmt = $this->pdo->prepare($sql);

        // Vezivanje filter parametara
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }

        // Paginacija
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
