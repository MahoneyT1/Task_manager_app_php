<?php
require_once __DIR__ . '/../../config/database.php';
require __DIR__ . '../../functions/data_sanitizer.php';

$storage = new DBStorage();

// if request is to delete task
if ($_SERVER["REQUEST_METHOD"] === "DELETE") {

    $id = $_GET["id"];

    try {
        $sanitized_data = cleanData($id);
        $storage->delete($id);

    } catch (PDOException $e) {
        echo "Error caused by" . $e;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delelete</title>
</head>
<body>
    <h1>Delete</h1>
</body>
</html>