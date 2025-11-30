<?php
class Validator {
    
    // Validar email
    public static function validateEmail($email) {
        if (empty($email)) {
            return ["isValid" => false, "message" => "El email es requerido"];
        }
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ["isValid" => false, "message" => "El formato del email es inválido"];
        }
        
        return ["isValid" => true, "message" => "Email válido"];
    }
    
    // Validar número entero
    public static function validateInteger($value, $min = null, $max = null) {
        if (!is_numeric($value)) {
            return ["isValid" => false, "message" => "El valor debe ser un número"];
        }
        
        $intValue = (int)$value;
        
        if ($min !== null && $intValue < $min) {
            return ["isValid" => false, "message" => "El valor debe ser mayor o igual a {$min}"];
        }
        
        if ($max !== null && $intValue > $max) {
            return ["isValid" => false, "message" => "El valor debe ser menor o igual a {$max}"];
        }
        
        return ["isValid" => true, "message" => "Número válido"];
    }
    
    // Validar número decimal
    public static function validateDecimal($value, $min = null, $max = null) {
        if (!is_numeric($value)) {
            return ["isValid" => false, "message" => "El valor debe ser un número"];
        }
        
        $floatValue = (float)$value;
        
        if ($min !== null && $floatValue < $min) {
            return ["isValid" => false, "message" => "El valor debe ser mayor o igual a {$min}"];
        }
        
        if ($max !== null && $floatValue > $max) {
            return ["isValid" => false, "message" => "El valor debe ser menor o igual a {$max}"];
        }
        
        return ["isValid" => true, "message" => "Número decimal válido"];
    }
    
    // Validar texto (longitud)
    public static function validateText($text, $minLength = 1, $maxLength = 255) {
        if (empty($text)) {
            return ["isValid" => false, "message" => "El texto es requerido"];
        }
        
        $length = strlen(trim($text));
        
        if ($length < $minLength) {
            return ["isValid" => false, "message" => "El texto debe tener al menos {$minLength} caracteres"];
        }
        
        if ($length > $maxLength) {
            return ["isValid" => false, "message" => "El texto no puede tener más de {$maxLength} caracteres"];
        }
        
        return ["isValid" => true, "message" => "Texto válido"];
    }
    
    // Validar fecha
    public static function validateDate($date, $format = 'Y-m-d') {
        if (empty($date)) {
            return ["isValid" => false, "message" => "La fecha es requerida"];
        }
        
        $d = DateTime::createFromFormat($format, $date);
        if (!$d || $d->format($format) !== $date) {
            return ["isValid" => false, "message" => "El formato de fecha debe ser {$format}"];
        }
        
        // Verificar que no sea una fecha futura (para algunos casos)
        $currentDate = new DateTime();
        if ($d > $currentDate) {
            return ["isValid" => false, "message" => "La fecha no puede ser futura"];
        }
        
        return ["isValid" => true, "message" => "Fecha válida"];
    }
    
    // Validar DNI (ejemplo para Colombia)
    public static function validateDNI($dni) {
        if (empty($dni)) {
            return ["isValid" => false, "message" => "El DNI es requerido"];
        }
        
        // Eliminar espacios y caracteres especiales
        $dni = preg_replace('/[^0-9]/', '', $dni);
        
        // Validar longitud (ejemplo: 8-10 dígitos)
        $length = strlen($dni);
        if ($length < 8 || $length > 10) {
            return ["isValid" => false, "message" => "El DNI debe tener entre 8 y 10 dígitos"];
        }
        
        return ["isValid" => true, "message" => "DNI válido"];
    }
    
    // Validar matrícula
    public static function validateMatricula($matricula) {
        if (empty($matricula)) {
            return ["isValid" => false, "message" => "La matrícula es requerida"];
        }
        
        // Puede ser numérica o alfanumérica
        if (!is_numeric($matricula) && !ctype_alnum($matricula)) {
            return ["isValid" => false, "message" => "La matrícula debe ser numérica o alfanumérica"];
        }
        
        return ["isValid" => true, "message" => "Matrícula válida"];
    }
    
    // Validar calificación (0-5)
    public static function validateCalificacion($calificacion) {
        if ($calificacion === null || $calificacion === '') {
            return ["isValid" => true, "message" => "Calificación opcional"]; // Puede ser null
        }
        
        if (!is_numeric($calificacion)) {
            return ["isValid" => false, "message" => "La calificación debe ser un número"];
        }
        
        $cal = (float)$calificacion;
        if ($cal < 0 || $cal > 5) {
            return ["isValid" => false, "message" => "La calificación debe estar entre 0 y 5"];
        }
        
        return ["isValid" => true, "message" => "Calificación válida"];
    }
    
    // Validar datos de alumno
    public static function validateAlumnoData($data) {
        $errors = [];
        
        // Validar matrícula
        $matriculaValidation = self::validateMatricula($data['matricula'] ?? '');
        if (!$matriculaValidation['isValid']) {
            $errors['matricula'] = $matriculaValidation['message'];
        }
        
        // Validar nombre
        $nombreValidation = self::validateText($data['nombre'] ?? '', 2, 100);
        if (!$nombreValidation['isValid']) {
            $errors['nombre'] = $nombreValidation['message'];
        }
        
        // Validar grupo
        $grupoValidation = self::validateText($data['nombre_grupo'] ?? '', 1, 50);
        if (!$grupoValidation['isValid']) {
            $errors['nombre_grupo'] = $grupoValidation['message'];
        }
        
        return [
            "isValid" => empty($errors),
            "errors" => $errors
        ];
    }
    
    // Validar datos de práctica
    public static function validatePracticaData($data) {
        $errors = [];
        
        // Validar código de práctica
        $codValidation = self::validateInteger($data['cod_practica'] ?? '', 1);
        if (!$codValidation['isValid']) {
            $errors['cod_practica'] = $codValidation['message'];
        }
        
        // Validar título
        $tituloValidation = self::validateText($data['titulo'] ?? '', 5, 150);
        if (!$tituloValidation['isValid']) {
            $errors['titulo'] = $tituloValidation['message'];
        }
        
        // Validar dificultad
        $dificultadOptions = ['baja', 'media', 'alta', 'muy alta'];
        $dificultad = $data['grado_dificultad'] ?? '';
        if (!in_array(strtolower($dificultad), $dificultadOptions)) {
            $errors['grado_dificultad'] = "La dificultad debe ser: " . implode(', ', $dificultadOptions);
        }
        
        // Validar DNI profesor
        $dniValidation = self::validateInteger($data['dni_profesor'] ?? '', 1000000);
        if (!$dniValidation['isValid']) {
            $errors['dni_profesor'] = $dniValidation['message'];
        }
        
        return [
            "isValid" => empty($errors),
            "errors" => $errors
        ];
    }
    
    // Sanitizar entrada de texto
    public static function sanitizeText($text) {
        if ($text === null) return '';
        
        $text = trim($text);
        $text = stripslashes($text);
        $text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
        
        return $text;
    }
    
    // Sanitizar número
    public static function sanitizeNumber($number) {
        if ($number === null) return null;
        
        // Remover caracteres no numéricos excepto punto decimal
        $number = preg_replace('/[^0-9.-]/', '', $number);
        
        return is_numeric($number) ? $number : null;
    }
    
    // Validar y sanitizar datos completos
    public static function processInput($data, $rules) {
        $result = [
            'isValid' => true,
            'errors' => [],
            'sanitizedData' => []
        ];
        
        foreach ($rules as $field => $rule) {
            $value = $data[$field] ?? null;
            $type = $rule['type'] ?? 'text';
            $required = $rule['required'] ?? true;
            
            // Si es requerido y está vacío
            if ($required && ($value === null || $value === '')) {
                $result['isValid'] = false;
                $result['errors'][$field] = "El campo {$field} es requerido";
                continue;
            }
            
            // Si no es requerido y está vacío, continuar
            if (!$required && ($value === null || $value === '')) {
                $result['sanitizedData'][$field] = null;
                continue;
            }
            
            // Sanitizar según el tipo
            switch ($type) {
                case 'email':
                    $sanitized = self::sanitizeText($value);
                    $validation = self::validateEmail($sanitized);
                    break;
                    
                case 'integer':
                    $sanitized = self::sanitizeNumber($value);
                    $min = $rule['min'] ?? null;
                    $max = $rule['max'] ?? null;
                    $validation = self::validateInteger($sanitized, $min, $max);
                    break;
                    
                case 'decimal':
                    $sanitized = self::sanitizeNumber($value);
                    $min = $rule['min'] ?? null;
                    $max = $rule['max'] ?? null;
                    $validation = self::validateDecimal($sanitized, $min, $max);
                    break;
                    
                case 'date':
                    $sanitized = self::sanitizeText($value);
                    $format = $rule['format'] ?? 'Y-m-d';
                    $validation = self::validateDate($sanitized, $format);
                    break;
                    
                default: // text
                    $sanitized = self::sanitizeText($value);
                    $minLength = $rule['minLength'] ?? 1;
                    $maxLength = $rule['maxLength'] ?? 255;
                    $validation = self::validateText($sanitized, $minLength, $maxLength);
                    break;
            }
            
            if (!$validation['isValid']) {
                $result['isValid'] = false;
                $result['errors'][$field] = $validation['message'];
            } else {
                $result['sanitizedData'][$field] = $sanitized;
            }
        }
        
        return $result;
    }
}
?>