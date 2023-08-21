<?php
require_once(BASE_FILE_FPDF . '/fpdf.php');
$pdf = new FPDF('P', 'mm', 'A4');
$wilayah = $bt['nm_kabkot_bgn'];
$nilai = substr($wilayah, 0, 3);
if ($nilai == "KAB") {
    $kabkota = "" . substr($wilayah, 5);
    $pejabat = "BUPATI";
} elseif ($nilai == "KOT") {
    if (substr($wilayah, 10, 7) == "JAKARTA") {
        $kabkota = "DKI JAKARTA";
        $pejabat = "GUBERNUR";
    } else {
        $kabkota = substr($wilayah, 5);
        $pejabat = "WALIKOTA";
    }
}
$tgl_skrg               = date('Y-m-d');
$tgl_validasi 			= date('d').date('m').date('Y');
$daftar_hari 			= array( 'Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu' ); 
$montharray 			= Array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$tgl_permohonan		    = tgl_eng_to_ind($bt['tgl_pernyataan']);
$tgl_pernyataan 	    = explode('-',$tgl_permohonan);
$tgl_pernyataan2 	    = $tgl_pernyataan[0].' '.$montharray [$tgl_pernyataan[1]-1].' '.$tgl_pernyataan[2];
if($bt['status'] =='10'){
	$stat				= $bt['status_pejabat'];
	$kepala_dinas 		= $bt['kepala_dinas'];
	$nip_kpl_dinas 		= $bt['nip_kepala_dinas'];	
	$nama_dinas			= $bt['p_nama_dinas'];
	$No_SPPST			= "SPPST-".$bt['id_kec_bgn']."-".$tgl_validasi."-000"."(**: No. SPPST terbentuk otomatis setelah divalidasi Kepala Dinas)";
	$tgl_tek 			= tgl_eng_to_ind($tgl_skrg);
	$tgl_tek2 			= explode('-',$tgl_tek);
	$tgl_penerbitan 	= $tgl_tek2[0].' '.$montharray [$tgl_tek2[1]-1].' '.$tgl_tek2[2];
	$tgl_Gk             = "( **:sesuai tanggal validasi)";
}else{
    if($bt['no_sppst'] == null || $bt['no_sppst'] ==''){
        $No_SPPST			= $bt['no_sk_tk'];
    }else{
        $No_SPPST			= $bt['no_sppst'];
    }
	$stat				= $bt['stat_pejabat'];
	$kepala_dinas 		= $bt['nama_kadis'];
	$nip_kpl_dinas 		= $bt['nip_kadis'];
	$nama_dinas			= $bt['nama_dinas'];	
	$tgl_tek 			= tgl_eng_to_ind($bt['tgl_validasi']);
	$tgl_tek2 			= explode('-',$tgl_tek);
	$tgl_penerbitan 	= $tgl_tek2[0].' '.$montharray [$tgl_tek2[1]-1].' '.$tgl_tek2[2];
    $tgl_Gk             = "";
}

