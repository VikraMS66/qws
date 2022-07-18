

<section  id="searchparorders" class="pt-5 ">
<?php 
            if (isset($_POST['searchValue'])) {
                $value = mysqli_real_escape_string($conn, $_POST['searchValue']);
?>
 <div class="mt-4">
    <form method='post' action='homepage.php?info=searchParOrders'>
       <div class='row'>
           <div class='col-3'>
               <div class="input-group text-center mx-3 mb-2" style="width:300px;">
                 <?php
                   echo "<input name='searchValue'  id='searchValue' type='text' class='form-control rounded' maxlength='20' minlength='1' value='".$value."' placeholder='Enter a value'/>";
                   ?>
                    <button type="submit" id="searchOrder" class="mx-2 btn btn-outline-dark text-white rounded">Search</button>
               </div>
           </div>
           <div class='col-9 text-dark h5'>
                 <p><u>To Search use OrderID or Order Status or Pincode or Delivery Address (Name or Number) or Capacity.</u></p>
           </div>
       </div>
    </form>
  </div>
     <?php 
           
            $ID = $_SESSION['sellerid'] ;
           $supplieid="";

           $sql_select="SELECT * FROM supplier WHERE mNumber='$ID'";
           $result=mysqli_query($conn,$sql_select);

            if (mysqli_num_rows($result) == 1) {
                while($row = mysqli_fetch_assoc($result)) {
                    $supplieid = $row['selectedSupplier'];
                }
                }
                if($supplieid!=null){

                        $sql_query="SELECT * FROM orders WHERE supplyid='$supplieid' AND (id ='$value' OR status LIKE '%".$value."%' OR pincode='$value' OR custName LIKE '%".$value."%' OR custNumber='$value' OR product='$value') ORDER BY date DESC";
                        $res=mysqli_query($conn,$sql_query);

                        if (mysqli_num_rows($res) > 0) {
                        ?>

            <div class="mx-3 pt-1 pb-5">
            <div class="row">

           <?php
               while($row = mysqli_fetch_assoc($res)) {
                   $orderid = $row['id']
            ?>

   
           <div class="col-6 mb-2 mt-3">
               <div class="card border border-white">
                 <div class="card-body bg-white text-dark">

                   <div class="row bg-dark text-white pt-2" >
                     <div class="col-4">
                      <?php
                       echo "<h5 class='card-title'>Order ID: <span>#".$row['id']."</span></h5>";
                       ?>
                        </div>
                       <div class="col-4">
                         <?php
                           echo "<h5 class='card-title h5'><span>".$row['product']."</span> Letter Water </h5>";
                         ?>
                        </div>
                       <div class="col-4">
                       <?php
                       echo "<h5 class='card-title'>Delivery by: <span>".$row['etd']."</span></h5>";
                       ?>
                        </div>
                   </div>

                   <hr/>

                   <div class="row">
                     <h5><u>Delivery Details</u></h5>
                       <div class="col-4">
                         <div class="row">
                               <?php
                               echo "<h5 class='card-title'>Name: <span>".$row['custName']."</span></h5>";
                               ?>
                           </div>
                           <div class="row">
                               <?php
                               echo "<h5 class='card-title'>Number: <span>".$row['custNumber']."</span></h5>";
                               ?>
                           </div>
                       </div>
                       <div class="col-8">
                           <?php
                               echo "<h5 class='card-title h5'>Address: <span>".$row['pincode']."</span>-<span>".$row['address']."</span></h5>";
                           ?>
                       </div> 
                   </div>

                   <hr/>

                   <div class="row">
                       <div class="col-6">
                               <?php
                               echo "<h5 class='card-title'>Supplier Name: <span>".$row['supName']."</span></h5>";
                               ?>
                           </div>
                          
                             <div class="col-6">
                               <?php
                               echo "<h5 class='card-title'>Suppllier Number: <span>".$row['supNumber']."</span></h5>";
                               ?>
                            
                           </div>
                       
                   </div>
                    
                   <hr/>

                   <div class="row bg-dark text-white pt-2">
                     <div class="col-4">
                      <?php
                       echo "<h5 class='card-title'>G-Map Code: <span>".$row['gCode']."</span></h5>";
                       ?>
                        </div>
                       <div class="col-4">
                         <?php
                           echo "<h5 class='card-title h5'>Amount: <span>".$row['amount']."</span></h5>";
                         ?>
                        </div>
                       <div class="col-4">
                                   <?php
                                       echo "<h5 class='card-title'>Status: <span>".$row['status']."</span></h5>";
                                   ?>
                       </div>
                   </div>
                     <?php 
                       if($row['status'] === 'Delivered' || $row['status'] === 'Cancelled') {

                       } else {

                      
                     ?>
                  
                  
                       <div class="row bg-warning text-dark pt-2 pb-2">
                           <div class="col-6">
                           
                               <label class="form-label h5" for="status">Change Order Status:</label>
                               <?php 
                                   echo "<select class='form-select form-control' id='".$row['id']."status' aria-label='Default select example' required='required'>";
                                   
                                       if($row['status'] === 'Placed') {
                                           echo "<option value='OnWay'>OnWay</option>";
                                           echo "<option value='Delivered'>Delivered</option>";
                                       } else {
                                           echo "<option value='Delivered'>Delivered</option>";
                                       }
                                       ?> 
                                   </select>
                           
                           </div>
                           <div class="col-6 mb-1 mx-auto mt-4 pt-2">
                                   <?php 
                                    echo "<button type='submit' style='width:100px;' id=".$row['id']." class='btn btn-dark save'>Save</button>";
                                   ?>
                               </div>
                       </div>

                       <?php 
                         }
                       ?>

                 </div>
                </div>
               </div>
            

        <?php 
          }
          ?>

   </div> 
   </div>
          <?php

               } else {
                   echo "<h1 class'text-center mt-5 pt-5 mb-5 pb-5 mx-5'>No Order Found</h1>";
               }
            }
        } else {
            echo "<h1 class'text-center mt-5 pt-5 mb-5 pb-5 mx-5'>Supplier Details Not Found.</h1>";
        }

           ?>
</section>


<script>
$(".save").click(function (event) {
   var id = event.target.id;
   //alert(id);
   const status = $( "#" + id + "status option:selected").val();
   // alert(status);

      $.post(
           'http://localhost:8013/h20app/Supplier/orderStatus.php',
           { id: id, status: status },
             function(id) {
             console.log(id);
           }
          )
          
          setTimeout(loadAgain, 500);
          function loadAgain(){
           alert("Order Status Changed!")
               location.reload();
          }

 });


</script>