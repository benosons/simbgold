<?php
require_once(BASE_FILE_FPDF . '/fpdf.php');
$pdf = new FPDF('P', 'mm', 'Letter');

$wilayah = $bg['nama_kabkota'];
$nilai = substr($wilayah,0,3);
$retri= str_replace(".", "", $bg['retribusi_imb']);
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

$montharray = Array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
if (trim($bg['terbit_imb']) != ''){
  $tgl_tek = tgl_eng_to_ind($bg['terbit_imb']);
  $tgl_tek2 = explode('-',$tgl_tek);
  $tgl_teknis = $tgl_tek2[0].' '.$montharray [$tgl_tek2[1]-1].' '.$tgl_tek2[2];
  }else{
  $tgl_tek = tgl_eng_to_ind($bg['terbit_imb']);
  $tgl_tek2 = explode('-',$tgl_tek);
  $tgl_teknis = $tgl_tek2[0].' '.$montharray [$tgl_tek2[1]-1].' '.$tgl_tek2[2];
  }

//membuat halaman baru
$pdf->SetMargins(20, 20, 20);
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetMargins(20, 20, 20, 20);
$pdf->setXY(5, 10);
$pdf->SetFont('Arial', '', 9);
$pdf->image('assets/logo/garuda.png', 100, 10, 20, 20);
//$pdf->image('file/LogoKabKota/BackGround_pbg.png', 75,75,59,100);
$pdf->setXY(20, 40);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 5, "PEMERINTAH REPUBLIK INDONESIA", 0, 1, "C");
$pdf->Cell(0, 5, "PERSETUJUAN BANGUNAN GEDUNG", 0, 1, "C");
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 5, "Nomor : ".$bg['no_sk_baru'], 0, 1, "C");
$pdf->Cell(0, 5, "", 0, 1, "C");
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40, 5, "Membaca", 0, 0, "L");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, ": Permohonan Persetujuan Bangunan Gedung", 0, 1, "L");
$pdf->Cell(42, 5, "", 0, 0, "L");

$pdf->Cell(50, 5, "Nomor", 0, 0, "L");
$pdf->Cell(0, 5, ": ".$bg['no_sk_baru'], 0, 1, "L");
$pdf->Cell(42, 5, "", 0, 0, "L");

$pdf->Cell(50, 5, "Nama pemohon/Pemilik", 0, 0, "L");
$pdf->Cell(0, 5, ": ".$bg['nama_pemilik'], 0, 1, "L");
$pdf->Cell(42, 5, "", 0, 0, "L");

$pdf->Cell(50, 5, "Alamat", 0, 0, "L");
$pdf->MultiCell(0, 5, ": ".$bg['alamat_pemilik'], 0, "L", 0);
$pdf->Cell(42, 5, "", 0, 0, "L");

$pdf->Cell(50, 5, "Fungsi bangunan gedung ", 0, 0, "L");
$pdf->Cell(0, 5, ": ".$bg['fungsi_bgn'], 0, 1, "L");
$pdf->Cell(42, 5, "", 0, 0, "L");

$pdf->Cell(50, 5, "Nama bangunan gedung", 0, 0, "L");
$pdf->Cell(0, 5, ": ".$bg['nama_bgn'], 0, 1, "L");
$pdf->Cell(42, 5, "", 0, 0, "L");

$pdf->Cell(50, 5, "Luas bangunan gedung ", 0, 0, "L");
$pdf->Cell(0, 5, ": ".$bg['luas_bgn']." meter persegi ", 0, 1, "L");
$pdf->Cell(42, 5, "", 0, 0, "L");

$pdf->Cell(50, 5, "Luas Tanah ", 0, 0, "L");
$pdf->Cell(0, 5, ": ".$bg['luas_tanah']." meter persegi ", 0, 1, "L");
$pdf->Cell(42, 5, "", 0, 0, "L");

$pdf->Cell(50, 5, "Terletak di", 0, 0, "L");
$pdf->MultiCell(0, 5,": ". $bg['alamat_bgn'].', Kel/Desa '.$bg['nama_kelurahan'].', Kec. '.$bg['nama_kecamatan'].', '.ucwords(strtolower($bg['nama_kabkota'])).', Prov '.$bg['nama_provinsi'], 0, 'L', 0);
$pdf->Cell(0,5,'',0,1);


