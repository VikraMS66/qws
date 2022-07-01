<?php
include("auth.php");
require('db.php');
$username="";
$errors = array(); 


$profileName = "";


      $username = $_SESSION['cnumberID'] ;
        $query = "SELECT * FROM customer WHERE mNumber='$username'";
        $results = mysqli_query($conn, $query);
        if (mysqli_num_rows($results) == 1) {
          while($row=mysqli_fetch_array($results))
          { 
            $profileName= $row['name'];
          }
        }


if (isset($_REQUEST['logout'])) {
  header("location:logout.php");
}

if (isset($_REQUEST['help'])) {
  header("location:cHomePage.php?info=help");
}
if (isset($_REQUEST['fillup'])) {
  header("location:cHomePage.php?info=fillup");
}
if (isset($_REQUEST['home'])) {
  header("location:cHomePage.php?info=products");
}
if (isset($_REQUEST['orders'])) {
  header("location:cHomePage.php?info=orders");
}
if (isset($_REQUEST['profile'])) {
  header("location:cHomePage.php?info=profile");
}
if (isset($_REQUEST['addressbook'])) {
  header("location:cHomePage.php?info=addressbook");
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

    
    <link rel="stylesheet" href="./Styles/cHomePage.css" />
    
    <link rel="stylesheet" href="./Styles/address.css" />
    
    <link rel="stylesheet" href="./Styles/orderDetails.css" />

    <style>
      input:focus,
      select:focus,
      textarea:focus,
      button:focus {
          outline: none;
      }

      </style>

    <title>Home Page</title>
  </head>
  <body class="bg-dark text-white" style="background-image:url('../images/back.jpg');">
    
    <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark border border-warning">
     
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div 
        class="collapse navbar-collapse justify-content-end"
        id="navbarNavAltMarkup"
      >
        <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                    <a id="homepage" class="nav-link" href="cHomePage.php?info=products" name="home" title="Water Supplies">Home<span class="sr-only"></span></a>
              </li>
              <li class="nav-item">
                    <a id="orders" class="nav-link mx-5" href="cHomePage.php?info=orders" name="orders" title="Orders">Orders</a>
              </li>
              <li class="nav-item">
                    <a id="fillup" class="nav-link pr-5" href="cHomePage.php?info=fillup" name="fillup" title="Active Fill-up Points">Fill-up Point</a>
              </li>
              <li class="nav-item">
                    <a id="help" class="nav-link" href="cHomePage.php?info=help" name="help" title="Need Help?">Contact</a>
              </li>
              <li class="nav-item">
                    <a id="addressbook" class="nav-link mx-4" href="cHomePage.php?info=addressbook" name="addressbook" title="Addressbook">Address Book</a>
              </li>
              <li class="nav-item">
                    <a id="profileName" class="nav-link mx-3" href="cHomePage.php?info=profile" name="profile" title="Profile"><?php echo $profileName ?></a>
              </li>
              <li class="nav-item">
                    <a id="logout" class="nav-link pr-5e" href="logout.php" name="logout" title="Logout" title="Logout?"><span class="material-symbols-outlined">logout</span></a>
             </li>
         </ul>
      </div>
    </nav>

    

    <div class="activity"> 
      <?php
@$info=$_GET['info'];
if ($info!=="") {
             if ($info=="products") {
             include('productsPage.php');
                } else if($info=="addressbook")
                {
                include('addressBook.php');
                } else if($info=="addAddress")
                {
                include('addAddress.php');
                }
                else if($info=="updateAddress")
                {
                include('updateAddress.php');
                }
                else if($info=="checkout")
                {
                include('checkoutPage.php');
                }
                else if($info=="orders")
                {
                include('cOrderPage.php');
                }
                else if($info=="fillup")
                {
                include('cFillupPage.php');
                }
                else if($info=="orderDetails")
                {
                include('orderDetails.php');
                }
                else if($info=="profile")
                {
                include('profile.php');
                }
                else if($info=="help")
                {
                include('contact.php');
                }
                else if($info=="searchfillup")
                {
                include('searchFillup.php');
                }
             }
             
?>
</div>
    

    <script>
      $(document).on("click", "ul li", function () {    
       // alert('Clicked'); Not Working try
          $(this).addClass('active').siblings().removeClass('active');

        });

        $(document).on("click", "#logout", function () {
          localStorage.removeItem("selectedAddressBookData");
          localStorage.removeItem("productDetails");
        });
    </script>

  </body>
</html>
