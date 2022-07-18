

<section  id="updatesList" class="pt-5 mt-5 mx-3">
 <h2 class='text-center pt-2 pb-2 bg-success'>Update Requested List</h2>
<?php 

    $sql_query="SELECT * FROM sellerupdate ORDER BY date ASC";
    $res=mysqli_query($conn,$sql_query);

    if (mysqli_num_rows($res) > 0) {
        ?>
<table class="table mt-3">
                     <thead class="thead-dark">
                         <tr>
                         <th scope="col">Date</th>
                         <th scope="col">Number</th>
                         <th scope="col">Company Name</th>
                         <th scope="col">GST Number</th>
                         <th scope="col">Comment</th>
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
                         echo"<td>".$row['sNumber']."</td>";
                         echo"<td>".$row['cName']."</td>";
                         echo"<td>".$row['gst']."</td>";
                         echo"<td>".$row['comment']."</td>";
                         echo"<td><a id=".$row['sNumber']." class='btn btn-info text-white updateView'>View</a></td>";
                        
     ?>     
                         </tr>   
   <?php

        }

        ?>

        </tbody>
        </table>

         <?php

        } else {
            echo "<h1 class'text-center mt-5 pt-5 mb-5 pb-5 mx-5'>No Update Request Found! You are free try something new for now.</h1>";
        }

 

    ?>
</section>


<script>

$(".updateView").click(function (event) {
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
     location.href='manager.php?info=updateDetails';
     }
});



function onlyNumberKey(evt) {
   // Only ASCII character in that range allowed
   var ASCIICode = evt.which ? evt.which : evt.keyCode;
   if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) return false;
   return true;
 }

</script>