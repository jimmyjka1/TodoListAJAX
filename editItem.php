<?php 
    require_once 'configuration.php';
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];

        $sql = "UPDATE todo SET title = '$title', description = '$description' WHERE id = $id";
        $result = $pdo -> query($sql) -> execute();
        if ($result) {
            header("Location: main.php");
        } else {
            echo "fail";
        }
    }

?>