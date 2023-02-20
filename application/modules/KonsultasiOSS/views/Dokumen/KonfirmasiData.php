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
}else if($bg['id_izin'] =='5') {
  $peruntukan = "Bangunan Prasarana";
} else if($bg['id_izin'] =='3'){
  $peruntukan = "Bangunan Baru";
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
$pdf->Cell(0, 5, "Nomor : - ", 0, 1, "C");
$pdf->Cell(0, 5, "", 0, 1, "C");
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40, 5, "Membaca", 0, 0, "L");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, ": Permohonan Persetujuan Bangunan Gedung", 0, 1, "L");
$pdf->Cell(42, 5, "", 0, 0, "L");
$pdf->Cell(50, 5, "Nomor", 0, 0, "L");
$pdf->Cell(0, 5, ": -  Tanggal - ", 0, 1, "L");
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
  $pdf->Cell(8, 5, 'No.', 1, 0,"C");
  $pdf->Cell(18, 5, 'Tipe', 1, 0,"C");
  $pdf->Cell(15, 5, 'Luas', 1, 0,"C");
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
      $pdf->Cell(8, 5, $no, 1, 0,"C");
      $pdf->Cell(18, 5, $bangunan['tipe'][$no], 1, 0,"C");
      $pdf->Cell(15, 5, $bangunan['luas'][$no], 1, 0,"C");
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
  //$pdf->Cell(0, 5, ": ".$bg['luas_bgn'], 0, 1, "L");
  $pdf->Cell(0, 5, ": ".number_format($bg['luas_bgn'],2,',','.'), 0, 1, "L");
}
$pdf->Cell(41, 5, "", 0, 0, "L");
$j=0;
$k=1;
if ($count_tanah>1) {
  //Table Tanah lebih dari 1 Data
  if($bg['id'] =='23906' || $bg['id'] =='19279' || $bg['id'] =='7701' || $bg['id'] =='33918' || $bg['id'] =='13515' || $bg['id'] =='45907' || $bg['id'] =='15111' || $bg['id'] =='36804' || $bg['id'] =='33292'){
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
      $pdf->MultiCell(65,5,(isset($row['atas_nama_dok']) ? ucwords(strtolower($row['atas_nama_dok'])) : '[ PEMILIK TANAH KOSONG ]'),0,"L",0);
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
  }else{
    $pdf->Cell(01, 5, "", 0, 0, "L");
    $pdf->Cell(50, 5, "Data Tanah ", 0, 0, "L");
    $pdf->Cell(3, 5, ":", 0, 1, "L");
    //$pdf->Cell(42,5,'',0,1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(43, 5, " ", 0, 0, "L");
    $pdf->Cell(5, 5, 'No.', 1, 0,"C");
    $pdf->Cell(53, 5, 'Atas Nama', 1, 0,"C");
    $pdf->Cell(25, 5, 'No. Dokumen', 1, 0,"C");
    $pdf->Cell(25, 5, 'Jenis Dokumen', 1, 0,"C");
    $pdf->Cell(25, 5, 'Luas Tanah', 1, 0,"C");
    $no = 0;
    foreach ($result_tanah as $key => $row) {
      $j++;
      $pdf->Cell(41, 5, "", 0, 0, "L");
      $pdf->Cell(01, 5, "", 0, 0, "L");
      $pdf->Cell(50, 5, "", 0, 0, "L");
      $pdf->Cell(3, 5, "", 0, 1, "L");
      $pdf->Cell(43, 5, " ", 0, 0, "L");
      $pdf->Cell(5, 5,$j, 1, 0,"C");
      $pdf->Cell(53, 5,$row['atas_nama_dok'], 1, 0,"L");
      $pdf->Cell(25, 5, $row['no_dok'], 1, 0,"C");
      $pdf->Cell(25, 5,$row['Jns_dok'], 1, 0,"C");
      $pdf->Cell(25, 5,$row['luas_tanah'], 1, 0,"C");
    }
    $pdf->Cell(42,5,'',0,1);
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

      $pdf->Cell(1,5,'',0,0);
      $pdf->Cell(41,5,'',0,0);
      $pdf->Cell(50,5,'Luas tanah',0,0,'L');
      $pdf->Cell(2,5,':',0,0);
      $pdf->Cell(17,5,(isset($row['luas_tanah']) ?   number_format($row['luas_tanah'],2,',','.'): '[ LUAS TANAH KOSONG ]'),0,0);
      if ($row['luas_tanah'] != 0 || $row['luas_tanah'] == null){
        $pdf->Cell(6,5,' meter persegi',0,0);
        //$pdf->subWrite(5,'2','',6,4);
        $pdf->Cell(10,5,'',0,1);
      }
      $pdf->Cell(42,5,'',0,0);
      $pdf->Cell(50,5,'Pemilik Tanah',0,0,'L');
      $pdf->Cell(2,5,": ",0,0);
      $pdf->MultiCell(95,5,(isset($row['atas_nama_dok']) ? ucwords(strtolower($row['atas_nama_dok'])) : '[ PEMILIK TANAH KOSONG ]'),0,1);
      $pdf->Cell(42,5,'',0,0);
    }else{
      $pdf->Cell(1,5,'',0,0);
    }
	}
}
//$pdf->Cell(42,5,'',0,0);
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
//$pdf->Cell(2,5,'',0,0);
$pdf->SetFont('ARIAL','',10);
if ($bg['id_fungsi_bg'] != 1) {
	$pdf->MultiCell(0,5,'Berita Acara Hasil Pemeriksaan Dokumen Rencana Teknis TPA Gedung Nomor '.$bg['no_sk_tk'].' Tanggal '.$tgl_teknis.' (untuk Bangunan Gedung Kepentingan Umum)',0,'J',0);
} else {
	$pdf->MultiCell(0,5,'Berita Acara Hasil Pemeriksaan Dokumen Rencana Teknis TPT Dinas PUPR/Dinas Teknis yang membidangi Bangunan Gedung Nomor '.$bg['no_sk_tk'].' Tanggal '.$tgl_teknis.' (untuk Bangunan Gedung Bukan Kepentingan Umum)',0,'J',0);
}

