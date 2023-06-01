<?php
//menyertakan file fpdf
require_once(BASE_FILE_FPDF . '/fpdf.php');
$pdf = new FPDF('P', 'mm', 'A4'); //membuat halaman baru
//membuat halaman baru
$pdf->AddPage();
//menyeting jenis font, bold, dan ukuran
$pdf->SetFont('Arial','B',20);
//menyeting tata letak tulisan
$pdf->Cell(40,10,'PBG Contoh');
//menampilkan tulisan
$pdf->Output();

?>
