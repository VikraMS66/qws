<?php 
session_start();
require('db.php');
$errors = array(); 

if (isset($_POST['login'])) {

    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $pwd = mysqli_real_escape_string($conn, $_POST['password']);
   

if (count($errors) == 0) {

      if(strlen($number) == 10) {

        if(strlen($pwd) > 5) {


                        $query = "SELECT * FROM admin WHERE number='$number' AND password='$pwd'";
                        $results = mysqli_query($conn, $query);

                        if (mysqli_num_rows($results) == 1) {

                              $_SESSION['admin'] = $number;
                              header("location:home.php?info=bug");

                    
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
                                .gradient-custom {
                /* fallback for old browsers */
                background: #6a11cb;

                /* Chrome 10-25, Safari 5.1-6 */
                background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));

                /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
                background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))
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

    <title>LOGIN</title>
</head>
<body> 

<section class="vh-100" style='background-image: url(../images/admin.webp)'>

<?php include('errors.php'); 
    echo @$msg;

    ?>

    <form method='post'>
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">

                        <div class="mb-md-5 mt-md-4 pb-5">

                        <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                        <p class="text-white-50 mb-5">Please enter your login and password!</p>

                        <div class="form-outline form-white mb-4">
                            <label class="form-label" for="typeEmailX">ID</label>
                            <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onkeypress="return onlyNumberKey(event)" type="number" id="typeEmailX" name='number' maxlength='10' minlength='10' class="form-control form-control-lg" />
                        
                        </div>

                        <div class="form-outline form-white mb-4">
                            <label class="form-label" for="typePasswordX">Password</label>
                            <input type="password" id="typePasswordX" name='password' class="form-control form-control-lg" />
                        
                        </div>


                        <button class="btn btn-outline-light btn-lg px-5" name='login' type="submit">Login</button>

                        

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

      </script>
</body>
</html>