if($bg['id_kabkot_bgn'] =='1371' ){
  if($bg['id'] == '23906' ||$bg['id'] == '13515' ||$bg['id'] == '36804'){
    $pdf->AddPage();
  }else{
    $pdf->Cell(0, 2, "", 0, 1, "L");
  }
}else if($bg['id_kabkot_bgn'] =='6303'){
  if($bg['id'] != '27116'){
    //$pdf->AddPage();
  }else{
    
  }
}else if($bg['id_kabkot_bgn'] =='5106'){
  if($bg['id'] != '28679'){
    $pdf->AddPage();
  }else{
    
  }
}else if($bg['id_kabkot_bgn'] =='3273'){
  if($bg['id'] == '33292'){
    
  }else{
    $pdf->AddPage();
  }

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
$pdf->MultiCell(0, 5,$pg['nm_pemilik'], 0, "L", 0);

$pdf->Cell(48, 5, "", 0, 0, "L");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 5, "Atas nama pemilik", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->MultiCell(0, 5,$pg['nm_pemilik'], 0, "L", 0);

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

$pdf->Cell(0,5,'',0,1);
$pdf->Cell(45);
$pdf->Cell(0,0,$pdf->image(BASE_FILE_PATH.'Konsultasi/QR_Code/'.$bg['no_izin_pbg'].'.png', $pdf->GetX(), $pdf->GetY(), 30,30),0,1);

$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "DITETAPKAN DI : ".$kabkota, 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "PADA TANGGAL : ".tgl_eng_to_ind($bg['tgl_pbg']), 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0,5,'ATAS NAMA '.$pejabat.' '.$kabkota,0,1,"L");
$pdf->Cell(100, 5, "", 0, 0, "L");
if($bg['id'] !='45907'){
$pdf->MultiCell(0, 5, "KEPALA " .ucwords(strtoupper($bg['p_nama_dinas'])), 0, "L", 0);
}else{
  $pdf->MultiCell(0, 5, "PLT KEPALA " .ucwords(strtoupper($bg['p_nama_dinas'])), 0, "L", 0);

}
if($bg['id_kabkot_bgn'] !='3577'){
  $pdf->Cell(100, 5, "", 0, 0, "L");
  $pdf->Cell(0, 10, "", 0, 1, "L");
}else{

}
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, $bg['nm_kadis'], 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "NIP : ".$bg['nip_kadis'], 0, 1, "L");
$pdf->Output('I', 'surat.pdf');
