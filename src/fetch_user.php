<?php
//fetch_user.php
include('forMsg.php');


session_start();


if(isset($_SESSION['p_id']) )    
{
    $query = "
    SELECT * FROM users 
    WHERE id != '".$_SESSION['p_id']."' 
    ";
}
else
{
    $query = "
    SELECT * FROM users 
    WHERE id != '".$_SESSION['u_id']."' 
    "; 
}

$result = mysqli_query($conn, $query);
$rows = mysqli_num_rows($result);
$user_data = mysqli_fetch_array($result);

$output = '
<table class="table table-bordered table-striped">
 <tr>
  <th width="50%">Username</td>
  <th width="25%">Status</td>
  <th width="25%">Action</td>
 </tr>
';
if (isset($_SESSION['p_id']))
{
    foreach($result as $row)
    {
    $status = '';
    $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
    $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
    $user_last_activity = fetch_user_last_activity($row['id'], $conn);
    if($user_last_activity > $current_timestamp)
    {
    $status = '<span class="badge badge-success">Online</span>';
    }
    else
    {
    $status = '<span class="badge badge-danger">Offline</span>';
    }
    $output .= '
    <tr>
    <td>'.$row['username'].'<span> '.count_unseen_message($row['id'], $_SESSION['p_id'], $conn).' </span>'.fetch_is_type_status($row['id'], $conn).'</td>
    <td>'.$status.'</td>
    <td><button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'.$row['id'].'" data-tousername="'.$row['username'].'">Start Chat</button></td>
    </tr>
    ';
}

$output .= '</table>';

echo $output;

}
else
{
    foreach($result as $row)
{
 $status = '';
 $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
 $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
 $user_last_activity = fetch_user_last_activity($row['id'], $conn);
 if($user_last_activity > $current_timestamp)
 {
  $status = '<span class="label label-success">Online</span>';
 }
 else
 {
  $status = '<span class="label label-danger">Offline</span>';
 }
 $output .= '
 <tr>
  <td>'.$row['username'].' '.count_unseen_message($row['id'], $_SESSION['u_id'], $conn).' '.fetch_is_type_status($row['id'], $conn).'</td>
  <td>'.$status.'</td>
  <td><button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'.$row['id'].'" data-tousername="'.$row['username'].'">Start Chat</button></td>
 </tr>
 ';
}

$output .= '</table>';

echo $output;

}

?>