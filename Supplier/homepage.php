<?php
include("auth.php");
require('db.php');
$errors = array(); 


$profileName = "";


      $username = $_SESSION['sellerid'] ;
     
        $query = "SELECT * FROM supplier WHERE mNumber='$username'";
        $results = mysqli_query($conn, $query);
        if (mysqli_num_rows($results) == 1) {
          while($row=mysqli_fetch_array($results))
          { 
            $profileName= $row['name'];
          }
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

    
    <link rel="stylesheet" href="./homepage.css" />
    

    <title>Home Page</title>
  </head>
  <body class=" text-white" style="background-image:url('../images/back.jpg');">
    
    <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark border border-info mb-5">
     
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
                    <a id="homepage" class="nav-link" href="homepage.php?info=current_supplies" name="home" title="Suppliers">Home<span class="sr-only"></span></a>
              </li>
              <li class="nav-item">
                    <a id="orders" class="nav-link mx-5" href="homepage.php?info=orders" name="orders" title="Orders">Orders</a>
              </li>
              <li class="nav-item">
                    <a id="supplies" class="nav-link pr-5" href="homepage.php?info=supplies" name="supplies" title="Supplies">Supplies</a>
              </li>
              <li class="nav-item">
                    <a id="fillup" class="nav-link" href="homepage.php?info=fillupPoints" name="fillup" title="Fill-up Points">Fill-up</a>
              </li>
              <li class="nav-item">
                    <a id="revenue" class="nav-link mx-4" href="homepage.php?info=revenue" name="revenue" title="Revenue">Revenue</a>
              </li>
              <li class="nav-item">
                    <a id="help" class="nav-link mx-3" href="homepage.php?info=help" name="help" title="help?">Help</a>
              </li>
              <li class="nav-item">
                    <a id="profile" class="nav-link mx-3" href="homepage.php?info=profile" name="profile" title="Profile"><?php echo $profileName ?></a>
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
             if ($info=="current_supplies") {

                 include('currentSupplies.php');

                } else if($info=="supplies")
                {

                include('supplies.php');

                } else if($info=="edit_supplie")
                {

                include('editSupplie.php');
                
                } 
                 else if($info=="add_supplie")
                {

                include('addSupplie.php');
                
                } 
                 else if($info=="help")
                {

                include('Contact.php');
                
                } 
                 else if($info=="parOrders")
                {

                include('parOrders.php');
                
                } 
                 else if($info=="searchParOrders")
                {

                include('searchParOrders.php');
                
                } 
                 else if($info=="orders")
                {

                include('orders.php');
                
                } 
                 else if($info=="search_orders")
                {

                include('searchOrders.php');
                
                } 
                 else if($info=="profile")
                {

                include('profile.php');
                
                } 
                 else if($info=="fillupPoints")
                {

                include('fillupPoints.php');
                
                } 
                 else if($info=="searchfillup")
                {

                include('searchFillup.php');
                
                } 
                 else if($info=="addFillup")
                {

                include('addfillup.php');
                
                } 
                 else if($info=="profile")
                {

                include('profile.php');
                
                } 
                 else if($info=="revenue")
                {

                include('revenue.php');
                
                } 
                 else if($info=="revenue_date")
                {

                include('revenueDate.php');
                
                } 
                 else if($info=="parRevenue")
                {

                include('parRevenue.php');
                
                } 
                 else if($info=="parRevenue_date")
                {

                include('parRevenueDate.php');
                
                } 
              }
             
             
?>
</div>
    
    <script>
      // $(document).on("click", "ul li", function (evt) {    
      //  // alert('Clicked'); Not Working try
      //     $("#" + evt.target.id).addClass("active");

      //   });

    </script>

  </body>
</html>
