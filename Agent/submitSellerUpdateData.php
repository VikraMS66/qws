<?php 
include("authManager.php");
require('db.php');

if(isset($_POST['number'])) { //if i have this post

    $number =  $_POST['number'];
    $cname =  $_POST['cname'];
    $gst =  $_POST['gst'];
    $status =  $_POST['status'];
    $comment =  $_POST['comment'];
    
    if($status == "Approve") {

        $queryUpdate = "update supplier set companyName='$cname', gstNumber='$gst', statusMsg='$comment' WHERE mNumber='$number'";
        $update_sql=mysqli_query($conn,$queryUpdate);

        $delete_query = "DELETE FROM sellerupdate WHERE sNumber='$number'";
        $delete_sql=mysqli_query($conn, $delete_query);

    } else if($status == "Reject") {
        
        $queryUpdate = "update supplier set statusMsg='$comment' WHERE mNumber='$number'";
        $update_sql=mysqli_query($conn,$queryUpdate);
        
        $delete_query = "DELETE FROM sellerupdate WHERE sNumber='$number'";
        $delete_sql=mysqli_query($conn, $delete_query);
    }
      


}

?>