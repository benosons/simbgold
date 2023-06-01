<script type="text/javascript">
function getjurusan(v){
	jQuery.post(base_url+'referensi/getDataJurusan/'+v,function(data){
		var nama_jurusan	= '';
		jQuery.each(data, function(key, value){
			nama_jurusan += '<option value="'+value.id_jurusan+'"> '+value.nama_jurusan+' </option>';
		});
		jQuery('#nama_jurusan').html(nama_jurusan);
	},'json');
}
</script>
<form action="<?php echo site_url('referensi/saveDataPendidikan'); ?>" class="form-horizontal" role="form" method="post" id="Form_Data_Pendidikan">
	
		<div class="col-md-12 ">
			
				<div class="form-group">
					<label class="col-md-3 control-label">Jenjang Pendidikan</label>
					<div class="col-md-6">	
						<select name="pendidikan" id="pendidikan" class="form-control select2me" data-placeholder="Select..." onchange="getjurusan(this.value)">
							<?php 
								if($daftar_pendidikan->num_rows() > 0)
								{
									foreach ($daftar_pendidikan->result() as $key) 
									{
										if($key->id_pendidikan == $daftar_pendidikan->id_pendidikan){
											$plhrole = "selected";
										}else{
											$plhrole = "";
											}
										echo '<option value="'.$key->id_pendidikan.'" '.$plhrole.'>'.$key->pendidikan.'</option>';
									}
								}
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Jurusan</label>
					<div class="col-md-6">	
						<select name="nama_provinsi" id="nama_provinsi" class="form-control select2me" data-placeholder="Select..." onchange="getkabkota(this.value)">
							<?php 
								if($daftar_jurusan->num_rows() > 0)
								{
									foreach ($daftar_jurusan->result() as $key) 
									{
										if($key->id_jurusan == $daftar_jurusan->id_jurusan){
											$plhrole = "selected";
										}else{
											$plhrole = "";
											}
										echo '<option value="'.$key->id_jurusan.'" '.$plhrole.'>'.$key->nama_jurusan.'</option>';
									}
								}
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Nama Sekolah/PerguruanTinggi</label>
					<div class="col-md-9">	
						<input type="text" class="form-control" value="<?php echo set_value('nama_pemohon', (isset($DataPersonil->nama_pemohon) ? $DataPersonil->nama_pemohon : ''))?>" name="nama_pemohon" placeholder="Nama Sekolah/Perguruan Tinggi" autocomplete="off">
					</div>
				</div>
			<div class="form-group">
					<label class="col-md-3 control-label">No. Ijazah</label>
					<div class="col-md-9">	
						<input type="text" class="form-control" value="<?php echo set_value('nama_pemohon', (isset($DataPersonil->nama_pemohon) ? $DataPersonil->nama_pemohon : ''))?>" name="nama_pemohon" placeholder="No Ijazah" autocomplete="off">
					</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Tahun Lulus</label>
				<div class="col-md-9">	
					<input type="text" class="form-control" value="<?php echo set_value('nama_pemohon', (isset($DataPersonil->nama_pemohon) ? $DataPersonil->nama_pemohon : ''))?>" name="nama_pemohon" placeholder="Tahun" autocomplete="off">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">File Ijazah</label>
				<div class="col-md-9">	
					<select name="nama_provinsi_pemilik" id="nama_provinsi_pemilik" class="form-control select2me" data-placeholder="Select..." onchange="getkabkota(this.value)">
					</select>
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
	
