<?php 
include("authManager.php");
require('db.php');

if(isset($_POST['id'])) { //if i have this post

    $agentID = $_SESSION['managerid'];
    $id =  $_POST['id'];
    
    $queryUpdate = "update agent set orderid='$id' WHERE number='$agentID'";
    $update_sql=mysqli_query($conn,$queryUpdate);

}

?>