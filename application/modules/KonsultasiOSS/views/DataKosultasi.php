<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
			<div class="portlet-body">
				<div class="row">
					<div class="col-md-4">
						<div class="btn-group">
							<a href="#DaftarPeng" role="button" class="btn btn-primary" data-toggle="modal"><i class="fa fa-plus"></i>Tambah Data Permohonan</a>
						</div>
					</div>
					<div class="col-md-8">
						<?php
						echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '<button class="close" data-close="alert">' . '</button>' . '</div>' : '';
						?>
					</div>
				</div>
				<div class="table-scrollable">
					<table class="table table-striped table-hover table-bordered" id="sample_editable_1">
						<thead>
							<tr>
								<th>No</th>
								<th width="25%">Nama Pemilik</th>
								<th width="25%">Jenis Permohonan</th>
								<th width="17%">No Registrasi</th>
								<th width="25%">Lokasi BG</th>
								<th width="25%">Status Permohonan</th>
								<th>Aksi</th>
								
							</tr>
						</thead>
						<tbody>
							<?php if ($DataKonsultasi->num_rows() > 0) {
								$no = 1;
								foreach ($DataKonsultasi->result() as $key) {
									if ($key->no_konsultasi == "" || $key->no_konsultasi == null) {
										$no_konsultasi = "[Belum Memiliki No Registrasi]";
									} else {
										$no_konsultasi = $key->no_konsultasi;
									}
									if ($key->status != '') {
										$status		= $this->mglobals->getdata('status_pemohon', 'simbg_status', array('kode_status' => $key->status))->row_array();
										$status 	= $status['status_pemohon'];
									} ?>
									<tr>
										<td align="center"><?php echo $no++; ?></td>
										<td><?php echo $key->nm_pemilik; ?></td>
										<td><?php echo $key->nm_konsultasi; ?></td>
										<td><?php echo $no_konsultasi; ?></td>
										<td><?php echo $key->almt_bgn; ?></td>
										<td align=""><?php echo $key->status_pemohon; ?></td>
										<td align="center">
											<?php
											if ($key->pernyataan == '1') { ?>
												<a href="<?php echo site_url('Konsultasi/FormSummary/' . $key->id); ?>" class="btn btn-primary btn-sm" title="Verifikasi Data"><span class="glyphicon glyphicon-edit"></span></a>
											<?php } else { ?>
												<a href="<?php echo site_url('Konsultasi/FormPendaftaran/' . $key->id); ?>" class="btn btn-primary btn-sm" title="Ubah Data"><span class="glyphicon glyphicon-pencil"></span></a>
												<a style="display: block;" href="<?php echo site_url('Konsultasi/removeData/' . $key->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ini?')" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a>
											<?php }
											?>
										</td>
										<!--<td align="center">
											<a href="#" onclick="GetCetakSurat()" class="btn btn-info btn-sm" title="Download" id="sbkbg"><span class="glyphicon glyphicon-print"></span></a>
											<a href="#" onclick="GetRetribusi()" class="btn btn-info btn-sm" title="Download" id="retribusi"><span class="glyphicon glyphicon-print"></span></a>
										
											<a href="#" onclick="GetCetakIMB(<? echo 1; ?>)" class="btn btn-danger btn-sm" title="Cetak IMB" id="tombolinver"><span class="glyphicon glyphicon-print"></span></a><a href="#" onClick="href='<?php echo site_url('detail/detail_imb/' . 1); ?>'" class="btn btn-info btn-sm" title="Lihat Detail Permohonan" id="tombolinver" data-toggle="modal" data-target="#modal-edit"><span class="glyphicon glyphicon-user"></span></a> -->
											<!--<a href="#" onclick="GetCetakSurat()" class="btn btn-info btn-sm" title="Download" id="sbkbg"><span class="glyphicon glyphicon-print"></span></a>
											<a href="#" onclick="GetRetribusi()" class="btn btn-info btn-sm" title="Download" id="retribusi"><span class="glyphicon glyphicon-print"></span></a>
											<a href="#" onclick="GetSLF()" class="btn btn-info btn-sm" title="Download" id="retribusi"><span class="glyphicon glyphicon-print"></span></a>
											<a href="#" onclick="GetRetribusi()" class="btn btn-info btn-sm" title="Download" id="retribusi"><span class="glyphicon glyphicon-print"></span></a>
											<a href="#" onclick="GetRetribusi()" class="btn btn-info btn-sm" title="Download" id="retribusi"><span class="glyphicon glyphicon-print"></span></a>
										</td>-->
									</tr>
								<?php }
							} ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="dialog-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<form action="<?php echo site_url('pengajuan/SuratTandaTerima'); ?>" class="form-horizontal" role="form" method="post">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" onclick="return confirm('Yakin Ingin Keluar?')" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="myModalLabel"></h4>
				</div>
				<div class="modal-body" id="MyModalBody">

				</div>
				<!--<div class="modal-footer">
		<input class="form-control" id="id_permohonannya" name="id_permohonannya" style="display: none;">
		<center><button type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-check"></span> Verifikasi IMB</button></center>
      </div>-->
			</div>
		</form>
	</div>
