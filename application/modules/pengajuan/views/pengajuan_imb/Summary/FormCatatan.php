
		<input type="hidden" class="form-control" value="<?php echo set_value('id_permohonan', (isset($id_permohonan) ? $id_permohonan : ''))?>" name="id_permohonan" placeholder="id_permohonan" autocomplete="off">
		<input type="hidden" class="form-control" value="<?php echo set_value('id_jenis_permohonan', (isset($id_jenis_permohonan) ? $id_jenis_permohonan : ''))?>" name="Jenis Permohonan" placeholder="id_nama_permohonan" autocomplete="off">
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					Data Catatan
				</div>
			</div>
			<div class="portlet-body">
					<div class="table-scrollable"><table class="table table-striped table-hover table-bordered" id="sample_editable_1">
						<thead>
							<tr>
								<th><center>No.</center></th>
								<th><center>Tanggal</center></th>
								<th><center>Catatan</center></th>
								<th><center>File</center></th>				
							</tr>				
						</thead>
										<tbody>
										<?php
											if($catatan->num_rows() > 0)
											{
												$no = 1;
												foreach ($catatan->result() as $key) 
												{
											?>
													<tr>
														<td align="center"> <?php echo $no++;?></td>
														<td align="center"> <?php echo $key->tgl_pemberitahuan;?></td>
														<td> <?php echo $key->catatan;?></td>
														<td align="center">
															<a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/imb/pengajuan_imb/'.$key->id_permohonan.'/pemberitahuan_persyaratan/'.$key->dir_file_pemberitahuan);?>')" class="btn default btn-xs blue-stripe" >Lihat</a></td>
														</td>	
													</tr>
											<?php			
												}
											}
											?>
										</tbody>
									</table></div>
				</div>
			</div>


<script>
function Getot(id,f){
	url = "<?php echo base_url() . index_page() ?>file/imb/pengajuan_imb/"+id+"/"+"persyaratan/Administrasi"+"/"+f;
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
}
function popWin(x,y){
	//alert(x);
	url = x;
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
	}
</script>