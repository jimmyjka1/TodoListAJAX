<?php 
    require_once 'configuration.php';
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $status = $_POST['status'];
        $sql = "UPDATE todo SET status = $status WHERE id = $id";
        $result = $pdo -> query($sql) -> execute();
        if ($result) {
            echo "success";
        } else {
            echo "fail";
        }
    }

?>

This is great