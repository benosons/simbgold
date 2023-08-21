<form action="DinasTeknis/status_dt_teknis_bertahap" class="form-horizontal" role="form" method="post" id="savestatussyarat" name="savestatussyarat" enctype="multipart/form-data">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 align="center" class="modal-title"><b>Data Pokok Permohonan <?php echo $bangunan->no_konsultasi; ?></b></h4>
	</div>
	<input type="hidden" name="id_pemilik" value="<?php echo $data->id; ?>">
	<input type="hidden" name="email" value="<?php echo $data->email; ?>">
	<input type="hidden" name="no_konsultasi" value="<?php echo $bangunan->no_konsultasi; ?>">
	<input type="hidden" id='csrf_id' name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
	<div class="portlet light bordered margin-top-20">
		<div class="row static-info">
			<div class="col-md-3 name">
				Nama Lengkap Pemilik
			</div>
			<div class="col-md-8 value">
				<?= (isset($data->glr_depan) ? $data->glr_depan : ''); ?>
				<?= (isset($data->nm_pemilik) ? $data->nm_pemilik : ''); ?>
				<?= (isset($data->glr_belakang) ? $data->glr_belakang : ''); ?>
			</div>
		</div>
		<?php if($data->jenis_id =='2'){ ?>
			<div class="row static-info">
				<div class="col-md-3 name">No. KITAS</div>
				<div class="col-md-8 value"><?= (isset($data->no_kitas) ? $data->no_kitas : ''); ?></div>
			</div>
		<?php }else{ ?>
			<div class="row static-info">
				<div class="col-md-3 name">No. Indentitas Pemilik</div>
				<div class="col-md-8 value"><?= (isset($data->no_ktp) ? $data->no_ktp : ''); ?></div>
			</div>
		<?php } ?>
		<div class="row static-info">
			<div class="col-md-3 name">Alamat Pemilik Bangunan</div>
			<div class="col-md-8 value">
				<?= (isset($data->alamat) ? $data->alamat : ''); ?>, Kel. <?= (isset($data->nama_kelurahan) ? $data->nama_kelurahan : ''); ?>, Kec. <?= (isset($data->nama_kecamatan) ? $data->nama_kecamatan : ''); ?>,
				<?= (isset($data->nama_kabkota) ? $data->nama_kabkota : ''); ?>, Prov. <?= (isset($data->nama_provinsi) ? $data->nama_provinsi : ''); ?>
			</div>
		</div>
		<div class="row static-info">
			<div class="col-md-3 name">No. Telepon</div>
			<div class="col-md-8 value"><?= (isset($data->no_hp) ? $data->no_hp : ''); ?></div>
		</div>
		<div class="row static-info">
			<div class="col-md-3 name">E-mail</div>
			<div class="col-md-8 value"><?= (isset($data->email) ? $data->email : ''); ?></div>
		</div>
		<div class="row static-info">
			<div class="col-md-3 name">Lokasi Bangunan</div>
			<div class="col-md-8 value">
				<?= (isset($bangunan->almt_bgn) ? $bangunan->almt_bgn : ''); ?>, Kel. <?= (isset($bangunan->nama_kelurahan) ? $bangunan->nama_kelurahan : ''); ?>, Kec. <?= (isset($bangunan->nama_kecamatan) ? $bangunan->nama_kecamatan : ''); ?>,
				<?= (isset($bangunan->nama_kabkota) ? $bangunan->nama_kabkota : ''); ?>, Prov. <?= (isset($bangunan->nama_provinsi) ? $bangunan->nama_provinsi : ''); ?>
			</div>
		</div>
	</div>
	<br>
	<div class="portlet-body">
		<div class="tabbable-custom nav-justified">
			<ul class="nav nav-tabs nav-justified">
				<li class="active"><a href="#tabtot" data-toggle="tab">Data Bangunan</a></li>
				<li><a href="#tab_2_1" data-toggle="tab">Data Tanah </a></li>
				<?php if($bangunan->tahap_pbg == '1' || $bangunan->tahap_pbg == '3'){ ?>
					<li><a href="#tab_2_2" data-toggle="tab">Data Umum</a></li>
				<?php }else{ ?>
					
				<?php } ?>
				<li><a href="#tab_2_3" data-toggle="tab">Data Arsitektur</a></li>
				<li><a href="#tab_2_4" data-toggle="tab">Data Struktur</a></li>
				<li><a href="#tab_2_5" data-toggle="tab">Data MEP</a></li>
				<li><a href="#tab_2_6" data-toggle="tab">Dokumen BGH</a></li>
				<li><a href="#tab_2_7" data-toggle="tab">Status</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane fade active in" id="tabtot">
					<?php include "DataKonsultasi.php"; ?>
				</div>
				<div class="tab-pane fade" id="tab_2_1">
					<table id="sample_1" class="table table-bordered table-striped table-hover">
						<thead>
							<tr class="warning">
								<th><center>No.</center></th>
								<th><center>Jenis Dokumen</center></th>
								<th><center>No. dan Tgl Dokumen</center></th>
								<th><center>Luas Tanah (m2)</center></th>
								<th><center>Atas Nama</center></th>
								<th><center>Berkas</center></th>
								<th><center>Izin Pemanfaatan</center></th>
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
										} ?>
									<tr>
										<td align="center"> <?php echo $no++; ?></td>
										<td align="center"> <?php echo $jenis_dokumen; ?></td>
										<td align="center"> <?php echo $key->no_dok; ?><br><?php echo $key->tanggal_dok; ?></td>
										<td align="center"> <?php echo $key->luas_tanah; ?></td>
										<td align="center"> <?php echo $key->atas_nama_dok; ?></td>
										<td align="center">
											<a href="javascript:void(0);" onClick="javascript:popWin('<?php echo $dir; ?>')" class="btn default btn-xs blue-stripe">Lihat</a>
										</td>
										<?php if ($key->dir_file_phat != "") { ?>
											<a href="javascript:void(0);" onClick="javascript:popWin('<?php echo $dirphat ?>')" class="btn default btn-xs blue-stripe">Lihat</a>
										<?php } else { ?>
											<td>Tidak Ada Dokumen</td>
										<?php } ?>
										<?php
										$cekik = "";
										if ($key->status_verifikasi_tanah == '1') {
											$cekik = "checked";
										} ?>
										<td align="center">
											<input type="checkbox" name="verifikasi_tanah_<?php echo $key->id_detail; ?>" value="<?php echo $key->id_detail; ?>" id="verifikasi_tanah_<?php echo $key->id_detail; ?>" onchange="check_tanah('verifikasi_tanah_<?php echo $key->id_detail; ?>','<?php echo $key->id_detail; ?>')" <?= $cekik ?>>
										</td>
									</tr>
								<?php }
							} ?>
						</tbody>
					</table>
					<?php if($bangunan->tahap_pbg == '1'){ ?>
						<table id="sample_2" class="table table-bordered table-striped table-hover">
							<thead>
								<tr class="warning">
									<th>No</th>
									<th width="45%">Ketentuan Teknis Tanah</th>
									<th width="42%">Keterangan</th>
									<th width="10%">Berkas</th>
									<th width="3%">Verifikasi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$jns_syarat_sblm = '';
								$cek = '';
								$i = 1;
								foreach ($results_tnh as $row) {
									if ($i % 2 == 0)
										$clss = "event";
									else
										$clss = "event2";
									?>
									<tr>
										<td align="center"><?php echo $i ?></td>
										<?php
										$detail = $row->id_jenis_persyaratan;
										$status = "";
										$query = $this->MDinasTeknis->getSyarat($row->id_detail, $this->uri->segment('3'))->result_array();
										for ($n = 0; $n < count($query); $n++) {
											$cek = $query[$n]['id_persyaratan_detail'];
											$dir = $query[$n]['dir_file'];
											$status = $query[$n]['status'];
											$ipk = $this->uri->segment('3');
										} 
										$filename = FCPATH . 'object-storage/file/Konsultasi/' . $ipk . '/Dokumen/' . $dir;
										$dirtanah = '';
										if (file_exists($filename)) {
											$dirtanah = base_url('object-storage/file/Konsultasi/' . $ipk . '/Dokumen/' . $dir);
										} else {
											$dirtanah = base_url('object-storage/dekill/Requirement/' . $dir);
										}
										?>
										<td><?php echo $row->nm_dokumen; ?></td>
										<td><?php echo $row->keterangan; ?></td>
										<td align="center">
											<?php if ($row->id_detail == $cek) { ?>
												<?php if ($dir != '') { ?>
													<a href="javascript:void(0);" onClick="javascript:popWin('<?php echo $dirtanah; ?>')" class="btn default btn-xs blue-stripe">Lihat</a>
												<?php } else { ?>
													[Tidak Ada Dokumen]
												<?php } ?>
											<?php } ?>
										</td>
										<?php $checked = "";
										if ($status == '1') {
											$checked = "checked";
										} ?>
										<td align="center"><input type="checkbox" name="syarat_<?= $row->id_detail ?>" value="<?= $row->id_detail ?>" id="syarat_<?= $row->id_detail ?>" onchange="check_status_bertahap('syarat_<?= $row->id_detail ?>','<?= $row->id_detail ?>','tnh')" <?= $checked ?>></td>
									</tr>
									<?php
									$i++;
									$jns_syarat_sblm = $detail;
								} ?>
							</tbody>
						</table>
					<?php }else{ ?>
						
					<?php } ?>
					
				</div>
				<div class="tab-pane fade" id="tab_2_2">
					<?php include "FormDokAdmBertahap.php"; ?>
				</div>
				<div class="tab-pane fade" id="tab_2_3">
					<?php include "FormArsitekturBertahap.php"; ?>
				</div>
				<div class="tab-pane fade" id="tab_2_3">
					<?php include "FormStrukturBertahap.php"; ?>
				</div>
				<div class="tab-pane fade" id="tab_2_4">
					<?php include "FormStrukturBertahap.php"; ?>
				</div>
				<div class="tab-pane fade" id="tab_2_5">
					<?php include "FormMEPBertahap.php"; ?>
				</div>
				<div class="tab-pane fade" id="tab_2_6">
					<?php include "FormBGHBertahap.php"; ?>
				</div>
				<div class="tab-pane fade" id="tab_2_7">
					<div class="col-md-12 ">
						<div class="form-body">
							<div class="form-group">
								<label class="col-md-3 control-label">Kelengkapan Ketentuan Teknis</label>
								<div class="col-md-9">
									<label class="radio-inline">
										<input type="radio" name="status_syarat" id="status_syarat_1" value="1">Lengkap
										<br>
										<input type="radio" name="status_syarat" id="status_syarat_2" value="2">Tidak Lengkap
									</label>
								</div>
							</div>
							<div class="form-group" type="hidden">
								<label class="col-md-3 control-label">No. Surat Pemberitahuan</label>
								<div class="col-md-9">
									<input class="form-control" name="no_surat_pemberitahuan" id="no_surat_pemberitahuan" placeholder="Nomor Surat">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Surat Pemberitahuan</label>
								<div class="col-md-8">
									<div class="fileinput fileinput-new" data-provides="fileinput">
										<input type="hidden" name="dir_dokumen" value="" id="dir_dokumen">
										<input type="file" name="dir_file" id="dir_file">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Catatan</label>
								<div class="col-md-9">
									<textarea class="form-control" name="catatan" id="catatan" placeholder="Keterangan"></textarea>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label"></label>
								<div class="col-md-9">
									<input id="xstin" name="xstin" onClick="Xtin()" type="submit" value="Simpan" class="btn green">
								</div>
							</div>
						</div>
					</div>
					<br>
					<table id="sample_1" class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>No. Surat</th>
								<th>Tanggal Surat</th>
								<th>Catatan</th>
								<th>Berkas</th>
								<th>Verifikator</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if ($History->num_rows() > 0) {
								$no = 1;
								foreach ($History->result() as $his) { ?>
									<tr>
										<td align="center"><?= $no; ?></td>
										<td align="center"><?= $his->no_surat; ?></td>
										<td align="center"><?= $his->tgl_status; ?></td>
										<td align="center"><?= $his->catatan; ?></td>
										<?php if ($his->dir_file == '' || $his->dir_file == null) { ?>
											<td align="center">Tidak Ada Dokumen</td>
										<?php } else { ?>
											<td align="center"><a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/Konsultasi/' . $his->id . '/' . $his->dir_file); ?>')" class="btn default btn-xs blue-stripe">Lihat</a></td>
										<?php } ?>
										<td align="center"><?= $his->post_by; ?></td>
									</tr>
								<?php $no++; }
							} ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</form>
