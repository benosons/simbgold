<?php
if(trim($result_list['dir_file_logo']) != ''){
  $logo = $result_list['dir_file_logo'];
}else{
  $logo = 'sample1.jpg';
}

$retri = $result_retri['retribusi']+$result_retri['retribusi_manual'];

$list_jenis_bg = array(
          '0' => '[ HAK ATAS TANAH KOSONG ]',
          '1' => 'Hak Milik',
          '2' => 'Hak Pakai',
          '3' => 'Hak Pengelolaan',
          '4' => 'Hak Guna Bangunan',
          '5' => 'Hak Guna Usaha',
		  '6' => 'Hak Wakaf',
		  '7' => '-',
        );

//Fungsi Tgl persetujuan
$montharray = Array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
//$result_list['date_sk_tk'];
if (trim($resultHasil['date_sk_tk']) != ''){
$tgl_tek = tgl_eng_to_ind($resultHasil['date_sk_tk']);
$tgl_tek2 = explode('-',$tgl_tek);
$tgl_teknis = $tgl_tek2[0].' '.$montharray [$tgl_tek2[1]-1].' '.$tgl_tek2[2];
}else{
$tgl_tek = tgl_eng_to_ind($result_list['tgl_sidang']);
$tgl_tek2 = explode('-',$tgl_tek);
$tgl_teknis = $tgl_tek2[0].' '.$montharray [$tgl_tek2[1]-1].' '.$tgl_tek2[2];
}	
	
$tgl_setuju = tgl_eng_to_ind($result_list['tgl_imb']);
$tgl_setuju2 = explode('-',$tgl_setuju);
$tgl_persetujuan = $tgl_setuju2[0].' '.$montharray [$tgl_setuju2[1]-1].' '.$tgl_setuju2[2];
//fungsi kabkot dan jabatan
$wilayah = $result_list['nama_kabkota_bg'];
$nilai = substr($wilayah,0,3);
if ($nilai == "KAB") {
  $kabkota2 = "KABUPATEN ".substr($wilayah,5);
  //$kabkota = "KABUPATEN ".substr($wilayah,5);
  $kabkota = substr($wilayah,5);
  $pejabat = "BUPATI";
} elseif ($nilai == "KOT") {
  if (substr($wilayah,10,7) == "JAKARTA") {
	$kabkota2 = "KABUPATEN ".substr($wilayah,5);
    $kabkota = $wilayah;
    $pejabat = "GUBERNUR";
  }
  else {
	$kabkota2 = "KOTA ".substr($wilayah,5);
    $kabkota = substr($wilayah,5);
    $pejabat = "WALIKOTA";
  }

}

require_once(BASE_FILE_FPDF.'/fpdf.php');
$pdf = new FPDF('P','mm','A4');
//membuat halaman baru
$pdf->SetMargins(20,20,20);
$pdf->AddPage();
$pdf->Image(BASE_FILE_PATH.'LogoKabKota/'.$logo,95,15,22);
$pdf->Cell(200,25,'',0,1);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,15,'PEMERINTAH DAERAH '.(isset($kabkota2) ? $kabkota2 : '[ NAMA PROVINSI KOSONG ]'),0,1,'C');
$pdf->SetFont('ARIAL','',12);
$pdf->Cell(0,5,'KEPUTUSAN',0,1,'C');
$pdf->SetFont('ARIAL','',12);
$pdf->Cell(0,5,$pejabat.' '.(isset($kabkota) ? $kabkota : '[ NAMA PROVINSI KOSONG ]'),0,1,'C');
$pdf->SetFont('ARIAL','',12);
$pdf->Cell(0,5,'NOMOR '.(isset($result_list['no_imb']) ? $result_list['no_imb'] : '[ NOMOR IMB KOSONG ]'),0,1,'C');
$pdf->SetFont('ARIAL','',12);
$pdf->Cell(0,10,'TENTANG',0,1,'C');
$pdf->SetFont('ARIAL','',12);
$pdf->Cell(0,10,'IZIN MENDIRIKAN BANGUNAN GEDUNG',0,1,'C');
$pdf->SetFont('ARIAL','',12);
$pdf->Cell(0,14,$pejabat.' '.(isset($kabkota) ? $kabkota : '[ NAMA PROVINSI KOSONG ]'),0,1,'C');

