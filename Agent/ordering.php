<section  id="customers" class="pt-5 mx-3">
       <div class="mt-4">
            <form method='post' action='associate.php?info=search_supply'>
                    <div class="input-group text-center mx-3 mb-2" style="width:300px;">
                        <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onkeypress="return onlyNumberKey(event)" name="number"  id="number" type="text" class="form-control rounded"  maxlength="6" minlength="6" placeholder="Enter Pincode"/>
                        <button type="submit" id="searchSupply" class="mx-2 btn btn-outline-dark text-white rounded">Search</button>
                    </div>
            </form>
        </div>
</section>
<script>
     function onlyNumberKey(evt) {
          // Only ASCII character in that range allowed
          var ASCIICode = evt.which ? evt.which : evt.keyCode;
          if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) return false;
          return true;
        }
</script>