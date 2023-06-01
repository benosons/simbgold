<div class="row">
	<div class="col-md-12">
		<?php echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '</div>' : ''; ?>
		<div class="portlet light bordered margin-top-20">
			<div class="portlet-body">
				<div class="table-scrollable">
					<table class="table table-bordered table-striped table-hover" id="sample_editable_1">
						<thead>
							<tr class="warning">
								<th width="10%"><center>No.</center></th>
								<th width="20%"><center>Tgl. Verifikasi</center></th>
								<th width="50%"><center>Catatan</center></th>
								<th width="20%"><center>Berkas</center></th>
							</tr>
						</thead>
						<tbody>
							<?php if ($DataInformasi->num_rows() > 0) {
								$no = 1;
								foreach ($DataInformasi->result() as $key) { ?>
									<tr>
										<td align="center"> <?php echo $no++; ?></td>
										<td align="center"> <?php echo $key->tgl_status; ?></td>
										<td align="left"> <?php echo $key->catatan; ?></td>
										<td align="center">
                                            <?php if($key->dir_file !='' && $key->dir_file !=null) { ?>
                                                <a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/Konsultasi/' . $key->id . '/' . $key->dir_file); ?>')" class="btn default btn-xs blue-stripe">Lihat</a>
                                            <?php } else { ?>
                                                Tidak Ada Dokumen
                                            <?php } ?>
                                        </td>
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
</script>