<?php
require_once '../models/Task.php';
require_once '../helpers/ResponseHelper.php';

class TaskController {
    private $task;

    public function __construct() {
        $this->task = new Task();
    }

    public function index() {
        $tasks = $this->task->getAll();
        ResponseHelper::sendJson($tasks);
    }

    public function show($id) {
        $task = $this->task->getById($id);
        if (!$task) {
            ResponseHelper::sendError('Task not found', 404);
        }
        ResponseHelper::sendJson($task);
    }

    public function store() {
        $data = json_decode(file_get_contents('php://input'), true);
        
        if (empty($data['title'])) {
            ResponseHelper::sendError('Title is required', 400);
        }

        if ($this->task->create($data)) {
            ResponseHelper::sendJson(['message' => 'Task created successfully'], 201);
        } else {
            ResponseHelper::sendError('Failed to create task', 500);
        }
    }

    public function update($id) {
        $data = json_decode(file_get_contents('php://input'), true);
        
        if (empty($data['title'])) {
            ResponseHelper::sendError('Title is required', 400);
        }

        if ($this->task->update($id, $data)) {
            ResponseHelper::sendJson(['message' => 'Task updated successfully']);
        } else {
            ResponseHelper::sendError('Failed to update task', 500);
        }
    }

    public function delete($id) {
        if ($this->task->delete($id)) {
            ResponseHelper::sendJson(['message' => 'Task deleted successfully']);
        } else {
            ResponseHelper::sendError('Failed to delete task', 500);
        }
    }
}
?>