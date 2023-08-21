<div class="portlet light bordered margin-top-20">
	<div class="portlet-body form">
	<form action="<?php echo site_url('DinasTeknis/status_dt_teknis'); ?>" class="form-horizontal" role="form" method="post" id="FormBangunan" type="multipart/form-data>
	<!--<form action="status_dt_teknis" class="form-horizontal" role="form" method="post" id="savestatussyarat" name="savestatussyarat" enctype="multipart/form-data">-->
	<div class="modal-header">
		<h4 align="center" class="modal-title"><b>Data Pokok Permohonan <?php echo $bangunan->no_konsultasi; ?></b></h4>
	</div>
	<input type="hidden" name="id_pemilik" value="<?php echo $data->id; ?>">
	<input type="hidden" name="email" value="<?php echo $data->email; ?>">
	<input type="hidden" name="no_konsultasi" value="<?php echo $bangunan->no_konsultasi; ?>">
	<input type="hidden" id='csrf_id' name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
	<div class="portlet light bordered margin-top-20">
		<div class="row static-info">
			<div class="col-md-3 name">Nama Lengkap Pemilik</div>
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
					<div class="col-md-8 value">
						<?= (isset($data->no_hp) ? $data->no_hp : ''); ?>
					</div>
				</div>
				<div class="row static-info">
					<div class="col-md-3 name">E-mail</div>
					<div class="col-md-8 value">
						<?= (isset($data->email) ? $data->email : ''); ?>
					</div>
				</div>
				<div class="row static-info">
					<div class="col-md-3 name">Lokasi Bangunan</div>
					<div class="col-md-8 value">
						<?= (isset($data->almt_bgn) ? $data->almt_bgn : ''); ?>, Kel. <?= (isset($data->nm_kel_bgn) ? $data->nm_kel_bgn : ''); ?>, Kec. <?= (isset($data->nm_kec_bgn) ? $data->nm_kec_bgn : ''); ?>,
						<?= (isset($data->nm_kabkot_bgn) ? $data->nm_kabkot_bgn : ''); ?>, Prov. <?= (isset($data->nm_prov_bgn) ? $data->nm_prov_bgn : ''); ?>
					</div>
				</div>
			</div>
	<br>
	<div class="portlet-body">
		<div class="tabbable-custom nav-justified">
			<ul class="nav nav-tabs nav-justified">
						<li class="active"><a href="#tabtot" data-toggle="tab">Data Bangunan</a></li>
						<li><a href="#tab_2_1" data-toggle="tab">Data Tanah </a></li>
						<li><a href="#tab_2_2" data-toggle="tab">Data Umum</a></li>
						<?php if ($data->id_jenis_permohonan != '3' && $data->id_jenis_permohonan != '4' && $data->id_jenis_permohonan != '5' && $data->id_jenis_permohonan != '12' && $data->id_jenis_permohonan != '21' && $data->id_jenis_permohonan != '34' && $data->id_jenis_permohonan != '35' && $data->id_jenis_permohonan != '36') { ?>
							<li><a href="#tab_2_3" data-toggle="tab">Ketentuan Teknis</a></li>
						<?php } else { ?>

						<?php } ?>
						<li><a href="#tab_2_4" data-toggle="tab">Status</a></li>
					</ul>
			<div class="tab-content">
			<div class="tab-pane fade active in" id="tabtot">
							<?php include "DataKonsultasi.php"; ?>
						</div>
				<div class="tab-pane fade active in" id="tab_2_1">
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
											$dir = './object-storage/dekill/Earth/' . $key->dir_file;
										} else {
											$dir = './object-storage/file/Konsultasi/' . $key->id . '/data_tanah/' . $key->dir_file;
										}
										if (file_exists($filenamephat)) {
											$dirphat = './object-storage/dekill/Earth/' . $key->dir_file_phat;
										} else {
											$dirphat = './object-storage/file/Konsultasi/' . $key->id . '/data_tanah/' . $key->dir_file_phat;
										} 
										$dir1		= $this->Outh_model->Encryptor('encrypt', $dir);
										$dirphat1	= $this->Outh_model->Encryptor('encrypt', $dirphat);
										
										?>
									<tr>
										<td align="center"> <?php echo $no++; ?></td>
										<td align="center"> <?php echo $jenis_dokumen; ?></td>
										<td align="center"> <?php echo $key->no_dok; ?><br><?php echo $key->tanggal_dok; ?></td>
										<td align="center"> <?php echo $key->luas_tanah; ?></td>
										<td align="center"> <?php echo $key->atas_nama_dok; ?></td>
										<td align="center">
											<a href="#PDFViewer" role="button" class="open-PDFViewer btn default btn-xs blue-stripe" data-toggle="modal" data-id="<?php echo site_url('Docreader/ReaderDok/' . $dir1); ?>">Lihat</a>
										</td>
										<td>
										<?php if ($key->dir_file_phat != "") { ?>
											<a href="#PDFViewer" role="button" class="open-PDFViewer btn default btn-xs blue-stripe" data-toggle="modal" data-id="<?php echo site_url('Docreader/ReaderDok/' . $dirphat1); ?>">Lihat</a>
										<?php } else { ?>
											<td>Tidak Ada Dokumen</td>
										<?php } ?>
										</td>
										<?php
										$cekik = "";
										if ($key->status_verifikasi_tanah == '1') {
											$cekik = "checked";
										}
										?>
										<td align="center">
											<input type="checkbox" name="verifikasi_tanah_<?php echo $key->id_detail; ?>" value="<?php echo $key->id_detail; ?>" id="verifikasi_tanah_<?php echo $key->id_detail; ?>" onchange="check_tanah('verifikasi_tanah_<?php echo $key->id_detail; ?>','<?php echo $key->id_detail; ?>')" <?= $cekik ?>>
										</td>
									</tr>
							<?php }
							}
							?>
						</tbody>
					</table>
					<?php if ($bangunan->id_izin != '2') { ?>
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
										$id		= $this->uri->segment('3');
										$ids 	= $this->secure->decrypt_url($id);
										$detail = $row->id_jenis_persyaratan;
										$status = "";
										$dir	= "";
										$ipk	= "";
										$query = $this->MDinasTeknis->getSyarat($row->id_detail, $ids)->result_array();
										for ($n = 0; $n < count($query); $n++) {
											$cek 	= $query[$n]['id_persyaratan_detail'];
											$dir 	= $query[$n]['dir_file'];
											$status = $query[$n]['status'];
											$ipk 	= $this->uri->segment('3');
										}
										$filename = FCPATH . "/object-storage/dekill/Requirement/$dir";
										$dirtanah = '';
										if (file_exists($filename)) {
											$dirtanah = './object-storage/dekill/Requirement/' . $dir;
										} else {
											$dirtanah = './object-storage/file/Konsultasi/' . $ipk . '/Dokumen/' . $dir;
										}
										$dirTnh	= $this->Outh_model->Encryptor('encrypt', $dirtanah);
										
										?>
										
										<td><?php echo $row->nm_dokumen; ?></td>
										<td><?php echo $row->keterangan; ?></td>
										<td align="center">
											<?php if($row->id_detail == $cek){?>
												<?php if ($dir != '') { ?>
													<a href="#PDFViewer" role="button" class="open-PDFViewer btn default btn-xs blue-stripe" data-toggle="modal" data-id="<?php echo site_url('Docreader/ReaderDok/'.$dirTnh); ?>">Lihat</a>
												<?php } else { ?>
													[Tidak Ada Dokumen]
												<?php } ?>
											<?php }?>
										</td>
										<?php $checked = "";
										if ($status == '1') {
											$checked = "checked";
										} ?>
										<td align="center"><input type="checkbox" name="syarat_<?= $row->id_detail ?>" value="<?= $row->id_detail ?>" id="syarat_<?= $row->id_detail ?>" onchange="check_status('syarat_<?= $row->id_detail ?>','<?= $row->id_detail ?>','tnh')" <?= $checked ?>></td>
									</tr>
								<?php
									$i++;
									$jns_syarat_sblm = $detail;
								} ?>
							</tbody>
						</table>
					<?php } else { ?>

					<?php } ?>
				</div>
				<div class="tab-pane fade" id="tab_2_2">
					<?php include "FormDokAdm.php"; ?>
				</div>
				<div class="tab-pane fade" id="tab_2_3">
					<?php include "FormTeknis.php"; ?>
				</div>
				<div class="tab-pane fade" id="tab_2_5">
					<?php include "FormMEP.php"; ?>
				</div>
				<div class="tab-pane fade" id="tab_2_4">
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
							<!-- <div id="syarat"> -->
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
									<button type="submit" onClick="Xtin()" class="btn green">Lanjut</button>
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
										<?php 
											$dirHis = './object-storage/dekill/Consultation/' . $his->dir_file;
											$dirSHis	= $this->Outh_model->Encryptor('encrypt', $dirHis);
										?>
					
										<?php if ($his->dir_file == '' || $his->dir_file == null) { ?>
											<td align="center">Tidak Ada Dokumen</td>
										<?php } else { ?>
											<td align="center">
												<a href="#PDFViewer" role="button" class="open-PDFViewer btn default btn-xs blue-stripe" data-toggle="modal" data-id="<?php echo site_url('Docreader/ReaderDok/'.$dirSHis); ?>">Lihat</a>
											</td>
										<?php } ?>
										<td align="center"><?= $his->post_by; ?></td>
									</tr>
							<?php $no++;
								}
							} ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</form>
