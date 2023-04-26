<?php
session_start();
// echo $_SESSION["adminemail"];
if (isset($_SESSION["adminemail"])) {
    unset($_SESSION["adminemail"]);
    // echo "distroing email";
    // die();
?>
<script>
    window.location.href = 'http://localhost/deli/adminlogin/';
</script>
<?php
}
?>
