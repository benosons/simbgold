<?php
require_once(BASE_FILE_FPDF . '/fpdf.php');
$pdf = new FPDF('P', 'mm', 'A4');
$wilayah = $result_list2['nm_kabkot_bgn'];
$nilai = substr($wilayah,0,3);
if($result_list2['id_kabkot_bgn'] == '3101' || $result_list2['id_kabkot_bgn'] == '3171' || $result_list2['id_kabkot_bgn'] == '3172' || $result_list2['id_kabkot_bgn'] == '3173' || $result_list2['id_kabkot_bgn'] == '3174' || $result_list2['id_kabkot_bgn'] == '3175'){
  $wilayahterbit = "DKI JAKARTA";
} else {
  $wilayahterbit = $result_list2['nm_kabkot_bgn'];
}
if ($nilai == "KAB") {
  $kabkota = "".substr($wilayah,5);
  $pejabat = "BUPATI";
} elseif ($nilai == "KOT") {
  if (substr($wilayah,10,7) == "JAKARTA") {
    $kabkota = "DKI JAKARTA";
    $pejabat = "GUBERNUR";
  }
  else {
	$kabkota = substr($wilayah,5);
    $pejabat = "WALIKOTA";
  }
}

if($result_list2['id_jenis_permohonan'] =='14' || $result_list2['id_jenis_permohonan'] =='35' || $result_list2['id_jenis_permohonan'] =='36'){
  if($result_list2['imb'] =='1'){
    $permohonan = "SLF";
  }else{
    $permohonan = "PBG dan SLF";
  }
}else{
  $permohonan = "PBG";
}

if ($result_list2['id_fungsi_bg'] =='1'){
  if($result_list2['id_jns_bg'] =='3'){
    $usiabg ='5';
  }else{
    $usiabg ='20';
  }
}else{
  $usiabg ='5';
}

$montharray = Array("JANUARI","FEBRUARI","MARET","APRIL","MEI","JUNI","JULI","AGUSTUS","SEPTEMBER","OKTOBER","NOVEMBER","DESEMBER");
if (trim($result_list2['date_sk_tk']) != ''){
  $tgl_tek = tgl_eng_to_ind($result_list2['date_sk_tk']);
  $tgl_tek2 = explode('-',$tgl_tek);
  $tgl_teknis = $tgl_tek2[0].' '.$montharray [$tgl_tek2[1]-1].' '.$tgl_tek2[2];
  }else{
  $tgl_tek = tgl_eng_to_ind($result_list2['tgl_sidang']);
  $tgl_tek2 = explode('-',$tgl_tek);
  $tgl_teknis = $tgl_tek2[0].' '.$montharray [$tgl_tek2[1]-1].' '.$tgl_tek2[2];
}

if($result_list2['luas_bgn'] <='72'){
  if($result_list2['jml_lantai'] =='1'){
    $klasifikasi = 'Sederhana';
  }
  $klasifikasi = 'Sederhana';
} else {
  $klasifikasi = 'Tidak Sederhana';
}
//membuat halaman baru
$pdf->SetMargins(20, 20, 20);
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetMargins(20, 20, 20, 20);
$pdf->setXY(0, 10);
$pdf->SetFont('Arial', '', 9);
$pdf->image('assets/logo/garuda.png', 100, 10, 20, 20);
$pdf->setXY(20, 40);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 5, "PEMERINTAH REPUBLIK INDONESIA", 0, 1, "C");
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 5, "PERNYATAAN PEMENUHAN STANDAR", 0, 1, "C");
$pdf->Cell(0, 5, "", 0, 1, "L");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(100, 5,"Nomor : ".$result_list2['no_sk_tk'], 0, 1, "L");
$pdf->Cell(0, 5, "Lampiran : 1 (satu) berkas", 0, 1, "L");
$pdf->Cell(0, 5, "Kepada Yth.", 0, 1, "L");
$pdf->Cell(0, 5, "Pemohon Sertifikat Laik Fungsi (".$permohonan.")", 0, 1, "L");
$pdf->Cell(0, 5, "di-", 0, 1, "L");
$pdf->Cell(0, 5, "tempat", 0, 1, "L");
$pdf->Cell(0, 5, "", 0, 1, "L");
$pdf->Cell(15, 5, "Perihal : ", 0, 0, "L");
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 5, "Pernyataan Pemenuhan Standar Teknis Bangunan Gedung", 0, 1, "L");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, "", 0, 1, "L");
$pdf->Cell(0, 5, "Dengan hormat,", 0, 1, "L");
$no_konsultasi = $result_list2['no_konsultasi'];
$tgl_pernyataan  = $result_list2['tgl_pernyataan'];
$pdf->MultiCell(0, 5, "Berdasarkan hasil pemeriksaan kesesuaian dokumen rencana teknis yang disampaikan dengan nomor permohonan $no_konsultasi pada tanggal $tgl_pernyataan , dan dengan memperhatikan berita acara konsultansi oleh TPA/TPT, bersama ini kami nyatakan bahwa dokumen rencana teknis telah memenuhi standar teknis dengan data sebagai berikut:", 0, "J", 0);
$pdf->Cell(0, 5, "", 0, 1, "L");
$pdf->Cell(20, 5, "", 0, 0, "L");
$pdf->Cell(60, 5, "Nama Pemilik", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, $result_list2['nm_pemilik'], 0, 1, "L");

