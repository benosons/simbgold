<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  	
	
	function hari_ind ($hari)
	{
		if($hari ==0){
			$h = 'Minggu';;
		} else if ($hari ==1){
			$h = ("Senin"); 
		} else if ($hari ==2){
			$h = 'Selasa';
		} else if ($hari ==3){
			$h = 'Rabu';
		} else if ($hari ==4){
			$h = 'Kamis';
		} else if ($hari ==5){
			$h = "Jum'at";
		}else if ($hari ==6){
			$h = "Sabtu";
		}
		
		return $h;
	}
	
	function nama_hari($tanggal) //dudi
	{
		$ubah = gmdate($tanggal, time()+60*60*8);
		$pecah = explode("-",$ubah);
		$tgl = $pecah[2];
		$bln = $pecah[1];
		$thn = $pecah[0];

		$nama = date("l", mktime(0,0,0,$bln,$tgl,$thn));
		$nama_hari = "";
		if($nama=="Sunday") {$nama_hari="Minggu";}
		else if($nama=="Monday") {$nama_hari="Senin";}
		else if($nama=="Tuesday") {$nama_hari="Selasa";}
		else if($nama=="Wednesday") {$nama_hari="Rabu";}
		else if($nama=="Thursday") {$nama_hari="Kamis";}
		else if($nama=="Friday") {$nama_hari="Jumat";}
		else if($nama=="Saturday") {$nama_hari="Sabtu";}
		return $nama_hari;
	}
	
	function bulan($bln)
	{
		switch ($bln)
		{
			case 1:
				return "Januari";
				break;
			case 2:
				return "Februari";
				break;
			case 3:
				return "Maret";
				break;
			case 4:
				return "April";
				break;
			case 5:
				return "Mei";
				break;
			case 6:
				return "Juni";
				break;
			case 7:
				return "Juli";
				break;
			case 8:
				return "Agustus";
				break;
			case 9:
				return "September";
				break;
			case 10:
				return "Oktober";
				break;
			case 11:
				return "November";
				break;
			case 12:
				return "Desember";
				break;
		}
			return $bln;
	}
	
	function killsession()
	{
		$this->session->unset_userdata('skeyhdno'); 
		$this->session->unset_userdata('skeynama_provinsi'); 
		$this->session->unset_userdata('skeynama_kementerian'); 
		// $this->session->unset_userdata('skeydasar'); 
	}	
	function tulistebal($teks)
	{
		$n = '<b>'.$teks.'</b>';
		return $n;
		
	}
	
	// Konversi dd-mm-yyyy -> yyyy-mm-dd
	function tgl_ind_to_eng($tgl) {
		$xreturn_ = '';
		if (trim($tgl) != '' && $tgl != '00-00-0000') {
			$tgl_eng=substr($tgl,6,4)."-".substr($tgl,3,2)."-".substr($tgl,0,2);
			$xreturn_ = $tgl_eng;
		}
		return $xreturn_;
	}
	
	function tgl_ind_to_eng_10($tgl) {
		$xreturn_ = '';
		if (trim($tgl) != '' && $tgl != '00-00-0000') {
			$tgl_eng=substr($tgl,6,4)."-".substr($tgl,3,2)."-10";
			$xreturn_ = $tgl_eng;
		}
		return $xreturn_;
	}
	function format_kurang_bln_n_10($tgl) {
		$xreturn_ = '';
		if (trim($tgl) != '' && $tgl != '00-00-0000') {
			$M = '';
			$m = substr($tgl,3,2);
			$y = substr($tgl,6,4);
			switch ($m) {
			case '00':
				$M = '';
				break;
			case '01':
				$M = '12';
				$y = $y-1;
				break;
			case '02':
				$M = '01';
				break;
			case '03':
				$M = '02';
				break;
			case '04':
				$M = '03';
				break;
			case '05':
				$M = '04';
				break;
			case '06':
				$M = '05';
				break;
			case '07':
				$M = '06';
				break;
			case '08':
				$M = '07';
				break;
			case '09':
				$M = '08';
				break;
			case '10':
				$M = '09';
				break;
			case '11':
				$M = '10';
				break;
			case '12':
				$M = '11';
				break;
			}
			
			$tgl_eng=$y."-".$M."-10";
			$xreturn_ = $tgl_eng;
		}
		return $xreturn_;
	}

	// Konversi yyyy-mm-dd -> dd-mm-yyyy
	function tgl_eng_to_ind($tgl) {
		$xreturn_ = '';
		if (trim($tgl) != '' AND $tgl != '0000-00-00') { 
			$tgl_ind=substr($tgl,8,2)."-".substr($tgl,5,2)."-".substr($tgl,0,4);
			$xreturn_ = $tgl_ind;
		}
		return $xreturn_;
	}
	
	function format_angka($angka) {
		$hasil =  number_format($angka,0, ",", ".");
		return $hasil;
	}
	
	// Konversi yyyy-mm-dd -> dd mmmm yyyy
	function format_date_ind($tgl){
		if (trim($tgl) != ''AND $tgl != '0000-00-00') {
			$d = substr($tgl,8,2);
			$m = substr($tgl,5,2);
			$y = substr($tgl,0,4);
			switch ($m) {
			case '00':
				$M = "";
				break;
			case '01':
				$M = "Januari";
				break;
			case '02':
				$M = "Februari";
				break;
			case '03':
				$M = "Maret";
				break;
			case '04':
				$M = "April";
				break;
			case '05':
				$M = "Mei";
				break;
			case '06':
				$M = "Juni";
				break;
			case '07':
				$M = "Juli";
				break;
			case '08':
				$M = "Agustus";
				break;
			case '09':
				$M = "September";
				break;
			case '10':
				$M = "Oktober";
				break;
			case '11':
				$M = "November";
				break;
			case '12':
				$M = "Desember";
				break;
			}
			
			$tanggal = $d." ".$M." ".$y;
			return $tanggal ;
		}
	}
	
