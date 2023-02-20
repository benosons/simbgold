<div class="col-md-12">
	<h5 class="caption-subject font-red bold uppercase">Data Lengkap Pemilik</h5>
	<div class="row static-info">
		<div class="col-md-4 name">Nama Pemilik</div>
		<div class="col-md-8 value">
			<?php echo $data->nm_pemilik; ?>
		</div>
	</div>
	<div class="row static-info">
		<div class="col-md-4 name">Alamat Pemilik Bangunan</div>
		<div class="col-md-8 value">
			<?php echo $data->alamat; ?>, Kec. <?php echo $data->nama_kecamatan; ?>, <?php echo ucwords(strtolower($data->nama_kabkota)); ?>, Prov. <?php echo $data->nama_provinsi; ?>
		</div>
	</div>
	<div class="row static-info">
		<div class="col-md-4 name">Nomor Telp / Hp</div>
		<div class="col-md-8 value">
			<?php echo $data->no_hp; ?>
		</div>
	</div>
	<div class="row static-info">
		<div class="col-md-4 name">Alamat Email</div>
		<div class="col-md-8 value">
			<?php echo $data->email; ?>
		</div>
	</div>
	<div class="row static-info">
		<div class="col-md-4 name">Nomor Identitas</div>
		<div class="col-md-8 value">
			<?php echo $data->no_ktp; ?>
		</div>
	</div>
	<div class="row static-info">
		<div class="col-md-4 name">Bentuk Kepemilikan</div>
		<div class="col-md-8 value">
			<?php echo $data->nm_pemilik; ?>
		</div>
	</div>
	<br>
	<h5 class="caption-subject font-red bold uppercase">Data Umum Bangunan Gedung</h5>
	<div class="row static-info">
		<div class="col-md-4 name">Jenis Permohonan Konsultasi</div>
		<div class="col-md-8 value">
			Rumah Tinggal Bangunan Sederhana 1 Lantai
		</div>
	</div>
	<div class="row static-info">
		<div class="col-md-4 name">Nama Bangunan Gedung</div>
		<div class="col-md-8 value">
			Rumah Tinggal Pribadi
		</div>
	</div>
	<div class="row static-info">
		<div class="col-md-4 name">Klasifikasi Bangunan Gedung</div>
		<div class="col-md-8 value">
			Sederhana
		</div>
	</div>
	<div class="row static-info">
		<div class="col-md-4 name">Lokasi Bangunan Gedung</div>
		<div class="col-md-8 value">
			Kp. Babakan Mekar Rt. 05/Rw. 18 No. 56 Desa Bojong Koneng, Kec. Ngamprah, Kab Bandung Barat, Prov. Jawa Barat </div>
	</div>
	<?
				if(isset($id_prasarana_bg) ==1){
					$prasarana = "Kolam/Reservoir bawah tanah";
				}elseif (isset($id_prasarana_bg) ==2){
					$prasarana = "Menara";
				}elseif(isset($id_prasarana_bg) ==3){
					$prasarana = "Monument";
				}elseif(isset($id_prasarana_bg) ==4){
					$prasarana = "Instalasi/Gardu";
				}elseif(isset($id_prasarana_bg) ==5){
					$prasarana = "Reklame/Papan Nama";
				}else{
					$prasarana = "Bangunan Prasarana";
				}		
			?>
	<div class="row static-info">
		<div class="col-md-4 name">Fungsi Bangunan Gedung</div>
		<div class="col-md-8 value">
			<?php $queFungsi = $this->Mpengawas->get_jenis_fungsi_list($data->id_fungsi_bg)->row();
			echo $queFungsi->fungsi_bg; ?>
		</div>
	</div>
	<div class="row static-info">
		<div class="col-md-4 name">Luas Bangunan Gedung</div>
		<div class="col-md-8 value">
			<?php echo $data->luas_bgn; ?> m<sup>2</sup>
		</div>
	</div>
	<div class="row static-info">
		<div class="col-md-4 name">Ketinggian Bangunan Gedung</div>
		<div class="col-md-8 value">
			<?php echo $data->tinggi_bgn; ?> Meter
		</div>
	</div>
	<div class="row static-info">
		<div class="col-md-4 name">Jumlah Lantai Bangunan Gedung</div>
		<div class="col-md-8 value">
			<?php echo $data->jml_lantai; ?> Lantai
		</div>
	</div>
	<div class="row static-info">
		<div class="col-md-4 name">Luas Basement</div>
		<div class="col-md-8 value">
			<?php echo $data->luas_basement; ?> - m<sup>2</sup>
		</div>
	</div>
	<div class="row static-info">
		<div class="col-md-4 name">Jumlah Lantai Basement</div>
		<div class="col-md-8 value">
			<?php echo $data->lapis_basement; ?> - Lantai
		</div>
	</div>
	<div class="row static-info">
		<div class="col-md-4 name">Perancang Dokumen Teknis</div>
		<div class="col-md-8 value">
			Perencana Kontruksi
		</div>
	</div>
</div>
