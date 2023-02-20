<div class="tab-pane" id="tab_1_2">
	<div class="tab-pane active" id="tab_1_1">
		<div class="row profile-account">
			<div class="col-md-3">
				<ul class="ver-inline-menu tabbable margin-bottom-10">
					<li class="active">
						<a data-toggle="tab" href="#tab_1-1"><i class="fa fa-cog"></i> Data Pemilik Bangunan  </a>
						<span class="after"></span>
					</li>
					<li>
						<a data-toggle="tab" href="#tab_1-2"><i class="fa fa-cog"></i> Data Bangunan Gedung </a>
					</li>
				</ul>
			</div>
			<div class="col-md-7">
				<div class="tab-content">
					<div id="tab_1-1" class="tab-pane active">
						<div class="form-group">
							<?
								if ($DataPermohonan->id_jenis_usaha == '1'){
									$JenisKepemilikan  = "Perseorangan";
								}else if($DataPermohonan->id_jenis_usaha == '2'){
									$JenisKepemilikan  = "Badan Usaha / Hukum";
								}else if($DataPermohonan->id_jenis_usaha == '3'){
									$JenisKepemilikan  = "Pemerintah";
								}else{
									$JenisKepemilikan  = "Belum Dipilih";
								}
							?>
							<label class="control-label">Jenis Kepemilikan </label>
							<input type="text" class="form-control" value="<?php echo set_value('JenisKepemilikan', (isset($JenisKepemilikan) ? $JenisKepemilikan : ''))?>" name="nama_lengkap" placeholder="Jenis Kepemilikan" autocomplete="off">
						</div>
						<div class="form-group">
							<?
								if($DataPermohonan ->nama_pemohon != null || $DataPermohonan->nama_pemohon !=''){
									$nama_pemilik = $DataPermohonan ->nama_pemohon;
								}else{
									$nama_pemilik = $DataPermohonan ->nama_perusahaan;
								}
							?>
							<label class="control-label">Nama Lengkap</label>
							<input type="text" class="form-control" value="<?php echo set_value('nama_pemilik', (isset($nama_pemilik) ? $nama_pemilik : ''))?>" name="nama_pemilik" placeholder="Nama Pemilik Lengkap" autocomplete="off">
						</div>
						<div class="form-group">
							<label class="control-label">Alamat Pemilik</label>
							<textarea class="form-control" rows="3" name="alamat">
								<?php echo set_value('alamat', (isset($DataPermohonan->alamat_pemohon) ? $DataPermohonan->alamat_pemohon : ''))?>
							</textarea>
						</div>
						<div class="form-group">
							<label class="control-label">No. Identitas</label>
							<input type="text" class="form-control" value="<?php echo set_value('no_ktp', (isset($DataPermohonan->no_ktp) ? $DataPermohonan->no_ktp : ''))?>" name="no_ktp" placeholder="E-Mail" autocomplete="off">
						</div>
						<div class="form-group">
							<label class="control-label">E-Mail</label>
							<input type="text" class="form-control" value="<?php echo set_value('email', (isset($DataPermohonan->email) ? $DataPermohonan->email : ''))?>" name="email" placeholder="E-Mail" autocomplete="off">
						</div>
						<div class="form-group">
							<label class="control-label">No.Telephone / No. Handphone</label>
							<input type="text" class="form-control" value="<?php echo set_value('no_tlp', (isset($DataPermohonan->no_tlp) ? $DataPermohonan->no_tlp : ''))?>" name="no_tlp" placeholder="No. Telephone" autocomplete="off">
						</div>
					</div>
					<div id="tab_1-2" class="tab-pane">
						<div class="form-group">
							<label class="control-label">Alamat Bangunan Gedung</label>
							<textarea class="form-control" rows="4" name="alamat">
								<?php echo set_value('alamat', (isset($DataPermohonan->alamat_bg) ? $DataPermohonan->alamat_bg : ''))?>, Kel/Desa. <?php echo set_value('kelurahan', (isset($DataPermohonan->kelurahan) ? $DataPermohonan->kelurahan : ''))?>, Kec. <?php echo set_value('nama_kecamatan', (isset($DataPermohonan->nama_kecamatan) ? $DataPermohonan->nama_kecamatan : ''))?>, <?php echo set_value('nama_kabkota', (isset($DataPermohonan->nama_kabkota) ? $DataPermohonan->nama_kabkota : ''))?>, Prov. <?php echo set_value('nama_provinsi', (isset($DataPermohonan->nama_provinsi) ? $DataPermohonan->nama_provinsi : ''))?>
							</textarea>
						</div>
						<div class="form-group">
							<label class="control-label">Permohonan IMB</label>
							<?
								if($DataPermohonan->id_fungsi_bg =='1'){
									$jenisPermohonan  ="Mendirikan Bangunan Gedung Baru";
								}else if ($DataPermohonan->id_fungsi_bg =='2'){
									$jenisPermohonan  ="Bangunan Gedung  Eksisting Belum Ber-IMB";
								}else if($DataPermohonan->id_fungsi_bg =='3'){
									$jenisPermohonan  ="Bangunan Gedung Perubahan";
								}else if($DataPermohonan->id_fungsi_bg =='4'){
									$jenisPermohonan  ="Bangunan Gedung Kolektif";
								}else if($DataPermohonan->id_fungsi_bg =='5'){
									$jenisPermohonan  ="Bangunan Gedung Prasarana";
								}else if($DataPermohonan->id_fungsi_bg =='6'){
									$jenisPermohonan  ="Bangunan Gedung IMB Bertahap";
								}
							?>
							<input type="text" class="form-control" value="<?php echo set_value('jenisPermohonan', (isset($jenisPermohonan) ? $jenisPermohonan : ''))?>" name="jenisPermohonan" placeholder="Jenis Permohonan" autocomplete="off">
						</div>
						<div class="form-group">
							<label class="control-label">Fungsi Bangunan </label>
							<input type="password" class="form-control"/>
						</div>
						<div class="form-group">
							<label class="control-label">Nama Bangunan</label>
							<input type="password" class="form-control"/>
						</div>
						<div class="form-group">
							<label class="control-label">Luas Bangunan</label>
							<input type="password" class="form-control"/>
						</div>
						<div class="form-group">
							<label class="control-label">Tinggi Bangunan</label>
							<input type="password" class="form-control"/>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
							<!--end tab-pane-->
	<!-- END PAGE CONTENT -->
