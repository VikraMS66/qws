<?php 
include("auth.php");
require('db.php');

if(isset($_POST['id'])) { //if i have this post

   
    $id =  $_POST['id'];
    $message = $_POST['message'];
    $status =  $_POST['status'];
   
    if($status == 'No') {
      $queryUpdate = "update bug set message='$message' WHERE id='$id'";
      $update_sql=mysqli_query($conn,$queryUpdate);
    } else {
      $queryUpdate = "update bug set message='$message', status='$status' WHERE id='$id'";
      $update_sql=mysqli_query($conn,$queryUpdate);
    }

    

}

?>