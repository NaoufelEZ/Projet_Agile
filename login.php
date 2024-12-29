<?php
    require_once("./connect.php");
    session_start();
    if(isset($_SESSION["login"])){
        header("Location:./index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Signup</title>
   <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container" id="form-container">
        <h1 id="form-title">Login</h1>
        <form id="login-form" method="POST">
            <div class="form-group">
                <label for="login-email">Email</label>
                <input type="email" id="login-email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="login-password">Password</label>
                <input type="password" id="login-password" name="password" placeholder="Enter your password" required>
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
    
</body>
</html>