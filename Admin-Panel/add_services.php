<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $data_to_store = filter_input_array(INPUT_POST);
    $ser_name = $data_to_store['ser_name'];
    //Check whether the services already exists ; 
    $sql="SELECT * FROM services WHERE ser_name ='$ser_name' ";
    $result=mysqli_query($conn, $sql); 
    $count = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);

    if($count >=1){
        $_SESSION['failure'] = "Services already exists";
        header('location: add_services.php');
        exit();
    }

    //reset db instance
    $Insert_qur="INSERT INTO services (ser_name) VALUES ('$ser_name')";
    $ins_result=mysqli_query($conn, $Insert_qur); 
    if($ins_result)
    {
    	$_SESSION['success'] = "Services added successfully!";
    	header('location: services_Show.php');
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
			<h2 class="page-header">Add Services</h2>
		</div>
	</div>
	 <?php 
    include_once('includes/flash_messages.php');
    ?>
	<form class="well form-horizontal" action=" " method="post"  id="contact_form" enctype="multipart/form-data">
		<?php include_once './forms/services_form.php'; ?>
	</form>
</div>

<?php include_once 'includes/footer.php'; ?>