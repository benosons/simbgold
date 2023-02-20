<div class="row">
	<div class="col-md-12">
		<?php echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '</div>' : ''; ?>
		<div class="table-scrollable">
				<table id="data_administrasi" class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>No</th>
							<th width="45%">Data Umum</th>
							<th width="45%">Keterangan</th>
							<th width="10%">Berkas</th>
						</tr>
					</thead>
					<tbody>
						<?php if (!empty($DokumenUmum)) {
							$no = 1;
							foreach ($DokumenUmum->result() as $key) {
								if ($no % 2 == 0)
								$clss = "event";
									else
								$clss = "event2";
								$id_administrasi 	= '';
								$dir_file		 	= '';
								if (!empty($DataUmum)) {
									foreach ($DataUmum->result() as $keyChild) {
										$file = $keyChild->dir_file;
										$id_persyaratan_detail = $keyChild->id_persyaratan_detail;
										$status_verifikasi = $keyChild->status;
										$id_data_administrasi = $keyChild->id_detail;
										if ($key->id_detail == $id_persyaratan_detail) {
											$id_administrasi = $id_data_administrasi;
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
										<?php echo form_open_multipart('Konsultasi/SaveDokumen/' . $id . '/' . $key->id_detail . '/1/' . $id_administrasi, array('name' => 'frmup' . $no, 'id' => 'frmup' . $no)); ?>
										<?php if ($dir_file == '' or $dir_file == null) { ?>
											<input type="file" name="d_file" id="d_file" placeholder="Unggah Berkas Disini" accept="application/pdf" onchange="form.submit()">
										<?php } else { ?>
											<center>						
												<a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/Konsultasi/' . $id . '/Dokumen/' . $dir_file); ?>')" class="btn default btn-xs blue-stripe">Lihat</a>
													|
												<a href="<?php echo site_url('Konsultasi/removeDataPersyaratan/' . $id_administrasi . '/adm/' . $id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ini?')" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a>
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
	</div>
</div>
<!-- /.modal -->
<div id="TambahTanah" class="modal fade" role="dialog" aria-hidden="true" data-width="60%" data-backdrop="static" data-keyboard="false">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h4 class="modal-title">Tambah Data Tanah</h4>
		</div>
		<div class="modal-body form">
			<form action="<?php echo site_url('Konsultasi/saveTanah'); ?>" class="form-horizontal" role="form" method="post" id="FormTambahTanah" enctype="multipart/form-data">
				<div class="portlet-body form">
					<div class="form-body">
						<br>
						<input type="text" class="form-control" value="<?= (isset($DataBangunan->id) ? $DataBangunan->id : ''); ?>" name="id" style="display: none;" autocomplete="off">
						<input type="text" class="form-control" value="<?= (isset($id_provinsi_bg) ? $id_provinsi_bg : ''); ?>" name="nama_provinsi" style="display: none;" autocomplete="off">
						<input type="text" class="form-control" value="<?= (isset($id_kec_bg) ? $id_kec_bg : ''); ?>" name="nama_kecamatan" style="display: none;" autocomplete="off">
						<input type="text" class="form-control" value="<?= (isset($id_kabkot_bg) ? $id_kabkot_bg : ''); ?>" name="nama_kabkota" style="display: none;" autocomplete="off">
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