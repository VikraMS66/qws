<section  id="complaintDetails" class="pt-5 mx-3 ">

<?php
    $ID = $_SESSION['associateid'];

    $query = "SELECT * FROM agent WHERE number='$ID'";
    $results = mysqli_query($conn, $query);
    
    $cNumber="";
    $orderid="";
    $name="";
    $number="";
    $issue="";
    $message="";
    $date="";

    if (mysqli_num_rows($results) == 1) {

        while($row=mysqli_fetch_array($results)) {
            $cNumber=$row['orderid'];
        }

        $query_get = "SELECT * FROM complaint WHERE id='$cNumber'";
        $results_get = mysqli_query($conn, $query_get);

        if (mysqli_num_rows($results_get) == 1) {
            while($row_get=mysqli_fetch_array($results_get)) {

                $orderid=$row_get['orderid'];
                $name=$row_get['name'];
                $number=$row_get['number'];
                $issue=$row_get['issue'];
                $message=$row_get['message'];
                $date=$row_get['date'];

            }
        }

   
?>

<div class='text-dark'>
   
      <div class="container">
          <div class="row">
               <div class="col-12">
                   <div class="card-body ">
                      <h3 class="mb-4 h2 pb-2 pb-md-0 mb-md-5 px-md-2 text-center bg-secondary text-white"><u>COMPLAINT DETAILS</u></h3>
                   
                      <div class='row'>
                     
                        <div class="col-4"> 
                            <div class="form-outline mb-4 text-center">
                                <label class="form-label" for="date">Date</label>
                                <?php 
                                echo "<input type='text' id='date' readonly class='form-control'  name='date' value='".$date."'/>";
                                ?>
                            </div>
                            </div> 
                        <div class="col-4"> 
                            <div class="form-outline mb-4 text-center">
                                <label class="form-label" for="cNumber">Complaint Number</label>
                                <?php 
                                echo "<input type='text' id='cNumber' readonly class='form-control'  value='".$cNumber."'/>";
                                ?>
                            </div>
                            </div> 
                        <div class="col-4"> 
                            <div class="form-outline mb-4 text-center">
                                <label class="form-label" for="orderid">ORDER ID</label>
                                <?php 
                                echo "<input type='text' id='orderid' readonly class='form-control' name='orderid' value='".$orderid."'/>";
                                ?>
                            </div>
                            </div> 
                       
                      </div> 

                      <div class='row'>
                      <h5 class='mx-2'><u>Complainer Details</u></h5>
                        <div class="col-6"> 
                            <div class="form-outline mb-4 text-center">
                                <label class="form-label" for="Name">Name</label>
                                <?php 
                                echo "<input type='text' id='Name' readonly class='form-control'  name='Name' value='".$name."'/>";
                                ?>
                            </div>
                            </div> 
                        <div class="col-6"> 
                            <div class="form-outline mb-4 text-center">
                                <label class="form-label" for="Number">Number</label>
                                <?php 
                                echo "<input type='text' id='Number' readonly class='form-control'  value='".$number."'/>";
                                ?>
                            </div>
                            </div> 
                      </div> 
                     
                      <hr/>

                      <div class='row'>
                            <div class="col-6"> 
                                <div class="form-outline mb-4 text-center">
                                        <label class="form-label h5" for="issue"><u>Issue</u></label>
                                        <?php
                                        echo "<textarea id='issue' type='text' readonly class='form-control' name='issue' rows='5' cols='50'>".$issue."</textarea>";
                                        ?>
                                </div>
                            </div>
                            <div class="col-6"> 
                                <div class="form-outline mb-4 text-center">
                                        <label class="form-label h5" for="issue"><u>Response</u></label>
                                        <?php
                                        echo "<textarea id='issue' type='text' readonly class='form-control' name='issue' rows='5' cols='50'>".$message."</textarea>";
                                        ?>
                                </div>
                            </div>
                      </div>

                            <div class='d-grid gap-2 col-6 mx-auto mt-2 mb-0 d-flex justify-content-start align-items-start mt-5'>
                                    <button type="button" href='#' style='width:100px;' id="back" name='dack' class="btn btn-info border border-dark mb-1 d-grid gap-2 col-6 mx-auto">Back</button>
                            </div>

                    </div>
                </div>
             
              </div>
          </div>
     
   </div>
  


<?php 
    }
?>

</section>

<script>
    $("#back").click(function() {
        location.href='associate.php?info=complaintList';
    });
    </script>