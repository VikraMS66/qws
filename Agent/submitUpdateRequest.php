<?php 
include("authAssociate.php");
require('db.php');

if(isset($_POST['number'])) { //if i have this post
     
    $number = $_POST['number'];
    $companyName =  $_POST['companyName'];
    $message =  $_POST['message'];
    $gstNumber =  $_POST['gstNumber'];

    $reporter = $_SESSION["associateid"];
   
    //echo "<script> alert('File Got Data'); </script>";

    $queryInsert = "INSERT INTO sellerupdate (sNumber,cName,gst,comment,agentNumber) VALUES('$number','$companyName','$gstNumber','$message','$reporter')";
    $insert_sql=mysqli_query($conn,$queryInsert);


     $queryUpdate = "update supplier set statusMsg='Update Requested' WHERE mNumber='$number'";
    $update_sql=mysqli_query($conn,$queryUpdate);
      
    
}

?>