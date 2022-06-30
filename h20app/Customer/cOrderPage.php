
<?php
 
 //include("auth.php");
  require('db.php');
  $username="";
  $errors = array();

  ?>
    <div class="mt-5 pt-5 text-start mx-1 mb-5 pb-3 bg-info">

     
        <div class="orders">

         <div class="container">
           <div class="row">
       
        <?php 
      
        $ID = $_SESSION['cnumberID'];
        $query="SELECT * FROM orders where custid='$ID' ORDER BY date DESC";
        $res=mysqli_query($conn, $query);
          
        if (mysqli_num_rows($res) > 0) {
          while($row = mysqli_fetch_assoc($res)) {

            ?>
         
          <div class="col-lg-4 mb-3">
          <form method="post" action="cHomePage.php?info=orderDetails">
            <div class="card bg-dark text-white pb-3" style="width: 18rem">
            <?php 
              echo "<div class='card-header'>Date: ".$row['date']."</div>";
              
            ?>
             <ul class="list-group list-group-flush">
             <?php 
               echo "<li class='list-group-item'>ID: #<input style='width: 100px;' readonly class='mx-3 border border-white ' name='orderId' value='".$row['id']."'/></li>";
               echo "<li class='list-group-item'>".$row['product']." Litter Water</li>";
               echo "<li class='list-group-item'>Amount Rs. ".$row['amount']."</li>";
               echo "<li class='list-group-item'>E-Delivary Time:  ".$row['etd']."</li>";
               echo "<li class='list-group-item'>Order Status:  ".$row['status']."</li>";
               $percentage = "";

               if($row['status'] === 'Placed'){
                $percentage = '33%';
               }
               if($row['status'] === 'OnWay'){
                $percentage = '67%';
               }
               if($row['status'] === 'Delivered' || $row['status'] === 'Cancelled'){
                $percentage = '97%';
               }
               echo "<button id=".$row['id']." style='height:40px;width:".$percentage."' type='submit'  name='selectedOrder' class='btn btn-info text-dark mt-1 ml-1 mr-1 details'>Details</button>";
               
             ?>
              </ul>
            </div>
              </form>
          </div>
       
        <?php 
          }
        } else {
          echo "<h1 class'text-center mt-5 pt-5 mb-5 pb-5 mx-5'>No Order Found</h1>";
        }
        ?>
       </div>
      </div>
      </form>
    
     
</div>


    <script>
          
      </script>
  
