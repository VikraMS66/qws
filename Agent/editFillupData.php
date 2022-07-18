<?php 
include("authAssociate.php");
require('db.php');

if(isset($_POST['id'])) { //if i have this post

    //echo("<script>alert('Supplie Data Gained');</script>");
    $id =  $_POST['id'];
    $name =  $_POST['name'];
    $number =  $_POST['number'];
    $pincode =  $_POST['pincode'];
    $status =  $_POST['status'];
    $gCode =  $_POST['gCode'];
    $address =  $_POST['address'];
   
    //echo "<script> alert('File Got Data'); </script>";

    $queryUpdate = "update fillup set name='$name', number='$number', pincode='$pincode', status='$status', gCode='$gCode', address='$address' WHERE id='$id'";
    $update_sql=mysqli_query($conn,$queryUpdate);

    //header("location:cHomepage.php?info=current_supplies");
    //echo("<script>alert('Supplie Edited!');</script>");
    //echo("<script>location.href='homepage.php?info=supplies';</script>");
    //echo json_encode($_POST);
}

?>