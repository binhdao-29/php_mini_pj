<?php
    $servername = "localhost";
    $database = "demo";
    $username = "root";
    $password = "123456";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);

    // Check connection

    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    // echo 'connected successfully';
    //mysqli_close($conn);
?>