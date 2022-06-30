<?php 
   // if(isset($_POST['supplieid'])) { //if i have this post
       //  $supplieid =  $_POST['supplieid'];
       // $sql_query="SELECT * FROM onboardsupply WHERE id='$supplieid'";
       // $res=mysqli_query($conn,$sql_query);
       // if (mysqli_num_rows($res) == 1) {
      //  while($row = mysqli_fetch_assoc($res)) {

?> 
<section style="background-color: #eee;" id="editsupplie" class="pt-5  text-dark px-5">

  <div class='text-dark text-center '>
      <form method='post'>
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                 <div class="col-10">
                     <div class="card-body p-4 p-md-5">
                        <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Supplie Details</h3>
                        <input style="font-size: xx-small; background-color: #eee;" readonly class="pb-0 mb-0 mt-0 pt-0 border border-none" id="supplieid" value='' name="supplieid" hidden></input>
                        <div class='row'>
                         <div class="col-6"> 
                            <div class="form-outline mb-4">
                                <label class="form-label" for="name">Name</label>
                                <input type="text" id="name" class="form-control" maxlength='20' minlength='1' name='name' value='Not Found' required="required"/>
                            </div>
                           </div> 
                          <div class="col-6"> 
                            <div class="form-outline mb-4">
                                <label class="form-label" for="number">Mobile Number</label>
                                <input type="text" inputmode="numeric" id="number" class="form-control" maxlength='10' minlength='10' name='number' value='Not Found' required="required"/>
                            </div>
                          </div>
                        </div> 
                        <div class='row'>
                         <div class="col-6"> 
                            <div class="form-outline mb-4">
                                <label class="form-label" for="pincode">Pincode</label>
                                <input type="text" inputmode="numeric" id="pincode" class="form-control" maxlength='6' minlength='6' name='pincode' value='Not Found' required="required"/>
                            </div>
                           </div> 
                          <div class="col-6"> 
                            <div class="form-outline mb-4">
                                <label class="form-label" for="capacity">Capacity in Litter</label>
                                <select class="form-select form-control" id="capacity" aria-label="Default select example" name='capacity' required="required">
                                    <option value="1000">1000</option>
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
                                <input type="text" readonly id="status" class="form-control" name='status' value='Not Found' required="required"/>
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
                                <button type="submit" style='width:100px;' id="editProfile" name='editSupplie' class="btn btn-info mb-1 d-grid gap-2 col-6 mx-auto">Save</button>
                        </div>
                      </div>
                  </div>
               
                </div>
            </div>
        </form> 
     </div>
     <?php 
      //  }
        // }
       // }
      
     ?>

     <div class='action'>
        <script>

          $(document).ready(function () {
            var selectedSupplieData = JSON.parse(
              localStorage.getItem("selectedSupplieData")
            );

            $("#supplieid").val(selectedSupplieData.id);
            $("#name").val(selectedSupplieData.name);
            $("#number").val(selectedSupplieData.number);
            $("#pincode").val(selectedSupplieData.pincode);
            var capacity = selectedSupplieData.capacity;
            //alert(capacity);
            $("#status").val(selectedSupplieData.status);
            $("#processing").val(selectedSupplieData.count);

            $('#capacity option[value='+capacity+']').prop('selected', true);
          });


           $("#editProfile").click(function(){
            const id = $("#supplieid").val();
            const name = $("#name").val();
            const number = $("#number").val();
            const pincode = $("#pincode").val();
            const capacity = $( "#capacity option:selected").val();
            //alert(capacity);
            const count = $("#processing").val();
             
            if($.is_numeric(number) && number.length === 10){
              if($.is_numeric(pincode) && pincode.length === 6){
                if($.is_numeric(capacity) && capacity === 1000 || capacity === 5000 || capacity === 10000){
                  
                  $.post(
                    'http://localhost:8013/h20app/Supplier/editSupplie.php',
                    { supplieid: supplieid, status: status },
                    function(data) {
                        console.log(data);
                    }
                   )
                   
                 }
              }
              

            }

            $.isNumeric(-0x56)
           });

        </script>
     </div>
</section>