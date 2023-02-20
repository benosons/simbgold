<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="fa fa-gift"></i>Data Perbaikan</div>
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
				<div class="col-md-8 value">
					<?= (isset($DataPemilik->no_ktp) ? $DataPemilik->no_ktp : ''); ?>
				</div>
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
				<div class="col-md-3 name">No. Telepon</div>
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
			<?php if($DataBangunan->id_izin =='4') { ?>
				<div class="row static-info">
				<div class="col-md-3 name">Data Bangunan Kolektif</div>
				<div class="col-md-6 value">
					<table class="table table-striped table-bordered dt-responsive wrap">
						<tr>
							<th>Tipe</th>
							<th>Luas</th>
							<th>Tinggi</th>
							<th>Lantai</th>
							<th>Jumlah Unit</th>
						</tr>
						<?php
							$tipe = json_decode($DataBangunan->tipeA);
							$luas = json_decode($DataBangunan->luasA);
							$tinggi = json_decode($DataBangunan->tinggiA);
							$lantai = json_decode($DataBangunan->lantaiA);
							$jumlah = json_encode($DataBangunan->jumlahA);
							$bangunan = array();
							foreach ($tipe as $noo => $val) {
								if ($val != "")
								$bangunan['tipe'][$noo] = $val;
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
										<td><?php echo form_input('tipeA[' . $no . ']', $bangunan['tipe'][$no], 'style="width:85px;" id="posisi' . $no . '" class="posisi' . $no . ' form-control"'); ?></td>
										<td><?php echo form_input('luasA[' . $no . ']', $bangunan['luas'][$no], 'style="width:90px;" id="luas' . $no . '" class="luas' . $no . ' form-control"'); ?></td>
										<td><?php echo form_input('tinggiA[' . $no . ']', $bangunan['tinggi'][$no], 'style="width:90px;" id="tinggi' . $no . '" class="tinggi' . $no . ' form-control"'); ?></td>
										<td><?php echo form_input('lantaiA[' . $no . ']', !empty($bangunan['lantai'][$no]) ? $bangunan['lantai'][$no] : '', 'style="width:90px;" id="lantai' . $no . '" class="lantai' . $no . ' form-control"'); ?></td>
									</tr>
								<?php }
							} else { ?>
								<tr id="tr-tipe">
									<td><?php echo form_input('tipeA[1]', '', 'style="width:85px;" id="posisi1" class="posisi1 form-control"'); ?></td>
									<td><?php echo form_input('luasA[1]', '', 'style="width:85px;" id="luas1" class="unit1 form-control"'); ?></td>
									<td><?php echo form_input('tinggiA[1]', '', 'style="width:85px;" id="tinggi1" class="tinggi1 form-control"'); ?></td>
									<td><?php echo form_input('lantaiA[1]', '', 'style="width:85px;" id="lantai1" class="tinggi1 form-control"'); ?></td>
								</tr>
							<?php } ?>
						</table>
					</div>
				</div>
			<?php } else if ($DataBangunan->id_izin =='5'){ ?>
				<div class="row static-info">
					<div class="col-md-3 name">Fungsi Bangunan</div>
					<div class="col-md-8 value">
						<?php echo $DataBangunan->jns_prasarana; ?>
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
			<?php } ?>
			<div class="row static-info">
				<div class="col-md-3 name">Catatan Perbaikan</div>
				<div class="col-md-9 value">	
					<table class="table table-bordered table-striped table-hover" id="sample_editable_1">
						<thead>
							<tr class="warning">
								<th width="5%"><center>No.</center></th>
								<th width="15%"><center>Tgl. Verifikasi</center></th>
								<th width="65%"><center>Catatan</center></th>
								<th width="15%"><center>Berkas</center></th>
							</tr>
						</thead>
						<tbody>
							<?php if ($DataInformasi->num_rows() > 0) {
								$no = 1;
								foreach ($DataInformasi->result() as $key) { ?>
									<tr>
										<td align="center"> <?php echo $no++; ?></td>
										<td align="center"> <?php echo $key->tgl_status; ?></td>
										<td align="left"> <?php echo $key->catatan; ?></td>
										<td align="center">
                      <?php if($key->dir_file !='' && $key->dir_file !=null) { ?>
                        <a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/Konsultasi/' . $key->id . '/' . $key->dir_file); ?>')" class="btn default btn-xs blue-stripe">Lihat</a>
                      <?php } else { ?>
                        Tidak Ada Dokumen
                      <?php } ?>
                    </td>
									</tr>
								<?php }
							} ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="tabbable tabbable-custom tabbable-noborder">
			<ul class="nav nav-tabs">
				<center>
					<li class="active">
						<a href="#tab1" data-toggle="tab" class="step"><h4><span class="desc"><i class="fa fa-check"></i>Perbaikan Dokumen Teknis</span></h4></a>
					</li>
				</center>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab1">
					<?php include "DataPerbaikanDokumen.php"; ?>
				</div>
				<div class="tab-pane" id="tab3">
					<?php include "DataUmumSummary.php"; ?>
				</div>
				<div class="tab-pane" id="tab4">
					<?php include "DataArStrSummary.php"; ?>
				</div>
				<div class="tab-pane" id="tab5">
					<?php include "DataMEPSummary.php"; ?>
				</div>
				<div class="tab-pane" id="tab7">
					<?php include "PernyataanUlang.php"; ?>
				</div>
			</div>

		</div>
	</div>
</div>