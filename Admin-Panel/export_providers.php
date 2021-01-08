<?php
session_start();
require_once 'config/config.php';
include_once('counting.php');
require_once BASE_PATH . '/includes/auth_validate.php';

$select = array('ID', 'User Name','Email','phone','City Name','Region Name',
'Service Name','Account Type','Provider State');


$chunk_size = 100;
$offset = 0;

$total_count = (int) counting('users');

$handle = fopen('php://memory', 'w');

fputcsv($handle,$select);
$filename = 'export_providers.csv';


$num_queries = ceil($total_count/$chunk_size);

//Prevent memory leak for large number of rows by using limit and offset :
for ($i=0; $i<$num_queries; $i++){

    $sql="SELECT users.id, username,email,phone,city_name,region_name,account_type,prov_state, group_concat(ser_name SEPARATOR ',')ser_name FROM `users`
    inner join p_address on users.id = p_address.p_id
    inner join regions on p_address.region_id = regions.id
    inner join cities on regions.city_id = cities.id
    inner join prov_services on prov_services.p_id = users.id
    inner join providers on providers.user_id = users.id
    inner join services on services.id = prov_services.ser_id
    Where prov_state = 'accept' GROUP BY users.id
    limit $chunk_size offset $offset ";
    $rows=mysqli_query($conn, $sql);

    $offset = $offset + $chunk_size;

    foreach ($rows as $row) {

        fputcsv($handle,array($row['id'], $row['username'],$row['email'],$row['phone'],
        $row['city_name'],$row['region_name'],$row['ser_name'],$row['account_type'],$row['prov_state']));
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

