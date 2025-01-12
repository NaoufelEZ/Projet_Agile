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
            <?php
            if(isset($_SESSION["login"])){
                $email = $_SESSION["login"];
                $sql = "SELECT nom,role,id_Utilisateur  FROM  utilisateur WHERE email = '$email'";
                $req = mysqli_query($conn,$sql);
                $res = mysqli_fetch_array($req);
                $id = $res[2];
                if($res[1] == "Client"){

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
                    $sqlNotificationAll = "SELECT *  FROM reservation WHERE clientID = $id AND status <>'En attente' ORDER BY date_update DESC;";
                    $reqNotificationAll = mysqli_query($conn,$sqlNotificationAll);
                    while($ligne = mysqli_fetch_assoc($reqNotificationAll)){
                            $status = $ligne["status"] == "Accept" ? "accept" : "refuse";
                            if($ligne["seen"] == 0){
                                echo "<li>le reservation est: <span class=$status>". $ligne["status"] . "</span></li>";
                            }
                            else{
                                echo "<li class='seen'>le reservation est: <span class=$status>". $ligne["status"] . "</span></li>";
                            }
                    }
                    echo "</ul>
                    <div><a href='./historique.php'>Historique</a></div>
                </div>";
                }
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
            <div class="title">
                <h1>Nos Services</h1>
            </div>
        <div class="content">

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
        </div>
    </section>
    <footer>
        <p>&copy; 2024 CarFixCo. All Rights Reserved.</p>
    </footer>
    <script src="main.js"></script>
</body>
</html>
