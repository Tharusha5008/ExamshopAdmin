<?php
   include'../components/connect.php';
   session_start();
           $post_id = $_GET['id'];

           $select_ops = $conn->prepare("DELETE FROM orders WHERE id = ?");
           $select_ops->execute([$post_id]);
           echo "<script>alert(' deleted success');</script>";
           header('location: order.php'); 
   ?>