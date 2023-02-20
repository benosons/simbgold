<?php
//call main fpdf file

//create new class extending fpdf class
class PDF_MC_Table extends FPDF
{

    // variable to store widths and aligns of cells, and line height
    var $widths;
    var $aligns;
    var $lineHeight;


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
    
    //Set the array of column widths
    function SetWidths($w)
    {
        $this->widths = $w;
    }

    //Set the array of column alignments
    function SetAligns($a)
    {
        $this->aligns = $a;
    }

    //Set line height
    function SetLineHeight($h)
    {
        $this->lineHeight = $h;
    }

    //Calculate the height of the row
    function Row($data)
    {
        // number of line
        $nb = 0;

        // loop each data to find out greatest line number in a row.
        for ($i = 0; $i < count($data); $i++) {
            // NbLines will calculate how many lines needed to display text wrapped in specified width.
            // then max function will compare the result with current $nb. Returning the greatest one. And reassign the $nb.
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        }

        //multiply number of line with line height. This will be the height of current row
        $h = $this->lineHeight * $nb;

        //Issue a page break first if needed
        $this->CheckPageBreak($h);

        //Draw the cells of current row
        for ($i = 0; $i < count($data); $i++) {
            // width of the current col
            $w = $this->widths[$i];
            // alignment of the current col. if unset, make it left.
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border
            $this->Rect($x, $y, $w, $h);
            //Print the text
            $this->MultiCell($w, 5, $data[$i], 0, $a);
            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->Ln($h);
    }

    function CheckPageBreak($h)
    {
        //If the height h would cause an overflow, add a new page immediately
        if ($this->GetY() + $h > $this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
    }

    function NbLines($w, $txt)
    {
        //calculate the number of lines a MultiCell of width w will take
        $cw = &$this->CurrentFont['cw'];
        if ($w == 0)
            $w = $this->w - $this->rMargin - $this->x;
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb > 0 and $s[$nb - 1] == "\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c == "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if ($c == ' ')
                $sep = $i;
            $l += $cw[$c];
            if ($l > $wmax) {
                if ($sep == -1) {
                    if ($i == $j)
                        $i++;
                } else
                    $i = $sep + 1;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            } else
                $i++;
        }
        return $nl;
    }

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
