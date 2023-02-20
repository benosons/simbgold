<form action="status_dt_teknis" class="form-horizontal" role="form" method="post" id="savestatussyarat" name="savestatussyarat" enctype="multipart/form-data">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 align="center" class="modal-title"><b>Data Pokok Permohonan <?php echo $data->no_konsultasi; ?></b></h4>
	</div>
	<input type="hidden" name="id_pemilik" value="<?php echo $data->id; ?>">
	<input type="hidden" name="email" value="<?php echo $data->email; ?>">
	<input type="hidden" name="no_konsultasi" value="<?php echo $data->no_konsultasi; ?>">
	<div class="modal-body">
		<div class="row static-info">
			<div class="col-md-3 name">Nama Lengkap Pemilik</div>
			<div class="col-md-8 value">
				<?= (isset($data->glr_depan) ? $data->glr_depan : ''); ?>
				<?= (isset($data->nm_pemilik) ? $data->nm_pemilik : ''); ?>
				<?= (isset($data->glr_belakang) ? $data->glr_belakang : ''); ?>
			</div>
		</div>
		<div class="row static-info">
			<div class="col-md-3 name">Alamat Pemilik Bangunan</div>
			<div class="col-md-8 value">
				<?= (isset($data->alamat) ? $data->alamat : ''); ?>, Kel. <?= (isset($data->nama_kelurahan) ? $data->nama_kelurahan : ''); ?>, Kec. <?= (isset($data->nama_kecamatan) ? $data->nama_kecamatan : ''); ?>,
				<?= (isset($data->nama_kabkota) ? $data->nama_kabkota : ''); ?>, Prov. <?= (isset($data->nama_provinsi) ? $data->nama_provinsi : ''); ?>
			</div>
		</div>
		<div class="row static-info">
			<div class="col-md-3 name">No. Telepon</div>
			<div class="col-md-8 value"><?= (isset($data->no_hp) ? $data->no_hp : ''); ?></div>
		</div>
		<div class="row static-info">
			<div class="col-md-3 name">E-mail</div>
			<div class="col-md-8 value"><?= (isset($data->email) ? $data->email : ''); ?></div>
		</div>
		<div class="row static-info">
			<div class="col-md-3 name">Lokasi Bangunan</div>
			<div class="col-md-8 value">
				<?= (isset($Bangunan->almt_bgn) ? $Bangunan->almt_bgn : ''); ?>, Kel. <?= (isset($Bangunan->nama_kelurahan) ? $Bangunan->nama_kelurahan : ''); ?>, Kec. <?= (isset($bangunan->nama_kecamatan) ? $bangunan->nama_kecamatan : ''); ?>,
				<?= (isset($Bangunan->nama_kabkota) ? $Bangunan->nama_kabkota : ''); ?>, Prov. <?= (isset($Bangunan->nama_provinsi) ? $Bangunan->nama_provinsi : ''); ?>
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
				<?php if ($data->id_jenis_permohonan !='3' && $data->id_jenis_permohonan !='4' && $data->id_jenis_permohonan !='5'){?>
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
							<?php if ($DataTanah->num_rows() > 0) {
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
											<?php $cekik = "";
											if($key->status_verifikasi_tanah == '1') {
												$cekik = "checked";
											} ?>
										<td align="center">
											<input type="checkbox" name="verifikasi_tanah_<?php echo $key->id_detail;?>" value="<?php echo $key->id_detail;?>" id="verifikasi_tanah_<?php echo $key->id_detail;?>" onchange="check_tanah('verifikasi_tanah_<?php echo $key->id_detail;?>','<?php echo $key->id_detail;?>')" <?=$cekik?>>
										</td>
									</tr>
								<?php }
							} ?>
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
										<?php $detail = $row->id_jenis_persyaratan;
											$status = "";
											$query = $this->Mteknis->getSyarat($row->id_detail,$this->uri->segment('3'))->result_array();
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
									if($status == '1') {
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
					<div class="col-md-12 ">
						<div class="form-body">
							<div class="form-group">
								<label class="col-md-3 control-label">Kelengkapan Ketentuan Teknis</label>

								<div class="col-md-9">
									<label class="radio-inline">
										<input type="radio" name="status_syarat" id="status_syarat_1" value="1">Lengkap
										<br>
										<input type="radio" name="status_syarat" id="status_syarat_2" value="2">Tidak Lengkap
									</label>
								</div>
							</div>
							<div class="form-group" type="hidden">
								<label class="col-md-3 control-label">No. Surat Pemberitahuan</label>
								<div class="col-md-9">
									<input class="form-control" name="no_surat_pemberitahuan" id="no_surat_pemberitahuan" placeholder="Nomor Surat">
								</div>
							</div>
							<div class="form-group" type="hidden">
								<label class="col-md-3 control-label">Surat Pemberitahuan</label>
								<div class="col-md-9">
									<span class="btn grey-cascade fileinput-button">
										<input type="file" name="dir_file_pemberitahuan" id="dir_file_pemberitahuan">
										<input type="text" name="filename_pemberitahuan" id="filename_pemberitahuan" style="display: none;">
									</span>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Catatan</label>
								<div class="col-md-9">
									<textarea class="form-control" name="catatan" id="catatan" placeholder="Keterangan"></textarea>
								</div>
							</div>
							<!-- </div> -->
							<div class="form-group">
								<input id="xstin" name="xstin" onClick="Xtin()" type="submit" value="Simpan" class="btn blue-hoki btn-block">
							</div>
						</div>
					</div>
					<br>
					<table id="sample_1" class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>Status</th>
								<th>No. Surat</th>
								<th>Tgl Surat</th>
								<th>Catatan</th>
								<th>Berkas</th>
							</tr>
						</thead>
						<tbody>
							<?php if ($DataHis->num_rows() > 0) {
								$no = 1;
								foreach ($DataHis->result() as $key) { ?>
									<tr>
										<td align="center"><?= $no; ?></td>
										<td align="center"><?= $key->status; ?></td>
										<td align="center"><?= $key->no_surat; ?></td>
										<td align="center"><?= $key->tgl_status; ?></td>
										<td align="center"><?= $key->catatan; ?></td>
										<td align="center"></td>
									</tr>
								<?php $no++; }
							} ?>
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
				url: '<?php echo base_url('Teknis/check_status_tanah/' . $this->uri->segment(3)) ?>/' + id + '/',
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
				url: '<?php echo base_url('Teknis/uncheck_status_tanah/' . $this->uri->segment(3)) ?>/' + id + '/',
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
				url: '<?php echo base_url('Teknis/check_status/'.$this->uri->segment(3)) ?>/'+id+'/'+ss+'/',
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
				url: '<?php echo base_url('Teknis/uncheck_status/'.$this->uri->segment(3)) ?>/'+id+'/'+ss+'/',
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
	function Xtin() {
		if ($('#status_syarat_1:checked').val() == 1) {
			$("#savestatussyarat").validate({
				// Specify the validation rules
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
				// Specify the validation error messages
				messages: {
					status_syarat: "Tentukan Status Syarat",
				},
				submitHandler: function(form) {
					form.submit();
				}
			});
		} else {
			$("#savestatussyarat").validate({
				// Specify the validation rules
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
				// Specify the validation error messages
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
