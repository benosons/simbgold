<?php
require_once(BASE_FILE_FPDF . '/fpdf.php');
$pdf = new FPDF('P', 'mm', 'A4');
$wilayah = $bg['nama_kabkota'];
$nilai = substr($wilayah,0,3);
if ($nilai == "KAB") {
    $kabkota = "".substr($wilayah,5);
    $pejabat = "BUPATI";
		$lokasi_dinas = "KABUPATEN";
} elseif ($nilai == "KOT") {
    if (substr($wilayah,10,7) == "JAKARTA") {
        $kabkota = $wilayah;
        $pejabat = "GUBERNUR";
		$lokasi_dinas = "PROVINSI";
    } else {
        $kabkota = substr($wilayah,5);
        $pejabat = "WALIKOTA";
		$lokasi_dinas = "KOTA";
    }
}
$tgl_skrg               = date('Y-m-d');
$tgl_validasi 			= date('d').date('m').date('Y');
$daftar_hari 			= array( 'Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu' ); 
$montharray 			= Array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
if($bg['status'] =='13'){
	$kepala_dinas 		= $bg['kepala_dinas'];
	$nip_kpl_dinas 		= $bg['nip_kepala_dinas'];	
	$nama_dinas			= $bg['p_nama_dinas'];
	$sk_izin			= "SK-PBG-".$bg['id_kec_bgn']."-".$tgl_validasi."-000";
	$tgl_tek 			= tgl_eng_to_ind($tgl_skrg);
	$tgl_tek2 			= explode('-',$tgl_tek);
	$tgl_penerbitan 	= $tgl_tek2[0].' '.$montharray [$tgl_tek2[1]-1].' '.$tgl_tek2[2];
	$date				= $tgl_skrg;
	$tgl_valkadintek	= tgl_eng_to_ind($bg['tgl_validasi']);
	$tgl_valkadintek2	= explode('-',$tgl_valkadintek);
	$tgl_valkadintek3 	= $tgl_valkadintek2[0].' '.$montharray [$tgl_valkadintek2[1]-1].' '.$tgl_valkadintek2[2];
	$status_sk			= $bg['status_pej'];
}else{
	$kepala_dinas 		= $bg['nm_kadis'];
	$nip_kpl_dinas 		= $bg['nip_kadis'];
	$nama_dinas			= $bg['p_nama_dinas'];	
	$sk_izin			= $bg['no_izin_pbg'];
	$tgl_tek 			= tgl_eng_to_ind($bg['tgl_pbg']);
	$tgl_tek2 			= explode('-',$tgl_tek);
	$tgl_penerbitan 	= $tgl_tek2[0].' '.$montharray [$tgl_tek2[1]-1].' '.$tgl_tek2[2];
	$date				= $bg['tgl_pbg'];
	$tgl_valkadintek	= tgl_eng_to_ind($bg['tgl_validasi']);
	$tgl_valkadintek2	= explode('-',$tgl_valkadintek);
	$tgl_valkadintek3 	= $tgl_valkadintek2[0].' '.$montharray [$tgl_valkadintek2[1]-1].' '.$tgl_valkadintek2[2];
	$status_sk			= $bg['status_pejabat'];
}

if($status_sk =='1'){
	$s_pejabat	="Plt ";
}else if($status_sk =='2'){
	$s_pejabat	="Pjs ";
}else if($status_sk =='3'){
	$s_pejabat	="";
}else if($status_sk =='4'){
	$s_pejabat	="Plh ";
}else{
	$s_pejabat	="";
}

$namahari 		= date('l', strtotime($date)); 
//Menentukan "Untuk"
if($bg['id_izin'] =='1'){
	$untuk ='Mendirikan Bangunan Gedung Baru';
}else if($bg['id_izin'] =='2'){
	if($bg['permohonan_slf'] =='1'){
		$untuk ='Mendirikan Bangunan Gedung Baru';
	}else if ($bg['permohonan_slf'] =='2'){
		$untuk ='Mendirikan Bangunan Gedung Baru';
	}else if ($bg['permohonan_slf'] =='3'){
		$untuk ='Mendirikan Bangunan Gedung Baru';
	}else{
		$untuk ='Belum Ditentukan';
	}
}else if($bg['id_izin'] =='3'){
	$untuk ='Mendirikan Bangunan Gedung Baru';
}else if($bg['id_izin'] =='4'){
	$untuk ='Mendirikan Bangunan Gedung Baru';
}else if($bg['id_izin'] =='5'){
	$untuk ='Mendirikan Bangunan Prasarana Baru';
}else if($bg['id_izin'] =='7'){
	$untuk ='Mendirikan Bangunan Gedung Baru';
}

if($bg['id_klasifikasi'] =='1'){
	$klasifikasi ="Sederhana";
}else if($bg['id_klasifikasi'] =='2'){
	$klasifikasi ="Tidak Sederhana";
}else if($bg['id_klasifikasi'] =='3'){
	$klasifikasi ="Khusus";
}else{
	$klasifikasi ="Belum Ditentukan";
}

if($bg['id_kelas'] =='1'){
	$kelas ="Klas 1b";
}else if ($bg['id_kelas'] =='2'){
	$kelas ="Klas 1b";
}else if ($bg['id_kelas'] =='3'){
	$kelas ="Klas 2";
}else if ($bg['id_kelas'] =='4'){
	$kelas ="Klas 3";
}else if ($bg['id_kelas'] =='5'){
	$kelas ="Klas 4";
}else if ($bg['id_kelas'] =='6'){
	$kelas ="Klas 5";
}else if ($bg['id_kelas'] =='7'){
	$kelas ="Klas 6";
}else if ($bg['id_kelas'] =='8'){
	$kelas ="Klas 7";
}else if ($bg['id_kelas'] =='9'){
	$kelas ="Klas 8";
}else if ($bg['id_kelas'] =='10'){
	$kelas ="Klas 9a";
}else if ($bg['id_kelas'] =='11'){
	$kelas ="Klas 9b";
}else if ($bg['id_kelas'] =='12'){
	$kelas ="Klas 10a";
}else if ($bg['id_kelas'] =='13'){
	$kelas ="Klas 10b";
}

/*if($pg['jns_pemilik'] =='1'){
	$status_pemilik ='Pemerintah';
}else if($pg['jns_pemilik'] =='2'){
	$status_pemilik ='Badan Usaha';
}else if($pg['jns_pemilik'] =='3'){
	$status_pemilik ='Perorangan';
}else{
	$status_pemilik ='Perorangan';
}*/


//membuat halaman baru
$pdf->SetMargins(20, 20, 20);
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetMargins(20, 20, 20, 20);
$pdf->setXY(5, 10);
$pdf->SetFont('Times', '', 9);
$pdf->image('assets/logo/garuda.png', 100, 10, 20, 20);
//$pdf->image('file/LogoKabKota/BackGround_pbg.png', 75,75,59,100);
$pdf->setXY(20, 40);
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(0, 5, "PEMERINTAH REPUBLIK INDONESIA", 0, 1, "C");
$pdf->Cell(0, 5, "PERSETUJUAN BANGUNAN GEDUNG", 0, 1, "C");
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(0, 5, "", 0, 1, "C");
$pdf->Cell(0, 5, "NOMOR: ".$sk_izin, 0, 1, "C");
$pdf->Cell(0, 5, "", 0, 1, "C");
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(40, 5, "Membaca", 0, 0, "L");
$pdf->SetFont('Times', '', 10);
$pdf->Cell(0, 5, ": Permohonan Persetujuan Bangunan Gedung", 0, 1, "L");
$pdf->Cell(42, 5, "", 0, 0, "L");