</div>
</div>
<div class="modal-footer">
	<a href="<?php echo site_url("DinasTeknis/Verifikasi"); ?>"  title="Ubah Data"><span class="btn red">X Tutup</span></a>
</div>
<div id="PDFViewer" class="modal fade" aria-hidden="true" data-width="75%">
	<div class="modal-body">
		<div>
			<embed id="pdfdataid" src="" frameborder="1" width="100%" height="750px">
		</div>
		<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn btn-primary"><i class="fa fa-sign-out"></i> Tutup</button>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).on("click",".open-PDFViewer", function(){
		var datapdf = $(this).data("id");
		$(".modal-body #pdfdataid").attr("src", datapdf);
		
	});
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
				url: '<?php echo base_url('DinasTeknis/check_status_tanah/' . $ids) ?>/' + id + '/',
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
				url: '<?php echo base_url('DinasTeknis/uncheck_status_tanah/' . $ids) ?>/' + id + '/',
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
	function check_status(key, id, ss) {
		if (document.getElementById(key).checked) {
			$.ajax({
				url: '<?php echo base_url('DinasTeknis/check_status/' . $ids) ?>/' + id + '/' + ss + '/',
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
				url: '<?php echo base_url('DinasTeknis/uncheck_status/' . $ids) ?>/' + id + '/' + ss + '/',
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