</div>
<div class="modal fade" id="dialog-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<form action="<?php echo site_url('Pengajuan/SuratTandaTerima'); ?>" class="form-horizontal" role="form" method="post">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" onclick="return confirm('Yakin Ingin Keluar?')" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="myModalLabel"></h4>
				</div>
				<div class="modal-body" id="MyModalBody">

				</div>
				<!--<div class="modal-footer">
		<input class="form-control" id="id_permohonannya" name="id_permohonannya" style="display: none;">
		<center><button type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-check"></span> Verifikasi IMB</button></center>
      </div>-->
			</div>
		</form>
	</div>
</div>
<div id="DaftarPeng" class="modal fade" role="dialog" aria-hidden="true" data-width="60%" data-backdrop="static" data-keyboard="false">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h4 class="modal-title">Daftar Pengajuan</h4>
		</div>
		<div class="modal-body form">
			<form action="<?php echo site_url('Konsultasi/savePermohonan'); ?>" class="form-horizontal" role="form" method="post" id="FormPermohonan" enctype="multipart/form-data">
				<div class="portlet-body form">
					<div class="form-body">
						<div class="form-group">
							<label class="control-label col-md-3">Jenis Permohonan <span class="required">* </span></label>
							<div class="col-md-7">
								<?php
								echo form_dropdown('id_izin', $list_JnsPer, '', 'class ="form-control" id="id_izin" onchange="getjenisPermohonan(this.value)"');
								?>
							</div>
							<div class="col-md-2">
								<a class="btn btn-info" data-toggle="modal" data-target="#modalJenis"><i class="fa fa-book left-icon"> </i></a>
							</div>
						</div>


						<div id="per_imb" style="display:none;">
							<div class="form-group row">
								<label class="control-label col-md-3">Memiliki IMB/PBG <span class="required">* </span></label>
								<div class="col-md-7">
									<div class="radio-list">
										<label><input type="radio" name="imb" value="1" onchange="show_slf(this);"> Iya</label>
										<label><input type="radio" name="imb" value="0" onchange="show_slf(this);"> Tidak</label>
									</div>
								</div>
							</div>
						</div>

						<div id="per_slf" style="display:none;">
							<div class="form-group row">
								<label class="control-label col-md-3">Memiliki SLF<span class="required">* </span></label>
								<div class="col-md-7">
									<div class="radio-list">
										<label><input type="radio" name="slf" value="1" onchange="show_cetak();"> Iya</label>
										<label><input type="radio" name="slf" value="0" onchange="show_cetak();"> Tidak</label>
									</div>
								</div>
							</div>
						</div>

						<div id="per_cetak" style="display:none;">
							<div class="form-group row">
								<label class="control-label col-md-3">Cetak Ulang<span class="required">* </span></label>
								<div class="col-md-7">
									<div class="radio-list">
										<label><input type="checkbox" name="cetak[]" value="1"> IMB/PBG</label>
										<label><input type="checkbox" name="cetak[]" value="2"> SLF</label>
										<label><input type="checkbox" name="cetak[]" value="3"> SBKBG</label>
									</div>
								</div>
							</div>
						</div>

						<div id="KolektifInduk" style="display:none;">
							<div class="form-group">
								<label class="control-label col-md-3">Tipe Bangunan<span class="required">
										* </span></label>
								<div class="col-md-7">
									<div class="col-md-3">
										<div class="form-group">
											<a class="btn btn-info" href="javascript:void(0);" onclick="addTipe();"><i class="fa fa-plus left-icon"> </i>Tambah Tipe</a>
										</div>
										<table class="table table-striped table-bordered dt-responsive wrap" id="tipe_bgn">
											<tr>
												<th>Tipe</th>
												<th>Luas</th>
												<th>Tinggi</th>
												<th>Lantai</th>
												<th width="5%">Aksi</th>
											</tr>
											<tr id="tr-tipe">
												<td><?php echo form_input('tipeA[1]', '', 'style="width:100px;" id="posisi1" class="posisi1 form-control"'); ?></td>
												<td><?php echo form_input('luasA[1]', '', 'style="width:100px;" id="luas1" class="unit1 form-control"'); ?></td>
												<td><?php echo form_input('tinggiA[1]', '', 'style="width:100px;" id="tinggi1" class="tinggi1 form-control"'); ?></td>
												<td><?php echo form_input('lantaiA[1]', '', 'style="width:100px;" id="lantai1" class="tinggi1 form-control"'); ?></td>
												<td><a class="btn btn-info" href="javascript:void(0);" onclick="if(checkDeleteTipeRow() == true){$(this).parent().parent().remove()}"><i class="fa fa-trash left-icon"></i></a></td>
											</tr>
										</table>
									</div>
								</div>
							</div>
						</div>

						<div id="fungsibg" class="form-group" style="display:none;">
							<label class="control-label col-md-3">Fungsi Bangunan<span class="required">* </span></label>
							<div class="col-md-7">
								<?php $id_fungsi_bg = set_value('id', (isset($DataBangunan->id_fungsi_bg) ? $DataBangunan->id_fungsi_bg : '')); ?>
								<?php
								$selected = '';
								if (isset($id_fungsi_bg) && $id_fungsi_bg != '')
									$selected = $id_fungsi_bg;
								else
									$selected = '';
								$js = 'id="id_fungsi_bg" onchange="set_jns_bg(this.value)" class="form-control"';
								echo form_dropdown('id_fungsi_bg', $list_fungsi, $selected, $js);
								?>
							</div>
							<div class="col-md-2">
								<a class="btn btn-info"><i class="fa fa-plus left-icon"> </i></a>
							</div>
						</div>

						<div id="jual_bg" style="display:none;">
							<div class="form-group row">
								<label class="control-label col-md-3">Bangunan akan dijual perunit bangunan<span class="required">* </span></label>
								<div class="col-md-7">
									<div class="radio-list">
										<label><input type="radio" name="jual" value="1"> Iya</label>
										<label><input type="radio" name="jual" value="0"> Tidak</label>
									</div>
								</div>
							</div>
						</div>

						<div id="jns_bg_toggle" class="form-group" style="display:none;">
							<label class="control-label col-md-3">Jenis Bangunan <span class="required">* </span></label>
							<div class="col-md-7">
								<?php
								echo form_dropdown('id_jns_bg', array('' => '--Pilih--'), isset($DataBangunan->id_jns_bg) ? $DataBangunan->id_jns_bg : '', 'id="id_jns_bg"  onchange="show_detail(this.value)" class="form-control"');
								?>
							</div>
							<div class="col-md-2">
								<a class="btn btn-info"><i class="fa fa-plus left-icon"> </i></a>
							</div>
						</div>

						<div id="prasarana" style="display: none;">
							<div class="form-group">
								<?php $prasarana_bg = !empty($DataBangunan->id_prasarana_bg) ? $DataBangunan->id_prasarana_bg : ''; ?>
								<label class="control-label col-md-3">Prasarana<span class="required">* </span></label>
								<div class="col-md-7">
									<select class="form-control" name="id_prasarana_bg" id="id_prasarana_bg">
										<option value="">--Pilih--</option>
										<option value="1" <?php if ($prasarana_bg == '1') echo "selected"; ?>>Kontruksi Pembatas/Penahan/Pengaman</option>
										<option value="2" <?php if ($prasarana_bg == '2') echo "selected"; ?>>Kontruksi Penanda Masuk Lokasi</option>
										<option value="3" <?php if ($prasarana_bg == '3') echo "selected"; ?>>Kontruksi Perkerasan</option>
										<option value="4" <?php if ($prasarana_bg == '4') echo "selected"; ?>>Kontruksi Penghubung</option>
										<option value="5" <?php if ($prasarana_bg == '5') echo "selected"; ?>>Kontruksi Kolam/Reservoir bawah tanah</option>
										<option value="6" <?php if ($prasarana_bg == '6') echo "selected"; ?>>Kontruksi Menara</option>
										<option value="7" <?php if ($prasarana_bg == '7') echo "selected"; ?>>Kontruksi Monumen</option>
										<option value="8" <?php if ($prasarana_bg == '8') echo "selected"; ?>>Kontruksi Instalasi/gardu</option>
										<option value="9" <?php if ($prasarana_bg == '9') echo "selected"; ?>>Kontruksi Reklame / Papan Nama</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Luas Bangunan Prasarana<span class="required">* </span></label>
								<div class="col-md-3">
									<div class="checkbox-list">
										<input type="text" class="form-control" value="<?php echo set_value('luas_bgp', (isset($DataBangunan->luas_bgp) ? $DataBangunan->luas_bgp : '')) ?>" name="luas_bgp" placeholder="Luas Bangunan" autocomplete="off">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Tinggi Bangunan Prasarana<span class="required">* </span></label>
								<div class="col-md-3">
									<div class="checkbox-list">
										<input type="text" class="form-control" value="<?php echo set_value('tinggi_bgp', (isset($DataBangunan->tinggi_bgp) ? $DataBangunan->tinggi_bgp : '')) ?>" name="tinggi_bgp" placeholder="Tinggi Bangunan" autocomplete="off">
									</div>
								</div>
							</div>

						</div>

						<div id="detail_bg" style="display:none;">
							<div class="form-group">
								<label class="control-label col-md-3">Nama Bangunan<span class="required">* </span></label>
								<div class="col-md-7">
									<input type="text" class="form-control" value="<?php echo set_value('nama_bangunan', (isset($DataBangunan->nm_bgn) ? $DataBangunan->nm_bgn : '')) ?>" name="nama_bangunan" placeholder="Jenis/Nama Usaha" autocomplete="off">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Luas Bangunan<span class="required">* </span></label>
								<div class="col-md-7">
									<div class="checkbox-list">
										<input type="text" class="form-control" value="<?php echo set_value('luas_bg', (isset($DataBangunan->luas_bgn) ? $DataBangunan->luas_bgn : '')) ?>" name="luas_bg" id="luas_bg" onblur="cek()" placeholder="Luas Bangunan Dalam Meter Persegi" autocomplete="off">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Jumlah Lantai Bangunan<span class="required">* </span></label>
								<div class="col-md-3">
									<div class="checkbox-list">
										<input type="text" class="form-control" value="<?php echo set_value('lantai_bg', (isset($DataBangunan->jml_lantai) ? $DataBangunan->jml_lantai : '')) ?>" name="lantai_bg" id="lantai_bg" onblur="cek()" placeholder="Jumlah Lantai Bangunan Gedung" autocomplete="off">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Tinggi Bangunan<span class="required">* </span></label>
								<div class="col-md-3">
									<div class="checkbox-list">
										<input type="text" class="form-control" value="<?php echo set_value('tinggi_bg', (isset($DataBangunan->tinggi_bgn) ? $DataBangunan->tinggi_bgn : '')) ?>" name="tinggi_bg" onblur="cek()" placeholder="Tinggi Bangunan" autocomplete="off">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Luas Basement Bangunan</label>
								<div class="col-md-7">
									<div class="checkbox-list">
										<input type="text" class="form-control" value="<?php echo set_value('luas_basement', (isset($DataBangunan->luas_basement) ? $DataBangunan->luas_basement : '')) ?>" name="luas_basement" placeholder="Luas Basement Bangunan" autocomplete="off">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Jumlah Lantai Basement Bangunan</label>
								<div class="col-md-7">
									<div class="checkbox-list">
										<input type="text" class="form-control" value="<?php echo set_value('lapis_basement', (isset($DataBangunan->lapis_basement) ? $DataBangunan->lapis_basement : '')) ?>" name="lapis_basement" placeholder="Jumlah Lantai Basement Bangunan" autocomplete="off">
									</div>
								</div>
							</div>
						</div>

						<div id="per_doc_tek" style="display: none;">
							<div class="form-group">
								<label class="col-md-3 control-label">Perancang Dokumen Teknis</label>
								<div class="col-md-7">
									<select name="id_doc_tek" id="id_doc_tek" onchange="set_prototype(this.value)" class="form-control" data-placeholder="Select...">
									</select>
								</div>
							</div>
						</div>
						<div id="prototype" style="display: none;">
							<div class="form-group">
								<label class="col-md-3 control-label">Pilih Prototype</label>
								<div class="col-md-7">
									<select name="id_prototype" id="id_prototype" class="form-control" data-placeholder="Select...">
									</select>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
	$(function() {
		$('.select2').select2();
		// Setup form validation on the #register-form element
		$("#FormPermohonan").validate({
			// Specify the validation rules
			rules: {
				id_izin: "required",
				id_fungsi_bg: "required",
				id_jns_bg: "required",
				id_doc_tek: "required",
				nama_bangunan: "required",
				luas_bg: "required",
				lantai_bg: "required",
				tinggi_bg: "required",
				id_prasarana_bg: "required",
				tinggi_bgp: "required",
				luas_bgp: "required",
				imb: "required",
				slf: "required",
				id_prototype: "required",
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
				id_izin: "Pilih Jenis Permohonan",
				id_fungsi_bg: "Pilih Fungsi Bangunan",
				id_jns_bg: "required",
				id_doc_tek: "required",
				nama_bangunan: "required",
				luas_bg: "required",
				lantai_bg: "required",
				tinggi_bg: "required",
				id_prasarana_bg: "required",
				tinggi_bgp: "required",
				luas_bgp: "required",
				imb: "",
				slf: "",
				id_prototype: "required",
			},
			submitHandler: function(form) {
				form.submit();
				document.getElementById("FormPermohonan").reset();
			}
		});
	});

	function GetTandaPermohonan(id) {
		$("#MyModalBody").html('<iframe src="<?php echo base_url(); ?>Pengajuan/SuratTandaTerima/' + id + '" frameborder="no" width="860" height="540"></iframe>');
		$('[name="id_permohonannya"]').val(id);
	}

	function GetCetakSurat(id) {
		var url = "<?php echo base_url() . index_page() ?>Konsultasi/cetak_surat/";
		swin = window.open(url, 'win', 'scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
		swin.focus();
	}

	function GetRetribusi(id) {
		var url = "<?php echo base_url() . index_page() ?>Konsultasi/cetak_retribusi/";
		swin = window.open(url, 'win', 'scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
		swin.focus();
	}

	function GetSLF(id) {
		var url = "<?php echo base_url() . index_page() ?>konsultasi/cetak_SLF/";
		swin = window.open(url, 'win', 'scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
		swin.focus();
	}


	function getjenisPermohonan(v) {

		if (v == '1' || v == '3') {
			document.getElementById('prasarana').style.display = "none";
			document.getElementById('fungsibg').style.display = "block";
			document.getElementById('per_doc_tek').style.display = "none";
			document.getElementById('prototype').style.display = "none";
			document.getElementById('jual_bg').style.display = "none";
			document.getElementById('per_imb').style.display = "none";
			document.getElementById('KolektifInduk').style.display = "none";
			document.getElementById('per_slf').style.display = "none";
			document.getElementById('per_cetak').style.display = "none";
		} else if (v == '2') {
			document.getElementById('prasarana').style.display = "none";
			document.getElementById('per_imb').style.display = "block";
			document.getElementById('fungsibg').style.display = "block";
			document.getElementById('jns_bg_toggle').style.display = "none";
			document.getElementById('detail_bg').style.display = "none";
			document.getElementById('per_doc_tek').style.display = "none";
			document.getElementById('prototype').style.display = "none";
			document.getElementById('jual_bg').style.display = "none";
			document.getElementById('KolektifInduk').style.display = "none";
			document.getElementById('per_slf').style.display = "none";
			document.getElementById('per_cetak').style.display = "none";
		} else if (v == '4') {
			document.getElementById('prasarana').style.display = "none";
			document.getElementById('KolektifInduk').style.display = "block";
			document.getElementById('per_imb').style.display = "none";
			document.getElementById('fungsibg').style.display = "none";
			document.getElementById('jns_bg_toggle').style.display = "none";
			document.getElementById('detail_bg').style.display = "none";
			document.getElementById('per_doc_tek').style.display = "none";
			document.getElementById('prototype').style.display = "none";
			document.getElementById('jual_bg').style.display = "none";
			document.getElementById('per_slf').style.display = "none";
			document.getElementById('per_cetak').style.display = "none";
		} else if (v == '5') {
			document.getElementById('prasarana').style.display = "block";
			document.getElementById('KolektifInduk').style.display = "none";
			document.getElementById('per_imb').style.display = "none";
			document.getElementById('fungsibg').style.display = "none";
			document.getElementById('jns_bg_toggle').style.display = "none";
			document.getElementById('detail_bg').style.display = "none";
			document.getElementById('per_doc_tek').style.display = "none";
			document.getElementById('prototype').style.display = "none";
			document.getElementById('jual_bg').style.display = "none";
			document.getElementById('per_slf').style.display = "none";
			document.getElementById('per_cetak').style.display = "none";
		} else if (v == '6') {
			document.getElementById('prasarana').style.display = "none";
			document.getElementById('per_imb').style.display = "none";
			document.getElementById('fungsibg').style.display = "block";
			document.getElementById('jns_bg_toggle').style.display = "none";
			document.getElementById('detail_bg').style.display = "none";
			document.getElementById('per_doc_tek').style.display = "none";
			document.getElementById('prototype').style.display = "none";
			document.getElementById('jual_bg').style.display = "none";
			document.getElementById('KolektifInduk').style.display = "none";
			document.getElementById('per_slf').style.display = "none";
			document.getElementById('per_cetak').style.display = "none";
		} else {
			document.getElementById('prasarana').style.display = "none";
			document.getElementById('per_imb').style.display = "none";
			document.getElementById('fungsibg').style.display = "none";
			document.getElementById('jns_bg_toggle').style.display = "none";
			document.getElementById('detail_bg').style.display = "none";
			document.getElementById('per_doc_tek').style.display = "none";
			document.getElementById('prototype').style.display = "none";
			document.getElementById('jual_bg').style.display = "none";
			document.getElementById('KolektifInduk').style.display = "none";
			document.getElementById('per_slf').style.display = "none";
			document.getElementById('per_cetak').style.display = "none";
		}
	}

	function show_slf(v) {
		var slf = v.value;
		if (slf == '1') {
			document.getElementById('per_slf').style.display = "block";
			document.getElementById('per_cetak').style.display = "none";
		} else {
			document.getElementById('per_slf').style.display = "block";
		}
		show_cetak()
	}

	function show_cetak() {
		var imb = document.getElementsByName('imb');
		for (i = 0; i < imb.length; i++) {
			if (imb[i].checked)
				imb = imb[i].value;
		}
		var slf = document.getElementsByName('slf');
		for (i = 0; i < slf.length; i++) {
			if (slf[i].checked)
				slf = slf[i].value;
		}

		if (imb == '1' && slf == '1') {
			document.getElementById('per_cetak').style.display = "block";
		} else {
			document.getElementById('per_cetak').style.display = "none";
		}
	}

	function set_jns_bg(v) {
		document.getElementById('detail_bg').style.display = "none";
		document.getElementById('jns_bg_toggle').style.display = "block";
		$("#jns_bg_toggle").fadeIn()
		jQuery.post(base_url + 'Konsultasi/getDataJnsBg/' + v, function(data) {
			var jenis_bg = '<option value="">-- Pilih --</option>';
			jQuery.each(data, function(key, value) {
				jenis_bg += '<option value="' + value.id_jns_bg + '"> ' + value.nm_jenis_bg + ' </option>';
			});
			jQuery('#id_jns_bg').html(jenis_bg);
			$('#id_jns_bg').prop("disabled", false);
		}, 'json');

		if (v == '') {
			document.getElementById('jual_bg').style.display = "none";
			document.getElementById('prototype').style.display = "none";
		} else if (v == '3') {
			document.getElementById('jual_bg').style.display = "block";
			document.getElementById('per_doc_tek').style.display = "none";
			document.getElementById('prototype').style.display = "none";
		} else {
			document.getElementById('jual_bg').style.display = "none";
			document.getElementById('per_doc_tek').style.display = "none";
			document.getElementById('prototype').style.display = "none";
		}

	}

	function show_detail(v) {
		if (v == '') {
			document.getElementById('detail_bg').style.display = "none";
		} else {
			document.getElementById('detail_bg').style.display = "block";
		}
	}

	function cek() {

		var luas_bg = $('#luas_bg').val();
		var lantai_bg = $('#lantai_bg').val();
		if ($("#id_izin").val() == 1) {
			if ($("#id_fungsi_bg").val() == 1) {
				if (luas_bg <= 100 && lantai_bg <= 2) {
					document.getElementById('per_doc_tek').style.display = "block";
					document.getElementById('prototype').style.display = "none";
					var select_tek = '';
					var select_tek2 = '';
					var select_tek3 = '';
					var select_tek4 = '';

					var id_doc_tek = '<option value="1" ' + select_tek + '>Perencana Kontruksi</option>';
					id_doc_tek += '<option value="2" ' + select_tek2 + '>Desain Protipe</option>';
					id_doc_tek += '<option value="3" ' + select_tek3 + '>Pengembangan Desain</option>';
					id_doc_tek += '<option value="4" ' + select_tek4 + '>Ketentuan Pokok Tahan Gempa</option>';
				} else {
					document.getElementById('per_doc_tek').style.display = "block";
					document.getElementById('prototype').style.display = "none";
					var id_doc_tek = '<option value="1" selected>Perencana Kontruksi</option>';

				}
			} else {
				document.getElementById('per_doc_tek').style.display = "block";
				document.getElementById('prototype').style.display = "none";
				var id_doc_tek = '<option value="1" selected>Perencana Kontruksi</option>';
			}

			$('#id_doc_tek').html(id_doc_tek);
		}
	}

	function set_prototype(v) {
		if (v == 2 || v == 3) {
			document.getElementById('prototype').style.display = "block";
			var select_1 = '';
			var select_2 = '';

			var id_type = '<option value="1" ' + select_1 + '>Type 45</option>';
			id_type += '<option value="2" ' + select_2 + '>Type 50</option>';
		} else {
			document.getElementById('prototype').style.display = "none";
		}
		$('#id_prototype').html(id_type);
	}

	function addTipe() {
		var lastRow = $('#tipe_bgn').find("tr").length;
		var emptyrows = 0;
		for (i = 1; i < lastRow; i++) {
			if ($("#posisi" + i).val() == '') {
				emptyrows += 1;
			}
		}
		var isi = `<td><?php echo form_input("tipeA[`+lastRow+`]", "", "class=\"form-control\" style=\"width:150px;\" id=\"posisi`+lastRow+`\""); ?></td>'`;
		isi += `<td><?php echo form_input("luasA[`+lastRow+`]", "", "class=\"form-control\" style=\"width:150px;\" id=\"luas`+lastRow+`\""); ?></td>'`;
		isi += `<td><?php echo form_input("tinggiA[`+lastRow+`]", "", "class=\"form-control\" class=\"form-control\" style=\"width:150px;\" id=\"tinggi`+lastRow+`\""); ?></td>'`;
		isi += `<td><?php echo form_input("lantaitA[`+lastRow+`]", "", "class=\"form-control\" style=\"width:150px;\" id=\"lantai`+lastRow+`\""); ?></td>'`;

		isi += `<td><a class="btn btn-info" href="javascript:void(0);" onclick="if(checkDeleteTipeRow() == true){$(this).parent().parent().remove()}" ><i class="fa fa-trash left-icon"></i></a></td>`;

		if (emptyrows == 0) {
			$('#tipe_bgn').children().append("<tr id='tr-tipe'>" + isi + "</tr>")
		} else {
			$('#dialog-message').attr('title', 'Perhatian').html("Silahkan mengisi data pada baris yang tersedia terlebih dahulu, sebelum menambah baris.").dialog();
		}
	}

	function checkDeleteTipeRow() {
		var tbl = $('#tipe_bgn');
		var lastRow = tbl.find("tr").length;
		if (lastRow > 2) {
			return true
		} else {
			$('#dialog-message').attr('title', 'Perhatian').html("Data tim audit tidak boleh kosong.").dialog();
			return false;
		}
	}

	function addUnit() {
		var lastRow = $('#unit_bgn').find("tr").length;
		var emptyrows = 0;
		for (i = 1; i < lastRow; i++) {
			if ($("#unit" + i).val() == '') {
				emptyrows += 1;
			}
		}
		var isi = `<td><?php echo form_input("unitA[`+lastRow+`]", "", "class=\"form-control\" style=\"width:150px;\" id=\"unit`+lastRow+`\""); ?></td>'`;

		isi += `<td><a class="btn btn-info" href="javascript:void(0);" onclick="if(checkDeleteUnitRow() == true){$(this).parent().parent().remove()}" ><i class="fa fa-trash left-icon"></i></a></td>`;

		if (emptyrows == 0) {
			$('#unit_bgn').children().append("<tr id='tr-unit'>" + isi + "</tr>")
		} else {
			$('#dialog-message').attr('title', 'Perhatian').html("Silahkan mengisi data pada baris yang tersedia terlebih dahulu, sebelum menambah baris.").dialog();
		}
	}

	function checkDeleteUnitRow() {
		var tbl = $('#unit_bgn');
		var lastRow = tbl.find("tr").length;
		if (lastRow > 2) {
			return true
		} else {
			$('#dialog-message').attr('title', 'Perhatian').html("Data tim audit tidak boleh kosong.").dialog();
			return false;
		}
	}

	function addTinggi() {
		var lastRow = $('#tinggi_bgn').find("tr").length;
		var emptyrows = 0;
		for (i = 1; i < lastRow; i++) {
			if ($("#tinggi" + i).val() == '') {
				emptyrows += 1;
			}
		}
		var isi = `<td><?php echo form_input("tinggiA[`+lastRow+`]", "", "class=\"form-control\" class=\"form-control\" style=\"width:150px;\" id=\"tinggi`+lastRow+`\""); ?></td>'`;

		isi += `<td><a class="btn btn-info" href="javascript:void(0);" onclick="if(checkDeleteTinggieRow() == true){$(this).parent().parent().remove()}" ><i class="fa fa-trash left-icon"></i></a></td>`;

		if (emptyrows == 0) {
			$('#tinggi_bgn').children().append("<tr id='tr-tinggi'>" + isi + "</tr>")
		} else {
			$('#dialog-message').attr('title', 'Perhatian').html("Silahkan mengisi data pada baris yang tersedia terlebih dahulu, sebelum menambah baris.").dialog();
		}
	}

	function checkDeleteTinggieRow() {
		var tbl = $('#tinggi_bgn');
		var lastRow = tbl.find("tr").length;
		if (lastRow > 2) {
			return true
		} else {
			$('#dialog-message').attr('title', 'Perhatian').html("Data tim audit tidak boleh kosong.").dialog();
			return false;
		}
	}
</script>

