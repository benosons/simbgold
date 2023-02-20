<div class="row">
	<div class="col-md-12">
		<?php echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '</div>' : ''; ?>
		<div class="table-scrollable">
			<table class="table table-bordered table-striped table-hover" id="sample_editable_1">
				<thead>
					<tr>
						<th>No</th>
						<th width="45%">Data Teknis Arsitektur</th>
						<th width="40%">Keterangan</th>
						<th width="15%">Berkas</th>
					</tr>
				</thead>
				<tbody>
					<?php if (!empty($DataArsitektur)) {
						$no = 1;
						foreach ($DataArsitektur->result() as $key) {
							if ($no % 2 == 0)
								$clss = "event";
							else
							$clss = "event2";
							$id_teknis 	= '';
							$dir_file		 	= '';
							$status_ver	='';
							if (!empty($DataTeknisArsitektur)) {
								foreach ($DataTeknisArsitektur->result() as $keyChild) {
									$file = $keyChild->dir_file;
									$status=$keyChild->status;
									$id_persyaratan_detail = $keyChild->id_persyaratan_detail;
									$status_verifikasi = $keyChild->status;
									$id_data_administrasi = $keyChild->id_detail;
									if ($key->id_detail == $id_persyaratan_detail) {
										$id_teknis = $id_data_administrasi;
										if ($file != '' or $file != null) {
											$dir_file = $file;
											$urut_file = $id_persyaratan_detail;
										}
										if ($status_verifikasi != '' or $status_verifikasi != null){
											$status_ver = $status_verifikasi;
											//$urut_file = $id_persyaratan_detail;
										}
									}
								}
								
							} ?>
							<tr class="<?= $clss ?>">
								<td align="center"><?php echo $no++; ?></td>
								<td align="left"><?php echo $key->nm_dokumen; ?></td>
								<td align="left"><?php echo $key->keterangan; ?></td>
								<td align="center">
								<?php echo form_open_multipart('Konsultasi/UploadPerbaikan/'.$id.'/'.$key->id_detail.'/2/'.$id_teknis,array('name'=>'frmup'.$no, 'id'=>'frmup'.$no)); ?>		
										<?php if ($status_ver !='1'){ ?>
											<?php if($dir_file == null)  {?>
												<input type="file" name="d_file" id="d_file" placeholder="Unggah Berkas Disini" accept="application/pdf" onchange="form.submit()">
											<?php } else { ?>
												<a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/Konsultasi/' . $id . '/Dokumen/' . $dir_file); ?>')" class="btn default btn-xs blue-stripe">Lihat</a>
												|
												<a href="<?php echo site_url('Konsultasi/DeleteTeknisRev/' . $id_teknis . '/tek/' . $id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ini?')" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a>
											<?php } ?>
										<?php } else if($dir_file == null){ ?>
										Tidak Ada Dokumen
										<?php } else{ ?>
										<a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/Konsultasi/' . $id . '/Dokumen/' . $dir_file); ?>')" class="btn default btn-xs blue-stripe">Lihat</a>
									
									<?php }?>
									<?php echo form_close(); ?>
								</td>
							</tr>
						<?php }
					} ?>
				</tbody>
			</table>
		</div>
		<?php if ($DataBangunan->id_jenis_permohonan !='3' && $DataBangunan->id_jenis_permohonan !='4' && $DataBangunan->id_jenis_permohonan !='5' && $DataBangunan->id_jenis_permohonan !='12' && $DataBangunan->id_jenis_permohonan !='21'){?>
			<div class="table-scrollable">
				<table id="data_administrasi" class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>No</th>
							<th width="45%">Data Teknis Struktur</th>
							<th width="40%">Keterangan</th>
							<th width="15%">Berkas</th>
						</tr>
					</thead>
					<tbody>
						<?php if (!empty($DataStruktur)) {
							$no = 1;
							foreach ($DataStruktur->result() as $key) {
								if ($no % 2 == 0)
									$clss = "event";
								else
								$clss = "event2";
								$id_teknis 	= '';
								$dir_file	= '';
								$status_ver	='';
								if (!empty($DataTeknisStruktur)) {
									foreach ($DataTeknisStruktur->result() as $keyChild) {
										$file = $keyChild->dir_file;
										$status=$keyChild->status;
										$id_persyaratan_detail = $keyChild->id_persyaratan_detail;
										$status_verifikasi = $keyChild->status;
										$id_data_administrasi = $keyChild->id_detail;
										if ($key->id_detail == $id_persyaratan_detail) {
											$id_teknis = $id_data_administrasi;
											if ($file != '' or $file != null) {
												$dir_file = $file;
												$urut_file = $id_persyaratan_detail;
											}
											if ($status_verifikasi != '' or $status_verifikasi != null){
												$status_ver = $status_verifikasi;
											}
										}
									}
								} ?>
								<tr class="<?= $clss ?>">
									<td align="center"><?php echo $no++; ?></td>
									<td align="left"><?php echo $key->nm_dokumen; ?></td>
									<td align="left"><?php echo $key->keterangan; ?></td>
									<td align="center">
										<?php echo form_open_multipart('Konsultasi/UploadPerbaikan/'.$id.'/'.$key->id_detail.'/3/'.$id_teknis,array('name'=>'frmup'.$no, 'id'=>'frmup'.$no)); ?>		
										<?php if ($status_ver !='1'){ ?>
											<?php if($dir_file == null)  {?>
												<input type="file" name="d_file" id="d_file" placeholder="Unggah Berkas Disini" accept="application/pdf" onchange="form.submit()">
											<?php } else { ?>
												<a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/Konsultasi/' . $id . '/Dokumen/' . $dir_file); ?>')" class="btn default btn-xs blue-stripe">Lihat</a>
												|
												<a href="<?php echo site_url('Konsultasi/DeleteTeknisRev/' . $id_teknis . '/tek/' . $id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ini?')" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a>
											<?php } ?>
										<?php } else if($dir_file == null){ ?>
										Tidak Ada Dokumen
										<?php } else{ ?>
										<a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/Konsultasi/' . $id . '/Dokumen/' . $dir_file); ?>')" class="btn default btn-xs blue-stripe">Lihat</a>
									
									<?php }?>
										<?php echo form_close(); ?>
									</td>
								</tr>
							<?php }
						} ?>
					</tbody>
				</table>
			</div>
		<?php } else { ?>
			
		<?php } ?>
	</div>
</div>
<!-- /.modal -->
<!-- /.modaledit -->
<div id="tanahnyaedit" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		</div>
	</div>
</div>
<script>
	function popWin(x) {
		url = x;
		swin = window.open(url, 'win', 'scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
		swin.focus();
	}
	function coktan() {

		$('#dir_file_tan').val(d_file_tan.value);
	}
	function cokphat() {

		$('#dir_file_phat').val(d_file_phat.value);
	}
</script>