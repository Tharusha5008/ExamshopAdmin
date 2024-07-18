<?php
   include'../components/connect.php';
   session_start();
           $post_id = $_GET['id'];

           $select_ops = $conn->prepare("UPDATE tbl_booking SET booking_status= '1' WHERE booking_id = ?");
           $select_ops->execute([$post_id]);
           echo "<script>alert('  success');</script>";
           header('location: dashboard.php'); 
   ?>