$pdf->Cell(0,3,'',0,1);
$pdf->SetFont('ARIAL','B',10);
$pdf->Cell(30,5,'Membaca',0,0,'L');
$pdf->Cell(2,5,':',0,0);
$pdf->SetFont('ARIAL','',10);
$pdf->Cell(2,5,' Permohonan Izin Mendirikan Bangunan Gedung',0,1);

$pdf->Cell(33,5,'',0,0);
$pdf->Cell(42,5,'Nomor',0,0,'L');
$pdf->Cell(2,5,':',0,0);
$pdf->Cell(49,5,$result_list['no_imb'],0,1,'L');
/*$pdf->Cell(13,5,'Tanggal :',0,0);
$pdf->Cell(0,5,$tgl_persetujuan,0,1,'R');*/

$pdf->Cell(33,5,'',0,0);
$pdf->Cell(42,5,'Nama Pemilik',0,0,'L');
$pdf->Cell(2,5,':',0,0);
if($result_list['nama_perusahaan']!= '')
{
	$nama_pemilik =ucwords(strtoupper($result_list['nama_perusahaan']));
}else{
	$nama_pemilik =$result_list['nama_pemohon'];
}
$pdf->MultiCell(0,5,(isset($nama_pemilik) ? $nama_pemilik : '[ NAMA PEMOHON KOSONG ]'),0,'J',0);

$pdf->Cell(33,5,'',0,0);
$pdf->Cell(42,5,'Alamat Pemilik',0,0,'L');
$pdf->Cell(2,5,':',0,0);
if($result_list['alamat_perusahaan'] != '')
{
	$alamat_pemilik = $result_list['alamat_perusahaan'];
}else{
	$alamat_pemilik = $result_list['alamat_pemohon'];
}
$pdf->MultiCell(0,5,(isset($alamat_pemilik) ? $alamat_pemilik : '[ NAMA PEMILIK  KOSONG ]').", ".(isset($result_list['nama_kecamatan']) ? 'Kec. '.$result_list['nama_kecamatan'].', '.ucwords(strtolower($result_list['nama_kabkota'])) : '[ NAMA KECAMATAN/KABKOT KOSONG ]').", ".(isset($result_list['nama_provinsi']) ? 'Prov. '. $result_list['nama_provinsi'] : '[ NAMA PROVINSI KOSONG ]'),0,'J',0);


$pdf->Cell(33,5,'',0,0);
$pdf->Cell(42,5,'Tipe Permohonan',0,0,'L');
$pdf->Cell(2,5,':',0,0);
$pdf->MultiCell(0,5,$result_list['jns_permohonan'],0,'J',0);


$pdf->Cell(33,5,'',0,0);
$pdf->Cell(42,5,'Fungsi bangunan gedung',0,0,'L');
$pdf->Cell(2,5,':',0,0);
$pdf->Cell(10,5,(isset($result_list['fungsi_bg']) ? ucwords(strtolower($result_list['fungsi_bg'])) : '[ FUNGSI BANGUNAN KOSONG ]'),0,1);

$pdf->Cell(33,5,'',0,0);
$pdf->Cell(42,5,'Jenis bangunan gedung',0,0,'L');
$pdf->Cell(2,5,':',0,0);
$pdf->Cell(10,5,(isset($result_list['jns_bangunan']) ? ucwords(strtolower($result_list['jns_bangunan'])) : '[ JENIS BANGUNAN KOSONG ]'),0,1);

$pdf->Cell(33,5,'',0,0);
$pdf->Cell(42,5,'Nama bangunan gedung',0,0,'L');
$pdf->Cell(2,5,':',0,0);
$pdf->MultiCell(0,5,(isset($result_list['nama_bangunan']) ? $result_list['nama_bangunan'] : '[ NAMA BANGUNAN KOSONG ]'),0,'J',0);

