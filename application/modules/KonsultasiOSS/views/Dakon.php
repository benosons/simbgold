<style>
	th {
		text-align: center;
	}
	.text-center {
		text-align: center;
	}
</style>
<div class="row margin-top-20">
	<div class="col-md-12">
		<div class="portlet light ">
			<div class="portlet-title">
				<div class="caption caption-md">
					<i class="icon-bar-chart theme-font hide"></i><span class="caption-subject theme-font bold uppercase">Data Pengajuan PBG, SLF, SBKBG, RTB, atau Pendataan Bangunan Gedung</span>
				</div>
			</div>
			<div class="portlet-body">
				<div class="row list-separated">
					<div class="col-md-6">
						<?php echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '<button class="close" data-close="alert">' . '</button>' . '</div>' : ''; ?>
					</div>
				</div>
				<table class="table table-striped table-bordered table-hover table-scrollable table-scrollable-borderless" id="tableKonsultasi">
					<thead>
						<tr class="warning">
							<th>No</th>
							<th>Nama Pemilik</th>
							<th>Jenis Permohonan</th>
							<th style="width:16%;">No. Registrasi</th>
							<th>Lokasi BG</th>
							<th>Status Permohonan</th>
							<th style="width:10%;">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php if ($DataKonsultasi->num_rows() > 0) {
							$no = 1;
							foreach ($DataKonsultasi->result() as $key) {
								if ($key->no_konsultasi == "" || $key->no_konsultasi == null) {
									$no_konsultasi = "[Belum Memiliki]";
								} else {
									$no_konsultasi = $key->no_konsultasi;
								} ?>
								<tr>
									<td align="center"><?php echo $no++; ?></td>
									<td class="text-center"><?php echo $key->nm_pemilik; ?></td>
									<td><?php echo $key->nm_konsultasi; ?> </td>
									<td class="text-center"><?php echo $no_konsultasi; ?></td>
									<td><?php echo $key->almt_bgn; ?></td>
									<td align=""><?php echo $key->status_pemohon; ?></td>
									<td align="center">
									<?php if($key->id_jenis_permohonan =='8'){ ?>
										<?php if($key->tahap_pbg =='1'){ ?>
											<a href="<?php echo site_url("KonsultasiOSS/FormDataTanah/{$this->secure->encrypt_url($key->id)}"); ?>" class="btn btn-primary btn-sm" title="Lanjut Tahap 2"><span class="glyphicon glyphicon-edit"></span></a>
										<?php }else if($key->tahap_pbg =='2'){ ?>
											<a href="<?php echo site_url("KonsultasiOSS/FormDataTeknis/{$this->secure->encrypt_url($key->id)}"); ?>" class="btn btn-primary btn-sm" title="Verifikasi Data"><span class="glyphicon glyphicon-edit"></span></a>
										<?php } else if($key->tahap_pbg =='3'){ ?>
											<a href="<?php echo site_url("KonsultasiOSS/FormDataDokumen/{$this->secure->encrypt_url($key->id)}"); ?>" class="btn btn-primary btn-sm" title="Verifikasi Data"><span class="glyphicon glyphicon-edit"></span></a>
										<?php }else{ ?>
											<a href="<?php echo site_url("KonsultasiOSS/FormPendaftaran/{$this->secure->encrypt_url($key->id)}"); ?>" class="btn btn-warning btn-sm" title="Ubah Data"><span class="glyphicon glyphicon-pencil"></span></a>
										<?php } ?>
									<?php }else { ?>
										<?php if ($key->status == 0) { ?>
											<a href="<?php echo site_url("KonsultasiOSS/FormPendaftaran/{$this->secure->encrypt_url($key->id)}"); ?>" class="btn btn-warning btn-sm" title="Ubah Data"><span class="glyphicon glyphicon-pencil"></span></a>
										<?php } else if ($key->status == '3') { ?>
											<a href="<?php echo site_url('KonsultasiOSS/FormPerbaikan/' . $key->id); ?>" class="btn btn-primary btn-sm" title="Verifikasi Data"><span class="glyphicon glyphicon-edit"></span></a>
										<?php } else if ($key->status == '7') { ?>
											<a href="<?php echo site_url('KonsultasiOSS/FormRevisi/' . $key->id); ?>" class="btn btn-primary btn-sm" title="Perbaikan Dokumen Teknis"><span class="glyphicon glyphicon-edit"></span></a>
											<!--<a href="<?php echo site_url('KonsultasiOSS/removeDataPengajuan/' . $key->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ini?')"title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a>-->
											<?php } else if ($key->status == '9') {
											if ($key->data_step == '7') { ?>
												<a href="<?php echo site_url('KonsultasiOSS/FormPengecekan/' . $key->id); ?>" class="btn btn-primary btn-sm" title="Perbaikan Dokumen Teknis"><span class="glyphicon glyphicon-edit"></span></a>
											<?php } else { ?>
											<?php } ?>
										<?php } else if ($key->status == '15') { ?>
											<a href="<?php echo site_url("KonsultasiOSS/FormSummary/{$this->secure->encrypt_url($key->id)}"); ?>" class="btn btn-primary btn-sm tooltips" data-container="body" data-placement="bottom" data-original-title="Verifikasi Data"><span class="glyphicon glyphicon-edit"></span></a>
											<a href="<?php echo site_url('KonsultasiOSS/LaporPembangunan/' . $key->id); ?>" class="btn btn-success btn-sm" title="Verifikasi Data" id="tombolver" data-toggle="modal" data-target="#modal-edit"><span class="glyphicon glyphicon-edit"></span></a>
											<br>
										<?php } else if ($key->status >= '16') { ?>
											<a href="<?php echo site_url('KonsultasiOSS/FormPelaporan/' . $key->id); ?>" class="btn btn-warning btn-sm" title="Pelaporan"><span class="glyphicon glyphicon-edit"></span></a>
										<?php } else { ?>
											<a href="<?php echo site_url("KonsultasiOSS/FormSummary/{$this->secure->encrypt_url($key->id)}"); ?>" class="btn btn-primary btn-sm tooltips" data-container="body" data-placement="bottom" data-original-title="Verifikasi Data"><span class="glyphicon glyphicon-edit"></span></a>
											<!--<a href="<?php echo site_url('KonsultasiOSS/removeDataPengajuan/' . $key->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ini?')" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a>-->
										<?php } ?>
										<?php }?>
									</td>
								</tr>
						<?php }
						} ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div id="CetakDokumen" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		</div>
		<div class="modal-body">
		<!--<form action="DinasTeknis/status_dt_teknis" class="form-horizontal" role="form" method="post" id="savestatussyarat" name="savestatussyarat" enctype="multipart/form-data">
			<div class="modal-header">
				<h4 align="center" class="modal-title"><b>Download Dokumen</b></h4>
			</div>
			<input type="text" name="idPer" id="idPer" >
			<div class="row">
			<div class="modal-body">
					<div class="col-md-12 ">
						<div class="form-body">
							<div class="form-group">
								<label class="col-md-9 control-label">Dokumen Persetujuan Bangunan Gedung</label>
								<div class="col-md-7">
					  <a href="#" onclick="GetCetakPersetujuanBangunanGedung(<?php echo $key->id ?>)" class="btn btn-info btn" title="Cetak Persetujuan Bangunan Gedung" id="tombolinver"><span class="glyphicon glyphicon-print">Download</span></a>
					</div>
							</div>
							<div class="form-group">
								<label class="col-md-9 control-label">Dokumen Sertifikat Laik Fungsi</label>
								<div class="col-md-7">
					  <a href="#" onclick="GetCetakLaikFungsi(<?php echo $key->id ?>)" class="btn btn-info btn" title="Cetak Persetujuan Bangunan Gedung" id="tombolinver"><span class="glyphicon glyphicon-print">Download</span></a>
					</div>
							</div>
				</div>
					</div>
				</div>
			</div>
		</form>-->
		</div>
	</div>
