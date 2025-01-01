<?php
  require_once("../connect.php");
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
    <h2>Reservation</h2>
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
    </ul>
  </div>

  <div class="main-content">
    <div class="add">
      <h2>Succed</h2>
      <div class="text">
        <p>utilisateur est Ajoute</p>
      </div>
      <button class="btn" type="button">OK</button>
    </div>
    <div class="top-bar">
      Welcome to Your Dashboard
    </div>
    <div class="content">
    <form id="signup-form" method="POST">
        <div class="form-group">
                <label for="signup-name">CIN</label>
                <input type="text" id="signup-name" name="cin" placeholder="Enter your CIN" required>
            </div>
            <div class="form-group">
                <label for="signup-name">Nom</label>
                <input type="text" id="signup-name" name="nom" placeholder="Enter your Nom" required>
            </div>
            <div class="form-group">
                <label for="signup-name">Prenom</label>
                <input type="text" id="signup-name" name="prenom" placeholder="Enter your Prenom" required>
            </div>
            <div class="form-group">
                <label for="signup-name">Username</label>
                <input type="text" id="signup-name" name="username" placeholder="Enter your username" required>
            </div>
            <div class="form-group">
                <label for="signup-name">Email</label>
                <input type="text" id="signup-name" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="signup-name">mot de Passe</label>
                <input type="password" id="signup-name" name="password" placeholder="Enter your Password" required>
            </div>
            <div class="form-group">
                <label for="signup-name">Role</label>
                <select name="role" id="role" required>
                  <option disabled selected value="">Role...</option>
                  <option value="Client">Client</option>
                  <option value="Administrateur">Administrateur</option>
                  <option value="Technician">Technician</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" name="btn">Ajoute</button>
                <?php
                if(isset($_POST["btn"])){
                  $cin = $_POST["cin"];
                  $nom = $_POST["nom"];
                  $prenom = $_POST["prenom"];
                  $username = $_POST["username"];
                  $email = $_POST["email"];
                  $password = $_POST["password"];
                  $role = $_POST["role"];
                  $sqlCIN = "SELECT * FROM utilisateur WHERE CIN = '$cin'";
                  $reqCIN = mysqli_query($conn,$sqlCIN);
                  $sqlEmail = "SELECT * FROM utilisateur WHERE email = '$email'";
                  $reqEmail = mysqli_query($conn,$sqlEmail);
                  $sqlUsername = "SELECT * FROM utilisateur WHERE username = '$username'";
                  $reqUsername = mysqli_query($conn,$sqlUsername);
                  if(mysqli_num_rows($reqCIN) > 0){
                    echo "<p class='err'>CIN est deja éxiste</p>";
                  }
                  else if(mysqli_num_rows($reqUsername) > 0){
                    echo "<p class='err'>Username est deja éxiste</p>";
                  }
                  else if(mysqli_num_rows($reqEmail) > 0){
                    echo "<p class='err'>Email est deja éxiste</p>";
                  }
                  else{
                    $password_hash = password_hash($password,false);
                    $sql = "INSERT INTO utilisateur  VALUES (NULL,'$cin','$role','$nom','$prenom','$email','$username','$password_hash');";
                    $req = mysqli_query($conn,$sql);
                    header("Location:./ajouteuser.php");
                    setcookie("add",true,time()+1);
                  }

                }
                ?>
            </div>
    </form>
    </div>
  </div>
  <script src="main.js"></script>
</body>
</html>
