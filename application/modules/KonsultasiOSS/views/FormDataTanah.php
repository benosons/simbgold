<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Data Konsultasi
				</div>
			</div>
			<?php $this->load->view('HeaderData') ?>
			<?php echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '</div>' : ''; ?>
			<div class="portlet box blue-hoki">
				<div class="portlet-title">
					<div class="caption">Data Tanah </div>
				</div>
				<div class="portlet-body">
					<a href="#tanahIMBnya" role="button" class="btn red" data-toggle="modal">Tambah Data</a>
					<div class="table-scrollable">
						<table class="table table-bordered table-striped table-hover" id="sample_editable_1">
							<thead>
								<tr class="warning">
									<th><center>No.</center></th>
									<th><center>Jenis Dokumen</center></th>
									<th><center>No. dan Tgl Dokumen</center></th>
									<th><center>Luas Tanah (m2)</center></th>
									<th><center>Atas Nama</center></th>
									<th><center>Berkas</center></th>
									<!--<th><center>Izin Pemanfaatan</center></th>-->
									<th><center>Aksi</center></th>
								</tr>
							</thead>
							<tbody>
								<?php
								if ($DataTanah->num_rows() > 0) {
									$no = 1;
									foreach ($DataTanah->result() as $key) {
										if ($key->id_dokumen == '1') {
											$jenis_dokumen = "Sertifikat";
										} else if ($key->id_dokumen == '2') {
											$jenis_dokumen = "Akte Jual Beli";
										} else if ($key->id_dokumen == '3') {
											$jenis_dokumen = "Girik";
										} else if ($key->id_dokumen == '4') {
											$jenis_dokumen = "Petuk";
										} else {
											$jenis_dokumen = "Bukti Lain - Lain";
										}
										$filename = FCPATH . "/object-storage/dekill/Earth/$key->dir_file";
										$filenamephat = FCPATH . "/object-storage/dekill/Earth/$key->dir_file_phat";
										$dir = '';
										if (file_exists($filename)) {
											$dir = base_url('object-storage/dekill/Earth/' . $key->dir_file);
										} else {
											$dir = base_url('object-storage/file/Konsultasi/' . $key->id . '/data_tanah/' . $key->dir_file);
										}
										if (file_exists($filenamephat)) {
											$dirphat = base_url('object-storage/dekill/Earth/' . $key->dir_file_phat);
										} else {
											$dirphat = base_url('object-storage/file/Konsultasi/' . $key->id . '/data_tanah/' . $key->dir_file_phat);
										}
										$dir1	= $this->Outh_model->Encryptor('encrypt', $dir);
										$dirphat1	= $this->Outh_model->Encryptor('encrypt', $dirphat);
										?>
										<tr>
											<td align="center"> <?php echo $no++; ?></td>
											<td align="center"> <?php echo $jenis_dokumen; ?></td>
											<td align="center"> <?php echo $key->no_dok; ?><br><?php echo $key->tanggal_dok; ?></td>
											<td align="center"> <?php echo $key->luas_tanah; ?></td>
											<td align="center"> <?php echo $key->atas_nama_dok; ?></td>
											<td align="center">
											<a href="javascript:void(0);" onClick="javascript:popWin('<?php echo $dir; ?>')" class="btn default btn-xs blue-stripe">Lihat</a>
											</td>
											<!--<?php if ($key->dir_file_phat != "") { ?>
												<td align="center">
												<a href="<?php echo site_url('Docreader/PDFRead/' . $dirphat1); ?>" class="btn default btn-xs blue-stripe">Lihat</a>
											</td>
											<?php } else { ?>
												<td></td>
											<?php } ?>-->
											<td align="center">
												<a href="<?php echo site_url('Konsultasi/removeDataTanah/' . $key->id_detail . '/' . $key->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ini?')" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a>
											</td>
										</tr>
								<?php }
								} ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<?php if ($DataBangunan->id_jenis_permohonan == '14'|| $DataBangunan->id_jenis_permohonan == '23' || $DataBangunan->id_jenis_permohonan == '24' || $DataBangunan->id_jenis_permohonan == '26' || $DataBangunan->id_jenis_permohonan == '29' || $DataBangunan->id_jenis_permohonan == '35' || $DataBangunan->id_jenis_permohonan == '36' ) { ?>
				
			<?php } else { ?>
				<div class="table-scrollable">
					<table class="table table-bordered table-striped table-hover" id="sample_editable_1">
						<thead>
							<tr class="warning">
								<th>No</th>
								<th width="45%">Data Teknis Tanah</th>
								<th width="40%">Keterangan</th>
								<th width="15%">Berkas</th>
							</tr>
						</thead>
						<tbody>
							<?php if (!empty($DataTkTanah)) {
								$no = 1;
								foreach ($DataTkTanah->result() as $key) {
									if ($no % 2 == 0)
										$clss = "event";
									else
										$clss = "event2";
									$id_teknis 	= '';
									$dir_file		 	= '';
									if (!empty($DataTeknisTanah)) {
										foreach ($DataTeknisTanah->result() as $keyChild) {
											$file = $keyChild->dir_file;
											$id_persyaratan_detail = $keyChild->id_persyaratan_detail;
											$status_verifikasi = $keyChild->status;
											$id_data_administrasi = $keyChild->id_detail;
											if ($key->id_detail == $id_persyaratan_detail) {
												$id_teknis = $id_data_administrasi;
												if ($file != '' or $file != null) {
													$dir_file = $file;
													$urut_file = $id_persyaratan_detail;
												}
											}
										}
									} ?>
									<tr class="<?= $clss ?>">
										<td align="center"><?php echo $no++; ?></td>
										<td align="left"><?php echo $key->nm_dokumen; ?></td>
										<td align="left"><?php echo $key->keterangan; ?></td>
										<td align="center">
											<?php echo form_open_multipart('KonsultasiOSS/SaveDokumen/' . $id . '/' . $key->id_detail . '/1/' . $id_teknis, array('name' => 'frmup' . $no, 'id' => 'frmup' . $no)); ?>

											<?php if ($dir_file == '' or $dir_file == null) { ?>
												<input type="file" name="d_file" id="d_file" placeholder="Unggah Berkas Disini" accept="application/pdf" onchange="form.submit()">
											<?php } else {
												$filename = FCPATH . "/dekill/Requirement/$dir_file";
												$dir = '';
												if (file_exists($filename)) {
													$dir = base_url('dekill/Requirement/' . $dir_file);
												} else {
													$dir = base_url('file/Konsultasi/' . $id . '/Dokumen/' . $dir_file);
												}
											?>
												<center>
													<a href="javascript:void(0);" onClick="javascript:popWin('<?php echo $dir; ?>')" class="btn default btn-xs blue-stripe">Lihat</a>
													|
													<a href="<?php echo site_url('KonsultasiOSS/DeleteTeknisTanah/' . $id_teknis . '/tek/' . $id ); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ini?')" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a>
												</center>
											<?php } ?>
											<?php echo form_close(); ?>
										</td>
									</tr>
							<?php }
							} ?>
						</tbody>
					</table>
				</div>
			<?php } ?>
			<center>
				<span class="input-group-btn">
				<?php 
				if($DataBangunan->sbkbg == 1){ ?>
					<button class="btn green" onClick="window.location.href = '<?php echo base_url(); ?>KonsultasiOSS/Form_PemilikSbkbg/<?php echo $DataBangunan->id_bgn; ?>';return false;">Kembali</button>
					<?php } else { ?>
						<button class="btn green" onClick="window.location.href = '<?php echo base_url(); ?>KonsultasiOSS/FormBangunan/<?php echo $this->secure->encrypt_url($id); ?>';return false;">Kembali</button>
					<?php } ?>
				</span>
				<?php if ($DataTanah->num_rows() > 0) { ?>
					<span class="input-group-btn">
						<button class="btn green" onClick="window.location.href = '<?php echo base_url(); ?>KonsultasiOSS/FormDataDokumen/<?php echo $this->secure->encrypt_url($id); ?>';return false;">Selanjutnya</button>
					</span>
				<?php } else { ?>
					<span class="input-group-btn">
						<button class="btn green" onclick="return confirm('Data Tanah Belum Ada, Mohon diinput sebelum melanjutkan!')" ;return false;">Selanjutnya</button>
					</span>
				<?php } ?>
			</center>
			<br>
		</div>
	</div>
