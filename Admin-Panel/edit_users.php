<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';

//User ID for which we are performing operation
$users_id = filter_input(INPUT_GET, 'users_id');
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
    $gender =$data_to_update['gender'];
    $phone =$data_to_update['phone'];
    $account_type =$data_to_update['account_type'];
	
	$prof_img = $_FILES['prof_img']['tmp_name'];
	$add_prof_img = $img_ID == '' ? "" : ", users.prof_img = '".addslashes(file_get_contents($prof_img))."' ";


	$sql="SELECT * FROM `users`
	WHERE email ='$email' && id <>'$users_id' ";
	$result=mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result);

	if (!empty($row['email'])) {

		$_SESSION['failure'] = "User already exists";

		$query_string = http_build_query(array(
			'users_id' => $users_id,
			'operation' => $operation,
		));
		header('location: edit_users.php?'.$query_string );
		exit;
	}

	$users_id = filter_input(INPUT_GET, 'users_id', FILTER_VALIDATE_INT);
	$add_password = $password != "" ? ", users.password='$password' " : "";

	$sql="UPDATE users
	SET username='$username'".$add_password.",email='$email',gender='$gender',phone='$phone'".$add_prof_img.",account_type='$account_type'
	WHERE id='$users_id'";	 

	
	$result=mysqli_query($conn, $sql);

	if ($result) {
		$_SESSION['success'] = "User has been updated successfully";
	} else {
		$_SESSION['failure'] = "Failed to update User : " . mysqli_error($conn);
	}

	header('location: Users_show.php');
	exit;

}

//Select where clause
$sql="SELECT * FROM `users`
WHERE id = $users_id ";
// Set values to $result
$result=mysqli_query($conn, $sql); 
$users = mysqli_fetch_array($result);

// import header
require_once 'includes/header.php';
?>
<div id="page-wrapper">

    <div class="row">
     <div class="col-lg-12">
            <h2 class="page-header">Update Users</h2>
        </div>

    </div>
    <?php include_once 'includes/flash_messages.php';?>
    <form class="well form-horizontal" action="" method="post"  id="contact_form" enctype="multipart/form-data">
        <?php include_once './forms/users_form.php';?>
    </form>
</div>




<?php include_once 'includes/footer.php';?>