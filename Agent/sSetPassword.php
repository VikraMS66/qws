
<section  id="resetPassword" class="ml-5 pt-5 mt-3 text-dark pl-5 text-dark">

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
               <div class="col-10">
                   <div class="card-body bg-dark text-white">
                      <h3 class="mb-4 h2 pb-2 pb-md-0 mb-md-5 px-md-2 text-center bg-danger text-white"><u>RESET PASSWORD</u></h3>
                      <div class='row'>
                      <div class="col-8"> 
                        <h3><span class="bg-info text-white">Verify Below Details Before Generating Password.</span><?php echo"<br><br><span>Name: '".$sName."'</span><br>";?>Number: <?php echo"<span id='number'>".$sNumber."</span><br>";?>Email: <?php echo"<span>'".$sEmail."'</span>";?>
                      </div>
                      <div class="col-4 mt-5 pt-5"> 
                        <div class="form-check">
                            <input id="verifier" class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                            <label class="form-check-label bg-warning text-white h3" for="flexCheckChecked">
                               Verified
                            </label>
                            </div>
                        </div>
                      </div> 
                     
                      <div class='row mt-5'>
                       <div class="col-6"> 
                          <div class="form-outline mb-4">
                              <label class="form-label bg-dark text-white text-center" for="pass">Generated Password</label>
                               <input type='text' style='width:200px;' id='pass' readonly class='form-control' maxlength='20' minlength='6' name='pass' value='' required='required' />
                          </div>
                         </div> 
                        <div class="col-6 mt-4 pt-1"> 
                          <div class="form-outline mb-4">
                          <button type="button" style='width:150px;' id="getPass" name='getPass' class="btn btn-success border border-dark mb-1 d-grid gap-2">Generate</button>
                          </div>
                        </div>
                      </div> 
                      <p class='bg-warning text-dark'>Note: Share password with customer once the details are verified and update password button clicked!.</p>
                       <div class='d-grid gap-2 col-6 mx-auto mt-2 mb-0 d-flex justify-content-center align-items-center mt-5'>
                              <button type="button" href='#' style='width:100px;' id="updatePass" name='updatePass' class="btn btn-info border border-dark mb-1 d-grid gap-2 col-6 mx-auto">Update Password</button>
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
   $("#getPass").click(function() {
    
         if($("#verifier").is(":checked"))
           {  
            var pass = generateP();
                 $("#pass").val(pass);
            } 

            else {
                alert("Verify Details before password is generated!");
            }


   });

   function generateP() {
            var pass = '';
            var str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' + 
                    'abcdefghijklmnopqrstuvwxyz0123456789@#$';
              
            for (let i = 1; i<=8; i++) {
                var char = Math.floor(Math.random()
                            * str.length + 1);
                  
                pass += str.charAt(char);
                if(pass.length == 6){
                    break;
                }
            }
              
            return pass;
        }


        $("#updatePass").click(function() {
            var number = $("#number").text();
            var pass = $("#pass").val();
            
            //alert(number);
            //alert(pass);

            if($("#verifier").is(":checked"))
           {  
             if(pass.length >=6 ) {

                $.post(
                  'http://localhost:8013/h20app/Agent/updateSellerPass.php',
                  { number: number, pass: pass },
                    function(pass) {
                    console.log(pass);
                  }
                 )
                 alert("Password Updated! Share password with seller.");
             }
            
            } else {
                alert("Verification of Details required before password is updated!");
            }

        })

    </script>