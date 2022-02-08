<?php
require_once "configuration.php";

// query to read all the data from the table
$sql = "SELECT * FROM todo";
$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

// var_dump($rows);


?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>To Do List</title>
</head>

<body>
    <div class="mainContainer d-flex flex-column align-items-center justify-content-center">
        <h1 class="m-2 p-2">To Do List</h1>
        <div class="itemContainer m-2 p-2 w-100 d-flex flex-column justify-content-center align-items-center" id="list">
            <button class="btn btn-primary" data-toggle="modal" data-target="#createNewModal">Add</button>
            <?php
            foreach ($rows as $row) {
                $id = $row['id'];
                if ($row['status'] == 0) {
                    echo '<div class="item m-2 p-2 w-50 row" id="item' . $id . '">
                        <div class="col-7 p-0">';
                } else {
                    echo '<div class="item m-2 p-2 w-50 row border border-success" id="item' . $id . '">
                        <div class="col-7 p-0">';
                }
                echo '<h3>';
                echo $row['title'];
                echo '</h3>
                        <p>';
                echo $row['description'];
                echo '</p>
                    </div>
                    <div class="col-2 p-0 d-flex justify-content-center align-items-center">';
                if ($row['status'] == 0) {
                    echo '<button class="complete btn btn-success" id="completeButton' . $id . '">Completed</button>';
                } else {
                    echo '<button class="complete btn btn-outline-success" id="completeButton' . $id . '" >Incomplete</button>';
                }
                echo '</div>
                    <div class="col-1 p-0 d-flex justify-content-center align-items-center">
                        <button class="editButton btn btn-warning p-2" id="edit' . $id . '">Edit</button>
                    </div>
                    <div class="col-2 p-0 d-flex justify-content-center align-items-center">
                        <button class="deleteButton btn btn-danger p-2 px-4" id="delete' . $id . '">Delete</button>
                    </div>
                    
                    </div>';
            }
            ?>




        </div>
    </div>


    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Enter Title" id="input_edit_title">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Enter Description" id="input_edit_description">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="editSubmit">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="createNewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Enter Title" id="input_create_title">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Enter Description" id="input_create_description">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="createSubmit">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>


    <script>

        $(document).ready(function() {
            function taskCompelte(){
                $parent = $(this).parent().parent();
                // console.log($parent.hasClass("border-success"));
                if ($parent.hasClass("border-success")) {
                    // console.log("Going here");
                    var id = $(this).parent().parent().attr("id");
                    var id = id.substring(4);
                    var data = {
                        id: id,
                        status: 0
                    };
                    console.log(data);
                    $.ajax({
                        url: "setCompleted.php",
                        method: "POST",
                        data: data,
                        success: function(response) {
                            // console.log("here too");
                            // console.log(response);
                            $("#item" + id).removeClass("border border-success");
                            // console.log($("#item" + id));
                            $("#completeButton" + id).removeClass("btn-outline-success");
                            $("#completeButton" + id).addClass("btn-success");
                            $("#completeButton" + id).text("Completed");

                        }
                    });
                } else {
                    var id = $(this).parent().parent().attr("id");
                    var id = id.substring(4);
                    var data = {
                        id: id,
                        status: 1
                    };
                    console.log(data);
                    $.ajax({
                        url: "setCompleted.php",
                        method: "POST",
                        data: data,
                        success: function(response) {
                            $("#item" + id).removeClass("border border-success");
                            $("#item" + id).addClass("border border-success");
                            // set button test to incomplete
                            $button = $("#completeButton" + id);
                            $button.removeClass("btn-success");
                            $button.addClass("btn-outline-success");
                            $button.text("Incomplete");
                        }
                    });
                }
            }

            $(".complete").click(taskCompelte);

            $(".editButton").click(function() {
                var id = $(this).parent().parent().attr("id");
                var id = id.substring(4);
                var title = $("#item" + id + " h3").text();
                var description = $("#item" + id + " p").text();
                $("#input_edit_title").val(title);
                $("#input_edit_description").val(description);
                $("#editModal").modal("show");
                $("#editSubmit").click(function() {
                    var data = {
                        id: id,
                        title: $("#input_edit_title").val(),
                        description: $("#input_edit_description").val()
                    };
                    console.log(data);
                    $.ajax({
                        url: "editItem.php",
                        method: "POST",
                        data: data,
                        success: function(response) {
                            console.log(response);
                            $("#item" + id + " h3").text(data.title);
                            $("#item" + id + " p").text(data.description);
                            $("#editModal").modal("hide");
                        }
                    });
                });
            });

            $(".deleteButton").click(function() {
                var id = $(this).parent().parent().attr("id");
                // alert user 
                var r = confirm("Are you sure you want to delete this item?");
                if (r == true) {
                    var id = id.substring(4);
                    var data = {
                        id: id
                    };
                    console.log(data);
                    $.ajax({
                        url: "deleteItem.php",
                        method: "POST",
                        data: data,
                        success: function(response) {
                            console.log(response);
                            $("#item" + id).remove();
                        }
                    });
                }
            });

            $("#createSubmit").click(function() {
                var data = {
                    title: $("#input_create_title").val(),
                    description: $("#input_create_description").val()
                };
                console.log(data);
                $.ajax({
                    url: "createItem.php",
                    method: "POST",
                    data: data,
                    success: function(response) {
                        console.log("GHHHH");
                        console.log(response);
                        $("#createNewModal").modal("hide");
                        // location.reload();
                        // append new item to list
                        $("#list").append(response);
                        $(".complete").click(taskCompelte);
                    }
                });
            });

            
        });
    </script>
</body>

</html>