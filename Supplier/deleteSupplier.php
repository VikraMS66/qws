<?php 
include('auth.php');
  require('db.php');

 if(isset($_POST['id'])) { //if i have this post

  $id=$_POST['id'];
  $sql_query="DELETE FROM onboardsupply WHERE id='$id'";
  $delete=mysqli_query($conn,$sql_query);
  
 //echo("<script>location.href='homepage.php?info=supplies';</script>");

}
?>