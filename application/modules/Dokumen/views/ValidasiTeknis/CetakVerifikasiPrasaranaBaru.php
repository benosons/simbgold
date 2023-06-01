<?php
require_once(BASE_FILE_FPDF . '/fpdf.php');
$pdf = new FPDF('P', 'mm', 'A4');
$wilayah = $result_list['nm_kabkot_bgn'];
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
$permohonan2= "Pemohon Persetujuan Bangunan Gedung (PBG)";
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
$no_konsultasi = $result_list['no_konsultasi'];
$tgl_pernyataan  = tgl_eng_to_ind($result_list['tgl_pernyataan']);
$pdf->MultiCell(0, 5, "Berdasarkan hasil pemeriksaan kesesuaian dokumen rencana teknis yang di sampaikan dengan nomor permohonan $no_konsultasi pada Tanggal $tgl_pernyataan , dan dengan memperhatikan berita acara konsultansi oleh TPA/TPT, bersama ini kami nyatakan bahwa dokumen rencana teknis Saudara telah memenuhi standar teknis dengan data sebagai berikut:", 0, "J", 0);
$pdf->Cell(0, 5, "", 0, 1, "L");
$pdf->Cell(20, 5, "", 0, 0, "L");
$pdf->Cell(60, 5, "Nama Pemilik", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->MultiCell(0, 5, $result_list['nm_pemilik'], 0, "J", 0);
$pdf->Cell(20, 5, "", 0, 0, "L");
$pdf->Cell(60, 5, "Lokasi Bangunan Prasarana", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->MultiCell(0, 5, $result_list['almt_bgn'] . ', Kel/Desa ' . $result_list['nm_kel_bgn'] . ', Kec. ' . $result_list['nm_kec_bgn'] . ', ' . ucwords(strtolower($result_list['nm_kabkot_bgn'])) . ', Prov ' . $result_list['nm_prov_bgn'], 0, "L", 0);
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
$pdf->Cell(15, 5, number_format($result_list['luas_bgp'],2,',','.'), 0, 0, "L");
$pdf->Cell(3,5,'m',0,0,"L");
$pdf->subWrite(5,'2','',6,4);
$pdf->Cell(10,5,'',0,1);
$pdf->Cell(20, 5, "", 0, 0, "L");
$pdf->Cell(60, 5, "Ketinggian Bangunan", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, $result_list['tinggi_bgp']. ' Meter', 0, 1, "L");
//$pdf->Cell(41, 5, "", 0, 0, "L");
$j=1;
if ($count_tanah>1) {
  if($result_list['id'] =='150163') {
    $pdf->Cell(20,5,'',0,0);
    $pdf->Cell(60,5,'Data Tanah',0,0,'L');
    $pdf->Cell(2,5,':',0,0);
    foreach ($result_tanah as $key => $row) {
      $hat = $row['hat'];
      if($j > 1){
        $pdf->Cell(39,5,'',0,0);
      }
      $pdf->Cell(20,5,$j++.'. Atas Nama',0,0);
      $pdf->Cell(2,5,':',0,0);
      $pdf->MultiCell(65,5,(isset($row['atas_nama_dok']) ? $row['atas_nama_dok'] : '[ PEMILIK TANAH KOSONG ]'),0,"L",0);
      if ($row['hat'] != 0) {
        $pdf->Cell(85,5,'',0,0);
        $pdf->Cell(20,5,'Dokumen',0,0);
        $pdf->Cell(2,5,':',0,0);
        $pdf->Cell(15,5,(isset($row['Jns_dok']) ? $row['Jns_dok'] : '[ HAK ATAS TANAH KOSONG ]'),0,1);
        $pdf->Cell(85,5,'',0,0);
        $pdf->Cell(19,5,'Luas',0,0);
        $pdf->Cell(2,5,':',0,0);
        $pdf->Cell(14,5,(isset($row['luas_tanah']) ? number_format($row['luas_tanah'],2,',','.') : '[ LUAS TANAH KOSONG ]'),0,0);
        $pdf->Cell(4,5,' m',0,0);
        $pdf->subWrite(5,'2','',6,4);
        $pdf->Cell(10,5,'',0,1);
      }
      $pdf->Cell(42,5,'',0,0);
    }
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
		$pdf->Cell(18,5,(isset($row['luas_tanah']) ? number_format($row['luas_tanah'],2,',','.') : '[ LUAS TANAH KOSONG ]'),0,0);
		if ($row['luas_tanah'] != 0 || $row['luas_tanah'] == null){
			$pdf->Cell(3,5,'m',0,0);
			$pdf->subWrite(5,'2','',6,4);
			$pdf->Cell(10,5,'',0,1);
		}
		$pdf->Cell(20,5,'',0,0);
		$pdf->Cell(60,5,'Pemilik Tanah',0,0,'L');
		$pdf->Cell(2,5,": ",0,0);
		$pdf->MultiCell(95,5,(isset($row['atas_nama_dok']) ? $row['atas_nama_dok'] : '[ PEMILIK TANAH KOSONG ]'),0,1);
    $pdf->Cell(20,5,'',0,0);
		$pdf->Cell(60,5,'No.Dokumen',0,0,'L');
		$pdf->Cell(2,5,": ",0,0);
		$pdf->MultiCell(95,5,(isset($row['atas_nama_dok']) ? $row['no_dok'] : '[ PEMILIK TANAH KOSONG ]'),0,1);
	
  }
}
$pdf->Cell(0, 5, "", 0, 1, "L");
$pdf->Cell(58, 5, "Dengan demikian permohonan PBG", 0, 0, "L");
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 5, "dapat dilakukan dan dapat diterbitkan segera.", 0, 1, "L");
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
if($result_list['status_pejabat'] == '1'){
  $pdf->Cell(100, 5, "", 0, 0, "L");
  $pdf->MultiCell(0, 5, "PLT KEPALA " .ucwords(strtoupper($result_list['p_nama_dinas'])), 0, "L", 0);
} else if($result_list['status_pejabat'] == '2'){
  $pdf->Cell(100, 5, "", 0, 0, "L");
  $pdf->MultiCell(0, 5, "PJS KEPALA " .ucwords(strtoupper($result_list['p_nama_dinas'])), 0, "L", 0);
} else if($result_list['status_pejabat'] == '3'){
  $pdf->Cell(100, 5, "", 0, 0, "L");
  $pdf->MultiCell(0, 5, "KEPALA " .ucwords(strtoupper($result_list['p_nama_dinas'])), 0, "L", 0);
} else if($result_list['status_pejabat'] == '4'){
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
$pdf->Output('I',$no_konsultasi.'.'.'pdf');
