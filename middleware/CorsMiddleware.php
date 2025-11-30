<?php
class CorsMiddleware {
    
    // Configuración CORS básica
    public static function handle() {
        // Headers CORS básicos
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization, X-API-Key, X-Requested-With");
        header("Access-Control-Allow-Credentials: true");
        header("Access-Control-Max-Age: 3600");
        
        // Manejar preflight OPTIONS request
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            http_response_code(200);
            exit();
        }
    }
    
    // Configuración CORS más específica
    public static function handleWithConfig($allowedOrigins = [], $allowedMethods = [], $allowedHeaders = []) {
        // Orígenes permitidos
        $origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';
        
        if (empty($allowedOrigins)) {
            $allowedOrigins = ['*'];
        }
        
        if (in_array('*', $allowedOrigins) || in_array($origin, $allowedOrigins)) {
            header("Access-Control-Allow-Origin: " . $origin);
        } else {
            header("Access-Control-Allow-Origin: " . $allowedOrigins[0]);
        }
        
        // Métodos permitidos
        if (empty($allowedMethods)) {
            $allowedMethods = ['GET', 'POST', 'PUT', 'DELETE', 'PATCH', 'OPTIONS'];
        }
        header("Access-Control-Allow-Methods: " . implode(', ', $allowedMethods));
        
        // Headers permitidos
        if (empty($allowedHeaders)) {
            $allowedHeaders = ['Content-Type', 'Authorization', 'X-API-Key', 'X-Requested-With'];
        }
        header("Access-Control-Allow-Headers: " . implode(', ', $allowedHeaders));
        
        header("Access-Control-Allow-Credentials: true");
        header("Access-Control-Max-Age: 3600");
        
        // Manejar preflight OPTIONS request
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            http_response_code(200);
            exit();
        }
    }
    
    // CORS para desarrollo
    public static function handleDevelopment() {
        $allowedOrigins = [
            'http://localhost:3000',
            'http://127.0.0.1:3000', 
            'http://localhost:8080',
            'http://127.0.0.1:8080'
        ];
        
        $origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';
        
        if (in_array($origin, $allowedOrigins)) {
            header("Access-Control-Allow-Origin: " . $origin);
        } else {
            header("Access-Control-Allow-Origin: http://localhost:3000");
        }
        
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization, X-API-Key");
        header("Access-Control-Allow-Credentials: true");
        
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            http_response_code(200);
            exit();
        }
    }
    
    // CORS para producción
    public static function handleProduction($domain) {
        header("Access-Control-Allow-Origin: " . $domain);
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization, X-API-Key");
        header("Access-Control-Allow-Credentials: true");
        header("Access-Control-Max-Age: 86400"); // 24 horas
        
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            http_response_code(200);
            exit();
        }
    }
}
?>