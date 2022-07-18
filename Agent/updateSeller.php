<section  id="complaint" class="pt-5 mt-3  text-dark px-5 bg-light text-dark">

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

  $sellerName="";
  $sellerNumber="";
  $sellerEmail="";
  $sellerCompany="";
  $sellerGST="";


  $query_sell = "SELECT * FROM supplier WHERE mNumber='$sellid'";
  $results_sell = mysqli_query($conn, $query_sell);

  if (mysqli_num_rows($results_sell) == 1) {

      while($row_sell=mysqli_fetch_array($results_sell)) {

          $sellerNumber=$row_sell['mNumber'];
          $sellerName=$row_sell['name'];
          $sellerEmail=$row_sell['email'];
          $sellerCompany=$row_sell['companyName'];
          $sellerGST=$row_sell['gstNumber'];

      }
  }

?>


<div class='text-dark '>
   
   <div class="container">
       <div class="row">
            <div class="col-12">
                <div class="card-body ">
                   <h3 class="mb-4 h2 pb-2 pb-md-0 mb-md-5 px-md-2 text-center bg-secondary text-white"><u>UPDATE DETAILS</u></h3>
                
                   <div class='row'>
                     <h5 class='mx-2'><u>Seller Details</u></h5>
                    <div class="col-4"> 
                       <div class="form-outline mb-4">
                           <label class="form-label" for="name">Name</label>
                           <?php 
                           echo "<input type='text' id='name' readonly class='form-control' maxlength='20' minlength='1' name='name' value='".$sellerName."'/>";
                           ?>
                       </div>
                      </div> 
                    <div class="col-4"> 
                       <div class="form-outline mb-4">
                           <label class="form-label" for="number">Number</label>
                           <?php 
                           echo "<input type='text' id='number' readonly class='form-control' maxlength='10' minlength='10' name='number' value='".$sellerNumber."' required='required'/>";
                           ?>
                       </div>
                      </div> 
                    <div class="col-4"> 
                       <div class="form-outline mb-4">
                           <label class="form-label" for="email">Email</label>
                           <?php 
                           echo "<input type='text' id='email' readonly class='form-control' maxlength='50' minlength='1' name='email' value='".$sellerEmail."'/>";
                           ?>
                       </div>
                      </div> 
                   </div> 
                   
                   <div class='row'>
                     <h5 class='mx-2'><u>Company Details</u></h5>
                    <div class="col-6"> 
                       <div class="form-outline mb-4 bg-dark text-white text-center">
                           <label class="form-label" for="cname">Company Name</label>
                           <?php 
                           echo "<input type='text' id='cname'  class='form-control' maxlength='20' minlength='1' name='cname' value='".$sellerCompany."'/>";
                           ?>
                       </div>
                      </div> 
                    <div class="col-6"> 
                       <div class="form-outline mb-4 bg-dark text-white text-center">
                           <label class="form-label" for="gstnumber">GST Number</label>
                           <?php 
                           echo "<input type='text' id='gstnumber' class='form-control' maxlength='20' minlength='1' name='gstnumber' value='".$sellerGST."' required='required'/>";
                           ?>
                       </div>
                      </div> 
                   </div> 
                  
                   <p class='bg-warning text-dark'>Note: Any Message by Selller, Maximum character allowed are 500.</p>

                   <div class="form-outline mb-4 bg-dark text-white text-center">
                           <label class="form-label" for="message">Comment</label>
                           <textarea id="message" type="text" class="form-control" name="message" rows="2" cols="30" maxlength="500"></textarea>
                       </div>

                    <div class='d-grid gap-2 col-6 mx-auto mt-2 mb-0 d-flex justify-content-center align-items-center mt-5'>
                           <button type="button" href='#' style='width:100px;' id="updateSellerDetails" name='updateSellerDetails' class="btn btn-info border border-dark mb-1 d-grid gap-2 col-6 mx-auto">Submitted</button>
                   </div>
                 </div>
             </div>
          
           </div>
       </div>
  
</div>

</section>

<script>

        $("#updateSellerDetails").click(function() {

            var number = $("#number").val();
            var companyName = $("#cname").val();
            var gstNumber = $("#gstnumber").val();
            var message = $("#message").val();
           
            
            
            //alert(number);
            //alert(pass);
 
             if(companyName.length > 1 || gstNumber.length > 1) { 

                $.post(
                  'http://localhost:8013/h20app/Agent/submitUpdateRequest.php',
                  { companyName: companyName, number: number, message: message, gstNumber: gstNumber },
                    function(number) {
                    console.log(number);
                  }
                 )

                      alert("Updation Request Submitted!");

                      location.href='associate.php?info=seller';
                    
             } else {
                alert("Enter Company name or GST number!");
             }
            
        });

    </script>