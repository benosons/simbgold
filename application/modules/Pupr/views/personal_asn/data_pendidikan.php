
<form action="<?php echo site_url('Pupr/saveDataPendidikan'); ?>" class="form-horizontal" role="form" method="post" id="Form_Data_Pendidikan" enctype="multipart/form-data">
<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">		
					
	<div class="col-md-12 ">
	<!--<input type="hidden" class="form-control" value="<?php echo set_value('id_riwpend', (isset($DataPersonil->id_riwpend) ? $DataPersonil->id_riwpend : '')) ?>" name="id" placeholder="ID Pendidikan" autocomplete="off">-->		
		<div class="form-group">
			<label class="col-md-3 control-label">Jenjang Pendidikan</label>
			<div class="col-md-8">
				<select name="id_jenjang" id="name_jenjang" class="form-control select" data-placeholder="Select..." onchange="getjurusan(this.value)">
					<option value="">--Pilih--</option>
					<?php
					if ($jenjang->num_rows() > 0) {
						foreach ($jenjang->result() as $key) {
							if ($key->id_jenjang == $DataPersonil->id_jenjang) {
								$plhrole = "selected";
							} else {
								$plhrole = "";
							}
							echo '<option value="' . $key->id_jenjang . '" ' . $plhrole . '>' . $key->nama_jenjang . '</option>';
						}
					}
					?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Jurusan</label>
			<div class="col-md-8">
				
				<input type="hidden" class="form-control" value="<?php echo set_value('id', (isset($DataPersonil->id_personal) ? $DataPersonil->id_personal : '')) ?>" name="id" placeholder="Jurusan" autocomplete="off">
				<input type="text" class="form-control" value="<?php echo set_value('jurusan', (isset($DataPersonil->jurusan) ? $DataPersonil->jurusan : '')) ?>" name="jurusan" placeholder="Jurusan Pendidikan" autocomplete="off">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Nama Sekolah/Perguruan Tinggi</label>
			<div class="col-md-8">
				<input type="text" class="form-control" value="<?php echo set_value('nm_sekolah', (isset($DataPersonil->nm_sekolah) ? $DataPersonil->nm_sekolah : '')) ?>" name="nm_sekolah" placeholder="Nama Sekolah/Perguruan Tinggi" autocomplete="off">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Kota Asal Sekolah</label>
			<div class="col-md-8">
				<input type="text" class="form-control" value="<?php echo set_value('alamat_skl', (isset($DataPersonil->alamat_skl) ? $DataPersonil->alamat_skl : '')) ?>" name="alamat_skl" placeholder="Kota Asal Sekolah" autocomplete="off">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">No. Ijazah</label>
			<div class="col-md-8">
				<input type="text" class="form-control" value="<?php echo set_value('no_ijazah', (isset($DataPersonil->no_ijazah) ? $DataPersonil->no_ijazah : '')) ?>" name="no_ijazah" placeholder="No. Ijazah" autocomplete="off">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Tahun Lulus</label>
			<div class="col-md-8">
				<input type="text" class="form-control" value="<?php echo set_value('thn_lulus', (isset($DataPersonil->thn_lulus) ? $DataPersonil->thn_lulus : '')) ?>" name="thn_lulus" placeholder="Tahun Kelulusan" autocomplete="off">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">File Ijazah</label>
			<div class="col-md-8">
				<div class="fileinput fileinput-new" data-provides="fileinput">
					<?php
					if (isset($DataPersonil->dir_file_ijazah) != '') {
						$file = base_url() . 'file/personil/' . $DataPersonil->id_personal . '/ijazah/' . $DataPersonil->dir_file_ijazah;
						$name = 'Ubah Fle';
						echo '<div class="fileinput-new thumbnail">';
						echo '<a href="' . $file . '" target="_blank" alt="" class="btn default blue-stripe">Lihat</a>';
						echo '</div>';
					} else {?>
						<input type="file" name="dir_file" id="dir_file" >
						<input type="text" name="filename_ijazah" id="filename_ijazah" style="display: none;" >
					<?}?>

				</div>
			</div>

		</div>

		<div class="form-group">
			<label class="col-md-3 control-label"></label>
			<div class="col-md-8">
				<button type="submit" class="btn green">Simpan</button>
			</div>
		</div>
	</div>
</form>

<script type="text/javascript">
	function getjurusan(v) {
		jQuery.get(base_url + 'Pupr/getDataJurusan/' + v, function(data) {
			var nama_jurusan = '';
			jQuery.each(data, function(key, value) {
				nama_jurusan += '<option value="' + value.id_jurusan + '"> ' + value.nama_jurusan + ' </option>';
			});
			jQuery('#nama_jurusan').html(nama_jurusan);
		}, 'json');
	}
	
	$("#Form_Data_Pendidikan").validate({
		
	    // Specify the validation rules
	   rules: {
			jurusan : "required",
			nm_sekolah: "required",
			dir_file : "required",
			id_jenjang: "required",
			no_ijazah: {
                    minlength: 6,
                    required: true,
					//number: true
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
			jurusan: "Masukan Nama Jurusan",
			nm_sekolah: "Masukan Nama Sekolah / Perguruan Tinggi",
			dir_file: "Unggah Ijazah",
			no_ijazah : {
				required: "Ijazah Wajib diisi",
				minlength: "Nomor Ijazah minimal 6 karakter",
				//atLeastOneLetter: "Password harus berupa gabungan huruf dan angka",
				//number: "ID harus berupa angka",
			},
			id_jenjang: "Pilih Jenjang Pendidikan",
			
	    },
	    submitHandler: function(form) {
	    	form.submit();
	    }
	});
</script>