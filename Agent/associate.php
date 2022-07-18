<?php
include("authAssociate.php");
require('db.php');
$errors = array(); 


$profileName = "";


        $username = $_SESSION['associateid'];
     
        $query = "SELECT * FROM agent WHERE number='$username'";
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

    
    <link rel="stylesheet" href="./associate.css"/>
    

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
                    <a id="home" class="nav-link mx-5" href="associate.php?info=home" name="home" title="mainpage">Home<span class="sr-only"></span></a>
              </li>
              <li class="nav-item">
                    <a id="orders" class="nav-link" href="associate.php?info=orders" name="orders" title="All Orders">Orders<span class="sr-only"></span></a>
              </li>
              <li class="nav-item">
                    <a id="devissue" class="nav-link mx-5" href="associate.php?info=devissues" name="devissues" title="Application Error Registration">Bug Report</a>
              </li>
              <li class="nav-item">
                    <a id="complaints" class="nav-link " href="associate.php?info=complaintList" name="complaintList" title="Complaints List">Complaints</a>
              </li>
              <li class="nav-item">
                    <a id="guidelines" class="nav-link mx-4" href="associate.php?info=guidelines" name="guidelines" title="Guidlines">Guide</a>
              </li>
              <li class="nav-item">
                    <a id="help" class="nav-link mx-3 " href="associate.php?info=help" name="help" title="help?">Help</a>
              </li>
              <li class="nav-item">
                    <a id="profile" class="nav-link mx-3" href="associate.php?info=profile" name="profile" title="Profile"><?php echo $profileName ?></a>
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
             if ($info=="home") {

                 include('aHome.php');

                } else if($info=="help"){

                    include('Contact.php');
                }
                 else if($info=="fillup"){

                    include('fillupPoints.php');
                }
                 else if($info=="searchfillup"){

                    include('searchFillup.php');
                }
                 else if($info=="addFillup"){

                    include('addFillup.php');
                }
                 else if($info=="updateFillup"){

                    include('updateFillup.php');
                }
                 else if($info=="customer"){

                    include('aCustomer.php');
                }
                 else if($info=="seller"){

                    include('aSeller.php');
                }
                 else if($info=="search_customer"){

                    include('searchCustomer.php');
                }
                 else if($info=="search_seller"){

                    include('searchSeller.php');
                }
                 else if($info=="corders"){

                    include('cOrders.php');
                }
                 else if($info=="sorders"){

                    include('sOrders.php');
                }
                 else if($info=="cpassword"){

                    include('cSetPassword.php');
                }
                 else if($info=="spassword"){

                    include('sSetPassword.php');
                }
                 else if($info=="cbug_report"){

                    include('cBug.php');
                }
                 else if($info=="sbug_report"){

                    include('sBug.php');
                }
                 else if($info=="csearch_orders"){

                    include('cSearchOrders.php');
                }
                 else if($info=="ssearch_orders"){

                    include('sSearchOrders.php');
                }
                 else if($info=="csearch_orders"){

                    include('cSearchOrders.php');
                }
                 else if($info=="devissues"){

                    include('agentBug.php');
                }
                 else if($info=="cComplaint"){

                    include('cComplaint.php');
                }
                 else if($info=="sComplaint"){

                    include('sComplaint.php');
                }
                 else if($info=="updateSeller"){

                    include('updateSeller.php');
                }
                 else if($info=="sellerSupplies"){

                    include('sellerSupplies.php');
                }
                 else if($info=="profile"){

                    include('agentProfile.php');
                }
                 else if($info=="complaintList"){

                    include('complaintList.php');
                }
                 else if($info=="complaintDetails"){

                    include('complaintDetails.php');
                }
                 else if($info=="search_complaint"){

                    include('searchComplaintList.php');
                }
                 else if($info=="ordering"){

                    include('ordering.php');
                }
                 else if($info=="search_supply"){

                    include('suppliesAvailable.php');
                }
                 else if($info=="processOrder"){

                    include('placeOrder.php');
                }
                 else if($info=="orders"){

                    include('ordersList.php');
                }
                 else if($info=="search_orderslist"){

                    include('searchorderslist.php');
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
