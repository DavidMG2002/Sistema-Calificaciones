<?php
require_once __DIR__ . '/../models/AlumnoModel.php';
require_once __DIR__ . '/../utils/Response.php';

class AlumnoController {
    private $alumnoModel;

    public function __construct() {
        $this->alumnoModel = new AlumnoModel();
    }

    // GET /alumnos
    public function getAll() {
        try {
            $alumnos = $this->alumnoModel->getAll();
            Response::sendSuccess($alumnos);
        } catch (Exception $e) {
            Response::sendError("Error al obtener alumnos: " . $e->getMessage());
        }
    }

    // GET /alumnos/{matricula}
    public function getById($matricula) {
        try {
            $alumno = $this->alumnoModel->getById($matricula);
            if ($alumno) {
                Response::sendSuccess($alumno);
            } else {
                Response::sendError("Alumno no encontrado", 404);
            }
        } catch (Exception $e) {
            Response::sendError("Error al obtener alumno: " . $e->getMessage());
        }
    }

    // POST /alumnos
    public function create() {
        try {
            $data = json_decode(file_get_contents("php://input"), true);
            
            // Validaciones básicas
            if (empty($data['matricula']) || empty($data['nombre'])) {
                Response::sendError("Datos incompletos", 400);
                return;
            }

            if ($this->alumnoModel->create($data)) {
                Response::sendSuccess("Alumno creado exitosamente", 201);
            } else {
                Response::sendError("Error al crear alumno");
            }
        } catch (Exception $e) {
            Response::sendError("Error: " . $e->getMessage());
        }
    }

    // PUT /alumnos/{matricula}
    public function update($matricula) {
        try {
            $data = json_decode(file_get_contents("php://input"), true);
            
            if ($this->alumnoModel->update($matricula, $data)) {
                Response::sendSuccess("Alumno actualizado exitosamente");
            } else {
                Response::sendError("Error al actualizar alumno");
            }
        } catch (Exception $e) {
            Response::sendError("Error: " . $e->getMessage());
        }
    }

    // DELETE /alumnos/{matricula}
    public function delete($matricula) {
        try {
            if ($this->alumnoModel->delete($matricula)) {
                Response::sendSuccess("Alumno eliminado exitosamente");
            } else {
                Response::sendError("Error al eliminar alumno");
            }
        } catch (Exception $e) {
            Response::sendError("Error: " . $e->getMessage());
        }
    }
}
?>