<div class="modal-footer">
	<button type="button" onclick="return confirm('Yakin Ingin Keluar?')" data-dismiss="modal" class="btn red"> X Tutup</button>
</div>
<script type="text/javascript">
	$('#dir_file_pemberitahuan').change(function() {
		var filename_pemberitahuan = $(this).val();
		var lastIndex = filename_pemberitahuan.lastIndexOf("\\");
		if (lastIndex >= 0) {
			filename_pemberitahuan = filename_pemberitahuan.substring(lastIndex + 1);
		}
		$('#filename_pemberitahuan').val(filename_pemberitahuan);
	});

	function check_tanah(key, id) {
		if (document.getElementById(key).checked) {
			$.ajax({
				url: '<?php echo base_url('DinasTeknis/check_status_tanah/' . $this->uri->segment(3)) ?>/' + id + '/',
				type: 'POST',
				dataType: 'html',
				data: $('form.form-horizontal').serialize(),
				cache: false,
				success: function(response) {
					const obj = JSON.parse(response);
					$('#csrf_id').val(obj.csrf);
				}
			});
		} else {
			$.ajax({
				url: '<?php echo base_url('DinasTeknis/uncheck_status_tanah/' . $this->uri->segment(3)) ?>/' + id + '/',
				type: 'POST',
				dataType: 'html',
				data: $('form.form-horizontal').serialize(),
				cache: false,
				success: function(response) {
					const obj = JSON.parse(response);
					$('#csrf_id').val(obj.csrf);
				}
			});
		}
	}

	function popWin(x) {
		url = x;
		swin = window.open(url, 'win', 'scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
		swin.focus();
	}

	function check_status_bertahap(key, id, ss) {
		if (document.getElementById(key).checked) {
			$.ajax({
				url: '<?php echo base_url('DinasTeknis/check_status_bertahap/' . $this->uri->segment(3)) ?>/' + id + '/' + ss + '/',
				type: 'POST',
				dataType: 'html',
				data: $('form.form-horizontal').serialize(),
				cache: false,
				success: function(response) {
					const obj = JSON.parse(response);
					$('#csrf_id').val(obj.csrf);
				}
			});
		} else {
			$.ajax({
				url: '<?php echo base_url('DinasTeknis/uncheck_status_bertahap/' . $this->uri->segment(3)) ?>/' + id + '/' + ss + '/',
				type: 'POST',
				dataType: 'html',
				data: $('form.form-horizontal').serialize(),
				cache: false,
				success: function(response) {
					const obj = JSON.parse(response);
					$('#csrf_id').val(obj.csrf);
				}
			});
		}
	}
	function batal() {
		location.reload();
	}
	function Xtin() {
		if ($('#status_syarat_1:checked').val() == 1) {
			$("#savestatussyarat").validate({
				rules: {
					status_syarat: "required",
				},
				highlight: function(element) {
					$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
				},
				unhighlight: function(element) {
					$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
				},
				errorClass: 'help-block',
				messages: {
					status_syarat: "Tentukan Status Syarat",
				},
				submitHandler: function(form) {
					form.submit();
				}
			});
		} else {
			$("#savestatussyarat").validate({
				rules: {
					status_syarat: "required",
					catatan: "required",
				},
				highlight: function(element) {
					$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
				},
				unhighlight: function(element) {
					$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
				},
				errorClass: 'help-block',
				messages: {
					status_syarat: "Tentukan Status Syarat",
					catatan: "Masukan Keterangan",
				},
				submitHandler: function(form) {
					form.submit();
				}
			});
		}
	}
</script>