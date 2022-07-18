<?php 
include("authAssociate.php");
require('db.php');

if(isset($_POST['orderid'])) { //if i have this post
     
    $name =  $_POST['name'];
    $number =  $_POST['number'];
    $message =  $_POST['message'];
    $type =  $_POST['type'];
    $orderid =  $_POST['orderid'];

    $reporter = $_SESSION["associateid"];
   
    //echo "<script> alert('File Got Data'); </script>";

    $queryInsert = "INSERT INTO complaint (name,number,orderid,issue,complaintby,agentNumber) VALUES('$name','$number','$orderid','$message','$type','$reporter')";
    $insert_sql=mysqli_query($conn,$queryInsert);
      
    
}

?>