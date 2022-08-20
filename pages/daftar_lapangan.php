<div class="row">
<?php  
error_reporting(0);
$qr = mysqli_query($conn,"SELECT * FROM lapangan");
while ($data=mysqli_fetch_array($qr)) {
?>
    <div class="col-lg-4">
        <div class="panel panel-default panel-border panel-success">
            <div class="panel-heading">
			    <a href="?page=detail_lapangan&lapangan_id=<?php echo $data['lapangan_id']; ?>">
					<h3 class="panel-title"><?php echo $data['judul']; ?></br>
				</a>
                <font color="black">
                    <b>Rp. <?php echo  empty($data['harga']) ?  "0 / Belum diset":  number_format($data['harga'],2,',',','); ?> / Jam</b>
                </font>
                </h3>
            </div>
            <div class="panel-body">
                <a href="?page=detail_lapangan&lapangan_id=<?php echo $data['lapangan_id']; ?>">
					<img src="upload/<?php echo $data['foto1']; ?>" width="200" height="190" class="thumb-img" alt="Foto Lapangan">
				</a>
                </br></br>
				<center>
				<?php if($level=="pengguna"){?>
                <a href="?page=detail_lapangan&lapangan_id=<?php echo $data['lapangan_id']; ?>" class="btn btn-primary">Lihat detail</a>
				<a class="btn btn-success" href="?page=pesan&lapangan_id=<?php echo $data['lapangan_id']; ?>"><i class="md md-place"></i> Sewa</a>
				<?php }elseif($level=="admin"){ ?>
				<a href="?page=detail_lapangan&lapangan_id=<?php echo $data['lapangan_id']; ?>" class="btn btn-primary">Lihat detail</a>
				<?php }else{ ?>
				<a href="?page=detail_lapangan&lapangan_id=<?php echo $data['lapangan_id']; ?>" class="btn btn-primary">Lihat detail</a>
				<a class="btn btn-success" href="?page=pesan&lapangan_id=<?php echo $data['lapangan_id']; ?>"><i class="md md-place"></i> Sewa</a>	
				<?php } ?>
				</center>
            </div>
        </div>
    </div>
<?php } ?>
</div>

