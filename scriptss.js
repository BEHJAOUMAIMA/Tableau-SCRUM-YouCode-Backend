function editTask(id) {
    document.getElementById("task-save-btn").style.display = 'none';
    document.getElementById("task-delete-btn").style.display = 'block';
    document.getElementById("task-update-btn").style.display = 'block';
    
    document.getElementById("task-id").value = id;
    document.getElementById("task-title").value = document.getElementById(id).getAttribute("title");
    document.getElementById("task-priority").value = document.getElementById(id).getAttribute("priority");
    document.getElementById("task-status").value = document.getElementById(id).getAttribute("status");
    document.getElementById("task-date").value = document.getElementById(id).getAttribute("date");
    document.getElementById("task-description").value = document.getElementById(id).getAttribute("description");
    if (document.getElementById(id).getAttribute("task-type") == 1) {
        document.getElementById("task-type-feature").checked = true;
    } else {
        document.getElementById("task-type-bug").checked = true;
    }
}
function addTask(){
    document.getElementById("task-save-btn").style.display = 'block';
    document.getElementById("task-delete-btn").style.display = 'none';
    document.getElementById("task-update-btn").style.display = 'none';
    document.getElementById("form-task").reset();

}
