<?php 
    require_once 'configuration.php';
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        // query to delete item 
        $sql = "DELETE FROM todo WHERE id = $id";
        $result = $pdo -> query($sql) -> execute();
        if ($result) {
            header("Location: main.php");
        } else {
            echo "fail";
        }
    }


?>