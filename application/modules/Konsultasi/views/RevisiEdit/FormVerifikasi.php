<div class="portlet-body">
	<div class="tabbable-custom nav-justified">
		<div class="tab-content">
			<div class="tab-pane fade active in" id="tab_0">
				<?php include "DataKonsultasi.php"; ?>
			</div>
		</div>
	</div>
</div>
<!--<div class="modal-footer">
	<button class="col-md-2 btn red" onClick="window.location.href = '<?php echo base_url(); ?>Konsultasi'">< Kembali</button>
</div>-->
<script type="text/javascript">
	$('#dir_file_pemberitahuan').change(function() {
		var filename_pemberitahuan = $(this).val();
		var lastIndex = filename_pemberitahuan.lastIndexOf("\\");
		if (lastIndex >= 0) {
			filename_pemberitahuan = filename_pemberitahuan.substring(lastIndex + 1);
		}
		$('#filename_pemberitahuan').val(filename_pemberitahuan);
	});
	function popWin(x) {
		url = x;
		swin = window.open(url, 'win', 'scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
		swin.focus();
	}
	function batal() {
		location.reload();
	}
	function Xtin() {
		if ($('#status_syarat_1:checked').val() == 1) {
			$("#savestatussyarat").validate({
				// Specify the validation rules
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
				// Specify the validation error messages
				messages: {
					status_syarat: "Tentukan Status Syarat",
				},
				submitHandler: function(form) {
					form.submit();
				}
			});
		} else {
			$("#savestatussyarat").validate({
				// Specify the validation rules
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
				// Specify the validation error messages
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