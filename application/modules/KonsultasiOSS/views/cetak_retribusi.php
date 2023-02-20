<?php

require_once(BASE_FILE_FPDF . '/fpdf.php');
$pdf = new FPDF('P', 'mm', 'Letter');
//membuat halaman baru
$pdf->SetMargins(10, 10, 10);
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetMargins(10, 10, 10);
$pdf->image('assets/logo/logo.PNG', 12, 12, 20, 20);

$pdf->setXY(10, 10);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(92, 24, "", 1, 0, "C");

$pdf->setXY(10, 12);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(21, 4, "", 0, 0, "C");
$pdf->Cell(71, 4, "PEMERINTAH KOTA DENPASAR", 0, 1, "C");
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(21, 4, "", 0, 0, "C");
$pdf->Cell(71, 4, "DINAS PENANAMAN MODAL DAN PTSP", 0, 1, "C");
$pdf->SetFont('Arial', '', 5);
$pdf->Cell(21, 4, "", 0, 0, "C");
$pdf->Cell(71, 4, "GRAHA SEWAKA DHARMA, JALAN MAJAPAHIT DENPASAR. TELP.(0361) 430820", 0, 1, "C");
$pdf->Cell(21, 4, "", 0, 0, "C");
$pdf->Cell(71, 4, "http://dinasperijinan.denpasarkota.go.id, Email.perijinan@denpasarkota.go.id ", 0, 1, "C");
$pdf->Cell(21, 4, "", 0, 0, "C");
$pdf->Cell(71, 4, "HOTLINE SMS:3477 ", 0, 1, "R");

$pdf->setXY(102, 10);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(54, 24, "", 1, 0, "C");

$pdf->setXY(102, 12);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(54, 5, "LAMPIRAN RINCIAN", 0, 1, "C");
$pdf->Cell(92, 5, "", 0, 0, "R");
$pdf->Cell(54, 5, "RETRIBUSI DAERAH", 0, 1, "C");

$pdf->setXY(156, 10);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(50, 24, "", 1, 0, "C");

$pdf->setXY(156, 27);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(50, 5, "Nomor Reg. : 002U.2000220", 0, 1, "L");

$pdf->setXY(10, 35);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(0, 190, "", 1, 0, "C");

