/**
 * Utility functions for the Task Manager App
 */

function handleTaskList(e) {
    e.preventDefault();

    const taskList = document.getElementById("taskList");

    if (taskList.style.display === "block") {
        taskList.style.display = "none";
    } else {
        taskList.style.display = "block";
    }
}