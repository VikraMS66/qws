
<?php
  require('db.php');

  if (isset($_POST['searchPin'])) {

    $pin = mysqli_real_escape_string($conn, $_POST['searchPin']);

      if(strlen($pin) > 0) {

      $query="SELECT * FROM fillup where pincode LIKE '%".$pin."%'";

      } else {

        $query="SELECT * FROM fillup";
        
      }
     $res=mysqli_query($conn, $query);
  ?>

    <section  class="mt-5 pt-5 text-start mx-1 mb-5 pb-3 ">
   
    <div class='row'>
      <div class='col-10'>
      <form method='post' action='associate.php?info=searchfillup'>
        <div class="input-group text-center mx-3 mb-3" style="width:300px;">
         <input name="searchPin"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onkeypress="return onlyNumberKey(event)"  id="pincodeEntered" type="text" class="form-control rounded ml-5" style="width:50px;" maxlength="6" minlength="6" placeholder="Enter Pincode to Search"/>
          <button type="submit" id="searchOrder" class="btn btn-outline-dark text-white rounded">Search</button>
        </div>
      </form>
      </div>
      <div class='col-2'>
      <a type="button" href='associate.php?info=addFillup' id="addFillup" class="btn btn-outline-dark text-end text-info rounded">Add Your Fill-up Point</a>
      </div>
      </div>
     
      <?php 
          
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
                      echo "<div class='card-header'>Pincode:<span id='".$row['id']."pincode' class='pincode'>".$row['pincode']."</span></div>";
                      
                    ?>
                    <ul class="list-group list-group-flush">
                    <?php 
                      echo "<li class='list-group-item'>Name: <span id='".$row['id']."name'>".$row['name']."</span></li>";
                      echo "<li class='list-group-item'>Contact No. <span id='".$row['id']."number'>".$row['number']."</span></li>";
                      if($row['gCode'] == null){
                        echo "<li class='list-group-item'>Map Code: <span id='".$row['id']."gCode'>Not Found</span></li>";
                      }else {
                        echo "<li class='list-group-item'>Map Code: <span id='".$row['id']."gCode'>".$row['gCode']."</span></li>";
                      }
                      echo "<li class='list-group-item'>Status:  <span id='".$row['id']."status'>".$row['status']."</span></li>";
                      echo "<li class='list-group-item'>Address:  <span id='".$row['id']."address'>".$row['address']."</span></li>";
                    ?>
                      </ul>
                      <?php 
                      echo "<a id=".$row['id']." href='associate.php?info=updateFillup' class='btn btn-info updateFillup' >Update</a>";
                      ?>
                    </div>
                   
                  </div>
       
                <?php 
                  }
                ?>
              </div>
            </div>
            
            <?php
                } else {
                  echo "<h1 class'text-center mt-5 pt-5 mb-5 pb-5 mx-5'>No Fill Up Points Found</h1>";
                }
              
            }
                ?>

  </section>

    <script>

        function onlyNumberKey(evt) {
          // Only ASCII character in that range allowed
          var ASCIICode = evt.which ? evt.which : evt.keyCode;
          if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) return false;
          return true;
        }

        $(".updateFillup").click(function(evt) {
                  //alert("Hello");

                  var id=evt.target.id;

                  var name = $("#" + id + "name").text();
                  var number = $("#" + id + "number").text();
                  var pincode = $("#" + id + "pincode").text();
                  var gCode = $("#" + id + "gCode").text();
                  var address = $("#" + id + "address").text();
                  var status = $("#" + id + "status").text();
                    
                  
                  alert(gCode);

                var selectedFillupData = {
                id: id,
                name: name,
                number: number,
                pincode: pincode,
                gCode: gCode,
                address: address,
                status: status,
              };

              localStorage.setItem(
                "selectedFillupData",
                JSON.stringify(selectedFillupData)
              );

               });
            

      </script>
  
          