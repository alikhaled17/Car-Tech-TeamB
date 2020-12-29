<?php
    include('../Config.php');  
    session_start();

    $lon = $_GET['lon'];
    $lat = $_GET['lat'];
    $id = $_SESSION['p_id'];

    $cords="SELECT * FROM coordinates WHERE p_id = '$id' ";
    $ifcords = mysqli_query($conn, $cords);
    if($ex = mysqli_num_rows($ifcords)) {
        $conn->query("UPDATE coordinates SET longitude= '$lon' , latitude = '$lat' , p_id='$id' ");
    } 
    else {
        $conn->query("INSERT INTO coordinates (longitude, latitude, p_id) 
        VALUES ('$lon','$lat','$id')");
    }
    

    header("Location: pProfile.php");

?>	