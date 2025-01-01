<?php
    require_once("../connect.php");
    session_start();
    if(isset($_SESSION["login"])){
    
        if(isset($_GET["Logout"])){
            session_unset();
            session_destroy();
            header('location:../index.php');
        }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Maintenance & Hardware</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        :root {
            --primary-color: #1e90ff;
            --secondary-color: #f4f4f4;
            --text-color: #333;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            background: var(--secondary-color);
        }

        nav .logo {
            font-size: 1.5rem;
            font-weight: bold;
        }

        nav ul {
            list-style: none;
            display: flex;
            align-items: center;
        }

        nav ul li {
            margin: 0 1rem;
        }

        nav ul li h3 {
            cursor: pointer;
        }

        nav ul li a {
            text-decoration: none;
            color: var(--text-color);
            font-weight: bold;
        }

        nav ul li a:hover {
            color: var(--primary-color);
        }

        nav ul li a.login-link {
            padding: 0.5rem 1rem;
            border: 2px solid var(--primary-color);
            border-radius: 5px;
            color: var(--primary-color);
            background: white;
            transition: all 0.3s ease;
        }

        nav ul li a.login-link:hover {
            background: var(--primary-color);
            color: white;
        }

        footer {
            text-align: center;
            padding: 1rem;
            background: var(--primary-color);
            color: white;
            margin-top: auto;
        }

        .main {
            display: flex;
            flex: 1;
        }

        .sidebar {
            width: 20%;
            background: var(--secondary-color);
            padding: 1rem;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 1rem 0;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: var(--text-color);
            display: block;
            padding: 0.5rem;
            border-radius: 4px;
        }

        .sidebar ul li a:hover {
            background: var(--primary-color);
            color: white;
        }

        .content {
            flex: 1;
            padding: 2rem;
        }
        .content h2{
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: bold;
        }

        input {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .avatar {
            position: relative;
        }

        .avatar .toggle {
            background-color: #FFF;
            border-radius: 5px;
            padding: 5px;
            position: absolute;
            top: 40px;
            left: -25px;
            display: none;
        }

        .toggle::after {
            content: "";
            position: absolute;
            top: -16px;
            left: 50%;
            border: 8px solid;
            border-color: transparent transparent #fff transparent;
        }

        .toggle.active {
            display: block;
        }
    </style>
</head>
<body>
    <nav>
        <div class="logo">CarFixCo</div>
        <ul>
            <li><a href="./index.php">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Products</a></li>
            <li><a href="#">Contact</a></li>
            <?php
            if(isset($_SESSION["login"])){
                $email = $_SESSION["login"];
                $sql = "SELECT * FROM utilisateur WHERE email = '$email'";
                $req = mysqli_query($conn,$sql);
                $res = mysqli_fetch_array($req);
                echo "<div class='avatar'>
                <li>
                <h3 class='hgu'>".$res["nom"]."</h3>
                </li>
                <div class='toggle'>
                " .( $res["role"] == 'Client' ? "<li><a href='./historique.php'>historique</a></li>"
                    : ($res["role"] == 'Administrateur' ? "<li><a href='./dashboard/index.php'>Dashboard</a></li>" : "<li><a href='./dashboard/reservation.php'>Reservation</a></li>"  )).
                "<li><a href='./parametre/index.php'>Paramétre</a></li>
                <li><a href='?Logout=true'>Déconnecter</a></li>
                </div>
                </div>" ;
            }
            else{
                echo "<li><a href='./login.php' class='login-link'>Login</a></li>
                    <li><a href='./signup.php'>Signup</a></li>";
            }
            ?>
        </ul>
    </nav>
    <div class="main">
        <div class="sidebar">
            <ul>
                <li><a href="./index.php">Information</a></li>
                <li><a href="./password.php">Password</a></li>
            </ul>
        </div>
        <div class="content">
            <section class="info" id="password">
                <div id="password" class="content">
                    <h2>Change Information</h2>
                    <form action="/update_password" method="POST">
                        <?php
                        echo "
                    <label for='current-password'>CIN</label>
                        <input type='text' id='current-password' name='current_password' value=". $res["CIN"] ." placeholder='Enter current CIN' required>
                        
                        <label for='current-password'>Nom</label>
                        <input type='text' id='current-password' name='current_password' value=". $res["nom"] ." placeholder='Enter current password' required>

                        <label for='new-password'>Prenom</label>
                        <input type='text' id='new-password' name='new_password' value=". $res["prenom"] ." placeholder='Enter new prénom' required>

                        <label for='confirm-password'>Usernmae</label>
                        <input type='text' id='confirm-password' name='confirm_password' value=". $res["username"] ." placeholder='Confirm new username' required>
                        
                        <label for='confirm-password'>Email</label>
                        <input type='email' id='confirm-password' name='confirm_password' value=". $res["email"] ." placeholder='Confirm new email' required>
                    ";
                    ?>
                        <button type='submit'>Change Password</button>
                    </form>
                </div>
            </section>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 CarFixCo. All Rights Reserved.</p>
    </footer>
    <script>
        const avatar = document.querySelector(".avatar");
        avatar.addEventListener("click",()=>{
            const toggle = document.querySelector(".toggle");
            toggle.classList.toggle("active");
        })
    </script>
</body>
</html>
<?php
    }
    else{
        header("Location:./index.php");

    }
?>
