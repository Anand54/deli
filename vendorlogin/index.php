<?php 
include '../header.php';
?>
<?php
session_start();
?>
  <script src="https://cdn.jsdelivr.net/npm/jquery.session@1.0.0/jquery.session.min.js"></script>
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
              <span class="">New Vendor? <a href="<?php echo BASE_URL; ?>vendorRegister">Create an Account</a></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>

<?php
  // include '../assets/library/library.php';
  if (isset($_POST['req_login'])) {
    $useremail = $_POST['email'];
    $userpassword = trim($_POST['password']);
    $userpassword = md5($userpassword);
    $userpassword = trim($userpassword);

    if ($useremail == "" || $userpassword == "") {
      popMsg("Input filled are empty!! Please fill the form properly.");
    } else {
      $sql = "SELECT IF(EXISTS(SELECT `vendor_email`,`vendor_pass` FROM `vendor_users` WHERE `vendor_email`='$useremail'),1,0) as result;"; //echo $sql;
      $result = check_if_exist($sql);
      if ($result == 0) {
        popMsg("Invalid or incorrect information. Please check and try again.");
      } else if ($result == 1) {
        $srv_email = '';
        $srv_pass = '';
        $myquery = "SELECT  `vendor_email`, `vendor_pass` FROM `vendor_users` WHERE `vendor_email` ='$useremail' and `active_state`='1';"; //echo $myquery;
        $details = get_Table_Data($myquery);
        foreach ($details as $detail) {
          $srv_email = $detail['vendor_email'];
          $srv_pass = trim($detail['vendor_pass']);
        }
        if ($useremail == $srv_email) {
          if ($userpassword == $srv_pass) {
            $_SESSION['session_start_status'] = 'started';
            $_SESSION['vendor_email'] = $useremail;
            $_SESSION['login_status'] = 1;
            echo "success";
            ?><script>window.location.href = "<?php echo BASE_URL; ?>vendor/order_history.php";</script>
 <?php
          } else {
            popMsg("Invalid or incorrect information. Please check and try again.");
          }
        } else {
          popMsg("Invalid or incorrect information. Please check and try again.");
        }
      } else {
        popMsg("Invalid or incorrect information. Please check and try again.");
      }
    }
  }
  ?>

<?php 
include '../footer.php';
?>
