<?php
require_once(BASE_FILE_FPDF . '/fpdf.php');
$pdf = new FPDF('P', 'mm', 'A4');
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
}else if($bg['id_izin'] =='5') {
  $peruntukan = "Bangunan Prasarana";
} else {
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
$pdf->SetMargins(20, 20, 20);
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetMargins(20, 20, 20, 20);
$pdf->setXY(5, 10);
$pdf->SetFont('Arial', '', 9);
$pdf->image('assets/logo/garuda.png', 100, 10, 20, 20);
$pdf->setXY(20, 40);
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
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->MultiCell(0, 5,$pg['nm_pemilik'], 0, "L", 0);
$pdf->Cell(42, 5, "", 0, 0, "L");
$pdf->Cell(50, 5, "Bangunan gedung", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->MultiCell(0, 5,$bg['nm_bgn'], 0, "L", 0);
$pdf->Cell(42, 5, "", 0, 0, "L");
$pdf->Cell(50, 5, "Alamat", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->MultiCell(0, 5,$pg['alamat'].', Kel/Desa '.$pg['nama_kelurahan'].', Kec. '.$pg['nama_kecamatan'].', '.ucwords(strtolower($pg['nama_kabkota'])).', Prov '.$pg['nama_provinsi'], 0, "L", 0);
$pdf->Cell(42, 5, "", 0, 0, "L");
$pdf->Cell(50, 5, "Untuk", 0, 0, "L");
$pdf->MultiCell(0, 5,": ".$peruntukan, 0, "L", 0);

if ($bg['id_izin'] == '5') {
  $pdf->Cell(42, 5, "", 0, 0, "L");
  $pdf->Cell(50, 5, "Fungsi Bangunan Gedung", 0, 0, "L");
  $pdf->Cell(2, 5, ":", 0, 0, "L");
  $pdf->Cell(0, 5, "Fungsi Prasarana", 0, 1, "L");
} else if ($bg['id_izin'] == '4') {
  $pdf->Cell(42, 5, "", 0, 0, "L");
  $pdf->Cell(50, 5, "Fungsi Bangunan Gedung", 0, 0, "L");
  $pdf->Cell(2, 5, ":", 0, 0, "L");
  $pdf->Cell(0, 5, "Fungsi Hunian", 0, 1, "L");
} else {
  $pdf->Cell(42, 5, "", 0, 0, "L");
  $pdf->Cell(50, 5, "Fungsi Bangunan Gedung", 0, 0, "L");
  $pdf->Cell(2, 5, ":", 0, 0, "L");
  $pdf->Cell(0, 5, $bg['fungsi_bg'], 0, 1, "L");
}
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
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->MultiCell(0, 5,$bg['nm_bgn'], 0, "L", 0);

if($bg['id_jenis_permohonan'] == '11'){
  $tipe = json_decode($bg['tipeA']);
  $luas = json_decode($bg['luasA']);
  $tinggi = json_decode($bg['tinggiA']);
  $lantai = json_decode($bg['lantaiA']);
  $jumlah = json_decode($bg['jumlahA']);
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
  if (!empty($jumlah))
    foreach ($jumlah as $noo => $val) {
      if ($val != "")
        $bangunan['jumlah'][$noo] = $val;
    }

  $pdf->Cell(42, 5, "", 0, 0, "L");
  $pdf->Cell(50, 5, "Data Bangunan Kolektif ", 0, 0, "L");
  $pdf->Cell(3, 5, ":", 0, 0, "L");
  $pdf->SetFont('Arial', '', 10);
  $pdf->Cell(9, 5, 'No.', 1, 0,"C");
  $pdf->Cell(12, 5, 'Tipe', 1, 0,"C");
  $pdf->Cell(13, 5, 'Luas', 1, 0,"C");
  $pdf->Cell(13, 5, 'Tinggi', 1, 0,"C");
  $pdf->Cell(13, 5, 'Lantai', 1, 0,"C");
  $pdf->Cell(20,5,'Jumlah Unit',1,1,"C");
  $no = 0;
  $LuasBg = 0;
  $LuasTotal = 0;
  if (!empty($bangunan)) {
    foreach ($bangunan['tipe'] as $dt) {
      $no++;
      $LuasBg += $bangunan['luas'][$no]*$bangunan['jumlah'][$no];
      $LuasType = $bangunan['luas'][$no]*$bangunan['jumlah'][$no];
      $pdf->Cell(42, 5, "", 0, 0, "L");
      $pdf->Cell(50, 5, "", 0, 0, "L");
      $pdf->Cell(3, 5, "", 0, 0, "L");
      $pdf->Cell(9, 5, $no, 1, 0,"C");
      $pdf->Cell(12, 5, $bangunan['tipe'][$no], 1, 0,"C");
      $pdf->Cell(13, 5, $bangunan['luas'][$no], 1, 0,"C");
      $pdf->Cell(13, 5, $bangunan['tinggi'][$no], 1, 0,"C");
      $pdf->Cell(13, 5, $bangunan['lantai'][$no], 1, 0,"C");
      $pdf->Cell(20,5, $bangunan['jumlah'][$no],1,1,"C"); 
    }
  }
  $LuasTotal  = $LuasBg;
  $pdf->Cell(42, 5, "", 0, 0, "L");
  $pdf->Cell(50, 5, "Total Luas Bangunan", 0, 0, "L");
  $pdf->Cell(2, 5, ":", 0, 0, "L");
  $pdf->Cell(0, 5, number_format($LuasTotal,2,',','.')." Meter Persegi", 0, 1, "L");
} else if($bg['id_jenis_permohonan'] == '12'){
  $pdf->Cell(42, 5, "", 0, 0, "L");
  $pdf->Cell(50, 5, "Luas Bangunan Prasarana ", 0, 0, "L");
  $pdf->Cell(19, 5, ": ".number_format($bg['luas_bgp'],2,',','.'), 0, 0);
  $pdf->Cell(4,5,' meter persegi',0,1,"L");
} else {
  $pdf->Cell(42, 5, "", 0, 0, "L");
  $pdf->Cell(50, 5, "Luas Bangunan Gedung ", 0, 0, "L");
  $pdf->Cell(0, 5, ": ".$bg['luas_bgn'], 0, 1, "L");
}
$pdf->Cell(41, 5, "", 0, 0, "L");
$j=0;
$k=1;
if ($count_tanah>1) {
  $pdf->Cell(1,5,'',0,0); 
    $pdf->Cell(50,5,'Data Tanah',0,0,'L');
    $pdf->Cell(2,5,':',0,0);
    foreach ($result_tanah as $key => $row) {
      $hat = $row['hat'];
      if($k > 1){
        $pdf->Cell(54,5,'',0,0);
      }
      $pdf->Cell(23,5,$k++.'. Atas Nama',0,0);
      $pdf->Cell(2,5,':',0,0);
      $pdf->MultiCell(60,5,(isset($row['atas_nama_dok']) ? ucwords(strtolower($row['atas_nama_dok'])) : '[ PEMILIK TANAH KOSONG ]'),0,"L",0);
      if ($row['hat'] != 0) {
        $pdf->Cell(100,5,'',0,0);
        $pdf->Cell(19,5,'Dokumen',0,0);
        $pdf->Cell(2,5,':',0,0);
        $pdf->Cell(15,5,(isset($row['Jns_dok']) ? $row['Jns_dok'] : '[ HAK ATAS TANAH KOSONG ]'),0,1);
        $pdf->Cell(100,5,'',0,0);
        $pdf->Cell(19,5,'Luas',0,0);
        $pdf->Cell(2,5,':',0,0);
        $pdf->Cell(14,5,(isset($row['luas_tanah']) ? number_format($row['luas_tanah'],2,',','.') : '[ LUAS TANAH KOSONG ]'),0,0);
        $pdf->Cell(4,5,' m',0,0);
        $pdf->subWrite(5,'2','',6,4);
        $pdf->Cell(10,5,'',0,1);
      }
      $pdf->Cell(42,5,'',0,0);
    }
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
  $pdf->Cell(42,5,'',0,0);
}

//$pdf->Cell(42,5,'',0,1);
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
	$pdf->MultiCell(0,5,'Berita Acara Hasil Pemeriksaan Dokumen Rencana Teknis TPA Gedung Nomor '.$bg['no_sk_tk'].' Tanggal '.$tgl_teknis.' (untuk Bangunan Gedung Kepentingan Umum)',0,'J',0);
} else {
	$pdf->MultiCell(0,5,'Berita Acara Hasil Pemeriksaan Dokumen Rencana Teknis TPT Dinas PUPR/Dinas Teknis yang membidangi Bangunan Gedung Nomor '.$bg['no_sk_tk'].' Tanggal '.$tgl_teknis.' (untuk Bangunan Gedung Bukan Kepentingan Umum)',0,'J',0);
}

if($bg['id_kabkot_bgn'] =='1371' || $bg['id_kabkot_bgn'] =='6303' || $bg['id_kabkot_bgn'] =='5171' || $bg['id_kabkot_bgn'] =='3404'|| $bg['id_kabkot_bgn'] =='7271'){ 
  $pdf->Cell(0, 2, "", 0, 1, "L");
}else{
  $pdf->AddPage();
}
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetMargins(20, 20, 20);
$pdf->SetFont('Arial', 'B', 12);
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
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5,$pg['nm_pemilik'], 0, 1, "L");


//$pdf->Cell(0, 5, ": ".$pg['nm_pemilik'], 0, 1, "L");
$pdf->Cell(48, 5, "", 0, 0, "L");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 5, "Atas nama pemilik", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
if($bg['id'] =='106560'){
  $pdf->MultiCell(0, 5,"Parisada Hindu Dharma Indonesia Provinsi Sulawesi Tengah", 0, "L", 0);
}else{
  $pdf->MultiCell(0, 5,$pg['nm_pemilik'], 0, "L", 0);
}
//$pdf->Cell(0, 5, ": ".$pg['nm_pemilik'], 0, 1, "L");

$pdf->Cell(48, 5, "", 0, 0, "L");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 5, "Bangunan gedung", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->MultiCell(0, 5,$bg['nm_bgn'], 0, "L", 0);

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
$pdf->Cell(70, 5, "Retribusi Persetujuan Bangunan Gedung", 0, 0, "L");
$pdf->Cell(0, 5, "Rp. ".number_format($bg['nilai_retribusi_keseluruhan'],0,'','.'), 0, 1, "L");
//$pdf->Cell(60, 5, "", 0, 1, "L");
//$pdf->Cell(0, 5, "", 0, 1, "L");

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
$pdf->MultiCell(0, 5, '( '.terbilang($bg['nilai_retribusi_keseluruhan']).' rupiah )', 0, "L", 0);

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

/*$pdf->Cell(0, 10, "", 0, 1, "L");
$pdf->image(BASE_FILE_PATH.'Konsultasi/QR_Code/'.$bg['no_izin_pbg'].'.png', 60, 140, 30, 30);*/
$pdf->Cell(0,5,'',0,1);
$pdf->Cell(45);
$pdf->Cell(0,0,$pdf->image(BASE_FILE_PATH2.'QR_Code/'.$bg['no_izin_pbg'].'.png', $pdf->GetX(), $pdf->GetY(), 30,30),0,1);


$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "DITETAPKAN DI : ".$kabkota, 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "PADA TANGGAL : ".tgl_eng_to_ind($bg['tgl_pbg']), 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0,5,'ATAS NAMA '.$pejabat.' '.$kabkota,0,1,"L");