function tgl_indo($tgl) 
	{
		$ubah = gmdate($tgl, time()+60*60*8);
		$pecah = explode("-",$ubah);
		$tanggal = $pecah[2];
		$bulan = bulan($pecah[1]);
		$tahun = $pecah[0];
		return $tanggal.' '.$bulan.' '.$tahun;
	}
	
function tgl_indo_2($tgl){
		if (trim($tgl) != ''AND $tgl != '0000-00-00') {
			$d = substr($tgl,8,2);
			$m = substr($tgl,5,2);
			$y = substr($tgl,2,2);
			switch ($m) {
			case '01':
				$M = "Jan";
				break;
			case '02':
				$M = "Feb";
				break;
			case '03':
				$M = "Mar";
				break;
			case '04':
				$M = "Apr";
				break;
			case '05':
				$M = "Mei";
				break;
			case '06':
				$M = "Jun";
				break;
			case '07':
				$M = "Jul";
				break;
			case '08':
				$M = "Ags";
				break;
			case '09':
				$M = "Sep";
				break;
			case '10':
				$M = "Okt";
				break;
			case '11':
				$M = "Nov";
				break;
			case '12':
				$M = "Des";
				break;
			}
			
			$tanggal = $d."-".$M."-".$y;
			return $tanggal ;
		}
	}

	
