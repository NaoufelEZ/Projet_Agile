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
    margin: 70px 0 ;
}

.content{
    background: white;
    padding: 5px 2rem;
    border-radius: 10px;
    box-shadow: 0px 1px 6px rgba(0, 0, 0, 0.1);
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
    transition: .3s ease-in-out;
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
.active{
    border: 2px solid red !important;
    outline-color: red;
}
span{
    color: red;
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
                    <label for="cin">CIN</label>
                    <input type="text" id="cin" name="cin" placeholder="Enter your CIN">
                    <span class="cinErr"></span>
                </div>
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="nom" placeholder="Enter your name">
                    <span class="nomErr"></span>
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input type="text" id="prenom" name="prenom" placeholder="Enter your name">
                    <span class="prenomErr"></span>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter your Username">
                    <span class="usernameErr"></span>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" placeholder="Enter your email">
                    <span class="emailErr"></span>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password">
                    <span class="passwordErr"></span>
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
    <script>
        const form = document.querySelector("form");
        form.addEventListener("submit",(e)=>{
            const rexAlpha = /^[A-Za-z]+$/;
            const rexUsername = /^[a-zA-Z0-9.@&!%]+$/;
            const rexEmail = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/
            const cin = document.querySelector("#cin");
            const nom = document.querySelector("#nom");
            const prenom = document.querySelector("#prenom");
            const username = document.querySelector("#username");
            const email = document.querySelector("#email");
            const password = document.querySelector("#password");
            if(cin.value == ""){
                e.preventDefault();
                document.querySelector(".cinErr").innerHTML = "CIN ne peut pas être vide";
                cin.classList.add("active");
            }
            else if(cin.value.length != 8){
                e.preventDefault();
                document.querySelector(".cinErr").innerHTML = "CIN doit être 8 chiffres";
                cin.classList.add("active");
            }
            else if(isNaN(cin.value)){
                e.preventDefault();
                document.querySelector(".cinErr").innerHTML = "CIN doit être un numéro";
                cin.classList.add("active");
            }
            else{
                document.querySelector(".cinErr").innerHTML = "";
                cin.classList.remove("active");
            }
            if(nom.value == ""){
                e.preventDefault();
                document.querySelector(".nomErr").innerHTML = "Nom ne peut pas être vide";
                nom.classList.add("active");
            }
            else if(!rexAlpha.test(nom.value)){
                e.preventDefault();
                document.querySelector(".nomErr").innerHTML = "Nom doit contenir uniquement des lettres";
                nom.classList.add("active");
            }
            else if(nom.value.length < 3){
                e.preventDefault();
                document.querySelector(".nomErr").innerHTML = "Nom doit avoir au moins 3 caractères";
                nom.classList.add("active");
            }
            else{
                document.querySelector(".nomErr").innerHTML = "";
                nom.classList.remove("active");
            }
            if(prenom.value == ""){
                e.preventDefault();
                document.querySelector(".prenomErr").innerHTML = "Prenom ne peut pas être vide";
                prenom.classList.add("active");
            }
            else if(!rexAlpha.test(prenom.value)){
                e.preventDefault();
                document.querySelector(".prenomErr").innerHTML = "Prenom doit contenir uniquement des lettres";
                prenom.classList.add("active");
            }
            else if(prenom.value.length < 3){
                e.preventDefault();
                document.querySelector(".prenomErr").innerHTML = "Prenom doit avoir au moins 3 caractères";
                prenom.classList.add("active");
            }
            else{
                document.querySelector(".prenomErr").innerHTML = "";
                prenom.classList.remove("active");
            }
            if(username.value == ""){
                e.preventDefault();
                document.querySelector(".usernameErr").innerHTML = "Username ne peut pas être vide";
                username.classList.add("active");
            }
            else if(!rexUsername.test(username.value)){
                e.preventDefault();
                document.querySelector(".usernameErr").innerHTML = "Username non valide";
                username.classList.add("active");
            }
            else if(username.value.length < 3){
                e.preventDefault();
                document.querySelector(".usernameErr").innerHTML = "Username doit avoir au moins 3 caractères";
                username.classList.add("active");
            }
            else{
                document.querySelector(".usernameErr").innerHTML = "";
                username.classList.remove("active");
            }
            if(email.value == ""){
                e.preventDefault();
                document.querySelector(".emailErr").innerHTML = "Email ne peut pas être vide";
                email.classList.add("active");
            }
            else if(!rexEmail.test(email.value)){
                e.preventDefault();
                document.querySelector(".emailErr").innerHTML = "Email non valide";
                email.classList.add("active");
            }
            else{
                document.querySelector(".emailErr").innerHTML = "";
                email.classList.remove("active");
            }
            if(password.value == ""){
                e.preventDefault();
                document.querySelector(".passwordErr").innerHTML = "Mot de passe ne peut pas être vide";
                password.classList.add("active");
            }
            else if(password.value.length < 6){
                e.preventDefault();
                document.querySelector(".passwordErr").innerHTML = "Mot de passe doit avoir au moins 6 caractères";
                password.classList.add("active");
            }
            else{
                document.querySelector(".passwordErr").innerHTML = "";
                password.classList.remove("active");
            }
        });
    </script>
</body>
</html>
