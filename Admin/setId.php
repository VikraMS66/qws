<?php 
include("auth.php");
require('db.php');

if(isset($_POST['id'])) { //if i have this post

    $ID = $_SESSION['admin'];
    $id =  $_POST['id'];
    
    $queryUpdate = "update admin set setid='$id' WHERE number='$ID'";
    $update_sql=mysqli_query($conn,$queryUpdate);

}

?>