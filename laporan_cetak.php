<?php
	session_start();
    include './config/koneksi.php';
    require('./assets/plugins/pdf/html2fpdf.php');
    ob_start();
?>
<!doctype html>
<html>
	<head>
		<title>Laporan</title>
		<center><h3>Laporan Pendapatan Sewa Lapangan GOR Bojonegoro</h3></center>
	</head>
	<body>
		<table border="1">
			<thead>
    			<tr>
                    <th>Kode</th>
        			<th>Nama Pemesan</th>
        			<th>Tanggal Pesan</th>
					<th>Jumlah Lapangan</th>
					<th>Harga / Lapangan</th>
					<th>Durasi</th>
					<th>Jumlah Pembayaran</th>
               	</tr>
            </thead>
        	</tbody>
        		<?php
        			$no=1;
        			if($level=="pengguna"){
						$pengguna_id = $_SESSION['pengguna_id'];
						$set 		 = "WHERE a.id_pengguna='$pengguna_id'";
					}
					$query 			 = mysqli_query($conn,"SELECT a.file, a.bank, a.tanggal_bayar, a.id_pengguna, a.jumlah_lap, d.harga, a.id_lapangan, a.status,a.booking_id, a.nama as pemesan, a.tanggal, a.tot, a.jam_mulai, a.jam_selesai FROM booking as a
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
       				<td><?php echo "DINPORA_".$data['booking_id']; ?></td>
					<td><?php echo $data['pemesan']; ?></td>
       				<td><?php echo $data['tanggal']; ?></td>
					<td><?php echo $data['jumlah_lap']; ?> Lapangan</td>
					<td>Rp. <?php echo $data['harga']; ?>,-</td>
					<td><?php echo $durasi." Jam"; ?></td>
					<td><strong>Rp. <?php echo $data['tot']; ?>,- </strong></td>
       			</tr>
				<?php } }?>
			</tbody>
       	</table>
       	<table border="1">
       		<thead>
    			<tr>
       				<th>Total Pendapatan:
       					<?php
						  $sum = mysqli_query($conn,"SELECT SUM(tot) as jumlah FROM booking WHERE status='sudah'");
						  $hasil = mysqli_fetch_array($sum);
						  echo "Rp. ".$hasil['jumlah'].",-";
						?>
					</th>
				</tr>
			</thead>
       	</table>
	</body>
</html>
<?php
	// Output-Buffer in variable:
	$html=ob_get_contents();
	ob_end_clean();
	$pdf=new HTML2FPDF();
	$pdf->AddPage();
	$pdf->WriteHTML($html);
	if (preg_match("/MSIE/i", $_SERVER["HTTP_USER_AGENT"])){
	    header("Content-type: application/PDF");
	} else {
	    header("Content-type: application/PDF");
	    header("Content-Type: application/pdf");
	}
	$pdf->Output("Laporan Penyewaan GOR.pdf", "I");
?>
