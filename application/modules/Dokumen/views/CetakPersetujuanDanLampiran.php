<?php
require_once(BASE_FILE_FPDF . '/fpdf.php');
$pdf = new FPDF('P', 'mm', 'A4');

//membuat halaman baru
$pdf->SetMargins(20, 20, 20);
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetMargins(20, 20, 20, 20);
$pdf->setXY(5, 10);
$pdf->SetFont('Times', '', 9);
$pdf->image('assets/logo/garuda.png', 100, 10, 20, 20);
//$pdf->image('file/LogoKabKota/BackGround_pbg.png', 75,75,59,100);
$pdf->setXY(20, 40);
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(0, 5, "PEMERINTAH REPUBLIK INDONESIA", 0, 1, "C");
$pdf->Cell(0, 5, "PERSETUJUAN BANGUNAN GEDUNG", 0, 1, "C");
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(0, 5, "", 0, 1, "C");
$pdf->Cell(0, 5, "NOMOR: SK-PBG-XXXXXX-DDMMYYYY-ZZZ", 0, 1, "C");
$pdf->Cell(0, 5, "", 0, 1, "C");
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(40, 5, "Membaca", 0, 0, "L");
$pdf->SetFont('Times', '', 10);
$pdf->Cell(0, 5, ": Permohonan Persetujuan Bangunan Gedung", 0, 1, "L");
$pdf->Cell(42, 5, "", 0, 0, "L");

$pdf->Cell(50, 5, "Nomor", 0, 0, "L");
$pdf->Cell(0, 5, ": ", 0, 1, "L");
$pdf->Cell(42, 5, "", 0, 0, "L");

$pdf->Cell(50, 5, "Pemilik Bangunan Gedung", 0, 0, "L");
$pdf->Cell(0, 5, ": ", 0, 1, "L");
$pdf->Cell(42, 5, "", 0, 0, "L");

$pdf->Cell(50, 5, "Alamat", 0, 0, "L");
$pdf->MultiCell(0, 5, ": ", 0, "L", 0);
$pdf->Cell(42, 5, "", 0, 0, "L");

$pdf->Cell(50, 5, "Untuk", 0, 0, "L");
$pdf->MultiCell(0, 5, ": ", 0, "L", 0);
$pdf->Cell(42, 5, "", 0, 0, "L");

$pdf->Cell(50, 5, "Nama Bangunan Gedung", 0, 0, "L");
$pdf->MultiCell(0, 5, ": ", 0, "L", 0);
$pdf->Cell(42, 5, "", 0, 0, "L");

$pdf->Cell(50, 5, "Fungsi bangunan gedung", 0, 0, "L");
$pdf->Cell(0, 5, ": ", 0, 1, "L");
$pdf->Cell(42, 5, "", 0, 0, "L");

$pdf->Cell(50, 5, "Sub Fungsi", 0, 0, "L");
$pdf->Cell(0, 5, ": ", 0, 1, "L");
$pdf->Cell(42, 5, "", 0, 0, "L");

$pdf->Cell(50, 5, "Klasifikasi Kompleksitas", 0, 0, "L");
$pdf->Cell(0, 5, ": ", 0, 1, "L");
$pdf->Cell(42, 5, "", 0, 0, "L");

