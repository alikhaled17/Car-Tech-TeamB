<?php 
session_start();
require_once 'includes/auth_validate.php';
require_once './config/config.php';
$del_id = filter_input(INPUT_POST, 'del_id');


// Delete a user using user_id
if ($del_id && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "DELETE FROM sent_messages WHERE id=$del_id";
    $result=mysqli_query($conn, $sql); 

    if ($result) {
        $_SESSION['info'] = "Message deleted successfully!";
        header('location: Sent_messages_show.php');
        exit;
    }
    else
    {
    	$_SESSION['failure'] = "Unable to delete Message";
    	header('location: Sent_messages_show.php');
        exit;

    }
}