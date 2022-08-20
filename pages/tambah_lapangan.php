<?php 
error_reporting(0);
$user_id = $_SESSION['user_id'];

if (isset($_REQUEST['simpan'])) {
    $keterangan = $_REQUEST['keterangan'];
    $alamat   	= $_REQUEST['alamat'];
    $jumlah_lap = $_REQUEST['jumlah_lap'];
    $judul   	= $_REQUEST['judul'];
    $harga    	= $_REQUEST['harga'];

    $temp_name 	= $_FILES['Foto']['tmp_name'];
    $name_file 	= $_FILES['Foto']['name'];
    $type_file 	= $_FILES['Foto']['type'];
    $size 		= $_FILES['Foto']['size'];

    $temp_name1 = $_FILES['Foto1']['tmp_name'];
    $name_file1 = $_FILES['Foto1']['name'];
    $type_file1 = $_FILES['Foto1']['type'];
    $size1 		= $_FILES['Foto1']['size'];

    $temp_name2 = $_FILES['Foto2']['tmp_name'];
    $name_file2 = $_FILES['Foto2']['name'];
    $type_file2 = $_FILES['Foto2']['type'];
    $size2 		= $_FILES['Foto2']['size'];
     
    $UpFoto1	= move_uploaded_file($temp_name,"upload/user_id"."_".$user_id."_".$name_file);
    $UpFoto2	= move_uploaded_file($temp_name1,"upload/user_id"."_".$user_id."_".$name_file1);
    $UpFoto3	= move_uploaded_file($temp_name2,"upload/user_id"."_".$user_id."_".$name_file2);
    
    if ($UpFoto3 OR $UpFoto1 OR $UpFoto2) {      
        $nama_foto_1 = "user_id_".$user_id."_".$name_file;
        $nama_foto_2 = "user_id_".$user_id."_".$name_file1;
        $nama_foto_3 = "user_id_".$user_id."_".$name_file2;
        $query 		 = mysqli_query($conn,"INSERT INTO `lapangan`(
                                    `keterangan`,  
                                    `judul`, 
                                    `alamat`, 
                                    `jumlah`, 
                                    `harga`,
                                    `foto1`, 
                                    `foto2`, 
                                    `foto3`) 
                                    VALUES (
                                    '$keterangan',
                                    '$judul',
                                    '$alamat',
									'$jumlah_lap',
                                    '$harga',
                                    '$nama_foto_1',
                                    '$nama_foto_2',
                                    '$nama_foto_3')");
        if ($query) {
            echo "<div class='alert alert-success'><b>Berhasil Simpan Data Lapangan</b></div>";   
        }else{
            echo "<div class='alert alert-danger'><b>Gagal Simpan Data Lapangan</b></div>";
        }
    }else{
            echo "<div class='alert alert-warning'><b>Upload gagal</b></div>";
    }
}

if ($_REQUEST['act']=='edit') {
    $lapangan_id	= $_REQUEST['lapangan_id'];

    $query 			= mysqli_query($conn,"SELECT * FROM lapangan WHERE lapangan_id='$lapangan_id'");
    $data			= mysqli_fetch_array($query);

    $judul			= $data['judul'];
    $keterangan		= $data['keterangan'];
    $alamat 		= $data['alamat'];
    $jumlah_lap		= $data['jumlah'];
    $harga			= $data['harga'];
    $gambar_1 		= "<img src='upload/$data[foto1]' width='50%'>";
    $gambar_2 		= "<img src='upload/$data[foto2]' width='50%'>";
    $gambar_3 		= "<img src='upload/$data[foto3]' width='50%'>";
}

