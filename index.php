<?php
    require_once("./connect.php");
    session_start();
    if(isset($_GET["Logout"])){
        session_unset();
        session_destroy();
        header('location:./index.php');
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
        }

        header {
            background: var(--primary-color);
            color: white;
            padding: 1rem 2rem;
            text-align: center;
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

        /* Specific styling for Login */
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

        .hero {
            background: url('./images/wmremove-transformed.avif') no-repeat center center/cover;
            height: 70vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            padding: 1rem;
        }

        .hero h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            background: #00000057;
            border-radius: 10px;
            padding: 4px;
            
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            background: #00000057;
            border-radius: 10px;
        }


        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            padding: 2rem;
            background: var(--secondary-color);
        }

        .features .feature {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .features .feature img {
            width: 250px;
            height: 250px;
            border-radius: 10px;
        }
        .features  a {
           text-decoration: none;
        }

        .features .feature h3 {
            margin: 1rem 0;
        }

        .product-3d {
            margin: 2rem auto;
            text-align: center;
        }

        .product-3d iframe {
            width: 80%;
            height: 500px;
            border: none;
        }

        footer {
            text-align: center;
            padding: 1rem;
            background: var(--primary-color);
            color: white;
        }

        @media (max-width: 768px) {
            nav ul {
                flex-direction: column;
            }

            .hero h1 {
                font-size: 2rem;
            }

            .hero p {
                font-size: 1rem;
            }
        }
        .avatar{
            position: relative;
            width: 100px;
        }
        .avatar .toggle{
            background-color: #FFF;
            border-radius: 5px;
            padding: 5px;
            position: absolute;
            top: 40px;
            left: -25px;
            display: none;
        }
        nav .avatar .toggle ul{
            display: list-item;
        }
         nav .avatar .toggle ul li{
            padding: 5px 0;
        }
        .toggle::before{
            content: "";
            position: absolute;
            top: -16px;
            left: 50%;
            border: 8px solid;
            border-color: transparent transparent #fff transparent;
        }
        .toggle.active{
            display: block;
        }
        nav .notification{
            position: relative;
            cursor: pointer;
        }
        nav .notification i{
            font-size: 23px;
        }
        nav .notification .nb_noti{
            height: 15px;
            width: 15px;
            background-color: red;
            border-radius: 50%;
            position: absolute;
            right: 10px;
            top: -3px;
            font-size: 12px;
            text-align: center;
            color: #fff;
            font-weight: bold;
        }
        nav .listNoti{
            position: absolute;
            right: 40px;
            top: 140px;
            padding: 10px;
            background-color: #fff;
            border-radius: 20px;
            display: none;
        }
        .listNoti.active{
            display: block;
        }
        nav .listNoti::before{
            content:"";
            position: absolute;
            top: -16px;
            right: 55%;
            border: 9px solid;
            border-color:  transparent transparent #fff transparent;
        }
        nav .listNoti ul{
            display: list-item;
        }
        nav .listNoti ul li{
            margin: 10px 0;
            cursor: pointer;
        }
        .listNoti div{
            width: 100%;
            text-align: center;
        }
        nav .listNoti div a{
            text-decoration: none;
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
            <?php
            if(isset($_SESSION["login"])){
                $email = $_SESSION["login"];
                $sql = "SELECT nom,role,id_Utilisateur  FROM  utilisateur WHERE email = '$email'";
                $req = mysqli_query($conn,$sql);
                $res = mysqli_fetch_array($req);
                $id = $res[2];
                echo "<div data-id='$id' class='notification'>";
                $sqlNotification = "SELECT *  FROM reservation WHERE clientID = $id AND status <>'En attente' AND seen = 0;";
                $reqNotification = mysqli_query($conn,$sqlNotification);
                $nbNotification = mysqli_num_rows($reqNotification);
                if($nbNotification > 0){
                    echo"<div class='nb_noti'>". $nbNotification ."</div>";
                }
                echo "<li><i class='fa-solid fa-bell'></i></li>
                </div>
                <div class='listNoti'>
                    <ul>";
                    $sqlNotificationAll = "SELECT *  FROM reservation WHERE clientID = $id AND status <>'En attente';";
                    $reqNotificationAll = mysqli_query($conn,$sqlNotificationAll);
                    while($ligne = mysqli_fetch_assoc($reqNotificationAll)){
                        echo "<li>le reservation est ". $ligne["status"] . "</li>";
                    }
                    echo "</ul>
                    <div><a href='./historique.php'>Historique</a></div>
                </div>
                ";
                echo "<div class='avatar'>
                <li>
                <h3 class='hgu'>".$res["nom"]."</h3>
                </li>
                <div class='toggle'>
                <ul>
                " .( $res["role"] == 'Client' ? "<li><a href='./historique.php'>historique</a></li>"
                    : ($res["role"] == 'Administrateur' ? "<li><a href='./dashboard/index.php'>Dashboard</a></li>" : "<li><a href='./dashboard/reservation.php'>Reservation</a></li>"  )).
                "<li><a href='./parametre/index.php'>Paramétre</a></li>
                <li><a href='?Logout=true'>Déconnecter</a></li></ul>
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
    <div class="hero">
        <div class="text">
            <h1>Your Reliable Car Maintenance Partner</h1>
            <p>Explore high-quality car hardware and repair services.</p>
        </div>
    </div>

    </div>
    <section class="features">
        <?php
            $sqlService = "SELECT * FROM service";
            $req = mysqli_query($conn,$sqlService);
            while($res = mysqli_fetch_array($req)){
                echo "<a href='./service.php?id=".$res["serviceID"]."'>
                <div class='feature'>
                    <img src='".$res["images"]."' alt=''>
                    <h3>".$res["serviceName"]."</h3>
                    <p>".$res["description"]."</p>
                </div></a>";
            }
        ?>
    </section>
    <footer>
        <p>&copy; 2024 CarFixCo. All Rights Reserved.</p>
    </footer>
    <script>
        const avatar = document.querySelector(".avatar");
        avatar.addEventListener("click",()=>{
            const toggle = document.querySelector(".toggle");
            toggle.classList.toggle("active");
        });
        const notification = document.querySelector(".notification");
        const id = notification.getAttribute('data-id');
        const list = document.querySelector(".listNoti");
        notification.addEventListener("click",()=>{
            list.classList.toggle("active");
            fetch(`./notification.php?id=${id}`);
        });
        const lists = document.querySelectorAll(".listNoti li");
        if(lists.length >= 5){
            document.querySelector(".listNoti ul").style.height = "160px";
            document.querySelector(".listNoti ul").style.overflowY= "scroll";
        }
    </script>
</body>
</html>