function tgl_dan_bulan($tgl) 
	{
		$tanggal = substr($tgl,8,2);
		$bulan = substr($tgl,5,2);
		$tahun = substr($tgl,0,4);
		return $tanggal.'/'.$bulan;
	}
	
	function ambil_bulan($tgl)  //Dudi
	{
		$ubah = gmdate($tgl, time()+60*60*8);
		$pecah = explode("-",$ubah);
		$tanggal = $pecah[2];
		$bulan = bulan($pecah[1]);
		$tahun = $pecah[0];
		return $bulan;
	}
	
	function ambil_tahun($tgl)
	{
		$ubah = gmdate($tgl, time()+60*60*8);
		$pecah = explode("-",$ubah);
		$tahun = $pecah[0];
		return $tahun;
	}
	
	function ambil_bulan_tahun($tgl)  //Dudi
	{
		$ubah = gmdate($tgl, time()+60*60*8);
		$pecah = explode("-",$ubah);
		$tanggal = $pecah[2];
		$bulan = bulan($pecah[1]);
		$tahun = $pecah[0];
		return $bulan.' '.$tahun;
	}
	
	function bahasa_tgl($tgl)  //Dudi
	{
		$ubah = gmdate($tgl, time()+60*60*8);
		$pecah = explode("-",$ubah);
		$tanggal = $pecah[2];
		$bulan = bulan($pecah[1]);
		$tahun = $pecah[0];
			switch ($tanggal) {
			case '1':
				$tanggal ="Satu";
				break;
			case '2':
				$tanggal ="Dua";
				break;
			case '3':
				$tanggal ="Tiga";
				break;
			case '4':
				$tanggal ="Empat";
				break;
			case '5':
				$tanggal ="Lima";
				break;
			case '6':
				$tanggal ="Enam";
				break;
			case '7':
				$tanggal ="Tujuh";
				break;
			case '8':
				$tanggal ="Delapan";
				break;
			case '9':
				$tanggal ="Sembilan";
				break;
			case '10':
				$tanggal ="Sepuluh";
				break;
			case '11':
				$tanggal ="Sebelas";
				break;
			case '12':
				$tanggal ="Dua Belas";
				break;
			case '13':
				$tanggal ="Tiga Belas";
				break;
			case '14':
				$tanggal ="Empat Belas";
				break;
			case '15':
				$tanggal ="Lima Belas";
				break;
			case '16':
				$tanggal ="Enam Belas";
				break;
			case '17':
				$tanggal ="Tujuh Belas";
				break;
			case '18':
				$tanggal ="Delapan Belas";
				break;
			case '19':
				$tanggal ="Sembilan Belas";
				break;
			case '20':
				$tanggal ="Dua Puluh";
				break;
			case '21':
				$tanggal ="Dua Puluh Satu";
				break;
			case '22':
				$tanggal ="Dua Puluh Dua";
				break;
			case '23':
				$tanggal ="Dua Puluh Tiga";
				break;
			case '24':
				$tanggal ="Dua Puluh Empat";
				break;
			case '25':
				$tanggal ="Dua Puluh Lima";
				break;
			case '26':
				$tanggal ="Dua Puluh Enam";
				break;
			case '27':
				$tanggal ="Dua Puluh Tujuh";
				break;
			case '28':
				$tanggal ="Dua Puluh Delapan";
				break;
			case '29':
				$tanggal ="Dua Puluh Sembilan";
				break;
			case '30':
				$tanggal ="Tiga Puluh";
				break;
			case '31':
				$tanggal ="Tiga Puluh Satu";
				break;
			}
		return $tanggal;
	}
	
	function nama_bulan_ind($m){
		if (trim($m) != '' AND $m != '0') {
			switch ($m) {
			case '1':
				$M = "Januari";
				break;
			case '2':
				$M = "Februari";
				break;
			case '3':
				$M = "Maret";
				break;
			case '4':
				$M = "April";
				break;
			case '5':
				$M = "Mei";
				break;
			case '6':
				$M = "Juni";
				break;
			case '7':
				$M = "Juli";
				break;
			case '8':
				$M = "Agustus";
				break;
			case '9':
				$M = "September";
				break;
			case '10':
				$M = "Oktober";
				break;
			case '11':
				$M = "November";
				break;
			case '12':
				$M = "Desember";
				break;
			default:
				$M = "";
			}
			return $M;
		}
	}
	
	function add_date($givendate,$day=0,$mth=0,$yr=0) {
		$cd = strtotime($givendate);
		$newdate = date('Y-m-d h:i:s', mktime(date('h',$cd),
		date('i',$cd), date('s',$cd), date('m',$cd)+$mth,
		date('d',$cd)+$day, date('Y',$cd)+$yr));
		return $newdate;
    }
	
	// menjumlahkan hari dalam tahun
	// digunakan pada sub modul daftar urut kepangkatan
	function date_diff_custom($d1, $d2){
		$d1 = (is_string($d1) ? strtotime($d1) : $d1);
		$d2 = (is_string($d2) ? strtotime($d2) : $d2);
		$diff_secs = abs($d1 - $d2);
		$base_year = min(date("Y", $d1), date("Y", $d2));
		$diff = mktime(0, 0, $diff_secs, 1, 1, $base_year);
		return array(
			"years" => date("Y", $diff) - $base_year,
			"months_total" => (date("Y", $diff) - $base_year) * 12 + date("n", $diff) - 1,
			"months" => date("n", $diff) - 1,
			"days_total" => floor($diff_secs / (3600 * 24)),
			"days" => date("j", $diff) - 1,
			"hours_total" => floor($diff_secs / 3600),
			"hours" => date("G", $diff),
			"minutes_total" => floor($diff_secs / 60),
			"minutes" => (int) date("i", $diff),
			"seconds_total" => $diff_secs,
			"seconds" => (int) date("s", $diff)
		);
	}
	
	function hitung_sel_bulan($tgl1,$tgl2) { //(tanggal sekarang, tanggal sebelumnya)
		$thn1=substr($tgl1,0,4);
		$bln1=substr($tgl1,5,2);
		$hr1=substr($tgl1,8,2);
		$thn2=substr($tgl2,0,4);
		$bln2=substr($tgl2,5,2);
		$hr2=substr($tgl2,8,2);
		$tahun=$thn1-$thn2;
		if ($bln1<$bln2){
			$tahun=$tahun-1;
			$bulan=($bln1+12)-$bln2;
		}else{
			$bulan=$bln1-$bln2;
		}
		
		/*if ($hr1<=$hr2){
			$bulan=$bulan-1;
		}*/
		
		$hasil=($tahun*12)+$bulan;
		return $hasil;
	}
	
	// untuk handle single or double quotes
	function quotes_cek($string)
	{
		/**
		$n = trim(strlen($string));
		$st =  trim($string);
		$hasil = $st;
		$ketemu = false;
		$i = 0;
		while ($i < $n && ! $ketemu){
			if ($st{$i} == "'" OR $st{$i} == '"'){
				$ketemu = TRUE;
				$hasil = addslashes($st);
			} else {
				$i++;
			}
		}
		
		return $hasil;
		**/
		$value = trim($string);

		if (get_magic_quotes_gpc()) {
			$value = stripslashes($value);
		}
		// Quote if not integer
		if (!is_numeric($value)) {
			$value = mysql_real_escape_string($value);
		}
		return $value;
	}
	
	function remove_spasi($str)
	{
		$str=trim($str);
		return  str_replace("%20"," ",$str); 
	}
	
	function compare_date_greater_than($date_1,$date_2) {
		if (! is_null($date_1) && ! is_null($date_2)) {
			list($year, $month, $day) = explode('-', $date_1);
			$new_date_1 = sprintf('%04d%02d%02d', $year, $month, $day);
			list($year, $month, $day) = explode('-', $date_2);
			$new_date_2 = sprintf('%04d%02d%02d', $year, $month, $day);
			if ($date_2 > $date_1) {
				return false;
			} else {
				return true;
			}
		}
	}
	
	function compare_date_less_than($date_1,$date_2) {
		if (! is_null($date_1) && ! is_null($date_2)) {
			list($year, $month, $day) = explode('-', $date_1);
			$new_date_1 = sprintf('%04d%02d%02d', $year, $month, $day);
			list($year, $month, $day) = explode('-', $date_2);
			$new_date_2 = sprintf('%04d%02d%02d', $year, $month, $day);
			if ($date_2 < $date_1) {
				return false;
			} else {
				return true;
			}
		}
	}
	
	// simple way
	function compare_dates($date1, $date2) {
		if (! is_null($date1) && ! is_null($date2)) {
			list($month, $day, $year) = split('-', $date1);
			$new_date1 = sprintf('%04d%02d%02d', $year, $month, $day);

			list($month, $day, $year) = split('-', $date2);
			$new_date2 = sprintf('%04d%02d%02d', $year, $month, $day);

			return ($new_date1 > $new_date2);
		}
	}
	
	
	
	function valid_date($strdate)
	{
		$err = array();
		//Check the length of the entered Date value
		if((strlen($strdate)<10) OR (strlen($strdate)>10)){
			array_unshift($err,"Enter the date in 'dd-mm-yyyy' Format<br>");
		}
		else{
			//The entered value is checked for proper Date format
			if((substr_count($strdate,"-"))<>2){
				array_unshift($err,"Enter the date in 'dd-mm-yyyy' format<br>");
			} else{
				$pos = strpos($strdate,"-");
				$date = substr($strdate,0,($pos));
				$result = ereg("^[0-9]+$",$date,$trashed);
				if(!($result)){
					array_unshift($err,"Enter a Valid Date<br>");
				}
				else {
					if(($date<=0)OR($date>31)){
						array_unshift($err,"Enter a Valid Date<br>");
					}
				}
				
				// check month
				$month=substr($strdate,($pos+1),($pos));
				if(($month<=0) OR ($month>12)){
					array_unshift($err, "Enter a Valid Month<br>");
				}
				else{
					$result=ereg("^[0-9]+$",$month,$trashed);
					if(!($result)){
						array_unshift($err, "Enter a Valid Month<br>");
					}
				}
				
				// check year
				$year= substr ($strdate,($pos+4),strlen($strdate));
				$result=ereg("^[0-9]+$",$year,$trashed);
				if(!($result)){
					array_unshift($err, "Enter a Valid year<br>");
				}
				else{
					if(($year < 1900) OR ($year > 2200)){
						array_unshift($err, "Enter a year between 1900-2200<br>");
					}
				}
			}
		}
		
		if (sizeof($err) > 0){
			$hasil = array (
				'err' => $err,
				'valid'=> FALSE
			);
		} else {
			$hasil = array (
				'err' => '',
				'valid'=>TRUE
			);
		}
		 
		return $hasil;
		
	
	}	
	
	function filename_extension($filename) {
		$pos = strrpos($filename, '.');
		if($pos===false) {
			return false;
		} else {
			return strtolower(substr($filename, $pos+1));
		}
	}
	
	function kill_search_session()
	{
		$_this =& get_Instance();
				
		// Load required library
		$_this->load->library('session');	
		$sessdata = array(
			// session name pada controller perusahaan
			'pencarian',
			'skeynama',
			'skeyjenis_usaha',
			'skeypimpinan',
			'skeybdn_usaha',
					
			// session name pada controller tenaga kerja
			'pencarian_tka',
			's_namatka',
			'tkaperusahaan',
			'tkanmperusahaan',
			'tkajabatan',
			'tkapengguna',
			'tkaidnegara',
			'tkanegara',
			'tka_thn_setujui',
					
			// session name pada controller TKIP
			'pencarian_tkip',
			'skeynamatki',
						
			// session name pada controller kontrak
			'pencarian_kk',
			'keyperusahaan',
			'keygalian',
			'keyjnskontrak',
			'keystatus',
			'keyprovinsi',
			
			// session name pada controller sub kontrak
			'keyskperusahaan',
			'pencarian_sk',
			
			// session name pada controller main  method TKA
			'fs_namatka', 
			'fpencarian_tka', 
			'ftkaperusahaan',
			'ftkanmperusahaan',
			'ftkajabatan', 
			'ftkapengguna', 
			'ftkaidnegara',
			'ftkanegara'
		);
		$_this->session->unset_userdata($sessdata);
	}
	
	function kekata($x) {
		$x = abs($x);
		$angka = array("", "satu", "dua", "tiga", "empat", "lima",
		"enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($x <12) {
			$temp = " ". $angka[$x];
		} else if ($x <20) {
			$temp = kekata($x - 10). " belas";
		} else if ($x <100) {
			$temp = kekata($x/10)." puluh". kekata($x % 10);
		} else if ($x <200) {
			$temp = " seratus" . kekata($x - 100);
		} else if ($x <1000) {
			$temp = kekata($x/100) . " ratus" . kekata($x % 100);
		} else if ($x <2000) {
			$temp = " seribu" . kekata($x - 1000);
		} else if ($x <1000000) {
			$temp = kekata($x/1000) . " ribu" . kekata($x % 1000);
		} else if ($x <1000000000) {
			$temp = kekata($x/1000000) . " juta" . kekata($x % 1000000);
		} else if ($x <1000000000000) {
			$temp = kekata($x/1000000000) . " milyar" . kekata(fmod($x,1000000000));
		} else if ($x <1000000000000000) {
			$temp = kekata($x/1000000000000) . " trilyun" . kekata(fmod($x,1000000000000));
		}      
        return $temp;
	}
	
	function terbilang($x, $style=4) {
		if($x<0) {
			$hasil = "minus ". trim(kekata($x));
		} else {
			$hasil = trim(kekata($x));
		}      
		switch ($style) {
			case 1:
				$hasil = strtoupper($hasil);
				break;
			case 2:
				$hasil = strtolower($hasil);
				break;
			case 3:
				$hasil = ucwords($hasil);
				break;
			default:
				$hasil = ucfirst($hasil);
            break;
		}      
		return $hasil;
	}
	
	function tgl_akhir_kab($tgl1,$tgl2)
	{	
		$hari=substr($tgl1,8,2);
		$day=substr($tgl2,8,2); 
		$mnth=substr($tgl2,5,2);
		$year=substr($tgl2,0,4); 
		$yr=(int)($year);
		if($hari=='31'){
			if(((($mnth=='03')&&($day=='03'))||(($mnth=='03')&&($day=='02'))||(($mnth=='03')&&($day=='01')))&&($yr%4==0)){
			$day='29';
			$tgl2= $year."-02-".$day;
			}
			if(((($mnth=='03')&&($day=='03'))||(($mnth=='03')&&($day=='02'))||(($mnth=='03')&&($day=='01')))&&($yr%4!=0)){
				$day='28';
				$tgl2= $year."-02-".$day;
			}
			if (($mnth=='05')&&($day =='01')){
				$day='30';
				$tgl2= $year."-04-".$day;
			}
			if (($mnth=='07')&&($day =='01')){
				$day='30';
				$tgl2= $year."-06-".$day;
			}
			if (($mnth=='10')&&($day =='01')){
				$day='30';
				$tgl2= $year."-09-".$day;
			}
			if (($mnth=='12')&&($day =='01')){
				$day='30';
				$tgl2= $year."-11-".$day;
			}
		}else if($hari=='29' || $hari=='30'){
			if(((($mnth=='03')&&($day=='03'))||(($mnth=='03')&&($day=='02'))||(($mnth=='03')&&($day=='01')))&&($yr%4==0)){
			$day='29';
			$tgl2= $year."-02-".$day;
			}
			if(((($mnth=='03')&&($day=='03'))||(($mnth=='03')&&($day=='02'))||(($mnth=='03')&&($day=='01')))&&($yr%4!=0)){
				$day='28';
				$tgl2= $year."-02-".$day;
			}
		}else{ $tgl2=$tgl2;}
		
		return $tgl2;
	
	}
	
	function print_cetak($html = '', $type = '', $file = 'cetak', $ori = 'P', $style = '', $format = 'A4', $ml = 10, $mr = 10, $mt = 15, $mb = 20, $mh = 5, $mf = 5)
{
	if ($type == 'pdf') {
		$footer = '
			<table width="100%" border="0" style="font-family: Tahoma; vertical-align: top; font-size: 9pt; color: #000; border-color: #000">
			<tr>
			<td width="50%" align="right"><i><small>Hal : {PAGENO}</small><i/></td>
			</tr>
			</table>';
		ini_set("pcre.backtrack_limit", "10000000000000");
		// 'en-x', 'FOLIO' . ($ori != 'P' ? '-' . $ori : ''), '', '', $ml, $mr, $mt, $mb, $mh, $mf
		$mpdf = new \Mpdf\Mpdf(array(
			'mode' => 'utf-8',
			'format' => $format,
			'orientation' => $ori,
			'margin_top' => $mt,
			'margin_left' => $ml,
			'margin_right' => $mr,
			'margin_bottom' => $mb,
			'tempDir' => APPPATH . '../storage'
		));

		$mpdf->SetHTMLFooter($footer);
		$mpdf->WriteHTML($html);
		$mpdf->Output($file . '.pdf', 'I');
	}

	if ($type == 'xls') {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $file . '.xls"');

		echo $html;
	}

	if ($type == 'doc') {
		header('Content-Type: application/vnd.ms-word');
		header('Content-Disposition: attachment;filename="' . $file . '.doc"');

		echo $html;
	}
}
	
?>