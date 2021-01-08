<script type="text/javascript">

function handleData()
{
    var form_data = new FormData(document.querySelector("form"));
    
    if(!form_data.has("ser_name[]"))
    {
        document.getElementById("chk_option_error").style.visibility = "visible";
      return false;
    }
    else
    {
        document.getElementById("chk_option_error").style.visibility = "hidden";
      return true;
    }
    
}
</script>


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
    $password = $data_to_store['password'];
    $email = $data_to_store['email'];
    $phone = $data_to_store['phone'];
    $city_name = $data_to_store['city_name'];
    $region_name = $data_to_store['region_name'];
    $ser_ids = $data_to_store['ser_name'];
    $account_type = 'Provider';
    $img_ID = $_FILES['ID_img']['tmp_name'];
    $img_ID= addslashes(file_get_contents($img_ID));
    $img_comm = $_FILES['comm_img']['tmp_name'];
    $img_comm= addslashes(file_get_contents($img_comm));
    $prov_state = 'accept';

    //Check whether the user name already exists ; 
    $sql="SELECT * FROM users
    WHERE email ='$email' ";
    $result=mysqli_query($conn, $sql); 
    $count = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);
    
    if($count >=1){
        $_SESSION['failure'] = "Provider already exists";

        header('location: add_providers.php');
        exit();
    }

    //reset db instance
    $Insert_qur="INSERT INTO users (username,password,email,phone,account_type) VALUES ('$username','$password','$email','$phone','$account_type');
    SELECT LAST_INSERT_ID() INTO @mysql_variable_here;
    INSERT INTO providers (user_id,ID_img,comm_img,prov_state) VALUES (@mysql_variable_here,'$img_ID','$img_comm','$prov_state');
    INSERT INTO p_address (p_id,region_id) VALUES (@mysql_variable_here,'$region_name');";

    foreach ($ser_ids as $ser_id):
        $Insert_qur .= "INSERT INTO prov_services (p_id,ser_id) VALUES (@mysql_variable_here,'$ser_id');";
    endforeach;

    $ins_result=mysqli_multi_query($conn, $Insert_qur); 


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
	<form class="well form-horizontal" onsubmit="return handleData()" action=" " method="post"  id="contact_form" enctype="multipart/form-data">
		<?php include_once './forms/providers_form.php'; ?>
	</form>
</div>

<?php include_once 'includes/footer.php'; ?>