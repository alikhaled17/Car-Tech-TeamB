<?php
if (isset ($_POST['send'])) {
    echo "Start contact config". '<br>';
    require_once "../Mail.php";
    echo "Afer required once ". '<br>';
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
    
    echo "After variables ". '<br>';

    $headers = array(
        'From' => $name . " <" . $from . ">",
        'To' => $to,
        'Subject' => $subject
    );

    echo json_encode($headers). '<br>';

    $smtp = Mail::factory('smtp', array(
                'host' => $smtpHost,
                'port' => $smtpPort,
                'auth' => true,
                'username' => $username,
                'password' => $password
            ));
    echo"smtp". '<br>';

    try {
        $mail = $smtp->send($to, $headers, $body);

    }
    
    catch(Exception $e) {
        echo 'Message: ' .$e->getMessage();
    }
    echo $mail. '<br>';
    if (PEAR::isError($mail)) {
        echo("<div class='alert alert-danger alert-dismissable'><a href='#' 
        class='close' data-dismiss='alert' aria-label='close'>×</a>".$mail->getMessage()."</div>");
    } else {
        echo ("<div class='alert alert-success alert-dismissable'><a href='#' 
            class='close' data-dismiss='alert' aria-label='close'>×</a>". $successMessage."</div>");
    }
} 
?>