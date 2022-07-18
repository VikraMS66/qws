<section class='pt-5 mt-5 mx-3' id='revenue'>
    <div class='row'>
        <div class='col-4 mr-4'>
            <div id='datePick' class='mb-2'>
                <form method="post" action="homepage.php?info=revenue_date">
                    <label for='sDate' class='mr-2'>From</label>
                    <input type='date' name='start' class='' id='sDate'/>
                    <label for='sDate' class='ml-2 mr-2'>To</label>
                    <input type='date' name='end' class='' id='eDate'/>
                    <button  style="width:150px ;" class="btn btn-dark text-white rounded-pill border border-info" name='getRevenue' id='getRevenue'>Fetch</button>
                </form>
            </div>
        </div>
        <div class='col-3 text-center mb-2 mx-5'>
        <h3 class='text-center bg-light text-dark pt-1 pb-1 '>OVERALL REVENUE</h3>
        </div>
    </div>


<div id="tables">

    <div class='' id='bycapacity'>
        <h4 class='text-center bg-warning text-dark pt-1 pb-1 mb-0'>CAPACITY BASED DISTRIBUTION</h4>
            <table class="table">
            <thead class="thead-dark mt-0">
                <tr>
                <th scope="col">Capacity</th>
                <th scope="col">Received</th>
                <th scope="col">Delivered</th>
                <th scope="col">In Process</th>
                <th scope="col">Cancelled</th>
                <th scope="col">Amount (Delivered)</th>
                
                </tr>
            </thead>
                <?php 
                
                $username = $_SESSION['sellerid'] ;

                $cap_recT=0;
                $cap_delT=0;
                $cap_proT=0;
                $cap_canT=0;
                $cap_amoT=0;

                $query = "SELECT DISTINCT capacity FROM onboardsupply WHERE sellerid='$username'";
                $results = mysqli_query($conn, $query);

                if (mysqli_num_rows($results) > 0) {

                    echo "<tbody class='bg-light'>";

                  while($cap_row=mysqli_fetch_array($results))

                  { 
                    $capacity=$cap_row['capacity'];
                    $rec=0;
                    $del=0;
                    $pro=0;
                    $can=0;
                    $amt=0;

                    $query_cap = "SELECT * FROM orders WHERE supid='$username' AND product='$capacity'";
                    $res_cap = mysqli_query($conn, $query_cap);
                    
                    if (mysqli_num_rows($res_cap) > 0) {
                        while($row=mysqli_fetch_array($res_cap))
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

                        $cap_recT=$cap_recT + $rec;
                        $cap_delT=$cap_delT + $del;
                        $cap_proT=$cap_proT + $pro;
                        $cap_canT=$cap_canT + $can;
                        $cap_amoT=$cap_amoT + $amt;


                        echo "<tr>";
                        echo "<td>".$capacity."</td>";
                        echo "<td>".$rec."</td>";
                        echo "<td>".$del."</td>";
                        echo "<td>".$pro."</td>";
                        echo "<td>".$can."</td>";
                        echo "<td>Rs. ".$amt."</td>";
                        echo "</tr>";

                    }

                  }

                  echo "<tr class='bg-dark text-white'>";
                  echo "<td> Total </td>";
                  echo "<td>".$cap_recT."</td>";
                  echo "<td>".$cap_delT."</td>";
                  echo "<td>".$cap_proT."</td>";
                  echo "<td>".$cap_canT."</td>";
                  echo "<td>Rs. ".$cap_amoT."</td>";
                  echo "</tr>";


                   echo "</tbody>";

                }
                ?>
                
                
          
            </table>

    </div>
    <div class='' id='bypincode'>
       <h4 class='text-center bg-warning text-dark pt-1 pb-1 mb-0'>PINCODE BASED DISTRIBUTION</h4>
            <table class="table">
            <thead class="thead-dark mt-0">
                <tr>
                <th scope="col">Pincode</th>
                <th scope="col">Received</th>
                <th scope="col">Delivered</th>
                <th scope="col">In Process</th>
                <th scope="col">Cancelled</th>
                <th scope="col">Amount (Delivered)</th>
                
                </tr>
            </thead>
                <?php 
                
                $username = $_SESSION['sellerid'] ;

                $pin_recT=0;
                $pin_delT=0;
                $pin_proT=0;
                $pin_canT=0;
                $pin_amoT=0;

                $query = "SELECT DISTINCT pincode FROM onboardsupply WHERE sellerid='$username'";
                $results = mysqli_query($conn, $query);

                if (mysqli_num_rows($results) > 0) {

                    echo "<tbody class='bg-light'>";

                  while($pin_row=mysqli_fetch_array($results))

                  { 
                    $pincode=$pin_row['pincode'];
                    $rec=0;
                    $del=0;
                    $pro=0;
                    $can=0;
                    $amt=0;

                    $query_pin = "SELECT * FROM orders WHERE supid='$username' AND pincode='$pincode'";
                    $res_pin = mysqli_query($conn, $query_pin);
                    
                    if (mysqli_num_rows($res_pin) > 0) {
                        while($row=mysqli_fetch_array($res_pin))
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

                        $pin_recT=$pin_recT + $rec;
                        $pin_delT=$pin_delT + $del;
                        $pin_proT=$pin_proT + $pro;
                        $pin_canT=$pin_canT + $can;
                        $pin_amoT=$pin_amoT + $amt;


                        echo "<tr>";
                        echo "<td>".$pincode."</td>";
                        echo "<td>".$rec."</td>";
                        echo "<td>".$del."</td>";
                        echo "<td>".$pro."</td>";
                        echo "<td>".$can."</td>";
                        echo "<td>Rs. ".$amt."</td>";
                        echo "</tr>";

                    }

                  }

                  echo "<tr class='bg-dark text-white'>";
                  echo "<td> Total </td>";
                  echo "<td>".$pin_recT."</td>";
                  echo "<td>".$pin_delT."</td>";
                  echo "<td>".$pin_proT."</td>";
                  echo "<td>".$pin_canT."</td>";
                  echo "<td>Rs. ".$pin_amoT."</td>";
                  echo "</tr>";


                   echo "</tbody>";

                }
                ?>
                
                
          
            </table>

    </div>
    <div class='' id='bysupplier'>
       <h4 class='text-center bg-warning text-dark pt-1 pb-1 mb-0'>SUPPLIER BASED DISTRIBUTION</h4>
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

                $sup_recT=0;
                $sup_delT=0;
                $sup_proT=0;
                $sup_canT=0;
                $sup_amoT=0;

                $query = "SELECT * FROM onboardsupply WHERE sellerid='$username'";
                $results = mysqli_query($conn, $query);

                if (mysqli_num_rows($results) > 0) {

                    echo "<tbody class='bg-light'>";

                  while($sup_row=mysqli_fetch_array($results))

                  { 
                    $id=$sup_row['id'];
                    $name=$sup_row['name'];
                    $number=$sup_row['number'];
                    $rec=0;
                    $del=0;
                    $pro=0;
                    $can=0;
                    $amt=0;

                    $query_sup = "SELECT * FROM orders WHERE supid='$username' AND supplyid='$id'";
                    $res_sup = mysqli_query($conn, $query_sup);
                    
                    if (mysqli_num_rows($res_sup) > 0) {
                        while($row=mysqli_fetch_array($res_sup))
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

                        $sup_recT=$sup_recT + $rec;
                        $sup_delT=$sup_delT + $del;
                        $sup_proT=$sup_proT + $pro;
                        $sup_canT=$sup_canT + $can;
                        $sup_amoT=$sup_amoT + $amt;


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

                  echo "<tr class='bg-dark text-white'>";
                  echo "<td> Total </td>";
                  echo "<td>".$sup_recT."</td>";
                  echo "<td>".$sup_delT."</td>";
                  echo "<td>".$sup_proT."</td>";
                  echo "<td>".$sup_canT."</td>";
                  echo "<td>Rs. ".$sup_amoT."</td>";
                  echo "</tr>";


                   echo "</tbody>";

                }
                ?>
                
                
          
            </table>

    </div>
</div>


</section>

<script>
    $("#getRevenue").click(function() {

     var start = $("#sDate").val();
     localStorage.setItem('start', start);
     var end = $("#eDate").val();
     localStorage.setItem('end', end);
     
    });
    </script>