$pdf->Cell(50, 5, "Nomor", 0, 0, "L");
$pdf->Cell(4, 5, ":", 0, 0, "L");
$pdf->MultiCell(0, 5,$bg['no_konsultasi'], 0, "J", 0);
$pdf->Cell(42, 5, "", 0, 0, "L");

$pdf->Cell(50, 5,"Pemilik Bangunan Gedung", 0, 0, "L");
$pdf->Cell(4, 5, ":", 0, 0, "L");
$pdf->MultiCell(0, 5,$pg['nm_pemilik'], 0, "J", 0);
$pdf->Cell(42, 5, "", 0, 0, "L");

$pdf->Cell(49, 5,"Alamat Pemilik", 0, 0, "L");
$pdf->Cell(5, 5, ": ", 0, "L", 0);
$pdf->MultiCell(0,5,$pg['alamat'].' Kel/Desa. '.$pg['nama_kelurahan'].' Kec.'.$pg['nama_kecamatan'].' '.ucwords(strtolower($pg['nama_kabkota'])).' Prov '.$pg['nama_provinsi'],  0, "J", 0);
$pdf->Cell(42, 5, "", 0, 0, "L");

$pdf->Cell(49, 5, "Untuk", 0, 0, "L");
$pdf->Cell(5, 5, ": ", 0, "L", 0);
$pdf->MultiCell(0, 5,$untuk, 0, "J", 0);
$pdf->Cell(42, 5, "", 0, 0, "L");

$pdf->Cell(49, 5,"Nama Bangunan Gedung", 0, 0, "L");
$pdf->Cell(5, 5,": ", 0, "L", 0);
$pdf->MultiCell(0, 5, $bg['nm_bgn'], 0, "J", 0);
$pdf->Cell(42, 5, "", 0, 0, "L");

if($bg['id_izin'] == '1'){// Bangunan Baru Tunggal
}else if($bg['id_izin'] == '2'){//Bangunan Eksisting
	if($bg['permohonan_slf'] == '1'){//Bangunan Eksisting Bangunan Tunggal
		
	}else if($bg['permohonan_slf'] == '2'){//Bangunan Eksisting Prasarana
		
	}else if($bg['permohonan_slf'] == '3'){//Bangunan Eksisiting Pertashop
		
	}else{
		
	}
}else if($bg['id_izin'] == '3'){
	
}else if($bg['id_izin'] == '4'){
	
}else if($bg['id_izin'] == '5'){
	
}else if($bg['id_izin'] == '6'){
	
}else if($bg['id_izin'] == '7'){
	
}else if($bg['id_izin'] == '8'){
	
}

$pdf->Cell(49, 5, "Fungsi bangunan gedung", 0, 0, "L");
$pdf->Cell(5, 5, ": ", 0, "L", 0);
$pdf->multiCell(0, 5, $bg['fungsi_bg'], 0, "J", 0);
$pdf->Cell(42, 5, "", 0, 0, "L");
if($bg['id_izin'] == '5'){
	$fungsi_bangunan  =$bg['jns_prasarana'];
}else{
	$fungsi_bangunan  =$fungsi['nm_jenis_bg'];
}
$pdf->Cell(49, 5, "Sub Fungsi", 0, 0, "L");
$pdf->Cell(5, 5, ": ", 0, "L", 0);
$pdf->MultiCell(0, 5, $fungsi_bangunan, 0, "J", 0);
$pdf->Cell(42, 5, "", 0, 0, "L");

$pdf->Cell(50, 5, "Klasifikasi Kompleksitas", 0, 0, "L");
$pdf->Cell(4, 5, ":", 0, 0, "L");
$pdf->MultiCell(0, 5,$klasifikasi, 0, "J", 0);
$pdf->Cell(42, 5, "", 0, 0, "L");

