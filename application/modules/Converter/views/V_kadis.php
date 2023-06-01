
<div class="portlet light margin-top-20"  style="min-height:500px;">

	<div class="portlet-title tabbable-line">
		<div class="caption caption-md">
			<i class="icon-globe theme-font hide"></i>
			<span class="caption-subject font-blue-madison bold uppercase">List Verifikasi Data IMB => PBG</span>
		</div>							
	</div>
	
	<div class="portlet-body">
		<div >
			<table class="table table-bordered btable">
				<thead>
						<tr class="info">
							<th style="width:4%"><center>#</center></th>
							<th>Nomor IMB</th>
							<th>Nama Pemilik</th>
							<th>Fungsi Bangunan</th>
							<th>Nama Bangunan</th>
							
							<th style="width:2%"><center>Status</center></th>
							<th style="width:2%">Detail</th>
							
						</tr>
					</thead>
					<tbody>
					<?php if ($dataconvert->num_rows() > 0) {
                        $no = 1;
                        foreach ($dataconvert->result() as $r) 
					{ ?>
						<?php
							if($r->status == 86){
								$clss = "success";
								$tomb = "";
							}else{
								$clss = "warning";
								$tomb = "disabled";
							}
						?>
							<tr class="<?=$clss?>">
								<td><?php echo $no++; ?></td>
								<td><?php echo $r->no_imb; ?></td>
								<td><?php echo $r->nama_pemilik; ?></td>
								<td><?php echo $r->fungsi_bgn; ?></td>
								<td><?php echo $r->nama_bgn; ?></td>
								
								<td align="center">
								  <?php  if ($r->status >= 86) { ?>
									
										<a href="#show-popup"  onClick="GetLihat(<? echo $r->id_convert ?>)" style="width:140px;" class="btn btn-success btn-sm" data-toggle="modal" title="Terverifikasi" >Terverifikasi</a>
									
								  <?}else{?>
									
										<a href="#dialog-popup"  style="width:140px;" onClick="GetCetak(<? echo $r->id_convert ?>)" class="btn btn-danger btn-sm" title="Lihat" id="tombolinver" data-toggle="modal">Menunggu Verifikasi</a>
									
								  <?}?>
								</td>
								<td>
									<a href="#" onClick="detaildata('<?php echo $r->id_convert; ?>')" class="btn btn-primary btn-sm" title="Lihat Data">
									<span class="glyphicon glyphicon-user"></span></a>
								</td>
								
							</tr>
						<?php }
                    } ?>
				</tbody>
			</table>
		</div>
	
	</div>
	
</div>
<div class="modal fade" id="dialog-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" role="dialog" data-backdrop="static" data-width="auto" data-keyboard="false">
  <form action="<?php echo site_url('Converter/ValidasiKadis'); ?>" class="form-horizontal" role="form" method="post" id="verifikasiform">
  <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none"> 
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" onClick="ResRes3()" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body" id="MyModalBody">
		
      </div>
      <div class="modal-footer">
		<input class="form-control" id="id_convertnya" name="id_convertnya" style="display: none;">
		<center>
			<a data-dismiss="modal" onClick="ResRes3()" type="button" style="width:150px;" class="btn red"><i class="fa fa-times"></i> Batal</a>
			<button type="submit" class="btn btn-success btn-md" style="width:150px;"><span class="glyphicon glyphicon-check"></span> Verifikasi PBG</button>
		</center>
      </div>
    </div>
  </form>
</div>
<div class="modal fade" id="show-popup" tabindex="-1" role="dialog" aria-hidden="true" role="dialog" data-backdrop="static" data-width="auto" data-keyboard="false">
  
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" onClick="ResRes3()" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        
      </div>
      <div class="modal-body" id="BodyCetak">
		
      </div>
      <div class="modal-footer">
		<center>
			<a data-dismiss="modal" onClick="ResRes3()" type="button" style="width:150px;" class="btn red"><i class="fa fa-times"></i> Tutup</a>
		</center>
      </div>
    </div>
  
</div>
<div id="modal_detail" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-width="60%" data-keyboard="false">
	
	<div class="modal-content">
		<div class="modal-body">
		<?php echo form_open_multipart('Converter/saveDataIMB', [
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
								<div class="col-md-12">
									<div class="form-group form-md-line-input has-success">
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-circle"></i>
											</span>
											<input readonly class="form-control" id="alamat_pemilik" name="alamat_pemilik" type="text"
												placeholder="Alamat Sesuai KTP" autocomplete="off">
											<label for="form_control_1">Alamat Pemilik IMB/PBG<span class="required" aria-required="true"> *
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
											<input readonly class="form-control" id="nama_kadis" name="nama_kadis" type="text"
												placeholder="Nama Kepala Dinas" autocomplete="off" >

											<label for="form_control_1">Nama Kepala Dinas<span class="required" aria-required="true"> *
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
											<input readonly class="form-control nip" id="nip_kadis" name="nip_kadis" type="text" placeholder="NIP Kepala Dinas"
												autocomplete="off">
											<label for="form_control_1">NIP Kepala Dinas<span class="required" aria-required="true">
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
				'targets': [2, 4, 6],
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
			url: "<?php echo base_url('Converter/Detail/') ?>",
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
					$('[name="alamat_pemilik"]').val(data.alamat_pemilik);
					$('[name="nama_kadis"]').val(data.nama_kadis);
					$('[name="nip_kadis"]').val(data.nip_kadis);
				});
			}
		});
		return false;
	};

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
	
	function ResRes3() {
		document.getElementById("verifikasiform").reset();
	};
	
	function GetCetak(id)
	{
		$("#MyModalBody").html('<iframe src="<?php echo base_url();?>Converter/CetakFormPbg/'+id+'" frameborder="no" width="860" height="540"></iframe>');
		$('[name="id_convertnya"]').val(id);
	}
	
	function GetLihat(id)
	{
		$("#BodyCetak").html('<iframe src="<?php echo base_url();?>Converter/CetakFormPbg/'+id+'" frameborder="no" width="860" height="540"></iframe>');
	}
 
</script>