<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-gift"></i>Data Summary Permohonan
				</div>
			</div>
		</div>
		<div class="portlet light bordered margin-top-20">
			<h4 align="center" class="caption-subject font-blue bold uppercase">Data <?= $row->no_konsultasi ?></h4>

			<div class="row static-info">
				<div class="col-md-3 name">
					Nama Lengkap Pemilik
				</div>
				<div class="col-md-9 value">
					<?= $row->nm_pemilik ?>
				</div>
			</div>

			<div class="row static-info">
				<div class="col-md-3 name">
					No. Indentitas Pemilik
				</div>
				<div class="col-md-9 value">
					<?= $row->no_ktp ?>
				</div>
			</div>

			<div class="row static-info">
				<div class="col-md-3 name">
					Alamat Pemilik Bangunan
				</div>
				<div class="col-md-9 value">
					<?= (isset($row->alamat) ? $row->alamat : ''); ?>, Kec. <?= (isset($row->nama_kecamatan) ? $row->nama_kecamatan : ''); ?>, <?= (isset($row->nama_kabkota) ? ucwords(strtolower($row->nama_kabkota)) : ''); ?>, <?= (isset($row->nama_provinsi) ? $row->nama_provinsi : ''); ?>
				</div>
			</div>

			<div class="row static-info">
				<div class="col-md-3 name">No. Kontak</div>
				<div class="col-md-9 value"><?= (isset($row->no_hp) ? $row->no_hp : ''); ?></div>
			</div>

			<div class="row static-info">
				<div class="col-md-3 name">Email</div>
				<div class="col-md-8 value"><?= (isset($row->email) ? $row->email : ''); ?></div>
			</div>

			<div class="row static-info">
				<div class="col-md-3 name">
					Jenis Konsultasi
				</div>
				<div class="col-md-9 value">
					<?= $row->nm_konsultasi ?>
				</div>
			</div>

			<div class="row static-info">
				<div class="col-md-3 name">Jenis Permohonan</div>
				<div class="col-md-8 value">
					<?php
					$list_izin = array(
						"1" => "Persetujuan Bangunan Gedung",
						"2" => "Bangunan Gedung Existing Belum Memiliki Izin",
						"3" => "Bangunan Gedung Perubahan",
						"4" => "Bangunan Gedung Kolektif",
						"5" => "Bangunan Gedung Prasarana",
						"6" => "Bangunan Gudang 1300 Meter Persegi"
					);
					foreach ($list_izin as $key => $val) {
						if ($key == $row->id_izin) {
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
					Luas, Tinggi & Jumlah Lantai
				</div>
				<div class="col-md-9 value">
					<?= (isset($row->luas_bgn) ? $row->luas_bgn : '') ?> m<sup>2</sup>, dengan tinggi <?= (isset($row->tinggi_bgn) ? $row->tinggi_bgn : '') ?> meter dan berjumlah <?= (isset($row->jml_lantai) ? $row->jml_lantai : '') ?> lantai.
				</div>
			</div>

			<div class="row static-info">
				<div class="col-md-3 name">
					Luas & Lapis Basement
				</div>
				<div class="col-md-9 value">
					<?php echo set_value('luas_basement', (isset($row->luas_basement) ? $row->luas_basement : '')) ?> m<sup>2</sup> dan berjumlah <?php echo set_value('lantai_basement', (isset($row->lapis_basement) ? $row->lapis_basement : '')) ?> lapis.
				</div>
			</div>

			<?php if ($DataBangunan->id_jenis_permohonan == '11') { ?>
				<div class="row static-info">
					<div class="col-md-3 name">Data Bangunan Kolektif</div>
					<div class="col-md-8 value">
						<table class="table table-striped table-bordered dt-responsive wrap" id="tipe_bgn">
							<tr>
								<th>Tipe</th>
								<th>Luas</th>
								<th>Tinggi</th>
								<th>Lantai</th>
								<th>Jumlah Unit</th>
							</tr>
							<?php
							$tipe = json_decode($DataBangunan->tipeA);
							$jumlah = json_decode($DataBangunan->jumlahA);
							$luas = json_decode($DataBangunan->luasA);
							$tinggi = json_decode($DataBangunan->tinggiA);
							$lantai = json_decode($DataBangunan->lantaiA);
							$bangunan = array();
							foreach ($tipe as $noo => $val) {
								if ($val != "")
									$bangunan['tipe'][$noo] = $val;
							}
							foreach ($jumlah as $noo => $val) {
								if ($val != "")
									$bangunan['jumlah'][$noo] = $val;
							}
							foreach ($luas as $noo => $val) {
								if ($val != "")
									$bangunan['luas'][$noo] = $val;
							}
							foreach ($tinggi as $noo => $val) {
								if ($val != "")
									$bangunan['tinggi'][$noo] = $val;
							}
							if (!empty($lantai))
								foreach ($lantai as $noo => $val) {
									if ($val != "")
										$bangunan['lantai'][$noo] = $val;
								}
							$no = 0;
							if (!empty($bangunan)) {
								foreach ($bangunan['tipe'] as $dt) {
									$no++; ?>
									<tr id="tr-tipe<?php echo $no ?>">
										<td><?php echo form_input('tipeA[' . $no . ']', $bangunan['tipe'][$no], 'style="width:90px;" id="posisi' . $no . '" class="posisi' . $no . ' form-control"'); ?></td>
										<td><?php echo form_input('luasA[' . $no . ']', $bangunan['luas'][$no], 'style="width:100px;" id="luas' . $no . '" class="luas' . $no . ' form-control"'); ?></td>
										<td><?php echo form_input('tinggiA[' . $no . ']', $bangunan['tinggi'][$no], 'style="width:90px;" id="tinggi' . $no . '" class="tinggi' . $no . ' form-control"'); ?></td>
										<td><?php echo form_input('lantaiA[' . $no . ']', !empty($bangunan['lantai'][$no]) ? $bangunan['lantai'][$no] : '', 'style="width:90px;" id="lantai' . $no . '" class="lantai' . $no . ' form-control"'); ?></td>
										<td><?php echo form_input('jumlahA[' . $no . ']', $bangunan['jumlah'][$no], 'style="width:100px;" id="luas' . $no . '" class="jumlah' . $no . ' form-control"'); ?></td>

									</tr>
								<?php }
							} else { ?>
								<tr id="tr-tipe">
									<td><?php echo form_input('tipeA[1]', '', 'style="width:90px;" id="posisi1" class="posisi1 form-control"'); ?></td>
									<td><?php echo form_input('luasA[1]', '', 'style="width:100px;" id="luas1" class="unit1 form-control"'); ?></td>
									<td><?php echo form_input('tinggiA[1]', '', 'style="width:90px;" id="tinggi1" class="tinggi1 form-control"'); ?></td>
									<td><?php echo form_input('lantaiA[1]', '', 'style="width:90px;" id="lantai1" class="tinggi1 form-control"'); ?></td>
									<td><?php echo form_input('jumlahA[1]', '', 'style="width:100px;" id="jumlah1" class="unit1 form-control"'); ?></td>
									<td></td>
								</tr>
							<?php } ?>
						</table>
					</div>
				</div>
			<?php } else if ($DataBangunan->id_jenis_permohonan == '12') { ?>
				<div class="row static-info">
					<div class="col-md-3 name">Fungsi Bangunan</div>
					<div class="col-md-8 value">
						<?php echo $DataBangunan->jns_prasarana; ?>
					</div>
				</div>
				<div class="row static-info">
					<div class="col-md-3 name">Luas dan Tinggi Bangunan Prasarana</div>
					<div class="col-md-8 value">
						<?php echo $DataBangunan->luas_bgp; ?> m<sup>2</sup> dengan Tinggi <?php echo $DataBangunan->tinggi_bgp; ?> Meter
					</div>
				</div>
			<?php } else { ?>
				<div class="row static-info">
					<div class="col-md-3 name">
						Fungsi Bangunan Gedung
					</div>
					<div class="col-md-9 value">
						<?php echo set_value('fungsi_bg', (isset($row->fungsi_bg) ? $row->fungsi_bg : '')) ?>
					</div>
				</div>

				<div class="row static-info">
					<div class="col-md-3 name">
						Lokasi Bangunan Gedung
					</div>
					<div class="col-md-9 value">
						<?= (isset($row->almt_bgn) ? $row->almt_bgn : ''); ?>, Kec. <?= (isset($row->nama_kec_bg) ? $row->nama_kec_bg : ''); ?>, <?= (isset($row->nama_kabkota_bg) ? ucwords(strtolower($row->nama_kabkota_bg)) : ''); ?>, <?= (isset($row->nama_provinsi_bg) ? $row->nama_provinsi_bg : ''); ?>
					</div>
				</div>
			<?php } ?>
		</div>
		<?php echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '</div>' : ''; ?>
		<div class="tabbable tabbable-custom tabbable-noborder">
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#tab1" data-toggle="tab" class="step"><span class="desc"><i class="fa fa-check"></i> Data Teknis Tanah</span></a>
				</li>
				<li>
					<a href="#tab2" data-toggle="tab" class="step">
						<span class="desc"><i class="fa fa-check"></i> Data Umum</span>
					</a>
				</li>
				<li>
					<a href="#tab4" data-toggle="tab" class="step">
						<span class="desc"><i class="fa fa-check"></i> Data Teknis Arsitektur dan Struktur</span>
					</a>
				</li>
				<?php if ($id_jenis_permohonan != '3' && $id_jenis_permohonan != '4' && $id_jenis_permohonan != '5' && $id_jenis_permohonan != '12') : ?>
					<li>
						<a href="#tab5" data-toggle="tab" class="step">
							<?php if ($id_izin != '2') : ?>
								<span class="desc"><i class="fa fa-check"></i> Data Teknis MEP</span>
							<?php else : ?>
								<span class="desc"><i class="fa fa-check"></i> Data Teknis Gedung Eksisting</span>
							<?php endif; ?>
						</a>
					</li>
				<?php endif; ?>
				<?php if ($id_jenis_permohonan == '14') : ?>
					<?php if ($imb != '1') : ?>
						<?php if ($status >= 10) : ?>
							<li>
								<a href="#tab7" data-toggle="tab" class="step">
									<span class="desc"><i class="fa fa-check"></i>Hasil Perhitungan Retribusi</span>
								</a>
							</li>
						<?php else : ?>
							<li>
								<a href="#tab6" data-toggle="tab" class="step">
									<span class="desc"><i class="fa fa-check"></i>Simulasi Perhitungan Retribusi</span>
								</a>
							</li>
						<?php endif; ?>
					<?php endif; ?>
				<?php else : ?>
					<?php if ($status >= 10) : ?>
						<li>
							<a href="#tab7" data-toggle="tab" class="step">
								<span class="desc"><i class="fa fa-check"></i>Hasil Perhitungan Retribusi</span>
							</a>
						</li>
					<?php else : ?>
						<li>
							<a href="#tab6" data-toggle="tab" class="step">
								<span class="desc"><i class="fa fa-check"></i>Simulasi Perhitungan Retribusi</span>
							</a>
						</li>
					<?php endif; ?>
				<?php endif; ?>
				<?php if ($status >= '17') : ?>
					<!--<li>
						<a href="#tab7" data-toggle="tab" class="step">
							<span class="desc"><i class="fa fa-check"></i>Rencana Kontruksi</span>
						</a>
					</li>-->
				<?php endif; ?>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab1">
					<?php include "DataTanahSummary.php"; ?>
				</div>
				<div class="tab-pane" id="tab2">
					<?php include "DataUmumSummary.php"; ?>
				</div>
				<div class="tab-pane" id="tab4">
					<?php include "DataArStrSummary.php"; ?>
				</div>
				<div class="tab-pane" id="tab5">
					<?php include "DataMEPSummary.php"; ?>
				</div>
				<?php if ($status >= 12) : ?>
					<div class="tab-pane" id="tab6">
						<?php include "BayarRetribusi.php"; ?>
					</div>
				<?php elseif ($status <= 9) : ?>
					<div class="tab-pane" id="tab6">
						<?php include "KalkulatorRetribusi.php"; ?>
					</div>
				<?php else : ?>
					<div class="tab-pane" id="tab7">
						<?php include "DetailRetribusi.php"; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>