<?php 
//include("auth.php");
require('db.php');
$ID=$_SESSION['cnumberID'];
$errors = array();

if (isset($_REQUEST['addressbook'])) {
  header("location:cHomePage.php?info=addressbook");
}


   $queryAddressID = "SELECT * FROM customer WHERE mNumber='$ID'";
   $resultAddressID = mysqli_query($conn, $queryAddressID);

  if (mysqli_num_rows($resultAddressID) == 1) {
   
    while($rowAddressID=mysqli_fetch_array($resultAddressID)) {

       $id = $rowAddressID['addressId'];
        
       $queryAddressData = "SELECT * FROM addressbook WHERE id='$id'";

       $resultAddressData= mysqli_query($conn, $queryAddressData);

       if (mysqli_num_rows($resultAddressData) == 1) {

        while($rowAddressData=mysqli_fetch_array($resultAddressData)) {


?>
<div class=" text-white pt-5 mt-4" style="background-image:url('../images/product.jpg');" >
     
<form method="post" >

            <div class="card-header bg-info fixed-top  mt-5 pt-4">
              <h5 class="text-center bg-primary">WATER SUPPLIES AVAILABLE</h5>
            </div>
         
         <div class='fixed-top mt-2 mx-5' style=" width: 300px ;" >
         <?php
             // echo "<label id='tagName' class='text-white h5 bg-dark'></label>";
              echo "<input style='width: 55px ;' id='tagName' readonly type='text' class='text-white bg-dark h5 border border-dark' name='tagName' value=".$rowAddressData['tagName'].">";
              echo "<input style='width: 80px ;' id='pincode' readonly type='text' class='text-white bg-dark h5 border border-info' name='pincode' value=".$rowAddressData['pincode'].">";
          ?>

         <button style='width:80px; height:27px;' id='addressbook'  name='addressbook' class='text-white bg-dark h5 ml-2 border border-warning' title='Change Address'>Change</button>
         </div>
 

     <div class="productsAvailable" style="height:650px;">
         
     <div class="container mt-1 pt-5">
        <div class="row">
        <?php 
       
        $product = array('no', 'no', 'no');


          $caddPincode = $rowAddressData['pincode'];

           $query1 = "SELECT * FROM onboardsupply WHERE status='Active' AND pincode='$caddPincode' AND capacity=1000 AND multiOrderCount > 0";
           $res1 = mysqli_query($conn, $query1);

          if (mysqli_num_rows($res1) > 0) {
           $product[0] = 'yes';
           
          }

          
          $query2 = "SELECT * FROM onboardsupply WHERE status='Active' AND pincode='$caddPincode' AND capacity=5000 AND multiOrderCount > 0";
          $res2 = mysqli_query($conn, $query2);
   
           if (mysqli_num_rows($res2) > 0) {
            $product[1] = 'yes';
         }

         $query2 = "SELECT * FROM onboardsupply WHERE status='Active' AND pincode='$caddPincode' AND capacity=10000 AND multiOrderCount > 0";
          $res2 = mysqli_query($conn, $query2);
   
           if (mysqli_num_rows($res2) > 0) {
            $product[2] = 'yes';
         

           }
        

        
        if($product[0] == 'yes') {
            ?>
            <div class="col-md-4">
            <div id="pd1" class="card bg-dark">
              <div class="card-icon">
                <img src="../images/thousand.jpg" />
              </div>
              <div class="card-body">
                <h5 class="card-title text-white">1000 Litter Water</h5>
                <h5 class="card-title text-success">Price Rs.250</h5>
                <p class="card-text text-info">Get Delivery within 2-hours</p>
                <a id="pd1" href="cHomePage.php?info=checkout" name="productSelected" class="btn btn-primary productSelected">Order Now</a>
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
              <div class="card-icon">
                <img src="../images/five.jpg" />
              </div>
              <div class="card-body">
                <h5 class="card-title text-white">5000 Litter Water</h5>
                <h5 class="card-title text-success">Price Rs.1000</h5>
                <p class="card-text text-info">Get Delivery within 3-hours</p>
                <a id="pd2" href="cHomePage.php?info=checkout" name="productSelected" class="btn btn-primary productSelected">Order Now</a>
              </div>
            </div>
          </div>
          <?php 
          }
        
        if($product[2] == 'yes') {
           
          ?>
            <div class="col-md-4 ">
            <div id="pd3" class="card bg-dark ">
              <div class="card-icon">
                <img src="../images/five.jpg" />
              </div>

              <div class="card-body">
                <h5 class="card-title text-white ">10000 Litter Water</h5>
                <h5 class="card-title text-success">Price Rs.1500</h5>
                <p class="card-text text-info">Get Delivery within 4-hours</p>
                <a id="pd3" href="cHomePage.php?info=checkout"  name="productSelected" class="btn btn-primary productSelected">Order Now</a>
              </div>
            </div>
          </div>
          <?php 
        }

        if($product[0] == 'yes' || $product[1] == 'yes' || $product[2] == 'yes') {


        } else {

          echo "<h1 class'text-center mt-5 pt-5 mb-5 pb-5 mx-5'>Sorry currently no supllies in your area.</h1>";
        }
          
          ?>
        </div>
      </div>
      
        </div>
      </form>
        
    </div>

    <?php 
   
        
      }
    }

    
  }
   
}



  
  ?>

    <script>

      
            
        $(document).on("click", "#pd1", function () {
          var productDetails = {
            productID: "pd1",
            pName: 1000,
            pRate: 250,
            pDeliveryCharge: 50,
          };
          localStorage.setItem("productDetails", JSON.stringify(productDetails));

            
          //window.location.href = "./checkoutPage.html";
        });
        $(document).on("click", "#pd2", function () {
          var productDetails = {
            productID: "pd2",
            pName: 5000,
            pRate: 1000,
            pDeliveryCharge: 100,
          };
          localStorage.setItem("productDetails", JSON.stringify(productDetails));
          //window.location.href = "./checkoutPage.html";
        });
        $(document).on("click", "#pd3", function () {
          var productDetails = {
            productID: "pd3",
            pName: 10000,
            pRate: 1500,
            pDeliveryCharge: 180,
          };
          localStorage.setItem("productDetails", JSON.stringify(productDetails));

          //window.location.href = "./checkoutPage.html";
        });

    </script>
   
