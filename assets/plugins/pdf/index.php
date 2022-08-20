<?php
include"../koneksi.php";
require('html2fpdf.php');
ob_start();
include "../function.php"; //memanggil fungsi
$link_export="export_rekomendasi.php";
?>

<?php
require_once ( '../ahp.php' );
//$link_pemeriksaan='?hal=data_pemeriksaan';
//$id=$_GET['id'];
$kriteria=array();
$q="select * from kriteria order by kode";
$q=mysqli_query($con,$q);
while($h=mysqli_fetch_array($q)){
    $kriteria[]=array($h['id_kriteria'],$h['kode'],$h['nama']);
}
//$q2=mysqli_query($con,"select * from pemeriksaan where id_pemeriksaan='".$id."'");
//$h2=mysqli_fetch_array($q2);
$alternatif=array();
// query $q yang lama dengan seleksi id alternatif dibanding penyakit $q="select * from alternatif where id_penyakit='".$h2['id_penyakit']."' order by id_alternatif";
$q1=mysqli_query($con,"select * from tahun_akademik where status='aktif'");
$h1=mysqli_fetch_array($q1);
$aktif=$h1['id_tahun_akademik'];
$tahun=$h1['tahun_akademik'];
$q="select * from alternatif where id_tahun_akademik='$aktif' order by id_alternatif";
$q=mysqli_query($con,$q);
while($h=mysqli_fetch_array($q)){
    $alternatif[]=array($h['id_alternatif'],$h['nama_alternatif']);
}

for($i=0;$i<count($kriteria);$i++){
    $id_kriteria[]=$kriteria[$i][0];
}
$matrik_kriteria = ahp_get_matrik_kriteria($id_kriteria);
$jumlah_kolom = ahp_get_jumlah_kolom($matrik_kriteria);
$matrik_normalisasi = ahp_get_normalisasi($matrik_kriteria, $jumlah_kolom);
$eigen_kriteria = ahp_get_eigen($matrik_normalisasi);

for($i=0;$i<count($alternatif);$i++){
    $id_alternatif[]=$alternatif[$i][0];
}
for($i=0;$i<count($kriteria);$i++){
    $matrik_alternatif = ahp_get_matrik_alternatif($kriteria[$i][0], $id_alternatif);
    $jumlah_kolom_alternatif = ahp_get_jumlah_kolom($matrik_alternatif);
    $matrik_normalisasi_alternatif = ahp_get_normalisasi($matrik_alternatif, $jumlah_kolom_alternatif);
    $eigen_alternatif[$i] = ahp_get_eigen($matrik_normalisasi_alternatif);
}

$nilai_to_sort = array();

for($i=0;$i<count($alternatif);$i++){
    $nilai=0;
    for($ii=0;$ii<count($kriteria);$ii++){
        $nilai = $nilai + ( $eigen_alternatif[$ii][$i] * $eigen_kriteria[$ii]);
    }
    $nilai = round( $nilai , 4);
    $nilai_global[$i] = $nilai;
    $nilai_to_sort[] = array($nilai, $alternatif[$i][0]);
}

sort($nilai_to_sort);
for($i=0;$i<count($nilai_to_sort);$i++){
    $ranking[$nilai_to_sort[$i][1]]=(count($nilai_to_sort) - $i);
}


?>
<html>
<head>
<title>Rekomendasi Calon Ketua OSIS MAN Model Palangka Raya</title>
<center><h3>Rekomendasi Calon Ketua OSIS MAN Model Palangka Raya Tahun <?php echo $tahun;?></h3></center>
</head>
<body>
<table align="center" border="1">
                                    <thead>
                                        <tr>
                                            <th width='5%'>No</th>
                                            <th>Alternatif</th>
                                            <?php
                                                for($i=0;$i<count($kriteria);$i++){
                                                    echo '<th>'.($kriteria[$i][2]).'</th>';
                                                }
                                            ?>
                                            <th>Nilai</th>
                                            <th>Rank</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
        for($i=0;$i<count($alternatif);$i++){
            echo '
                <tr>
                    <td>'.($i+1).'</td>
                    <td>'.$alternatif[$i][1].'</td>
            ';
            for($ii=0;$ii<count($kriteria);$ii++){
                echo '
                        <td>'.$eigen_alternatif[$ii][$i].'</td>
                ';
                
            }
            echo '
                    <td><strong>'.$nilai_global[$i].'</strong></td>
                    <td>'.$ranking[$alternatif[$i][0]].'</td>
                </tr>
            ';
        }
        ?>
                                    </tbody>
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
$pdf->Output("sample2.pdf","I");

?>

