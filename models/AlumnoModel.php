<?php
require_once __DIR__ . '/../config/database.php';

class AlumnoModel {
    private $conn;
    private $table = "alumno";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Obtener todos los alumnos
    public function getAll() {
        $query = "SELECT a.*, g.nombre_grupo 
                  FROM " . $this->table . " a 
                  LEFT JOIN grupo g ON a.nombre_grupo = g.nombre_grupo";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener alumno por matrícula
    public function getById($matricula) {
        $query = "SELECT * FROM " . $this->table . " WHERE matricula = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $matricula);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear alumno
    public function create($data) {
        $query = "INSERT INTO " . $this->table . " 
                  SET matricula=:matricula, nombre=:nombre, nombre_grupo=:nombre_grupo";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":matricula", $data['matricula']);
        $stmt->bindParam(":nombre", $data['nombre']);
        $stmt->bindParam(":nombre_grupo", $data['nombre_grupo']);

        return $stmt->execute();
    }

    // Actualizar alumno
    public function update($matricula, $data) {
        $query = "UPDATE " . $this->table . " 
                  SET nombre=:nombre, nombre_grupo=:nombre_grupo 
                  WHERE matricula=:matricula";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nombre", $data['nombre']);
        $stmt->bindParam(":nombre_grupo", $data['nombre_grupo']);
        $stmt->bindParam(":matricula", $matricula);

        return $stmt->execute();
    }

    // Eliminar alumno
    public function delete($matricula) {
        $query = "DELETE FROM " . $this->table . " WHERE matricula = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $matricula);
        return $stmt->execute();
    }
}
?>