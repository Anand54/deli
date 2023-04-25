<?php 
include '../header.php';
?>
  <form action="#" method="post">
    <div class="row row-cols-1 row-cols-md-2 p-2">
      <div class="col">
        <div class="col-12 text-center">
          <img src="<?php echo BASE_URL; ?>assets/image/vendorLogin/63787-secure-login.gif" class="w-75"><br>
        </div>
      </div>
      <div class="col">
        <div class="col-12 ">

          <div class="col-10 text-center mt-3 m-auto"
            style="padding: 1rem;border-radius: 10px;box-shadow: 0px 0px 10px black;">
            <div class="col-12 fw-bold text-center p-1">
              <span class="fs-1">Vendor Login</span><br>
              <span>Please enter your valid e-mail and password:</span>
            </div>
            <div class="container form-floating mb-3 mt-2 w-100">
              <input type="email" class="form-control ps-4" name="email">
              <label class="ms-4" for="floatingInput">E-mail</label>
            </div>
            <div class="container form-floating w-100">
              <input type="password" class="form-control ps-4" name="password" placeholder="Password">
              <label class="ms-4" for="floatingPassword">Password</label>
            </div>
            <div class="mt-3 container">
              <button type="submit" class="btn col-4" name="req_login"
                style="background:red; color:white">Login</button>
            </div>
            <div class=" mt-3 pb-3">
              <span class="">New Vendor? <a href="<?php echo BASE_URL; ?>vendorRegister/index.php/">Create an Account</a></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>

<?php 
include '../footer.php';
?>
