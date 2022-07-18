

<section  id="complaintList" class="pt-5 mx-3">
 
 <div class="mt-4">
     <form method='post' action='manager.php?info=msearch_complaint'>
     <div class='row'>
           <div class='col-4'>
               <div class="input-group text-center mx-3 mb-2" style="width:300px;">
                   <input name="searchValue" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onkeypress="return onlyNumberKey(event)" id="searchValue" type="text" class="form-control rounded"  maxlength="20" minlength="1" placeholder="Enter number"/>
                   <button type="submit" id="searchOrder" class="mx-2 btn btn-outline-dark text-white rounded">Search</button>
               </div>
           </div>
           <div class='col-8 text-dark h4'>
              <p><u>To Search use complaint number or order id or mobile number.</u></p>
           </div>
       </div>
     </form>
 </div>

<?php 

    $sql_query="SELECT * FROM complaint WHERE status = 'Registered' OR status = 'In Process' ORDER BY date DESC";
    $res=mysqli_query($conn,$sql_query);

    if (mysqli_num_rows($res) > 0) {
        ?>
<table class="table mt-3">
                     <thead class="thead-dark">
                         <tr>
                         <th scope="col">Date</th>
                         <th scope="col">Complait Number</th>
                         <th scope="col">Order ID</th>
                         <th scope="col">Mobile Number</th>
                         <th scope="col">Name</th>
                         <th scope="col">Current Status</th>
                         <th scope="col">Details</th>
                         </tr>
                     </thead>
                     <tbody class='text-dark bg-white'>

    <?php
        while($row = mysqli_fetch_assoc($res)) {
           
     ?>
                         <tr>
     <?php
                        echo"<td>".$row['date']."</td>";
                         echo"<td>".$row['id']."</td>";
                         echo"<td>".$row['orderid']."</td>";
                         echo"<td>".$row['number']."</td>";
                         echo"<td>".$row['name']."</td>";
                         echo"<td>".$row['status']."</td>";
                         echo"<td><a id=".$row['id']." class='btn btn-info text-white complaintDetails'>View</a></td>";
                        
     ?>     
                         </tr>   
   <?php

        }

        ?>

        </tbody>
        </table>

         <?php

        } else {
            echo "<h1 class'text-center mt-5 pt-5 mb-5 pb-5 mx-5'>No Complaint Found</h1>";
        }

 

    ?>
</section>


<script>


$(".complaintDetails").click(function (event) {
var id = event.target.id;
//alert(id);


$.post(
    'http://localhost:8013/h20app/Agent/mcomplaintId.php',
    { id: id},
      function(id) {
      console.log(id);
    }
   )

   setTimeout(redirectPage, 300);

     function redirectPage(){
     location.href='manager.php?info=mcomplaintDetails';
     }
});


function onlyNumberKey(evt) {
   // Only ASCII character in that range allowed
   var ASCIICode = evt.which ? evt.which : evt.keyCode;
   if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) return false;
   return true;
 }

</script>