<?php 
include("auth.php");
require('db.php');

if(isset($_POST['id'])) { //if i have this post

   
    $id =  $_POST['id'];
    $status =  $_POST['status'];
   
    $queryUpdate = "update agent set role='$status' WHERE id='$id'";
    $update_sql=mysqli_query($conn,$queryUpdate);

}

?>