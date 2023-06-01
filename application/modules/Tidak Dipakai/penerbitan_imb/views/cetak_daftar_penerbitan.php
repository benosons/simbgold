<?php
require_once(BASE_FILE_FPDF.'/Pdf_Service.php');
 
$htmlRM = "<html>
<head><title>$head_title</title></head>
<body>
<table width='280' border='0' align='center' cellpadding='2' cellspacing='2'>
 <tr>
	<td align='left' width='0'></td>
	<td width='0'></td>
	<td width='230'></td>
  </tr>";

/*if(isset($username)){	 
$htmlRM .= "
  <tr>
	<td align='left' width='30' style='bold'>No Registrasi</td>
	<td align='left' width='2' style='bold'>:</td>
	<td style='bold'>".$username."</td>
  </tr>";
}
if(isset($nama_pemohon)){	 
$htmlRM .= "
  <tr>
	<td align='left' width='30' style='bold'>Nama Pemohon</td>
	<td align='left' width='2' style='bold'>:</td>
	<td style='bold'>".$nama_pemohon."</td>
  </tr>";
}
if(isset($id_jenis_bg)){
	if ($id_jenis_bg == 'Semua') {
	$htmlRM .="
	<tr>
		<td align='left' width='30'></td>
	</tr>";
	}else if($id_jenis_bg == '1'){
		$htmlRM .="
	<tr>
		<td align='left' width='30' style='bold'>Pelayanan IMB</td>
		<td align='left' width='2' style='bold'>:</td>
		<td style='bold'>Mendirikan Bangunan Gedung Baru</td>
	</tr>";
	}else if($id_jenis_bg == '2'){
		$htmlRM .="
	<tr>
		<td align='left' width='30' style='bold'> Pelayanan IMB</td>
		<td align='left' width='2' style='bold'>:</td>
		<td style='bold'>Bangunan Gedung Existing Belum Ber-IMB</td>
	</tr>";
	}else if($id_jenis_bg == '3'){
		$htmlRM .="
	<tr>
		<td align='left' width='30' style='bold'>Pelayanan IMB</td>
		<td align='left' width='2' style='bold'>:</td>
		<td style='bold'>Mengubah Bangunan Gedung</td>
	</tr>";
	}else if($id_jenis_bg == '4'){
		$htmlRM .="
	<tr>
		<td align='left' width='30' style='bold'> Pelayanan IMB</td>
		<td align='left' width='2' style='bold'>:</td>
		<td style='bold'>Bangunan Gedung Kolektif</td>
	</tr>";
	}else if($id_jenis_bg == '5'){
		$htmlRM .="
	<tr>
		<td align='left' width='30' style='bold'>Pelayanan IMB</td>
		<td align='left' width='2' style='bold'>:</td>
		<td style='bold'>Bangunan Gedung Prasarana</td>
	</tr>";
	}else if($id_jenis_bg == '6'){
		$htmlRM .="
	<tr>
		<td align='left' width='30' style='bold'> Pelayanan IMB</td>
		<td align='left' width='2' style='bold'>:</td>
		<td style='bold'>Bangunan Gedung IMB Bertahap</td>
	</tr>";
	}else if($id_jenis_bg == '7'){
		$htmlRM .="
	<tr>
		<td align='left' width='30' style='bold'>Pelayanan IMB</td>
		<td align='left' width='2' style='bold'>:</td>
		<td style='bold'>Memperluas Bangunan Gedung</td>
	</tr>";
	}else if($id_jenis_bg == '8'){
		$htmlRM .="
	<tr>
		<td align='left' width='30' style='bold'> Pelayanan IMB</td>
		<td align='left' width='2' style='bold'>:</td>
		<td style='bold'>Mengurangi Luas Bangunan Gedung</td>
	</tr>";
	}else if($id_jenis_bg == '9'){
		$htmlRM .="
	<tr>
		<td align='left' width='30' style='bold'>Pelayanan IMB</td>
		<td align='left' width='2' style='bold'>:</td>
		<td style='bold'>Merawat Bangunan Gedung</td>
	</tr>";
	}
}
if(isset($klasifikasi_bg)){
	if ($klasifikasi_bg == 'Semua') {
	$htmlRM .="
	<tr>
		<td align='left' width='30'></td>
	</tr>";
	}else if($klasifikasi_bg == '1'){
		$htmlRM .="
	<tr>
		<td align='left' width='30' style='bold'>Kompleksitas Bangunan Gedung</td>
		<td align='left' width='2' style='bold'>:</td>
		<td style='bold'>Sederhana</td>
	</tr>";
	}else if($klasifikasi_bg == '2'){
		$htmlRM .="
	<tr>
		<td align='left' width='30' style='bold'>Kompleksitas Bangunan Gedung</td>
		<td align='left' width='2' style='bold'>:</td>
		<td style='bold'>Tidak Sederhana</td>
	</tr>";
	}else if($klasifikasi_bg == '3'){
		$htmlRM .="
	<tr>
		<td align='left' width='30' style='bold'>Kompleksitas Bangunan Gedung</td>
		<td align='left' width='2' style='bold'>:</td>
		<td style='bold'>Khusus</td>
	</tr>";
	}
}
if(isset($id_pemanfaatan_bg)){
	if ($id_pemanfaatan_bg == 'Semua') {
	$htmlRM .="
	<tr>
		<td align='left' width='30'></td>
	</tr>";
	}else if($id_pemanfaatan_bg == '1'){
		$htmlRM .="
	<tr>
		<td align='left' width='30' style='bold'>Pemanfaatan Bangunan Gedung</td>
		<td align='left' width='2' style='bold'>:</td>
		<td style='bold'>Untuk Kepentingan Umum</td>
	</tr>";
	}else if($id_pemanfaatan_bg == '2'){
		$htmlRM .="
	<tr>
		<td align='left' width='30' style='bold'>Pemanfaatan Bangunan Gedung</td>
		<td align='left' width='2' style='bold'>:</td>
		<td style='bold'>Bukan Untuk Kepentingan Umum</td>
	</tr>";
	}
}
if(isset($jenis_urusan)){
if($jenis_urusan == ''){
 }else{	 
$htmlRM .= "
  <tr>
	<td align='left' width='30' style='bold'>Jenis Permohonan</td>
	<td align='left' width='2' style='bold'>:</td>
	<td style='bold'>".$nama_permohonan."</td>
  </tr>";
}
}

if(isset($id_kabkot)){
if($id_kabkot == ''){
 }else{	 
$htmlRM .= "
  <tr>
	<td align='left' width='30' style='bold'>Kab/Kota</td>
	<td align='left' width='2' style='bold'>:</td>
	<td style='bold'>".$nama_kabkota_bg."</td>
  </tr>";
}
}
 
if(isset($tgl_permohonan_awal)){ 
	if($tgl_permohonan_awal == ''){
	}else{
	$htmlRM .= "
	<tr>
		<td align='left' width='30' style='bold'>Periode Permohonan</td>
		<td align='left' width='2' style='bold'>:</td>
		<td style='bold'>".$tgl_permohonan_awal." Sampai ".$tgl_permohonan_akhir."</td>
	</tr>";
	}
}*/