$pdf->setXY(10, 35);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(40, 5, "Nama Pemohon", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->MultiCell(0, 5, "Suanjaya -", 0, "J", 0);
$pdf->Cell(40, 5, "Alamat Pemohon", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->MultiCell(0, 5, "Jl. Gajah Mada No. 35, Desa Dauh Puri Kangin, Denpasar Utara Pekerjaan", 0, "J", 0);
$pdf->Cell(40, 5, "Pekerjaan", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->MultiCell(0, 5, "Wiraswasta", 0, "J", 0);
$pdf->Cell(40, 5, "NPWPD", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->MultiCell(0, 5, "xxxx", 0, "J", 0);
$pdf->Cell(60, 5, "Batas Penyetoran Terakhir Tanggal", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->MultiCell(0, 5, "xxxxx", 0, "J", 0);


$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(0, 5, "A. Rincian Retribusi Bangunan Gedung", 1, 1, "L");


$pdf->SetFont('Arial', '', 9);
$pdf->Cell(60, 5, "1.Jenis", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->MultiCell(0, 5, "xxxx", 0, "J", 0);
$pdf->Cell(60, 5, "2.Luas Bangunan Gedung", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->MultiCell(0, 5, "xxxx", 0, "J", 0);
$pdf->Cell(60, 5, "3.Luas Teras, Balkon & Selasar", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->MultiCell(0, 5, "xxxx", 0, "J", 0);
$pdf->Cell(60, 5, "4.Luas Canopy & pergola berkolo", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->MultiCell(0, 5, "xxxx", 0, "J", 0);
$pdf->Cell(60, 5, "5.Luas Canopy & pergola tanpa kolom", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->MultiCell(0, 5, "xxxxx", 0, "J", 0);
$pdf->Cell(60, 5, "6.Nilai RAB", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->MultiCell(0, 5, "xxxxx", 0, "J", 0);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(0, 5, "Perhitungan Index Terintegrasi :", 0, 1, "L");

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(15, 5, "Fungsi", 0, 0, "L");
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->Cell(23, 5, "4", 0, 0, "C");
$pdf->Cell(20, 5, "0.25 x 0.40", 0, 0, "R");
$pdf->Cell(2, 5, "=", 0, 0, "C");
$pdf->Cell(10, 5, "0.100", 0, 0, "R");
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(30, 5, "Kompleksitas", 0, 0, "L");
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->Cell(30, 5, "Sederhana", 0, 0, "L");
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(30, 5, "Waktu Penggunaan ", 0, 0, "L");
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->Cell(10, 5, "1.00", 0, 1, "L");

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(40, 5, "Ganda / Campuran", 0, 0, "L");
$pdf->Cell(20, 5, "0.20 x 1.00", 0, 0, "R");
$pdf->Cell(2, 5, "=", 0, 0, "C");
$pdf->Cell(10, 5, "0.200", 0, 0, "R");
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(30, 5, "Permanensi", 0, 0, "L");
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->Cell(30, 5, "Permanen", 0, 0, "L");
$pdf->Cell(30, 5, "Lebih dari 3 tahun ", 0, 1, "L");

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(40, 5, "", 0, 0, "L");
$pdf->Cell(20, 5, "0.15 x 0.70", 0, 0, "R");
$pdf->Cell(2, 5, "=", 0, 0, "C");
$pdf->Cell(10, 5, "0.105", 0, 0, "R");
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(30, 5, "Resiko Kebakaran", 0, 0, "L");
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->Cell(30, 5, "Sedang", 0, 1, "L");

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(40, 5, "", 0, 0, "L");
$pdf->Cell(20, 5, "0.15 x 0.70", 0, 0, "R");
$pdf->Cell(2, 5, "=", 0, 0, "C");
$pdf->Cell(10, 5, "0.105", 0, 0, "R");
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(30, 5, "Zonasi Gempa", 0, 0, "L");
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->Cell(30, 5, "Zona V / Kuat", 0, 1, "L");

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(40, 5, "", 0, 0, "L");
$pdf->Cell(20, 5, "0.10 x 1.00", 0, 0, "R");
$pdf->Cell(2, 5, "=", 0, 0, "C");
$pdf->Cell(10, 5, "0.100", 0, 0, "R");
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(30, 5, "Lokasi", 0, 0, "L");
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->Cell(30, 5, "Padat", 0, 1, "L");

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(40, 5, "", 0, 0, "L");
$pdf->Cell(20, 5, "0.10 x 0.40", 0, 0, "R");
$pdf->Cell(2, 5, "=", 0, 0, "C");
$pdf->Cell(10, 5, "0.040", 0, 0, "R");
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(30, 5, "Ketinggian", 0, 0, "L");
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->Cell(30, 5, "Rendah (lt1 - lt4)", 0, 1, "L");

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(40, 5, "", 0, 0, "L");
$pdf->SetFont('Arial', 'U', 9);
$pdf->Cell(20, 5, "0.05 x 0.70", 0, 0, "R");
$pdf->Cell(2, 5, "=", 0, 0, "C");
$pdf->Cell(10, 5, "0.035", 0, 0, "R");
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(30, 5, "Kepemilikan", 0, 0, "L");
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->Cell(30, 5, "Perorangan", 0, 1, "L");

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(72, 5, "0.685", 0, 1, "R");
$pdf->Cell(0, 5, "", 0, 1, "R");

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(0, 5, "Terdapat Basemen/bagian bangunan diatas/bawah permukaan air, prasarana dan sarana umum ? : Tidak ada (1.00)", 0, 1, "L");
$pdf->Cell(0, 5, "Nilai Index Terintegrasi	: 4 x 0.685 x 1.00 x 1.00 = 2.74", 0, 1, "L");
$pdf->Cell(0, 5, "Tarif Retribusi Bangunan	: 208.18 x 2.74 x 1.00 x Rp 17.000,- = Rp 9.697.025,-", 0, 1, "L");

$pdf->setXY(10, 161);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(0, 5, "B. Rincian Retribusi Prasarana Bangunan Gedung", 1, 1, "L");
$pdf->Cell(0, 5, "Jenis : Pembangunan Prasarana Bangunan", 0, 1, "L");
$pdf->Cell(65, 5, "Jenis Prasarana:", 0, 0, "L");
$pdf->Cell(20, 5, "Keterangan:", 0, 0, "L");
$pdf->Cell(40, 5, "Satuan:", 0, 0, "R");
$pdf->Cell(40, 5, "Perhitungan:", 0, 0, "R");
$pdf->Cell(25, 5, "Biaya:", 0, 1, "R");
$pdf->Cell(3, 5, "1", 0, 0, "L");
$pdf->Cell(0, 5, "Konstruksi pembatas/penahan/pengaman :", 0, 1, "L");
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(3, 5, "", 0, 0, "L");
$pdf->Cell(62, 5, "Pagar", 0, 0, "L");
$pdf->Cell(20, 5, "Baru", 0, 0, "L");
$pdf->Cell(40, 5, "panjang: 73.01m", 0, 0, "R");
$pdf->Cell(40, 5, "Rp 1000x73.01x1 =Rp", 0, 0, "R");
$pdf->Cell(25, 5, "73.010", 0, 1, "R");

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(3, 5, "2", 0, 0, "L");
$pdf->Cell(0, 5, "Konstruksi penanda masuk lokasi :", 0, 1, "L");
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(3, 5, "", 0, 0, "L");
$pdf->Cell(62, 5, "Gerbang (luas maks. 2m2)", 0, 0, "L");
$pdf->Cell(20, 5, "Baru", 0, 0, "L");
$pdf->Cell(40, 5, "juml: 1unit,Luas: 0.32m2", 0, 0, "R");
$pdf->Cell(40, 5, "Rp 50000x1x1 =Rp", 0, 0, "R");
$pdf->Cell(25, 5, "50.000", 0, 1, "R");

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(3, 5, "3", 0, 0, "L");
$pdf->Cell(0, 5, "Konstruksi perkerasan :", 0, 1, "L");
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(3, 5, "", 0, 0, "L");
$pdf->Cell(62, 5, "Lap/hal.dg perkerasan(konblok,aspal,dll)", 0, 0, "L");
$pdf->Cell(20, 5, "Baru", 0, 0, "L");
$pdf->Cell(40, 5, "Luas: 100.64m2", 0, 0, "R");
$pdf->Cell(40, 5, "Rp 1000x100.64x1 =Rp", 0, 0, "R");
$pdf->Cell(25, 5, "100.640", 0, 1, "R");

$pdf->Cell(0, 7, "Tarif Retribusi Prasarana Bangunan : Rp 223.650,- ", 0, 1, "L");

$pdf->Cell(0, 5, "NILAI TOTAL RETRIBUSI = Rp 9.920.675,-", 0, 1, "L");
$pdf->Cell(0, 5, "Terbilang : Sembilan Juta Sembilan Ratus Dua Puluh Ribu Enam Ratus Tujuh Puluh Lima Rupiah", 0, 1, "L");

$pdf->setXY(10, 231);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(80, 5, "Kepala Dinas Penanaman Modal dan PTSP Kota Denpasar", 0, 1, "C");
$pdf->Cell(0, 15, "", 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->SetFont('Arial', 'U', 9);
$pdf->Cell(80, 5, "Ida Bagus Benny Pidada Rurus, ST. ", 0, 1, "C");
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(80, 5, "Pembina Tingkat I", 0, 1, "C");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(80, 5, "NIP. 19720924 199803 1 008", 0, 1, "C");

$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetMargins(10, 10, 10);

$pdf->setXY(10, 10);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(150, 100, "", 1, 1, "C");

$pdf->setXY(10, 10);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(150, 10, "", 1, 1, "C");

$pdf->setXY(10, 10);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(150, 62, "", 1, 1, "C");

$pdf->setXY(10, 10);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(150, 5, "PEMERINTAH KOTA DENPASAR", 0, 1, "C");
$pdf->Cell(150, 5, "DINAS PENANAMAN MODAL &  PTSP", 0, 1, "C");
$pdf->Cell(150, 7, "BUKTI PENERIMAAN", 1, 1, "C");

$pdf->Cell(150, 5, "Nomor:....................", 0, 1, "R");

$pdf->Cell(38, 5, "Telah terima dari", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->Cell(110, 5, "Suanjaya", 0, 1, "L");
$pdf->Cell(38, 5, "Untuk Pembayaran", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->Cell(110, 5, "Izin Mendirikan Bangunan (IMB)", 0, 1, "L");
$pdf->Cell(38, 5, "Kode Rekening", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->Cell(110, 5, "1.38.13.00.00.4.1.2.03.01", 0, 1, "L");
$pdf->Cell(38, 5, "Nama Rekening", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->Cell(110, 5, "KAS DAERAH KOTA DENPASAR", 0, 1, "L");
$pdf->Cell(38, 5, "Banyaknya Uang", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->Cell(110, 5, "9.938.675,-", 0, 1, "L");
$pdf->Cell(38, 5, "Terbilang", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->MultiCell(110, 5, "Sembilan Juta Sembilan Ratus Dua Puluh Ribu Enam Ratus Tujuh Puluh Lima Rupiah", 0, "J", 0);
$pdf->Cell(38, 5, "Nomor Tagihan", 0, 0, "L");
$pdf->Cell(2, 5, ":", 0, 0, "L");
$pdf->Cell(110, 5, "2011005576", 0, 1, "L");

$pdf->Cell(150, 5, "Denpasar,...............2020", 0, 1, "R");
$pdf->Cell(75, 5, "Yang Menyetor", 0, 0, "C");
$pdf->Cell(75, 5, "Kasir Penerima,", 0, 1, "C");
$pdf->Cell(75, 20, "", 0, 0, "C");
$pdf->Cell(75, 20, "", 0, 1, "C");
$pdf->Cell(75, 5, "( ............................................ )", 0, 0, "C");
$pdf->Cell(75, 5, "( ............................................ )", 0, 1, "C");

$pdf->Output('I', 'surat.pdf');
