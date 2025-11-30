<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/middleware/CorsMiddleware.php';
require_once __DIR__ . '/middleware/AuthMiddleware.php';
require_once __DIR__ . '/routes/api.php';

// Aplicar CORS
CorsMiddleware::handleDevelopment(); // o handle() para producción

// Aplicar autenticación (opcional - descomenta si necesitas proteger la API)
// if (!AuthMiddleware::verifyApiKey()) {
//     exit; // La respuesta de error ya se envió en el middleware
// }

$router = new Router();
$router->route();
?>