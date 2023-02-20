<?php
//include pdf_mc_table.php, not fpdf17/fpdf.php
include('pdf_mc_table.php');

//make new object
$pdf = new PDF_MC_Table();

//add page, set font
$pdf->AddPage();
$pdf->SetFont('Arial','',10);

//set width for each column (6 columns)
$pdf->SetWidths(Array(10,40,45,30,40,30));

//set alignment
//$pdf->SetAligns(Array('','R','C','','',''));

//set line height. This is the height of each lines, not rows.
$pdf->SetLineHeight(5);

//load json data
$data = $penugasan;

//add table heading using standard cells
//set font to bold
// $pdf->SetFont('Arial','B',12);
// $pdf->Cell(15,5,"No",1,0);
// $pdf->Cell(40,5,"Jenis Konsultasi",1,0);
// $pdf->Cell(45,5,"Nomor Registrasi",1,0);
// $pdf->Cell(30,5,"Nama Pemilik",1,0);
// $pdf->Cell(40,5,"Lokasi Bangunan",1,0);
// $pdf->Cell(20,5,"Status",1,0);

// $pdf->Ln();

//reset font
$pdf->SetFont('Arial','',10);
//loop the data
$no = 1;
foreach($data as $item)
{
    //write data using Row() method containing array of values.
    $pesan = $item->status  == 3 ? 'Menunggu Penugasan TPA/TPT' : 'Sudah Dilakukan Penugasan';
	$pdf->Row(Array(
        $no++,
		$item->nm_konsultasi,
		$item->no_konsultasi,
		$item->nm_pemilik,
		$item->almt_bgn,
		$pesan,
	));
	
}

//output the pdf
$pdf->Output();






