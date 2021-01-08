<?php
// Get Input data from query string
$search_string = filter_input(INPUT_GET, 'search_string');
$filter_col = filter_input(INPUT_GET, 'filter_col');
$order_by = filter_input(INPUT_GET, 'order_by');

// Per page limit for pagination.
$pagelimit = 10;

// Get current page.
$page = filter_input(INPUT_GET, 'page');
if (!$page) {
	$page = 1;
}

// If filter types are not selected we show latest added data first
if (!$filter_col) {
	$filter_col = 'id';
}
if (!$order_by) {
	$order_by = 'Asc';
}

$sql="SELECT $select_coul FROM $nema_table";

if($select_types != null ) {
	$sql.=" WHERE $types = $select_types";
}


// If search string
if ($search_string)
{
	if ($select_types != null){
		$sql.=" and";
	}else{
		$sql.=" WHERE";
	}
    $sql.=" $coul like  '$search_string%' ";
}

//If order by option selected
if ($order_by)
{
    $sql.=" ORDER BY $filter_col $order_by";

}

// Set pagination limit
$offset = ($page - 1) * $pagelimit ;

// Get result of the query.
$sql.=" LIMIT $pagelimit OFFSET $offset";
$rows=mysqli_query($conn, $sql);
$total_count = 0 ;
if ($nema_table_count == 'users' || $nema_table_count == 'providers'){
	$total_count = counting_type($nema_table_count, $types, $select_types_count);
}else {
	$total_count = counting($nema_table);
}
$total_pages = ceil( $total_count / $pagelimit);
//}
?>
