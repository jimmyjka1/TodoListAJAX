<?php

    $host = 'localhost';
    $port = 3306;
    $dbname = 'todolist';
    $username = 'user1';
    $password = 'password1';

    // creating PDO object
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
?>