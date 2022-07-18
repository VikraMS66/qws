
<section  id="reportBug" class="pt-5 mt-3 text-dark px-5  text-dark">

<?php
    $ID = $_SESSION['associateid'];

    $query = "SELECT * FROM agent WHERE number='$ID'";
    $results = mysqli_query($conn, $query);
    
    $sNumber="";
    $sName="";
    $sEmail="";

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
            }
        }

    

   
?>



<div class='text-dark'>
   
      <div class="container">
          <div class="row">
               <div class="col-12">
                   <div class="card-body bg-dark text-white text-center">
                      <h3 class="mb-4 h2 pb-2 pb-md-0 mb-md-5 px-md-2 text-center bg-secondary text-white"><u>REPORT BUG/ERROR</u></h3>
                   
                      <div class='row'>
                        <h5 class='mx-2'><u>Seller Details</u></h5>
                       <div class="col-4"> 
                          <div class="form-outline mb-4">
                              <label class="form-label" for="name">Name</label>
                              <?php 
                              echo "<input type='text' id='name' readonly class='form-control' maxlength='20' minlength='1' name='name' value='".$sName."'/>";
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
                              echo "<input type='text' id='email' readonly class='form-control' maxlength='50' minlength='1' name='email' value='".$sEmail."'/>";
                              ?>
                          </div>
                         </div> 
                      </div> 
                     
                      <p class='bg-warning text-dark'>Note: Describr the bug/error in details, Maximum character allowed are 500.</p>

                      <div class="form-outline mb-4 bg-dark text-white text-center">
                      <label class="form-label h5" for="bugMessage"><u>Describe Bug/Error</u></label>
                              <textarea id="bugMessage" type="text" class="form-control" name="bugMessage" rows="5" cols="50" maxlength="500" required="required"></textarea>
                          </div>

                       <div class='d-grid gap-2 col-6 mx-auto mt-2 mb-0 d-flex justify-content-center align-items-center mt-5'>
                              <button type="button" href='#' style='width:100px;' id="submitBug" name='submitBug' class="btn btn-info border border-dark mb-1 d-grid gap-2 col-6 mx-auto">Submit Report</button>
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

        $("#submitBug").click(function() {

            var number = $("#number").val();
            var name = $("#name").val();
            var email = $("#email").val();
            var message = $("#bugMessage").val();
            
            
            //alert(number);
            //alert(pass);
 
             if(message.length > 1 ) {

             if(message.length < 500 ) {

                

                $.post(
                  'http://localhost:8013/h20app/Agent/submitBugData.php',
                  { number: number, name: name, email: email, message: message, type: 'seller' },
                    function(number) {
                    console.log(number);
                  }
                 )

                      alert("Bug/Error Report Submitted!");

                      location.href='associate.php?info=seller';
                    
                } else {

                    alert("Maximum description length is 500!");

                }

             } else {
                alert("Description of bug/error is required!");
             }
            
        });

    </script>