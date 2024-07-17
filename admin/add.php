<?php

include_once('connection.php');

if(isset($_POST['register']))
{
    $name=$_POST['name'];
    $username=$_POST['username'];
    $pass=md5($_POST['password']);
    $id = unique_i();

    $sql   ="INSERT INTO admin(id,name, username, password) VALUES ('$id','$name','$username','$pass')";
    $result=mysqli_query($conn,$sql);
    if($result){ 
    header('location:log.php');
    echo"<script>alert('Admin Register Success');</script>";   
    $_SESSION['user_id'] = $id;
    header('location:log.php');
    }else{
        die(mysqli_error($conn)) ;
    }
   
}
