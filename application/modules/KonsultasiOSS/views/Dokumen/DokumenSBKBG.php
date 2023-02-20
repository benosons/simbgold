<?php
require_once(BASE_FILE_FPDF . '/fpdf.php');
$pdf = new FPDF('P', 'mm', 'A4');
/*$wilayah = $bg['nama_kabkota'];
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
$nama_kabkota= ucwords(strtolower($bg['nama_kabkota']));

$montharray = Array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
if (trim($bg['tgl_penerbitan_slf']) != ''){
  $tgl_tek = tgl_eng_to_ind($bg['tgl_penerbitan_slf']);
  $tgl_tek2 = explode('-',$tgl_tek);
  $tgl_teknis = $tgl_tek2[0].' '.$montharray [$tgl_tek2[1]-1].' '.$tgl_tek2[2];
  }else{
  $tgl_tek = tgl_eng_to_ind($bg['tgl_penerbitan_slf']);
  $tgl_tek2 = explode('-',$tgl_tek);
  $tgl_teknis = $tgl_tek2[0].' '.$montharray [$tgl_tek2[1]-1].' '.$tgl_tek2[2];
}

if ($bg['id_fungsi_bg'] =='1'){
  $usiabg ='20';
}else{
  $usiabg ='5';
}

if($bg['luas_bgn'] <='72'){
  if($bg['jml_lantai'] =='1'){
    $klasifikasi = 'Sederhana';
  }
  $klasifikasi = 'Sederhana';
} else {
  $klasifikasi = 'Tidak Sederhana';
}*/
//membuat halaman baru
$pdf->SetMargins(20, 20, 20);
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetMargins(20, 20, 20, 20);
$pdf->setXY(10, 15);
$pdf->image('file/garuda.png', 68, 30, 80, 80, '', '', '', false, 300, '', false, false, 0);
$pdf->SetFont('Arial', 'B', 22);
$pdf->Cell(0, 10, "PEMERINTAH DAERAH", 0, 1, "C");
$pdf->Cell(0, 10, $kabkota, 0, 1, "C");
$pdf->setXY(10, 130);

$pdf->SetFont('Arial', 'B', 28);
$pdf->Cell(0, 10, "SERTIFIKAT LAIK FUNGSI", 0, 1, "C");
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, "Nomor :".$bg['no_slf'], 0, 1, "C");
$pdf->Cell(0, 5, "", 0, 1, "C");
$pdf->Cell(25, 10, "", 0, 0, "L");
$pdf->Cell(60, 10, "PROVINSI", 0, 0, "L");
$pdf->Cell(0, 10, ": ".ucwords(strtoupper($bg['nama_provinsi'])), 0, 1, "L");
$pdf->Cell(25, 10, "", 0, 0, "L");
$pdf->Cell(60, 10, "KABUPATEN/KOTA", 0, 0, "L");
$pdf->Cell(0, 10, ": ".ucwords(strtoupper($bg['nama_kabkota'])), 0, 1, "L");
$pdf->Cell(25, 10, "", 0, 0, "L");
$pdf->Cell(60, 10, "KECAMATAN", 0, 0, "L");
$pdf->Cell(0, 10, ": ".ucwords(strtoupper($bg['nama_kecamatan'])), 0, 1, "L");
$pdf->Cell(25, 10, "", 0, 0, "L");
$pdf->Cell(60, 10, "DESA/KELURAHAN", 0, 0, "L");
$pdf->Cell(0, 10, ": ".ucwords(strtoupper($bg['nama_kelurahan'])), 0, 1, "L");

$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, "", 0, 1, "C");
$pdf->Cell(90, 10, "", 0, 0, "L");
$pdf->MultiCell(110, 10, ucwords(strtoupper($bg['p_nama_dinas'])), 0, "L", 0);


