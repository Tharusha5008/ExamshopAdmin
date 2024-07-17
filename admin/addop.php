<?php
   include'../components/connect.php';
   session_start();

   $admin_id = $_SESSION['id'];
   if (!isset($admin_id)) {
   	header('location: log.php');
   }

   if (isset($_POST['publish'])) {
   	$id = unique_id();
   	$name = $_POST['name'];
   	$name = filter_var($name, FILTER_SANITIZE_STRING);

   	$email = $_POST['email'];
   	$email = filter_var($email, FILTER_SANITIZE_STRING);

   	$password = $_POST['password'];
   	$password = filter_var($password, FILTER_SANITIZE_STRING);

   		$insert_product = $conn->prepare("INSERT INTO subadmin (id,name,email,password) VALUES(?,?,?,?)");
   		$insert_product->execute([$id,$name,$email,$password]);
   		echo "<script>alert('Employee added successfully');</script>";
   	
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
		<h1>Add Operational Staff</h1>
	</div>
	<section class="form-container">
		<h1 class="heading">add member</h1>
		<form action="" method="post" enctype="multipart/form-data">
			<div class="input-field">
				<label>Employee name</label>
				<input type="text" name="name" maxlength="100" required placeholder="enter name">
			</div>
			<div class="input-field">
				<label>Employee Email</label>
				<input type="text" name="email" maxlength="100" required placeholder="enter email">
			</div>
			<div class="input-field">
				<label>password</label>
				<input type="text" name="password" maxlength="1000" required placeholder="add strong password">
			</div>
			<div class="flex-btn">
				<button type="submit" name="publish" class="btn">Add Employee</button>

			</div>
		</form>
	</section>
</div>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
	<script src="script.js"></script>
	<?php include '../components/alert.php'; ?>
</body>
</html>