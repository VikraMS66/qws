<?php 
include("auth.php");
require('db.php');

if(isset($_POST['number'])) { //if i have this post
     
    
    $name =  $_POST['name'];
    $number =  $_POST['number'];
    $email =  $_POST['email'];
    $role =  $_POST['role'];
    $password =  $_POST['password'];
   
  

    $queryInsert = "INSERT INTO agent (name,number,email,role,password) VALUES('$name','$number','$email','$role','$password')";
    $insert_sql=mysqli_query($conn,$queryInsert);
      
    
}

?>