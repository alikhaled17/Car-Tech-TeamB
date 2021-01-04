<?php
include_once("./config/config.php");
$sql="SELECT id,ser_name FROM `services`";
$result=mysqli_query($conn, $sql);

echo '<option value="Choose" >service Name</option>';

while($myservices=mysqli_fetch_array($result)) {
    $selected_attribute = $selected_service_id == $myservices ['id'] ? "selected" : "";
    echo '<option value="'
    .$myservices ['id'].'"'.$selected_attribute.'>'
    .$myservices ['ser_name'] .'</option>';
}

?>