if($bg['id_izin'] == '4'){
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
	$pdf->Cell(50, 5, "Data Bangunan Kolektif ", 0, 0, "L");
	$pdf->Cell(3, 5, ":", 0, 0, "L");
	//$pdf->Cell(9, 5, 'No.', 1, 0,"C");
	$pdf->Cell(17, 5, 'Tipe', 1, 0,"C");
	$pdf->Cell(15, 5, 'Luas', 1, 0,"C");
	$pdf->Cell(14, 5, 'Tinggi', 1, 0,"C");
	$pdf->Cell(15, 5, 'Lantai', 1, 0,"C");
	$pdf->Cell(14,5,'Jumlah',1,1,"C");
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
			//$pdf->Cell(9, 5, $no, 1, 0,"C");
			$pdf->Cell(17, 5, $bangunan['tipe'][$no], 1, 0,"C");
			$pdf->Cell(15, 5, $bangunan['luas'][$no], 1, 0,"C");
			$pdf->Cell(14, 5, $bangunan['tinggi'][$no], 1, 0,"C");
			$pdf->Cell(15, 5, $bangunan['lantai'][$no], 1, 0,"C");
			$pdf->Cell(14,5, $bangunan['jumlah'][$no],1,1,"C"); 
		}
	}
	$LuasTotal  = $LuasBg;
	$pdf->Cell(42, 5, "", 0, 0, "L");
	$pdf->Cell(50, 5, "Luas Bangunan Gedung", 0, 0, "L");
	$pdf->Cell(2, 5, ":", 0, 0, "L");
	$pdf->Cell(25, 5, "Total Luas", 0, 0, "L");
	$pdf->Cell(2,5,':',0,0);
	$pdf->Cell(15, 5,number_format($LuasBg,2,',','.'), 0, 0, "L");
	$pdf->Cell(4,5,' m',0,0);
    $pdf->subWrite(5,'2','',6,4);
	$pdf->Cell(10,5,'',0,1);
	
	$pdf->Cell(95, 5, "", 0, 0, "L");
	$pdf->Cell(25, 5, "Luas Lantai", 0, 0, "L");
	$pdf->Cell(2,5,':',0,0);
	$pdf->Cell(15, 5,number_format($bangunan['luas'][$no],2,',','.'), 0, 0, "L");
	$pdf->Cell(4,5,' m',0,0);
    $pdf->subWrite(5,'2','',6,4);
	$pdf->Cell(10,5,'',0,1);

	$pdf->Cell(95, 5, "", 0, 0, "L");
	$pdf->Cell(25, 5, "Luas Basemen", 0, 0, "L");
	$pdf->Cell(2,5,':',0,0);
	$pdf->Cell(15, 5,number_format($bg['luas_basement'],2,',','.'), 0, 0, "L");
	$pdf->Cell(4,5,' m',0,0);
    $pdf->subWrite(5,'2','',6,4);
	$pdf->Cell(10,5,'',0,1);
	
	$pdf->Cell(42, 5, "", 0, 0, "L");
	$pdf->Cell(50, 5, "Jumlah Lantai Bangunan Gedung", 0, 0, "L");
	$pdf->Cell(2,5,':',0,0);
	$pdf->Cell(0, 5, $bangunan['lantai'][$no]." Lantai", 0, 1, "L");
	$pdf->Cell(42, 5, "", 0, 0, "L");

	$pdf->Cell(50, 5, "Tinggi Bangunan Gedung", 0, 0, "L");
	$pdf->Cell(0, 5, ": ".number_format($bangunan['tinggi'][$no],2,',','.')." m", 0, 1, "L");
	$pdf->Cell(42, 5, "", 0, 0, "L");
	
	$pdf->Cell(50, 5, "Jumlah Lapis Basemen", 0, 0, "L");
	$pdf->Cell(0, 5, ": ".$bg['lapis_basement']." Lapis ", 0, 1, "L");
	$pdf->Cell(42, 5, "", 0, 0, "L");
	
} else if($bg['id_izin'] == '5'){
	$pdf->Cell(50, 5, "Luas Bangunan Prasarana", 0, 0, "L");
	$pdf->Cell(3, 5, ":", 0, 0, "L");

	$total_luas =  $bg['luas_bgp'];
	$pdf->Cell(25, 5, "Total Luas", 0, 0, "L");
	$pdf->Cell(2,5,':',0,0);
	$pdf->Cell(15, 5,number_format($total_luas,2,',','.'), 0, 0, "L");
	$pdf->Cell(4,5,' m',0,0);
    $pdf->subWrite(5,'2','',6,4);
	$pdf->Cell(10,5,'',0,1);

	$pdf->Cell(95, 5, "", 0, 0, "L");
	$pdf->Cell(25, 5, "Luas Lantai", 0, 0, "L");
	$pdf->Cell(2,5,':',0,0);
	$pdf->Cell(15, 5,number_format($bg['luas_bgp'],2,',','.'), 0, 0, "L");
	$pdf->Cell(4,5,' m',0,0);
    $pdf->subWrite(5,'2','',6,4);
	$pdf->Cell(10,5,'',0,1);

	$pdf->Cell(42, 5, "", 0, 0, "L");
	$pdf->Cell(50, 5, "Jumlah Lantai", 0, 0, "L");
	$pdf->Cell(2,5,':',0,0);
	$pdf->Cell(0, 5, $bg['jml_lantai']." Lantai", 0, 1, "L");
	$pdf->Cell(42, 5, "", 0, 0, "L");

	$pdf->Cell(50, 5, "Tinggi Bangunan Gedung", 0, 0, "L");
	$pdf->Cell(0, 5, ": ".$bg['tinggi_bgp']." m", 0, 1, "L");
	$pdf->Cell(42, 5, "", 0, 0, "L");

}else if($bg['id_izin'] == '7'){
	$pdf->Cell(50, 5, "Luas Bangunan Gedung", 0, 0, "L");
	$pdf->Cell(3, 5, ":", 0, 0, "L");

	$total_luas =  $bg['luas_bgp'] + $bg['luas_basement'];
	$pdf->Cell(25, 5, "Total Luas", 0, 0, "L");
	$pdf->Cell(2,5,':',0,0);
	$pdf->Cell(15, 5,number_format($total_luas,2,',','.'), 0, 0, "L");
	$pdf->Cell(4,5,' m',0,0);
    $pdf->subWrite(5,'2','',6,4);
	$pdf->Cell(10,5,'',0,1);

	$pdf->Cell(95, 5, "", 0, 0, "L");
	$pdf->Cell(25, 5, "Luas Lantai", 0, 0, "L");
	$pdf->Cell(2,5,':',0,0);
	$pdf->Cell(15, 5,number_format($bg['luas_bgp'],2,',','.'), 0, 0, "L");
	$pdf->Cell(4,5,' m',0,0);
    $pdf->subWrite(5,'2','',6,4);
	$pdf->Cell(10,5,'',0,1);

	$pdf->Cell(95, 5, "", 0, 0, "L");
	$pdf->Cell(25, 5, "Luas Basemen", 0, 0, "L");
	$pdf->Cell(2,5,':',0,0);
	$pdf->Cell(15, 5,number_format($bg['luas_basement'],2,',','.'), 0, 0, "L");
	$pdf->Cell(4,5,' m',0,0);
    $pdf->subWrite(5,'2','',6,4);
	$pdf->Cell(10,5,'',0,1);
	
	$pdf->Cell(42, 5, "", 0, 0, "L");
	$pdf->Cell(50, 5, "Jumlah Lantai Bangunan Gedung", 0, 0, "L");
	$pdf->Cell(2,5,':',0,0);
	$pdf->Cell(0, 5, $bg['jml_lantai']." Lantai", 0, 1, "L");
	$pdf->Cell(42, 5, "", 0, 0, "L");

	$pdf->Cell(50, 5, "Tinggi Bangunan Gedung", 0, 0, "L");
	$pdf->Cell(0, 5, ": ".$bg['tinggi_bgp']." m", 0, 1, "L");
	$pdf->Cell(42, 5, "", 0, 0, "L");
	
	$pdf->Cell(50, 5, "Jumlah Lapis Basemen", 0, 0, "L");
	$pdf->Cell(0, 5, ": ".$bg['lapis_basement']." Lapis ", 0, 1, "L");
	$pdf->Cell(42, 5, "", 0, 0, "L");
}else{
	$pdf->Cell(50, 5, "Luas Bangunan Gedung", 0, 0, "L");
	$pdf->Cell(3, 5, ":", 0, 0, "L");

	$total_luas =  $bg['luas_bgn'] + $bg['luas_basement'];
	$pdf->Cell(25, 5, "Total Luas", 0, 0, "L");
	$pdf->Cell(2,5,':',0,0);
	$pdf->Cell(15, 5,number_format($total_luas,2,',','.'), 0, 0, "L");
	$pdf->Cell(4,5,' m',0,0);
    $pdf->subWrite(5,'2','',6,4);
	$pdf->Cell(10,5,'',0,1);

	$pdf->Cell(95, 5, "", 0, 0, "L");
	$pdf->Cell(25, 5, "Luas Lantai", 0, 0, "L");
	$pdf->Cell(2,5,':',0,0);
	$pdf->Cell(15, 5,number_format($bg['luas_bgn'],2,',','.'), 0, 0, "L");
	$pdf->Cell(4,5,' m',0,0);
    $pdf->subWrite(5,'2','',6,4);
	$pdf->Cell(10,5,'',0,1);

	$pdf->Cell(95, 5, "", 0, 0, "L");
	$pdf->Cell(25, 5, "Luas Basemen", 0, 0, "L");
	$pdf->Cell(2,5,':',0,0);
	$pdf->Cell(15, 5,number_format($bg['luas_basement'],2,',','.'), 0, 0, "L");
	$pdf->Cell(4,5,' m',0,0);
    $pdf->subWrite(5,'2','',6,4);
	$pdf->Cell(10,5,'',0,1);
	
	$pdf->Cell(42, 5, "", 0, 0, "L");
	$pdf->Cell(50, 5, "Jumlah Lantai Bangunan Gedung", 0, 0, "L");
	$pdf->Cell(2,5,':',0,0);
	$pdf->Cell(0, 5, $bg['jml_lantai']." Lantai", 0, 1, "L");
	$pdf->Cell(42, 5, "", 0, 0, "L");

	$pdf->Cell(50, 5, "Tinggi Bangunan Gedung", 0, 0, "L");
	$pdf->Cell(0, 5, ": ".$bg['tinggi_bgn']." m", 0, 1, "L");
	$pdf->Cell(42, 5, "", 0, 0, "L");
	
	$pdf->Cell(50, 5, "Jumlah Lapis Basemen", 0, 0, "L");
	$pdf->Cell(0, 5, ": ".$bg['lapis_basement']." Lapis ", 0, 1, "L");
	$pdf->Cell(42, 5, "", 0, 0, "L");
}

