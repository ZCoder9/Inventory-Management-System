<?php

//product_action.php

include('database_connection.php');

include('function.php');


if(isset($_POST['btn_action']))
{
	if($_POST['btn_action'] == 'load_brand')
	{
		echo fill_brand_list($connect, $_POST['category_id']);
	}

	if($_POST['btn_action'] == 'Add')
	{
		$query = "
		INSERT INTO inward ( inward_date, inward_product_id, inward_vendor_id, quantity, price_per_item, total_price, tax, total_tax, total_item_amount, peritem_transcost, total_transcost, total_bill_amount, stock_type)
        VALUES ( :inward_date,:inward_product_id , :inward_vendor_id, :quantity, :price_per_item ,:total_price,:tax ,:total_tax , :total_item_amount, :peritem_transcost, :total_transcost , :total_bill_amount, :stock_type);
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
                ':inward_date'			=>	date("Y-m-d"),
				':inward_product_id'	=>	$_POST['inward_product_id'],
				':inward_vendor_id'		=>	$_POST['inward_vendor_id'],
				':quantity'			    =>	$_POST['quantity'],
				':price_per_item'	    =>	$_POST['price_per_item'],
				':total_price'		    =>	intval($_POST['quantity']*$_POST['price_per_item']),
				':tax'			        =>	$_POST['tax'],
				':total_tax'	        =>	intval($_POST['tax']*0.01*$_POST['quantity']*$_POST['price_per_item']),
				':total_item_amount'	=>	intval($_POST['quantity']*$_POST['price_per_item']) + intval($_POST['tax']*0.01*$_POST['quantity']*$_POST['price_per_item']),
				':peritem_transcost'	=>	$_POST['peritem_transcost'],
				':total_transcost'	    =>	$_POST['peritem_transcost'],
				':total_bill_amount'	=>	intval($_POST['quantity']*$_POST['price_per_item']) + intval($_POST['tax']*0.01*$_POST['quantity']*$_POST['price_per_item']) + $_POST['peritem_transcost'],
				':stock_type'	        =>	$_POST['stock_type'],
				
				
			)
		);

		//25 june
		
		$qua=intval($_POST['quantity']);
		$iid=intval($_POST['inward_product_id']);

		$cq = "select `product_quantity` from `product` WHERE `product_id` =? ";
		$q=$connect->prepare($cq);
		$q->execute([$iid]);
		$temp1=$q->fetchColumn();
		$temp1=$temp1+$qua;


		try{
            $sql = "UPDATE `product` set `product_quantity` = $temp1 WHERE `product_id` = $iid";
            $connect->exec($sql);
            echo "Records was updated successfully.";
        } catch(PDOException $e){
            die("ERROR: Could not able to execute $sql. "
                                        . $e->getMessage());
        }
		
	}