$pdf->SetFont('ARIAL','B',10);
$pdf->Cell(40,5,'Menimbang',0,0,'L');
$pdf->Cell(2,5,':',0,0);
$pdf->Cell(2,5,'',0,0);
$pdf->SetFont('ARIAL','',10);
$pdf->MultiCell(0,5,'Bahwa setelah memeriksa (mencatat/meneliti), mengkaji, dan menilai /evaluasi serta menyetujui dokumen rencana teknis bangunan gedung sebagaimana dimaksud di atas dengan ini disahkan, maka terhadap permohonan persetujuan bangunan gedung yang dimaksud dapat diberikan persetujuan dengan ketentuan sebagaimana dalam lampiran keputusan ini.',0,'J',0);


$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0,5,'',0,1);
$pdf->SetFont('ARIAL','B',10);
$pdf->Cell(40,5,'Mengingat',0,0,'L');
$pdf->Cell(3,5,':',0,0);
$pdf->SetFont('ARIAL','',10);

$i=1;
foreach ($uuck as $key => $value) {
  $pdf->Cell(5,5,$i++.'.',0,0);
  $pdf->MultiCell(0,5,$value['uu'],0,'J',0,1);
  $pdf->Cell(43,5,'',0,0);
}
foreach ($result_per as $key => $value) {
	if ($value['nama_perda'] != null || $value['nama_perda'] != ''){
		$pdf->Cell(5,5,$i++.'.',0,0);
	}
	$pdf->MultiCell(0,5,$value['nama_perda'],0,'J',0,1);
	$pdf->Cell(43,5,'',0,0);
}

$pdf->Cell(0,5,'',0,1);
$pdf->SetFont('ARIAL','B',10);
$pdf->Cell(40,5,'Memperhatikan',0,0,'L');
$pdf->Cell(2,5,':',0,0);

$pdf->Cell(2,5,'',0,0);
$pdf->SetFont('ARIAL','',10);
if ($bg['fungsi_bgn'] != 'Fungsi Hunian') {
	$pdf->MultiCell(0,5,'Berita Acara Hasil Pemeriksaan Dokumen Rencana Teknis TPA (untuk Bangunan Gedung Kepentingan Umum)',0,'J',0);
} else {
	$pdf->MultiCell(0,5,'Berita Acara Hasil Pemeriksaan Dokumen Rencana Teknis TPT Dinas PUPR/Dinas Teknis (untuk Bangunan Gedung Bukan Kepentingan Umum)',0,'J',0);
}

$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetMargins(20, 20, 20);
$pdf->SetFont('Arial', '', 12);
//$pdf->image('file/LogoKabKota/BackGround_pbg.png', 75,75,59,100);
$pdf->Cell(0, 5, "Memutuskan", 0, 1, "C");
$pdf->Cell(0, 2, "", 0, 1, "L");
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40, 5,"Menetapkan", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(5, 5, "1.", 0, 0, "L");
$pdf->Cell(0, 5, "Persetujuan Bangunan Gedung kepada:", 0, 1, "L");

$pdf->Cell(48, 5, "", 0, 0, "L");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 5, "Nama Pemohon", 0, 0, "L");
$pdf->Cell(0, 5, ": ".$bg['nama_pemilik'], 0, 1, "L");

$pdf->Cell(48, 5, "", 0, 0, "L");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 5, "Atas nama pemilik", 0, 0, "L");
$pdf->Cell(0, 5, ": ".$bg['nama_pemilik'], 0, 1, "L");

$pdf->Cell(48, 5, "", 0, 0, "L");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 5, "Bangunan gedung", 0, 0, "L");
$pdf->Cell(0, 5, ": ".$bg['nama_bgn'], 0, 1, "L");

$pdf->Cell(48, 5, "", 0, 0, "L");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 5, "Alamat", 0, 0, "L");
$pdf->MultiCell(0, 5, ": ".$bg['alamat_bgn'].', Kel/Desa '.$bg['nama_kelurahan'].', Kec. '.$bg['nama_kecamatan'].', '.ucwords(strtolower($bg['nama_kabkota'])).', Prov '.$bg['nama_provinsi'], 0, "L", 0);

$pdf->Cell(48, 5, "", 0, 0, "L");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 5, "Untuk", 0, 0, "L");
$pdf->MultiCell(0, 5, ": sebagaimana dijelaskan dalam gambar situasi Lampiran b dan rencana teknis, meliputi gambar arsitektur, gambar konstruksi bangunan gedung, dan gambar utilitas (mekanikal dan elektrikal), pembekuan dan pencabutan PBG Lampiran c, dan penghitungan besarnya retribusi PBG dalam Lampiran d Keputusan ini:", 0, "J", 0);

