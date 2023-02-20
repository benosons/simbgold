<script type="text/javascript">

</script>
<form action="<?php echo site_url('referensi/saveDataKeahlian'); ?>" class="form-horizontal" role="form" method="post" id="Form_Data_Keahlian">
	
		<div class="col-md-12 ">
			<div class="form-group">
				<label class="col-md-3 control-label">Unsur ASN Teknis/Intansi Terkait</label>
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
				<label class="col-md-3 control-label">Sub Unsur</label>
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
				<label class="col-md-3 control-label">Bidang Keahlian</label>
				<div class="col-md-6">	
					<select name="nama_bidang" id="nama_bidang" class="form-control select2me" data-placeholder="Select..." onchange="getjurusan(this.value)">
						<?php 
							if($keahlian->num_rows() > 0)
							{
								foreach ($keahlian->result() as $key) 
								{
									if($key->id_bidang == $keahlian->id_bidang){
										$plhrole = "selected";
									}else{
										$plhrole = "";
										}
									echo '<option value="'.$key->id_bidang.'" '.$plhrole.'>'.$key->nama_bidang.'</option>';
								}
							}
						?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Kualifikasi/Jabatan Fungsional</label>
				<div class="col-md-6">				
					<input type="text" class="form-control" value="<?php echo set_value('nm_sekolah', (isset($DataPersonil->nm_sekolah) ? $DataPersonil->nm_sekolah : ''))?>" name="nm_sekolah" placeholder="Kualifikasi/Jabatan Fungsional" autocomplete="off">
				</div>
			</div>
			<div class="form-group">
				<label for="exampleInputFile" class="col-md-3 control-label">File Sertifikat</label>
				<div class="col-md-9">
					<input type="file" id="exampleInputFile">
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
	
