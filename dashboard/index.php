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
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="style.css">
  
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
      <li><a href="./produit.php">Produit</a></li>
      <li><a href="./ajouteproduit.php">Ajoute Produit</a></li>
      <li>
      <a href="" class="there">Reservation</a>
        <ul class="sub-menu">
          <li><a href="./reservation.php">En Attende</a></li>
          <li><a href="./reservationAccept.php">Accept</a></li>
          <li><a href="./reservationRefuse.php">Refuse</a></li>
        </ul>
    </ul>
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
      <h1>Overview</h1>
      <div class="cards">
        <div class="card">
          <h3>Users</h3>
          <?php
            $sql = "SELECT * FROM utilisateur";
            $req = mysqli_query($conn,$sql);
            echo "<p>". mysqli_num_rows($req) ."</p>";
          ?>
        </div>
        <div class="card">
          <h3>Services</h3>
          <?php
            $sql = "SELECT * FROM service";
            $req = mysqli_query($conn,$sql);
            echo "<p>". mysqli_num_rows($req) ."</p>";
          ?>
        </div>
        <div class="card">
          <h3>Reservation</h3>
          <?php
            $sql = "SELECT * FROM reservation";
            $req = mysqli_query($conn,$sql);
            echo "<p>". mysqli_num_rows($req) ."</p>";
          ?>
        </div>
        <div class="card">
          <h3>gains</h3>
          <?php
            $sql = "SELECT SUM(price+pricePro) FROM reservation r,service s,products p WHERE s.serviceID = r.serviceID AND p.idProduct  = r.idProduct AND status = 'Accept';";
            $req = mysqli_query($conn,$sql);
            echo "<p>". mysqli_fetch_row($req)[0] ." DT</p>";
          ?>
        </div>
      </div>
    </div>
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
