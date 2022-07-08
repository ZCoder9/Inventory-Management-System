<?php
//header.php
?>
<!DOCTYPE html>
<html>
<head>
		<title>Envin Engineering</title>
		<script src="js/jquery-1.10.2.min.js"></script>
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<script src="js/jquery.dataTables.min.js"></script>
		<script src="js/dataTables.bootstrap.min.js"></script>		
		<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
		<script src="js/bootstrap.min.js"></script>
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="css/extra.css" />
	</head>
	<body>
		<br />
		<div class="container">
			<!-- <h2 align="center">Envin Engg Inventory</h2> -->

			
			<h1 class="ml6">
  <span class="text-wrapper">
    <span class="letters">Envin Engineering</span>
  </span>
</h1>

<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>

<script>
	var textWrapper = document.querySelector('.ml6 .letters');
textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

anime.timeline({loop: false})
  .add({
    targets: '.ml6 .letter',
    translateY: ["1.1em", 0],
    translateZ: 0,
    duration: 750,
    delay: (el, i) => 50 * i
  });
//   .add({
//     targets: '.ml6',
//     opacity: 0,
//     duration: 1000,
//     easing: "easeOutExpo",
//     delay: 1000
//   });
</script>



			<nav class="navbar navbar-inverse">
				<div class="container-fluid">
					<div class="navbar-header">
						<a href="index.php" class="navbar-brand">Home</a>
					</div>
					<ul class="nav navbar-nav">
					<?php
					if($_SESSION['type'] == 'master')
					{
					?>
					
						<li><a href="category.php">Category</a></li>
						<li><a href="brand.php">Brand</a></li>
						<li><a href="product.php">Product</a></li>
						<li><a href="stocks.php">Stocks</a></li>
						<li><a href="vendor.php">Vendor</a></li>
						<li><a href="inward.php">Inward</a></li>
						<li><a href="customer.php">Customer</a></li>
						<li><a href="order.php">Outward1</a></li>
					<?php
					}
					?>
						<!-- <li><a href="order.php">Order</a></li> -->
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count"></span> <?php echo $_SESSION["user_name"]; ?></a>
							<ul class="dropdown-menu">
								<li><a href="profile.php">Profile</a></li>
								<li><a href="logout.php">Logout</a></li>
							</ul>
						</li>
					</ul>

				</div>
			</nav>
			
			