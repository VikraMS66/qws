

<?php
 
  //include("auth.php");
  require('db.php');
  $username="";
  $errors = array();




  if (isset($_REQUEST['addAddress'])) {
    header("location:cHomePage.php?info=addAddress");
  }
 
  if (isset($_REQUEST['updateAddress'])) {
      
    header("location:cHomePage.php?info=updateAddress");
  }
  
  if (isset($_POST['confirmDelete'])) {
    
    $ID = $_SESSION["cnumberID"];

     $sql="SELECT * FROM addressbook WHERE custid='$ID'";

    $fetch=mysqli_query($conn,$sql);

     if (mysqli_num_rows($fetch) == 1) {
        echo "<script>alert('Address Deletion Failed! Atlest One Address Required.');</script>";
        echo("<script>  location.href = 'cHomePage.php?info=addressbook';</script>");
    }  else {

          $delID = $_POST['addressId'];
         $sql_query="DELETE FROM addressbook WHERE id='$delID'";
	       $delete=mysqli_query($conn,$sql_query);

         $queryAddress = "SELECT * FROM addressbook WHERE custID='$ID'";
         $resultsAddress = mysqli_query($conn, $queryAddress);
         if (mysqli_num_rows($resultsAddress) > 0) {
               
            while($row=mysqli_fetch_array($resultsAddress)) {
                $addId=$row['id'];
                $queryUpdate = "update customer set addressId='$addId' where mNumber='$ID'";
                $update_sql=mysqli_query($conn,$queryUpdate);
                
            }
            echo("<script>  location.href = 'cHomePage.php?info=addressbook';</script>");
          } else {
            echo("<script>  location.href = 'signin.php';</script>");
          }
         
    }
       
  }
  
  //if (isset($_REQUEST['selectedAddress'])) {
     
    //header("location:cHomePage.php?info=products");
  //}
 
  

?>

    
   
  <div class="mt-5 pt-5 text-white ">
  <form method="post" action="cHomePage.php?info=products" >
    <div
        class="card-header bg-success text-center fixed-top mb-4 mt-5 pt-4"
      >
        <h5 >SELECT ADDRESS TO GET AVAILABLE WATER SUPPLIES</h5>
      </div>

        <div class="addAddress mt-3 pt-1 ">
            <a 
             style="width: 150px ;"
              class="btn btn-dark mt-3 mb-5 mx-3 bg-dark text-white rounded-pill"
              name="addAddress"
              href="cHomePage.php?info=addAddress">
              New Address </a>
           
          </div>
        

      <div class="addressBook">
       
        <div class="container">
            <div class="row">
        <?php 
      
        $ID = $_SESSION['cnumberID'];
        $query="SELECT * FROM addressbook where custid='$ID'";
        $res=mysqli_query($conn,$query);
        if (mysqli_num_rows($res) > 0) {
            while($row = mysqli_fetch_assoc($res)) {
              ?>
               <div class="col-lg-4 mb-3">
              <div class="card bg-dark text-white pb-3 pt-3 " style="width: 18rem">
              
           <?php
              $addressId = $row['id'];
              echo "<ul class='list-group list-group-flush'>";
              echo "<li class='list-group-item'>Tag Name: <span  id='".$addressId."tagName'>".$row['tagName']."</span></li>";
              echo "<li class='list-group-item'>Name: <span  id='".$addressId."name'>".$row['name']."</span></li>";
              echo "<li class='list-group-item'>Number: <span  id='".$addressId."number'>".$row['mNumber']."</span></li>";
              echo "<li class='list-group-item'>Pincode: <span name='pincode' id='".$addressId."pincode'>".$row['pincode']."</span></li>";
              echo "<li class='list-group-item'>Map Code: <span  id='".$addressId."gCode'>".$row['gCode']."</span></li>";
              echo "<li class='list-group-item'><p>Address: <span  id='".$addressId."address'>".$row['address']."</span></p></li>";
              echo "</ul>";
              echo "<input readonly id='".$row['id']."' type='submit'  name='selectedAddress' class='btn btn-primary selectedAddress' value='Select Address' />";
              ?>
              
               <div class="container">
                <div class="row">
                <div class="col-lg-6 mb-1 mt-2">
                  <?php 
                echo "<a id='".$row['id']."' href='cHomePage.php?info=updateAddress'  name='updateAddress' class='btn text-white btn-warning updateAddress'>Edit</a>";
                ?>
                </div>
                <div class="col-lg-6 mb-1 mt-2">
                  <?php
                echo "<a id='".$row['id']."' name='deleteAddress' data-toggle='modal' data-target='#exampleModal' class='delete btn btn-danger ' title='Delete Address?'>Delete</a>";
               ?>
            </div>
            </div>
            </div>
            </div>
            </div>
              <?php
            } 
            }else {
              array_push($errors, "<div class='alert alert-warning'><b>No address's found address to processed.</b></div>") ;
            }
         
        ?>
       
      </div>
         
    </div>
    </form>


<!-- Modal -->
<div class="modal fade text-dark" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
  <form method="post">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title " id="exampleModalLabel">Are you sure to delete?<input style="font-size: xx-small; color: white;" readonly class="pb-0 mb-0 mt-0 pt-0 border border-white noselect" id="delId" name="addressId"></input></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <h5 id="delTagName" class="">TagName</h5>
            <p id="delAddress"  class="">Address </p>
      </div>
      <div class="modal-footer">
        <button id="deleteAboard" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger text-white" name="confirmDelete">Confirm</button>
      </div>
    </div>
  </form>
  </div>
</div>

    </div>
    
    <script>
      
            $(".selectedAddress").click(function (event) {
              var addressId = event.target.id;
              
               //alert(addressId);

                $.post(
                  'http://localhost:8013/h20app/Customer/updateAddressId.php',
                  { id: addressId },
                  function(data) {
                    console.log(data);
                  }
                )

            });

          
            $(".updateAddress").click(function (event) {
              //alert("called");
              selectedAddress = event.target.id;
              var tagName = $("#" + selectedAddress + "tagName").text();
              var name = $("#" + selectedAddress + "name").text();
             var number = $("#" + selectedAddress + "number").text();
              var pincode = $("#" + selectedAddress + "pincode").text();
             var gCode = $("#" + selectedAddress + "gCode").text();
             var address = $("#" + selectedAddress + "address").text();

              var selectedAddressBookData = {
                addressId: selectedAddress,
                tagName: tagName,
                name: name,
                number: number,
                pincode: pincode,
                gCode: gCode,
                address: address,
              };
              localStorage.setItem(
                "selectedAddressBookData",
                JSON.stringify(selectedAddressBookData)
              );

            });

      $(".delete").click(function (event) {
      
        selectedAddress = event.target.id;
        var tagName = $("#" + selectedAddress + "tagName").text();
        var address = $("#" + selectedAddress + "address").text();

        var selectedDeleteAddress = {
          addressId: selectedAddress,
          tagName: tagName,
          address: address,
        };

        localStorage.setItem(
          "selectedDeleteAddress",
          JSON.stringify(selectedDeleteAddress)
        );

        
        var selectedDeleteAddress = JSON.parse(
          localStorage.getItem("selectedDeleteAddress")
        );
        $("#delId").val(selectedDeleteAddress.addressId);
        $("#delTagName").text("Tag Name: " + selectedDeleteAddress.tagName);
        $("#delAddress").text("Address: " + selectedDeleteAddress.address);
      });
  
        
     

        $("#deleteAboard").click(function() {
         // alert("Hello");
          localStorage.removeItem('selectedDeleteAddress');
        });

    </script>
