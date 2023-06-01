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
<script type="text/javascript">

function set_pemanfaatan(v){
	if(v == '1'){
		document.getElementById('dokumen_teknis').style.display="block";
	}else{
		document.getElementById('dokumen_teknis').style.display="none";
		document.getElementById("id_dok_tek").value = "1";	
	}
}

function set_tek(v){
	if(v == '2'){
		document.getElementById("id_dok_tek").value = "2";
		
	}else if(v == '3'){
		document.getElementById("id_dok_tek").value = "3";
	}else{
		document.getElementById("id_dok_tek").value = "1";	
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


function getjenisPermohonan(v){
	if(v == '5'){
		document.getElementById('NonPrasarana').style.display="none";
		document.getElementById('prasarana').style.display="block";
		document.getElementById('Kolektif').style.display="none";
		document.getElementById('KolektifPecah').style.display="none";
		document.getElementById('KolektifInduk').style.display="none";
		document.getElementById('dokumen_teknis').style.display="none";
		document.getElementById("id_dok_tek").value = "1";	
	}else if(v =='4'){
		document.getElementById('Kolektif').style.display="block";
		document.getElementById('NonPrasarana').style.display="none";
		document.getElementById('prasarana').style.display="none";
		document.getElementById('dokumen_teknis').style.display="none";
		document.getElementById("id_dok_tek").value = "1";	
	}else if(v ==''){
		document.getElementById('Kolektif').style.display="none";
		document.getElementById('NonPrasarana').style.display="none";
		document.getElementById('prasarana').style.display="none";
		document.getElementById('KolektifInduk').style.display="none";
		document.getElementById('KolektifPecah').style.display="none";
		
	}else if(v =='6'){
		document.getElementById('Kolektif').style.display="none";
		document.getElementById('NonPrasarana').style.display="none";
		document.getElementById('prasarana').style.display="none";
		document.getElementById('KolektifInduk').style.display="none";
		document.getElementById('KolektifPecah').style.display="none";
		document.getElementById('dokumen_teknis').style.display="none";
		document.getElementById("id_dok_tek").value = "1";	
		
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
		document.getElementById('Kolektif').style.display="block";
		document.getElementById('KolektifInduk').style.display="none";
		document.getElementById('KolektifPecah').style.display="none";
		document.getElementById('NonPrasarana').style.display="none";
		document.getElementById('prasarana').style.display="none";
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
<div class="page-container">
	<div class="page-content">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="portlet light">
						<div class="portlet-body form">
							<form action="<?php echo site_url('pengajuan/saveDataIMB'); ?>" class="form-horizontal" role="form" method="POST" id="form_permohonan">
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
												<div class="form-group">
													<label class="control-label col-md-3">Memiliki NIB ?<span class="required">*</span></label>
													<div class="col-md-7">
														<select class="form-control select2me" name="id_fungsi" onchange="getNib(this.value)">
															<option value="">--Pilih--</option>
															<option value="1">Memiliki NIB</option>
															<option value="2">Tidak Memiliki NIB</option>
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
													<label class="control-label col-md-3"></label>
													<div class="col-md-8">
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
												<div class="form-group">
													<label class="control-label col-md-3">Bentuk Kepemilikan <span class="required">
													* </span></label>
													<div class="col-md-7">
														<select class="form-control select2me" name="id_jenis_usaha">
															<option value="">--Pilih--</option>
															<option value="1">Perseorangan</option>
															<option value="2">Badan Usaha/Hukum</option>
															<option value="3">Pemerintah</option>
														</select>
													</div>
												</div>
												
												<div id="Pemilik" >
													<div class="form-group">
														<label class="control-label col-md-3">Nama Pemilik / Perusahaan<span class="required">* </span></label>
														<div class="col-md-7">
															<div class="input-icon right"><i class="fa"></i>
																<input type="text" class="form-control" name="nama_pemilik" placeholder="Nama Pemilik / Perusahaan"/>
																<input type="text" class="form-control" name="id_permohonan"  id="id_permohonan" style="display:none"/>
															</div>
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
																		if ($key->id_provinsi == $profile_user->id_provinsi) {
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
													isset($profile_user->id_kabkota) ? $toggle = "" : $toggle = "display:block";
													// $toggle = "";
													?>

													<div class="form-group" id="nama_kabkota_toggle" style="<?= $toggle; ?>">
														<label class="col-md-3 control-label">Kab/Kota</label>
														<div class="col-md-7">
															<select name="nama_kabkota" id="nama_kabkota" class="form-control select2me" data-placeholder="Select..." onchange="getkecamatan(this.value)">
																<option value="">-- Pilih Kabupaten / Kota --</option>
																<?php
																if (isset($daftar_kabkota)) {
																	if ($daftar_kabkota->num_rows() > 0) {
																		foreach ($daftar_kabkota->result() as $key) {
																			if ($key->id_kabkot == $profile_user->id_kabkota) {
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
													isset($profile_user->id_kabkota) ? $toggle = "" : $toggle = "display:block";
													// $toggle = "";
													?>
													<div class="form-group" id="nama_kecamatan_toggle" style="<?= $toggle; ?>">
														<label class="col-md-3 control-label">Kecamatan</label>
														<div class="col-md-7">
															<select name="nama_kecamatan" id="nama_kecamatan" class="form-control select2me" data-placeholder="Select...">
																<option value="">-- Pilih Kecamatan --</option>
																<?php
																if (isset($daftar_kabkota)) {
																	if ($daftar_kecamatan->num_rows() > 0) {
																		foreach ($daftar_kecamatan->result() as $key) {
																			if ($key->id_kecamatan == $profile_user->id_kecamatan) {
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
															<textarea type="text" name="alamat_pemohon" class="form-control" placeholder="Alamat Pemilik / Perusahaan"></textarea>
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label">Nomor Telp / HP <span class="required">* </span></label>
														<div class="col-md-7">
															<div class="input-group">
																<span class="input-group-addon"><i class="fa fa-mobile"></i></span>
																<input type="no_tlp" name="no_tlp" class="form-control" placeholder="Masukan Nomor Aktif" value="<?php echo set_value('no_tlp', (isset($profile_user->no_hp) ? $profile_user->no_hp : ''))?>">
															</div>
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label">Alamat Email <span class="required">* </span></label>
														<div class="col-md-7">
															<div class="input-group">
																<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
																<input type="email" name="email" value="<?php echo set_value('email', (isset($profile_user->email) ? $profile_user->email : ''))?>" class="form-control" placeholder="layanan@simbg.com">
															</div>
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label">Nomor Identitas <span class="required">* </span></label>
														<div class="col-md-7">
															<div class="input-group">
																<span class="input-group-addon"><i class="fa fa-circle"></i></span>
																<input type="number" name="no_ktp" value="<?php echo set_value('no_ktp', (isset($profile_user->no_ktp) ? $profile_user->no_ktp : ''))?>" class="form-control" placeholder="Nomor KTP/SIM/Passport/NPWP">
															</div>
														</div>
													</div>
												</div>
												<hr>
												<h4 class="caption-subject font-red bold uppercase" align="center">Lokasi Bangunan Gedung</h4><hr>
												<div class="form-group">
														<label class="col-md-3 control-label">Provinsi</label>
														<div class="col-md-7">
															<select name="nama_provinsi_bg" id="nama_provinsi_bg" class="form-control select2me" data-placeholder="Select..." onchange="getkabkota_bg(this.value)">
																<option value="">-- Pilih Provinsi --</option>
																<?php
																if ($daftar_provinsi->num_rows() > 0) {
																	foreach ($daftar_provinsi->result() as $key) {
																		if ($key->id_provinsi == $profile_user->id_provinsi) {
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
													isset($profile_user->id_kabkota) ? $toggle = "" : $toggle = "display:block";
													// $toggle = "";
													?>

													<div class="form-group" id="nama_kabkota_toggle" style="<?= $toggle; ?>">
														<label class="col-md-3 control-label">Kab/Kota</label>
														<div class="col-md-7">
															<select name="nama_kabkota_bg" id="nama_kabkota_bg" class="form-control select2me" data-placeholder="Select..." onchange="getkecamatan_bg(this.value)">
																<option value="">-- Pilih Kabupaten / Kota --</option>
																<?php
																if (isset($daftar_kabkota)) {
																	if ($daftar_kabkota->num_rows() > 0) {
																		foreach ($daftar_kabkota->result() as $key) {
																			if ($key->id_kabkot == $profile_user->id_kabkota) {
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
													isset($profile_user->id_kabkota) ? $toggle = "" : $toggle = "display:block";
													// $toggle = "";
													?>
													<div class="form-group" id="nama_kecamatan_toggle" style="<?= $toggle; ?>">
														<label class="col-md-3 control-label">Kecamatan</label>
														<div class="col-md-7">
															<select name="nama_kecamatan_bg" id="nama_kecamatan_bg" class="form-control select2me" data-placeholder="Select...">
																<option value="">-- Pilih Kecamatan --</option>
																<?php
																if (isset($daftar_kabkota)) {
																	if ($daftar_kecamatan->num_rows() > 0) {
																		foreach ($daftar_kecamatan->result() as $key) {
																			if ($key->id_kecamatan == $profile_user->id_kecamatan) {
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
														<textarea type="text" class="form-control" name="alamat_bg" placeholder="Alamat Bangunan" autocomplete="off"></textarea>
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
															<input type="text" class="form-control"  name="nama_bangunan" placeholder="Nama Bangunan" autocomplete="off">
														</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Permohonan IMB<span class="required">
													* </span>
													</label>
													<div class="col-md-7">
														<select class="form-control" name="id_jenis_bg" id="id_jenis_bg" onchange="getjenisPermohonan(this.value)">
															<option value="">--Pilih--</option>
															<option value="1">Mendirikan Bangunan Gedung Baru</option>
															<option value="2">Bangunan Gedung Existing Belum Ber-IMB</option>
															<option value="3">Bangunan Gedung Perubahan</option>
															<option value="4">Bangunan Gedung Kolektif</option>
															<option value="5">Bangunan Gedung Prasarana</option>
															<option value="6">Bangunan Gudang 1300 Meter Persegi</option>
														</select>
													</div>
												</div>
												
												<div id="Kolektif" style="display: none;">
													<div class="form-group">
														<label class="control-label col-md-3">Tipe Permohonan Kolektif<span class="required">
															* </span></label>
															<div class="col-md-7">
																<select class="form-control select2me" name="id_kolektif" onchange="tpk(this.value)">
																	<option value="">--Pilih--</option>
																	<option value="1">Induk</option>
																	<option value="2">Tunggal/Pemisahan</option>
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
																<input type="number" class="form-control" name="tipeA" placeholder="36/45/102/..." autocomplete="off">
															</div>
															<div class="col-md-3">
																<input type="number" class="form-control" name="tipeB" placeholder="36/45/102/..." autocomplete="off">
															</div>
															<div class="col-md-3">
																<input type="number" class="form-control" name="tipeC" placeholder="36/45/102/..." autocomplete="off">
															</div>
															<div class="col-md-3">
																<input type="number" class="form-control" name="tipeD" placeholder="36/45/102/..." autocomplete="off">
															</div>
														</div>	
													</div>
													<div class="form-group">
														<label class="control-label col-md-3">Jumlah Unit<span class="required">* </span></label>
														<div class="col-md-7">
															<div class="col-md-3">
																<input type="number" class="form-control" name="unitA" placeholder="123" autocomplete="off">
															</div>
															<div class="col-md-3">
																<input type="number" class="form-control" name="unitB" placeholder="123" autocomplete="off">
															</div>
															<div class="col-md-3">
																<input type="number" class="form-control" name="unitC" placeholder="123" autocomplete="off">
															</div>
															<div class="col-md-3">
																<input type="number" class="form-control" name="unitD" placeholder="123" autocomplete="off">
															</div>
														
														</div>
													</div>
													<div class="form-group" style="display: none;">
														<label class="control-label col-md-3">Luas Bangunan <i>(m<sup>2</sup>)</i><span class="required">* </span></label>
														<div class="col-md-7">
															<div class="col-md-3">
																<input type="number" class="form-control" name="luasA" placeholder="123.45" autocomplete="off">
															</div>
															<div class="col-md-3">
																<input type="number" class="form-control" name="luasB" placeholder="123.45" autocomplete="off">
															</div>
															<div class="col-md-3">
																<input type="number" class="form-control" name="luasC" placeholder="123.45" autocomplete="off">
															</div>
															<div class="col-md-3">
																<input type="number" class="form-control" name="luasD" placeholder="123.45" autocomplete="off">
															</div>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-3">Tinggi Bangunan <i>(m)</i><span class="required">* </span></label>
													  <div class="col-md-7">
														<div class="col-md-3">
																<input type="number" class="form-control" name="tinggiA" placeholder="6.9" autocomplete="off">
														</div>
														<div class="col-md-3">
																<input type="number" class="form-control" name="tinggiB" placeholder="6.9" autocomplete="off">
														</div>
														<div class="col-md-3">
																<input type="number" class="form-control" name="tinggiC" placeholder="6.9" autocomplete="off">
														</div>
														<div class="col-md-3">
																<input type="number" class="form-control" name="tinggiD" placeholder="6.9" autocomplete="off">
														</div>
													  </div>
													</div>
												</div>
												<div id="KolektifPecah" style="display: none;">
													<div class="form-group">
														<label class="control-label col-md-3">Nomor SK IMB Kolektif<span class="required">* </span></label>
														<div class="col-md-7">
																<input type="text" class="form-control" name="sk_imbkol" placeholder="SK-IMB-123456-78902019-01" />
														</div>
													</div>
												</div>
												<div id="NonPrasarana" style="display: none;">
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
													<div class="form-group">
														<label class="control-label col-md-3">Jenis Bangunan <span class="required">* </span></label>
														<div class="col-md-7">
															<select name="jns_bangunan" id="child_selection" class="form-control">
																<option ></option>
															</select>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-3">Luas Bangunan <i>(m<sup>2</sup>)</i><span class="required">* </span></label>
														<div class="col-md-3">
															<div class="checkbox-list">
																<input type="number" class="form-control" name="luas_bgn" id="luas_bgn" placeholder="123.45" autocomplete="off">
															</div>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-3">Tinggi Bangunan <i>(m)</i><span class="required">* </span></label>
														<div class="col-md-3">
															<div class="checkbox-list">
																<input type="number" class="form-control" name="tinggi_bgn" placeholder="6.9" autocomplete="off">
															</div>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-3">Jumlah Lantai Bangunan<span class="required">* </span></label>
														<div class="col-md-3">
															<div class="checkbox-list">
																<input type="number" class="form-control" name="lantai_bg" placeholder="0 - 9" autocomplete="off">
															</div>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-3">Luas Basement Bangunan <i>(m<sup>2</sup>)</i></label>
														<div class="col-md-7">
															<div class="checkbox-list">
																<input type="number" class="form-control" name="luas_basement" placeholder="123.45" autocomplete="off">
															</div>
														</div>
													</div>
													
													<div class="form-group">
														<label class="control-label col-md-3">Jumlah  Lantai Basement Bangunan</label>
														<div class="col-md-7">
															<div class="checkbox-list">
																<input type="number" class="form-control" name="lapis_basement" placeholder="0 - 9" autocomplete="off">
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
														<label class="control-label col-md-3">Luas Bangunan Prasarana<i>(m<sup>2</sup>)</i><span class="required">* </span></label>
														<div class="col-md-3">
															<div class="checkbox-list">
																	<input type="number" class="form-control" name="luas_prasarana" placeholder="123.45" autocomplete="off">
															</div>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-3">Tinggi Bangunan Prasarana <i>(m)</i><span class="required">* </span></label>
														<div class="col-md-3">
															<div class="checkbox-list">
																	<input type="number" class="form-control" name="tinggi_prasarana" placeholder="5.78" autocomplete="off">
															</div>
														</div>
													</div>
												</div>
												<!-- End Untuk Prasarana-->
												<div id="dokumen_teknis" style="display: none;">
													<div class="form-group">
														<label class="control-label col-md-3">Dokumen Teknis<span class="required">* </span></label>
														<div class="col-md-7">
															<div class="radio-list" class="form-control" >
																<label><input type="radio" name="id_dok_tek1" value="1" onclick="set_tek(this.value)"/>Perencana Konstruksi</label>
																<label><input type="radio" name="id_dok_tek1" value="2" onclick="set_tek(this.value)"/>Desain Prototipe</label>
																<label><input type="radio" name="id_dok_tek1" value="3" onclick="set_tek(this.value)"/>Pengembangan Desain Prototipe</label>
															</div>
														</div>
													</div>
												</div>
												<input type="text" name="id_dok_tek" id="id_dok_tek" value="1" style="display: none;"/>
											</div>
										</div>
									</div>
									<div class="form-actions">
										<center><div class="row">
											<div class="col-md-12">
												<button type="submit" class="btn green">Simpan</button>
												<button type="button" class="btn red" onClick="window.location.href = '<?php echo base_url();?>pengajuan';return false;">Batal</button>
											</div>
										</center></div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- END PAGE CONTENT INNER -->
		</div>
	</div>
</div>
	<!-- END PAGE CONTENT -->
	
	
	
	
	
	
<div id="modal-edit" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog" data-focus-on="input:first">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		
		<table class="tbl2" id="tabelbiasa" border="0" cellpadding="2" cellspacing="1">
			<tbody>
			<tr>
				<th width="3%">#</th>
				<th width="30%">Nama Permohonan</th> 
				<th width="60%">Keterangan</th>
			</tr>
			<tr class="event">
				<td></td>
				<td class="clleft">Mendirikan Bangunan Gedung Baru</td>
				<td class="clleft">Permohonan IMB terhadap bangunan gedung yang belum terbangun</td>
			</tr>
			<tr class="event2">
				<td></td>
				<td class="clleft">Bangunan Gedung Existing Belum Ber-IMB</td>
				<td class="clleft">Permohonan IMB terhadap bangunan gedung yang sudah terbangun</td>
			</tr>
			<tr class="event">
				<td></td>
				<td class="clleft">Bangunan Gedung Perubahan</td>
				<td class="clleft">IMB yang dimohonkan dalam rangka memperluas dan/atau memperbaharui bangunan gedung</td>
			</tr>
			<tr class="event2">
				<td></td>
				<td class="clleft">Bangunan Gedung Kolektif</td>
				<td class="clleft">IMB yang dimohonkan untuk sejumlah bangunan gedung menjadi satu kesatuan</td>
			</tr>
			<tr class="event">
				<td></td>
				<td class="clleft">Bangunan Gedung Prasarana</td>
				<td class="clleft">IMB yang dimohonkan untuk bangunan prasarana</td>
			</tr>
			<tr class="event2">
				<td></td>
				<td class="clleft">Bangunan Gedung IMB Bertahap</td>
				<td class="clleft">IMB yang dimohonkan pada tahap pembangunan bangunan gedung</td>
			</tr>
			</tbody>
		</table>
        </div>
        <!-- /.modal-content -->
	</div>
</div>

<script>
$(function () {    
	 // Setup form validation on the #register-form element
	$("#form_permohonan").validate({
	    // Specify the validation rules
	    rules: {
			id_fungsi : "required",
			id_akun : "required",
	        nama_pemilik: {
				required: true},
			alamat_pemohon: "required",
			id_jenis_usaha: "required",
			id_kolektif: "required",
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
			//no_ktp : "required",
			no_ktp : {
                    minlength: 2,
                    required: true
                }, 
			id_dok_tek1 :{
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
			id_fungsi: "Pilih Memiliki NIB Atau Tidak",
			id_akun : "Silahkan Memilih",
	        nama_pemilik: "Masukkan Nama Pemilik",
			alamat_pemohon: "Masukkan Alamat Pemilik",
			no_ktp : "Masukkan Nomor KTP Pemilik",
			id_jenis_usaha: "Pilih Jenis Kepemilikan",
			id_jenis_bg: "Pilih Jenis Permohonan IMB",
			id_fungsi_bg: "Pilih Fungsi Bangunan",
			jns_bangunan: "Pilih Jenis Bangunan",
			
			nama_provinsi: "Pilih Provinsi Alamat Pemilik",
			nama_kabkota: "Pilih Kabupaten/Kota Alamat Pemilik",
			nama_kecamatan : "Pilih Kecamatan Alamat Pemilik",
			id_kolektif: "Pilih Tipe Kolektif",
			alamat_bg : "Masukkan Alamat Bangunan Gedung",
			nama_provinsi_bg: "Pilih Provinsi Alamat Bangunan Gedung",
			nama_kabkota_bg: "Pilih Kabupaten/Kota Alamat Bangunan Gedung",
			nama_kecamatan_bg: "Pilih Kecamatan Alamat Bangunan Gedung",
			id_dok_tek1	: "Pilih Jenis Dokumen Teknis",
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
	}
	
</script>