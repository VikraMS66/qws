
<section  id="products" class="pt-5 mx-3">
<?php 
      if (isset($_POST['number'])) {
        $value = mysqli_real_escape_string($conn, $_POST['number']);
?>
       <div class="mt-4">
            <form method='post' action='associate.php?info=search_supply'>
                    <div class="input-group text-center mx-3 mb-2" style="width:300px;">
                    <?php
                       echo "<input oninput='javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);' onkeypress='return onlyNumberKey(event)' name='number'  id='number' type='text' class='form-control rounded'  maxlength='6' minlength='6' value='".$value."' placeholder='Enter Pincode'/>";
                       ?>
                        <button type="submit" id="searchSupply" class="mx-2 btn btn-outline-dark text-white rounded">Search</button>
                    </div>
            </form>
        </div>


<div class="productsAvailable" style="height:650px;">
         
     <div class="container mt-1 pt-5">
        <div class="row">
        <?php 
       
         $product = array('no', 'no', 'no');


           $query1 = "SELECT * FROM onboardsupply WHERE status='Active' AND pincode='$value' AND capacity=1000 AND multiOrderCount > 0";
           $res1 = mysqli_query($conn, $query1);

          if (mysqli_num_rows($res1) > 0) {
           $product[0] = 'yes';
           
          }

          
          $query2 = "SELECT * FROM onboardsupply WHERE status='Active' AND pincode='$value' AND capacity=5000 AND multiOrderCount > 0";
          $res2 = mysqli_query($conn, $query2);
   
           if (mysqli_num_rows($res2) > 0) {
            $product[1] = 'yes';
         }

         $query2 = "SELECT * FROM onboardsupply WHERE status='Active' AND pincode='$value' AND capacity=10000 AND multiOrderCount > 0";
          $res2 = mysqli_query($conn, $query2);
   
           if (mysqli_num_rows($res2) > 0) {
            $product[2] = 'yes';
         

           }
        

        
        if($product[0] == 'yes') {
            ?>
            <div class="col-md-4">
            <div id="pd1" class="card bg-dark">
              <div class="card-icon ml-5">
                <img src="../images/thou.png" />
              </div>
              <div class="card-body bg-white">
                <h5 class="card-title text-dark h3">1000 Litter Water</h5>
                <h5 class="card-title text-success h4">Price Rs.250</h5>
                <p class="card-text text-info h5">Get Delivery within 2-hours</p>
                <a id="pd1" style='height:50px;width:100%' href="associate.php?info=processOrder" name="productSelected" class="btn btn-dark productSelected btn-lg">Order Now</a>
              </div>
            </div>
          </div>
         <?php 
         
        }

         ?>

          <?php
          
          if($product[1] == 'yes') {
         ?>
        
          <div class="col-md-4">
            <div id="pd2" class="card bg-dark">
              <div class="card-icon ml-5">
                <img src="../images/ten.png" />
              </div>
              <div class="card-body bg-white">
                <h5 class="card-title text-dark h3">5000 Litter Water</h5>
                <h5 class="card-title text-success h4">Price Rs.1000</h5>
                <p class="card-text text-info h5">Get Delivery within 3-hours</p>
                <a id="pd2" style='height:50px;width:100%' href="associate.php?info=processOrder" name="productSelected" class="btn btn-dark productSelected btn-lg">Order Now</a>
              </div>
            </div>
          </div>
          <?php 
          }
        
        if($product[2] == 'yes') {
           
          ?>
            <div class="col-md-4">
            <div id="pd3" class="card bg-dark ">
              <div class="card-icon ml-5">
                <img src="../images/fiv.png" />
              </div>

              <div class="card-body bg-white">
                <h5 class="card-title text-dark h3">10000 Litter Water</h5>
                <h5 class="card-title text-success h4">Price Rs.1500</h5>
                <p class="card-text text-info h5">Get Delivery within 4-hours</p>
                <a id="pd3" style='height:50px;width:100%' href="associate.php?info=processOrder"  name="productSelected" class="btn btn-dark productSelected btn-lg">Order Now</a>
              </div>
            </div>
          </div>
          <?php 
        }

        if($product[0] == 'yes' || $product[1] == 'yes' || $product[2] == 'yes') {


        } else {

          echo "<h1 class'text-center mt-5 pt-5 mb-5 pb-5 mx-5'>Sorry currently no supllies available.</h1>";
        }
          
          ?>
        </div>
        </div>
      
        </div>
        <?php

            }

            ?>

</section>

<script>

    function onlyNumberKey(evt) {
          // Only ASCII character in that range allowed
          var ASCIICode = evt.which ? evt.which : evt.keyCode;
          if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) return false;
          return true;
        }

          
        $(document).on("click", "#pd1", function () {
        var pincode = $("#number").val();
          var productDetails = {
            productID: "pd1",
            pName: 1000,
            pRate: 250,
            pDeliveryCharge: 50,
            pincode: pincode,
          };
          localStorage.setItem("productDetails", JSON.stringify(productDetails));

            
          //window.location.href = "./checkoutPage.html";
        });
        $(document).on("click", "#pd2", function () {
        var pincode = $("#number").val();
          var productDetails = {
            productID: "pd2",
            pName: 5000,
            pRate: 1000,
            pDeliveryCharge: 100,
            pincode: pincode,
          };
          localStorage.setItem("productDetails", JSON.stringify(productDetails));
          //window.location.href = "./checkoutPage.html";
        });
        $(document).on("click", "#pd3", function () {
        var pincode = $("#number").val();
          var productDetails = {
            productID: "pd3",
            pName: 10000,
            pRate: 1500,
            pDeliveryCharge: 180,
            pincode: pincode,
          };
          localStorage.setItem("productDetails", JSON.stringify(productDetails));

          //window.location.href = "./checkoutPage.html";
        });

</script>
   