<script>
function getkabkota(v){
	jQuery.post(base_url+'pengajuan/getDataKabKota/'+v,function(data){
		var nama_kabkota	= '';
		jQuery.each(data, function(key, value){
			nama_kabkota += '<option value="'+value.id_kabkot+'"> '+value.nama_kabkota+' </option>';
		});
		jQuery('#nama_kabkota').html(nama_kabkota);
	},'json');
}
function getkecamatan(v){
	jQuery.post(base_url+'pengajuan/getDataKecamatan/'+v,function(data){
		var nama_kecamatan	= '';
		jQuery.each(data, function(key, value){
			nama_kecamatan += '<option value="'+value.id_kecamatan+'"> '+value.nama_kecamatan+' </option>';
		});
		jQuery('#nama_kecamatan').html(nama_kecamatan);
	},'json');
}

function getkabkotabg(v){
	jQuery.post(base_url+'pengajuan/getDataKabKota/'+v,function(data){
		var nama_kabkota	= '';
		jQuery.each(data, function(key, value){
			nama_kabkota += '<option value="'+value.id_kabkot+'"> '+value.nama_kabkota+' </option>';
		});
		jQuery('#nama_kabkota').html(nama_kabkota);
	},'json');
}
function getkecamatanbg(v){
	jQuery.post(base_url+'pengajuan/getDataKecamatan/'+v,function(data){
		var nama_kecamatan	= '';
		jQuery.each(data, function(key, value){
			nama_kecamatan += '<option value="'+value.id_kecamatan+'"> '+value.nama_kecamatan+' </option>';
		});
		jQuery('#nama_kecamatan').html(nama_kecamatan);
	},'json');
}



</script>
