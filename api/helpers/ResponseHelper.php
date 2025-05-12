<?php
class ResponseHelper {
    public static function sendJson($data, $statusCode = 200) {
        header('Content-Type: application/json');
        http_response_code($statusCode);
        echo json_encode($data);
        exit;
    }

    public static function sendError($message, $statusCode = 400) {
        self::sendJson(['error' => $message], $statusCode);
    }
}
?>