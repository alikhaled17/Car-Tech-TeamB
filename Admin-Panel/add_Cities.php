<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $data_to_store = filter_input_array(INPUT_POST);
    $username = $data_to_store['city_name'];

    //Check whether the user name already exists ; 
    $sql="SELECT * FROM cities WHERE city_name ='$username' ";
    $result=mysqli_query($conn, $sql); 
    $count = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);
    
    if($count >=1){
        $_SESSION['failure'] = "User name already exists";
        header('location: add_Cities.php');
        exit();
    }

    //reset db instance
    $Insert_qur="INSERT INTO cities (city_name) VALUES ('$username')";
    $ins_result=mysqli_query($conn, $Insert_qur); 
    if($ins_result)
    {

    	$_SESSION['success'] = "Cities added successfully!";
    	header('location: Cities_Show.php');
    	exit();
    }  
    
}

$edit = false;


require_once 'includes/header.php';
?>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h2 class="page-header">Add Cities</h2>
		</div>
	</div>
	 <?php 
    include_once('includes/flash_messages.php');
    ?>
	<form class="well form-horizontal" action=" " method="post"  id="contact_form" enctype="multipart/form-data">
		<?php include_once './forms/cities_form.php'; ?>
	</form>
</div>

<?php include_once 'includes/footer.php'; ?>