
<form action="<?php echo site_url('Sekretariat/saveDataKeahlian'); ?>" class="form-horizontal" role="form" method="post" id="Form_Data_Keahlian" enctype="multipart/form-data">

	<div class="col-md-12 ">
		<div class="form-group">
			<label class="col-md-3 control-label">Unsur ASN Teknis/Intansi Terkait</label>
			<div class="col-md-8">
				<input type="hidden" class="form-control" value="<?php echo set_value('id', (isset($DataPersonil->id_personal) ? $DataPersonil->id_personal : '')) ?>" name="id" placeholder="id" autocomplete="off">
				<select class="form-control select" name="id_unsur" id="id_jenis_kepemilikan">
					<option value="">--Pilih--</option>
					<option value="1" <?php if (isset($DataPersonil->id_unsur) == 1) {
											echo 'selected';
										} ?>>Dinas Teknis</option>


					<option value="2" <?php if (isset($DataPersonil->id_unsur) == 2) {
											echo 'selected';
										} ?>>Dinas Intansi Terkait</option>
					<option value="3" <?php if (isset($DataPersonil->id_unsur) == 3) {
											echo 'selected';
										} ?>>Tenaga Ahli</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Bidang Keahlian</label>
			<div class="col-md-8">
				<input type="text" class="form-control" value="<?php echo set_value('nama_bidang', (isset($DataPersonil->nama_bidang) ? $DataPersonil->nama_bidang : '')) ?>" name="nama_bidang" placeholder="Bidang Keahlian" autocomplete="off">
				
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Kualifikasi/Jabatan Fungsional</label>
			<div class="col-md-8">
				<textarea class="form-control" rows="3" name="list_keahlian"><?php echo set_value('list_keahlian', (isset($DataPersonil->list_keahlian) ? $DataPersonil->list_keahlian : '')) ?></textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Tanggal Sertifikat / SK</label>
			<div class="col-md-8">
				<input class="form-control datepicker" data-date-format="dd/mm/yyyy" type="text" name="tgl_penetapan" placeholder="Tanggal Penerbitan Sertifikat / SK" value="<?php echo set_value('tgl_penetapan', (isset($DataPersonil->tgl_penetapan) ? date('d/m/Y', strtotime($DataPersonil->tgl_penetapan)) : '')) ?>" autocomplete="off" onkeydown="return false"/>
				<input type="hidden" class="form-control" value="<?php echo set_value('id', (isset($DataPersonil->id_personal) ? $DataPersonil->id_personal : '')) ?>" name="idgagal" placeholder="" autocomplete="off">
			</div>
		</div>
		<!--div class="form-group">
			<label class="col-md-3 control-label">File Sertifikat</label>
			<div class="col-md-8">
				<div class="fileinput fileinput-new" data-provides="fileinput">
					<?php
					if (isset($DataPersonil->dir_file) != '') {
						$file = base_url() . 'file/personil/' . $DataPersonil->id_personal . '/sertifikat/' . $DataPersonil->dir_file;
						$name = 'Ubah Fle';
						echo '<div class="fileinput-new thumbnail">';
						echo '<a href="' . $file . '" target="_blank" alt="" class="btn default blue-stripe">Lihat</a>';
						echo '</div>';
					} else {?>
						<input type="file" name="dir_file" id="dir_file" >
						<input type="text" name="filename_sertifikat" id="filename_sertifikat" style="display: none;" >
					<?}?>

				</div>
			</div>

		</div-->
		<hr>
		<div class="form-group">
				<button type="submit" class="btn green-jungle btn-block"><b>Simpan</b></button>
		</div>
	</div>
</form>

<script type="text/javascript">
	
	$("#Form_Data_Keahlian").validate({
		
	    // Specify the validation rules
	   rules: {
			id_unsur : "required",
			tgl_penetapan: "required",
			dir_file : "required",
			nama_bidang : "required",
			list_keahlian : "required",
			 
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
			id_unsur: "Pilih Unsur Terkait",
			tgl_penetapan: "Masukan Tanggal SK/Sertifikat",
			dir_file: "Unggah Ijazah",
			nama_bidang: "Masukan Bidang Keahlian",
			list_keahlian: "Masukan Kualifikasi/Jabatan Fungsional",
			
	    },
	    submitHandler: function(form) {
	    	form.submit();
	    }
	});
</script>