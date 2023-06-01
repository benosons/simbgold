<script language="javascript" type="text/javascript">
$(document).ready(function(){
//let's create arrays
var hunian = [
{display: "--Pilih--", value: "" },
{display: "Rumah tinggal tunggal", value: "Rumah tinggal tunggal" },
{display: "Rumah tinggal deret", value: "Rumah tinggal deret" },
{display: "Rumah tinggal susun", value: "Rumah tinggal susun" },
{display: "Rumah tinggal sementara", value: "Rumah tinggal sementara" }];

var keagamaan = [
	{display: "--Pilih--", value: "" },
	{display: "Bangunan Masjid dan Mushola", value: "Bangunan Masjid dan Mushola" },
	{display: "Bangunan Gereja & Kapel", value: "Bangunan Gereja & Kapel" },
	{display: "Bangunan Pura", value: "Bangunan Pura" },
	{display: "Bangunan Vihara", value: "Bangunan Vihara" },
	{display: "Bangunan Kelenteng", value: "Bangunan Kelenteng" }];

var usaha = [
	{display: "--Pilih--", value: "" },
	{display: "Perkantoran", value: "Perkantoran" },
	{display: "Perdagangan", value: "Perdagangan" },
	{display: "Perindustrian", value: "Perindustrian" },
	{display: "Perhotelan", value: "Perhotelan" },
	{display: "Wisata dan rekreasi", value: "Wisata dan rekreasi" },
	{display: "Terminal", value: "Terminal" },
	{display: "Bangunan gedung tempat penyimpanan", value: "Bangunan gedung tempat penyimpanan" }];

var sosmed = [
	{display: "--Pilih--", value: "" },
	{display: "Pelayanan pendidikan", value: "Pelayanan pendidikan" },
	{display: "Pelayanan kesehatan", value: "Pelayanan kesehatan" },
	{display: "Kebudayaan", value: "Kebudayaan" },
	{display: "Laboratorium", value: "Laboratorium" },
	{display: "Bangunan gedung pelayanan umum", value: "Bangunan gedung pelayanan umum" }];

var khusus = [
	{display: "--Pilih--", value: "" },
	{display: "Bangunan gedung untuk reaktor nuklir", value: "Bangunan gedung untuk reaktor nuklir" },
	{display: "Instalasi pertahanan dan keamanan", value: "Instalasi pertahanan dan keamanan" },
	{display: "Bangunan sejenis yang ditetapkan oleh Menteri", value: "Bangunan sejenis yang ditetapkan oleh Menteri" }];

var parent2 = $(".parent_selection").val();

switch(parent2){ //using switch compare selected option and populate child
		case '1':
		list2(hunian);
		break;
		case '2':
		list2(keagamaan);
		break;
		case '3':
		list2(usaha);
		break;
		case '4':
		list2(sosmed);
		break;
		case '5':
		list2(khusus);
		break;

	default: //default child option is blank
		$("#child_selection").html();
		break;
	 }
//If parent option is changed
$(".parent_selection").change(function() {
	var parent = $(this).val(); //get option value from parent
	switch(parent){ //using switch compare selected option and populate child
			case '1':
			list(hunian);
			break;
			case '2':
			list(keagamaan);
			break;
			case '3':
			list(usaha);
			break;
			case '4':
			list(sosmed);
			break;
			case '5':
			list(khusus);
			break;

		default: //default child option is blank
			$("#child_selection").html();
			break;
		 }
});

//function to populate child select box
function list(array_list)
{
$("#child_selection").html(""); //reset child options
$(array_list).each(function (i) { //populate child options
	$("#child_selection").append("<option value=\""+array_list[i].value+"\">"+array_list[i].display+"</option>");
});
}

function list2(array_list)
{
$(array_list).each(function (i) { //populate child options
	$("#child_selection").append("<option value=\""+array_list[i].value+"\">"+array_list[i].display+"</option>");
});
}

});
</script>
<div class="page-container">
	<div class="page-content">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="portlet light">
						<div class="portlet-body form">
							<form action="<?php echo site_url('pengajuan/saveDataIMB'); ?>" class="form-horizontal" role="form" method="post" id="form_permohonan">
								<h4 class="block">Data Pemilik Bangunan </h4>
								<input type="hidden" class="form-control" value="<?php echo set_value('id_permohonan', (isset($DataPermohonan->id_permohonan) ? $DataPermohonan->id_permohonan : ''))?>" name="id_permohonan" placeholder="Nama Pemilik">
								<div class="form-group">
									<label class="control-label col-md-3">Memiliki NIB ?<span class="required">* </span></label>
									<div class="col-md-7">
										<select class="form-control select2me" name="id_fungsi" onchange="getNib(this.value)">
											<option value="">--Pilih--</option>
											<option value="1" >Memiliki NIB</option>
											<option value="2" >Tidak Memiliki NIB</option>
										</select>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-md-3">Bentuk Kepemilikan <span class="required">
									* </span></label>
									<input class="form-control" value="<?php echo $DataPermohonan->id_permohonan;?>" name="id_permohonan" style="display: none;" placeholder="id" autocomplete="off">
									<div class="col-md-7">
										<select class="bs-select form-control" name="id_jenis_usaha">
											<option value="">--Pilih--</option>
											<option value="1" <?php if($DataPermohonan->id_jenis_usaha == '1') echo "selected";?>>Perseorangan</option>
											<option value="2" <?php if($DataPermohonan->id_jenis_usaha == '2') echo "selected";?>>Badan Usaha/Hukum</option>
											<option value="3" <?php if($DataPermohonan->id_jenis_usaha == '3') echo "selected";?>>Pemerintah</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Nama Pemilik <span class="required">* </span></label>
									<div class="col-md-7">
										<input type="text" class="form-control" value="<?php echo set_value('nama_pemilik', (isset($DataPermohonan->nama_pemohon) ? $DataPermohonan->nama_pemohon : ''))?>" name="nama_pemilik" placeholder="Nama Pemilik">
									</div>
								</div>
								
								<div class="form-group">
														<label class="col-md-3 control-label">Provinsi</label>
														<div class="col-md-7">
															<select name="nama_provinsi" id="nama_provinsi" class="form-control select2me" data-placeholder="Select..." onchange="getkabkota(this.value)">
																<option value="">-- Pilih Provinsi --</option>
																<?php
																if ($daftar_provinsi->num_rows() > 0) {
																	foreach ($daftar_provinsi->result() as $key) {
																		if ($key->id_provinsi == $DataPermohonan->id_provinsi) {
																			$plhrole = "selected";
																		} else {
																			$plhrole = "";
																		}
																		echo '<option value="' . $key->id_provinsi . '" ' . $plhrole . '>' . $key->nama_provinsi . '</option>';
																	}
																}
																?>
															</select>
														</div>
								</div>
													
									<div class="form-group">
										<label class="col-md-3 control-label">Kab/Kota</label>
										<div class="col-md-7">	
											<select name="nama_kabkota" id="nama_kabkota" class="form-control select2me" data-placeholder="Select..." onchange="getkecamatan(this.value)">
											<option value="">-- Pilih Kabupaten / Kota --</option>
												<?php 
													if($DataPermohonan->id_permohonan)
													{
														if($daftar_kabkota->num_rows() > 0)
														{
															foreach ($daftar_kabkota->result() as $key) 
															{
																if($key->id_kabkot == $DataPermohonan->id_kabkot){
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
								
								
							
								<div id="kecamatan" style="display: block;">
									<div class="form-group">
										<label class="col-md-3 control-label">Kecamatan</label>
										<div class="col-md-7">	
											<select name="nama_kecamatan" id="nama_kecamatan" class="form-control select2me" data-placeholder="Select...">
											<option value="">-- Pilih Kecamatan --</option>
												<?php 
													if($DataPermohonan->id_permohonan){
														if($daftar_kecamatan->num_rows() > 0){
															foreach ($daftar_kecamatan->result() as $key) {
																if($key->id_kecamatan == $DataPermohonan->id_kecamatan){
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
									<label class="control-label col-md-3">Alamat Pemilik<span class="required">*</span></label>
									<div class="col-md-8">
										<input type="text" class="form-control" value="<?php echo set_value('alamat_pemohon', (isset($DataPermohonan->alamat_pemohon) ? $DataPermohonan->alamat_pemohon : ''))?>" name="alamat_pemohon" placeholder="Alamat Pemilik" autocomplete="off">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Email <span class="required">* </span></label>
									<div class="col-md-7">

										<input type="text" class="form-control" value="<?php echo set_value('email', (isset($DataPermohonan->email) ? $DataPermohonan->email : ''))?>" name="email" placeholder="E-Mail Pemilik">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">No. Kartu Tanda Penduduk <span class="required">* </span></label>
									<div class="col-md-7">
										<div class="input-group">
											
											<input type="text" class="form-control" value="<?php echo set_value('no_ktp', (isset($DataPermohonan->no_ktp) ? $DataPermohonan->no_ktp : ''))?>" name="no_ktp" placeholder="No. Kartu Penduduk">
										</div>
									</div>
								</div>
								<h4 class="block">Alamat Bangunan Gedung</h4>
								<div class="form-group">
									<label class="col-md-3 control-label">Provinsi</label>
									<div class="col-md-7">	
										<select name="nama_provinsi_bg" id="nama_provinsi_bg" class="form-control select2me" data-placeholder="Select..." onchange="getkabkota_bg(this.value)">
											<?php 
											if($daftar_provinsi->num_rows() > 0){
												foreach ($daftar_provinsi->result() as $prov) {
													if($prov->id_provinsi == $DataPermohonan->id_provinsi_bg){
														$plhrole = "selected";
													}else{
														$plhrole = "";
													}
													echo '<option value="'.$prov->id_provinsi.'" '.$plhrole.'>'.$prov->nama_provinsi.'</option>';
												}
											}
											?>
										</select>
									</div>
								</div>
								
								<div id="kab_kota" style="display: block;">
									<div class="form-group">
										<label class="col-md-3 control-label">Kab/Kota</label>
										<div class="col-md-7">	
											<select name="nama_kabkota_bg" id="nama_kabkota_bg" class="form-control select2me" data-placeholder="Select..." onchange="getkecamatan_bg(this.value)">
												<?php 
													if($DataPermohonan->id_permohonan){
														if($daftar_kabkota->num_rows() > 0){
															foreach ($daftar_kabkota->result() as $key) {
																if($key->id_kabkot == $DataPermohonan->id_kabkot_bg){
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
								<div id="kecamatan" style="display: block;">
									<div class="form-group">
										<label class="col-md-3 control-label">Kecamatan</label>
										<div class="col-md-7">	
											<select name="nama_kecamatan_bg" id="nama_kecamatan_bg" class="form-control select2me" data-placeholder="Select...">
												<?php 
													if($DataPermohonan->id_permohonan){
														if($daftar_kecamatan->num_rows() > 0){
															foreach ($daftar_kecamatan->result() as $key) {
																if($key->id_kecamatan == $DataPermohonan->id_kec_bg){
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
									<label class="control-label col-md-3">Alamat Bangunan Gedung<span class="required">*</span></label>
									<div class="col-md-7">
										<input type="text" class="form-control" value="<?php echo set_value('alamat_bg', (isset($DataPermohonan->alamat_bg) ? $DataPermohonan->alamat_bg : ''))?>" name="alamat_bg" placeholder="Alamat Bangunan" autocomplete="off">				
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Permohonan IMB<span class="required">* </span></label>
									<div class="col-md-7">
										<select class="form-control" name="id_jenis_bg" id="id_jenis_bg" onchange="getjenisPermohonan(this.value)">
											<option value="1" <?php if($DataPermohonan->id_jenis_bg == '1') echo "selected";?>>Mendirikan Bangunan Gedung Baru</option>
											<option value="2" <?php if($DataPermohonan->id_jenis_bg == '2') echo "selected";?>>Bangunan Gedung Existing Belum Ber-IMB</option>
											<option value="3" <?php if($DataPermohonan->id_jenis_bg == '3') echo "selected";?>>Bangunan Gedung Perubahan</option>
											<option value="4" <?php if($DataPermohonan->id_jenis_bg == '4') echo "selected";?>>Bangunan Gedung Kolektif</option>
											<option value="5" <?php if($DataPermohonan->id_jenis_bg == '5') echo "selected";?>>Bangunan Gedung Prasarana</option>
											<option value="6" <?php if($DataPermohonan->id_jenis_bg == '6') echo "selected";?>>Bangunan Gudang 1300 Meter Persegi</option>
										</select>
									</div>
								</div>
								
								<!--Begin Untuk Prasarana -->
												<div id="prasarana" style="display: none;">
													<div class="form-group">
														<label class="control-label col-md-3">Prasarana<span class="required">* </span></label>
														<div class="col-md-7">
															
																<select class="form-control" name="id_prasarana_bg" id="id_prasarana_bg">
																	<option value="">--Pilih--</option>
																	<option value="1">Kontruksi Pembatas/Penahan/Pengaman</option>
																	<option value="2">Konstruksi Penanda Masuk Lokasi</option>
																	<option value="3">Kontruksi Perkerasan</option>
																	<option value="4">Kontruksi Penghubung</option>
																	<option value="5">Kontruksi Kolam/Reservoir bawah tanah</option>
																	<option value="6">Kontruksi Menara</option>
																	<option value="7">Kontruksi Monumen</option>
																	<option value="8">Kontruksi Instalasi/gardu</option>
															</select>
															
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-3">Luas Bangunan Prasarana<span class="required">* </span></label>
														<div class="col-md-3">
															<div class="checkbox-list">
																	<input type="text" class="form-control" value="<?php echo set_value('luas_bg', (isset($DataJenisPermohonan->luas_bg) ? $DataJenisPermohonan->luas_bg : ''))?>" name="luas_bg" placeholder="Luas Bangunan" autocomplete="off">
															</div>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-3">Tinggi Bangunan Prasarana<span class="required">* </span></label>
														<div class="col-md-3">
															<div class="checkbox-list">
																	<input type="text" class="form-control" value="<?php echo set_value('tinggi_bg', (isset($DataJenisPermohonan->tinggi_bg) ? $DataJenisPermohonan->tinggi_bg : ''))?>" name="tinggi_bg" placeholder="Tinggi Bangunan" autocomplete="off">
															</div>
														</div>
													</div>
												</div>
												<!-- End Untuk Prasarana-->
												
								<div class="form-group">
									<label class="control-label col-md-3">Fungsi Bangunan<span class="required">* </span></label>
									<div class="col-md-7">
										<?php $id_fungsi_bg = set_value('id', (isset($DataPermohonan->id_fungsi_bg) ? $DataPermohonan->id_fungsi_bg : ''));?>	
										<?php
											$selected = '';
											if(isset($id_fungsi_bg) && $id_fungsi_bg != '')
												$selected = $id_fungsi_bg;
											else
												$selected = '';
												$js = 'id="id_fungsi_bg" onchange="set_pemanfaatan(this.value)" class="form-control parent_selection"';
											echo form_dropdown('id_fungsi_bg', $list_fungsi, $selected, $js);
										?>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Jenis Bangunan <span class="required">* </span></label>
									<div class="col-md-7">
										<select name="jns_bangunan" id="child_selection" class="form-control">
											<option value="<?= (isset($DataPermohonan->jns_bangunan));?>"><?= (isset($DataPermohonan->jns_bangunan)?$DataPermohonan->jns_bangunan:'--Pilih--'); ?></option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Nama Bangunan<span class="required">* </span></label>
									<div class="col-md-7">
										<input type="text" class="form-control" value="<?php echo set_value('nama_bangunan', (isset($DataPermohonan->nama_bangunan) ? $DataPermohonan->nama_bangunan : ''))?>" name="nama_bangunan" placeholder="Jenis/Nama Usaha" autocomplete="off">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Luas Bangunan<span class="required">* </span></label>
									<div class="col-md-7">
										<div class="checkbox-list">
											<input type="text" class="form-control" value="<?php echo set_value('luas_bg', (isset($DataPermohonan->luas_bg) ? $DataPermohonan->luas_bg : ''))?>" name="luas_bg" onblur="cek()" placeholder="Luas Bangunan Dalam Meter Persegi" autocomplete="off"> 
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Tinggi Bangunan<span class="required">* </span></label>
									<div class="col-md-3">
										<div class="checkbox-list">
											<input type="text" class="form-control" value="<?php echo set_value('tinggi_bg', (isset($DataPermohonan->tinggi_bg) ? $DataPermohonan->tinggi_bg : ''))?>" name="tinggi_bg" onblur="cek()" placeholder="Tinggi Bangunan" autocomplete="off">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Jumlah Lantai Bangunan<span class="required">* </span></label>
									<div class="col-md-3">
										<div class="checkbox-list">
											<input type="text" class="form-control" value="<?php echo set_value('lantai_bg', (isset($DataPermohonan->lantai_bg) ? $DataPermohonan->lantai_bg : ''))?>" name="lantai_bg" onblur="cek()" placeholder="Jumlah Lantai Bangunan Gedung" autocomplete="off">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Luas Basement Bangunan</label>
									<div class="col-md-7">
										<div class="checkbox-list">
											<input type="text" class="form-control" value="<?php echo set_value('luas_basement', (isset($DataPermohonan->luas_basement) ? $DataPermohonan->luas_basement : ''))?>" name="luas_basement" placeholder="Luas Basement Bangunan" autocomplete="off">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Jumlah  Lantai Basement Bangunan</label>
									<div class="col-md-7">
										<div class="checkbox-list">
											<input type="text" class="form-control" value="<?php echo set_value('lapis_basement', (isset($DataPermohonan->lapis_basement) ? $DataPermohonan->lapis_basement : ''))?>" name="lapis_basement" placeholder="Jumlah Lantai Basement Bangunan" autocomplete="off">
										</div>
									</div>
								</div>
								
								<div id="dokumen_teknis" style="display: block;">
									<div class="form-group">
										<label class="control-label col-md-3">Dokumen Teknis<span class="required">* </span></label>
										<div class="col-md-7">
											<div class="radio-list" >
												<?php
													if (isset($DataPermohonan->id_dok_tek)!=''){
														$id_dok_tek = $DataPermohonan->id_dok_tek;
													}else{
														$id_dok_tek = isset($DataPermohonan->id_dok_tek);
													}
												?>
												<label><input type="radio" name="id_dok_tek" value="1" <?php if ($DataPermohonan->id_dok_tek=='1') echo "checked";?>>Perencana Konstruksi</label>
												<label><input type="radio" name="id_dok_tek" value="2" <?php if ($DataPermohonan->id_dok_tek=='2') echo "checked";?>>Desain Prototipe</label>
												<label><input type="radio" name="id_dok_tek" value="3" <?php if ($DataPermohonan->id_dok_tek=='3') echo "checked";?>>Pengembangan Desain Prototipe</label>
											</div>
										</div>
									</div>
								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn green">Selanjutnya</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	function getkabkota(v) {
		$("#nama_kabkota_toggle").fadeIn()
		jQuery.post(base_url + 'pengajuan/getDataKabKota/' + v, function(data) {
			var nama_kabkota = '<option value="">-- Pilih Kabupaten / Kota --</option>';
			jQuery.each(data, function(key, value) {
				nama_kabkota += '<option value="' + value.id_kabkot + '"> ' + value.nama_kabkota + ' </option>';
			});

			jQuery('#nama_kabkota').html(nama_kabkota);
			$('#nama_kabkota').prop("disabled", false);
		}, 'json');
	}

	function getkecamatan(v) {
		$("#nama_kecamatan_toggle").fadeIn()
		jQuery.post(base_url + 'pengajuan/getDataKecamatan/' + v, function(data) {
			var nama_kecamatan = '<option value="">-- Pilih Kecamatan --</option>';
			jQuery.each(data, function(key, value) {
				nama_kecamatan += '<option value="' + value.id_kecamatan + '"> ' + value.nama_kecamatan + ' </option>';
			});
			jQuery('#nama_kecamatan').html(nama_kecamatan);
			$('#nama_kecamatan').prop("disabled", false);
		}, 'json');
	}
	
	function getkabkota_bg(v) {
		$("#nama_kabkota_toggle").fadeIn()
		jQuery.post(base_url + 'pengajuan/getDataKabKota/' + v, function(data) {
			var nama_kabkota_bg = '<option value="">-- Pilih Kabupaten / Kota --</option>';
			jQuery.each(data, function(key, value) {
				nama_kabkota_bg += '<option value="' + value.id_kabkot + '"> ' + value.nama_kabkota + ' </option>';
			});

			jQuery('#nama_kabkota_bg').html(nama_kabkota_bg);
			$('#nama_kabkota_bg').prop("disabled", false);
		}, 'json');
	}

	function getkecamatan_bg(v) {
		$("#nama_kecamatan_toggle").fadeIn()
		jQuery.post(base_url + 'pengajuan/getDataKecamatan/' + v, function(data) {
			var nama_kecamatan_bg = '<option value="">-- Pilih Kecamatan --</option>';
			jQuery.each(data, function(key, value) {
				nama_kecamatan_bg += '<option value="' + value.id_kecamatan + '"> ' + value.nama_kecamatan + ' </option>';
			});
			jQuery('#nama_kecamatan_bg').html(nama_kecamatan_bg);
			$('#nama_kecamatan_bg').prop("disabled", false);
		}, 'json');
	}

</script>
	
