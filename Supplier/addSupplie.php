
<section  id="newsupplie" class="pt-5  text-dark px-5">

<div class='text-dark text-center '>
   
      <div class="container h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
               <div class="col-10">
                   <div class="card-body p-4 p-md-5">
                      <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Add New Supplier</h3>
                      <div class='row'>
                       <div class="col-6"> 
                          <div class="form-outline mb-4">
                              <label class="form-label" for="name">Name</label>
                              <input type="text" id="name" class="form-control" maxlength='20' minlength='1' name='name' required="required"/>
                          </div>
                         </div> 
                        <div class="col-6"> 
                          <div class="form-outline mb-4">
                              <label class="form-label" for="number">Mobile Number</label>
                              <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onkeypress="return onlyNumberKey(event)"  type="text" inputmode="numeric"  id="number" class="form-control" maxlength='10' minlength='10' name='number'  required="required"/>
                          </div>
                        </div>
                      </div> 
                      <div class='row'>
                       <div class="col-6"> 
                          <div class="form-outline mb-4">
                              <label class="form-label" for="pincode">Pincode</label>
                              <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onkeypress="return onlyNumberKey(event)" type="text" inputmode="numeric" id="pincode" class="form-control" maxlength='6' minlength='6' name='pincode'  required="required"/>
                          </div>
                         </div> 
                        <div class="col-6"> 
                          <div class="form-outline mb-4">
                              <label class="form-label" for="capacity">Capacity in Litter</label>
                              <select class="form-select form-control" id="capacity" aria-label="Default select example" name='capacity' required="required">
                                  <option value="1000" selected>1000</option>
                                  <option value="5000">5000</option>
                                  <option value="10000">10000</option>
                              </select>
                          </div>
                        </div>
                      </div> 
                      <div class='row'>
                       <div class="col-6"> 
                          <div class="form-outline mb-4">
                              <label class="form-label" for="status">Status</label>
                              <input type="text" readonly id="status" class="form-control" name='status' value='Deactive' required="required"/>
                          </div>
                         </div> 
                        <div class="col-6"> 
                          <div class="form-outline mb-4">
                              <label class="form-label" for="processing">Order Processing at a time</label>
                              <input type="number" inputmode="numeric" id="processing" class="form-control" max='9' min='0' maxlength='1' minlength='1' name='number' value='0' required="required"/>
                          </div>
                        </div>
                      </div> 
                       <div class='d-grid gap-2 col-6 mx-auto mt-2 mb-0 d-flex justify-content-center align-items-center'>
                              <button type="submit" style='width:100px;' id="addSupplie" name='addSupplie' class="btn btn-info border border-dark mb-1 d-grid gap-2 col-6 mx-auto">Save</button>
                      </div>
                    </div>
                </div>
             
              </div>
          </div>
     
   </div>
   <div class='action'>
      <script>

        

         $("#addSupplie").click(function(){
             
              const name = $("#name").val();
              const number = $("#number").val();
              const pincode = $("#pincode").val();
              const capacity = $( "#capacity option:selected").val();
              const count = $("#processing").val();
         

          if($.isNumeric(number) && number.length === 10){
            //alert('Hello1');
            if($.isNumeric(pincode) && pincode.length === 6){
             // alert('Hello2');
              if($.isNumeric(capacity) && capacity === "1000" || capacity === "5000" || capacity === "10000"){
               //alert('Hello');
                $.post(
                  'http://localhost:8013/h20app/Supplier/addNewSupplier.php',
                  { name: name, number: number, pincode: pincode, capacity: capacity, count: count },
                    function(name) {
                    console.log(name);
                  }
                 )
                 
                 setTimeout(loadingSupplie, 500);

                   function loadingSupplie(){
                    location.href='homepage.php?info=supplies';
                   }

                 
                
                } else {
                alert('Invalid Capacity!');
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
   </div>
</section>