<?php
session_start();
require('db.php');
$username="";
$errors = array(); 

if (isset($_REQUEST['csignup'])) {
  header("location:signup.php");
}

//chnage the  link
if (isset($_REQUEST['help'])) {
  header("location:signup.php");
}

if (isset($_POST['csignin'])) {

  $username = mysqli_real_escape_string($conn, $_POST['cuserId']);
  $pwd = mysqli_real_escape_string($conn, $_POST['cuserPwd']);
  
  if (count($errors) == 0) {
    if(strlen($username) == 10){
          
      if(strlen($pwd) > 5) {
          
        $_SESSION['cnumberID'] = $username;
        $query = "SELECT * FROM customer WHERE mNumber='$username' AND password='$pwd'";
        $results = mysqli_query($conn, $query);
        if (mysqli_num_rows($results) == 1) {
          $queryCheck = "SELECT * FROM addressbook WHERE custID='$username'";

          $res = mysqli_query($conn, $queryCheck);
          if (mysqli_num_rows($res) == 0) {
            header("location:firstAddress.php");
          } else {  
            
           
          header("location:cHomepage.php?info=products");
            
          }

      } else {
        array_push($errors, "<div class='alert alert-warning'><b>Wrong username/password combination</b></div>");
      }

    } 
    else {
      array_push($errors, "<div class='alert alert-warning'><b>Incorrect Password</b></div>");
    }

  } else {
    array_push($errors, "<div class='alert alert-warning'><b>Enter valid Mobile Number</b></div>");
  }   
    
  }
  else {
    array_push($errors, "<div class='alert alert-warning'><b>Some Error!</b></div>");
  }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./Styles/signin.css" />
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

    

    <style>
      @import url("https://fonts.googleapis.com/css?family=Raleway:400,700");

* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
  font-family: "Times New Roman", Times, serif, sans-serif;
}

body {
  background-image: url('../images/sign.jpg');
      
}

.container {
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
}