</div>
<div id="modal-edit" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false" data-focus-on="input:first">
	<div class="modal-dialog modal-lg">
		<div class="modal-content"></div>
	</div>
</div>
<div id="DaftarPeng" class="modal fade" role="dialog" aria-hidden="true" data-width="50%" data-backdrop="static" data-keyboard="false">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h4 class="modal-title">Daftar Pengajuan</h4>
		</div>
		<div class="modal-body form">
			<form action="<?php echo site_url('KonsultasiOSS/savePermohonan'); ?>" class="form-horizontal" role="form" method="post" id="FormPermohonan">
				<div class="portlet-body form">
					<div class="form-body">
						<input type="hidden" id='csrf_id' name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
						<div id="show_jenisPer" style="display:none;">
							<div class="form-group">
								<label class="control-label col-md-3">Jenis Permohonan <span class="required">*
									</span></label>
								<div class="col-md-5">
									<?php echo form_dropdown('id_izin', $list_JnsPer, '', 'class ="form-control" id="id_izin" onchange="getjenisPermohonan(this.value)"'); ?>
									<input type="hidden" name="id_existing" id="id_existing" />
								</div>
								<!--<div class="col-md-2">
								<a class="btn btn-info" data-toggle="modal" data-target="#modalJenis"><iclass="fa fa-book left-icon"> </i></a>
							</div>-->
							</div>
						</div>
						<div id="per_imb" style="display:none;">
							<div class="form-group row">
								<label class="control-label col-md-3">Memiliki IMB/PBG <span class="required">*
									</span></label>
								<div class="col-md-7">
									<div class="radio-list">
										<label><input type="radio" name="imb" value="1" onchange="show_slf(this);">Iya (Sudah Memiliki IMB / PBG)</label>
										<label><input type="radio" name="imb" value="0" onchange="show_slf(this);">Tidak (Tidak Memiliki IMB / PBG)</label>
									</div>
								</div>
							</div>
						</div>
						<div id="show_imb" style="display:none;">
							<div class="form-group row">
								<label class="control-label col-md-3">Nomor IMB<span class="required">*</span></label>
								<div class="col-md-5">
									<div class="checkbox-list">
										<input type="text" class="form-control" maxlength="50" name="no_imb" placeholder="No IMB" autocomplete="off">
										<?= form_error('no_imb', '<small class="text-danger pl-3">', '</small>') ?>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Tanggal Terbit IMB<span class="required">*</span></label>
								<div class="col-md-4">
									<input type="date" class="form-control" name="tgl_imb">
								</div>
							</div>
						</div>
						<div id="per_slf" style="display:none;">
							<div class="form-group row">
								<label class="control-label col-md-3">Memiliki SLF<span class="required">*</span></label>
								<div class="col-md-7">
									<div class="radio-list">
										<label><input type="radio" name="slf" value="1" onchange="show_cetak();">Iya</label>
										<label><input type="radio" name="slf" value="0" onchange="show_cetak();">Tidak</label>
									</div>
								</div>
							</div>
						</div>
						<div id="show_slf" style="display:none;">
							<div class="form-group row">
								<label class="control-label col-md-3">Nomor SLF<span class="required">*</span></label>
								<div class="col-md-5">
									<div class="checkbox-list">
										<input type="text" class="form-control" maxlength="22" name="no_slf" placeholder="No SLF" autocomplete="off">
										<?= form_error('no_slf', '<small class="text-danger pl-3">', '</small>') ?>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Tanggal Terbit SLF<span class="required">*</span></label>
								<div class="col-md-4">
									<input type="date" class="form-control" name="tgl_slf">
								</div>
							</div>
						</div>
						<div id="per_cetak" style="display:none;">
							<div class="form-group row">
								<label class="control-label col-md-3">Cetak Ulang<span class="required">*</span></label>
								<div class="col-md-7">
									<div class="radio-list">
										<label><input type="checkbox" name="cetak[]" value="1"> IMB/PBG</label>
										<label><input type="checkbox" name="cetak[]" value="2"> SLF</label>
										<label><input type="checkbox" name="cetak[]" value="3"> SBKBG</label>
									</div>
								</div>
							</div>
						</div>
						<div id="permohonan_slf_show" style="display:none;">
							<div class="form-group">
								<label class="control-label col-md-3">Permohonan SLF<span class="required">*</span></label>
								<div class="col-md-5">
									<?php $list_perSlf = array(
										'' => '--Pilih--',
										'1' => 'Bangunan Gedung',
										'2' => 'Bangunan Prasarana',
										'3' => 'Bangunan Purwarupa/Prototipe 3(Tiga) Kilo Liter'
									
									);
									echo form_dropdown('permohonan_slf', $list_perSlf, '', 'class ="form-control" onchange="set_permohonan_slf(this.value)" id="permohonan_slf"'); ?>
								</div>
							</div>
						</div>
						<div id="KolektifInduk" style="display:none;">
							<div class="form-group">
								<label class="control-label col-md-3">Nama Bangunan<span class="required">*</span></label>
								<div class="col-md-7">
									<input type="text" class="form-control" value="<?php echo set_value('nama_bangunan_kolektif', (isset($DataBangunan->nm_bgn) ? $DataBangunan->nm_bgn : '')) ?>" name="nama_bangunan_kolektif" placeholder="Nama Bangunan" autocomplete="off">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Tipe Bangunan<span class="required">* </span></label>
								<div class="col-md-7">
									<div class="col-md-3">
										<!--<div class="form-group"><a class="btn btn-info" href="javascript:void(0);" onclick="addTipe();"><i class="fa fa-plus left-icon"> </i>Tambah Tipe</a></div>-->
										<table class="table table-striped table-bordered dt-responsive wrap" id="tipe_bgn">
											<tr>
												<th>Tipe</th>
												<th>Jumlah Unit</th>
												<th>Luas</th>
												<th>Tinggi</th>
												<th>Lantai</th>
												<th width="5%">Aksi</th>
											</tr>
											<tr id="tr-tipe">
												<td><?php echo form_input('tipeA[1]', '', 'style="width:60px;" id="tipe1" class="tipe1 form-control"'); ?></td>
												<td><?php echo form_input('jumlahA[1]', '', 'style="width:60px;" id="jumlah1" class="jumlah1 form-control"'); ?></td>
												<td><?php echo form_input('luasA[1]', '', 'style="width:60px;" id="luas1" class="luas1 form-control"'); ?></td>
												<td><?php echo form_input('tinggiA[1]', '', 'style="width:60px;" id="tinggi1" class="tinggi1 form-control"'); ?></td>
												<td><?php echo form_input('lantaiA[1]', '', 'style="width:60px;" id="lantai1" class="lantai1 form-control"'); ?></td>
												<td><a class="btn btn-info" href="javascript:void(0);" onclick="if(checkDeleteTipeRow() == true){$(this).parent().parent().remove()}"><i class="fa fa-trash left-icon"></i></a>
												</td>
											</tr>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div id="fungsibg" class="form-group" style="display:none;">
							<label class="control-label col-md-3">Fungsi Bangunan<span class="required">*</span></label>
							<div class="col-md-5">
								<?php $id_fungsi_bg = set_value('id', (isset($DataBangunan->id_fungsi_bg) ? $DataBangunan->id_fungsi_bg : '')); ?>
								<?php
								$selected = '';
								if (isset($id_fungsi_bg) && $id_fungsi_bg != '')
									$selected = $id_fungsi_bg;
								else
									$selected = '';
								$js = 'id="id_fungsi_bg" onchange="set_jns_bg(this.value)" class="form-control"';
								echo form_dropdown('id_fungsi_bg', $list_fungsi, $selected, $js); ?>
							</div>
							<!--<div class="col-md-2">
								<a class="btn btn-info"><i class="fa fa-plus left-icon"> </i></a>
							</div>-->
						</div>
						<div id="jual_bg" style="display:none;">
							<div class="form-group row">
								<label class="control-label col-md-3">Apakah Bagian Bangunan Gedung dapat dialihkan ke pihak lain?<span class="required">* </span></label>
								<div class="col-md-7">
									<div class="radio-list">
										<label><input type="radio" name="jual" value="1"> Iya</label>
										<label><input type="radio" name="jual" value="0"> Tidak</label>
									</div>
								</div>
							</div>
						</div>
						<div id="jns_bg_toggle" class="form-group" style="display:none;">
							<label class="control-label col-md-3">Jenis Bangunan <span class="required">*</span></label>
							<div class="col-md-5">
								<?php echo form_dropdown('id_jns_bg', array('' => '--Pilih--'), isset($DataBangunan->id_jns_bg) ? $DataBangunan->id_jns_bg : '', 'id="id_jns_bg"  onchange="show_detail(this.value)" class="form-control"'); ?>
							</div>
							<!--<div class="col-md-2">
								<a class="btn btn-info"><i class="fa fa-plus left-icon"> </i></a>
							</div>-->
						</div>
						<div class="form-group" id="campurincek" style="display: none;">
							<?php
							$hunian = '';
							$keagamaan = '';
							$usaha = '';
							$sosbud = '';
							$khusus = '';
							if ($DataBangunan->id_jns_bg != NULL) {
								$jenis = json_decode($DataBangunan->id_jns_bg);
								foreach ($jenis as $dt_cek) {
									if ($dt_cek == 1) $hunian = 'checked';
									if ($dt_cek == 2) $keagamaan = 'checked';
									if ($dt_cek == 3) $usaha = 'checked';
									if ($dt_cek == 4) $sosbud = 'checked';
									if ($dt_cek == 5) $khusus = 'checked';
								}
							}
							?>
							<label class="control-label col-md-3">Jenis Bangunan <span class="required">*minimal 2</span></label>
							<div class="col-md-7 checkbox-inline">
								<label><input type="checkbox" class="form-control" name="dcampur[]" value="1" <?= $hunian; ?>> Hunian </label>
								<label><input type="checkbox" class="form-control" name="dcampur[]" value="2" <?= $keagamaan; ?>> Keagamaan </label>
								<label><input type="checkbox" class="form-control" name="dcampur[]" value="3" <?= $usaha; ?>> Usaha </label>
								<label><input type="checkbox" class="form-control" name="dcampur[]" value="4" <?= $sosbud; ?>> Sosial & Budaya </label>
								<label><input type="checkbox" class="form-control" name="dcampur[]" value="5" <?= $khusus; ?>> Khusus </label>
							</div>
						</div>
						<!-- Begin Bangunan Prasarana -->
						<div id="prasarana" style="display: none;">
							<div class="form-group">
								<label class="control-label col-md-3">Nama Bangunan<span class="required">*</span></label>
								<div class="col-md-7">
									<input type="text" class="form-control" value="<?php echo set_value('nama_bangunan_prasarana', (isset($DataBangunan->nm_bgn) ? $DataBangunan->nm_bgn : '')) ?>" name="nama_bangunan_prasarana" placeholder="" autocomplete="off">
								</div>
							</div>
							<div class="form-group">
								<?php $prasarana_bg = !empty($DataBangunan->id_prasarana_bg) ? $DataBangunan->id_prasarana_bg : ''; ?>
								<label class="control-label col-md-3">Prasarana<span class="required">* </span></label>
								<div class="col-md-7">
									<select class="form-control" name="id_prasarana_bg" id="id_prasarana_bg">
										<option value="">--Pilih--</option>
										<option value="1" <?php if ($prasarana_bg == '1') echo "selected"; ?>>Kontruksi Pembatas/Penahan/Pengaman</option>
										<option value="2" <?php if ($prasarana_bg == '2') echo "selected"; ?>>Kontruksi Penanda Masuk Lokasi</option>
										<option value="3" <?php if ($prasarana_bg == '3') echo "selected"; ?>>Kontruksi Perkerasan</option>
										<option value="4" <?php if ($prasarana_bg == '4') echo "selected"; ?>>Kontruksi Penghubung</option>
										<option value="5" <?php if ($prasarana_bg == '5') echo "selected"; ?>>Kontruksi Kolam/Reservoir bawah tanah</option>
										<option value="6" <?php if ($prasarana_bg == '6') echo "selected"; ?>>Kontruksi Menara</option>
										<option value="7" <?php if ($prasarana_bg == '7') echo "selected"; ?>>Kontruksi Monumen</option>
										<option value="8" <?php if ($prasarana_bg == '8') echo "selected"; ?>>Kontruksi Instalasi/gardu</option>
										<option value="9" <?php if ($prasarana_bg == '9') echo "selected"; ?>>Kontruksi Reklame / Papan Nama</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Luas Bangunan Prasarana<span class="required">*</span></label>
								<div class="col-md-3">
									<div class="checkbox-list">
										<input type="text" class="form-control" value="<?php echo set_value('luas_bgp', (isset($DataBangunan->luas_bgp) ? $DataBangunan->luas_bgp : '')) ?>" name="luas_bgp" placeholder="Luas Bangunan" autocomplete="off">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Tinggi Bangunan Prasarana<span class="required">*</span></label>
								<div class="col-md-3">
									<div class="checkbox-list">
										<input type="text" class="form-control" value="<?php echo set_value('tinggi_bgp', (isset($DataBangunan->tinggi_bgp) ? $DataBangunan->tinggi_bgp : '')) ?>" name="tinggi_bgp" placeholder="Tinggi Bangunan" autocomplete="off">
									</div>
								</div>
							</div>
						</div>
						<!-- End Bangunan Prasarana -->
						<div id="detail_bg" style="display:none;">
							<div class="form-group">
								<label class="control-label col-md-3">Nama Bangunan<span class="required">*</span></label>
								<div class="col-md-7">
									<input type="text" class="form-control" value="<?php echo set_value('nama_bangunan', (isset($DataBangunan->nm_bgn) ? $DataBangunan->nm_bgn : '')) ?>" name="nama_bangunan" placeholder="Nama Bangunan" autocomplete="off">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Luas Bangunan</label>
								<div class="col-md-3">
									<div class="checkbox-list">
										<input type="text" class="form-control input-comma" value="<?php echo set_value('luas_bg', (isset($DataBangunan->luas_bgn) ? $DataBangunan->luas_bgn : '')) ?>" name="luas_bg" id="luas_bg" onblur="cek()" placeholder="Luas Bangunan" autocomplete="off" pattern="[0-9]+">
									</div>
								</div>
								<label class="control-label">m<sup>2</sup></label>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Jumlah Lantai Bangunan<span class="required">* </span></label>
								<div class="col-md-5">
									<div class="checkbox-list">
										<select name="lantai_bg" id="lantai_bg" class="form-control dropdown-lantai">
											<?php
											for ($i = 1; $i < 11; $i++) {
												$selectedLantai = $i == $DataBangunan->jml_lantai ? 'selected' : '';
												echo "<option value='{$i}' ${selectedLantai}>{$i} Lantai</option>";
											} ?>
										</select>
										<input type="number" class="form-control input-lantai input-number" style="display: none;" value="<?php echo set_value('lantai_bg', (isset($DataBangunan->jml_lantai) ? $DataBangunan->jml_lantai : '')) ?>" name="lantai_bg" id="lantai_bg" onblur="cek()" placeholder="Jumlah Lantai Bangunan Gedung" autocomplete="off" disabled="">
									</div>
									<input type="checkbox" name="pilihan" id="pilihanLantai">
									<label class="control-label">Centang Apabila lebih dari 10 Lantai</label>
								</div>
								<label class="control-label"></label>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Tinggi Bangunan<span class="required">* </span></label>
								<div class="col-md-3">
									<div class="checkbox-list">
										<input type="text" class="form-control input-comma" value="<?php echo set_value('tinggi_bg', (isset($DataBangunan->tinggi_bgn) ? $DataBangunan->tinggi_bgn : '')) ?>" name="tinggi_bg" onblur="cek()" placeholder="Tinggi Bangunan" autocomplete="off" pattern="[0-9]+,">
									</div>
								</div>
								<label class="control-label">M</label>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Luas Basement Bangunan</label>
								<div class="col-md-4">
									<div class="checkbox-list">
										<input type="text" class="form-control input-comma" value="<?php echo set_value('luas_basement', (isset($DataBangunan->luas_basement) ? $DataBangunan->luas_basement : '')) ?>" name="luas_basement" placeholder="Luas Basement Bangunan" autocomplete="off">
									</div>
								</div>
								<label class="control-label">m<sup>2</sup></label>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Jumlah Lantai Basement Bangunan</label>
								<div class="col-md-5">
									<div class="checkbox-list">
										<select name="lapis_basement" id="lapis_basement" class="form-control dropdown-basement">
											<?php for ($i = 0; $i < 11; $i++) {
												$selectedBasement = $i == $DataBangunan->lapis_basement ? 'selected' : '';
												echo "<option value='{$i}' {$selectedBasement}>{$i} Lapis</option>";
											} ?>
										</select>
										<input type="number" class="form-control input-basement" style="display:none;" value="<?php echo set_value('lapis_basement', (isset($DataBangunan->lapis_basement) ? $DataBangunan->lapis_basement : '')) ?>" name="lapis_basement" placeholder="Jumlah Lantai Basement Bangunan" autocomplete="off" disabled="">
									</div>
									<input type="checkbox" name="pilihan_basement" class="input-number" id="pilihanBasement">
									<label class="control-label">Centang Apabila lebih dari 10 Lantai</label>
								</div>
								<label class="control-label"></label>
							</div>
						</div>
						<!-- Begin SPBU Mikro -->
						<div id="spbu_micro" style="display: none;">
							<div class="form-group">
								<label class="control-label col-md-3">Nama Bangunan<span class="required">*</span></label>
								<div class="col-md-7">
									<input type="text" class="form-control" value="<?php echo set_value('nama_bangunan_pertashop', (isset($DataBangunan->nm_bgn) ? $DataBangunan->nm_bgn : '')) ?>" name="nama_bangunan_pertashop" placeholder="" autocomplete="off">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Luas Bangunan<span class="required">*</span></label>
								<div class="col-md-2">
									<div class="checkbox-list">
										<input type="text" class="form-control" value="10.1" name="" placeholder="" autocomplete="off" readonly>
									</div>
								</div>
								<div class="col-md-2">m<sup>2</sup></div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Tinggi Bangunan<span class="required">*</span></label>
								<div class="col-md-2">
									<div class="checkbox-list">
										<input type="text" class="form-control" value="2.6" name="" placeholder="Tinggi Bangunan" autocomplete="off" readonly>
									</div>
								</div>
								<div class="col-md-2">m<sup>2</sup></div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Lantai Bangunan<span class="required">*</span></label>
								<div class="col-md-2">
									<div class="checkbox-list">
										<input type="text" class="form-control" value="0" name="" placeholder="Lantai Bangunan" autocomplete="off" readonly>
									</div>
								</div>
							</div>
						</div>
						<!-- End SPBU Mikro -->
						<!-- Begin Eksisting SPBU Mikro -->
						<div id="spbu_micro_eks" style="display: none;">
							<div class="form-group">
								<label class="control-label col-md-3">Nama Bangunan<span class="required">*</span></label>
								<div class="col-md-7">
									<input type="text" class="form-control" value="<?php echo set_value('nama_bangunan_pertashop', (isset($DataBangunan->nm_bgn) ? $DataBangunan->nm_bgn : '')) ?>" name="nama_bangunan_pertashop" placeholder="" autocomplete="off">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Luas Bangunan<span class="required">*</span></label>
								<div class="col-md-2">
									<div class="checkbox-list">
										<input type="text" class="form-control" value="10.1" name="" placeholder="" autocomplete="off" >
									</div>
								</div>
								<div class="col-md-2">m<sup>2</sup></div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Tinggi Bangunan<span class="required">*</span></label>
								<div class="col-md-2">
									<div class="checkbox-list">
										<input type="text" class="form-control" value="2.6" name="" placeholder="Tinggi Bangunan" autocomplete="off" >
									</div>
								</div>
								<div class="col-md-2">m<sup>2</sup></div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Lantai Bangunan<span class="required">*</span></label>
								<div class="col-md-2">
									<div class="checkbox-list">
										<input type="text" class="form-control" value="1" name="" placeholder="Lantai Bangunan" autocomplete="off">
									</div>
								</div>
							</div>
						</div>
						<!-- End Eksisting SPBU Mikro -->
						<div id="per_doc_tek" style="display: none;">
							<div class="form-group">
								<label class="col-md-3 control-label">Perancang Dokumen Teknis</label>
								<div class="col-md-7">
									<select name="id_doc_tek" id="id_doc_tek" onchange="set_prototype(this.value)" class="form-control" data-placeholder="Select...">
									</select>
								</div>
							</div>
						</div>
						<div id="prototype" style="display: none;">
							<div class="form-group">
								<label class="col-md-3 control-label">Pilih Prototype</label>
								<div class="col-md-7">
									<select name="id_prototype" id="id_prototype" class="form-control" data-placeholder="Select...">
									</select>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>


