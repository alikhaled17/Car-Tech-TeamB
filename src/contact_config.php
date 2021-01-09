<?php
if (isset ($_POST['send'])) {
    require_once "Mail.php";
    $username = 'info.cartechb@gmail.com';
    $password = 'car5857507M';
    $smtpHost = 'ssl://smtp.gmail.com';
    $smtpPort = '465';
    $to = 'info.cartechb@gmail.com';
    $from =  'info.cartechb@gmail.com';
    
    $subject = $_POST['subjectTitle'];
    $successMessage = 'Message sent successfully!';


    $replyTo = "\n";
    $name = $_POST['nameUser'];
    $body = $_POST['message'].$replyTo.$_POST['nameUser'].$replyTo.$_POST['Emailsend'];


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

    if (PEAR::isError($mail)) {
        echo($mail->getMessage());
    } else {
        echo ("<div class='alert alert-success alert-dismissable'><a href='#' 
            class='close' data-dismiss='alert' aria-label='close'>×</a>". $successMessage."</div>");
    }
} 
?>