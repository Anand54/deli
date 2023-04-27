<?php
include "base_url.php";
session_start();
// echo $_SESSION["adminemail"];
if (isset($_SESSION["vendor_email"])) {
    unset($_SESSION["vendor_email"]);
    // die();
?>
<script>
    window.location.href = '<?php echo BASE_URL ?>';
</script>
<?php
}
?>