<fieldset class="panel-form">
			<input name="id_status" value='<?php echo set_value('id_status', (isset($id_status) ? $id_status : ''))?>' id="id_status" type="hidden">
			<div class="row">
				<div class="col-md-12 ">										
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-3 control-label">Kelengkapan Persyaratan</label>
							<div class="col-md-9">
								<label class="radio-inline">
									<input type="radio" name="status_syarat" value="1" <?php if ($status_syarat=='1'){echo 'checked';}?>>Lengkap
								</label>
								<label class="radio-inline">
									<input type="radio" name="status_syarat" value="0" <?php if ($status_syarat=='0'){echo 'checked';}?>>Tidak Lengkap
								</label>
							</div>
						</div>
					</div>	
				</div>
				<div class="col-md-12 ">										
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-3 control-label">No. Surat Pemberitahuan</label>
							<div class="col-md-9">
								<input class="form-control" value="<?php echo set_value('no_surat_pemberitahuan', (isset($no_surat_pemberitahuan) ? $no_surat_pemberitahuan : ''))?>" name="no_surat_pemberitahuan" id="no_surat_pemberitahuan" placeholder="Nomor Surat" autocomplete="off">
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
			<?php echo form_submit('save','Simpan');	?>
					
					
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
				<?php
					if(isset($jumdata)==0){?>
						<tr>
							<td><label  class="control-label">Data Kosong</label></td>
						</tr>
					<?}else{
						$no= 1;
						for($i=0;$i<count($resultsted);$i++) {
							if ($i % 2== 0 )
							  $clss = "event";
							else
							  $clss = "event2";
							  
							if ($resultsted[$i]['status_syarat'] == 1){
								$status ="Lengkap";
							}else{
								$status ="Tidak Lengkap";
							}
				?>
				<tr class="<?=$clss?>" id="record">
					<td ><?php echo $no ?></td>
					<td ><?php echo $status ?></td>
					<td ><?php echo $resultsted[$i]['no_surat_pemberitahuan']; ?></td>
					<td ><?php echo $resultsted[$i]['tgl_pemberitahuan'];?></td>
					<td >
						<a href="javascript:void(0);" onClick="javascript:GetPdfStatus('<?php echo $resultsted[$i]['id_status']?>','<?php echo $resultsted[$i]['dir_file_pemberitahuan']?>')" >
						<?php 
							if($resultsted[$i]['dir_file_pemberitahuan'] != '' || $resultsted[$i]['dir_file_pemberitahuan'] != null)
							{	
								echo 'Download';
							}
						?>
						</a>
					</td>
					<td >
						<a href="javascript:void(0);">
							<div class="add" title="Kirim/Kirim Ulang" onclick="kirim_ulang_email_kelengkapan(<?php echo $resultsted[$i]['id_status']?>)">
							</div>
						</a>
					</td>
					<td >
						<a href="javascript:void(0);">
						<div class="edit" title="Ubah Data" id='id_status<?php echo $resultsted[$i]['id_status']?>' onclick="edit_data_status(<?php echo $resultsted[$i]['id_status']?>)" ></div>
						</a>
					</td>
					<td >
						<a href="javascript:void(0);">
						<div class="delete2" title="Hapus Data"  id='id_status<?php echo $resultsted[$i]['id_status']?>' onclick="del_status(<?php echo $resultsted[$i]['id_status']?>)" ></div>
				</a>
					</td>
				</tr>
				<?php  
					$no++;
					} 
				} 
				?>
				
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

