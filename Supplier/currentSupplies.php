
<section  id="currentSupplies" class="pt-5 mt-3">
          <div class="mx-3 pt-3 pb-5 text-dark">
           <div class="row">
            <?php 
             
             $ID = $_SESSION['sellerid'];
             $sql_query="SELECT * FROM onboardsupply WHERE sellerid='$ID'";
             $res=mysqli_query($conn,$sql_query);
             if (mysqli_num_rows($res) > 0) {
                while($row = mysqli_fetch_assoc($res)) {

            ?>
                    
                    <div class="col-6  mb-2">
                        <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                <h5 class="card-title h5"><?php echo $row['capacity'] ?> Letter Water </h5>
                                </div>
                                <div class="col-6">
                                <h5 class="card-title"> Current Status: <?php echo $row['status'] ?></h5>
                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col-3">
                                <p class="card-text">Name: <?php echo $row['name'] ?></p>
                                </div>
                                <div class="col-3">
                                <p class="card-text">Mobile No.<?php echo $row['number'] ?></p>
                                </div>
                                <div class="col-3">
                                <p class="card-text">Service Pincode: <?php echo $row['pincode'] ?></p>
                                </div>
                                <div class="col-3">
                                <p class="card-text">Processing: <?php echo $row['multiOrderCount'] ?> order at a time</p>
                                </div>
                             </div>
                             <hr/>
                             <div class="row">
                                <div class="col-6">
                                    <?php 
                                      if($row['status'] == 'Active') {
                                   
                                      echo "<a id='".$row['id']."' href='#' class='btn btn-danger mt-3 mx-2 statusBtn'>Deactivate</a>";
                                 
                                    } else {
                                        echo "<a id='".$row['id']."' href='#' class='btn btn-warning mt-3 mx-2 statusBtn'>Activate</a>";
                                      }
                                    ?>
                                   
                                </div>
                                <div class="col-6"> 
                                 <?php
                                   echo "<a id='".$row['id']."' href='#' class='btn btn-primary mt-3 mx-2 ordersBtn'>Orders</a>";
                                  ?>
                                </div>
                              </div>
                        </div>
                        </div>
                    </div>
                    
                    <?php 
                   }
                  } else {
                    echo "<h1 class'text-center mt-5 pt-5 mb-5 pb-5 mx-5'>No Supplie Found, ADD NEW ONE NOW!</h1>";
                    echo "<div class='mx-3 pt-5'>";
                    echo "<a  style='width:150px;' class='btn btn-dark text-white rounded-pill border border-info' href='homepage.php?info=add_supplie'>New Supplie</a>";
                    echo "</div>";
                    
                  }
                    ?>
          </div>
          </div>

</section>

<script> 
                $('.statusBtn').click(function(event){
                    var supplieid = event.target.id;
                    var value = $(this).text();
                    var status = '';
                    //alert(value);
                    if(value == 'Deactivate'){
                        status = 'Deactive';
                    } else {
                        status = 'Active';
                    }
                    
                    $.post(
                    'http://localhost:8013/h20app/Supplier/supplieStatus.php',
                    { supplieid: supplieid, status: status },
                    function(supplieid) {
                        console.log(supplieid);
                    }
                   )

                   setTimeout(loadingAgain, 500);
                   function loadingAgain(){
                        location.reload();
                   }


                });

                $(".ordersBtn").click(function(evt){
                  var supplieid = event.target.id;
                  //alert(supplieid);

                  $.post(
                    'http://localhost:8013/h20app/Supplier/setSupplie.php',
                    { supplieid: supplieid },
                    function() {
                        console.log("Done");
                    }
                   )

                   setTimeout(forward, 500);
                   function forward(){
                     location.href="homepage.php?info=parOrders";
                   }
                   

                });

            </script>