<?php
require_once(BASE_FILE_FPDF.'/fpdf.php');
$pdf = new FPDF('P','mm','A4');
$pdf->SetMargins(10,10,20);
$pdf->AddPage();
$pdf->Cell(100,5,'',0,1);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(190,7,'Rekap Retribusi ',0,1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(190,7,'Kabupaten',0,1,'C');
 // Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,7,'',0,1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(15,6,'No.',1,0);
$pdf->Cell(25,6,'No. SK IMB',1,0,'C');
$pdf->Cell(35,6,'Nama Pemilik',1,0,'C');
$pdf->Cell(65,6,'Alamat Bangunan Gedung',1,0,'C');
$pdf->Cell(25,6,'Nominal',1,1,'C');
//Menampilkan Data
$pdf->SetFont('Arial','',10);
    //$retribusi = $this->mrekap->getDataRekapRetribusi->result();
	if($retribusi->num_rows() > 0){
		$no = 1;
		//$no_sk = $key->no_imb;
		foreach ($retribusi as $row){
			//$no_sk = $row->no_imb;
			$pdf->Cell(15,6,$no++,1,0,'C');
			$pdf->Cell(25,6,$row['no_imb'],1,0);
			$pdf->Cell(35,6,'1',1,0);
			$pdf->Cell(65,6,'1',1,0);
			$pdf->Cell(25,6,'a',1,1);			
		}
	}
	
$pdf->Output('I','.pdf');	
?>

