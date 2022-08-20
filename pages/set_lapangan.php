<?php
error_reporting(0);
if ($_REQUEST['act']=='set_session') {
    $_SESSION['user_id']	= $_REQUEST['user_id'];
    $user_id_sess 			= $_SESSION['user_id'];
    echo "<script>
            document.location='?page=set_lapangan'
         </script>";
}else{
    $user_id_sess 			= $_SESSION['user_id'];
}

if ($_REQUEST['act']=="hapus") {
    $lapangan_id 			= $_REQUEST['lapangan_id'];
    $query 					= mysqli_query($conn,"DELETE FROM lapangan WHERE lapangan_id='$lapangan_id'");
    if ($query) {
        echo "<font color='green'>Berhasil dihapus</font>";
    }else{
        echo "<font color='red'>Gagal dihapus</font>";
    }
}
?>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
			<div class="row">
				<div class="col-lg-12">
					<h4>E-booking GOR Bojonegoro 2022 | DINPORA Bojonegoro</h4><hr>
                        <a href="?page=tambah_lapangan" class="btn btn-success">Tambah data</a><br><br>
                        <div class="panel-group" id="accordion-test-2">
							<?php
								$no=1;
								$query = mysqli_query($conn,"SELECT * FROM lapangan ORDER BY lapangan_id ASC");
								while ($data=mysqli_fetch_array($query)) {
							?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
									    <a data-toggle="collapse" data-parent="#accordion-test-2" href="#lapangan<?php echo $data['lapangan_id']; ?>" aria-expanded="false" class="collapsed">
										 <a href="?page=tambah_lapangan&lapangan_id=<?php echo $data['lapangan_id']; ?>&act=edit">
                                            <font>
                                                <span class="btn glyphicon glyphicon-edit btn-warning" title="Ubah Data"></span>
                                            </font>
                                         </a>|
                                         <a href="?page=set_lapangan&lapangan_id=<?php echo $data['lapangan_id']; ?>&act=hapus" onclick="return confirm('Apakah anda ingin menghapus data ini ?')">
                                                <font>
                                                    <span class="btn glyphicon glyphicon-trash btn-danger" title="Hapus Data"></span>
                                                </font>
                                         </a>
										 <?php echo $data['judul']; ?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="lapangan<?php echo $data['lapangan_id']; ?>" class="panel-collapse collapse">
                                    <div class="panel-body">
                                      <table class="table table-bordered">
                                          <tr>
                                              <td align="center"><img src="upload/<?php echo $data[foto1]; ?>" width="50%"><br><b>Foto 1</b></td>
                                              <td align="center"><img src="upload/<?php echo $data[foto2]; ?>" width="50%"><br><b>Foto 2</b></td>
                                              <td align="center"><img src="upload/<?php echo $data[foto3]; ?>" width="50%"><br><b>Foto 3</b></td>
                                          </tr>
                                      </table>
                                      <table width="30%">
										  <tr>
                                              <td><b>Nama Lapangan</b></td>
                                              <td><b>:</b></td>
                                              <td><b><?php echo $data['judul']; ?></b></td>
                                          </tr>
                                          <tr>
                                              <td><b>Harga</b></td>
                                              <td><b>:</b></td>
                                              <td><b>Rp. <?php echo $data['harga']; ?>,- / Jam</b></td>
                                          </tr>
										  <tr>
                                              <td><b>Jumlah</b></td>
                                              <td><b>:</b></td>
                                              <td><b><?php echo $data['jumlah']; ?> Lapangan</b></td>
                                          </tr>
                                      </table>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        </div>
                    </div>
                </div> <!-- end row -->
        </div>
    </div>
</div>
