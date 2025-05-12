<?php
ob_start();
?>
<h1>Edit Task</h1>
<form id="task-form" action="/tasks/<?php echo $task['id']; ?>" method="POST" class="task-form">
    <input type="hidden" name="_method" value="PUT">
    <div class="form-group">
        <label for="title">Title*</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($task['title']); ?>" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="description"><?php echo htmlspecialchars($task['description']); ?></textarea>
    </div>
    <div class="form-group">
        <label for="status">Status</label>
        <select id="status" name="status">
            <option value="pending" <?php echo $task['status'] === 'pending' ? 'selected' : ''; ?>>Pending</option>
            <option value="in_progress" <?php echo $task['status'] === 'in_progress' ? 'selected' : ''; ?>>In Progress</option>
            <option value="completed" <?php echo $task['status'] === 'completed' ? 'selected' : ''; ?>>Completed</option>
        </select>
    </div>
    <button type="submit">Update Task</button>
</form>
<?php
$content = ob_get_clean();
include '../layout.php';
?>