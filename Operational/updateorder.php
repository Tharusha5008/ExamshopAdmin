<?php   

   include'../components/connect.php';
   session_start();

    $order_id = $_GET['id'];
   	

   	$update_payment = $_GET['st'];
   

   	$update_pay = $conn->prepare("UPDATE orders SET status = 'Order Accepted' WHERE id =?");
   	$update_pay->execute([$order_id ]);

   	echo "<script>alert('updating success');</script>";
   	header('location: order.php'); 

   ?>