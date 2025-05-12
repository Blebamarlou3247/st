<?php
require_once '../api/models/Task.php';

$taskModel = new Task();
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($uri === '/tasks') {
    $tasks = $taskModel->getAll();
    require 'tasks/index.php';
} elseif (preg_match('/^\/tasks\/(\d+)$/', $uri, $matches) && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $task = $taskModel->getById($matches[1]);
    if (!$task) {
        header("HTTP/1.1 404 Not Found");
        echo "Task not found";
        exit;
    }
    require 'tasks/show.php';
} elseif ($uri === '/tasks/create') {
    require 'tasks/create.php';
} elseif (preg_match('/^\/tasks\/(\d+)\/edit$/', $uri, $matches)) {
    $task = $taskModel->getById($matches[1]);
    if (!$task) {
        header("HTTP/1.1 404 Not Found");
        echo "Task not found";
        exit;
    }
    require 'tasks/edit.php';
} else {
    header("HTTP/1.1 404 Not Found");
    echo "Page not found";
}
?>