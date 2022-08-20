<?php
   $lapangan_id = $_REQUEST['lapangan_id'];
   $query = mysqli_query($conn,"SELECT * FROM lapangan where lapangan_id='$lapangan_id'");
   $data = mysqli_fetch_array($query);
?>
<div class="row">
   <div class="col-lg-12">
        <div class="panel panel-color panel-success">
            <div class="panel-heading">
                <h3 class="panel-title text-right"><?php echo $data['judul']; ?> <a href="?page=daftar_lapangan" class="btn btn-danger btn-xs"><i class="md md-cancel"></i></a></h3>
                <p class="panel-sub-title font-13 text-muted text-right">Berikut adalah detail lengkap deskripsi lapangan </p>
            </div>
            <div class="panel-body">
				<div class="row">
                  <div class="col-sm-6">
                     <div class="col-sm-12 col-lg-12 col-md-12 graphicdesign photography">
                        <div class="gal-detail thumb">
								<img src="upload/<?php echo $data['foto1']; ?>" width="600" height="600" class="img-responsive thumb-img" alt="Foto Lapangan">
                            <div class="ga-border"></div>
                            <p class="text-muted text-center"><small>E-booking GOR Bojonegoro @ 2022</small></p>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-12 col-md-12 graphicdesign photography">
                        <div class="gal-detail thumb">
                                <img src="upload/<?php echo $data['foto2']; ?>" width="600" height="600" class="img-responsive thumb-img" alt="Foto Lapangan">
                            <div class="ga-border"></div>
                            <p class="text-muted text-center"><small>E-booking GOR Bojonegoro @ 2022</small></p>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-12 col-md-12 graphicdesign photography">
                        <div class="gal-detail thumb">
                                <img src="upload/<?php echo $data['foto3']; ?>" width="600" height="600" class="img-responsive thumb-img" alt="Foto Lapangan">
                            <div class="ga-border"></div>
                            <p class="text-muted text-center"><small>E-booking GOR Bojonegoro @ 2022</small></p>
                        </div>
                    </div>
                  </div>
                  <div class="col-sm-6"><br><br>
                      <table class="table">
                          <tr>
                              <th colspan="3">Detail Deskripsi Lapangan</th>
                          </tr>
                          <tr>
                              <td width="20%">Nama</td>
                              <td width="1px">:</td>
                              <td><?php echo $data['judul']; ?></td>
                          </tr>
                            <tr>
                              <td width="20%">Harga Sewa</td>
                              <td width="1px">:</td>
                              <td><strong>Rp. <?php echo  empty($data['harga']) ?  "0 / Belum diset":  number_format($data['harga'],2,',',','); ?>,- / Jam</strong></td>
                          </tr>
                           <tr>
                              <td width="20%">Alamat</td>
                              <td width="1px">:</td>
                              <td><?php echo $data['alamat']; ?></td>
                          </tr>
                           <tr>
                              <td width="20%">Tersedia</td>
                              <td width="1px">:</td>
                              <td><strong><?php echo $data['jumlah']; ?> Lapangan</strong></td>
                          </tr>
                           <tr>
                              <td width="20%">Keterangan</td>
                              <td width="1px">:</td>
                              <td><?php echo $data['keterangan']; ?></td>
                          </tr>
                      </table>
					  <?php if($level=="pengguna"){?>
                      <a href="?page=daftar_lapangan" class="btn btn-danger">Kembali kehalaman sebelumya</a>
                      <a href="?page=pesan&lapangan_id=<?php echo $data['lapangan_id']; ?>" class="btn btn-success"><i class="md md-place"></i> Sewa Sekarang</a>
					  <?php }elseif($level=="admin"){ ?>
					  <a href="?page=daftar_lapangan" class="btn btn-danger">Kembali kehalaman sebelumya</a>
					  <?php }else{ ?>
					  <a href="?page=daftar_lapangan" class="btn btn-danger">Kembali kehalaman sebelumya</a>
                      <a href="?page=pesan&lapangan_id=<?php echo $data['lapangan_id']; ?>" class="btn btn-success"><i class="md md-place"></i> Sewa Sekarang</a>
					  <?php } ?>
                  </div>
            </div>
            </div>
        </div>
    </div>
</div>
