<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';

//User ID for which we are performing operation
$providers_id = filter_input(INPUT_GET, 'providers_id');
$operation = filter_input(INPUT_GET, 'operation', FILTER_SANITIZE_STRING);
($operation == 'add') ? $add = true : $add = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $data_to_store = filter_input_array(INPUT_POST);
    $username = $data_to_store['username'];
    $email = $data_to_store['email'];
    $gender = $data_to_store['gender'];
    $phone = $data_to_store['phone'];
    $account_type = 'Provider';


    //Check whether the user name already exists ; 
    $sql="SELECT * FROM users WHERE email ='$email' ";
    $result=mysqli_query($conn, $sql); 
    $count = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);
    
    if($count >=1){
        $_SESSION['failure'] = "Provider already exists";
        header('location: add_users.php');
        exit();
    }
    //Encrypt password
    $password = password_hash($data_to_store['password'],PASSWORD_DEFAULT);
    //reset db instance
    $Insert_qur="INSERT INTO users (username,password,email,gender,phone,account_type) VALUES ('$username','$password','$email','$gender','$phone','$account_type')";
    $ins_result=mysqli_query($conn, $Insert_qur); 
    if($ins_result)
    {

    	$_SESSION['success'] = "Provider added successfully!";
    	header('location: providers_show.php');
    	exit();
    }  
    
}

$edit = false;


require_once 'includes/header.php';
?>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h2 class="page-header">Add Provider</h2>
		</div>
	</div>
	 <?php 
    include_once('includes/flash_messages.php');
    ?>
	<form class="well form-horizontal" action=" " method="post"  id="contact_form" enctype="multipart/form-data">
		<?php include_once './forms/providers_form.php'; ?>
	</form>
</div>

<?php include_once 'includes/footer.php'; ?>