$pdf->Cell(50, 5, "Di Atas Tanah", 0, 0, "L");
$pdf->Cell(0, 5, ": (tercantum dalam Lampiran A)", 0, 1, "L");
$pdf->Cell(42, 5, "", 0, 0, "L");

$pdf->Cell(50, 5, "Luas Tanah", 0, 0, "L");
$pdf->Cell(0, 5, ": (tercantum dalam Lampiran A)", 0, 1, "L");
$pdf->Cell(42, 5, "", 0, 0, "L");

$pdf->Cell(50, 5, "Pemilik Tanah", 0, 0, "L");
$pdf->Cell(0, 5, ": (tercantum dalam Lampiran A)", 0, 1, "L");
$pdf->Cell(42, 5, "", 0, 0, "L");

$pdf->Cell(50, 5, "Terletak di", 0, 0, "L");
$pdf->MultiCell(0, 5,": (tercantum dalam Lampiran A)", 0, 'L', 0);
$pdf->Cell(0,5,'',0,1);

$pdf->SetFont('Times','B',10);
$pdf->Cell(40,5,'Menimbang',0,0,'L');
$pdf->Cell(2,5,':',0,0);
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,'Bahwa setelah memeriksa (mencatat/meneliti), mengkaji, dan menilai/evaluasi serta menyetujui dokumen rencana teknis bangunan gedung sebagaimana dimaksud di atas dengan ini disahkan, maka terhadap permohonan persetujuan bangunan gedung yang dimaksud dapat diberikan persetujuan dengan ketentuan sebagaimana dalam lampiran keputusan ini.',0,'J',0);

$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(0,5,'',0,1);
$pdf->SetFont('Times','B',10);
$pdf->Cell(40,5,'Mengingat',0,0,'L');
$pdf->Cell(3,5,':',0,0);
$pdf->SetFont('Times','',10);
$pdf->Cell(5, 5, "1.", 0, 0, "L");
$pdf->MultiCell(0,5,'Undang-Undang Nomor 28 Tahun 2002 tentang Bangunan Gedung (Lembaran Negara Republik Indonesia Tahun 2002 Nomor 134, Tambahan Lembaran Negara Republik Indonesia Nomor 4247);',0,'J',0);
$pdf->Cell(43, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "2.", 0, 0, "L");
$pdf->MultiCell(0,5,'Undang-Undang Nomor 6 Tahun 2023 Tentang Penetapan Peraturan Pemerintah Pengganti Undang-Undang Nomor 2 Tahun 2022 tentang Cipta Kerja menjadi Undang-Undang (Lembaran Negara Republik Indonesia Tahun 2022 Nomor 238, Tambahan Lembaran Negara Republik Indonesia Nomor 6841);',0,'J',0);
$pdf->Cell(43, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "3.", 0, 0, "L");
$pdf->MultiCell(0,5,'Peraturan Pemerintah Nomor 16 Tahun 2021 tentang Peraturan Pelaksanaan Undang-Undang Nomor 28 Tahun 2002 tentang Bangunan Gedung (Lembaran Negara Republik Indonesia Tahun 2021 Nomor 26, Tambahan Lembaran Negara Republik Indonesia Nomor 6628);',0,'J',0);
$pdf->Cell(43, 5, "", 0, 0, "L");

$i=4;
foreach ($result_per as $key => $value) {
	if ($value['nama_perda'] != null || $value['nama_perda'] != ''){
		$pdf->Cell(5,5,$i++.'.',0,0);
	}
	$pdf->MultiCell(0,5,ucwords(strtolower($value['nama_perda'])),0,'J',0,1);
	$pdf->Cell(43,5,'',0,0);
}

$pdf->Cell(0,5,'',0,1);
$pdf->SetFont('Times','B',10);
$pdf->Cell(40,5,'Memperhatikan',0,0,'L');
$pdf->Cell(2,5,':',0,0);
$pdf->Cell(2,5,'',0,0);
$pdf->SetFont('Times','',10); 
$pdf->MultiCell(0,5,'Surat Kepala '.ucwords(strtolower($bg['nama_dinas'])).' nomor '.$bg['no_sppst'].' tanggal'.' '.$tgl_valkadintek3.' Perihal Pernyataan Pemenuhan Standar Teknis Bangunan Gedung.',0,'J',0);

$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(0, 10, "Memutuskan", 0, 1, "C");
$pdf->Cell(0, 2, "", 0, 1, "L");

