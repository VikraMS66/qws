
<?php 
include("authManager.php");
require('db.php');

if(isset($_POST['name'])) { //if i have this post
     
  
    $name =  $_POST['name'];
    $number =  $_POST['number'];
    $email =  $_POST['email'];
    $message =  $_POST['message'];
    $type =  $_POST['type'];
    $reporter = $_SESSION["managerid"];
   
    //echo "<script> alert('File Got Data'); </script>";

    $queryInsert = "INSERT INTO bug (name,number,email,message,reportedby,reporterNumber) VALUES('$name','$number','$email','$message','$type','$reporter')";
    $insert_sql=mysqli_query($conn,$queryInsert);
      
    
}

?>