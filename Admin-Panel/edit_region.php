<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';

//User ID for which we are performing operation
$region_id = filter_input(INPUT_GET, 'region_id');
$operation = filter_input(INPUT_GET, 'operation', FILTER_SANITIZE_STRING);
($operation == 'edit') ? $edit = true : $edit = false;

//Serve POST request.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Sanitize input post if we want
	$data_to_update = filter_input_array(INPUT_POST);
	//Check whether the user name already exists ;
	$region_name =$data_to_update['region_name'];
	$city_name =$data_to_update['city_name'];

	$sql="SELECT * FROM `regions`
	WHERE region_name ='$region_name' && id <>'$region_id' && city_id =$city_name  ";
	$result=mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result);

	if (!empty($row['region_name']) && !empty($row['city_id']) ) {

		$_SESSION['failure'] = "User name already exists";

		$query_string = http_build_query(array(
			'region_id' => $region_id,
			'operation' => $operation,
		));
		header('location: edit_region.php?'.$query_string );
		exit;
	}

	$region_id = filter_input(INPUT_GET, 'region_id', FILTER_VALIDATE_INT);

	$sql="UPDATE regions
	SET region_name='$region_name', city_id=$city_name  WHERE id=$region_id";
	$result=mysqli_query($conn, $sql);

	if ($result) {
		$_SESSION['success'] = "region user has been updated successfully";
	} else {
		$_SESSION['failure'] = "Failed to update region : " . mysqli_error($conn);
	}

	header('location: Region_show.php');
	exit;

}

//Select where clause
$sql="SELECT * FROM `regions`
WHERE id = $region_id ";
// Set values to $result
$result=mysqli_query($conn, $sql); 
$region = mysqli_fetch_array($result);

// import header
require_once 'includes/header.php';
?>
<div id="page-wrapper">

    <div class="row">
     <div class="col-lg-12">
            <h2 class="page-header">Update Region</h2>
        </div>

    </div>
    <?php include_once 'includes/flash_messages.php';?>
    <form class="well form-horizontal" action="" method="post"  id="contact_form" enctype="multipart/form-data">
        <?php include_once './forms/region_form.php';?>
    </form>
</div>




<?php include_once 'includes/footer.php';?>