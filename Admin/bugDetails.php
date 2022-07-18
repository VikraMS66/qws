<section  id="bugDetails" class="pt-5 mx-3 ">

<?php
    $ID = $_SESSION['admin'];

    $query = "SELECT * FROM admin WHERE number='$ID'";
    $results = mysqli_query($conn, $query);
    
    $bugid="";
    $reportedby="";
    $name="";
    $number="";
    $email="";
    $message="";
    $date="";
    $status="";

    if (mysqli_num_rows($results) == 1) {

        while($row=mysqli_fetch_array($results)) {
            $bugid=$row['setid'];
        }

        $query_get = "SELECT * FROM bug WHERE id='$bugid'";
        $results_get = mysqli_query($conn, $query_get);

        if (mysqli_num_rows($results_get) == 1) {
            while($row_get=mysqli_fetch_array($results_get)) {

                $reportedby=$row_get['reportedby'];
                $name=$row_get['name'];
                $number=$row_get['number'];
                $email=$row_get['email'];
                $message=$row_get['message'];
                $date=$row_get['date'];
                $status=$row_get['status'];

            }
        }

   
?>

<div class='text-white '>
   
      <div class="container border border-warning bg-dark">
          <div class="row">
               <div class="col-12">
                   <div class="card-body ">
                      <h3 class="mb-4 h2 pb-2 pb-md-0 mb-md-5 px-md-2 text-center bg-light text-dark">BUG DETAILS</h3>
                   
                      <div class='row'>
                      <h4><u>Bug Details</u></h4>
                        <div class="col-4"> 
                            <div class="form-outline mb-4">
                            <h5>Date: <span id='Password'><?php echo $date; ?></span></h5>
                            </div>
                            </div> 
                        <div class="col-4"> 
                            <div class="form-outline mb-4">
                            <h5>Bug ID: <span id='bugid'><?php echo $bugid; ?></span></h5>
                            </div>
                            </div> 
                        <div class="col-4"> 
                            <div class="form-outline mb-4">
                            <h5>Reported By: <span><?php echo $reportedby; ?></span></h5>
                            </div>
                            </div> 
                       
                      </div> 
                     
                      <hr/>

                      <div class='row'>
                        <h4><u>Repoter Details</u></h4>
                        <div class="col-4"> 
                            <div class="form-outline mb-4">
                            <h5>Name: <span><?php echo $name; ?></span></h5>
                            </div>
                            </div> 
                        <div class="col-4"> 
                            <div class="form-outline mb-4">
                            <h5>Number: <span><?php echo $number; ?></span></h5>
                            </div>
                            </div> 
                        <div class="col-4"> 
                            <div class="form-outline mb-4">
                            <h5>Email: <span><?php echo $email; ?></span></h5>
                            </div>
                            </div> 
                      </div> 

<hr/>
                      <div class='row'>
                        <div class="col-4"> 
                            <div class="form-outline mb-4">
                              <label class="form-label" for="message">Message</label>
                              <textarea type="text" id='message' class="form-control" rows="3" cols="30"><?php echo $message; ?></textarea>
                            </div>
                            </div> 

                        <div class="col-4 mt-5"> 
                            <div class="form-outline mb-4">
                            <h5>Current Status: <span><?php echo $status; ?></span></h5>
                            </div>
                            </div> 

                        <div class="col-4 mt-5"> 
                            <div class="form-outline mb-4 text-center text-dark bg-warning">
                                <label class="form-label h5" for="bugAction">Status</label>
                                <?php 
                                echo "<select class='form-select form-control' id='bugAction' aria-label='Default select example' required='required'>";
                                if($status == 'Registered'){
                                echo "<option value='No'>No Action</option>";
                                echo "<option value='In Process'>In Process</option>";
                                echo "<option value='Closed'>Closed</option>";
                                } else if($status == 'In Process'){
                                echo "<option value='No'>No Action</option>";
                                echo "<option value='Closed'>Closed</option>";
                                } 
                                                        
                                ?> 
                                </select>
                            </div>
                        </div> 
                      </div> 
                      

                            <div class='d-grid gap-2 col-6 mx-auto mt-2 mb-0 d-flex justify-content-start align-items-start mt-5'>
                                    <button type="button" href='#' style='width:100px;' id="submit" name='submit' class="btn btn-light border border-dark mb-1 d-grid gap-2 col-6 mx-auto">SUBMIT</button>
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
    $("#submit").click(function() {
        
        const id = $("#bugid").text();
        const message = $("#message").val();
        const status = $("#bugAction option:selected").val();

        //alert(status);

        if(id.length > 0) {

            $.post(
                'http://localhost:8013/h20app/Admin/updateBugData.php',
                { id: id, message: message, status: status},
                function(id) {
                console.log(id);
                }
            )

            setTimeout(redirectPage, 300);
            function redirectPage(){
                alert("Bug Details Updated!");
            location.href='home.php?info=bug';
            }

          }

    });
    </script>