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
    <style>

.container {
    background-color: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 70px 0 ;
}

.content{
    background: white;
    padding: 5px 2rem;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    width: 90%;
    max-width: 400px;
}

.container h1 {
    text-align: center;
    margin-bottom: 1rem;
    color: var(--primary-color);

}

.form-group {
    margin-bottom: 1rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
}

.form-group input {
    width: 100%;
    padding: 0.5rem;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.form-group button {
    width: 100%;
    padding: 0.5rem;
    border: none;
    background: var(--primary-color);
    color: white;
    font-weight: bold;
    border-radius: 5px;
    cursor: pointer;
}

.form-group button:hover {
    background: darkblue;
}

.toggle {
    text-align: center;
}

.toggle a {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: bold;
}

.toggle a:hover {
    text-decoration: underline;
}
.err{
    color: red;
    text-align: center;
}

    </style>
</head>
<body>
<header>
        <h1>Welcome to Vehicle Maintenance & Hardware</h1>
    </header>
    <nav>
        <div class="logo">CarFixCo</div>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href='./login.php' class='login-link'>Login</a></li>
            <li><a href='./signup.php'>Signup</a></li>
        </ul>
    </nav>

    <div class="container" id="form-container">
        <div class="content">
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
                        $sql = "INSERT INTO utilisateur  VALUES (NULL,'$cin','Client','$nom','$prenom','$email','$username','$password_hash');";
                        $result = mysqli_query($conn,$sql);
                        header("Location:./login.php");
                        }
                    }
                    ?>
                </div>
            </form>
            <div class="toggle">
                <p id="toggle-text">Already have an account? <a href="./login.php" id="toggle-link">Login</a></p>
            </div>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 CarFixCo. All Rights Reserved.</p>
    </footer>
</body>
</html>