if($bg['status'] == '13'){
  if($bg['stat_pejabat'] =='1'){
    $pdf->Cell(100, 5, "", 0, 0, "L");
    $pdf->MultiCell(0, 5, "PLT KEPALA " .ucwords(strtoupper($bg['p_nama_dinas'])), 0, "L", 0);
  } else if($bg['stat_pejabat'] =='2'){
    $pdf->Cell(100, 5, "", 0, 0, "L");
    $pdf->MultiCell(0, 5, "PJS KEPALA " .ucwords(strtoupper($bg['p_nama_dinas'])), 0, "L", 0);
  } else if($bg['stat_pejabat'] =='3'){
    $pdf->Cell(100, 5, "", 0, 0, "L");
    $pdf->MultiCell(0, 5, "KEPALA " .ucwords(strtoupper($bg['p_nama_dinas'])), 0, "L", 0);
  }else if($bg['stat_pejabat'] =='4'){
    $pdf->Cell(100, 5, "", 0, 0, "L");
    $pdf->MultiCell(0, 5, "PLH KEPALA " .ucwords(strtoupper($bg['p_nama_dinas'])), 0, "L", 0);
  }else{
    $pdf->Cell(100, 5, "", 0, 0, "L");
    $pdf->MultiCell(0, 5, "KEPALA " .ucwords(strtoupper($bg['p_nama_dinas'])), 0, "L", 0);
  }
}else{
  if($bg['status_pejabat'] == '1'){
    $pdf->Cell(100, 5, "", 0, 0, "L");
    $pdf->MultiCell(0, 5, "PLT KEPALA " .ucwords(strtoupper($bg['p_nama_dinas'])), 0, "L", 0);
  } else if($bg['status_pejabat'] == '2'){
    $pdf->Cell(100, 5, "", 0, 0, "L");
    $pdf->MultiCell(0, 5, "PJS KEPALA " .ucwords(strtoupper($bg['p_nama_dinas'])), 0, "L", 0);
  } else if($bg['status_pejabat'] == '3'){
    $pdf->Cell(100, 5, "", 0, 0, "L");
    $pdf->MultiCell(0, 5, "KEPALA " .ucwords(strtoupper($bg['p_nama_dinas'])), 0, "L", 0);
  } else if($bg['status_pejabat'] == '4'){
    $pdf->Cell(100, 5, "", 0, 0, "L");
    $pdf->MultiCell(0, 5, "PLH KEPALA " .ucwords(strtoupper($bg['p_nama_dinas'])), 0, "L", 0);
  } else{
    $pdf->Cell(100, 5, "", 0, 0, "L");
    $pdf->MultiCell(0, 5, "KEPALA " .ucwords(strtoupper($bg['p_nama_dinas'])), 0, "L", 0);
  }
}
//$pdf->Cell(100, 5, "", 0, 0, "L");
//$pdf->MultiCell(0, 5, "KEPALA " .ucwords(strtoupper($bg['p_nama_dinas'])), 0, "L", 0);
if($bg['nip_kadis'] =='' || $bg['nip_kadis'] == null){
  $kadis = $bg['kepala_dinas'];
  $nip   = $bg['nip_kepala_dinas'];
}else{
  $kadis = $bg['nm_kadis'];
  $nip   = $bg['nip_kadis'];
}