$pdf->Cell(40, 5,"Menetapkan", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->SetFont('Times', '', 10);
$pdf->Cell(5, 5, "1.", 0, 0, "L");
$pdf->Cell(0, 5, "Persetujuan Bangunan Gedung kepada:", 0, 1, "L");

$pdf->Cell(48, 5, "", 0, 0, "L");
$pdf->SetFont('Times', '', 10);
$pdf->Cell(25, 5, "Pemilik", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->MultiCell(0, 5,$pg['nm_pemilik'], 0, "J", 0);

$pdf->Cell(48, 5, "", 0, 0, "L");
$pdf->SetFont('Times', '', 10);
$pdf->Cell(25, 5, "Alamat Pemilik", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->MultiCell(0,5,$pg['alamat'].' Kel/Desa. '.$pg['nama_kelurahan'].' Kec.'.$pg['nama_kecamatan'].' '.ucwords(strtolower($pg['nama_kabkota'])).' Prov '.$pg['nama_provinsi'],  0, "J", 0);

$pdf->SetFont('Times', '', 10);
$pdf->Cell(48, 5, "", 0, 0, "L");
$pdf->Cell(25, 5, "Untuk", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->MultiCell(0, 5,$untuk.' sebagaimana dijelaskan dalam Dokumen Teknis yang tercantum dalam Lampiran B Keputusan ini', 0, "J", 0);

$pdf->Cell(40, 5, "", 0, 0, "L");
$pdf->Cell(3, 5, "", 0, 0, "L");
$pdf->SetFont('Times', '', 10);
$pdf->Cell(5, 5, "2.", 0, 0, "J");
$pdf->MultiCell(0, 5, "Besaran Retribusi Persetujuan Bangunan Gedung yang dibayarkan oleh pemilik bangunan gedung sebagaimana tercantum dalam Lampiran C adalah sebesar Rp.".number_format($bg['nilai_retribusi_keseluruhan']."",2,',','.')." ".'( '.terbilang($bg['nilai_retribusi_keseluruhan']).' rupiah )', 0, "J", 0);


$pdf->Cell(40, 5, "", 0, 0, "L");
$pdf->Cell(3, 5, "", 0, 0, "L");
$pdf->SetFont('Times', '', 10);
$pdf->Cell(5, 5, "3.", 0, 0, "J");
$pdf->MultiCell(0, 5, "Informasi Umum Persetujuan Bangunan Gedung tercantum dalam Lampiran D;", 0, "L", 0);

$pdf->Cell(40, 5, "", 0, 0, "L");
$pdf->Cell(3, 5, "", 0, 0, "L");
$pdf->SetFont('Times', '', 10);
$pdf->Cell(5, 5, "4.", 0, 0, "J");
$pdf->MultiCell(0, 5, "Ketentuan terkait Pembekuan dan Pencabutan Persetujuan Bangunan Gedung tercantum dalam Lampiran E;", 0, "J", 0);

$pdf->Cell(40, 5, "", 0, 0, "L");
$pdf->Cell(3, 5, "", 0, 0, "L");
$pdf->SetFont('Times', '', 10);
$pdf->Cell(5, 5, "5.", 0, 0, "J");
$pdf->MultiCell(0, 5, "Lampiran Keputusan ini merupakan satu kesatuan yang tidak terpisahkan dari Keputusan ini;", 0, "J", 0);

$pdf->Cell(40, 5, "", 0, 0, "L");
$pdf->Cell(3, 5, "", 0, 0, "L");
$pdf->SetFont('Times', '', 10);
$pdf->Cell(5, 5, "6.", 0, 0, "J");
$pdf->MultiCell(0, 5, "Hal-hal yang belum diatur dalam Keputusan ini akan ditetapkan kemudian;", 0, "J", 0);

$pdf->Cell(40, 5, "", 0, 0, "L");
$pdf->Cell(3, 5, "", 0, 0, "L");
$pdf->SetFont('Times', '', 10);
$pdf->Cell(5, 5, "7.", 0, 0, "L");
$pdf->MultiCell(0, 5, "Salinan Keputusan ini diberikan kepada yang berkepentingan; dan", 0, "J", 0);

$pdf->Cell(40, 5, "", 0, 0, "L");
$pdf->Cell(3, 5, "", 0, 0, "L");
$pdf->SetFont('Times', '', 10);
$pdf->Cell(5, 5, "8.", 0, 0, "J");
$pdf->MultiCell(0, 5, "Keputusan ini mulai berlaku sejak tanggal diterbitkan.", 0, "J", 0);
if($bg['id_kabkot_bgn'] =='3174'){
	$pdf->AddPage();
	$pdf->SetAutoPageBreak(true, 10);
	$pdf->SetMargins(20, 20, 20, 20);
	$pdf->setXY(20, 40);
}else{
	
}
$pdf->SetFont('Times','',10);
$pdf->Cell(0, 5, "", 0, 1, "L");
$pdf->Cell(80, 5, "", 0, 0, "L");
$pdf->Cell(80, 5, "", 0, 1, "L");

$pdf->Cell(75, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "Diterbitkan Di : ".$kabkota, 0, 1, "L");
$pdf->Cell(75, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "Pada Tanggal : ".$daftar_hari[$namahari].", ".$tgl_penerbitan, 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");

$pdf->Cell(0,5,'',0,1);
$pdf->Cell(45);
if($bg['status'] =='13'){
	$pdf->Cell(0,0,$pdf->image('assets/gambar/barcode.png', $pdf->GetX(), $pdf->GetY(), 50,50),0,1);
}else{
	$pdf->Cell(0,0,$pdf->image(BASE_FILE_PATH2.'QR_Code/'.$bg['no_izin_pbg'].'.png', $pdf->GetX(), $pdf->GetY(), 50,50),0,1);
}
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0,5,"Atas Nama",0,1,"L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0,5,$pejabat." ". $kabkota,0,1,"L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->MultiCell(0,5,$s_pejabat."Kepala ".ucwords(strtolower($nama_dinas)),0,"j",0);
//$pdf->MultiCell(0,5,"KEPALA ".$nama_dinas,0,"j",0);
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0,5,"",0,1,"L");

$pdf->Cell(0, 20, "", 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, $kepala_dinas, 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "NIP : ".$nip_kpl_dinas, 0, 1, "L");

//Lampiran A
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetMargins(20, 20, 20, 20);
$pdf->setXY(20, 40);
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(0, 5, "LAMPIRAN A", 0, 1, "L");
$pdf->Cell(0, 5, "KEPUTUSAN ".$lokasi_dinas. " ".$kabkota , 0, 1, "L");
$pdf->Cell(0, 5, "NOMOR ".$sk_izin." TANGGAL ".$tgl_penerbitan, 0, 1, "L");
$pdf->Cell(0, 5, "TENTANG PERSETUJUAN BANGUNAN GEDUNG", 0, 1, "L");
$pdf->Cell(0, 5, "", 0, 1, "L");

$pdf->Cell(0, 10, "INFORMASI TANAH, FUNGSI, DAN KLASIFIKASI BANGUNAN GEDUNG", 0, 1, "C");
$pdf->Cell(0, 5, "", 0, 1, "L");

$pdf->Cell(5, 5, "I.", 0, 0, "L");
$pdf->Cell(0, 5, "Informasi Tanah", 0, 1, "L");

$pdf->SetFont('Times', '', 10);
$j=0;
$k=1;
if ($count_tanah>1) {
  //Table Tanah lebih dari 1 Data
  $pdf->Cell(5,5,'',0,0);
    $pdf->Cell(28,5,'Data Tanah',0,0,'L');
    $pdf->Cell(2,5,':',0,0);
    foreach ($result_tanah as $key => $row) {
      $hat = $row['hat'];
      if($k > 1){
        $pdf->Cell(-7,5,'',0,0);
	}
    $pdf->Cell(33,5,$k++.'.Di Atas Tanah',0,0);
    $pdf->Cell(2,5,':',0,0);
      $pdf->MultiCell(0,5,(isset($row['Jns_dok']) ? $row['Jns_dok'] : '[ PEMILIK TANAH KOSONG ]'),0,"L",0);
      if ($row['hat'] != 0) {
        $pdf->Cell(38,5,'',0,0);
        $pdf->Cell(30,5,'Luas Tanah',0,0);
        $pdf->Cell(2,5,':',0,0);
		$pdf->Cell(14,5,(isset($row['luas_tanah']) ? number_format($row['luas_tanah'],2,',','.') : '[ LUAS TANAH KOSONG ]'),0,0);
        $pdf->Cell(4,5,' m',0,0);
        $pdf->subWrite(5,'2','',6,4);
		$pdf->Cell(10,5,'',0,1);
		$pdf->Cell(38,5,'',0,0);
        $pdf->Cell(30,5,'Pemilik Tanah',0,0);
        $pdf->Cell(2,5,':',0,0);
		$pdf->MultiCell(95,5,(isset($row['atas_nama_dok']) ? $row['atas_nama_dok'] : '[ PEMILIK TANAH KOSONG ]'),0,1);
		$pdf->Cell(38,5,'',0,0);
        $pdf->Cell(30,5,'Terletak Di',0,0);
        $pdf->Cell(2,5,':',0,0);
		$pdf->MultiCell(95,5,$bg['almt_bgn'].' Kel/Desa. '.$bg['nama_kelurahan'].' Kec.'.$bg['nama_kecamatan'].' '.ucwords(strtolower($bg['nama_kabkota'])).' Prov '.$bg['nama_provinsi'],  0, 1);
		}
		$pdf->Cell(42,5,'',0,0);
    }
} else {
	foreach ($result_tanah as $key => $row) { // JIka Dokumen Tanah Hanya 1
		if ($row['hat'] != 0) {
			$hat = $row['hat'];
			$pdf->Cell(5,5,'',0,0);
			$pdf->Cell(30,5,'Data Tanah',0,0,'L');
			$pdf->Cell(2,5,':',0,0);
			$pdf->Cell(5, 5, "1.", 0, 0, "L");
			$pdf->Cell(23, 5, "Di Atas Tanah", 0, 0, "L");
			$pdf->Cell(2,5,":",0,0);
			$pdf->Cell(17,5," ". (isset($row['Jns_dok']) ? $row['Jns_dok'] : '[ HAK ATAS TANAH KOSONG ]'),0,1);
			$pdf->Cell(1,5,'',0,0);
			$pdf->Cell(41,5,'',0,0);
			$pdf->Cell(23,5,'Luas tanah',0,0,'L');
			$pdf->Cell(2,5,': ',0,0);
			$pdf->Cell(22,5,(isset($row['luas_tanah']) ?   number_format($row['luas_tanah'],2,',','.'): '[ LUAS TANAH KOSONG ]'),0,0);
			if ($row['luas_tanah'] != 0 || $row['luas_tanah'] != null){
				$pdf->Cell(5,5,' m',0,0);
				$pdf->subWrite(5,'2','',6,4);
				$pdf->Cell(10,5,'',0,1);
			}
			$pdf->Cell(42,5,'',0,0);
			$pdf->Cell(23,5,'Pemilik Tanah',0,0,'L');
			$pdf->Cell(2,5,": ",0,0);
			$pdf->MultiCell(95,5,(isset($row['atas_nama_dok']) ? $row['atas_nama_dok'] : '[ PEMILIK TANAH KOSONG ]'),0,1);
			$pdf->Cell(42,5,'',0,0);
			$pdf->Cell(23,5,'Terletak Di',0,0,'L');
			$pdf->Cell(2,5,": ",0,0);
			$pdf->MultiCell(95,5,$bg['almt_bgn'].' Kel/Desa. '.$bg['nama_kelurahan'].' Kec.'.$bg['nama_kecamatan'].' '.ucwords(strtolower($bg['nama_kabkota'])).' Prov '.$bg['nama_provinsi'],  0, 1);
		$pdf->Cell(42,5,'',0,0);
		}else{
		  $pdf->Cell(1,5,'',0,0);
		}
	}
}
$pdf->Cell(3, 5, "", 0, 1, "L");
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(5, 10, "II.", 0, 0, "L");
$pdf->Cell(0, 10, "Fungsi dan Klasifikasi Bangunan Gedung", 0, 1, "L");

$pdf->SetFont('Times', '', 10);
$pdf->Cell(5, 5, "", 0, 0, "L");
$pdf->Cell(60, 5, "Pemilik Bangunan Gedung", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, $pg['nm_pemilik'], 0, 1, "L");

$pdf->Cell(5, 5, "", 0, 0, "L");
$pdf->Cell(60, 5, "Fungsi Bangunan Gedung", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->Cell(3, 5, $bg['fungsi_bg'], 0, 1, "L");

$pdf->Cell(5, 5, "", 0, 0, "L");
$pdf->Cell(60, 5, "Sub Fungsi Bangunan Gedung", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->Cell(3, 5, $fungsi_bangunan, 0, 1, "L");

$pdf->Cell(5, 5, "", 0, 0, "L");
$pdf->Cell(60, 5, "Klasifikasi Bangunan Gedung", 0, 1, "L");

$pdf->Cell(5, 5, "", 0, 0, "L");
$pdf->Cell(60, 5, "- Tingkat Kompleksitas", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->Cell(3, 5, $klasifikasi, 0, 1, "L");

if($bg['id_permanensi'] == '1'){
	$permanensi	="Permanen";
}else if($bg['id_permanensi'] == '2'){
	$permanensi	="Non Permanen";
}else if($bg['id_permanensi'] == '0'){
	$permanensi	="-";
}else{
	$permanensi	="-";
}

$pdf->Cell(5, 5, "", 0, 0, "L");
$pdf->Cell(60, 5, "- Tingkat Permanensi", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->Cell(3, 5, $permanensi, 0, 1, "L");

if($bg['id_resiko'] == '1'){
	$Resiko	="Rendah";
}else if($bg['id_resiko'] == '2'){
	$Resiko	="Sedang";
}else if($bg['id_resiko'] == '3'){
	$Resiko	="Tinggi";
}else{
	$Resiko	="-";
}

$pdf->Cell(5, 5, "", 0, 0, "L");
$pdf->Cell(60, 5, "- Tingkat Risiko Bahaya Kebakaran", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->Cell(3, 5, $Resiko, 0, 1, "L");

$pdf->Cell(5, 5, "", 0, 0, "L");
$pdf->Cell(60, 5, "- Lokasi", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->Cell(3, 5, "Padat", 0, 1, "L");

$pdf->Cell(5, 5, "", 0, 0, "L");
$pdf->Cell(60, 5, "- Ketinggian Bangunan Gedung", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->Cell(3, 5, $bg['jml_lantai']." Lantai "."(Rendah)", 0, 1, "L");


$pdf->Cell(5, 5, "", 0, 0, "L");
$pdf->Cell(60, 5, "- Kepemilikan Bangunan Gedung", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->Cell(3, 5, 'Perorangan', 0, 1, "L");

$pdf->Cell(5, 5, "", 0, 0, "L");
$pdf->Cell(60, 5, "- Klas bangunan", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->Cell(3, 5, $kelas, 0, 1, "L");

$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetMargins(20, 20, 20, 20);
$pdf->setXY(20, 40);
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(0, 5, "LAMPIRAN B", 0, 1, "L");
$pdf->Cell(0, 5, "KEPUTUSAN ".$lokasi_dinas. " ".$kabkota , 0, 1, "L");
$pdf->Cell(0, 5, "NOMOR ".$sk_izin." TANGGAL ".$tgl_penerbitan, 0, 1, "L");
$pdf->Cell(0, 5, "TENTANG PERSETUJUAN BANGUNAN GEDUNG", 0, 1, "L");
$pdf->Cell(0, 5, "", 0, 1, "L");
$pdf->Cell(0, 10, "DOKUMEN TEKNIS", 0, 1, "C");
$pdf->Cell(5, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "", 0, 1, "L");
$pdf->Cell(0, 50, "", 0, 1, "L");

$pdf->SetFont('Times', '', 10);
$pdf->Cell(10, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "Keterangan", 0, 1, "L");

$pdf->image(BASE_FILE_PATH2.'QR_Code/'.$bg['no_validasi'].'.png', 80, 80, 50, 50);

$pdf->Cell(10, 5, "", 0, 0, "L");
$pdf->Cell(3, 5, "1.", 0, 0, "L");
$pdf->MultiCell(0, 5, "Dokumen Teknis Persetujuan Bangunan Gedung yang telah dibayarkan oleh pemilik bangunan gedung dapat diakses dengan memindai QR-Code di atas.", 0, "L", 0);

$pdf->Cell(10, 5, "", 0, 0, "L");
$pdf->Cell(3, 5, "2.", 0, 0, "L");
$pdf->MultiCell(0, 5, "Keamanan data Dokumen Teknis sepenuhnya menjadi tanggung jawab pemilik bangunan gedung.", 0, "L", 0);

//Lampiran C
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetMargins(20, 20, 20, 20);

$pdf->setXY(20, 40);
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(0, 5, "LAMPIRAN C", 0, 1, "L");
$pdf->Cell(0, 5, "KEPUTUSAN ".$lokasi_dinas. " ".$kabkota , 0, 1, "L");
$pdf->Cell(0, 5, "NOMOR ".$sk_izin." TANGGAL ".$tgl_penerbitan, 0, 1, "L");
$pdf->Cell(0, 5, "TENTANG PERSETUJUAN BANGUNAN GEDUNG", 0, 1, "L");
$pdf->Cell(0, 5, "", 0, 1, "L");
$pdf->Cell(0, 10, "BESARAN RETRIBUSI PERSETUJUAN BANGUNAN GEDUNG", 0, 1, "C");
$pdf->Cell(5, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "", 0, 1, "L");
$pdf->Cell(0, 50, "", 0, 1, "L");

$pdf->SetFont('Times', '', 10);
$pdf->Cell(10, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "Keterangan", 0, 1, "L");

$pdf->image(BASE_FILE_PATH2.'QR_Code/'.$bg['no_sppst'].'.png', 80, 80, 50, 50);

$pdf->Cell(10, 5, "", 0, 0, "L");
$pdf->Cell(3, 5, "1.", 0, 0, "L");
$pdf->MultiCell(0, 5, "Retribusi Persetujuan Bangunan Gedung yang telah dibayarkan oleh pemilik bangunan gedung dapat diakses dengan memindai QR-Code di atas; ", 0, "L", 0);

$pdf->Cell(10, 5, "", 0, 0, "L");
$pdf->Cell(3, 5, "2.", 0, 0, "L");
$pdf->MultiCell(0, 5, "Retribusi Persetujuan Bangunan Gedung (PBG) dimaksudkan untuk mendukung pembiayaan pelayanan perizinan, menerbitkan surat bukti kepemilikan bangunan gedung dan pembinaan teknis penyelenggaraan bangunan gedung; ", 0, "J", 0);

$pdf->Cell(10, 5, "", 0, 0, "L");
$pdf->Cell(3, 5, "3.", 0, 0, "L");
$pdf->MultiCell(0, 5, "Keamanan data Retribusi Persetujuan Bangunan Gedung sepenuhnya menjadi tanggung jawab pemilik bangunan gedung.", 0, "J", 0);

//Lampiran D
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetMargins(20, 20, 20, 20);
$pdf->setXY(20, 40);
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(0, 5, "LAMPIRAN D", 0, 1, "L");
$pdf->Cell(0, 5, "KEPUTUSAN ".$lokasi_dinas. " ".$kabkota , 0, 1, "L");
$pdf->Cell(0, 5, "NOMOR ".$sk_izin." TANGGAL ".$tgl_penerbitan, 0, 1, "L");
$pdf->Cell(0, 5, "TENTANG PERSETUJUAN BANGUNAN GEDUNG", 0, 1, "L");
$pdf->Cell(0, 5, "", 0, 1, "L");

$pdf->Cell(0, 10, "INFORMASI UMUM PERSETUJUAN BANGUNAN GEDUNG", 0, 1, "C");

$pdf->SetFont('Times', '', 10);
$pdf->Cell(0, 5, "", 0, 1, "L");

$pdf->Cell(5, 5, "1.", 0, 0, "L");
$pdf->MultiCell(0, 5, "Pemilik bangunan gedung agar menyampaikan informasi jadwal dan tanggal mulai pelaksanaan konstruksi kepada " .$bg['nama_dinas']." melalui Sistem Informasi Manajemen Bangunan Gedung (SIMBG). Informasi tersebut disampaikan sebelum pelaksanaan konstruksi dimulai. Jadwal dan tanggal mulai konstruksi Bangunan Gedung disampaikan secara bertahap sebagai berikut:", 0, "J", 0);

$pdf->Cell(5, 5, "", 0, 0, "L");
$pdf->MultiCell(0, 5, "a. Tahap konstruksi struktur bawah;
b. Tahap konstruksi basemen (bila ada);
c. Tahap konstruksi struktur atas, arsitektur, mekanikal, elektrikal, dan perpipaan; dan
d. Tahap pengetesan dan pengujian.
", 0, "L", 0);

$pdf->Cell(5, 5, "2.", 0, 0, "L");
$pdf->MultiCell(0, 5, "Apabila pemilik bangunan gedung tidak menyampaikan jadwal dimulainya pekerjaan konstruksi, " .$bg['nama_dinas']." akan meminta klarifikasi kepada pemilik bangunan gedung. Klarifikasi dapat dilakukan paling banyak 2 (dua) kali dalam kurun waktu paling lama 6 (enam) bulan sejak diterbitkannya PBG. Dalam hal pemilik bangunan gedung tidak menyampaikan informasi jadwal dimulainya pekerjaan konstruksi sebagaimana penjelasan di atas, maka PBG dicabut dan dinyatakan tidak berlaku.", 0, "J", 0);
$pdf->Cell(5, 5, "3.", 0, 0, "L");
$pdf->MultiCell(0, 5,$bg['nama_dinas']." melakukan inspeksi terhadap pelaksanaan konstruksi bangunan gedung setelah mendapatkan informasi dari pemilik bangunan gedung pada tiap tahapan sebagaimana tercantum pada angka 1 (satu). Proses inspeksi dilaksanakan sebagai prasyarat penerbitan Sertifikat Laik Fungsi (SLF) dan Surat Bukti Kepemilikan Bangunan Gedung (SBKBG) tanpa dikenakan biaya apa pun.", 0, "J", 0);

$pdf->Cell(5, 5, "4.", 0, 0, "L");
$pdf->MultiCell(0, 5, "Pemilik bangunan gedung dapat mengakses laman(Jadwal Pelaporan Konstruksi) dengan cara masuk ke dalam SIMBG menggunakan akun yang digunakan pada saat permohonan Persetujuan Bangunan Gedung kemudian masuk ke nomor Persetujuan Bangunan Gedung yang ingin dilaporkan jadwal, atau dengan memindai QR-Code dibawah ini dan login menggunakan akun yang sama.", 0, "J", 0);
//$pdf->image('assets/gambar/barcode.PNG', 75, 180, 40, 40);

$pdf->SetFont('Times','',10);
$pdf->Cell(0, 5, "", 0, 1, "L");
$pdf->Cell(80, 5, "", 0, 0, "L");
$pdf->Cell(80, 5, "", 0, 1, "L");

$pdf->Cell(75, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "Diterbitkan Di : ".$kabkota, 0, 1, "L");
$pdf->Cell(75, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "Pada Tanggal : ".$tgl_penerbitan, 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");

$pdf->Cell(0,5,'',0,1);
$pdf->Cell(45);
if($bg['status'] =='13'){
	//$pdf->image('assets/gambar/barcode.PNG', 75, 180, 40, 40);
	$pdf->Cell(0,0,$pdf->image('assets/gambar/barcode.png', $pdf->GetX(), $pdf->GetY(), 40,40),0,1);
}else{
	$pdf->Cell(0,0,$pdf->image(BASE_FILE_PATH2.'QR_Code/'.$bg['no_izin_pbg'].'.png', $pdf->GetX(), $pdf->GetY(), 40,40),0,1);
}
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0,5,"Atas Nama",0,1,"L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0,5,$pejabat." ". $kabkota,0,1,"L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->MultiCell(0,5,$s_pejabat."Kepala ".ucwords(strtolower($nama_dinas)),0,"j",0);
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0,5,"",0,1,"L");

$pdf->Cell(0, 20, "", 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, $kepala_dinas, 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "NIP : ".$nip_kpl_dinas, 0, 1, "L");
//Lampiran E
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetMargins(20, 20, 20, 20);
$pdf->setXY(20, 40);
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(0, 5, "LAMPIRAN E", 0, 1, "L");
$pdf->Cell(0, 5, "KEPUTUSAN ".$lokasi_dinas. " ".$kabkota , 0, 1, "L");
$pdf->Cell(0, 5, "NOMOR ".$sk_izin." TANGGAL ".$tgl_penerbitan, 0, 1, "L");
$pdf->Cell(0, 5, "TENTANG PERSETUJUAN BANGUNAN GEDUNG", 0, 1, "L");
$pdf->Cell(0, 10, "PEMBEKUAN DAN PENCABUTAN PERSETUJUAN BANGUNAN GEDUNG", 0, 1, "C");

$pdf->SetFont('Times', '', 10);
$pdf->Cell(5, 5, "1.", 0, 0, "L");
$pdf->Cell(0, 5, "Status PBG", 0, 1, "L");

$pdf->Cell(10, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "a.", 0, 0, "L");
$pdf->Cell(0, 5, "Penerbitan", 0, 1, "L");

$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "1)", 0, 0, "L");
$pdf->Cell(40, 5, "Nomor SK Penerbitan", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, $bg['no_izin_pbg'], 0, 1, "L");

$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "2)", 0, 0, "L");
$pdf->Cell(40, 5, "Tanggal SK Penerbitan", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5,tgl_eng_to_ind($bg['tgl_pbg']), 0, 1, "L");

$pdf->Cell(10, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "b.", 0, 0, "L");
$pdf->Cell(0, 5, "Pembekuan", 0, 1, "L");

$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "1)", 0, 0, "L");
$pdf->Cell(40, 5, "Nomor SK Pembekuan", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, "-", 0, 1, "L");

$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "2)", 0, 0, "L");
$pdf->Cell(40, 5, "Tanggal SK Pembekuan", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, "-", 0, 1, "L");

$pdf->Cell(10, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "c.", 0, 0, "L");
$pdf->Cell(0, 5, "Pencabutan", 0, 1, "L");

$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "1)", 0, 0, "L");
$pdf->Cell(40, 5, "Nomor SK Pencabutan", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, "-", 0, 1, "L");

$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "2)", 0, 0, "L");
$pdf->Cell(40, 5, "Tanggal SK Pencabutan", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, "-", 0, 1, "L");

$pdf->Cell(5, 5, "2.", 0, 0, "L");
$pdf->Cell(0, 5, "Ketentuan Umum", 0, 1, "L");

$pdf->Cell(10, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "a.", 0, 0, "L");
$pdf->Cell(0, 5, "PBG dibekukan apabila pemilik bangunan gedung", 0, 1, "L");

$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "1)", 0, 0, "L");
$pdf->MultiCell(0, 5, "tidak melakukan klarifikasi dimulainya pekerjaan konstruksi kepada pemerintah daerah dalam jangka waktu 3 (tiga) bulan sejak diterbitkannya PBG;", 0, "L", 0);

$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "2)", 0, 0, "L");
$pdf->MultiCell(0, 5, "tidak memberikan justifikasi teknis dalam hal terdapat ketidaksesuaian desain terhadap kondisi lapangan sehingga kegiatan pembangunan harus dihentikan oleh pemerintah daerah;", 0, "L", 0);
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "3)", 0, 0, "L");
$pdf->MultiCell(0, 5, "tidak menindaklanjuti surat peringatan yang disampaikan oleh pemerintah daerah; dan/atau", 0, "L", 0);
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "4)", 0, 0, "L");
$pdf->MultiCell(0, 5, "melakukan pelanggaran lain terhadap ketentuan penyelenggaraan bangunan gedung.", 0, "L", 0);

$pdf->Cell(10, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "b.", 0, 0, "L");
$pdf->Cell(0, 5, "PBG dibatalkan pembekuannya apabila pemilik bangunan gedung:", 0, 1, "L");

$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "1)", 0, 0, "L");
$pdf->MultiCell(0, 5, "melakukan klarifikasi dimulainya pekerjaan konstruksi melalui SIMBG dalam jangka waktu tidak lebih dari 6 (enam) bulan sejak diterbitkannya PBG; dan/atau", 0, "L", 0);

$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "2)", 0, 0, "L");
$pdf->MultiCell(0, 5, "memberikan justifikasi teknis penyesuaian desain terhadap kondisi lapangan sebelum PBG dicabut.", 0, "L", 0);

$pdf->Cell(10, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "c.", 0, 0, "L");
$pdf->Cell(0, 5, "PBG dicabut apabila:", 0, 1, "L");

$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "1)", 0, 0, "L");
$pdf->MultiCell(0, 5, "pemilik bangunan gedung tidak melakukan klarifikasi mulai konstruksi dalam jangka waktu 6 (enam) bulan sejak diterbitkannya PBG;", 0, "L", 0);

$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "2)", 0, 0, "L");
$pdf->MultiCell(0, 5, "pemilik bangunan gedung tidak memberikan justifikasi teknis penyesuaian desain terhadap kondisi lapangan dalam jangka waktu 6 (enam) bulan sejak dinyatakan ketidaksesuaiannya oleh penilik pada masa inspeksi;", 0, "L", 0);

$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "3)", 0, 0, "L");
$pdf->MultiCell(0, 5, "justifikasi teknis penyesuaian desain terhadap kondisi lapangan melanggar ketentuan tata bangunan dan/atau keandalan bangunan gedung; dan/atau", 0, "L", 0);

$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "4)", 0, 0, "L");
$pdf->MultiCell(0, 5, "pemilik bangunan gedung melakukan pelanggaran lain terhadap ketentuan penyelenggaraan bangunan gedung.", 0, "L", 0);
$pdf->Output('I', 'PersetujuanBangunanGedung.pdf');
