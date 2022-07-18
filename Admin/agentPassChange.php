<?php 
include("auth.php");
require('db.php');

if(isset($_POST['id'])) { //if i have this post

   
    $id =  $_POST['id'];
    $pass =  $_POST['pass'];
    

    $queryUpdate = "update agent set password='$pass' WHERE id='$id'";
    $update_sql=mysqli_query($conn,$queryUpdate);

}

?>