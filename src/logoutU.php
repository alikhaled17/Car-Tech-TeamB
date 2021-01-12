<?php
   include('../Config.php');  
   session_start();
   $lg = $_SESSION['login_details_id'];
   $result=mysqli_query($conn,"DELETE FROM  login_details WHERE login_details_id = $lg ");
   unset($_SESSION['u_id']);

   session_destroy();
   header("Location:/Car-Tech-TeamB/index.php");
?>