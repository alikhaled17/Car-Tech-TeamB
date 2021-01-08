<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';

$operation = filter_input(INPUT_GET, 'operation', FILTER_SANITIZE_STRING);

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $data_to_store = filter_input_array(INPUT_POST);
    $send_name = 'Car Tech';
    $from_email = 'info.cartechb@gmail.com';
    $to_email = $data_to_store['email'];
    $Subject = $data_to_store['Subject'];
    $Massege = $data_to_store['Massege'];


    require_once "Mail.php";
    $username = 'info.cartechb@gmail.com';
    $password = 'car5857507M';
    $smtpHost = 'ssl://smtp.gmail.com';
    $smtpPort = '465';
    $to = $to_email;
    $from =  'info.cartechb@gmail.com';
    
    $subject = $Subject;

    $replyTo = "\n";
    $name = $send_name;
    $body = $Massege.$replyTo.$send_name.$replyTo.$from_email;


    $headers = array(
        'From' => $name . " <" . $from . ">",
        'To' => $to,
        'Subject' => $subject
    );
    $smtp = Mail::factory('smtp', array(
                'host' => $smtpHost,
                'port' => $smtpPort,
                'auth' => true,
                'username' => $username,
                'password' => $password
            ));

    $mail = $smtp->send($to, $headers, $body);
    require_once 'insert_sent_meassage.php';
    if (PEAR::isError($mail)) {
        echo($mail->getMessage());
    } else {
        $_SESSION['success'] = "Message sent successfully!";
    	header('location: add_message.php');
    	exit();
    }
} 

$edit = false;

require_once 'includes/header.php';
?>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h2 class="page-header">Add Message</h2>
		</div>
	</div>
	 <?php 
    include_once('includes/flash_messages.php');
    ?>
	<form class="well form-horizontal" action=" " method="post"  id="contact_form" enctype="multipart/form-data">
		<?php include_once './forms/message_form.php'; ?>
	</form>
</div>

<?php include_once 'includes/footer.php'; ?>

