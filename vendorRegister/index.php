 <?php
   include '../header.php'
  ?>
 <form action="#" method="post" class="mb-2">
    <div class="row row-cols-1 row-cols-md-2">
      <div class="col">
        <div class="col-12 text-center">
          <img src="<?php echo BASE_URL; ?>assets/image/vendorRegister/54483-vender-por-redes.gif" class="w-75"><br>
        </div>
      </div>
      <div class="col">
        <div class="col-12 ">

          <div class="col-11 text-center mb-3 mt-3 m-auto"
            style="padding: 1rem;border-radius: 10px;box-shadow: 0px 0px 10px black;" >
      
            <div class="col-12 fw-bold text-center p-1">
              <span class="fs-1">Vendor Register</span><br>
              <span>Please enter your valid Details:</span>
            </div>
                <div id="reggap" style="padding:10px;">
            <div class="row" id="registermain"  style="padding:10px;">
             
            <div class="col form-floating"  style="padding:10px;">
              <input type="text" class="form-control ps-4" name="companyname" id="companyname" placeholder="Company">
              <label class="ms-4" for="floatingInput">Company</label>
            </div>
            </div>
            <div class=" row " id="registermain" style="padding:10px;">
            <div class="col  form-floating   ">
              <input type="text" class="form-control ps-4" name="pan" id="panno" placeholder="PAN" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
              <label class="ms-4" for="floatingInput">PAN</label>
            </div>
            <div class="col form-floating  ">
              <input type="text" class="form-control ps-4" name="vat" id="Vatno" placeholder="VAT" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
              <label class="ms-4" for="floatingInput">VAT</label>
            </div>
            </div>
             <div class=" row   " id="registermain"  style="padding:10px;">
            <div class="col form-floating  ">
              <input type="email" class="form-control ps-4" id="vEmail" name="email" placeholder="E-mail">
              <label class="ms-4" for="floatingInput">E-mail</label>
            </div>
            <div class="col form-floating ">
              <input type="text" class="form-control ps-4 onlyNum" id="phone" name="phone" placeholder="Phone" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
              <label class="ms-4" for="floatingphone">Phone</label>
            </div>
            </div>
            <div class=" row" id="registermain"  style="padding:10px;">
            <div class="col form-floating ">
              <input type="password" class="form-control ps-4" name="password" id="password" placeholder="Password">
              <label class="ms-4" for="floatingPassword">Password</label>
            </div>
            <div class="col form-floating">
                <select class="form-select" id="province" aria-label="Default select example">
                    <?php
                      $query = "SELECT DISTINCT `province` FROM `address`;";
                      $conn = dbConnecting();
                      $req = mysqli_query($conn, $query) or die(mysqli_error($conn));
                      if (mysqli_num_rows($req) > 0) {
                        while ($data = mysqli_fetch_assoc($req)) {
                        $province = $data["province"]; ?>
                        <option value="<?Php echo $province; ?>">
                           <?Php echo $province; ?>
                        </option>
                    <?php
                      }
                    } 
                    ?>
                </select> 
                <label class="ms-4" for="province">Province</label>
                </div>
            </div>
            <div class=" row  " id="registermain"  style="padding:10px;">
            <div class="col form-floating ">
            <select class="form-select" id="district" name="district" aria-label="Default select example">
            </select> 
            <label class="ms-4" for="floatingPassword">District</label>
            </div>
              <div class="col form-floating ">
             <select class="form-select" id="municipality" name="municipality" aria-label="Default select example">
             </select> 
            <label class="ms-4" for="floatingPassword">Municipality</label>
              </div>
            </div>
            <div class="mt-3 " id="registermain"  style="padding:10px;">
              <button type="button" class="btn col-4" id="Submitbtn" name="Submitbtn"
                style="background:red; color:white">Request</button>
            </div>
            <div class=" mt-3 pb-3" id="registermain"  style="padding:10px;">
              <span class="">Already have account ? <a href="<?php echo BASE_URL; ?>vendorlogin/index.php/">Login</a></span>
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>
  </form>