$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 10, "", 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, $kadis, 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "NIP : ".$nip, 0, 1, "L");


//Data SLF 
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
}
//membuat halaman baru
$pdf->SetMargins(20, 20, 20);
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetMargins(20, 20, 20, 20);
$pdf->setXY(10, 15);
//$pdf->image('assets/gambar/bg.PNG', 0, 0, 220, 280, '', '', '', false, 300, '', false, false, 0);
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
$pdf->MultiCell(100, 10, ucwords(strtoupper($bg['p_nama_dinas'])), 0, "L", 0);
//$pdf->Cell(90, 10, "", 0, 0, "L");
//$pdf->Cell(0, 10, $bg['nama_kabkota'], 0, 1, "L");
//$pdf->image('assets/gambar/barcode.PNG', 150, 225, 30, 30);


$pdf->SetMargins(20, 20, 20);
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
$pdf->Cell(0, 5, "Nomor : ".$bg['no_slf'], 0, 1, "C");
$pdf->Cell(0, 5, "Berdasarkan Surat Pernyataan Pemeriksaan Kelaikan Fungsi Bangunan Gedung", 0, 1, "C");
$pdf->Cell(0, 5, "Nomor : ".$bg['no_slf']. " Tanggal : ".$tgl_teknis, 0, 1, "C");
$pdf->Cell(0, 5, "Menyatakan bahwa :", 0, 1, "C");
$pdf->Cell(0, 5, "Nama Bangunan Gedung", 0, 1, "C");
$pdf->Cell(0, 5, $bg['nm_bgn'], 0, 1, "C");
$pdf->Cell(0, 5, "Fungsi Bangunan Gedung", 0, 1, "C");
$pdf->Cell(0, 5, $bg['fungsi_bg'], 0, 1, "C");
$pdf->Cell(0, 5, "Klasifikasi Bangunan Gedung", 0, 1, "C");
$pdf->Cell(0, 5, $fungsi['nm_jenis_bg'], 0, 1, "C");
if ($bg['no_imb'] =='' || $bg['no_imb'] == null || $bg['no_imb'] == 0){
  //$no_izin_mendirikan = $bg['no_slf'];
  //$no_izin_mendirikan = $bg['no_imb'];
  $no_izin_mendirikan = $bg['no_izin_pbg'];
}else {
  //$no_izin_mendirikan = $bg['no_izin_pbg'];
  $no_izin_mendirikan = $bg['no_imb'];
}
$pdf->Cell(0, 5, "Nomor PBG", 0, 1, "C");
$pdf->Cell(0, 5, $no_izin_mendirikan, 0, 1, "C");
$pdf->Cell(0, 5, "Nama/Pemilik Bangunan Gedung", 0, 1, "C");
$pdf->Cell(0, 5, $pg['nm_pemilik'], 0, 1, "C");
$pdf->Cell(0, 5, "Lokasi Bangunan Gedung", 0, 1, "C");
$pdf->MultiCell(0, 5,$bg['almt_bgn'].', Kel/Desa '.$bg['nama_kelurahan'].', Kec. '.$bg['nama_kecamatan'].', '.ucwords(strtolower($bg['nama_kabkota'])).', Prov '.$bg['nama_provinsi'], 0, "C", 0);
$pdf->Cell(0, 5, "Sebagai", 0, 1, "C");
$pdf->Cell(0, 5, "LAIK FUNGSI", 0, 1, "C");
$pdf->Cell(0, 5, "Dalam Batas Okupansi", 0, 1, "C");
$pdf->Cell(0, 5, $bg['okupansi']." Orang", 0, 1, "C");
$pdf->Cell(0, 5, "sesuai dengan lampiran sertifikat iniI", 0, 1, "C");
$pdf->Cell(0, 5, "yang merupakan bagian yang tidak terpisahkan.", 0, 1, "C");
$pdf->Cell(0, 5, "Sertifikat Laik Fungsi ini berlaku selama ".$usiabg." tahun sejak diterbitkan.", 0, 1, "C");
$pdf->Cell(0, 2, "", 0, 1, "L");

$pdf->Cell(0, 10, "", 0, 1, "L");
//$pdf->Cell(0,0,$pdf->image(BASE_FILE_PATH2.'QR_Code/'.$bg['no_slf'].'.png', $pdf->GetX(), $pdf->GetY(), 30,30),0,1);
$pdf->image(BASE_FILE_PATH2.'QR_Code/'.$bg['no_slf'].'.png', 60, 180, 30, 30);
$pdf->Cell(100, 5, "", 0, 0, "L");
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
$pdf->Cell(0, 5, $bg['luas_bgn']. " meter persegi", 0, 1, "L");
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
$pdf->MultiCell(0, 5, "CATATAN : Lampiran 2 ini merupakan bagian yang tidak terpisahkan dari Sertifikat Laik Fungsi Bangunan Gedung Nomor : ".$bg['no_slf']." Tanggal ".$tgl_teknis, 0, "L", 0);

$pdf->Output('I', 'surat.pdf');
