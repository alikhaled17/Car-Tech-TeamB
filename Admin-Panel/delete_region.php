<?php 
session_start();
require_once 'includes/auth_validate.php';
require_once './config/config.php';
$del_id = filter_input(INPUT_POST, 'del_id');



// Delete a user using user_id
if ($del_id && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "DELETE FROM regions WHERE id=$del_id";
    echo $sql;
    $result=mysqli_query($conn, $sql); 
    // $db->where('id', $del_id);
    // $stat = $db->delete('admin_accounts');
    if ($result) {
        $_SESSION['info'] = "User deleted successfully!";
        header('location: Region_show.php');
        exit;
    }
    else
    {
        $_SESSION['failure'] = "Unable to delete Region";
        echo 'sql';
    	header('location: Region_show.php');
        exit;

    }
    echo 'sql';
}

echo 'sql';