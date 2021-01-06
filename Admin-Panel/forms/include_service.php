<?php
include_once("./config/config.php");
$sql="SELECT id,ser_name FROM `services`";
$result=mysqli_query($conn, $sql);
while($myservices=mysqli_fetch_array($result)) {

     
    $checked_attribute = (strpos($selected_service_ids, $myservices ['id'] ) !== false)  ? "checked" : "";
    echo '<input type="checkbox" name="ser_name[]" '.$checked_attribute.' value='.$myservices ["id"].' ">
                <label>'.$myservices ['ser_name'].'</label><br>';

}

?>
