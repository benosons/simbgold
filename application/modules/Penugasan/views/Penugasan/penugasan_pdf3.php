<?php
class ConductPDF extends FPDF
{

    function Header()
    {
        if ($this->PageNo() == 1) {
            $this->setFont('Arial', 'I', 9);
            $this->setFillColor(255, 255, 255);
            $this->cell(90, 6, '', 0, 0, 'L', 1);
            $this->cell(100, 6, "Tanggal: " . date('d/m/Y'), 0, 1, 'R', 1);
            $this->Line(10, $this->GetY(), 200, $this->GetY());
            // Logo
            $this->Image(base_url('assets/logo/logo.png'), 10, 20, '20', '20', 'png');
            $this->Ln(12);
            $this->setFont('Arial', '', 14);
            $this->setFillColor(255, 255, 255);
            $this->cell(25, 6, '', 0, 0, 'C', 0);
            $this->cell(150, 6, 'Laporan Data Penugasan Pemeriksan Dokumen Konsultasi PBG', 0, 1, 'C', 1);
            $this->cell(25, 6, '', 0, 0, 'C', 0);
            $this->cell(100, 6, "", 0, 1, 'L', 1);
            $this->cell(25, 6, '', 0, 0, 'C', 0);
            $this->cell(100, 6, '', 0, 1, 'L', 1);
            // Line break
            $this->Ln(5);
            $this->setFont('Arial', 'B', 9);
            $this->setFillColor(230, 230, 200);
            $this->cell(10, 10, 'No.', 1, 0, 'L', 1);
            $this->cell(40, 10, 'Jenis Konsultasi', 1, 0, 'C', 1);
            $this->cell(45, 10, 'Nomor Registrasi   ', 1, 0, 'C', 1);
            $this->cell(30, 10, 'Nama Pemilik', 1, 0, 'C', 1);
            $this->cell(40, 10, 'Lokasi Bangunan', 1, 0, 'C', 1);
            $this->cell(30, 10, 'Status', 1, 1, 'C', 1);
        } else {
            $this->setFont('Arial', 'I', 9);
            $this->setFillColor(255, 255, 255);
            $this->cell(90, 6, "Laporan Data Pegawai", 0, 0, 'L', 1);
            $this->cell(100, 6, "(A4 - Portrait) - Printed date : " . date('d-M-Y'), 0, 1, 'R', 1);
            $this->Ln(2);
            $this->setFont('Arial', 'B', 9);
            $this->setFillColor(230, 230, 200);
            $this->cell(10, 10, 'No.', 1, 0, 'L', 1);
            $this->cell(40, 10, 'Jenis Konsultasi', 1, 0, 'C', 1);
            $this->cell(45, 10, 'Nomor Registrasi', 1, 0, 'C', 1);
            $this->cell(30, 10, 'Nama Pemilik', 1, 0, 'C', 1);
            $this->cell(40, 10, 'Lokasi Bangunan', 1, 0, 'C', 1);
            $this->cell(35, 10, 'Status', 1, 1, 'C', 1);
        }
    }

    function vcell($c_width, $c_height, $x_axis, $text)
    {
        $w_w = $c_height / 3;
        $w_w_1 = $w_w + 2;
        $w_w1 = $w_w + $w_w + $w_w + 3;
        $len = strlen($text); // check the length of the cell and splits the text into 7 character each and saves in a array 

        $lengthToSplit = 7;
        if ($len > $lengthToSplit) {
            $w_text = str_split($text, $lengthToSplit);
            $this->SetX($x_axis);
            $this->Cell($c_width, $w_w_1, $w_text[0], '', '', '');
            if (isset($w_text[1])) {
                $this->SetX($x_axis);
                $this->Cell($c_width, $w_w1, $w_text[1], '', '', '');
            }
            $this->SetX($x_axis);
            $this->Cell($c_width, $c_height, '', 'LTRB', 0, 'L', 0);
        } else {
            $this->SetX($x_axis);
            $this->Cell($c_width, $c_height, $text, 'LTRB', 0, 'L', 0);
        }
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        //buat garis horizontal
        $this->Line(10, $this->GetY(), 200, $this->GetY());
        //Arial italic 9
        $this->SetFont('Arial', 'I', 9);
        $this->Cell(0, 10, 'Hak Cipta @ ' . date('Y') . ' Kementerian Pekerjaan Umum Dan Perumahan Rakyat Republik Indonesia.
          ', 0, 0, 'L');
        //nomor halaman
        $this->Cell(0, 10, 'Halaman ' . $this->PageNo() . '', 0, 0, 'R');
    }
}
$pdf = new ConductPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 16);
$pdf->Ln();
$pdf->Output();
