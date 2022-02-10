<?php 
    require_once 'configuration.php';
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $status = $_POST['status'];
        $sql = "UPDATE todo SET status = $status WHERE id = $id";
        $result = $pdo -> query($sql) -> execute();
        if ($result) {
            header("Location: main.php");
        } else {
            echo "fail";
        }
    }

?>

This is great