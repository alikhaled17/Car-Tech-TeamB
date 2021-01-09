<?php
include('../Config.php'); 


session_start();

$id=$_GET['id'];
$query = "
SELECT  * FROM `users` 
WHERE  users.id = $id  
";  

$result = mysqli_query($conn, $query);
$rows = mysqli_num_rows($result);
$user_data = mysqli_fetch_array($result);


    foreach($result as $row)
    {
        $output = '
        <div class="clearfix">
            <button id="yourButtonId" type="button" class="start_chat" data-touserid="'.$id.'" data-tousername="'.$user_data['username'].'">
                Chat
            </button>
            
        </div>
        ';
    }
echo $output;

?>
<script>
    $(document).ready(function(){

    $("#yourButtonId")[0].click();

    }); 
</script>