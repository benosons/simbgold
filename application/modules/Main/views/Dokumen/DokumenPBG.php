<?php
require_once(BASE_FILE_FPDF . '/fpdf.php');
$pdf = new FPDF('P', 'mm', 'Letter');
$wilayah = $bg['nama_kabkota'];
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
if($bg['id_izin'] =='1'){
  $peruntukan = "Bangunan Baru";
}else if($bg['id_izin'] =='2'){
 $peruntukan = "Bangunan Eksisting";
}else if($bg['id_izin'] =='4'){
  $peruntukan = "Bangunan Kolektif";
}else{
  $peruntukan = "Belum Ditentukan";
}

$montharray = Array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
if (trim($bg['date_sk_tk']) != ''){
  $tgl_tek = tgl_eng_to_ind($bg['date_sk_tk']);
  $tgl_tek2 = explode('-',$tgl_tek);
  $tgl_teknis = $tgl_tek2[0].' '.$montharray [$tgl_tek2[1]-1].' '.$tgl_tek2[2];
  }else{
  $tgl_tek = tgl_eng_to_ind($bg['tgl_sidang']);
  $tgl_tek2 = explode('-',$tgl_tek);
  $tgl_teknis = $tgl_tek2[0].' '.$montharray [$tgl_tek2[1]-1].' '.$tgl_tek2[2];
  }
