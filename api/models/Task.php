<?php
class Task {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM tasks ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM tasks WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO tasks (title, description, status) 
            VALUES (?, ?, ?)
        ");
        return $stmt->execute([
            $data['title'],
            $data['description'] ?? null,
            $data['status'] ?? 'pending'
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("
            UPDATE tasks 
            SET title = ?, description = ?, status = ?
            WHERE id = ?
        ");
        return $stmt->execute([
            $data['title'],
            $data['description'] ?? null,
            $data['status'] ?? 'pending',
            $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM tasks WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>