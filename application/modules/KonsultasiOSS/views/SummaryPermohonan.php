<div class="portlet light bordered margin-top-20">

	<div class="row static-info">
		<div class="col-md-3 name">
			Nama Lengkap Pemilik
		</div>
		<div class="col-md-8 value">:
			<?= (isset($DataPemilik->glr_depan) ? $DataPemilik->glr_depan : ''); ?>
			<?= (isset($DataPemilik->nm_pemilik) ? $DataPemilik->nm_pemilik : ''); ?>
			<?= (isset($DataPemilik->glr_belakang) ? $DataPemilik->glr_belakang : ''); ?>
		</div>
	</div>
	<div class="row static-info">
		<div class="col-md-3 name">
			No. Indentitas Pemilik
		</div>
		<div class="col-md-8 value">:
			<?= (isset($DataPemilik->no_ktp) ? $DataPemilik->no_ktp : ''); ?>
		</div>
	</div>
	<div class="row static-info">
		<div class="col-md-3 name">
			Alamat Pemilik Bangunan
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
	
	<div class="row static-info">
		<div class="col-md-3 name">
			Alamat Bangunan Gedung
		</div>
		<div class="col-md-8 value">:
			<?= (isset($DataBangunan->almt_bgn) ? $DataBangunan->almt_bgn : ''); ?>
			<?php if (isset($daftar_kabkota)) {
				if ($daftar_kecamatan->num_rows() > 0) {
					foreach ($daftar_kecamatan->result() as $key) {
						if ($key->id_kecamatan == $DataBangunan->id_kec_bgn) {
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
						if ($key->id_kabkot == $DataBangunan->id_kabkot_bgn) {
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
					if ($key->id_provinsi == $DataBangunan->id_prov_bgn) {
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
			Jenis Permohonan
		</div>
		<div class="col-md-8 value">:
			<?php
			$list_izin = array(
				"1" => "Persetujuan Bangunan Gedung",
				"2" => "Bangunan Gedung Existing Belum Ber-IMB",
				"3" => "Bangunan Gedung Perubahan",
				"4" => "Bangunan Gedung Kolektif",
				"5" => "Bangunan Gedung Prasarana",
				"6" => "Bangunan Gudang 1300 Meter Persegi"
			);
			foreach ($list_izin as $key => $val) {
				if ($key == $DataBangunan->id_izin) {
					$jenis = $val;
					break;
				} else {
					$jenis = "";
				}
			}
			echo $jenis;
			?>
		</div>
	</div>
	
	<div class="row static-info">
			<div class="col-md-3 name">
				Fungsi Bangunan
			</div>
			<div class="col-md-8 value">:
				<?php
				$queFungsi = $this->Mkonsultasi->get_jenis_fungsi_list($DataBangunan->id_fungsi_bg)->row_array();
				echo $queFungsi['fungsi_bg'];
				?>
			</div>
		</div>

</div>