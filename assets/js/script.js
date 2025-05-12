document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn.delete').forEach(button => {
        button.addEventListener('click', function() {
            const taskId = this.getAttribute('data-id');
            if (confirm('Are you sure you want to delete this task?')) {
                fetch(`/tasks/${taskId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    }
                    throw new Error('Network response was not ok');
                })
                .then(data => {
                    if (data.message) {
                        window.location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to delete task');
                });
            }
        });
    });

    const taskForm = document.getElementById('task-form');
    if (taskForm) {
        taskForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                title: this.querySelector('[name="title"]').value,
                description: this.querySelector('[name="description"]').value,
                status: this.querySelector('[name="status"]').value
            };
            
            const url = this.getAttribute('action');
            const method = this.querySelector('[name="_method"]') ? 
                          this.querySelector('[name="_method"]').value : 
                          this.getAttribute('method');
            
            fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formData)
            })
            .then(response => {
                if (response.ok) {
                    return response.json();
                }
                throw new Error('Network response was not ok');
            })
            .then(data => {
                if (data.message) {
                    window.location.href = '/tasks';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to save task');
            });
        });
    }
});