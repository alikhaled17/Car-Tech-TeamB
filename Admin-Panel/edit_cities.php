<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';

//User ID for which we are performing operation
$cities_id = filter_input(INPUT_GET, 'cities_id');
$operation = filter_input(INPUT_GET, 'operation', FILTER_SANITIZE_STRING);
($operation == 'edit') ? $edit = true : $edit = false;

//Serve POST request.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Sanitize input post if we want
	$data_to_update = filter_input_array(INPUT_POST);
	//Check whether the user name already exists ;
	$city_name =$data_to_update['city_name'];

	$sql="SELECT * FROM `cities`
	WHERE city_name ='$city_name' && id <>'$cities_id' ";
	$result=mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result);

	if (!empty($row['city_name'])) {

		$_SESSION['failure'] = "User name already exists";

		$query_string = http_build_query(array(
			'cities_id' => $cities_id,
			'operation' => $operation,
		));
		header('location: edit_cities.php?'.$query_string );
		exit;
	}

	$cities_id = filter_input(INPUT_GET, 'cities_id', FILTER_VALIDATE_INT);

	$sql="UPDATE cities
	SET city_name='$city_name' WHERE id='$cities_id'";
	$result=mysqli_query($conn, $sql);

	if ($result) {
		$_SESSION['success'] = "city user has been updated successfully";
	} else {
		$_SESSION['failure'] = "Failed to update city : " . mysqli_error($conn);
	}

	header('location: Cities_Show.php');
	exit;

}

//Select where clause
$sql="SELECT * FROM `cities`
WHERE id = $cities_id ";
// Set values to $result
$result=mysqli_query($conn, $sql); 
$cities = mysqli_fetch_array($result);

// import header
require_once 'includes/header.php';
?>
<div id="page-wrapper">

    <div class="row">
     <div class="col-lg-12">
            <h2 class="page-header">Update Cities</h2>
        </div>

    </div>
    <?php include_once 'includes/flash_messages.php';?>
    <form class="well form-horizontal" action="" method="post"  id="contact_form" enctype="multipart/form-data">
        <?php include_once './forms/cities_form.php';?>
    </form>
</div>




<?php include_once 'includes/footer.php';?>