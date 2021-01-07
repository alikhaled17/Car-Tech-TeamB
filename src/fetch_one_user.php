<?php
//fetch_user.php
include('forMsg_one.php');


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
    $o=$_SESSION['p_id'];
    $id=$_GET['id'];
    $query = "
    SELECT  * FROM `users` 
    LEFT OUTER JOIN `chat_message`
    ON users.id = chat_message.from_user_id
    WHERE  chat_message.to_user_id = $id  
    ";  
   
}
$result = mysqli_query($conn, $query);
$rows = mysqli_num_rows($result);
$user_data = mysqli_fetch_array($result);


if (isset($_SESSION['p_id']))
{
    foreach($result as $row)
    {
        $output = '
        <div class="clearfix">
            <button type="button" class="start_chat" data-touserid="'.$id.'" data-tousername="'.$user_data['username'].'">
                start
            </button>
            <div class="about">
                <div class="name">'.$user_data['username'] .  '</div>
            </div>
        </div>
        ';
}


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