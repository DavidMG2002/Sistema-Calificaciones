<?php
require_once __DIR__ . '/../config/database.php';

class PracticaModel {
    private $conn;
    private $table = "practica";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Obtener todas las prácticas
    public function getAll() {
        $query = "SELECT p.*, pr.nombre as nombre_profesor 
                  FROM " . $this->table . " p 
                  LEFT JOIN profesor pr ON p.dni_profesor = pr.dni 
                  ORDER BY p.cod_practica";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener práctica por código
    public function getById($cod_practica) {
        $query = "SELECT p.*, pr.nombre as nombre_profesor 
                  FROM " . $this->table . " p 
                  LEFT JOIN profesor pr ON p.dni_profesor = pr.dni 
                  WHERE p.cod_practica = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $cod_practica);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear práctica
    public function create($data) {
        $query = "INSERT INTO " . $this->table . " 
                  SET cod_practica=:cod_practica, titulo=:titulo, 
                      grado_dificultad=:grado_dificultad, dni_profesor=:dni_profesor";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":cod_practica", $data['cod_practica']);
        $stmt->bindParam(":titulo", $data['titulo']);
        $stmt->bindParam(":grado_dificultad", $data['grado_dificultad']);
        $stmt->bindParam(":dni_profesor", $data['dni_profesor']);

        return $stmt->execute();
    }

    // Actualizar práctica
    public function update($cod_practica, $data) {
        $query = "UPDATE " . $this->table . " 
                  SET titulo=:titulo, grado_dificultad=:grado_dificultad, 
                      dni_profesor=:dni_profesor 
                  WHERE cod_practica=:cod_practica";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":titulo", $data['titulo']);
        $stmt->bindParam(":grado_dificultad", $data['grado_dificultad']);
        $stmt->bindParam(":dni_profesor", $data['dni_profesor']);
        $stmt->bindParam(":cod_practica", $cod_practica);

        return $stmt->execute();
    }

    // Eliminar práctica
    public function delete($cod_practica) {
        $query = "DELETE FROM " . $this->table . " WHERE cod_practica = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $cod_practica);
        return $stmt->execute();
    }

    // Obtener alumnos que presentaron una práctica
    public function getAlumnosByPractica($cod_practica) {
        $query = "SELECT a.matricula, a.nombre, p.fecha_presentacion, p.calificacion 
                  FROM presenta p 
                  JOIN alumno a ON p.matricula = a.matricula 
                  WHERE p.cod_practica = ? 
                  ORDER BY p.fecha_presentacion";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $cod_practica);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener prácticas de un profesor
    public function getByProfesor($dni_profesor) {
        $query = "SELECT * FROM " . $this->table . " 
                  WHERE dni_profesor = ? 
                  ORDER BY cod_practica";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $dni_profesor);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener estadísticas de una práctica
    public function getEstadisticas($cod_practica) {
        $query = "SELECT 
                    COUNT(*) as total_presentaciones,
                    AVG(calificacion) as promedio_calificacion,
                    MAX(calificacion) as maxima_calificacion,
                    MIN(calificacion) as minima_calificacion
                  FROM presenta 
                  WHERE cod_practica = ? AND calificacion IS NOT NULL";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $cod_practica);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>