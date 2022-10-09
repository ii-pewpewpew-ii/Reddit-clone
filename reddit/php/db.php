<?php
    $server = "localhost";
    $user = "root";
    $passwords = "";
    $dbname = "reddit";
    $conn = mysqli_connect($server,$user,$passwords,$dbname);
    if(!$conn){
        die("failed to connect".mysqli_connect_error());
    }
?>