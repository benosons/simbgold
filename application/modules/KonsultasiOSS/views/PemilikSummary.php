<div class="portlet light bordered margin-top-20">
	<div class="portlet-title margin-top-10">
		<div class="page-title" align="center">
			<span class="caption font-blue-hoki bold" style="font-size: 22px;"> Data Pemilik</span>
		</div>
	</div>
	<div class="row static-info">
		<div class="col-md-3 name">
			Nama Lengkap
		</div>
		<div class="col-md-8 value">:
			<?= (isset($DataPemilik->glr_depan) ? $DataPemilik->glr_depan : ''); ?>
			<?= (isset($DataPemilik->nm_pemilik) ? $DataPemilik->nm_pemilik : ''); ?>
			<?= (isset($DataPemilik->glr_belakang) ? $DataPemilik->glr_belakang : ''); ?>
		</div>
	</div>
	<div class="row static-info">
		<div class="col-md-3 name">
			Nomor Indentitas
		</div>
		<div class="col-md-8 value">:
			<?= (isset($DataPemilik->no_ktp) ? $DataPemilik->no_ktp : ''); ?>
		</div>
	</div>
	<div class="row static-info">
		<div class="col-md-3 name">
			Alamat
		</div>
		<div class="col-md-8 value">:
			<?= (isset($DataPemilik->alamat) ? $DataPemilik->alamat : ''); ?>
			<?php if (isset($daftar_kabkota)) {
				if ($daftar_kecamatan->num_rows() > 0) {
					foreach ($daftar_kecamatan->result() as $key) {
						if ($key->id_kecamatan == $DataPemilik->id_kecamatan) {
							$kec = $key->nama_kecamatan;
							break;
						} else {
							$kec = "";
						}
					}
				}
			}
			echo 'Kec. ' . $kec . ', '; ?>
			<?php if (isset($daftar_kabkota)) {
				if ($daftar_kabkota->num_rows() > 0) {
					foreach ($daftar_kabkota->result() as $key) {
						if ($key->id_kabkot == $DataPemilik->id_kabkota) {
							$kot = $key->nama_kabkota;
							break;
						} else {
							$kot = "";
						}
					}
				}
			}
			echo $kot . ', '; ?>
			<?php if ($daftar_provinsi->num_rows() > 0) {
				foreach ($daftar_provinsi->result() as $key) {
					if ($key->id_provinsi == $DataPemilik->id_provinsi) {
						$prov = $key->nama_provinsi;
						break;
					} else {
						$prov = "";
					}
				}
			}
			echo 'Prov. ' . $prov; ?>
		</div>
	</div>
	<div class="row static-info">
		<div class="col-md-3 name">
			Nomor Telepon
		</div>
		<div class="col-md-8 value">:
			<?= (isset($DataPemilik->no_hp) ? $DataPemilik->no_hp : ''); ?>
		</div>
	</div>
	<div class="row static-info">
		<div class="col-md-3 name">
			Email
		</div>
		<div class="col-md-8 value">:
			<?= (isset($DataPemilik->email) ? $DataPemilik->email : ''); ?>
		</div>
	</div>

</div>