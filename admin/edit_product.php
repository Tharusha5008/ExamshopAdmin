<?php
   include'../components/connect.php';
   session_start();

   $admin_id = $_SESSION['id'];
   if (!isset($admin_id)) {
   	header('location: log.php');
   }


   if (isset($_POST['update'])) {
   	$post_id = $_GET['id'];

   	$name = $_POST['name'];
   	$name = filter_var($name, FILTER_SANITIZE_STRING);

   	$price = $_POST['price'];
   	$price = filter_var($price, FILTER_SANITIZE_STRING);

   	$content = $_POST['content'];
   	$content = filter_var($content, FILTER_SANITIZE_STRING);

   	$updatep = $conn->prepare("UPDATE productst SET name = ?, price = ?, product_detail = ? WHERE id = ?");
   	$updatep->execute([$name,$price,$content,$post_id]);
      if ($updatep) {
      	echo "<script>alert('product updated');</script>";
      }
   	
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
		<h1>Edit product</h1>
	</div>
	<section class="edit-post">
		<h1 class="heading">edit product</h1>
		<?php
           $post_id = $_GET['id'];

           $select_product = $conn->prepare("SELECT * FROM productst WHERE id = ?");
           $select_product->execute([$post_id]);

           if ($select_product->rowCount() > 0) {
           	while($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)){
           
		?>
		<div class="form-container">
			<form action="" method="post" enctype="multipart/form-data">
				
				<img src="../../Examshop/components/product/<?=$fetch_product['image']; ?>" class="image">
				<input type="hidden" name="product_id" value="<?=$fetch_product['id']; ?>">
				<div class="input-field">
					<label>product name</label>
					<input type="text" name="name" value="<?=$fetch_product['name']; ?>">
				</div>
				<div class="input-field">
					<label>price</label>
					<input type="text" name="price" value="<?=$fetch_product['price']; ?>">
				</div>
				<div class="input-field">
					<label>Detail</label>
					<input type="text" name="content" value="<?=$fetch_product['product_detail']; ?>">
				</div>
				<div class="flex-btn">
					<button type="submit" name="update" class="btn">Update product</button>
					<a href="view_product.php" class="btn">go back</a>
				</div>
			</form>
		</div>
		<?php
            	}
          }
		?>
	</section>
</div>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
	<script src="script.js"></script>
	<?php include '../components/alert.php'; ?>
</body>
</html>