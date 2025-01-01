<?php
require_once("../connect.php");
session_start();
if(isset($_SESSION["login"])){
    $email = $_SESSION["login"];
    $sql = "SELECT role,nom FROM utilisateur WHERE email = '$email'";
    $req = mysqli_query($conn,$sql);
    $res = mysqli_fetch_row($req);
    if($res[0] == "Technician" || $res[0] == "Administrateur"){
        if(isset($_GET["accept"])){
            $type = $_GET["accept"];
            $id = $_GET["id"];
            if($type == "true"){
                $sqlUpdate = "UPDATE reservation SET status = 'Accept' WHERE reservationID = $id";
                $reqUpdate = mysqli_query($conn,$sqlUpdate);
                header("location:./reservation.php");
            }
            else{
                $sqlUpdate = "UPDATE reservation SET status = 'Refuse' WHERE reservationID = $id";
                $reqUpdate = mysqli_query($conn,$sqlUpdate);
                header("location:./reservation.php");
            }
            
        }
        if(isset($_GET["Logout"])){
            session_unset();
            session_destroy();
            header("location:../index.php");
        }

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <title>reservation</title>
</head>
<body>
<div class="sidebar">
    <h2>Dashboard</h2>
    <?php
    require_once("./header.php");
    ?>
  </div>
  <div class="main-content">
    <div class="top-bar">
        <div class="avatar">
            <?php
        echo "<h3>". $res[1] ."</h3>";
        ?>
      <div class='toggle'>
        <ul>
          <li><a href='./parametre.php'>Paramétre</a></li>
          <li><a href='?Logout=true'>Déconnecter</a></li>
        </ul>
        </div>
    </div>
</div>
<div class="content">
    <table border="1">
        <tr>
        <th>Num</th>
        <th>Nom Prénom</th>
        <th>Service</th>
        <th>Model Véhicule</th>
        <th>note</th>
        <th>date</th>
        <th>action</th>
        </tr>
        <?php
        $sql = "SELECT * FROM reservation r,service s,utilisateur u WHERE s.serviceID = r.serviceID and  u.id_Utilisateur = r.clientID and status = 'En attente';";
        $req = mysqli_query($conn,$sql);
        if(mysqli_num_rows($req) > 0){
        $i = 1;
        while($ligne = mysqli_fetch_assoc($req)){
        echo "<tr>
        <td>$i</td>
        <td>". $ligne["nom"]. " " .$ligne["prenom"] ."</td>
        <td>". $ligne["serviceName"] ."</td>
        <td>". $ligne["car_model"] ."</td>
        <td>". $ligne["notes"] ."</td>
        <td>". $ligne["date_rese"] ."</td>
        <td><div class='space'><a href='?accept=true&id=". $ligne["reservationID"] ."'>accept</a><a href='?accept=false&id=". $ligne["reservationID"] ."'>refuse</a></div></td>
        </tr>";
        $i++;
        }
        }
        else{
            echo "<tr><td colspan='7'>il n' a pas des Reservation </td></tr>";
        }

        ?>
    </table>
</div>
<script src="main.js"></script>
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