if($stat =='1'){
	$jbt ="PLT ";
}else if($stat =='2'){
	$jbt ="PJS ";
}else if($stat =='3'){
	$jbt ="";
}else if($stat =='4'){
	$jbt ="PLH ";
}else{
	$jbt ="";
}
//membuat halaman baru
$pdf->SetMargins(10, 10, 10);
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetMargins(20,20,20);
//$pdf->SetMargins(10, 10, 10, 10);
$pdf->setXY(10, 10);
$pdf->SetFont('Arial', '', 9);
$pdf->image('assets/logo/garuda.png', 100, 10, 20, 20);
$pdf->setXY(20, 40);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 5, "PEMERINTAH REPUBLIK INDONESIA", 0, 1, "C");
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 5, "PERNYATAAN PEMENUHAN STANDAR TEKNIS BANGUNAN GEDUNG", 0, 1, "C");
$pdf->Cell(0, 5, "", 0, 1, "L");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(18, 5, "Nomor " , 0, "L");
$pdf->Cell(2, 5, ": ", 0, 0, "L");
$pdf->Cell(50, 5,$No_SPPST, 0, 1, "L");
$pdf->Cell(18, 5, "Lampiran ", 0, 0, "L");
$pdf->Cell(2, 5, ": ", 0, 0, "L");
$pdf->Cell(50, 5, "1 (satu) berkas", 0, 1, "L");
$pdf->Cell(0, 5, "Kepada Yth.", 0, 1, "L");
$pdf->Cell(0, 5,"Kepala Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu", 0, 1, "L");
$pdf->Cell(0, 5, "di-", 0, 1, "L");
$pdf->Cell(0, 5, "tempat", 0, 1, "L");
$pdf->Cell(0, 5, "", 0, 1, "L");
$pdf->Cell(15, 5, "Perihal : ", 0, 0, "L");
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 5, "Pernyataan Pemenuhan Standar Teknis Bangunan Gedung", 0, 1, "L");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, "", 0, 1, "L");
$pdf->Cell(0, 5, "Dengan hormat,", 0, 1, "L");
$no_konsultasi = $bt['no_konsultasi'];
$tgl_pernyataan  = tgl_eng_to_ind($bt['tgl_pernyataan']);
$pdf->MultiCell(0, 5, "Berdasarkan hasil pemeriksaan kesesuaian dokumen rencana teknis yang disampaikan dengan nomor permohonan $no_konsultasi pada tanggal $tgl_pernyataan2, dan dengan memperhatikan berita acara konsultansi oleh TPA/TPT, bersama ini kami nyatakan bahwa dokumen rencana teknis Saudara telah memenuhi standar teknis dengan data sebagai berikut:", 0, "J", 0);
$pdf->Cell(0, 5, "", 0, 1, "L");
$pdf->Cell(20, 5, "", 0, 0, "L");
$pdf->Cell(60, 5, "Nama Pemilik", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->MultiCell(0, 5, $bt['nm_pemilik'], 0, "J", 0);
$pdf->Cell(20, 5, "", 0, 0, "L");
$pdf->Cell(60, 5, "Lokasi Bangunan Gedung", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->MultiCell(0, 5, $bt['almt_bgn'] . ', Kel/Desa ' . $bt['nm_kel_bgn'] . ', Kec. ' . $bt['nm_kec_bgn'] . ', ' . ucwords(strtolower($bt['nm_kabkot_bgn'])) . ', Prov ' . $bt['nm_prov_bgn'], 0, "L", 0);

if($bt['id_izin'] == '1'){// Bangunan Tunggal Baru 
	if($bt['id_fungsi_bg'] == '6'){// Fungsi Campuran
		$pdf->Cell(20, 5, "", 0, 0, "L");
		$pdf->Cell(60, 5, "Fungsi Bangunan Gedung", 0, 0, "L");
		$pdf->Cell(2, 5, ":", 0, 0, "L");
		$pdf->Cell(0, 5, $bt['fungsi_bg'], 0, 1, "L");
		$pdf->Cell(20, 5, "", 0, 0, "L");
		$pdf->Cell(60, 5, "Sub Fungsi", 0, 0, "L");
		$pdf->Cell(2, 5, ":", 0, 0, "L");
		$pdf->Cell(0, 5, "Hunian dan Usaha", 0, 1, "L"); 
	}else{//Non Campuran
		$pdf->Cell(20, 5, "", 0, 0, "L");
		$pdf->Cell(60, 5, "Fungsi Bangunan Gedung", 0, 0, "L");
		$pdf->Cell(2, 5, ":", 0, 0, "L");
		$pdf->Cell(0, 5, $bt['fungsi_bg'], 0, 1, "L");
		$pdf->Cell(20, 5, "", 0, 0, "L");
		$pdf->Cell(60, 5, "Sub Fungsi", 0, 0, "L");
		$pdf->Cell(2, 5, ":", 0, 0, "L");
		$pdf->Cell(0, 5, $fungsi['nm_jenis_bg'], 0, 1, "L"); 
	}
}else if($bt['id_izin'] == '2'){// Bangunan Eksisting
	if($bt['permohonan_slf'] =='1'){//Bangunan Tunggal
		$pdf->Cell(20, 5, "", 0, 0, "L");
		$pdf->Cell(60, 5, "Fungsi Bangunan Gedung", 0, 0, "L");
		$pdf->Cell(2, 5, ":", 0, 0, "L");
		$pdf->Cell(0, 5, $bt['fungsi_bg'], 0, 1, "L");
		$pdf->Cell(20, 5, "", 0, 0, "L");
		$pdf->Cell(60, 5, "Sub Fungsi", 0, 0, "L");
		$pdf->Cell(2, 5, ":", 0, 0, "L");
		$pdf->Cell(0, 5, $fungsi['nm_jenis_bg'], 0, 1, "L"); 
	}else if($bt['permohonan_slf'] =='2'){//Bangunan Prasarana
		$pdf->Cell(20, 5, "", 0, 0, "L");
		$pdf->Cell(60, 5, "Fungsi Bangunan Gedung", 0, 0, "L");
		$pdf->Cell(2, 5, ":", 0, 0, "L");
		$pdf->Cell(0, 5, $bt['fungsi_bg'], 0, 1, "L");
		$pdf->Cell(20, 5, "", 0, 0, "L");
		$pdf->Cell(60, 5, "Sub Fungsi", 0, 0, "L");
		$pdf->Cell(2, 5, ":", 0, 0, "L");
		$pdf->Cell(0, 5, $fungsi['jns_prasarana'], 0, 1, "L"); 
	}else if($bt['permohonan_slf'] =='3'){//Bangunan Pertashop
		$pdf->Cell(20, 5, "", 0, 0, "L");
		$pdf->Cell(60, 5, "Fungsi Bangunan Gedung", 0, 0, "L");
		$pdf->Cell(2, 5, ":", 0, 0, "L");
		$pdf->Cell(0, 5, $bt['fungsi_bg'], 0, 1, "L");
		$pdf->Cell(20, 5, "", 0, 0, "L");
		$pdf->Cell(60, 5, "Sub Fungsi", 0, 0, "L");
		$pdf->Cell(2, 5, ":", 0, 0, "L");
		$pdf->Cell(0, 5, $fungsi['nm_jenis_bg'], 0, 1, "L");
	}
}else if($bt['id_izin'] == '3'){// Bangunan Gedung Perubahan
		$pdf->Cell(20, 5, "", 0, 0, "L");
		$pdf->Cell(60, 5, "Fungsi Bangunan Gedung", 0, 0, "L");
		$pdf->Cell(2, 5, ":", 0, 0, "L");
		$pdf->Cell(0, 5, $bt['fungsi_bg'], 0, 1, "L");
		$pdf->Cell(20, 5, "", 0, 0, "L");
		$pdf->Cell(60, 5, "Sub Fungsi", 0, 0, "L");
		$pdf->Cell(2, 5, ":", 0, 0, "L");
		$pdf->Cell(0, 5, $fungsi['nm_jenis_bg'], 0, 1, "L"); 
}else if($bt['id_izin'] == '4'){// Bangunan Kolektif
	$pdf->Cell(20, 5, "", 0, 0, "L");
	$pdf->Cell(60, 5, "Fungsi Bangunan Gedung", 0, 0, "L");
	$pdf->Cell(2, 5, ":", 0, 0, "L");
	$pdf->Cell(0, 5, $bt['fungsi_bg'], 0, 1, "L");
	$pdf->Cell(20, 5, "", 0, 0, "L");
	$pdf->Cell(60, 5, "Jenis Bangunan Gedung ", 0, 0, "L");
	$pdf->Cell(2, 5, ":", 0, 0, "L");
	$pdf->Cell(0, 5, "Perumahan", 0, 1, "L");
}else if($bt['id_izin'] == '5'){// Bangunan Prasarana
	$pdf->Cell(20, 5, "", 0, 0, "L");
	$pdf->Cell(60, 5, "Fungsi Bangunan Gedung", 0, 0, "L");
	$pdf->Cell(2, 5, ":", 0, 0, "L");
	$pdf->Cell(0, 5, "Fungsi Prasarana", 0, 1, "L");
	$pdf->Cell(20, 5, "", 0, 0, "L");
	$pdf->Cell(60, 5, "Sub Fungsi", 0, 0, "L");
	$pdf->Cell(2, 5, ":", 0, 0, "L");
	$pdf->Cell(0, 5, $fungsi['jns_prasarana'], 0, 1, "L");
}else if($bt['id_izin'] == '6'){// Bangunan Cagar Budaya
	$pdf->Cell(20, 5, "", 0, 0, "L");
	$pdf->Cell(60, 5, "Fungsi Bangunan Gedung", 0, 0, "L");
	$pdf->Cell(2, 5, ":", 0, 0, "L");
	$pdf->Cell(0, 5, $bt['fungsi_bg'], 0, 1, "L");
	$pdf->Cell(20, 5, "", 0, 0, "L");
	$pdf->Cell(60, 5, "Sub Fungsi", 0, 0, "L");
	$pdf->Cell(2, 5, ":", 0, 0, "L");
	$pdf->Cell(0, 5, $fungsi['nm_jenis_bg'], 0, 1, "L"); 
}else if($bt['id_izin'] == '7'){// Bangunan Baru pertaShop
	$pdf->Cell(20, 5, "", 0, 0, "L");
	$pdf->Cell(60, 5, "Fungsi Bangunan Gedung", 0, 0, "L");
	$pdf->Cell(2, 5, ":", 0, 0, "L");
	$pdf->Cell(0, 5, $bt['fungsi_bg'], 0, 1, "L");
	$pdf->Cell(20, 5, "", 0, 0, "L");
	$pdf->Cell(60, 5, "Sub Fungsi", 0, 0, "L");
	$pdf->Cell(2, 5, ":", 0, 0, "L");
	$pdf->Cell(0, 5, $fungsi['nm_jenis_bg'], 0, 1, "L");
}else if($bt['id_izin'] == '8'){// Bangunan Baru Bertahap
	
}
$pdf->Cell(20, 5, "", 0, 0, "L");
$pdf->Cell(60, 5, "Nama Bangunan Gedung ", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, $bt['nm_bgn'], 0, 1, "L");
if($bt['id_izin'] == '4'){
    $tipe = json_decode($bt['tipeA']);
    $luas = json_decode($bt['luasA']);
    $tinggi = json_decode($bt['tinggiA']);
    $lantai = json_decode($bt['lantaiA']);
    $jumlah = json_decode($bt['jumlahA']);
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
    $pdf->Cell(20, 5, "", 0, 0, "L");
    $pdf->Cell(60, 5, "Data Bangunan Kolektif ", 0, 0, "L");
    $pdf->Cell(3, 5, ":", 0, 0, "L");
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(9, 5, 'No.', 1, 0,"C");
    $pdf->Cell(15, 5, 'Tipe', 1, 0,"C");
    $pdf->Cell(15, 5, 'Luas', 1, 0,"C");
    $pdf->Cell(15, 5, 'Tinggi', 1, 0,"C");
    $pdf->Cell(15, 5, 'Lantai', 1, 0,"C");
    $pdf->Cell(20,5,'Jumlah Unit',1,1,"C");
    $no = 0;
    $LuasBg = 0;
    $LuasTotal = 0;
    if (!empty($bangunan)) {
        foreach ($bangunan['tipe'] as $dt) {
        $no++;
        $LuasBg += $bangunan['luas'][$no]*$bangunan['jumlah'][$no];
      $LuasType = $bangunan['luas'][$no]*$bangunan['jumlah'][$no];
      $pdf->Cell(20, 5, "", 0, 0, "L");
      $pdf->Cell(60, 5, "", 0, 0, "L");
      $pdf->Cell(3, 5, "", 0, 0, "L");
      $pdf->Cell(9, 5, $no, 1, 0,"C");
      $pdf->Cell(15, 5, $bangunan['tipe'][$no], 1, 0,"C");
      $pdf->Cell(15, 5, $bangunan['luas'][$no], 1, 0,"C");
      $pdf->Cell(15, 5, $bangunan['tinggi'][$no], 1, 0,"C");
      $pdf->Cell(15, 5, $bangunan['lantai'][$no], 1, 0,"C");
      $pdf->Cell(20,5, $bangunan['jumlah'][$no],1,1,"C"); 
    }
  }
  $LuasTotal  = $LuasBg;
  $pdf->Cell(20, 5, "", 0, 0, "L");
  $pdf->Cell(60, 5, "Total Luas Bangunan", 0, 0, "L");
  $pdf->Cell(2, 5, ":", 0, 0, "L");
  $pdf->Cell(0, 5, number_format($LuasTotal,2,',','.')." Meter Persegi", 0, 1, "L");
}else if($bt['id_izin'] == '7'){ // Bangunan PertaShop
    $pdf->Cell(20, 5, "", 0, 0, "L");
    $pdf->Cell(60, 5, "Luas Bangunan", 0, 0, "L");
    $pdf->Cell(2, 5, ":", 0, 0, "L");
    $pdf->Cell(15, 5,number_format($bt['luas_bgp'],2,',','.'), 0, 0, "L");
    $pdf->Cell(4,5,'m',0,0,"L");
	$pdf->subWrite(5,'2','',6,4);
	$pdf->Cell(10,5,'',0,1);
    $pdf->Cell(20, 5, "", 0, 0, "L");
    $pdf->Cell(60, 5, "Ketinggian Bangunan", 0, 0, "L");
    $pdf->Cell(2, 5, ":", 0, 0, "L");
    $pdf->Cell(0, 5, $bt['tinggi_bgp']. ' Meter', 0, 1, "L");
}else if($bt['id_izin'] == '5'){
	$pdf->Cell(20, 5, "", 0, 0, "L");
    $pdf->Cell(60, 5, "Luas Bangunan Prasarana", 0, 0, "L");
    $pdf->Cell(2, 5, ":", 0, 0, "L");
    $pdf->Cell(15, 5,number_format($bt['luas_bgp'],2,',','.'), 0, 0, "L");
    $pdf->Cell(4,5,'m',0,0,"L");
	$pdf->subWrite(5,'2','',6,4);
	$pdf->Cell(10,5,'',0,1);
    $pdf->Cell(20, 5, "", 0, 0, "L");
    $pdf->Cell(60, 5, "Ketinggian Bangunan Prasarana", 0, 0, "L");
    $pdf->Cell(2, 5, ":", 0, 0, "L");
    $pdf->Cell(0, 5, $bt['tinggi_bgp']. ' Meter', 0, 1, "L");  
}else if($bt['id_izin'] == '2'){
	if($bt['permohonan_slf'] == '1'){
		$pdf->Cell(20, 5, "", 0, 0, "L");
		$pdf->Cell(60, 5, "Luas Bangunan Gedung", 0, 0, "L");
		$pdf->Cell(2, 5, ":", 0, 0, "L");
		$total_luas =  $bt['luas_bgn'] + $bt['luas_basement'];
		$pdf->Cell(26, 5, "Total Luas", 0, 0, "L");
		$pdf->Cell(2,5,':',0,0);
		$pdf->Cell(15, 5,number_format($total_luas,2,',','.'), 0, 0, "L");
		$pdf->Cell(4,5,' m',0,0);
		$pdf->subWrite(5,'2','',6,4);
		$pdf->Cell(10,5,'',0,1);

		$pdf->Cell(83, 5, "", 0, 0, "L");
		$pdf->Cell(25, 5, "Luas Lantai", 0, 0, "L");
		$pdf->Cell(2,5,':',0,0);
		$pdf->Cell(15, 5,number_format($bt['luas_bgn'],2,',','.'), 0, 0, "L");
		$pdf->Cell(4,5,' m',0,0);
		$pdf->subWrite(5,'2','',6,4);
		$pdf->Cell(10,5,'',0,1);

		$pdf->Cell(83, 5, "", 0, 0, "L");
		$pdf->Cell(25, 5, "Luas Basemen", 0, 0, "L");
		$pdf->Cell(2,5,':',0,0);
		$pdf->Cell(15, 5,number_format($bt['luas_basement'],2,',','.'), 0, 0, "L");
		$pdf->Cell(4,5,' m',0,0);
		$pdf->subWrite(5,'2','',6,4);
		$pdf->Cell(10,5,'',0,1);
		
		$pdf->Cell(20, 5, "", 0, 0, "L");
		$pdf->Cell(60, 5, "Jumlah Lantai/Tinggi Bangunan", 0, 0, "L");
		$pdf->Cell(2, 5, ":", 0, 0, "L");
		$pdf->Cell(0, 5, $bt['jml_lantai'] . ' Lantai / ' . $bt['tinggi_bgn'] . ' Meter', 0, 1, "L");
	}else if($bt['permohonan_slf'] == '2'){
		$pdf->Cell(20, 5, "", 0, 0, "L");
		$pdf->Cell(60, 5, "Luas Bangunan Prasraana", 0, 0, "L");
		$pdf->Cell(2, 5, ":", 0, 0, "L");
		$pdf->Cell(15, 5,number_format($bt['luas_bgp'],2,',','.'), 0, 0, "L");
		$pdf->Cell(4,5,'m',0,0,"L");
		$pdf->subWrite(5,'2','',6,4);
		$pdf->Cell(10,5,'',0,1);
		$pdf->Cell(20, 5, "", 0, 0, "L");
		$pdf->Cell(60, 5, "Ketinggian Bangunan Prasarana", 0, 0, "L");
		$pdf->Cell(2, 5, ":", 0, 0, "L");
		$pdf->Cell(0, 5, $bt['tinggi_bgp']. ' Meter', 0, 1, "L");
	}else if($bt['permohonan_slf'] == '3'){// Bangunan Eksisting Pertashop
		$pdf->Cell(20, 5, "", 0, 0, "L");
		$pdf->Cell(60, 5, "Luas Bangunan", 0, 0, "L");
		$pdf->Cell(2, 5, ":", 0, 0, "L");
		$pdf->Cell(15, 5,number_format($bt['luas_bgp'],2,',','.'), 0, 0, "L");
		$pdf->Cell(4,5,'m',0,0,"L");
		$pdf->subWrite(5,'2','',6,4);
		$pdf->Cell(10,5,'',0,1);
		$pdf->Cell(20, 5, "", 0, 0, "L");
		$pdf->Cell(60, 5, "Ketinggian Bangunan", 0, 0, "L");
		$pdf->Cell(2, 5, ":", 0, 0, "L");
		$pdf->Cell(0, 5, $bt['tinggi_bgp']. ' Meter', 0, 1, "L");
	}
}else{
    $pdf->Cell(20, 5, "", 0, 0, "L");
	$pdf->Cell(60, 5, "Luas Bangunan Gedung", 0, 0, "L");
	$pdf->Cell(2, 5, ":", 0, 0, "L");
	$total_luas =  $bt['luas_bgn'] + $bt['luas_basement'];
	$pdf->Cell(26, 5, "Total Luas", 0, 0, "L");
	$pdf->Cell(2,5,':',0,0);
	$pdf->Cell(18, 5,number_format($total_luas,2,',','.'), 0, 0, "L");
	$pdf->Cell(4,5,' m',0,0);
    $pdf->subWrite(5,'2','',6,4);
	$pdf->Cell(10,5,'',0,1);
	$pdf->Cell(83, 5, "", 0, 0, "L");
	$pdf->Cell(25, 5, "Luas Lantai", 0, 0, "L");
	$pdf->Cell(2,5,':',0,0);
	$pdf->Cell(18, 5,number_format($bt['luas_bgn'],2,',','.'), 0, 0, "L");
	$pdf->Cell(4,5,' m',0,0);
    $pdf->subWrite(5,'2','',6,4);
	$pdf->Cell(10,5,'',0,1);
	$pdf->Cell(83, 5, "", 0, 0, "L");
	$pdf->Cell(25, 5, "Luas Basemen", 0, 0, "L");
	$pdf->Cell(2,5,':',0,0);
	$pdf->Cell(18, 5,number_format($bt['luas_basement'],2,',','.'), 0, 0, "L");
	$pdf->Cell(4,5,' m',0,0);
    $pdf->subWrite(5,'2','',6,4);
	$pdf->Cell(10,5,'',0,1);
    $pdf->Cell(20, 5, "", 0, 0, "L");
    $pdf->Cell(60, 5, "Jumlah Lantai/Tinggi Bangunan", 0, 0, "L");
    $pdf->Cell(2, 5, ":", 0, 0, "L");
    $pdf->Cell(0, 5, $bt['jml_lantai'] . ' Lantai / ' . $bt['tinggi_bgn'] . ' Meter', 0, 1, "L");
}
$j=1;
if ($count_tanah>1) {
	$pdf->Cell(20,5,'',0,0);
    $pdf->Cell(60,5,'Data Tanah',0,0,'L');
    $pdf->Cell(2,5,':',0,0);
    foreach ($result_tanah as $key => $row) {
		$hat = $row['hat'];
		if($j > 1){
			$pdf->Cell(39,5,'',0,0);
		}
        $pdf->Cell(23,5,$j++.'.Atas Nama',0,0);
        $pdf->Cell(2,5,':',0,0);
        $pdf->MultiCell(65,5,(isset($row['atas_nama_dok']) ? $row['atas_nama_dok'] : '[ PEMILIK TANAH KOSONG ]'),0,"L",0);
        if ($row['hat'] != 0) {
            $pdf->Cell(85,5,'',0,0);
            $pdf->Cell(20,5,'Dokumen',0,0);
            $pdf->Cell(2,5,':',0,0);
            $pdf->Cell(15,5,(isset($row['Jns_dok']) ? $row['Jns_dok'] : '[ HAK ATAS TANAH KOSONG ]'),0,1);
            $pdf->Cell(85,5,'',0,0);
            $pdf->Cell(20,5,'No. Surat',0,0);
            $pdf->Cell(2,5,':',0,0);
            $pdf->Cell(15,5,(isset($row['no_dok']) ? $row['no_dok'] : '[ NO DOKUMEN KOSONG ]'),0,1);
            $pdf->Cell(85,5,'',0,0);
            $pdf->Cell(20,5,'Luas',0,0);
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
			$pdf->Cell(20,5,'',0,0);
			$pdf->Cell(60,5,'Hak atas tanah',0,0,'L');
			$pdf->Cell(2,5,':',0,0);
			$pdf->Cell(17,5,(isset($row['Jns_dok']) ? $row['Jns_dok'] : '[ HAK ATAS TANAH KOSONG ]'),0,1);
		}
		$pdf->Cell(20,5,'',0,0);
		$pdf->Cell(60,5,'Luas tanah',0,0,'L');
		$pdf->Cell(2,5,':',0,0);
		$pdf->Cell(18,5,(isset($row['luas_tanah']) ? $row['luas_tanah'] : '[ LUAS TANAH KOSONG ]'),0,0);
		if ($row['luas_tanah'] != 0 || $row['luas_tanah'] == null){
			$pdf->Cell(3,5,'m',0,0);
			$pdf->subWrite(5,'2','',6,4);
			$pdf->Cell(10,5,'',0,1);
		}
		$pdf->Cell(20,5,'',0,0);
		$pdf->Cell(60,5,'Pemilik Tanah',0,0,'L');
		$pdf->Cell(2,5,": ",0,0);
		$pdf->MultiCell(95,5,(isset($row['atas_nama_dok']) ? $row['atas_nama_dok'] : '[ PEMILIK TANAH KOSONG ]'),0,1);
	}
}
$pdf->Cell(0, 5, "", 0, 1, "L");
if($bt['id_izin'] =='2'){
	if($bt['imb'] =='1'){
		$pdf->Cell(58, 5, "Dengan demikian permohonan SLF", 0, 0, "L");
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(0, 5, "dapat dilakukan dan dapat diterbitkan segera.", 0, 1, "L");
	}else{
		$pdf->Cell(72, 5, "Dengan demikian permohonan PBG dan SLF", 0, 0, "L");
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(0, 5, "dapat dilakukan dan dapat diterbitkan segera.", 0, 1, "L");
	}
}else{
	$pdf->Cell(58, 5, "Dengan demikian permohonan PBG", 0, 0, "L");
	$pdf->SetFont('Arial', 'B', 10);
	$pdf->Cell(0, 5, "dapat dilakukan dan dapat diterbitkan segera.", 0, 1, "L");
}
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, "", 0, 1, "L");
$pdf->MultiCell(0, 5, "Demikian surat pernyataan ini kami sampaikan. Atas perhatian dan kerja sama Saudara, kami ucapkan terima kasih.", 0, "L", 0);
$pdf->Cell(0,5,'',0,1);
$pdf->Cell(25);
$pdf->Cell(0,0,$pdf->image(BASE_FILE_PATH2.'QR_Code/'.$bt['no_konsultasi'].'.png', $pdf->GetX(), $pdf->GetY(), 35,35),0,1);

$pdf->Cell(75, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "DITETAPKAN DI  : ".$wilayah, 0, 1, "L");
$pdf->Cell(75, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "PADA TANGGAL : ". $tgl_penerbitan."".$tgl_Gk, 0, 1, "L");
$pdf->Cell(75, 5, "", 0, 0, "L");
$pdf->Cell(0,5,'ATAS NAMA '.$pejabat.' '.$kabkota,0,1,"L");
$pdf->Cell(75, 5, "", 0, 0, "L");
$pdf->MultiCell(0, 5, $jbt."KEPALA " .ucwords(strtoupper($nama_dinas)), 0, "L", 0);

$pdf->Cell(75, 5, "", 0, 0, "L");
$pdf->Cell(0, 10, "", 0, 1, "L");
$pdf->Cell(75, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, $kepala_dinas, 0, 1, "L");
$pdf->Cell(75, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "NIP. ".$nip_kpl_dinas, 0, 1, "L");
$pdf->Output('I', "SPPST-".$no_konsultasi.'.pdf');
