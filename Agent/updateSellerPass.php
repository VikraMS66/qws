<?php 
include("authAssociate.php");
require('db.php');

if(isset($_POST['number'])) { //if i have this post

   
    $number =  $_POST['number'];
    $pass =  $_POST['pass'];
    

    $queryUpdate = "update supplier set password='$pass' WHERE mNumber='$number'";
    $update_sql=mysqli_query($conn,$queryUpdate);

}

?>