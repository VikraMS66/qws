<?php 
include("authAssociate.php");
require('db.php');

if(isset($_POST['supplieid'])) { //if i have this post

    $id =  $_POST['supplieid'];
    $status =  $_POST['status'];
   
   // echo "<script>alert('File Got Data');</script>";

    $queryUpdate = "update onboardsupply set status='$status' where id='$id'";
    $update_sql=mysqli_query($conn,$queryUpdate);

}

?>