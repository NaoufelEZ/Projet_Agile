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
        <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <title>Reservation Accept</title>
</head>
<body>
<div class="sidebar">
    <h2>Dashboard</h2>
    <ul>
      <li><a href="#">Home</a></li>
      <li><a href="#">Profile</a></li>
      <li><a href="#">Settings</a></li>
      <li>
      <a href="" class="there">Reservation</a>
        <ul class="sub-menu">
          <li><a href="./reservation.php">En Attende</a></li>
          <li><a href="./reservationAccept.php">Accept</a></li>
          <li><a href="./reservationRefuse.php">Refuse</a></li>
        </ul>
      </li>
      <li><a href="#">Logout</a></li>
    </ul>
  </div>
  <div class="main-content">
    <div class="top-bar">
      Welcome to Your Dashboard
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
        </tr>
        <?php
        $sql = "SELECT * FROM reservation r,service s,utilisateur u WHERE s.serviceID = r.serviceID and  u.id_Utilisateur = r.clientID and status = 'Refuse';";
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
        </tr>";
        $i++;
        }
        }
        else{
            echo "<tr><td colspan='6'>il n' a pas des Reservation Refuse</td></tr>";
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