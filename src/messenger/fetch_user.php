<?php
include('forMsg.php');

include('../../Config.php'); 

session_start();


if(isset($_SESSION['p_id']) )    
{
    $id=$_SESSION['p_id'];
}
else
{
    $id=$_SESSION['u_id']; 
}
$query = "
SELECT  * FROM `users` LEFT OUTER JOIN `favorite`
ON users.id = favorite.favorite_id
LEFT OUTER JOIN `chat_message`
ON users.id = chat_message.from_user_id
WHERE favorite.user_id = $id OR chat_message.to_user_id = $id
GROUP BY(users.id)
    ";   

$result = mysqli_query($conn, $query);
$rows1 = mysqli_num_rows($result);

$messages = array();
while($user_data = mysqli_fetch_array($result)){
    array_push($messages, $user_data);
}

$query2 = "
SELECT  * FROM `users` 
LEFT OUTER JOIN `chat_message` ON users.id = chat_message.to_user_id
WHERE chat_message.from_user_id = $id
GROUP BY(users.id)
    ";

$result = mysqli_query($conn, $query2);
$rows2 = mysqli_num_rows($result);

while($user_data = mysqli_fetch_array($result)){
    $isUnique = true;
    foreach($messages as $element) {
        if([$element][0]["id"] == [$user_data][0]["id"]) {
            $isUnique = false;
        }
    }
    if($isUnique)
        array_push($messages, $user_data);
}

if ($rows1<1 && $rows2<1)
{
    echo "<script>
    document.getElementById('chatContainer').innerHTML  = 'No Massages';
    document.getElementById('chatContainer').style.color  = 'black';
    </script>";
    echo "<script>
    document.getElementById('chatBody').style.display = 'none';
    </script>";
}
else
{

    $output = '
        <ul class="list">
    ';
    if (isset($_SESSION['p_id']) || isset($_SESSION['u_id']) )
    {
        foreach($messages as $user_data)
        {
        $status = '';
        date_default_timezone_set("Africa/Cairo");
        $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 15 second ');
        $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
        $user_last_activity = fetch_user_last_activity($user_data['id'], $conn);

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
            <button type="button" class="start_chat" data-touserid="'.$user_data['id'].'" data-tousername="'.$user_data['username'].'">
                <img  src="data:image/jpg;charset=utf8mb4;base64,'. base64_encode($user_data['prof_img']) .'" alt="avatar" />
            </button>
            <div class="about">
                <div class="name">'.$user_data['username'] .  '<span> '.count_unseen_message($user_data['id'], $id, $conn).' </span></div>
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
}

?>