<?php
 $conn = mysqli_connect("localhost","root","","projet_agile");
 $conn->set_charset("utf8mb4");
    if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }
 
?>