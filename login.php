<?php
include "config/koneksi.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="description" content="Halaman Login Admin dan Member Area">
        <meta name="author" content="AZIZAH UNUGIRI - DINPORA Bojonegoro">

        <link rel="shortcut icon" href="assets/images/favicon_1.ico">

        <title>Member Area Login - E-booking GOR Bojonegoro</title>

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
                if (isset($_REQUEST['login'])) {
                    $username 	= $_REQUEST['username'];
                    $password 	= md5($_REQUEST['password']);

                    $query 		= mysqli_query($conn,"SELECT * FROM pengguna WHERE username='$username' AND password='$password'");
                    $data 		= mysqli_fetch_array($query);
                    $jumlah 	= mysqli_num_rows($query);

                    if ($jumlah==1) {
                        session_start();
                        $_SESSION['username']		= $data['username'];
                        $_SESSION['pengguna_id']	= $data['id_pengguna'];
                        $_SESSION['nama']			= $data['nama'];
                        $_SESSION['level']			= $data['level'];
                        echo "<script>
                                document.location='index.php'
                              </script>";
                    }
					else
					{
                        $query	= mysqli_query($conn,"SELECT * FROM user WHERE username='$username' AND password='$password'");
                        $data	= mysqli_fetch_array($query);
                        $jumlah = mysqli_num_rows($query);
                            if ($jumlah==1) {
                               session_start();
                               $_SESSION['username']=$data['username'];
                               $_SESSION['nama']=$data['nama'];
                               $_SESSION['level']=$data['level'];
                               echo "<script>
                                       document.location='index.php?page=home'
                                     </script>";
                            }
							else{
                                 echo "<div class='alert alert-danger'><b>Gagal login!! Username atau Password yang anda masukkan salah.</b></div>";
                            }
                    }
                }
            ?>
            <form class="form-horizontal m-t-20" action="" method="POST">
                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" type="text" name="username"  placeholder="Masukkan Username Anda">
                        <i class="md md-account-circle form-control-feedback l-h-34"></i>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" type="password" name="password"  placeholder="Masukkan Password Anda">
                        <i class="md md-vpn-key form-control-feedback l-h-34"></i>
                    </div>
                </div>

                   <!-- DAFTAR  -->
                   <div class="form-group">
                      <div class="col-xs-12">
                              <label for="checkbox-signup">
                                 Jika anda belum mempunyai akun klik daftar <a href="daftar.php" class="btn btn-sm btn-default">Daftar Pengguna</a>
                              </label>
                      </div>
                   </div>

                <div class="form-group text-right m-t-20">
                    <div class="col-xs-12">
                        <a href="dashboard.php?page=daftar_lapangan" class="btn btn-danger">Kembali</a>
                        <button class="btn btn-primary btn-custom w-md waves-effect waves-light" type="submit" name="login">Log In
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
