<?php
require_once __DIR__ . '/../config/database.php';

class ProfesorModel {
    private $conn;
    private $table = "profesor";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Obtener todos los profesores
    public function getAll() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY nombre";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener profesor por DNI
    public function getById($dni) {
        $query = "SELECT * FROM " . $this->table . " WHERE dni = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $dni);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear profesor
    public function create($data) {
        $query = "INSERT INTO " . $this->table . " SET dni=:dni, nombre=:nombre";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":dni", $data['dni']);
        $stmt->bindParam(":nombre", $data['nombre']);
        return $stmt->execute();
    }

    // Actualizar profesor
    public function update($dni, $data) {
        $query = "UPDATE " . $this->table . " SET nombre=:nombre WHERE dni=:dni";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nombre", $data['nombre']);
        $stmt->bindParam(":dni", $dni);
        return $stmt->execute();
    }

    // Eliminar profesor
    public function delete($dni) {
        $query = "DELETE FROM " . $this->table . " WHERE dni = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $dni);
        return $stmt->execute();
    }

    // Obtener prácticas diseñadas por un profesor
    public function getPracticasByProfesor($dni) {
        $query = "SELECT p.cod_practica, p.titulo, p.grado_dificultad,
                         COUNT(pr.matricula) as total_presentaciones,
                         AVG(pr.calificacion) as promedio_calificacion
                  FROM practica p 
                  LEFT JOIN presenta pr ON p.cod_practica = pr.cod_practica
                  WHERE p.dni_profesor = ?
                  GROUP BY p.cod_practica, p.titulo, p.grado_dificultad
                  ORDER BY p.cod_practica";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $dni);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener estadísticas del profesor
    public function getEstadisticas($dni) {
        $query = "SELECT 
                    (SELECT COUNT(*) FROM practica WHERE dni_profesor = ?) as total_practicas,
                    (SELECT COUNT(DISTINCT pr.matricula) 
                     FROM presenta pr 
                     JOIN practica p ON pr.cod_practica = p.cod_practica 
                     WHERE p.dni_profesor = ?) as total_alumnos_unicos,
                    (SELECT AVG(pr.calificacion) 
                     FROM presenta pr 
                     JOIN practica p ON pr.cod_practica = p.cod_practica 
                     WHERE p.dni_profesor = ? AND pr.calificacion IS NOT NULL) as promedio_general";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $dni);
        $stmt->bindParam(2, $dni);
        $stmt->bindParam(3, $dni);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Verificar si el profesor existe
    public function exists($dni) {
        $query = "SELECT COUNT(*) as count FROM " . $this->table . " WHERE dni = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $dni);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0;
    }
}
?>