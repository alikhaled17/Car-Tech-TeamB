<?php
session_start();
require_once 'config/config.php';
include_once('counting.php');
require_once BASE_PATH . '/includes/auth_validate.php';

$select = array('Email','Subject','Massege','Date');


$chunk_size = 100;
$offset = 0;

$total_count = (int) counting('sent_messages');

$handle = fopen('php://memory', 'w');

fputcsv($handle,$select);
$filename = 'export_sent_messages.csv';


$num_queries = ceil($total_count/$chunk_size);

//Prevent memory leak for large number of rows by using limit and offset :
for ($i=0; $i<$num_queries; $i++){

    $sql="SELECT * FROM `sent_messages` 
    limit $chunk_size offset $offset ";

    $rows=mysqli_query($conn, $sql);

    $offset = $offset + $chunk_size;
    foreach ($rows as $row) {

        fputcsv($handle,array($row['Email'],$row['Subject'],$row['Massege'],$row['date_time']));
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

