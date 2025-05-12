<?php
ob_start();
?>
<h1>Create New Task</h1>
<form id="task-form" action="/tasks" method="POST" class="task-form">
    <div class="form-group">
        <label for="title">Title*</label>
        <input type="text" id="title" name="title" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="description"></textarea>
    </div>
    <div class="form-group">
        <label for="status">Status</label>
        <select id="status" name="status">
            <option value="pending">Pending</option>
            <option value="in_progress">In Progress</option>
            <option value="completed">Completed</option>
        </select>
    </div>
    <button type="submit">Create Task</button>
</form>
<?php
$content = ob_get_clean();
include '../layout.php';
?>