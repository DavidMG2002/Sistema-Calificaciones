<?php
require_once __DIR__ . '/../models/PracticaModel.php';
require_once __DIR__ . '/../utils/Response.php';

class PracticaController {
    private $practicaModel;

    public function __construct() {
        $this->practicaModel = new PracticaModel();
    }

    // GET /practicas
    public function getAll() {
        try {
            $practicas = $this->practicaModel->getAll();
            Response::sendSuccess($practicas);
        } catch (Exception $e) {
            Response::sendError("Error al obtener prácticas: " . $e->getMessage());
        }
    }

    // GET /practicas/{cod_practica}
    public function getById($cod_practica) {
        try {
            $practica = $this->practicaModel->getById($cod_practica);
            if ($practica) {
                Response::sendSuccess($practica);
            } else {
                Response::sendError("Práctica no encontrada", 404);
            }
        } catch (Exception $e) {
            Response::sendError("Error al obtener práctica: " . $e->getMessage());
        }
    }

    // POST /practicas
    public function create() {
        try {
            $data = json_decode(file_get_contents("php://input"), true);
            
            // Validaciones
            $required = ['cod_practica', 'titulo', 'grado_dificultad', 'dni_profesor'];
            foreach ($required as $field) {
                if (empty($data[$field])) {
                    Response::sendError("Campo requerido: $field", 400);
                    return;
                }
            }

            if ($this->practicaModel->create($data)) {
                Response::sendSuccess("Práctica creada exitosamente", 201);
            } else {
                Response::sendError("Error al crear práctica");
            }
        } catch (Exception $e) {
            Response::sendError("Error: " . $e->getMessage());
        }
    }

    // PUT /practicas/{cod_practica}
    public function update($cod_practica) {
        try {
            $data = json_decode(file_get_contents("php://input"), true);
            
            if ($this->practicaModel->update($cod_practica, $data)) {
                Response::sendSuccess("Práctica actualizada exitosamente");
            } else {
                Response::sendError("Error al actualizar práctica");
            }
        } catch (Exception $e) {
            Response::sendError("Error: " . $e->getMessage());
        }
    }

    // DELETE /practicas/{cod_practica}
    public function delete($cod_practica) {
        try {
            if ($this->practicaModel->delete($cod_practica)) {
                Response::sendSuccess("Práctica eliminada exitosamente");
            } else {
                Response::sendError("Error al eliminar práctica");
            }
        } catch (Exception $e) {
            Response::sendError("Error: " . $e->getMessage());
        }
    }

    // GET /practicas/{cod_practica}/alumnos - Alumnos que presentaron una práctica
    public function getAlumnosByPractica($cod_practica) {
        try {
            $alumnos = $this->practicaModel->getAlumnosByPractica($cod_practica);
            Response::sendSuccess($alumnos);
        } catch (Exception $e) {
            Response::sendError("Error al obtener alumnos de la práctica: " . $e->getMessage());
        }
    }

    // GET /practicas/profesor/{dni_profesor} - Prácticas de un profesor
    public function getByProfesor($dni_profesor) {
        try {
            $practicas = $this->practicaModel->getByProfesor($dni_profesor);
            Response::sendSuccess($practicas);
        } catch (Exception $e) {
            Response::sendError("Error al obtener prácticas del profesor: " . $e->getMessage());
        }
    }
}
?>