<?php

   include('../Config.php');  
   session_start();
   $lg = $_SESSION['login_details_id'];
   $result=mysqli_query($conn,"DELETE FROM  login_details WHERE login_details_id = $lg ");
   unset($_SESSION['p_id']);
   
   session_destroy();
   header("Location:https://care-tech.herokuapp.com/index.php");
?>