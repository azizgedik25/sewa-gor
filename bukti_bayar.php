<!-- data print -->
<section id="print">
<div class="d-none pt-5 px-5 print-show">
        <div class="text-center mb-5 pt-2">
            <h2 class="mb-3" style="font-size:60px;"><?php echo $toko ?></h2>
            <h2 class="mb-0"><?php echo $alamat ?></h2>
            <h2 class="mb-4">Telp : <?php echo $telepon ?></h2>
        </div>
            <h2 class="mb-1">Invoice : <?php echo $noinv ?>
          <span class="float-right">Kasir : <?php echo $username ?></span></h2>
            <h2 class="mb-1">Tanggal : <?php echo $Datee ?></h2>
    <div class="row">
        <div class="col-12 py-3 my-3 border-top border-bottom">
            <div class="row">
                <div class="col-5"><h2 class="mb-0 py-1" style="font-weight:700;">Description</h2></div>
                <div class="col-2"><h2 class="mb-0 py-1" style="font-weight:700;">Harga</h2></div>
                <div class="col-2"><h2 class="mb-0 py-1" style="font-weight:700;">Qty</h2></div>
                <div class="col-3"><h2 class="mb-0 py-1" style="font-weight:700;">Jumlah</h2></div>
            </div>
        </div>
        <?php
        $no = 1;
        $dataprint = mysqli_query($conn,"SELECT * FROM laporan WHERE invoice='$noinv'");
        while($c = mysqli_fetch_array($dataprint)){
            ?>
        <div class="col-12">
            <div class="row">
                <div class="col-5"><h2 class="mb-0 py-1" style="font-weight:500;"><?php echo $c['nama_produk']; ?></h2></div>
                <div class="col-2"><h2 class="mb-0 py-1" style="font-weight:500;"><?php echo ribuan($c['harga']); ?></h2></div>
                <div class="col-2"><h2 class="mb-0 py-1" style="font-weight:500;"><?php echo ribuan($c['qty']); ?></h2></div>
                <div class="col-3"><h2 class="mb-0 py-1" style="font-weight:500;"><?php echo ribuan($c['subtotal']); ?></h2></div>
            </div>
        </div>
      <?php } ?>
      <div class="col-12 py-3 my-3 border-top">
            <div class="row justify-content-end">

                <div class="col-3 text-right border-bottom">
                  <h2 class="mb-1" style="font-weight:700;">Total <span class="ml-3">:</span></h2>
                  <h2 class="mb-1" style="font-weight:500;">Tunai <span class="ml-3">:</span></h2>
                  <h2 class="mb-1" style="font-weight:500;">Kembali <span class="ml-3">:</span></h2>
                </div>
                <div class="col-3 border-bottom">
                  <h2 class="mb-1" style="font-weight:700;"><?php echo ribuan($i4['isub']); ?></h2>
                  <h2 class="mb-1" style="font-weight:500;"><?php echo ribuan($Dbayar); ?></h2>
                  <h2 class="mb-1" style="font-weight:500;"><?php echo ribuan($Dkembali); ?></h2>
                </div>
            </div>
        </div>
        <div class="col-12 text-center mt-5">
            <h2>* Terima Kasih Telah Berbelanja Di Adgrafika *</h2>
        </div>
    </div><!-- end row -->
</div><!-- end box print -->
</section>
<!-- end data print -->