//membuat halaman baru
$pdf->SetMargins(10, 10, 10);
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetMargins(10, 10, 10, 10);
$pdf->setXY(5, 10);
$pdf->SetFont('Arial', '', 9);
$pdf->image('assets/logo/garuda.png', 100, 10, 20, 20);
//$pdf->image('file/LogoKabKota/BackGround_pbg.png', 75,75,59,100);
$pdf->setXY(10, 40);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 5, "PEMERINTAH REPUBLIK INDONESIA", 0, 1, "C");
$pdf->Cell(0, 5, "PERSETUJUAN BANGUNAN GEDUNG", 0, 1, "C");
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 5, "Nomor : ".$bg['no_izin_pbg'], 0, 1, "C");
$pdf->Cell(0, 5, "", 0, 1, "C");
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40, 5, "Membaca", 0, 0, "L");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, ": Permohonan Persetujuan Bangunan Gedung", 0, 1, "L");
$pdf->Cell(42, 5, "", 0, 0, "L");
$pdf->Cell(50, 5, "Nomor", 0, 0, "L");
$pdf->Cell(0, 5, ": ".$bg['no_izin_pbg']." Tanggal ".tgl_eng_to_ind($bg['tgl_pbg']), 0, 1, "L");
$pdf->Cell(42, 5, "", 0, 0, "L");
$pdf->Cell(50, 5, "Nama pemohon/Pemilik", 0, 0, "L");
$pdf->Cell(0, 5, ": ".$pg['nm_pemilik'], 0, 1, "L");
$pdf->Cell(42, 5, "", 0, 0, "L");
$pdf->Cell(50, 5, "Bangunan gedung", 0, 0, "L");
$pdf->Cell(0, 5, ": ".$bg['nm_bgn'], 0, 1, "L");
$pdf->Cell(42, 5, "", 0, 0, "L");
$pdf->Cell(50, 5, "Alamat", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->MultiCell(0, 5,$bg['almt_bgn'].', Kel/Desa '.$bg['nama_kelurahan'].', Kec. '.$bg['nama_kecamatan'].', '.ucwords(strtolower($bg['nama_kabkota'])).', Prov '.$bg['nama_provinsi'], 0, "L", 0);
$pdf->Cell(42, 5, "", 0, 0, "L");
$pdf->Cell(50, 5, "Untuk", 0, 0, "L");
$pdf->MultiCell(0, 5,": ".$peruntukan, 0, "L", 0);
$pdf->Cell(42, 5, "", 0, 0, "L");
$pdf->Cell(50, 5, "Fungsi bangunan gedung ", 0, 0, "L");
$pdf->Cell(0, 5, ": ".$bg['fungsi_bg'], 0, 1, "L");
$pdf->Cell(42, 5, "", 0, 0, "L");
if ($bg['luas_bgn'] >= '100'){
  $klasifikasi ='Bangunan Tidak Sederhana';
}else{
  $klasifikasi = 'Bangunan Sederhana';
}
$pdf->Cell(50, 5, "Klasifikasi bangunan Gedung", 0, 0, "L");
$pdf->Cell(0, 5, ": $klasifikasi", 0, 1, "L");
$pdf->Cell(42, 5, "", 0, 0, "L");
$pdf->Cell(50, 5, "Nama bangunan gedung", 0, 0, "L");
$pdf->Cell(0, 5, ": ".$bg['nm_bgn'], 0, 1, "L");

if($bg['id_izin'] == '4'){
  $tipe = json_decode($bg['tipeA']);
  $luas = json_decode($bg['luasA']);
  $tinggi = json_decode($bg['tinggiA']);
  $lantai = json_decode($bg['lantaiA']);
  $bangunan = array();
  foreach ($tipe as $noo => $val) {
    if ($val != "")
      $bangunan['tipe'][$noo] = $val;
  }
  foreach ($luas as $noo => $val) {
    if ($val != "")
      $bangunan['luas'][$noo] = $val;
  }
  foreach ($tinggi as $noo => $val) {
    if ($val != "")
      $bangunan['tinggi'][$noo] = $val;
  }
  if (!empty($lantai))
    foreach ($lantai as $noo => $val) {
      if ($val != "")
        $bangunan['lantai'][$noo] = $val;
    }

  $pdf->Cell(42, 5, "", 0, 0, "L");
  $pdf->Cell(50, 5, "Data Bangunan Kolektif ", 0, 0, "L");
  $pdf->Cell(3, 5, ":", 0, 0, "L");
  $pdf->SetFont('Arial', '', 10);
  $pdf->Cell(15, 5, 'Tipe', 1, 0,"C");
  $pdf->Cell(15, 5, 'Luas', 1, 0,"C");
  $pdf->Cell(15, 5, 'Tinggi', 1, 0,"C");
  $pdf->Cell(15, 5, 'Lantai', 1, 0,"C");
  $pdf->Cell(20,5,'Jumlah Unit',1,1,"C");
  $no = 0;
  if (!empty($bangunan)) {
    foreach ($bangunan['tipe'] as $dt) {
      $no++;
      $pdf->Cell(42, 5, "", 0, 0, "L");
      $pdf->Cell(50, 5, "", 0, 0, "L");
      $pdf->Cell(3, 5, "", 0, 0, "L");
      $pdf->Cell(15, 5, $bangunan['tipe'][$no], 1, 0,"C");
      $pdf->Cell(15, 5, $bangunan['luas'][$no], 1, 0,"C");
      $pdf->Cell(15, 5, $bangunan['tinggi'][$no], 1, 0,"C");
      $pdf->Cell(15, 5, $bangunan['lantai'][$no], 1, 0,"C");
      $pdf->Cell(20,5, $bangunan['tipe'][$no],1,1,"C"); 
    }
  }
  $pdf->Cell(42, 5, "", 0, 0, "L");
  $pdf->Cell(50, 5, "Luas bangunan gedung ", 0, 0, "L");
  $pdf->Cell(0, 5, ": ".$bg['luas_bgn'], 0, 1, "L");
} else {
  $pdf->Cell(42, 5, "", 0, 0, "L");
  $pdf->Cell(50, 5, "Luas bangunan gedung ", 0, 0, "L");
  $pdf->Cell(0, 5, ": ".$bg['luas_bgn'], 0, 1, "L");
  
}


$pdf->Cell(41, 5, "", 0, 0, "L");
$j=0;
if ($count_tanah>1) {
  //Table Tanah lebih dari 1 Data
  $pdf->Cell(01, 5, "", 0, 0, "L");
  $pdf->Cell(50, 5, "Data Tanah ", 0, 0, "L");
  $pdf->Cell(3, 5, ":", 0, 1, "L");

  $pdf->Cell(01, 6, "", 0, 0, "L");
  $pdf->Cell(42, 6, "", 0, 0, "L");
  $pdf->SetFont('Arial', '', 10);
  $pdf->Cell(5, 5, 'No.', 1, 0,"C");
  $pdf->Cell(55, 5, 'Atas Nama', 1, 0,"C");
  $pdf->Cell(25, 5, 'No. Dokumen', 1, 0,"C");
  $pdf->Cell(25, 5, 'Jenis Dokumen', 1, 0,"C");
  $pdf->Cell(25, 5, 'Luas Tanah', 1, 1,"C");
  $no = 0;
  foreach ($result_tanah as $key => $row) {
    $j++;
    /*$pdf->Cell(41, 5, "", 0, 0, "L");
    $pdf->Cell(01, 5, "", 0, 0, "L");
    $pdf->Cell(50, 5, "", 0, 0, "L");*/
    //$pdf->Cell(1, 5, "", 0, 0, "L");
    $pdf->Cell(01, 5, "", 0, 0, "L");
    $pdf->Cell(42, 5, "", 0, 0, "L");
    $pdf->Cell(5, 5,$j, 1, 0,"C");
    $pdf->Cell(55, 5,$row['atas_nama_dok'], 1, 0,"L");
    $pdf->Cell(25, 5, $row['no_dok'], 1, 0,"C");
    $pdf->Cell(25, 5,$row['Jns_dok'], 1, 0,"C");
    $pdf->Cell(25, 5,$row['luas_tanah'], 1, 1,"C");
    //$pdf->Cell(20,5, $bangunan['tipe'][$no],1,1,"C"); 
  }
  /*if (!empty($result_tanah)) {
    foreach ($bangunan['tipe'] as $dt) {
      $no++;
      $pdf->Cell(42, 5, "", 0, 0, "L");
      $pdf->Cell(50, 5, "", 0, 0, "L");
      $pdf->Cell(3, 5, "", 0, 0, "L");
      $pdf->Cell(15, 5, $bangunan['tipe'][$no], 1, 0,"C");
      $pdf->Cell(15, 5, $bangunan['luas'][$no], 1, 0,"C");
      $pdf->Cell(15, 5, $bangunan['tinggi'][$no], 1, 0,"C");
      $pdf->Cell(15, 5, $bangunan['lantai'][$no], 1, 0,"C");
      $pdf->Cell(20,5, $bangunan['tipe'][$no],1,1,"C"); 
    }
  }*/


  /*$pdf->Cell(1,5,'',0,0);
  $pdf->Cell(50,5,'Hak atas tanah',0,0,'L');
  $pdf->Cell(2,5,':',0,0);
  foreach ($result_tanah as $key => $row) {
    $hat = $row['hat'];
    if($j > 1){
      $pdf->Cell(1,5,'',0,0);
      $pdf->Cell(93,5,'',0,0);
    }
    $pdf->Cell(34,5,$j++.'. Atas Nama',0,0);
    $pdf->MultiCell(50,5,(isset($row['atas_nama_dok']) ? ucwords(strtolower($row['atas_nama_dok'])) : '[ PEMILIK TANAH KOSONG ]'),0,1);
    if ($row['hat'] != 0) {
      $pdf->Cell(2,5,'',0,0);
      $pdf->Cell(96,5,'',0,0);
      $pdf->Cell(30,5,'Jenis Dokumen',0,0);
      $pdf->Cell(40,5,(isset($row['Jns_dok']) ? $row['Jns_dok'] : '[ HAK ATAS TANAH KOSONG ]'),0,1);
      $pdf->Cell(2,5,'',0,0);
      $pdf->Cell(96,5,'',0,0);
      $pdf->Cell(30,5,'Luas Tanah',0,0);
      $pdf->Cell(10,5,(isset($row['luas_tanah']) ? $row['luas_tanah'] : '[ LUAS TANAH KOSONG ]'),0,0);
      $pdf->Cell(5,5,' meter persegi',0,0);
      //$pdf->subWrite(5,'2','',6,4);
      $pdf->Cell(10,5,'',0,1);
    }
  }*/
} else {
  foreach ($result_tanah as $key => $row) {
		if ($row['hat'] != 0) {
			$hat = $row['hat'];
			$pdf->Cell(1,5,'',0,0);
			$pdf->Cell(50,5,'Hak atas tanah',0,0,'L');
			$pdf->Cell(2,5,':',0,0);
			$pdf->Cell(17,5,(isset($row['Jns_dok']) ? $row['Jns_dok'] : '[ HAK ATAS TANAH KOSONG ]'),0,1);
		}
		$pdf->Cell(42,5,'',0,0);
		$pdf->Cell(50,5,'Luas tanah',0,0,'L');
		$pdf->Cell(2,5,':',0,0);
		$pdf->Cell(18,5,(isset($row['luas_tanah']) ? $row['luas_tanah'] : '[ LUAS TANAH KOSONG ]'),0,0);
		if ($row['luas_tanah'] != 0 || $row['luas_tanah'] == null){
			$pdf->Cell(6,5,' meter persegi',0,0);
			//$pdf->subWrite(5,'2','',6,4);
			$pdf->Cell(10,5,'',0,1);
		}
		$pdf->Cell(42,5,'',0,0);
		$pdf->Cell(50,5,'Pemilik Tanah',0,0,'L');
		$pdf->Cell(2,5,": ",0,0);
		$pdf->MultiCell(95,5,(isset($row['atas_nama_dok']) ? ucwords(strtolower($row['atas_nama_dok'])) : '[ PEMILIK TANAH KOSONG ]'),0,1);
	}
}


$pdf->Cell(42,5,'',0,0);
$pdf->Cell(50, 5, "Terletak di", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->MultiCell(0, 5,$bg['almt_bgn'].', Kel/Desa '.$bg['nama_kelurahan'].', Kec. '.$bg['nama_kecamatan'].', '.ucwords(strtolower($bg['nama_kabkota'])).', Prov '.$bg['nama_provinsi'], 0, "L", 0);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0,5,'',0,1);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40, 5, "Menimbang", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(0, 5, "Bahwa setelah memeriksa (mencatat/meneliti), mengkaji, dan menilai /evaluasi serta menyetujui dokumen rencana teknis bangunan gedung sebagaimana dimaksud di atas dengan ini disahkan, maka terhadap permohonan persetujuan bangunan gedung yang dimaksud dapat diberikan persetujuan dengan ketentuan sebagaimana dalam lampiran keputusan ini.", 0, "J", 0);
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
if ($bg['id_fungsi_bg'] != 1) {
	$pdf->MultiCell(0,5,'Berita Acara Hasil Pemeriksaan Dokumen Rencana Teknis TPA Gedung Nomor '.$bg['no_sk_tk'].' tanggal '.$tgl_teknis.' (untuk Bangunan Gedung Kepentingan Umum)',0,'J',0);
} else {
	$pdf->MultiCell(0,5,'Berita Acara Hasil Pemeriksaan Dokumen Rencana Teknis TPT Dinas PUPR/Dinas Teknis yang membidangi Bangunan Gedung Nomor '.$bg['no_sk_tk'].' tanggal '.$tgl_teknis.' (untuk Bangunan Gedung Bukan Kepentingan Umum)',0,'J',0);
}

$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetMargins(10, 10, 10);
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
$pdf->Cell(0, 5, ": ".$pg['nm_pemilik'], 0, 1, "L");

$pdf->Cell(48, 5, "", 0, 0, "L");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 5, "Atas nama pemilik", 0, 0, "L");
$pdf->Cell(0, 5, ": ".$pg['nm_pemilik'], 0, 1, "L");

