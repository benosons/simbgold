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
					<input type="hidden" class="form-control" value="<?php echo set_value('id', (isset($DataPemilik->id) ? $DataPemilik->id : ''))?>" name="id" placeholder="id" autocomplete="off">
					<select class="form-control" name="id_jenis_kepemilikan" id="id_jenis_kepemilikan" onchange="getjenisKepemilikan(this.value)">
						<option value="">--Pilih--</option>
						<option value="1">Dinas PUPR</option>
						<option value="2">Dinas Intansi Terkait</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Nama Sekolah/Perguruan Tinggi</label>
				<div class="col-md-6">				
					<input type="text" class="form-control" value="<?php echo set_value('nm_sekolah', (isset($DataPersonil->nm_sekolah) ? $DataPersonil->nm_sekolah : ''))?>" name="nm_sekolah" placeholder="Nama Sekolah/Perguruan Tinggi" autocomplete="off">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Kota Asal Sekolah</label>
				<div class="col-md-6">				
					<input type="text" class="form-control" value="<?php echo set_value('alamat_skl', (isset($DataPersonil->alamat_skl) ? $DataPersonil->alamat_skl : ''))?>" name="alamat_skl" placeholder="Kota Asal Sekolah" autocomplete="off">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">No. Ijazah</label>
				<div class="col-md-6">				
					<input type="text" class="form-control" value="<?php echo set_value('no_ijazah', (isset($DataPersonil->no_ijazah) ? $DataPersonil->no_ijazah : ''))?>" name="no_ijazah" placeholder="No. Ijazah" autocomplete="off">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Tahun Lulus</label>
				<div class="col-md-6">				
					<input type="text" class="form-control" value="<?php echo set_value('thn_lulus', (isset($DataPersonil->thn_lulus) ? $DataPersonil->thn_lulus : ''))?>" name="thn_lulus" placeholder="Tahun Kelulusan" autocomplete="off">
				</div>
			</div>
			<div class="form-group">
				<label for="exampleInputFile" class="col-md-3 control-label">File Ijazah</label>
				<div class="col-md-9">
					<input type="file" id="exampleInputFile">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label"></label>
				<div class="col-md-9">	
					<button type="submit" class="btn green">Simpan</button>
				</div>
			</div>
		</divs>	
</form>
	
