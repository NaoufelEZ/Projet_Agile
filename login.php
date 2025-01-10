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
    <title>Login & Signup</title>
   <style>

body {
    font-family: Arial, sans-serif;
    background: var(--secondary-color);
    color: var(--text-color);
}

.container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;    
    background: white;

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
    <link rel="stylesheet" href="style.css">
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
        <h1 id="form-title">Login</h1>
        <form id="login-form" method="POST">
            <div class="form-group">
                <label for="login-email">Email</label>
                <input type="text" id="login-email" name="email" placeholder="Entre Votre Email ou Username" required>
            </div>
            <div class="form-group">
                <label for="login-password">Password</label>
                <input type="password" id="login-password" name="password" placeholder="Entre Votre Mot de Passe" required>
            </div>
            <div class="form-group">
                <button type="submit" name="btn">Login</button>
            </div>
            <?php
                        
                if(isset($_POST["btn"])){
                    $email = $_POST["email"];
                    $password = $_POST["password"];
                    $sql = "SELECT * FROM utilisateur WHERE email = '$email'";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) >= 1){
                    $res = mysqli_fetch_array($result);
                    $passwordDB = $res["password"];
                    if(password_verify($password, $passwordDB)){
                        $_SESSION["login"] = $email;
                        header("Location:./index.php");

                    }  
                    else{
                        echo "<p style='color: red'>Invalid email or password</p>";
                    }                  

                }
                else{
                    echo "<p style='color: red'>Invalid email or password</p>";
                }          
            }
            ?>
        </form>
        <div class="toggle">
            <p id="toggle-text">Don't have an account? <a href="./signup.php" id="toggle-link">Signup</a></p>
        </div>
    </div>
    </div>
    <footer>
        <p>&copy; 2024 CarFixCo. All Rights Reserved.</p>
    </footer>
    
</body>
</html>