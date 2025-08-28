<?php
// function that sanitizes input

function cleanData($datas)
{
    // function that sanitizes input
    $name = htmlspecialchars($datas['name']);
    $completed = (int) htmlspecialchars($datas["completed"]);

    return ["name" => $name, "completed" => $completed];
};
