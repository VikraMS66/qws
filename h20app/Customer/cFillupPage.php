
<?php
 
 //include("auth.php");
  require('db.php');
  $username="";
  $errors = array();



  ?>
    <div class="mt-5 pt-5 text-start mx-1 mb-5 pb-3 bg-info">
   
      <form method='post' action='cHomePage.php?info=searchfillup'>
        <div class="input-group text-center mx-3 mb-3" style="width:300px;">
         <input name="searchPin"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onkeypress="return onlyNumberKey(event)"  id="pincodeEntered" type="number" class="form-control rounded ml-5" style="width:50px;" maxlength="6" minlength="6" placeholder="Enter Pincode to Search"/>
          <button type="submit" id="searchOrder" class="btn btn-outline-dark text-white rounded">Search</button>
        </div>
      </form>
       
     
        <?php 
      
        $query="SELECT * FROM fillup where status='Active'";
        $res=mysqli_query($conn, $query);
          
        if (mysqli_num_rows($res) > 0) {
          ?>
          

        <div class="container">
          <div class="row">
            <?php
                  while($row = mysqli_fetch_assoc($res)) {

                    ?>
                
                  <div class="col-lg-3 mb-3 mr-2 order">
                    <div class="card bg-dark text-white pb-3" style="width: 18rem">
                    <?php 
                      echo "<div class='card-header'>Pincode:<span class='pincode'>".$row['pincode']."</span></div>";
                      
                    ?>
                    <ul class="list-group list-group-flush">
                    <?php 
                      echo "<li class='list-group-item'>Name: ".$row['name']."</li>";
                      echo "<li class='list-group-item'>Contact No. ".$row['number']."</li>";
                      if($row['gCode'] == null){
                        echo "<li class='list-group-item'>Map Code: Not Found</li>";
                      }else {
                      echo "<li class='list-group-item'>Map Code: ".$row['gCode']."</li>";
                      }
                      echo "<li class='list-group-item'>Status:  ".$row['status']."</li>";
                      echo "<li class='list-group-item'>Address:  ".$row['address']."</li>";
                    ?>
                      </ul>
                    </div>
                   
                  </div>
       
                <?php 
                  }
                ?>
              </div>
            </div>
            
            <?php
                } else {
                  echo "<h1 class'text-center mt-5 pt-5 mb-5 pb-5 mx-5'>No Active Fill Up Points Found</h1>";
                }
                ?>

      
    <script>
        
                    //alert("Hello");
        function onlyNumberKey(evt) {
          // Only ASCII character in that range allowed
          var ASCIICode = evt.which ? evt.which : evt.keyCode;
          if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) return false;
          return true;
        }

      </script>
  
          </div>