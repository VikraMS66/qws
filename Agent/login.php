<?php 
session_start();
require('db.php');
$errors = array(); 

if (isset($_POST['login'])) {

    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pass']);
   

if (count($errors) == 0) {

      if(strlen($number) == 10) {

        if(strlen($pwd) > 5) {


                        $query = "SELECT * FROM agent WHERE number='$number' AND password='$pwd'";
                        $results = mysqli_query($conn, $query);

                        if (mysqli_num_rows($results) == 1) {
                              
                            $role="";

                              while($row=mysqli_fetch_array($results)) {

                                  $role = $row['role'];
                            } 

                            if($role == 'Associate') {

                                $_SESSION['associateid'] = $number;

                                header("location:associate.php?info=home");

                            } else if($role == 'Manager') {

                                $_SESSION['managerid'] = $number;

                                header("location:manager.php?info=home");
                                
                            } else {
                              header("location:blockPage.php");
                            }

                        } else {
                            array_push($errors, "<div class='alert alert-warning'><b>Invalid Number or Password!</b></div>");
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
                    .gradient-custom-3 {
            /* fallback for old browsers */
            background: #84fab0;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right, rgba(132, 250, 176, 0.5), rgba(143, 211, 244, 0.5));

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right, rgba(132, 250, 176, 0.5), rgba(143, 211, 244, 0.5))
            }
            .gradient-custom-4 {
            /* fallback for old browsers */
            background: #84fab0;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right, rgba(132, 250, 176, 1), rgba(143, 211, 244, 1));

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right, rgba(132, 250, 176, 1), rgba(143, 211, 244, 1))
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

    <title>Sign In</title>
</head>
<body>

<section class="vh-100 bg-image"
  style="background-image: url('../images/slogin.png');">
  <?php include('errors.php'); 
    echo @$msg;

    ?>
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Agent Login</h2>

              <form method="post">

                <div class="form-outline mb-4">
                  <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onkeypress="return onlyNumberKey(event)" type="number" inputmode="numeric" id="number" name='number' minlength='10' maxlength='10' class="form-control form-control-lg" required='required'/>
                  <label class="form-label" for="number">Your Mobile Number</label>
                </div>

                <div class="form-outline mb-4">
                  <input type="password" id="pass" name='pass' minlength='6' maxlength='20' class="form-control form-control-lg" required='required'/>
                  <label class="form-label" for="pass">Password</label>
                </div>

                <div class="d-flex justify-content-center">
                  <button type="submit" id='login' name='login'
                    class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Login</button>
                </div>
                <div class='d-flex justify-content-end mt-3'>
                  <a class="h5 text-dark mt-3" href="help.php" data-mdb-ripple-color="dark"><u>Help?</u></a>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
        function onlyNumberKey(evt) {
          // Only ASCII character in that range allowed
          var ASCIICode = evt.which ? evt.which : evt.keyCode;
          if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) return false;
          return true;
        }

      </script>
</body>
</html>