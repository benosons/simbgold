<form action="<?php echo site_url('pengajuan/saveDataPemohon'); ?>" class="form-horizontal" role="form" method="post" id="from_DataPemohon">
		<div class="col-md-12 ">
			<div class="form-group">
				<label class="col-md-3 control-label">Nama Pemohon</label>
				<div class="col-md-9">	
					<input type="hidden" class="form-control" value="<?php echo set_value('id', (isset($DataPemohon->id) ? $DataPemohon->id : ''))?>" name="id" placeholder="id" autocomplete="off">
					<input type="hidden" class="form-control" value="<?php echo set_value('pengajuan_id', (isset($pengajuan_id) ? $pengajuan_id : ''))?>" name="pengajuan_id" placeholder="id" autocomplete="off">
					<input type="hidden" class="form-control" value="<?php echo set_value('code_pengajuan', (isset($code_pengajuan) ? $code_pengajuan : ''))?>" name="code_pengajuan" placeholder="code_pengajuan" autocomplete="off">
					<input type="text" class="form-control" value="<?php echo set_value('nama_pemohon', (isset($DataPemohon->nama_pemohon) ? $DataPemohon->nama_pemohon : ''))?>" name="nama_pemohon" placeholder="Nama Pemohon" autocomplete="off">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">No KTP</label>
				<div class="col-md-9">	
					<input type="text" class="form-control" value="<?php echo set_value('no_ktp', (isset($DataPemohon->no_ktp) ? $DataPemohon->no_ktp : ''))?>" name="no_ktp" placeholder="No Identitas" autocomplete="off">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Alamat</label>
				<div class="col-md-9">	
					<textarea class="form-control" rows="3" name="alamat" ><?php echo set_value('alamat', (isset($DataPemohon->alamat) ? $DataPemohon->alamat : ''))?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Provinsi</label>
				<div class="col-md-9">	
					<select name="nama_provinsi" id="nama_provinsi" class="form-control select2me" data-placeholder="Select..." onchange="getkabkota(this.value)">
					<?php 
						if($daftar_provinsi->num_rows() > 0){
							foreach ($daftar_provinsi->result() as $key) {
								if($key->id_provinsi == $DataPemohon->id_provinsi){
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
			<div id="kab_kota" style="display: none;">
				<div class="form-group">
					<label class="col-md-3 control-label">Kab/Kota</label>
					<div class="col-md-9">	
						<select name="nama_kabkota" id="nama_kabkota" class="form-control select2me" data-placeholder="Select..." onchange="getkecamatan(this.value)">
						<?php 
							if($DataPemohon->id){
							if($daftar_kabkota->num_rows() > 0){
								foreach ($daftar_kabkota->result() as $key) {
									if($key->id_kabkot == $DataPemohon->id_kabkot){
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
			</div>
			<div id="kecamatan" style="display: none;">
				<div class="form-group">
					<label class="col-md-3 control-label">Kecamatan</label>
					<div class="col-md-9">	
						<select name="nama_kecamatan" id="nama_kecamatan" class="form-control select2me" data-placeholder="Select...">
						<?php 
							if($DataPemohon->id){
							if($daftar_kecamatan->num_rows() > 0){
								foreach ($daftar_kecamatan->result() as $key) {
									if($key->id_kecamatan == $DataPemohon->id_kecamatan){
										$plhrole = "selected";
									}else{
										$plhrole = "";
									}
									echo '<option value="'.$key->id_kecamatan.'" '.$plhrole.'>'.$key->nama_kecamatan.'</option>';
								}
							}
							}
						?>
						</select>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">No Handphone</label>
				<div class="col-md-9">	
					<input type="text" class="form-control" value="<?php echo set_value('no_hp', (isset($DataPemohon->no_hp) ? $DataPemohon->no_hp : ''))?>" name="no_hp" placeholder="No HandPhone" autocomplete="off">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">No Telephone</label>
				<div class="col-md-9">	
					<input type="text" class="form-control" value="<?php echo set_value('no_tlp', (isset($DataPemohon->no_tlp) ? $DataPemohon->no_tlp : ''))?>" name="no_tlp" placeholder="No Telephone" autocomplete="off">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Email</label>
				<div class="col-md-9">	
					<input type="text" class="form-control" value="<?php echo set_value('email', (isset($DataPemohon->email) ? $DataPemohon->email : ''))?>" name="email" placeholder="Mohon untuk Menginput Email Aktif" autocomplete="off">
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

$(document).ready(function() {
	
	var id_provinsi	= "<?=(isset($DataPemohon->id_provinsi) ? $DataPemohon->id_provinsi : '')?>";
	var id_kabkot	= "<?=(isset($DataPemohon->id_kabkot) ? $DataPemohon->id_kabkot : '')?>";
	var id_kecamatan	= "<?=(isset($DataPemohon->id_kabkot) ? $DataPemohon->id_kabkot : '')?>";
	if(id_kabkot != ""){
		document.getElementById('kab_kota').style.display="block";
	}
	if(id_kecamatan != ""){
		document.getElementById('kecamatan').style.display="block";
	}

});

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