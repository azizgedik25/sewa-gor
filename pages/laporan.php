<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
                <h4 class="m-t-0 header-title"><b>DAFTAR PENYEWA</b></h4>
                <div class="row">
                    <div class="col-md-12">
                     <a href="laporan_cetak.php?page=laporan" target="_blank" class="btn btn-success">Print Data</a><br><br>
                    	<table class="table table-bordered">
                    		<tr>
                    			<th>#Kode</th>
								<th>Lapangan ID</th>
                    			<th>Nama Pemesan</th>
                    			<th>Tanggal Pesan</th>
								<th>#Jml Lap</th>
								<th>#Harga / Lap</th>
								<th>#Durasi</th>
                    			<th>Status</th>
								<th>Jumlah Pembayaran</th>
                    		</tr>
                    		<?php
                    			$no=1;
                    			if($level=="pengguna"){
									$pengguna_id = $_SESSION['pengguna_id'];
									$set 		 = "WHERE a.id_pengguna='$pengguna_id'";
								}
								$query 			 = mysqli_query($conn,"SELECT a.file, a.bank, a.tanggal_bayar, a.id_pengguna, a.jumlah_lap, d.harga, a.id_lapangan, a.status, a.booking_id, a.nama as pemesan, a.tanggal, a.tot, a.jam_mulai, a.jam_selesai FROM booking as a
                    									 LEFT JOIN pengguna as c
                    									 ON a.id_pengguna = c.id_pengguna
                    									 LEFT JOIN lapangan as d
                                         				 ON a.id_lapangan = d.lapangan_id
                    									 $set");
								while ($data	 = mysqli_fetch_array($query)) {
								$booking_id 	 = $data['booking_id'];
								$jam_mulai		 = $data['jam_mulai'];
								$jam_selesai	 = $data['jam_selesai'];
								$durasi			 = $jam_selesai-$jam_mulai;
								if ($data['status']=="sudah"){
                   			?>
                   			<tr>
                   				<td><?php echo "DINPORA".$data['booking_id']; ?></td>
								<td style="color:red;"><b>#<?php echo $data['id_lapangan']; ?></b></td>
								<td><?php echo $data['pemesan']; ?></td>
                   				<td><?php echo $data['tanggal']; ?></td>
								<td><?php echo $data['jumlah_lap']; ?> Lapangan</td>
								<td>Rp. <?php echo $data['harga']; ?>,-</td>
								<td><?php echo $durasi." Jam"; ?></td>
                   				<td>
									<?php if($_SESSION['level']=="admin"){ ?>
										<?php if ($data['status']=="sudah") {
											echo "<div class='label label-success'>Sudah</div>";
										}else{
											echo "<div class='label label-danger'>Belum</div>";
										} ?>
									<?php }else{?>
									<table>
										<tr>
											<td>
												<?php if ($data['status']=="sudah") {
													echo "<div class='label label-success'>Sudah</div>";
												}else{
													echo "<div class='label label-danger'>Belum</div>";
												} ?>
											</td>

										</tr>
									</table>

									<?php } ?>
                   				</td>
								<td><strong>Rp. <?php echo $data['tot']; ?>,- </strong></td>
                   			</tr>
							<?php } }?>
                    	</table>
						<?php require_once "./pages/laporan_detail.php"; ?>
                    </div>
                </div>
            </div>
         </div>
    </div>
