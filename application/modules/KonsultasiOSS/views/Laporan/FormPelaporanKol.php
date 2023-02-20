<div class="portlet light bordered margin-top-20">
	<div class="portlet-body form">
		<center>
			<?php echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '<button class="close" data-close="alert">' . '</button>' . '</div>' : ''; ?>
		</center>

		<div class="row static-info">
			<div class="col-md-3 name">Nama Lengkap Pemilik</div>
			<div class="col-md-9 value"></div>
		</div>
		<div class="row static-info">
			<div class="col-md-3 name">Data Bangunan Kolektif</div>
			<div class="col-md-9 value">

			</div>
		</div>
		<div class="row static-info">
			<div class="col-md-3 name">Nomor Persetujuan Bangunan Gedung</div>
			<div class="col-md-9 value">

			</div>
		</div>
		<div class="row static-info">
			<div class="col-md-3 name">Dokumen Persetujuan Bangunan Gedung</div>
			<div class="col-md-9 value">

			</div>
		</div>
		<div class="modal-footer">
			<?php if ($tambah) { ?>
				<center><a href="#pengalaman" role="button" class="btn green" data-toggle="modal">Tambah Laporan Kontruksi</a></center>
			<?php } ?>
		</div>
		<div class="table-scrollable">
			<table class="table table-bordered table-striped table-hover" id="sample_editable_1">
				<thead>
					<tr class="warning">
						<th><center>No.</center></th>
						<th><center>Proses Terakhir</center></th>
						<th><center>Lokasi Rumah</center></th>
						<th><center>Tanggal</center></th>
						<th><center>Keterangan</center></th>
						<th><center>Aksi</center></th>
					</tr>
				</thead>
				<tbody>
					<?php if ($pelaporan->num_rows() > 0) {
						$no = 1;
						foreach ($pelaporan->result() as $list) {
							$list_pem = array(
								'1' => 'Konstruksi Bawah',
								'2' => 'Basement',
								'3' => 'Konstruksi Atas',
								'4' => 'Testing and Comisioning',
							);
							echo '<tr>
								<td align ="center">' . $no++ . '</td>
								<td align ="left">' . $list_pem[$list->proses_pembangunan] . '</td>
								<td align ="left">' . $list_pem[$list->proses_pembangunan] . '</td>
								<td>' . tgl_eng_to_ind($list->tanggal_proses) . '</td>
								<td>' . $list->keterangan . '</td>
								<td>'; ?>

							<a href="<?php echo site_url('Konsultasi/FormEditPelaporan/' . $list->id); ?>" class="btn btn-warning btn-sm" title="Ubah Data" data-toggle="modal" data-target="#pengalaman"><span class="glyphicon glyphicon-pencil"></span></a>
							<a href="<?php echo site_url('Konsultasi/DeletePelaporan/'. $list->id_bgn . '/' . $list->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ini?')" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a></td>
							<?php echo '</tr>';
						}
					} else {
						echo '<tr> <td colspan ="4" align="center"> Data Kosong </td> </tr>';
					} ?>
				</tbody>
			</table>
		</div>
		<div class="form-actions">
			<button class="btn red" onClick="window.location.href = '<?php echo base_url(); ?>Konsultasi/';return false;">Kembali</button>
		</div>
	</div>
</div>
<div id="pengalaman" class="modal fade" role="dialog" aria-hidden="true" data-width="60%" data-backdrop="static" data-keyboard="false">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h4 class="modal-title">Tambah Data Pelaporan</h4>
		</div>
		<div class="modal-body form">
			<form action="<?php echo site_url('Konsultasi/savePelaporan'); ?>" class="form-horizontal" role="form" method="post" id="frm_pelaporan" enctype="multipart/form-data">
				<input type="hidden" id='csrf_id_peng' name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<input type="hidden" value="<?php echo !empty($Pelaporan->id) ? $Pelaporan->id : '' ?>" name="id">
				<input type="hidden" value="<?php echo $id ?>" name="id_bgn">
				<div class="portlet-body form">
					<div class="form-body">
						<div class="form-body">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3">Proses Pembangunan<span class="required">*</span></label>
										<div class="col-md-7">
											<?php $list_pem = array(
												'1' => 'Konstruksi Bawah',
												'2' => 'Basement',
												'3' => 'Konstruksi Atas',
												'4' => 'Testing and Comisioning',
											);
											echo form_dropdown('proses_pembangunan', $list_pem, !empty($Pelaporan->proses_pembangunan) ? $Pelaporan->proses_pembangunan : '', 'class = "form-control"');
											?>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">Tanggal Proses<span class="required">*</span></label>
										<div class="col-md-4">
											<input type="date" class="form-control" value="<?php echo !empty($Pelaporan->tanggal_proses) ? $Pelaporan->tanggal_proses : '' ?>" name="tanggal_proses">
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">Alamat Bangunan<span class="required">*</span></label>
										<div class="col-md-9">
											<textarea name="alamat_bg" class="form-control" rows="3"><?php echo !empty($Pelaporan->alamat_bg) ? $Pelaporan->alamat_bg : '' ?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">Ketrangan<span class="required">*</span></label>
										<div class="col-md-9">
											<textarea name="keterangan" class="form-control" rows="3"><?php echo !empty($Pelaporan->keterangan) ? $Pelaporan->keterangan : '' ?></textarea>
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
<div id="modal-edit" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		</div>
		<!-- /.modal-content -->
	</div>
</div>
<script type="text/javascript">
	$(function() {
		// Setup form validation on the #register-form element
		$("#frm_pelaporan").validate({
			// Specify the validation rules
			rules: {
				tanggal_proses: "required",
				keterangan: "required",
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
				tanggal_proses: "Tanggal Proses",
				keterangan: "Keterangan",
			},
			submitHandler: function(form) {
				form.submit();
			}
		});
	});
</script>