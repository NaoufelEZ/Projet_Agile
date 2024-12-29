<!DOCTYPE html>
<html lang="en">
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
            width: 100%;
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
        <form action="/submit-reservation" method="POST">
            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Your Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="car-model">Car Model:</label>
            <input type="text" id="car-model" name="car-model" required>

            <label for="date">Preferred Maintenance Date:</label>
            <input type="date" id="date" name="date" required>

            <label for="message">Additional Notes (optional):</label>
            <textarea id="message" name="message" rows="4" placeholder="Describe any specific issues with your car or other requests..."></textarea>

            <button type="submit">Reserve Appointment</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2024 Car Maintenance Service - All Rights Reserved</p>
    </footer>
</body>
</html>
