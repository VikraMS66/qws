<?php 
include("authManager.php");
require('db.php');

if(isset($_POST['orderid'])) { //if i have this post

    $orderid =  $_POST['orderid'];
    $orderStatus =  $_POST['orderStatus'];

    $customerid =  $_POST['customerid'];
    $customerStatus =  $_POST['customerStatus'];

    $sellerid =  $_POST['sellerid'];
    $sellerStatus =  $_POST['sellerStatus'];

    $supplyid =  $_POST['supplyid'];
    $supplierStatus =  $_POST['supplierStatus'];

    $response =  $_POST['response'];
    $complaintStatus =  $_POST['complaintStatus'];
    $complaintid = $_POST['complaintid'];
   
    




    if($orderStatus == "Cancelled") {

        $queryUpdate = "update orders set status='Cancelled' WHERE id='$orderid'";
        $update_sql=mysqli_query($conn,$queryUpdate);
    
    }

    if($supplierStatus == "Delete") {

        $delete_query = "DELETE FROM onboardsupply WHERE id='$supplyid'";
        $delete_sql=mysqli_query($conn, $delete_query);

    }


    if($customerStatus == "Blocked") {

        $queryUpdate = "update customer set status='Blocked' WHERE mNumber='$customerid'";
        $update_sql=mysqli_query($conn,$queryUpdate);

        $query = "UPDATE orders set status='Cancelled' WHERE custid='$customerid' AND (status='Placed' OR status='OnWay')";
        $sql=mysqli_query($conn,$query);
    
    }

    if($sellerStatus == "Blocked") {

        $queryUpdate = "update supplier set status='Blocked', statusMsg='Blocked due to complaint on order id ".$orderid."' WHERE mNumber='$sellerid'";
        $update_sql=mysqli_query($conn,$queryUpdate);

        $query = "UPDATE onboardsupply set status='Deactive' WHERE sellerid='$sellerid'";
        $sql=mysqli_query($conn,$query);

        $query_can = "UPDATE orders set status='Cancelled' WHERE supid='$sellerid' AND (status='Placed' OR status='OnWay')";
        $sql_can=mysqli_query($conn,$query_can);
    
    }

    

        $queryUpdate = "update complaint set status='$complaintStatus', message='$response' WHERE id='$complaintid'";
        $update_sql=mysqli_query($conn,$queryUpdate);
    
    


}

?>