$pdf->Cell(50, 5, "Luas Bangunan Gedung", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");

$pdf->Cell(30, 5, "Total Luas", 0, 0, "L");
$pdf->Cell(0, 5, ": xxx m", 0, 1, "L");

$pdf->Cell(95, 5, "", 0, 0, "L");
$pdf->Cell(30, 5, "Luas Lantai", 0, 0, "L");
$pdf->Cell(0, 5, ": xxx m", 0, 1, "L");

$pdf->Cell(95, 5, "", 0, 0, "L");
$pdf->Cell(30, 5, "Luas Basemen", 0, 0, "L");
$pdf->Cell(0, 5, ":  m", 0, 1, "L");
$pdf->Cell(42, 5, "", 0, 0, "L");

$pdf->Cell(50, 5, "Tinggi Bangunan Gedung", 0, 0, "L");
$pdf->Cell(0, 5, ":  m ", 0, 1, "L");
$pdf->Cell(42, 5, "", 0, 0, "L");

$pdf->Cell(50, 5, "Jumlah Lapis Basemen", 0, 0, "L");
$pdf->Cell(0, 5, ":  Lapis ", 0, 1, "L");
$pdf->Cell(42, 5, "", 0, 0, "L");

$pdf->Cell(50, 5, "Prasarana Bangunan Gedung", 0, 0, "L");
$pdf->Cell(0, 5, ": (terlampir)", 0, 1, "L");
$pdf->Cell(42, 5, "", 0, 0, "L");

$pdf->Cell(50, 5, "Di Atas Tanah", 0, 0, "L");
$pdf->Cell(0, 5, ": (terlampir)", 0, 1, "L");
$pdf->Cell(42, 5, "", 0, 0, "L");

$pdf->Cell(50, 5, "Luas Tanah", 0, 0, "L");
$pdf->Cell(0, 5, ": (terlampir)", 0, 1, "L");
$pdf->Cell(42, 5, "", 0, 0, "L");

$pdf->Cell(50, 5, "Pemilik Tanah", 0, 0, "L");
$pdf->Cell(0, 5, ": (terlampir)", 0, 1, "L");
$pdf->Cell(42, 5, "", 0, 0, "L");

$pdf->Cell(50, 5, "Terletak di", 0, 0, "L");
$pdf->MultiCell(0, 5,": (terlampir)", 0, 'L', 0);
$pdf->Cell(0,5,'',0,1);


$pdf->SetFont('Times','B',10);
$pdf->Cell(40,5,'Menimbang',0,0,'L');
$pdf->Cell(2,5,':',0,0);
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,'Bahwa setelah memeriksa, mengkaji, dan menilai serta menyetujui Dokumen Teknis Pembangunan Bangunan Gedung sebagaimana dimaksud di atas dengan ini disahkan, maka terhadap permohonan Persetujuan Bangunan Gedung yang dimaksud dapat diberikan persetujuan dengan ketentuan sebagaimana terlampir dalam Keputusan ini.',0,'J',0);


$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(0,5,'',0,1);
$pdf->SetFont('Times','B',10);
$pdf->Cell(40,5,'Mengingat',0,0,'L');
$pdf->Cell(3,5,':',0,0);
$pdf->SetFont('Times','',10);
$pdf->Cell(5, 5, "1.", 0, 0, "L");
$pdf->MultiCell(0,5,'Undang-Undang Nomor 28 Tahun 2002 tentang Bangunan Gedung (Lembaran Negara Republik Indonesia Tahun 2002 Nomor 134, Tambahan Lembaran Negara Republik Indonesia Nomor 4247);',0,'J',0);
$pdf->Cell(43, 5, "", 0, 0, "L");$pdf->Cell(5, 5, "2.", 0, 0, "L");
$pdf->MultiCell(0,5,'Peraturan Pemerintah Pengganti Undang-Undang Nomor 2 Tahun 2022 tentang Cipta Kerja (Lembaran Negara Republik Indonesia Tahun 2022 Nomor 238, Tambahan Lembaran Negara Republik Indonesia Nomor 6841);',0,'J',0);
$pdf->Cell(43, 5, "", 0, 0, "L");$pdf->Cell(5, 5, "3.", 0, 0, "L");
$pdf->MultiCell(0,5,'Peraturan Pemerintah Nomor 16 Tahun 2021 tentang Peraturan Pelaksanaan Undang-Undang Nomor 28 Tahun 2002 tentang Bangunan Gedung (Lembaran Negara Republik Indonesia Tahun 2021 Nomor 26, Tambahan Lembaran Negara Republik Indonesia Nomor 6628);',0,'J',0);
$pdf->Cell(43, 5, "", 0, 0, "L");$pdf->Cell(5, 5, "4.", 0, 0, "L");
$pdf->MultiCell(0,5,'Peraturan [Bupati/Walikota/Gubernur DKI Jakarta] Nomor .... Tahun .... tentang Retribusi Persetujuan Bangunan Gedung/Perizinan Tertentu ....',0,'J',0);
$pdf->Cell(43, 5, "", 0, 0, "L");$pdf->Cell(5, 5, "5.", 0, 0, "L");
$pdf->MultiCell(0,5,'...............................................................................................................................
...............................................................................................................................',0,'J',0);

$pdf->Cell(0,5,'',0,1);
$pdf->SetFont('Times','B',10);
$pdf->Cell(40,5,'Memperhatikan',0,0,'L');
$pdf->Cell(2,5,':',0,0);
$pdf->Cell(2,5,'',0,0);
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,'Surat [Plt./Plh./Pjs.] Kepala Dinas [Nama Dinas Teknis] Nomor ..... Tanggal ..... Perihal Pernyataan Pemenuhan Standar Teknis Bangunan Gedung',0,'J',0);

