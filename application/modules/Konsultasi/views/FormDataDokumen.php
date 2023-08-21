<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">Data Pengajuan Konsultasi</div>
			</div>
			<?php $this->load->view('HeaderData') ?>
			<div class="portlet-title">
				<div class="caption">Data Kelengkapan</div>
			</div>
			<?php echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-'.$this->session->flashdata('status').'">'.$this->session->flashdata('message').'</div>' : ''; ?>
			<div class="table-scrollable">
				<table id="data_administrasi" class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>No</th>
							<th width="45%">Data Umum</th>
							<th width="45%">Keterangan</th>
							<th width="10%">Berkas</th>
						</tr>
					</thead>
					<tbody>
						<?php if (!empty($DokumenUmum)) {
							$no = 1;
							foreach ($DokumenUmum->result() as $key) {
								if ($no % 2 == 0)
								$clss = "event";
									else
								$clss = "event2";
								$id_administrasi 	= '';
								$dir_file		 	= '';
								if (!empty($DataUmum)) {
									foreach ($DataUmum->result() as $keyChild) {
										$file = $keyChild->dir_file;
										$id_persyaratan_detail = $keyChild->id_persyaratan_detail;
										$status_verifikasi = $keyChild->status;
										$id_data_administrasi = $keyChild->id_detail;
										if ($key->id_detail == $id_persyaratan_detail) {
											$id_administrasi = $id_data_administrasi;
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
										<?php echo form_open_multipart('Konsultasi/SaveDokumen/' . $id . '/' . $key->id_detail . '/5/' . $id_administrasi, array('name' => 'frmup' . $no, 'id' => 'frmup' . $no)); ?>
										<?php if ($dir_file == '' or $dir_file == null) { ?>
												<input type="file" name="d_file" id="d_file" placeholder="Unggah Berkas Disini" accept="application/pdf" onchange="showDiv();form.submit()">
											<?php } else {
												$filename = FCPATH . "/object-storage/dekill/Requirement/$dir_file";
												$dir = '';
												if (file_exists($filename)) {
													$dir = './object-storage/dekill/Requirement/' . $dir_file;
												} else {
													$dir = './object-storage/file/Konsultasi/' . $id . '/Dokumen/' . $dir_file;
												}
												$dir1	= $this->Outh_model->Encryptor('encrypt', $dir);
											
											?>
												<center>
													<a href="#PDFViewer" role="button" class="open-PDFViewer btn default btn-xs blue-stripe" data-toggle="modal" data-id="<?php echo site_url('Docreader/ReaderDok/' . $dir1); ?>">Lihat</a>
													<a href="<?php echo site_url('Konsultasi/DeleteAdministrasi/' . $id_administrasi . '/tek/' . $id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ini?')" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a>
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
			<center>
				<span class="input-group-btn">
					<button class="btn green" onClick="window.location.href = '<?php echo base_url();?>Konsultasi/FormDataTanah/<?php echo $id;?>';return false;">Kembali</button>
				</span>				
				<span class="input-group-btn">
					<button class="btn green" onClick="window.location.href = '<?php echo base_url();?>Konsultasi/FormDataTeknis/<?php echo $id;?>';return false;">Selanjutnya</button>
				</span>
			</center>
			<br>
		</div>				
	</div>
</div>				
<!-- /.modal -->
<!-- /.modalloader (bisa dipindahkan ke View Utama) -->
<div id="loadertot" class="modal fade" tabindex="-1" data-width="auto" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<center> <img src="https://icon-library.com/images/ajax-loading-icon/ajax-loading-icon-2.jpg"> </center>
</div>

<div id="PDFViewer" class="modal fade" aria-hidden="true" data-width="55%">
	<div class="modal-body">
		<div>
			<embed id="pdfdataid" src="" frameborder="1" width="100%" height="750px">
		</div>
	</div>
</div>
<script>
$(document).on("click",".open-PDFViewer", function(){
		var datapdf = $(this).data("id");
		$(".modal-body #pdfdataid").attr("src", datapdf);
		
	});
	
//loader (bisa dipindahkan ke View Utama)
function showDiv() {
	$('#loadertot').modal('show');
}
function popWin(x){
	url = x;
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
	}
function set_status_izin_pemanfaatan(v)
{
	if(v == '1'){
		document.getElementById('izinjing').style.display="block";
	}else{
		document.getElementById('izinjing').style.display="none";
	}
}
</script>



