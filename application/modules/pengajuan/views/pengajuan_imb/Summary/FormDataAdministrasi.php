<script type="text/javascript">

function Getot(id,f){
	url = "<?php echo base_url() . index_page() ?>file/imb/pengajuan_imb/"+id+"/"+"data_administrasi"+"/"+f;
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
}

</script>
<div class="row">
	<div class="col-md-12">
		<input type="hidden" class="form-control" value="<?php echo set_value('id_permohonan', (isset($id_permohonan) ? $id_permohonan : ''))?>" name="id_permohonan" placeholder="id_permohonan" autocomplete="off">
		<input type="hidden" class="form-control" value="<?php echo set_value('id_jenis_permohonan', (isset($id_jenis_permohonan) ? $id_jenis_permohonan : ''))?>" name="Jenis Permohonan" placeholder="id_nama_permohonan" autocomplete="off">
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					Data Kelengkapan Persyaratan Administrasi
				</div>
			</div>
			<div class="portlet-body">
				<table id="data_administrasi" class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Dokumen</th>
							<th>Berkas</th>
							<th>Perbaikan</th>
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
										<td align="center">		
											<? if($dir_file == '' or $dir_file == null){?>
												KOSONG	
												<?}else{?>	
													<a class="btn default btn-xs blue-stripe" onClick="javascript:Getot('<?php echo $id_permohonan;?>','<?php echo $dir_file; ?>')" src="<?php echo base_url()?>assets/images/pdf.gif" title='File Pdf' class='link' > 
														Lihat
													</a>
											<?}?>		
										</td>
										<td></td>
									</tr>
								<?php			
								}
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					Data Kelengkapan Persyaratan Teknis
				</div>
			</div>
			<div class="portlet-body">
				<table id="data_teknis" class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Dokumen</th>
							<th>Berkas</th>
							<th>Perbaikan</th>
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
																			$id_persyaratan_detail = $keyChild->id_persyaratan_detail;
																			$status_verifikasi = $keyChild->status;
																			$id_data_teknis = $keyChild->id_persyaratan_detail;
																			if($key->id_persyaratan_detail == $id_persyaratan_detail)
																			{
																				$id_data_teknis = $id_data_teknis;
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
															<td align="center">
																<? if($dir_file == '' or $dir_file == null){?>
																		KOSONG	
																	<? }else{?>
																	<center>
																		
																		<a class="btn default btn-xs blue-stripe" onClick="javascript:Getit('<?php echo $id_permohonan;?>','<?php echo $dir_file; ?>')" src="<?php echo base_url()?>assets/images/pdf.gif" title='File Pdf' class='link' > 
																		Lihat
																		</a>
																	</center>	
																<? }?>
																<?php echo form_close(); ?>
															</td>
															<td></td>
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
</div>
