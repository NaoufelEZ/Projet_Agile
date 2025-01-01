<?php
echo "<ul>";
    if($res == "Administrateur"){
    echo "<li><a href='./index.php'>Home</a></li>
      <li><a href='./users.php'>Users</a></li>
      <li><a href='./ajouteuser.php'>Ajoute User</a></li>
      <li><a href='./services.php'>Services</a></li>
      <li><a href='./ajouteservice.php'>Ajoute Service</a></li>";
}
     echo "<li><a href='' class='there'>Reservation</a>
        <ul class='sub-menu'>
          <li><a href='./reservation.php'>En Attende</a></li>
          <li><a href='./reservationAccept.php'>Accept</a></li>
          <li><a href='./reservationRefuse.php'>Refuse</a></li>
        </ul>
      </li>
    </ul>";
?>