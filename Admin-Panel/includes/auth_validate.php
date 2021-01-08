<?php

if (!isset($_SESSION['user_logged_in'])) {
	header('Location:login.php');
}

 ?>