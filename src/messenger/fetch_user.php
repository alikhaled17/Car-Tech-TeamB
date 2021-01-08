<?php

include('forMsg.php');
include('../../Config.php'); 
session_start();


if(isset($_SESSION['p_id']) )    
{


    $id=$_SESSION['p_id'];
    $query = "
    SELECT  * FROM `users` 
    right OUTER JOIN `chat_message`
    ON users.id = chat_message.from_user_id or (users.id = chat_message.to_user_id and users.id = chat_message.from_user_id)
    WHERE  users.id != $id
    GROUP BY(users.id)
    ";
}
else
{
    $id=$_SESSION['u_id'];
    $query = "
    SELECT  * FROM `users` 
    LEFT OUTER JOIN `chat_message`
    ON users.id = chat_message.from_user_id 
    WHERE  users.id != $id  
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
    date_default_timezone_set("Africa/Cairo");
    $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 15 second ');
    $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
    $user_last_activity = fetch_user_last_activity($row['id'], $conn);

    if($user_last_activity > $current_timestamp)
    {
        $st_class = "online";
        $status = '<span>Online</span>';
    }
    else
    {
        $st_class = "offline";
        $status = '<span>Offline</span>';
    }
    $output .= '
    <li class="clearfix">
        <button type="button" class="start_chat" data-touserid="'.$row['id'].'" data-tousername="'.$row['username'].'">
            '. strtoupper(substr($row['username'], 0, 1)) .'
        </button>
        <div class="about">
            <div class="name">'.$row['username'] .  '<span> '.count_unseen_message($row['id'], $id, $conn).' </span></div>
            <div class="status">
                <i class="fa fa-circle '.$st_class.'"></i> '.$status.'
            </div>
        </div>
    </li>
    ';
}

$output .= ' </ul>';

echo $output;

}


?>