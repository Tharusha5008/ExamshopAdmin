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

   	$delete_product = $conn->prepare("DELETE FROM users WHERE id = ?");
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
	<section class="show-post">
		<h1 class="heading">all users</h1>
		<div class="box-container">
			<?php
			  $select_op = $conn->prepare("SELECT * FROM users");
			  $select_op->execute();

			  if ($select_op->rowCount() > 0) {
			   	while ($fetch_op = $select_op->fetch(PDO::FETCH_ASSOC)) 
			   	{  	
			    
			?>
			<form action="" method="post" class="box">
				<input type="hidden" name="op_id" value="<?=$fetch_op['id']; ?>">
				<?php { ?>
				<img src="icon.jpg" class="image">
			<?php } ?>
			<div class="name"> <?=$fetch_op['name']; ?></div>
			<div class="name"><?=$fetch_op['username']; ?></div>
			<div class="name"><?=$fetch_op['password']; ?></div>
			<div class="flex-btn">
				<a href="edit_user.php?id=<?=$fetch_op['id']; ?>" class="btn">edit</a>
				<button type="submit" name="delete" class="btn" onclick="return confirm('delete this employee');">delete</button>
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