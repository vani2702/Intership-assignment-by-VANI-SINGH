<?php
session_start();

// Define an array to store the tasks
$tasks = array();

// Check if the session variable for tasks exists
if (isset($_SESSION['tasks'])) {
    $tasks = $_SESSION['tasks'];
}

// Check if the form was submitted
if (isset($_POST['submit'])) {
    // Get the task name from the form
    $task_name = $_POST['task'];

    // Add the task to the array
    $tasks[] = array(
        'name' => $task_name,
        'completed' => false,
    );

    // Save the updated task array to the session
    $_SESSION['tasks'] = $tasks;
}

// Check if the delete button was clicked
if (isset($_GET['delete'])) {
    // Get the task index from the URL
    $task_index = $_GET['delete'];

    // Remove the task from the array
    unset($tasks[$task_index]);

    // Save the updated task array to the session
    $_SESSION['tasks'] = $tasks;
}

// Check if the complete button was clicked
if (isset($_GET['complete'])) {
    // Get the task index from the URL
    $task_index = $_GET['complete'];

    // Set the completed flag to true for the task
    $tasks[$task_index]['completed'] = true;

    // Save the updated task array to the session
    $_SESSION['tasks'] = $tasks;
}

// Define functions to filter the tasks by completed status
function filter_completed($task) {
    return $task['completed'];
}

function filter_pending($task) {
    return !$task['completed'];
}

// Get the completed and pending tasks using array_filter()
$completed_tasks = array_filter($tasks, 'filter_completed');
$pending_tasks = array_filter($tasks, 'filter_pending');

// Output the HTML for the app
?>
<!DOCTYPE html>
<html>
<head>
    <title>TODO App</title>
</head>
<body>
    <h1>TODO App</h1>

    <h2>Add Task</h2>
    <form method="post">
        <input type="text" name="task">
        <input type="submit" name="submit" value="Add">
    </form>

    <h2>Tasks</h2>
    <ul>
        <?php foreach ($pending_tasks as $index => $task): ?>
            <li>
                <?php echo $task['name']; ?>
                <a href="?complete=<?php echo $index; ?>">Complete</a>
                <a href="?delete=<?php echo $index; ?>">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>

    <h2>Completed Tasks</h2>
    <ul>
        <?php foreach ($completed_tasks as $task): ?>
            <li><?php echo $task['name']; ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