if($result_list['tinggi_prasarana'] == 0 || $result_list['tinggi_prasarana'] == null){
$pdf->Cell(33,5,'',0,0);
$pdf->Cell(42,5,'Luas bangunan gedung',0,0,'L');
$pdf->Cell(2,5,':',0,0);
$pdf->Cell(17,5,(isset($result_list['luas_bg']) ? $result_list['luas_bg'] : '[ LUAS BANGUNAN KOSONG ]'),0,0);
if ($result_list['luas_bg'] == 0 || $result_list['luas_bg'] == null){
  $pdf->Cell(6,5,' m',0,0);
  $pdf->subWrite(5,'2','',6,4);
  $pdf->Cell(6,5,'',0,1);
}else{
 $pdf->Cell(4,5,' m',0,0);
  $pdf->subWrite(5,'2','',6,4);
  $pdf->Cell(6,5,'',0,1);
}
}else{
$pdf->Cell(33,5,'',0,0);
$pdf->Cell(42,5,'Tinggi bangunan gedung',0,0,'L');
$pdf->Cell(2,5,':',0,0);
$pdf->Cell(10,5,(isset($result_list['tinggi_prasarana']) ? $result_list['tinggi_prasarana'] : '[ LUAS BANGUNAN KOSONG ]'),0,0);
if ($result_list['tinggi_prasarana'] != 0 || $result_list['tinggi_prasarana'] != null){
  $pdf->Cell(4,5,'m',0,0);
  //$pdf->subWrite(5,'2','',6,4);
  $pdf->Cell(10,5,'',0,1);
}
}


$j=1;
if ($count_tanah>1) {
  $pdf->Cell(33,5,'',0,0);
  $pdf->Cell(42,5,'Hak atas tanah',0,0,'L');
  $pdf->Cell(2,5,':',0,0);
  foreach ($result_tanah as $key => $row) {
	  $hat = $row['hat'];
	  if($j > 1){
		  $pdf->Cell(77,5,'',0,0);
	  }
	  $pdf->Cell(34,5,$j++.'. Atas Nama',0,0);
	  $pdf->Cell(2,5,':',0,0);
	  $pdf->MultiCell(45,5,(isset($row['atas_nama_dok']) ? $row['atas_nama_dok'] : '[ PEMILIK TANAH KOSONG ]'),0,1);

	  if ($row['hat'] != 0) {
		$pdf->Cell(81,5,'',0,0);
		$pdf->Cell(30,5,'Hak Atas Tanah',0,0,'L');
		$pdf->Cell(2,5,':',0,0);
		$pdf->Cell(15,5,(isset($list_jenis_bg[$hat]) ? $list_jenis_bg[$hat] : '[ HAK ATAS TANAH KOSONG ]'),0,1);
	  
		if($row['id_kabkot'] != '5171' ){
			
		}else{	
			$pdf->Cell(81,5,'',0,0);
			$pdf->Cell(30,5,'No. Dokumen',0,0,'L');
			$pdf->Cell(2,5,':',0,0);
			$pdf->Cell(17,5,(isset($row['no_dok']) ? $row['no_dok'] : '[ No Dokumen Kosong ]'),0,1);
		}

		$pdf->Cell(81,5,'',0,0);
		$pdf->Cell(30,5,'Luas Tanah',0,0,'L');
		$pdf->Cell(2,5,':',0,0);
		$pdf->Cell(17,5,(isset($row['luas_tanah']) ? $row['luas_tanah'] : '[ LUAS TANAH KOSONG ]'),0,0);
		$pdf->Cell(6,5,' m',0,0);
		$pdf->subWrite(5,'2','',6,4);
		$pdf->Cell(10,5,'',0,1);
	  }
  }
} else {
  foreach ($result_tanah as $key => $row) {
		if ($row['hat'] != 0) {
			$hat = $row['hat'];
			$pdf->Cell(33,5,'',0,0);
			$pdf->Cell(42,5,'Hak Atas Tanah',0,0,'L');
			$pdf->Cell(2,5,':',0,0);
			$pdf->Cell(10,5,(isset($list_jenis_bg[$hat]) ? $list_jenis_bg[$hat] : '[ HAK ATAS TANAH KOSONG ]'),0,1);
		}
		$pdf->Cell(33,5,'',0,0);
		$pdf->Cell(42,5,'Luas tanah',0,0,'L');
		$pdf->Cell(2,5,':',0,0);
		$pdf->Cell(17,5,(isset($row['luas_tanah']) ? $row['luas_tanah'] : ''),0,0);
		if ($row['luas_tanah'] != 0 || $row['luas_tanah'] == null){
			$pdf->Cell(4,5,' m',0,0);
			$pdf->subWrite(5,'2','',6,4);
			$pdf->Cell(10,5,'',0,1);
		}
		$pdf->Cell(33,5,'',0,0);
		$pdf->Cell(42,5,'Pemilik Tanah',0,0,'L');
		$pdf->Cell(2,5,':',0,0);
		$pdf->MultiCell(95,5,(isset($row['atas_nama_dok']) ? $row['atas_nama_dok'] : '[ PEMILIK TANAH KOSONG ]'),0,1);
		if($row['id_kabkot'] != '5171'){
		
		}else{
			$pdf->Cell(33,5,'',0,0);
			$pdf->Cell(42,5,'No. Dokumen Tanah',0,0,'L');
			$pdf->Cell(2,5,':',0,0);
			$pdf->MultiCell(95,5,(isset($row['no_dok']) ? $row['no_dok'] : '[ No. Dokumen Tanah Kosong ]'),0,1);
		}
	}
}


