<?php
require_once __DIR__ . '/../config/database.php';

class ExamenModel {
    private $conn;
    private $table = "examen";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($num_examen) {
        $query = "SELECT * FROM " . $this->table . " WHERE num_examen = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $num_examen);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $query = "INSERT INTO " . $this->table . " 
                  SET num_examen=:num_examen, num_pregunta=:num_pregunta, fecha=:fecha";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":num_examen", $data['num_examen']);
        $stmt->bindParam(":num_pregunta", $data['num_pregunta']);
        $stmt->bindParam(":fecha", $data['fecha']);

        return $stmt->execute();
    }
}
?>