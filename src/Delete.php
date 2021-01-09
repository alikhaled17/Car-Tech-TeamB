<?php
    include('https://care-tech.herokuapp.com/Config.php');
    session_start();
    session_regenerate_id();    
    $id= $_GET['id'];
    $result=mysqli_query($conn,"DELETE FROM  gallery WHERE id=$id");
    header("Location:pProfile.php");
?>