$pdf->Cell(33,5,'',0,0);
$pdf->Cell(42,5,'Lokasi tanah',0,0,'L');
$pdf->Cell(2,5,':',0,0);
$pdf->MultiCell(95,5,(isset($result_list['lokasi_tanah']) ? $result_list['lokasi_tanah'] : '[ LOKASI TANAH KOSONG ]').", ".(isset($row['nama_kecamatan']) ? 'Kec. '.ucwords(strtolower($row['nama_kecamatan'])).', '.ucwords(strtolower($row['nama_kabkota'])) : '[ NAMA KECAMATAN/KABKOT KOSONG ]').", ".(isset($row['nama_provinsi']) ? 'Prov. '.ucwords(strtolower($row['nama_provinsi'])) : '[ NAMA PROVINSI KOSONG ]'),0,1);

$pdf->Cell(0,5,'',0,1);
$pdf->SetFont('ARIAL','B',10);
$pdf->Cell(30,5,'Menimbang',0,0,'L');
$pdf->Cell(2,5,':',0,0);
$pdf->SetFont('ARIAL','',10);
$pdf->Cell(1,5,'',0,0);
$pdf->MultiCell(0,5,'Bahwa setelah memeriksa (mencatat/meneliti), mengkaji, dan menilai/evaluasi serta menyetujui dokumen rencana teknis bangunan gedung sebagaimana dimaksud di atas dengan ini disahkan, maka terhadap Permohonan Izin Mendirikan Bangunan Gedung yang dimaksud dapat diberikan izin dengan ketentuan persyaratan sebagaimana dalam Lampiran Keputusan ini.',0,'J',0);

$pdf->Cell(0,5,'',0,1);
$pdf->SetFont('ARIAL','B',10);
$pdf->Cell(30,5,'Mengingat',0,0,'L');
$pdf->Cell(3,5,':',0,0);
$pdf->SetFont('ARIAL','',10);

$i=1;
foreach ($result_uu as $key => $value) {
  $pdf->Cell(5,5,$i++.'.',0,0);
  $pdf->MultiCell(0,5,$value['uu'],0,'J',0,1);
  $pdf->Cell(33,5,'',0,0);
}


	foreach ($result_per as $key => $value) {

	if ($value['nama_perda'] != null || $value['nama_perda'] != ''){
		$pdf->Cell(5,5,$i++.'.',0,0);
	}
	$pdf->MultiCell(0,5,$value['nama_perda'],0,'J',0,1);
	$pdf->Cell(33,5,'',0,0);
	}

$pdf->Cell(0,5,'',0,1);
$pdf->SetFont('ARIAL','B',10);
$pdf->Cell(30,5,'Memperhatikan',0,0,'L');
$pdf->Cell(2,5,':',0,0);

