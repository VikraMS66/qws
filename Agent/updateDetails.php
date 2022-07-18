
<section  id="sellerVerify" class="pt-5 mt-3 text-dark px-5  text-dark">

<?php
    $ID = $_SESSION['managerid'];

    $query = "SELECT * FROM agent WHERE number='$ID'";
    $results = mysqli_query($conn, $query);
    
    $sNumber="";
    $sName="";
    $sEmail="";
    $comapnyName="";
    $status="";
    $message="";
    $pincode="";
    $address="";
    $gCode="";
    $gstNumber="";
    $date="";

    $newGst = "";
    $newCName = "";
    $requestComment = "";

    if (mysqli_num_rows($results) == 1) {
        while($row=mysqli_fetch_array($results)) {
            $sNumber=$row['selectedid'];
        }

        $query_get = "SELECT * FROM supplier WHERE mNumber='$sNumber'";
        $results_get = mysqli_query($conn, $query_get);

        if (mysqli_num_rows($results_get) == 1) {
            while($row_get=mysqli_fetch_array($results_get)) {

                $sName=$row_get['name'];
                $sEmail=$row_get['email'];
                $comapnyName=$row_get['companyName'];
                $status=$row_get['status'];
                $message=$row_get['statusMsg'];
                $pincode=$row_get['pincode'];
                $address=$row_get['address'];
                $gstNumber=$row_get['gstNumber'];
                $gCode=$row_get['gCode'];
                $date=$row_get['date'];
               
            }
        }

        $query_update = "SELECT * FROM sellerupdate WHERE sNumber='$sNumber'";
        $results_update = mysqli_query($conn, $query_update);

        if (mysqli_num_rows($results_update) == 1) {
            while($row_update=mysqli_fetch_array($results_update)) {

                
                $newCName=$row_update['cName'];
                $newGst=$row_update['gst'];
                $requestComment=$row_update['comment'];
               
            }
        }

    

   
?>



<div class='text-dark'>
   
      <div class="container">
          <div class="row">
               <div class="col-12">
                   <div class="card-body bg-dark text-white ">
                      <h3 class=" text-center bg-success text-white"><u>UPDATE APPROVAL PAGE</u></h3>
                   
                      <div class='row'>
                        <h5 class='mx-2'><u>Seller Details</u></h5>
                       <div class="col-4"> 
                          <div class="form-outline mb-4">
                              <label class="form-label" for="name">Name</label>
                              <?php 
                              echo "<input type='text' id='name' readonly class='form-control' maxlength='20' minlength='1' name='name' value='".$sName."' required='required'/>";
                              ?>
                          </div>
                         </div> 
                       <div class="col-4"> 
                          <div class="form-outline mb-4">
                              <label class="form-label" for="number">Number</label>
                              <?php 
                              echo "<input type='text' id='number' readonly class='form-control' maxlength='10' minlength='10' name='number' value='".$sNumber."' required='required'/>";
                              ?>
                          </div>
                         </div> 
                       <div class="col-4"> 
                          <div class="form-outline mb-4">
                              <label class="form-label" for="email">Email</label>
                              <?php 
                              echo "<input type='text' id='email' readonly  class='form-control' maxlength='50' minlength='1' name='email' value='".$sEmail."'/>";
                              ?>
                          </div>
                         </div> 
                      </div> 

                      <div class='row'>
                       <div class="col-4"> 
                          <div class="form-outline mb-4">
                              <label class="form-label" for="cname">Company Name</label>
                              <?php 
                              echo "<input type='text' id='cname' readonly class='form-control' maxlength='20'  name='cname' value='".$comapnyName."'/>";
                              ?>
                          </div>
                         </div> 
                       <div class="col-4"> 
                          <div class="form-outline mb-4">
                              <label class="form-label" for="gst">GST Number</label>
                              <?php 
                              echo "<input type='text' id='gst' readonly class='form-control' maxlength='20' name='gst' value='".$gstNumber."'/>";
                              ?>
                          </div>
                         </div> 
                       <div class="col-4"> 
                          <div class="form-outline mb-4">
                          <label class="form-label" for="status">Profile Status</label>
                              <?php 
                              echo "<p id='status' class='bg-warning text-dark h5'>".$status."</p>";
                              ?>
                          </div>
                         </div> 
                      </div> 

                      <div class='row'>
                        <h5 class='mx-2'><u>Adress Details</u></h5>
                       <div class="col-4"> 
                          <div class="form-outline mb-4">
                              <label class="form-label" for="pincode">Pincode</label>
                              <?php 
                              echo "<input type='text' id='pincode' readonly  class='form-control' maxlength='6' minlength='6' name='pincode' value='".$pincode."' required='required'/>";
                              ?>
                          </div>
                         </div> 
                       <div class="col-4"> 
                          <div class="form-outline mb-4">
                              <label class="form-label" for="gCode">Google Map Plus Code</label>
                              <?php 
                              echo "<input type='text' id='gCode' readonly class='form-control' maxlength='50'  name='gCode' value='".$gCode."'/>";
                              ?>
                          </div>
                         </div> 
                       <div class="col-4"> 
                         <div class="form-outline  text-white">
                              <label class="form-label h5" for="address">Address</label>
                              <textarea id="address" type="text" class="form-control" readonly name="address" rows="2" cols="50" maxlength="500" required="required"><?php echo $address ?></textarea>
                         </div>
                         </div> 
                      </div> 
                       <hr/>
                      <div class='row'>
                      <h5 class='mx-2'><u>New details to update</u></h5>
                       <div class="col-6"> 
                          <div class="form-outline mb-4">
                              <label class="form-label" for="ncname">Company Name</label>
                              <?php 
                              echo "<input type='text' id='ncname' readonly class='form-control' maxlength='20'  name='ncname' value='".$newCName."'/>";
                              ?>
                          </div>
                         </div> 
                       <div class="col-6"> 
                          <div class="form-outline mb-4">
                              <label class="form-label" for="ngst">GST Number</label>
                              <?php 
                              echo "<input type='text' id='ngst' readonly class='form-control' maxlength='20' name='ngst' value='".$newGst."'/>";
                              ?>
                          </div>
                         </div> 
                      </div> 

                      <div class='row'>
                        <h5 class='mx-2'><u>Actions</u></h5>
                       <div class="col-4"> 
                          <div class="form-outline mb-4">
                              <label class="form-label" for="msg">Message</label>
                              <?php 
                              echo "<p id='msg' class='bg-warning text-dark h5'>".$requestComment."</p>";
                              ?>
                          </div>
                         </div> 
                       <div class="col-4"> 
                          <div class="form-outline mb-4">
                          <label class="form-label h5" for="status">Choice Action</label>
                                        <?php 
                                            echo "<select class='form-select form-control' id='actionSelected' aria-label='Default select example' required='required'>";

                                                    echo "<option value='Approve'>Approve</option>";
                                                    echo "<option value='Reject'>Reject</option>";
                                                
                                                ?> 
                                            </select>
                                    
                          </div>
                         </div> 
                       <div class="col-4"> 
                         <div class="form-outline mb-2 text-white">
                              <label class="form-label h5" for="address">Comment</label>
                              <textarea id="comment" type="text" class="form-control" name="comment" rows="1" cols="50" maxlength="500" required="required"></textarea>
                         </div>
                         </div> 
                      </div> 
                     
                      <p class='bg-warning text-dark'>Note: Comment is required to submit, verify all details before approval.</p>

                       <div class='d-grid gap-2 col-6 mx-auto d-flex justify-content-center align-items-center'>
                              <button type="button" href='#' style='width:100px;' id="submit" name='submit' class="btn btn-info btn-lg border border-dark  d-grid gap-2 col-6 mx-auto">Submit</button>
                      </div>
                    </div>
                </div>
             
              </div>
          </div>
     
   </div>
  
         

<?php


    }



?>
 </section>
 <script>

        $("#submit").click(function() {

            var number = $("#number").val();
            
            var cname = $("#ncname").val();
            var gst = $("#ngst").val();
            
            var comment = $("#comment").val();

            const status = $("#actionSelected option:selected").val();


            if(comment.length > 0) {

                                $.post(
                                    'http://localhost:8013/h20app/Agent/submitSellerUpdateData.php',

                                    { number: number, cname: cname, gst: gst, comment: comment, status: status },
                                    function(number) {
                                    console.log(number);
                                    }
                                ) 

                                setTimeout(redirectPage, 300);

                                    function redirectPage(){
                                    alert("Seller Update Details Submitted!");
                                    location.href='manager.php?info=updates';
                                    }
                               

                            } else {
                                alert("Comment is required!");
                            }

                        

                 

                
            
        });

    </script>