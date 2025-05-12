<?php
require_once 'api/controllers/TaskController.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");


if (strpos($_SERVER['REQUEST_URI'], '/tasks') !== false && 
    isset($_SERVER['HTTP_ACCEPT']) && 
    strpos($_SERVER['HTTP_ACCEPT'], 'text/html') !== false) {
    require_once 'views/router.php';
    exit;
}


$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$controller = new TaskController();

if ($requestMethod === 'GET' && $requestUri === '/tasks') {
    $controller->index();
} elseif ($requestMethod === 'GET' && preg_match('/^\/tasks\/(\d+)$/', $requestUri, $matches)) {
    $controller->show($matches[1]);
} elseif ($requestMethod === 'POST' && $requestUri === '/tasks') {
    $controller->store();
} elseif ($requestMethod === 'PUT' && preg_match('/^\/tasks\/(\d+)$/', $requestUri, $matches)) {
    $controller->update($matches[1]);
} elseif ($requestMethod === 'DELETE' && preg_match('/^\/tasks\/(\d+)$/', $requestUri, $matches)) {
    $controller->delete($matches[1]);
} else {
    header("HTTP/1.1 404 Not Found");
    echo json_encode(['error' => 'Endpoint not found']);
}
?>