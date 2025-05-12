<?php
ob_start();
?>
<h1>Todo List</h1>
<div class="task-list">
    <?php foreach ($tasks as $task): ?>
    <div class="task-card">
        <h3><?php echo htmlspecialchars($task['title']); ?></h3>
        <p><?php echo htmlspecialchars($task['description']); ?></p>
        <span class="status <?php echo str_replace('_', '-', $task['status']); ?>">
            <?php echo ucfirst(str_replace('_', ' ', $task['status'])); ?>
        </span>
        <div class="actions">
            <a href="/tasks/<?php echo $task['id']; ?>" class="btn view">View</a>
            <a href="/tasks/<?php echo $task['id']; ?>/edit" class="btn edit">Edit</a>
            <button class="btn delete" data-id="<?php echo $task['id']; ?>">Delete</button>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<a href="/tasks/create" class="btn create">Create New Task</a>
<?php
$content = ob_get_clean();
include '../layout.php';
?>