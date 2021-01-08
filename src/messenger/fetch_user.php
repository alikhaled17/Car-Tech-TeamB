<?php
//fetch_user.php
include('forMsg.php');

session_start();

if (isset($_SESSION['p_id']) ) {
    $id=$_SESSION['p_id'];
} else {
    $id=$_SESSION['u_id'];
}
$query = "
SELECT  * FROM `users` 
LEFT OUTER JOIN `chat_message`
ON users.id = chat_message.from_user_id
WHERE  chat_message.to_user_id = $id or chat_message.from_user_id = $id 
GROUP BY(users.id)
";   

$result = mysqli_query($conn, $query);
$rows = mysqli_num_rows($result);

if ($rows<1)
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
        
        // echo "last: " . $user_last_activity ."<br>";
        // echo "time: " . $current_timestamp ."<br>";

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
                <img  src="data:image/jpg;charset=utf8mb4;base64,'. base64_encode($row['prof_img']) .'" alt="avatar" />
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
}

?>