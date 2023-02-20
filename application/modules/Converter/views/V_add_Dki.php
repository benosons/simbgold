<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />
<div class="portlet light margin-top-20">
	<div class="portlet-title tabbable-line">
		<div class="caption caption-md">
			<i class="icon-globe theme-font hide"></i><span class="caption-subject font-blue-madison bold uppercase">Form Pengajuan</span>
		</div>
		<div class="actions">
			<a href="<?php echo site_url('Converter'); ?>" type="button" id="btnplus2" class="btn btn-danger">Batal <i class="fa fa-times"></i></a>
		</div>
	</div>
	<div class="portlet-body">
		<?php echo form_open_multipart('Converter/saveDataIMB', [
			'class' => 'form-horizontal',
			'role' => 'form',
			'id' => 'form_pengajuan'
		]) ?>
		<div class="form-body">
			<h4><b>Data Pemilik</b></h4>
			<div class="row">
				<br>
				<div class="col-md-6">
					<div class="form-group form-md-line-input has-success">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-circle"></i></span>
							<input class="form-control" id="no_imb" name="no_imb" type="text" placeholder="SK IMB 0-9 / A-Z" autocomplete="off">
							<input style="display:none;" class="form-control" type="text" name="id_convert" autocomplete="off">
							<label for="form_control_1">Nomor IMB / PBG<span class="required" aria-required="true"> *
							</span></label>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group form-md-line-input has-success">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-circle"></i>
							</span>
							<input class="form-control datepicker" type="text" name="terbit_imb" data-date-format="yyyy-mm-dd" autocomplete="off" placeholder="2021-08-02" onkeydown="return false">
							<label for="form_control_1">Tgl. Penerbitan <span class="required" aria-required="true"> *</span></label>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group form-md-line-input has-success">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-circle"></i></span>
							<input class="form-control" id="nama_pemilik" name="nama_pemilik" type="text" placeholder="Nama Sesuai KTP" autocomplete="off">
							<label for="form_control_1">Nama Pemilik IMB/PBG<span class="required" aria-required="true"> *</span></label>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group form-md-line-input has-success">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-circle"></i></span>
							<input class="form-control ktp" id="ktp_pemilik" name="ktp_pemilik" type="text" placeholder="Nomor KTP" autocomplete="off">
							<label for="form_control_1">No. KTP Pemilik IMB/PBG<span class="required" aria-required="true">* </span></label>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group form-md-line-input has-success">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-circle"></i></span>
							<input class="form-control" id="alamat_pemilik" name="alamat_pemilik" type="text" placeholder="Alamat Sesuai KTP" autocomplete="off">
							<label for="form_control_1">Alamat Pemilik IMB/PBG<span class="required" aria-required="true"> *</span></label>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group form-md-line-input has-success">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-circle"></i></span>
							<input class="form-control" id="nama_kadis" name="nama_kadis" type="text" placeholder="Nama Kepala Dinas" autocomplete="off" value="<?= (isset($profile_dinas->kepala_dinas) ? $profile_dinas->kepala_dinas : ''); ?>">
							<label for="form_control_1">Nama Kepala Dinas<span class="required" aria-required="true"> *</span></label>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group form-md-line-input has-success">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-circle"></i></span>
							<input class="form-control nip" id="nip_kadis" name="nip_kadis" type="text" placeholder="NIP Kepala Dinas" autocomplete="off" value="<?= (isset($profile_dinas->nip_kepala_dinas) ? $profile_dinas->nip_kepala_dinas : ''); ?>">
							<label for="form_control_1">NIP Kepala Dinas<span class="required" aria-required="true">* </span></label>
						</div>
					</div>
				</div>
			</div>
			<h4><b>Data Bangunan</b></h4>
			<div class="row">
				<br>
				<div class="col-md-6">
					<div class="form-group form-md-line-input has-success">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-circle"></i>
							</span>
							<select name="fungsi_bgn" class="form-control">
								<option value="">Pilih</option>
								<option value="Fungsi Hunian">Fungsi Hunian</option>
								<option value="Fungsi Keagamaan">Fungsi Keagamaan</option>
								<option value="Fungsi Usaha">Fungsi Usaha</option>
								<option value="Fungsi Sosial dan Budaya">Fungsi Sosial dan Budaya</option>
								<option value="Fungsi Khusus">Fungsi Khusus</option>
								<option value="Fungsi Campuran">Fungsi Campuran</option>
							</select>
							<label for="form_control_1">Fungsi Bangunan <span class="required" aria-required="true"> *</span></label>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group form-md-line-input has-success">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-circle"></i>
							</span>
							<input class="form-control" id="nama_bgn" name="nama_bgn" type="text" placeholder="Nama Bangunan" autocomplete="off">
							<label for="form_control_1">Nama Bangunan<span class="required" aria-required="true"> * </span></label>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group form-md-line-input has-success">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-circle"></i></span>
							<input class="form-control luas" id="luas_bgn" name="luas_bgn" type="text" placeholder="Luas Bangunan 100.50" autocomplete="off">
							<label for="form_control_1">Luas Bangunan (m<sup>2</sup>) <span class="required" aria-required="true"> *</span></label>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group form-md-line-input has-success">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-circle"></i>
							</span>
							<input class="form-control luas" id="luas_tanah" name="luas_tanah" type="text" placeholder="Luas Tanah 100.50" autocomplete="off">
							<label for="form_control_1">Luas Tanah (m<sup>2</sup>)<span class="required" aria-required="true"> *</span></label>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group form-md-line-input has-success">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-circle"></i></span>
							<select name="id_prov_bgn" id="id_prov_bgn" class="form-control select" onchange="getkabkota(this.value)">
								<option value="<?php echo $id_provinsi; ?>" selected><?php echo $nama_provinsi; ?></option>
							</select>
							<label for="form_control_1">Provinsi <span class="required" aria-required="true"> * </span></label>
						</div>
					</div>
				</div>
                <div class="col-md-6">
					<div class="form-group form-md-line-input has-success">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-circle"></i></span>
							<select name="id_kabkot_bgn" id="id_kabkot_bgn" class="form-control select" onchange="getkecamatan(this.value)">
								<option value="">Pilih</option>
								<?php if (isset($id_provinsi)) {
									if ($daftar_kabkota->num_rows() > 0) {
										foreach ($daftar_kabkota->result() as $key) {
											if ($key->id_kabkot == $id_provinsi) {
												$plhrole = "selected";
											} else {
												$plhrole = "";
											}
											echo '<option value="' . $key->id_kabkot . '" ' . $plhrole . '>' . $key->nama_kabkota . '</option>';
										}
									}
								} ?>
							</select>
							<label for="form_control_1">Kabupaten/Kota <span class="required" aria-required="true"> * </span></label>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group form-md-line-input has-success">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-circle"></i></span>
							<select name="id_kec_bgn" id="id_kec_bgn" class="form-control select" onchange="getkelurahan(this.value)">
								<option value="">Pilih</option>
								<?php if (isset($id_kabkota)) {
									if ($daftar_kecamatan->num_rows() > 0) {
										foreach ($daftar_kecamatan->result() as $key) {
											if ($key->id_kecamatan == $id_kabkota) {
												$plhrole = "selected";
											} else {
												$plhrole = "";
											}
											echo '<option value="' . $key->id_kecamatan . '" ' . $plhrole . '>' . $key->nama_kecamatan . '</option>';
										}
									}
								} ?>
							</select>
							<label for="form_control_1">Kecamatan <span class="required" aria-required="true"> * </span></label>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group form-md-line-input has-success">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-circle"></i></span>
							<select name="id_desa_bgn" id="id_desa_bgn" class="form-control select">
								<option value="">Pilih</option>
							</select>
							<label for="form_control_1">Kelurahan / Desa <span class="required" aria-required="true"> *</span></label>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group form-md-line-input has-success">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-circle"></i></span>
							<input class="form-control" id="alamat_bgn" name="alamat_bgn" type="text" placeholder="Lokasi Bangunan" autocomplete="off">
							<label for="form_control_1">Lokasi Bangunan<span class="required" aria-required="true"> *</span></label>
						</div>
					</div>
				</div>
			</div>
			<h4><b>Lampiran</b></h4>
			<div class="row">
				<br>
				<div class="col-md-12">
					<div class="form-group form-md-line-input has-success">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-circle"></i></span>
							<input class="form-control money" id="retribusi_imb" name="retribusi_imb" type="text" placeholder="Ketik Angka 0 Jika Belum Memiliki Perda Retribusi PBG" autocomplete="off">
							<label for="form_control_1">Total Retribusi (Rp.)<span class="required" aria-required="true"> *</span></label>
						</div>
					</div>
					<div class="form-group form-md-line-input has-success">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-circle"></i>
							</span>
							<input type="file" class="form-control" name="berkas_imb" accept="application/pdf">
						</div>
						<label for="form_control_1">Unggah berkas IMB dalam berbentuk PDF. <span class="required" aria-required="true"> * </span></label>
					</div>
					<div class="form-group form-md-line-input has-success">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-circle"></i>
							</span>
							<input type="file" class="form-control" name="berkas_retribusi" accept="application/pdf">

						</div>
						<label for="form_control_1">Unggah dokumen retribusi berbentuk PDF. <span class="required" aria-required="true"> * </span></label>
					</div>
					<div class="form-group form-md-line-input has-success">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-circle"></i>
							</span>
							<input type="file" class="form-control" name="berkas_tanah" accept="application/pdf">

						</div>
						<label for="form_control_1">Unggah dokumen tanah berbentuk PDF. <span class="required" aria-required="true"> * </span></label>
					</div>
					<div class="form-group form-md-line-input has-success">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-circle"></i>
							</span>
							<input type="file" class="form-control" name="berkas_arsitektur" accept="application/pdf">

						</div>
						<label for="form_control_1">Unggah dokumen Arsitektur (yang telah disetujui dinas) berbentuk PDF. <span class="required" aria-required="true"> * </span></label>
					</div>
					<div class="form-group form-md-line-input has-success">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-circle"></i>
							</span>
							<input type="file" class="form-control" name="berkas_struktur" accept="application/pdf">

						</div>
						<label for="form_control_1">Unggah dokumen Struktur (yang telah disetujui dinas) berbentuk PDF. <span class="required" aria-required="true"> * </span></label>
					</div>
					<div class="form-group form-md-line-input has-success">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-circle"></i>
							</span>
							<input type="file" class="form-control" name="berkas_mep" accept="application/pdf">

						</div>
						<label for="form_control_1">Unggah dokumen MEP (yang telah disetujui dinas) berbentuk PDF. <span class="required" aria-required="true"> * </span></label>
					</div>
				</div>
			</div>

		</div>
		<div class="form-actions">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group form-md-line-input has-danger">
						<label><b>Cek kembali Data dan Dokumen yang telah diisi.</label>
						<label>
							<div class="checker">
								<span class="checked"><input type="checkbox" name="tnc" checked disabled></span>
							</div>
							Dengan ini menyatakan bahwa Data dapat dipertangung jawabkan kebenarannya, dan tidak dapat diubah dikemudian hari.</b>
						</label>
					</div>
					<center>
						<button type="submit" class="btn green" style="width:120px;">Simpan</button>
						<a href="<?php echo site_url('Converter'); ?>" type="button" style="width:120px;" class="btn red">Batal</a>
					</center>
				</div>
			</div>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>
