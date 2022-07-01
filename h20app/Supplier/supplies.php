<section style="background-color: #eee;" id="supplies" class="pt-5">
 
         <div id="supplieAdd" class="mx-3 pt-5">
            <a  style="width:150px ;" class="btn btn-dark text-white rounded-pill border border-info" name="addAddress" href="homepage.php?add_supplie">New Supplie</a>
          </div>
          <div class="mx-3 pt-3 pb-5 text-dark">
           <div class="row">
            <?php 
             $sql_query="SELECT * FROM onboardsupply WHERE sellerid='9972145655'";
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
                                <div class="col-6">
                                    <?php 
                                      echo "<a id='".$row['id']."' href='homepage.php?info=edit_supplie' class='col-3 mx-auto btn btn-info mt-3 mx-2 editBtn'>Edit</a>";
                                    ?>
                                </div>
                                <div class="col-6"> 
                                 <?php
                                   echo "<a id='".$row['id']."' href='#' class='btn btn-danger mt-3 mx-2 deleteBtn'>Delete</a>";
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
          </div>

          <div class='action'>
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
            </script>
          </div>

</section>