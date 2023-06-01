<div class="portlet light bordered margin-top-20">
	<div class="portlet-title margin-top-10">
		<div class="page-title" align="center">
			<span class="caption font-blue-hoki bold" style="font-size: 22px;"> Data Bangunan</span>
		</div>
	</div>

	<dv class="row static-info">
		<div class="col-md-3 name">
			Alamat
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
				"1" => "Perizinan Bangunan Gedung",
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
	<?php
	if ($DataBangunan->id_izin == 4 && $DataBangunan->id_kolektif == 1) {
	?>
		<div class="row static-info">
			<div class="col-md-3 name">
				Tipe Permohonan Kolektif
			</div>
			<div class="col-md-8 value">:
				<?php
				$list_kolektif = array(
					"" => "",
					"1" => "Induk",
					"2" => "Tunggal/Pemisahan"
				);
				foreach ($list_kolektif as $key => $val) {
					if ($key == $DataBangunan->id_kolektif) {
						$kolektif = $val;
						break;
					} else {
						$kolektif = "";
					}
				}
				echo $kolektif;
				?>
			</div>
		</div>
		<div class="row static-info">
			<div class="col-md-3 name">
				Tipe Bangunan
			</div>
			<div class="col-md-8 value">:

				<?php
				$tipe = json_decode($DataBangunan->tipeA);
				if ($DataBangunan->tipeA != '') {
					$prefix = $tipex = '';
					foreach ($tipe as $noo => $val) {
						$tipex .= $prefix . ' ' . $val;
						$prefix = ', ';
					}
					echo $tipex;
				} else {
				} ?>
			</div>
		</div>
		<div class="row static-info">
			<div class="col-md-3 name">
				Jumlah Unit
			</div>
			<div class="col-md-8 value">:

				<?php
				$unit = json_decode($DataBangunan->unitA);
				if ($DataBangunan->unitA != '') {
					$prefix = $unitx = '';
					foreach ($unit as $noo => $val) {
						$unitx .= $prefix . ' ' . $val;
						$prefix = ', ';
					}
					echo $unitx;
				} else {
				} ?>
			</div>
		</div>
		<div class="row static-info">
			<div class="col-md-3 name">
				Tinggi Bangunan
			</div>
			<div class="col-md-8 value">:

				<?php
				$tinggi = json_decode($DataBangunan->tinggiA);
				if ($DataBangunan->tinggiA != '') {
					$prefix = $tinggix = '';
					foreach ($tinggi as $noo => $val) {
						$tinggix .= $prefix . ' ' . $val;
						$prefix = ', ';
					}
					echo $tinggix;
				} else {
				} ?>
			</div>
		</div>
		<?php
	} else {
		if ($DataBangunan->id_izin == 4) {
		?>
			<div class="row static-info">
				<div class="col-md-3 name">
					Tipe Permohonan Kolektif
				</div>
				<div class="col-md-8 value">:
					<?php
					$list_kolektif = array(
						"" => "",
						"1" => "Induk",
						"2" => "Tunggal/Pemisahan"
					);
					foreach ($list_kolektif as $key => $val) {
						if ($key == $DataBangunan->id_kolektif) {
							$kolektif = $val;
							break;
						} else {
							$kolektif = "";
						}
					}
					echo $kolektif;
					?>
				</div>
			</div>
		<?php } ?>

		<div class="row static-info">
			<div class="col-md-3 name">
				Fungsi Bangunan
			</div>
			<div class="col-md-8 value">:
				<?php
				$queFungsi = $this->mkonsultasi->get_jenis_fungsi_list($DataBangunan->id_fungsi_bg)->row_array();
				echo $queFungsi['fungsi_bg'];
				?>
			</div>
		</div>

		<div class="row static-info">
			<div class="col-md-3 name">
				Jenis Bangunan
			</div>
			<div class="col-md-8 value">:
				<?php

				echo '';
				?>
			</div>
		</div>

		<div class="row static-info">
			<div class="col-md-3 name">
				Nama Bangunan
			</div>
			<div class="col-md-8 value">:
				<?= (isset($DataBangunan->nm_bgn) ? $DataBangunan->nm_bgn : ''); ?>
			</div>
		</div>
		<div class="row static-info">
			<div class="col-md-3 name">
				Luas Bangunan
			</div>
			<div class="col-md-8 value">:
				<?= (isset($DataBangunan->luas_bgn) ? $DataBangunan->luas_bgn : ''); ?>
			</div>
		</div>
		<div class="row static-info">
			<div class="col-md-3 name">
				Tinggi Bangunan
			</div>
			<div class="col-md-8 value">:
				<?= (isset($DataBangunan->tinggi_bgn) ? $DataBangunan->tinggi_bgn : ''); ?>
			</div>
		</div>
		<div class="row static-info">
			<div class="col-md-3 name">
				Jumlah Lantai Bangunan
			</div>
			<div class="col-md-8 value">:
				<?= (isset($DataBangunan->jml_lantai) ? $DataBangunan->jml_lantai : ''); ?>
			</div>
		</div>
		<div class="row static-info">
			<div class="col-md-3 name">
				Luas Basement Bangunan
			</div>
			<div class="col-md-8 value">:
				<?= (isset($DataBangunan->luas_basement) ? $DataBangunan->luas_basement : ''); ?>
			</div>
		</div>
		<div class="row static-info">
			<div class="col-md-3 name">
				Jumlah Lantai Basement Bangunan
			</div>
			<div class="col-md-8 value">:
				<?= (isset($DataBangunan->lapis_basement) ? $DataBangunan->lapis_basement : ''); ?>
			</div>
		</div>

	<?php } ?>


</div>