<section  id="complaintDetails" class="pt-5 mx-3 bg-dark text-white">

<?php
    $ID = $_SESSION['managerid'];

    $query = "SELECT * FROM agent WHERE number='$ID'";
    $results = mysqli_query($conn, $query);
    
    $customerNumber="";
    $customerName="";
    $customerEmail="";

    $sellerNumber="";
    $sellerName="";
    $sellerEmail="";
    $sellerCName="";
    $sellerGst="";
    $sellerStatus="";
    $sellerMsg="";
    $sellerAddress="";
    $sellerPincode="";
    $sellerGCode="";
    
    $orderid="";
    $capacity="";
    $amount="";
    $orderdDate="";
    $orderEtd="";
    $orderStatus="";
    $supplieNumber="";
    $supllierName="";
    $deliveryName="";
    $deliveryNumber="";
    $deliveryAddress="";
    $deliveryPincode="";
    $deliveryGCode="";
    $supplyid="";

    
    $issue="";
    $complaintMessage="";
    $complaintDate="";
    $complaintStatus="";
    $complaintid="";
    $complaintBy="";


    if (mysqli_num_rows($results) == 1) {

        while($row=mysqli_fetch_array($results)) {
            $complaintid=$row['orderid'];
        }

        $query_get = "SELECT * FROM complaint WHERE id='$complaintid'";
        $results_get = mysqli_query($conn, $query_get);

        if (mysqli_num_rows($results_get) == 1) {
            while($row_get=mysqli_fetch_array($results_get)) {

                $orderid=$row_get['orderid'];
                $complaintBy=$row_get['complaintby'];
                $issue=$row_get['issue'];
                $complaintMessage=$row_get['message'];
                $complaintDate=$row_get['date'];
                $complaintStatus=$row_get['status'];

            }
        }

        $orders = "SELECT * FROM orders WHERE id='$orderid'";
        $orders_sql = mysqli_query($conn, $orders);
        if (mysqli_num_rows($orders_sql) == 1) {
            while($orders_row=mysqli_fetch_array($orders_sql)) {
                 $customerNumber=$orders_row['custid'];
                 $sellerNumber=$orders_row['supid'];   
                 $supplyid=$orders_row['supplyid'];

                $capacity=$orders_row['product'];
                $amount=$orders_row['amount'];
                $orderdDate=$orders_row['date'];
                $orderEtd=$orders_row['etd'];
                $orderStatus=$orders_row['status'];
                $supplieNumber=$orders_row['supNumber'];
                $supllierName=$orders_row['supName'];
                $deliveryName=$orders_row['custName'];
                $deliveryNumber=$orders_row['custNumber'];
                $deliveryAddress=$orders_row['address'];
                $deliveryPincode=$orders_row['pincode'];
                $deliveryGCode=$orders_row['gCode'];

            }
        }

        $customer = "SELECT * FROM customer WHERE mNumber='$customerNumber'";
        $customer_sql = mysqli_query($conn, $customer);

        if (mysqli_num_rows($customer_sql) == 1) {
            while($customer_row=mysqli_fetch_array($customer_sql)) {
                $customerName=$customer_row['name'];
                $customerEmail=$customer_row['email']; 
            }
        }

        $seller = "SELECT * FROM supplier WHERE mNumber='$sellerNumber'";
        $seller_sql = mysqli_query($conn, $seller);

        if (mysqli_num_rows($seller_sql) == 1) {
            while($seller_row=mysqli_fetch_array($seller_sql)) {
              
                    $sellerName=$seller_row['name'];
                    $sellerEmail=$seller_row['email'];
                    $sellerCName=$seller_row['companyName'];
                    $sellerGst=$seller_row['gstNumber'];
                    $sellerStatus=$seller_row['status'];
                    $sellerMsg=$seller_row['statusMsg'];
                    $sellerAddress=$seller_row['address'];
                    $sellerPincode=$seller_row['pincode'];
                    $sellerGCode=$seller_row['gCode'];
            }
        }

   
?>

<div class=''>
   
      <div class="container">
          <div class="row">
           
               <div class="col-12">
                   <div class="card-body ">
                      <h3 class="mb-0 pt-2 pb-2 text-center bg-info text-white">COMPLAINT DETAILS</h3>
                   
                      <div class='row border border-warning' id='orderDetails'>
                      <h4><u>Order Details</u></h4>
                        <div class="col-3"> 
                            <div class="form-outline mb-4">
                               <h5>Order ID: <span id="orderid"><?php echo $orderid; ?></span></h5>
                            </div>
                            </div> 
                        <div class="col-3"> 
                            <div class="form-outline mb-4">
                               <h5>Capacity: <?php echo $capacity; ?> Litter Water</h5>
                            </div>
                            </div> 
                        <div class="col-3"> 
                            <div class="form-outline mb-4">
                            <h5>Amount Rs. <?php echo $amount; ?></h5>
                            </div>
                            </div> 
                        <div class="col-3"> 
                            <div class="form-outline mb-4">
                            <h5>Date: <?php echo $orderdDate; ?></h5>
                            </div>
                            </div> 
                      </div> 

                      <div class='row border border-warning' id='orderDetailsMore'>
                        <div class="col-3"> 
                            <div class="form-outline mb-4">
                               <h5>Order Status: <?php echo $orderStatus; ?></h5>
                            </div>
                            </div> 
                        <div class="col-3"> 
                            <div class="form-outline mb-4">
                               <h5>Delivery Time: <?php echo $orderEtd; ?></h5>
                            </div>
                            </div> 
                        <div class="col-3"> 
                            <div class="form-outline mb-4">
                            <h5>Supplier Name: <?php echo $supllierName; ?></h5>
                            </div>
                            </div> 
                        <div class="col-3"> 
                            <div class="form-outline mb-4">
                            <h5>Supplier Number: <?php echo $supplieNumber; ?></h5>
                            </div>
                            </div> 
                      </div> 

                      <div class='row border border-warning' id='deliveryDetails'>
                        <h4><u>Delivery Details</u></h4>
                            <div class="col-3"> 
                                <div class="form-outline mb-4">
                                <h5>Name: <?php echo $deliveryName; ?></h5>
                                </div>
                                </div> 
                            <div class="col-3"> 
                                <div class="form-outline mb-4">
                                <h5>Number: <?php echo $deliveryNumber; ?></h5>
                                </div>
                                </div> 
                            <div class="col-4"> 
                                <div class="form-outline mb-4">
                                    <label class="form-label h5" for="oaddress"><u>Address</u></label>
                                    <textarea id='oaddress' type='text' readonly class='form-control bg-dark text-white border border-dark' name='oaddress' rows='3' cols='30'><?php echo $deliveryAddress;?> - <?php echo $deliveryPincode;?> - <?php echo $deliveryGCode; ?></textarea>
                                </div> 
                                </div> 
                            <div class="col-2"> 
                            <div class="form-outline mb-4 text-center text-dark bg-warning">
                                <label class="form-label h5" for="orderAction">Action</label>
                                    <?php 
                                        echo "<select class='form-select form-control' id='orderAction' aria-label='Default select example' required='required'>";
                                        
                                            if($orderStatus == 'Cancelled') {
                                                echo "<option value='NoAction'>No Action</option>";
                                                echo "<option value='DeleteSupplier'>Delete Supplier</option>";
                                            } else {
                                                echo "<option value='NoAction'>No Action</option>";
                                                echo "<option value='Cancel'>Cancel Order</option>";
                                                echo "<option value='DeleteSupplier'>Delete Supplier</option>";
                                                echo "<option value='CancelDeleteSupplier'>Cancel Order & Delete Supplier</option>";
                                            }
                                            ?> 
                                   </select>
                                </div>
                                </div> 
                        </div>  

                           <div class='row border border-info' id='customerDetails'>
                                <h4><u>Customer Details</u></h4>
                                    <div class="col-3"> 
                                        <div class="form-outline mb-4">
                                        <h5>Name: <?php echo $customerName; ?></h5>
                                        </div>
                                        </div> 
                                    <div class="col-3"> 
                                        <div class="form-outline mb-4">
                                        <h5>Number: <span id="cNumber"><?php echo $customerNumber; ?></span></h5>
                                        
                                        </div>
                                        </div> 
                                    <div class="col-3"> 
                                        <div class="form-outline mb-4">
                                        <h5>Email <?php echo $customerEmail; ?></h5>
                                        </div>
                                        </div> 
                                    <div class="col-3"> 
                                      <div class="form-outline mb-4 text-center text-dark bg-warning">
                                        <label class="form-label h5" for="customerAction">Action</label>
                                            <?php 
                                                echo "<select class='form-select form-control' id='customerAction' aria-label='Default select example' required='required'>";
                                                
                                                        echo "<option value='NoAction'>No Action</option>";
                                                        echo "<option value='Block'>Block Customer</option>";
                                                    
                                                    ?> 
                                            </select>
                                        </div>
                                        </div> 
                            </div> 

                           <div class='row border border-light' id='sellerDetails'>
                                <h4><u>Seller Profile Details</u></h4>
                                    <div class="col-3"> 
                                        <div class="form-outline mb-4">
                                        <h5>Name: <?php echo $sellerName; ?></h5>
                                        </div>
                                        </div> 
                                    <div class="col-3"> 
                                        <div class="form-outline mb-4">
                                        <h5>Number: <span id="sNumber"><?php echo $sellerNumber; ?></span></h5>
                                        
                                        </div>
                                        </div> 
                                    <div class="col-3"> 
                                        <div class="form-outline mb-4">
                                        <h5>Email <?php echo $sellerEmail; ?></h5>
                                        </div>
                                        </div> 
                                    <div class="col-3"> 
                                      <div class="form-outline mb-4 text-center text-dark bg-warning">
                                        <label class="form-label h5" for="sellerAction">Action</label>
                                            <?php 
                                                echo "<select class='form-select form-control' id='sellerAction' aria-label='Default select example' required='required'>";
                                                
                                                        echo "<option value='NoAction'>No Action</option>";
                                                        echo "<option value='Block'>Block Seller</option>";
                                                    
                                                    ?> 
                                            </select>
                                        </div>
                                        </div> 
                            </div> 

                            <div class='row border border-light' id='sellerDetailsMore'>
                                <h4><u>Seller Company Details</u></h4>
                                    <div class="col-2"> 
                                        <div class="form-outline mb-4">
                                        <h5>Company Name: <?php echo $sellerCName; ?></h5>
                                        </div>
                                        </div> 
                                    <div class="col-2"> 
                                        <div class="form-outline mb-4">
                                        <h5>GST Number: <?php echo $sellerGst; ?></h5>
                                        </div>
                                        </div> 
                                    <div class="col-2"> 
                                        <div class="form-outline mb-4">
                                        <h5>Company Status: <?php echo $sellerStatus; ?></h5>
                                        </div>
                                        </div> 
                                    <div class="col-2"> 
                                        <div class="form-outline mb-4">
                                        <h5>Comment: <?php echo $sellerMsg; ?></h5>
                                        </div>
                                        </div> 
                                    <div class="col-4"> 
                                        <div class="form-outline mb-4">
                                        <label class="form-label h5" for="saddress"><u>Address</u></label>
                                        <textarea id='saddress' type='text' readonly class='form-control bg-dark text-white border border-dark' name='saddress' rows='3' cols='30'><?php echo $deliveryAddress;?> - <?php echo $deliveryPincode;?> - <?php echo $deliveryGCode; ?></textarea>
                                        </div>
                                    </div> 
                            </div> 

                            <div class='row border border-danger' id='complaintDetails'>
                               <h4><u>Complaint Details</u></h4>
                                <div class="col-3"> 
                                    <div class="form-outline mb-4">
                                    <h5>Complaint Number: <span id='complaintid'><?php echo $complaintid; ?></span></h5>
                                    </div>
                                    </div> 
                                <div class="col-3"> 
                                    <div class="form-outline mb-4">
                                    <h5>Date: <?php echo $complaintDate; ?></h5>
                                    </div>
                                    </div> 
                                <div class="col-3"> 
                                    <div class="form-outline mb-4">
                                    <h5>Complainer: <?php echo $complaintBy; ?></h5>
                                    </div>
                                    </div> 
                                <div class="col-3"> 
                                    <div class="form-outline mb-4">
                                    <h5>Complaint Status: <?php echo $complaintStatus; ?></h5>
                                    </div>
                                    </div> 
                      </div> 

                            <div class='row border border-danger' id='complaintDetailsMore'>
                                <div class="col-4"> 
                                    <div class="form-outline mb-4">
                                        <label class="form-label h5" for="issue"><u>Issue</u></label>
                                        <textarea id='issue' type='text' readonly class='form-control bg-dark text-white border border-dark' name='issue' rows='3' cols='30'><?php echo $issue;?></textarea>
                                        </div>
                                    </div> 
                                <div class="col-4"> 
                                    <div class="form-outline mb-4">
                                        <label class="form-label h5" for="response"><u>Response</u></label>
                                        <textarea id='response' type='text' class='form-control bg-dark text-white border border-light' name='response' rows='3' cols='30'></textarea>
                                       
                                    </div> 
                                    </div> 
                                <div class="col-4 mt-4"> 
                                    <div class="form-outline mb-4 text-center text-dark bg-warning">
                                            <label class="form-label h5" for="complaintstatus">Action</label>
                                                <?php 
                                                    echo "<select class='form-select form-control' id='complaintstatus' aria-label='Default select example' required='required'>";
                                                            if($complaintStatus == 'Registered') {
                                                            echo "<option value='Closed'>Close Complaint</option>";
                                                            echo "<option value='In Process'>In Process</option>";
                                                            echo "<option value='Resolved'>Resolved</option>";
                                                             } else {
                                                            echo "<option value='Closed'>Close Complaint</option>";
                                                            echo "<option value='Resolved'>Resolved</option>";
                                                             }
                                                        
                                                        ?> 
                                                </select>
                                    </div>
                                </div> 
                           </div> 
                           
                              
                            <div class='mt-2 '>
                                    <button type="button" href='#'  id='<?php echo $supplyid; ?>' name='submit' class="btn btn-primary btn-lg btn-block border border-dark d-grid gap-2 col-6 mx-auto submitData">Submit</button>
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
    $(".submitData").click(function(evt) {
         supplyid = evt.target.id;
         customerid = $("#cNumber").text();
         sellerid = $("#sNumber").text();
         orderid = $("#orderid").text();
         complaintid = $("#complaintid").text();

          //alert(customerid);
          //alert(sellerid);
          //alert(orderid);

        orderAction = $("#orderAction option:selected").val();
        customerAction = $("#customerAction option:selected").val();
        sellerAction = $("#sellerAction option:selected").val();
        complaintAction = $("#complaintstatus option:selected").val();

        response = $("#response").val();

        //alert(orderAction);

        orderStatus="";
        customerStatus="No";
        sellerStatus="No";
        supplierStatus="";

         if(orderAction === 'NoAction'){
            orderStatus = "No";
            supplierStatus = "No";

         } else if(orderAction === 'Cancel'){
            orderStatus = "Cancelled";
            supplierStatus = "No";

         } else if(orderAction === 'DeleteSupplier'){
            orderStatus = "No";
            supplierStatus = "Delete";

         } else if(orderAction === 'CancelDeleteSupplier'){
            orderStatus = "Cancelled";
            supplierStatus = "Delete";

         }

         if(customerAction === 'Block'){
            customerStatus = "Blocked";
         }

         if(sellerAction === 'Block'){
            sellerStatus = "Blocked";
         }

        // alert(supplierStatus);
    
           if(response.length > 0) {

                  if(customerid.length === 10) {

                      if(sellerid.length === 10) {

                         if(orderid.length > 0) {
                            
                            if(supplyid.length > 0) {

                                $.post(
                                    'http://localhost:8013/h20app/Agent/mComplaintDataSubmit.php',
                                    { orderid: orderid, orderStatus: orderStatus, supplyid: supplyid, supplierStatus: supplierStatus, customerid: customerid, customerStatus: customerStatus, sellerid: sellerid, sellerStatus: sellerStatus, complaintid: complaintid, response: response, complaintStatus: complaintAction },
                                        function(orderid) {
                                        console.log(orderid);
                                    }
                                    )

                                    setTimeout(redirectPage, 500);
                                    function redirectPage(){
                                        alert("Comlaint details submitted with all actions!");
                                        location.href='manager.php?info=complaintList';
                                    }


                            } else {

                                 alert("Invalid Supplier Data!");

                            }


                         } else {

                            alert("Invalid Order ID!");

                         }

                      } else {

                        alert("Invalid Seller Number!");

                      }

                  } else {

                    alert("Invalid Customer Number!");

                  }

           } else {

            alert("Reponse Message Required!");
           }

        //location.href='';s
    });
    </script>