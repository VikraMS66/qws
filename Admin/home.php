<?php
include("auth.php");
require('db.php');
$errors = array(); 

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

    <title>Home</title>
</head>

    <body class=" text-white bg-white" style='background-image: url(../images/admin.webp)'>
    
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
              <li class="nav-item mr-5">
                    <a id="bug" class="nav-link" href="home.php?info=bug" name="bug" title="Bug List">Bugs<span class="sr-only"></span></a>
              </li>
              <li class="nav-item mr-5">
                    <a id="agent" class="nav-link" href="home.php?info=agent" name="agent" title="Agent List">Agents<span class="sr-only"></span></a>
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
             if ($info=="bug") {
                 include('bug.php');

                } else if($info=="agent") {
                include('agent.php');
                
                } else if($info=='agentUpdate') {
                    include('agentUpdate.php');
                }
                  else if($info=='addAgent') {
                    include('addAgent.php');
                }
                  else if($info=='bugDetails') {
                    include('bugDetails.php');
                }
              }
             
             
?>
</div>
    
    <script>
     
    </script>

</body>
</html>