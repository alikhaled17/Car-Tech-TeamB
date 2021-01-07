
<?php

//update_is_type_status.php

include('forMsg_one.php');

session_start();

$query = "
    UPDATE login_details 
    SET is_type = '".$_POST["is_type"]."' 
    WHERE login_details_id = '".$_SESSION["login_details_id"]."'
";

$statement = $conn->prepare($query);
$statement->execute();

?>