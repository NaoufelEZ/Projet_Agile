<?php
  require_once("../connect.php");
  session_start();
  if(isset($_SESSION["login"])){
    $email = $_SESSION["login"];
    $sql = "SELECT role,nom FROM utilisateur WHERE email = '$email'";
    $req = mysqli_query($conn,$sql);
    $res = mysqli_fetch_row($req);
    if($res[0] == "Administrateur"){
      if(isset($_GET["logout"])){
        session_unset();
        session_destroy();
        header("location:../index.php");

      }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    <div class="add">
      <h2>Succed</h2>
      <div class="text">
        <p>Service est Ajoute</p>
      </div>
      <button class="btn" type="button">OK</button>
    </div>
    <div class="top-bar">
    <div class="avatar">
            <?php
        echo "<h3>". $res[1] ."</h3>";
        ?>
      <div class='toggle'>
        <ul>
          <li><a href='../parametre/index.php'>Paramétre</a></li>
          <li><a href='?Logout=true'>Déconnecter</a></li>
        </ul>
        </div>
    </div>
    </div>
    <div class="content">
    <form id="signup-form" method="POST" enctype="multipart/form-data">
        <div class="form-group">
                <label for="signup-name">Nom de service</label>
                <input type="text" id="signup-name" name="nom" placeholder="Enter your Nom de Service" required>
            </div>
        <div class="form-group">
                <label for="signup-name">Description</label>
                <input type="text" id="signup-name" name="description" placeholder="Enter your Description de Service" required>
            </div>
        <div class="form-group">
                <label for="signup-name">Image</label>
                <input type="file" id="signup-name" name="image" required>
            </div>
            <div class="form-group">
                <label for="signup-name">Price</label>
                <input type="text" id="signup-name" name="price" placeholder="Enter your Price" required>
            </div>
            <div class="form-group">
                <button type="submit" name="btn">Ajoute</button>
                <?php
                  
                  if(isset($_POST["btn"])){
                    $img = $_FILES["image"];
                    $exp = explode(".",$img["name"]);
                    $name = time();
                    $path = "./images/$name.".end($exp);
                    move_uploaded_file($img['tmp_name'],".".$path) ;
                  $nom = $_POST["nom"];
                  $price = $_POST["price"];
                  $description = $_POST["description"];
              
                    $sql = "INSERT INTO service  VALUES (NULL,'$nom','$description','$path',$price);";
                    $req = mysqli_query($conn,$sql);
                    header("Location:./ajouteservice.php");
                    setcookie("add",true,time()+1);
                  }
                ?>
            </div>
    </form>
    </div>
  </div>
  <script src="main.js"></script>
</body>
</html>
<?php
    }else{
    header("location:../index.php");
    }
  }else{
    header("location:../login.php");
    }
?>