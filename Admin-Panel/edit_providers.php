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
	$ser_ids =$data_to_update['ser_name'];
	$account_type =$data_to_update['account_type'];
	$img_ID = $_FILES['ID_img']['tmp_name'];
    $img_ID= addslashes(file_get_contents($img_ID));
    $img_comm = $_FILES['comm_img']['tmp_name'];
    $img_comm= addslashes(file_get_contents($img_comm));
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

	$add_password = $password != "" ? ", users.password='$password' " : "";
	$add_ID_img = $img_ID != "" ? ", providers.ID_img='$img_ID' " : "";
	$add_comm_img = $img_comm != "" ? ", providers.comm_img='$img_comm' " : "";

	$sql="UPDATE users, p_address ,providers
	SET users.username='$username'".$add_password.",users.email='$email',users.phone='$phone',users.account_type='$account_type', 
	p_address.region_id='$region_name'".$add_ID_img."".$add_comm_img.",providers.prov_state='$prov_state'
	WHERE users.id='$providers_id' && ;";
		 echo $sql;
	$sql .= "Delete from prov_services where p_id = '$providers_id';";

	foreach ($ser_ids as $ser_id):
		$sql .= "INSERT INTO prov_services (p_id,ser_id) VALUES ('$providers_id','$ser_id');";

	endforeach;
	$result=mysqli_multi_query($conn, $sql); 

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