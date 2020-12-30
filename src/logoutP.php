<?php
   session_start();
   unset($_SESSION['p_id']);
   
   session_destroy();
   header("Location:../index.php");
?>