$pdf->Cell(20, 5, "", 0, 0, "L");
$pdf->Cell(60, 5, "Lokasi Bangunan Gedung", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->MultiCell(0, 5, $result_list2['almt_bgn'].', Kel/Desa '.$result_list2['nm_kel_bgn'].', Kec. '.$result_list2['nm_kec_bgn'].', '.$result_list2['nm_kabkot_bgn'].', Prov '.$result_list2['nm_prov_bgn'], 0, "L", 0);
if($result_list2['id_prasarana_bg'] == null || $result_list2['id_prasarana_bg'] == '0'){
  $pdf->Cell(20, 5, "", 0, 0, "L");
  $pdf->Cell(60, 5, "Fungsi Bangunan Gedung", 0, 0, "L");
  $pdf->Cell(2, 5, ":", 0, 0, "L");
  $pdf->Cell(0, 5, $result_list2['fungsi_bg'], 0, 1, "L");
  $pdf->Cell(20, 5, "", 0, 0, "L");
  $pdf->Cell(60, 5, "Jenis Bangunan Gedung ", 0, 0, "L");
  $pdf->Cell(2, 5, ":", 0, 0, "L");
  $pdf->Cell(0, 5, $fungsi['nm_jenis_bg'], 0, 1, "L"); // Perlu di cek untuk Jenis Bangunan
  $pdf->Cell(20, 5, "", 0, 0, "L");
  $pdf->Cell(60, 5, "Nama Bangunan Gedung ", 0, 0, "L");
  $pdf->Cell(2, 5, ":", 0, 0, "L");
  $pdf->MultiCell(0, 5, $result_list2['nm_bgn'], 0, "L", 0);
  $pdf->Cell(20, 5, "", 0, 0, "L");
  $pdf->Cell(60, 5, "Luas Bangunan Gedung", 0, 0, "L");
  $pdf->Cell(2, 5, ":", 0, 0, "L");
  $pdf->Cell(20, 5, number_format($result_list2['luas_bgn'],2,',','.'), 0, 0, "L");
  $pdf->Cell(3,5,'m',0,0,"L");
  $pdf->subWrite(5,'2','',6,4);
  $pdf->Cell(10,5,'',0,1);

  $pdf->Cell(20, 5, "", 0, 0, "L");
  $pdf->Cell(60, 5, "Jumlah Lantai/tinggi Bangunan", 0, 0, "L");
  $pdf->Cell(2, 5, ":", 0, 0, "L");
  $pdf->Cell(0, 5, $result_list2['jml_lantai'] .' Lantai / '. $result_list2['tinggi_bgn'] .' Meter', 0, 1, "L");
}else{
  $pdf->Cell(20, 5, "", 0, 0, "L");
  $pdf->Cell(60, 5, "Fungsi Bangunan Gedung", 0, 0, "L");
  $pdf->Cell(2, 5, ":", 0, 0, "L");
  $pdf->Cell(0, 5, "Bangunan Prasarana", 0, 1, "L");

  $pdf->Cell(20, 5, "", 0, 0, "L");
  $pdf->Cell(60, 5, "Jenis Bangunan Gedung ", 0, 0, "L");
  $pdf->Cell(2, 5, ":", 0, 0, "L");
  $pdf->Cell(0, 5, $result_list2['jns_prasarana'], 0, 1, "L"); // Perlu di cek untuk Jenis Bangunan

  $pdf->Cell(20, 5, "", 0, 0, "L");
  $pdf->Cell(60, 5, "Nama Bangunan Gedung ", 0, 0, "L");
  $pdf->Cell(2, 5, ":", 0, 0, "L");
  $pdf->Cell(0, 5, $result_list2['nm_bgn'], 0, 1, "L");
  $pdf->Cell(20, 5, "", 0, 0, "L");
  $pdf->Cell(60, 5, "Luas Bangunan Prasarana", 0, 0, "L");
  $pdf->Cell(2, 5, ":", 0, 0, "L");
  $pdf->Cell(20, 5, number_format($result_list2['luas_bgp'],2,',','.'), 0, 0, "L");
  $pdf->Cell(3,5,'m',0,0,"L");
  $pdf->subWrite(5,'2','',6,4);
  $pdf->Cell(10,5,'',0,1);

  $pdf->Cell(20, 5, "", 0, 0, "L");
  $pdf->Cell(60, 5, "Tinggi Bangunan Prasarana", 0, 0, "L");
  $pdf->Cell(2, 5, ":", 0, 0, "L");
  $pdf->Cell(0, 5,$result_list2['tinggi_bgp'] .' Meter', 0, 1, "L");
}
$j=1;
if ($count_tanah>1) {
  $pdf->Cell(20,5,'',0,0);
  $pdf->Cell(60,5,'Pemilik Tanah',0,0,'L');
  $pdf->Cell(2,5,':',0,0);
  foreach ($result_tanah as $key => $row) {
    $hat = $row['hat'];
    if($j > 1){
    $pdf->Cell(77,5,'',0,0);
  }
  $pdf->Cell(5,5,$j++.'.',0,0);
  $pdf->MultiCell(95,5,(isset($row['atas_nama_dok']) ? $row['atas_nama_dok'] : '[ PEMILIK TANAH KOSONG ]'),0,1);
  }
} else {
  foreach ($result_tanah as $key => $row) {
		$pdf->Cell(20,5,'',0,0);
		$pdf->Cell(60,5,'Luas tanah',0,0,'L');
		$pdf->Cell(2,5,':',0,0);
		$pdf->Cell(17,5,(isset($row['luas_tanah']) ? $row['luas_tanah'] : '[ LUAS TANAH KOSONG ]'),0,0);
		if ($row['luas_tanah'] != 0 || $row['luas_tanah'] == null){
      $pdf->Cell(3,5,'m',0,0,"L");
      $pdf->subWrite(5,'2','',6,4);
      $pdf->Cell(10,5,'',0,1);
		}
		$pdf->Cell(20,5,'',0,0);
		$pdf->Cell(60,5,'Pemilik Tanah',0,0,'L');
		$pdf->Cell(2,5,':',0,0);
		$pdf->MultiCell(95,5,(isset($row['atas_nama_dok']) ? $row['atas_nama_dok'] : '[ PEMILIK TANAH KOSONG ]'),0,1);
	}
}
$pdf->Cell(0, 5, "", 0, 1, "L");
$pdf->MultiCell(0, 5, "Dengan demikian permohonan ".$permohonan." Saudara dapat dilakukan dan dapat diterbitkan segera", 0, "L", 0);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, "", 0, 1, "L");
$pdf->MultiCell(0, 5, "Demikian surat pernyataan ini kami sampaikan. Atas perhatian dan kerja sama Saudara, kami ucapkan terima kasih.", 0, "L", 0);
$pdf->Cell(0,5,'',0,1);
$pdf->Cell(25);
$pdf->Cell(0,0,$pdf->image(BASE_FILE_PATH2.'QR_Code/'.$result_list2['no_konsultasi'].'.png', $pdf->GetX(), $pdf->GetY(), 35,35),0,1);