<script>
	$(document).ready(function() {
		var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
		$(".datepicker").datepicker({
			startDate: '2021-08-02',
			//endDate: today,
			endDate: '2021-12-31',
			autoclose: true,
			todayHighlight: false,
		});
		$('.ktp').mask('0000000000000000');
		$('.nip').mask('00000000 000000 0 000');
		$('.money').mask('000.000.000.000.000', {
			reverse: true
		});
		$('.luas').mask('000.000.000.000.00', {
			reverse: true
		});
		$("#form_pengajuan").validate({
			// Specify the validation rules
			rules: {
				nama_pemilik: "required",
				ktp_pemilik: "required",
				alamat_pemilik: "required",
				no_imb: "required",
				terbit_imb: "required",
				nama_kadis: "required",
				nip_kadis: "required",
				fungsi_bgn: "required",
				nama_bgn: "required",
				luas_bgn: "required",
				luas_tanah: "required",
				alamat_bgn: "required",
				id_prov_bgn: "required",
				id_kabkot_bgn: "required",
				id_kec_bgn: "required",
				id_desa_bgn: "required",
				retribusi_imb: "required",
				berkas_imb: "required",
				berkas_retribusi: "required",
				berkas_mep: "required",
				berkas_struktur: "required",
				berkas_arsitektur: "required",
				berkas_tanah: "required",
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
				nama_pemilik: '', //"Masukan Nomor SK",
				ktp_pemilik: '',
				alamat_pemilik: "",
				no_imb: '',
				terbit_imb: '', //"Masukan Tanggal Penerbitan",
				nama_kadis: "",
				nip_kadis: "",
				fungsi_bgn: "",
				nama_bgn: "",
				luas_bgn: "",
				luas_tanah: "",
				alamat_bgn: "",
				id_prov_bgn: "",
				id_kabkot_bgn: "",
				id_kec_bgn: "",
				id_desa_bgn: "",
				retribusi_imb: "",
				berkas_imb: '',
				berkas_retribusi: "",
				berkas_mep: "",
				berkas_struktur: "",
				berkas_arsitektur: "",
				berkas_tanah: "",
			},
			submitHandler: function(form) {
				form.submit();
			}
		});

	});
    function getkecamatan(v) {
		if (v == '') {
			$("#id_kec_bgn").empty();
			var id_desa_bgn = '<option value="">Pilih</option>';
			jQuery('#id_kec_bgn').html(id_kec_bgn);
		} else {
			//$("#nama_kelurahan_toggle").fadeIn()
			jQuery.post(base_url + 'Profile/getDataKecamatan/' + v, function(data) {
				var id_kec_bgn = '<option  value="">Pilih</option>';
				jQuery.each(data, function(key, value) {
					id_kec_bgn += '<option value="' + value.id_kecamatan + '"> ' + value.nama_kecamatan + ' </option>';
				});
				jQuery('#id_kec_bgn').html(id_kec_bgn);
				//$('#nama_kelurahan').prop("disabled", false);
			}, 'json');
		}
	}

	function getkelurahan(v) {
		if (v == '') {
			$("#id_desa_bgn").empty();
			var id_desa_bgn = '<option value="">Pilih</option>';
			jQuery('#id_desa_bgn').html(id_desa_bgn);
		} else {
			//$("#nama_kelurahan_toggle").fadeIn()
			jQuery.post(base_url + 'Profile/getDataKelurahan/' + v, function(data) {
				var id_desa_bgn = '<option  value="">Pilih</option>';
				jQuery.each(data, function(key, value) {
					id_desa_bgn += '<option value="' + value.id_kelurahan + '"> ' + value.nama_kelurahan + ' </option>';
				});
				jQuery('#id_desa_bgn').html(id_desa_bgn);
				//$('#nama_kelurahan').prop("disabled", false);
			}, 'json');
		}
	}
</script>