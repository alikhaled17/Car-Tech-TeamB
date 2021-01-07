<?php

//fetch_user_chat_history.php

include('forMsg.php');

session_start();
if(isset($_SESSION['p_id']) )    
{
    echo fetch_user_chat_history($_SESSION['p_id'], $_POST['to_user_id'], $conn);

}
else
{
    echo fetch_user_chat_history($_SESSION['u_id'], $_POST['to_user_id'], $conn);
    
}


?>
