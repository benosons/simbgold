<style type="text/css">
	th {
		text-align: center;
	}
</style>
<!-- BEGIN PAGE CONTENT-->
<div class="row">
	<div class="col-md-12">
		<?php
		echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '</div>' : '';
		?>
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-globe"></i>Nama Ketentuan Teknis
				</div>
			</div>
			<div class="portlet-body">
				<div class="table-toolbar">
					<div class="row">
						<div class="col-md-4">
							<div class="btn-group">
								<a href="<?php echo site_url('DataSetting/FormCreateDokumen'); ?>" class="btn btn-primary" title="Tambah Data" data-toggle="modal" data-target="#modal-create">Tambah <i class="fa fa-plus"></i></a></a>
							</div>
						</div>
					</div>
				</div>
				<table id="example1" class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th style="width: 4%;">No</th>
							<th style="40%">Ketentuan Teknis</th>
							<th style="30%">Keterangan</th>
							<th style="width: 15%;">Jenis Dokumen</th>

							<th style="width: 8%;">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if ($syarat_imb->num_rows() > 0) {
							$no = 1;
							foreach ($syarat_imb->result() as $syarat) {
								if ($syarat->jns_dokumen == '1') {
									$jenis = "Data Umum";
								} else if ($syarat->jns_dokumen == '2') {
									$jenis = "Data Teknis Tanah";
								} else if ($syarat->jns_dokumen == '3') {
									$jenis = "Data Teknis Arsitektur";
								} else if ($syarat->jns_dokumen == '4'){
									$jenis = "Data Teknis Struktur";
								} else if ($syarat->jns_dokumen == '5'){
									$jenis = "Data Teknis: Mekanikal, Elektrikal, dan Plambing";
								}
								?>
								<tr>
									<td align="center"><?php echo $no++; ?></td>
									<td><?php echo $syarat->nm_dokumen; ?></td>
									<td><?php echo $syarat->keterangan; ?></td>
									<td><?php echo $jenis; ?></td>
									<td align="center">
										<a href="<?php echo site_url('DataSetting/FormEditDokumen/' . $syarat->id); ?>" class="btn btn-warning btn-sm" title="Ubah Data" data-toggle="modal" data-target="#modal-edit"><span class="glyphicon glyphicon-pencil"></span></a> 
										<a href="<?php echo site_url('DataSetting/removeDokumen/' . $syarat->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ini?')" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a>
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
	</div>
</div>

<!-- /.modal -->
<div id="modal-create" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		</div>
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
<script>
	$(document).ready(function() {
		var table = $('#example1').DataTable({
			scrollX: true,
			responsive: true
		});
	});
	$(document).ready(function() {
		var table = $('#example2').DataTable({
			scrollX: true,
			responsive: true
		});
	});

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
		$("#form_daftar_persyaratan").validate({
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