if($result_list2['id_dki'] == '1'){
  $kepala_dinas = "Heru Hermawanto";
  $nipkadis     = "196803121998031010";
}else{
  if($result_list2['nm_kadis'] != null){
    $kepala_dinas = $result_list2['nm_kadis'];
    $nipkadis     = $result_list2['nip_kadis'];
  }else{
    $kepala_dinas = $result_list2['kepala_dinas'];
    $nipkadis     = $result_list2['nip_kepala_dinas'];
  }
}

$pdf->Cell(85, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "DITETAPKAN DI  : ".$wilayahterbit, 0, 1, "L");
$pdf->Cell(85, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "PADA TANGGAL : ".tgl_eng_to_ind($result_list2['date_sk_tk']), 0, 1, "L");
$pdf->Cell(85, 5, "", 0, 0, "L");
$pdf->Cell(0,5,'ATAS NAMA '.$pejabat.' '.$kabkota,0,1,"L");
if($result_list2['id_dki'] == '1'){
    $pdf->Cell(85, 5, "", 0, 0, "L");
    $pdf->MultiCell(0, 5, "KEPALA DINAS CIPTA KARYA, TATA RUANG DAN PERTANAHAN PROVINSI DKI JAKARTA", 0, "L", 0);
}else{
  if($result_list2['stat_pejabat'] == '1'){
    $pdf->Cell(85, 5, "", 0, 0, "L");
    $pdf->MultiCell(0, 5, "PLT KEPALA " .ucwords(strtoupper($result_list2['p_nama_dinas'])), 0, "L", 0);
  } else if($result_list2['stat_pejabat'] == '2'){
    $pdf->Cell(85, 5, "", 0, 0, "L");
    $pdf->MultiCell(0, 5, "PJS KEPALA " .ucwords(strtoupper($result_list2['p_nama_dinas'])), 0, "L", 0);
  } else if($result_list2['stat_pejabat'] == '3'){
    $pdf->Cell(85, 5, "", 0, 0, "L");
    $pdf->MultiCell(0, 5, "KEPALA " .ucwords(strtoupper($result_list2['p_nama_dinas'])), 0, "L", 0);
  } else if($result_list2['stat_pejabat'] == '4'){
    $pdf->Cell(85, 5, "", 0, 0, "L");
    $pdf->MultiCell(0, 5, "PLH KEPALA " .ucwords(strtoupper($result_list2['p_nama_dinas'])), 0, "L", 0);
  } else{
    $pdf->Cell(85, 5, "", 0, 0, "L");
    $pdf->MultiCell(0, 5, "KEPALA " .ucwords(strtoupper($result_list2['p_nama_dinas'])), 0, "L", 0);
  }
}
$pdf->Cell(85, 5, "", 0, 0, "L");
$pdf->Cell(0, 10, "", 0, 1, "L");
$pdf->Cell(85, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, $kepala_dinas, 0, 1, "L");
$pdf->Cell(85, 5, "", 0, 0, "L");
$pdf->Cell(0, 5,"NIP. ". $nipkadis, 0, 1, "L");
//Hasil Pemeriksaan Untuk SLF
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetMargins(20, 20, 20, 20);
$pdf->setXY(20, 20);
$pdf->SetFont('Arial', '', 9);
$pdf->image('assets/logo/garuda.png', 100, 10, 20, 20);
$pdf->image('file/LogoKabKota/background_slf.png', 75,75,59,100);
$pdf->setXY(10, 40);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(0, 5, "PEMERINTAH REPUBLIK INDONESIA", 0, 1, "C");
$pdf->Cell(0, 5, "SERTIFIKAT LAIK FUNGSI BANGUNAN GEDUNG", 0, 1, "C");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, "Nomor : ".$result_list2['no_slf'], 0, 1, "C");
$pdf->Cell(0, 5, "Berdasarkan Surat Pernyataan Pemeriksaan Kelaikan Fungsi Bangunan Gedung", 0, 1, "C");
$pdf->Cell(0, 5, "Nomor : ".$result_list2['no_slf'], 0, 1, "C");
$pdf->Cell(0, 5, "Menyatakan bahwa :", 0, 1, "C");
$pdf->Cell(0, 5, "Nama Bangunan Gedung", 0, 1, "C");
$pdf->Cell(0, 5, $result_list2['nm_bgn'], 0, 1, "C");
if($result_list2['id_prasarana_bg'] == null || $result_list2['id_prasarana_bg'] == '0'){
  $pdf->Cell(0, 5, "Fungsi Bangunan Gedung", 0, 1, "C");
  $pdf->Cell(0, 5, $result_list2['fungsi_bg'], 0, 1, "C");
  $pdf->Cell(0, 5, "Klasifikasi Bangunan Gedung", 0, 1, "C");
  $pdf->Cell(0, 5, $fungsi['nm_jenis_bg'], 0, 1, "C");
}else{
  $pdf->Cell(0, 5, "Fungsi Bangunan Gedung", 0, 1, "C");
  $pdf->Cell(0, 5, "Bangunan Prasarana", 0, 1, "C");
  $pdf->Cell(0, 5, "Klasifikasi Bangunan Gedung", 0, 1, "C");
  $pdf->Cell(0, 5, $result_list2['jns_prasarana'], 0, 1, "C");
}

