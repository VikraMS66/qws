
<section  id="reportBug" class="pt-5 mt-3 px-5 text-white">

<div class=''>
   
      <div class="container bg-info">
          <div class="row">
               <div class="col-12">
                   <div class="card-body">
                      <h3 class="mb-4 h2 pb-2 pb-md-0 mb-md-5 px-md-2 text-center bg-light text-dark">ADD NEW AGNET</h3>
                   
                      <div class='row'>
                       <div class="col-4"> 
                          <div class="form-outline mb-4">
                              <label class="form-label" for="name">Name</label>
                              <input type='text' id='name'class='form-control' maxlength='20' minlength='1' name='name' require='required'/>
                             
                          </div>
                         </div> 
                       <div class="col-4"> 
                          <div class="form-outline mb-4">
                              <label class="form-label" for="number">Number</label>
                              <input type='text' oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onkeypress="return onlyNumberKey(event)" id='number'class='form-control' maxlength='10' minlength='10' name='number' require='required'/>
                          </div>
                         </div> 
                       <div class="col-4"> 
                          <div class="form-outline mb-4">
                              <label class="form-label" for="email">Email</label>
                              <input type='email' id='email'class='form-control' maxlength='50' minlength='1' name='email' require='required'/>
                          </div>
                         </div> 
                      </div> 

                      <div class='row'>
                       
                        <div class="col-6"> 
                            <div class="form-outline bg-light text-success mb-4 border border-warning">
                               <h3>Password: <span id='Password'>password</span></h3>
                            </div>
                        </div>
                     
                            <div class="col-6"> 
                                <div class="form-outline mb-4 text-center text-dark bg-warning pt-2">
                                    <label class="form-label h5" for="roleAction">Select Role</label>
                                    <select class='form-select form-control' id='roleAction' aria-label='Default select example' required='required'>   
                                    <option value='Associate'>Associate</option>
                                    <option value='Manager'>Manager</option>
                                    </select>
                                </div>
                            </div>
                         </div> 
                      

                      <div class='d-grid gap-2 col-6 mx-auto mt-2 mb-0 d-flex justify-content-center align-items-center mt-5'>
                              <button type="button" href='#' style='width:100px;' id="addAgent" name='addAgent' class="btn btn-dark border border-dark mb-1 d-grid gap-2 col-6 mx-auto">ADD AGENT</button>
                      </div>

                    </div>
                </div>
             
              </div>
          </div>
     
   </div>
  
        
 </section>
 <script>
           
           $(document).ready(function() {
    
            const password = generateP();
             
            $("#Password").text(password);
             
             });


        $("#addAgent").click(function() {

            var number = $("#number").val();
            var name = $("#name").val();
            var email = $("#email").val();
            var role = $("#roleAction option:selected").val();
            var password = $("#Password").text();
            
            
            //alert(number);
            //alert(pass);
 
             if(number.length === 10 ) {

             if(name.length > 0) {

                if(email.length > 0) {

                    $.post(
                        'http://localhost:8013/h20app/Admin/addAgentData.php',
                        { number: number, name: name, email: email, role: role, password: password },
                            function(number) {
                            console.log(number);
                        }
                        )

                        alert("Agent Added Successfully");

                        location.href='home.php?info=agent';

                } else {

                    alert("Email required!");
                }

                } else {

                    alert("Name Required!");

                }

             } else {
                alert("Invalid Number!");
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

        function onlyNumberKey(evt) {
          // Only ASCII character in that range allowed
          var ASCIICode = evt.which ? evt.which : evt.keyCode;
          if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) return false;
          return true;
        }

    </script>