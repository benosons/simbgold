<?php
require_once(BASE_FILE_FPDF . '/fpdf.php');
$pdf = new FPDF('P', 'mm', 'Letter');
$wilayah = $nm_kabkot_bgn;
$nilai = substr($wilayah,0,3);
if ($nilai == "KAB") {
  $kabkota = "".substr($wilayah,5);
  $pejabat = "BUPATI";
} elseif ($nilai == "KOT") {
  if (substr($wilayah,10,7) == "JAKARTA") {
	$kabkota = $wilayah;
    $pejabat = "GUBERNUR";
  }
  else {
	$kabkota = substr($wilayah,5);
    $pejabat = "WALIKOTA";
  }
}
if($id_izin =='1'){
  $peruntukan = "Bangunan Baru";
}else if($id_izin =='2'){
 $peruntukan = "Bangunan Eksisting";
}else{
  $peruntukan = "Belum Ditentukan";
}
//membuat halaman baru
$pdf->SetMargins(10, 10, 10);

$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetMargins(10, 10, 10, 10);

$pdf->setXY(10, 10);
$pdf->SetFont('Arial', '', 9);

$pdf->image('assets/logo/garuda.png', 100, 10, 20, 20);
$pdf->setXY(10, 40);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 5, "PEMERINTAH REPUBLIK INDONESIA", 0, 1, "C");
$pdf->Cell(0, 5, "PERSETUJUAN BANGUNAN GEDUNG", 0, 1, "C");
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 5, "Nomor : ".$no_izin_pbg, 0, 1, "C");
$pdf->Cell(0, 5, "", 0, 1, "C");
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40, 5, "Membaca", 0, 0, "L");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, ": Permohonan Persetujuan Bangunan Gedung", 0, 1, "L");
$pdf->Cell(40, 5, "", 0, 0, "L");
$pdf->Cell(50, 5, "Nomor", 0, 0, "L");
$pdf->Cell(0, 5, ": ".$no_izin_pbg." tanggal ".date('d-m-Y'), 0, 1, "L");
$pdf->Cell(40, 5, "", 0, 0, "L");
$pdf->Cell(50, 5, "Nama pemohon/Pemilik", 0, 0, "L");
$pdf->Cell(0, 5, ": ".$nm_pemilik, 0, 1, "L");
$pdf->Cell(40, 5, "", 0, 0, "L");
$pdf->Cell(50, 5, "Bangunan gedung", 0, 0, "L");
$pdf->Cell(0, 5, ": ".$nm_bgn, 0, 1, "L");
$pdf->Cell(40, 5, "", 0, 0, "L");
$pdf->Cell(50, 5, "Alamat", 0, 0, "L");
$pdf->MultiCell(0, 5, ": ".$alamat.', Kel/Desa '.$nm_kel_bgn.', Kec. '.$nama_kecamatan.', '.$nama_kabkota.', Prov '.$nama_provinsi, 0, "L", 0);
$pdf->Cell(40, 5, "", 0, 0, "L");
$pdf->Cell(50, 5, "Untuk", 0, 0, "L");
$pdf->MultiCell(0, 5,": ".$peruntukan, 0, "L", 0);
$pdf->Cell(40, 5, "", 0, 0, "L");
$pdf->Cell(50, 5, "Fungsi bangunan gedung ", 0, 0, "L");
$pdf->Cell(0, 5, ": ", 0, 1, "L");
$pdf->Cell(40, 5, $fungsi_bg, 0, 0, "L");
$pdf->Cell(50, 5, "Klasifikasi bangunan Gedung", 0, 0, "L");
$pdf->Cell(0, 5, ": ", 0, 1, "L");
$pdf->Cell(40, 5, "", 0, 0, "L");
$pdf->Cell(50, 5, "Nama bangunan gedung", 0, 0, "L");
$pdf->Cell(0, 5, ": ".$nm_bgn, 0, 1, "L");
$pdf->Cell(40, 5, "", 0, 0, "L");
$pdf->Cell(50, 5, "Luas bangunan gedung ", 0, 0, "L");
$pdf->Cell(0, 5, ": ".$luas_bgn, 0, 1, "L");
$pdf->Cell(40, 5, "", 0, 0, "L");
$pdf->Cell(50, 5, "Di atas tanah", 0, 0, "L");
$pdf->Cell(0, 5, ": (hak atas tanah)", 0, 1, "L");
$pdf->Cell(40, 5, "", 0, 0, "L");
$pdf->Cell(50, 5, "Luas tanah", 0, 0, "L");
$pdf->Cell(0, 5, ": ".$luas_tanah, 0, 1, "L");
$pdf->Cell(40, 5, "", 0, 0, "L");
$pdf->Cell(50, 5, "Atas nama/Pemilik tanah", 0, 0, "L");
$pdf->Cell(0, 5, ": ".$atas_nama_dok, 0, 1, "L");
$pdf->Cell(40, 5, "", 0, 0, "L");
$pdf->Cell(50, 5, "Terletak di", 0, 0, "L");
$pdf->MultiCell(0, 5, $almt_bgn.', Kel/Desa '.$nm_kel_bgn.', Kec. '.$nm_kec_bgn.', '.$nm_kabkot_bgn.', Prov '.$nm_prov_bgn, 0, "L", 0);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40, 5, "Menimbang", 0, 0, "L");
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(0, 5, ": Bahwa setelah memeriksa (mencatat/meneliti), mengkaji, dan menilai /evaluasi serta menyetujui dokumen rencana teknis bangunan gedung sebagaimana dimaksud di atas dengan ini disahkan, maka terhadap permohonan persetujuan bangunan gedung yang dimaksud dapat diberikan persetujuan dengan ketentuan sebagaimana dalam lampiran keputusan ini.", 0, "J", 0);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40, 5, "Mengingat", 0, 0, "L");
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(0, 5, ":1. Undang-undang Nomor 28 Tahun 2002 tentang Bangunan Gedung (Lembaran Negara Republik Indonesia Tahun 2002 Nomor 134);
2. Undang-undang Nomor 11 Tahun 2020 tentang Cipta Kerja (Lembaran Negara Republik Indonesia Tahun....Nomor....);", 0, "J", 0);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40, 5, "Memperhatikan :", 0, 0, "L");
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(0, 5, "Pertimbangan dari:
1. .............
2. .............", 0, "L", 0);

$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetMargins(10, 10, 10);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 5, "Memutuskan", 0, 1, "C");
$pdf->Cell(0, 2, "", 0, 1, "L");
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40, 5, "Mengingat", 0, 0, "L");
$pdf->Cell(10, 5, ":", 0, 0, "L");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(5, 5, "1.", 0, 0, "L");
$pdf->Cell(0, 5, "Persetujuan Bangunan Gedung kepada:", 0, 1, "L");

