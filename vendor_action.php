<?php

//vendor_action.php

include('database_connection.php');

if(isset($_POST['btn_action']))
{
	if($_POST['btn_action'] == 'Add')
	{
		$query = "
		INSERT INTO vendor (vendor_id, vendor_name, vendor_contact, vendor_address, vendor_status) 
		VALUES (:vendor_id, :vendor_name, :vendor_contact, :vendor_address, :vendor_status)
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':vendor_id'			=>	$_POST['vendor_id'],
				':vendor_name'			=>	$_POST['vendor_name'],
				':vendor_contact'	    =>	$_POST['vendor_contact'],
				':vendor_address'		=>	$_POST['vendor_address'],
				':vendor_status'		=>	'active',
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Vendor Added';
		}
	}
	
	if($_POST['btn_action'] == 'fetch_single')
	{
		$query = "SELECT * FROM vendor WHERE vendor_id = :vendor_id";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':vendor_id'	=>	$_POST["vendor_id"]
			)
		);
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output['vendor_id '] = $row['vendor_id'];
			$output['vendor_name'] = $row['vendor_name'];
			$output['vendor_contact'] = $row['vendor_contact'];
			$output['vendor_address'] = $row['vendor_address'];
			$output['vendor_status'] = $row['vendor_status'];
		}
		echo json_encode($output);
	}

	if($_POST['btn_action'] == 'Edit')
	{
		$query = "
		UPDATE vendor set vendor_name = :vendor_name,
		vendor_contact= :vendor_contact,
		vendor_address= :vendor_address  
		WHERE vendor_id = :vendor_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':vendor_name'	=>	$_POST["vendor_name"],
				':vendor_contact'	=>	$_POST["vendor_contact"],
				':vendor_address'	=>	$_POST["vendor_address"],
				':vendor_id'		=>	$_POST["vendor_id"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'vendor details Edited';
		}
	}
	if($_POST['btn_action'] == 'delete')
	{
		$status = 'active';
		if($_POST['status'] == 'active')
		{
			$status = 'inactive';	
		}
		$query = "
		UPDATE vendor 
		SET vendor_status = :vendor_status 
		WHERE vendor_id = :vendor_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':vendor_status'	=>	$status,
				':vendor_id'		=>	$_POST["vendor_id"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'vendor status change to ' . $status;
		}
	}
}

?>