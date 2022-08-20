<?php require_once "./pages/set_lapangan.php" ?>
<div class="row">
	<div class="col-sm-12">
		<div class="card-box">
            <h4 class="m-t-0 header-title"><b>Daftar Lapangan</b></h4></br>
				<table class="table table-bordered"> 
	            	<tr>
	            		<th width="1px">Kode</th>
	            		<th width="270px">Judul</th>
	            		<th width="400px">Alamat</th>
	            		<th>Keterangan</th>
	            	</tr>
	            	<?php 
	            	$qr = mysqli_query($conn,"SELECT * FROM lapangan");
	            	while ($data=mysqli_fetch_array($qr)) {

	            	?>
	            	<tr>
	            		<td><h4><a href="?page=detail_lapangan&lapangan_id=<?php echo $data['lapangan_id']; ?>">#<?php echo $data['lapangan_id']; ?></a></h4></td>
	            		<td>
	            			<?php echo $data['judul']; ?><br>
	            		</td>
	            		<td><?php echo $data['alamat']; ?></td>
	            		<td>
	            			<?php echo $data['keterangan']; ?>
	            		</td>
	            	</tr>
	            	<?php } ?>
	            </table>
        </div>      
    </div>
</div>