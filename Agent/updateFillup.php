
<section  id="editfillup" class="pt-5  text-dark px-5">

<div class='text-dark text-center '>
   
      <div class="container h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
               <div class="col-10">
                   <div class="card-body p-4 p-md-5 bg-dark text-white text-center">
                      <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Fill-up Details</h3>
                      <input style="font-size: xx-small; background-color: #eee;" readonly class="pb-0 mb-0 mt-0 pt-0 border border-none" id="id" value='' name="id" hidden></input>
                      <div class='row'>
                       <div class="col-6"> 
                          <div class="form-outline mb-4 bg-dark text-white text-center">
                              <label class="form-label" for="name">Name</label>
                              <input type="text" id="name" class="form-control" maxlength='20' minlength='1' name='name' value='Not Found' required="required"/>
                          </div>
                         </div> 
                        <div class="col-6"> 
                          <div class="form-outline mb-4 bg-dark text-white text-center">
                              <label class="form-label" for="number">Mobile Number</label>
                              <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onkeypress="return onlyNumberKey(event)" type="text" inputmode="numeric" id="number" class="form-control" maxlength='10' minlength='10' name='number' value='Not Found' required="required"/>
                          </div>
                        </div>
                      </div> 
                      <div class='row'>
                       <div class="col-6"> 
                          <div class="form-outline mb-4 bg-dark text-white text-center">
                              <label class="form-label" for="pincode">Pincode</label>
                              <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onkeypress="return onlyNumberKey(event)" type="text" inputmode="numeric" id="pincode" class="form-control" maxlength='6' minlength='6' name='pincode' value='Not Found' required="required"/>
                          </div>
                         </div> 
                        <div class="col-6"> 
                          <div class="form-outline mb-4 bg-dark text-white text-center">
                              <label class="form-label" for="status">Status</label>
                              <select class="form-select form-control" id="status" aria-label="Default select example" name='status' required="required">
                                  <option value="Active">Active</option>
                                  <option value="Deactive">Deactive</option>
                              </select>
                          </div>
                        </div>
                      </div> 
                      <div class='row'>
                       <div class="col-6"> 
                          <div class="form-outline mb-4 bg-dark text-white text-center">
                              <label class="form-label" for="gCode">Google Map Plus Code</label>
                              <input type="text" id="gCode" class="form-control" name='gCode' maxlength='50' value='Not Found' required="required"/>
                          </div>
                         </div> 
                        <div class="col-6"> 
                          <div class="form-outline mb-4 bg-dark text-white text-center">
                              <label class="form-label" for="address">Address</label>
                              <textarea id="address" type="text" class="form-control" name="address" rows="3" cols="50" maxlength="50" required="required"></textarea>
                          </div>
                        </div>
                      </div> 
                       <div class='d-grid gap-2 col-6 mx-auto mt-2 mb-0 d-flex justify-content-center align-items-center'>
                              <button type="submit" href='associate.php?info=fillup' style='width:100px;' id="editFillup" name='editFillup' class="btn btn-info border border-dark mb-1 d-grid gap-2 col-6 mx-auto">Save</button>
                      </div>
                    </div>
                </div>
             
              </div>
          </div>
     
   </div>
   <div class='action'>
      <script>

        $(document).ready(function () {
          var selectedFillupData = JSON.parse(
            localStorage.getItem("selectedFillupData")
          );

          $("#id").val(selectedFillupData.id);
          $("#name").val(selectedFillupData.name);
          $("#number").val(selectedFillupData.number);
          $("#pincode").val(selectedFillupData.pincode);
          var status = selectedFillupData.status;
          //alert(capacity);
          $("#gCode").val(selectedFillupData.gCode);
          $("#address").val(selectedFillupData.address);

          $('#status option[value='+status+']').prop('selected', true);
        });


         $("#editFillup").click(function(){

              const id = $("#id").val();
              const name = $("#name").val();
              const number = $("#number").val();
              const pincode = $("#pincode").val();
              const status = $( "#status option:selected").val();
              const gCode = $("#gCode").val();
              const address = $("#address").val();
         

          if($.isNumeric(number) && number.length === 10){
            //alert('Hello1');
            if($.isNumeric(pincode) && pincode.length === 6){
             // alert('Hello2');
              if(status === "Active" || status === "Deactive" ){
               //alert('Hello');
                $.post(
                  'http://localhost:8013/h20app/Agent/editFillupData.php',
                  { id: id, name: name, number: number, pincode: pincode, status: status, gCode: gCode, address: address },
                    function(id) {
                    console.log(id);
                  }
                 )

                 setTimeout(changeHeader, 500);
                 function changeHeader(){
                      location.href='associate.php?info=fillup';
                 }
                
               } else {
              alert('Invalid Status!');
             }

            } else {
             alert('Invalid Pincode!');
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