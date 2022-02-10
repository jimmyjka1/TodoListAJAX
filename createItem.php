<?php
require_once 'configuration.php';
var_dump($_POST);
if (isset($_POST['title']) && isset($_POST['description'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    // prepare query
    $sql = "INSERT INTO todo (title, description) VALUES (?, ?)";
    $stmt = $pdo -> prepare($sql);
    // bind parameters
    $stmt -> bindParam(1, $title);
    $stmt -> bindParam(2, $description);
    // execute query
    // echo "GOIN HERE";
    $result = $stmt -> execute();
    if ($result) {
        // get last id 
        header("Location: main.php");
    }
}

?>
