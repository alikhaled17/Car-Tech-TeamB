<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $data_to_store = filter_input_array(INPUT_POST);
    $region_name = $data_to_store['region_name'];
    $city_name =$data_to_store['city_name'];

    //Check whether the user name already exists ; 
    $sql="SELECT * FROM regions WHERE region_name ='$region_name' && city_id ='$city_name' ";
    $result=mysqli_query($conn, $sql); 
    $count = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);
    
    if($count >=1){
        $_SESSION['failure'] = "Region already exists";
        header('location: add_Region.php');
        exit();
    }

    //reset db instance
    $Insert_qur="INSERT INTO regions (region_name,city_id) VALUES ('$region_name','$city_name')";
    echo $Insert_qur;
    $ins_result=mysqli_query($conn, $Insert_qur); 
    if($ins_result)
    {

    	$_SESSION['success'] = "Region added successfully!";
    	header('location: Region_show.php');
    	exit();
    }  
    
}

$edit = false;


require_once 'includes/header.php';
?>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h2 class="page-header">Add Region</h2>
		</div>
	</div>
	 <?php 
    include_once('includes/flash_messages.php');
    ?>
	<form class="well form-horizontal" action=" " method="post"  id="contact_form" enctype="multipart/form-data">
		<?php include_once './forms/region_form.php'; ?>
	</form>
</div>

<?php include_once 'includes/footer.php'; ?>