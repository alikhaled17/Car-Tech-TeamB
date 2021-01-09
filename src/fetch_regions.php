<?php
    echo '<option value="none" selected >Choose ...</option>';
    if(isset($_POST['get_option']))
    {

        include_once("https://care-tech.herokuapp.com/Config.php");
        $selected_city = $_POST['get_option'];
        $sql="SELECT id, region_name FROM `regions` WHERE city_id = '$selected_city'";
        $result=mysqli_query($conn, $sql);

        while($myregion=mysqli_fetch_array($result)) {

            echo '<option value="'
            .$myregion ['id']
            .'">'
            .$myregion ['region_name']
            .'</option>';

        }
        exit;
    }
?>