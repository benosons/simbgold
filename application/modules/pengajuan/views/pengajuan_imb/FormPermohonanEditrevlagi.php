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
	
var campuran = [
	{display: "--Pilih--", value: "" }];

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
		case '6':
		list2(campuran);
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
			case '6':
			list2(campuran);
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
<script type="text/javascript">

$(document).ready(function(){
	
	var gjp = document.getElementById("id_jenis_bg").value;
	var tpknya = document.getElementById("id_kolektif").value;
	var manfaatnya = document.getElementById("id_fungsi_bg").value;
	var dokteknya = "<?=(isset($DataPermohonan->id_dok_tek) ? $DataPermohonan->id_dok_tek : '')?>";
	getjenisPermohonan(gjp);
	tpk(tpknya);
	set_pemanfaatan(manfaatnya);
	set_tek(dokteknya);
	
});

function set_tek(v){
	if(v == '2'){
		//document.getElementById("id_dok_tek").value = "2";
		document.getElementById('nama_idp_toggle').style.display="block";
	}else if(v == '3'){
		//document.getElementById("id_dok_tek").value = "3";
		document.getElementById('nama_idp_toggle').style.display="none";
	}else if(v == '1'){
		//document.getElementById("id_dok_tek").value = "1";
		document.getElementById('nama_idp_toggle').style.display="none";
	}else{
		//document.getElementById("id_dok_tek").value = "1";
		document.getElementById('nama_idp_toggle').style.display="none";		
	}
}

function getNib(v){
	if(v == '1'){
		document.getElementById('Nib').style.display="block";
		document.getElementById('NonNib').style.display="none";
	}else{
		document.getElementById('Nib').style.display="none";
		document.getElementById('NonNib').style.display="block";
	}
}

function set_pemanfaatan(v){
	if(v == '1'){
		document.getElementById('dokumen_teknis').style.display="block";
		document.getElementById('campurin').style.display="block";
		document.getElementById('campurincek').style.display="none";
		document.getElementById('nama_idp_toggle').style.display="none";
	}else if(v == '6'){
		document.getElementById('campurin').style.display="none";
		document.getElementById('campurincek').style.display="block";
		document.getElementById('dokumen_teknis').style.display="none";
		//document.getElementById("id_dok_tek").value = "1";
		document.getElementById('nama_idp_toggle').style.display="none";
	}else{
		document.getElementById('dokumen_teknis').style.display="none";
		document.getElementById('campurin').style.display="block";
		document.getElementById('campurincek').style.display="none";
		//document.getElementById("id_dok_tek").value = "1";
		document.getElementById('nama_idp_toggle').style.display="none";
	}
}

function getjenisPermohonan(v){
	if(v == '5'){
		document.getElementById('NonPrasarana').style.display="none";
		document.getElementById('prasarana').style.display="block";
		document.getElementById('Kolektif').style.display="none";
		document.getElementById('KolektifPecah').style.display="none";
		document.getElementById('KolektifInduk').style.display="none";
		document.getElementById('dokumen_teknis').style.display="none";
		//document.getElementById("id_dok_tek").value = "1";
		document.getElementById('nama_idp_toggle').style.display="none";		
	}else if(v =='4'){
		document.getElementById('Kolektif').style.display="block";
		document.getElementById('NonPrasarana').style.display="none";
		document.getElementById('prasarana').style.display="none";
		document.getElementById('dokumen_teknis').style.display="none";
		//document.getElementById("id_dok_tek").value = "1";	
		document.getElementById('nama_idp_toggle').style.display="none";
	}else if(v ==''){
		document.getElementById('Kolektif').style.display="none";
		document.getElementById('NonPrasarana').style.display="none";
		document.getElementById('prasarana').style.display="none";
		document.getElementById('KolektifInduk').style.display="none";
		document.getElementById('KolektifPecah').style.display="none";
		document.getElementById('nama_idp_toggle').style.display="none";
		
	}else if(v =='6'){
		document.getElementById('Kolektif').style.display="none";
		document.getElementById('NonPrasarana').style.display="none";
		document.getElementById('prasarana').style.display="none";
		document.getElementById('KolektifInduk').style.display="none";
		document.getElementById('KolektifPecah').style.display="none";
		document.getElementById('dokumen_teknis').style.display="none";
		//document.getElementById("id_dok_tek").value = "1";	
		document.getElementById('nama_idp_toggle').style.display="none";
		
	}else{
		document.getElementById('Kolektif').style.display="none";
		document.getElementById('NonPrasarana').style.display="block";
		document.getElementById('prasarana').style.display="none";
		document.getElementById('KolektifInduk').style.display="none";
		document.getElementById('KolektifPecah').style.display="none";
		
	}
}

function tpk(v){
	if(v == '1'){
		document.getElementById('KolektifInduk').style.display="block";
		document.getElementById('KolektifPecah').style.display="none";
		document.getElementById('NonPrasarana').style.display="none";
		document.getElementById('prasarana').style.display="none";
		document.getElementById('dokumen_teknis').style.display="none";
	}else if(v =='2'){
		document.getElementById('KolektifPecah').style.display="block";
		document.getElementById('KolektifInduk').style.display="none";
		document.getElementById('NonPrasarana').style.display="block";
		document.getElementById('prasarana').style.display="none";
	}else{
		//document.getElementById('Kolektif').style.display="block";
		document.getElementById('KolektifInduk').style.display="none";
		document.getElementById('KolektifPecah').style.display="none";
		//document.getElementById('NonPrasarana').style.display="none";
		//document.getElementById('prasarana').style.display="none";
	}
}

