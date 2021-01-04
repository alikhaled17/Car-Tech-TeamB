<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';

//User ID for which we are performing operation
$services_id = filter_input(INPUT_GET, 'services_id');
$operation = filter_input(INPUT_GET, 'operation', FILTER_SANITIZE_STRING);
($operation == 'edit') ? $edit = true : $edit = false;

//Serve POST request.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Sanitize input post if we want
	$data_to_update = filter_input_array(INPUT_POST);
	//Check whether the user name already exists ;
	$ser_name =$data_to_update['ser_name'];

	$sql="SELECT * FROM `services`
	WHERE ser_name ='$ser_name' && id <>'$services_id' ";
	$result=mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result);

	if (!empty($row['ser_name'])) {

		$_SESSION['failure'] = "User name already exists";

		$query_string = http_build_query(array(
			'services_id' => $services_id,
			'operation' => $operation,
		));
		header('location: edit_services.php?'.$query_string );
		exit;
	}

	$services_id = filter_input(INPUT_GET, 'services_id', FILTER_VALIDATE_INT);

	$sql="UPDATE services
	SET ser_name='$ser_name' WHERE id='$services_id'";
	$result=mysqli_query($conn, $sql);

	if ($result) {
		$_SESSION['success'] = "Service user has been updated successfully";
	} else {
		$_SESSION['failure'] = "Failed to update Service : " . mysqli_error($conn);
	}

	header('location: services_Show.php');
	exit;

}

//Select where clause
$sql="SELECT * FROM `services`
WHERE id = $services_id ";
// Set values to $result
$result=mysqli_query($conn, $sql); 
$services = mysqli_fetch_array($result);

// import header
require_once 'includes/header.php';
?>
<div id="page-wrapper">

    <div class="row">
     <div class="col-lg-12">
            <h2 class="page-header">Update Services</h2>
        </div>

    </div>
    <?php include_once 'includes/flash_messages.php';?>
    <form class="well form-horizontal" action="" method="post"  id="contact_form" enctype="multipart/form-data">
        <?php include_once './forms/services_form.php';?>
    </form>
</div>




<?php include_once 'includes/footer.php';?>