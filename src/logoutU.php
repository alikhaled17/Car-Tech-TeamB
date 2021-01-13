<?php
   session_start();
   unset($_SESSION['u_id']);
   session_destroy();
   header("Location:/Car-Tech-TeamB/index.php");
?>