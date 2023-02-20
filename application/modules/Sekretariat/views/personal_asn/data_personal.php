<form action="<?php echo site_url('Sekretariat/saveDataASNsekte'); ?>" class="form-horizontal" role="form" method="post" id="form_personil">

	<div class="col-md-12 ">
		<div class="form-group">
			<label class="col-md-2 control-label">Nama Personil</label>
			<div class="col-md-2">
				<input type="text" class="form-control" value="<?php echo set_value('glr_depan', (isset($DataPersonil->glr_depan) ? $DataPersonil->glr_depan : '')) ?>" name="glr_depan" placeholder="Gelar" autocomplete="off">
			</div>
			<div class="col-md-5">
				<input type="hidden" class="form-control" value="<?php echo set_value('id', (isset($DataPersonil->id_personal) ? $DataPersonil->id_personal : '')) ?>" name="id" placeholder="id" autocomplete="off">
				<input type="text" class="form-control" value="<?php echo set_value('nama_personal', (isset($DataPersonil->nama_personal) ? $DataPersonil->nama_personal : '')) ?>" name="nama_personal" placeholder="Nama Lengkap Petugas" autocomplete="off">
			</div>
			<div class="col-md-2">
				<input type="text" class="form-control" value="<?php echo set_value('glr_belakang', (isset($DataPersonil->glr_belakang) ? $DataPersonil->glr_belakang : '')) ?>" name="glr_belakang" placeholder="Gelar" autocomplete="off">
			</div>
		</div>
		<!--div class="form-group">
			<label class="col-md-2 control-label">Status</label>
			<div class="col-md-9">
				<select name="stat" id="stat" class="form-control select" data-placeholder="Select...">
					<option value="">-- Pilih Status --</option>

					<?php

					$daftar_status = array(
						0 => "Non ASN",
						1 => "ASN"
					);
					foreach ($daftar_status as $key => $value) {
						if (isset($DataPersonil->stat)) {
							if ($key == $DataPersonil->stat) {
								$plhrole = "selected";
							} else {
								$plhrole = "";
							}
						}

						echo '<option value="' . $key . '"' . $plhrole . '>' . $value . '</option>';
					}

					?>
				</select>
			</div>
		</div-->
		<div class="form-group">
			<label class="col-md-2 control-label">NIP</label>
			<div class="col-md-9">
				<input type="text" class="form-control nip" value="<?php echo set_value('no_ktp', (isset($DataPersonil->nip) ? $DataPersonil->nip : '')) ?>" name="nip" placeholder="NIP" autocomplete="off">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Nomor KTP</label>
			<div class="col-md-9">
				<input type="text" class="form-control ktp" value="<?php echo set_value('no_ktp', (isset($DataPersonil->no_ktp) ? $DataPersonil->no_ktp : '')) ?>" name="no_ktp" placeholder="Nomor KTP" autocomplete="off">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Alamat</label>
			<div class="col-md-9">
				<textarea class="form-control" rows="3" name="alamat"><?php echo set_value('alamat', (isset($DataPersonil->alamat) ? $DataPersonil->alamat : '')) ?></textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Provinsi</label>
			<div class="col-md-9">
				<select name="id_provinsi" id="id_provinsi" class="form-control select" data-placeholder="Select..." onchange="getkabkota(this.value)">
					<option value="">-- Pilih Provinsi --</option>
					<?php
					if ($daftar_provinsi->num_rows() > 0) {
						foreach ($daftar_provinsi->result() as $key) {
							if ($key->id_provinsi == $DataPersonil->id_provinsi) {
								$plhrole = "selected";
							} else {
								$plhrole = "";
							}
							echo '<option value="' . $key->id_provinsi . '" ' . $plhrole . '>' . $key->nama_provinsi . '</option>';
						}
					}
					?>
				</select>
			</div>
		</div>

		<?php
		isset($DataPersonil->id_kabkot) ? $toggle = "" : $toggle = "display:none";
		?>

		<div class="form-group" id="nama_kabkota_toggle" style="">
			<label class="col-md-2 control-label">Kab/Kota</label>
			<div class="col-md-9">
				<select name="id_kabkot" id="nama_kabkota" class="form-control select" data-placeholder="Select..." onchange="getkecamatan(this.value)">
					
					<option value="">-- Pilih Kabupaten / Kota --</option>
					<?php
					if (isset($daftar_kabkota)) {
						if ($daftar_kabkota->num_rows() > 0) {
							foreach ($daftar_kabkota->result() as $key) {
								if ($key->id_kabkot == $DataPersonil->id_kabkot) {
									$plhrole = "selected";
									// echo '<option value="' . $key->id_provinsi . '" selected>' . $key->nama_provinsi . '</option>';
								} else {
									$plhrole = "";
								}
								echo '<option value="' . $key->id_kabkot . '" ' . $plhrole . '>' . $key->nama_kabkota . '</option>';
							}
						}
					}

					?>
				</select>
			</div>
		</div>

		<?php
		isset($DataPersonil->id_kecamatan) ? $toggle = "" : $toggle = "display:none";
		?>

		<div class="form-group" id="nama_kecamatan_toggle" style="">
			<label class="col-md-2 control-label">Kecamatan</label>
			<div class="col-md-9">
				<select  name="id_kecamatan" id="nama_kecamatan" class="form-control select" data-placeholder="Select...">
					<option value="">-- Pilih Kecamatan --</option>
					<?php
					if (isset($daftar_kabkota)) {
						if ($daftar_kecamatan->num_rows() > 0) {
							foreach ($daftar_kecamatan->result() as $key) {
								if ($key->id_kecamatan == $DataPersonil->id_kecamatan) {
									$plhrole = "selected";
								} else {
									$plhrole = "";
								}
								echo '<option value="' . $key->id_kecamatan . '" ' . $plhrole . '>' . $key->nama_kecamatan . '</option>';
							}
						}
					}
					?>
				</select>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-md-2 control-label">Nomor HP</label>
			<div class="col-md-9">
				<input type="text" class="form-control" value="<?php echo set_value('no_hp', (isset($DataPersonil->no_hp) ? $DataPersonil->no_hp : '')) ?>" name="no_hp" placeholder="Nomor HP" autocomplete="off">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Email</label>
			<div class="col-md-9">
				<input type="text" class="form-control" value="<?php echo set_value('email', (isset($DataPersonil->email) ? $DataPersonil->email : '')) ?>" name="email" placeholder="Mohon untuk Menginput Email Aktif" autocomplete="off" readonly>
			</div>
		</div>
		<hr>
		<div class="form-group">
			
				<!--button  class="btn green">Simpan</button-->
				<button type="submit" class="btn green-jungle btn-block"><b>Simpan</b></button>
			
		</div>
	</div>
