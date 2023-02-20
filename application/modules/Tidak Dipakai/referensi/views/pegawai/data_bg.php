<script type="text/javascript">

function cek_doktek(){
	document.getElementById('dokumen_teknis').style.display="block";
	document.getElementById("id_dok_tek1").checked = false;
	var luas_bg = document.getElementsByName("luas_bg")[0].value;
	var jml_lantai_bg = document.getElementsByName("jml_lantai_bg")[0].value;
	var id_jenis_bg = "<?=(isset($DataJenisPermohonan->id_jenis_permohonan) ? $DataJenisPermohonan->id_jenis_permohonan : '')?>";
	var id_pemanfaatan_bg = "<?=(isset($DataJenisPermohonan->id_klasifikasi_bg) ? $DataJenisPermohonan->id_klasifikasi_bg : '')?>";
	var nama = "";
	
	if(id_jenis_bg == '1'){//Gedung Baru
		nama += "gedung baru, ";
		if(luas_bg > 500 || jml_lantai_bg > 2){//Tidak Sederhana
			nama += "Tidak Sederhana, ";
			document.getElementById("id_dok_tek1").checked = true;
			document.getElementById("id_dok_tek2").disabled = true;
			document.getElementById("id_dok_tek3").disabled = true;
		}else if(luas_bg <= 500){//sederhanan
			nama += "Sederhana, ";
			if(id_pemanfaatan_bg == '2'){//bukan untuk kepentingan umum
				nama += "Hunian, ";
				if(luas_bg <= 100){//luas bangunan di bawah 100
					nama += "luas bgn di bawah 100, ";
					if(jml_lantai_bg == 1){// 1 lantai
						nama += "1 lantai, ";
						document.getElementById("id_dok_tek1").removeAttribute("disabled",'disabled');
						document.getElementById("id_dok_tek2").removeAttribute("disabled",'disabled');
						document.getElementById("id_dok_tek3").removeAttribute("disabled",'disabled');
					}else if(jml_lantai_bg == 2){//2 lantai
						nama += "2 lantai, ";
						document.getElementById("id_dok_tek1").removeAttribute("disabled",'disabled');
						document.getElementById("id_dok_tek2").removeAttribute("disabled",'disabled');
						document.getElementById("id_dok_tek3").disabled = true;
					}
				}else{//luas bgn lebih dari 100 dan di bawah 500
					nama += "luas bgn lebih dari 100 di bawah 500, ";
					document.getElementById("id_dok_tek1").checked = true;
					document.getElementById("id_dok_tek2").disabled = true;
					document.getElementById("id_dok_tek3").disabled = true;
				}
			}else{//untuk kepentingan umum
				nama += "Untuk Kepentingan Umum, ";
				document.getElementById("id_dok_tek1").checked = true;
				document.getElementById("id_dok_tek2").disabled = true;
				document.getElementById("id_dok_tek3").disabled = true;
			}
		}
	}else if(id_jenis_bg == '2'){
		nama += "BG Existing, ";
		document.getElementById("id_dok_tek1").removeAttribute("disabled",'disabled');
		document.getElementById("id_dok_tek2").removeAttribute("disabled",'disabled');
		document.getElementById("id_dok_tek3").removeAttribute("disabled",'disabled');
	}else{
		nama += "Bukan Gedung Baru, ";
		document.getElementById("id_dok_tek1").removeAttribute("disabled",'disabled');
		document.getElementById("id_dok_tek2").disabled = true;
		document.getElementById("id_dok_tek3").disabled = true;
	}
	
	//alert(nama);
}

