<?php
session_start();
require('db.php');
$username="";
$errors = array(); 

if (isset($_POST['cregister'])) {
  $cusername = mysqli_real_escape_string($conn, $_POST['cusername']);
  $cemail = mysqli_real_escape_string($conn, $_POST['cemail']);
  $cnumber = mysqli_real_escape_string($conn, $_POST['cnumber']);
  $pwd = mysqli_real_escape_string($conn, $_POST['password']);
  $cpwd = mysqli_real_escape_string($conn, $_POST['cpwd']);


  if (count($errors) == 0) {
    if(strlen($cnumber) == 10) {
      if(strlen($cpwd) > 5) {
  if($pwd == $cpwd) {
      $query = "SELECT * FROM customer WHERE mNumber='$cnumber'";
      $results = mysqli_query($conn, $query);
      if (mysqli_num_rows($results) > 0) {
        array_push($errors, "<div class='alert alert-warning'><b>User Already Exist! Try to Signin</b></div>") ;
      }else {

        $queryInsert = "INSERT INTO customer (name,mNumber,email,password) 
          VALUES('$cusername','$cnumber','$cemail','$cpwd')";
          
           $sql=mysqli_query($conn, $queryInsert);

        $_SESSION['cnumberID'] = $cnumber;
        header("location:firstAddress.php");
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
if (isset($_REQUEST['csignin'])) {
  header("location:signin.php");
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
    <link rel="stylesheet" href="./Styles/signup.css" />

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

    <title>SignUp</title>
  </head>
  <body style="background-image:url('../images/back.jpg');">
  <?php include('errors.php'); 
    echo @$msg;

    ?>
  <form class="form " action="" method="post">
    <section class="vh-100" >
      <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-lg-12 col-xl-11">
            <div class="card text-black" style="border-radius: 25px">
              <div class="card-body p-md-5">
                <div class="row justify-content-center">
                  <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">
                     Sign up
                    </p>

                    <form class="mx-1 mx-md-4">
                      <div class="d-flex flex-row align-items-center mb-2">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <input
                          maxlength="20"
                          name="cusername"
                            type="text"
                            id="form3Example1c"
                            class="form-control"
                          />
                          <label class="form-label" for="form3Example1c"
                            >Your Name</label
                          >
                        </div>
                      </div>

                      <div class="d-flex flex-row align-items-center mb-2">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <input
                          maxlength="50"
                          name="cemail"
                            type="email"
                            id="form3Example3c"
                            class="form-control"
                          />
                          <label class="form-label" for="form3Example3c"
                            >Your Email</label
                          >
                        </div>
                      </div>
                      <div class="d-flex flex-row align-items-center mb-2">
                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <input
                          oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onkeypress="return onlyNumberKey(event)"
                          name="cnumber"
                            type="number"
                            id="form3Example0c"
                            class="form-control"
                            maxlength="10"
                            minlength="10"
                          />
                          <label class="form-label" for="form3Example0c"
                            >Mobile Number</label
                          >
                        </div>
                      </div>
                     
                      <div class="d-flex flex-row align-items-center mb-2">
                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <input
                          minlength="6"
                          maxlength="20"
                          name="password"
                            type="password"
                            id="form3Example5c"
                            class="form-control"
                          />
                          <label class="form-label" for="form3Example5c"
                            >Password</label
                          >
                        </div>
                      </div>
                      <p class="d-flex flex-row align-items-center mx-3 mb-3"> Password should atleast of length 6! </P>

                      <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <input
                          minlength="6"
                          maxlength="20"
                          name="cpwd"
                            type="password"
                            id="form3Example5cd"
                            class="form-control"
                          />
                          <label class="form-label" for="form3Example5cd"
                            >Repeat your password</label
                          >
                        </div>
                      </div>

                   

                      <div
                        class="d-flex justify-content-center mx-4 mb-2 mb-lg-4"
                      >
                        <button type="submit" class="btn btn-primary btn-lg" href="./addressadd.php" name="cregister">
                          Register
                        </button>
                      </div>
                    </form>
                  </div>
                  <div
                    class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2"
                  >
                    <img
                      src="../images/signup.png"
                      class="img-fluid"
                      alt="Sample image"
                    />
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                <a style="color: black" href="./signin.php" name="csignin"
                  >Already a member?</a
                >
                   </div>
                   <div class="col-6">
                      <a class="text-dark" href="help.php" name="help"
                      >Help?</a
                    >
                   </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <div>
                </div>
                </form>
  </body>

  <script>
        
        function onlyNumberKey(evt) {
          // Only ASCII character in that range allowed
          var ASCIICode = evt.which ? evt.which : evt.keyCode;
          if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) return false;
          return true;
        }

      </script>
</html>
