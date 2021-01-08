<?php
require_once './config/config.php';
require_once 'includes/auth_validate.php';
    if(isset($_POST['get_prov_id']))
    {
        $selected_prov = $_POST['get_prov_id'];

        $sql="UPDATE providers
        SET prov_state='accept' WHERE user_id='$selected_prov'";
        $result=mysqli_query($conn, $sql);

        if ($result) {

            return 'provider has been Accept successfully';
        
        } else {

            return "Failed to Accept provider : " . mysqli_error($conn);
        }


    }
?>