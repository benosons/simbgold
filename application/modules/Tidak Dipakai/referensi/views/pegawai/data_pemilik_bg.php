<script type="text/javascript">

function getjenisKepemilikan(v){
	if(v == '1'){
		document.getElementById('perseorangan').style.display="block";
		document.getElementById('badan_usaha').style.display="none";
		document.getElementById('pemerintah').style.display="none";
	}else if(v == '2'){
		document.getElementById('perseorangan').style.display="none";
		document.getElementById('badan_usaha').style.display="block";
		document.getElementById('pemerintah').style.display="none";
	}else if(v == '3'){
		document.getElementById('perseorangan').style.display="none";
		document.getElementById('badan_usaha').style.display="none";
		document.getElementById('pemerintah').style.display="block";
	}else{
		document.getElementById('perseorangan').style.display="none";
		document.getElementById('badan_usaha').style.display="none";
		document.getElementById('pemerintah').style.display="none";
	}
}
</script>
<form action="<?php echo site_url('pengajuan/saveDataPemilik'); ?>" class="form-horizontal" role="form" method="post" id="from_DataPemilik">
		<div class="col-md-12 ">
			<div class="form-group">
				<label class="col-md-3 control-label">Jenis Kepemilikan</label>
				<div class="col-md-9">	
					<input type="hidden" class="form-control" value="<?php echo set_value('id', (isset($DataPemilik->id) ? $DataPemilik->id : ''))?>" name="id" placeholder="id" autocomplete="off">
					<input type="hidden" class="form-control" value="<?php echo set_value('pengajuan_id', (isset($pengajuan_id) ? $pengajuan_id : ''))?>" name="pengajuan_id" placeholder="id" autocomplete="off">
					<input type="hidden" class="form-control" value="<?php echo set_value('code_pengajuan', (isset($code_pengajuan) ? $code_pengajuan : ''))?>" name="code_pengajuan" placeholder="code_pengajuan" autocomplete="off">
					<select class="form-control" name="id_jenis_kepemilikan" id="id_jenis_kepemilikan" onchange="getjenisKepemilikan(this.value)">
						<?php $id_jenis_kepemilikan = set_value('id_jenis_kepemilikan', (isset($DataPemilik->id_jenis_kepemilikan) ? $DataPemilik->id_jenis_kepemilikan : ''));?>
						<option value="">--Pilih--</option>
						<option value="1" <?php if($id_jenis_kepemilikan == '1') echo "selected";?>>Perseorangan</option>
						<option value="2" <?php if($id_jenis_kepemilikan == '2') echo "selected";?>>Badan Usaha/Hukum</option>
						<option value="3" <?php if($id_jenis_kepemilikan == '3') echo "selected";?>>Pemerintah</option>
					</select>
				</div>
			</div>
			
			<div id="perseorangan" style="display: none;">
				<div class="form-group">
					<label class="col-md-3 control-label">Nama Pemilik</label>
					<div class="col-md-9">	
						<input type="text" class="form-control" value="<?php echo set_value('nama_pemilik', (isset($DataPemilik->nama_pemilik) ? $DataPemilik->nama_pemilik : ''))?>" name="nama_pemilik" placeholder="Nama Pemilik" autocomplete="off">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">No KTP</label>
					<div class="col-md-9">	
						<input type="text" class="form-control" value="<?php echo set_value('no_ktp_pemilik', (isset($DataPemilik->no_ktp_pemilik) ? $DataPemilik->no_ktp_pemilik : ''))?>" name="no_ktp_pemilik" placeholder="No Identitas Pemilik" autocomplete="off">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Pekerjaan</label>
					<div class="col-md-9">	
						<input type="text" class="form-control" value="<?php echo set_value('pekerjaan_pemilik', (isset($DataPemilik->pekerjaan_pemilik) ? $DataPemilik->pekerjaan_pemilik : ''))?>" name="pekerjaan_pemilik" placeholder="Pekerjaan Pemilik" autocomplete="off">
					</div>
				</div>
			</div>
			
			<div id="badan_usaha" style="display: none;">
				<div class="form-group">
					<label class="col-md-3 control-label">NIB</label>
					<div class="col-md-9">	
						<input type="text" class="form-control" value="<?php echo set_value('nib', (isset($DataPemilik->nib) ? $DataPemilik->nib : ''))?>" name="nib" placeholder="NIB" autocomplete="off">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Nama Perusahaan</label>
					<div class="col-md-9">	
						<input type="text" class="form-control" value="<?php echo set_value('nama_perusahaan', (isset($DataPemilik->nama_perusahaan) ? $DataPemilik->nama_perusahaan : ''))?>" name="nama_perusahaan" placeholder="Nama Perusahaan" autocomplete="off">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">NPWP Perusahaan</label>
					<div class="col-md-9">	
						<input type="text" class="form-control" value="<?php echo set_value('npwp_perusahaan', (isset($DataPemilik->npwp_perusahaan) ? $DataPemilik->npwp_perusahaan : ''))?>" name="npwp_perusahaan" placeholder="NPWP Perusahaan" autocomplete="off">
					</div>
				</div>
			</div>
			
			<div id="pemerintah" style="display: none;">
				<div class="form-group">
					<label class="col-md-3 control-label">Nama Kementerian</label>
					<div class="col-md-9">	
						<input type="hidden" class="form-control" value="<?php echo set_value('id_kementerian', (isset($DataPemilik->id_kementerian) ? $DataPemilik->id_kementerian : ''))?>" name="id_kementerian" placeholder="id Kementerian" autocomplete="off">
						<input type="text" class="form-control" value="<?php echo set_value('nama_kementerian', (isset($DataPemilik->nama_kementerian) ? $DataPemilik->nama_kementerian : ''))?>" name="nama_kementerian" placeholder="Nama Kementerian" autocomplete="off">
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-md-3 control-label">Alamat</label>
				<div class="col-md-9">	
					<textarea class="form-control" rows="3" name="alamat_pemilik" ><?php echo set_value('alamat_pemilik', (isset($DataPemilik->alamat_pemilik) ? $DataPemilik->alamat_pemilik : ''))?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Provinsi</label>
					<div class="col-md-9">	
					<select name="nama_provinsi_pemilik" id="nama_provinsi_pemilik" class="form-control select2me" data-placeholder="Select..." onchange="getkabkota(this.value)">
					<?php 
						if($daftar_provinsi->num_rows() > 0){
							foreach ($daftar_provinsi->result() as $key) {
								if($key->id_provinsi == $DataPemilik->id_provinsi){
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
			<div id="kab_kota_pemilik" style="display: none;">
				<div class="form-group">
					<label class="col-md-3 control-label">Kab/Kota</label>
					<div class="col-md-9">	
						<select name="nama_kabkota_pemilik" id="nama_kabkota_pemilik" class="form-control select2me" data-placeholder="Select..." onchange="getkecamatan(this.value)">
						<?php 
							if($DataPemilik->id){
							if($daftar_kabkota->num_rows() > 0){
								foreach ($daftar_kabkota->result() as $key) {
									if($key->id_kabkot == $DataPemilik->id_kabkot){
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
			<div id="kecamatan_pemilik" style="display: none;">
				<div class="form-group">
					<label class="col-md-3 control-label">Kecamatan</label>
					<div class="col-md-9">	
						<select name="nama_kecamatan_pemilik" id="nama_kecamatan_pemilik" class="form-control select2me" data-placeholder="Select...">
						<?php 
							if($DataPemilik->id){
							if($daftar_kecamatan->num_rows() > 0){
								foreach ($daftar_kecamatan->result() as $key) {
									if($key->id_kecamatan == $DataPemilik->id_kecamatan){
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
				<label class="col-md-3 control-label"></label>
				<div class="col-md-9">	
					<button type="submit" class="btn green">Simpan</button>
				</div>
			</div>
			
		</div>	
	
</form>
	
<script>

$(document).ready(function() {
	
	var id_provinsi		     = "<?=(isset($DataPemilik->id_provinsi) ? $DataPemilik->id_provinsi : '')?>";
	var id_kabkot			 = "<?=(isset($DataPemilik->id_kabkot) ? $DataPemilik->id_kabkot : '')?>";
	var id_kecamatan		 = "<?=(isset($DataPemilik->id_kabkot) ? $DataPemilik->id_kabkot : '')?>";
	var id_jenis_kepemilikan = "<?=(isset($DataPemilik->id_jenis_kepemilikan) ? $DataPemilik->id_jenis_kepemilikan : '')?>";
	if(id_kabkot != ""){
		document.getElementById('kab_kota_pemilik').style.display="block";
	}
	if(id_kecamatan != ""){
		document.getElementById('kecamatan_pemilik').style.display="block";
	}
	getjenisKepemilikan(id_jenis_kepemilikan);

});

function getkabkota(v,id_kabkot){
	jQuery.post(base_url+'pengajuan/getDataKabKota/'+v,function(data){
		var nama_kabkota	= '';
		jQuery.each(data, function(key, value){
			nama_kabkota += '<option value="'+value.id_kabkot+'"> '+value.nama_kabkota+' </option>';
		});
		jQuery('#nama_kabkota_pemilik').html(nama_kabkota);
	},'json');
	
	document.getElementById('kab_kota_pemilik').style.display="block";
}

function getkecamatan(v,id_kecamatan){
	jQuery.post(base_url+'pengajuan/getDataKecamatan/'+v,function(data){
		var nama_kecamatan	= '';
		jQuery.each(data, function(key, value){
			
			nama_kecamatan += '<option value="'+value.id_kecamatan+'" > '+value.nama_kecamatan+' </option>';
		});
		jQuery('#nama_kecamatan_pemilik').html(nama_kecamatan);
	},'json');
	
	document.getElementById('kecamatan_pemilik').style.display="block";
	
}


</script>