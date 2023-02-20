<fieldset class="panel-form">
	<div class="row">
		<div class="col-md-12 ">										
			<div class="form-body">
				<div class="form-group">
					<label class="col-md-3 control-label">Kelengkapan Persyaratan</label>
					<div class="col-md-9">
							
					</div>
				</div>
			</div>	
		</div>
		<div class="col-md-12 ">										
			<div class="form-body">
				<div class="form-group">
					<label class="col-md-3 control-label">No. Surat Pemberitahuan</label>
					<div class="col-md-9">
					</div>
				</div>
			</div>	
		</div>
		<div class="col-md-12 ">										
			<div class="form-body">
				<div class="form-group">
					<label class="col-md-3 control-label">File Surat Pemberitahuan</label>
					<div class="col-md-9">
						<input class="form-control"  name="dir_file_pemberitahuan" id="dir_file_pemberitahuan" value='<?php echo set_value('dir_file_pemberitahuan', (isset($dir_file_pemberitahuan) ? $dir_file_pemberitahuan : ''))?>' onchange='cek()'>
						<input type="file" name="d_file" id="d_file" onchange='cek()'>
					</div>
				</div>
			</div>	
		</div>
	</div>
	<?php echo form_submit('save','Simpan');?>
	<table id="example1" class="table table-bordered table-striped table-hover">
		<tbody>
			<tr class="control-label">
				<th><center>No.</center></th>
				<th><center>Status</center></th>
				<th><center>Nomor Surat</center></th>
				<th><center>Tanggal Surat</center></th>
				<th><center>Dokumen Surat</center></th>
				<th><center>Kirim/Kirim Ulang<br>Email</center></th>
				<th><center>Edit</center></th>
				<th><center>Hapus</center></th>
			</tr>
			
		</tbody>
	</table>	
</fieldset>

<script>
function GetPdfStatus(id_bg,f){
	url = "<?php echo base_url() . index_page() ?>file/pemberitahuan/"+f;
	swin = window.open(url,'win','scrollbars,width=1200,height=800,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
}
</script>			

