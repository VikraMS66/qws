

<section  id="bugList" class="pt-5 mx-3 border border-warning">

<div class='col-2 mt-4'>
      <a type="button" href='home.php?info=addAgent' id="addAgent" class="btn btn-outline-info text-end text-light rounded">Add New Agent</a>
      </div>

<?php 

    $sql_query="SELECT * FROM agent";
    $res=mysqli_query($conn,$sql_query);

    if (mysqli_num_rows($res) > 0) {
        ?>
<table class="table mt-3">
                     <thead class="thead-dark">
                         <tr>
                         <th scope="col">ID</th>
                         <th scope="col">Role Status</th>
                         <th scope="col">Name</th>
                         <th scope="col">Number</th>
                         <th scope="col">Email</th>
                         <th scope="col">Password</th>
                         <th scope="col">Update</th>
                         <th scope="col">Block/Unblock</th>
                         </tr>
                     </thead>
                     <tbody class='text-dark bg-white'>

    <?php
        while($row = mysqli_fetch_assoc($res)) {
           
     ?>
                         <tr>
     <?php
                        echo"<td>".$row['id']."</td>";
                         echo"<td>".$row['role']."</td>";
                         echo"<td>".$row['name']."</td>";
                         echo"<td>".$row['number']."</td>";
                         echo"<td>".$row['email']."</td>";
                         echo"<td>".$row['password']."</td>";
                         echo"<td><a id=".$row['id']." class='btn btn-info text-white update'>Update</a></td>";
                         if($row['role'] == 'Blocked') {
                         echo"<td><a id='".$row['id']."' class='btn btn-warning text-white unblock'>Unblock</a></td>";
                         } else {
                            echo"<td><a id=".$row['id']." class='btn btn-danger text-white block'>Block</a></td>";
                         }
                        
     ?>     
                         </tr>   
   <?php

        }

        ?>

        </tbody>
        </table>

         <?php

        } else {
            echo "<h1 class'text-center mt-5 pt-5 mb-5 pb-5 mx-5'>No Agent Found</h1>";
        }

 

    ?>
</section>


<script>


$(".update").click(function (event) {
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
     location.href='home.php?info=agentUpdate';
     }
});

$(".block").click(function (event) {
var id = event.target.id;



$.post(
    'http://localhost:8013/h20app/Admin/changeAgentStatus.php',
    { id: id, status: 'Blocked'},
      function(id) {
      console.log(id);
    }
   )

   alert("Agent Blocked!");

   setTimeout(reloadPage, 300);

     function reloadPage(){
     location.reload();
     }
});

$(".unblock").click(function (event) {
var id = event.target.id;

$.post(
    'http://localhost:8013/h20app/Admin/changeAgentStatus.php',
    { id: id, status: 'Associate'},
      function(id) {
      console.log(id);
    }
   )

   alert("Agent Unblocked, role set to 'Associate'!");

   setTimeout(reloadPage, 300);

     function reloadPage(){
     location.reload();
     }
});

</script>