<script type="text/javascript">
function Getot(id,f){
	url = "<?php echo base_url() . index_page() ?>file/imb/pengajuan_imb/"+id+"/"+"data_administrasi"+"/"+f;
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
}

function GetFileAdm(id,f){
	url = "<?php echo base_url() . index_page() ?>file/imb/pengajuan_imb/"+id+"/"+"data_administrasi"+"/"+f;
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
}

function Getut(id,f){
	url = "<?php echo base_url() . index_page() ?>file/imb/pengajuan_imb/"+id+"/"+"data_teknis"+"/"+f;
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
}
</script>

		<input type="hidden" class="form-control" value="<?php echo set_value('id_permohonan', (isset($id_permohonan) ? $id_permohonan : ''))?>" name="id_permohonan" placeholder="id_permohonan" autocomplete="off">
		<input type="hidden" class="form-control" value="<?php echo set_value('id_jenis_permohonan', (isset($id_jenis_permohonan) ? $id_jenis_permohonan : ''))?>" name="Jenis Permohonan" placeholder="id_nama_permohonan" autocomplete="off">
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					Data Kelengkapan Persyaratan Administrasi
				</div>
			</div>
			<div class="portlet-body">
				<div class="table-scrollable"><table id="data_administrasi" class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Dokumen</th>
							<th>Berkas</th>
							<?php if (trim($status_progress) == 2){?>
							<th>Catatan</th>
							<?}else{?>
						
							<?}?>
						</tr>
					</thead>
					<tbody>
						<?php
							if(!empty($MasterAdministrasi)){
								$no = 1;
								foreach ($MasterAdministrasi->result() as $key) {
									if ($no % 2 == 0 )
										$clss = "event";
										else
										$clss = "event2";		
														$id_administrasi 	= '';
														$dir_file		 	= '';
														$sesat = '';
													if(!empty($DataAdministrasi))
													{
														foreach ($DataAdministrasi->result() as $keyChild) 
														{
															$file = $keyChild->dir_file;
															$id_persyaratan_detail = $keyChild->id_persyaratan_detail;
															$status_verifikasi = $keyChild->status;
															$id_data_administrasi = $keyChild->id_perhomonan_bg_syarat;
															if($key->id_persyaratan_detail == $id_persyaratan_detail)
															{
																$id_administrasi = $id_data_administrasi;
																$sesat = $status_verifikasi;
																if($file != '' or $file != null){
																	$dir_file = $file;
																	$urut_file = $id_persyaratan_detail;
																}
															}
														}
													}
												?>
									<tr class="<?=$clss?>" >
										<td align="center"><?php echo $no++;?></td>
										<td align="left"><?php echo $key->nama_syarat;?></td>
										<?php if (trim($status_progress) == 2){?>
										<td align="center" width="10%">		
										<?php echo form_open_multipart('pengajuan/persyaratan_submitadmrev/'.$id_permohonan.'/'.$key->id_persyaratan_detail.'/1/'.$id_administrasi,array('name'=>'frmup'.$no, 'id'=>'frmup'.$no)); ?>
											<? if($dir_file == '' or $dir_file == null){?>
												<? if(trim($sesat) != 1){?>
													<input type="file" name="d_file" id="d_file" placeholder="Unggah Berkas Disini" accept="application/pdf" onchange="form.submit()">	
													<? }else{?>
														TERVERIFIKASI
													<? }?>
											<? }else{?>
												<a class="btn default btn-xs blue-stripe" onClick="javascript:GetFileAdm('<?php echo $id_permohonan;?>','<?php echo $dir_file; ?>')" src="<?php echo base_url()?>assets/images/pdf.gif" title='File Pdf' class='link' > 
												Lihat</a>| 
												<a href="<?php echo site_url('pengajuan/removeDataPersyaratanrev/'.$id_administrasi.'/adm/'.$id_permohonan);?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ini?')" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a>
											<? }?>
										<?php echo form_close(); ?>
										</td>
										<td>
											<? if(trim($sesat) != 1){?>
											Berkas Belum Diunggah
											<? }else{?>
											TERVERIFIKASI
											<?}?>
										</td>
										<?}else{?>
										<td align="center" width="10%"> 
											<? if($dir_file == '' or $dir_file == null){?>
												KOSONG	
											<?}else{?>
											<center>
												<a class="btn default btn-xs blue-stripe" onClick="javascript:GetFileAdm('<?php echo $id_permohonan;?>','<?php echo $dir_file; ?>')" src="<?php echo base_url()?>assets/images/pdf.gif" title='File Pdf' class='link' > 
												Lihat
												</a>
											</center>	
										<? }?>
											<?php echo form_close(); ?>
										</td>
										<?}?>
									</tr>
								<?php			
								}
							}
						?>
					</tbody>
				</table></div>
			</div>
		</div>
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					Data Kelengkapan Persyaratan Teknis
				</div>
			</div>
			<div class="portlet-body">
				<div class="table-scrollable"><table id="data_teknis" class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Dokumen</th>
							<th>Berkas</th>
							<?php if (trim($status_progress) == 2){?>
							<th>Catatan</th>
							<?}else{?>
						
							<?}?>
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
															$sesat = '';
															if(!empty($DataTeknis)){
																if(!empty($DataTeknis)){
																		foreach ($DataTeknis->result() as $keyChild) {
																			$file = $keyChild->dir_file;
																			$id_persyaratan_detail = $keyChild->id_persyaratan_detail;
																			$status_verifikasi = $keyChild->status;
																			//$id_data_teknis = $keyChild->id_persyaratan_detail;
																			$id_data_teknis = $keyChild->id_perhomonan_bg_syarat;
																			if($key->id_persyaratan_detail == $id_persyaratan_detail)
																			{
																				$id_teknis = $id_data_teknis;
																				$sesat = $status_verifikasi;
																				if($file != '' or $file != null){
																					$dir_file = $file;
																					$urut_file = $id_persyaratan_detail;
																					
																				}
																			}
																		}
																	}	
																}
																?>
														<tr class="<?=$clss?>" >
															<td align="center"><?php echo $no++;?></td>
															<td align="left"><?php echo $key->nama_syarat;?></td>
															<?php if (trim($status_progress) == 2){?>
															<td align="center" width="10%">
																<?php echo form_open_multipart('pengajuan/persyaratan_submitrev/'.$id_permohonan.'/'.$key->id_persyaratan_detail.'/2/'.$id_administrasi,array('name'=>'frmup'.$no, 'id'=>'frmup'.$no)); ?>
																	<? if($dir_file == '' or $dir_file == null){?>
																	<? if(trim($sesat) != 1){?>
																<input type="file" name="d_file" id="d_file" onchange="form.submit()" accept="application/pdf">	
																<? }else{?>
																TERVERIFIKASI
																<? }?>
																			
																	<?}else{?>
																	
																		<a class="btn default btn-xs blue-stripe" onClick="javascript:Getut('<?php echo $id_permohonan;?>','<?php echo $dir_file; ?>')" src="<?php echo base_url()?>assets/images/pdf.gif" title='File Pdf' class='link' > 
																		Lihat 
																		</a>
																		| 
																		<a href="<?php echo site_url('pengajuan/removeDataPersyaratanrev/'.$id_teknis.'/2/'.$id_permohonan);?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ini?')" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a>
																		
																<? }?>
																<?php echo form_close(); ?>
															</td>
															
															<td>
																<? if(trim($sesat) != 1){?>
																Berkas Belum Diunggah
																<? }else{?>
																TERVERIFIKASI
																<? }?>
															</td>
															<?}else{?>
															<td align="center" width="10%"> 
																<? if($dir_file == '' or $dir_file == null){?>
																		KOSONG	
																	<? }else{?>
																	<center>
																		
																		<a class="btn default btn-xs blue-stripe" onClick="javascript:Getut('<?php echo $id_permohonan;?>','<?php echo $dir_file; ?>')" src="<?php echo base_url()?>assets/images/pdf.gif" title='File Pdf' class='link' > 
																		Lihat
																		</a>
																	</center>	
																<? }?>
																<?php echo form_close(); ?>
															</td>
															<?}?>
														</tr>
													<?php			
													//$no++;
													}
												}
											?>
					</tbody>
				</table></div>
			</div>
		</div>

<?php if (trim($status_progress) == 2){?>
<button class="col-md-12 btn blue" onClick="window.location.href = '<?php echo base_url();?>Pengajuan/simpanperbaikan/<?php echo $id_permohonan;?>';return false;">Simpan Perbaikan</button>
<hr>
<?}else{?>
						
<?}?>