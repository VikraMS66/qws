<?php
include("auth.php");
require('db.php');

if(isset($_POST['supplieid'])) { //if i have this post
    //echo("<script>alert('Got!');</script>");

  
     $ID = $_SESSION['sellerid'];
    $id = $_POST['supplieid'];
   

  $queryUpdate = "update supplier set selectedSupplier='$id' WHERE mNumber='$ID'";
  $update_sql=mysqli_query($conn,$queryUpdate);

//header("location:cHomepage.php?info=parOrders");
   // echo("<script>location.href='homepage.php?info=parOrders';</script>");

}

?>