// 	if($_POST['btn_action'] == 'product_details')
// 	{
// 		$query = "
// 		SELECT * FROM product 
// 		INNER JOIN category ON category.category_id = product.category_id 
// 		INNER JOIN brand ON brand.brand_id = product.brand_id 
// 		INNER JOIN user_details ON user_details.user_id = product.product_enter_by 
// 		WHERE product.product_id = '".$_POST["product_id"]."'
// 		";
// 		$statement = $connect->prepare($query);
// 		$statement->execute();
// 		$result = $statement->fetchAll();
// 		$output = '
// 		<div class="table-responsive">
// 			<table class="table table-boredered">
// 		';
// 		foreach($result as $row)
// 		{
// 			$status = '';
// 			if($row['product_status'] == 'active')
// 			{
// 				$status = '<span class="label label-success">Active</span>';
// 			}
// 			else
// 			{
// 				$status = '<span class="label label-danger">Inactive</span>';
// 			}
// 			$output .= '
// 			<tr>
// 				<td>Product Name</td>
// 				<td>'.$row["product_name"].'</td>
// 			</tr>
// 			<tr>
// 				<td>Product Description</td>
// 				<td>'.$row["product_description"].'</td>
// 			</tr>
// 			<tr>
// 				<td>Category</td>
// 				<td>'.$row["category_name"].'</td>
// 			</tr>
// 			<tr>
// 				<td>Brand</td>
// 				<td>'.$row["brand_name"].'</td>
// 			</tr>
// 			<tr>
// 				<td>Available Quantity</td>
// 				<td>'.$row["product_quantity"].' '.$row["product_unit"].'</td>
// 			</tr>
// 			<tr>
// 				<td>Base Price</td>
// 				<td>'.$row["product_base_price"].'</td>
// 			</tr>
// 			<tr>
// 				<td>Tax (%)</td>
// 				<td>'.$row["product_tax"].'</td>
// 			</tr>
// 			<tr>
// 				<td>Enter By</td>
// 				<td>'.$row["user_name"].'</td>
// 			</tr>
// 			<tr>
// 				<td>Status</td>
// 				<td>'.$status.'</td>
// 			</tr>
// 			';
// 		}
// 		$output .= '
// 			</table>
// 		</div>
// 		';
// 		echo $output;
// 	}
// 	if($_POST['btn_action'] == 'fetch_single')
// 	{
// 		$query = "
// 		SELECT * FROM product WHERE product_id = :product_id
// 		";
// 		$statement = $connect->prepare($query);
// 		$statement->execute(
// 			array(
// 				':product_id'	=>	$_POST["product_id"]
// 			)
// 		);
// 		$result = $statement->fetchAll();
// 		foreach($result as $row)
// 		{
// 			$output['category_id'] = $row['category_id'];
// 			$output['brand_id'] = $row['brand_id'];
// 			$output["brand_select_box"] = fill_brand_list($connect, $row["category_id"]);
// 			$output['product_name'] = $row['product_name'];
// 			$output['product_description'] = $row['product_description'];
// 			$output['product_quantity'] = $row['product_quantity'];
// 			$output['product_unit'] = $row['product_unit'];

// 			$output['product_base_price'] = $row['product_base_price'];
// 			$output['product_tax'] = $row['product_tax'];
// 		}
// 		echo json_encode($output);
// 	}

// 	if($_POST['btn_action'] == 'Edit')
// 	{
// 		$query = "
// 		UPDATE product 
// 		set category_id = :category_id, 
// 		brand_id = :brand_id,
// 		product_name = :product_name,
// 		product_description = :product_description, 
// 		product_quantity = :product_quantity, 
// 		product_unit = :product_unit, 
// 		product_base_price = :product_base_price, 
// 		product_tax = :product_tax 
// 		WHERE product_id = :product_id
// 		";
// 		$statement = $connect->prepare($query);
// 		$statement->execute(
// 			array(
// 				':category_id'			=>	$_POST['category_id'],
// 				':brand_id'				=>	$_POST['brand_id'],
// 				':product_name'			=>	$_POST['product_name'],
// 				':product_description'	=>	$_POST['product_description'],
// 				':product_quantity'		=>	$_POST['product_quantity'],
// 				':product_unit'			=>	$_POST['product_unit'],
// 				':product_base_price'	=>	$_POST['product_base_price'],
// 				':product_tax'			=>	$_POST['product_tax'],
// 				':product_id'			=>	$_POST['product_id']
// 			)
// 		);
// 		$result = $statement->fetchAll();
// 		if(isset($result))
// 		{
// 			echo 'Product Details Edited';
// 		}
// 	}
// 	if($_POST['btn_action'] == 'delete')
// 	{
// 		$status = 'active';
// 		if($_POST['status'] == 'active')
// 		{
// 			$status = 'inactive';
// 		}
// 		$query = "
// 		UPDATE product 
// 		SET product_status = :product_status 
// 		WHERE product_id = :product_id
// 		";
// 		$statement = $connect->prepare($query);
// 		$statement->execute(
// 			array(
// 				':product_status'	=>	$status,
// 				':product_id'		=>	$_POST["product_id"]
// 			)
// 		);
// 		$result = $statement->fetchAll();
// 		if(isset($result))
// 		{
// 			echo 'Product status change to ' . $status;
// 		}
// 	}
}


?>