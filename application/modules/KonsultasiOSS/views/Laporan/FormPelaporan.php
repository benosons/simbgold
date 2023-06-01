<div class="portlet light bordered margin-top-20">
	<div class="portlet-body form">
		<center>
			<?php echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '<button class="close" data-close="alert">' . '</button>' . '</div>' : ''; ?>
		</center>
		<form action="<?php echo site_url('Konsultasi/savePelaporan'); ?>" class="form-horizontal" role="form" method="post" id="frm_pelaporan">
			<input type="hidden" value="<?php echo !empty($Pelaporan->id) ? $Pelaporan->id : '' ?>" name="id">
			<input type="hidden" id='csrf_id' name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
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
							<label class="control-label col-md-3">Ketrangan<span class="required">*</span></label>
							<div class="col-md-9">
								<textarea name="keterangan" class="form-control" rows="3"><?php echo !empty($Pelaporan->keterangan) ? $Pelaporan->keterangan : '' ?></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="form-actions">
				<?php if(empty($Pelaporan->status) || $Pelaporan->status == 0){ ?>
					<button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
				<?php } ?>
				<button class="btn red" onClick="window.location.href = '<?php echo base_url(); ?>Konsultasi/';return false;">Kembali</button>
			</div>
		</form>
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