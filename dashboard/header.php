<?php
date_default_timezone_set("asia/kathmandu");
session_start();
if (isset($_SESSION['adminemail'])) {
    // echo "<hr><hr><hr><hr><hr><h1>".$_SESSION['adminemail']."</h1><hr><hr><hr><hr><hr>";
} else if ($_SESSION['adminemail'] == ''||$_SESSION['adminemail'] !== $_SESSION['adminemail']) {
    echo "<hr><h1>AAAAANNNN".$_SESSION['adminemail']."</h1><hr><hr>";
    echo '<script>    window.location.href = "http://localhost/deli/adminlogin/";</script>';
}else{
    echo "<hr><h1>No thing yr</h1><hr><hr>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Dashboard</title>
     <link rel="icon" type="images/ico" href="favicon.ico">
     <!-- datatable -->
     <!-- datatable -->
     <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    
    <!-- css file  -->
    <!-- <link rel="stylesheet" type="text/css" href="css/select2.min.css" /> -->
    <link rel="stylesheet" type="text/css" href="css/style.css" />

    <!-- jquery script -->
    <!-- jquery script -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- jquery script -->
    <!-- jquery script -->

    <!-- bootstrap cdn -->
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <!-- bootstrap cdn -->
    <!-- bootstrap cdn -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</head>
<?php 
include "library/connect_server.php";
?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background:black; font-size:13px;">

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            Divider
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!--add product and category -->
            <li class="nav-item">
                <a class="nav-link" href="api.php">
                    <i class="bi bi-collection-fill"></i>
                    <span>API</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="product.php">
                    <i class="bi bi-collection-fill"></i>
                    <span>All Product</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="vendor_user.php">
                    <i class="bi bi-collection-fill"></i>
                    <span>Users</span></a>
            </li>

            <!-- Nav Item - checkout -->
            <!-- Nav Item - checkout -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages1"
                    aria-expanded="true" aria-controls="collapsePages1">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Checkout</span>
                </a>
                <div id="collapsePages1" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Checkout</h6>
                        <a class="collapse-item" href="checkout.php">Checkout</a>
                        <a class="collapse-item" href="delivered.php">Delivered List</a>
                    </div>
                </div>
            </li>
            

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->
        <div id="myNotifyElem" style="display: none;"></div>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include "top_navbar.php"; ?>
                <!-- End of Topbar -->