function popupNIB() {
	$.ajax({
        type: "POST",
        url:  "<?php echo base_url();?>pengajuan/list_nib_popup",
		data: $('form.form-horizontal').serialize(),
        success: function(response) {
			if(response == ''){
				alert("NIB tidak terdaftar pada sistem OSS, Silahkan isi manual jika telah memiliki NIB, jika belum memiliki NIB silahkan Lakukan Pendaftaran pada sistem OSS");
				document.getElementById('nib_list').style.display="none";
			}else{
				$('#table_IMB tbody').html(response);
				document.getElementById('nib_list').style.display="block";
			}
        },
        error: function(error) {
            alert('NIB tidak terdaftar pada sistem OSS');
        }
    });
}
</script>

			<div class="row">
				<div class="col-md-12">
					<div class="portlet light">
						<div class="portlet-body form">
							<form action="<?php echo site_url('pengajuan/saveDataIMB'); ?>" class="form-horizontal" role="form" method="POST" id="form_permohonan_edit">
								<div class="form-wizard">
									<div class="portlet-body form">
										<div class="tab-content">
											<div class="alert alert-danger display-none">
												<button class="close" data-dismiss="alert"></button>
												You have some form errors. Please check below.
											</div>
											<div class="alert alert-success display-none">
												<button class="close" data-dismiss="alert"></button>
												Your form validation is successful!
											</div>
											<!-- Begin Data Pemilik Bangunan Gedung -->
											<div class="tab-pane active" id="tab1">
												<h4 class="caption-subject font-red bold uppercase" align="center">Data Pemilik Bangunan</h4><hr>
												
												
												<? if(isset($DataPermohonan->kd_izin) && $DataPermohonan->kd_izin != ""){?>
													<div class="form-group">
														<label class="control-label col-md-3">Nomor Induk Berusaha<span class="required">* </span></label>
														<div class="col-md-7">
																<input type="number" class="form-control" name="nib" placeholder="8120001340969" value="<?php echo set_value('nib', (isset($DataPermohonan->nib) ? $DataPermohonan->nib : ''))?>" readonly />
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-3">Kode Izin<span class="required">* </span></label>
														<div class="col-md-7">
																<input type="number" class="form-control" name="nib_detail" placeholder="8120001340969" value="<?php echo set_value('nib_detail', (isset($DataPermohonan->kd_izin) ? $DataPermohonan->kd_izin : ''))?>" readonly />
														</div>
													</div>
					
												<?}else{?>
												<div class="form-group">
													<label class="control-label col-md-3">Memiliki NIB ?<span class="required">*</span></label>
													<div class="col-md-7">
														<select class="form-control select" name="id_fungsi" onchange="getNib(this.value)">
															<option value="">Tidak Memiliki NIB</option>
															<option value="1">Memiliki NIB</option>
															
														</select>
													</div>
												</div>
												<div id="Nib" style="display: none;">
													<div class="form-group">
														<label class="control-label col-md-3">Nomor Induk Berusaha<span class="required">* </span></label>
														<div class="col-md-7">
																<input type="number" class="form-control" name="nib" placeholder="8120001340969" />
														</div>
														<div class="col-md-2">
															<input type='button' onClick="popupNIB()" title="Cari Data NIB" value="Cari" class="btn green" name="btnib" id="btnib"/>
														</div>
													</div>
												</div>
												<div id="nib_list" style="display: none;">
													<div class="form-group">
													<div class="col-md-12">
														<table id="table_IMB" class="table table-striped table-bordered" cellspacing="0" width="100%">
															<thead>
																<tr>
																	<th>NIB</th>
																	<th>Uraian Usaha</th>
																	<th>Alamat Investasi</th>
																	<th>...</th>
																</tr>
															</thead>
															<tbody></tbody>
														</table>
														</div>
													</div>
												</div>
												<?}?>
												
												<div class="form-group">
													<label class="control-label col-md-3">Bentuk Kepemilikan <span class="required">
													* </span></label>
													<div class="col-md-7">
														<select class="form-control select" name="id_jenis_usaha">
															<option value="">--Pilih--</option>
															<option value="1" <?php if($DataPermohonan->id_jenis_usaha == '1') echo "selected";?>>Perseorangan</option>
															<option value="2" <?php if($DataPermohonan->id_jenis_usaha == '2') echo "selected";?>>Badan Usaha/Hukum</option>
															<option value="3" <?php if($DataPermohonan->id_jenis_usaha == '3') echo "selected";?>>Pemerintah</option>
														</select>
													</div>
												</div>
												
												<div class="form-group" style="display: none;">
													<label class="control-label col-md-3">Pemilik Akun Sama dengan Pemilik Bangunan ?<span class="required">
													* </span></label>
													<div class="col-md-7">
														<select class="form-control select" name="id_akun" onchange="getAkun(this.value)">
															<option value="">--Pilih--</option>
															<option value="1">Iya</option>
															<option value="2">Tidak</option>
														</select>
													</div>
												</div>
												<div id="Pemilik" >
													<div class="form-group">
														<label class="control-label col-md-3">Nama Pemilik / Perusahaan<span class="required">* </span></label>
														<div class="col-md-7">
															<div class="input-icon right"><i></i>
																<input type="text" class="form-control" name="nama_pemilik" value="<?php echo set_value('nama_pemilik', (isset($DataPermohonan->nama_pemohon) ? $DataPermohonan->nama_pemohon : ''))?><?php echo set_value('nama_perusahaan', (isset($DataPermohonan->nama_perusahaan) ? $DataPermohonan->nama_perusahaan : ''))?>" placeholder="Nama Pemilik / Perusahaan"/>
																<input type="text" class="form-control" name="id_permohonan"  id="id_permohonan" value="<?php echo $this->uri->segment(3);?>" style="display: none;"/>
																<input type="text" class="form-control" name="no_kolektif"  id="no_kolektif" value="<?php echo set_value('no_kolektif', (isset($DataPermohonan->no_kolektif) ? $DataPermohonan->no_kolektif : ''))?>" style="display: none;"/>
															</div>
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label">Provinsi</label>
														<div class="col-md-7">
															<select name="nama_provinsi" id="nama_provinsi" class="form-control select" data-placeholder="Select..." onchange="getkabkota(this.value)">
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


													<?php
													isset($DataPermohonan->id_kabkot) ? $toggle = "" : $toggle = "display:block";
													// $toggle = "";
													?>

													<div class="form-group" id="nama_kabkota_toggle" style="<?= $toggle; ?>">
														<label class="col-md-3 control-label">Kab/Kota</label>
														<div class="col-md-7">
															<select name="nama_kabkota" id="nama_kabkota" class="form-control select" data-placeholder="Select..." onchange="getkecamatan(this.value)">
																<option value="">-- Pilih Kabupaten / Kota --</option>
																<?php
																if (isset($daftar_kabkota)) {
																	if ($daftar_kabkota->num_rows() > 0) {
																		foreach ($daftar_kabkota->result() as $key) {
																			if ($key->id_kabkot == $DataPermohonan->id_kabkot) {
																				$plhrole = "selected";
																			} else {
																				$plhrole = "";
																			}
																			echo '<option value="' . $key->id_kabkot . '" ' . $plhrole . '>' . $key->nama_kabkota . '</option>';
																		}
																	}
																}
																?>
															</select>
														</div>
													</div>
													<?php
													isset($DataPermohonan->id_kabkot) ? $toggle = "" : $toggle = "display:block";
													// $toggle = "";
													?>
													<div class="form-group" id="nama_kecamatan_toggle" style="<?= $toggle; ?>">
														<label class="col-md-3 control-label">Kecamatan</label>
														<div class="col-md-7">
															<select name="nama_kecamatan" id="nama_kecamatan" class="form-control select" data-placeholder="Select...">
																<option value="">-- Pilih Kecamatan --</option>
																<?php
																if (isset($daftar_kabkota)) {
																	if ($daftar_kecamatan->num_rows() > 0) {
																		foreach ($daftar_kecamatan->result() as $key) {
																			if ($key->id_kecamatan == $DataPermohonan->id_kecamatan) {
																				$plhrole = "selected";
																			} else {
																				$plhrole = "";
																			}
																			echo '<option value="' . $key->id_kecamatan . '" ' . $plhrole . '>' . $key->nama_kecamatan . '</option>';
																		}
																	}
																}
																?>
															</select>
														</div>
													</div>
													
													<div class="form-group">
														<label class="control-label col-md-3">Alamat Pemilik / Perusahaan<span class="required">* </span></label>
														<div class="col-md-7">
															<textarea type="text" name="alamat_pemohon" class="form-control" placeholder="Alamat Pemilik / Perusahaan"><?php echo set_value('alamat_pemohon', (isset($DataPermohonan->alamat_pemohon) ? $DataPermohonan->alamat_pemohon : ''))?><?php echo set_value('alamat_perusahaan', (isset($DataPermohonan->alamat_perusahaan) ? $DataPermohonan->alamat_perusahaan : ''))?></textarea>
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label">Nomor Telp / HP <span class="required">* </span></label>
														<div class="col-md-7">
															<div class="input-group">
																<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
																<input type="no_tlp" name="no_tlp" class="form-control" placeholder="Masukan Nomor Aktif" value="<?php echo set_value('no_tlp', (isset($DataPermohonan->no_tlp) ? $DataPermohonan->no_tlp : ''))?>">
															</div>
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label">Alamat Email <span class="required">* </span></label>
														<div class="col-md-7">
															<div class="input-group">
																<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
																<input type="email" name="email" class="form-control" placeholder="layanan@simbg.com" value="<?php echo set_value('email', (isset($DataPermohonan->email) ? $DataPermohonan->email : ''))?>">
															</div>
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label">Nomor Identitas <span class="required">* </span></label>
														<div class="col-md-7">
															<div class="input-group">
																<span class="input-group-addon"><i class="fa fa-circle"></i></span>
																<input type="number" name="no_ktp" class="form-control" value="<?php echo set_value('no_ktp', (isset($DataPermohonan->no_ktp) ? $DataPermohonan->no_ktp : ''))?>" placeholder="Nomor KTP/SIM/Passport/NPWP">
															</div>
														</div>
													</div>
												</div>
												<hr>
												<h4 class="caption-subject font-red bold uppercase" align="center">Lokasi Bangunan Gedung</h4><hr>
												<div class="form-group">
														<label class="col-md-3 control-label">Provinsi</label>
														<div class="col-md-7">
															<select name="nama_provinsi_bg" id="nama_provinsi_bg" class="form-control select" data-placeholder="Select..." onchange="getkabkota_bg(this.value)">
																<option value="">-- Pilih Provinsi --</option>
																<?php
																if ($daftar_provinsi->num_rows() > 0) {
																	foreach ($daftar_provinsi->result() as $key) {
																		if ($key->id_provinsi == $DataPermohonan->id_provinsi_bg) {
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


													<?php
													isset($DataPermohonan->id_kabkot) ? $toggle = "" : $toggle = "display:block";
													// $toggle = "";
													?>

													<div class="form-group" id="nama_kabkota_toggle" style="<?= $toggle; ?>">
														<label class="col-md-3 control-label">Kab/Kota</label>
														<div class="col-md-7">
															<select name="nama_kabkota_bg" id="nama_kabkota_bg" class="form-control select" data-placeholder="Select..." onchange="getkecamatan_bg(this.value)">
																<option value="">-- Pilih Kabupaten / Kota --</option>
																<?php
																if (isset($daftar_kabkota_bg)) {
																	if ($daftar_kabkota_bg->num_rows() > 0) {
																		foreach ($daftar_kabkota_bg->result() as $key) {
																			if ($key->id_kabkot == $DataPermohonan->id_kabkot_bg) {
																				$plhrole = "selected";
																			} else {
																				$plhrole = "";
																			}
																			echo '<option value="' . $key->id_kabkot . '" ' . $plhrole . '>' . $key->nama_kabkota . '</option>';
																		}
																	}
																}
																?>
															</select>
														</div>
													</div>
													<?php
													isset($DataPermohonan->id_kabkot) ? $toggle = "" : $toggle = "display:block";
													// $toggle = "";
													?>
													<div class="form-group" id="nama_kecamatan_toggle" style="<?= $toggle; ?>">
														<label class="col-md-3 control-label">Kecamatan</label>
														<div class="col-md-7">
															<select name="nama_kecamatan_bg" id="nama_kecamatan_bg" class="form-control select" data-placeholder="Select...">
																<option value="">-- Pilih Kecamatan --</option>
																<?php
																if (isset($daftar_kabkota_bg)) {
																	if ($daftar_kecamatan_bg->num_rows() > 0) {
																		foreach ($daftar_kecamatan_bg->result() as $key) {
																			if ($key->id_kecamatan == $DataPermohonan->id_kec_bg) {
																				$plhrole = "selected";
																			} else {
																				$plhrole = "";
																			}
																			echo '<option value="' . $key->id_kecamatan . '" ' . $plhrole . '>' . $key->nama_kecamatan . '</option>';
																		}
																	}
																}
																?>
															</select>
														</div>
													</div>
												<div class="form-group">
													<label class="control-label col-md-3">Alamat Bangunan Gedung<span class="required">*</span></label>
													<div class="col-md-7">
														<textarea type="text" class="form-control" name="alamat_bg" placeholder="Alamat Bangunan" autocomplete="off"><?php echo set_value('alamat_bg', (isset($DataPermohonan->alamat_bg) ? $DataPermohonan->alamat_bg : ''))?></textarea>
													</div>
												</div>
												<hr>
												<h4 class="caption-subject font-red bold uppercase" align="center">Jenis Bangunan Gedung</h4>
												<hr>
												<div class="form-group">
														<label class="control-label col-md-3">Nama Bangunan<span class="required">
														* </span>
														</label>
														<div class="col-md-7">
															<input type="text" class="form-control" value="<?php echo set_value('nama_bangunan', (isset($DataPermohonan->nama_bangunan) ? $DataPermohonan->nama_bangunan : ''))?>" name="nama_bangunan" placeholder="Nama Bangunan" autocomplete="off">
														</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Permohonan IMB<span class="required">
													* </span>
													</label>
													<div class="col-md-7">
														<select class="form-control select" name="id_jenis_bg" id="id_jenis_bg" onchange="getjenisPermohonan(this.value)">
															<option value="">--Pilih--</option>
															<option value="1" <?php if($DataPermohonan->id_jenis_bg == '1') echo "selected";?>>Mendirikan Bangunan Gedung Baru</option>
															<option value="2" <?php if($DataPermohonan->id_jenis_bg == '2') echo "selected";?>>Bangunan Gedung Existing Belum Ber-IMB</option>
															<option value="3" <?php if($DataPermohonan->id_jenis_bg == '3') echo "selected";?>>Bangunan Gedung Perubahan</option>
															<option value="4" <?php if($DataPermohonan->id_jenis_bg == '4') echo "selected";?>>Bangunan Gedung Kolektif</option>
															<option value="5" <?php if($DataPermohonan->id_jenis_bg == '5') echo "selected";?>>Bangunan Gedung Prasarana</option>
															<option value="6" <?php if($DataPermohonan->id_jenis_bg == '6') echo "selected";?>>Bangunan Gudang 1300 Meter Persegi</option>
														</select>
													</div>
												</div>
												
												<div id="Kolektif" style="display: none;">
													<div class="form-group">
														<label class="control-label col-md-3">Tipe Permohonan Kolektif<span class="required">
															* </span></label>
															<div class="col-md-7">
																<select class="form-control select" name="id_kolektif" id="id_kolektif" onchange="tpk(this.value)">
																	<option value="">--Pilih--</option>
																	<option value="1" <?php if($DataPermohonan->id_kolektif == '1') echo "selected";?>>Induk</option>
																	<option value="2" <?php if($DataPermohonan->id_kolektif == '2') echo "selected";?>>Tunggal/Pemisahan</option>
																</select>
														</div>
													</div>
												</div>
												<div id="KolektifInduk" style="display:none;">
													<div class="form-group">
														<label class="control-label col-md-3">Tipe Bangunan<span class="required">
															* </span></label>
														<div class="col-md-7">
															<div class="col-md-3">
																<input type="number" class="form-control" name="tipeA" placeholder="36/45/102/..." autocomplete="off" value="<?php echo set_value('tipeA', (isset($DataPermohonan->tipeA) ? $DataPermohonan->tipeA : ''))?>">
															</div>
															<div class="col-md-3">
																<input type="number" class="form-control" name="tipeB" placeholder="36/45/102/..." autocomplete="off" value="<?php echo set_value('tipeB', (isset($DataPermohonan->tipeB) ? $DataPermohonan->tipeB : ''))?>">
															</div>
															<div class="col-md-3">
																<input type="number" class="form-control" name="tipeC" placeholder="36/45/102/..." autocomplete="off" value="<?php echo set_value('tipeC', (isset($DataPermohonan->tipeC) ? $DataPermohonan->tipeC : ''))?>">
															</div>
															<div class="col-md-3">
																<input type="number" class="form-control" name="tipeD" placeholder="36/45/102/..." autocomplete="off" value="<?php echo set_value('tipeD', (isset($DataPermohonan->tipeD) ? $DataPermohonan->tipeD : ''))?>">
															</div>
														</div>	
													</div>
													<div class="form-group">
														<label class="control-label col-md-3">Jumlah Unit<span class="required">* </span></label>
														<div class="col-md-7">
															<div class="col-md-3">
																<input type="number" class="form-control" name="unitA" placeholder="123" autocomplete="off" value="<?php echo set_value('unitA', (isset($DataPermohonan->unitA) ? $DataPermohonan->unitA : ''))?>">
															</div>
															<div class="col-md-3">
																<input type="number" class="form-control" name="unitB" placeholder="123" autocomplete="off" value="<?php echo set_value('unitB', (isset($DataPermohonan->unitB) ? $DataPermohonan->unitB : ''))?>">
															</div>
															<div class="col-md-3">
																<input type="number" class="form-control" name="unitC" placeholder="123" autocomplete="off" value="<?php echo set_value('unitC', (isset($DataPermohonan->unitC) ? $DataPermohonan->unitC : ''))?>">
															</div>
															<div class="col-md-3">
																<input type="number" class="form-control" name="unitD" placeholder="123" autocomplete="off" value="<?php echo set_value('unitD', (isset($DataPermohonan->unitD) ? $DataPermohonan->unitD : ''))?>">
															</div>
														
														</div>
													</div>
													<div class="form-group" style="display: none;">
														<label class="control-label col-md-3">Luas Bangunan <i>(m<sup>2</sup>)</i><span class="required">* </span></label>
														<div class="col-md-7">
															<div class="col-md-3">
																<input type="number" class="form-control" name="luasA" placeholder="123.45" autocomplete="off" value="<?php echo set_value('luasA', (isset($DataPermohonan->luasA) ? $DataPermohonan->luasA : ''))?>">
															</div>
															<div class="col-md-3">
																<input type="number" class="form-control" name="luasB" placeholder="123.45" autocomplete="off" value="<?php echo set_value('luasB', (isset($DataPermohonan->luasB) ? $DataPermohonan->luasB : ''))?>">
															</div>
															<div class="col-md-3">
																<input type="number" class="form-control" name="luasC" placeholder="123.45" autocomplete="off" value="<?php echo set_value('luasC', (isset($DataPermohonan->luasC) ? $DataPermohonan->luasC : ''))?>">
															</div>
															<div class="col-md-3">
																<input type="number" class="form-control" name="luasD" placeholder="123.45" autocomplete="off" value="<?php echo set_value('luasD', (isset($DataPermohonan->luasD) ? $DataPermohonan->luasD : ''))?>">
															</div>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-3">Tinggi Bangunan <i>(m)</i><span class="required">* </span></label>
													  <div class="col-md-7">
														<div class="col-md-3">
																<input type="number" class="form-control" name="tinggiA" placeholder="6.9" autocomplete="off" value="<?php echo set_value('tinggiA', (isset($DataPermohonan->tinggiA) ? $DataPermohonan->tinggiA : ''))?>">
														</div>
														<div class="col-md-3">
																<input type="number" class="form-control" name="tinggiB" placeholder="6.9" autocomplete="off" value="<?php echo set_value('tinggiB', (isset($DataPermohonan->tinggiB) ? $DataPermohonan->tinggiB : ''))?>">
														</div>
														<div class="col-md-3">
																<input type="number" class="form-control" name="tinggiC" placeholder="6.9" autocomplete="off" value="<?php echo set_value('tinggiC', (isset($DataPermohonan->tinggiC) ? $DataPermohonan->tinggiC : ''))?>">
														</div>
														<div class="col-md-3">
																<input type="number" class="form-control" name="tinggiD" placeholder="6.9" autocomplete="off" value="<?php echo set_value('tinggiD', (isset($DataPermohonan->tinggiD) ? $DataPermohonan->tinggiD : ''))?>">
														</div>
													  </div>
													</div>
												</div>
												<div id="KolektifPecah" style="display: none;">
													<div class="form-group">
														<label class="control-label col-md-3">Nomor SK IMB Kolektif<span class="required">* </span></label>
														<div class="col-md-7">
																<input type="text" class="form-control" name="sk_imbkol" placeholder="SK-IMB-123456-78902019-01" value="<?php echo set_value('sk_imbkol', (isset($DataPermohonan->sk_imb_kolektif) ? $DataPermohonan->sk_imb_kolektif : ''))?>"/>
														</div>
													</div>
												</div>
												<div id="NonPrasarana" style="display:none;">
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
																	$js = 'id="id_fungsi_bg" onchange="set_pemanfaatan(this.value)" class="form-control parent_selection" ';
																echo form_dropdown('id_fungsi_bg', $list_fungsi, $selected, $js);
															?>
														</div>
													</div>
													<div class="form-group" id="campurin">
														<label class="control-label col-md-3">Jenis Bangunan <span class="required">* </span></label>
														<div class="col-md-7">
															<select name="jns_bangunan" id="child_selection" class="form-control">
																<option><?= (isset($DataPermohonan->jns_bangunan)?$DataPermohonan->jns_bangunan:'--Pilih--'); ?></option>
															</select>
														</div>
													</div>
													
													<div class="form-group" id="campurincek" style="display: none;">
														<label class="control-label col-md-3">Jenis Bangunan <span class="required">*minimal 2</span></label>
														
														<div class="col-md-7 checkbox-inline">
														<?php
																	if (isset($DataPermohonan->jns_bangunan)!=''){
																		$str= $DataPermohonan->jns_bangunan;
																		$campur=(explode(", ",$str));
																		$check=array("Hunian","Keagamaan","Usaha","Sosial & Budaya","Khusus");
																		if (in_array($check[0], $campur)) {
																			$checked1 ="checked";
																		}else{
																			$checked1 ="";
																		}
																		if (in_array($check[1], $campur)) {
																			$checked2 ="checked";
																		}else{
																			$checked2 ="";
																		}
																		if (in_array($check[2], $campur)) {
																			$checked3 ="checked";
																		}else{
																			$checked3 ="";
																		}
																		if (in_array($check[3], $campur)) {
																			$checked4 ="checked";
																		}else{
																			$checked4 ="";
																		}
																		if (in_array($check[4], $campur)) {
																			$checked5 ="checked";
																		}else{
																			$checked5 ="";
																		}
																	}else{
																		
																	}
														?>
														<label>
															<input type="checkbox" class="form-control" name="dcampur[]" id="dcampur" value="Hunian" <?=$checked1;?> > Hunian </label>
														<label>
															<input type="checkbox" class="form-control" name="dcampur[]" id="dcampur" value="Keagamaan" <?=$checked2;?> > Keagamaan </label>
														<label>
															<input type="checkbox" class="form-control" name="dcampur[]" id="dcampur" value="Usaha" <?=$checked3;?> > Usaha </label>
														<label>
															<input type="checkbox" class="form-control" name="dcampur[]" id="dcampur" value="Sosial & Budaya" <?=$checked4;?> > Sosial & Budaya </label>
														<label>
															<input type="checkbox" class="form-control" name="dcampur[]" id="dcampur" value="Khusus" <?=$checked5;?> > Khusus </label>
														</div>
													</div>
													
													<div class="form-group">
														<label class="control-label col-md-3">Luas Bangunan <i>(m<sup>2</sup>)</i><span class="required">* </span></label>
														<div class="col-md-3">
															<div class="checkbox-list">
																<input step="any" type="number" class="form-control" value="<?php echo set_value('luas_bg', (isset($DataPermohonan->luas_bg) ? $DataPermohonan->luas_bg : ''))?>" name="luas_bgn" id="luas_bgn" onblur="cek()" placeholder="123.45" autocomplete="off">
															</div>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-3">Tinggi Bangunan <i>(m)</i><span class="required">* </span></label>
														<div class="col-md-3">
															<div class="checkbox-list">
																<input step="any" type="number" class="form-control" value="<?php echo set_value('tinggi_bgn', (isset($DataPermohonan->tinggi_bg) ? $DataPermohonan->tinggi_bg : ''))?>" name="tinggi_bgn" onblur="cek()" placeholder="6.9" autocomplete="off">
															</div>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-3">Jumlah Lantai Bangunan<span class="required">* </span></label>
														<div class="col-md-3">
															<div class="checkbox-list">
																<input step="any" type="number" class="form-control" value="<?php echo set_value('lantai_bg', (isset($DataPermohonan->lantai_bg) ? $DataPermohonan->lantai_bg : ''))?>" name="lantai_bg" onblur="cek()" placeholder="0 - 9" autocomplete="off">
															</div>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-3">Luas Basement Bangunan <i>(m<sup>2</sup>)</i></label>
														<div class="col-md-7">
															<div class="checkbox-list">
																<input step="any" type="number" class="form-control" value="<?php echo set_value('luas_basement', (isset($DataPermohonan->luas_basement) ? $DataPermohonan->luas_basement : ''))?>" name="luas_basement" placeholder="123.45" autocomplete="off">
															</div>
														</div>
													</div>
													
													<div class="form-group">
														<label class="control-label col-md-3">Jumlah  Lantai Basement Bangunan</label>
														<div class="col-md-7">
															<div class="checkbox-list">
																<input step="any" type="number" class="form-control" value="<?php echo set_value('lapis_basement', (isset($DataPermohonan->lapis_basement) ? $DataPermohonan->lapis_basement : ''))?>" name="lapis_basement" placeholder="0 - 9" autocomplete="off">
															</div>
														</div>
													</div>
												</div>
												<!--Begin Untuk Prasarana -->
												<div id="prasarana" style="display: none;">
													<div class="form-group">
														<label class="control-label col-md-3">Prasarana<span class="required">* </span></label>
														<div class="col-md-7">
															
																<select class="form-control" name="id_prasarana_bg" id="id_prasarana_bg">
																	<option value="">--Pilih--</option>
																	<option value="1" <?php if($DataPermohonan->id_prasarana_bg == '1') echo "selected";?>>Kontruksi Pembatas/Penahan/Pengaman</option>
																	<option value="2" <?php if($DataPermohonan->id_prasarana_bg == '2') echo "selected";?>>Konstruksi Penanda Masuk Lokasi</option>
																	<option value="3" <?php if($DataPermohonan->id_prasarana_bg == '3') echo "selected";?>>Kontruksi Perkerasan</option>
																	<option value="4" <?php if($DataPermohonan->id_prasarana_bg == '4') echo "selected";?>>Kontruksi Penghubung</option>
																	<option value="5" <?php if($DataPermohonan->id_prasarana_bg == '5') echo "selected";?>>Kontruksi Kolam/Reservoir bawah tanah</option>
																	<option value="6" <?php if($DataPermohonan->id_prasarana_bg == '6') echo "selected";?>>Kontruksi Menara</option>
																	<option value="7" <?php if($DataPermohonan->id_prasarana_bg == '7') echo "selected";?>>Kontruksi Monumen</option>
																	<option value="8" <?php if($DataPermohonan->id_prasarana_bg == '8') echo "selected";?>>Kontruksi Instalasi/gardu</option>
																	<option value="8" <?php if($DataPermohonan->id_prasarana_bg == '9') echo "selected";?>>Kontruksi Reklame / Papan Nama</option>
															
															</select>
															
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-3">Luas Bangunan Prasarana<i>(m<sup>2</sup>)</i><span class="required">* </span></label>
														<div class="col-md-3">
															<div class="checkbox-list">
																	<input step="any" type="number" class="form-control" value="<?php echo set_value('luas_prasarana', (isset($DataPermohonan->luas_prasarana) ? $DataPermohonan->luas_prasarana : ''))?>" name="luas_prasarana" placeholder="123.45" autocomplete="off">
															</div>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-3">Tinggi Bangunan Prasarana <i>(m)</i><span class="required">* </span></label>
														<div class="col-md-3">
															<div class="checkbox-list">
																	<input step="any" type="number" class="form-control" value="<?php echo set_value('tinggi_prasarana', (isset($DataPermohonan->tinggi_prasarana) ? $DataPermohonan->tinggi_prasarana : ''))?>" name="tinggi_prasarana" placeholder="5.78" autocomplete="off">
															</div>
														</div>
													</div>
												</div>
												<!-- End Untuk Prasarana-->
												<div id="dokumen_teknis" style="display: none;">
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
																<label><input type="radio" name="id_dok_tek" id="id_dok_tek" onclick="set_tek(this.value)" value="1" <?php if ($id_dok_tek =='1') echo "checked";?>>Perencana Konstruksi</label>
																<label><input type="radio" name="id_dok_tek" id="id_dok_tek" onclick="set_tek(this.value)" value="2" <?php if ($id_dok_tek =='2') echo "checked";?>>Desain Prototipe</label>
																<label><input type="radio" name="id_dok_tek" id="id_dok_tek" onclick="set_tek(this.value)" value="3" <?php if ($id_dok_tek =='3') echo "checked";?>>Pengembangan Desain Prototipe</label>
															</div>
														</div>
													</div>
												</div>
												
												<div class="form-group" id="nama_idp_toggle" style="">
														<label class="col-md-3 control-label">Tipe Prototipe</label>
														<div class="col-md-7">
															<select name="nama_idp" id="nama_idp" class="form-control select" data-placeholder="Select...">
																<option value="">-- Pilih Tipe Prototipe --</option>
																<?php
																if (isset($daftar_kabkota_bg)) {
																	if ($daftar_idp->num_rows() > 0) {
																		foreach ($daftar_idp->result() as $key) {
																			if ($key->idp == $DataPermohonan->idp) {
																				$plhrole = "selected";
																			} else {
																				$plhrole = "";
																			}
																			echo '<option value="' . $key->idp . '" ' . $plhrole . '>' . $key->type_protype . '</option>';
																		}
																	}
																}
																?>
															</select>
														</div>
												</div>
												
												<div style="">
													<div class="form-group">
														
														<div class="col-md-12">
															<input type="submit" value="Simpan Perubahan"class="form-control btn blue">
														</div>
													</div>
												</div>
												<br>
												
											</div>
										</div>
									</div>
									<div class="form-actions">
										<div class="row">
											
												<div class="form-group">
														<center>
														<div class="col-md-6">
															<span class="input-group-btn">
															<button class="btn green" onClick="window.location.href = '<?php echo base_url();?>Pengajuan/';return false;">Kembali</button>
															</span>
															
														</div>
														<div class="col-md-6">
															<span class="input-group-btn">
															<button class="btn green" onClick="window.location.href = '<?php echo base_url();?>Pengajuan/FormDataTanah/<?php echo $this->uri->segment(3);?>';return false;">Selanjutnya</button>
															</span>
														</div>
														</center>
												</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- END PAGE CONTENT INNER -->
		
	<!-- END PAGE CONTENT -->
<script>
$(function () {    
	 // Setup form validation on the #register-form element
	$("#form_permohonan_edit").validate({
	    // Specify the validation rules
	    rules: {
			//id_fungsi : "required",
			id_akun : "required",
			'dcampur[]': {
                    minlength: 2,
					required: true
                },
	        nama_pemilik: {
				required: true},
			alamat_pemohon: "required",
			id_jenis_usaha: "required",
			id_jenis_bg: "required",
			id_fungsi_bg:"required",
			nama_provinsi: "required",
			nama_kabkota: "required",
			alamat_bg : "required",
			nama_kecamatan: "required",
			nama_provinsi_bg : "required",
			nama_kabkota_bg: "required",
			nama_kecamatan_bg: "required",
			jns_bangunan: "required",
			email: {
                    required: true,
                    email: true
                    }, 
			no_tlp : "required",
			no_ktp : {
                    minlength: 2,
                    required: true
                }, 
			id_dok_tek :{
						required: true,
					},
			nama_bangunan : "required",
			luas_bgn : "required",
			tinggi_bgn : "required",
			lantai_bg : "required",
	    },
	        highlight: function(element) {
	            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
	    },
	        unhighlight: function(element) {
	            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
	    },
	      errorClass: 'help-block',
	    
	    // Specify the validation error messages
	    messages: {
			//id_fungsi: "Pilih Memiliki NIB Atau Tidak",
			id_akun : "Silahkan Memilih",
	        nama_pemilik: "Masukkan Nama Pemilik",
			alamat_pemohon: "Masukkan Alamat Pemilik",
			no_ktp : "Masukkan No. KTP Pemilik",
			id_jenis_usaha: "Pilih Jenis Kepemilikan",
			id_jenis_bg: "Pilih Jenis Permohonan IMB",
			id_fungsi_bg: "Pilih Fungsi Bangunan",
			jns_bangunan: "Pilih Jenis Bangunan",
			'dcampur[]' : "",
			nama_provinsi: "Pilih Provinsi Alamat Pemilik",
			nama_kabkota: "Pilih Kabupaten/Kota Alamat Pemilik",
			nama_kecamatan : "Pilih Kecamatan Alamat Pemilik",
			no_tlp : "Masukkan Nomor Telp/HP Aktif",
			alamat_bg : "Masukkan Alamat Bangunan Gedung",
			nama_provinsi_bg: "Pilih Provinsi Alamat Bangunan Gedung",
			nama_kabkota_bg: "Pilih Kabupaten/Kota Alamat Bangunan Gedung",
			nama_kecamatan_bg: "Pilih Kecamatan Alamat Bangunan Gedung",
			id_dok_tek	: "Pilih Jenis Dokumen Teknis",
			email : "Masukkan Alamat E-Mail",
			nama_bangunan : "Masukkan Nama Bangunan",
			luas_bgn : "Masukkan Luas Bangunan",
			tinggi_bgn : "Masukkan Tinggi Bangunan",
			lantai_bg : "Masukkan Lantai Bangunan",
	    },
	    submitHandler: function(form) {
	    	form.submit();
	    }
	});
}); 

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
		jQuery.post(base_url + 'pengajuan/getIDP/' + v, function(data) {
			var nama_idp = '<option value="">-- Pilih Tipe Prototipe --</option>';
			jQuery.each(data, function(key, value) {
				nama_idp += '<option value="' + value.idp + '"> ' + value.type_protype + ' </option>';
			});
			jQuery('#nama_idp').html(nama_idp);
			$('#nama_idp').prop("disabled", false);
		}, 'json');
	}
</script>