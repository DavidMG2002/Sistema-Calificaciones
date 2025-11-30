<?php
require_once __DIR__ . '/../models/ExamenModel.php';
require_once __DIR__ . '/../utils/Response.php';

class ExamenController {
    private $examenModel;

    public function __construct() {
        $this->examenModel = new ExamenModel();
    }

    // GET /examenes
    public function getAll() {
        try {
            $examenes = $this->examenModel->getAll();
            Response::sendSuccess($examenes);
        } catch (Exception $e) {
            Response::sendError("Error al obtener exámenes: " . $e->getMessage());
        }
    }

    // GET /examenes/{num_examen}
    public function getById($num_examen) {
        try {
            $examen = $this->examenModel->getById($num_examen);
            if ($examen) {
                Response::sendSuccess($examen);
            } else {
                Response::sendError("Examen no encontrado", 404);
            }
        } catch (Exception $e) {
            Response::sendError("Error al obtener examen: " . $e->getMessage());
        }
    }

    // POST /examenes
    public function create() {
        try {
            $data = json_decode(file_get_contents("php://input"), true);
            
            if (empty($data['num_examen']) || empty($data['num_pregunta']) || empty($data['fecha'])) {
                Response::sendError("Datos incompletos: num_examen, num_pregunta y fecha son requeridos", 400);
                return;
            }

            if ($this->examenModel->create($data)) {
                Response::sendSuccess("Examen creado exitosamente", 201);
            } else {
                Response::sendError("Error al crear examen");
            }
        } catch (Exception $e) {
            Response::sendError("Error: " . $e->getMessage());
        }
    }

    // PUT /examenes/{num_examen}
    public function update($num_examen) {
        try {
            $data = json_decode(file_get_contents("php://input"), true);
            if ($this->examenModel->update($num_examen, $data)) {
                Response::sendSuccess("Examen actualizado exitosamente");
            } else {
                Response::sendError("Error al actualizar examen");
            }
        } catch (Exception $e) {
            Response::sendError("Error: " . $e->getMessage());
        }
    }

    // DELETE /examenes/{num_examen}
    public function delete($num_examen) {
        try {
            if ($this->examenModel->delete($num_examen)) {
                Response::sendSuccess("Examen eliminado exitosamente");
            } else {
                Response::sendError("Error al eliminar examen");
            }
        } catch (Exception $e) {
            Response::sendError("Error: " . $e->getMessage());
        }
    }

    // GET /examenes/{num_examen}/alumnos
    public function getAlumnosByExamen($num_examen) {
        try {
            require_once __DIR__ . '/../models/RealizaModel.php';
            $realizaModel = new RealizaModel();
            $alumnos = $realizaModel->getByExamen($num_examen);
            Response::sendSuccess($alumnos);
        } catch (Exception $e) {
            Response::sendError("Error al obtener alumnos del examen: " . $e->getMessage());
        }
    }
}

?>
