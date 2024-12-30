<?php
require_once("../connect.php");
session_start();
if(isset($_SESSION["login"])){
    $email = $_SESSION["login"];
    $sql = "SELECT role FROM utilisateur WHERE email = '$email'";
    $req = mysqli_query($conn,$sql);
    $res = mysqli_fetch_row($req)[0];
    if($res == "Technician" || $res == "Administrateur"){

?>
<!DOCTYPE html>
<html>
<head>
    <style>
        .space{
            width: 100%;
        }
        .space a{
            margin: 6px;
        }
    </style>
    <meta charset="UTF-8">
    <title>reservation</title>
</head>
<body>
    <table border="1">
        <tr>
        <th>Num</th>
        <th>Nom Prénom</th>
        <th>Service</th>
        <th>Model vecu</th>
        <th>note</th>
        <th>date</th>
        <th>action</th>
        </tr>
        <?php
        $sql = "SELECT * FROM reservation r,service s,utilisateur u WHERE s.serviceID = r.serviceID and  u.id_Utilisateur = r.clientID;";
        $req = mysqli_query($conn,$sql);
        $i = 1;
        while($ligne = mysqli_fetch_assoc($req)){
        echo "<tr>
        <td>$i</td>
        <td>". $ligne["nom"]. " " .$ligne["prenom"] ."</td>
        <td>". $ligne["serviceName"] ."</td>
        <td>". $ligne["car_model"] ."</td>
        <td>". $ligne["notes"] ."</td>
        <td>". $ligne["date_rese"] ."</td>
        <td><div class='space'><a href='?accpet=true'>accpet</a><a href='?accpet=false'>refuse</a></div></td>
        </tr>";
        $i++;
        }

        ?>
    </table>
</body>
</html>
<?php
}
else{
    header("location:../index.php");
}
}
else{
    header("location:../login.php");
}

?>