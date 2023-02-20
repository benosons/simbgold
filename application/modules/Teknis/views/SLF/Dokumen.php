<?php
require_once(BASE_FILE_FPDF . '/fpdf.php');
$pdf = new FPDF('P', 'mm', 'Letter');
$wilayah = $nm_kabkot_bgn;
$nilai = substr($wilayah,0,3);
if ($nilai == "KAB") {
  $kabkota = "".substr($wilayah,5);
  $pejabat = "BUPATI";
} elseif ($nilai == "KOT") {
  if (substr($wilayah,10,7) == "JAKARTA") {
	$kabkota = $wilayah;
    $pejabat = "GUBERNUR";
  }
  else {
	$kabkota = substr($wilayah,5);
    $pejabat = "WALIKOTA";
  }
}
$nama_kabkota= ucwords(strtolower($nm_kabkot_bgn));
//membuat halaman baru
$pdf->SetMargins(10, 10, 10);

$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetMargins(10, 10, 10, 10);

$pdf->setXY(10, 10);
$pdf->SetFont('Arial', '', 9);

$pdf->image('assets/logo/garuda.png', 100, 10, 20, 20);
$pdf->setXY(10, 40);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(0, 5, "PEMERINTAH REPUBLIK INDONESIA", 0, 1, "C");
$pdf->Cell(0, 5, "SERTIFIKAT LAIK FUNGSI BANGUNAN GEDUNG", 0, 1, "C");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, "Nomor :", 0, 1, "C");
$pdf->Cell(0, 5, "Berdasarkan Surat Pernyataan Pemeriksaan Kelaikan Fungsi Bangunan Gedung", 0, 1, "C");
$pdf->Cell(0, 5, "Nomor : Tanggal :", 0, 1, "C");
$pdf->Cell(0, 5, "Menyatakan bahwa :", 0, 1, "C");
$pdf->Cell(0, 5, "Nama Bangunan Gedung", 0, 1, "C");
$pdf->Cell(0, 5, $nm_bgn, 0, 1, "C");
$pdf->Cell(0, 5, "Fungsi Bangunan Gedung", 0, 1, "C");
$pdf->Cell(0, 5, "..........", 0, 1, "C");
$pdf->Cell(0, 5, "Klasifikasi Bangunan Gedung", 0, 1, "C");
$pdf->Cell(0, 5, "..........", 0, 1, "C");
$pdf->Cell(0, 5, "Nomor PBG", 0, 1, "C");
$pdf->Cell(0, 5, $no_izin_pbg, 0, 1, "C");
$pdf->Cell(0, 5, "Nama/Pemilik Bangunan Gedung", 0, 1, "C");
$pdf->Cell(0, 5, $nm_pemilik, 0, 1, "C");
$pdf->Cell(0, 5, "Lokasi Bangunan Gedung", 0, 1, "C");
$pdf->MultiCell(0, 5, "$almt_bgn, Kec. $nm_kec_bgn, $nama_kabkota, $nm_prov_bgn", 0, "C", 0);
$pdf->Cell(0, 5, "Sebagai", 0, 1, "C");
$pdf->Cell(0, 5, "LAIK FUNGSI", 0, 1, "C");
$pdf->Cell(0, 5, "Dalam Batas Okupansi", 0, 1, "C");
$pdf->Cell(0, 5, "Orang", 0, 1, "C");
$pdf->Cell(0, 5, "sesuai dengan lampiran sertifikat iniI", 0, 1, "C");
$pdf->Cell(0, 5, "yang merupakan bagian yang tidak terpisahkan.", 0, 1, "C");
$pdf->Cell(0, 5, "Sertifikat Laik Fungsi ini berlaku selama tahun sejak diterbitkan.", 0, 1, "C");
$pdf->Cell(0, 2, "", 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "DITETAPKAN DI ..........", 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "PADA TANGGAL ..........", 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->MultiCell(0, 5,'ATAS NAMA '.$pejabat.' '.$kabkota,0, "L", 0);

$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "KEPALA " .ucwords(strtoupper($p_nama_dinas)), 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "", 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "($nm_kadis),", 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "NIP.$nip_kadis", 0, 1, "L");


$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetMargins(10, 10, 10, 10);

$pdf->setXY(10, 10);
$pdf->SetFont('Arial', '', 9);
$pdf->image('assets/logo/garuda.png', 30, 10, 20, 20);
$pdf->setXY(10, 30);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(0, 7, "LEMBAR PENCATATAN HISTORIS", 0, 1, "C");
$pdf->Cell(0, 7, "TANGGAL PENERBITAN SERTIFIKAT LAIK FUNGSI BANGUNAN GEDUNG", 0, 1, "C");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(70, 5, "Nama Pemilik Bangunan Gedung", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, $nm_pemilik, 0, 1, "L");
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(70, 5, "Klasifikasi Bangunan Gedung", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, "..........................................................................", 0, 1, "L");
$pdf->Cell(15, 5, "", 0, 0, "L");

