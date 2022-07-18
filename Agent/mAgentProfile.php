<section  id="agentProfile" class="pt-5 mt-3 text-dark px-5 text-dark" style="background-image:url('../images/back.jpg');">

<?php 

     $ID= $_SESSION['managerid'];
     
     $name="";
     $number="";
     $email="";
     $pass="";

     $sql_query="SELECT * FROM agent WHERE number='$ID'";

     $res=mysqli_query($conn,$sql_query);

     if (mysqli_num_rows($res) == 1) {

        while($row = mysqli_fetch_assoc($res)) {

           $name=$row['name'];
           $number=$row['number'];
           $email=$row['email'];
           $pass=$row['password'];

        }
      } else {
        echo "<h1 class'text-center mt-5 pt-5 mb-5 pb-5 mx-5'>No Profile Data Found</h1>";
      }
      //#eee color code
?>


    
  <div class='text-dark text-center '>

    <form method='post'>

            <div class="container py-4 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                 <div class="col-lg-10 col-xl-6">
                    <div class="card rounded-3">
                    <img src="../images/profilepic.png"
                        class="w-100" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem;"
                        alt="Sample photo">
                    <div class="card-body p-4 p-md-5">
                        <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Profile Information</h3>

                        <form class="px-md-2" method='post'>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example1q">Name</label>
                            <input type="text" id="form3Example1q" class="form-control" name='username' minlength='1' maxlength='20' value='<?php echo $name ?>'/>
                            
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example1qa">Eamil</label>
                            <input type="email" id="form3Example1qa" class="form-control" name='email' minlength='1' maxlength='20' value='<?php echo $email ?>'/>
                            
                        </div>
                        <div class="form-outline mb-4">
                             <label class="form-label" for="form3Example1qb">Mobile Number</label>
                            <input type="text" id="form3Example1qb" readonly class="form-control" name='number' value='<?php echo $number ?>'/>
                            
                        </div>
                         <div class='row mt-2 mb-0'>
                            <div class="col-5 text-start mx-4">
                                <button type="submit" style='width:80px;' id="editProfile" name='profileEdit' class="btn btn-info mb-1">Save</button>
                            </div>
                            <div class="col-5 text-end">
                                <button type="button" style='width:180px;' id='changePass' data-toggle="modal" data-target="#exampleModalPass" data-whatever='<?php echo $name ?>' class="btn btn-success mb-1">Change Password</button>
                            </div>
                        </div>
                        </form>

                    </div>
                    </div>
               
                </div>
            </div>
   
    </form>
  </div>


            <div class="modal fade" id="exampleModalPass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Changing Password for '<?php echo $name ?>'</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method='post'>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Current Password</label>
                            <input type="password" name='oldPass' class="form-control" id="oldPass">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">New Password</label>
                            <input type="password" name='newPass' class="form-control" id="newPasss">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Repeat New Password</label>
                            <input type="password" name='renewPass' class="form-control" id="renewPass">
                        </div>
                       
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name='passChange' class="btn btn-success">Change Password</button>
                    </div>
                    </form>
                    </div>
                </div>
                </div>

                <?php 

                if (isset($_POST['passChange'])) {
                    $current = mysqli_real_escape_string($conn, $_POST['oldPass']);
                    $pwd = mysqli_real_escape_string($conn, $_POST['newPass']);
                    $repwd = mysqli_real_escape_string($conn, $_POST['renewPass']);
                    if($pass == $current) {

                        if($pwd != $repwd) {

                            echo("<script>alert('New Password and Repeat Password Does not Match!');</script>");

                        } else if(strlen($repwd) > 5){

                            $sql_query="update agent set password='$repwd' where number='$number'";
                            $res=mysqli_query($conn,$sql_query);

                            if($res) {
                                echo("<script>alert('Password Changed!');</script>");
                            }
                        } else {
                            echo("<script>alert('Password should be atleat of length 6.');</script>");
                        }
                       
                    } else {
                        echo("<script>alert('Enter a valid Current Password!');</script>");
                    }
                 
                }


                if (isset($_POST['profileEdit'])) {
                    $name = mysqli_real_escape_string($conn, $_POST['username']);
                    $email = mysqli_real_escape_string($conn, $_POST['email']);
                     if(strlen($name) > 0 && strlen($email) > 0){

                            $sql_query="update agent set name='$name', email='$email' where number='$number'";
                            $res=mysqli_query($conn,$sql_query);
                            if($res) {
                                echo("<script>alert('Profile Edited!');</script>");
                                echo("<script>location.href = 'manager.php?info=profile';</script>");
                             }
                        } else {
                            echo("<script>alert('Invalid Name or Email.');</script>");
                        }
                       
                    } 
               ?>

  <script>
    
  </script>
    
</section>