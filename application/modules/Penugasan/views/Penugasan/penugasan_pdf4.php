<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class PDF extends FPDF
{
    // Page header
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
            $this->cell(30, 10, 'Status', 1, 1, 'C', 1);
        }
    }

    function Content($penugasan)
    {
        $ya = 56;
        $rw = 6;
        $no = 1;
        foreach ($penugasan as $key) {
            $pesan = $key->status  == 3 ? 'Menunggu Penugasan TPA/TPT' : 'Sudah Dilakukan Penugasan';
            $cellWidth = 40; //lebar sel
            $cellHeight = 5; //tinggi sel satu baris normal
            if ($this->GetStringWidth($key->almt_bgn) < $cellWidth) {
                //jika tidak, maka tidak melakukan apa-apa
                $line = 1;
            } else {
                $textLength = strlen($key->almt_bgn);    //total panjang teks
                $errMargin = 5;        //margin kesalahan lebar sel, untuk jaga-jaga
                $startChar = 0;        //posisi awal karakter untuk setiap baris
                $maxChar = 0;            //karakter maksimum dalam satu baris, yang akan ditambahkan nanti
                $textArray = array();    //untuk menampung data untuk setiap baris
                $tmpString = "";        //untuk menampung teks untuk setiap baris (sementara)

                while ($startChar < $textLength) { //perulangan sampai akhir teks
                    //perulangan sampai karakter maksimum tercapai
                    while (
                        $this->GetStringWidth($tmpString) < ($cellWidth - $errMargin) &&
                        ($startChar + $maxChar) < $textLength
                    ) {
                        $maxChar++;
                        $tmpString = substr($key->almt_bgn, $startChar, $maxChar);
                    }
                    //pindahkan ke baris berikutnya
                    $startChar = $startChar + $maxChar;
                    //kemudian tambahkan ke dalam array sehingga kita tahu berapa banyak baris yang dibutuhkan
                    array_push($textArray, $tmpString);
                    //reset variabel penampung
                    $maxChar = 0;
                    $tmpString = '';
                }
                //dapatkan jumlah baris
                $line = count($textArray);
            }
            if ($this->GetStringWidth($pesan) < $cellWidth) {
                //jika tidak, maka tidak melakukan apa-apa
                $line = 1;
            } else {
                $textLength = strlen($pesan);    //total panjang teks
                $errMargin = 3;        //margin kesalahan lebar sel, untuk jaga-jaga
                $startChar = 0;        //posisi awal karakter untuk setiap baris
                $maxChar = 0;            //karakter maksimum dalam satu baris, yang akan ditambahkan nanti
                $textArray = array();    //untuk menampung data untuk setiap baris
                $tmpString = "";        //untuk menampung teks untuk setiap baris (sementara)

                while ($startChar < $textLength) { //perulangan sampai akhir teks
                    //perulangan sampai karakter maksimum tercapai
                    while (
                        $this->GetStringWidth($tmpString) < ($cellWidth - $errMargin) &&
                        ($startChar + $maxChar) < $textLength
                    ) {
                        $maxChar++;
                        $tmpString = substr($pesan, $startChar, $maxChar);
                    }
                    //pindahkan ke baris berikutnya
                    $startChar = $startChar + $maxChar;
                    //kemudian tambahkan ke dalam array sehingga kita tahu berapa banyak baris yang dibutuhkan
                    array_push($textArray, $tmpString);
                    //reset variabel penampung
                    $maxChar = 0;
                    $tmpString = '';
                }
                //dapatkan jumlah baris
                $line = count($textArray);
            }
            $this->setFont('Arial', '', 9);

            $this->setFillColor(255, 255, 255);
            $this->Cell(10, ($line * $cellHeight), $no, 1, 0, 'C', true); //sesuaikan ketinggian dengan jumlah garis
            $this->Cell(40, ($line * $cellHeight), $key->nm_konsultasi, 1, 0); //sesuaikan ketinggian dengan jumlah garis
            $this->Cell(45, ($line * $cellHeight), $key->no_konsultasi, 1, 0); //sesuaikan ketinggian dengan jumlah garis
            $this->Cell(30, ($line * $cellHeight), $key->nm_pemilik, 1, 0); //sesuaikan ketinggian dengan jumlah garis

            $xPos = $this->GetX();
            $yPos = $this->GetY();
            $this->MultiCell($cellWidth, $cellHeight, $key->almt_bgn, 1);
            $this->SetXY($xPos + $cellWidth , $yPos);
            $this->MultiCell($cellWidth, $cellHeight, $pesan, 1);
            // $this->Cell(50,($line * $cellHeight),$pesan,1,1); //sesuaikan ketinggian dengan jumlah garis

            // $this->cell(10, 6, $no, 1, 0, 'L', 1);
            // $this->cell(40, 6, $key->nm_konsultasi, 1);
            // $this->cell(45, 6, $key->no_konsultasi, 1, 0, 'L', 1);

            // $this->MultiCell(40, 6, $key->nm_konsultasi, 1);
            // $this->MultiCell(45, 6, $key->no_konsultasi, 1);
            // $this->cell(40, 6, $key->nm_konsultasi, 1, 0, 'L', 1);
            // $this->cell(30, 6, $key->nm_pemilik, 1, 0, 'L', 1);
            // $this->cell(40, 6, $key->almt_bgn, 1, 0, 'L', 1);
            // $this->cell(30, 6, $pesan, 1, 1, 'L', 1);
            $ya = $ya + $rw;
            $no++;
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
        $this->Cell(0, 10, 'Halaman ' . $this->PageNo() . '/{nb}', 0, 0, 'R');
    }
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Content($penugasan);
$pdf->Output();
