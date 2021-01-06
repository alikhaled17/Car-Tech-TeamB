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
	$password =$data_to_update['password'];
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

	$add_password = $password != "" ? ", password='$password' " : "";
	// if($password != "")
	// {
		$sql="UPDATE users
		SET username='$username'".$add_password.",email='$email',phone='$phone',account_type='$account_type'
		WHERE id='$providers_id'";	 
	// }else
	// {
	// 	$sql="UPDATE users
	// 	SET username='$username',email='$email',phone='$phone',account_type='$account_type'
	// 	WHERE id='$providers_id'";
	// }
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
$sql="SELECT users.id,username,email,gender,phone,account_type,prof_img,
city_id,region_id,ID_img,comm_img,prov_state, group_concat(ser_id SEPARATOR ',')ser_id FROM `users`
inner join p_address on users.id = p_address.p_id
inner join regions on p_address.region_id = regions.id
inner join cities on regions.city_id = cities.id
inner join prov_services on prov_services.p_id = users.id
inner join providers on providers.user_id = users.id
inner join services on services.id = prov_services.ser_id
WHERE users.id = $providers_id ";
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