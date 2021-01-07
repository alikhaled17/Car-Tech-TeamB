<?php
//fetch_user.php
include('forMsg.php');


session_start();

/***
 * SELECT  * FROM `users` LEFT OUTER JOIN `favorite`
ON users.id = favorite.favorite_id
LEFT OUTER JOIN `chat_message`
ON users.id = chat_message.from_user_id
WHERE favorite.user_id = 4 OR chat_message.to_user_id = 4
GROUP BY(users.id)
 */
if(isset($_SESSION['p_id']) )    
{
    $id=$_SESSION['p_id'];
    $query = "
    SELECT  * FROM `users` LEFT OUTER JOIN `favorite`
    ON users.id = favorite.favorite_id
    LEFT OUTER JOIN `chat_message`
    ON users.id = chat_message.from_user_id
    WHERE favorite.user_id = $id OR chat_message.to_user_id = $id
    GROUP BY(users.id)
    ";  
}
else
{
    $id=$_SESSION['u_id'];
    $query = "
    SELECT  * FROM `users` LEFT OUTER JOIN `favorite`
    ON users.id = favorite.favorite_id
    LEFT OUTER JOIN `chat_message`
    ON users.id = chat_message.from_user_id
    WHERE favorite.user_id = $id OR chat_message.to_user_id = $id
    GROUP BY(users.id)
    ";   
}

$result = mysqli_query($conn, $query);
$rows = mysqli_num_rows($result);
$user_data = mysqli_fetch_array($result);

$output = '
      <ul class="list">
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
    <li class="clearfix">
        <button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'.$row['id'].'" data-tousername="'.$row['username'].'"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_10.jpg" alt="avatar" /></button>
        <div class="about">
        <div class="name">'.$row['username'] .  '<span> '.count_unseen_message($row['id'], $id, $conn).' </span></div>
        <div class="status">
            <i class="fa fa-circle online"></i> '.$status.'
        </div>
        </div>
    </li>
    ';
}

$output .= ' </ul>';

echo $output;

}
// else
// {
//     foreach($result as $row)
// {
//  $status = '';
//  $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
//  $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
//  $user_last_activity = fetch_user_last_activity($row['id'], $conn);
//  if($user_last_activity > $current_timestamp)
//  {
//   $status = '<span class="label label-success">Online</span>';
//  }
//  else
//  {
//   $status = '<span class="label label-danger">Offline</span>';
//  }
//  $output .= '
//  <tr>
//   <td>'.$row['username'].' '.count_unseen_message($row['id'], $_SESSION['u_id'], $conn).' '.fetch_is_type_status($row['id'], $conn).'</td>
//   <td>'.$status.'</td>
//   <td><button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'.$row['id'].'" data-tousername="'.$row['username'].'">Start Chat</button></td>
//  </tr>
//  ';
// }

// $output .= '</table>';

// echo $output;

// }

?>