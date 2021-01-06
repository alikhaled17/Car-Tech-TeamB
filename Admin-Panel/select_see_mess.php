<?php
require_once './config/config.php';
require_once 'includes/auth_validate.php';
    if(isset($_POST['get_mess_id']))
    {
        $selected_mess = $_POST['get_mess_id'];

        $sql="UPDATE message
        SET message_type='old' WHERE id='$selected_mess'";
        $result=mysqli_query($conn, $sql);

        if ($result) {

            return 'successfully';
        
        } else {

            return "Failed ";
        }


    }
?>