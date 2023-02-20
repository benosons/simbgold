
<div class="portlet light margin-top-20"  style="min-height:500px;">

	<div class="portlet-title tabbable-line">
		<div class="caption caption-md">
			<i class="icon-globe theme-font hide"></i>
			<span class="caption-subject font-blue-madison bold uppercase">List Data IMB => PBG</span>
		</div>
		<div class="actions">
			<a href="<?php echo site_url('Convert/Add');?>" type="button" class="btn btn-primary">Tambah <i class="fa fa-plus"></i></a>
		</div>								
	</div>
	
	<div class="portlet-body">
		<div >
			
		</div>
	
	</div>
	
</div>

<div id="modal_detail" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-width="60%" data-keyboard="false">
	
	<div class="modal-content">
		<!--div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onClick="ResRes2()"></button>
			<span class="caption-subject text-primary bold uppercase " style="font-size:15px;">Detail Data</span>
		</div-->
		<div class="modal-body">
		<?php echo form_open_multipart('Convert/saveDataIMB', [
			'class' => 'form-horizontal',
			'role' => 'form',
			'id' => 'detailform'
		]) ?>
			<div class="form-body">
				<div class="tabbable-custom nav-justified ">
					<ul class="nav nav-tabs nav-justified">
						
						<li class="active">
							<a href="#tab_2" data-toggle="tab">Data Pemilik</a>
						</li>
						<li>
							<a href="#tab_3" data-toggle="tab">Data Bangunan</a>
						</li>

					</ul>
					<div class="tab-content">
						
						<div class="tab-pane active" class="active" id="tab_2">
								<br>
								<div class="col-md-6">
									<div class="form-group form-md-line-input has-success">
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-circle"></i>
											</span>
											<input class="form-control" id="no_imb" name="no_imb" readonly type="text" placeholder="SK IMB 0-9 / A-Z"
												autocomplete="off">
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
											<input class="form-control" type="text" name="terbit_imb" readonly>
											<label for="form_control_1">Tanggal Penerbitan <span class="required" aria-required="true"> *
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
											<input class="form-control" id="nama_pemilik" name="nama_pemilik" type="text"
												readonly>

											<label for="form_control_1">Nama Pemilik<span class="required" aria-required="true"> *
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
											<input class="form-control ktp" id="ktp_pemilik" name="ktp_pemilik" type="text" readonly placeholder="Nomor KTP"
												autocomplete="off">
											<label for="form_control_1">Nomor KTP Pemilik<span class="required" aria-required="true">
													* </span></label>

										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-md-line-input has-success">
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-circle"></i>
											</span>
											<input class="form-control" readonly id="retribusi_imb" name="retribusi_imb" type="text"
												placeholder="Ketik Angka Saja Tanpa Tanda Baca" autocomplete="off">
											<label for="form_control_1">Total Retribusi (Rp.)<span class="required" aria-required="true"> *
												</span></label>

										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-md-line-input has-success">
										<div class="input-group">
											
											<input style="display:none;" class="form-control" id="lampiran_imb" name="lampiran_imb" type="button"
												placeholder="Ketik Angka Saja Tanpa Tanda Baca" autocomplete="off">
											<span class="input-group-btn btn-right">
												<button class="btn green-haze" type="button" onClick="javascript:get_lampiran();">Klik Untuk Melihat Lampiran</button>
											</span>
											
											<label for="form_control_1">Lampiran<span class="required" aria-required="true"> *
												</span></label>

										</div>
									</div>
								</div>
						</div>
						<div class="tab-pane" id="tab_3">
								<br>
								<div class="col-md-6">
									<div class="form-group form-md-line-input has-success">
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-circle"></i>
											</span>
											<input readonly class="form-control" id="fungsi_bgn" name="fungsi_bgn" type="text" placeholder="Fungsi Bangunan"
												autocomplete="off">
											<label for="form_control_1">Fungsi Bangunan<span class="required" aria-required="true"> * </span></label>

										</div>
									</div>

								</div>
								<div class="col-md-6">
									<div class="form-group form-md-line-input has-success">
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-circle"></i>
											</span>
											<input readonly class="form-control" id="nama_bgn" name="nama_bgn" type="text" placeholder="Nama Bangunan"
												autocomplete="off">
											<label for="form_control_1">Nama Bangunan<span class="required" aria-required="true"> * </span></label>

										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-md-line-input has-success">
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-circle"></i>
											</span>
											<input readonly class="form-control" id="luas_bgn" name="luas_bgn" type="text" placeholder="Luas Bangunan"
												autocomplete="off">

											<label for="form_control_1">Luas Bangunan (m<sup>2</sup>) <span class="required" aria-required="true"> *
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
											<input readonly class="form-control" id="luas_tanah" name="luas_tanah" type="text" placeholder="Luas Tanah"
												autocomplete="off">

											<label for="form_control_1">Luas Tanah (m<sup>2</sup>)<span class="required" aria-required="true"> *
												</span></label>

										</div>
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group form-md-line-input has-success">
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-circle"></i>
											</span>
											<input readonly class="form-control" id="alamat_bgn" name="alamat_bgn" type="text"
												placeholder="Alamat / Lokasi Bangunan" autocomplete="off">
											<label for="form_control_1">Alamat / Lokasi Bangunan<span class="required" aria-required="true"> *
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
											<input readonly class="form-control" id="nama_kelurahan" name="nama_kelurahan" type="text"
												placeholder="Alamat / Lokasi Bangunan" autocomplete="off">
											<label for="form_control_1">Desa / Kelurahan<span class="required" aria-required="true"> *
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
											<input readonly class="form-control" id="nama_kecamatan" name="nama_kecamatan" type="text"
												placeholder="Alamat / Lokasi Bangunan" autocomplete="off">
											<label for="form_control_1">Kecamatan<span class="required" aria-required="true"> *
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
											<input readonly class="form-control" id="nama_kabkota" name="nama_kabkota" type="text"
												placeholder="Alamat / Lokasi Bangunan" autocomplete="off">
											<label for="form_control_1">Kabupaten / Kota<span class="required" aria-required="true"> *
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
											<input readonly class="form-control" id="nama_provinsi" name="nama_provinsi" type="text"
												placeholder="Alamat / Lokasi Bangunan" autocomplete="off">
											<label for="form_control_1">Provinsi<span class="required" aria-required="true"> *
												</span></label>

										</div>
									</div>
								</div>
						</div>
					</div>
				</div>
				<center>
					<button type="button" data-dismiss="modal" class="btn red" onClick="ResRes2()"><i class="fa fa-times"></i> Tutup</button>
				</center>
			</div>
		<?php echo form_close(); ?>
		</div>
		
	</div>
