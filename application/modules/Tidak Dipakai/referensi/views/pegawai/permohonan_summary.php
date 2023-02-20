<div class="row">
	<div class="col-md-3">
		<?if((isset($DataPengajuan->no_registrasi) ? $DataPengajuan->no_registrasi : '') != ""){?>
		<p class="note note-success">NO REGISTRASI :<br><?php echo $DataPengajuan->no_registrasi;?></p>
		<?}?>
		<ul class="list-unstyled profile-nav">
			<li>
				<a data-toggle="tab" href="#tab_1_1"><i class="fa fa-cog"></i> Data Pemohon </a>
				<span class="after"></span>
			</li>
			<li>
				<a data-toggle="tab" href="#tab_1_2"><i class="fa fa-cog"></i> Data Pemilik BG </a>
			</li>
			<li>
				<a data-toggle="tab" href="#tab_1_3"><i class="fa fa-cog"></i> Lokasi BG </a>
			</li>
			<li>
				<a data-toggle="tab" href="#tab_1_4"><i class="fa fa-cog"></i> Jenis Permohonan IMB </a>
			</li>
		</ul>
		<?if((isset($DataPengajuan->nama_permohonan) ? $DataPengajuan->nama_permohonan : '') != ""){?>
		<p class="note note-warning">NAMA PERMOHONAN : <?php echo $DataPengajuan->nama_permohonan;?></p>
		<?}?>
	</div>
	<div class="col-md-9">
		<div class="tab-content">
			<!-- Begin Data pemohon -->
			<div id="tab_1_1" class="tab-pane active">
				<form action="<?php echo site_url('pengajuan/saveDataPemohon'); ?>"  class="form-horizontal" role="form" id="form_DataPemohon" >
					<div class="form-group input-xlarge">
						<label class="control-label">Nama Pemohon</label>
						<div class="input-icon right">
							<input type="hidden" class="form-control" value="<?php echo set_value('id', (isset($DataPemohon->id) ? $DataPemohon->id : ''))?>" name="id" placeholder="id" autocomplete="off">
							<input type="hidden" class="form-control" value="<?php echo set_value('pengajuan_id', (isset($pengajuan_id) ? $pengajuan_id : ''))?>" name="pengajuan_id" placeholder="id" autocomplete="off">
							<input type="hidden" class="form-control" value="<?php echo set_value('code_pengajuan', (isset($code_pengajuan) ? $code_pengajuan : ''))?>" name="code_pengajuan" placeholder="code_pengajuan" autocomplete="off">
							<input type="text" class="form-control" value="<?php echo set_value('nama_pemohon', (isset($DataPemohon->nama_pemohon) ? $DataPemohon->nama_pemohon : ''))?>" name="nama_pemohon" placeholder="Nama Pemohon" autocomplete="off">
						</div>
					</div>
					<div class="form-group input-xlarge">
						<label class="control-label">No Identitas</label>
						<div class="input-icon right">
							<input type="text" class="form-control" value="<?php echo set_value('no_ktp', (isset($DataPemohon->no_ktp) ? $DataPemohon->no_ktp : ''))?>" name="no_ktp" placeholder="No Identitas" autocomplete="off">
						</div>
					</div>
					<div class="form-group input-xlarge">
						<label class="control-label">Alamat</label>
						<div class="input-icon right">
							<textarea class="form-control" rows="3" name="alamat" ><?php echo set_value('alamat', (isset($DataPemohon->alamat) ? $DataPemohon->alamat : ''))?></textarea>
						</div>
					</div>
					<div class="form-group input-xlarge">
						<label class="control-label">Provinsi</label>
						<div class="input-icon right">
							<select name="nama_provinsi" id="nama_provinsi" class="form-control select2me" data-placeholder="Select..." onchange="getkabkota(this.value)">
								<?php 
								if($daftar_provinsi->num_rows() > 0)
								{
									foreach ($daftar_provinsi->result() as $key) 
									{
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
					<div>
						<div class="form-group input-xlarge">
						<label class="control-label">Kabupaten/Kota</label>
						<div class="input-icon right">
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
					<div>
						<div class="form-group input-xlarge">
							<label class="control-label">Kecamatan</label>
							<div class="input-icon right">	
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
					<div class="form-group input-xlarge">
						<label class="control-label">No. Handphone</label>
						<div class="input-icon right">
							<input type="text" class="form-control" value="<?php echo set_value('no_hp', (isset($DataPemohon->no_hp) ? $DataPemohon->no_hp : ''))?>" name="no_hp" placeholder="No HandPhone" autocomplete="off">
						</div>
					</div>
					<div class="form-group input-xlarge">
						<label class="control-label">No. Telephone</label>
						<div class="input-icon right">
							<input type="text" class="form-control" value="<?php echo set_value('no_tlp', (isset($DataPemohon->no_tlp) ? $DataPemohon->no_tlp : ''))?>" name="no_tlp" placeholder="No Telephone" autocomplete="off">
						</div>
					</div>
					<div class="form-group input-xlarge">
						<label class="control-label">Email</label>
						<div class="input-icon right">
							<input type="text" class="form-control" value="<?php echo set_value('email', (isset($DataPemohon->email) ? $DataPemohon->email : ''))?>" name="email" placeholder="Mohon untuk Menginput Email Aktif" autocomplete="off">
						</div>
					</div>
					
					<div class="form-group input-xlarge">
						<label class="control-label"></label>
						<div class="col-md-9">	
							<button type="submit" class="btn green">Simpan</button>
						</div>
					</div>
				</form>
			</div>
			<!-- End Data Pemohon -->
			<!-- Begin Data Pemilik BG -->
			<div id="tab_1_2" class="tab-pane">
				<form action="<?php echo site_url('pengajuan/saveDataPemilik'); ?>" class="form-horizontal" role="form" id="from_DataPemilik" >
					<div class="form-group input-xlarge">
						<div class="input-icon right">
							<label class="control-label">Jenis Kepemilikan</label>
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
					<!-- Begin Kepemilikan Badan Usaha !-->
					<div id="badan_usaha" style="display: none;">
						<div class="form-group input-xlarge">
							<label class="control-label">NIB</label>
							<div class="input-icon right">	
								<input type="text" class="form-control" value="<?php echo set_value('nib', (isset($DataPemilik->nib) ? $DataPemilik->nib : ''))?>" name="nib" placeholder="NIB" autocomplete="off">
							</div>
						</div>
						<div class="form-group input-xlarge">
							<label class="control-label">Nama Perusahaan</label>
							<div class="input-icon right">	
								<input type="text" class="form-control" value="<?php echo set_value('nama_perusahaan', (isset($DataPemilik->nama_perusahaan) ? $DataPemilik->nama_perusahaan : ''))?>" name="nama_perusahaan" placeholder="Nama Perusahaan" autocomplete="off">
							</div>
						</div>
						<div class="form-group input-xlarge">
							<label class="control-label">NPWP Perusahaan</label>
							<div class="input-icon right">	
								<input type="text" class="form-control" value="<?php echo set_value('npwp_perusahaan', (isset($DataPemilik->npwp_perusahaan) ? $DataPemilik->npwp_perusahaan : ''))?>" name="npwp_perusahaan" placeholder="NPWP Perusahaan" autocomplete="off">
							</div>
						</div>
					</div>
					<!-- End Kepemilikan Badan Usaha !-->
					<!-- Begin Kepemilikan Perseorangan !-->
					<div id="perseorangan" style="display: none;">
						<div class="form-group input-xlarge">
							<label class="control-label">Nama Pemilik</label>
							<div class="input-icon right">	
								<input type="text" class="form-control" value="<?php echo set_value('nama_pemilik', (isset($DataPemilik->nama_pemilik) ? $DataPemilik->nama_pemilik : ''))?>" name="nama_pemilik" placeholder="Nama Pemilik" autocomplete="off">
							</div>
						</div>
						<div class="form-group input-xlarge">
							<label class="control-label">No KTP</label>
							<div class="input-icon right">	
								<input type="text" class="form-control" value="<?php echo set_value('no_ktp_pemilik', (isset($DataPemilik->no_ktp_pemilik) ? $DataPemilik->no_ktp_pemilik : ''))?>" name="no_ktp_pemilik" placeholder="No Identitas Pemilik" autocomplete="off">
							</div>
						</div>
						<div class="form-group input-xlarge">
							<label class="control-label">Pekerjaan</label>
							<div class="input-icon right">	
								<input type="text" class="form-control" value="<?php echo set_value('pekerjaan_pemilik', (isset($DataPemilik->pekerjaan_pemilik) ? $DataPemilik->pekerjaan_pemilik : ''))?>" name="pekerjaan_pemilik" placeholder="Pekerjaan Pemilik" autocomplete="off">
							</div>
						</div>
					</div
					<!-- End Kepemilikan Perseorangan !-->
					<!-- Begin Kepemilikan Pemerintah !-->
					<div id="pemerintah" style="display: none;">
						<div class="form-group input-xlarge">
							<label class="control-label">Nama Kementerian</label>
							<div class="input-icon right">	
								<input type="hidden" class="form-control" value="<?php echo set_value('id_kementerian', (isset($DataPemilik->id_kementerian) ? $DataPemilik->id_kementerian : ''))?>" name="id_kementerian" placeholder="id Kementerian" autocomplete="off">
								<input type="text" class="form-control" value="<?php echo set_value('nama_kementerian', (isset($DataPemilik->nama_kementerian) ? $DataPemilik->nama_kementerian : ''))?>" name="nama_kementerian" placeholder="Nama Kementerian" autocomplete="off">
							</div>
						</div>
					</div>
					<!-- End Kepemilikan Pemerintah !-->
					<div class="form-group input-xlarge">
						<label class="control-label">Alamat</label>
						<div class="input-icon right">	
							<textarea class="form-control" rows="3" name="alamat_pemilik" ><?php echo set_value('alamat_pemilik', (isset($DataPemilik->alamat_pemilik) ? $DataPemilik->alamat_pemilik : ''))?></textarea>
						</div>
					</div>
					<div class="form-group input-xlarge">
						<label class="control-label">Provinsi</label>
						<div class="input-icon right">	
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
					<div id="kab_kota_pemilik" style="display: block;">
						<div class="form-group input-xlarge">
							<label class="control-label">Kab/Kota</label>
							<div class="input-icon right">		
								<select name="nama_kabkota_pemilik" id="nama_kabkota_pemilik" class="form-control select2me" data-placeholder="Select..." onchange="getkecamatan(this.value)">
									<?php 
										if($DataPemilik->id)
										{
											if($daftar_kabkota->num_rows() > 0)
											{
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
					<div id="kecamatan_pemilik" style="display: block;">
						<div class="form-group input-xlarge">
							<label class="control-label">Kecamatan</label>
							<div class="input-icon right">		
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
					<div class="form-group input-xlarge">
						<label class="control-label"></label>
						<div class="col-md-9">	
							<button type="submit" class="btn green">Simpan</button>
						</div>
					</div>
				</form>
			</div>
			<!-- End Data Pemilik BG -->
			<div id="tab_1_3" class="tab-pane">
				<form action="#" class="form-horizontal" role="form" >
					<!-- Begin MAP Lokasi !-->
					
					<!-- END MAP Lokasi !-->
					<div class="form-group input-xlarge">
						<label class="control-label">Lokasi Bangunan Gedung</label>
						<div class="input-icon right">
							<i class="fa fa-warning tooltips" data-original-title="Data Kosong!" data-container="body"></i>
							<textarea class="form-control" rows="2" disabled="false"></textarea>
						</div>
					</div>
					<div class="form-group input-xlarge">
						<label class="control-label">Lat</label>
						<div class="input-icon right">
							<i class="fa fa-warning tooltips" data-original-title="Data Kosong!" data-container="body"></i>
							<input type="text" class="form-control" value="" placeholder="" disabled="false">
						</div>
					</div>
					<div class="form-group input-xlarge">
						<label class="control-label">Lang</label>
						<div class="input-icon right">
							<i class="fa fa-warning tooltips" data-original-title="Data Kosong!" data-container="body"></i>
							<input type="text" class="form-control" value="" placeholder="" disabled="false">
						</div>
					</div>
				</form>
			</div>
			<div id="tab_1_4" class="tab-pane">
				<form action="#" class="form-horizontal" role="form" >
					<div class="form-group input-xlarge">
						<label class="control-label">Nama Bangunan</label>
						<div class="input-icon right">
							<i class="fa fa-warning tooltips" data-original-title="Data Kosong!" data-container="body"></i>
							<input type="text" class="form-control" value="" placeholder="" disabled="false">
						</div>
					</div>
					<div class="form-group input-xlarge">
						<label class="control-label">Jenis Permohonan</label>
						<div class="input-icon right">
							<i class="fa fa-warning tooltips" data-original-title="Data Kosong!" data-container="body"></i>
							<input type="text" class="form-control" value="" placeholder="" disabled="false">
						</div>
					</div>
					<div class="form-group input-xlarge">
						<label class="control-label">Fungsi BG</label>
						<div class="input-icon right">
							<i class="fa fa-warning tooltips" data-original-title="Data Kosong!" data-container="body"></i>
							<input type="text" class="form-control" value="" placeholder="" disabled="false">
						</div>
					</div>
					<div class="form-group input-xlarge">
						<label class="control-label">Luas Bangunan</label>
						<div class="input-icon right">
							<i class="fa fa-warning tooltips" data-original-title="Data Kosong!" data-container="body"></i>
							<input type="text" class="form-control" value="" placeholder="" disabled="false">
						</div>
					</div>
					<div class="form-group input-xlarge">
						<label class="control-label">Tinggi Bangunan</label>
						<div class="input-icon right">
							<i class="fa fa-warning tooltips" data-original-title="Data Kosong!" data-container="body"></i>
							<input type="text" class="form-control" value="" placeholder="" disabled="false">
						</div>
					</div>
					<div class="form-group input-xlarge">
						<label class="control-label">Dokumen Teknis</label>
						<div class="input-icon right">
							<i class="fa fa-warning tooltips" data-original-title="Data Kosong!" data-container="body"></i>
							<input type="text" class="form-control" value="" placeholder="" disabled="false">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	function getjenisKepemilikan(v)
	{
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
