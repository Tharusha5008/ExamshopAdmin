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

   	$email = $_POST['email'];
   	$email = filter_var($email, FILTER_SANITIZE_STRING);

   	$password = $_POST['password'];
   	$password = filter_var($password, FILTER_SANITIZE_STRING);

   	$updatep = $conn->prepare("UPDATE subadmin SET name = ?, email = ?, password = ? WHERE id = ?");
   	$updatep->execute([$name,$email,$password,$post_id]);
      if ($updatep) {
      	echo "<script>alert('account updated');</script>";
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
		<h1>Edit staff</h1>
	</div>
	<section class="edit-post">
		<h1 class="heading">edit staff</h1>
		<?php
           $post_id = $_GET['id'];

           $select_ops = $conn->prepare("SELECT * FROM subadmin WHERE id = ?");
           $select_ops->execute([$post_id]);

           if ($select_ops->rowCount() > 0) {
           	while($fetch_ops = $select_ops->fetch(PDO::FETCH_ASSOC)){
           
		?>
		<div class="form-container">
			<form action="" method="post" enctype="multipart/form-data">
				
				<img src="icon.jpg" class="image">
				<input type="hidden" name="product_id" value="<?=$fetch_ops['id']; ?>">
				<div class="input-field">
					<label>name</label>
					<input type="text" name="name" value="<?=$fetch_ops['name']; ?>">
				</div>
				<div class="input-field">
					<label>email</label>
					<input type="text" name="email" value="<?=$fetch_ops['email']; ?>">
				</div>
				<div class="input-field">
					<label>password</label>
					<input type="text" name="password" value="<?=$fetch_ops['password']; ?>">
				</div>
				<div class="flex-btn">
					<button type="submit" name="update" class="btn">Update employee</button>
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