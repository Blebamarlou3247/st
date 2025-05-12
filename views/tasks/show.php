<?php
ob_start();
?>
<h1>Task Details</h1>

<div class="task-details">
    <div class="detail-row">
        <span class="detail-label">ID:</span>
        <span class="detail-value"><?php echo htmlspecialchars($task['id']); ?></span>
    </div>
    
    <div class="detail-row">
        <span class="detail-label">Title:</span>
        <span class="detail-value"><?php echo htmlspecialchars($task['title']); ?></span>
    </div>
    
    <div class="detail-row">
        <span class="detail-label">Description:</span>
        <span class="detail-value"><?php echo nl2br(htmlspecialchars($task['description'])); ?></span>
    </div>
    
    <div class="detail-row">
        <span class="detail-label">Status:</span>
        <span class="detail-value status <?php echo str_replace('_', '-', $task['status']); ?>">
            <?php echo ucfirst(str_replace('_', ' ', $task['status'])); ?>
        </span>
    </div>
    
    <div class="detail-row">
        <span class="detail-label">Created At:</span>
        <span class="detail-value"><?php echo date('Y-m-d H:i:s', strtotime($task['created_at'])); ?></span>
    </div>
    
    <div class="detail-row">
        <span class="detail-label">Updated At:</span>
        <span class="detail-value"><?php echo date('Y-m-d H:i:s', strtotime($task['updated_at'])); ?></span>
    </div>
</div>

<div class="action-buttons">
    <a href="/tasks" class="btn back">Back to List</a>
    <a href="/tasks/<?php echo $task['id']; ?>/edit" class="btn edit">Edit Task</a>
    <button class="btn delete" data-id="<?php echo $task['id']; ?>">Delete Task</button>
</div>

<?php
$content = ob_get_clean();
include '../layout.php';
?>