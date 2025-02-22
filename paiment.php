<?php
    require_once("./connect.php");
    session_start();
    if(isset($_SESSION["login"])){
        $email = $_SESSION["login"];
        $sql = "SELECT id_Utilisateur,role FROM utilisateur WHERE email = '$email'";
        $req = mysqli_query($conn,$sql);
        $res = mysqli_fetch_row($req);
        $role = $res[1];
        if($role == "Client"){
            $service = $_GET["ser"];
            $idService = $service;
            $idproduct = $_GET["pro"];
            if(isset($_POST["btn"])){
                $id = $res[0];
                $model = $_POST["car-model"];
                $date = $_POST["date"];
                $msg = $_POST["message"];
                $sqlInsert = "INSERT INTO reservation VALUES(NULL,$id,$idService,$idproduct,'$model','$msg','En attente','$date',0,now(),now())";
                $reqInsert = mysqli_query($conn,$sqlInsert);
                header("location:./index.php");
            }
        }else{
            header("location:./index.php");
        }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Maintenance Reservation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px;
        }
        .form-container {
            max-width: 600px;
            margin: 30px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            font-size: 16px;
            margin-bottom: 8px;
            display: block;
            color: #333;
        }
        input, select, textarea {
            width: 95%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        button:hover {
            background-color: #555;
        }
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 15px;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>Car Maintenance Service Reservation</h1>
    </header>

    <div class="form-container">
        <h2>Book Your Maintenance Appointment</h2>
        <form method="POST">
            <label for="car-model">Car Model:</label>
            <input type="text" id="car-model" name="car-model" required>

            <label for="date">Preferred Maintenance Date:</label>
            <input type="date" id="date" name="date" required>

            <label for="message">Additional Notes:</label>
            <textarea id="message" name="message" rows="4" placeholder="Describe any specific issues with your car or other requests..."></textarea>
            <button type="submit" name="btn">Reserve Appointment</button>

        </form>
    </div>

    <footer>
        <p>&copy; 2024 Car Maintenance Service - All Rights Reserved</p>
    </footer>
</body>
</html>
<?php
    }
    else{
        header("location:./login.php");
    }

?>