$pdf->Cell(70, 5, "Lokasi Bangunan Gedung", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "L");
$pdf->MultiCell(0, 5,"$almt_bgn, Kec. $nm_kec_bgn, $nama_kabkota, $nm_prov_bgn", 0, "L", 0);
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(70, 5, "Jumlah Lantai Bangunan Gedung", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, "$jml_lantai Lantai", 0, 1, "L");
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(70, 5, "Luas Lantai Bangunan Gedung", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, "$luas_bgn m", 0, 1, "L");
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(70, 5, "Luas Dasar Bangunan Gedung ", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, "............m", 0, 1, "L");
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(70, 5, "Luas Tanah ", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, "............m", 0, 1, "L");
$pdf->Cell(15, 15, "", 0, 1, "L");

$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(20, 10, "No Urut", 1, 0, "C");
$pdf->Cell(40, 10, "Tanggal SLF", 1, 0, "C");
$pdf->Cell(40, 10, "Nomor SLF", 1, 0, "C");
$pdf->MultiCell(60, 10, "Lingkup Sertifikat Layak Fungsi", 1, "C", 0);
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(20, 10, "", 1, 0, "C");
$pdf->Cell(40, 10, "", 1, 0, "C");
$pdf->Cell(40, 10, "", 1, 0, "C");
$pdf->MultiCell(60, 10, "", 1, "C", 0);
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(20, 10, "", 1, 0, "C");
$pdf->Cell(40, 10, "", 1, 0, "C");
$pdf->Cell(40, 10, "", 1, 0, "C");
$pdf->MultiCell(60, 10, "", 1, "C", 0);
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(20, 10, "", 1, 0, "C");
$pdf->Cell(40, 10, "", 1, 0, "C");
$pdf->Cell(40, 10, "", 1, 0, "C");
$pdf->MultiCell(60, 10, "", 1, "C", 0);
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(20, 10, "", 1, 0, "C");
$pdf->Cell(40, 10, "", 1, 0, "C");
$pdf->Cell(40, 10, "", 1, 0, "C");
$pdf->MultiCell(60, 10, "", 1, "C", 0);
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(20, 10, "", 1, 0, "C");
$pdf->Cell(40, 10, "", 1, 0, "C");
$pdf->Cell(40, 10, "", 1, 0, "C");
$pdf->MultiCell(60, 10, "", 1, "C", 0);
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(20, 10, "", 1, 0, "C");
$pdf->Cell(40, 10, "", 1, 0, "C");
$pdf->Cell(40, 10, "", 1, 0, "C");
$pdf->MultiCell(60, 10, "", 1, "C", 0);
$pdf->Cell(15, 5, "", 0, 1, "L");
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->MultiCell(0, 5, "CATATAN : Lampiran 1 ini merupakan bagian yang tidak terpisahkan dari Sertifikat Laik Fungsi Bangunan Gedung Nomor : ......... tanggal .........", 0, "L", 0);

$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetMargins(10, 10, 20, 10);

$pdf->setXY(10, 10);
$pdf->SetFont('Arial', '', 9);
$pdf->image('assets/logo/garuda.png', 30, 10, 20, 20);
$pdf->setXY(10, 30);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(0, 7, "LEMBAR PENCATATAN HISTORIS", 0, 1, "C");
$pdf->Cell(0, 7, "TANGGAL PENERBITAN SERTIFIKAT LAIK FUNGSI BANGUNAN GEDUNG", 0, 1, "C");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(70, 5, "Nama Pemilik Bangunan Gedung", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, "$nm_pemilik", 0, 1, "L");
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(70, 5, "Klasifikasi Bangunan Gedung", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, "..........................................................................", 0, 1, "L");
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(70, 5, "Lokasi Bangunan Gedung", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "L");
$pdf->MultiCell(0, 5,"$almt_bgn, Kec. $nm_kec_bgn, $nama_kabkota, $nm_prov_bgn", 0, "L", 0);
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(70, 5, "Jumlah Lantai Bangunan Gedung", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, "$jml_lantai Lantai", 0, 1, "L");
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(70, 5, "Luas Lantai Bangunan Gedung", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, "$luas_bgn m", 0, 1, "L");
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(70, 5, "Luas Dasar Bangunan Gedung ", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, "............m", 0, 1, "L");
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(70, 5, "Luas Tanah ", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, "............m", 0, 1, "L");
$pdf->Cell(15, 5, "", 0, 1, "L");
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(0, 70, "", 1, 1, "L");
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->MultiCell(0, 5, "CATATAN : Lampiran 2 ini merupakan bagian yang tidak terpisahkan dari Sertifikat Laik Fungsi Bangunan Gedung Nomor : ......... tanggal .........", 0, "L", 0);
$pdf->Output('I', 'surat.pdf');
