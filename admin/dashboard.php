<?php
   include'../components/connect.php';
   session_start();

   $admin_id = $_SESSION['id'];
   if (!isset($admin_id)) {
   	header('location: log.php');
   }


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href='https://unpkg.com/browse/boxicons@2.1.4/css/boxicons.css' rel='stylsheet'>
	<link rel="stylesheet" type="text/css" href="admin_style.css?v=<?php echo time();?>">
	<title>admin panel</title>
</head>
<body>
	
<div class="main">
	<div class="banner">
		<h1>dashboard</h1>
	</div>
	<section class="dashboard">
		<div class="box-container">
		<div class="box">
		<h3>welcome !</h3>
		<p>Manage Easiliy your works </p>
		<P>The Gallery Cafe</P>
		</div>
		<div class="box">
			<?php
			$select_product = $conn->prepare("SELECT * FROM productst");
			$select_product->execute();
			$nop = $select_product->rowCount();
			?>
			<h3><?=$nop ;?></h3>
			<p>products added</p>
			<a href="add_product.php" class="btn"> add new product</a>
			<a href="view_product.php" class="btn"> edit products</a>
		</div>
		<div class="box">
			<?php
			$select_sub = $conn->prepare("SELECT * FROM subadmin");
			$select_sub->execute();
			$nop = $select_sub->rowCount();
			?>
			<h3><?=$nop ;?></h3>
			<p>Operational Staff</p>
			<a href="addop.php" class="btn"> add </a>
			<a href="addopm.php" class="btn"> manage </a>

		</div>
		<div class="box">
			<?php
			$select_users = $conn->prepare("SELECT * FROM users");
			$select_users->execute();
			$nop = $select_users->rowCount();
			?>
			<h3><?=$nop ;?></h3>
			<p>Registered Users</p>
			<a href="accountsm.php" class="btn"> manage user</a>
			
		</div>
		<div class="box">
			<?php
			$select_orders = $conn->prepare("SELECT * FROM orders");
			$select_orders->execute();
			$nop = $select_orders->rowCount();
			?>
			<h3><?=$nop ;?></h3>
			<p>Total Orders</p>
			<a href="order.php" class="btn"> View Orders</a>
		</div>
		<div class="box">
			<?php
			$select_table = $conn->prepare("SELECT * FROM tbl_booking");
			$select_table->execute();
			$nop = $select_table->rowCount();
			?>
			<h3><?=$nop ;?></h3>
			<p>Total Table Booked</p>
			<a href="book.php" class="btn"> View Bookings</a>
		</div>
		</div>
	</section>
</div>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
	<script src="script.js"></script>
	<?php include '../components/alert.php'; ?>
</body>
</html>