</div>

<div id="notif" class="modal fade" tabindex="-1" aria-hidden="true" data-width="25%" data-backdrop="static"
	data-keyboard="false" style="background-color:#f2dede">
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12 ">
				<div class="form-body">
					<?php
						echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" style="margin-bottom:0px;" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '</div>' : '';
					?>
				</div>
			</div>
		</div><br>
		<center><button type="button" data-dismiss="modal" data-toggle="modal" class="btn red">Coba Lagi</button></center>
	</div>
</div>

<div id="notifBerhasil" class="modal fade" tabindex="-1" aria-hidden="true" data-width="25%" data-backdrop="static"
	data-keyboard="false" style="background-color:#dff0d8">
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12 ">
				<div class="form-body">
					<?php
						echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" style="margin-bottom:0px;" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '</div>' : '';
					?>
				</div>
			</div>
		</div><br>
		<center><button type="button" data-dismiss="modal" class="btn green">Ok</button></center>
	</div>
</div>
	<? if ($this->session->flashdata('message') != ''){?>
		<? if ($this->session->flashdata('status') != 'danger'){?>
			<script>
				$('#notifBerhasil').modal('show');
			</script>
		<?}else{?>
			<script>
				$('#notif').modal('show');
			</script>	
		<?}?>
		
	<?}else{?>
			
	<?}?>
<script>

	$(document).ready(function () {
		$(".btable").DataTable({
			
			"pageLength": 25,
			'columnDefs': [{
				'targets': [2, 4, 6, 7],
				/* column index */
				'orderable': false,
				/* true or false */
			}],
			"language": {
				"aria": {
					"sortAscending": ": activate to sort column ascending",
					"sortDescending": ": activate to sort column descending"
				},

				"emptyTable": "Data Belum Tersedia",
				"info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ jumlah data",
				"infoEmpty": "Data Tidak Ditemukan",
				"infoFiltered": "",
				"lengthMenu": "Tampilkan _MENU_ Data",
				"search": "Cari:",
				"zeroRecords": "Data Tidak Ditemukan",
				"oPaginate": {
					"sNext": 'Selanjutnya',
					"sLast": 'Terakhir',
					"sFirst": 'Pertama',
					"sPrevious": 'Sebelumnya'
				}
			},
		});
		
	});

	function detaildata(id) {
		$.ajax({
			type: "GET",
			url: "<?php echo base_url('Convert/Detail/') ?>",
			dataType: "JSON",
			data: {
				id: id
			},
			success: function (data) {
				$.each(data, function () {
					$('#modal_detail').modal('show');
					$('[name="nama_pemilik"]').val(data.nama_pemilik);
					$('[name="no_imb"]').val(data.no_imb);
					$('[name="terbit_imb"]').val(data.terbit_imb);
					$('[name="ktp_pemilik"]').val(data.ktp_pemilik);
					$('[name="nama_bgn"]').val(data.nama_bgn);
					$('[name="fungsi_bgn"]').val(data.fungsi_bgn);
					$('[name="alamat_bgn"]').val(data.alamat_bgn);
					$('[name="luas_bgn"]').val(data.luas_bgn);
					$('[name="luas_tanah"]').val(data.luas_tanah);
					$('[name="retribusi_imb"]').val(data.retribusi_imb);
					$('[name="lampiran_imb"]').val(data.lampiran_imb);
					$('[name="nama_provinsi"]').val(data.nama_provinsi);
					$('[name="nama_kabkota"]').val(data.nama_kabkota);
					$('[name="nama_kelurahan"]').val(data.nama_kelurahan);
					$('[name="nama_kecamatan"]').val(data.nama_kecamatan);
				});
			}
		});
		return false;
	};
	
	function get_cetak(id) {
		//Cetakan Belum
		url = "<?php echo base_url() . index_page() ?>Covert/CetakPBG/"+id;
		swin = window.open(url, 'win',
			'scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
		swin.focus();
	}
	
	function get_lampiran() {
		var id = document.getElementById("lampiran_imb").value;
		url = "<?php echo base_url() . index_page() ?>public/uploads/lampiran_convert/" + id;
		swin = window.open(url, 'win',
			'scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
		swin.focus();
	}

	function ResRes2() {
		document.getElementById("detailform").reset();
	};
 
</script>