
<form action="<?php echo site_url('referensi/saveDataKonsultasi'); ?>" class="form-horizontal" role="form" method="post" id="FormEditKonsultasi">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h4 class="modal-title">Form Edit Jenis Konsultasi</h4>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-md-12 ">
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-3 control-label">Nama Permohonan</label>
							<div class="col-md-9">
								<input type="hidden" class="form-control" value="<?php echo $row->id;?>" name="id" placeholder="id" autocomplete="off">
								<textarea type="text" class="form-control" name="nm_konsultasi" placeholder="Nama Jenis Konsultasi" autocomplete="off"><?php echo set_value('nm_konsultasi', (isset($row->nm_konsultasi) ? $row->nm_konsultasi : ''))?></textarea>
							</div>
						</div>	
						<div class="form-group">
							<label class="col-md-3 control-label">Jenis Bangunan Gedung</label>
							<div class="col-md-6">
								<select class="form-control" name="id_izin" id="id_izin">
									<option value="">--Pilih--</option>
									<option value="1" <?php if($row->id_izin == '1') echo "selected";?>>Mendirikan Bangunan Gedung Baru</option>
									<option value="2" <?php if($row->id_izin == '2') echo "selected";?>>Bangunan Gedung Existing Belum Berizin</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Perancang Dokumen Teknis</label>
							<div class="col-md-6">
								<select class="form-control" name="id_perancang_dok" id="id_perancang_dok">
									<option value="">--Pilih--</option>
									<option value="1" <?php if($row->id_perancang_dok == '1') echo "selected";?>>Pemerintah Daerah</option>
									<option value="2" <?php if($row->id_perancang_dok == '2') echo "selected";?>>Pemilik Bangunan</option>
									<option value="3" <?php if($row->id_perancang_dok == '3') echo "selected";?>>Perencana Kontruksi</option>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" onclick="batal()" class="btn default">Batal</button>
				<button type="submit" class="btn green">Simpan</button>
			</div>
		</div>
	</div>
</form>

<script type="text/javascript">
	$(function () {
	 // Setup form validation on the #register-form element
	$("#FormEditKonsultasi").validate({
	    // Specify the validation rules
	    rules: {
	        nm_konsultasi: "required",
			id_izin : "required",
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
	        nm_konsultasi: "Masukan Nama Jenis Konsultasi",
	        id_izin: "Pilih Jenis Perizinan",
	    },

	    submitHandler: function(form) {
	    	form.submit();
	    }
	});
});
</script>
