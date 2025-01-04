<?php
require_once("../connect.php");
session_start();
if(isset($_SESSION["login"])){
    $email = $_SESSION["login"];
    $sql = "SELECT role,nom FROM utilisateur WHERE email = '$email'";
    $req = mysqli_query($conn,$sql);
    $res = mysqli_fetch_row($req);
    if($res[0] == "Administrateur"){
      if(isset($_GET["Logout"])){
        session_unset();
        session_destroy();
        header("location:../index.php");
      }
      if(isset($_GET["delete"])){
        $id = $_GET["id"];
        $sqlImage = "SELECT images FROM service WHERE serviceID = $id";
        $reqImage = mysqli_query($conn,$sqlImage);
        $path = mysqli_fetch_row($reqImage)[0];
        $path = ".".$path;
        unlink($path);
        $sql = "DELETE FROM service WHERE serviceID = $id";
        $req = mysqli_query($conn,$sql);
        header("Location:./services.php");
        
      }

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta charset="UTF-8">
    <title>Services</title>
</head>
<body>
<div class="sidebar">
    <h2>Tableau de Board</h2>
    <ul>
    <li><a href="./index.php">Home</a></li>
      <li><a href="./users.php">Users</a></li>
      <li><a href="./ajouteuser.php">Ajoute User</a></li>
      <li><a href="./services.php">Services</a></li>
      <li><a href="./ajouteservice.php">Ajoute Service</a></li>
      <li>
      <a href="" class="there">Reservation</a>
        <ul class="sub-menu">
          <li><a href="./reservation.php">En Attende</a></li>
          <li><a href="./reservationAccept.php">Accept</a></li>
          <li><a href="./reservationRefuse.php">Refuse</a></li>
        </ul>
      </li>
    </ul>
  </div>
  <div class="main-content">
  <div class="show">
  <h2>Attention</h2>
  <div class="text">
    <p>Tu es sûr pour supprimer cette service ?</p>
  </div>
  <div class="buttons">
    <button class="btn yes" type="button">Oui</button>
    <button class="btn no" type="button">Non</button>
  </div>
</div>

    <div class="top-bar">
    <div class="avatar">
            <?php
        echo "<h3>". $res[1] ."</h3>";
        ?>
      <div class='toggle'>
        <ul>
          <li><a href='../parametre'>Paramétre</a></li>
          <li><a href='?Logout=true'>Déconnecter</a></li>
        </ul>
        </div>
    </div>
</div>
<div class="content">

    <table border="1">
        <tr>
        <th>Num</th>
        <th>serviceName</th>
        <th>price</th>
        <th>Action</th>
        </tr>
        <?php
        $sql = "SELECT * FROM service;";
        $req = mysqli_query($conn,$sql);
        if(mysqli_num_rows($req) > 0){
        $i = 1;
        while($ligne = mysqli_fetch_assoc($req)){
        echo "<tr>
        <td>$i</td>
        <td>". $ligne["serviceName"] ."</td>
        <td>". $ligne["price"] ."</td>
        <td><div class='space'><a href='?accept=true&id=". $ligne["serviceID"] ."'><i class='fa-solid fa-pen-to-square'></i></a><a class='delete' href='?delete&id=". $ligne["serviceID"] ."'><i class='fa-solid fa-trash'></i></a></div></td>
        </tr>";
        $i++;
        }
        }
        else{
            echo "<tr><td colspan='4'>il n' a pas des services</td></tr>";
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