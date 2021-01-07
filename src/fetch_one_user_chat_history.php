<?php


include('forMsg_one.php');

session_start();

if(isset($_SESSION['p_id']) )    
{
    echo fetch_one_user_chat_history($_SESSION['p_id'], $_POST['to_user_id'], $conn);
}
else
{
    echo fetch_one_user_chat_history($_SESSION['u_id'], $_POST['to_user_id'], $conn);
    
}


?>
