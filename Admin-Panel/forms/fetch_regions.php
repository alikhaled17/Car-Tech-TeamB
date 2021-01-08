<?php
if ($operation != 'edit'){
    
    require_once '../config/config.php';
}

if(isset($_POST['get_option']) || isset($selected_city_id))
{
    echo $selected_city_id;
    $selected_city = isset($_POST['get_option']) ? $_POST['get_option'] : $selected_city_id;
    echo $selected_city;
    $sql="SELECT id, region_name FROM `regions` WHERE city_id = '$selected_city'";
    $result=mysqli_query($conn, $sql);

    echo '<option value="none" >Region Name</option>';

    while($myregion=mysqli_fetch_array($result)) {
        $selected_attribute = $selected_region_id == $myregion ['id'] ? "selected" : "";
        echo '<option value="'
        .$myregion ['id'].'"'.$selected_attribute.'>'
        .$myregion ['region_name'] .'</option>';
    }

}
?>