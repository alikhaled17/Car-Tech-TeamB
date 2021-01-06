<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';

$operation = filter_input(INPUT_GET, 'operation', FILTER_SANITIZE_STRING);
//Only super admin is allowed to access this page
if ($_SESSION['admin_type'] != 'super') {
    // show permission denied message
    echo 'Permission Denied';
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $data_to_store = filter_input_array(INPUT_POST);
    $username = $data_to_store['user_name'];
    $admin_type= $data_to_store['admin_type'];

    //Check whether the user name already exists ; 
    $sql="SELECT * FROM admin_accounts WHERE user_name ='$username' ";
    $result=mysqli_query($conn, $sql); 
    $count = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);
    
    if($count >=1){
        $_SESSION['failure'] = "User name already exists";
        header('location: add_admin.php');
        exit();
    }

    //Encrypt password
    $password = password_hash($data_to_store['password'],PASSWORD_DEFAULT);

    //reset db instance
    $Insert_qur="INSERT INTO admin_accounts (user_name, password, admin_type) VALUES ('$username', '$password', '$admin_type')";

    $ins_result=mysqli_query($conn, $Insert_qur); 

    if($ins_result)
    {

    	$_SESSION['success'] = "Admin added successfully!";
    	header('location: admin_users.php');
    	exit();
    }
    else
    {
        echo 'insert failed: ' . mysqli_error($conn);
        exit();
    }
    
}

$edit = false;


require_once 'includes/header.php';
?>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h2 class="page-header">Add Admin</h2>
		</div>
	</div>
	 <?php 
    include_once('includes/flash_messages.php');
    ?>
	<form class="well form-horizontal" action=" " method="post"  id="contact_form" enctype="multipart/form-data">
		<?php include_once './forms/admin_users_form.php'; ?>
	</form>
</div>

<?php include_once 'includes/footer.php'; ?>