<!--<div id="Pemberitahuan" class="modal fade" tabindex="-1" aria-hidden="true" data-width="800px" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<span class="caption-subject text-primary bold uppercase " style="font-size:15px;">
			<center><b>INFORMASI</b></center>
		</span>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12 ">
				<div class="form-body">
					<div class="col-md-12"><br>
						<center><b>TENTANG<br>Update SIMBG</b></center>
					</div>
					<div class="col-md-12"><br>
						Sehubungan dengan telah diundangkan Peraturan Pemerintah Nomor 16 Tahun 2021 Tentang Peraturan Pelaksanaan Undang – Undang Nomor 28 Tahun 2002 Tentang Bangunan Gedung. Untuk Mempermudah Penggunaan SIMBG bagi Pemilik Akun Pemohon(Masyarakat):
						<ol><br>
							<li>SIMBG akan menyesuaikan dengan proses penyelenggaraan bangunan gedung sesuai ketentuan PP Nomor 16
								Tahun 2021.</li>
							<li>SIMBG sebelumnya dapat diakses pada alamat <a href="https://103.211.51.151/">https://103.211.51.151/</a></li>
							<li>Mengantisipasi banyaknya kesalahan yang terjadi pada Dokumen Output dari SIMBG (PBG/SLF), saat ini SIMBG telah dilengkapi dengan fitur konfirmasi kebenaran data dari Pemohon. Proses konfirmasi tersebut agar dimintakan oleh petugas di dinas teknis kepada Pemohon untuk dilakukan segera pasca Proses Perhitungan Retribusi. Kepala Dinas Teknis hanya dapat memberikan pernyataan Pemenuhan Standar Teknis setelah pemohon melakukan konfirmasi kebenaran data.</li>
							<li>Demikian agar menjadi maklum.</li>
						</ol>
					</div>
					<br>
				</div>
			</div>
		</div>
	</div>
	<br>
	<div class="modal-footer">
		<center><button type="button" data-dismiss="modal" class="btn yellow-crusta">Tutup</button></center>
	</div>
