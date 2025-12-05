<?php
require_once __DIR__ . '/../models/ProfesorModel.php';
require_once __DIR__ . '/../utils/Response.php';

class ProfesorController {
    private $profesorModel;

    public function __construct() {
        $this->profesorModel = new ProfesorModel();
    }

    public function getAll() {
        try {
            $profesores = $this->profesorModel->getAll();
            Response::sendSuccess($profesores);
        } catch (Exception $e) {
            Response::sendError("Error al obtener profesores: " . $e->getMessage());
        }
    }

    public function getById($dni) {
        try {
            $profesor = $this->profesorModel->getById($dni);
            if ($profesor) {
                Response::sendSuccess($profesor);
            } else {
                Response::sendError("Profesor no encontrado", 404);
            }
        } catch (Exception $e) {
            Response::sendError("Error al obtener profesor: " . $e->getMessage());
        }
    }

    public function create() {
        try {
            $data = json_decode(file_get_contents("php://input"), true);
            
            if (empty($data['dni']) || empty($data['nombre'])) {
                Response::sendError("Datos incompletos", 400);
                return;
            }

            if ($this->profesorModel->create($data)) {
                Response::sendSuccess("Profesor creado exitosamente", 201);
            } else {
                Response::sendError("Error al crear profesor");
            }
        } catch (Exception $e) {
            Response::sendError("Error: " . $e->getMessage());
        }
    }

    public function update($dni) {
        try {
            $data = json_decode(file_get_contents("php://input"), true);
            
            if ($this->profesorModel->update($dni, $data)) {
                Response::sendSuccess("Profesor actualizado exitosamente");
            } else {
                Response::sendError("Error al actualizar profesor");
            }
        } catch (Exception $e) {
            Response::sendError("Error: " . $e->getMessage());
        }
    }

    public function delete($dni) {
        try {
            if ($this->profesorModel->delete($dni)) {
                Response::sendSuccess("Profesor eliminado exitosamente");
            } else {
                Response::sendError("Error al eliminar profesor");
            }
        } catch (Exception $e) {
            Response::sendError("Error: " . $e->getMessage());
        }
    }
}
?>