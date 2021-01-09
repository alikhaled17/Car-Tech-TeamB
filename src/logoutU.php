<?php
   session_start();
   unset($_SESSION['u_id']);
   session_destroy();
   header("Location:https://care-tech.herokuapp.com/index.php");
?>