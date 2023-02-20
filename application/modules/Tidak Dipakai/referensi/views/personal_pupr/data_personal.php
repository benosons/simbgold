<form action="<?php echo site_url('referensi/saveDataPersonil'); ?>" class="form-horizontal" role="form" method="post" id="form_personil">
	
		<div class="col-md-12 ">
			<div class="form-group">
				<label class="col-md-3 control-label">Nama Personil PUPR</label>
				<div class="col-md-1">	
					<input type="text" class="form-control" value="<?php echo set_value('glr_depan', (isset($DataPersonil->glr_depan) ? $DataPersonil->glr_depan : ''))?>" name="glr_depan" placeholder="Gelar" autocomplete="off">
				</div>
				<div class="col-md-4">	
					<input type="hidden" class="form-control" value="<?php echo set_value('id', (isset($DataPersonil->id) ? $DataPersonil->id : ''))?>" name="id" placeholder="id" autocomplete="off">
					<input type="text" class="form-control" value="<?php echo set_value('nama_personal', (isset($DataPersonil->nama_personal) ? $DataPersonil->nama_personal : ''))?>" name="nama_personal" placeholder="Nama Petugas Tim Teknis" autocomplete="off">
				</div>
				<div class="col-md-1">	
					<input type="text" class="form-control" value="<?php echo set_value('glr_belakang', (isset($DataPersonil->glr_belakang) ? $DataPersonil->glr_belakang : ''))?>" name="glr_belakang" placeholder="Gelar" autocomplete="off">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">No KTP</label>
				<div class="col-md-9">	
					<input type="text" class="form-control" value="<?php echo set_value('no_ktp', (isset($DataPersonil->no_ktp) ? $DataPersonil->no_ktp : ''))?>" name="no_ktp" placeholder="No Identitas" autocomplete="off">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Alamat</label>
				<div class="col-md-9">	
					<textarea class="form-control" rows="3" name="alamat" ><?php echo set_value('alamat', (isset($DataPersonil->alamat) ? $DataPersonil->alamat : ''))?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Provinsi</label>
				<div class="col-md-9">	
					<select name="id_provinsi" id="id_provinsi" class="form-control select2me" data-placeholder="Select..." onchange="getkabkota(this.value)">
					<?php 
						if($daftar_provinsi->num_rows() > 0){
							foreach ($daftar_provinsi->result() as $key) {
								if($key->id_provinsi == $DataPersonil->id_provinsi){
									$plhrole = "selected";
								}else{
									$plhrole = "";
								}
								echo '<option value="'.$key->id_provinsi.'" '.$plhrole.'>'.$key->nama_provinsi.'</option>';
							}
						}
					?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Kab/Kota</label>
				<div class="col-md-9">	
					<select name="id_kabkot" id="nama_kabkota" class="form-control select2me" data-placeholder="Select..." onchange="getkecamatan(this.value)">
						<?php 
							if($DataPersonil->id){
							if($daftar_kabkota->num_rows() > 0){
								foreach ($daftar_kabkota->result() as $key) {
									if($key->id_kabkot == $DataPersonil->id_kabkot){
										$plhrole = "selected";
									}else{
										$plhrole = "";
									}
									echo '<option value="'.$key->id_kabkot.'" '.$plhrole.'>'.$key->nama_kabkota.'</option>';
								}
							}
							}
						?>
						</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Kecamatan</label>
				<div class="col-md-9">	
					<select name="id_kecamatan" id="nama_kecamatan" class="form-control select2me" data-placeholder="Select...">
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">No Kontak</label>
				<div class="col-md-9">	
					<input type="text" class="form-control" value="<?php echo set_value('no_kontak', (isset($DataPersonil->no_kontak) ? $DataPersonil->no_kontak : ''))?>" name="no_kontak" placeholder="No Kontak" autocomplete="off">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Email</label>
				<div class="col-md-9">	
					<input type="text" class="form-control" value="<?php echo set_value('email', (isset($DataPersonil->email) ? $DataPersonil->email : ''))?>" name="email" placeholder="Mohon untuk Menginput Email Aktif" autocomplete="off">
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-md-3 control-label"></label>
				<div class="col-md-9">	
					<button type="submit" class="btn green">Simpan</button>
				</div>
			</div>
		</div>	
</form>
<script>
	function getkabkota(v,id_kabkot){
	jQuery.post(base_url+'pengajuan/getDataKabKota/'+v,function(data){
		var nama_kabkota	= '';
		jQuery.each(data, function(key, value){
			nama_kabkota += '<option value="'+value.id_kabkot+'"> '+value.nama_kabkota+' </option>';
		});
		jQuery('#nama_kabkota').html(nama_kabkota);
	},'json');
	
	document.getElementById('kab_kota').style.display="block";
	}
	
	function getkecamatan(v,id_kecamatan){
	jQuery.post(base_url+'pengajuan/getDataKecamatan/'+v,function(data){
		var nama_kecamatan	= '';
		jQuery.each(data, function(key, value){
			
			nama_kecamatan += '<option value="'+value.id_kecamatan+'" > '+value.nama_kecamatan+' </option>';
		});
		jQuery('#nama_kecamatan').html(nama_kecamatan);
	},'json');
	document.getElementById('kecamatan').style.display="block";
	}

</script>
	