<script>
  $(document).ready(function(){

          $("#Submitbtn").click(function(){
           var  company_name = $("#companyname").val();
            var  venEmail = $("#vEmail").val();
             var  Password = $("#password").val();
              var  Vatno = $("#Vatno").val();
               var  panno = $("#panno").val();
                var  contact = $("#phone").val();
                 var  province = $("#province").val();
                 var  district = $("#district").val();
                 var  municipality = $("#municipality").val();
                 var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
        
                 if(company_name==""||venEmail==""||Password==""||contact==""||district==""||municipality==""){
                     alert("Please fill the form properly");
                 }
                 else if(!pattern.test(venEmail))
                    {
                      alert('Not a valid e-mail address');
                    }
                 else if(Vatno=='' && panno ==''){
                     alert("Please enter pan or vat no.");
                 }
                 else{
                $.ajax({
                type: 'POST',
                url: '../assets/library/create_vendor_control.php',
                data: { register_vendor_user: company_name,venEmail:venEmail,Password:Password,Vatno:Vatno,panno:panno,contact:contact,province:province,district:district,municipality:municipality},
                success: function (data) {
                    // console.log(data);
                    var da = JSON.parse(data);
                    if(da.status_code==200){
                        alert("Vendor register request send. Please Wait for the conformation. Please Check your email. Thank you !! ");
                        location.reload();
                    }else{
                        alert("Unable to create vendor");
                    }
                }
            }); 
          }  
        });

          $("#province").change(function () {
            var province = $(this).val();
            alert(province);
            $.ajax({
                type: 'POST',
                url: '../assets/library/create_vendor_control.php',
                data: { give_district_from_server: province },
                success: function (data) {
                    var da = JSON.parse(data);
                    if (da.status_code == '200') {
                        $("#district").empty();
                        $("#district").append('<option value="">Choose..</option>');
                        jQuery.each(da.address, function (i, district) {
                            var dis = district.district;
                            dis = dis.toUpperCase();
                            $("#district").append('<option value="' + dis + '" >' + dis + '</option>');
                        });
                    }
                    else {
                        $("#district").empty();
                        $("#district").append('<option value="">Choose..</option>');
                    }
                }
            });
        });

        $("#district").change(function () {
            var district = $(this).val();
            $.ajax({
                type: 'POST',
                url: '../assets/library/create_vendor_control.php',
                data: { give_municipality_from_server: district },
                success: function (data) {
                    // console.log(data);
                    var da = JSON.parse(data);
                    if (da.status_code == '200') {
                        $("#municipality").empty();
                        $("#municipality").append('<option value="">Choose..</option>');
                        jQuery.each(da.address, function (i, municipality) {
                            var muni = municipality.municipality;
                            muni = muni.toUpperCase();
                            $("#municipality").append('<option value="' + muni + '" >' + muni + '</option>');
                        });
                    }
                    else {
                        $("#municipality").empty();
                        $("#municipality").append('<option value="">Choose..</option>');
                    }
                }
            });
        });

  $("#selectType").click(function(){
             $(".selectOption").hide(); 
          });
          
          $(".onlyNum").filter(function(value) {
            return /^\d*$/.test(value);    // Allow digits only, using a RegExp
          },"Only digits allowed");
          
          //select either vat or pan
        $("#panno").focusout(function(){
            var len = $(this).val().length;
            if(len>0){
              $("#Vatno").attr('disabled','disabled');    
            }
            else{
                 $("#Vatno").removeAttr('disabled'); 
            }
        });
        
        $("#Vatno").focusout(function(){
            var len = $(this).val().length;
            if(len>0){
              $("#panno").attr('disabled','disabled');    
            }
            else{
                 $("#panno").removeAttr('disabled'); 
            }
        });
  });
</script>
<?php
   include '../footer.php'
  ?>
 