if ($result_list2['no_imb'] !=''){
  $no_izin_mendirikan = $result_list2['no_imb'];
}else{
  $no_izin_mendirikan = "[Belum Memiliki No. IMB/PBG]" ;
}
$pdf->Cell(0, 5, "Nomor PBG", 0, 1, "C");
$pdf->Cell(0, 5, $no_izin_mendirikan, 0, 1, "C");
$pdf->Cell(0, 5, "Nama/Pemilik Bangunan Gedung", 0, 1, "C");
$pdf->Cell(0, 5, $pg['nm_pemilik'], 0, 1, "C");
$pdf->Cell(0, 5, "Lokasi Bangunan Gedung", 0, 1, "C");
$pdf->MultiCell(0, 5,$result_list2['almt_bgn'].', Kel/Desa '.$result_list2['nm_kel_bgn'].', Kec. '.$result_list2['nm_kec_bgn'].', '.ucwords(strtolower($result_list2['nm_kabkot_bgn'])).', Prov '.$result_list2['nm_prov_bgn'], 0, "C", 0);
$pdf->Cell(0, 5, "Sebagai", 0, 1, "C");
$pdf->Cell(0, 5, "LAIK FUNGSI", 0, 1, "C");
$pdf->Cell(0, 5, "Dalam Batas Okupansi", 0, 1, "C");
$pdf->Cell(0, 5, $result_list2['okupansi']." Orang", 0, 1, "C");
//$pdf->Cell(0, 5, "Orang", 0, 1, "C");
$pdf->Cell(0, 5, "sesuai dengan lampiran sertifikat ini", 0, 1, "C");
$pdf->Cell(0, 5, "yang merupakan bagian yang tidak terpisahkan.", 0, 1, "C");
$pdf->Cell(0, 5, "Sertifikat Laik Fungsi ini berlaku selama ".$usiabg." tahun sejak diterbitkan.", 0, 1, "C");
$pdf->Cell(0, 2, "", 0, 1, "L");

