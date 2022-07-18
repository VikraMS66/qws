

<section  id="bugList" class="pt-5 mx-3 border border-warning">

<?php 

    $sql_query="SELECT * FROM bug WHERE status='Registered' OR status='In Process' ORDER BY date ASC";
    $res=mysqli_query($conn,$sql_query);

    if (mysqli_num_rows($res) > 0) {
        ?>
<table class="table mt-3">
                     <thead class="thead-dark">
                         <tr>
                         <th scope="col">Date</th>
                         <th scope="col">Bug ID</th>
                         <th scope="col">Reported By</th>
                         <th scope="col">Status</th>
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
                         echo"<td>".$row['reportedby']."</td>";
                         echo"<td>".$row['status']."</td>";
                         echo"<td><a id=".$row['id']." class='btn btn-info text-white bugDetails'>View</a></td>";
                        
     ?>     
                         </tr>   
   <?php

        }

        ?>

        </tbody>
        </table>

         <?php

        } else {
            echo "<h1 class'text-center mt-5 pt-5 mb-5 pb-5 mx-5'>No Bug Found</h1>";
        }

 

    ?>
</section>


<script>


$(".bugDetails").click(function (event) {
var id = event.target.id;
//alert(id);


$.post(
    'http://localhost:8013/h20app/Admin/setId.php',
    { id: id},
      function(id) {
      console.log(id);
    }
   )

   setTimeout(redirectPage, 300);

     function redirectPage(){
     location.href='home.php?info=bugDetails';
     }
});

</script>