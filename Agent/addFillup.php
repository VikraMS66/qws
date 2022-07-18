
<section  id="newfillup" class="pt-5  text-dark px-5">

<div class='text-dark text-center '>
   
      <div class="container h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
               <div class="col-10">
                   <div class="card-body p-4 p-md-5 bg-dark text-white text-center">
                      <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Add Fill-up Point Details</h3>
                      <div class='row'>
                       <div class="col-6"> 
                          <div class="form-outline mb-4 bg-dark text-white text-center">
                              <label class="form-label" for="name">Name</label>
                              <input type="text" id="name" class="form-control" maxlength='20' minlength='1' name='name' required="required"/>
                          </div>
                         </div> 
                        <div class="col-6"> 
                          <div class="form-outline mb-4 bg-dark text-white text-center">
                              <label class="form-label" for="number">Mobile Number</label>
                              <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onkeypress="return onlyNumberKey(event)"  type="text" inputmode="numeric"  id="number" class="form-control" maxlength='10' minlength='10' name='number'  required="required"/>
                          </div>
                        </div>
                      </div> 
                      <div class='row'>
                       <div class="col-6"> 
                          <div class="form-outline mb-4 bg-dark text-white text-center">
                              <label class="form-label" for="pincode">Pincode</label>
                              <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onkeypress="return onlyNumberKey(event)" type="text" inputmode="numeric" id="pincode" class="form-control" maxlength='6' minlength='6' name='pincode'  required="required"/>
                          </div>
                         </div> 
                         <div class="col-6"> 
                          <div class="form-outline mb-4 bg-dark text-white text-center">
                              <label class="form-label" for="gCode">Google Map Plus Code (optional)</label>
                              <input type="text"  id="gCode" class="form-control" name='gCode' maxlength='50'/>
                          </div>
                         </div> 
                      </div> 

                      <div class="col-6"> 
                          <div class="form-outline mb-4 bg-dark text-white text-center">
                              <label class="form-label" for="address">Address</label>
                              <textarea id="address" type="text" class="form-control" name="address" rows="3" cols="50" maxlength="50" required="required"></textarea>
                          </div>
                        </div>
                       
                       <div class='d-grid gap-2 col-6 mx-auto mt-2 mb-0 d-flex justify-content-center align-items-center'>
                              <button type="submit" style='width:100px;' id="addFillup" name='addFillup' class="btn btn-info border border-dark mb-1 d-grid gap-2 col-6 mx-auto">Save</button>
                      </div>
                    </div>
                </div>
             
              </div>
          </div>
     
   </div>
</section>
      <script>
        
         $("#addFillup").click(function(){
             
              const name = $("#name").val();
              const number = $("#number").val();
              const pincode = $("#pincode").val();
              const gCode = $( "#gCode").val();
              const address = $("#address").val();
          

          if($.isNumeric(number) && number.length === 10){
           // alert('Hello1');
            if($.isNumeric(pincode) && pincode.length === 6){
             //alert('Hello2');
              if(name.length > 0){
               //alert('Hello');
                $.post(
                  'http://localhost:8013/h20app/Agent/addNewFillUp.php',
                  { name: name, number: number, pincode: pincode, gCode: gCode, address: address },
                    function(name) {
                    console.log(name);
                  }
                 )
                 
                 setTimeout(loadingAgain, 500);

                   function loadingAgain(){
                    location.href='associate.php?info=fillup';
                   }

                 
                
                } else {
                alert('Invalid Name!');
               }

              } else {
               alert('Invalid pincode!');
            }

            } else {
              alert('Invalid Number!');
            }
           });


        function onlyNumberKey(evt) {
          // Only ASCII character in that range allowed
          var ASCIICode = evt.which ? evt.which : evt.keyCode;
          if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) return false;
          return true;
        }

  

      </script>
  
