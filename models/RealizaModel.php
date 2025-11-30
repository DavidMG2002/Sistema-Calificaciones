<?php
require_once __DIR__ . '/../config/database.php';

class RealizaModel {
    private $conn;
    private $table = "realiza";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Obtener todos los registros de realización
    public function getAll() {
        $query = "SELECT r.*, a.nombre as nombre_alumno, e.fecha as fecha_examen
                  FROM " . $this->table . " r
                  JOIN alumno a ON r.matricula = a.matricula
                  JOIN examen e ON r.num_examen = e.num_examen
                  ORDER BY r.fecha_realizacion DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener realización específica
    public function getById($matricula, $num_examen) {
        $query = "SELECT r.*, a.nombre as nombre_alumno, e.fecha as fecha_examen
                  FROM " . $this->table . " r
                  JOIN alumno a ON r.matricula = a.matricula
                  JOIN examen e ON r.num_examen = e.num_examen
                  WHERE r.matricula = ? AND r.num_examen = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $matricula);
        $stmt->bindParam(2, $num_examen);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear registro de realización
    public function create($data) {
        $query = "INSERT INTO " . $this->table . " 
                  SET matricula=:matricula, num_examen=:num_examen, 
                      calificacion=:calificacion, fecha_realizacion=:fecha_realizacion";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":matricula", $data['matricula']);
        $stmt->bindParam(":num_examen", $data['num_examen']);
        $stmt->bindParam(":calificacion", $data['calificacion']);
        $stmt->bindParam(":fecha_realizacion", $data['fecha_realizacion']);

        return $stmt->execute();
    }

    // Actualizar realización
    public function update($matricula, $num_examen, $data) {
        $query = "UPDATE " . $this->table . " 
                  SET calificacion=:calificacion, fecha_realizacion=:fecha_realizacion
                  WHERE matricula=:matricula AND num_examen=:num_examen";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":calificacion", $data['calificacion']);
        $stmt->bindParam(":fecha_realizacion", $data['fecha_realizacion']);
        $stmt->bindParam(":matricula", $matricula);
        $stmt->bindParam(":num_examen", $num_examen);

        return $stmt->execute();
    }

    // Eliminar realización
    public function delete($matricula, $num_examen) {
        $query = "DELETE FROM " . $this->table . " WHERE matricula = ? AND num_examen = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $matricula);
        $stmt->bindParam(2, $num_examen);
        return $stmt->execute();
    }

    // Obtener exámenes realizados por un alumno
    public function getByAlumno($matricula) {
        $query = "SELECT r.*, e.fecha, e.num_pregunta
                  FROM " . $this->table . " r
                  JOIN examen e ON r.num_examen = e.num_examen
                  WHERE r.matricula = ?
                  ORDER BY r.fecha_realizacion DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $matricula);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener alumnos que realizaron un examen
    public function getByExamen($num_examen) {
        $query = "SELECT r.*, a.nombre, a.nombre_grupo
                  FROM " . $this->table . " r
                  JOIN alumno a ON r.matricula = a.matricula
                  WHERE r.num_examen = ?
                  ORDER BY a.nombre";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $num_examen);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener estadísticas de un examen
    public function getEstadisticasExamen($num_examen) {
        $query = "SELECT 
                    COUNT(*) as total_realizaciones,
                    AVG(calificacion) as promedio_calificacion,
                    MAX(calificacion) as maxima_calificacion,
                    MIN(calificacion) as minima_calificacion,
                    COUNT(CASE WHEN calificacion >= 3.0 THEN 1 END) as aprobados,
                    COUNT(CASE WHEN calificacion < 3.0 THEN 1 END) as reprobados
                  FROM " . $this->table . " 
                  WHERE num_examen = ? AND calificacion IS NOT NULL";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $num_examen);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Verificar si ya existe el registro
    public function exists($matricula, $num_examen) {
        $query = "SELECT COUNT(*) as count FROM " . $this->table . " 
                  WHERE matricula = ? AND num_examen = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $matricula);
        $stmt->bindParam(2, $num_examen);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0;
    }
}
?>