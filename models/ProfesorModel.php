<?php
require_once __DIR__ . '/../config/database.php';

class ProfesorModel {
    private $conn;
    private $table = "profesor";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY nombre";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($dni) {
        $query = "SELECT * FROM " . $this->table . " WHERE dni = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $dni);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $query = "INSERT INTO " . $this->table . " SET dni=:dni, nombre=:nombre";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":dni", $data['dni']);
        $stmt->bindParam(":nombre", $data['nombre']);
        return $stmt->execute();
    }

    public function update($dni, $data) {
        $query = "UPDATE " . $this->table . " SET nombre=:nombre WHERE dni=:dni";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nombre", $data['nombre']);
        $stmt->bindParam(":dni", $dni);
        return $stmt->execute();
    }

    public function delete($dni) {
        $query = "DELETE FROM " . $this->table . " WHERE dni = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $dni);
        return $stmt->execute();
    }
}
?>