$pdf->Cell(55, 5, "", 0, 0, "L");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 5, "Nama Pemohon", 0, 0, "L");
$pdf->Cell(0, 5, ": ".$nm_pemilik, 0, 1, "L");

$pdf->Cell(55, 5, "", 0, 0, "L");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 5, "Atas nama pemilik", 0, 0, "L");
$pdf->Cell(0, 5, ": ".$nm_pemilik, 0, 1, "L");

$pdf->Cell(55, 5, "", 0, 0, "L");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 5, "Bangunan gedung", 0, 0, "L");
$pdf->Cell(0, 5, ": ".$nm_bgn, 0, 1, "L");

$pdf->Cell(55, 5, "", 0, 0, "L");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 5, "Alamat", 0, 0, "L");
$pdf->MultiCell(0, 5, ": ".$almt_bgn.', Kel/Desa '.$nm_kel_bgn.', Kec. '.$nm_kec_bgn.', '.$nm_kabkot_bgn.', Prov '.$nm_prov_bgn, 0, "L", 0);

$pdf->Cell(55, 5, "", 0, 0, "L");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 5, "Untuk", 0, 0, "L");
$pdf->MultiCell(0, 5, ": ".$peruntukan. " sebagaimana dijelaskan dalam gambar situasi Lampiran b dan rencana teknis, meliputi gambar arsitektur, gambar konstruksi bangunan gedung, dan gambar utilitas (mekanikal dan elektrikal), pembekuan dan pencabutan PBG Lampiran c, dan penghitungan besarnya retribusi PBG dalam Lampiran d Keputusan ini:", 0, "J", 0);

