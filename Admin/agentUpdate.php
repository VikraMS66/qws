
<section  id="reportBug" class="pt-5 mt-3 text-dark px-5 ">

<?php
    $ID = $_SESSION['admin'];

    $query = "SELECT * FROM admin WHERE number='$ID'";
    $results = mysqli_query($conn, $query);
    
    $agent="";
    $Name="";
    $Email="";
    $Number="";
    $Role="";
    $password="";

    if (mysqli_num_rows($results) == 1) {
        while($row=mysqli_fetch_array($results)) {
            $agent=$row['setid'];
        }

        $query_get = "SELECT * FROM agent WHERE id='$agent'";
        $results_get = mysqli_query($conn, $query_get);

        if (mysqli_num_rows($results_get) == 1) {

            while($row_get=mysqli_fetch_array($results_get)) {

                $Name=$row_get['name'];
                $Email=$row_get['email'];
                $Number=$row_get['number'];
                $Role=$row_get['role'];
                $password=$row_get['password'];
                
            }
        }

    

   
?>



<div class='text-dark'>
   
      <div class="container border border-warning bg-info text-white">
          <div class="row">
               <div class="col-12">
                   <div class="card-body ">
                      <h3 class="mb-4 h2 pb-2 pb-md-0 mb-md-5  text-center bg-light text-dark">AGENT DETAILS</h3>
                   
                      <div class='row'>
                       <div class="col-3"> 
                          <div class="form-outline mb-4">
                          <h5>ID: <span id="agentid"><?php echo $agent; ?></span></h5>
                          </div>
                         </div> 
                       <div class="col-3"> 
                          <div class="form-outline mb-4">
                             <h5>Name: <span><?php echo $Name; ?></span></h5>
                          </div>
                         </div> 
                       <div class="col-3"> 
                          <div class="form-outline mb-4">
                          <h5>Number: <span><?php echo $Number; ?></span></h5>
                          </div>
                         </div> 
                       <div class="col-3"> 
                          <div class="form-outline mb-4">
                          <h5>Email: <span><?php echo $Email; ?></span></h5>
                          </div>
                         </div> 
                      </div> 
<hr/>
                      <div class='row'>
                       <div class="col-6"> 
                          <div class="form-outline mb-4">
                          <h5>Password: <span id='Password'><?php echo $password; ?></span></h5>
                          </div>
                         </div> 
                      

                       <div class="col-6"> 
                          <div class="form-outline mb-4">
                          <button type="button" href='#'  id="generatePass" name='generatePass' class="btn btn-success border border-dark mb-1 d-grid gap-2 col-6 mx-auto">Generate & Update Password</button>
                          </div>
                         </div> 
                    </div> 
<hr/>
                      <div class='row'>

                        <div class="col-6"> 
                            <div class="form-outline mb-4">
                            <h5>Current Role Status: <span><?php echo $Role; ?></span></h5>
                            </div>
                            </div> 

                            <div class="col-6"> 
                            <div class="form-outline mb-4 text-center text-dark bg-warning">
                                            <label class="form-label h5" for="roleAction">New Role Status</label>
                                                <?php 
                                                    echo "<select class='form-select form-control' id='roleAction' aria-label='Default select example' required='required'>";
                                                            if($Role == 'Associate'){
                                                            echo "<option value='No'>No Action</option>";
                                                            echo "<option value='Manager'>Manager</option>";
                                                            echo "<option value='Blocked'>Block</option>";
                                                            } else if($Role == 'Manager'){
                                                                echo "<option value='No'>No Action</option>";
                                                                echo "<option value='Blocked'>Block</option>";
                                                            } else if($Role == 'Blocked') {
                                                                echo "<option value='No'>No Action</option>";
                                                                echo "<option value='Associate'>Associate</option>";
                                                                echo "<option value='Manager'>Manager</option>";
                                                            }
                                                        
                                                        ?> 
                                                </select>
                                            </div>
                            </div> 
                    </div>

                      <p class='bg-warning text-dark'>Note: Generate and Update Password will generate new password and update in agent profile. Save will update only the role of agent in profile.</p>

                       <div class='d-grid gap-2 col-6 mx-auto mt-2 mb-0 d-flex justify-content-center align-items-center mt-5'>
                              <button type="button" href='#' style='width:100px;' id="updateRole" name='updateRole' class="btn btn-dark border border-dark mb-1 d-grid gap-2 col-6 mx-auto">Save</button>
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

        $("#generatePass").click(function() {

            var agentid = $("#agentid").text();
            var newPass = generateP();
            
            if(agentid > 0) {
                   if(newPass.length > 5) {

                    $.post(
                        'http://localhost:8013/h20app/Admin/agentPassChange.php',
                        { id: agentid, pass: newPass},
                        function(id) {
                        console.log(id);
                        }
                    )

                    setTimeout(reloadPage, 300);

                    function reloadPage(){
                    alert("Password Changed!")
                    location.reload();
                    }
                        
                   } else {
                    alert("Password Generation Failed! Try Again")
                   }
            } else {
                alert("Invalid Agent Data");
            }
           
        });

        $("#updateRole").click(function() {
          
           var id = $("#agentid").text();
           var newRole = $("#roleAction option:selected").val();
           //alert(newRole);

           if(newRole === 'No'){

           } else {

           $.post(
                'http://localhost:8013/h20app/Admin/changeAgentStatus.php',
                { id: id, status: newRole},
                function(id) {
                console.log(id);
                }
            )
            

            setTimeout(reloadPage, 300);
                function reloadPage(){
                 alert("Agent Role Status Changed to " + newRole);
                 location.href='home.php?info=agent';
                }
           }

            

            

        });


        function generateP() {
            var pass = '';
            var str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' + 
                    'abcdefghijklmnopqrstuvwxyz0123456789@#$';
              
            for (let i = 1; i<=8; i++) {
                var char = Math.floor(Math.random()
                            * str.length + 1);
                  
                pass += str.charAt(char);
                if(pass.length == 6){
                    break;
                }
            }
              
            return pass;
        }

    </script>