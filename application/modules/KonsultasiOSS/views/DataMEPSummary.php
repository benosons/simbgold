<div class="row">
	<div class="col-md-12">
		<?php echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '</div>' : ''; ?>
		<div class="table-scrollable">
			<table id="data_administrasi" class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>No</th>
						<th width="45%">Data Teknis Mekanikal, Elektrikal, dan Plambing</th>
						<th width="40%">Keterangan</th>
						<th width="15%">Berkas</th>
					</tr>
				</thead>
				<tbody>
					<?php if (!empty($DataMPE)) {
						$no = 1;
						foreach ($DataMPE->result() as $key) {
							if ($no % 2 == 0)
								$clss = "event";
							else
							$clss = "event2";
							$id_teknis 	= '';
							$dir_file		 	= '';
							if (!empty($DataTeknisMEP)) {
								foreach ($DataTeknisMEP->result() as $keyChild) {
									$file = $keyChild->dir_file;
									$id_persyaratan_detail = $keyChild->id_persyaratan_detail;
									$status_verifikasi = $keyChild->status;
									$id_data_administrasi = $keyChild->id_detail;
									if ($key->id_detail == $id_persyaratan_detail) {
										$id_teknis = $id_data_administrasi;
										if ($file != '' or $file != null) {
											$dir_file = $file;
											$urut_file = $id_persyaratan_detail;
										}
									}
								}
							} ?>
							<tr class="<?= $clss ?>">
								<td align="center"><?php echo $no++; ?></td>
								<td align="left"><?php echo $key->nm_dokumen; ?></td>
								<td align="left"><?php echo $key->keterangan; ?></td>
								<td align="center">
									<?php echo form_open_multipart('Konsultasi/SaveDokumen/' . $id . '/' . $key->id_detail . '/4/' . $id_teknis, array('name' => 'frmup' . $no, 'id' => 'frmup' . $no)); ?>
									<?php if ($dir_file == '' or $dir_file == null) { ?>
										<input type="file" name="d_file" id="d_file" placeholder="Unggah Berkas Disini" accept="application/pdf" onchange="form.submit()">
									<?php } else { ?>
										<center>						
											<a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/Konsultasi/' . $id . '/Dokumen/' . $dir_file); ?>')" class="btn default btn-xs blue-stripe">Lihat</a>
											|
											<a href="<?php echo site_url('Konsultasi/removeDataPersyaratan/' . $id_teknis . '/tek/' . $id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ini?')" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a>
										</center>
									<?php } ?>
									<?php echo form_close(); ?>
								</td>
							</tr>
						<?php }
					} ?>
				</tbody>
			</table>
		</div>
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