<?php
require_once(BASE_FILE_FPDF.'/fpdf.php');

$pdf = new FPDF('P','mm','A4');
// membuat halaman baru
$pdf->SetMargins(20,20,20);
$pdf->AddPage();
$pdf->Image(BASE_FILE_PATH."logo/logo_slf.png",39.5,50,131,100);
$pdf->Cell(200,135,'',0,1);

// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(200,5,'',0,1);
$pdf->SetFont('Arial','',12);

$pdf->Cell(19.5,5,'',0,0);
$pdf->Cell(58,5,'Nomor SLF',0,0);
$pdf->Cell(2,5,':',0,0);
$pdf->SetTextColor(50 , 150, 50);
$pdf->Cell(109,5,'-data-',0,1);
$pdf->SetTextColor(0, 0, 0);

$pdf->Cell(19.5,5,'',0,0);
$pdf->Cell(58,5,'Tanggal',0,0);
$pdf->Cell(2,5,':',0,0);
$pdf->SetTextColor(50 , 150, 50);
$pdf->Cell(109,5,'-data-',0,1);
$pdf->SetTextColor(0, 0, 0);

$pdf->Cell(19.5,5,'',0,0);
$pdf->Cell(58,5,'Atas nama/Pemilik',0,0);
$pdf->Cell(2,5,':',0,0);
$pdf->SetTextColor(50 , 150, 50);
$pdf->Cell(109,5,'-data-',0,1);
$pdf->SetTextColor(0, 0, 0);

$pdf->Cell(19.5,5,'',0,0);
$pdf->Cell(58,5,'Nomor Bukti Kepemilikan',0,0);
$pdf->Cell(2,5,':',0,0);
$pdf->SetTextColor(50 , 150, 50);
$pdf->Cell(109,5,'-data-',0,1);
$pdf->SetTextColor(0, 0, 0);

$pdf->Cell(19.5,5,'',0,0);
$pdf->Cell(58,5,'Fungsi bangunan gedung',0,0);
$pdf->Cell(2,5,':',0,0);
$pdf->SetTextColor(50 , 150, 50);
$pdf->Cell(109,5,'-data-',0,1);
$pdf->SetTextColor(0, 0, 0);

$pdf->Cell(19.5,5,'',0,0);
$pdf->Cell(58,5,'Jenis bangunan gedung',0,0);
$pdf->Cell(2,5,':',0,0);
$pdf->SetTextColor(50 , 150, 50);
$pdf->Cell(109,5,'-data-',0,1);
$pdf->SetTextColor(0, 0, 0);

$pdf->Cell(19.5,5,'',0,0);
$pdf->Cell(58,5,'Nama bangunan gedung',0,0);
$pdf->Cell(2,5,':',0,0);
$pdf->SetTextColor(50 , 150, 50);
$pdf->Cell(109,5,'-data-',0,1);
$pdf->SetTextColor(0, 0, 0);

$pdf->Cell(19.5,5,'',0,0);
$pdf->Cell(58,5,'Lokasi',0,0);
$pdf->Cell(2,5,':',0,0);
$pdf->SetTextColor(50 , 150, 50);
$pdf->Cell(109,5,'-data-',0,1);
$pdf->SetTextColor(0, 0, 0);

$pdf->Cell(200,65,'',0,1);

//$pdf->Image(BASE_FILE_PATH."logo/logo_pemda.png",20,260,20,22);
$pdf->SetFont('Arial','',10);
$pdf->Cell(26,5,'',0,0);
$pdf->Cell(68,5,'PEMERINTAH PROVINSI/KABUPATEN/KOTA ..... .................................................................',0,1);
$pdf->Cell(26,5,'',0,0);
$pdf->Cell(68,5,'ALAMAT : ..................................................................................................................................',0,1);

$pdf->AddPage();
$pdf->Image(BASE_FILE_PATH."logo/logo_pemda.png",95,20,20,22);
$pdf->Image(BASE_FILE_PATH."logo/background_slf.png",75,100,59,100);
$pdf->Cell(200,22,'',0,1);

$pdf->SetFont('ARIAL','B',16);
$pdf->SetTextColor(50 , 150, 50);
$pdf->Cell(0,10,'PEMERINTAH PROVINSI/KABUPATEN/KOTA ........',0,1,'C');
$pdf->SetTextColor(0, 0, 0);

$pdf->SetFont('ARIAL','B',14);
$pdf->Cell(0,10,'SURAT KETERANGAN BANGUNAN GEDUNG LAIK FUNGSI',0,1,'C');
$pdf->SetTextColor(50 , 150, 50);
$pdf->Cell(0,5,'NOMOR '.'-data-',0,1,'C');
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('ARIAL','',12);
$pdf->Cell(0,10,'GUBERNUR/BUPATI/WALIKOTA PROVINSI/KABUPATEN/KOTA ........',0,1,'C');
$pdf->Cell(0,5,'Berdasarkan Surat Pernyataan Kelaikan Fungsi Bangunan Gedung/Rekomendasi',0,1,'C');
$pdf->Cell(0,5,'Nomor : ........   Tanggal : ........',0,1,'C');

$pdf->Cell(0,12,'menyatakan bahwa :',0,1,'C');
$pdf->Cell(0,5,'Nama bangunan gedung',0,1,'C');$pdf->Cell(0,10,'.........................................',0,1,'C');
$pdf->Cell(0,5,'Jenis bangunan gedung',0,1,'C');$pdf->Cell(0,10,'.........................................',0,1,'C');
$pdf->Cell(0,5,'Fungsi bangunan gedung',0,1,'C');$pdf->Cell(0,10,'.........................................',0,1,'C');
$pdf->Cell(0,5,'Nomor Bukti Kepemilikan',0,1,'C');$pdf->Cell(0,10,'.........................................',0,1,'C');
$pdf->Cell(0,5,'Nomor IMB',0,1,'C');$pdf->Cell(0,10,'.........................................',0,1,'C');
$pdf->Cell(0,5,'Atas nama/Pemilik bangunan gedung',0,1,'C');$pdf->Cell(0,10,'.........................................',0,1,'C');
$pdf->Cell(0,5,'Lokasi',0,1,'C');$pdf->Cell(0,10,'.........................................',0,1,'C');$pdf->Cell(0,5,'.........................................',0,1,'C');
$pdf->Cell(0,5,'sebagai',0,1,'C');
$pdf->SetFont('ARIAL','B',14);
$pdf->Cell(0,10,'LAIK FUNGSI',0,1,'C');
$pdf->SetFont('ARIAL','',12);
$pdf->Cell(0,5,'seluruhnya/sebagian',0,1,'C');
$pdf->Cell(0,5,'sesuai dengan lampiran-lampiran Surat Keterangan ini',0,1,'C');
$pdf->Cell(0,5,'yang merupakan bagian yang tidak terpisahkan dari Surat Keterangan ini.',0,1,'C');
$pdf->Cell(0,5,'Surat Keterangan ini berlaku sampai 5/20 tahun sejak ditertibkan.',0,1,'C');
$pdf->Cell(0,5,'..............., 2018',0,1,'C');
$pdf->Cell(0,10,'GUBERNUR/BUPATI/WALIKOTA PROVINSI/KABUPATEN/KOTA ........',0,1,'C');
$pdf->Cell(0,17,'',0,1,'C');
$pdf->Cell(0,0,'.........................................',0,1,'C');
$pdf->Output();
?>
