<?php
//index.php
include('database_connection.php');
include('function.php');

if(!isset($_SESSION["type"]))
{
	header("location:login.php");
}

include('header.php');

?>

	<br />
	<div class="row">
	<?php
	if($_SESSION['type'] == 'master')
	{
	?>
	
	<div class="col-md-3">
		<div class="col-md-3-btn">
			<div class="panel panel-default">
				<div class="panel-heading">
				<a href="stocks.php">
				<button type="button" class="btn1" style="height: 116px; width: 232px; background-color: #f5f5f5; font-size: x-large;">Check Stocks</button>
				</a>
				</div>		
			</div>
		</div>	
	</div>
	<div class="col-md-3">
		<div class="col-md-3-btn">
			<div class="panel panel-default">
				<div class="panel-heading">
				<button type="button" class="btn1" style="height: 116px; width: 232px; background-color: #f5f5f5; font-size: x-large;">Check Manufacturing Requirement</button>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="panel panel-default">
			<div class="panel-heading"><strong>Date</strong></div>
			<div class="panel-body" align="center">
				<h1><?php date_default_timezone_set("Asia/Calcutta");
						  echo date("d-m-Y");
					?></h1>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="panel panel-default">
			<div class="panel-heading"><strong>Time</strong></div>
			<div class="panel-body" align="center">
				<h1><?php date_default_timezone_set("Asia/Calcutta");
						  echo date("H:i:s"); ?></h1>
			</div>
		</div>
	</div>
	
	<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">
				<a href="inward.php">
				<button type="button" class="btn1" style="height: 116px; width: 232px; background-color: #f5f5f5; font-size: x-large;">Update Inward(Inventory)</button></a>
				</div>
			</div>
		
	</div>
	<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">
				<a href="vendor.php">
				<button type="button" class="btn1" style="height: 116px; width: 232px; background-color: #f5f5f5; font-size: x-large;">Add Vendor</button></a>
				</div>
			</div>
	</div>
	<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">
				<a href="customer.php">
				<button type="button" class="btn1" style="height: 116px; width: 232px; background-color: #f5f5f5; font-size: x-large;">Add Customer</button></a>
				</div>
			</div>
	</div>
	<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">
				<a href="product.php">
				<button type="button" class="btn1" id="addProduct" data-target="product.php" style="height: 116px; width: 232px; background-color: #f5f5f5; font-size: x-large;">Add new Product</button></a>
				</div>
			</div>
	</div>
	<?php
	}
	?>
		<!-- <div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading"><strong>Loss</strong></div>
				<div class="panel-body" align="center">
					<h1>₹<?php echo count_total_order_value($connect); ?></h1>
				</div>
			</div>
		</div>
		
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading"><strong>Profit</strong></div>
				<div class="panel-body" align="center">
					<h1>₹<?php echo count_total_credit_order_value($connect); ?></h1>
				</div>
			</div>
		</div> -->
		<hr />
		<?php
		if($_SESSION['type'] == 'master')
		{
		?>
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading"><strong>Inventory Reports</strong></div>
				<div class="panel-body" align="center">
					<?php echo get_user_wise_total_order($connect); ?>
				</div>
			</div>
		</div>
		<?php
		}
		?>
	</div>
<?php
include("footer.php");
?>
  <!-- <script>
			$('#addProduct').on('click', function(event) {
		event.preventDefault(); 
		var url = $(this).data('target');
		location.replace(url);
			$(#add_button).click();
		});
	
      </script> -->