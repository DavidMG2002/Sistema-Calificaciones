<?php
class Response {

    public static function sendSuccess($data, $status = 200) {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode([
            "success" => true,
            "data" => $data
        ]);
        exit;
    }

    public static function sendError($message, $status = 500) {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode([
            "success" => false,
            "error" => $message
        ]);
        exit;
    }

}
