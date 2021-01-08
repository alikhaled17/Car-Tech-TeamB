<?php
    $operation = filter_input(INPUT_GET, 'operation', FILTER_SANITIZE_STRING);
    ($operation == 'add') ? $add = true : $add = false;
    require_once './config/config.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $data_to_store = filter_input_array(INPUT_POST);
        $nameUser = 'Car Tech';
        $FromEmail= 'info.cartechb@gmail.com';
        $ToEmail = $data_to_store['email'];
        $subjectTitle= $data_to_store['Subject'];
        $message= $data_to_store['Massege'];
        $date_time=date('Y-m-d H:i:s');        

        //reset db instance
        $Insert_qur="INSERT INTO sent_messages (mess_name,mess_from,mess_to,mess_subject,mess_text,date_time) VALUES ('$nameUser', '$FromEmail', '$ToEmail','$subjectTitle','$message','$date_time')";
        $ins_result=mysqli_query($conn, $Insert_qur);        
    
} 

$edit = false;

require_once 'includes/header.php';
?>
<div id="page-wrapper">
	 <?php 
    include_once('includes/flash_messages.php');
    ?>
	<form class="well form-horizontal" action=" " method="post"  id="contact_form" enctype="multipart/form-data">
		<?php include_once './forms/message_form.php'; ?>
	</form>
</div>

<?php include_once 'includes/footer.php'; ?>