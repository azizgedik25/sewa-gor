<?php
error_reporting(0);
session_start();
$level =$_SESSION['level'];
?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Halaman Dashboard Daftar Lapangan">
        <meta name="author" content="Heru Pralambang Indra Irawan">

        <link rel="shortcut icon" href="assets/images/favicon_1.ico">

        <title>E-booking GOR Bojonegoro</title>

        <link href="assets/plugins/jquery-circliful/css/jquery.circliful.css" rel="stylesheet" type="text/css" />

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
        <script src="assets/js/modernizr.min.js"></script>
    </head>


    <body>


        <!-- Navigation Bar-->
        <header id="topnav">
            <div class="topbar-main">
                <div class="container">

                    <!-- Logo container-->
                    <div class="logo">
                        <a href="#" class="logo"><i class="md md-room"></i> <span>E-booking GOR Bojonegoro</span> </a>
                    </div>
                    <!-- End Logo container-->

                    <div class="menu-extras">
                        <ul class="nav navbar-nav navbar-right pull-right">
                          <?php if(isset($_SESSION['username'])){ ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle waves-effect waves-light profile" data-toggle="dropdown" aria-expanded="true"><img src="assets/images/users/avatar-1.png" alt="user-img" class="img-circle"> </a>
                                <ul class="dropdown-menu">
                                    <li><a href="logout.php"><i class="ti-power-off m-r-5"></i> Logout</a></li>
                                </ul>
                            </li>
						  <?php } ?>
                        </ul>

                        <div class="menu-item">
                            <!-- Mobile menu toggle-->
                            <a class="navbar-toggle">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </div>
                    </div>

                </div>
            </div>
            <div class="navbar-custom">
                <div class="container">
                <div id="navigation">
                    <!-- Navigation Menu-->
                    <ul class="navigation-menu">
					    <?php if($_SESSION['level']=='admin'){ ?>
                        <li class="has-submenu active">
                            <a href="index.php"><i class="md md-apps"></i>Dashboard</a>
                        </li>
                        <?php }else{ ?>
                         <li class="has-submenu active">
                            <a href="index.php"><i class="md md-apps"></i>Dashboard</a>
                        </li>
                        <?php } ?>

                        <?php
						if (isset($_SESSION['level'])) {
						if($_SESSION['level']=='pengguna'){ ?>
                        <li class="has-submenu active">
                            <a href="?page=allbook"><i class="md md-local-grocery-store"></i>History Pemesanan</a>
                        </li>
                        <?php } elseif($_SESSION['level']=='admin'){ ?>
                         <li class="has-submenu active">
                            <a href="?page=home"><i class="md md-assessment"></i>Counter</a>
                        </li>
                        <li class="has-submenu active">
                            <a href="?page=allbook"><i class="md md-shopping-basket"></i>Master Booking All</a>
                        </li>
                         <li class="has-submenu active">
                            <a href="?page=lapangan"><i class="md md-map"></i>List Lapangan</a>
                        </li>
                        <li class="has-submenu active">
                            <a href="?page=laporan"><i class="md md-print"></i>Laporan</a>
                        </li>
                        <?php } }?>


                        <?php if(!empty($_SESSION['level'])){ ?>
                        <li class="has-submenu active">
                            <a href="logout.php"><i class="md md-exit-to-app"></i>Logout</a>
                        </li>
                        <?php }else{?>
                         <li class="has-submenu active">
                            <a href="login.php"><i class="md md-person"></i>Sign in</a>
                        </li>
                        <?php } ?>
                    </ul>
                    <!-- End navigation menu -->
                </div>
            </div>
            </div>
        </header>

        <div class="wrapper">
            <div class="container">

                <!-- Page-Title -->
                <?php
                    session_start();
                    include 'config/koneksi.php';
                    if (file_exists("pages/".$_GET['page'].".php")) {
                        if($_GET['page']!="home"){
                            include"pages/".$_GET['page'].".php";
                        }else{

                            include"pages/home.php";
                        }
                    }else{
                        include 'pages/daftar_lapangan.php';
                    }
                ?>


                <!-- end row -->
                 <!-- Footer -->
                <footer class="footer text-right">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                <center>2022 © E-booking GOR Bojonegoro. Developed By www.dinpora.go.id</center>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- End Footer -->

            </div> <!-- end container -->
        </div>
        <!-- End wrapper -->



        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

        <!-- Counter Up  -->
        <script src="assets/plugins/waypoints/lib/jquery.waypoints.js"></script>
        <script src="assets/plugins/counterup/jquery.counterup.min.js"></script>

        <!-- circliful Chart -->
        <script src="assets/plugins/jquery-circliful/js/jquery.circliful.min.js"></script>
        <script src="assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>

        <!-- skycons -->
        <script src="assets/plugins/skyicons/skycons.min.js" type="text/javascript"></script>

        <!-- Page js  -->
        <script src="assets/pages/jquery.dashboard.js"></script>

        <!-- Custom main Js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
    </body>
</html>
