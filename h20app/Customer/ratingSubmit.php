<?php
//include("auth.php");
require('db.php');

if(isset($_POST['id'])) { //if i have this post
    $orderId =  $_POST['id'];
    $rating =  $_POST['rating'];
    echo "<script> alert('File Got Data'); </script>";
    $queryUpdate = "update orders set rating='$rating' where id='$orderId'";
    $update_sql=mysqli_query($conn,$queryUpdate);
    
    //echo json_encode($_POST);
}
?>