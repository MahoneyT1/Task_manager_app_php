<?php
// sanitize the post input data
//check if request method is post

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../../config/database.php';
require __DIR__ . '/../../functions/data_sanitizer.php';

$storage = new DBStorage();

// prefetch the all task
$allTasks = $storage->listAllTask();

$cleanedData = [];
$results = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = $_POST['name'];
    $completed = $_POST['completed'];

    $postDataList = ["name" => $name, "completed" => $completed];

    $cleanedData = cleanData($postDataList);
} else if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // check if the page number was passing in the query
    $page = isset($_SERVER['page']) ? (int)$_GET['page'] : 1;

    if (isset($_SERVER["id"])) {

        $id = htmlspecialchars($_GET['id']);

        try {
            $currentTask = $storage->getTaskWithId($id);
            echo "<div>" . $currentTask . "</div>";
        } catch (PDOException $e) {
            echo "$e " . "Occured";
        }
    } else {
        // fetch all task from db
        try {
            $tasks = $storage->listAllTask();
            $results = $tasks['data'];
        } catch (PDOException $e) {
            echo "Error occured" . $e;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <script src="../../public/assets/js/utils.js"></script>
</head>

<body class="w-100 flex-sm-column flex-column flex-md-column justify-center p-2 ">
    <div class="d-flex w-100 p-2 mt-2">
        <h1 class="text-center w-100">My Task Manager 😁</h1>
    </div>

    <div class="w-100 d-flex gap-3 mt-2">
        <button onclick="handleTaskList(event)">
            See list of tasks
        </button>

        <a href="">Create task</a>
        <a href="">Delete task</a>
    </div>

    <div class="d-flex flex-column w-100 p-2 text-center">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"
            class="w-100 d-flex flex-column justify-content-center p-3 gap-3">

            <label for="name" class="">
                <input type="text" name="name" placeholder="Task name" id="name"
                    class="border-radius-5 w-100">
            </label>
            <label for="completed">Task completed
                <select name="completed" id="completed" class="border-radius-full ">
                    <option value="1" class="">Yes</option>
                    <option value="0">No</option>
                </select>
            </label>

            <button class="btn btn-primary flex-1">Create task</button>
        </form>
    </div>

    <div id="taskList" style="display: none;" class="w-55">
        <h1>Task List</h1>

        <ul class="w-100 bg-danger">
            <?php if (!empty($results)): ?>
                <?php foreach ($results as $task): ?>
                    <li class="w-50">
                        <?php echo htmlspecialchars($task['name']); ?>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>No tasks found.</li>
            <?php endif; ?>
        </ul>
    </div>

    <?php

    ?>

</body>

</html>