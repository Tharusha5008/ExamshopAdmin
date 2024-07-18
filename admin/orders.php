<?php
   include'../components/connect.php';
   session_start();

   $admin_id = $_SESSION['id'];
   if (!isset($admin_id)) {
   	header('location: log.php');
   }


   if (isset($_POST['delete'])) {
   	$p_id = $_POST['id'];
   	$p_id = filter_var($p_id, FILTER_SANITIZE_STRING);

   	$delete_product = $conn->prepare("DELETE FROM orders WHERE id = ?");
   	$delete_product->execute([$p_id]);

   	echo "<script>alert(' deleted success');</script>";
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
		<h1>users</h1>
	</div>
	<section class="order-container">
		<h1 class="heading">all users</h1>
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
		  	  	  
		  	  	  <P>user name : <span><?= $fetch_orders['name']; ?></span></P>
		  	  	  <P>user number : <span><?= $fetch_orders['number']; ?></span></P>
		  	  	  <P>user total : <span><?= $fetch_orders['qty']*$fetch_orders['price']?></span></P>
		  	  	  <P>user method : <span><?= $fetch_orders['method']; ?></span></P>
		  	  </div>

			<form action="" method="post" class="box">
				<input type="hidden" name="op_id" value="<?=$fetch_orders['id']; ?>">
				<?php { ?>
			<?php } ?>
			<select name="update_pay">
		  	  		<option disabled selected><?= $fetch_orders['status']; ?></option>
		  	  		<option value="pending">pending</option>
		  	  		<option value="complete">complete</option>
		  	  	</select>
			<div class="flex-btn">
				<button type="submit" name="update" class="btn">Update Status</button>
		  	  		<button type="submit" name="delete" class="btn">Delete</button>
			</div>
			</form>
			<?php
			       }
			    }
			?>
			</div>
		</div>
	</section>
</div>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
	<script src="script.js"></script>
	<?php include '../components/alert.php'; ?>
</body>
</html>