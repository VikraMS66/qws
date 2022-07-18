<?php
 include("auth.php");
 require('db.php');
  $username="";
  $errors = array(); 
  
  if (isset($_POST['Order'])) {

     $customerID = $_SESSION['cnumberID'];
     $product = mysqli_real_escape_string($conn, $_POST['pName']);
     $pincode = mysqli_real_escape_string($conn, $_POST['dPincode']);
    
     $query = "SELECT * FROM onboardsupply WHERE status='Active' AND pincode='$pincode' AND capacity='$product' AND multiOrderCount > 0 LIMIT 1";
     $res = mysqli_query($conn, $query);

     if (mysqli_num_rows($res) > 0) {
      
      //echo '<script>alert("check case")</script>';

            
             $queryId = "SELECT * FROM customer WHERE mNumber='$customerID'";
             $resultsId = mysqli_query($conn, $queryId);

             if (mysqli_num_rows($resultsId) > 0) {

              while($rowId = mysqli_fetch_assoc($resultsId)) {
               
                    $addressId=$rowId['addressId'];

                    $queryAddress = "SELECT * FROM addressbook WHERE id='$addressId'";
                    $results = mysqli_query($conn, $queryAddress);

                    if (mysqli_num_rows($results) > 0) {
                      while($rowData = mysqli_fetch_assoc($results)) {


                        $customerName = $rowData['name'];
                        $customerNumber = $rowData['mNumber'];
                        $address = $rowData['address'];
                        $amount = mysqli_real_escape_string($conn, $_POST['bTotal']);
                        $gCode = $rowData['gCode'];
                        $etd = mysqli_real_escape_string($conn, $_POST['timeSet']);
                        
                        $supplierID = "";
                        $supplierName = "";
                        $supplierNumber ="";

                        //id to reduce multiordercount
                        $suppllyID = "";

    
      
                            while($row=mysqli_fetch_array($res))
                              { 
                                $suppllyID = $row['id'];
                                $supplierID = $row['sellerid'];
                                $supplierName = $row['name'];
                                $supplierNumber = $row['number'];
                              }

                              

                              $queryInsert = "INSERT INTO orders (custid,supid,supplyid,product,custName,custNumber,address,pincode,gCode,amount,supName,supNumber,etd) 
                                              VALUES('$customerID','$supplierID','$suppllyID','$product','$customerName','$customerNumber','$address','$pincode','$gCode','$amount','$supplierName','$supplierNumber','$etd')";

                              $sql=mysqli_query($conn, $queryInsert);

                              if($sql) {
                                $que = "update onboardsupply set multiOrderCount=multiOrderCount-1 where id='$suppllyID'";
                                $got = mysqli_query($conn, $que);
                              
                              }
                              echo("<script>location.href = 'cHomePage.php?info=orders';</script>");
                              //header("Location:cHomePage.php?info=orders");
                              
                            }


                        } else {
                          
                         array_push($errors, "<div class='alert alert-warning'><b>Address Not Found</b></div>");
                        }
                              
                                  //need to be updated to orders
                             
                            
                  } 

              } else {
                          
               array_push($errors, "<div class='alert alert-warning'><b>Profile Data Not Found</b></div>");
            }
                    
                    //need to be updated to orders
                    //header("location:cHomePage.php?info=addressbook");
      } else {
                          
        array_push($errors, "<div class='alert alert-warning'><b>Out of Stock!</b></div>");
      }

  } else {
        array_push($errors, "<div class='alert alert-warning'><b>Some Error!</b></div>");
      }



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />

    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0"
    />

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
      integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
      crossorigin="anonymous"
    ></script>

    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>

   

    <style>
      #checkoutImg {
       width: 500px;
       }

.card {
  width: 60rem;
  margin: auto;
  background: white;
  position: center;
  align-self: center;
  border-radius: 1.5rem;
  box-shadow: 4px 3px 20px #3535358c;
  display: flex;
  flex-direction: row;
}

.leftside {
  background: #030303;
  width: 25rem;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  border-top-left-radius: 1.5rem;
  border-bottom-left-radius: 1.5rem;
}

.product {
  object-fit: cover;
  width: 20em;
  height: 20em;
  border-radius: 100%;
}