$pdf->Cell(0, 10, "", 0, 1, "L");

$pdf->image(BASE_FILE_PATH2.'QR_Code/'.$result_list2['no_slf'].'.png', 60, 180, 35, 35);
$pdf->Cell(85, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "DITETAPKAN DI ".$wilayahterbit, 0, 1, "L");
$pdf->Cell(85, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "PADA TANGGAL ". tgl_eng_to_ind($result_list2['tgl_penerbitan_slf']), 0, 1, "L");
$pdf->Cell(85, 5, "", 0, 0, "L");
$pdf->MultiCell(0, 5,'ATAS NAMA '.$pejabat.' '.$kabkota,0, "L", 0);

if($result_list2['id_dki'] == '1'){
  $pdf->Cell(85, 5, "", 0, 0, "L");
  $pdf->MultiCell(0, 5, "KEPALA DINAS CIPTA KARYA, TATA RUANG DAN PERTANAHAN PROVINSI DKI JAKARTA", 0, "L", 0);
}else{
  if($result_list2['stat_pejabat'] == '1'){
    $pdf->Cell(85, 5, "", 0, 0, "L");
    $pdf->MultiCell(0, 5, "PLT KEPALA " .ucwords(strtoupper($result_list2['p_nama_dinas'])), 0, "L", 0);
  } else if($result_list2['stat_pejabat'] == '2'){
    $pdf->Cell(85, 5, "", 0, 0, "L");
    $pdf->MultiCell(0, 5, "PJS KEPALA " .ucwords(strtoupper($result_list2['p_nama_dinas'])), 0, "L", 0);
  } else if($result_list2['stat_pejabat'] == '3'){
    $pdf->Cell(85, 5, "", 0, 0, "L");
    $pdf->MultiCell(0, 5, "KEPALA " .ucwords(strtoupper($result_list2['p_nama_dinas'])), 0, "L", 0);
  } else if($result_list2['stat_pejabat'] == '4'){
    $pdf->Cell(85, 5, "", 0, 0, "L");
    $pdf->MultiCell(0, 5, "PLH KEPALA " .ucwords(strtoupper($result_list2['p_nama_dinas'])), 0, "L", 0);
  } else{
    $pdf->Cell(85, 5, "", 0, 0, "L");
    $pdf->MultiCell(0, 5, "KEPALA " .ucwords(strtoupper($result_list2['p_nama_dinas'])), 0, "L", 0);
  }
}

