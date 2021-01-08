<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';

//User ID for which we are performing operation
$advertising_id = filter_input(INPUT_GET, 'advertising_id');
$operation = filter_input(INPUT_GET, 'operation', FILTER_SANITIZE_STRING);
($operation == 'edit') ? $edit = true : $edit = false;

//Serve POST request.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Sanitize input post if we want
	$data_to_update = filter_input_array(INPUT_POST);
	//Check whether the user name already exists ;
    $name_adver =$data_to_update['name_adver'];
	$ad_content =$data_to_update['ad_content'];
	$img_adver = $_FILES['img_adver']['name'];
	$img_adver_tmp = $_FILES['img_adver']['tmp_name'];
	$img_adver_tmp= addslashes(file_get_contents($img_adver_tmp));
	$ad_type =$data_to_update['ad_type'];

	$advertising_id = filter_input(INPUT_GET, 'advertising_id', FILTER_VALIDATE_INT);

	if($img_adver_tmp != "")
	{
		$sql="UPDATE advertising
		SET name_adver='$name_adver',ad_content='$ad_content',img_adver='$img_adver_tmp',ad_type='$ad_type' WHERE id='$advertising_id'";	 
	}else
	{
		$sql="UPDATE advertising
		SET name_adver='$name_adver',ad_content='$ad_content',ad_type='$ad_type' WHERE id='$advertising_id'";
	}
	$result=mysqli_query($conn, $sql);

	if ($result) {
		$_SESSION['success'] = "advertising has been updated successfully";
	} else {
		$_SESSION['failure'] = "Failed to update advertising : " . mysqli_error($conn);
	}

	header('location: advertising_show.php');
	exit;

}

//Select where clause
$sql="SELECT * FROM `advertising`
WHERE id = $advertising_id ";
// Set values to $result
$result=mysqli_query($conn, $sql); 
$advertising = mysqli_fetch_array($result);

// import header
require_once 'includes/header.php';
?>
<div id="page-wrapper">

    <div class="row">
     <div class="col-lg-12">
            <h2 class="page-header">Update Advertising</h2>
        </div>

    </div>
    <?php include_once 'includes/flash_messages.php';?>
    <form class="well form-horizontal" action="" method="post"  id="contact_form" enctype="multipart/form-data">
        <?php include_once './forms/advertising_form.php';?>
    </form>
</div>




<?php include_once 'includes/footer.php';?>