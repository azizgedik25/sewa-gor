<?php
    session_start();
    $level 			= $_SESSION['level'];
    $lapangan_id 	= $_REQUEST['lapangan_id'];
    $pengguna_id  	= $_SESSION['pengguna_id'];
    $query 			= mysqli_query($conn,"SELECT * FROM lapangan WHERE lapangan_id='$lapangan_id'");
    $data 			= mysqli_fetch_array($query);
	$query2 		= mysqli_query($conn,"SELECT * FROM pengguna WHERE id_pengguna='$pengguna_id'");
    $data2 			= mysqli_fetch_array($query2);
    $harga 			= $data['harga'];
	$jumlah 		= $data['jumlah'];

    if ($level==NULL) {
        echo "<script>
                    alert('Silahkan login terlebih dahulu, untuk melanjutkan Proses Sewa Lapangan!!!');
                    document.location='login.php';
              </script>";
    }
?>
<div class="row">
        <div class="col-lg-8">
        <div class="panel panel-default panel-border panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Daftar Jadwal Booking</span><br></h3>
            </div>
            <div class="panel-body">
                <table class="table">
                        <tr>
                            <th>No</th>
                            <th>Tanggal Sewa</th>
                            <th>Waktu Penyewaan</th>
                            <th>Durasi</th>
                            <th>Status</th>
                        </tr>
                        <?php
                            $no=1;
                            if($level=="pengguna"){
                               $pengguna_id = $_SESSION['pengguna_id'];
                               $set         = "WHERE d.lapangan_id='$lapangan_id' ORDER BY a.booking_id DESC";
                            $query          = mysqli_query($conn,"SELECT a.booking_id, a.id_pengguna, a.jumlah_lap, d.harga, a.id_lapangan, a.status, a.tanggal, a.jam_mulai, a.jam_selesai FROM booking as a
                                LEFT JOIN pengguna as c
                                    ON a.id_pengguna = c.id_pengguna
                                LEFT JOIN lapangan as d
                                    ON a.id_lapangan = d.lapangan_id
                                $set");
                            while ($data    = mysqli_fetch_array($query)) {
                            $jam_mulai      = $data['jam_mulai'];
                            $jam_selesai    = $data['jam_selesai'];
                            $durasi         = $jam_selesai-$jam_mulai;
                        ?>
                        <tr>
                            <td><?php echo $no; $no++; ?></td>
                            <td><?php echo $data['tanggal']; ?></td>
                            <td><?php echo "Jam ".$jam_mulai.".00 - ".$jam_selesai.".00 WIB"; ?></td>
                            <td><?php echo $durasi." Jam"; ?></td>
                            <td>
                                <?php if ($data['status']=="sudah") {
                                        echo "<div class='label label-success'>Sudah</div>";
                                      }else if ($data['status']=="belum"){
                                        echo "<div class='label label-warning'>Belum</div>";
                                      }else if ($data['status']=="batal"){
                                        echo "<div class='label label-danger'>Batal</div>";
                                      }
                                ?>
                            </td>
                        </tr>
                        <?php } } ?>
                </table>
            </div>
        </div>
    </div>
    <?php
        $query          = mysqli_query($conn,"SELECT * FROM lapangan WHERE lapangan_id='$lapangan_id'");
        $data           = mysqli_fetch_array($query);
        $query2         = mysqli_query($conn,"SELECT * FROM pengguna WHERE id_pengguna='$pengguna_id'");
        $data2          = mysqli_fetch_array($query2);
    ?>
    <div class="col-lg-4">
        <div class="panel panel-default panel-border panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Sewa Lapangan sekarang <br></h3>
            </div>
            <div class="panel-body">
            <?php
				if (isset($_REQUEST['simpan'])) {
					$harga 			= $data['harga'];
					$nama 			= $_REQUEST['nama'];
					$email 			= $_REQUEST['email'];
					$hp    			= $_REQUEST['hp'];
					$keterangan 	= $_REQUEST['keterangan'];
					$jumlah     	= $_REQUEST['jml'];
					$jam_mulai		= $_REQUEST['jam_mulai'];
					$jam_selesai	= $_REQUEST['jam_selesai'];
				    $durasi			= $jam_selesai-$jam_mulai;
					$lapangan_id    = $_REQUEST['lapangan_id'];
					$pengguna_id  	= $_SESSION['pengguna_id'];
					$date 			= $_REQUEST['tgl'];
					$tot 			= $jumlah*($harga*$durasi);

					$cekdata		= mysqli_query($conn,"SElECT * FROM booking
															WHERE tanggal='$date' AND jam_mulai='$jam_mulai'
															AND jam_selesai='$jam_selesai'
															AND status='sudah'");

					if	($cek		= mysqli_num_rows($cekdata) == 0) {
							$query	= mysqli_query($conn,"INSERT INTO `booking`(
															`booking_id`,
															`nama`,
															`email`,
															`hp`,
															`jumlah_lap`,
															`tot`,
															`id_pengguna`,
															`id_lapangan`,
															`tanggal`,
															`keterangan`,
															`jam_mulai`,
															`jam_selesai`)
															VALUES (
															'',
															'$nama',
															'$email',
															'$hp',
															'$jumlah',
															'$tot',
															'$pengguna_id',
															'$lapangan_id',
															'$date',
															'$keterangan',
															'$jam_mulai',
															'$jam_selesai')");
													if ($query) {
														echo "<div class='alert alert-success'><b>Data berhasil diproses</b></div>";
													}else{
														echo "<div class='alert alert-danger'><b>Data gagal diproses</b></div>";
													}
					}else {
					   echo "<div class='alert alert-warning'><b>Maaf jadwal sewa lapangan, sudah terisi oleh pengguna yang lain. Silahkan pilih jadwal kembali.</b></div>";
					}
				}
            ?>
            <form class="form-horizontal" role="form" action="" method="POST">
                <div class="form-group">
                    <label class="col-md-3 control-label">Nama Penyewa</label>
                    <div class="col-md-9">
                        <strong><input type="text" class="form-control" name="nama" placeholder="Nama" value=" "></strong>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="example-email">Email</label>
                    <div class="col-md-9">
                        <input type="email" id="example-email" name="email" class="form-control" readonly="readonly" placeholder="Email" value="<?php echo $data2['email']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="example-email">Hp</label>
                    <div class="col-md-9">
                        <input type="text" id="example-email" name="hp" class="form-control" placeholder="Hp" value=" ">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="example-email">Keterangan</label>
                    <div class="col-md-9">
                        <textarea class="form-control" placeholder="Keterangan" name="keterangan"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="example-email">Jumlah Lapangan</label>
                    <div class="col-md-4 has-success">
                        <input type="number" onchange="jumlahkan()" name="jml" id="jumlah" class="form-control" placeholder="0">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="example-email">Tanggal</label>
                    <div class="col-md-9 has-success">
                        <input type="date" onchange="jumlahkan()" id="tgl" name="tgl" class="form-control">
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-md-3 control-label">Jam Mulai</label>
                    <div class="col-md-3 has-success">
                        <select name="jam_mulai" onchange="jumlahkan()" id="jam_mulai" class="form-control" placeholder="Pilih Jam">
						    <?php
							$query3 		= mysqli_query($conn,"SELECT * FROM jam ORDER BY id_jam ASC");
							while ($data3 	= mysqli_fetch_array($query3)){
							?>
							<option value="<?php echo $data3['jam_mulai']; ?>"><?php echo $data3['jam_mulai'].".00"; ?></option>
							<?php } ?>
						</select>
                    </div>
					<label class="col-md-3 control-label">Jam Selesai</label>
					<div class="col-md-3 has-success">
                        <select name="jam_selesai" onchange="jumlahkan()" id="jam_selesai" class="form-control" placeholder="Pilih Jam">
						    <?php
							$query4 		= mysqli_query($conn,"SELECT * FROM jam ORDER BY id_jam ASC");
							while ($data4 	= mysqli_fetch_array($query4)){
							?>
							<option value="<?php echo $data4['jam_selesai']; ?>"><?php echo $data4['jam_selesai'].".00"; ?></option>
							<?php } ?>
						</select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Durasi</label>
                    <div class="col-md-9 has-success">
                        <div id="durasi" class="form-control" readonly="readonly"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                                <div class="panel panel-color panel-primary">
                                    <div class="panel-heading">
                                        <p class="panel-sub-title font-13 text-muted">Detail Lapangan yang disewa</p>
                                    </div>
                                    <div class="panel-body">
                                        <table class="tabel">
                                            <tr>
                                                <td>Nama  </td>
                                                <td>:</td>
                                                <td><?php echo $data['judul']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Tersedia  </td>
                                                <td>:</td>
                                                <td><strong><?php echo $data['jumlah']; ?> Lapangan</strong></td>
                                            </tr>
                                             <tr>
                                                <td>Harga Sewa</td>
                                                <td>:</td>
                                                <td><strong>Rp. <?php echo $data['harga']; ?>,- / Jam</strong></td>
                                            </tr>

                                        </table>
                                    </div>
                                </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                                <div class="panel panel-color panel-primary">
                                    <div class="panel-heading">
                                        <p class="panel-sub-title font-13 text-muted">Total Pembayaran</p>
                                    </div>
                                    <div class="panel-body">
                                        <script type="text/javascript">
                                            function jumlahkan() {
												var jam_mulai 	= $('#jam_mulai').val();
												var jam_selesai = $('#jam_selesai').val();
												var durasi		= jam_selesai - jam_mulai;
												$("#durasi").html(""+durasi+" Jam");
												$("#jam_mulai").val(jam_mulai);
												$("#jam_selesai").val(jam_selesai);
                                                var harga 		= <?php echo $harga; ?> * durasi;
                                                var jumlah	    = $('#jumlah').val();
                                                var tgl         = $('#tgl').val();
                                                if (durasi <= <?php echo 0; ?>) {
													$("#button-checkout").html("");
													$("#notif").html("<div class='alert alert-danger' role='alert'>Nilai Durasi <b>Tidak Tepat</b>. Minimum Penyewaan adalah <b>1 Jam</b>.</div>");
												}
                                                else
                                                if (tgl <= <?php echo 0; ?>) {
                                                    $("#button-checkout").html("");
                                                    $("#notif").html("<div class='alert alert-danger' role='alert'><b>Jangan Lupa Isi Tanggalnya ya!!!</b></div>");
                                                }
												else
												if (jumlah <= <?php echo 0; ?>) {
													$("#button-checkout").html("");
													$("#notif").html("<div class='alert alert-danger' role='alert'>Nilai Jumlah tidak boleh <b>0</b>. Minimum Penyewaan adalah <b>1 Lapangan</b>.</div>");
												}
												else
												if (jumlah > <?php echo $jumlah; ?>)
												{
													$("#notif").html("<div class='alert alert-warning' role='alert'>Melebihi kapasitas jumlah yang tersedia. Kapasitas yang tersedia hanya <b><?php echo $jumlah ?> Lapangan</b>.</div>");
													$("#button-checkout").html("");
												}
												else
												if (jumlah <= <?php echo $jumlah; ?>) {
													$("#notif").html("");
													$("#button-checkout").html("<button class='btn btn-success' type='submit' name='simpan'><i class='md md-pin-drop'></i> Checkout</button>");
													var tot     = jumlah * harga;
													var tot     = jumlah * harga;
													$("#tot").html("<h1>Rp. "+tot+",-</h1>");
													$("#jumlah").val(jumlah);
												};
                                            }
                                        </script>
                                       <div id="tot"></div>
									   <div id="notif"></div>
                                    </div>
                                </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="example-email"></label>
                    <div class="col-md-8">
                          <a href="?page=daftar_lapangan" class="btn btn-danger">Kembali</a>
						  <a id="button-checkout"></a>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
