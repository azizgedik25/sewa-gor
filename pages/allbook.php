<?php
if (isset($_REQUEST['status'])) {
	$status 		= $_REQUEST['status'];
	$booking_id 	= $_REQUEST['booking_id'];
	$query 			= mysqli_query($conn,"UPDATE booking SET status='$status' WHERE booking_id='$booking_id'");
	if ($query) {
		echo "<script>
				alert('Berhasil di set');
				documen.location='?page=allbook';
			  </script>";
	}else{
		echo "<script>
				alert('Gagal di set');
				documen.location='?page=allbook';
			  </script>";
	}
}

if (isset($_REQUEST['simpan'])) {
	$temp_name 		= $_FILES['Foto']['tmp_name'];
    $name_file 		= $_FILES['Foto']['name'];
    $type_file 		= $_FILES['Foto']['type'];
    $size 			= $_FILES['Foto']['size'];
    $pengguna_id 	= $_REQUEST['pengguna_id'];
    $booking_id 	= $_REQUEST['booking_id'];
    $bank      		= $_REQUEST['bank'];
    $tgl  			= date("Y-m-d H:i:s");
	$UpFoto1		= move_uploaded_file($temp_name,"scan/bukti_pembayaran_sewaGORbjn"."_".$pengguna_id."_".$name_file);
	$nama_foto_1 	= "bukti_pembayaran_sewalapangan_dinporabjn".$pengguna_id."_".$name_file;
	$query 			= mysqli_query($conn,"UPDATE booking SET bank='$bank', file='$nama_foto_1',tanggal_bayar='$tgl' WHERE booking_id='$booking_id'");
	if ($query) {
		echo "<script>
				alert('berhasil di set');
				documen.location='?page=allbook';
			  </script>";
	}else{
		echo "<script>
				alert('gagal di set');
				documen.location='?page=allbook';
			  </script>";
	}
}
?>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h4 class="m-t-0 header-title"><b>DAFTAR PENYEWAAN</b></h4>
               <div class="row">
                  <div class="col-md-12">
                  <?php if($level=="pengguna"){ ?>
			      <button class="btn btn-success" onclick="print()">Print data</button><br><br>
			      <?php }?>
                     <table class="table">
                    	<tr>
						    <th>No</th>
                    		<th>#Kode</th>
                    		<th>Nama Penyewa</th>
                    		<th>Tanggal Sewa</th>
							<th>Waktu Penyewaan</th>
                    		<th>Lap ID</th>
                    		<th>Total</th>
                    		<?php if($level=="pengguna" OR $level=="admin"){?>
                    		<th>Bukti Pembayaran</th>
                    		<?php } ?>
                    		<th>Status</th>
                    	</tr>
                    	<?php
                    		$no=1;
			                if($level=="pengguna"){
			                   $pengguna_id = $_SESSION['pengguna_id'];
			                   $set 		= "WHERE a.id_pengguna='$pengguna_id'";
			                }
                    	    $query 			= mysqli_query($conn,"SELECT a.file, a.bank, a.tanggal_bayar, a.id_pengguna, a.jumlah_lap, d.harga, a.id_lapangan, a.status,a.booking_id, a.nama as pemesan, a.tanggal, a.keterangan, a.jam_mulai, a.jam_selesai FROM booking as a
                    									 LEFT JOIN pengguna as c
                    									 ON a.id_pengguna = c.id_pengguna
                    									 LEFT JOIN lapangan as d
                                         				 ON a.id_lapangan = d.lapangan_id
                    									 $set");
                   			while ($data	= mysqli_fetch_array($query)) {
							$jam_mulai		= $data['jam_mulai'];
							$jam_selesai	= $data['jam_selesai'];
							$durasi			= $jam_selesai-$jam_mulai;
                		?>
                   		<tr>
						    <td>
								<?php echo $no; $no++; ?>
							</td>
                   			<td>
								<?php echo "DINPORA".$data['booking_id']; ?>
							</td>
                   			<td>
								<?php echo $data['pemesan']; ?>
							</td>
                   			<td>
								<?php echo $data['tanggal']; ?>
							</td>
							<td>
								<?php echo "Jam ".$jam_mulai.".00 - ".$jam_selesai.".00 WIB (".$durasi." Jam)"; ?>
							</td>
                   			<td>
                   				<a href="?page=detail_lapangan&lapangan_id=<?php echo $data['id_lapangan']; ?>" target="_blank">
                   				<h4 class="text-primary">#<?php echo $data['id_lapangan']; ?></h4>
                   				</a>
                   			</td>
                   			<td>
                   				<?php echo $data['jumlah_lap']." Lapangan * (Rp.".$data['harga'].",- * ".$durasi." Jam)"; ?></br><hr>
                   				<strong><?php echo "Rp. ".$data['jumlah_lap']*($data['harga']*$durasi).",-"; ?></strong>
                   			</td>
                   			<td>
							<!--USER -->
							<?php if($level=="pengguna"){
								if ($data['status']=="sudah" OR $data['status']=="batal") { ?>
								<button type="button" class="btn btn-warning btn-sm disabled" data-toggle="modal" data-target="#myModal<?php echo $data['booking_id']; ?>">Pembayaran</button>
							<?php } else { ?>
								<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal<?php echo $data['booking_id']; ?>">Pembayaran</button>
									<div id="myModal<?php echo $data['booking_id']; ?>" class="modal fade" role="dialog">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Data Bukti Pembayaran</h4>
												</div>
												<div class="modal-body">
													<form action="" enctype="multipart/form-data" method="POST">
														<input type="hidden" name="pengguna_id" value="<?php echo $data['id_pengguna']; ?>" class="form-control">
														<input type="hidden" name="booking_id" value="<?php echo $data['booking_id']; ?>" class="form-control">
														Tanggal Pembayaran
														<input type="date" value="<?php echo $data['tanggal_bayar']; ?>" name="tanggal" class="form-control" placeholder="Tanggal"><br>
														Cash/Transfer
														<input type="txt" name="bank" value="<?php echo $data['bank']; ?>" class="form-control" placeholder="Cash atau Transfer"><br>
														Upload File Bukti Pembayaran
														<?php  if (!empty($data['file'])) {?>
														<img src="./scan/<?php echo $data['file']; ?>" width="100%" hight="20%">
														<?php }?>
														<input type="file" name="Foto" class="form-control" placeholder="upload">
												</div>
													<div class="modal-footer">
														<?php if($level=="pengguna"){ ?>
														<button type="submit" class="btn btn-success" name="simpan">Simpan</button>
														<?php } ?>
														<button  class="btn btn-default" data-dismiss="modal">Kembali</button>
													</form>
													</div>
											</div>
										</div>
									</div>
							<?php } }?>
							<!-- ADMIN -->
							<?php if($level=="admin"){ ?>
								<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal<?php echo $data['booking_id']; ?>">Pembayaran</button>
									<div id="myModal<?php echo $data['booking_id']; ?>" class="modal fade" role="dialog">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Data Bukti Pembayaran</h4>
												</div>
												<div class="modal-body">
													<form action="" enctype="multipart/form-data" method="POST">
														<input type="hidden" name="pengguna_id" value="<?php echo $data['id_pengguna']; ?>" class="form-control">
														<input type="hidden" name="booking_id" value="<?php echo $data['booking_id']; ?>" class="form-control">
														Tanggal Pembayaran
														<input type="date" value="<?php echo $data['tanggal_bayar']; ?>" name="tanggal" class="form-control" placeholder="Tanggal"><br>
														Cash/Transfer
														<input type="txt" name="bank" value="<?php echo $data['bank']; ?>" class="form-control" placeholder="Cash atau Transfer"><br>
														Upload File Bukti Pembayaran
														<?php  if (!empty($data['file'])) {?>
														<img src="scan/<?php echo $data['file']; ?>" width="100%" hight="20%">
														<?php }?>
														<input type="file" name="Foto" class="form-control" placeholder="upload">
												</div>
													<div class="modal-footer">
														<?php if($level=="pengguna"){ ?>
														<button type="submit" class="btn btn-success" name="simpan">Simpan</button>
														<?php } ?>
														<button  class="btn btn-default" data-dismiss="modal">Kembali</button>
														</form>
													</div>
													</div>
												</div>
							<?php } ?>
                   			</td>
                   			<td>
                   				<?php if($level=="pengguna"){ ?>
                   					<?php if ($data['status']=="sudah") {
                   						echo "<div class='label label-success'>Sudah</div>";
                   					}else if ($data['status']=="belum"){
                   						echo "<div class='label label-warning'>Belum</div>";
                   					}else if ($data['status']=="batal"){
                   						echo "<div class='label label-danger'>Batal</div>";
                   					}?>
                   				<?php }else{?>
                   				<table>
                   					<tr>
                   						<td>
                   							<form action="" method="POST">
		                   					 <input type="hidden" name="booking_id" value="<?php echo $data['booking_id']; ?>">
		                   					 	<select class="form-control" name="status" onchange="form.submit()">
		                   					 		<option value="">-Pilih Status-</option>
		                   					 		<option value="sudah" <?php if($data['status']=="sudah"){echo "selected";} ?>>Sudah</option>
		                   					 		<option value="belum" <?php if($data['status']=="belum"){echo "selected";} ?>>Belum</option>
													<option value="batal" <?php if($data['status']=="batal"){echo "selected";} ?>>Batal</option>
		                   					 	</select>
		                   					 </form>
                   						</td>
                   					</tr>
                   				</table>

                   				<?php } ?>
                   			</td>
                   		</tr>
						<tr>
							<td colspan="8" class="text-right"><b>Keterangan</b> : <?php echo $data['keterangan']; ?></td>
						</tr>
                   		<?php } ?>
					</table>
                    </div>
                </div>
        </div>
    </div>
</div>
