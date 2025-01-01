<?php
    require_once("./connect.php");
    session_start();
    if(isset($_SESSION["login"])){
    
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
        footer {
            text-align: center;
            padding: 1rem;
            background: var(--primary-color);
            color: white;
            height: 100%;
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
        .toggle::after{
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
        .historique{
            height: calc(100vh - 128px);
            padding: 5rem;
            
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
            cursor: pointer;
        }

        table th {
            background-color: #007BFF;
            color: #fff;
            text-transform: uppercase;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }
        .no-data {
            text-align: center;
            font-size: 16px;
            color: #666;
            padding: 15px 0;
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
                $sql = "SELECT nom,role,id_Utilisateur,prenom FROM  utilisateur WHERE email = '$email'";
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
     <section class="historique">
     <table border="1">
        <tr>
        <th>Num</th>
        <th>Service</th>
        <th>Model Véhicule</th>
        <th>note</th>
        <th>date</th>
        <th>Etat</th>
        </tr>
        <?php
        $id = $res[2];
        $sql = "SELECT * FROM reservation r,service s WHERE s.serviceID = r.serviceID and clientID = $id;";
        $req = mysqli_query($conn,$sql);
        if(mysqli_num_rows($req) > 0){
        $i = 1;
        while($ligne = mysqli_fetch_assoc($req)){
        echo "<tr>
        <td>$i</td>
        <td>". $ligne["serviceName"] ."</td>
        <td>". $ligne["car_model"] ."</td>
        <td>". $ligne["notes"] ."</td>
        <td>". $ligne["date_rese"] ."</td>
        <td>". $ligne["status"] ."</td>
        </tr>";
        $i++;
        }
        }
        else{
            echo "<tr><td colspan='7'>il n' a pas des Reservation </td></tr>";
        }

        ?>
    </table>
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
    </script>
</body>
</html>
<?php
    }
    else{
        header("Location:./index.php");

    }
?>
