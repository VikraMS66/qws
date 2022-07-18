
<section  id="sellerSupplies" class="pt-5 mt-3">

          <div class="mx-3 pt-3 pb-5 text-dark">
           <div class="row">
            <?php 
             
             $number = $_SESSION['associateid'];

                $query = "SELECT * FROM agent WHERE number='$number'";
                $results = mysqli_query($conn, $query);

                $sellid = "";

                if (mysqli_num_rows($results) == 1) {

                    while($row=mysqli_fetch_array($results)) {

                        $sellid=$row['selectedid'];

                    }
                }


             $sql_query="SELECT * FROM onboardsupply WHERE sellerid='$sellid'";

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
                                
                              </div>
                        </div>
                        </div>
                    </div>
                    
                    <?php 
                   }
                  } else {

                    echo "<h1 class'text-center mt-5 pt-5 mb-5 pb-5 mx-5'>No Supplie Found!</h1>";
                   
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
                    'http://localhost:8013/h20app/Agent/supplieStatusChange.php',
                    { supplieid: supplieid, status: status },
                    function(supplieid) {
                        console.log(supplieid);
                    }
                   )

                   alert("Supplie status chamged!");

                   setTimeout(loadingAgain, 300);

                   function loadingAgain(){
                        location.reload();
                   }


                });


            </script>