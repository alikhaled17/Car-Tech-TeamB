
<?php
session_start();
include('forMsg.php');
//insert_chat.php
if(isset($_SESSION['p_id']) )    
{
    $id=$_SESSION['p_id'] ;
}
else
{
    $id=$_SESSION['u_id'] ; 
}

$data = array(
 ':to_user_id'  => $_POST['to_user_id'],
 ':from_user_id'  => $id,
 ':chat_message'  => $_POST['chat_message'],
 ':status'   => '1'
);

$query = "
INSERT INTO chat_message 
(to_user_id, from_user_id, chat_message, status) 
VALUES (:to_user_id, :from_user_id, :chat_message, :status)
";

$statement = $conn->prepare($query);

if($statement->execute($data))
{
    if(isset($_SESSION['p_id']) )    
    {
        echo fetch_user_chat_history($_SESSION['p_id'], $_POST['to_user_id'], $conn);
    }
    else
    {
        echo fetch_user_chat_history($_SESSION['u_id'], $_POST['to_user_id'], $conn);   
    }
}

?>