/*$pdf->SetMargins(20, 20, 20);
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetMargins(20, 20, 20, 20);
$pdf->setXY(20, 20);
$pdf->SetFont('Arial', '', 9);
$pdf->image('assets/logo/garuda.png', 100, 10, 20, 20);
$pdf->image('file/LogoKabKota/background_slf.png', 75,75,59,100);
$pdf->setXY(10, 40);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 5, "PEMERINTAH REPUBLIK INDONESIA", 0, 1, "C");
$pdf->Cell(0, 5, "SERTIFIKAT LAIK FUNGSI BANGUNAN GEDUNG", 0, 1, "C");
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(0, 5, "Nomor : ".$bg['no_slf'], 0, 1, "C");
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(0, 5, "Berdasarkan Surat Pernyataan Pemeriksaan Kelaikan Fungsi Bangunan Gedung", 0, 1, "C");

$pdf->Cell(0, 5, "Nomor : ".$bg['no_slf']. " Tanggal : ".$tgl_teknis, 0, 1, "C");
$pdf->Cell(0, 5, "Menyatakan bahwa :", 0, 1, "C");
$pdf->Cell(0, 5, "Nama Bangunan Gedung", 0, 1, "C");
$pdf->Cell(0, 5, $bg['nm_bgn'], 0, 1, "C");
$pdf->Cell(0, 5, "Fungsi Bangunan Gedung", 0, 1, "C");
$pdf->Cell(0, 5, $bg['fungsi_bg'], 0, 1, "C");
$pdf->Cell(0, 5, "Klasifikasi Bangunan Gedung", 0, 1, "C");
$pdf->Cell(0, 5, $fungsi['nm_jenis_bg'], 0, 1, "C");
if ($bg['no_imb'] !=''){
  $no_izin_mendirikan = $bg['no_imb'];
}else {
  $no_izin_mendirikan = $bg['no_slf'];
}
$pdf->Cell(0, 5, "Nomor PBG", 0, 1, "C");
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 5, $no_izin_mendirikan, 0, 1, "C");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, "Nama Pemilik Bangunan Gedung", 0, 1, "C");
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 5, $pg['nm_pemilik'], 0, 1, "C");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, "Lokasi Bangunan Gedung", 0, 1, "C");
$pdf->SetFont('Arial', 'B', 10);
$pdf->MultiCell(0, 5,$bg['almt_bgn'].', Kel/Desa '.$bg['nama_kelurahan'].', Kec. '.$bg['nama_kecamatan'].', '.ucwords(strtolower($bg['nama_kabkota'])).', Prov '.$bg['nama_provinsi'], 0, "C", 0);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, "Sebagai", 0, 1, "C");
$pdf->Cell(0, 5, "LAIK FUNGSI", 0, 1, "C");
$pdf->Cell(0, 5, "Dalam Batas Okupansi", 0, 1, "C");
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 5, $bg['okupansi']." Orang", 0, 1, "C");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, "Sesuai dengan lampiran sertifikat iniI", 0, 1, "C");
$pdf->Cell(0, 5, "yang merupakan bagian yang tidak terpisahkan.", 0, 1, "C");
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 5, "Sertifikat Laik Fungsi ini berlaku selama ".$usiabg." tahun sejak diterbitkan.", 0, 1, "C");
$pdf->Cell(0, 2, "", 0, 1, "L");
$pdf->SetFont('Arial', '', 10);

$pdf->Cell(0, 10, "", 0, 1, "L");
$pdf->image(BASE_FILE_PATH.'Konsultasi/QR_Code/'.$bg['no_slf'].'.png', 60, 180, 30, 30);
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(0, 5, "DITETAPKAN DI :".$wilayah, 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "PADA TANGGAL : ". $tgl_teknis, 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->MultiCell(0, 5,'ATAS NAMA '.$pejabat.' '.$kabkota,0, "L", 0);

$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->MultiCell(0, 5, "KEPALA " .ucwords(strtoupper($bg['nm_dinas'])), 0, "L", 0);
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "", 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "", 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, ($bg['nm_kadis_teknis']), 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "NIP. ".$bg['nip_kadis_teknis'], 0, 1, "L");


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
$pdf->Cell(0, 5, $pg['nm_pemilik'], 0, 1, "L");
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(70, 5, "Klasifikasi Bangunan Gedung", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, $klasifikasi, 0, 1, "L");
$pdf->Cell(15, 5, "", 0, 0, "L");

$pdf->Cell(70, 5, "Lokasi Bangunan Gedung", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "L");
$pdf->MultiCell(0, 5,$bg['almt_bgn'].", Kel/Desa. ".$bg['nama_kelurahan'].", Kec ".$bg['nama_kecamatan'].", ".ucwords(strtolower($bg['nama_kabkota'])).", Prov ".$bg['nama_provinsi'], 0, "L", 0);
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(70, 5, "Jumlah Lantai Bangunan Gedung", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, $bg['jml_lantai']. "Lantai", 0, 1, "L");
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(70, 5, "Luas Lantai Bangunan Gedung", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, $bg['luas_bgn']. "m", 0, 1, "L");
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
$pdf->MultiCell(0, 5, "CATATAN : Lampiran 1 ini merupakan bagian yang tidak terpisahkan dari Sertifikat Laik Fungsi Bangunan Gedung Nomor : ".$bg['no_slf']." Tanggal ".$tgl_teknis, 0, "L", 0);

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
$pdf->Cell(0, 5, $pg['nm_pemilik'], 0, 1, "L");
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(70, 5, "Klasifikasi Bangunan Gedung", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, $klasifikasi, 0, 1, "L");
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(70, 5, "Lokasi Bangunan Gedung", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "L");
$pdf->MultiCell(0, 5,$bg['almt_bgn'].", Kel/Desa. ".$bg['nama_kelurahan'].", Kec ".$bg['nama_kecamatan'].", ".ucwords(strtolower($bg['nama_kabkota'])).", Prov ".$bg['nama_provinsi'], 0, "L", 0);
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(70, 5, "Jumlah Lantai Bangunan Gedung", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, $bg['jml_lantai']. "Lantai", 0, 1, "L");
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(70, 5, "Luas Lantai Bangunan Gedung", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, $bg['luas_bgn']. "m", 0, 1, "L");
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
$pdf->MultiCell(0, 5, "CATATAN : Lampiran 2 ini merupakan bagian yang tidak terpisahkan dari Sertifikat Laik Fungsi Bangunan Gedung Nomor : ".$bg['no_slf']." Tanggal ".$tgl_teknis, 0, "L", 0);*/
$pdf->Output('I', 'surat.pdf');
