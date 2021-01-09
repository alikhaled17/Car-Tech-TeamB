<?php
   session_start();
   unset($_SESSION['u_id']);
   session_destroy();
   header("Location:https://car-tch.herokuapp.comindex.php");
?>