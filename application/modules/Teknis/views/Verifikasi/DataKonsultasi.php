<div class="col-md-12">
	<h5 class="caption-subject font-red bold uppercase">Data Lengkap Pemilik</h5>
	<div class="row static-info">
		<div class="col-md-4 name">Nama Pemilik</div>
		<div class="col-md-8 value"><?php echo $data->nm_pemilik; ?></div>
	</div>
	<div class="row static-info">
		<div class="col-md-4 name">Alamat Pemilik Bangunan</div>
		<div class="col-md-8 value">
			<?php echo $data->alamat; ?>, Kec. <?php echo $data->nama_kecamatan; ?>, <?php echo ucwords(strtolower($data->nama_kabkota)); ?>, Prov. <?php echo $data->nama_provinsi; ?>
		</div>
	</div>
	<div class="row static-info">
		<div class="col-md-4 name">Nomor Telp / Hp</div>
		<div class="col-md-8 value"><?php echo $data->no_hp; ?></div>
	</div>
	<div class="row static-info">
		<div class="col-md-4 name">Alamat Email</div>
		<div class="col-md-8 value"><?php echo $data->email; ?></div>
	</div>
	<div class="row static-info">
		<div class="col-md-4 name">No. Identitas</div>
		<div class="col-md-8 value"><?php echo $data->no_ktp; ?></div>
	</div>
	<div class="row static-info">
		<div class="col-md-4 name">Bentuk Kepemilikan</div>
		<div class="col-md-8 value"><?php echo $data->nm_pemilik; ?></div>
	</div>
	<br>
	<h5 class="caption-subject font-red bold uppercase">Data Umum Bangunan Gedung</h5>
	<div class="row static-info">
		<div class="col-md-4 name">Jenis Permohonan Konsultasi</div>
		<div class="col-md-8 value"><?php echo $Bangunan->nm_konsultasi; ?></div>
	</div>
	<div class="row static-info">
		<div class="col-md-4 name">Nama Bangunan Gedung</div>
		<div class="col-md-8 value"><?php echo $Bangunan->nm_bgn; ?></div>
	</div>
	<div class="row static-info">
		<div class="col-md-4 name">Klasifikasi Bangunan Gedung</div>
		<div class="col-md-8 value">Tidak Sederhana</div>
	</div>
	<div class="row static-info">
		<div class="col-md-4 name">Lokasi Bangunan Gedung</div>
		<div class="col-md-8 value">
			<?= (isset($Bangunan->almt_bgn) ? $Bangunan->almt_bgn : ''); ?>, Kel. <?= (isset($Bangunan->nama_kelurahan) ? $Bangunan->nama_kelurahan : ''); ?>, Kec. <?= (isset($bangunan->nama_kecamatan) ? $bangunan->nama_kecamatan : ''); ?>,
			<?= (isset($Bangunan->nama_kabkota) ? $Bangunan->nama_kabkota : ''); ?>, Prov. <?= (isset($Bangunan->nama_provinsi) ? $Bangunan->nama_provinsi : ''); ?>
		</div>
	</div>
	<div class="row static-info">
		<div class="col-md-4 name">Fungsi Bangunan Gedung</div>
		<div class="col-md-8 value">
			<?php $queFungsi = $this->Mteknis->get_jenis_fungsi_list($data->id_fungsi_bg)->row();
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