$pdf->Cell(2,5,'',0,0);
$pdf->SetFont('ARIAL','',10);
if ($result_list['id_fungsi_bg'] != 1) {
	$pdf->MultiCell(0,5,'Berita Acara Hasil Pemeriksaan Dokumen Rencana Teknis Tim Ahli Bangunan Gedung Nomor '.$resultHasil['no_sk_tk'].' tanggal '.$tgl_teknis.' (untuk Bangunan Gedung Kepentingan Umum)',0,'J',0);
} else {
	$pdf->MultiCell(0,5,'Berita Acara Hasil Pemeriksaan Dokumen Rencana Teknis Tim Teknis Dinas PUPR/Dinas Teknis yang membidangi Bangunan Gedung Nomor '.$resultHasil['no_sk_tk'].' tanggal '.$tgl_teknis.' (untuk Bangunan Gedung Bukan Kepentingan Umum)',0,'J',0);
}

$pdf->AddPage();
$pdf->Cell(0,5,'',0,1);
$pdf->SetFont('ARIAL','',12);
$pdf->Cell(0,10,'MEMUTUSKAN',0,1,'C');

$pdf->Cell(0,5,'',0,1);
$pdf->SetFont('ARIAL','B',10);
$pdf->Cell(30,5,'Menetapkan',0,0,'L');
$pdf->Cell(2,5,':',0,0);
$pdf->SetFont('ARIAL','',10);
$pdf->Cell(2,5,'1.   Pemberian Izin Mendirikan Bangunan Gedung kepada :',0,1);

$pdf->Cell(38,5,'',0,0);
$pdf->Cell(42,5,'Nama  Pemilik',0,0,'L');
$pdf->Cell(2,5,':',0,0);
if($result_list['nama_perusahaan']!= '')
{
	$nama_pemilik =ucwords(strtoupper($result_list['nama_perusahaan']));
}else{
	$nama_pemilik = $result_list['nama_pemohon'];
}
$pdf->MultiCell(0,5,(isset($nama_pemilik) ? $nama_pemilik : '[ NAMA PEMOHON KOSONG ]'),0,'J',0);

$pdf->Cell(38,5,'',0,0);
$pdf->Cell(42,5,'Alamat Pemilik',0,0,'L');
$pdf->Cell(2,5,':',0,0);
if($result_list['alamat_perusahaan'] != '')
{
	$alamat_pemilik = $result_list['alamat_perusahaan'];
}else{
	$alamat_pemilik = $result_list['alamat_pemohon'];
}
//$pdf->MultiCell(0,5,(isset($alamat_pemilik) ? ucwords(strtolower($alamat_pemilik)) : '[ NAMA PEMILIK KOSONG ]'),0,'J',0);
$pdf->MultiCell(0,5,(isset($alamat_pemilik) ? $alamat_pemilik : '[ Alamat Pemilik Kosong ]').", ".(isset($result_list['nama_kecamatan']) ? 'Kec. '.ucwords(strtolower($result_list['nama_kecamatan'])).', '.ucwords(strtolower($result_list['nama_kabkota'])) : '[ NAMA KECAMATAN/KABKOT KOSONG ]').", ".(isset($result_list['nama_provinsi']) ? 'Prov. '.$result_list['nama_provinsi'] : '[ NAMA PROVINSI KOSONG ]'),0,'J',0);



$pdf->Cell(38,5,'',0,0);
$pdf->Cell(42,5,'Untuk',0,0,'L');
$pdf->Cell(2,5,':',0,0);
$pdf->MultiCell(0,5,$result_list['jns_permohonan'],0,'J',0);

$pdf->SetFont('ARIAL','',10);
$pdf->Cell(33,5,'',0,0);
$pdf->Cell(4,5,'2.',0,0);
$pdf->MultiCell(0,5,'Besarnya  retribusi  yang  harus  dibayar  oleh pemohon  sebesar :',0,'J',0);

