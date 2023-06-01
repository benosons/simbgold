<style type="text/css">
	th {
		text-align: center;
	}
</style>
<!-- BEGIN PAGE CONTENT-->
<div class="row">
	<div class="col-md-12">
		<!-- Begin Jenis Konsultasi -->
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-globe"></i>List Data Jenis Konsultasi Bangunan Gedung 
				</div>
			</div>
			<div class="portlet-body">
				<div class="table-toolbar">
					<div class="row">
						<div class="col-md-4">
							<div class="btn-group">
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#JnsKonsultasi">Tambah <i class="fa fa-plus"></i></button>
							</div>
						</div>
						<div class="col-md-4">
							<?php
							echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '</div>' : '';
							?>
						</div>
					</div>
				</div>
				<table id="example2" class="display nowrap" style="width:100%">
					<thead>
						<tr>
							<th style="max-width:19px !important">No</th>
							<th>Jenis Konsultasi Bangunan Gedung</th>
							<th>Persyaratan</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if ($Konsultasi->num_rows() > 0) {
							$no = 1;
							foreach ($Konsultasi->result() as $Jenis) {
								?>
								<tr>
									<td><?php echo $no++; ?></td>
									<td><?php echo $Jenis->nm_konsultasi; ?></td>
									<td align="center">
										<a href="<?php echo site_url('DataSetting/ViewSyarat/' . $Jenis->id); ?>" class="btn btn-success btn-sm" title="Lihat Data Persyaratan" data-toggle="modal" data-target="#modal-view-persyaratan"><span class="fa fa-eye"></span></a> 
										<a href="<?php echo site_url('DataSetting/EditSyarat/' . $Jenis->id); ?>" class="btn btn-info btn-sm" title="Edit Data Persyaratan"><span class="icon-settings"></span></a>
									</td>
									<td align="center">
										<a href="<?php echo site_url('DataSetting/FormEditKonsultasi/' . $Jenis->id); ?>" class="btn btn-warning btn-sm" title="Ubah Data" data-toggle="modal" data-target="#modal-edit"><span class="glyphicon glyphicon-pencil"></span></a> 
										<a href="<?php echo site_url('referensi/JnsDeleteKonsultasi/' . $Jenis->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ini?')" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a>
									</td>
								</tr>
							<?php
							}
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
		<!-- End Jenis Konsultasi -->
	</div>
</div>

<div id="JnsKonsultasi" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog">
	<div class="modal-dialog modal-lg">
		<form action="<?php echo site_url('DataSetting/saveDataKonsultasi'); ?>" class="form-horizontal" role="form" method="post" id="form_daftar_permohonan">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Form Tambah Jenis Konsultasi Bangunan Gedung</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 ">
							<div class="form-body">
								<div class="form-group">
									<label class="col-md-3 control-label">Nama Konsultasi Bangunan Gedung</label>
									<div class="col-md-7">
										<textarea rows="3" cols="30" class="form-control" name="nm_konsultasi" placeholder="Nama Permohonan" autocomplete="off"></textarea>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Jenis Persetujuan Bangunan Gedung</label>
								<div class="col-md-5">
									<select class="form-control" name="id_izin" id="id_izin">
										<option value="">--Pilih--</option>
										<option value="1">Mendirikan Bangunan Gedung Baru</option>
										<option value="2">Bangunan Gedung Existing</option>
										<option value="3">Renovasi Bangunan Gedung</option>
										<option value="4">Bangunan Gedung Kolektif</option>
										<option value="5">Prasarana Bangunan Gedung</option>
										<option value="6">Bangunan Gedung Campuran</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Dokumen Rencana Teknis</label>
								<div class="col-md-4">
									<select class="form-control" name="id_dok_tek" id="id_dok_tek">
										<option value="">--Pilih--</option>
										<option value="1">Desain Protipe</option>
										<option value="2">Pengembangan Desain Protipe</option>
										<option value="3">Perencana Kontruksi</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Kompleksitas Bangunan Gedung</label>
								<div class="col-md-4">
									<select class="form-control" name="klasifikasi_bg" id="klasifikasi_bg">
										<option value="">--Pilih--</option>
										<option value="1">Sederhana</option>
										<option value="2">Tidak Sederhana</option>
										<option value="3">Khusus</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Pemanfaatan Bangunan Gedung</label>
								<div class="col-md-4">
									<select class="form-control" name="id_pemanfaatan_bg" id="id_pemanfaatan_bg">
										<option value="">--Pilih--</option>
										<option value="1">Untuk Kepentingan Umum</option>
										<option value="2">Bukan Untuk Kepentingan Umum</option>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn default">Batal</button>
					<button type="submit" class="btn green">Simpan</button>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- /.modaledit -->
<div id="modal-edit" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		</div>
		<!-- /.modal-content -->
	</div>
</div>

<!-- /.modalviewpersyaratan -->
<div id="modal-view-persyaratan" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		</div>
		<!-- /.modal-content -->
	</div>
</div>

<!-- /.modaleditpersyaratan -->
<div id="modal-edit-persyaratan" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		</div>
		<!-- /.modal-content -->
	</div>
</div>
<script>
	$(document).ready(function() {
		var table = $('#example1').DataTable({
			// rowReorder: {
			// 	selector: 'td:nth-child(2)'
			// },
			scrollX: true,
			responsive: true
		});
		var table = $('#example2').DataTable({
			// rowReorder: {
			// 	selector: 'td:nth-child(2)'
			// },
			scrollX: true,
			responsive: true
		});
	});
	// $(function() {
	// 	$("#example1").DataTable();

	// 	var table = $('#example1').dataTable();
	// 	var table = $('#example2').dataTable();


	// 	//setInterval(getStatus, 1000);

	// });

	function getStatus() {
		var randomnumber = Math.floor(Math.random() * 100);
		$('#show').text(
			'I am getting refreshed every 3 seconds..! Random Number ==> ' +
			randomnumber);

	}

	// Example call to load a new file
	//table.fnReloadAjax( 'media/examples_support/json_source2.txt' );
	// Example call to reload from original file

	$(function() {
		// Setup form validation on the #register-form element
		$("#form_daftar_permohonan").validate({
			// Specify the validation rules
			rules: {
				nama_persyaratan: "required",
				id_jenis_persyaratan: "required",
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
				nama_persyaratan: "Masukan Nama Persyaratan",
				id_jenis_persyaratan: "Pilih Jenis Persyaratan",
			},

			submitHandler: function(form) {
				form.submit();
			}
		});
	});
</script>