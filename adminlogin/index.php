 <?php 
 include '../header.php';
//  include '../header.php';
 ?> 
<?php
session_start();
?>
  <form action="#" method="post" style="background-color: white;">
    <div class="row row-cols-1 row-cols-md-2 p-2">
        <div class="col">
            <div class="col-12 text-center">
                <img src="<?php echo BASE_URL; ?>assets/image/adminLogin/38435-register.gif" class="w-75"><br>
            </div>
        </div>
        <div class="col">
            <div class="col-12">
                <div class="col-10 text-center mt-3 m-auto"
                    style="padding: 1rem;border-radius: 10px;box-shadow: 0px 0px 10px black;">
                    <div class="col-12 fw-bold text-center p-1">
                        <span class="fs-1">Admin Login</span><br>
                        <span>Welcome back !!</span>
                    </div>
                    <div class="container form-floating mb-3 mt-2 w-100">
                        <input type="email" class="form-control ps-2" name="email" >
                        <label class="ms-4" for="floatingInput">E-mail</label>
                    </div>
                    <div class="container form-floating w-100">
                        <input type="password" class="form-control ps-2" name="pass" >
                        <label class="ms-4" for="floatingPassword">Password</label>
                    </div>
                    <div class="mt-3 container">
                        <button type="submit" class="btn col-4" name="adminSubmit"
                            style="background:red; color:white">Login</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?php

if (isset($_POST["adminSubmit"])) {
    $email = $_POST['email'];
    $pass = trim($_POST['pass']);
    if ($email == "" || $pass == "") {
        popMsg('Input filled are empty!! Please fill the form properly.');
    } else {
        $myquery = "SELECT IF ( EXISTS (SELECT `email`,`admin_pass` FROM `admin` WHERE email='$email' and admin_pass='$pass' and `active_state`=1),1,0)as result;";
        $md5Pass = md5($pass);
        $myquery2 = "SELECT IF ( EXISTS (SELECT `email`,`admin_pass` FROM `admin` WHERE email='$email' and admin_pass='$md5Pass' and `active_state`=1),1,0)as result;";
        $req1 = check_if_exist($myquery);// echo "req1 :".$req1; 
        $req2 = check_if_exist($myquery2);// echo "req1 :".$req1;
        if ($req1 == 1 || $req2==1) {
            $_SESSION['adminemail'] = $email;
           ?>
           <script>window.location.href = "<?php echo BASE_URL; ?>Dashboard/"</script>'
           <?php
        } else {
            popMsg("Invalid or incorrect information. Please check and try again.");
            ?>
<script></script>
<?php
        }
    }
}
?>

 <?php 
 include '../footer.php';
 ?> 
