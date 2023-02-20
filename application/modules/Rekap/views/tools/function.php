<?php 
function cekmail($email){
  return filter_var( $email, FILTER_VALIDATE_EMAIL );
}
function under($str){
  return str_replace(" ", "_", $str);
}
function nounder($str){
  return str_replace("_", " ", $str);
}
function f150($folder,$foto){
  $filegam= str_replace('file/'.$folder.'/', "", $foto);
  return 'file/'.$folder.'/150_'.$filegam;
}
function f200($folder,$foto){
  $filegam= str_replace('file/'.$folder.'/', "", $foto);
  return 'file/'.$folder.'/200_'.$filegam;
}
function f250($folder,$foto){
  $filegam= str_replace('file/'.$folder.'/', "", $foto);
  return 'file/'.$folder.'/250_'.$filegam;
}
function f350($folder,$foto){
  $filegam= str_replace('file/'.$folder.'/', "", $foto);
  return 'file/'.$folder.'/350_'.$filegam;
}
function f700($folder,$foto){
  $filegam= str_replace('file/'.$folder.'/', "", $foto);
  return 'file/'.$folder.'/700_'.$filegam;
}
function f900($folder,$foto){
  $filegam= str_replace('file/'.$folder.'/', "", $foto);
  return 'file/'.$folder.'/900_'.$filegam;
}
function f1000($folder,$foto){
  $filegam= str_replace('file/'.$folder.'/', "", $foto);
  return 'file/'.$folder.'/1000_'.$filegam;
}
function f1800($folder,$foto){
  $filegam= str_replace('file/'.$folder.'/', "", $foto);
  return 'file/'.$folder.'/1800_'.$filegam;
}
function f1200($folder,$foto){
  $filegam= str_replace('file/'.$folder.'/', "", $foto);
  return 'file/'.$folder.'/1200_'.$filegam;
}
function fotobank($foto){
  if(file_exists($foto)){
    return base_url($foto);
  }
  else{
    return base_url('file/bank/default.jpg');
  }
}
function fotoartikel($foto){
  if(file_exists($foto)){
    return base_url($foto);
  }
  else{
    return base_url('file/artikel/default.jpg');
  }
}
function statust($status){
  if($status=='pending'){
    $sta= '<span class="label label-warning">PENDING</span>';
  }
  else if($status=='selesai'){
    $sta= '<span class="label label-success">SELESAI</span>';
  }
  else{
    $sta= '<span class="label label-default">BLM LUNAS</span>';
  }
  return $sta;
}
function statusspp($status){
  if($status=='lunas'){
    $sta= '<span class="label label-success">LUNAS</span>';
  }
  else{
    $sta= '<span class="label label-default">BLM LUNAS</span>';
  }
  return $sta;
}
function selisih($CheckIn,$CheckOut){
  $CheckInX = explode("-", $CheckIn);
  $CheckOutX =  explode("-", $CheckOut);
  $date1 =  mktime(0, 0, 0, $CheckInX[1],$CheckInX[2],$CheckInX[0]);
  $date2 =  mktime(0, 0, 0, $CheckOutX[1],$CheckOutX[2],$CheckOutX[0]);
  $interval =($date2 - $date1)/(3600*24);
  // returns numberofdays
  if($interval>=0){
    return $interval.' Hari';
  }
  else{
    echo 'Expired';
  }
}
function hitungselisih($CheckIn,$CheckOut){
  $CheckInX = explode("-", $CheckIn);
  $CheckOutX =  explode("-", $CheckOut);
  $date1 =  mktime(0, 0, 0, $CheckInX[1],$CheckInX[2],$CheckInX[0]);
  $date2 =  mktime(0, 0, 0, $CheckOutX[1],$CheckOutX[2],$CheckOutX[0]);
  $interval =($date2 - $date1)/(3600*24);
  // returns numberofdays
  return $interval;
}
function seliesihhari($ex){
  if(date('Y-m-d') > $ex){
    return 'Expired';
  }
  else{
    $awal = date_create(); // waktu sekarang
    $akhir  = date_create($ex);
    $diff  = date_diff( $awal, $akhir );
    // Output: Selisih waktu: 28 tahun, 5 bulan, 9 hari, 13 jam, 7 menit, 7 detik
    return $diff->y . ' tahun,'.$diff->m . ' bulan,'.$diff->d . ' hari';
  }
}
function hitung_umur($tanggal_lahir) {
    list($year,$month,$day) = explode("-",$tanggal_lahir);
    $year_diff  = date("Y") - $year;
    $month_diff = date("m") - $month;
    $day_diff   = date("d") - $day;
    if ($month_diff < 0) $year_diff--;
    elseif (($month_diff==0) && ($day_diff < 0)) $year_diff--;
    return str_replace("-", " ", $year_diff.' Tahun'.$month_diff.' Bulan');
}
function tanpakoma($angka){
  return intval($angka,0);
}
function staperiode($status){
  if($status=='aktif'){
    $sta= '<span class="label label-success" style="text-transform: uppercase;">Aktif</span>';
  }
  else{
    $sta= '<span class="label label-default" style="text-transform: uppercase;">Tidak aktif</span>';
  }
  return $sta;
}
function stareq($status){
  if($status=='selesai'){
    $sta= '<span class="label label-success">SELESAI</span>';
  }
  else if($status=='proses'){
    $sta= '<span class="label label-info">PROSES</span>';
  }
  else{
    $sta= '<span class="label label-warning">PENDING</span>';
  }
  return $sta;
}
function embedyoutube($link){
  return str_replace("https://www.youtube.com/watch?v=","https://www.youtube.com/embed/", $link);
}
function subber($isi){
  return substr($isi, 0,210);
}
function statusgaji($status){
  if($status=='lunas'){
    $sta= '<span class="label label-success" style="text-transform: uppercase;">lunas</span>';
  }
  else{
    $sta= '<span class="label label-danger" style="text-transform: uppercase;">belum dibayar</span>';
  }
  return $sta;
}
function hilangtitik($string){
  $hasil= str_replace(".", "", $string);
  return $hasil;
}
function newcolor($no){
  $color= array(
    "#00B5B8","#f1c40f","#16a085","#2ecc71","#d35400","#3c8dbc","#00c0ef","#00a65a","#f56954","#3498db","#27ae60","#1abc9c","#16a085",
  );
  return $color[$no];
}
//start rumus
function rumus_NA($total_N,$dibagi,$ujian){
  $awal= ($total_N/$dibagi)*0.6;
  $kedua= $ujian*0.4;
  $hasil= $awal+$kedua;
  return number_format($hasil,1);
}
function rumus_N($lp,$la){
  $proseslp= $lp*0.3;
  $prosesla= $la*0.7;
  $pro= $proseslp+$prosesla;
  return $pro;
}
function jumlahseharusnya($jmhs,$ujian_persemester){
  $total= ($jmhs*2*$ujian_persemester)+$jmhs;
  return $total;
}
function jumlahsaatini($jnilailp,$jnilaila,$jnilaiuj){
  $hasil= $jnilailp+$jnilaila+$jnilaiuj;
  return $hasil;
}
function persenya($jumlahseharusnya,$jumlahsaatini){
  if($jumlahseharusnya>0 and $jumlahsaatini>0){
    $pro= (100/$jumlahseharusnya)*$jumlahsaatini;
    if($pro==100){
      return $pro;
    }
    else{
      return number_format($pro,1);
    }
  }
  else{
    return '0';
  }
}
function backpersen($persenya){
  if($persenya>=0 and $persenya<=25.9){$bg='bg-red';}
  else if($persenya>=26 and $persenya<=50.9){$bg='bg-yellow';}
  else if($persenya>=60 and $persenya<=75.9){$bg='bg-info';}
  else if($persenya>=76 and $persenya<=90.9){$bg='bg-blue';}
  else if($persenya>=91 and $persenya<=100){$bg='bg-green';}
  return $bg;
}
//end rumus
function waktu($waktu){
  if($waktu!=null){
    $re= date('H:i',strtotime($waktu));
    return $re;
  }
}
function dmy($dmy){
  if($dmy!=null){
    $re= date('d-m-Y',strtotime($dmy));
    return $re;
  }
}
function ymd($ymd){
  if($ymd!=null){
    $re= date('Y-m-d',strtotime($ymd));
    return $re;
  }
}
function waktulalu($timestamp){
  $selisih= time() - strtotime($timestamp);
  $detik= $selisih;
  $menit= round($selisih/60);
  $jam= round($selisih/3600);
  $hari= round($selisih/86400);
  $minggu= round($selisih/604800);
  $bulan= round($selisih/2419200);
  $tahun= round($selisih/29030400);
  if($detik<=60){
    $waktu= $detik.' detik yang lalu';
  }
  else if($menit<=60){
    $waktu= $menit.' menit yang lalu';
  }
  else if($jam<=24){
    $waktu= $jam.' jam yang lalu';
  }
  else if($hari<=7){
    $waktu= $hari.' hari yang lalu';
  }
  else if($minggu<=4){
    $waktu= $minggu.' minggu yang lalu';
  }
  else if($bulan<=12){
    $waktu= $bulan.' bulan yang lalu';
  }
  else{
    $waktu= $tahun.' tahun yang lalu';
  }
  return $waktu;
}
function isinotifikasi($aksi){
  if($aksi=='baru'){
    $hasil= 'Pengajuan Baru Telah Dibuat';
  }
  else if($aksi=='edit'){
    $hasil= 'Pengajuan Telah Diupdate';
  }
  else if($aksi=='proses'){
    $hasil= 'Pengajuan Anda Telah Diproses';
  }
  else if($aksi=='setuju'){
    $hasil= 'Pengajuan Anda Telah Disetujui';
  }
  else if($aksi=='tolak'){
    $hasil= 'Pengajuan Anda Telah Ditolak';
  }
  return $hasil;
}
function subisi($text,$batas){
  $hasil = substr($text, 0,$batas);
  return $hasil;
}
function random($length){
  //$data='1234567890AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSstuuUvVwWxXyYyZz';
  $data= '123456789123456789123456789123456789';
  $string='';
  for($i=1;$i<=$length;$i++){
    $pos=rand(0,strlen($data)-1);
    $string.=$data{$pos};
  }
  return $string;
}
function randomkar($length){
  $data='1234567890AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSstuuUvVwWxXyYyZz';
  //$data= '123456789123456789123456789123456789';
  $string='';
  for($i=1;$i<=$length;$i++){
    $pos=rand(0,strlen($data)-1);
    $string.=$data{$pos};
  }
  return $string;
}
function ai($data){
  $filternya = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
  return $filternya;
}
function predikat($nilai){
  if($nilai>=90 and $nilai<=100){
    $predikat='A';
  }
  else if($nilai>=80 and $nilai<=89){
    $predikat='B+';
  }
  else if($nilai>=70 and $nilai<=79){
    $predikat='B';
  }
  else if($nilai>=41 and $nilai<=69){
    $predikat='C';
  }
  else if($nilai>0 and $nilai<=40){
    $predikat='D';
  }
  else{$predikat='-';}
  return $predikat;
}
function romawi($n){
  $iromawi = array("","I","II","III","IV","V","VI","VII","VIII","IX","X",20=>"XX",30=>"XXX",40=>"XL",50=>"L",
  60=>"LX",70=>"LXX",80=>"LXXX",90=>"XC",100=>"C",200=>"CC",300=>"CCC",400=>"CD",500=>"D",600=>"DC",700=>"DCC",
  800=>"DCCC",900=>"CM",1000=>"M",2000=>"MM",3000=>"MMM");
  if(array_key_exists($n,$iromawi)){
  $hasil = $iromawi[$n];
  }elseif($n >= 11 && $n <= 99){
  $i = $n % 10;
  $hasil = $iromawi[$n-$i] . Romawi($n % 10);
  }elseif($n >= 101 && $n <= 999){
  $i = $n % 100;
  $hasil = $iromawi[$n-$i] . Romawi($n % 100);
  }else{
  $i = $n % 1000;
  $hasil = $iromawi[$n-$i] . Romawi($n % 1000);
  }
  return $hasil;
}
function rp($str){
  if($str==null){
    return 0;
  }
  else{
    $nomi= round($str);
    $jum = strlen($nomi);
    $jumtitik = ceil($jum/3);
    $balik = strrev($nomi);
    
    $awal = 0;
    $akhir = 3;
    for($x=0;$x<$jumtitik;$x++){
      $a[$x] = substr($balik,$awal,$akhir)."."; 
      $awal+=3;
    }
    $hasil = implode($a);
    $hasilakhir = strrev($hasil);
    $hasilakhir = substr($hasilakhir,1,$jum+$jumtitik);
          
    return "".$hasilakhir."";
  }
}
function tgl($date){  
  if($date!=null){
  $array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus','September','Oktober', 'November','Desember');
  $date = strtotime($date);
  $tanggal = date ('j', $date);
  $bulan = $array_bulan[date('n',$date)];
  $tahun = date('Y',$date); 
  $result = $tanggal ." ". $bulan ." ". $tahun;       
  return($result);  
}
}
function tglwaktu($date){  
  if($date!=null){
  $array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus','September','Oktober', 'November','Desember');
  $date = strtotime($date);
  $tanggal = date ('j', $date);
  $bulan = $array_bulan[date('n',$date)];
  $tahun = date('Y',$date); 
  $waktu = date('H:i',$date);
  $result = $tanggal ." ". $bulan ." ". $tahun.' | '.$waktu;       
  return($result);  
}
}
function dmywaktu($date){  
  if($date!=null){
  $date = strtotime($date);
  $dmy= date('d-m-Y',$date);
  $waktu = date('H:i:s',$date);
  $result = $dmy.' | '.$waktu;       
  return($result);  
}
}
function bulan($bulan){
  if($bulan=='01'){$namabulan="Januari";}
  elseif($bulan=='01'){$namabulan="Januari";}
  elseif($bulan=='02'){$namabulan="Februari";}
  elseif($bulan=='03'){$namabulan="Maret";}
  elseif($bulan=='04'){$namabulan="April";}
  elseif($bulan=='05'){$namabulan="Mei";}
  elseif($bulan=='06'){$namabulan="Juni";}
  elseif($bulan=='07'){$namabulan="Juli";}
  elseif($bulan=='08'){$namabulan="Agustus";}
  elseif($bulan=='09'){$namabulan="September";}
  elseif($bulan=='10'){$namabulan="Oktober";}
  elseif($bulan=='11'){$namabulan="November";}
  elseif($bulan=='12'){$namabulan="Desember";}
  return($namabulan);
}
function hari($hari){
  $daftar_hari = array( 'Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu' );
  $hariini = date('l', strtotime($hari)); 
  return $daftar_hari[$hariini];
}
function h($h){
  if($h=='1'){$hr='Senin';}
  elseif($h=='2'){$hr='Selasa';}
  elseif($h=='3'){$hr='Rabu';}
  elseif($h=='4'){$hr='Kamis';}
  elseif($h=='5'){$hr='Jumat';}
  elseif($h=='6'){$hr='Sabtu';}
  elseif($h=='7'){$hr='Minggu';}
  return $hr;
}
function l($linku){
  $l=substr(md5($linku), 0,9);
  return $l;
}
  function penyebut($nilai) {
    $nilai = abs($nilai);
    $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
    $temp = "";
    if ($nilai < 12) {
      $temp = " ". $huruf[$nilai];
    } else if ($nilai <20) {
      $temp = penyebut($nilai - 10). " Belas";
    } else if ($nilai < 100) {
      $temp = penyebut($nilai/10)." Puluh". penyebut($nilai % 10);
    } else if ($nilai < 200) {
      $temp = " Seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
      $temp = penyebut($nilai/100) . " Ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
      $temp = " Seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
      $temp = penyebut($nilai/1000) . " Ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
      $temp = penyebut($nilai/1000000) . " Juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
      $temp = penyebut($nilai/1000000000) . " Milyar" . penyebut(fmod($nilai,1000000000));
    } else if ($nilai < 1000000000000000) {
      $temp = penyebut($nilai/1000000000000) . " Trilyun" . penyebut(fmod($nilai,1000000000000));
    }     
    return $temp;
  }
 
  function terbilang($nilai) {
    if($nilai<0) {
      $hasil = "minus ". trim(penyebut($nilai));
    } else {
      $hasil = trim(penyebut($nilai));
    }         
    return $hasil.' Rupiah';
  }
  function encode($value){
    $key = sha1('EnCRypT10nK#Y!RiSRNn');
    if(!$value){return false;}
    $strLen = strlen($value);
    $keyLen = strlen($key);
    $j=0;
    $crypttext= '';
    for ($i = 0; $i < $strLen; $i++) {
    $ordStr = ord(substr($value,$i,1));
    if ($j == $keyLen) { $j = 0; }
    $ordKey = ord(substr($key,$j,1));
    $j++;
    $crypttext .= strrev(base_convert(dechex($ordStr + $ordKey),16,36));
    }
    return $crypttext;
  }

  function decode($value){
    if(!$value){return false;}
        $key = sha1('EnCRypT10nK#Y!RiSRNn');
        $strLen = strlen($value);
        $keyLen = strlen($key);
        $j=0;
        $decrypttext= '';
        for ($i = 0; $i < $strLen; $i+=2) {
            $ordStr = hexdec(base_convert(strrev(substr($value,$i,2)),36,16));
            if ($j == $keyLen) { $j = 0; }
            $ordKey = ord(substr($key,$j,1));
            $j++;
            $decrypttext .= chr($ordStr - $ordKey);
        }

    return $decrypttext;
  }
?>