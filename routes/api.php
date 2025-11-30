<?php

require_once __DIR__ . '/../controllers/AlumnoController.php';
require_once __DIR__ . '/../controllers/ExamenController.php';
require_once __DIR__ . '/../utils/Response.php';

class Router {

    public function route() {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Detectar la carpeta base automáticamente
        $baseFolder = '/' . basename(__DIR__ . '/..');
        $path = str_replace($baseFolder, '', $path);

        switch (true) {

            // GET /alumnos
            case ($path === "/alumnos" && $method === "GET"):
                (new AlumnoController())->getAll();
                break;

            // POST /alumnos
            case ($path === "/alumnos" && $method === "POST"):
                (new AlumnoController())->create();
                break;

            // GET /alumnos/{id}
            case preg_match('/^\/alumnos\/(\d+)$/', $path, $m) && $method === "GET":
                (new AlumnoController())->getById($m[1]);
                break;

            // GET /examenes
            case ($path === "/examenes" && $method === "GET"):
                (new ExamenController())->getAll();
                break;

            default:
                Response::sendError("Endpoint no encontrado", 404);
                break;
        }
    }
}

?>
