<script>
function getStatus(v) 
		alert(v);
		if (v == '1') {
			document.getElementById('NonPrasarana').style.display = "none";
		} else {
			document.getElementById('Kolektif').style.display = "none";
		}
	}
</script>
<form action="Pengawas/status_dt_val" class="form-horizontal" role="form" method="post" id="savestatussyarat" name="savestatussyarat" enctype="multipart/form-data">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 align="center" class="modal-title"><b>Data Pokok Permohonan </b></h4>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12 ">
				<input type="hidden" name="id_pemilik" value="<?php echo $data->id; ?>">
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-3 control-label">Nama Pemilik</label>
						<div class="col-md-9">
							<input class="form-control" value="<?php echo $data->nm_pemilik; ?>" placeholder="Nama Pemilik" autocomplete="off" readonly>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 ">
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-3 control-label">Alamat Pemilik</label>
						<div class="col-md-9">
							<textarea class="form-control" placeholder="Alamat Pemilik" readonly><?php echo $data->alamat; ?>, Kec. <?php echo $data->nama_kecamatan; ?>, <?php echo ucwords(strtolower($data->nama_kabkota)); ?>, Prov. <?php echo $data->nama_provinsi; ?>
							</textarea>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 ">
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-3 control-label">Jenis Konsultasi</label>
						<?php
						$list_izin = array(
							"0" => "--Pilih--",
							"1" => "Perizinan Bangunan Gedung",
							"2" => "Bangunan Gedung Existing Belum Ber-IMB",
							"3" => "Bangunan Gedung Perubahan",
							"4" => "Bangunan Gedung Kolektif",
							"5" => "Bangunan Gedung Prasarana",
							"6" => "Bangunan Gudang 1300 Meter Persegi"
						);
						?>
						<div class="col-md-9">
							<input class="form-control" value="<?php echo $list_izin[$data->id_izin]; ?>" readonly>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 ">
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-3 control-label">Lokasi Bangunan Gedung</label>
						<div class="col-md-9">
							<?php $bgn = $this->mglobal->listDataKecamatan('a.nama_kecamatan,b.nama_kabkota,c.nama_provinsi', $data->id_kec_bgn, $data->id_kabkot_bgn)->row(); ?>
							<textarea class="form-control" readonly><?php echo $data->almt_bgn; ?>, Kec. <?php echo $bgn->nama_kecamatan; ?>, <?php echo ucwords(strtolower($bgn->nama_kabkota)); ?>, Prov. <?php echo $bgn->nama_provinsi; ?></textarea>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
	<div class="portlet-body">
		<div class="tabbable-custom nav-justified">
			<ul class="nav nav-tabs nav-justified">
				<li class="active"><a href="#tabtot" data-toggle="tab">Data Bangunan</a></li>
				<li><a href="#tab_2_1" data-toggle="tab">Data Tanah </a></li>
				<li><a href="#tab_2_2" data-toggle="tab">Data Umum</a></li>
				<?php if ($data->id_jenis_permohonan !='4'){?>
				<li><a href="#tab_2_3" data-toggle="tab">Ketentuan Teknis</a></li>
				<?}else{?>
					
				<?}?>
				<li><a href="#tab_2_4" data-toggle="tab">Status</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane fade active in" id="tabtot">
					<?php include "DataKonsultasi.php"; ?>
				</div>
				<div class="tab-pane fade" id="tab_2_1">
					<table id="sample_1" class="table table-bordered table-striped table-hover">
						<thead>
							<tr class="warning">
								<th><center>No.</center></th>
								<th><center>Jenis Dokumen</center></th>
								<th><center>No. dan Tgl Dokumen</center></th>
								<th><center>Luas Tanah (m2)</center></th>
								<th><center>Atas Nama</center></th>
								<th><center>Berkas</center></th>
								<th><center>Izin Pemanfaatan</center></th>
								<th><center>Aksi</center></th>
							</tr>
						</thead>
						<tbody>
							<?php
							if ($DataTanah->num_rows() > 0) {
								$no = 1;
								foreach ($DataTanah->result() as $key) {
									if ($key->id_dokumen == '1') {
										$jenis_dokumen = "Sertifikat";
									} else if ($key->id_dokumen == '2') {
										$jenis_dokumen = "Akte Jual Beli";
									} else if ($key->id_dokumen == '3') {
										$jenis_dokumen = "Girik";
									} else if ($key->id_dokumen == '4') {
										$jenis_dokumen = "Petuk";
									} else {
										$jenis_dokumen = "Bukti Lain - Lain";
									} ?>
									<tr>
										<td align="center"> <?php echo $no++; ?></td>
										<td align="center"> <?php echo $jenis_dokumen; ?></td>
										<td align="center"> <?php echo $key->no_dok; ?><br><?php echo $key->tanggal_dok; ?></td>
										<td align="center"> <?php echo $key->luas_tanah; ?></td>
										<td align="center"> <?php echo $key->atas_nama_dok; ?></td>
										<td align="center"><a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/Konsultasi/' . $key->id . '/data_tanah/' . $key->dir_file); ?>')" class="btn default btn-xs blue-stripe">Lihat</a></td>
										<?php if ($key->dir_file_phat != "") { ?>
											<td align="center"><a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/Konsultasi/' . $key->id . '/data_tanah/' . $key->dir_file_phat); ?>')" class="btn default btn-xs blue-stripe">Lihat</a></td>
										<?php } else { ?>
											<td></td>
										<?php } ?>
										<?
											$cekik = "";
											if($key->status_verifikasi_tanah == '1')
											{
												$cekik = "checked";
											}
										 ?>
										<td align="center">
											<input type="checkbox" name="verifikasi_tanah_<?php echo $key->id_detail;?>" value="<?php echo $key->id_detail;?>" id="verifikasi_tanah_<?php echo $key->id_detail;?>" onchange="check_tanah('verifikasi_tanah_<?php echo $key->id_detail;?>','<?php echo $key->id_detail;?>')" <?=$cekik?>>
										</td>
									</tr>
							<?php }
							}
							?>
						</tbody>
					</table>
					<table id="sample_2" class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>Ketentuan Teknis Tanah</th>
								<th>Keterangan</th>
								<th>Berkas</th>
								<th>Verifikasi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$jns_syarat_sblm = '';
							$cek = '';
							$i= 1 ;
							foreach ($results_tnh as $row) {								
								if ($i % 2== 0 )
									$clss = "event";
								else
									$clss = "event2";	
								?>	
								<tr >
									<td align="center"><?php echo $i?></td>
										<?
										$detail = $row->id_jenis_persyaratan;
										$status = "";
										$query = $this->Mpengawas->getSyarat($row->id_detail,$this->uri->segment('3'))->result_array();
										for($n=0;$n<count($query);$n++) {
											$cek = $query[$n]['id_persyaratan_detail'];
											$dir = $query[$n]['dir_file'];
											$status = $query[$n]['status'];
											$ipk=$this->uri->segment('3');
										} ?>
									<td><?php echo $row->nm_dokumen;?></td>
									<td><?php echo $row->keterangan;?></td>
									<td align="center">
										<? if($row->id_detail == $cek){?>
											<? if($dir != ''){?>
												<a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/Konsultasi/'.$ipk.'/Dokumen/'.$dir);?>')" class="btn default btn-xs blue-stripe" >Lihat</a>
											<?php } else {?>
												[Tidak Ada Dokumen]
											<?php }?>
										<?php }?>	
									</td>
									<? $checked = "";
									if($status == '1')
									{
										$checked = "checked";
									} ?>
									<td align="center"><input type="checkbox" name="syarat_<?=$row->id_detail?>" value="<?=$row->id_detail?>" id="syarat_<?=$row->id_detail?>" onchange="check_status('syarat_<?=$row->id_detail?>','<?=$row->id_detail?>','adm')" <?=$checked?>></td>			  
								</tr>
								<?php
								$i++;
								$jns_syarat_sblm = $detail;
							} ?>          
						</tbody>
					</table>
				</div>
				<div class="tab-pane fade" id="tab_2_2">
					<?php include "FormDokAdm.php"; ?>
				</div>
				<div class="tab-pane fade" id="tab_2_3">
					<?php include "FormTeknis.php"; ?>
				</div>
				<div class="tab-pane fade" id="tab_2_4">
					<div class="form-group">
						<label class="control-label col-md-3">Status Persyaratan<span class="required">* </span></label>
						<div class="col-md-7">
							<?php $list_status = array(
								"" => "--Pilih--",
								"1" => "Lengkap",
								"2" => "Tidak Lengkap",
							);
							echo form_dropdown('id_izin', $list_status, isset($DataBangunan->id_izin) ? $DataBangunan->id_izin : '', 'class ="form-control" id="id_izin" onchange="getStatus(this.value)"');
							?>
						</div>
					</div>
					<br>
					<!--<div class="col-md-6 ">
						<input onchange="getStatus(this.value)" type="submit" value="Tidak Lengkap"  class="btn red btn-block">
					</div>
					<div class="col-md-6 ">
						<input id="xsleng" name="xsleng" type="submit" value="Lengkap"  class="btn blue btn-block"><br>
					</div>-->
					<table id="sample_1" class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>Status</th>
								<th>Nomor Surat</th>
								<th>Tanggal Surat</th>
								<th>Catatan</th>
								<th>Berkas</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if ($DataHis->num_rows() > 0) {
								$no = 1;
								foreach ($DataHis->result() as $key) {
							?>
									<tr>
										<td align="center"><?= $no; ?></td>
										<td align="center"><?= $key->status; ?></td>
										<td align="center"><?= $key->no_surat; ?></td>
										<td align="center"><?= $key->tgl_status; ?></td>
										<td align="center"><?= $key->catatan; ?></td>
										<td align="center"></td>
									</tr>
							<?php
									$no++;
								}
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</form>
<div class="modal-footer">
	<button type="button" onclick="return confirm('Yakin Ingin Keluar?')" data-dismiss="modal" class="btn red"> X Tutup</button>
</div>
<script type="text/javascript">
	$('#dir_file_pemberitahuan').change(function() {
		var filename_pemberitahuan = $(this).val();
		var lastIndex = filename_pemberitahuan.lastIndexOf("\\");
		if (lastIndex >= 0) {
			filename_pemberitahuan = filename_pemberitahuan.substring(lastIndex + 1);
		}
		$('#filename_pemberitahuan').val(filename_pemberitahuan);
	});

	function check_tanah(key, id) {
		if (document.getElementById(key).checked) {
			$.ajax({
				url: '<?php echo base_url('Pengawas/check_status_tanah/' . $this->uri->segment(3)) ?>/' + id + '/',
				type: 'POST',
				dataType: 'html',
				cache: false,
				success: function(response) {
					$('div#detail_personal').html('');
					$('div#detail_personal').html(response);
				}
			});
		} else {
			$.ajax({
				url: '<?php echo base_url('Pengawas/uncheck_status_tanah/' . $this->uri->segment(3)) ?>/' + id + '/',
				type: 'POST',
				dataType: 'html',
				cache: false,
				success: function(response) {
					$('div#detail_personal').html('');
					$('div#detail_personal').html(response);
				}
			});
		}
	}

	function popWin(x) {
		url = x;
		swin = window.open(url, 'win', 'scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
		swin.focus();
	}

	function check_status(key,id,ss) {
		//alert(key);
		if (document.getElementById(key).checked) {
			$.ajax({
				url: '<?php echo base_url('Pengawas/check_status/'.$this->uri->segment(3)) ?>/'+id+'/'+ss+'/',
				type: 'POST',
				dataType: 'html',
				cache: false,
				success: function(response) {
					$('div#detail_personal').html('');
					$('div#detail_personal').html(response);
				}
			});
		} else {
			$.ajax({
				url: '<?php echo base_url('Pengawas/uncheck_status/'.$this->uri->segment(3)) ?>/'+id+'/'+ss+'/',
				type: 'POST',
				dataType: 'html',
				cache: false,
				success: function(response) {
					$('div#detail_personal').html('');
					$('div#detail_personal').html(response);
				}
			});
		}
	}
	function batal() {
		location.reload();
	}
	function Save() {
		if ($('#status_syarat_1:checked').val() == 1) {
			$("#savestatussyarat").validate({
				rules: {
					status_syarat: "required",
				},
				highlight: function(element) {
					$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
				},
				unhighlight: function(element) {
					$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
				},
				errorClass: 'help-block',
				messages: {
					status_syarat: "Tentukan Status Syarat",
				},
				submitHandler: function(form) {
					form.submit();
				}
			});
		} else {
			$("#savestatussyarat").validate({
				rules: {
					status_syarat: "required",
					catatan: "required",
				},
				highlight: function(element) {
					$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
				},
				unhighlight: function(element) {
					$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
				},
				errorClass: 'help-block',
				messages: {
					status_syarat: "Tentukan Status Syarat",
					catatan: "Masukan Keterangan",
				},
				submitHandler: function(form) {
					form.submit();
				}
			});
		}
	}
</script>
