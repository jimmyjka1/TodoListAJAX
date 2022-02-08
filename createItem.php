<?php
require_once 'configuration.php';
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
        $lastInsertId = $pdo->lastInsertId();
        echo '<div class="item m-2 p-2 w-50 row" id="item'.$lastInsertId.'">
        <div class="col-7 p-0">
            <h3>'.$title.'</h3>
            <p>'.$description.'</p>
        </div>
        <div class="col-2 p-0 d-flex justify-content-center align-items-center"><button class="complete btn btn-success" id="completeButton'.$lastInsertId.'">Completed</button></div>
        <div class="col-1 p-0 d-flex justify-content-center align-items-center">
            <button class="editButton btn btn-warning p-2" id="edit'.$lastInsertId.'">Edit</button>
        </div>
        <div class="col-2 p-0 d-flex justify-content-center align-items-center">
            <button class="deleteButton btn btn-danger p-2 px-4" id="delete'.$lastInsertId.'">Delete</button>
        </div>

        </div>';
    }
}

?>
