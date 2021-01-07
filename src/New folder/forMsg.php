<style>
li {
    list-style-type: none;
}
</style>
<?php
include('../Config.php');  

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

function fetch_user_chat_history($from_user_id, $to_user_id, $conn)
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
$output = '<ul>';
foreach($result as $row)
 {
    $user_name = '';
    if($row['from_user_id'] == $from_user_id)
    {


        $output .= '<li class="clearfix">
        <div class="message-data align-right">
            <span class="message-data-name" >You</span> <i class="fa fa-circle me"></i>
            
            </div>
            <div class="message other-message float-right">
            '.$row['chat_message'].'
            </div>
        </li>
        ';
    }
    else

    {
        if(fetch_user_last_activity($row['from_user_id'], $conn) == 1) {
            $x = "online";
        } else {
            $x = "offline";
        }
        $output .= '<li class="clearfix">
        <div class="message-data">
            <i class="fa fa-circle '.$x. '"></i>
            <span class="message-data-name" >'.get_user_name($row['from_user_id'], $conn).'</span>
            <span class="message-data-time" >'.$row['timestamp'].'</span>
            
            </div>
            <div class="message '. 'my-message' .'">
            '.$row['chat_message'].'
            </div>
        </li>
        ';
    }

    
       
       $query = "
       UPDATE chat_message 
       SET status = '0' 
       WHERE from_user_id = '".$to_user_id."' 
       AND to_user_id = '".$from_user_id."' 
       AND status = '1'
       ";
       $result = mysqli_query($conn, $query);
//   return $row['from_user_id'];
 }
 $output .= '</ul>';

// while($user_data = mysqli_fetch_array($result))
// {    
// }
return $output;       
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

function fetch_is_type_status($user_id, $conn)
{
 $query = "
 SELECT is_type FROM login_details 
 WHERE user_id = '".$user_id."' 
 ORDER BY last_activity DESC 
 LIMIT 1
 "; 
 $result = mysqli_query($conn, $query);
 $output = '';
 foreach($result as $row)
 {
  if($row["is_type"] == 'yes')
  {
   $output = ' - <small><em><span class="text-muted">Typing...</span></em></small>';
  }
 }
 return $output;
}


?>