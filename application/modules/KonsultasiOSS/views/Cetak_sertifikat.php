<?php

require_once(BASE_FILE_FPDF . '/fpdf.php');
$pdf = new FPDF('P', 'mm', 'Letter');
//membuat halaman baru
$pdf->SetMargins(10, 10, 10);

$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetMargins(10, 10, 10, 10);

$pdf->setXY(10, 15);

$pdf->image('assets/gambar/bg.PNG', 0, 0, 220, 280, '', '', '', false, 300, '', false, false, 0);
$pdf->image('assets/gambar/GARUDA.PNG', 68, 30, 80, 80, '', '', '', false, 300, '', false, false, 0);
$pdf->SetFont('Arial', 'B', 22);
$pdf->Cell(0, 10, "PEMERINTAH DAERAH", 0, 1, "C");
$pdf->Cell(0, 10, "PROVINSI DAERAH KHUSUS IBUKOTA JAKARTA", 0, 1, "C");
$pdf->setXY(10, 130);

$pdf->SetFont('Arial', 'B', 28);
$pdf->Cell(0, 10, "SERTIFIKAT LAIK FUNGSI", 0, 1, "C");
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, "Nomor :................................................", 0, 1, "C");
$pdf->Cell(0, 5, "", 0, 1, "C");

$pdf->Cell(25, 10, "", 0, 0, "L");
$pdf->Cell(60, 10, "PROVINSI", 0, 0, "L");
$pdf->Cell(0, 10, ": .................................................", 0, 1, "L");
$pdf->Cell(25, 10, "", 0, 0, "L");
$pdf->Cell(60, 10, "KABUPATEN/KOTA", 0, 0, "L");
$pdf->Cell(0, 10, ": .................................................", 0, 1, "L");
$pdf->Cell(25, 10, "", 0, 0, "L");
$pdf->Cell(60, 10, "KECAMATAN", 0, 0, "L");
$pdf->Cell(0, 10, ": .................................................", 0, 1, "L");
$pdf->Cell(25, 10, "", 0, 0, "L");
$pdf->Cell(60, 10, "DESA/KELURAHAN", 0, 0, "L");
$pdf->Cell(0, 10, ": .................................................", 0, 1, "L");

$pdf->Cell(0, 10, "", 0, 1, "C");
$pdf->Cell(120, 10, "", 0, 0, "L");
$pdf->Cell(50, 10, "DINAS .................", 0, 1, "L");
$pdf->Cell(120, 10, "", 0, 0, "L");
$pdf->Cell(0, 10, "Provinsi/Kabupaten/Kota", 0, 1, "L");
$pdf->image('assets/gambar/barcode.PNG', 150, 225, 30, 30);

$pdf->Output('I', 'surat.pdf');
