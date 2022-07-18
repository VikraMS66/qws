<?php 
include("auth.php");
require('db.php');

if(isset($_POST['id'])) { //if i have this post

    //echo("<script>alert('Supplie Data Gained');</script>");
    $id =  $_POST['id'];
    $name =  $_POST['name'];
    $number =  $_POST['number'];
    $pincode =  $_POST['pincode'];
    $capacity =  $_POST['capacity'];
    $count =  $_POST['count'];
   
    //echo "<script> alert('File Got Data'); </script>";

    $queryUpdate = "update onboardsupply set name='$name', number='$number', pincode='$pincode', capacity='$capacity', multiOrderCount='$count' WHERE id='$id'";
    $update_sql=mysqli_query($conn,$queryUpdate);

    //header("location:cHomepage.php?info=current_supplies");
    //echo("<script>alert('Supplie Edited!');</script>");
    //echo("<script>location.href='homepage.php?info=supplies';</script>");
    //echo json_encode($_POST);
}

?>