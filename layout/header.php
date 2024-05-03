<?php
    session_start();
    // NOT LOGGED IN
    if($_SESSION['login']!="yes"){
        header("location:login.php");
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

    <title>MPI BUSINESS SYSTEM</title>
    <link rel="icon" href="img/logo.png" sizes="32x32">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/font.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/toast.css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-text mx-3">BUSINESS <span style="font-size: 8px;">v1.1.0</span></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Home</span></a>
            </li>
            <?php
            
            $role = $_SESSION['role'];

            $menuMaster = '<a class="collapse-item" href="data_master.php">Data Master</a>';
            $menuAlamat = '<a class="collapse-item" href="data_alamat.php">Data Alamat</a>';
            $menuUser = '<a class="collapse-item" href="data_user.php">Data User</a>';
            $menuSummary = '<a class="nav-link" href="data_summary.php"><i class="fas fa-fw fa-upload"></i><span>Summary</span></a>';
            $menuPacking = '<a class="nav-link" href="data_packing.php"><i class="fas fa-fw fa-upload"></i><span>Packing List</span></a>';
            $menuShipping = '<a class="nav-link" href="output.php"><i class="fas fa-fw fa-download"></i><span>Data Shipping Mark</span></a>';
            $menuInvoice = '<a class="nav-link" href="data_invoice.php"><i class="fas fa-fw fa-credit-card"></i><span>Data Invoice</span></a>';
            $menuInvoice1 = '<a class="nav-link" href="data_invoice1.php"><i class="fas fa-fw fa-credit-card"></i><span>Data Invoice</span></a>';
            $menuCarton = '<a class="nav-link" href="total_carton.php"><i class="fas fa-fw fa-download"></i><span>Total Carton</span></a>';
            $menuPurchase = '<a class="nav-link" href="data_purchase.php"><i class="fas fa-fw fa-archive"></i><span>Purchase Order</span></a>';
            $menuBooking = '<a class="nav-link" href="data_booking.php"><i class="fas fa-fw fa-book"></i><span>Booking Container</span></a>';
            $menuMeas = '<a class="nav-link" href="meas_side_mark.php"><i class="fas fa-fw fa-book"></i><span>Meas Side Mark</span></a>';
            $menuGrade = '<a class="nav-link" href="menugrade.php"><i class="fas fa-fw fa-book"></i><span>Grade Option</span></a>';
	    $mlt = '<a class="nav-link" href="data_mlt.php"><i class="fas fa-fw fa-book"></i><span>Data MLT</span></a>';	    

            if ($role == 1) {
                //Nav Item - Data Master
                echo    '<li class="nav-item">
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#datamaster" aria-expanded="true" aria-controls="datamaster">
                                <i class="fas fa-fw fa-database"></i>
                                    <span>Data Master</span>
                            </a>
                            <div id="datamaster" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                                <div class="bg-white py-2 collapse-inner rounded">
                                    '.$menuMaster.'
                                    '.$menuUser.'
                                </div>
                            </div>
                        </li>';

                // Divider
                echo    '<hr class="sidebar-divider">';

                // Heading
                echo    '<div class="sidebar-heading">INPUT</div>';

                // Nav Item - Output Summary
                echo    '<li class="nav-item">
                            '.$menuSummary.'
                        </li>';

                // Nav Item - Output Packing List
                echo    '<li class="nav-item">
                            '.$menuPacking.'
                        </li>';

                // Divider
                echo    '<hr class="sidebar-divider">';

                // Heading
                echo    '<div class="sidebar-heading">
                            OUTPUT
                        </div>';

                // Nav Item - Output Packing List
                echo    '<li class="nav-item">
                            '.$menuShipping.'
                        </li>';

                echo    '<li class="nav-item">
                            '.$menuMeas.'
                        </li>';

                echo    '<li class="nav-item">
                        '.$menuBooking.'
                        </li>';
                
                echo    '<li class="nav-item">
                        '.$menuInvoice.'
                        </li>';

                echo    '<li class="nav-item">
                        '.$menuPurchase.'
                        </li>';

                echo    '<li class="nav-item">
                        '.$menuCarton.'
                        </li>';
                echo    '<li class="nav-item">
                        '.$menuGrade.'
                        </li>';
		echo    '<li class="nav-item">
                        '.$mlt.'
                        </li>';
            }

            if ($role == 2) {
                //Nav Item - Data Master
                echo    '<li class="nav-item">
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#datamaster" aria-expanded="true" aria-controls="datamaster">
                                <i class="fas fa-fw fa-database"></i>
                                    <span>Data Master</span>
                            </a>
                            <div id="datamaster" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                                <div class="bg-white py-2 collapse-inner rounded">
                                    '.$menuMaster.'
                                    '.$menuAlamat.'
                                </div>
                            </div>
                        </li>';

                // Divider
                echo    '<hr class="sidebar-divider">';

                // Heading
                echo    '<div class="sidebar-heading">INPUT</div>';

                // Nav Item - Output Summary
                echo    '<li class="nav-item">
                            '.$menuSummary.'
                        </li>';

                // Nav Item - Output Packing List
                echo    '<li class="nav-item">
                            '.$menuPacking.'
                        </li>';

                // Divider
                echo    '<hr class="sidebar-divider">';

                // Heading
                echo    '<div class="sidebar-heading">
                            OUTPUT
                        </div>';

                // Nav Item - Output Packing List
                echo    '<li class="nav-item">
                            '.$menuShipping.'
                        </li>';
                        
                echo    '<li class="nav-item">
                            '.$menuMeas.'
                        </li>';
                        
                echo    '<li class="nav-item">
                        '.$menuBooking.'
                        </li>';
                
                echo    '<li class="nav-item">
                        '.$menuCarton.'
                        </li>';

                echo    '<li class="nav-item">
                        '.$menuPurchase.'
                        </li>';
            }

            if ($role == 3) {
                //Nav Item - Data Master
                echo    '<li class="nav-item">
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#datamaster" aria-expanded="true" aria-controls="datamaster">
                                <i class="fas fa-fw fa-database"></i>
                                    <span>Data Master</span>
                            </a>
                            <div id="datamaster" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                                <div class="bg-white py-2 collapse-inner rounded">
                                    '.$menuMaster.'
                                    '.$menuAlamat.'
                                </div>
                            </div>
                        </li>';

                // Divider
                echo    '<hr class="sidebar-divider">';

                // Heading
                echo    '<div class="sidebar-heading">INPUT</div>';

                // Nav Item - Output Summary
                echo    '<li class="nav-item">
                            '.$menuSummary.'
                        </li>';

                // Nav Item - Output Packing List
                echo    '<li class="nav-item">
                            '.$menuPacking.'
                        </li>';

                // Divider
                echo    '<hr class="sidebar-divider">';

                // Heading
                echo    '<div class="sidebar-heading">
                            OUTPUT
                        </div>';

                // Nav Item - Output Packing List
                echo    '<li class="nav-item">
                            '.$menuShipping.'
                        </li>';
                        
                echo    '<li class="nav-item">
                        '.$menuBooking.'
                        </li>';

                // Nav Item - Output Packing List
                echo    '<li class="nav-item">
                        '.$menuInvoice.'
                        </li>';

            }
            if ($role == 4) {
                //Nav Item - Data Master
                echo    '<li class="nav-item">
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#datamaster" aria-expanded="true" aria-controls="datamaster">
                                <i class="fas fa-fw fa-database"></i>
                                    <span>Data Master</span>
                            </a>
                            <div id="datamaster" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                                <div class="bg-white py-2 collapse-inner rounded">
                                    '.$menuMaster.'
                                    '.$menuAlamat.'
                                </div>
                            </div>
                        </li>';

                // Divider
                echo    '<hr class="sidebar-divider">';

                // Heading
                echo    '<div class="sidebar-heading">INPUT</div>';

                // Nav Item - Output Summary
                echo    '<li class="nav-item">
                            '.$menuSummary.'
                        </li>';

                // Nav Item - Output Packing List
                echo    '<li class="nav-item">
                            '.$menuPacking.'
                        </li>';

                // Divider
                echo    '<hr class="sidebar-divider">';

                // Heading
                echo    '<div class="sidebar-heading">
                            OUTPUT
                        </div>';

                // Nav Item - Output Packing List
                echo    '<li class="nav-item">
                            '.$menuShipping.'
                        </li>';
                
                echo    '<li class="nav-item">
                        '.$menuCarton.'
                        </li>';

                // Nav Item - Output Packing List
                echo    '<li class="nav-item">
                '.$menuInvoice1.'
                </li>';
            }
            ?>
            <li class="nav-item">
                <a class="nav-link" href="shipping_notice.php">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Shipping Notice</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- <div>
                <span style=" font-size : 14px; color : red;"><strong><marquee behavior="alternate" direction="right">FYI : Data Summary Dapat Di Edit Dan Upload Packing ada 2 Opsi ( Solid dan Prepack) Untuk sementara Prepack Masih Belum Dapat di Gunakan. Terimakasih..</marquee></strong></span>
            </div> -->
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><strong style="font-size: 12px; text-transform: uppercase;"><?= $_SESSION['username']; ?></strong></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="functions/logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->