<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car";


// Create connection
$conn = new mysqli($servername, $username, $password);
$usedb = "USE car;";
$runusedb = $conn->query($usedb);
?>