<?php
  require('db.php');

  if (isset($_POST['number'])) {

    $pin = mysqli_real_escape_string($conn, $_POST['number']);

      if(strlen($pin) > 0) {

      $query="SELECT * FROM supplier WHERE mNumber='$pin' AND status <> 'Approved' ORDER BY date DESC";

      } else {

        $query="SELECT * FROM supplier WHERE status <> 'Approved' ORDER BY date DESC";

      }

     $res=mysqli_query($conn, $query);
  ?>

<section  id="sellerlist" class="pt-5 mx-3">

      <div class='mt-4'>
            <form method='post' action='manager.php?info=search_sellerlist'>
                <div class="input-group text-center mx-1 mb-2" style="width:300px;">
                        <?php
                        echo "<input name='number'  oninput='javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);' onkeypress='return onlyNumberKey(event)'  id='number' type='text' class='form-control rounded ' style='width:50px;' maxlength='10' minlength='10' value='".$pin."' placeholder='Enter number'/>";
                        ?>
                       <button type="submit" id="searchSeller" class="mx-2 btn btn-outline-dark text-white rounded">Search</button>
                </div>
            </form>
      </div>

      <?php 

if (mysqli_num_rows($res) > 0) {
    ?>
<table class="table mt-3">
                 <thead class="thead-dark">
                     <tr>
                     <th scope="col">Date</th>
                     <th scope="col">Name</th>
                     <th scope="col">Number</th>
                     <th scope="col">Email</th>
                     <th scope="col">Status</th>
                     <th scope="col">Message</th>
                     <th scope="col">View/Update</th>
                     </tr>
                 </thead>
                 <tbody class='text-dark bg-white'>

<?php
    while($row = mysqli_fetch_assoc($res)) {
       
 ?>
                     <tr>
 <?php
                     echo"<td>".$row['date']."</td>";
                     echo"<td>".$row['name']."</td>";
                     echo"<td>".$row['mNumber']."</td>";
                     echo"<td>".$row['email']."</td>";
                     echo"<td>".$row['status']."</td>";
                     echo"<td>".$row['statusMsg']."</td>";
                     echo"<td><a id=".$row['mNumber']." class='btn btn-info text-white sellerView'>View</a></td>";
                    
 ?>     
                     </tr>   
<?php

    }

    ?>

    </tbody>
    </table>

     <?php

    } else {
        echo "<h1 class'text-center mt-5 pt-5 mb-5 pb-5 mx-5'>No Seller Found</h1>";
    }



?>
</section>
<?php 
  }
  ?>

<script>

$(".sellerView").click(function (event) {
var id = event.target.id;
//alert(id);


$.post(
'http://localhost:8013/h20app/Agent/msetId.php',
{ id: id},
  function(id) {
  console.log(id);
}
)

setTimeout(redirectPage, 300);

 function redirectPage(){
 location.href='manager.php?info=sellerDetails';
 }
});



function onlyNumberKey(evt) {
// Only ASCII character in that range allowed
var ASCIICode = evt.which ? evt.which : evt.keyCode;
if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) return false;
return true;
}

</script>