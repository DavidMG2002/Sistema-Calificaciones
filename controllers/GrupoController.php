<?php
require_once __DIR__ . '/../models/GrupoModel.php';
require_once __DIR__ . '/../utils/Response.php';

class GrupoController {
    private $grupoModel;

    public function __construct() {
        $this->grupoModel = new GrupoModel();
    }

    // GET /grupos
    public function getAll() {
        try {
            $grupos = $this->grupoModel->getAll();
            Response::sendSuccess($grupos);
        } catch (Exception $e) {
            Response::sendError("Error al obtener grupos: " . $e->getMessage());
        }
    }

    // GET /grupos/{nombre_grupo}
    public function getById($nombre_grupo) {
        try {
            $grupo = $this->grupoModel->getById($nombre_grupo);
            if ($grupo) {
                Response::sendSuccess($grupo);
            } else {
                Response::sendError("Grupo no encontrado", 404);
            }
        } catch (Exception $e) {
            Response::sendError("Error al obtener grupo: " . $e->getMessage());
        }
    }

    // POST /grupos
    public function create() {
        try {
            $data = json_decode(file_get_contents("php://input"), true);
            
            if (empty($data['nombre_grupo'])) {
                Response::sendError("El nombre del grupo es requerido", 400);
                return;
            }

            if ($this->grupoModel->create($data)) {
                Response::sendSuccess("Grupo creado exitosamente", 201);
            } else {
                Response::sendError("Error al crear grupo");
            }
        } catch (Exception $e) {
            Response::sendError("Error: " . $e->getMessage());
        }
    }

    // PUT /grupos/{nombre_grupo}
    public function update($nombre_grupo) {
        try {
            $data = json_decode(file_get_contents("php://input"), true);
            
            if ($this->grupoModel->update($nombre_grupo, $data)) {
                Response::sendSuccess("Grupo actualizado exitosamente");
            } else {
                Response::sendError("Error al actualizar grupo");
            }
        } catch (Exception $e) {
            Response::sendError("Error: " . $e->getMessage());
        }
    }

    // DELETE /grupos/{nombre_grupo}
    public function delete($nombre_grupo) {
        try {
            if ($this->grupoModel->delete($nombre_grupo)) {
                Response::sendSuccess("Grupo eliminado exitosamente");
            } else {
                Response::sendError("Error al eliminar grupo");
            }
        } catch (Exception $e) {
            Response::sendError("Error: " . $e->getMessage());
        }
    }

    // GET /grupos/{nombre_grupo}/alumnos - Alumnos de un grupo específico
    public function getAlumnosByGrupo($nombre_grupo) {
        try {
            $alumnos = $this->grupoModel->getAlumnosByGrupo($nombre_grupo);
            Response::sendSuccess($alumnos);
        } catch (Exception $e) {
            Response::sendError("Error al obtener alumnos del grupo: " . $e->getMessage());
        }
    }
}
?>