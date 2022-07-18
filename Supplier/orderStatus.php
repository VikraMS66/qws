<?php 
include("auth.php");
require('db.php');

if(isset($_POST['id'])) { //if i have this post

    
    $id =  $_POST['id'];
    $status =  $_POST['status'];
    
    //echo "<script> alert('File Got Data'); </script>";

    $queryUpdate = "update orders set status='$status' WHERE id='$id'";
    $update_sql=mysqli_query($conn,$queryUpdate);

    if($update_sql){

        if($status == 'Delivered'){

            $query = "SELECT supplyid FROM orders WHERE id='$id' LIMIT 1";
            $results = mysqli_query($conn, $query);

            if (mysqli_num_rows($results) == 1) { 

                $supplyid='';

                while($row=mysqli_fetch_array($results))

                { 
                  $supplyid=$row['supplyid'];
                }

                $query_Update = "update onboardsupply set multiOrderCount=multiOrderCount+1 where id='$supplyid'";
                $updatesql=mysqli_query($conn,$query_Update);
             
            }

            }
    }
    
    
    //echo("<script>location.href='homepage.php?info=supplies';</script>");
   
}

?>