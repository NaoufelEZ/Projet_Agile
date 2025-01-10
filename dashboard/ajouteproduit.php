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
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="style.css">
  <style>
    span{
      color:red;
    }
    </style>
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
                <label for="nom">Nom de Produit</label>
                <input type="text" id="nom" name="nom" placeholder="Enter your Nom de Produit">
                <span class="nomErr"></span>
            </div>
        <div class="form-group">
                <label for="image">Image</label>
                <input type="file" id="image" name="image">
                <span class="imageErr"></span>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" id="price" name="price" placeholder="Enter your Produit Price">
                <span class="priceErr"></span>
              </div>
              <div class="form-group">
                <label for="service">Services</label>
                <select id="service" name="service">
                  <option disabled selected value="">Select Service</option>
                  <?php
                        $sql = "SELECT * FROM service";
                        $req = mysqli_query($conn,$sql);
                        while($res = mysqli_fetch_row($req)){
                          echo "<option value='$res[0]'>$res[1]</option>";
                        }
                        ?>
                </select>
                <span class="servicesErr"></span>
            </div>
            <div class="form-group">
                <button type="submit" name="btn">Ajoute</button>
                <?php
                  
                  if(isset($_POST["btn"])){
                    $img = $_FILES["image"];
                    $exp = explode(".",$img["name"]);
                    $name = time();
                    $path = "./images/$name.".end($exp);
                    move_uploaded_file($img['tmp_name'],".".$path);
                    $nom = $_POST["nom"];
                    $price = $_POST["price"];
                    $service = $_POST["service"];
                    $nomR = str_replace("'","\'",$nom);
                    $sql = "INSERT INTO products  VALUES (NULL,'$service','$nomR','$path',$price);";
                    $req = mysqli_query($conn,$sql);
                    header("Location:./ajouteproduit.php");
                    setcookie("add",true,time()+1);
                  }
                ?>
            </div>
    </form>
    </div>
  </div>
  <script src="main.js"></script>
  <script>
    const form = document.querySelector("form");
    form.addEventListener("submit",(e)=>{
      const nom = document.querySelector("#nom").value;
      const image = document.querySelector("#image").files;
      const price = document.querySelector("#price").value;
      const services = document.querySelector("#service");
      if (nom == "") {
        e.preventDefault();
        document.querySelector(".nomErr").innerHTML = "Veuillez saisir un nom.";
      } else {
        document.querySelector(".nomErr").innerHTML = "";
      }

      if (price == "") {
          e.preventDefault();
          document.querySelector(".priceErr").innerHTML = "Veuillez saisir un prix.";
      } else if (isNaN(price)) {
          e.preventDefault();
          document.querySelector(".priceErr").innerHTML = "Le prix doit être un nombre valide.";
      } else {
          document.querySelector(".priceErr").innerHTML = "";
      }

      if (image.length == 1) {
          const typeImage = image[0].type.split("/")[0];
          if (typeImage == "image") {
              document.querySelector(".imageErr").innerHTML = "";
          } else {
              e.preventDefault();
              document.querySelector(".imageErr").innerHTML = "Le fichier doit être une image.";
          }
      } else {
          e.preventDefault();
          document.querySelector(".imageErr").innerHTML = "Veuillez télécharger une image.";
      }

      if (services.selectedIndex == 0) {
          e.preventDefault();
          document.querySelector(".servicesErr").innerHTML = "Veuillez sélectionner un service.";
      } else {
          document.querySelector(".servicesErr").innerHTML = "";
      }

    });
  </script>
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