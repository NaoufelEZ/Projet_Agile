<?php
    require_once('connect.php');
    session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peinture de Voiture</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }
        .product-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin: 20px;
        }
        .product {
            background-color: #fff;
            border-radius: 5px;
            width: 250px;
            margin: 10px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }
        .product img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .product-name {
            font-size: 18px;
            font-weight: bold;
            margin: 10px 0;
        }
        
        .product-price {
            color: #333;
            font-size: 16px;
            margin: 15px 0;
        }
        .product-btn {
            margin: 5px 0;
            background-color: #333;
            padding: 15px;
            text-align: center;
        }
        .product-btn a {
            color: #fff;
            font-size: 20px;
            font-weight: bold;
            text-decoration: none;

        }
        footer {
            text-align: center;
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <?php
            if(isset($_GET['id'])){
               $id = $_GET['id'];
                $sql = "SELECT * FROM service WHERE serviceID = $id";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                echo "<h1>".$row['serviceName']." de Voiture</h1>";

            }
        ?>
    </header>

    <div class="product-container">
        <?php
            $sql = "SELECT * FROM products WHERE idService = $id";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)){
                echo "<div class='product'>";
                echo "<img src='".$row['imageProduit']."' alt='".$row['nameProduit']."'>";
                echo "<div class='product-name'>".$row['nameProduit']."</div>";
                echo "<div class='product-price'>Prix: ".$row['pricePro']."DT</div>";
                echo "<div class='product-btn'><a href='paiment.php?ser=$id&pro=".$row['idProduct']."'>payer</a></div>";
                echo "</div>";
            }
            ?>

    </div>

    <footer>
        <p>&copy; 2024 Peinture de Voiture - All Rights Reserved</p>
    </footer>
</body>
</html>