</script>
<form action="<?php echo site_url('pengajuan/saveDataBg'); ?>" class="form-horizontal" role="form" method="post" id="from_DataBg">
	<div class="col-md-12 ">
		<div id="databg_bukan_prasarana" style="display: none;">
			<div class="form-group">
				<label class="col-md-3 control-label">Luas Bangunan</label>
				<div class="col-md-9">
					<input type="hidden" class="form-control" value="<?php echo set_value('id', (isset($DataBg->id) ? $DataBg->id : ''))?>" name="id" placeholder="id" autocomplete="off">
					<input type="hidden" class="form-control" value="<?php echo set_value('pengajuan_id', (isset($pengajuan_id) ? $pengajuan_id : ''))?>" name="pengajuan_id" placeholder="id" autocomplete="off">
					<input type="hidden" class="form-control" value="<?php echo set_value('code_pengajuan', (isset($code_pengajuan) ? $code_pengajuan : ''))?>" name="code_pengajuan" placeholder="code_pengajuan" autocomplete="off">
					<input type="hidden" class="form-control" value="<?php echo set_value('id_jenis_permohonan', (isset($DataJenisPermohonan->id_jenis_permohonan) ? $DataJenisPermohonan->id_jenis_permohonan : ''))?>" name="id_jenis_permohonan" placeholder="id_jenis_permohonan" autocomplete="off">
					<input type="hidden" class="form-control" value="<?php echo set_value('id_fungsi_bg', (isset($DataJenisPermohonan->id_fungsi_bg) ? $DataJenisPermohonan->id_fungsi_bg : ''))?>" name="id_fungsi_bg" placeholder="id_fungsi_bg" autocomplete="off">
					<input type="hidden" class="form-control" value="<?php echo set_value('id_klasifikasi_bg', (isset($DataJenisPermohonan->id_klasifikasi_bg) ? $DataJenisPermohonan->id_klasifikasi_bg : ''))?>" name="id_klasifikasi_bg" placeholder="id_klasifikasi_bg" autocomplete="off">
					<input type="text" class="form-control" value="<?php echo set_value('luas_bg', (isset($DataBg->luas_bg) ? $DataBg->luas_bg : ''))?>" name="luas_bg" placeholder="Luas Bangunan" autocomplete="off" onblur="cek_doktek();">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Tinggi Bangunan</label>
				<div class="col-md-9">	
					<input type="text" class="form-control" value="<?php echo set_value('tinggi_bg', (isset($DataBg->tinggi_bg) ? $DataBg->tinggi_bg : ''))?>" name="tinggi_bg" placeholder="Tinggi Bangunan" autocomplete="off">
				</div>
			</div>
			<hr>
			<div class="form-group">
				<label class="col-md-3 control-label">Jumlah Lantai</label>
				<div class="col-md-9">	
					<input type="text" class="form-control" value="<?php echo set_value('jml_lantai_bg', (isset($DataBg->jml_lantai_bg) ? $DataBg->jml_lantai_bg : ''))?>" name="jml_lantai_bg" placeholder="Jumlah Lantai Bangunan" autocomplete="off" onblur="cek_doktek();">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Luas Basement</label>
				<div class="col-md-9">	
					<input type="text" class="form-control" value="<?php echo set_value('luas_basement', (isset($DataBg->luas_basement) ? $DataBg->luas_basement : ''))?>" name="luas_basement" placeholder="Luas Basement" autocomplete="off" >
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Jumlah Lantai Basement</label>
				<div class="col-md-9">	
					<input type="text" class="form-control" value="<?php echo set_value('jml_lantai_basement', (isset($DataBg->jml_lantai_basement) ? $DataBg->jml_lantai_basement : ''))?>" name="jml_lantai_basement" placeholder="Jumlah Lantai Basement" autocomplete="off" >
				</div>
			</div>
		</div>
		<div id="databg_prasarana" style="display: none;">
			<div class="form-group">
				<label class="col-md-3 control-label">Ketinggian Prasarana</label>
				<div class="col-md-9">	
					<input type="text" class="form-control" value="<?php echo set_value('ketinggian_prasarana', (isset($DataBg->ketinggian_prasarana) ? $DataBg->ketinggian_prasarana : ''))?>" name="ketinggian_prasarana" placeholder="Ketinggian Prasarana" autocomplete="off">
				</div>
			</div>
		</div>
		<hr>
		<div id="dokumen_teknis" style="display: none;">
			<div class="form-group">
				<label class="col-md-3 control-label">Dokumen Teknis</label>
				<div class="col-md-9">
					<?php 	
						$id_dok_tek = set_value('id_dok_tek', (isset($DataBg->id_dok_tek) ? $DataBg->id_dok_tek : ''));
					?>
					<div class="radio-list">
						<label><input type="radio" name="id_dok_tek" id="id_dok_tek1" onclick="set_dok_teknis(this.value)" value="1" > Perencana Konstruksi</label>
						<label><input type="radio" name="id_dok_tek" id="id_dok_tek2" onclick="set_dok_teknis(this.value)" value="2" > Desain Prototipe </label>
						<label><input type="radio" name="id_dok_tek" id="id_dok_tek3" onclick="set_dok_teknis(this.value)" value="3" > Disediakan Sendiri Oleh Pemohon </label>
					</div>
				</div>
			</div>
		</div>
		<div id="desain_prototipe" style="display: none;">
		desain prototipe
		</div>
		<div id="desain_dibuatsendiri" style="display: none;">
		dibuat sendiri
		<hr>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Alamat/Lokasi Bangunan</label>
			<div class="col-md-9">	
				<textarea class="form-control" rows="3" name="lokasi_bg" ><?php echo set_value('lokasi_bg', (isset($DataBg->lokasi_bg) ? $DataBg->lokasi_bg : ''))?></textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Provinsi</label>
			<div class="col-md-9">	
				<select name="nama_provinsi_pemilik" id="nama_provinsi_pemilik" class="form-control select2me" data-placeholder="Select..." onchange="getkabkota(this.value)">
				<?php 
					if($daftar_provinsi->num_rows() > 0){
						foreach ($daftar_provinsi->result() as $key) {
							if($key->id_provinsi == $DataBg->id_provinsi){
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
		<div id="kab_kota_lokasi_bg" style="display: none;">
			<div class="form-group">
				<label class="col-md-3 control-label">Kab/Kota</label>
				<div class="col-md-9">	
					<select name="nama_kabkota_lokasi_bg" id="nama_kabkota_lokasi_bg" class="form-control select2me" data-placeholder="Select..." onchange="getkecamatan(this.value)">
					<?php 
						if($DataBg->id){
							if($daftar_kabkota->num_rows() > 0){
								foreach ($daftar_kabkota->result() as $key) {
									if($key->id_kabkot == $DataBg->id_kabkot){
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
		<div id="kecamatan_lokasi_bg" style="display: none;">
			<div class="form-group">
				<label class="col-md-3 control-label">Kecamatan</label>
				<div class="col-md-9">	
					<select name="nama_kecamatan_lokasi_bg" id="nama_kecamatan_lokasi_bg" class="form-control select2me" data-placeholder="Select...">
					<?php 
						if($DataBg->id){
							if($daftar_kecamatan->num_rows() > 0){
								foreach ($daftar_kecamatan->result() as $key) {
									if($key->id_kecamatan == $DataBg->id_kecamatan){
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
	
	var id_jenis_permohonan	 = "<?=(isset($DataJenisPermohonan->id_jenis_permohonan) ? $DataJenisPermohonan->id_jenis_permohonan : '')?>";
	var id_provinsi			 = "<?=(isset($DataBg->id_provinsi) ? $DataBg->id_provinsi : '')?>";
	var id_kabkot			 = "<?=(isset($DataBg->id_kabkot) ? $DataBg->id_kabkot : '')?>";
	var id_kecamatan		 = "<?=(isset($DataBg->id_kabkot) ? $DataBg->id_kabkot : '')?>";
	if(id_kabkot != ""){
		document.getElementById('kab_kota_lokasi_bg').style.display="block";
	}
	if(id_kecamatan != ""){
		document.getElementById('kecamatan_lokasi_bg').style.display="block";
	}
	
	if(id_jenis_permohonan == '5'){
		document.getElementById('databg_bukan_prasarana').style.display="none";
		document.getElementById('databg_prasarana').style.display="block";
	}else{
		document.getElementById('databg_bukan_prasarana').style.display="block";
		document.getElementById('databg_prasarana').style.display="none";
	}
	
	cek_doktek();
	
});

function getkabkota(v,id_kabkot){
	jQuery.post(base_url+'pengajuan/getDataKabKota/'+v,function(data){
		var nama_kabkota	= '';
		jQuery.each(data, function(key, value){
			nama_kabkota += '<option value="'+value.id_kabkot+'"> '+value.nama_kabkota+' </option>';
		});
		jQuery('#nama_kabkota_lokasi_bg').html(nama_kabkota);
	},'json');
	
	document.getElementById('kab_kota_lokasi_bg').style.display="block";
}

function getkecamatan(v,id_kecamatan){
	jQuery.post(base_url+'pengajuan/getDataKecamatan/'+v,function(data){
		var nama_kecamatan	= '';
		jQuery.each(data, function(key, value){
			
			nama_kecamatan += '<option value="'+value.id_kecamatan+'" > '+value.nama_kecamatan+' </option>';
		});
		jQuery('#nama_kecamatan_lokasi_bg').html(nama_kecamatan);
	},'json');
	
	document.getElementById('kecamatan_lokasi_bg').style.display="block";
	
}

</script>