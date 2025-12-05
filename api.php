<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require_once __DIR__ . '/controllers/AlumnoController.php';
require_once __DIR__ . '/controllers/ExamenController.php';
require_once __DIR__ . '/controllers/ProfesorController.php';
require_once __DIR__ . '/controllers/PracticaController.php';
require_once __DIR__ . '/controllers/GrupoController.php';
require_once __DIR__ . '/utils/Response.php';

class Router {

    public function route() {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Remover la carpeta del proyecto y api.php de la ruta
        $path = str_replace('/examenes_proyecto', '', $path);
        $path = str_replace('/api.php', '', $path);
        
        // Si la ruta está vacía, mostrar endpoints disponibles
        if (empty($path) || $path === '/') {
            Response::sendError("Endpoints disponibles: /alumnos, /profesores, /examenes, /practicas, /grupos", 404);
            return;
        }

        switch (true) {

            // ============ ALUMNOS ============
            case ($path === "/alumnos" && $method === "GET"):
                (new AlumnoController())->getAll();
                break;

            case ($path === "/alumnos" && $method === "POST"):
                (new AlumnoController())->create();
                break;

            case preg_match('/^\/alumnos\/(\d+)$/', $path, $m) && $method === "GET":
                (new AlumnoController())->getById($m[1]);
                break;

            case preg_match('/^\/alumnos\/(\d+)$/', $path, $m) && $method === "PUT":
                (new AlumnoController())->update($m[1]);
                break;

            case preg_match('/^\/alumnos\/(\d+)$/', $path, $m) && $method === "DELETE":
                (new AlumnoController())->delete($m[1]);
                break;

            // ============ PROFESORES ============
            case ($path === "/profesores" && $method === "GET"):
                (new ProfesorController())->getAll();
                break;

            case ($path === "/profesores" && $method === "POST"):
                (new ProfesorController())->create();
                break;

            case preg_match('/^\/profesores\/(\d+)$/', $path, $m) && $method === "GET":
                (new ProfesorController())->getById($m[1]);
                break;

            case preg_match('/^\/profesores\/(\d+)$/', $path, $m) && $method === "PUT":
                (new ProfesorController())->update($m[1]);
                break;

            case preg_match('/^\/profesores\/(\d+)$/', $path, $m) && $method === "DELETE":
                (new ProfesorController())->delete($m[1]);
                break;

            // ============ EXAMENES ============
            case ($path === "/examenes" && $method === "GET"):
                (new ExamenController())->getAll();
                break;

            case ($path === "/examenes" && $method === "POST"):
                (new ExamenController())->create();
                break;

            case preg_match('/^\/examenes\/(\d+)$/', $path, $m) && $method === "GET":
                (new ExamenController())->getById($m[1]);
                break;

            case preg_match('/^\/examenes\/(\d+)$/', $path, $m) && $method === "PUT":
                (new ExamenController())->update($m[1]);
                break;

            case preg_match('/^\/examenes\/(\d+)$/', $path, $m) && $method === "DELETE":
                (new ExamenController())->delete($m[1]);
                break;

            // ============ PRACTICAS ============
            case ($path === "/practicas" && $method === "GET"):
                (new PracticaController())->getAll();
                break;

            case ($path === "/practicas" && $method === "POST"):
                (new PracticaController())->create();
                break;

            case preg_match('/^\/practicas\/(\d+)$/', $path, $m) && $method === "GET":
                (new PracticaController())->getById($m[1]);
                break;

            case preg_match('/^\/practicas\/(\d+)$/', $path, $m) && $method === "PUT":
                (new PracticaController())->update($m[1]);
                break;

            case preg_match('/^\/practicas\/(\d+)$/', $path, $m) && $method === "DELETE":
                (new PracticaController())->delete($m[1]);
                break;

            // ============ GRUPOS ============
            case ($path === "/grupos" && $method === "GET"):
                (new GrupoController())->getAll();
                break;

            case ($path === "/grupos" && $method === "POST"):
                (new GrupoController())->create();
                break;

            default:
                Response::sendError("Endpoint no encontrado: " . $path, 404);
                break;
        }
    }
}

$router = new Router();
$router->route();
?>