<?php
require_once __DIR__ . '/../config/database.php';

class GrupoModel {
    private $conn;
    private $table = "grupo";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY nombre_grupo";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $query = "INSERT INTO " . $this->table . " SET nombre_grupo=:nombre_grupo";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nombre_grupo", $data['nombre_grupo']);
        return $stmt->execute();
    }
}
?>