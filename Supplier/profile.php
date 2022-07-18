<?php 
     require('db.php');

     $ID= $_SESSION['sellerid'];
     $name="";
     $number="";
     $email="";
     $pass="";
     $cname="Not Found";
     $gst="Not Found";
     $pincode="";
     $gCode="";
     $address="";

     $sql_query="SELECT * FROM supplier WHERE mNumber='$ID'";
     $res=mysqli_query($conn,$sql_query);
     if (mysqli_num_rows($res) == 1) {
        while($row = mysqli_fetch_assoc($res)) {
           $name=$row['name'];
           $number=$row['mNumber'];
           $email=$row['email'];
           $pass=$row['password'];
           $pincode=$row['pincode'];
           $gCode=$row['gCode'];
           $address=$row['address'];

           if(strlen($row['companyName']) > 0){
             $cname=$row['companyName'];
           }
           if(strlen($row['gstNumber']) > 0){
             $cname=$row['gstNumber'];
           }

        }
      } else {
        echo "<h1 class'text-center mt-5 pt-5 mb-5 pb-5 mx-5'>No Account Data Found</h1>";
      }
      //#eee color code
?>

<section  class="pt-5  text-dark mx-2" id='profile'>
     <div class='row'>

       <div class='col-4'>
                    <form method='post'>
                        <div class=" d-flex justify-content-start align-items-start">

                            <div class="card-body p-4 p-md-5  border border-dark">
                                <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2"><u>Profile Information</u></h3>

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
                                    <input type="text"  id="form3Example1qb" readonly class="form-control" name='number' value='<?php echo $number ?>'/>
                                    
                                </div>
                              
                                <div class='row mb-0'>
                                    <div class="col-5 text-start  mt-3">
                                        <button type="submit" style='width:80px;' id="editProfile" name='profileEdit' class="btn btn-info mb-1">Save</button>
                                    </div>
                                    <div class="col-5 text-end mt-3">
                                        <button type="button" style='width:150px;' id='changePass' data-toggle="modal" data-target="#exampleModalPass" data-whatever='<?php echo $name ?>' class="btn btn-success mb-1">Change Password</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                </form>
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
        </div>

       <div class='col-4'>
               <form method='post'>
                          <div class="d-flex justify-content-start align-items-start">
                                <div class="card-body p-4 p-md-5  border border-dark">
                                  <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2"><u>General Information</u></h3>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example1qb">Company Name</label>
                                        <input type="text"  id="form3Example1qb" readonly class="form-control" name='cname' value='<?php echo $cname ?>'/>
                                        
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example1qb">GST Number</label>
                                        <input type="text"  id="form3Example1qb" readonly class="form-control" name='gst' value='<?php echo $gst ?>'/>
                                    </div>
                                    <p class='bg-dark text-white'>To Update Company Name or Gst Details Contact Cutomer care at No.9876543210 or mail us at accountservice@qws.in</p> 
                                </div>
                            </div>
                </form>
        </div>

       <div class='col-4'>
               <form method='post'>
                          <div class="d-flex justify-content-end align-items-end">
                                <div class="card-body p-4 p-md-5 border border-dark">
                                  <h3 class="mb-1  pb-md-0 mb-md-5 px-md-2"><u>Contact Information</u></h3>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example1q">Pincode</label>
                                        <input type="text" id="form3Example1q" class="form-control" name='pincode' minlength='6' maxlength='6' value='<?php echo $pincode ?>'/>
                                        
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example1qa">Google Map Plus Code</label>
                                        <input type="text" id="form3Example1qa" class="form-control" name='gCode' minlength='1' maxlength='50' value='<?php echo $gCode ?>'/>
                                        
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example1qb">Address</label>
                                        <input type="text"  id="form3Example1qb" class="form-control" name='address' minlength='1' maxlength='50' value='<?php echo $address ?>'/>  
                                    </div>

                                      <button type="submit" style='width:180px;' id="editAddress" name='addressEdit' class="btn btn-info mb-1">Save</button>       

                                </div>
                            </div>
                 </form>
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

                    $sql_query="update supplier set password='$repwd' where mNumber='$number'";
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

           
        if (isset($_POST['addressEdit'])) {

            $pincode = mysqli_real_escape_string($conn, $_POST['pincode']);
            $gCode = mysqli_real_escape_string($conn, $_POST['gCode']);
            $address = mysqli_real_escape_string($conn, $_POST['address']);

            if(strlen($pincode) == 6)
            {
                if(strlen($address) > 0){

                        $sql_query="update supplier set pincode='$pincode', gCode='$gCode', address='$address' where mNumber='$number'";
                        $res=mysqli_query($conn,$sql_query);
                        if($res) {
                            echo("<script>alert('Contact Information Edited!');</script>");
                            echo("<script>location.href = 'homepage.php?info=profile';</script>");
                           }
                    } else {
                        echo("<script>alert('Invalid Address.');</script>");
                    }
            } else {
                echo("<script>alert('Invalid Pincode.');</script>");
            }

            } 



            if (isset($_POST['profileEdit'])) {
                $name = mysqli_real_escape_string($conn, $_POST['username']);
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                if(strlen($name) > 0 && strlen($email) > 0){
    
                        $sql_query="update supplier set name='$name', email='$email' where mNumber='$number'";
                        $res=mysqli_query($conn,$sql_query);
                        if($res) {
                            echo("<script>alert('Profile Edited!');</script>");
                            echo("<script>location.href = 'homepage.php?info=profile';</script>");
                        }
                    } else {
                        echo("<script>alert('Invalid Name or Email.');</script>");
                    }
                
                } 
        ?>

</section>