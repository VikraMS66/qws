<?php 
session_start();
require('db.php');
$errors = array(); 

if (isset($_POST['register'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pass']);
    $rpwd = mysqli_real_escape_string($conn, $_POST['rpass']);

    $cname = mysqli_real_escape_string($conn, $_POST['cname']);
    $gst = mysqli_real_escape_string($conn, $_POST['gst']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $pincode = mysqli_real_escape_string($conn, $_POST['pincode']);
    $gCode = mysqli_real_escape_string($conn, $_POST['gCode']);
  
if (count($errors) == 0) {

      if(strlen($number) == 10) {

        if(strlen($rpwd) > 5) {

         if($pwd == $rpwd) {

            if(strlen($pincode) == 6){

                if(strlen($name) > 0) {

                        $query = "SELECT * FROM supplier WHERE mNumber='$number'";
                        $results = mysqli_query($conn, $query);

                        if (mysqli_num_rows($results) > 0) {

                            array_push($errors, "<div class='alert alert-warning'><b>User Already Exist! Try to Sign In</b></div>");

                            } else 
                            {
                
                                $queryInsert = "INSERT INTO supplier (name,mNumber,email,password,companyName,pincode,gCode,address,gstNumber) 
                                                VALUES('$name','$number','$email','$rpwd','$cname','$pincode','$gCode','$address','$gst')";
                                    
                                     $sql=mysqli_query($conn, $queryInsert);
                        
                                     $_SESSION['sellerid'] = $number;

                                     header("location:waitingPage.php");
                        }
           
        } else {
            array_push($errors, "<div class='alert alert-warning'><b>Name Cannot be Empty!</b></div>");
        }

         } else {
            array_push($errors, "<div class='alert alert-warning'><b>Enter a valid pincode!</b></div>");
         }

        } else {
            array_push($errors, "<div class='alert alert-warning'><b>Password and Repeat Password Does not Match</b></div>");
        }

    } else {
      array_push($errors, "<div class='alert alert-warning'><b>Password should atleast of length 6!</b></div>");
    }

    } else {
      array_push($errors, "<div class='alert alert-warning'><b>Enter valid mobile Number</b></div>");
    }
  
    } else {
      array_push($errors, "<div class='alert alert-warning'><b>Some Error!</b></div>");
    }
    
  } 

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">

      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


      <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
      integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
      crossorigin="anonymous"
    ></script>

    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>

    <style>
        @media (min-width: 1025px) {
            .h-custom {
            height: 100vh !important;
            }
            }
            .card-registration .select-input.form-control[readonly]:not([disabled]) {
            font-size: 1rem;
            line-height: 2.15;
            padding-left: .75em;
            padding-right: .75em;
            }
            .card-registration .select-arrow {
            top: 13px;
            }

            .gradient-custom-2 {
            /* fallback for old browsers */
            background: #a1c4fd;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right, rgba(161, 196, 253, 1), rgba(194, 233, 251, 1));

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right, rgba(161, 196, 253, 1), rgba(194, 233, 251, 1))
            }

            .bg-indigo {
            background-color: #4835d4;
            }
            @media (min-width: 992px) {
            .card-registration-2 .bg-indigo {
            border-top-right-radius: 15px;
            border-bottom-right-radius: 15px;
            }
            }
            @media (max-width: 991px) {
            .card-registration-2 .bg-indigo {
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
            }
            }

            input[type="number"]::-webkit-inner-spin-button,
            input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
            }

            /* Firefox */
            input[type="number"] {
            -moz-appearance: textfield;
            }

        </style>
    <title>Sign Up</title>
</head>
<body>
<section class="h-100 h-custom gradient-custom-2" style="background-image:url('../images/back.jpg');">
   <form method='post'>
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12">
        <div class="card card-registration card-registration-2" style="border-radius: 15px;">
          <div class="card-body p-0">
            <div class="row g-0">
              <div class="col-lg-6">
                <div class="p-5">
                  <h3 class="fw-normal mb-5" style="color: #4835d4;">General Infomation</h3>

                  <div class="row">
                    <div class="col-md-6 mb-4 pb-2">

                      <div class="form-outline">
                        <input  type="text" id="name" name='name' maxlength='20' minlength='1' class="form-control form-control-lg" required='required'/>
                        <label class="form-label" for="name">Name</label>
                      </div>

                    </div>
                    <div class="col-md-6 mb-4 pb-2">

                      <div class="form-outline">
                        <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onkeypress="return onlyNumberKey(event)"  type="text" inputmode="numeric" name='number'  maxlength='10' minlength='10' class="form-control form-control-lg" required='required'/>
                        <label class="form-label" for="number">Number</label>
                      </div>

                    </div>
                  </div>

                  

                  <div class="row">
                    <div class="col-md-6 mb-4 pb-2 mb-md-0 pb-md-0">

                      <div class="form-outline">
                        <input type="text" id="cname" name='cname' maxlength='20' class="form-control form-control-lg" />
                        <label class="form-label" for="cname">Company Name (Optional)</label>
                      </div>

                    </div>
                    <div class="col-md-6 mb-4 pb-2 mb-md-0 pb-md-0">

                      <div class="form-outline">
                        <input type="text" id="gst" name='gst' maxlength='20' class="form-control form-control-lg" />
                        <label class="form-label" for="gst">GST Number (Optional)</label>
                      </div>

                    </div>
                  </div>
                  <div class="row mt-5">
                    
                    <div class="col-md-6 mb-4 pb-2 mb-md-0 pb-md-0">

                      <div class="form-outline">
                        <input type="password" id="pass" name='pass' maxlength='20' minlength='6' class="form-control form-control-lg" required='required'/>
                        <label class="form-label" for="pass">Password</label>
                      </div>

                    </div>
                    <div class="col-md-6 mb-4 pb-2 mb-md-0 pb-md-0">

                      <div class="form-outline">
                        <input type="password" id="rpass" name='rpass' maxlength='20' minlength='6' class="form-control form-control-lg" required='required'/>
                        <label class="form-label" for="rpass">Repeat Password</label>
                      </div>

                    </div>
                    <h5 class='mx-1 mt-2'>Password should be atleast of length 6!<h5>
                  </div>
        
                  <div class="row mt-5 mx-5">
                  <hr/>
                    <div class="col-md-6 mb-4 pb-2">
                       <a class="h5 text-dark" href="login.php" data-mdb-ripple-color="dark"><u>Already a Member?</u></a>
                    </div>
                    <div class="col-md-6 mb-4 pb-2 text-end">
                       <a class="h5 text-dark" href="help.php" data-mdb-ripple-color="dark"><u>Help?</u></a>
                    </div>
                 </div>

                </div>
              </div>
              <div class="col-lg-6 bg-indigo text-white">
                <div class="p-5">
                  <h3 class="fw-normal mb-5">Contact Details</h3>

                  <div class="mb-4 pb-2">
                    <div class="form-outline form-white">
                      <input type="text" id="address" name='address' maxlength='50' minlength='1' class="form-control form-control-lg" required='required'/>
                      <label class="form-label" for="address">Address</label>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-5 mb-4 pb-2">

                      <div class="form-outline form-white">
                        <input type="number" inputmode="numeric" id="pincode" name='pincode' maxlength='6' minlength='6' class="form-control form-control-lg" required='required'/>
                        <label class="form-label" for="pincode">Pincode</label>
                      </div>

                    </div>
                    <div class="col-md-7 mb-4 pb-2">

                      <div class="form-outline form-white">
                        <input type="text" id="gCode" name='gCode' maxlength='20' class="form-control form-control-lg" />
                        <label class="form-label" for="gCode">Google Map Plus Code (Optional)</label>
                      </div>

                    </div>
                  </div>

                  <div class="mb-4">
                    <div class="form-outline form-white">
                      <input type="text" id="email" maxlength='20' name='email' minlength='1' class="form-control form-control-lg" required='required'/>
                      <label class="form-label" for="email">Your Email</label>
                    </div>
                  </div>

                  <div class="form-check d-flex justify-content-start mb-4 pb-3">
                    <input class="form-check-input me-3" type="checkbox" value="" id="form2Example3c" checked/>
                    <label class="form-check-label text-white" for="form2Example3">
                      I do accept the <a href="#" class="text-white"><u>Terms and Conditions.</u></a> 
                    </label>
                  </div>

                  
                        <button type='submit' id='register' name='register' style="width:430px;" class="btn btn-light btn-lg">Register</button>
                  

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
</section>
<script>
 
function onlyNumberKey(evt) {
// Only ASCII character in that range allowed
var ASCIICode = evt.which ? evt.which : evt.keyCode;
if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) return false;
return true;
}


<script>
</body>
</html>