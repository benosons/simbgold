<div class="portlet light margin-top-20">
	<div class="portlet-title tabbable-line">
		<div class="caption caption-md">
			<i class="icon-globe theme-font hide"></i>
			<span class="caption-subject text-primary bold uppercase"><i class=""></i>Data TPA Yang di Input Oleh Dinas Teknis Kab/Kota</span>
		</div>
		<div class="actions">
			<a href="#" data-toggle="modal" data-target="#responsive" style="margin: 0 auto;" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah TPA</a>
		</div>
	</div>
	<div class="portlet-body">
		<?php echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '<button class="close" data-close="alert">' . '</button>' . '</div>' : ''; ?>
		<div class="">
			<table class="table table-bordered btable">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Lengkap</th>
						<th>NIK</th>
						<th>Alamat</th>
						<th>No. Telepon</th>
						<th>Unsur</th>
						<th>Email</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					foreach ($tpa->result() as $row) { ?>
						<?php if ($row->id_lembaga == '1') {
							$unsur = "Akademisi";
						} else if ($row->id_lembaga == '2') {
							$unsur = "Pakar";
						} else if ($row->id_lembaga == '3') {
							$unsur = "Asosiasi Profesi";
						} else {
							$unsur = "Belum di tentukan";
						} ?>
						<tr>
							<td><?= $no++ ?></td>
							<td><?= $row->nm_tpa; ?></td>
							<td><?= $row->no_ktp ?></td>
							<td><?= $row->alamat ?></td>
							<td><?= $row->no_kontak ?></td>
							<td><?= $unsur ?></td>
							<td><?= $row->email ?></td>
							<td>
								<a href="<?php echo site_url('InputTPA/Form/' . $row->id); ?>" class="btn btn-warning btn-sm" title="Ubah Data"><span class="glyphicon glyphicon-pencil"></span></a>
								<!--<a href="<?php echo site_url('InputTPA/removeDataTpa/' . $row->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ini?')" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a>-->
							</td>
						</tr>
					<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- /.modal -->
<div id="responsive" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog" data-width="50%" data-backdrop="static" data-keyboard="false">
	<form action="<?php echo site_url('InputTPA/ProsesTambah'); ?>" class="form-horizontal" role="form" method="post" id="from_tambah">
		<input type="hidden" id='csrf_id' name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Form Tambah</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12 ">
						<div class="form-body">
							<div class="form-group">
								<label class="col-md-3 control-label">NIK</label>
								<div class="col-md-4">
									<input type="text" maxlength="16" class="allownumericwithoutdecimal form-control" value="<?php echo set_value('no_ktp', (isset($Dataaka->no_ktp) ? $Dataaka->no_ktp : '')) ?>" name="no_ktp" placeholder="No. Identitas" autocomplete="off">
									<?= form_error('no_ktp', '<small class="text-danger pl-3">', '</small>') ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Lembaga</label>
								<div class="col-md-9">
									<select class="form-control" name="lembaga" id="group">
										<option value="1">Akademisi</option>
										<option value="2">Pakar</option>
										<option value="3">Profesi</option>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn green" name="post" value="tambah">Simpan</button>
				<button type="button" data-dismiss="modal" class="btn red">Batal</button>
			</div>
		</div>
	</form>
</div>
<script>
	$("#from_tambah").validate({
		// Specify the validation rules
		rules: {
			no_ktp: {
				minlength: 16,
				maxlength: 16,
				required: true,
			},
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
			no_ktp: {
				required: "Masukan No. Identitas",
				minlength: "No. Identitas minimal 16 karakter",
				number: "ID harus berupa angka",
			}
		},
		submitHandler: function(form) {
			form.submit();
		}
	});

	$(".allownumericwithoutdecimal").on("keypress keyup blur", function(event) {
		$(this).val($(this).val().replace(/[^\d].+/, ""));
		if ((event.which < 48 || event.which > 57)) {
			event.preventDefault();
		}
	});
</script>