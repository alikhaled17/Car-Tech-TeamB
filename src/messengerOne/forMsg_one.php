<style>
li {
    list-style-type: none;
}
</style>
<?php
include_once ('C:/xampp/htdocs/Car-Tech-TeamB/Config.php');
function fetch_user_last_activity($user_id, $conn)
{
 $query = "
 SELECT * FROM login_details 
 WHERE user_id = '$user_id' 
 ORDER BY last_activity DESC 
 LIMIT 1
 ";
$result = mysqli_query($conn, $query);
$rows = mysqli_num_rows($result);
$user_data = mysqli_fetch_array($result);

    foreach($result as $row)
    {
    return $row['last_activity'];
    }
}

function fetch_one_user_chat_history($from_user_id, $to_user_id, $conn)
{
 $query = "
    SELECT * FROM chat_message 
    WHERE (from_user_id = '".$from_user_id."' 
    AND to_user_id = '".$to_user_id."') 
    OR (from_user_id = '".$to_user_id."' 
    AND to_user_id = '".$from_user_id."') 
    ORDER BY timestamp 
 ";

$result = mysqli_query($conn, $query);
$user_data = mysqli_fetch_array($result);

foreach($result as $row)
 {
    $msg = $row['chat_message'];
    $user_name = '';
    if($row['from_user_id'] == $from_user_id)
    {
        $output = '<div class="msg-send">'.$msg.'</div>';
    }
    else
    {
        $output = '<div class="msg-receive">'.$msg.'</div>';
        
    }
        echo $output;
       
        $query = "
       UPDATE chat_message 
       SET status = '0' 
       WHERE from_user_id = '".$to_user_id."' 
       AND to_user_id = '".$from_user_id."' 
       AND status = '1'
       ";
       $result = mysqli_query($conn, $query);
 }
}

function get_user_name($user_id, $conn)
{
 $query = "SELECT username FROM users WHERE id = '$user_id'";

    $result = mysqli_query($conn, $query) ;
    if (is_array($result) || is_object($result))
    {
        foreach($result as $row)
        {
         return $row['username'];
        }
    }
 
}

function count_unseen_message($from_user_id, $to_user_id, $conn)
{
 $query = "
 SELECT * FROM chat_message 
 WHERE from_user_id = '$from_user_id' 
 AND to_user_id = '$to_user_id' 
 AND status = '1'
 ";
$result = mysqli_query($conn, $query);
$rows = mysqli_num_rows($result);
$count = mysqli_num_rows($result);

 $output = '';
 if($count > 0)
 {
  $output = '<span class="label label-success">'.$count.'</span>';
 }
 return $output;
}




?>