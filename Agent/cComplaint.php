<section  id="complaint" class="pt-5 mt-3  text-dark px-5 bg-light text-dark">
   <?php 

      $number = $_SESSION['associateid'];

      $query = "SELECT * FROM agent WHERE number='$number'";
      $results = mysqli_query($conn, $query);

      $orderid = "";
      $custid = "";

      if (mysqli_num_rows($results) == 1) {

            while($row=mysqli_fetch_array($results)) {

                $orderid=$row['orderid'];
                $custid=$row['selectedid'];

            }
        }

        $customerName="";
        $customerNumber="";
        $customerEmail="";


        $query_cust = "SELECT * FROM customer WHERE mNumber='$custid'";
        $results_cust = mysqli_query($conn, $query_cust);

        if (mysqli_num_rows($results_cust) == 1) {

            while($row_cust=mysqli_fetch_array($results_cust)) {

                $customerNumber=$row_cust['mNumber'];
                $customerName=$row_cust['name'];
                $customerEmail=$row_cust['email'];

            }
        }

   ?>

<div class='text-dark '>
   
   <div class="container">
       <div class="row">
            <div class="col-12">
                <div class="card-body ">
                   <h3 class="mb-4 h2 pb-2 pb-md-0 mb-md-5 px-md-2 text-center bg-secondary text-white"><u>COMPLAINT REGISTRATION</u></h3>
                
                   <div class='row'>
                     <h5 class='mx-2'><u>Customer Details</u></h5>
                    <div class="col-3"> 
                       <div class="form-outline mb-4">
                           <label class="form-label" for="name">Name</label>
                           <?php 
                           echo "<input type='text' id='name' readonly class='form-control' maxlength='20' minlength='1' name='name' value='".$customerName."'/>";
                           ?>
                       </div>
                      </div> 
                    <div class="col-3"> 
                       <div class="form-outline mb-4">
                           <label class="form-label" for="number">Number</label>
                           <?php 
                           echo "<input type='text' id='number' readonly class='form-control' maxlength='10' minlength='10' name='number' value='".$customerNumber."' required='required'/>";
                           ?>
                       </div>
                      </div> 
                    <div class="col-3"> 
                       <div class="form-outline mb-4">
                           <label class="form-label" for="email">Email</label>
                           <?php 
                           echo "<input type='text' id='email' readonly class='form-control' maxlength='50' minlength='1' name='email' value='".$customerEmail."'/>";
                           ?>
                       </div>
                      </div> 
                    <div class="col-3"> 
                       <div class="form-outline mb-4">
                           <label class="form-label" for="orderid">Order ID</label>
                           <?php 
                           echo "<input type='text' id='orderid' readonly class='form-control' maxlength='50' minlength='1' name='orderid' value='".$orderid."'/>";
                           ?>
                       </div>
                      </div> 
                   </div> 
                  
                   <p class='bg-warning text-dark'>Note: Describr the issue in details, Maximum character allowed are 500.</p>

                   <div class="form-outline mb-4 bg-dark text-white text-center">
                           <label class="form-label" for="issueMessage">DESCRIBE ISSUE</label>
                           <textarea id="issueMessage" type="text" class="form-control" name="issueMessage" rows="5" cols="50" maxlength="500" required="required"></textarea>
                       </div>

                    <div class='d-grid gap-2 col-6 mx-auto mt-2 mb-0 d-flex justify-content-center align-items-center mt-5'>
                           <button type="button" href='#' style='width:100px;' id="registerComplaint" name='registerComplaint' class="btn btn-info border border-dark mb-1 d-grid gap-2 col-6 mx-auto">Register Complaint</button>
                   </div>
                 </div>
             </div>
          
           </div>
       </div>
  
</div>

</section>

<script>

        $("#registerComplaint").click(function() {

           var number = $("#number").val();
           var name = $("#name").val();
            //var email = $("#email").val();
            var message = $("#issueMessage").val();
            var orderid = $("#orderid").val();
            
            
            //alert(number);
            //alert(pass);
 
             if(message.length > 1 ) {

             if(message.length < 500 ) {

                

                $.post(
                  'http://localhost:8013/h20app/Agent/submitComplaintData.php',
                  { name: name, number: number, message: message, type: 'customer', orderid: orderid },
                    function(number) {
                    console.log(number);
                  }
                 )

                      alert("Complaint Registered!");

                      location.href='associate.php?info=complaintList';
                    
                } else {

                    alert("Maximum description length is 500!");

                }

             } else {
                alert("Description of complaint is required!");
             }
            
        });

    </script>