$pdf->Cell(48, 5, "", 0, 0, "L");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 5, "Bangunan gedung", 0, 0, "L");
$pdf->Cell(0, 5, ": ".$bg['nm_bgn'], 0, 1, "L");

$pdf->Cell(48, 5, "", 0, 0, "L");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 5, "Alamat", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->MultiCell(0, 5,$bg['almt_bgn'].', Kel/Desa '.$bg['nama_kelurahan'].', Kec. '.$bg['nama_kecamatan'].', '.ucwords(strtolower($bg['nama_kabkota'])).', Prov '.$bg['nama_provinsi'], 0, "L", 0);

$pdf->Cell(48, 5, "", 0, 0, "L");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 5, "Untuk", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->MultiCell(0, 5,$peruntukan. " sebagaimana dijelaskan dalam gambar situasi Lampiran b dan rencana teknis, meliputi gambar arsitektur, gambar konstruksi bangunan gedung, dan gambar utilitas (mekanikal dan elektrikal), pembekuan dan pencabutan PBG Lampiran c, dan penghitungan besarnya retribusi PBG dalam Lampiran d Keputusan ini:", 0, "J", 0);

$pdf->Cell(40, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "2.", 0, 0, "L");
$pdf->MultiCell(0, 5, "Besarnya retribusi yang harus dibayar oleh pemohon sebagaimana
Dimaksud dalam Lampiran d Keputusan ini sebesar:", 0, "L", 0);

$pdf->Cell(55, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "a.", 0, 0, "L");
$pdf->Cell(70, 5, "Retribusi pembinaan penyelenggaraan", 0, 0, "L");
$pdf->Cell(0, 5, "Rp. ".number_format($bg['nilai_retribusi_keseluruhan'],0,'','.'), 0, 1, "L");
$pdf->Cell(60, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "Bangunan gedung", 0, 1, "L");

/*$pdf->Cell(55, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "b.", 0, 0, "L");
$pdf->Cell(70, 5, "Retribusi administrasi PBG. *)", 0, 0, "L");
$pdf->Cell(0, 5, "Rp. ....................", 0, 1, "L");

$pdf->Cell(55, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "c.", 0, 0, "L");
$pdf->Cell(70, 5, "Retribusi penyediaan formular", 0, 0, "L");
$pdf->Cell(0, 5, "Rp. ....................+", 0, 1, "L");

$pdf->Cell(55, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "", 0, 0, "L");
$pdf->Cell(70, 5, "Jumlah ............................", 0, 0, "L");
$pdf->Cell(0, 5, "Rp. ", 0, 1, "L");*/

$pdf->Cell(55, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, '( '.terbilang($bg['nilai_retribusi_keseluruhan']).' rupiah )', 0, 1, "L");

$pdf->Cell(55, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "*) untuk perubahan PBG atas permintaan pemilik.", 0, 1, "L");

$pdf->Cell(40, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "3.", 0, 0, "L");
$pdf->MultiCell(0, 5, "Lampiran Keputusan ini merupakan satu kesatuan yang tidak terpisahkan dari Keputusan ini;", 0, "L", 0);

$pdf->Cell(40, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "4.", 0, 0, "L");
$pdf->MultiCell(0, 5, "Hal-hal yang belum diatur dalam Keputusan ini akan ditetapkan kemudian;", 0, "L", 0);

$pdf->Cell(40, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "5.", 0, 0, "L");
$pdf->MultiCell(0, 5, "Salinan Keputusan ini diberikan kepada yang berkepentingan; dan", 0, "L", 0);

$pdf->Cell(40, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "6.", 0, 0, "L");
$pdf->MultiCell(0, 5, "Keputusan ini mulai berlaku sejak tanggal diterbitkan.", 0, "L", 0);

$pdf->Cell(0, 10, "", 0, 1, "L");
$pdf->image(BASE_FILE_PATH.'Konsultasi/QR_Code/'.$bg['no_izin_pbg'].'.png', 60, 140, 30, 30);
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "DITETAPKAN DI : ".$kabkota, 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "PADA TANGGAL : ".date('d-m-Y'), 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0,5,'ATAS NAMA '.$pejabat.' '.$kabkota,0,1,"L");
$pdf->Cell(100, 5, "", 0, 0, "L");
//$pdf->MultiCell(0, 5, "KEPALA " .ucwords(strtoupper($nm_dinas)), 0, "L", 0);
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 10, "", 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, $bg['nm_kadis'], 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "NIP : ".$bg['nip_kadis'], 0, 1, "L");
$pdf->Output('I', 'surat.pdf');
