 <form action="#" method="post" class="mb-2">
    <div class="row row-cols-1 row-cols-md-2">
      <div class="col">
        <div class="col-12 text-center">
          <img src="http://delinepal.com/assets/images/Account/54483-vender-por-redes.gif" class="w-75"><br>
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
                <div id="reggap">
            <div class=" row    " id="registermain">
                <!--<div class="col form-floating   ">-->
                <!--    <select class="form-select" id="selectType" aria-label="Default select example">-->
                <!--      <option class="selectOption">--SELECT--</option>-->
                <!--      <option value="Dealer">Dealer</option>-->
                <!--      <option value="Wholesaler">Wholesaler</option>-->
                <!--      <option value="Retailer">Retailer</option>-->
                <!--    </select>   -->
                <!--</div>-->
            <div class="col form-floating   ">
              <input type="text" class="form-control ps-4" name="companyname" id="companyname" placeholder="Company">
              <label class="ms-4" for="floatingInput">Company</label>
            </div>
            </div>
            <div class=" row " id="registermain">
            <div class="col  form-floating   ">
              <input type="text" class="form-control ps-4" name="pan" id="panno" placeholder="PAN" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
              <label class="ms-4" for="floatingInput">PAN</label>
            </div>
            <div class="col form-floating  ">
              <input type="text" class="form-control ps-4" name="vat" id="Vatno" placeholder="VAT" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
              <label class="ms-4" for="floatingInput">VAT</label>
            </div>
            </div>
             <div class=" row   " id="registermain">
            <div class="col form-floating  ">
              <input type="email" class="form-control ps-4" id="vEmail" name="email" placeholder="E-mail">
              <label class="ms-4" for="floatingInput">E-mail</label>
            </div>
            <div class="col form-floating ">
              <input type="text" class="form-control ps-4 onlyNum" id="phone" name="phone" placeholder="Phone" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
              <label class="ms-4" for="floatingPassword">Phone</label>
            </div>
            </div>
            <div class=" row" id="registermain">
            <div class="col form-floating ">
              <input type="password" class="form-control ps-4" name="password" id="password" placeholder="Password">
              <label class="ms-4" for="floatingPassword">Password</label>
            </div>
            <div class="col form-floating">
                <select class="form-select" id="province" aria-label="Default select example">
                    <?php
                                        $query = "SELECT DISTINCT `province` FROM `address`;";
                                        // $conn = connectDB();
                                        $req = mysqli_query($conn, $query) or die(mysqli_error($conn));
                                        if (mysqli_num_rows($req) > 0) {
                                            while ($data = mysqli_fetch_assoc($req)) {
                                                $province = $data["province"]; ?>
                                        <option value="<?Php echo $province; ?>">
                                            <?Php echo $province; ?>
                                        </option>
                                        <?php
                                            }
                                        } ?>
                </select> 
                <label class="ms-4" for="province">Province</label>
                </div>
            </div>
            <div class=" row  " id="registermain">
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
            <div class="mt-3 " id="registermain">
              <button type="button" class="btn col-4" id="Submitbtn" name="Submitbtn"
                style="background:red; color:white">Request</button>
            </div>
            <div class=" mt-3 pb-3" id="registermain">
              <span class="">Already have account ? <a href="../vendor_login/">Login</a></span>
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>
  </form>
