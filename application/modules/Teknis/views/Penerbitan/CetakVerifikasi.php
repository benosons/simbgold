<?php
require_once(BASE_FILE_FPDF . '/fpdf.php');
$pdf = new FPDF('P', 'mm', 'A4');

$wilayah = $nm_kabkot_bgn;
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
//membuat halaman baru
$pdf->SetMargins(10, 10, 10);

$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetMargins(10, 10, 10, 10);
$pdf->setXY(10, 10);
$pdf->SetFont('Arial', '', 9);
$pdf->image('assets/logo/garuda.png', 100, 10, 20, 20);

$pdf->setXY(10, 40);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 5, "PEMERINTAH REPUBLIK INDONESIA", 0, 1, "C");
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 5, "PERNYATAAN PEMENUHAN STANDAR", 0, 1, "C");
$pdf->Cell(0, 5, "", 0, 1, "L");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(100, 5, "Nomor :......", 0, 0, "L");
$pdf->Cell(0, 5, "Kab/Kota..................2020", 0, 1, "L");
$pdf->Cell(0, 5, "Lampiran : 1 (satu) berkas", 0, 1, "L");
$pdf->Cell(0, 5, "Kepada Yth.", 0, 1, "L");
$pdf->Cell(0, 5, "Pemohon Persetujuan Bangunan Gedung (PBG)", 0, 1, "L");
$pdf->Cell(0, 5, "di-", 0, 1, "L");
$pdf->Cell(0, 5, "tempat", 0, 1, "L");
$pdf->Cell(0, 5, "", 0, 1, "L");
$pdf->Cell(15, 5, "Perihal : ", 0, 0, "L");
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 5, "Pernyataan Pemenuhan Standar Teknis Bangunan Gedung", 0, 1, "L");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, "", 0, 1, "L");
$pdf->Cell(0, 5, "Dengan hormat,", 0, 1, "L");
$pdf->MultiCell(0, 5, "Berdasarkan hasil pemeriksaan kesesuaian dokumen rencana teknis yang Saudara sampaikan dengan nomor permohonan $no_konsultasi pada tanggal $tgl_pernyataan , dan dengan memperhatikan berita acara konsultansi oleh TPA/TPT, bersama ini kami nyatakan bahwa dokumen rencana teknis Saudara telah/tidak memenuhi standar teknis dengan data sebagai berikut:", 0, "L", 0);
$pdf->Cell(0, 5, "", 0, 1, "L");
$pdf->Cell(20, 5, "a.", 0, 0, "L");
$pdf->Cell(60, 5, "Nama Pemilik", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, $nm_pemilik, 0, 1, "L");
$pdf->Cell(20, 5, "b.", 0, 0, "L");
$pdf->Cell(60, 5, "Alamat", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, $almt_bgn, 0, 1, "L");
$pdf->Cell(20, 5, "c.", 0, 0, "L");
$pdf->Cell(60, 5, "Fungsi Bangunan Gedung", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, "", 0, 1, "L");
$pdf->Cell(20, 5, "d.", 0, 0, "L");
$pdf->Cell(60, 5, "Jenis Bangunan Gedung ", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, "", 0, 1, "L");
$pdf->Cell(20, 5, "e.", 0, 0, "L");
$pdf->Cell(60, 5, "Nama Bangunan Gedung ", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, $nm_bgn, 0, 1, "L");
$pdf->Cell(20, 5, "f.", 0, 0, "L");
$pdf->Cell(60, 5, "Luas Bangunan Gedung", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, $luas_bgn, 0, 1, "L");
$pdf->Cell(20, 5, "g.", 0, 0, "L");
$pdf->Cell(60, 5, "Jumlah Lantai/tinggi Bangunan", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, $jml_lantai .' Lantai / '. $tinggi_bgn .' Meter', 0, 1, "L");
$pdf->Cell(20, 5, "h.", 0, 0, "L");
$pdf->Cell(60, 5, "Atas nama/pemilik tanah", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, "", 0, 1, "L");

$pdf->Cell(0, 5, "", 0, 1, "L");
$pdf->Cell(72, 5, "Dengan demikian permohonan PBG Saudara ", 0, 0, "L");
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 5, "dapat dilakukan dan dapat diterbitkan segera.", 0, 1, "L");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, "", 0, 1, "L");

$pdf->MultiCell(0, 5, "Demikian surat pernyataan ini kami sampaikan. Atas perhatian dan kerja sama Saudara, kami ucapkan terima kasih.", 0, "L", 0);

$pdf->Cell(0, 10, "", 0, 1, "L");
//$pdf->image('assets/logo/barcode.PNG', 50, 173, 30, 30);
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "DITETAPKAN DI : ..........", 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "PADA TANGGAL : ..........", 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0,5,'ATAS NAMA '.$pejabat.' '.$kabkota,0,1,"L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->MultiCell(0, 5, "KEPALA " .ucwords(strtoupper($p_nama_dinas)), 0, "L", 0);

$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 10, "", 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, $kepala_dinas, 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "NIP: $nip_kepala_dinas", 0, 1, "L");


$pdf->Output('I', 'surat.pdf');