</div>-->
<div id="dialog-popup" class="modal fade bs-modal-sm" data-width="55%" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-content">
		<form action="<?php echo site_url('KonsultasiOSS/FormKonfirmasi'); ?>" class="form-horizontal" role="form" method="post">
			<input type="text" style="display: none;" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
			<div class="modal-header">
				<button type="button" onclick="return confirm('Yakin Ingin Keluar?')" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel"></h4>
			</div>
			<div class="modal-body" id="MyModalBody"></div>
			<div class="modal-footer">
				<input class="form-control" type="hidden" id="id" name="id" style="display: block;">
				<center><button type="submit" onclick="return confirm('Yakin Datanya Telah Benar?')" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-check"></span>Cek Data</button></center>
			</div>
		</form>
	</div>
</div>
<!-- /.modal -->
<div id="modal-edit" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false" data-focus-on="input:first">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		</div>
		<!-- /.modal-content -->
	</div>
</div>
<script>
	function GetVerifikasi(id) {
		$("#MyModalBody").html('<iframe src="<?php echo base_url(); ?>KonsultasiOSS/CetakVerifikasi/' + id + '" frameborder="no" width="860" height="540"></iframe>');
		$('[name="id"]').val(id);
	}
	$(".next").click(function(e) {
		var nib = $('.input-nib').val();
		if (nib == 2) {
			$('#PNib').modal('toggle');
			$('#PPsit').modal('show');
			$('#hide_nib').hide();

		} else {
			$('#PNib').modal('toggle');
			$('#INib').modal('show');
			$('#hide_nib').show();
		}
	});

	$("#from_nib").submit(function(event) {
		event.preventDefault();
		var url = $(this).attr('action');
		$.ajax({
			url: url,
			method: "POST",
			data: $(this).serialize(),
			dataType: "json",
			beforeSend: function() {
				$('#contact').attr('disabled', 'disabled');
			},
			success: function(data) {
				if (data.error) {
					$('#csrf_id').val(data.csrf);
					$('#csrf_id_nib').val(data.csrf);
					if (data.no_nib != '') {
						$('#nib_error').html(data.no_nib);
					} else {
						$('#nib_error').html('');
					}
				} else {
					window.location.href = data.url;
				}
				// $('#contact').attr('disabled', false);
			}
		})
	});
	$(function() {
		var table = $('#tableKonsultasi').DataTable({
			"responsive": false,
			"language": {
				"aria": {
					"sortAscending": ": activate to sort column ascending",
					"sortDescending": ": activate to sort column descending"
				},
				"emptyTable": "Data Belum Tersedia",
				"info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ jumlah data",
				"infoEmpty": "Data Tidak Ditemukan",
				"infoFiltered": "",
				"lengthMenu": "Tampilkan _MENU_ Baris",
				"search": "Cari:",
				"zeroRecords": "Data Tidak Ditemukan",
				"oPaginate": {
					"sNext": 'Selanjutnya',
					"sLast": 'Terakhir',
					"sFirst": 'Pertama',
					"sPrevious": 'Sebelumnya'
				}
			},
		});

		table.on('draw.dt', function() {
			$('.tooltips').tooltip(); // Or your function for 
		});


		$(() => {
			let lantaiBangunan = $('.input-lantai').val();
			let basementBangunan = $('.input-basement').val();
			if (parseInt(lantaiBangunan) > 10) {
				$("#uniform-pilihanLantai").find('span').addClass('checked');
				$('#pilihanLantai').attr('checked', true);
				$(".dropdown-lantai").css("display", "none");
				$(".dropdown-lantai ").attr("disabled", true);
				$(".input-lantai").attr("disabled", false);
				$(".input-lantai").css("display", "block");
			} else {
				$('#pilihanLantai').attr('checked', false);
				$(".dropdown-lantai").css("display", "block");
				$(".dropdown-lantai ").attr("disabled", false);
				$(".input-lantai").attr("disabled", true);
				$(".input-lantai").css("display", "none");
			}
			if (parseInt(basementBangunan) > 10) {
				$("#uniform-pilihanBasement").find('span').addClass('checked');
				$('#pilihanBasement').attr('checked', true);
				$(".dropdown-basement").attr("disabled", true);
				$(".input-basement").attr("disabled", false);
				$(".dropdown-basement").css("display", "none");
				$(".input-basement").css("display", "block");
			} else {
				$('#pilihanBasement').prop('checked', true);
				$(".dropdown-basement").attr("disabled", false);
				$(".input-basement").attr("disabled", true);
				$(".dropdown-basement").css("display", "block");
				$(".input-basement").css("display", "none");
			}
			console.log(lantaiBangunan);
		});
		$(".input-number").keypress(function(e) {
			var charCode = (e.which) ? e.which : e.keyCode;
			if (charCode > 31 && (charCode < 48 || charCode > 57)) {
				return false;
			}
		});
		const regex = /[^\d.]|\.(?=.*\.)/g;
		const subst = ``;
		$('.input-comma').keyup(function() {
			const str = this.value;
			const result = str.replace(regex, subst);
			this.value = result;
		});

		$('#pilihanLantai').change(function(e) {
			e.preventDefault();
			if (this.checked) {
				$(".dropdown-lantai").css("display", "none");
				$(".dropdown-lantai ").attr("disabled", true);
				$(".input-lantai").attr("disabled", false);
				$(".input-lantai").css("display", "block");
			} else {
				$(".dropdown-lantai").css("display", "block");
				$(".dropdown-lantai ").attr("disabled", false);
				$(".input-lantai").attr("disabled", true);
				$(".input-lantai").css("display", "none");
			}
		});

		$('#pilihanBasement').change(function(e) {
			e.preventDefault();
			if (this.checked) {
				$(".dropdown-basement").attr("disabled", true);
				$(".input-basement").attr("disabled", false);
				$(".dropdown-basement").css("display", "none");
				$(".input-basement").css("display", "block");
			} else {
				$(".dropdown-basement").attr("disabled", false);
				$(".input-basement").attr("disabled", true);
				$(".dropdown-basement").css("display", "block");
				$(".input-basement").css("display", "none");
			}
		});
		$('.select2').select2();
		// Setup form validation on the #register-form element
		$("#FormPermohonan").validate({
			// Specify the validation rules
			rules: {
				id_izin: "required",
				id_fungsi_bg: "required",
				permohonan_slf: "required",
				id_jns_bg: "required",
				'dcampur[]': {
					minlength: 2,
					required: true
				},
				id_doc_tek: "required",
				nama_bangunan: "required",
				luas_bg: "required",
				lantai_bg: "required",
				tinggi_bg: "required",
				id_prasarana_bg: "required",
				tinggi_bgp: "required",
				luas_bgp: "required",
				imb: "required",
				slf: "required",
				no_imb: "required",
				no_slf: "required",
				id_prototype: "required",
			},
			highlight: function(element) {
				$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
			},
			unhighlight: function(element) {
				$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
			},
			errorClass: 'help-block',
			// Specify the validation error messages
			messages: {
				id_izin: "Pilih Jenis Permohonan",
				id_fungsi_bg: "Pilih Fungsi Bangunan",
				permohonan_slf: "Pilih Permohonan Slf",
				id_jns_bg: "required",
				'dcampur[]': "",
				id_doc_tek: "required",
				nama_bangunan: "Isi Nama Bangunan",
				luas_bg: "Isi Luas Bangunan",
				lantai_bg: "Isi Jumlah Lantai",
				tinggi_bg: "Isi Tinggi Bangunan",
				id_prasarana_bg: "required",
				tinggi_bgp: "Isi Tinggi Bangunan Prasarana",
				luas_bgp: "Isi Luas Bangunan Prasarana",
				imb: "",
				slf: "",
				id_prototype: "required",
			},
			submitHandler: function(form) {
				form.submit();
				document.getElementById("FormPermohonan").reset();
			}
		});
	});
	function GetTandaPermohonan(id) {
		$("#MyModalBody").html('<iframe src="<?php echo base_url(); ?>pengajuan/SuratTandaTerima/' + id +
			'" frameborder="no" width="860" height="540"></iframe>');
		$('[name="id_permohonannya"]').val(id);
	}
	function GetCetakSurat(id) {
		var url = "<?php echo base_url() . index_page() ?>KonsultasiOSS/cetak_surat/";
		swin = window.open(url, 'win',
			'scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
		swin.focus();
	}

	function GetRetribusi(id) {
		var url = "<?php echo base_url() . index_page() ?>KonsultasiOSS/cetak_retribusi/";
		swin = window.open(url, 'win',
			'scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
		swin.focus();
	}
	function GetSLF(id) {
		var url = "<?php echo base_url() . index_page() ?>KonsultasiOSS/cetak_SLF/";
		swin = window.open(url, 'win',
			'scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
		swin.focus();
	}
	function show_jenisPem(v) {
		if (v == 1) {
			$('#id_izin').val(0);
			$('#id_izin').prop('disabled', false);
			$("#id_izin option[value='2']").hide();
			$('#id_existing').val('');
			document.getElementById('show_imb').style.display = "none";
			document.getElementById('show_slf').style.display = "none";
			getjenisPermohonan(1);

		} else if (v == 2) {
			$("#id_izin option[value='2']").show();
			$('#id_izin').val(2);
			$('#id_existing').val(2);
			$('#id_izin').prop('disabled', true);
			document.getElementById('show_imb').style.display = "none";
			document.getElementById('show_slf').style.display = "none";
			getjenisPermohonan(2);
		} else if (v == 3){

			getjenisPermohonan();
			getSBKBG();
		}
	}

	function show_keyID(v){
		$('#idPer').val(v);
	}

	function getSBKBG() {
		document.getElementById('show_imb').style.display = "block";
		document.getElementById('show_slf').style.display = "block";
		document.getElementById('fungsibg').style.display = "block";
		document.getElementById('jns_bg_toggle').style.display = "block";
	}

	function getjenisPermohonan(v) {
		if (v == '1' || v == '3' || v == '8') {
			document.getElementById('prasarana').style.display = "none";
			document.getElementById('show_jenisPer').style.display = "block";
			document.getElementById('fungsibg').style.display = "block";
			document.getElementById('permohonan_slf_show').style.display = "none";
			document.getElementById('per_doc_tek').style.display = "none";
			document.getElementById('prototype').style.display = "none";
			document.getElementById('jual_bg').style.display = "none";
			document.getElementById('per_imb').style.display = "none";
			document.getElementById('KolektifInduk').style.display = "none";
			document.getElementById('per_slf').style.display = "none";
			document.getElementById('per_cetak').style.display = "none";
			document.getElementById('spbu_micro').style.display = "none";
		} else if (v == '2') {
			document.getElementById('prasarana').style.display = "none";
			document.getElementById('show_jenisPer').style.display = "block";
			document.getElementById('per_imb').style.display = "block";
			document.getElementById('fungsibg').style.display = "none";
			document.getElementById('permohonan_slf_show').style.display = "block";
			document.getElementById('jns_bg_toggle').style.display = "none";
			document.getElementById('detail_bg').style.display = "none";
			document.getElementById('per_doc_tek').style.display = "none";
			document.getElementById('prototype').style.display = "none";
			document.getElementById('jual_bg').style.display = "none";
			document.getElementById('KolektifInduk').style.display = "none";
			document.getElementById('per_slf').style.display = "none";
			document.getElementById('per_cetak').style.display = "none";
			document.getElementById('spbu_micro').style.display = "none";
		} else if (v == '4') {
			document.getElementById('prasarana').style.display = "none";
			document.getElementById('show_jenisPer').style.display = "block";
			document.getElementById('KolektifInduk').style.display = "block";
			document.getElementById('per_imb').style.display = "none";
			document.getElementById('fungsibg').style.display = "none";
			document.getElementById('permohonan_slf_show').style.display = "none";
			document.getElementById('jns_bg_toggle').style.display = "none";
			document.getElementById('detail_bg').style.display = "none";
			document.getElementById('per_doc_tek').style.display = "none";
			document.getElementById('prototype').style.display = "none";
			document.getElementById('jual_bg').style.display = "none";
			document.getElementById('per_slf').style.display = "none";
			document.getElementById('per_cetak').style.display = "none";
			document.getElementById('spbu_micro').style.display = "none";
		} else if (v == '5') {
			document.getElementById('prasarana').style.display = "block";
			document.getElementById('show_jenisPer').style.display = "block";
			document.getElementById('KolektifInduk').style.display = "none";
			document.getElementById('per_imb').style.display = "none";
			document.getElementById('fungsibg').style.display = "none";
			document.getElementById('permohonan_slf_show').style.display = "none";
			document.getElementById('jns_bg_toggle').style.display = "none";
			document.getElementById('detail_bg').style.display = "none";
			document.getElementById('per_doc_tek').style.display = "none";
			document.getElementById('prototype').style.display = "none";
			document.getElementById('jual_bg').style.display = "none";
			document.getElementById('per_slf').style.display = "none";
			document.getElementById('per_cetak').style.display = "none";
			document.getElementById('spbu_micro').style.display = "none";
		} else if (v == '6') {
			document.getElementById('prasarana').style.display = "none";
			document.getElementById('show_jenisPer').style.display = "block";
			document.getElementById('per_imb').style.display = "none";
			document.getElementById('fungsibg').style.display = "block";
			document.getElementById('permohonan_slf_show').style.display = "none";
			document.getElementById('jns_bg_toggle').style.display = "none";
			document.getElementById('detail_bg').style.display = "none";
			document.getElementById('per_doc_tek').style.display = "none";
			document.getElementById('prototype').style.display = "none";
			document.getElementById('jual_bg').style.display = "none";
			document.getElementById('KolektifInduk').style.display = "none";
			document.getElementById('per_slf').style.display = "none";
			document.getElementById('per_cetak').style.display = "none";
			document.getElementById('spbu_micro').style.display = "none";
		} else if (v == '7') {
			document.getElementById('prasarana').style.display = "none";
			document.getElementById('show_jenisPer').style.display = "none";
			document.getElementById('per_imb').style.display = "none";
			document.getElementById('fungsibg').style.display = "none";
			document.getElementById('permohonan_slf_show').style.display = "none";
			document.getElementById('jns_bg_toggle').style.display = "none";
			document.getElementById('detail_bg').style.display = "none";
			document.getElementById('per_doc_tek').style.display = "none";
			document.getElementById('prototype').style.display = "none";
			document.getElementById('jual_bg').style.display = "none";
			document.getElementById('KolektifInduk').style.display = "none";
			document.getElementById('per_slf').style.display = "none";
			document.getElementById('per_cetak').style.display = "none";
			document.getElementById('spbu_micro').style.display = "block";
		} else {
			document.getElementById('prasarana').style.display = "none";
			document.getElementById('show_jenisPer').style.display = "none";
			document.getElementById('per_imb').style.display = "none";
			document.getElementById('fungsibg').style.display = "none";
			document.getElementById('permohonan_slf_show').style.display = "none";
			document.getElementById('jns_bg_toggle').style.display = "none";
			document.getElementById('detail_bg').style.display = "none";
			document.getElementById('per_doc_tek').style.display = "none";
			document.getElementById('prototype').style.display = "none";
			document.getElementById('jual_bg').style.display = "none";
			document.getElementById('KolektifInduk').style.display = "none";
			document.getElementById('per_slf').style.display = "none";
			document.getElementById('per_cetak').style.display = "none";
			document.getElementById('spbu_micro').style.display = "none";
		}
	}

	function show_slf(v) {
		var slf = v.value;
		if (slf == '1') {
			document.getElementById('show_imb').style.display = "block";
			document.getElementById('per_slf').style.display = "block";
			document.getElementById('per_cetak').style.display = "none";
		} else {
			document.getElementById('show_imb').style.display = "none";
			document.getElementById('per_slf').style.display = "block";
		}
		show_cetak()
	}

	function show_cetak() {
		var imb = document.getElementsByName('imb');
		for (i = 0; i < imb.length; i++) {
			if (imb[i].checked)
				imb = imb[i].value;
		}
		var slf = document.getElementsByName('slf');
		for (i = 0; i < slf.length; i++) {
			if (slf[i].checked)
				slf = slf[i].value;
		}
		if (imb == '1' && slf == '1') {
			document.getElementById('per_cetak').style.display = "block";
		} else {
			document.getElementById('per_cetak').style.display = "none";
		}

		if (slf == '1') {
			document.getElementById('show_slf').style.display = "block";
		} else {
			document.getElementById('show_slf').style.display = "none";
		}
	}

	function set_jns_bg(v) {
		if (v == 6) {
			document.getElementById('detail_bg').style.display = "block";
			document.getElementById('campurincek').style.display = "block";
			document.getElementById('jns_bg_toggle').style.display = "none";
		} else {
			document.getElementById('detail_bg').style.display = "none";
			document.getElementById('campurincek').style.display = "none";
			document.getElementById('jns_bg_toggle').style.display = "block";
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>KonsultasiOSS/getDataJnsBg/" + v,
				data: $('form.form-horizontal').serialize(),
				success: function(response) {
					let data = JSON.parse(response);
					let csrf_token = data.csrf;
					$('#csrf_id').val(csrf_token);
					var jenis_bg = '<option value="">-- Pilih --</option>';
					$.each(data, function(key, value) {
						jenis_bg += '<option value="' + value.id_jns_bg + '"> ' + value.nm_jenis_bg + ' </option>';
					});
					$('#id_jns_bg').html(jenis_bg);
				},
				error: function(error) {
					alert(' Tidak Ditemukan');
				}
			});
		}
		if (v == '') {
			document.getElementById('jual_bg').style.display = "none";
			document.getElementById('prototype').style.display = "none";
		} else if (v == '3') {
			document.getElementById('jual_bg').style.display = "block";
			document.getElementById('per_doc_tek').style.display = "none";
			document.getElementById('prototype').style.display = "none";
		} else {
			document.getElementById('jual_bg').style.display = "none";
			document.getElementById('per_doc_tek').style.display = "none";
			document.getElementById('prototype').style.display = "none";
		}
	}

	function set_permohonan_slf(v) {
		if (v == '1') {
			document.getElementById('fungsibg').style.display = "block";
			document.getElementById('prasarana').style.display = "none";
			document.getElementById('spbu_micro_eks').style.display = "none";
		} else if (v == '2') {
			document.getElementById('prasarana').style.display = "block";
			document.getElementById('fungsibg').style.display = "none";
			document.getElementById('jns_bg_toggle').style.display = "none";
			document.getElementById('detail_bg').style.display = "none";
			document.getElementById('per_doc_tek').style.display = "none";
			document.getElementById('prototype').style.display = "none";
			document.getElementById('jual_bg').style.display = "none";
			document.getElementById('KolektifInduk').style.display = "none";
			document.getElementById('spbu_micro_eks').style.display = "none";
		} else if(v == '3'){
			document.getElementById('fungsibg').style.display = "none";
			document.getElementById('prasarana').style.display = "none";
			document.getElementById('spbu_micro').style.display = "none";
			document.getElementById('spbu_micro_eks').style.display = "block";
		}else{
			document.getElementById('prasarana').style.display = "none";
			document.getElementById('fungsibg').style.display = "none";
			document.getElementById('jns_bg_toggle').style.display = "none";
			document.getElementById('detail_bg').style.display = "none";
			document.getElementById('per_doc_tek').style.display = "none";
			document.getElementById('prototype').style.display = "none";
			document.getElementById('jual_bg').style.display = "none";
			document.getElementById('KolektifInduk').style.display = "none";
			document.getElementById('spbu_micro_eks').style.display = "none";

		}
	}
	function show_detail(v) {
		if (v == '') {
			document.getElementById('detail_bg').style.display = "none";
		} else {
			document.getElementById('detail_bg').style.display = "block";
		}
	}
	function cek() {
		var luas_bg = $('#luas_bg').val();
		var lantai_bg = $('#lantai_bg').val();
		if ($("#id_izin").val() == 1) {
			if ($("#id_fungsi_bg").val() == 1) {
				if (luas_bg <= 100 && lantai_bg <= 2) {
					document.getElementById('per_doc_tek').style.display = "block";
					document.getElementById('prototype').style.display = "none";
					var select_tek = '';
					var select_tek2 = '';
					var select_tek3 = '';
					var select_tek4 = '';
					var id_doc_tek = '<option value="1" ' + select_tek + '>Disediakan oleh Penyedia Jasa Konstruksi</option>';
					id_doc_tek += '<option value="2" ' + select_tek2 + '>Menggunakan Desain Prototipe dari Pemda</option>';
					id_doc_tek += '<option value="3" ' + select_tek3 + '>Mengembangan Desain Prototipe dari Pemda</option>';
					id_doc_tek += '<option value="4" ' + select_tek4 + '>Desain Berdasarkan Ketetuan Pokok Tahan Gempa</option>';
				} else {
					document.getElementById('per_doc_tek').style.display = "block";
					document.getElementById('prototype').style.display = "none";
					var id_doc_tek = '<option value="1" selected>Disediakan oleh Penyedia Jasa Konstruksi</option>';
				}
			} else {
				document.getElementById('per_doc_tek').style.display = "block";
				document.getElementById('prototype').style.display = "none";
				var id_doc_tek = '<option value="1" selected>Disediakan oleh Penyedia Jasa Konstruksi</option>';
			}
			$('#id_doc_tek').html(id_doc_tek);
		}
	}

	function set_prototype(v) {
		if (v == 2 || v == 3) {
			document.getElementById('prototype').style.display = "block";
			var select_1 = '';
			var select_2 = '';
			var select_3 = '';
			var id_type = '<option value="1" ' + select_1 + '>Type 36</option>';
			id_type += '<option value="2" ' + select_2 + '>Type 54</option>';
			id_type += '<option value="3" ' + select_3 + '>Type 72</option>';
		} else {
			document.getElementById('prototype').style.display = "none";
		}
		$('#id_prototype').html(id_type);
	}

	function addTipe() {
		var lastRow = $('#tipe_bgn').find("tr").length;
		var emptyrows = 0;
		for (i = 1; i < lastRow; i++) {
			if ($("#tipe" + i).val() == '') {
				emptyrows += 1;
			}
		}
		var isi = `<td><?php echo form_input("tipeA[` + lastRow +`]", "", "class=\'form-control\' style=\'width:60px;\' id=\'tipe` + lastRow + `\'"); ?></td>'`;
		isi += `<td><?php echo form_input("jumlahA[` + lastRow +`]", "", "class=\'form-control\' style=\'width:60px;\' id=\'jumlah` + lastRow + `\'"); ?></td>'`;
		isi += `<td><?php echo form_input("luasA[` + lastRow +`]", "", "class=\'form-control\' style=\'width:60px;\' id=\'luas` + lastRow + `\'"); ?></td>'`;
		isi += `<td><?php echo form_input("tinggiA[` + lastRow +`]", "", "class=\'form-control\' style=\'width:60px;\' id=\'tinggi` + lastRow +`\'"); ?></td>'`;
		isi += `<td><?php echo form_input("lantaiA[` + lastRow +`]", "", "class=\'form-control\' style=\'width:60px;\' id=\'lantai` + lastRow + `\'"); ?></td>'`;

		isi +=
			`<td><a class="btn btn-info" href="javascript:void(0);" onclick="if(checkDeleteTipeRow() == true){$(this).parent().parent().remove()}" ><i class="fa fa-trash left-icon"></i></a></td>`;
		if (emptyrows == 0) {
			$('#tipe_bgn').children().append("<tr id='tr-tipe'>" + isi + "</tr>")
		} else {
			$('#dialog-message').attr('title', 'Perhatian').html(
				"Silahkan mengisi data pada baris yang tersedia terlebih dahulu, sebelum menambah baris.").dialog();
		}
	}

	function checkDeleteTipeRow() {
		var tbl = $('#tipe_bgn');
		var lastRow = tbl.find("tr").length;
		if (lastRow > 2) {
			return true
		} else {
			$('#dialog-message').attr('title', 'Perhatian').html("Data tim audit tidak boleh kosong.").dialog();
			return false;
		}
	}

	function addUnit() {
		var lastRow = $('#unit_bgn').find("tr").length;
		var emptyrows = 0;
		for (i = 1; i < lastRow; i++) {
			if ($("#unit" + i).val() == '') {
				emptyrows += 1;
			}
		}
		var isi = `<td><?php echo form_input("unitA[` + lastRow +
			`]", "", "class=\"form-control\" style=\"width:150px;\" id=\"unit` + lastRow + `\""); ?></td>'`;

		isi +=
			`<td><a class="btn btn-info" href="javascript:void(0);" onclick="if(checkDeleteUnitRow() == true){$(this).parent().parent().remove()}" ><i class="fa fa-trash left-icon"></i></a></td>`;

		if (emptyrows == 0) {
			$('#unit_bgn').children().append("<tr id='tr-unit'>" + isi + "</tr>")
		} else {
			$('#dialog-message').attr('title', 'Perhatian').html(
				"Silahkan mengisi data pada baris yang tersedia terlebih dahulu, sebelum menambah baris.").dialog();
		}
	}

	function checkDeleteUnitRow() {
		var tbl = $('#unit_bgn');
		var lastRow = tbl.find("tr").length;
		if (lastRow > 2) {
			return true
		} else {
			$('#dialog-message').attr('title', 'Perhatian').html("Data tim audit tidak boleh kosong.").dialog();
			return false;
		}
	}

	function addTinggi() {
		var lastRow = $('#tinggi_bgn').find("tr").length;
		var emptyrows = 0;
		for (i = 1; i < lastRow; i++) {
			if ($("#tinggi" + i).val() == '') {
				emptyrows += 1;
			}
		}
		var isi = `<td><?php echo form_input("tinggiA[` + lastRow +
			`]", "", "class=\"form-control\" class=\"form-control\" style=\"width:150px;\" id=\"tinggi` + lastRow +
			`\""); ?></td>'`;
		isi +=
			`<td><a class="btn btn-info" href="javascript:void(0);" onclick="if(checkDeleteTinggieRow() == true){$(this).parent().parent().remove()}" ><i class="fa fa-trash left-icon"></i></a></td>`;
		if (emptyrows == 0) {
			$('#tinggi_bgn').children().append("<tr id='tr-tinggi'>" + isi + "</tr>")
		} else {
			$('#dialog-message').attr('title', 'Perhatian').html(
				"Silahkan mengisi data pada baris yang tersedia terlebih dahulu, sebelum menambah baris.").dialog();
		}
	}

	function checkDeleteTinggieRow() {
		var tbl = $('#tinggi_bgn');
		var lastRow = tbl.find("tr").length;
		if (lastRow > 2) {
			return true
		} else {
			$('#dialog-message').attr('title', 'Perhatian').html("Data tim audit tidak boleh kosong.").dialog();
			return false;
		}
	}
	$(".allownumericwithoutdecimal").on("keypress keyup blur", function(event) {
		$(this).val($(this).val().replace(/[^\d].+/, ""));
		if ((event.which < 48 || event.which > 57)) {
			event.preventDefault();
		}
	});
</script>
<script type="text/javascript">
	$('#Pemberitahuan').modal('show');
</script>