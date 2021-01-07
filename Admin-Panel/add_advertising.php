<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';

$operation = filter_input(INPUT_GET, 'operation', FILTER_SANITIZE_STRING);

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $data_to_store = filter_input_array(INPUT_POST);
    $name_adver = $data_to_store['name_adver'];
    $ad_content = $data_to_store['ad_content'];
    $img_adver = $_FILES['img_adver']['tmp_name'];
    $img_adver= addslashes(file_get_contents($img_adver));
    $ad_type = $data_to_store['ad_type'];

    

    //Check whether the user name already exists ; 
    $sql="SELECT * FROM advertising WHERE name_adver ='$name_adver' ";
    $result=mysqli_query($conn, $sql); 
    $count = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);

    if($count >=1){
        $_SESSION['failure'] = "Advertising already exists";
        header('location: add_advertising.php');
        exit();
    }

    //reset db instance
    $Insert_qur="INSERT INTO advertising (name_adver,ad_content,img_adver,ad_type) VALUES ('$name_adver','$ad_content','$img_adver','$ad_type')";
    $ins_result=mysqli_query($conn, $Insert_qur); 
    if($ins_result)
    {
    	$_SESSION['success'] = "advertising added successfully!";
    	header('location: advertising_show.php');
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
			<h2 class="page-header">Add Advertising</h2>
		</div>
	</div>
	 <?php 
    include_once('includes/flash_messages.php');
    ?>
	<form class="well form-horizontal" action=" " method="post"  id="contact_form" enctype="multipart/form-data">
		<?php include_once './forms/advertising_form.php'; ?>
	</form>
</div>

<?php include_once 'includes/footer.php'; ?>