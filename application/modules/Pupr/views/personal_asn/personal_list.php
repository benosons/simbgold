<div class="portlet light margin-top-20">
	<div class="portlet-title tabbable-line">
		<div class="caption caption-md">
			<i class="icon-globe theme-font hide"></i>
			<span class="caption-subject font-blue-madison bold uppercase">List Data Personil ASN ( PUPR dan Instansi Teknis Terkait )</span>
		</div>								
	</div>
	<div class="portlet-body">
		<div>
			<?php
				echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-'.$this->session->flashdata('status').'">'.
				$this->session->flashdata('message').'<button class="close" data-close="alert">'.'</button>'.'</div>' : '';
			?>
		</div>
		<button type="button" id="btnplus2" class="btn btn-primary" onclick="getPlus()">Tambah <i class="fa fa-plus"></i></button>
		<button type="button" id="btnplus" class="btn red" onclick="getPlus2()" style="display: none;">Batal X</button>
		<div id="pluspersonil" style="display: none;">
		<br>
		<div class="portlet box red">
			<div class="portlet-title">
				<div class="caption">Tambah Personil</div>
			</div>
			<div class="portlet-body">
				<form action="<?php echo site_url('Pupr/saveDataPersonil'); ?>" class="form-horizontal" role="form" method="post" id="form_plusonil">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">		
						<div class="form-group">
							<label class="col-md-2 control-label">Nama Personil PUPR</label>
							<div class="col-md-2">
								<input type="text" class="form-control" name="glr_depan" placeholder="Gelar" autocomplete="off">
							</div>
							<div class="col-md-5">
								<input type="hidden" class="form-control"  name="id" placeholder="id" autocomplete="off">
								<input type="text" class="form-control"  name="nama_personal" placeholder="Nama Lengkap Petugas" autocomplete="off">
							</div>
							<div class="col-md-2">
								<input type="text" class="form-control" name="glr_belakang" placeholder="Gelar" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Status</label>
							<div class="col-md-9">
								<select name="stat" id="stat" class="form-control select" data-placeholder="Select...">
									<option value="">-- Pilih Status --</option>
									<option value="0">Non ASN</option>
									<option value="1">ASN</option>					
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">NIP</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="nip" placeholder="NIP" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">No Identitas</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="no_ktp" placeholder="Nomor KTP/SIM/Passport/NPWP" autocomplete="off">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-2 control-label">Alamat</label>
							<div class="col-md-9">
								<textarea class="form-control" rows="3" name="alamat" placeholder="Alamat Lengkap"></textarea>
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
						<div class="form-group" id="nama_kabkota_toggle" >
							<label class="col-md-2 control-label">Kab/Kota</label>
							<div class="col-md-9">
								<select disabled name="id_kabkot" id="nama_kabkota" class="form-control select" data-placeholder="Select..." onchange="getkecamatan(this.value)">
									<option id="Loading" value="">-- Pilih Kabupaten / Kota --</option>
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
						<div class="form-group" id="nama_kecamatan_toggle" >
							<label class="col-md-2 control-label">Kecamatan</label>
							<div class="col-md-9">
								<select disabled style="display :block" name="id_kecamatan" id="nama_kecamatan" class="form-control select" data-placeholder="Select...">
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
							<label class="col-md-2 control-label">No HP</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="no_hp" placeholder="No HP" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Email</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="email" placeholder="Mohon untuk Menginput Email Aktif" autocomplete="off">
							</div>
						</div>
						<div class="modal-footer"><center>
							<button type="button" onclick="getPlus2()" class="btn red">Batal</button>
							<button type="submit" class="btn green">Simpan</button></center>
						</div>
				</form>
			</div>
		</div></div>
		<div class="table-scrollable">
			<table class="table table-bordered table-hover">
				<thead>
						<tr class="warning">
							<th><center>#</center></th>
							<th>Nama Personil</th>
							<th>Status</th>
							<th><center>Aksi</center></th>
						</tr>
					</thead>
					<tbody>
						<?php
						if ($asn->num_rows() > 0) {
							$no = 1;
							foreach ($asn->result() as $asn) {
								?>
								<tr>
									<td align="center"><?php echo $no++; ?></td>
									<td><?php echo $asn->glr_depan . ' '; ?><?php echo '<b>' . $asn->nama_personal . '</b>'; ?><?php echo (isset($asn->glr_belakang) && ($asn->glr_belakang != '') ? ', ' . $asn->glr_belakang : '') ?></td>
									<td>
										<?php
										if ($asn->stat == 1) {
											echo "ASN";
										} else {
											echo "Non ASN";
										}
										?>
									</td>
									<td align="center"><a href="<?php echo site_url('Pupr/edit_personal_form/' . $asn->id_personal); ?>" class="btn btn-warning btn-sm" title="Ubah Data"><span class="glyphicon glyphicon-pencil"></span></a> <a href="<?php echo site_url('Pupr/removeDataPersonal/' . $asn->id_personal); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ini?')" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a></td>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script>
	function getkabkota(v, id_kabkot) {
		$("#nama_kabkota_toggle").fadeIn()
		jQuery.post(base_url + 'Profile/getDataKabKota/' + v, function(data) {

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
		jQuery.post(base_url + 'Profile/getDataKecamatan/' + v, function(data) {
			var nama_kecamatan = '<option value="">-- Pilih Kecamatan --</option>';
			jQuery.each(data, function(key, value) {

				nama_kecamatan += '<option value="' + value.id_kecamatan + '" > ' + value.nama_kecamatan + ' </option>';
			});
			jQuery('#nama_kecamatan').html(nama_kecamatan);
			$('#nama_kecamatan').prop("disabled", false);
		}, 'json');
	}
	function getPlus(){
		document.getElementById('pluspersonil').style.display="block";
		document.getElementById('btnplus').style.display="block";
		document.getElementById('btnplus2').style.display="none";
	}
	function getPlus2(){
		document.getElementById('pluspersonil').style.display="none";
		document.getElementById('btnplus').style.display="none";
		document.getElementById('btnplus2').style.display="block";
	}
	
	   
	 // Setup form validation on the #register-form element
	$("#form_plusonil").validate({
		
	    // Specify the validation rules
	   rules: {
			nama_personal : "required",
			stat: "required",
			alamat : "required",
			id_provinsi: "required",
			id_kabkot: "required",
			
			id_kecamatan: "required",
			
			no_hp: {
                    minlength: 6,
                    required: true,
					number: true
                }, 
			email: {
                    required: true,
                    email: true
                    }, 
			//no_ktp : "required",
			no_ktp : {
                    minlength: 6,
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
			nama_personal: "Masukan Nama Petugas",
			alamat: "Masukan Alamat Lengkap",
			stat: "Pilih Salah Satu",
			no_ktp : {
				required: "Masukan Nomor Identitas",
				minlength: "Nomor Identitas minimal 6 karakter",
				//atLeastOneLetter: "Password harus berupa gabungan huruf dan angka",
				number: "ID harus berupa angka",
			},
			no_hp : {
				required: "Masukan Nomor Telp/HP Aktif",
				minlength: "Nomor Telp/HP minimal 6 karakter",
				//atLeastOneLetter: "Password harus berupa gabungan huruf dan angka",
				number: "Nomor Telp/HP harus berupa angka",
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