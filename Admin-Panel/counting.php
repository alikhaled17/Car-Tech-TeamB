<?php
require_once './config/config.php';
require_once 'includes/auth_validate.php';

function counting($table_name) {
    include('./config/config.php');
    $sql="SELECT count(*) FROM $table_name";
    $result=mysqli_query($conn, $sql);
    while ($row = $result->fetch_assoc()) {
        $numCustomers = $row['count(*)'];
    };
    return $numCustomers;
};

function counting_type($table_name,$column_name,$types) {
    include('./config/config.php');
    $sql="SELECT count(*) FROM `$table_name`
    WHERE $column_name =$types";
    $result=mysqli_query($conn, $sql);
    while ($row = $result->fetch_assoc()) {
        $numCustomers = $row['count(*)'];
    };
    return $numCustomers;
};


?>