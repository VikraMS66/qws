<?php 
include("authManager.php");
require('db.php');

if(isset($_POST['number'])) { //if i have this post

    $number =  $_POST['number'];
    $name =  $_POST['name'];
    $email =  $_POST['email'];
    $cname =  $_POST['cname'];
    $gst =  $_POST['gst'];
    $pincode =  $_POST['pincode'];
    $gCode =  $_POST['gCode'];
    $address =  $_POST['address'];
    $status =  $_POST['status'];
    $comment =  $_POST['comment'];
    
    

    $queryUpdate = "update supplier set name='$name', email='$email', companyName='$cname', gstNumber='$gst', pincode='$pincode', gCode='$gCode', address='$address', status='$status', statusMsg='$comment' WHERE mNumber='$number'";
    $update_sql=mysqli_query($conn,$queryUpdate);

    if($status == 'Blocked') {
        $query = "UPDATE onboardsupply set status='Deactive' WHERE sellerid='$number'";
        $sql=mysqli_query($conn,$query);
    }

}

?>