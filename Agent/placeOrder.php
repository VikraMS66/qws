<section  id="checkout" class="pt-5 mx-3 text-dark text-center">
<?php include('errors.php'); 
    echo @$msg;

    ?>
    <div class='row'>
        <div class="col-4">
        </div>
        <div class="col-4 bg-light pt-3">
                            <form>
                            <h3 class="text-center bg-warning pt-1 pb-1">CHECKOUT PAGE</h3>
                            <hr>
                            <h5 class="text-center"><span id="product"></span> LITTER WATER</h5>
                            <hr>
                            <!-- 2 column grid layout with text inputs for the first and last names -->
                            <div class="row mb-4">

                                <div class="col">
                                <div class="form-outline">
                                    <input type="text" id="name" class="form-control" maxlength='20' required="required"/>
                                    <label class="form-label" for="name">Name</label>
                                </div>
                                </div>

                                <div class="col">
                                <div class="form-outline">
                                    <input type="text" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onkeypress="return onlyNumberKey(event)" id="number" class="form-control" maxlength='10' minlength='10' required="required"/>
                                    <label class="form-label" for="number">Mobile Number</label>
                                </div>
                                </div>

                            </div>

                            <div class="row mb-4">

                                <div class="col">
                                <div class="form-outline">
                                    <input type="text" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onkeypress="return onlyNumberKey(event)" readonly id="pincode" maxlength='6' minlength='6' class="form-control" required="required"/>
                                    <label class="form-label" for="pincode">Pincode</label>
                                </div>
                                </div>

                                <div class="col">
                                <div class="form-outline">
                                    <input type="text" id="gCode" maxlength='50' class="form-control" />
                                    <label class="form-label" for="gCode">Google Map Plus Code</label>
                                </div>
                                </div>

                            </div>

                          
                        <div class="form-outline mb-4 bg-dark text-white text-center" style="width:200;">

                            <label class="form-label h5" for="address"><u>Address</u></label>
                            <textarea id="address" type="text" class="form-control" name="address" rows="2" cols="10" maxlength="500" required="required"></textarea>

                        </div>

                        <hr>
                            <div class="form-outline mb-2 text-start">
                            <h5 class="text-success mx-2 text-center" style="width:200;"> Get Delivered By <span id='etd'></span></h5>
                            </div>

                            <div class="form-outline mb-3 text-start">
                                    <table class="table mt-3" style="width:200;">
                                    <tbody class='text-white bg-dark'>
                                    <tr>
                                    <td>Price Rs. </td>
                                    <td id="price"></td>
                                    </tr>
                                    <tr>
                                    <td>GST Rs. </td>
                                    <td id="gst"></td>
                                    </tr>
                                    <tr>
                                    <td>Delivery Charge Rs. </td>
                                    <td id="charge"></td>
                                    </tr>
                                    <tr class='text-white bg-success h5'>
                                    <td>Total Rs. </td>
                                    <td id="total"></td>
                                    </tr>
                                    </tbody>
                                    </table>
                            </div>

                            <!-- Submit button -->
                            <button type="button" id='placeorderNow' style="background: linear-gradient(135deg, #753370 0%, #298096 100%);" class="btn btn-lg btn-block mb-4 text-white">PLACE ORDER</button>
                            
                            </form>


</div>
<div class="col-4">

</div>
</div>

</section>

<script>

$(document).ready(function () {
      var productDetails = JSON.parse(localStorage.getItem("productDetails"));

       $("#product").text(productDetails.pName);
       $("#pincode").val(productDetails.pincode);

       var amount = productDetails.pRate;
        var gst = ((3 / 100) * amount).toFixed(0);
        var dCharge = productDetails.pDeliveryCharge;
        $("#price").text(amount);
        $("#charge").text(dCharge);
        $("#gst").text(gst);
        $("#total").text(parseInt(amount) + parseInt(gst) + parseInt(dCharge));

          function formatAMPM(date, addedTime) {
              var hours = date.getHours() + addedTime;
              var minutes = date.getMinutes();
              var ampm = hours >= 12 ? 'PM' : 'AM';
              hours = hours % 12;
              hours = hours ? hours : 12; // the hour '0' should be '12'
              minutes = minutes < 10 ? '0'+minutes : minutes;
              var strTime = hours + ':' + minutes + ' ' + ampm;
              return strTime;
            }
            
            if(productDetails.productID === "pd1"){
              $("#etd").text(formatAMPM(new Date, 2));
            } else if(productDetails.productID === "pd2"){
              $("#etd").text(formatAMPM(new Date, 3));
            } else if(productDetails.productID === "pd3"){
              $("#etd").text(formatAMPM(new Date, 4));
            } 
        });

        function onlyNumberKey(evt) {
          // Only ASCII character in that range allowed
          var ASCIICode = evt.which ? evt.which : evt.keyCode;
          if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) return false;
          return true;
        }

        $("#placeorderNow").click(function(){

            var product = $("#product").text();
            var name = $("#name").val();
            var number = $("#number").val();
            var pincode = $("#pincode").val();
            var gCode = $("#gCode").val();
            var address = $("#address").val();
            var etd = $("#etd").text();
            var amount = $("#total").text();

            alert(amount);

            if(name.length > 0) {

                if(number.length === 10) {

                    if(pincode.length === 6) {

                        if(address.length > 0) {

                            if(amount > 250) {

                                $.post(
                                'http://localhost:8013/h20app/Agent/orderDataSubmit.php',
                                { name: name, number: number, capacity: product, pincode: pincode, gCode: gCode, address: address, etd: etd, amount: amount },

                                    function(number) {
                                    console.log(number);
                                }
                                )
                                  
                                alert("Order Plcaed!")
                                
                                setTimeout(redirectPage, 500);

                                function redirectPage(){
                                location.href='associate.php?info=home';
                                }

                            } else {
                                alert("Invalid Amount! Try again from start!");
                            }

                        } else {
                            alert("Address Required!");
                        }

                    } else {

                        alert("Invalid Pincode");

                    }

                } else {
                    alert("Enter Valid Mobile Number!");
                }

            }else {
                alert("Name Required!");
            }
            
           

           

        });

    </script>