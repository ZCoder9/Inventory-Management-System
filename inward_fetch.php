
<?php

//product_fetch.php

include('database_connection.php');
include('function.php');

$query = '';

$output = array();
$query .= "
	SELECT * FROM inward 
INNER JOIN vendor ON vendor.vendor_id = inward.inward_vendor_id
INNER JOIN product ON product.product_id = inward.inward_product_id 

";

if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE vendor.vendor_name LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR product.product_name LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR product.product_quantity LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR product.product_id LIKE "%'.$_POST["search"]["value"].'%" ';
}

if(isset($_POST['order']))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY product_id DESC ';
}

if($_POST['length'] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
	$status = '';
	if($row['product_status'] == 'active')
	{
		$status = '<span class="label label-success">Active</span>';
	}
	else
	{
		$status = '<span class="label label-danger">Inactive</span>';
	}
	$sub_array = array();
	$sub_array[] = $row['inward_id'];
	$sub_array[] = $row['product_name'];
	$sub_array[] = $row['inward_date'];
	// $sub_array[] = $row['quantity'];
	$sub_array[] = $row['vendor_name'];
	$sub_array[] = $row['quantity'];
	$sub_array[] = $status;
	$sub_array[] = $row['price_per_item'];
	$sub_array[] = $row['total_price'];
	$sub_array[] = $row['tax'];
	$sub_array[] = $row['total_tax'];
	$sub_array[] = $row['total_item_amount'];
	$sub_array[] = $row['total_transcost'];
	$sub_array[] = $row['total_bill_amount'];

	$data[] = $sub_array;
}

function get_total_all_records($connect)
{
	$statement = $connect->prepare('SELECT * FROM inward');
	$statement->execute();
	return $statement->rowCount();
}

$output = array(
	"draw"    			=> 	intval($_POST["draw"]),
	"recordsTotal"  	=>  $filtered_rows,
	"recordsFiltered" 	=> 	get_total_all_records($connect),
	"data"    			=> 	$data
);

echo json_encode($output);

?>