</div>
<!-- /.modal -->
<div id="tanahIMBnya" class="modal fade" role="dialog" aria-hidden="true" data-width="60%" data-backdrop="static" data-keyboard="false">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h4 class="modal-title">Tambah Data Tanah</h4>
		</div>
		<div class="modal-body form">
			<form action="<?php echo site_url('KonsultasiOSS/saveTanah'); ?>" class="form-horizontal" role="form" method="post" id="FormTambahTanah" enctype="multipart/form-data">
				<div class="portlet-body form">
					<div class="form-body">
						<br>
						<input type="text" class="form-control" value="<?= (isset($DataBangunan->id) ? $DataBangunan->id : ''); ?>" name="id" style="display: none;" autocomplete="off">
						<input type="text" class="form-control" value="<?= (isset($id_provinsi_bg) ? $id_provinsi_bg : ''); ?>" name="nama_provinsi" style="display: none;" autocomplete="off">
						<input type="text" class="form-control" value="<?= (isset($id_kec_bg) ? $id_kec_bg : ''); ?>" name="nama_kecamatan" style="display: none;" autocomplete="off">
						<input type="text" class="form-control" value="<?= (isset($id_kabkot_bg) ? $id_kabkot_bg : ''); ?>" name="nama_kabkota" style="display: none;" autocomplete="off">
						<input type="hidden" id='csrf_id' name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-circle"></i></span>
										<select name="id_dokumen" id="id_dokumen" class="form-control" onchange="">
											<option value="">Pilih</option>
											<option value="1">Sertifikat</option>
											<option value="2">Akte Jual Beli</option>
											<option value="3">Girik</option>
											<option value="4">Petuk</option>
											<option value="5">Bukti Lain - Lain</option>
										</select>
										<label for="form_control_1">Jenis Dokumen Kepemilikan Data Tanah</label>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-circle"></i></span>
										<input class="form-control" id="nomor_dokumen" name="nomor_dokumen" type="text" placeholder="0-9 / A-Z" autocomplete="off">
										<label for="form_control_1">Nomor Dokumen Data Tanah</label>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										<input class="form-control date-picker" type="text" id="tgl_terbit_dokumen" name="tgl_terbit_dokumen" data-date-format="yyyy-mm-dd" autocomplete="off" placeholder="2000/12/31" />
										<label for="form_control_1">Tanggal Terbit Dokumen</label>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-circle"></i></span>
										<input class="form-control" id="luas_tanah" name="luas_tanah" type="text" placeholder="Luas Tanah 00.00" autocomplete="off">
										<label for="form_control">Luas Tanah (<i> meter<sup> 2 </sup></i>)</label>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-circle"></i></span>
										<select name="hat" id="hat" class="form-control" onchange="">
											<option value="">Pilih</option>
											<option value="1">Hak Milik</option>
											<option value="2">Hak Pakai</option>
											<option value="3">Hak Pengelolaan</option>
											<option value="4">Hak Guna Bangunan</option>
											<option value="5">Hak Guna Usaha</option>
											<option value="6">Hak Wakaf</option>
										</select>
										<label for="form_control_1">Hak Kepemilikan Atas Tanah</label>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-circle"></i></span>
										<input class="form-control" id="atas_nama" name="atas_nama" type="text" placeholder="Nama Pemegang Hak Atas Tanah" autocomplete="off">
										<label for="form_control">Nama Pemilik Hak Atas Tanah</label>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group form-md-line-input">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-circle"></i></span>
										<input type="text" class="form-control" value='<?= (isset($alamat_bg) ? $alamat_bg :  $DataBangunan->almt_bgn . " Kec. " . $DataBangunan->nama_kecamatan . ", " . ucwords(strtolower($DataBangunan->nama_kabkota)) . ", Prov. " . $DataBangunan->nama_provinsi); ?>' rows="1" placeholder="Lokasi Tanah" id="lokasi_tanah" name="lokasi_tanah" readonly>
										<label for="form_control_1">Alamat Lokasi Tanah</label>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-circle"></i></span>
										<input style="display: none;" name="dir_file_tan" id="dir_file_tan" onchange='coktan()'>
										<input type="file" class="form-control" name="d_file_tan" id="d_file_tan" accept="application/pdf" onchange='coktan()'>
										<label for="form_control_1">File Data Kepemilikan Tanah</label>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-circle"></i></span>
										<select name="hat2" id="hat2" class="form-control" onclick="set_status_izin_pemanfaatan(this.value)">
											<option value="">Pilih</option>
											<option value="1">YA</option>
											<option value="2">Tidak</option>
										</select>
										<label for="form_control_1">Izin pemanfaatan dari pemegang hak atas tanah</label>
									</div>
								</div>
							</div>
							<div id="izinjing" style="display: none;">
								<h3 class="title">&nbsp;</h3>
								<div class="col-md-6">
									<div class="form-group form-md-line-input">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-circle"></i></span>
											<input class="form-control" id="no_dok_izin_pemanfaatan" name="no_dok_izin_pemanfaatan" type="text" placeholder="0-9 / A-Z" autocomplete="off">
											<label for="form_control_1">Nomor Dokumen Izin Pemanfaatan</label>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-md-line-input">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											<input class="form-control date-picker" type="text" id="tgl_terbit_phat" name="tgl_terbit_phat" data-date-format="yyyy-mm-dd" placeholder="2000/12/31" autocomplete="off" />
											<label for="form_control_1">Tanggal Terbit Izin Pemanfaatan</label>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-md-line-input">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-circle"></i></span>
											<input class="form-control" id="nama_penerima_kuasa" name="nama_penerima_kuasa" type="text" placeholder="Nama Penerima Izin Pemanfaatan" autocomplete="off">
											<label for="form_control">Nama Penerima Izin Pemanfaatan</label>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-md-line-input">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-circle"></i></span>
											<input style="display: none;" name="dir_file_phat" id="dir_file_phat" onchange='cokphat()'>
											<input type="file" class="form-control" name="d_file_phat" id="d_file_phat" accept="application/pdf" onchange='cokphat()'>
											<label for="form_control_1">Berkas Izin Pemanfaatan</label>
										</div>
									</div>
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
<!-- /.modaledit -->
<div id="tanahnyaedit" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		</div>
	</div>