.screen {
  background: linear-gradient(90deg, #5d54a4, #7c78b8);
  position: relative;
  height: 600px;
  width: 360px;
  box-shadow: 0px 0px 24px #5c5696;
}

.screen__content {
  z-index: 1;
  position: relative;
  height: 100%;
}

.screen__background {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  z-index: 0;
  -webkit-clip-path: inset(0 0 0 0);
  clip-path: inset(0 0 0 0);
}

.screen__background__shape {
  transform: rotate(45deg);
  position: absolute;
}

.screen__background__shape1 {
  height: 520px;
  width: 520px;
  background: #fff;
  top: -50px;
  right: 120px;
  border-radius: 0 72px 0 0;
}

.screen__background__shape2 {
  height: 220px;
  width: 220px;
  background: #6c63ac;
  top: -172px;
  right: 0;
  border-radius: 32px;
}

.screen__background__shape3 {
  height: 540px;
  width: 190px;
  background: linear-gradient(270deg, #5d54a4, #6a679e);
  top: -24px;
  right: 0;
  border-radius: 32px;
}

.screen__background__shape4 {
  height: 400px;
  width: 200px;
  background: #7e7bb9;
  top: 420px;
  right: 50px;
  border-radius: 60px;
}

.login {
  width: 320px;
  padding: 30px;
  padding-top: 156px;
}

.login__field {
  padding: 20px 0px;
  position: relative;
}

.login__icon {
  position: absolute;
  top: 30px;
  color: #7875b5;
}

.login__input {
  border: none;
  border-bottom: 2px solid #d1d1d4;
  background: none;
  padding: 10px;
  padding-left: 24px;
  font-weight: 700;
  width: 75%;
  transition: 0.2s;
}

.login__input:active,
.login__input:focus,
.login__input:hover {
  outline: none;
  border-bottom-color: #6a679e;
}

.login__submit {
  background: #fff;
  font-size: 14px;
  margin-top: 30px;
  padding: 16px 20px;
  border-radius: 26px;
  border: 1px solid #d4d3e8;
  text-transform: uppercase;
  font-weight: 700;
  display: flex;
  align-items: center;
  width: 100%;
  color: #4c489d;
  box-shadow: 0px 2px 2px #5c5696;
  cursor: pointer;
  transition: 0.2s;
}

.login__submit:active,
.login__submit:focus,
.login__submit:hover {
  border-color: #6a679e;
  outline: none;
}

.button__icon {
  font-size: 24px;
  margin-left: auto;
  color: #7875b5;
}

.social-login {
  position: absolute;
  height: 140px;
  width: 160px;
  text-align: center;
  bottom: 0px;
  right: 0px;
  color: #fff;
}

.social-icons {
  display: flex;
  align-items: center;
  justify-content: center;
}

.social-login__icon {
  padding: 20px 10px;
  color: #fff;
  text-decoration: none;
  text-shadow: 0px 0px 8px #7875b5;
}

.social-login__icon:hover {
  transform: scale(1.5);
}

.button {
  border: 1px solid black;
  border-radius: 3px;
  width: 100px;
  height: 30px;
  display: block;

  background: linear-gradient(to right, black 50%, white 50%);
  background-size: 200% 100%;
  background-position: right bottom;
  transition: all 0.5s ease-out;
}

.button:hover {
  background-position: left bottom;
}

.text {
  text-align: center;
  font-size: 16px;
  line-height: 30px;
  color: black;
  transition: all 0.6s ease-out;
  display: block;
}

.text:hover {
  color: white;
}

        .button {
          border: 1px solid black;
          border-radius: 3px;
          width: 200px;
          height: 55px;
          display: block;

          background: linear-gradient(to right, black 50%, white 50%);
          background-size: 200% 100%;
          background-position: right bottom;
          transition: all 0.5s ease-out;
        }

        .button:hover {
          background-position: left bottom;
        }

        .text {
          text-align: center;
          font-size: 20px;
          line-height: 15px;
          color: black;
          transition: all 0.6s ease-out;
          display: block;
        }

        .text:hover {
          color: white;
        }

      </style>

    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <title>Login</title>
  </head>

  <body class='text-dark'>

  <?php include('errors.php'); 
    echo @$msg;

    ?>
    <div class="container">
      <div class="screen">
        <div class="screen__content">
       
          <form class="login" method="post">
            <h1>Login</h1>
            <br />
            <div class="login__field">
              <i class="login__icon fas fa-user"></i>
              <input
              style="font-family: 'Times New Roman', Times, serif, sans-serif;"
                id="firstPara"
                type="number"
                name="cuserId"
                class="login__input h5 "
                placeholder="Mobile No."
                maxlength="10"
                minlength="10"
              />
            </div>
            <div class="login__field">
              <i class="login__icon fas fa-lock"></i>
              <input
              style="font-family: 'Times New Roman', Times, serif, sans-serif;"
              maxlength="20"
                minlength="6"
                name="cuserPwd"
                id="secondPara"
                type="password"
                class="login__input"
                placeholder="Password"
              />
            </div>
            <button class="button login__submit mt-1" id="loginBt" name="csignin" href="cHomePage.php?info=addressbook">
              <span class="button__text text">Log In Now</span>
              <i class="button__icon fas fa-chevron-right"></i>
            </button>
          </form>

          <div class="social-login mx-3 mt-5 pt-5 h5">
            <a class="text-light" href="./signup.php" name="csignup"
              >Create Account</a
            >
          </div>
          <div >
            <a  class="text-white font-weight-bold mx-5 px-3 h5"
              style="color: rgb(125, 71, 211); margin-left: 10px"
              href="help.php"
              name="help"
              >HELP?</a
            >
          </div>
        </div>
        <div class="screen__background">
          <span
            class="screen__background__shape screen__background__shape4"
          ></span>
          <span
            class="screen__background__shape screen__background__shape3"
          ></span>
          <span
            class="screen__background__shape screen__background__shape2"
          ></span>
          <span
            class="screen__background__shape screen__background__shape1"
          ></span>
        </div>
      </div>
    </div>

    
  </body>
</html>
