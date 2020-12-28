<?php
    include('../Config.php');  
    session_start();

    $lon = $_GET['lon'];
    $lat = $_GET['lat'];
    $id = $_SESSION['p_id'];

    $conn->query("INSERT INTO coordinates (longitude, latitude, p_id) 
    VALUES ('$lon','$lat','$id')");

    header("Location: pProfile.php");

?>	