<?php
session_start();
require_once 'config/config.php';
include_once('counting.php');
require_once BASE_PATH . '/includes/auth_validate.php';

$select = array('id', 'username','email','gender','phone','account_type');


$chunk_size = 100;
$offset = 0;

$total_count = (int) counting('users');

$handle = fopen('php://memory', 'w');

fputcsv($handle,$select);
$filename = 'export_users.csv';


$num_queries = ceil($total_count/$chunk_size);

//Prevent memory leak for large number of rows by using limit and offset :
for ($i=0; $i<$num_queries; $i++){

    $sql="SELECT id, username,email,gender,phone,account_type FROM `users`
    Where account_type = 'Client'
    limit $chunk_size offset $offset ";

    $rows=mysqli_query($conn, $sql);

    $offset = $offset + $chunk_size;
    foreach ($rows as $row) {

        fputcsv($handle,array($row['id'], $row['username'],$row['email'],$row['gender'],$row['phone'],$row['account_type']));
    }
}

// reset the file pointer to the start of the file
fseek($handle, 0);
// tell the browser it's going to be a csv file
header('Content-Type: application/csv');
// Save instead of displaying csv string
header('Content-Disposition: attachment; filename="'.$filename.'";');
//Send the generated csv lines directly to browser
fpassthru($handle);

