<?php 
include("auth.php");
require('db.php');

if(isset($_POST['name'])) { //if i have this post
     
    
    $ID = $_SESSION['sellerid'];
    
    $name =  $_POST['name'];
    $number =  $_POST['number'];
    $pincode =  $_POST['pincode'];
    $capacity =  $_POST['capacity'];
    $count =  $_POST['count'];
   
    //echo "<script> alert('File Got Data'); </script>";

    $queryInsert = "INSERT INTO onboardsupply (sellerid,name,number,pincode,capacity,multiOrderCount) VALUES('$ID','$name','$number','$pincode','$capacity','$count')";
    $insert_sql=mysqli_query($conn,$queryInsert);
      
    
         //echo("<script>alert('Supplier Added!');</script>");
         //echo("<script>location.href='homepage.php?info=supplies';</script>");
    
    //header("location:cHomepage.php?info=current_supplies");
    //echo("<script>alert('Supplie Edited!');</script>");
    //echo("<script>location.href='homepage.php?info=supplies';</script>");
    //echo json_encode($_POST);
}

?>