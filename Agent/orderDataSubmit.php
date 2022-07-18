<?php 
include("authAssociate.php");
require('db.php');

if (isset($_POST['number'])) {

    $name = $_POST['name'];
    $number = $_POST['number'];
    $pincode = $_POST['pincode'];
    $gCode = $_POST['gCode'];
    $capacity = $_POST['capacity'];
    $address = $_POST['address'];
    $etd = $_POST['etd'];
    $amount = $_POST['amount'];


   
    $query = "SELECT * FROM onboardsupply WHERE status='Active' AND pincode='$pincode' AND capacity='$capacity' AND multiOrderCount > 0 LIMIT 1";
    $res = mysqli_query($conn, $query);

    if (mysqli_num_rows($res) > 0) {
     
     //echo '<script>alert("check case")</script>';

                       $sellerID = "";
                       $supplierName = "";
                       $supplierNumber ="";
                       $suppllyID = "";

   
     
                           while($row=mysqli_fetch_array($res))
                             { 
                               $suppllyID = $row['id'];
                               $sellerID = $row['sellerid'];
                               $supplierName = $row['name'];
                               $supplierNumber = $row['number'];
                             }

                             

                             $queryInsert = "INSERT INTO orders (custid,supid,supplyid,product,custName,custNumber,address,pincode,gCode,amount,supName,supNumber,etd) 
                                             VALUES('$number','$sellerID','$suppllyID','$capacity','$name','$number','$address','$pincode','$gCode','$amount','$supplierName','$supplierNumber','$etd')";

                             $sql=mysqli_query($conn, $queryInsert);

                             if($sql) {
                               $que = "update onboardsupply set multiOrderCount=multiOrderCount-1 where id='$suppllyID'";
                               $got = mysqli_query($conn, $que);

                               //echo("<script>location.href = 'associate.php?info=home';</script>");
                             
                             }
                 
     } else {
                         
       array_push($errors, "<div class='alert alert-warning'><b>Out of Stock!</b></div>");
     }

 } else {
       array_push($errors, "<div class='alert alert-warning'><b>Some Error!</b></div>");
     }
