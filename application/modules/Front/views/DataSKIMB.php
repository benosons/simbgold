			<h5 class="caption-subject font-red bold uppercase">Data Lengkap Pemilik</h5>
			<div class="row static-info">
				<div class="col-md-4 name">
					Nomor Izin Mendirikan Bangunan
				</div>
				<div class="col-md-8 value">
					<?= (isset($no_imb) ? $no_imb : ''); ?>
				</div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">
					Nama Pemilik
				</div>
				<div class="col-md-8 value">
					<?= (isset($nama_pemohon) ? $nama_pemohon : ''); ?>
				</div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">
					Alamat Pemilik
				</div>
				<div class="col-md-8 value">
					<?= (isset($alamat_pemohon) ? $alamat_pemohon : ''); ?>,
					Kec. <?= (isset($nama_kecamatan) ? $nama_kecamatan : ''); ?>,
					<?= (isset($nama_kabkota) ? $nama_kabkota : ''); ?>,
					<?= (isset($nama_provinsi) ? $nama_provinsi : ''); ?>
				</div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">
					Nomor Telp / Hp
				</div>
				<div class="col-md-8 value">
					<?= (isset($no_tlp) ? $no_tlp : ''); ?>
				</div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">
					Alamat Email
				</div>
				<div class="col-md-8 value">
					<p class="font-red"><i><?= (isset($email) ? $email : ''); ?></i></p>
				</div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">
					Nomor Identitas
				</div>
				<div class="col-md-8 value">
					<?= (isset($no_ktp) ? $no_ktp : ''); ?>
				</div>
			</div>

			<div class="row static-info">
				<div class="col-md-4 name">
					Kepemilikan
				</div>
				<div class="col-md-8 value">
					<?= (isset($usaha) ? $usaha : ''); ?>
				</div>
			</div>
			<?php if (isset($usaha2) != null) { ?>

				<div class="row static-info">
					<div class="col-md-4 name">
						Nama Perusahaan/Pemerintah
					</div>
					<div class="col-md-8 value">
						<?= (isset($nm_pershn) ? $nm_pershn : ''); ?>
					</div>
				</div>

				<div class="row static-info">
					<div class="col-md-4 name">
						Jabatan dalam Perusahaan/ Pemerintah
					</div>
					<div class="col-md-8 value">
						<?= (isset($jabdpershn) ? $jabdpershn : ''); ?>
					</div>
				</div>

				<div class="row static-info">
					<div class="col-md-4 name">
						Alamat Perusahaan/ Pemerintah
					</div>
					<div class="col-md-8 value">
						<?= (isset($alamat_pershn) ? $alamat_pershn : ''); ?>
					</div>
				</div>

			<?php } else { ?>

			<?php } ?>
			<br>
			<h5 class="caption-subject font-red bold uppercase">Data Umum Bangunan Gedung</h5>
			<div class="row static-info">
				<div class="col-md-4 name">
					Jenis Permohonan
				</div>
				<div class="col-md-8 value">
					<?= (isset($nama_permohonan) ? $nama_permohonan : '') ?>
				</div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">
					Lokasi Bangunan Gedung
				</div>
				<div class="col-md-8 value">
					<?= (isset($alamat_bg) ? $alamat_bg : ''); ?>, Des/Kel. <?= (isset($kelurahan) ? $kelurahan : ''); ?> Kec. <?= (isset($nama_kecamatan) ? $nama_kecamatan : ''); ?>,
					<br> <?= (isset($nama_kabkota_bg) ? $nama_kabkota_bg : ''); ?>, Prov. <?= (isset($nama_provinsi_bg) ? $nama_provinsi_bg : ''); ?>
				</div>
			</div>
			<?php
			if (isset($id_prasarana_bg) == 1) {
				$prasarana = "Kolam/Reservoir bawah tanah";
			} elseif (isset($id_prasarana_bg) == 2) {
				$prasarana = "Menara";
			} elseif (isset($id_prasarana_bg) == 3) {
				$prasarana = "Monument";
			} elseif (isset($id_prasarana_bg) == 4) {
				$prasarana = "Instalasi/Gardu";
			} elseif (isset($id_prasarana_bg) == 5) {
				$prasarana = "Reklame/Papan Nama";
			}
			?>

			<?php if (isset($sarana) == 5) { ?>

				<div class="row static-info">
					<div class="col-md-4 name">
						Fungsi Bangunan Gedung
					</div>
					<div class="col-md-8 value">
						<?php echo set_value('prasarana', (isset($$prasarana) ? $prasarana : '')) ?>
					</div>
				</div>
			<?php } else { ?>
				<div class="row static-info">
					<div class="col-md-4 name">
						Fungsi Bangunan Gedung :
					</div>
					<div class="col-md-8 value">
						<?php echo set_value('fungsi_bg', (isset($fungsi_bg) ? $fungsi_bg : '')) ?> - <?php echo set_value('jns_bangunan', (isset($jns_bangunan) ? $jns_bangunan : '')) ?>
					</div>
				</div>
			<?php } ?>
			<div class="row static-info">
				<div class="col-md-4 name">
					Luas Bangunan Gedung :
				</div>
				<div class="col-md-8 value">
					<?= (isset($luas_bg) ? $luas_bg : '') ?> M<sup>2</sup>
				</div>
			</div>
			<?php if (isset($tsarana) == 5) { ?>

				<div class="row static-info">
					<div class="col-md-4 name">
						Tinggi Bangunan Prasarana :
					</div>
					<div class="col-md-8 value">
						<?php echo set_value('tinggi_prasarana', (isset($tinggi_prasarana) ? $tinggi_prasarana : '')) ?> Meter
					</div>
				</div>
			<?php } else { ?>

				<div class="row static-info">
					<div class="col-md-4 name">
						Jumlah Lantai Bangunan Gedung :
					</div>
					<div class="col-md-8 value">
						<?php echo set_value('lantai_bg', (isset($lantai_bg) ? $lantai_bg : '')) ?> Lantai
					</div>
				</div>
				<div class="row static-info">
					<div class="col-md-4 name">
						Ketinggian Bangunan Gedung :
					</div>
					<div class="col-md-8 value">
						<?php echo set_value('tinggi_bg', (isset($tinggi_bg) ? $tinggi_bg : '')) ?> Meter
					</div>
				</div>
			<?php } ?>
			<br>
			<h5 class="caption-subject font-red bold uppercase">Data Teknis</h5>