if (isset($_REQUEST['update'])) {
    $keterangan 	= $_REQUEST['keterangan'];
    $alamat   		= $_REQUEST['alamat'];
    $jumlah_lap 	= $_REQUEST['jumlah_lap'];
    $judul   		= $_REQUEST['judul'];
    $harga    		= $_REQUEST['harga'];

    $temp_name 		= $_FILES['Foto']['tmp_name'];
    $name_file 		= $_FILES['Foto']['name'];
    $type_file 		= $_FILES['Foto']['type'];
    $size 			= $_FILES['Foto']['size'];

    $temp_name1 	= $_FILES['Foto1']['tmp_name'];
    $name_file1 	= $_FILES['Foto1']['name'];
    $type_file1 	= $_FILES['Foto1']['type'];
    $size1 			= $_FILES['Foto1']['size'];

    $temp_name2 	= $_FILES['Foto2']['tmp_name'];
    $name_file2 	= $_FILES['Foto2']['name'];
    $type_file2 	= $_FILES['Foto2']['type'];
    $size2 			= $_FILES['Foto2']['size'];
     
    $UpFoto1		= move_uploaded_file($temp_name,"upload/user_id"."_".$user_id."_".$name_file);
    $UpFoto2		= move_uploaded_file($temp_name1,"upload/user_id"."_".$user_id."_".$name_file1);
    $UpFoto3		= move_uploaded_file($temp_name2,"upload/user_id"."_".$user_id."_".$name_file2);

    $nama_foto_1 	= "user_id_".$user_id."_".$name_file;
    $nama_foto_2 	= "user_id_".$user_id."_".$name_file1;
    $nama_foto_3 	= "user_id_".$user_id."_".$name_file2;  


    if (!empty($temp_name)) {
        $sql3 = ",foto1='$nama_foto_1'";
    }
    if (!empty($temp_name1)) {
        $sql2 = ",foto2='$nama_foto_2'";
    }
    if (!empty($temp_name2)) {
        $sql1 = ",foto3='$nama_foto_3'";
    }
    
    $query = mysqli_query($conn,"UPDATE `lapangan` SET 
                                `keterangan`='$keterangan',
                                `judul`='$judul',
                                `alamat`='$alamat',
                                `jumlah`='$jumlah_lap',
                                `harga`='$harga'
                                $sql1
                                $sql2
                                $sql3
                                WHERE `lapangan_id`='$lapangan_id'");
    if ($query) {
        echo "<div class='alert alert-success'><b>Berhasil Ubah Data Lapangan</b></div>";   
    }else{
        echo "<div class='alert alert-danger'><b>Gagal Ubah Data Lapangan</b></div>";   
    }
}
?>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">          
			<div class="row">
				<div class="col-sm-12">
					<div class="card-box">
						<h4 class="m-t-0 header-title"><b>Atur Data Lapangan</b></h4><hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <form class="form-horizontal" method="post" enctype="multipart/form-data" role="form">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Judul</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="judul" placeholder="Nama Lapangan" value="<?php echo $judul; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="example-email">Keterangan</label>
                                            <div class="col-md-10">
                                              <textarea class="form-control" name="keterangan" placeholder="Keterangan Lapangan"><?php echo $keterangan; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="example-email">Alamat</label>
                                            <div class="col-md-10">
                                              <textarea class="form-control" name="alamat" placeholder="Alamat Lengkap"><?php echo $alamat; ?></textarea>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="col-md-2 control-label">Harga per jam</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="harga" placeholder="Harga" value="<?php echo $harga; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Jumlah</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="jumlah_lap" placeholder="Jumlah Lapangan" value="<?php echo $jumlah_lap; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Foto 1</label>
                                            <div class="col-md-10">
                                                <?php echo $gambar_1; ?>
                                                <input type="file" name="Foto" class="form-control">
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="col-md-2 control-label">Foto 2</label>
                                            <div class="col-md-10">
                                                 <?php echo $gambar_2; ?>
                                                <input type="file" name="Foto1" class="form-control">
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="col-md-2 control-label">Foto 3</label>
                                            <div class="col-md-10">
                                                 <?php echo $gambar_3; ?>
                                                <input type="file" name="Foto2" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label"></label>
                                            <div class="col-md-10">
                                                <a href="?page=lapangan" class="btn btn-danger">Kembali</a>
                                                <button type="submit" class="btn btn-success" <?php if($_REQUEST['act']=='edit'){echo 'name="update"';}else{echo 'name="simpan"';}?>>Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>