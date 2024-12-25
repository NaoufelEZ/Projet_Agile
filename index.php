<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Maintenance & Hardware</title>
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
            background: url('https://images.unsplash.com/photo-1619331258261-8fc7a6c3d45a?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwzNjUyOXwwfDF8c2VhcmNofDl8fGF1dG9tb3RpdmV8ZW58MHx8fHwxNjg2OTIwMjk0&ixlib=rb-4.0.3&q=80&w=1920') no-repeat center center/cover;
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
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }

        .hero a {
            background: var(--primary-color);
            color: white;
            padding: 0.5rem 1.5rem;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .hero a:hover {
            background: white;
            color: var(--primary-color);
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
            max-width: 100%;
            height: auto;
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
            <li><a href="./login.php" class="login-link">Login</a></li>
            <li><a href="./signup.php">Signup</a></li>
        </ul>
    </nav>
    <div class="hero">
        <div>
            <h1>Your Reliable Car Maintenance Partner</h1>
            <p>Explore high-quality car hardware and repair services.</p>
            <a href="#">Shop Now</a>
        </div>
    </div>
    <section class="features">
        <div class="feature">
            <img src="https://via.placeholder.com/300x200?text=Brake+Pads" alt="Brake Pads">
            <h3>Brake Pads</h3>
            <p>High-performance brake pads for every vehicle.</p>
        </div>
        <div class="feature">
            <img src="https://via.placeholder.com/300x200?text=Oil+Filters" alt="Oil Filters">
            <h3>Oil Filters</h3>
            <p>Durable and efficient oil filters for smooth driving.</p>
        </div>
        <div class="feature">
            <img src="https://via.placeholder.com/300x200?text=Car+Batteries" alt="Car Batteries">
            <h3>Car Batteries</h3>
            <p>Reliable batteries to power your journey.</p>
        </div>
    </section>
    <section class="product-3d">
        <h2>Explore Our Products in 3D</h2>
        <iframe src="https://sketchfab.com/models/7w7c8f4fcbb546f4ad720cc6b4820a9f/embed" allowfullscreen></iframe>
    </section>
    <footer>
        <p>&copy; 2024 CarFixCo. All Rights Reserved.</p>
    </footer>
</body>
</html>
