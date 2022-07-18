<section  id="supplies" class="pt-5">
 
          <div id="supplieAdd" class="mx-3 pt-5">
            <a  style="width:150px ;" class="btn btn-dark text-white rounded-pill border border-info" href="homepage.php?info=add_supplie">New Supplie</a>
           </div>
            <div class="mx-3 pt-3 pb-5 text-dark">
             <div class="row">
            <?php 
            
             $ID = $_SESSION['sellerid'];
             $sql_query="SELECT * FROM onboardsupply WHERE sellerid='$ID'";
             $res=mysqli_query($conn,$sql_query);
             if (mysqli_num_rows($res) > 0) {
                while($row = mysqli_fetch_assoc($res)) {
                     $supplieid=$row['id'];
            ?>
                    
                    <div class="col-6  mb-2">
                        <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                  <?php
                                    echo "<h5 class='card-title h5'><span id='".$supplieid."capacity'>".$row['capacity']."</span> Letter Water </h5>";
                                  ?>
                                
                                </div>
                                <div class="col-6">
                                <?php
                                echo "<h5 class='card-title'> Current Status: <span id='".$supplieid."status'>".$row['status']."</span></h5>";
                                ?>
                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col-3">
                                  <?php
                                   echo "<p class='card-text'>Name: <span id='".$supplieid."name'>".$row['name']."</span></p>";
                                ?>
                                </div>
                                <div class="col-3">
                              <?php
                                echo "<p class='card-text'>Mobile No.<span id='".$supplieid."number'>".$row['number']."</span></p>";
                              ?>
                                </div>
                                <div class="col-3">
                              <?php
                                echo "<p class='card-text'>Service Pincode: <span id='".$supplieid."pincode'>".$row['pincode']."</span></p>";
                              ?>
                                </div>
                                <div class="col-3">
                              <?php
                                echo "<p class='card-text'>Processing: <span id='".$supplieid."count'>".$row['multiOrderCount']."</span> order at a time</p>";
                              ?>
                                </div>
                             </div>
                             <hr/>
                             <div class="row">
                                <div class="col-4">
                                    <?php 
                                      echo "<a id='".$row['id']."' href='homepage.php?info=edit_supplie'  class='btn-md col-3  btn btn-info mt-3 mx-2 editBtn'>Edit</a>";
                                    ?>
                                </div>
                                <div class="col-4 text-center"> 
                                 <?php
                                   echo "<a id='".$row['id']."' href='#' class='btn btn-warning mt-3 mx-2 revenueBtn' title='Get Revenue fro supplier'>Revenue</a>";
                                  ?>
                                </div>
                                <div class="col-4 text-end"> 
                                 <?php
                                   echo "<a id='".$row['id']."' href='#' data-toggle='modal' data-target='#deleteModal' class='btn btn-danger mt-3 mx-2 deleteBtn' title='Delete Supplie?'>Delete</a>";
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
                  }
                    ?>
          </div>


                <!-- Modal -->
                      <div class="modal fade text-dark" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title " id="exampleModalLabel">Are you sure to delete?<input style="font-size: xx-small; color: white;" readonly class="pb-0 mb-0 mt-0 pt-0 border border-white noselect" id="delid" hidden></input></h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                  <h5 class="">Supplie of <span id='delcapacity'></span> Litter water done by <span id='delname'></span> in <span id='delpincode'></span> Service Area.</h5> 
                            </div>
                            <div class="modal-footer">
                              <button id="deleteAboard" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button id='confirmDelete' type="submit" class="btn btn-danger text-white" name="confirmDelete">Confirm</button>
                            </div>
                          </div>
                      
                        </div>
                      </div>
</section>

  <script> 
               $(".editBtn").click(function(evt) {
                   var id = evt.target.id;
                   //alert(id);
                  var name = $("#" + id + "name").text();
                  var number = $("#" + id + "number").text();
                  var pincode = $("#" + id + "pincode").text();
                  var count = $("#" + id + "count").text();
                  var capacity = $("#" + id + "capacity").text();
                  var status = $("#" + id + "status").text();
                    
                var selectedSupplieData = {
                id: id,
                name: name,
                number: number,
                pincode: pincode,
                count: count,
                capacity: capacity,
                status: status,
              };

              localStorage.setItem(
                "selectedSupplieData",
                JSON.stringify(selectedSupplieData)
              );
               });



              $(".deleteBtn").click(function(evt) {
                         id = event.target.id;
                  var name = $("#" + id + "name").text();
                  var capacity = $("#" + id + "capacity").text();
                  var pincode = $("#" + id + "pincode").text();

                  var deleteSupplieData = {
                    id: id,
                    name: name,
                    pincode: pincode,
                    capacity: capacity,
                  };

                  localStorage.setItem(
                    "deleteSupplieData",
                    JSON.stringify(deleteSupplieData)
                  );

                  
                  var deleteSupplieData = JSON.parse(
                    localStorage.getItem("deleteSupplieData")
                  );
                  $("#delid").val(deleteSupplieData.id);
                  $("#delname").text(deleteSupplieData.name);
                  $("#delcapacity").text(deleteSupplieData.capacity);
                  $("#delpincode").text(deleteSupplieData.pincode);

              });

              $("#deleteAboard").click(function() {
                // alert("Hello");
                  localStorage.removeItem('deleteSupplieData');
                });


                $('#confirmDelete').click(function() {
                  var value=$("#delid").val();
                   //alert(value);
                  $.post(
                    'http://localhost:8013/h20app/Supplier/deleteSupplier.php',
                    { id: value },
                      function() {
                      console.log("Done");
                    }
                   )

                   //alert('hello');
                   setTimeout(loadingAgain, 500);
                   function loadingAgain(){
                        location.reload();
                   }

                });

                $(".revenueBtn").click(function(evt){
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
                     location.href="homepage.php?info=parRevenue";
                   }
                   

                });

            </script>