<?php
 
 //include("auth.php");
 require('db.php');

 $errors = array();


 if (isset($_POST['selectedOrder'])) {
  
  

   $id =  mysqli_real_escape_string($conn, $_POST['orderId']);;

   $query="SELECT * FROM orders where id='$id'";
   $results=mysqli_query($conn, $query);

      if (mysqli_num_rows($results) == 1) {

        while($row=mysqli_fetch_array($results)) {

   ?>

    <div class="bg-white text-dark mt-5 pt-5 orderDetails my-5" style="width:50%; background: #ddd3;">
    <div class="mx-5"> 
     <div class="row">
      <div class="col-6">
      <div class="title">Purchase Reciept</div>
      </div>
      <div class="col-6  pb-1">
        <?php 
        if($row['status'] === 'Delivered') {
          if($row['rating'] === '0'){
            echo "<div class='bg-dark text-white'>";
            echo "<p class=''>1: Worst - 2: Bad - 3: Average - 4: Good - 5: Great</p>";
            echo "<input oninput='javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);' onkeypress='return onlyNumberKey(event)' id='rating' style='width:40px; height:35px;' max='5' min='1' maxlength='1' minlength='1' class='mx-1 mr-3' type='number' required='required'/>";
            echo "<button id='submitFeedback' style='width:80px; height:35px;' type='submit' class='bg-dark border-info rounded text-white' onclick='submitRating()'>Submit</button>";
            echo "</div>";
          } else {
            echo "<div class='title bg-white'>Rating: ".$row['rating']."</div>";
          }
        }
        ?>
      </div>
    </div>
      <div class="info">
        <div class="row">
          <div class="col-6">
            <span id="heading">Date:</span>
            <?php
            echo "<span id='details'>".$row['date']."</span>";
            ?>
          </div>
          <div class="col-6">
            <span id="heading">Order No.</span>
            <?php
            echo "<span id='details' class='orderid'>".$row['id']."</span>";
            ?>
          </div>
        </div>
      </div>
      <div class="pricing">
        <div class="row">
          <div class="col-7">
            <?php 
            echo "<span id='name'>".$row['product']." Litter Water</span>";
            ?>
          </div>
          <div class="col-5">
            
            <?php
            echo "<span id='price'>Supplier Name: ".$row['supName']."</span>";
            ?>
          </div>
        </div>
        <div class="row">
          <div class="col-7">
            <span id="name"></span>
          </div>
          <div class="col-5">
            <?php 
            echo "<span id='price'>Supplier No. ".$row['supNumber']." </span>";
            ?>
          </div>
        </div>
      </div>
      <hr />
      <div class="title mb-2">Delivery Address</div>
      <div class="pricing">
        <div class="row">
          <div class="col-8">
            <?php
            echo "<span id='name'>".$row['custName']."</span>";
            ?>
          </div>
          <div class="col-4">
            <?php
            echo "<span id='price'>No. ".$row['custNumber']."</span>";
            ?>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <?php
            echo "<span id='name'>Address: ".$row['address']." - ".$row['pincode']." - ".$row['gCode']."</span>"
            ?>
          </div>
        </div>
      </div>
      <div class="total">
        <div class="row">
          <div class="col-6"></div>
          <div class="col-6">
            <?php
              echo "<h3>Amount Rs. &#8377; ".$row['amount']."</h3>"
            ?>
          </div>
        </div>
      </div>
      <div class="tracking">
      <div class="tracking">
                <div class="title">Tracking Order</div>
            </div>
      </div>
      <div class="progress-track">
        <ul id="progressbar">
          <li class='step0 <?php if($row['status'] == 'Placed' || $row['status'] == 'OnWay' || $row['status'] == 'Cancelled' || $row['status'] == 'Delivered') { ?> active <?php } ?>' id="step1">Ordered</li>
          <li class='step0 <?php if($row['status'] == 'OnWay' || $row['status'] == 'Delivered' || $row['status'] == 'Cancelled') { ?> active <?php } ?> text-right' id="step2">On the way</li>
          <li class='step0 <?php if($row['status'] == 'Delivered' || $row['status'] == 'Cancelled') { ?> active <?php } ?> text-right' id="step3">Delivered</li>
          <?php if($row['status'] == 'Cancelled')
           echo "<li class='step0 active text-right' id='step4'>Cancelled</li>";
          ?>
        </ul>
      </div>
      <div class="footer">
        <div class="row">
          <div class="col-2">
            <img class="img-fluid" src="https://i.imgur.com/YBWc55P.png" />
          </div>
          <div class="col-10">
            Want any help? Please &nbsp;<a href="cHomePage.php?info=help"> contact us</a>
          </div>
        </div>
      </div>
        </div>

                 

    </div>
   
  </body>
</html>

<?php 
}
}
} 
?>

<script> 
     function submitRating() {
               //alert("hello");
                 var value = $("#rating").val();
                 //value = parseInt(value);
                 //alert(value);
                 var id = $('.orderid').text();
                  
                 
                      
                if(value > 0 && value < 6) {
                    $.post(
                        'http://localhost:8013/h20app/Customer/ratingSubmit.php',
                        { id: id, rating: value, },
                         function(data) {
                          console.log(data);
                         //alert('Rating Submitted.');

                         setTimeout(loadingAgain, 300);
                          function loadingAgain(){
                            alert('Rating Submitted!');
                          location.reload();
                   }
                        }
                      );
                  } else {
                    alert('Submited invalid rating. Please input number between 1 to 5');
                     }
                 }
  
        function onlyNumberKey(evt) {
          // Only ASCII character in that range allowed
          var ASCIICode = evt.which ? evt.which : evt.keyCode;
          if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) return false;
          return true;
        }

          
</script>
