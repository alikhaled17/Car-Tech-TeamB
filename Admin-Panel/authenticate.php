<?php
require_once './config/config.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$username = filter_input(INPUT_POST, 'username');
	$passwd = filter_input(INPUT_POST, 'passwd');
	$remember = filter_input(INPUT_POST, 'remember');

	//Get DB instance.
	$sql="SELECT * FROM `admin_accounts`
	WHERE user_name ='$username'";
	$result=mysqli_query($conn, $sql); 
	$count = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);

	if ($count >= 1) {

		$db_password = $row['password'];
		$user_id = $row['id'];

		if (password_verify($passwd, $db_password)) {

			$_SESSION['user_logged_in'] = TRUE;
			$_SESSION['admin_type'] = $row['admin_type'];
			$_SESSION['id'] = $row['id'];

			if ($remember) {

				$series_id = randomString(16);
				$remember_token = getSecureRandomToken(20);
				$encryted_remember_token = password_hash($remember_token,PASSWORD_DEFAULT);
				

				$expiry_time = date('Y-m-d H:i:s', strtotime(' + 30 days'));

				$expires = strtotime($expiry_time);
				
				setcookie('series_id', $series_id, $expires, "/");
				setcookie('remember_token', $remember_token, $expires, "/");

				$sql="UPDATE admin_accounts
				SET series_id='$series_id',remember_token='$encryted_remember_token',expires='$expiry_time'
				WHERE id='$user_id'";

				$result=mysqli_query($conn, $sql);
		
			}
			//Authentication successfull redirect user
			header('Location:index.php');

		} else {
		
			$_SESSION['login_failure'] = "Invalid user name or password";
			header('Location:login.php');
		}

		exit;
	} else {
		$_SESSION['login_failure'] = "Invalid user name or password";
		header('Location:login.php');
		exit;
	}

}
else {
	die('Method Not allowed');
}