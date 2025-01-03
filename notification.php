<?php
require_once("./connect.php");
$id = $_GET["id"];
        $req = mysqli_query($conn,"UPDATE reservation SET seen = 1 WHERE clientID = $id AND  status <> 'En attente'");

?>