$htmlRM .= "   
</table>
<table>
	<tr>
		<td></td>
	</tr>
</table>
<table width='280px' border='1' cellpadding='2' cellspacing='1' align='center' fonts-size='50'>
  <tr BGCOLOR ='#CCCCCC' repeat>
    <td rowspan='1' width='7px' align='center'  height='5' style='bold' valign='middle'>No.</td>
	<td rowspan='1' width='28px' align='center' style='bold' valign='middle'>Jenis Permohonan</td>
	<td rowspan='1' width='20px' align='center' style='bold' valign='middle'>Tgl. Permohonan <br>No. Registrasi</td>
	<td rowspan='1' width='25px' align='center' style='bold' valign='middle'>Nama Pemohon</td>
	<td rowspan='1' width='15px' align='center' style='bold' valign='middle'>Bentuk<br> Usaha</td>
	<td rowspan='1' width='30px' align='center' style='bold' valign='middle'>Alamat</td>
	<td rowspan='1' width='20px' align='center' style='bold' valign='middle'>No. KTP</td>
	<td rowspan='1' width='25px' align='center' style='bold' valign='middle'>No. Telepon/ No. Hp</td>
	<td rowspan='1' width='40px' align='center' style='bold' valign='middle'>Nama dan Alamat<br> Badan Usaha/Hukum</td>
	<td rowspan='1' width='35px' align='center' style='bold' valign='middle'>Lokasi BG</td>
	<td rowspan='1' width='17px' align='center' style='bold' valign='middle'>Fungsi BG</td>
