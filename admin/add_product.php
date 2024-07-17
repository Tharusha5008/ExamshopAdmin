<?php
   include'../components/connect.php';
   session_start();

   $admin_id = $_SESSION['id'];
   if (!isset($admin_id)) {
   	header('location: log.php');
   }

   //product adding

   if (isset($_POST['publish'])) {
   	$id = unique_id();
   	$name = $_POST['name'];
   	$name = filter_var($name, FILTER_SANITIZE_STRING);

   	$price = $_POST['price'];
   	$price = filter_var($price, FILTER_SANITIZE_STRING);

   	$content = $_POST['content'];
   	$content = filter_var($content, FILTER_SANITIZE_STRING);

   	$image = $_FILES['image']['name'];
   	$image= filter_var($image, FILTER_SANITIZE_STRING);
   	$image_size = $_FILES['image']['size'];
   	$image_tmp_name = $_FILES['image']['tmp_name'];
   	$image_folder = '../../Examshop/components/product/'.$image;

   	$select_image = $conn->prepare("SELECT * FROM productst WHERE image = ?");
   	$select_image->execute([$image]);

   	if (isset($image)) {
   		if ($select_image->rowCount() > 0) {
   			echo "<script>alert('image repeated');</script>";
   		}elseif ($image_size > 2000000) {
   			echo "<script>alert('image is too large');</script>";
   		}else{
   			move_uploaded_file($image_tmp_name, $image_folder);
   		}
   	}else{
   		$image='';
   	}
   	if ($select_image->rowCount() > 0 AND $image != '') {
   		echo "<script>alert('rename your image');</script>";
   	}else{
   		$insert_product = $conn->prepare("INSERT INTO productst (id,name,price,image,product_detail) VALUES(?,?,?,?,?)");
   		$insert_product->execute([$id,$name,$price,$image,$content]);
   		echo "<script>alert('product added successfully');</script>";
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
		<h1>Add Product</h1>
	</div>
	<section class="form-container">
		<h1 class="heading">add product</h1>
		<form action="" method="post" enctype="multipart/form-data">
			<div class="input-field">
				<label>product name</label>
				<input type="text" name="name" maxlength="100" required placeholder="add product name">
			</div>
			<div class="input-field">
				<label>product price</label>
				<input type="text" name="price" maxlength="100" required placeholder="add product price">
			</div>
			<div class="input-field">
				<label>product description</label>
				<textarea name="content" maxlength="1000" required placeholder="add product description">
				</textarea>
			</div>
			<div class="input-field">
				<label>product image</label>
				<input type="file" name="image" accept="image/*" required>
			</div>
			<div class="flex-btn">
				<button type="submit" name="publish" class="btn">publish product</button>

			</div>
		</form>
	</section>
</div>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
	<script src="script.js"></script>
	<?php include '../components/alert.php'; ?>
</body>
</html>