<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';

//User ID for which we are performing operation
$providers_id = filter_input(INPUT_GET, 'providers_id');
$operation = filter_input(INPUT_GET, 'operation', FILTER_SANITIZE_STRING);
($operation == 'edit') ? $edit = true : $edit = false;

//Serve POST request.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Sanitize input post if we want
	$data_to_update = filter_input_array(INPUT_POST);
	//Check whether the user name already exists ;
    $username =$data_to_update['username'];
    $email =$data_to_update['email'];
	$phone =$data_to_update['phone'];
	$city_name =$data_to_update['city_name'];
	$region_name =$data_to_update['region_name'];
	$ser_name =$data_to_update['ser_name'];
	$account_type =$data_to_update['account_type'];
	$prov_state =$data_to_update['prov_state'];
    

	$sql="SELECT * FROM `users`
	WHERE email ='$email' && id <>'$providers_id' ";
	$result=mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result);

	if (!empty($row['email'])) {

		$_SESSION['failure'] = "Provider already exists";

		$query_string = http_build_query(array(
			'providers_id' => $providers_id,
			'operation' => $operation,
		));
		header('location: edit_providers.php?'.$query_string );
		exit;
	}

    $providers_id = filter_input(INPUT_GET, 'providers_id', FILTER_VALIDATE_INT);
    //Encrypting the password
	$password = password_hash($data_to_update['password'], PASSWORD_DEFAULT);

	$sql="UPDATE users
	SET username='$username',password='$password',email='$email',gender='$gender',phone='$phone',account_type='$account_type'
    WHERE id='$providers_id'";
	$result=mysqli_query($conn, $sql);

	if ($result) {
		$_SESSION['success'] = "Provider has been updated successfully";
	} else {
		$_SESSION['failure'] = "Failed to update Provider : " . mysqli_error($conn);
	}

	header('location: providers_show.php');
	exit;

}

//Select where clause
$sql="SELECT * FROM `users`
WHERE id = $providers_id ";
// Set values to $result
$result=mysqli_query($conn, $sql); 
$users = mysqli_fetch_array($result);

// import header
require_once 'includes/header.php';
?>
<div id="page-wrapper">

    <div class="row">
     <div class="col-lg-12">
            <h2 class="page-header">Update Provider</h2>
        </div>

    </div>
    <?php include_once 'includes/flash_messages.php';?>
    <form class="well form-horizontal" action="" method="post"  id="contact_form" enctype="multipart/form-data">
        <?php include_once './forms/providers_form.php';?>
    </form>
</div>




<?php include_once 'includes/footer.php';?>