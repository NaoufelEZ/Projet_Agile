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
            height: 450px;
            display: flex;
            justify-content: center;
            align-items: top;
            color: white;
            padding: 1rem;
            width: 100%;
        }
        .hero .cont{
            width: 50%;
            display: flex;
            align-items: center;
            flex-direction: column;
        }
        .hero .show img{
            width: 250px;
            height: 250px;
            border-radius: 15px ;
        }
        .hero .decr{
            display: flex;
            color: #000;
            width: 100%;
            justify-content: space-around;
        }
        
        .hero .decr .box{
            cursor: pointer;
            width: 200px;
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
        .avatar .toggle ul li{
            background-color: red;
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
            <li><a href="#">Products</a></li>
            <li><a href="#">Contact</a></li>
            <?php
            if(isset($_SESSION["login"])){
                $email = $_SESSION["login"];
                $sql = "SELECT nom,role FROM  utilisateur WHERE email = '$email'";
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
    <div class="hero">
        <div class="cont">
        <div class="show">
            <img class="cover" src="https://www.amiraltechnologies.com/wp2k23/wp-content/uploads/2022/12/8839_032_gestion-et-integration-de-maintenance-industrielle-cta-maintenance-industrielle.jpeg" alt="">
        </div>
        <div class="decr">
            <div class="box">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Impedit, dolorum? Accusantium itaque quae magni veritatis deleniti, sed voluptatum inventore tempore!
            </div>
            <div class="box">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil at illo nesciunt beatae architecto inventore quia ratione fugiat molestiae eius!
            </div>
        </div>
    </div>

    </div>
    <section class="features">
        <a href="peinture.php">
        <div class="feature">
                <img src="./images/Covering-ou-Peinture-article3.webp" alt="">
            <h3>Peinture</h3>
            <p>High-performance brake pads for every vehicle.</p>
        </div></a>
        <a href="jantes.php">
            <div class="feature">
                <img src="./images/nettoyant-jantes-hard-750ml.webp" alt="">
            <h3>Jantes</h3>
            <p>Durable and efficient oil filters for smooth driving.</p>
        </div></a>
        <a href="Interieur.php">
            <div class="feature">
                <img src="./images/automatique-victimes.webp" alt="">
            <h3>Intérieur</h3>
            <p>Reliable batteries to power your journey.</p>
        </div></a>
    </section>
    <section class="product-3d">
        <h2>Intérieur</h2>
        <iframe src="https://sketchfab.com/models/7w7c8f4fcbb546f4ad720cc6b4820a9f/embed" allowfullscreen></iframe>
    </section>
    <footer>
        <p>&copy; 2024 CarFixCo. All Rights Reserved.</p>
    </footer>
    <script>
        const avatar = document.querySelector(".avatar");
        avatar.addEventListener("click",()=>{
            const toggle = document.querySelector(".toggle");
            toggle.classList.toggle("active");
        })
        const cover = document.querySelector(".cover");
        const decr = document.querySelectorAll(".decr .box");
            decr.forEach((elem,i)=>{
                elem.addEventListener("click",()=>{
                    if(i == 0){
                        cover.src="https://www.amiraltechnologies.com/wp2k23/wp-content/uploads/2022/12/8839_032_gestion-et-integration-de-maintenance-industrielle-cta-maintenance-industrielle.jpeg"
                    }
                    else{
                        cover.src="https://www.fieldeagle.com/wp-content/uploads/2023/01/regular_maintenance_header.png"
                    }
                });
            })
            let isFirstImage = true;

setInterval(() => {
    cover.src = isFirstImage
        ? "https://www.fieldeagle.com/wp-content/uploads/2023/01/regular_maintenance_header.png"
        : "https://www.amiraltechnologies.com/wp2k23/wp-content/uploads/2022/12/8839_032_gestion-et-integration-de-maintenance-industrielle-cta-maintenance-industrielle.jpeg";
    isFirstImage = !isFirstImage; // Toggle the boolean
}, 6000);

    </script>
</body>
</html>