</div>
<script>
	function popWin(x) {
		url = x;
		swin = window.open(url, 'win', 'scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
		swin.focus();
	}

	function set_status_izin_pemanfaatan(v) {
		if (v == '1') {
			document.getElementById('izinjing').style.display = "block";
		} else {
			document.getElementById('izinjing').style.display = "none";
		}
	}

	function coktan() {

		$('#dir_file_tan').val(d_file_tan.value);
	}

	function cokphat() {

		$('#dir_file_phat').val(d_file_phat.value);
	}

	$(function() {
		// Setup form validation on the #register-form element
		$("#FormTambahTanah").validate({
			// Specify the validation rules
			rules: {
				id_dokumen: "required",
				nomor_dokumen: "required",
				tgl_terbit_dokumen: "required",
				luas_tanah: "required",
				hat2: "required",
				hat: "required",
				atas_nama: "required",
				lokasi_tanah: "required",
				d_file_tan: "required",
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
				id_dokumen: "",
				nomor_dokumen: "",
				tgl_terbit_dokumen: "",
				luas_tanah: "",
				hat2: "",
				hat: "",
				atas_nama: "",
				lokasi_tanah: "",
				d_file_tan: "",
			},
			submitHandler: function(form) {
				form.submit();
			}
		});
	});
</script>