</form>
<script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>
<script>
	$(document).ready(function () {
		
		$('.nip').mask('00000000 000000 0 000');
		$('.ktp').mask('0000000000000000');
		//$('.nohp').mask('0000000000000');
		
	});	
	function getkabkota(v, id_kabkot) {
		$("#nama_kabkota_toggle").fadeIn()
		jQuery.post(base_url + 'profile/getDataKabKota/' + v, function(data) {

			var nama_kabkota = '<option value="">-- Pilih Kabupaten / Kota --</option>';
			jQuery.each(data, function(key, value) {
				nama_kabkota += '<option value="' + value.id_kabkot + '"> ' + value.nama_kabkota + ' </option>';
			});
			jQuery('#nama_kabkota').html(nama_kabkota);
			$('#nama_kabkota').prop("disabled", false);
		}, 'json');
	}

	function getkecamatan(v, id_kecamatan) {
		$("#nama_kecamatan_toggle").fadeIn()
		jQuery.post(base_url + 'profile/getDataKecamatan/' + v, function(data) {
			var nama_kecamatan = '<option value="">-- Pilih Kecamatan --</option>';
			jQuery.each(data, function(key, value) {

				nama_kecamatan += '<option value="' + value.id_kecamatan + '" > ' + value.nama_kecamatan + ' </option>';
			});
			jQuery('#nama_kecamatan').html(nama_kecamatan);
			$('#nama_kecamatan').prop("disabled", false);
		}, 'json');
	}
	
	$("#form_personil").validate({
		
	    // Specify the validation rules
	   rules: {
			nama_personal : "required",
			stat: "required",
			alamat : "required",
			id_provinsi: "required",
			id_kabkot: "required",
			
			id_kecamatan: "required",
			nip : {
                    minlength: 8,
                    required: true,
					//number: true
                }, 
			no_hp: {
                    minlength: 10,
                    required: true,
					number: true
                }, 
			email: {
                    required: true,
                    email: true
                    }, 
			//no_ktp : "required",
			no_ktp : {
                    minlength: 16,
                    required: true,
					number: true
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
			nama_personal: "Masukan Nama Personil",
			alamat: "Masukan Alamat Lengkap",
			stat: "Pilih Salah Satu",
			no_ktp : {
				required: "Wajib diisi",
				minlength: "Nomor Identitas minimal 6 karakter",
				//atLeastOneLetter: "Password harus berupa gabungan huruf dan angka",
				number: "ID harus berupa angka",
			},
			nip : {
				required: "Masukan NIP",
				minlength: "NIP Tidak Dikenali",
				//atLeastOneLetter: "Password harus berupa gabungan huruf dan angka",
				//number: "ID harus berupa angka",
			},
			no_hp : {
				required: "Masukan Nomor HP Aktif",
				minlength: "Nomor HP minimal 10 karakter",
				//atLeastOneLetter: "Password harus berupa gabungan huruf dan angka",
				number: "Nomor HP harus berupa angka",
			},
			id_provinsi: "Pilih Provinsi",
			id_kabkot: "Pilih Kabupaten/Kota",
			id_kecamatan : "Pilih Kecamatan",
			
			email : "Masukan Alamat E-Mail Anda",
	    },
	    submitHandler: function(form) {
	    	form.submit();
	    }
	});
</script>