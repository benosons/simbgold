
<div class="col-md-12">
		
			
			<!--div style="display: none;">
			<h5 class="caption-subject font-red bold uppercase">Data Pemohon</h5>
			
			<div class="row static-info">
				<div class="col-md-4 name">
					Nama Pemohon	:
				</div>
				<div class="col-md-8 value">
					<?=(isset($nama) ? $nama : '');?>
				</div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">
					Nomor Identitas	:
				</div>
				<div class="col-md-8 value">
					<?=(isset($jalan) ? $jalan : '');?>, Kec. <?=(isset($nama_kec) ? $nama_kec : '');?>,<br> <?=(isset($nama_kabkota) ? $nama_kabkota : '');?>, <?=(isset($nama_provinsi) ? $nama_provinsi : '') ;?>
				</div>
			</div>
			<br>
			</div-->
			
			<h5 class="caption-subject font-red bold uppercase">Data Lengkap Pemilik</h5>
			
			<div class="row static-info">
				<div class="col-md-4 name">
					Nama Pemilik	:
				</div>
				<div class="col-md-8 value">
					<?=(isset($nama) ? $nama : '');?>
				</div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">
					Alamat Pemilik	:
				</div>
				<div class="col-md-8 value">
					<?=(isset($jalan) ? $jalan : '');?>, Kec. <?=(isset($nama_kec) ? $nama_kec : '');?>,<br> <?=(isset($nama_kabkota) ? $nama_kabkota : '');?>, <?=(isset($nama_provinsi) ? $nama_provinsi : '') ;?>
				</div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">
					Nomor Telp / Hp	:
				</div>
				<div class="col-md-8 value">
					<?=(isset($no_tlpn) ? $no_tlpn : '');?>
				</div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">
					Alamat Email	:
				</div>
				<div class="col-md-8 value">
					<p class="font-red"><i><?=(isset($email) ? $email : '');?></i></p>
				</div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">
					Nomor Identitas	:
				</div>
				<div class="col-md-8 value">
					<?=(isset($ktp) ? $ktp : '');?>
				</div>
			</div>
			
			
					
			<div class="row static-info">
				<div class="col-md-4 name">
					Kepemilikan	:
				</div>
				<div class="col-md-8 value">
					<?=(isset($usaha) ? $usaha : '');?>
				</div>
			</div>
					<? if (isset($usaha2) != null){?>
					
					
					<?}else{?>
					
					<?}?>
			<br>
			<h5 class="caption-subject font-red bold uppercase">Data Umum Bangunan Gedung</h5>
			<div class="row static-info">
				<div class="col-md-4 name">
					Jenis Permohonan	:
				</div>
				<div class="col-md-8 value">
					<?=(isset($nama_permohonan) ? $nama_permohonan : '')?>
				</div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">
					Nama Bangunan	:
				</div>
				<div class="col-md-8 value">
					<?=(isset($nama_bangunan) ? $nama_bangunan : '')?>
				</div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">
					Klasifikasi Bangunan Gedung	:
				</div>
				<div class="col-md-8 value">
					<?php echo set_value('klasifikasi_bg', (isset($klasifikasi_bg) ? $klasifikasi_bg : ''))?>
				</div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">
					Lokasi Bangunan Gedung	:
				</div>
				<div class="col-md-8 value">
					<?=(isset($jalan_lokasi)? $jalan_lokasi : '') ;?>, Kec. <?=(isset($nama_kecamatan_bg) ? $nama_kecamatan_bg : '');?>,<br> <?=(isset($nama_kabkota_bg) ? $nama_kabkota_bg : '');?>, <?=(isset($nama_provinsi_bg) ? $nama_provinsi_bg : '') ;?>
				</div>
			</div>
			<?
				if($id_prasarana_bg == 1){
					$prasarana = "Kontruksi Pembatas/Penahan/Pengaman";
				}elseif ($id_prasarana_bg == 2){
					$prasarana = "Konstruksi Penanda Masuk Lokasi";
				}elseif($id_prasarana_bg == 3){
					$prasarana = "Kontruksi Perkerasan";
				}elseif($id_prasarana_bg == 4){
					$prasarana = "Kontruksi Penghubung";
				}elseif($id_prasarana_bg == 5){
					$prasarana = "Kontruksi Kolam/Reservoir bawah tanah";
				}elseif ($id_prasarana_bg == 6){
					$prasarana = "Kontruksi Menara";
				}elseif ($id_prasarana_bg== 7){
					$prasarana = "Kontruksi Monumen";
				}elseif ($id_prasarana_bg == 8){
					$prasarana = "Kontruksi Instalasi/gardu";
				}elseif ($id_prasarana_bg == 9){
					$prasarana = "Kontruksi Reklame / Papan Nama";
				}else{
					$prasarana = "Belum ditentukan";
				}
			?>
			<? if(trim($tsarana) == 5){?>
			
			<div class="row static-info">
				<div class="col-md-4 name">
					Prasarana	:
				</div>
				<div class="col-md-8 value">
					<?php echo set_value('prasarana', (isset($prasarana) ? $prasarana : ''))?>
				</div>
			</div>
			
			<div class="row static-info">
				<div class="col-md-4 name">
					Luas Bangunan Prasarana	:
				</div>
				<div class="col-md-8 value">
					<?php echo set_value('luas_prasarana', (isset($luas_prasarana) ? $luas_prasarana : ''))?> M<sup>2</sup>
				</div>
			</div>
			
			<div class="row static-info">
				<div class="col-md-4 name">
					Tinggi Bangunan Prasarana	:
				</div>
				<div class="col-md-8 value">
					<?php echo set_value('tinggi_prasarana', (isset($tinggi_prasarana) ? $tinggi_prasarana : ''))?> Meter
				</div>
			</div>
			
			<?}else{?>
				<? if(trim($id_kolektif) == 1){?>
				<div class="row static-info">
				<div class="col-md-4 name">
					Tipe Bangunan :
				</div>
				<div class="col-md-8 value">
					<?php echo set_value('tipeA', (isset($tipeA) ? $tipeA : ''))?> || <?php echo set_value('tipeB', (isset($tipeB) ? $tipeB : ''))?> || <?php echo set_value('tipeC', (isset($tipeC) ? $tipeC : ''))?> || <?php echo set_value('tipeD', (isset($tipeD) ? $tipeD : ''))?>
				</div>
				</div>
				
				<div class="row static-info">
				<div class="col-md-4 name">
					Jumlah Unit :
				</div>
				<div class="col-md-8 value">
					<?php echo set_value('unitA', (isset($unitA) ? $unitA : ''))?> || <?php echo set_value('unitB', (isset($unitB) ? $unitB : ''))?> || <?php echo set_value('unitC', (isset($unitC) ? $unitC : ''))?> || <?php echo set_value('unitD', (isset($unitD) ? $unitD : ''))?>
				</div>
				</div>
				
				<div class="row static-info" style="display: none;">
				<div class="col-md-4 name">
					Luas Bangunan :
				</div>
				<div class="col-md-8 value">
					<?php echo set_value('luasA', (isset($luasA) ? $luasA : ''))?> M<sup>2</sup> || <?php echo set_value('luasB', (isset($luasB) ? $luasB : ''))?> M<sup>2</sup> || <?php echo set_value('luasC', (isset($luasC) ? $luasC : ''))?> M<sup>2</sup> || <?php echo set_value('luasD', (isset($luasD) ? $luasD : ''))?> M<sup>2</sup>
				</div>
				</div>
				
				<div class="row static-info">
				<div class="col-md-4 name">
					Tinggi Bangunan :
				</div>
				<div class="col-md-8 value">
					<?php echo set_value('tinggiA', (isset($tinggiA) ? $tinggiA : ''))?> Meter || <?php echo set_value('tinggiB', (isset($tinggiB) ? $tinggiB : ''))?> Meter || <?php echo set_value('tinggiC', (isset($tinggiC) ? $tinggiC : ''))?> Meter || <?php echo set_value('tinggiD', (isset($tinggiD) ? $tinggiD : ''))?> Meter
				</div>
				</div>
				
				<?}else{?>
			<div class="row static-info">
				<div class="col-md-4 name">
					Fungsi Bangunan Gedung	:
				</div>
				<div class="col-md-8 value">
					<?php echo set_value('fungsi_bg', (isset($fungsi_bg) ? $fungsi_bg : ''))?> - <?php echo set_value('jns_bangunan', (isset($jns_bangunan) ? $jns_bangunan : ''))?>
				</div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">
					Luas Bangunan Gedung	:
				</div>
				<div class="col-md-8 value">
					<?php echo set_value('luas_bg', (isset($luas_bg) ? $luas_bg : ''))?> M<sup>2</sup>
				</div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">
					Ketinggian Bangunan Gedung	:
				</div>
				<div class="col-md-8 value">
					<?php echo set_value('tinggi_bg', (isset($tinggi_bg) ? $tinggi_bg : ''))?> Meter
				</div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">
					Jumlah Lantai Bangunan Gedung	:
				</div>
				<div class="col-md-8 value">
					<?php echo set_value('lantai_bg', (isset($lantai_bg) ? $lantai_bg : ''))?> Lantai
				</div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">
					Luas Basement	:
				</div>
				<div class="col-md-8 value">
					<?php echo set_value('luas_basement', (isset($luas_basement) ? $luas_basement : ''))?> 
				</div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">
					Jumlah Lantai Basement	:
				</div>
				<div class="col-md-8 value">
					<?php echo set_value('lantai_basement', (isset($lapis_basement) ? $lapis_basement : ''))?> 
				</div>
			</div>
				<?}?>
			<?}?>
</div>
