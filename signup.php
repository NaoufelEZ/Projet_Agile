<?php
require_once("./connect.php");
session_start();
if(isset($_SESSION["login"])){
    header("Location:./index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container" id="form-container">
    <h1 id="form-title">Sign Up</h1>
        <form id="signup-form" method="POST">
        <div class="form-group">
                <label for="signup-name">CIN</label>
                <input type="text" id="signup-name" name="cin" placeholder="Enter your CIN" required>
            </div>
            <div class="form-group">
                <label for="signup-name">Nom</label>
                <input type="text" id="signup-name" name="nom" placeholder="Enter your name" required>
            </div>
            <div class="form-group">
                <label for="signup-name">Prénom</label>
                <input type="text" id="signup-name" name="prenom" placeholder="Enter your name" required>
            </div>
            <div class="form-group">
                <label for="signup-name">Username</label>
                <input type="text" id="signup-name" name="username" placeholder="Enter your Username" required>
            </div>
            <div class="form-group">
                <label for="signup-email">Email</label>
                <input type="email" id="signup-email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="signup-password">Password</label>
                <input type="password" id="signup-password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="form-group">
                <button type="submit" name="btn">Signup</button>
                <?php
                if(isset($_POST["btn"])){
                    $cin = $_POST["cin"];
                    $nom = $_POST["nom"];
                    $prenom = $_POST["prenom"];
                    $username = $_POST["username"];
                    $email = $_POST["email"];
                    $password = $_POST["password"];
                    $password_hash = password_hash($password,false);
                    $sqlFind = "SELECT * FROM utilisateur WHERE email = '$email' or CIN = '$cin' or username = '$username'";
                    $res = mysqli_query($conn,$sqlFind);
                    if(mysqli_num_rows($res) == 0){
                    $sql = "INSERT INTO utilisateur  VALUES (NULL,'$cin','Client','$nom','$prenom','$email','$username','$password_hash');";
                    $result = mysqli_query($conn,$sql);
                    header("Location:./login.php");

                    }
                    else{
                        echo "<p class='err'>Email, CIN ou username deja existant</p>";
                    }
                


                }
                
                
                ?>
            </div>
        </form>
        <div class="toggle">
            <p id="toggle-text">Already have an account? <a href="./login.php" id="toggle-link">Login</a></p>
        </div>
    
    </div>
</body>
</html>