$pdf->Cell(37,10,'',0,0);
$pdf->Cell(75,10,'Nilai Retribusi IMB',0,0,'L');
$pdf->Cell(6,10,'Rp.',0,0);
$pdf->Cell(0,10,number_format($retri,0,'',','),0,1);


$pdf->Cell(37,5,'',0,0);
//$pdf->Cell(75,5,'(Terbilang ..... )',0,1,'L');
$pdf->Cell(75,5,'( '.terbilang($retri).' rupiah )',0,1,'L');

$pdf->Cell(0,5,'',0,1);

$pdf->Cell(33,5,'',0,0);
$pdf->Cell(4,5,'3.',0,0);
$pdf->MultiCell(0,5,'Lampiran Keputusan ini merupakan satu kesatuan yang tidak terpisahkan dari Keputusan ini;',0,'J',0);


/* $pdf->Cell(33,5,'',0,0);
$pdf->Cell(75,5,'4. Hal-hal yang belum diatur dalam keputusan ini akan ditetapkan kemudian;',0,1,'L'); */

$pdf->Cell(33,5,'',0,0);
$pdf->Cell(75,5,'4. Salinan Keputusan ini diberikan kepada yang berkepentingan; dan',0,1,'L');

$pdf->Cell(33,5,'',0,0);
$pdf->Cell(75,5,'5. Keputusan ini mulai berlaku sejak tanggal diterbitkan.',0,1,'L');


$pdf->Cell(0,5,'',0,1);
$pdf->Cell(33);
$pdf->Cell(0,0,$pdf->Image(BASE_FILE_PATH.'IMB/qr_imb/'.$result_list['no_imb'].'.png', $pdf->GetX(), $pdf->GetY(), 30,30),0,1);

$pdf->Cell(70);
$pdf->Cell(30,5,'DITETAPKAN DI',0,0);
$pdf->Cell(2,5,':',0,0);
$pdf->Cell(30,5,$kabkota,0,1);
$pdf->Cell(70);
$pdf->Cell(30,5,'PADA TANGGAL',0,0);
$pdf->Cell(2,5,':',0,0);
$pdf->Cell(30,5,$tgl_persetujuan,0,1);

// $pdf->Cell(90);
// $pdf->Cell(0,0,'---------------------------------------------------------',0,1);
$pdf->Cell(70);
$pdf->Cell(0,5,'ATAS NAMA '.$pejabat.' '.$kabkota,0,1);
//$pdf->Cell(70);
//$pdf->Cell(0,5,$kabkota,0,1);
if(trim($result_list['p_nama_dinas']) != ''){
  $nm_dinas = ucwords(strtoupper($result_list['p_nama_dinas']));
}else{
  $nm_dinas = 'DPMPTSP';
}
if($result_list['ttd_pejabat_sk'] =='Drs. SEPTEDY, M.Si'){
	if($result_list['tgl_imb']>='2020-12-02'){
		$Kasid = ' Plt. KEPALA';
	}else{
		$Kasid ='KEPALA';
	}
}elseif($result_list['ttd_pejabat_sk'] == 'SUPRIYANTO, S.Sos, M.Si'){
	if($result_list['tgl_imb'] >='2021-01-15'){
		$Kasid ='Plt. KEPALA';
	}else{
		$Kasid='KEPALA';
	}
}elseif($result_list['ttd_pejabat_sk'] == 'GEREK, S.Hut, MP'){
	if($result_list['tgl_imb'] >= '2021-07-07'){
		$Kasid ='Plt KEPALA';
	}else{
		$Kasid='KEPALA';
	}
}else{
	$Kasid ='KEPALA';
}


$pdf->Cell(70); 
$pdf->MultiCell(0,5,$Kasid.' '.$nm_dinas,0,1);
$pdf->Cell(0,0,'',0,1);
$pdf->Cell(70);
$pdf->Cell(0,5,$result_list['ttd_pejabat_sk'],0,1);
$pdf->Cell(70);
$pdf->Cell(0,5,$result_list['nip_pejabat_sk'],0,1);

// $pdf->Image((isset($QR) ? $QR : ''),120,205,30,30);
$pdf->Output('I',$result_list['no_imb'].'.pdf');
?>
