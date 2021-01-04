<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';

//User ID for which we are performing operation
$admin_user_id = filter_input(INPUT_GET, 'admin_user_id');
$operation = filter_input(INPUT_GET, 'operation', FILTER_SANITIZE_STRING);
($operation == 'edit') ? $edit = true : $edit = false;
//Serve POST request.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// If non-super user accesses this script via url. Stop the exexution
	if ($_SESSION['admin_type'] !== 'super') {
		// show permission denied message
		echo 'Permission Denied';
		exit();
	}
	// Sanitize input post if we want
	$data_to_update = filter_input_array(INPUT_POST);
	//Check whether the user name already exists ;
	$username =$data_to_update['user_name'];
	$admin_type =$data_to_update['admin_type'];

	$sql="SELECT * FROM `admin_accounts`
	WHERE user_name ='$username' && id <>'$admin_user_id' ";
	$result=mysqli_query($conn, $sql); 
	$count = mysqli_num_rows($result);
	$row = mysqli_fetch_array($result);

	if (!empty($row['user_name'])) {

		$_SESSION['failure'] = "Admin already exists";

		$query_string = http_build_query(array(
			'admin_user_id' => $admin_user_id,
			'operation' => $operation,
		));
		header('location: edit_admin.php?'.$query_string );
		exit;
	}

	$admin_user_id = filter_input(INPUT_GET, 'admin_user_id', FILTER_VALIDATE_INT);
	//Encrypting the password
	if ($data_to_update['password'] != ""){
		$password = password_hash($data_to_update['password'], PASSWORD_DEFAULT);

	}else{
		$password = $row['password'];
	}

	$sql="UPDATE admin_accounts
	SET user_name='$username',password='$password',admin_type='$admin_type'
	WHERE id='$admin_user_id'";
	$result=mysqli_query($conn, $sql);

	if ($result) {
		$_SESSION['success'] = "Admin user has been updated successfully";
	} else {
		$_SESSION['failure'] = "Failed to update Admin user : " . mysqli_error($conn);
	}

	header('location: admin_users.php');
	exit;

}

//Select where clause
$sql="SELECT * FROM `admin_accounts`
WHERE id = $admin_user_id ";
// Set values to $result
$result=mysqli_query($conn, $sql); 
$admin_account = mysqli_fetch_array($result);


// import header
require_once 'includes/header.php';
?>
<div id="page-wrapper">

    <div class="row">
     <div class="col-lg-12">
            <h2 class="page-header">Update User</h2>
        </div>

    </div>
    <?php include_once 'includes/flash_messages.php';?>
    <form class="well form-horizontal" action="" method="post"  id="contact_form" enctype="multipart/form-data">
        <?php include_once './forms/admin_users_form.php';?>
    </form>
</div>




<?php include_once 'includes/footer.php';?>