if($result_list2['id_dki'] == '1'){
  $kepala_dinas = "Heru Hermawanto";
  $nipkadis     = "196803121998031010";
}else{
  if($result_list2['nm_kadis'] != null){
    $kepala_dinas     = $result_list2['nm_kadis'];
    $nip_kadis_teknis = $result_list2['nip_kadis'];
    
  }else{
    $kepala_dinas     = $result_list2['kepala_dinas'];
    $nip_kadis_teknis = $result_list2['nip_kepala_dinas'];
  }
}
$pdf->Cell(85, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "", 0, 1, "L");
$pdf->Cell(85, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "", 0, 1, "L");
$pdf->Cell(85, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, $kepala_dinas, 0, 1, "L");
$pdf->Cell(85, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "NIP. ".$nipkadis, 0, 1, "L");


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
$pdf->MultiCell(0, 5,$result_list2['almt_bgn'].", Kel/Desa. ".$result_list2['nm_kel_bgn'].", Kec ".$result_list2['nm_kec_bgn'].", ".ucwords(strtolower($result_list2['nm_kabkot_bgn'])).", Prov ".$result_list2['nm_prov_bgn'], 0, "L", 0);
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(70, 5, "Jumlah Lantai Bangunan Gedung", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, $result_list2['jml_lantai']. "Lantai", 0, 1, "L");
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(70, 5, "Luas Lantai Bangunan Gedung", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, $result_list2['luas_bgn']. " meter persegi", 0, 1, "L");
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(70, 5, "Luas Dasar Bangunan Gedung ", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5,$result_list2['luas_dasar']. " meter persegi", 0, 1, "L");
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
$pdf->MultiCell(0, 5, "CATATAN : Lampiran 1 ini merupakan bagian yang tidak terpisahkan dari Sertifikat Laik Fungsi Bangunan Gedung Nomor : ".$result_list2['no_slf']." Tanggal ".$tgl_teknis, 0, "L", 0);

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
$pdf->MultiCell(0, 5,$result_list2['almt_bgn'].", Kel/Desa. ".$result_list2['nm_kel_bgn'].", Kec ".$result_list2['nm_kec_bgn'].", ".ucwords(strtolower($result_list2['nm_kabkot_bgn'])).", Prov ".$result_list2['nm_prov_bgn'], 0, "L", 0);
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(70, 5, "Jumlah Lantai Bangunan Gedung", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, $result_list2['jml_lantai']. "Lantai", 0, 1, "L");
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(70, 5, "Luas Lantai Bangunan Gedung", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, $result_list2['luas_bgn']. "m", 0, 1, "L");
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(70, 5, "Luas Dasar Bangunan Gedung ", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5,$result_list2['luas_dasar']. " meter persegi", 0, 1, "L");
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(70, 5, "Luas Tanah ", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, "............m", 0, 1, "L");
$pdf->Cell(15, 5, "", 0, 1, "L");
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(0, 70, "", 1, 1, "L");
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->MultiCell(0, 5, "CATATAN : Lampiran 2 ini merupakan bagian yang tidak terpisahkan dari Sertifikat Laik Fungsi Bangunan Gedung Nomor : ".$result_list2['no_slf']." Tanggal ".$tgl_teknis, 0, "L", 0);
$pdf->Output('I', 'surat.pdf');
