<?php
include "config/koneksi.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="description" content="Halaman Pendaftaran">
        <meta name="author" content="PKL UNUGIRI - DINPORA Bojonegoro">

        <link rel="shortcut icon" href="assets/images/favicon_1.ico">

        <title>Member Area Register - E-booking GOR Bojonegoro</title>

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/core.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="assets/css/components.css" rel="stylesheet" type="text/css">
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css">
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css">
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css">
        <script src="assets/js/modernizr.min.js"></script>
    </head>
    <body>
        <div class="wrapper-page">

            <div class="text-center">
                <a href="#" class="logo logo-lg"><i class="md md-room"></i> <span>E-booking GOR Bojonegoro</span> </a>
            </div>
            <?php
                if (isset($_REQUEST['simpan'])) {
                    $nama = $_REQUEST['nama'];
                    $hp   = $_REQUEST['hp'];
                    $email = $_REQUEST['email'];
                    $username = $_REQUEST['username'];
                    $password = md5($_REQUEST['password']);

                    $query = mysqli_query($conn,"INSERT INTO `pengguna`(
                                                `id_pengguna`,
                                                `nama`,
                                                `hp`,
                                                `email`,
                                                `username`,
                                                `password`,
                                                `level`)
                                                 VALUES (
                                                 '',
                                                 '$nama',
                                                 '$hp',
                                                 '$email',
                                                 '$username',
                                                 '$password',
                                                 'pengguna')");
                    if ($query) {
                        echo "<div class='alert alert-success'><b>Data berhasil diinputkan | silahkan anda login</b></div>";
                    }else{
                         echo "<div class='alert alert-danger'><b>Data gagal diinputkan</b></div>";
                    }
                }

            ?>
            <form class="form-horizontal m-t-20" action="" method="POST">

                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" type="text"  name="nama" placeholder="Masukkan Nama Anda">
                        <i class="md md-account-circle form-control-feedback l-h-34"></i>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" type="text" name="hp"  placeholder="Masukkan No.Telp/No.HP Anda">
                        <i class="md md-contacts form-control-feedback l-h-34"></i>
                    </div>
                </div>

                 <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" type="text" name="email"  placeholder="Masukkan Email Anda">
                        <i class="md md-email form-control-feedback l-h-34"></i>
                    </div>
                </div>

                 <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" type="text" name="username" placeholder="Masukkan Username Anda">
                        <i class="md md-account-box form-control-feedback l-h-34"></i>
                    </div>
                </div>

                 <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" type="text" name="password"  placeholder="Masukkan Password Anda">
                        <i class="md md-vpn-key form-control-feedback l-h-34"></i>
                    </div>
                </div>

                <div class="form-group text-right m-t-20">
                    <div class="col-xs-12">
                        <a href="login.php" class="btn btn-danger">Kembali Login</a>
                        <button name="simpan" class="btn btn-primary btn-custom w-md waves-effect waves-light" type="submit">Daftar
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <!-- Main  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

        <!-- Custom main Js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

	</body>

</html>
