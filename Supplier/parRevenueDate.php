<?php
if (isset($_POST['getRevenue'])) {
    $start = mysqli_real_escape_string($conn, $_POST['start']);
    $end = mysqli_real_escape_string($conn, $_POST['end']);

     ?>

<section class='pt-5 mt-5 mx-3' id='parRevenueDate'>
        <div id='datePick' class='mb-2'>
            <form method="post" action="homepage.php?info=parRevenue_date">
               
                <?php
                echo "<label for='sDate' class='mr-2'>From</label>";
                echo "<input type='date' name='start' class='' id='sDate' value=''/>";
                echo "<label for='sDate' class='ml-2 mr-2'>To</label>";
                echo "<input type='date' name='end' class='' id='eDate' value=''/>";
                ?>

                <button  style="width:150px ;" class="btn btn-dark text-white rounded-pill border border-info" name='getRevenue' id='getRevenue'>Fetch</button>
            </form>
        </div>

        <div class='' id='parrevenuedate'>
            <table class="table">
            <thead class="thead-dark mt-0">
                <tr>
                <th scope="col">Supplier Name & Number</th>
                <th scope="col">Received</th>
                <th scope="col">Delivered</th>
                <th scope="col">In Process</th>
                <th scope="col">Cancelled</th>
                <th scope="col">Amount (Delivered)</th>
                </tr>
            </thead>
                <?php 
                
                $username = $_SESSION['sellerid'] ;


                $query = "SELECT * FROM supplier WHERE mNumber='$username'";
                $results = mysqli_query($conn, $query);

                if (mysqli_num_rows($results) == 1) {

                    echo "<tbody class='bg-light'>";

                  while($par_row=mysqli_fetch_array($results))

                  { 
                    $id=$par_row['selectedSupplier'];
                    $rec=0;
                    $del=0;
                    $pro=0;
                    $can=0;
                    $amt=0;

                    $query_par = "SELECT * FROM orders WHERE supid='$username' AND supplyid='$id' AND date BETWEEN '$start' AND '$end'";
                    $res_par = mysqli_query($conn, $query_par);
                    
                    if (mysqli_num_rows($res_par) > 0) {
                        while($row=mysqli_fetch_array($res_par))
                        { 
                            $rec=$rec + 1;
                            if($row['status'] == 'Delivered'){
                                $del=$del + 1;
                                $amt = $amt + $row['amount'];
                            }else if($row['status'] == 'Placed' || $row['status'] == 'OnWay'){
                                $pro=$pro + 1;
                            }else if($row['status'] == 'Cancelled'){
                                $can = $can + 1;
                            }

                        }

                        //Fetching Supplier Name and Number
                        $query_get = "SELECT * FROM onboardsupply WHERE id='$id'";
                        $result_get = mysqli_query($conn, $query_get);
                        
                        $name="";
                        $number="";

                        if (mysqli_num_rows($result_get) == 1) {
        
                          while($row_get=mysqli_fetch_array($result_get))
        
                          { 
                            $name=$row_get['name'];
                            $number=$row_get['number'];
                          }
                        }
        


                        echo "<tr>";
                        echo "<td>".$name." & ".$number."</td>";
                        echo "<td>".$rec."</td>";
                        echo "<td>".$del."</td>";
                        echo "<td>".$pro."</td>";
                        echo "<td>".$can."</td>";
                        echo "<td>Rs. ".$amt."</td>";
                        echo "</tr>";

                    }

                  }

                   echo "</tbody>";

                }
                ?>
                
                
          
            </table>

    </div>
   

<?php  

}
?>
</section>

<script>
     var start = localStorage.getItem('start');
     var end = localStorage.getItem('end');
     document.getElementById('sDate').value = start;
     document.getElementById('eDate').value = end;


     $("#getRevenue").click(function() {

        var start = $("#sDate").val();
        localStorage.setItem('start', start);
        var end = $("#eDate").val();
        localStorage.setItem('end', end);

        });
</script>