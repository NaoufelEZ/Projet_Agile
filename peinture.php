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
            margin: 5px 0;
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
        <h1>Peinture de Voiture</h1>
        <p>Quality Paints for Your Car</p>
    </header>

    <div class="product-container">
        <div class="product">
            <img src="https://via.placeholder.com/250" alt="Peinture 1">
            <div class="product-name">Peinture Auto - Rouge</div>
            <div class="product-price">35DT</div>
            <a href="paiment.php?sev=peinture">p</a>
        </div>
        
        <div class="product">
            <img src="https://via.placeholder.com/250" alt="Peinture 2">
            <div class="product-name">Peinture Auto - Bleu</div>
            <div class="product-price">40DT</div>
            <a href="paiment.php?sev=peinture">p</a>
        </div>
        
        <div class="product">
            <img src="https://via.placeholder.com/250" alt="Peinture 3">
            <div class="product-name">Peinture Auto - Noir</div>
            <div class="product-price">30DT</div>
            <a href="paiment.php?sev=peinture">p</a>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Peinture de Voiture - All Rights Reserved</p>
    </footer>
</body>
</html>
