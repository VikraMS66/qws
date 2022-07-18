<?php
include("auth.php");
require('db.php');

if(isset($_POST['id'])) { //if i have this post
    $addressID =  $_POST['id'];
    $ID = $_SESSION['cnumberID'];
    echo "<script> alert('File Got Data'); </script>";
    $queryUpdate = "update customer set addressId='$addressID' where mNumber='$ID'";
    $update_sql=mysqli_query($conn,$queryUpdate);

    header("location:cHomepage.php?info=products");

    //echo json_encode($_POST);
}
?>