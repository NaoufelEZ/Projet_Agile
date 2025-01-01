<?php
require_once("../connect.php");
session_start();
if(isset($_SESSION["login"])){
    $email = $_SESSION["login"];
    $sql = "SELECT role,nom FROM utilisateur WHERE email = '$email'";
    $req = mysqli_query($conn,$sql);
    $res = mysqli_fetch_row($req);
    if($res[0] == "Administrateur"){
        if(isset($_GET["delete"])){
            $id = $_GET["id"];
            $sql = "DELETE FROM utilisateur WHERE id_Utilisateur = $id";
            $req = mysqli_query($conn,$sql);
            header("Location:./users.php");
            
          }

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <title>Reservation Accept</title>
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
        <th>CIN</th>
        <th>username</th>
        <th>Nom Prénom</th>
        <th>Role</th>
        <th>Email</th>
        <th>Action</th>
        </tr>
        <?php
        $sql = "SELECT * FROM utilisateur;";
        $req = mysqli_query($conn,$sql);
        if(mysqli_num_rows($req) > 0){
        $i = 1;
        while($ligne = mysqli_fetch_assoc($req)){
        echo "<tr>
        <td>$i</td>
        <td>". $ligne["CIN"] ."</td>
        <td>". $ligne["username"] ."</td>
        <td>". $ligne["nom"]. " " .$ligne["prenom"] ."</td>
        <td>". $ligne["role"] ."</td>
        <td>". $ligne["email"] ."</td>";
        if($email == $ligne["email"]){
            echo "<td><div class='space'><a href='?accept=true&id=". $ligne["id_Utilisateur"] ."'><i class='fa-solid fa-pen-to-square'></i></div></td>";
        }
        else{
            echo "<td><div class='space'><a href='?accept=true&id=". $ligne["id_Utilisateur"] ."'><i class='fa-solid fa-pen-to-square'></i></a><a class='delete' href='?delete&id=". $ligne["id_Utilisateur"] ."'><i class='fa-solid fa-trash'></i></a></div></td>";
        }

        echo "</tr>";
        $i++;
        }
        }
        else{
            echo "<tr><td colspan='7'>il n' a pas des Utilisateurs</td></tr>";
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