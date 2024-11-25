<?php
class Cursos {
    private $conn;
    private $table = 'cursos';

    public $idcursos;
    public $cursosnome;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT * FROM {$this->table}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create() {
        $query = "INSERT INTO {$this->table} (nome) VALUES (:cursosnome)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':cursosnome', $this->cursosnome);
        return $stmt->execute();
    }

    public function update() {
        $query = "UPDATE {$this->table} SET nome = :cursosnome WHERE id = :idcursos";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':idcursos', $this->idcursos);
        $stmt->bindParam(':cursosnome', $this->cursosnome);
        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM {$this->table} WHERE id = :idcursos";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':idcursos', $this->idcursos);
        return $stmt->execute();
    }
}
?>