$pdf->Cell(40, 5, "", 0, 0, "L");
$pdf->Cell(3, 5, "", 0, 0, "L");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(5, 5, "2.", 0, 0, "L");
$pdf->MultiCell(0, 5, "Besarnya retribusi yang harus dibayar oleh pemohon sebagaimana
Dimaksud dalam Lampiran d Keputusan ini sebesar:", 0, "L", 0);

$pdf->Cell(55, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "a.", 0, 0, "L");
$pdf->Cell(70, 5, "Retribusi pembinaan penyelenggaraan bangunan gedung", 0, 1, "L");

//$pdf->Cell(0, 5, "Rp. ".number_format($bg['retribusi_imb'],0,'','.'), 0, 1, "L");
//$pdf->Cell(0, 5, "Rp. ".$bg['retribusi_imb'],0,".", 0, 1, "L");
//$pdf->Cell(0, 5, "Rp. ".$bg['retribusi_imb'],0,0, "L");
$pdf->Cell(60, 5, "", 0, 0, "L");
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 5, "Rp. ".$bg['retribusi_imb'].",-", 0, 1, "L");

$pdf->Cell(55, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "", 0, 0, "L");
$pdf->MultiCell(0, 5, '( '.terbilang($retri).' rupiah )', 0, "L", 0);

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(55, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "*) untuk perubahan PBG atas permintaan pemilik.", 0, 1, "L");

$pdf->Cell(40, 5, "", 0, 0, "L");$pdf->Cell(3, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "3.", 0, 0, "L");
$pdf->MultiCell(0, 5, "Lampiran Keputusan ini merupakan satu kesatuan yang tidak terpisahkan dari keputusan ini;", 0, "L", 0);

$pdf->Cell(40, 5, "", 0, 0, "L");$pdf->Cell(3, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "4.", 0, 0, "L");
$pdf->MultiCell(0, 5, "Hal-hal yang belum diatur dalam Keputusan ini akan ditetapkan kemudian;", 0, "L", 0);

$pdf->Cell(40, 5, "", 0, 0, "L");$pdf->Cell(3, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "5.", 0, 0, "L");
$pdf->MultiCell(0, 5, "Salinan Keputusan ini diberikan kepada yang berkepentingan; dan", 0, "L", 0);

$pdf->Cell(40, 5, "", 0, 0, "L");$pdf->Cell(3, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "6.", 0, 0, "L");
$pdf->MultiCell(0, 5, "Keputusan ini mulai berlaku sejak tanggal diterbitkan.", 0, "L", 0);


$pdf->Cell(0,5,'',0,1);
$pdf->Cell(45);
$pdf->Cell(0,0,$pdf->image('public/uploads/lampiran_convert_qrc/'.$bg['no_sk_baru'].'.png', $pdf->GetX(), $pdf->GetY(), 30,30),0,1);



//$pdf->Cell(0, 10, "", 0, 1, "L");
//$pdf->image(/* BASE_FILE_PATH. */'public/uploads/lampiran_convert_qrc/'.$bg['no_sk_baru'].'.png', 70, 140, 32, 32);
//$pdf->image(BASE_FILE_PATH. 'convert_qrc/'.$bg['no_sk_baru'].'.png', 60, 140, 30, 30);
$pdf->SetFont('ARIAL','',10);
//$pdf->Cell(0, 5, "", 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
if($bg['id_prov_bgn'] =='31'){
  $lokasi ="JAKARTA";
}else{
  $lokasi = $kabkota;
}

$pdf->Cell(0, 5, "DITETAPKAN DI : ".$lokasi, 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "PADA TANGGAL : ".tgl_eng_to_ind($bg['terbit_imb']), 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
if($bg['id_prov_bgn'] =='31'){
  $pdf->Cell(0,5,'ATAS NAMA '.$pejabat ." DKI JAKARTA",0,1,"L");
}else{
  $pdf->Cell(0,5,'ATAS NAMA '.$pejabat.' '.$kabkota,0,1,"L");
}

$pdf->SetFont('ARIAL','B',11);
$pdf->Cell(0, 5, "", 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, $bg['nama_kadis'], 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "NIP : ".$bg['nip_kadis'], 0, 1, "L");

$pdf->Output('I', $bg['no_sk_baru'].'.pdf');