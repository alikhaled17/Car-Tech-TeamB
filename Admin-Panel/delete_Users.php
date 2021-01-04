<?php 
session_start();
require_once 'includes/auth_validate.php';
require_once './config/config.php';
$del_id = filter_input(INPUT_POST, 'del_id');


// Delete a user using user_id
if ($del_id && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "DELETE FROM users WHERE id=$del_id && account_type='Client' ";
    $result=mysqli_query($conn, $sql); 
    // $db->where('id', $del_id);
    // $stat = $db->delete('admin_accounts');
    if ($result) {
        $_SESSION['info'] = "User deleted successfully!";
        header('location: Users_show.php');
        exit;
    }
    else
    {
    	$_SESSION['failure'] = "Unable to delete Users";
    	header('location: Users_show.php');
        exit;

    }
}