$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(0, 10, "Memutuskan", 0, 1, "C");
$pdf->Cell(0, 2, "", 0, 1, "L");


$pdf->Cell(40, 5,"Menetapkan", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->SetFont('Times', '', 10);
$pdf->Cell(5, 5, "1.", 0, 0, "L");
$pdf->Cell(0, 5, "Persetujuan Bangunan Gedung kepada:", 0, 1, "L");

$pdf->Cell(48, 5, "", 0, 0, "L");
$pdf->SetFont('Times', '', 10);
$pdf->Cell(20, 5, "Pemilik", 0, 0, "L");
$pdf->Cell(0, 5, ": ", 0, 1, "L");

$pdf->Cell(48, 5, "", 0, 0, "L");
$pdf->SetFont('Times', '', 10);
$pdf->Cell(20, 5, "Alamat", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->MultiCell(0, 5, "Jalan Pattimura Nun Jauh Disuni Nomor 43, Selong, Kebayoran Baru, Jakarta Selatan, DKI Jakarta", 0, "L", 0);

$pdf->Cell(48, 5, "", 0, 0, "L");
$pdf->SetFont('Times', '', 10);
$pdf->Cell(20, 5, "Untuk", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->MultiCell(0, 5, ": Menerbitkan SLF Prasarana Bangunan Gedung Eksisting, apabila dipilih SLF namun belum memiliki PBG/IMB sebagaimana dijelaskan dalam Dokumen Teknis, sebagaimana dijelaskan dalam Dokumen Te", 0, "J", 0);

$pdf->Cell(40, 5, "", 0, 0, "L");
$pdf->Cell(3, 5, "", 0, 0, "L");
$pdf->SetFont('Times', '', 10);
$pdf->Cell(5, 5, "2.", 0, 0, "L");
$pdf->MultiCell(0, 5, "Besaran Retribusi Persetujuan Bangunan Gedung yang dibayarkan oleh pemilik bangunan gedung sebagaimana tercantum dalam Lampiran C adalah sebesar Rp. 300.000.000.000,00(terbilang ....... );", 0, "L", 0);

$pdf->Cell(40, 5, "", 0, 0, "L");
$pdf->Cell(3, 5, "", 0, 0, "L");
$pdf->SetFont('Times', '', 10);
$pdf->Cell(5, 5, "3.", 0, 0, "L");
$pdf->MultiCell(0, 5, "Informasi Umum Persetujuan Bangunan Gedung tercantum dalam Lampiran D;", 0, "L", 0);

$pdf->Cell(40, 5, "", 0, 0, "L");
$pdf->Cell(3, 5, "", 0, 0, "L");
$pdf->SetFont('Times', '', 10);
$pdf->Cell(5, 5, "4.", 0, 0, "L");
$pdf->MultiCell(0, 5, "Lampiran Keputusan ini merupakan satu kesatuan yang tidak terpisahkan dari Keputusan ini;", 0, "L", 0);

$pdf->Cell(40, 5, "", 0, 0, "L");
$pdf->Cell(3, 5, "", 0, 0, "L");
$pdf->SetFont('Times', '', 10);
$pdf->Cell(5, 5, "5.", 0, 0, "L");
$pdf->MultiCell(0, 5, "Hal-hal yang belum diatur dalam Keputusan ini akan ditetapkan kemudian;", 0, "L", 0);

$pdf->Cell(40, 5, "", 0, 0, "L");
$pdf->Cell(3, 5, "", 0, 0, "L");
$pdf->SetFont('Times', '', 10);
$pdf->Cell(5, 5, "6.", 0, 0, "L");
$pdf->MultiCell(0, 5, "Salinan Keputusan ini diberikan kepada yang berkepentingan; dan", 0, "L", 0);

$pdf->Cell(40, 5, "", 0, 0, "L");
$pdf->Cell(3, 5, "", 0, 0, "L");
$pdf->SetFont('Times', '', 10);
$pdf->Cell(5, 5, "7.", 0, 0, "L");
$pdf->MultiCell(0, 5, "Keputusan ini mulai berlaku sejak tanggal diterbitkan.", 0, "L", 0);

$pdf->SetFont('Times','',10);
$pdf->Cell(0, 5, "", 0, 1, "L");
$pdf->Cell(80, 5, "", 0, 0, "L");

$pdf->image('assets/gambar/barcode.PNG', 75, 160, 40, 40);

$pdf->Cell(25, 5, "Ditetapkan Di", 0, 0, "L");
$pdf->Cell(0, 5, " : ", 0, 1, "L");
$pdf->Cell(80, 5, "", 0, 0, "L");
$pdf->Cell(25, 5, "Pada Tanggal", 0, 0, "L");
$pdf->Cell(0, 5, " : ", 0, 1, "L");

$pdf->Cell(0, 5, "", 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0,5,"Atas Nama",0,1,"L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0,5,"Otorita Ibu Kota Nusantara",0,1,"L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0,5,"Kepala Dinas Penanaman Modal Dan",0,1,"L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0,5,"Pelayanan Terpadu Satu Pintu Kabupaten",0,1,"L");

$pdf->Cell(0, 20, "", 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "Nama Kepala Dinas Penanaman Modal", 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "NIP : 1234567890123456", 0, 1, "L");

$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetMargins(20, 20, 20, 20);

$pdf->setXY(20, 40);
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(0, 5, "LAMPIRAN A", 0, 1, "L");
$pdf->Cell(0, 5, "KEPUTUSAN OTORITA IBU KOTA NUSANTARA", 0, 1, "L");
$pdf->Cell(0, 5, "NOMOR SK-PBG-XXXXXX-DDMMYYYY-ZZZ TANGGAL DD MM YYYY", 0, 1, "L");
$pdf->Cell(0, 5, "TENTANG PERSETUJUAN BANGUNAN GEDUNG", 0, 1, "L");
$pdf->Cell(0, 10, "INFORMASI TANAH, FUNGSI, DAN KLASIFIKASI BANGUNAN GEDUNG", 0, 1, "C");

$pdf->Cell(5, 5, "I.", 0, 0, "L");
$pdf->Cell(0, 5, "Informasi Tanah", 0, 1, "L");

$pdf->SetFont('Times', '', 10);
$pdf->Cell(5, 5, "", 0, 0, "L");
$pdf->Cell(30, 5, "Data Tanah", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->Cell(5, 5, "1.", 0, 0, "L");
$pdf->Cell(30, 5, "Di Atas Tanah", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, "Hak Milik", 0, 1, "L");

$pdf->Cell(43, 5, "", 0, 0, "L");
$pdf->Cell(30, 5, "Luas Tanah", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, "2x1 m", 0, 1, "L");

$pdf->Cell(43, 5, "", 0, 0, "L");
$pdf->Cell(30, 5, "Pemilik Tanah ", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, "Giandhika", 0, 1, "L");

$pdf->Cell(43, 5, "", 0, 0, "L");
$pdf->Cell(30, 5, "Terletak Di", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->MultiCell(0, 5, "Jalan Pattimura No.12, Selong, Jakarta Selatan, DKI Jakarta", 0, "L", 0);

$pdf->Cell(38, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "2.", 0, 0, "L");
$pdf->Cell(30, 5, "Di Atas Tanah", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, "Hak Milik", 0, 1, "L");

$pdf->Cell(43, 5, "", 0, 0, "L");
$pdf->Cell(30, 5, "Luas Tanah", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, "2x1 m", 0, 1, "L");

$pdf->Cell(43, 5, "", 0, 0, "L");
$pdf->Cell(30, 5, "Pemilik Tanah ", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, "Giandhika", 0, 1, "L");

$pdf->Cell(43, 5, "", 0, 0, "L");
$pdf->Cell(30, 5, "Terletak Di", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->MultiCell(0, 5, "Jalan Pattimura No.12, Selong, Jakarta Selatan, DKI Jakarta", 0, "L", 0);

$pdf->Cell(38, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "3.", 0, 0, "L");
$pdf->Cell(30, 5, "Di Atas Tanah", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, "Hak Milik", 0, 1, "L");

$pdf->Cell(43, 5, "", 0, 0, "L");
$pdf->Cell(30, 5, "Luas Tanah", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, "2x1 m", 0, 1, "L");

$pdf->Cell(43, 5, "", 0, 0, "L");
$pdf->Cell(30, 5, "Pemilik Tanah ", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, "Giandhika", 0, 1, "L");

$pdf->Cell(43, 5, "", 0, 0, "L");
$pdf->Cell(30, 5, "Terletak Di", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->MultiCell(0, 5, "Jalan Pattimura No.12, Selong, Jakarta Selatan, DKI Jakarta", 0, "L", 0);

$pdf->Cell(38, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "4.", 0, 0, "L");
$pdf->Cell(30, 5, "Di Atas Tanah", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, "Hak Milik", 0, 1, "L");

$pdf->Cell(43, 5, "", 0, 0, "L");
$pdf->Cell(30, 5, "Luas Tanah", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, "2x1 m", 0, 1, "L");

$pdf->Cell(43, 5, "", 0, 0, "L");
$pdf->Cell(30, 5, "Pemilik Tanah ", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, "Giandhika", 0, 1, "L");

$pdf->Cell(43, 5, "", 0, 0, "L");
$pdf->Cell(30, 5, "Terletak Di", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->MultiCell(0, 5, "Jalan Pattimura No.12, Selong, Jakarta Selatan, DKI Jakarta", 0, "L", 0);

$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(5, 10, "II.", 0, 0, "L");
$pdf->Cell(0, 10, "Fungsi dan Klasifikasi Bangunan Gedung", 0, 1, "L");

$pdf->SetFont('Times', '', 10);
$pdf->Cell(5, 5, "", 0, 0, "L");
$pdf->Cell(60, 5, "Pemilik Bangunan Gedung", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->Cell(3, 5, "1.", 0, 0, "L");
$pdf->Cell(0, 5, "Giandhika", 0, 1, "L");

$pdf->Cell(5, 5, "", 0, 0, "L");
$pdf->Cell(60, 5, "Fungsi Bangunan Gedung", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->Cell(3, 5, "xxx", 0, 1, "L");

$pdf->Cell(5, 5, "", 0, 0, "L");
$pdf->Cell(60, 5, "Sub Fungsi Bangunan Gedung", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->Cell(3, 5, "xxx", 0, 1, "L");

$pdf->Cell(5, 5, "", 0, 0, "L");
$pdf->Cell(60, 5, "Klasifikasi Bangunan Gedung", 0, 1, "L");

$pdf->Cell(5, 5, "", 0, 0, "L");
$pdf->Cell(60, 5, "- Tingkat Kompleksitas", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->Cell(3, 5, "xxx", 0, 1, "L");

$pdf->Cell(5, 5, "", 0, 0, "L");
$pdf->Cell(60, 5, "- Tingkat Permanensi", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->Cell(3, 5, "xxx", 0, 1, "L");

$pdf->Cell(5, 5, "", 0, 0, "L");
$pdf->Cell(60, 5, "- Tingkat Risiko Bahaya Kebakaran", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->Cell(3, 5, "Tinggi", 0, 1, "L");

$pdf->Cell(5, 5, "", 0, 0, "L");
$pdf->Cell(60, 5, "- Lokasi", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->Cell(3, 5, "Padat", 0, 1, "L");

$pdf->Cell(5, 5, "", 0, 0, "L");
$pdf->Cell(60, 5, "- Ketinggian Bangunan Gedung", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->Cell(3, 5, "800 Lantai (Super Tinggi)", 0, 1, "L");

$pdf->Cell(5, 5, "", 0, 0, "L");
$pdf->Cell(60, 5, "- Kepemilikan Bangunan Gedung", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->Cell(3, 5, "Badan Usaha", 0, 1, "L");

$pdf->Cell(5, 5, "", 0, 0, "L");
$pdf->Cell(60, 5, "- Klas bangunan", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->Cell(3, 5, "8", 0, 1, "L");

$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetMargins(20, 20, 20, 20);

$pdf->setXY(20, 40);
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(0, 5, "LAMPIRAN B", 0, 1, "L");
$pdf->Cell(0, 5, "KEPUTUSAN OTORITA IBU KOTA NUSANTARA", 0, 1, "L");
$pdf->Cell(0, 5, "NOMOR SK-PBG-XXXXXX-DDMMYYYY-ZZZ TANGGAL DD MM YYYY", 0, 1, "L");
$pdf->Cell(0, 5, "TENTANG PERSETUJUAN BANGUNAN GEDUNG", 0, 1, "L");
$pdf->Cell(0, 10, "DOKUMEN TEKNIS PERSETUJUAN BANGUNAN GEDUNG", 0, 1, "C");
$pdf->Cell(5, 5, "I.", 0, 0, "L");
$pdf->Cell(0, 5, "RETRIBUSI PERSETUJUAN BANGUNAN GEDUNG", 0, 1, "L");
$pdf->Cell(0, 50, "", 0, 1, "L");

$pdf->SetFont('Times', '', 10);
$pdf->Cell(10, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "Keterangan", 0, 1, "L");

$pdf->image('assets/gambar/barcode.PNG', 75, 80, 40, 40);

$pdf->Cell(10, 5, "", 0, 0, "L");
$pdf->Cell(3, 5, "1.", 0, 0, "L");
$pdf->Cell(0, 5, "Dokumen Teknis ini dapat diakses dengan memindai QR-Code di atas.", 0, 1, "L");

$pdf->Cell(10, 5, "", 0, 0, "L");
$pdf->Cell(3, 5, "2.", 0, 0, "L");
$pdf->MultiCell(0, 5, "Dokumen Teknis ini merupakan dokumen yang telah diunggah dan ter verifikasi oleh Dinas [Nama Dinas Teknis] melalui proses konsultasi.", 0, "L", 0);

$pdf->Cell(10, 5, "", 0, 0, "L");
$pdf->Cell(3, 5, "3.", 0, 0, "L");
$pdf->Cell(0, 5, "Keamanan data Dokumen Teknis sepenuhnya menjadi tanggung jawab pemilik bangunan gedung.", 0, 1, "L");

$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetMargins(20, 20, 20, 20);

$pdf->setXY(20, 40);
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(0, 5, "LAMPIRAN C", 0, 1, "L");
$pdf->Cell(0, 5, "KEPUTUSAN OTORITA IBU KOTA NUSANTARA", 0, 1, "L");
$pdf->Cell(0, 5, "NOMOR SK-PBG-XXXXXX-DDMMYYYY-ZZZ TANGGAL DD MM YYYY", 0, 1, "L");
$pdf->Cell(0, 5, "TENTANG PERSETUJUAN BANGUNAN GEDUNG", 0, 1, "L");
$pdf->Cell(0, 10, "RETRIBUSI PERSETUJUAN BANGUNAN GEDUNG", 0, 1, "C");
$pdf->Cell(5, 5, "I.", 0, 0, "L");
$pdf->Cell(0, 5, "Dokumen Teknis", 0, 1, "L");
$pdf->Cell(0, 50, "", 0, 1, "L");

$pdf->SetFont('Times', '', 10);
$pdf->Cell(10, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "Keterangan", 0, 1, "L");

$pdf->image('assets/gambar/barcode.PNG', 75, 80, 40, 40);

$pdf->Cell(10, 5, "", 0, 0, "L");
$pdf->Cell(3, 5, "1.", 0, 0, "L");
$pdf->MultiCell(0, 5, "Retribusi Persetujuan Bangunan Gedung yang telah dibayarkan oleh pemilik bangunan gedung dapat diakses dengan memindai QR-Code di atas.", 0, "L", 0);

$pdf->Cell(10, 5, "", 0, 0, "L");
$pdf->Cell(3, 5, "2.", 0, 0, "L");
$pdf->MultiCell(0, 5, "Retribusi Persetujuan Bangunan Gedung ini merupakan surat ketetapan dan surat setor retribusi daerah yang telah diunggah dan ter verifikasi oleh Dinas [Nama Dinas Perizinan] setelah proses konsultasi oleh pemilik bangunan gedung.", 0, "L", 0);

$pdf->Cell(10, 5, "", 0, 0, "L");
$pdf->Cell(3, 5, "3.", 0, 0, "L");
$pdf->MultiCell(0, 5, "Keamanan data Retribusi Persetujuan Bangunan Gedung sepenuhnya menjadi tanggung jawab pemilik bangunan gedung.", 0, "L", 0);


$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetMargins(20, 20, 20, 20);

$pdf->setXY(20, 40);
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(0, 5, "LAMPIRAN C", 0, 1, "L");
$pdf->Cell(0, 5, "KEPUTUSAN OTORITA IBU KOTA NUSANTARA", 0, 1, "L");
$pdf->Cell(0, 5, "NOMOR SK-PBG-XXXXXX-DDMMYYYY-ZZZ TANGGAL DD MM YYYY", 0, 1, "L");
$pdf->Cell(0, 5, "TENTANG PERSETUJUAN BANGUNAN GEDUNG", 0, 1, "L");
$pdf->Cell(0, 10, "PEMBEKUAN DAN PENCABUTAN PERSETUJUAN BANGUNAN GEDUNG", 0, 1, "C");

$pdf->SetFont('Times', '', 10);
$pdf->Cell(5, 5, "1.", 0, 0, "L");
$pdf->Cell(0, 5, "Status PBG", 0, 1, "L");

$pdf->Cell(10, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "a.", 0, 0, "L");
$pdf->Cell(0, 5, "Penerbitan", 0, 1, "L");

$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "1)", 0, 0, "L");
$pdf->Cell(40, 5, "Nomor SK Penerbitan", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, "SK-PBG-123456-DDMMYYYY-001", 0, 1, "L");

$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "2)", 0, 0, "L");
$pdf->Cell(40, 5, "Tanggal SK Penerbitan", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, "1 Januari 2023", 0, 1, "L");

$pdf->Cell(10, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "b.", 0, 0, "L");
$pdf->Cell(0, 5, "Pembekuan", 0, 1, "L");

$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "1)", 0, 0, "L");
$pdf->Cell(40, 5, "Nomor SK Pembekuan", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, "SK-PBG-123456-DDMMYYYY-001", 0, 1, "L");

$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "2)", 0, 0, "L");
$pdf->Cell(40, 5, "Tanggal SK Pembekuan", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, "2 Januari 2023", 0, 1, "L");

$pdf->Cell(10, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "c.", 0, 0, "L");
$pdf->Cell(0, 5, "Pencabutan", 0, 1, "L");

$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "1)", 0, 0, "L");
$pdf->Cell(40, 5, "Nomor SK Pencabutan", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, "SK-PBG-123456-DDMMYYYY-001", 0, 1, "L");

$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "2)", 0, 0, "L");
$pdf->Cell(40, 5, "Tanggal SK Pencabutan", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "L");
$pdf->Cell(0, 5, "3 Januari 2023", 0, 1, "L");

$pdf->Cell(5, 5, "2.", 0, 0, "L");
$pdf->Cell(0, 5, "Ketentuan Umum", 0, 1, "L");

$pdf->Cell(10, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "a.", 0, 0, "L");
$pdf->Cell(0, 5, "PBG dibekukan apabila pemilik bangunan gedung", 0, 1, "L");

$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "1)", 0, 0, "L");
$pdf->MultiCell(0, 5, "tidak melakukan klarifikasi dimulainya pekerjaan konstruksi kepada pemerintah daerah dalam jangka waktu 3 (tiga) bulan sejak diterbitkannya PBG;", 0, "L", 0);

$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "2)", 0, 0, "L");
$pdf->MultiCell(0, 5, "tidak memberikan justifikasi teknis dalam hal terdapat ketidaksesuaian desain terhadap kondisi lapangan sehingga kegiatan pembangunan harus dihentikan oleh pemerintah daerah;", 0, "L", 0);
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "3)", 0, 0, "L");
$pdf->MultiCell(0, 5, "tidak menindaklanjuti surat peringatan yang disampaikan oleh pemerintah daerah; dan/atau", 0, "L", 0);
$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "1)", 0, 0, "L");
$pdf->MultiCell(0, 5, "melakukan pelanggaran lain terhadap ketentuan penyelenggaraan bangunan gedung.", 0, "L", 0);

$pdf->Cell(10, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "b.", 0, 0, "L");
$pdf->Cell(0, 5, "PBG dibatalkan pembekuannya apabila pemilik bangunan gedung:", 0, 1, "L");

$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "1)", 0, 0, "L");
$pdf->MultiCell(0, 5, "melakukan klarifikasi dimulainya pekerjaan konstruksi melalui SIMBG dalam jangka waktu tidak lebih dari 6 (enam) bulan sejak diterbitkannya PBG; dan/atau", 0, "L", 0);

$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "2)", 0, 0, "L");
$pdf->MultiCell(0, 5, "memberikan justifikasi teknis penyesuaian desain terhadap kondisi lapangan sebelum PBG dicabut.", 0, "L", 0);

$pdf->Cell(10, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "c.", 0, 0, "L");
$pdf->Cell(0, 5, "PBG dicabut apabila:", 0, 1, "L");

$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "1)", 0, 0, "L");
$pdf->MultiCell(0, 5, "pemilik bangunan gedung tidak melakukan klarifikasi mulai konstruksi dalam jangka waktu 6 (enam) bulan sejak diterbitkannya PBG;", 0, "L", 0);

$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "2)", 0, 0, "L");
$pdf->MultiCell(0, 5, "pemilik bangunan gedung tidak memberikan justifikasi teknis penyesuaian desain terhadap kondisi lapangan dalam jangka waktu 6 (enam) bulan sejak dinyatakan ketidaksesuaiannya oleh penilik pada masa inspeksi;", 0, "L", 0);

$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "3)", 0, 0, "L");
$pdf->MultiCell(0, 5, "justifikasi teknis penyesuaian desain terhadap kondisi lapangan melanggar ketentuan tata bangunan dan/atau keandalan bangunan gedung; dan/atau", 0, "L", 0);

$pdf->Cell(15, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "4)", 0, 0, "L");
$pdf->MultiCell(0, 5, "pemilik bangunan gedung melakukan pelanggaran lain terhadap ketentuan penyelenggaraan bangunan gedung.", 0, "L", 0);


$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetMargins(20, 20, 20, 20);

$pdf->setXY(20, 40);
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(0, 5, "LAMPIRAN D", 0, 1, "L");
$pdf->Cell(0, 5, "KEPUTUSAN OTORITA IBU KOTA NUSANTARA", 0, 1, "L");
$pdf->Cell(0, 5, "NOMOR SK-PBG-XXXXXX-DDMMYYYY-ZZZ TANGGAL DD MM YYYY", 0, 1, "L");
$pdf->Cell(0, 5, "TENTANG PERSETUJUAN BANGUNAN GEDUNG", 0, 1, "L");
$pdf->Cell(0, 10, "INFORMASI UMUM PERSETUJUAN BANGUNAN GEDUNG", 0, 1, "C");

$pdf->SetFont('Times', '', 10);
$pdf->Cell(0, 5, "Dalam Informasi Umum ini disampaikan hal-hal sebagai berikut:", 0, 1, "L");

$pdf->Cell(5, 5, "1.", 0, 0, "L");
$pdf->MultiCell(0, 5, "Pemilik bangunan gedung agar menyampaikan informasi jadwal dan tanggal mulai pelaksanaan konstruksi kepada Dinas [Nama Dinas Teknis] melalui Sistem Informasi Manajemen Bangunan Gedung (SIMBG). Informasi tersebut disampaikan sebelum pelaksanaan konstruksi dimulai. Jadwal dan tanggal mulai konstruksi Bangunan Gedung disampaikan secara bertahap sebagai berikut:", 0, "L", 0);

$pdf->Cell(5, 5, "", 0, 0, "L");
$pdf->MultiCell(0, 5, "a. tahap konstruksi struktur bawah;
b. tahap konstruksi basemen (bila ada);
c. tahap konstruksi struktur atas, arsitektur, mekanikal, elektrikal, dan perpipaan; dan
d. tahap pengetesan dan pengujian.
", 0, "L", 0);

$pdf->Cell(5, 5, "2.", 0, 0, "L");
$pdf->MultiCell(0, 5, "Apabila pemilik bangunan gedung tidak menyampaikan jadwal dimulainya pekerjaan konstruksi Dinas [Nama Dinas Teknis] akan meminta klarifikasi kepada pemilik bangunan gedung. Klarifikasi dapat dilakukan paling banyak 2 (dua) kali dalam kurun waktu paling lama 6 (enam) bulan sejak diterbitkannya PBG. Dalam hal pemilik bangunan gedung tidak menyampaikan informasi jadwal dimulainya pekerjaan konstruksi sebagaimana penjelasan di atas, maka PBG dicabut dan dinyatakan tidak berlaku.", 0, "L", 0);

$pdf->Cell(5, 5, "3.", 0, 0, "L");
$pdf->MultiCell(0, 5, "Dinas [Nama Dinas Teknis] melakukan inspeksi terhadap pelaksanaan konstruksi bangunan gedung setelah mendapatkan informasi dari pemilik bangunan gedung pada tiap tahapan sebagaimana tercantum pada angka 1 (satu). Proses inspeksi dilaksanakan sebagai prasyarat penerbitan Sertifikat Laik Fungsi (SLF) dan Surat Bukti Kepemilikan Bangunan Gedung (SBKBG) tanpa dikenakan biaya apa pun.", 0, "L", 0);

$pdf->image('assets/gambar/barcode.PNG', 75, 180, 40, 40);

$pdf->SetFont('Times','',10);
$pdf->Cell(0, 5, "", 0, 1, "L");
$pdf->Cell(80, 5, "", 0, 0, "L");
$pdf->Cell(25, 5, "Ditetapkan Di", 0, 0, "L");
$pdf->Cell(0, 5, " : ", 0, 1, "L");
$pdf->Cell(80, 5, "", 0, 0, "L");
$pdf->Cell(25, 5, "Pada Tanggal", 0, 0, "L");
$pdf->Cell(0, 5, " : ", 0, 1, "L");

$pdf->Cell(0, 5, "", 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0,5,"Atas Nama",0,1,"L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0,5,"Otorita Ibu Kota Nusantara",0,1,"L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0,5,"Kepala Dinas Penanaman Modal Dan",0,1,"L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0,5,"Pelayanan Terpadu Satu Pintu Kabupaten",0,1,"L");

$pdf->Cell(0, 20, "", 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "Nama Kepala Dinas Penanaman Modal", 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "NIP : 1234567890123456", 0, 1, "L");

$pdf->Output('I', "".'.pdf');