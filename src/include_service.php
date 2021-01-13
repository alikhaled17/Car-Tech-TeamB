<?php
include_once("../Config.php");
$sql="SELECT id,ser_name FROM `services`";
$result=mysqli_query($conn, $sql);
while($myservices=mysqli_fetch_array($result)) {

     
    //$checked_attribute = (strpos($selected_service_ids, $myservices ['id'] ) !== false)  ? "checked" : "";
    echo '<input style="display:inline; margin-top:7px; width:5% !important; float:left;" type="checkbox" name="ser_name[]" value='.$myservices ["id"].'>
                <label width="60%">'.$myservices ['ser_name'].'</label><br>';

}

?>
