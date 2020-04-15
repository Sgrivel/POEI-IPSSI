<?php

namespace App\Manager;

use App\Table\Exception\NotFoundException;
use Exception;
use PDO;

abstract class Manager {

    protected $pdo;

    protected $table = null;

    protected $class = null;

    public function __construct(PDO $pdo)
    {
        if ($this->table === null) {
            throw new Exception("La classe " . get_class($this) . "n'a pas de propriété \$table");
        }
        if ($this->class === null) {
            throw new Exception("La classe " . get_class($this) . " n'a pas de propriété \$class");
        }
        $this->pdo = $pdo;
    }

    public function find(int $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $query->execute([":id" => $id]);
        $query->setFetchMode(PDO::FETCH_CLASS, $this->class);
        $result = $query->fetch();
        if ($result === false) {
            throw new NotFoundException($this->table, $id);
        }
        return $result;
    }
    
    /**
     * exists
     *
     * @param  string $field    Champs a rechercher
     * @param  mixed $value     Valeur associée au champs
     * @return bool
     * 
     * Vérifie si une valeur existe pour un champ donné dans la table
     */
    public function exists(string $field, $value, ?int $except = null): bool 
    {
        $claddId = "{$this->table}_id";
        $sql = "SELECT COUNT($claddId) FROM {$this->table} WHERE {$field} = ?";
        $params = [$value];
        if ($except !== null) {
            $sql .= " AND $claddId != ?";
            $params[] = $except;
        }
        $query = $this->pdo->prepare($sql);
        $query->execute($params);
        return (int)$query->fetch(PDO::FETCH_NUM)[0] > 0;
    }

    public function all(): array {
        $sql = "SELECT * FROM {$this->table} ORDER BY id DESC";
        return $this->queryAndFetchAll($sql);
    }

    public function delete(int $id): void 
    {
        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $state = $query->execute([":id" => $id]);
        if ($state === false) {
            throw new Exception("Impossible de supprimer l'enregistrement $id dans la table {$this->table}");
        }
    }

    public function create(array $data): int
    {
        $sqlFields = [];
        foreach ($data as $key => $value) {
            $sqlFields[] = "$key = :$key";
        }
        $query = $this->pdo->prepare("INSERT INTO {$this->table} SET " . implode(", ", $sqlFields));
        $state = $query->execute($data);
        if ($state === false) {
            throw new Exception("Impossible de créer l'enregistrement dans la table {$this->table}");
        }
        return (int)$this->pdo->lastInsertId();
    }

    public function update(array $data, int $id) {
        $sqlFields = [];
        foreach ($data as $key => $value) {
            $sqlFields[] = "$key = :$key";
        }
        $query = $this->pdo->prepare("UPDATE {$this->table} SET " . implode(", ", $sqlFields) . " WHERE id = :id");
        $state = $query->execute(array_merge($data, ["id" => (int)$id]));
        if ($state === false) {
            throw new Exception("Impossible de modifier l'enregistrement dans la table {$this->table}");
        }
    }

    protected function queryAndFetchAll(string $sql): array {
        return $this->pdo->query($sql, PDO::FETCH_CLASS, $this->class)->fetchAll();
    }
}

?>