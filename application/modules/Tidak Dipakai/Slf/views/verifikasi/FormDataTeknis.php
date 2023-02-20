<script type="text/javascript">

function getFile(v){
	alert(v);
}

</script>
<div class="page-container">
	<div class="page-content">
		<div class="container">
			<div class="row">
				<div class="portlet box blue">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-gift"></i>Data Permohonan
						</div>
					</div>
					<div class="portlet box blue">
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form class="form-horizontal" role="form">
								<div class="form-body">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-5">Nama Permohonan :</label>
												<div class="col-md-7">
													<p class="form-control-static">
														
													</p>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-5">Nama Pemilik :</label>
												<div class="col-md-6">
													<p class="form-control-static">
														
													</p>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-5">Alamat Bangunan Gedung :</label>
												<div class="col-md-7">
													<p class="form-control-static">
													</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</form>
							<input type="hidden" class="form-control" value="<?php echo set_value('id', (isset($id) ? $id : ''))?>" name="id" placeholder="id_permohonan" autocomplete="off">
							<div class="portlet box blue-hoki">
								<div class="portlet-title">
									<div class="caption">
										Data Kelengkapan Persyaratan Teknis
									</div>
								</div>
							</div>
								<div class="portlet-body">
									<table id="data_administrasi" class="table table-bordered table-striped table-hover">
										<thead>
											<tr>
												<th>No</th>
												<th align="center">Nama Dokumen</th>
												<th align="center">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
												if(!empty($MasterTeknis))
												{
													$no = 1;
													foreach ($MasterTeknis->result() as $key) {
														if ($no % 2 == 0 )
															$clss = "event";
														else
															$clss = "event2";		
															$id_data_teknis 	= '';
															$dir_file		 	= '';
															$id_administrasi 	= '';
															if(!empty($DataTeknis)){
																if(!empty($DataTeknis)){
																		foreach ($DataTeknis->result() as $keyChild) {
																			$file = $keyChild->dir_file;
																			$id_dokumen_permohonan = $keyChild->id_dokumen_permohonan;
																			$status_verifikasi = $keyChild->verifikasi;
																			$id_data_teknis = $keyChild->id;
																			if($key->id_syarat_slf == $id_dokumen_permohonan)
																			{
																				$id_data_teknis = $id_data_teknis;
																				if($file != '' or $file != null){
																					$dir_file = $file;
																					$urut_file = $id_dokumen_permohonan;
																				}
																			}
																		}
																	}	
																}
																?>
														<tr class="<?=$clss?>" >
															<td align="center"><?php echo $no++;?></td>
															<td align="left"><?php echo $key->nama_syarat_slf;?></td>
															<td align="center">
																<div class="fileinput fileinput-new" data-provides="fileinput">
																	<div class="input-group input-large">
																		<div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
																			<i class="fa fa-file fileinput-exists"></i>&nbsp; <span class="fileinput-filename">
																			</span>
																		</div>
																		<span class="input-group-addon btn default btn-file">
																			<span class="fileinput-new">Pilih File</span>
																			<span class="fileinput-exists">Ganti </span>
																			<input type="file" name="...">
																		</span>
																		<a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput">Hapus </a>
																	</div>
																</div>
															
															
																<?php echo form_open_multipart('pengajuan/persyaratan_submit_slf/'.$id.'/'.$key->id_syarat_slf.'/2/'.$id_administrasi,array('name'=>'frmup'.$no, 'id'=>'frmup'.$no)); ?>
																	<?
																	if($key->id_syarat_slf == '14'){
																		if ($DataSummary['id_kelaikan_fungsi'] == '1'){?>
																			<center>
																				<?
																				$surat_pernyataan = '';
																				if($DataSummary['dir_file_dokumen'] != '')
																				{
																					$surat_pernyataan = explode('\\',$DataSummary['dir_file_dokumen']);
																					$surat_pernyataan = (isset($surat_pernyataan[2]) ? $surat_pernyataan[2] : '');
																				}
																					?>
																				<a href="javascript:void(0);" onClick="javascript:GetDokumenPdf('<?php echo $id;?>','<?php echo $surat_pernyataan; ?>')" >
																					<?php echo 'Download'; ?>
																				</a>
																			</center>
																			<?}else if($dir_file == '' or $dir_file == null){?>
																				<input type="file" name="d_file" id="d_file">
																				<input id="upload"type="submit" name="save" value="Upload" >
																			<?}?>
																	<?}else if($key->id_syarat_slf == '1000'){
																		if ($DataSummary['id_status_imb'] == '1'){?>
																			<center>
																				<a href="javascript:void(0);" onClick="javascript:GetPdf('<?php echo $id;?>','<?php echo $dir_file; ?>')" >
																					<?php echo 'Download'; ?>
																				</a>
																			</center>
																			<?}else if($dir_file == '' or $dir_file == null){?>
																				<input type="file" name="d_file" id="d_file">
																				<input id="upload"type="submit" name="save" value="Upload" >
																			<?}?>
																		<?}else if($dir_file == '' or $dir_file == null){?>
																				<input type="file" name="d_file" id="d_file">
																				<input id="upload"type="submit" name="save" value="Upload" >
																				<?}else{?>
																					<center>	
																					<a href="javascript:void(0);" onClick="javascript:GetPdf('<?php echo $id;?>','<?php echo $dir_file; ?>')" >
																						<?php echo 'Download'; ?>
																					</a>
																					| 
																					
																					<a href="javascript:void(0);" onClick="javascript:del_up('<?php echo $urut_file; ?>','<?php echo $no; ?>')" >
																					<?php echo 'Delete'; ?>
																					</a>
																				</center>
																			<?}?>
																	<?php echo form_close(); ?>
																</td>
															</tr>
													<?php			
													//$no++;
													}
												}
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<span class="input-group-btn">
						</span>
						<span class="input-group-btn">
						</span>
						<span class="input-group-btn">
						<button class="btn green" onClick="window.location.href = '<?php echo base_url();?>Pengajuan/FormAdministrasiSLF/<?php echo $id;?>';return false;">Kembali</button>
						</span>
						<span class="input-group-btn">
						</span>
						<span class="input-group-btn">
						</span>
						<span class="input-group-btn">
						</span>
						<span class="input-group-btn">
						</span>
						<span class="input-group-btn">
						</span>
						<span class="input-group-btn">
						</span>
						<span class="input-group-btn">
						</span>
						<span class="input-group-btn">
						</span>
						<span class="input-group-btn">
						</span>
						<span class="input-group-btn">
						</span>
						<span class="input-group-btn">
						</span>
						<span class="input-group-btn">
						</span>
						<span class="input-group-btn">
						</span>
						<span class="input-group-btn">
						</span>
						<span class="input-group-btn">
							<button class="btn green" onClick="window.location.href = '<?php echo base_url();?>pengajuan/FormKonfirmasi/<?php echo $id;?>';return false;">Next</button>
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
var pengajuan_id 		= document.getElementsByName("pengajuan_id")[0].value;
var id_nama_permohonan	= document.getElementsByName("id_nama_permohonan")[0].value;

$(function () {
	jQuery.post(base_url+'pengajuan/listDataAdministrasi',{value:pengajuan_id,value2:id_nama_permohonan},function(data){	
			jQuery('#data_administrasi').append(data);
			
	});
}); 

</script>