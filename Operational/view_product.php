<?php
   include'../components/connect.php';
   session_start();

   $admin_id = $_SESSION['id'];
   if (!isset($admin_id)) {
   	header('location: log.php');
   }


   if (isset($_POST['delete'])) {
   	$p_id = $_POST['product_id'];
   	$p_id = filter_var($p_id, FILTER_SANITIZE_STRING);

   	$delete_product = $conn->prepare("DELETE FROM productst WHERE id = ?");
   	$delete_product->execute([$p_id]);

   	echo "<script>alert('product deleted success');</script>";
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
	<section class="show-post">
		<h1 class="heading">all products</h1>
		<div class="box-container">
			<?php
			  $select_products = $conn->prepare("SELECT * FROM productst");
			  $select_products->execute();

			  if ($select_products->rowCount() > 0) {
			   	while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) 
			   	{  	
			    
			?>
			<form action="" method="post" class="box">
				<input type="hidden" name="product_id" value="<?=$fetch_products['id']; ?>">
				<?php if($fetch_products['image'] != ''){ ?>
				<img src="../../Examshop/components/product/<?=$fetch_products['image']; ?>" class="image">
			<?php } ?>
			<div class="price">$ <?=$fetch_products['price']; ?></div>
			<div class="name"><?=$fetch_products['name']; ?></div>
			<div class="flex-btn">
				<a href="edit_product.php?id=<?=$fetch_products['id']; ?>" class="btn">edit</a>
				<button type="submit" name="delete" class="btn" onclick="return confirm('delete this product');">delete</button>
			</div>
			</form>
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