.rightside {
  background-color: #ffffff;
  width: 35rem;
  border-bottom-right-radius: 1.5rem;
  border-top-right-radius: 1.5rem;
  padding: 1rem 2rem 3rem 3rem;
}

p {
  display: block;
  font-size: 1.1rem;
  font-weight: 400;
  margin: 0.8rem 0;
}

.inputbox {
  color: #030303;
  width: 100%;
  padding: 0.5rem;
  border: none;
  border-bottom: 1.5px solid #ccc;
  margin-bottom: 1rem;
  border-radius: 0.3rem;
  font-family: "Roboto", sans-serif;
  color: #615a5a;
  font-size: 1.1rem;
  font-weight: 500;
  outline: none;
}
.expcvv {
  display: flex;
  justify-content: space-between;
  padding-top: 0.6rem;
}

.expcvv_text {
  padding-right: 1rem;
}
.expcvv_text2 {
  padding: 0 1rem;
}

.button {
  background: linear-gradient(135deg, #753370 0%, #298096 100%);
  padding: 15px;
  border: none;
  border-radius: 50px;
  color: white;
  font-weight: 400;
  font-size: 1.2rem;
  margin-top: 10px;
  width: 100%;
  letter-spacing: 0.11rem;
  outline: none;
}

.button:hover {
  transform: scale(1.05) translateY(-3px);
  box-shadow: 3px 3px 6px #38373785;
}




input:focus,
select:focus,
textarea:focus,
button:focus {
    outline: none;
}

@media only screen and (max-width: 1000px) {
  .card {
    flex-direction: column;
    width: auto;
  }

  .leftside {
    width: 100%;
    border-top-right-radius: 0;
    border-bottom-left-radius: 0;
    border-top-right-radius: 0;
    border-radius: 0;
  }

  .rightside {
    width: auto;
    border-bottom-left-radius: 1.5rem;
    padding: 0.5rem 3rem 3rem 2rem;
    border-radius: 0;
  }



}

      </style>

    <title>Checkout Page</title>
  </head>
  <body>
  
    <div class="mt-1 pt-3 text-start text-dark mx-1"  >
      <form method="post">
          <div class="card">
            <div class="leftside">
              <img
                id="checkoutImg"
                src="../images/orderbg.jpg"
                class="product"
                alt="Image"
              />
            </div>
            <div class="rightside">
              <form action="">
                <h5 class="text-center text-uppercase">CheckOut</h5>
                <hr>
                 <h4 class="text-center"><input style=" width: 80px ;" readonly id="pName" name="pName" class="text-center border border-white h4" value="Not Found"/> Litter Water</h4>
                <hr>
              
                <?php 


             $ID = $_SESSION['cnumberID'];
             $queryId = "SELECT * FROM customer WHERE mNumber='$ID'";
             $resultsId = mysqli_query($conn, $queryId);

             if (mysqli_num_rows($resultsId) > 0) {
              while($rowId = mysqli_fetch_assoc($resultsId)) {
               
                    $addressId=$rowId['addressId'];

                    $queryAddress = "SELECT * FROM addressbook WHERE id='$addressId'";
                    $results = mysqli_query($conn, $queryAddress);

                    if (mysqli_num_rows($results) > 0) {
                      while($row = mysqli_fetch_assoc($results)) {

            
         ?>
                  <div class="cAdressData">
                    <div class="container">
                      <div class="row">
                        <div class="col-lg-6">
                    <h5>Name</h5>
                    </div>
                        <div class="col-lg-6 ">
                          <?php
                    echo "<h5 style='width: 150px ;' class='text-start border border-white noselect'>".$row['name']."</h5>";
                    ?>
                    </div>
                   </div>
                   </div>
                   <div class="container">
                    <div class="row">
                      <div class="col-lg-6">
                  <p>Contact No.</p>
                  </div>
                  <div class="col-lg-6 ">
                    <?php
                   echo "<p style='width: 150px ;' class='text-start border border-white noselect'>".$row['mNumber']."</p>";
                    ?>
                    </div>
                    </div>
                 </div>
                   <div class="container">
                    <div class="row">
                      <div class="col-lg-6">
                  <p>Pincode</p>
                  </div>
                  <div class="col-lg-6 ">
                    <?php
                    echo "<p><input style='width: 150px ;' name='dPincode' readonly class='text-start border border-white noselect' value='".$row['pincode']."'></p>";
                    ?>
                    </div>
                    </div>
                 </div>
                   <div class="container">
                    <div class="row">
                      <div class="col-lg-6">
                  <p>Google Map Code</p>
                  </div>
                  <div class="col-lg-6 ">
                    <?php
                    echo "<p style='width: 150px ;' class='text-start border border-white noselect'>".$row['gCode']."</p>";
                    ?>
                    </div>
                    </div>
                 </div>
                 <div class="container">
                  <div class="row">
                    <div class="col-lg-6 ">
                <p>Address</p>
                </div>
                    <div class="col-lg-6 ">
                      <?php
                 echo "<p style='width: 200px ;' class='text-start border border-white'>".$row['address']."</p>";
                ?>
                </div>
                </div>
                </div>
                <?php 
            }
          }
        }
      }
                ?>
             </div>
                <hr>
                <p class="h5 text-success mx-2 text-center"> Get Delivered By <span ><input style=" width: 120px ;" readonly  id="timeSet" name="timeSet" class="text-success border border-white noselect " value="Not Found" /></span></p>
                <hr>
                <div class="billing">
                  <div class="container">
                    <div class="row">
                      <div class="col-lg-6 ">
                  <h5 >Amount Rs.</h5>
                  </div>
                      <div class="col-lg-6 ">
                  <h5 id="bInitial">0.0</h5>
                  </div>
                 </div>
                 </div>
                 <div class="container">
                  <div class="row">
                    <div class="col-lg-6 ">
                <p >Delivery Charge Rs.</p>
                </div>
                <div class="col-lg-6 ">
                  <p id="bDelivery">0.0</p>
                  </div>
                  </div>
               </div>
               <div class="container">
                <div class="row">
                  <div class="col-lg-6 ">
              <p>GST Rs.</p>
              </div>
                  <div class="col-lg-6 ">
              <p id="bGST">0.0</p>
              </div>
              </div>
             </div>
             <div class="container text-dark">
              <div class="row">
                <div class="col-lg-6 ">
            <h5>Total Amount Rs.</h5>
            </div>
                <div class="col-lg-6">
            <h5><input style=" width: 120px ;" readonly  id="bTotal" name="bTotal" class="text-start border border-white noselect" value="Not Found" /></h5>
            </div>
            </div>
           </div>
           </div >
                <button  id="orderPlaced" href="#" type="submit"  class="button" name="Order">Order</button>
                <p style="font-size: x-small; width:200px; " class='text-warning bg-dark '>Once Placed Order Cannot be Cancelled.</p>
            </div>
          </div>
        </div>
      </form>
    </div>
       
    <script>
      var productDetails = JSON.parse(localStorage.getItem("productDetails"));
       $("#pName").val(productDetails.pName);
       var amount = productDetails.pRate;
           var gst = ((3 / 100) * amount).toFixed(0);
            var dCharge = productDetails.pDeliveryCharge;
             $("#bInitial").text(amount);
          $("#bDelivery").text(dCharge);
          $("#bGST").text(gst);
          $("#bTotal").val(parseInt(amount) + parseInt(gst) + parseInt(dCharge));

          // var selectedAddressBookData = JSON.parse(localStorage.getItem("selectedAddressBookData"));
          // $("#dName").val(selectedAddressBookData.name);
          // $("#dNumber").val(selectedAddressBookData.number);
          // $("#dAddress").val(selectedAddressBookData.address);
          // $("#dPincode").val(selectedAddressBookData.pincode);
          // $("#dGCode").val(selectedAddressBookData.gCode);


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
              $("#timeSet").val(formatAMPM(new Date, 2));
            } else if(productDetails.productID === "pd2"){
              $("#timeSet").val(formatAMPM(new Date, 3));
            } else if(productDetails.productID === "pd3"){
              $("#timeSet").val(formatAMPM(new Date, 4));
            } 
            

           //alert(formatAMPM(new Date, 2));



          //on successful order placing product data is removed
          //$(document).on("click", "#orderPlace", function () {
          // localStorage.removeItem("productDetails");
          //});

    </script>
  </body>
</html>
