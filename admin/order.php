<?php
   include'../components/connect.php';
   session_start();

   $admin_id = $_SESSION['id'];
   if (!isset($admin_id)) {
   	header('location: log.php');
   }
   if (isset($_POST['delete'])) {
   	$p_id = $_POST['order_id'];
   	$p_id = filter_var($p_id, FILTER_SANITIZE_STRING);

   	$delete_product = $conn->prepare("DELETE FROM orders WHERE id = ?");
   	$delete_product->execute([$p_id]);

   	echo "<script>alert(' deleted success');</script>";
   }
   if (isset($_POST['update'])) {
   	$order_id = $_POST['order_id'];
   	$order_id = filter_var($order_id, FILTER_SANITIZE_STRING);

   	$update_payment = $_POST['update_pay'];
   	$update_payment = filter_var($update_payment, FILTER_SANITIZE_STRING);

   	$update_pay = $conn->prepare("UPDATE orders SET status = ? WHERE id =?");
   	$update_pay->execute([$update_payment,$order_id ]);

   	echo "<script>alert(' updating success');</script>";
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
		<h1>pre-orders</h1>
	</div>
	<section class="order-container">
		<div class="box-container">
		  <?php
		  $select_orders = $conn->prepare("SELECT * FROM orders");
		  $select_orders->execute();

		  if ($select_orders->rowCount() > 0) {
		  	   while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){

		  	   
		  
		  ?>
		  <div class="box">
		  	  <div class="status" style="color: <?php if($fetch_orders['status'] == 'in progress'){echo "green";}else{echo "red";} ?>"><?=$fetch_orders['status']; ?></div>		  	  	
		  	  
		  	  <div class="detail">
		  	  	  <P>order id :<span><?= $fetch_orders['id']; ?></span></P>
		  	  	  <P>user name : <span><?= $fetch_orders['name']; ?></span></P>
		  	  	  <P>user number : <span><?= $fetch_orders['number']; ?></span></P>
		  	  	  <P>user total : <span><?= $fetch_orders['qty']*$fetch_orders['price']?></span></P>
		  	  	  <P>user method : <span><?= $fetch_orders['method']; ?></span></P>
		  	  </div>
		  	  <form action="" method="post" >
		  	  	<input type="hidden" id="order_id" value="<?=$fetch_orders['id']; ?>"> 	  	
		  	  	<select name="update_pay">
		  	  		<option disabled selected><?= $fetch_orders['status']; ?></option>
		  	  		<option value="pending">pending</option>
		  	  		<option value="complete">complete</option>
		  	  	</select>
		  	  	<div class="flex-btn">
		  	  		<a href="delete.php?id=<?=$fetch_orders['id'];?>" class="btn">Delete</a>

		  	  		<a href="updateorder.php?id=<?=$fetch_orders['id']; ?>&st=<?=$fetch_orders['status']?>" class="btn">Update Status</a>
		  	  		
		  	  	</div>
		  	  </form>
		  </div>
		  <?php

		  	   }
		   }

		    ?>
		</div>
	</section>
</div>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
	<script src="script.js"></script>
	<?php include '../components/alert.php'; ?>
</body>
</html>