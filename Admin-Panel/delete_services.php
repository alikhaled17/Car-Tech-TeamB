<?php 
session_start();
require_once 'includes/auth_validate.php';
require_once './config/config.php';
$del_id = filter_input(INPUT_POST, 'del_id');

echo ($del_id);

// Delete
if ($del_id && $_SERVER['REQUEST_METHOD'] == 'POST') {
    echo ('Hellllo');
    $sql = "DELETE FROM services WHERE id=$del_id";
    $result=mysqli_query($conn, $sql); 

    if ($result) {
        $_SESSION['info'] = "User deleted successfully!";
        header('location: services_Show.php');
        exit;
    }
    else
    {
    	$_SESSION['failure'] = "Unable to delete Services";
    	header('location: services_Show.php');
        exit;

    }
}