</tr> 
 ";
	if(count($results) <= 0)
	{
		$htmlRM .= "<tr>
						<td align='center' colspan = '10'>Data Kosong</td>
					</tr>
					";
	}else{	
		for($i=0;$i<count($results);$i++){
			if($results[$i]['id_jenis_usaha']==1){
				$usaha = "Perseorangan";
				}elseif($results[$i]['id_jenis_usaha']==2){
				$usaha = "Badan Usaha";
				}elseif($results[$i]['id_jenis_usaha']==3){
				$usaha = "Badan Hukum";
				}else{
				$usaha = "";
				}
			
			$htmlRM .= "
			<tr>
				<td align='center' valign='middle' height='7' fonts-size='7'>".($i+1)."</td>
				<td align='left' valign='middle>".$results[$i]['nama_permohonan']."</td>
				<td align='center' valign='middle' height='7'>".tgl_eng_to_ind($results[$i]['tgl_permohonan'])."</td>
				<td align='left' valign='middle'>".$results[$i]['nama_pemohon']."</td>
				<td align='left' valign='middle'>".$usaha."</td>
				<td align='center' valign='middle'>".$results[$i]['alamat_pemohon'].", ".$results[$i]['nama_kecamatan'].", ".$results[$i]['nama_kabkota'].", ".$results[$i]['nama_provinsi']."</td>
				<td align='left' valign='middle'>".$results[$i]['no_ktp']."</td>
				<td align='center' valign='middle'>".$results[$i]['no_tlp']."</td>
				<td align='left' valign='middle'>".$results[$i]['nama_perusahaan']."<br>".$results[$i]['alamat_perusahaan']."<br>".$results[$i]['no_tlp_perusahaan']."</td>
				<td align='left' valign='middle'>".$results[$i]['alamat_bg'].", ".$results[$i]['kecamatan'].", ".$results[$i]['nama_kabkota_bg'].", ".$results[$i]['nama_provinsi_bg']."</td>
				<td align='left' valign='middle'>".$results[$i]['fungsi_bg']."</td>
			</tr>";	
			}
			
	}
	
$htmlRM .= "

	<table width='280' border='0' align='center' cellpadding='1' cellspacing='1'>
		<tr>
			<td></td>
		</tr>
		<tr>
			<td align='right'></td>
		</tr>
	</table>
</table></body></html>"; 	
 
class PDF extends Pdf_Service
{
        var $angle=0;
		private $namafile = '';
         
		function Rotate($angle,$x=-1,$y=-1)
		{
			if($x==-1)
				$x=$this->x;
			if($y==-1)
				$y=$this->y;
			if($this->angle!=0)
				$this->_out('Q');
			$this->angle=$angle;
			if($angle!=0)
			{
				$angle*=M_PI/180;
				$c=cos($angle);
				$s=sin($angle);
				$cx=$x*$this->k;
				$cy=($this->h-$y)*$this->k;
				$this->_out(sprintf('q %.5f %.5f %.5f %.5f %.2f %.2f cm 1 0 0 1 %.2f %.2f cm',$c,$s,-$s,$c,$cx,$cy,-$cx,-$cy));
			}
		}

		function _endpage()
		{
			if($this->angle!=0)
			{
				$this->angle=0;
				$this->_out('Q');
			}
			parent::_endpage();
		}
		function Header()
		{
			
		}
		
		function Footer() 
		{
			$this->SetY(-8); //-1.5
			$this->SetFont('Arial','I',7);
			$this->Cell(0,1,'Page '.$this->PageNo().'/{nb}',0,0,'L');
			$tanggal = date("d-m-Y",time());
			$this->SetFont('Arial','I',7);
			$this->Cell(0,1,'Printed by SIM BG tanggal '.$tanggal,0,0,'R');
		}  
}
	
$p = new PDF($orientation='L',$unit='mm',$format='A4');   
    $p ->AliasNbPages();
    $p ->AddPage();
	$p->SetMargins(20,10,10); //L,T,R
    $p->SetFont('Arial', 'B', 13);
    $p->SetTextColor(35, 35, 35);   
    $p->Cell(45);
    $p->Cell(175,5,'DAFTAR PERMOHONAN IMB',0,1,'C');    
	$p->Cell(95);
	//$p->Cell(75,10,'KEMENTERIAN ESDM',0,1,'C'); 
    $p->Ln();
    $p->SetFont('Arial', '', 6);
	//echo $htmlRM;
    $p->WriteHTML($htmlRM);
    //$p->output('lap.pdf','D');
    $p->output('daftar_permohonan_'.date('d-m-Y-H-s').'.pdf','I');
?>