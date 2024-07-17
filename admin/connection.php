<?php
$server = 'localhost';
$username = 'root';
$password = 'Vismine@123';
$database = 'shop_dp';

if (isset($_POST))

    $conn = new mysqli($server, $username, $password, $database);
if ($conn) {
    // echo 'Server Connected Success';
} else {
    die(mysqli_error($conn));
}
function unique_i(){
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charLength = strlen($chars);
    $randomString ='';
    for ($i=0; $i < 20 ; $i++) {
         $randomString .= $chars[mt_rand(0, $charLength -1)];
    }
    return $randomString;

     }
