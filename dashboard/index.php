<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="style.css">
  
</head>
<body>
  <div class="sidebar">
    <h2>Reservation</h2>
    <ul>
      <li><a href="#">Home</a></li>
      <li><a href="#">Profile</a></li>
      <li><a href="#">Settings</a></li>
      <li>
        <a href="" class="there">Reservation</a>
        <ul class="sub-menu">
          <li><a href="./reservation.php">En Attende</a></li>
          <li><a href="./reservationAccept.php">Accept</a></li>
          <li><a href="./reservationRefuse.php">Refuse</a></li>
        </ul>
      </li>
      <li><a href="#">Logout</a></li>
    </ul>
  </div>

  <div class="main-content">
    <div class="top-bar">
      Welcome to Your Dashboard
    </div>
    <div class="content">
      <h1>Overview</h1>
      <div class="cards">
        <div class="card">
          <h3>Users</h3>
          <p>1,245</p>
        </div>
        <div class="card">
          <h3>Sales</h3>
          <p>$8,430</p>
        </div>
        <div class="card">
          <h3>Feedback</h3>
          <p>320</p>
        </div>
      </div>
    </div>
  </div>
  <script src="main.js"></script>
</body>
</html>
