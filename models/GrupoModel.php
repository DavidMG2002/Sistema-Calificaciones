<?php
require_once __DIR__ . '/../config/database.php';

class GrupoModel {
    private $conn;
    private $table = "grupo";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Obtener todos los grupos
    public function getAll() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY nombre_grupo";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener grupo por nombre
    public function getById($nombre_grupo) {
        $query = "SELECT * FROM " . $this->table . " WHERE nombre_grupo = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $nombre_grupo);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear grupo
    public function create($data) {
        $query = "INSERT INTO " . $this->table . " SET nombre_grupo = :nombre_grupo";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nombre_grupo", $data['nombre_grupo']);
        return $stmt->execute();
    }

    // Actualizar grupo
    public function update($nombre_grupo, $data) {
        $query = "UPDATE " . $this->table . " SET nombre_grupo = :nuevo_nombre WHERE nombre_grupo = :nombre_grupo";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nuevo_nombre", $data['nombre_grupo']);
        $stmt->bindParam(":nombre_grupo", $nombre_grupo);
        return $stmt->execute();
    }

    // Eliminar grupo
    public function delete($nombre_grupo) {
        $query = "DELETE FROM " . $this->table . " WHERE nombre_grupo = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $nombre_grupo);
        return $stmt->execute();
    }

    // Obtener alumnos de un grupo específico
    public function getAlumnosByGrupo($nombre_grupo) {
        $query = "SELECT matricula, nombre FROM alumno WHERE nombre_grupo = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $nombre_grupo);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener estadísticas del grupo
    public function getEstadisticas($nombre_grupo) {
        $query = "SELECT 
                    COUNT(*) as total_alumnos,
                    (SELECT COUNT(*) FROM realiza r 
                     JOIN alumno a ON r.matricula = a.matricula 
                     WHERE a.nombre_grupo = ?) as total_examenes_realizados,
                    (SELECT COUNT(*) FROM presenta p 
                     JOIN alumno a ON p.matricula = a.matricula 
                     WHERE a.nombre_grupo = ?) as total_practicas_presentadas
                  FROM alumno 
                  WHERE nombre_grupo = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $nombre_grupo);
        $stmt->bindParam(2, $nombre_grupo);
        $stmt->bindParam(3, $nombre_grupo);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>