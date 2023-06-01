<?php
require_once(BASE_FILE_FPDF . '/fpdf.php');
$pdf = new FPDF('P', 'mm', 'A4');
$wilayah = $result_list['nm_kabkot_bgn'];
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
if($result_list['imb'] =='1'){
    $permohonan = "SLF";
}else{
    $permohonan = "PBG dan SLF";
}

if ($result_list['id_fungsi_bg'] =='1'){
    $usiabg ='20';
}else{
    $usiabg ='5';
}
$montharray = Array("JANUARI","FEBRUARI","MARET","APRIL","MEI","JUNI","JULI","AGUSTUS","SEPTEMBER","OKTOBER","NOVEMBER","DESEMBER");
if (trim($result_list['date_sk_tk']) != ''){
    $tgl_tek = tgl_eng_to_ind($result_list['date_sk_tk']);
    $tgl_tek2 = explode('-',$tgl_tek);
    $tgl_teknis = $tgl_tek2[0].' '.$montharray [$tgl_tek2[1]-1].' '.$tgl_tek2[2];
}else{
    $tgl_tek = tgl_eng_to_ind($result_list['tgl_sidang']);
    $tgl_tek2 = explode('-',$tgl_tek);
    $tgl_teknis = $tgl_tek2[0].' '.$montharray [$tgl_tek2[1]-1].' '.$tgl_tek2[2];
}
$no_konsultasi = $result_list['no_konsultasi'];
$tgl_pernyataan  = tgl_eng_to_ind($result_list['tgl_pernyataan']);
//membuat halaman baru
$pdf->SetMargins(20, 20, 20);
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetMargins(20, 20, 20, 20);
$pdf->setXY(10, 10);
$pdf->SetFont('Arial', '', 9);
$pdf->image('assets/logo/garuda.png', 100, 10, 20, 20);
$pdf->setXY(20, 40);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 5, "PEMERINTAH REPUBLIK INDONESIA", 0, 1, "C");
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 5, "PERNYATAAN PEMENUHAN STANDAR", 0, 1, "C");
$pdf->Cell(0, 5, "", 0, 1, "L");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(20, 5, "Nomor" , 0, 0, "L");
$pdf->Cell(3, 5, ": " . $result_list['no_sk_tk'], 0, 1, "L");
$pdf->Cell(20, 5, "Lampiran", 0, 0, "L");
$pdf->Cell(3, 5, ": 1 (satu) berkas", 0, 1, "L");
$pdf->Cell(0, 5, "Kepada Yth.", 0, 1, "L");
$pdf->Cell(0, 5,"Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu", 0, 1, "L");
$pdf->Cell(0, 5, "di-", 0, 1, "L");
$pdf->Cell(0, 5, "tempat", 0, 1, "L");
$pdf->Cell(0, 5, "", 0, 1, "L");
$pdf->Cell(15, 5, "Perihal : ", 0, 0, "L");
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 5, "Pernyataan Pemenuhan Standar Teknis Bangunan Gedung", 0, 1, "L");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, "", 0, 1, "L");
$pdf->Cell(0, 5, "Dengan hormat,", 0, 1, "L");
$pdf->MultiCell(0, 5, "Berdasarkan hasil pemeriksaan kesesuaian dokumen rencana teknis yang Saudara sampaikan dengan nomor permohonan $no_konsultasi pada tanggal $tgl_pernyataan , dan dengan memperhatikan berita acara konsultansi oleh TPA/TPT, bersama ini kami nyatakan bahwa dokumen rencana teknis Saudara telah memenuhi standar teknis dengan data sebagai berikut:", 0, "J", 0);
$pdf->Cell(0, 5, "", 0, 1, "L");
$pdf->Cell(20, 5, "", 0, 0, "L");
$pdf->Cell(60, 5, "Nama Pemilik", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, $result_list['nm_pemilik'], 0, 1, "L");
$pdf->Cell(20, 5, "", 0, 0, "L");
$pdf->Cell(60, 5, "Lokasi Bangunan Prasarana", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->MultiCell(0, 5, $result_list['almt_bgn'].', Kel/Desa '.$result_list['nm_kel_bgn'].', Kec. '.$result_list['nm_kec_bgn'].', '.ucwords(strtolower($result_list['nm_kabkot_bgn'])).', Prov '.$result_list['nm_prov_bgn'], 0, "L", 0);
$pdf->Cell(20, 5, "", 0, 0, "L");
$pdf->Cell(60, 5, "Fungsi Bangunan Gedung", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, "Fungsi Prasarana", 0, 1, "L");
$pdf->Cell(20, 5, "", 0, 0, "L");
$pdf->Cell(60, 5, "Jenis Bangunan Gedung ", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, $fungsi['jns_prasarana'], 0, 1, "L"); // Perlu di cek untuk Jenis Bangunan
$pdf->Cell(20, 5, "", 0, 0, "L");
$pdf->Cell(60, 5, "Nama Bangunan Gedung ", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, $result_list['nm_bgn'], 0, 1, "L");
$pdf->Cell(20, 5, "", 0, 0, "L");
$pdf->Cell(60, 5, "Luas Bangunan Prasarana", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->Cell(8, 5, $result_list['luas_bgp'], 0, "L", 0);
$pdf->Cell(4,5,' m',0,0);
$pdf->subWrite(5,'2','',6,4);
$pdf->Cell(10,5,'',0,1);
$pdf->Cell(20, 5, "", 0, 0, "L");
$pdf->Cell(60, 5, "Tinggi Bangunan Prasarana", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5,$result_list['tinggi_bgp'] .' Meter', 0, 1, "L");
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
    if ($row['hat'] != 0) {
        $pdf->Cell(60,5,'Luas Tanah',0,0);
        $pdf->Cell(10,5,(isset($row['luas_tanah']) ? $row['luas_tanah'] : '[ LUAS TANAH KOSONG ]'),0,0);
        $pdf->Cell(4,5,' m',0,0);
        $pdf->subWrite(5,'2','',6,4);
        $pdf->Cell(10,5,'',0,1);
    }
}
} else {
  foreach ($result_tanah as $key => $row) {
		$pdf->Cell(20,5,'',0,0);
		$pdf->Cell(60,5,'Luas tanah',0,0,'L');
		$pdf->Cell(2,5,':',0,0);
		$pdf->Cell(17,5,(isset($row['luas_tanah']) ? $row['luas_tanah'] : '[ LUAS TANAH KOSONG ]'),0,0);
		if ($row['luas_tanah'] != 0 || $row['luas_tanah'] == null){
        $pdf->Cell(4,5,' m',0,0);
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
$pdf->Cell(45);
$pdf->Cell(0,0,$pdf->image(BASE_FILE_PATH2.'QR_Code/'.$result_list['no_konsultasi'].'.png', $pdf->GetX(), $pdf->GetY(), 30,30),0,1);
if($result_list['nm_kadis'] != null){
    $kepala_dinas = $result_list['nm_kadis'];
    $nipkadis = $result_list['nip_kadis'];
}else{
    $kepala_dinas = $result_list['kepala_dinas'];
    $nipkadis = $result_list['nip_kepala_dinas'];
}
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "DITETAPKAN DI  : ".$wilayah, 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "PADA TANGGAL : ".tgl_eng_to_ind($result_list['date_sk_tk']), 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0,5,'ATAS NAMA '.$pejabat.' '.$kabkota,0,1,"L");
if($result_list['stat_pejabat'] == '1'){
    $pdf->Cell(100, 5, "", 0, 0, "L");
    $pdf->MultiCell(0, 5, "PLT KEPALA " .ucwords(strtoupper($result_list['p_nama_dinas'])), 0, "L", 0);
} else if($result_list['stat_pejabat'] == '2'){
    $pdf->Cell(100, 5, "", 0, 0, "L");
    $pdf->MultiCell(0, 5, "PJS KEPALA " .ucwords(strtoupper($result_list['p_nama_dinas'])), 0, "L", 0);
} else if($result_list['stat_pejabat'] == '3'){
    $pdf->Cell(100, 5, "", 0, 0, "L");
    $pdf->MultiCell(0, 5, "KEPALA " .ucwords(strtoupper($result_list['p_nama_dinas'])), 0, "L", 0);
} else if($result_list['stat_pejabat'] == '4'){
    $pdf->Cell(100, 5, "", 0, 0, "L");
    $pdf->MultiCell(0, 5, "PLH KEPALA " .ucwords(strtoupper($result_list['p_nama_dinas'])), 0, "L", 0);
} else{
    $pdf->Cell(100, 5, "", 0, 0, "L");
    $pdf->MultiCell(0, 5, "KEPALA " .ucwords(strtoupper($result_list['p_nama_dinas'])), 0, "L", 0);
}

$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 10, "", 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, $kepala_dinas, 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, $nipkadis, 0, 1, "L");

//Hasil Cetakan Dokumen Sertifikat Laik Fungsi
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
$pdf->Cell(0, 5, "Nomor : ".$result_list['no_slf'], 0, 1, "C");
$pdf->Cell(0, 5, "Berdasarkan Surat Pernyataan Pemeriksaan Kelaikan Fungsi Bangunan Gedung", 0, 1, "C");
$pdf->Cell(0, 5, "Nomor : ".$result_list['no_slf'], 0, 1, "C");
$pdf->Cell(0, 5, "Menyatakan bahwa :", 0, 1, "C");
$pdf->Cell(0, 5, "Nama Bangunan Gedung", 0, 1, "C");
$pdf->Cell(0, 5, $result_list['nm_bgn'], 0, 1, "C");
if($result_list['id_prasarana_bg'] == null || $result_list['id_prasarana_bg'] == '0'){
  $pdf->Cell(0, 5, "Fungsi Bangunan Gedung", 0, 1, "C");
  $pdf->Cell(0, 5, $result_list['fungsi_bg'], 0, 1, "C");
  $pdf->Cell(0, 5, "Klasifikasi Bangunan Gedung", 0, 1, "C");
  $pdf->Cell(0, 5, $fungsi['nm_jenis_bg'], 0, 1, "C");
}else{
  $pdf->Cell(0, 5, "Fungsi Bangunan Gedung", 0, 1, "C");
  $pdf->Cell(0, 5, "Bangunan Prasarana", 0, 1, "C");
  $pdf->Cell(0, 5, "Klasifikasi Bangunan Gedung", 0, 1, "C");
  $pdf->Cell(0, 5, $result_list['jns_prasarana'], 0, 1, "C");
}

if ($result_list['no_imb'] !=''){
  $no_izin_mendirikan = $result_list['no_imb'];
}else{
  $no_izin_mendirikan = "[Belum Memiliki No. IMB/PBG]" ;
}
$pdf->Cell(0, 5, "Nomor PBG", 0, 1, "C");
$pdf->Cell(0, 5, $no_izin_mendirikan, 0, 1, "C");
$pdf->Cell(0, 5, "Nama/Pemilik Bangunan Gedung", 0, 1, "C");
$pdf->Cell(0, 5, $pg['nm_pemilik'], 0, 1, "C");
$pdf->Cell(0, 5, "Lokasi Bangunan Gedung", 0, 1, "C");
$pdf->MultiCell(0, 5,$result_list['almt_bgn'].', Kel/Desa '.$result_list['nm_kel_bgn'].', Kec. '.$result_list['nm_kec_bgn'].', '.ucwords(strtolower($result_list['nm_kabkot_bgn'])).', Prov '.$result_list['nm_prov_bgn'], 0, "C", 0);
$pdf->Cell(0, 5, "Sebagai", 0, 1, "C");
$pdf->Cell(0, 5, "LAIK FUNGSI", 0, 1, "C");
$pdf->Cell(0, 5, "Dalam Batas Okupansi", 0, 1, "C");
$pdf->Cell(0, 5, $result_list['okupansi']." Orang", 0, 1, "C");
//$pdf->Cell(0, 5, "Orang", 0, 1, "C");
$pdf->Cell(0, 5, "sesuai dengan lampiran sertifikat ini", 0, 1, "C");
$pdf->Cell(0, 5, "yang merupakan bagian yang tidak terpisahkan.", 0, 1, "C");
$pdf->Cell(0, 5, "Sertifikat Laik Fungsi ini berlaku selama ".$usiabg." tahun sejak diterbitkan.", 0, 1, "C");
$pdf->Cell(0, 2, "", 0, 1, "L");

$pdf->Cell(0, 10, "", 0, 1, "L");

$pdf->image(BASE_FILE_PATH2.'QR_Code/'.$result_list['no_slf'].'.png', 60, 180, 30, 30);
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "DITETAPKAN DI ".$wilayah, 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "PADA TANGGAL ". tgl_eng_to_ind($result_list['tgl_penerbitan_slf']), 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->MultiCell(0, 5,'ATAS NAMA '.$pejabat.' '.$kabkota,0, "L", 0);


/*if($result_list['stat_pejabat'] =='1'){
  $pdf->Cell(100, 5, "", 0, 0, "L");
  $pdf->MultiCell(0, 5, "PLT KEPALA " .ucwords(strtoupper($result_list['nm_dinas'])), 0, "L", 0);
} else if($result_list['stat_pejabat'] =='2'){
  $pdf->Cell(100, 5, "", 0, 0, "L");
  $pdf->MultiCell(0, 5, "PJS KEPALA " .ucwords(strtoupper($result_list['nm_dinas'])), 0, "L", 0);
} else if($result_list['stat_pejabat'] =='3'){
  $pdf->Cell(100, 5, "", 0, 0, "L");
  $pdf->MultiCell(0, 5, "KEPALA " .ucwords(strtoupper($result_list['nm_dinas'])), 0, "L", 0);
}else{
  $pdf->Cell(100, 5, "", 0, 0, "L");
  $pdf->MultiCell(0, 5, "KEPALA " .ucwords(strtoupper($result_list['nm_dinas'])), 0, "L", 0);
}*/
if($result_list['stat_pejabat'] == '1'){
  $pdf->Cell(100, 5, "", 0, 0, "L");
  $pdf->MultiCell(0, 5, "PLT KEPALA " .ucwords(strtoupper($result_list['p_nama_dinas'])), 0, "L", 0);
} else if($result_list['stat_pejabat'] == '2'){
  $pdf->Cell(100, 5, "", 0, 0, "L");
  $pdf->MultiCell(0, 5, "PJS KEPALA " .ucwords(strtoupper($result_list['p_nama_dinas'])), 0, "L", 0);
} else if($result_list['stat_pejabat'] == '3'){
  $pdf->Cell(100, 5, "", 0, 0, "L");
  $pdf->MultiCell(0, 5, "KEPALA " .ucwords(strtoupper($result_list['p_nama_dinas'])), 0, "L", 0);
} else if($result_list['stat_pejabat'] == '4'){
  $pdf->Cell(100, 5, "", 0, 0, "L");
  $pdf->MultiCell(0, 5, "PLH KEPALA " .ucwords(strtoupper($result_list['p_nama_dinas'])), 0, "L", 0);
} else{
  $pdf->Cell(100, 5, "", 0, 0, "L");
  $pdf->MultiCell(0, 5, "KEPALA " .ucwords(strtoupper($result_list['p_nama_dinas'])), 0, "L", 0);
}

if($result_list['nm_kadis'] != null){
  $kepala_dinas = $result_list['nm_kadis'];
  $nip_kadis_teknis = $result_list['nip_kadis'];
  
}else{
  $kepala_dinas = $result_list['kepala_dinas'];
  $nip_kadis_teknis = $result_list['nip_kepala_dinas'];
}


$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "", 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "", 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, ($result_list['nm_kadis_teknis']), 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
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
$pdf->MultiCell(0, 5,$result_list['almt_bgn'].", Kel/Desa. ".$result_list['nama_kelurahan'].", Kec ".$result_list['nama_kecamatan'].", ".ucwords(strtolower($result_list['nama_kabkota'])).", Prov ".$result_list['nama_provinsi'], 0, "L", 0);
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(70, 5, "Jumlah Lantai Bangunan Gedung", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, $result_list['jml_lantai']. "Lantai", 0, 1, "L");
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(70, 5, "Luas Lantai Bangunan Gedung", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, $result_list['luas_bgn']. " meter persegi", 0, 1, "L");
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(70, 5, "Luas Dasar Bangunan Gedung ", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5,$result_list['luas_dasar']. " meter persegi", 0, 1, "L");
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
$pdf->MultiCell(0, 5, "CATATAN : Lampiran 1 ini merupakan bagian yang tidak terpisahkan dari Sertifikat Laik Fungsi Bangunan Gedung Nomor : ".$result_list['no_slf']." Tanggal ".$tgl_teknis, 0, "L", 0);

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
$pdf->MultiCell(0, 5,$result_list['almt_bgn'].", Kel/Desa. ".$result_list['nama_kelurahan'].", Kec ".$result_list['nama_kecamatan'].", ".ucwords(strtolower($result_list['nama_kabkota'])).", Prov ".$result_list['nama_provinsi'], 0, "L", 0);
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(70, 5, "Jumlah Lantai Bangunan Gedung", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, $result_list['jml_lantai']. "Lantai", 0, 1, "L");
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(70, 5, "Luas Lantai Bangunan Gedung", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, $result_list['luas_bgn']. "m", 0, 1, "L");
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(70, 5, "Luas Dasar Bangunan Gedung ", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5,$result_list['luas_dasar']. " meter persegi", 0, 1, "L");
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(70, 5, "Luas Tanah ", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, "............m", 0, 1, "L");
$pdf->Cell(15, 5, "", 0, 1, "L");
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(0, 70, "", 1, 1, "L");
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->MultiCell(0, 5, "CATATAN : Lampiran 2 ini merupakan bagian yang tidak terpisahkan dari Sertifikat Laik Fungsi Bangunan Gedung Nomor : ".$result_list['no_slf']." Tanggal ".$tgl_teknis, 0, "L", 0);
$pdf->Output('I', 'surat.pdf');
