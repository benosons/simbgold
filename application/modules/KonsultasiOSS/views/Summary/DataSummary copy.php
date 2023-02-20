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
			<div class="row static-info">
				<div class="col-md-3 name">Nama Lengkap Pemilik</div>
				<div class="col-md-8 value">
					<?= (isset($DataPemilik->glr_depan) ? $DataPemilik->glr_depan : ''); ?>
					<?= (isset($DataPemilik->nm_pemilik) ? $DataPemilik->nm_pemilik : ''); ?>
					<?= (isset($DataPemilik->glr_belakang) ? $DataPemilik->glr_belakang : ''); ?>
				</div>
			</div>
			<div class="row static-info">
				<div class="col-md-3 name">No. Indentitas Pemilik</div>
				<div class="col-md-8 value"><?= (isset($DataPemilik->no_ktp) ? $DataPemilik->no_ktp : ''); ?></div>
			</div>
			<div class="row static-info">
				<div class="col-md-3 name">Alamat Pemilik Bangunan</div>
				<div class="col-md-8 value">
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
				<div class="col-md-3 name">No. Kontak</div>
				<div class="col-md-8 value"><?= (isset($DataPemilik->no_hp) ? $DataPemilik->no_hp : ''); ?></div>
			</div>
			<div class="row static-info">
				<div class="col-md-3 name">Email</div>
				<div class="col-md-8 value"><?= (isset($DataPemilik->email) ? $DataPemilik->email : ''); ?></div>
			</div>
			<div class="row static-info">
				<div class="col-md-3 name">Alamat Bangunan Gedung</div>
				<div class="col-md-8 value">
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
				<div class="col-md-3 name">Jenis Permohonan</div>
				<div class="col-md-8 value">
					<?php $list_izin = array(
						"1" => "Persetujuan Bangunan Gedung",
						"2" => "Bangunan Gedung Existing Belum Memiliki Izin",
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
			<?php if($DataBangunan->id_jenis_permohonan =='11') { ?>
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
			<?php } else if ($DataBangunan->id_jenis_permohonan =='12'){ ?>
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
			<?php } else {?>
				<div class="row static-info">
					<div class="col-md-3 name">Fungsi Bangunan</div>
					<div class="col-md-8 value">
						<?php
							$queFungsi = $this->Mkonsultasi->get_jenis_fungsi_list($DataBangunan->id_fungsi_bg)->row_array();
							echo $queFungsi['fungsi_bg'];
							?>
					</div>
				</div>
				<div class="row static-info">
					<div class="col-md-3 name">Luas, Tinggi dan Jumlah Lantai Bangunan </div>
					<div class="col-md-8 value">
						<?php echo $DataBangunan->luas_bgn; ?> m<sup>2</sup> dengan Tinggi <?php echo $DataBangunan->tinggi_bgn; ?> Meter dan Jumlah Lantai <?php echo $DataBangunan->jml_lantai; ?> Lantai 
					</div>
				</div>
			<?php } ?>
			<?php if($DataBangunan->status =='6'){ ?>
				<div class="row static-info">
					<div class="col-md-3 name">Jadwal Konsultasi</div>
					<div class="col-md-8 value">
						<table class="table table-striped table-bordered dt-responsive wrap" id="tipe_bgn">
							<tr>
								<th>No.</th>
								<th>Jadwal Konsultasi</th>
								<th>Catatan</th>
								<th>Undangan</th>
							</tr>
						</table>	
					</div>
				</div>
			<?php } ?>
		</div>
		<?php echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '</div>' : ''; ?>
		<div class="tabbable tabbable-custom tabbable-noborder">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab1" data-toggle="tab" class="step"><span class="desc"><i class="fa fa-check"></i> Data Teknis Tanah</span></a></li>
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
				<?php if ($id_jenis_permohonan !='3' && $id_jenis_permohonan !='4' && $id_jenis_permohonan !='5' && $id_jenis_permohonan !='12'){?>
				<li>
					<a href="#tab5" data-toggle="tab" class="step">
						<?php if($id_izin != '2'){ ?>
							<span class="desc"><i class="fa fa-check"></i> Data Teknis MEP</span>
						<?php } else { ?>
							<span class="desc"><i class="fa fa-check"></i> Data Teknis Gedung Eksisting</span>
						<?php } ?>
					</a>
				</li>
				<?php } else{ ?>
					
				<?php } ?>
				<?php if($id_jenis_permohonan =='14'){ ?>
					<?php if($imb == '1') { ?>
						
					<?php } else { ?>
						<li>
						<a href="#tab6" data-toggle="tab" class="step">
							<span class="desc"><i class="fa fa-check"></i>Retribusi</span>
						</a>
					</li>
					<?php } ?>
				<?php } else { ?>
					<li>
						<a href="#tab6" data-toggle="tab" class="step">
							<span class="desc"><i class="fa fa-check"></i>Retribusi</span>
						</a>
					</li>
				<?php } ?>
				<?php if ($status >='17'){?>
					<!--<li>
						<a href="#tab7" data-toggle="tab" class="step">
							<span class="desc"><i class="fa fa-check"></i>Rencana Kontruksi</span>
						</a>
					</li>-->
				<?php } else { ?>

				<?php } ?>
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
				<?php if ($status >= 12){ ?>
					<div class="tab-pane" id="tab6">
						<?php include "BayarRetribusi.php"; ?>
					</div>
				<?php }else { ?>
					<div class="tab-pane" id="tab6">
						<?php include "KalkulatorRetribusi.php"; ?>
					</div>
				<?php } ?>

				<?php if ($status >='17'){ ?>
					<!--<div class="tab-pane" id="tab7">
						<?php include "RenKontruksi.php"; ?>
					</div>-->
				<?php } else { ?>
					
				<?php } ?>	
			</div>
		</div>
	</div>
</div>