<?php
require_once __DIR__ . '/../utils/Response.php';

class AuthMiddleware {
    
    // Método para verificar API Key básica
    public static function verifyApiKey() {
        $headers = getallheaders();
        
        // Verificar si existe la API Key en los headers
        $apiKey = isset($headers['X-API-Key']) ? $headers['X-API-Key'] : 
                 (isset($_SERVER['HTTP_X_API_KEY']) ? $_SERVER['HTTP_X_API_KEY'] : null);
        
        if (!$apiKey) {
            Response::sendError("API Key requerida", 401);
            return false;
        }
        
        // Validar la API Key (puedes cambiar esto por tu lógica de validación)
        $validApiKey = "tu_api_key_secreta_2025"; // En producción, usa variables de entorno
        
        if ($apiKey !== $validApiKey) {
            Response::sendError("API Key inválida", 401);
            return false;
        }
        
        return true;
    }
    
    // Método para verificar token JWT (opcional)
    public static function verifyJWT() {
        $headers = getallheaders();
        $authHeader = isset($headers['Authorization']) ? $headers['Authorization'] : 
                     (isset($_SERVER['HTTP_AUTHORIZATION']) ? $_SERVER['HTTP_AUTHORIZATION'] : null);
        
        if (!$authHeader) {
            Response::sendError("Token de autorización requerido", 401);
            return false;
        }
        
        // Extraer el token del header "Bearer {token}"
        if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            $token = $matches[1];
            
            // Aquí iría la validación del token JWT
            // Por ahora es un ejemplo básico
            if (self::validateJWT($token)) {
                return true;
            } else {
                Response::sendError("Token inválido o expirado", 401);
                return false;
            }
        } else {
            Response::sendError("Formato de autorización inválido. Use: Bearer {token}", 401);
            return false;
        }
    }
    
    // Método para validar JWT (implementación básica)
    private static function validateJWT($token) {
        // En una implementación real, usarías una librería JWT
        // Esta es una validación básica de ejemplo
        try {
            // Decodificar el token (en producción usa firebase/php-jwt)
            $parts = explode('.', $token);
            if (count($parts) !== 3) {
                return false;
            }
            
            $payload = json_decode(base64_decode($parts[1]), true);
            
            // Verificar expiración
            if (isset($payload['exp']) && $payload['exp'] < time()) {
                return false;
            }
            
            return true;
            
        } catch (Exception $e) {
            return false;
        }
    }
    
    // Método para verificar roles de usuario
    public static function verifyRole($allowedRoles = []) {
        // Obtener el token del header
        $headers = getallheaders();
        $authHeader = isset($headers['Authorization']) ? $headers['Authorization'] : null;
        
        if (!$authHeader) {
            Response::sendError("Acceso no autorizado", 403);
            return false;
        }
        
        // Extraer y decodificar el token
        if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            $token = $matches[1];
            $parts = explode('.', $token);
            
            if (count($parts) === 3) {
                $payload = json_decode(base64_decode($parts[1]), true);
                $userRole = $payload['role'] ?? 'user';
                
                // Verificar si el rol está permitido
                if (!in_array($userRole, $allowedRoles)) {
                    Response::sendError("No tiene permisos para acceder a este recurso", 403);
                    return false;
                }
                
                return true;
            }
        }
        
        Response::sendError("Token inválido", 401);
        return false;
    }
    
    // Método simple para rutas protegidas
    public static function protect() {
        return self::verifyApiKey(); // o self::verifyJWT() según tu necesidad
    }
}
?>