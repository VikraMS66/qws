<?php 
include("authAssociate.php");
require('db.php');

if(isset($_POST['name'])) { //if i have this post
     
  
    $name =  $_POST['name'];
    $number =  $_POST['number'];
    $pincode =  $_POST['pincode'];
    $gCode =  $_POST['gCode'];
    $address =  $_POST['address'];
   
    //echo "<script> alert('File Got Data'); </script>";

    $queryInsert = "INSERT INTO fillup (name,number,pincode,gCode,address) VALUES('$name','$number','$pincode','$gCode','$address')";
    $insert_sql=mysqli_query($conn,$queryInsert);
      
    
         //echo("<script>alert('Supplier Added!');</script>");
         //echo("<script>location.href='homepage.php?info=supplies';</script>");
    
    //header("location:cHomepage.php?info=current_supplies");
    //echo("<script>alert('Supplie Edited!');</script>");
    //echo("<script>location.href='homepage.php?info=supplies';</script>");
    //echo json_encode($_POST);
}

?>