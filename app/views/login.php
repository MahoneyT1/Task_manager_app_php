<?php
// using the switch case statement to route request


$request = $_SERVER['REQUEST_URI'];

switch ($request) {

    case "/" :
        require __DIR__ . "/app/views/home.php";
        break;

    case "/create":
        require __DIR__ . "/app/views/create_task.php";
        break;

    case "/list":
        require __DIR__ . "/app/views/list_tasks.php";
        break;

    default:
        echo "Error 404";
        break;
};

