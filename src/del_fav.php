<?php
    include('../Config.php');
    session_start();
    session_regenerate_id();    
    $id= $_GET['id'];
    if(isset($_SESSION['p_id']) || isset($_SESSION['u_id']) )  
    {
        if (isset($_SESSION['u_id']))
        {
            $current_id=$_SESSION['u_id'];
        }
        else
        {
            $current_id=$_SESSION['p_id'];
        }
    }
    $conn->query("DELETE FROM favorite WHERE user_id = '$current_id' AND favorite_id='$id' ");

    header("Location:favoriteUser.php");
?>