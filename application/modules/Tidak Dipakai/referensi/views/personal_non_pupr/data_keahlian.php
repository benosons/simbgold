<script type="text/javascript">

</script>
<form action="<?php echo site_url('referensi/saveDataKeahlian'); ?>" class="form-horizontal" role="form" method="post" id="Form_Data_Keahlian">
	
		<div class="col-md-12 ">
			<div class="form-group">
				<label class="col-md-3 control-label">Unsur ASN/TABG</label>
				<div class="col-md-6">	
					<select class="form-control" name="id_jenis_kepemilikan" id="id_jenis_kepemilikan" onchange="getjenisKepemilikan(this.value)">
						<option value="">--Pilih--</option>
						<option value="1">Ahli</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Sub Unsur</label>
				<div class="col-md-6">	
					<select name="nama_unsur_ahli" id="nama_unsur_ahli" class="form-control select2me" data-placeholder="Select..." onchange="getjurusan(this.value)">
						<?php 
							if($daftar_sub->num_rows() > 0)
							{
								foreach ($daftar_sub->result() as $key) 
								{
									if($key->id_unsur_ahli == $daftar_sub->id_unsur_ahli){
										$plhrole = "selected";
									}else{
										$plhrole = "Pilih";
										}
									echo '<option value="'.$key->id_unsur_ahli.'" '.$plhrole.'>'.$key->nama_unsur_ahli.'</option>';
								}
							}
						?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Kualifikasi/Jabatan</label>
				<div class="col-md-6">	
					<select name="nama_keahlian" id="nama_keahlian" class="form-control select2me" data-placeholder="Select..." onchange="getjurusan(this.value)">
						<?php 
							if($daftar_sub->num_rows() > 0)
							{
								foreach ($daftar_keahlian->result() as $key) 
								{
									if($key->id_unsur_keahlian == $daftar_keahlian->id_unsur_keahlian){
										$plhrole = "selected";
									}else{
										$plhrole = "Pilih";
										}
									echo '<option value="'.$key->id_unsur_keahlian.'" '.$plhrole.'>'.$key->nama_keahlian.'</option>';
								}
							}
						?>
					</select>
				</div>
			</div>
			<div class="form-group">
					<label class="col-md-3 control-label">File</label>
					<div class="col-md-9">	
						<textarea class="form-control" rows="3" name="alamat_pemilik" ><?php echo set_value('alamat_pemilik', (isset($DataPemilik->alamat_pemilik) ? $DataPemilik->alamat_pemilik : ''))?></textarea>
					</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Tgl. SK/Sertifikat</label>
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
	