$pdf->Cell(50, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "2.", 0, 0, "L");
$pdf->MultiCell(0, 5, "Besarnya retribusi yang harus dibayar oleh pemohon sebagaimana
Dimaksud dalam Lampiran d Keputusan ini sebesar:", 0, "L", 0);

$pdf->Cell(55, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "a.", 0, 0, "L");
$pdf->Cell(70, 5, "Retribusi pembinaan penyelenggaraan", 0, 0, "L");
$pdf->Cell(0, 5, "Rp. ".number_format($nilai_retribusi_keseluruhan,0,'','.'), 0, 1, "L");
$pdf->Cell(60, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "Bangunan gedung", 0, 1, "L");

/*$pdf->Cell(55, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "b.", 0, 0, "L");
$pdf->Cell(70, 5, "Retribusi administrasi PBG. *)", 0, 0, "L");
$pdf->Cell(0, 5, "Rp. ....................", 0, 1, "L");

$pdf->Cell(55, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "c.", 0, 0, "L");
$pdf->Cell(70, 5, "Retribusi penyediaan formular", 0, 0, "L");
$pdf->Cell(0, 5, "Rp. ....................+", 0, 1, "L");

$pdf->Cell(55, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "", 0, 0, "L");
$pdf->Cell(70, 5, "Jumlah ............................", 0, 0, "L");
$pdf->Cell(0, 5, "Rp. ", 0, 1, "L");*/

$pdf->Cell(55, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, '( '.terbilang($nilai_retribusi_keseluruhan).' rupiah )', 0, 1, "L");

$pdf->Cell(55, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "*) untuk perubahan PBG atas permintaan pemilik.", 0, 1, "L");

$pdf->Cell(50, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "3.", 0, 0, "L");
$pdf->MultiCell(0, 5, "3. Lampiran Keputusan ini merupakan satu kesatuan yang tidak terpisahkan dari 
Keputusan ini;", 0, "L", 0);

$pdf->Cell(50, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "4.", 0, 0, "L");
$pdf->MultiCell(0, 5, "Hal-hal yang belum diatur dalam Keputusan ini akan ditetapkan kemudian;", 0, "L", 0);

$pdf->Cell(50, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "5.", 0, 0, "L");
$pdf->MultiCell(0, 5, "Salinan Keputusan ini diberikan kepada yang berkepentingan; dan", 0, "L", 0);

$pdf->Cell(50, 5, "", 0, 0, "L");
$pdf->Cell(5, 5, "6.", 0, 0, "L");
$pdf->MultiCell(0, 5, "Keputusan ini mulai berlaku sejak tanggal diterbitkan.", 0, "L", 0);

$pdf->Cell(0, 10, "", 0, 1, "L");
$pdf->image(BASE_FILE_PATH.'Konsultasi/QR_Code/'.$no_izin_pbg.'.png', 60, 140, 30, 30);
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "DITETAPKAN DI : ..........", 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "PADA TANGGAL : ".date('d-m-Y'), 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0,5,'ATAS NAMA '.$pejabat.' '.$kabkota,0,1,"L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->MultiCell(0, 5, "KEPALA " .ucwords(strtoupper($p_nama_dinas)), 0, "L", 0);
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 10, "", 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, $nm_kadis, 0, 1, "L");
$pdf->Cell(100, 5, "", 0, 0, "L");
$pdf->Cell(0, 5, "NIP : ".$nip_kadis, 0, 1, "L");
$pdf->Output('I', 'surat.pdf');
