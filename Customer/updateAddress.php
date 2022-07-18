<?php
//include("auth.php");
require('db.php');
$username="";
$errors = array(); 

if (isset($_POST['caddress'])) {
  $caddTagName = mysqli_real_escape_string($conn, $_POST['addTagName']);
  $caddName = mysqli_real_escape_string($conn, $_POST['addName']);
  $caddNumber = mysqli_real_escape_string($conn, $_POST['addNumber']);
  $caddPincode = mysqli_real_escape_string($conn, $_POST['addPincode']);
  $caddGCode = mysqli_real_escape_string($conn, $_POST['addGCode']);
  $caddAddress = mysqli_real_escape_string($conn, $_POST['addAddress']);
  $addressID = mysqli_real_escape_string($conn, $_POST['addressId']);

  if (count($errors) == 0) {

    if(strlen($caddNumber) == 10) {
     
      if(strlen($caddPincode) == 6) {
		$ID = $_SESSION["cnumberID"];         
           
                $query = "SELECT * FROM addressbook WHERE custid='$ID' AND tagName='$caddTagName' AND id != '$addressID'";
                $results = mysqli_query($conn, $query);
                if (mysqli_num_rows($results) < 1) {

				$queryUpdate = "update addressbook set tagName='$caddTagName',name='$caddName',mNumber='$caddNumber',pincode='$caddPincode',gCode='$caddGCode',address='$caddAddress' where id='$addressID'";
				$update_sql=mysqli_query($conn,$queryUpdate);
               
				//header("location:cHomePage.php");
                echo("<script>alert('Address Updated!');</script>");
                echo("<script>location.href = 'cHomePage.php?info=addressbook';</script>");

                } else {

                    array_push($errors, "<div class='alert alert-warning'><b>Tag Name Already Exist!</b></div>");
           }
			
		}
	}
       else {
           array_push($errors, "<div class='alert alert-warning'><b>Enter valid Pincode</b></div>");
  }
  } else {
    array_push($errors, "<div class='alert alert-warning'><b>Enter valid mobile Number</b></div>");
  }

  }

?>

<div class="mt-5 pt-3 text-center" >
<?php include('errors.php'); 
    echo @$msg;

    ?>
<div class="signup-form">

    <form action="" method="post" class="form-horizontal">
      	<div class="row">
        	<div class="col-8 offset-4">
            
				<h2>Address Book</h2>
			</div>	
      	</div>			
        <div class="form-group row">
			<label class="col-form-label col-4">Address Tag Name</label>
			<div class="col-8">
                <input id="addTagName" type="text" class="form-control" name="addTagName" maxlength="20" required="required">
            </div>        	
        </div>
		<div class="form-group row">
        
			<label class="col-form-label col-4">Name</label>
			<div class="col-8">
                <input id="addName" type="text" class="form-control" name="addName" maxlength="20" required="required">
            </div>        	
        </div>
		<div class="form-group row">
			<label class="col-form-label col-4">Mobile Number</label>
			<div class="col-8">
                <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onkeypress="return onlyNumberKey(event)" id="addNumber" type="number" class="form-control" name="addNumber"  maxlength="10" minlength="10" required="required">
            </div>        	
        </div>
		<div class="form-group row">
			<label class="col-form-label col-4">Pincode</label>
			<div class="col-8">
                <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onkeypress="return onlyNumberKey(event)" id="addPincode" type="number" class="form-control" name="addPincode" maxlength="6" minlength="6" required="required">
            </div>        	
        </div>
		<div class="form-group row">
			<label class="col-form-label col-4">Google Map Code</label>
			<div class="col-8">
                <input id="addGCode" type="text" class="form-control text-dark" name="addGCode" maxlength="10" required="required">
            </div>        	
        </div>
		<div class="form-group row">
			<label class="col-form-label col-4">Address</label>
			<div class="col-8">
                <textarea id="addAddress" type="text" class="form-control" name="addAddress" rows="3" cols="50" maxlength="50" required="required"> </textarea>
                <input style="font-size: xx-small; color: white;" readonly class="pb-0 mb-0 mt-0 pt-0 border border-white noselect" id="addressId" name="addressId"></input>
            </div>        	
        </div>
		<div class="form-group row">
			<div class="col-8 offset-4">
				<button  id="addressSave" type="submit" class="btn btn-primary btn-lg " name="caddress">Done</button>
			</div>  
		</div>		      
    </form>
	
</div>
</div>
<script>
    $(document).ready(function () {
    let input = document.getElementById("addTagName");
        let val = input.value.replace(/\s/g, "");
        //alert(val);

  var addressBookData = JSON.parse(
    localStorage.getItem("selectedAddressBookData")
  );
  $("#addressId").val(addressBookData.addressId);
  $("#addTagName").val(addressBookData.tagName);
  $("#addName").val(addressBookData.name);
  $("#addNumber").val(addressBookData.number);
  $("#addPincode").val(addressBookData.pincode);
  $("#addGCode").val(addressBookData.gCode);
  $("#addAddress").val(addressBookData.address);
});

        function onlyNumberKey(evt) {
          // Only ASCII character in that range allowed
          var ASCIICode = evt.which ? evt.which : evt.keyCode;
          if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) return false;
          return true;
        }

    
</script>
