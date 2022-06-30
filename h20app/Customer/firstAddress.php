<?php
include("auth.php");
?>


<?php

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

  if (count($errors) == 0) {

    if(strlen($caddNumber) == 10) {

      if(strlen($caddPincode) == 6) {
		$ID = $_SESSION["cnumberID"];
		$query = "SELECT * FROM addressbook WHERE custID='$ID' and tagName='$caddTagName'";
		$results = mysqli_query($conn, $query);

		if (mysqli_num_rows($results) > 0) {
			array_push($errors, "<div class='alert alert-warning'><b>Address Tag Name Already Exist!</b></div>") ;

		} else {    
				$queryInsert = "INSERT INTO addressbook (tagName,custid,name,mNumber,pincode,gCode,address) 
				VALUES('$caddTagName','$ID','$caddName','$caddNumber','$caddPincode','$caddGCode','$caddAddress')";
				 $sql=mysqli_query($conn, $queryInsert);

                 $queryAddress = "SELECT * FROM addressbook WHERE custID='$ID' and tagName='$caddTagName'";
                 $resultsAddress = mysqli_query($conn, $queryAddress);
                 if (mysqli_num_rows($resultsAddress) == 1) {
                       
                    while($row=mysqli_fetch_array($resultsAddress)) {
                        $addressId=$row['id'];
                        $queryUpdate = "update customer set addressId='$addressId' where mNumber='$ID'";
                        $update_sql=mysqli_query($conn,$queryUpdate);
                        
                    }
                    header("location:cHomepage.php?info=products");
                }

				// header("location:cHomePage.php?info=addressbook");
		}
	}
       else {
           array_push($errors, "<div class='alert alert-warning'><b>Enter valid Pincode</b></div>");
  }
  } else {
    array_push($errors, "<div class='alert alert-warning'><b>Enter valid mobile Number</b></div>");
  }

  }
  
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<title>Bootstrap Sign up Form Horizontal</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="./Styles/address.css" />

<style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
  
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>

</head>
<body>
<div class="mt-5 pt-3 text-center text-dark ">
<div class="signup-form text-dark">

<?php include('errors.php'); 
    echo @$msg;

    ?>

    <form action="" method="post" class="form-horizontal">
      	<div class="row text-dark">
        	<div class="col-8 offset-4">
				<h2>Address Book</h2>
			</div>	
      	</div>			
        <div class="form-group row">
			<label class="col-form-label col-4 text-dark">Address Tag Name</label>
			<div class="col-8">
                <input id="addTagName" type="text" class="form-control" name="addTagName" maxlength="20" required="required">
            </div>        	
        </div>
		<div class="form-group row text-dark">
			<label class="col-form-label col-4">Name</label>
			<div class="col-8">
                <input id="addName" type="text" class="form-control" name="addName" maxlength="20" required="required">
            </div>        	
        </div>
		<div class="form-group row text-dark">
			<label class="col-form-label col-4">Mobile Number</label>
			<div class="col-8">
                <input id="addNumber" type="number" class="form-control" name="addNumber"  maxlength="10" minlength="10" required="required">
            </div>        	
        </div>
		<div class="form-group row text-dark">
			<label class="col-form-label col-4">Pincode</label>
			<div class="col-8">
                <input id="addPincode" type="number" class="form-control" name="addPincode" maxlength="6" minlength="6" required="required">
            </div>        	
        </div>
		<div class="form-group row text-dark">
			<label class="col-form-label col-4">Google Map Code</label>
			<div class="col-8">
                <input id="addGCode" type="text" class="form-control" name="addGCode" maxlength="10">
            </div>        	
        </div>
		<div class="form-group row text-dark">
			<label class="col-form-label col-4">Address</label>
			<div class="col-8">
                <textarea id="addAddress" type="text" class="form-control" name="addAddress" rows="3" cols="50" maxlength="50" required="required"> </textarea>
            </div>        	
        </div>
		<div class="form-group row text-dark">
			<div class="col-8 offset-4">
				<button  id="addressSave" type="submit" href="cHomePage.php?info=addressbook" class="btn btn-primary btn-lg" name="caddress">Done</button>
			</div>  
		</div>		      
    </form>
	
</div>
</div>
</body>
</html>