<table id="sample_2" class="table table-bordered table-striped table-hover">
    <thead>
	    <tr>
	        <th>No</th>
	        <th>Nama Dokumen</th>
			<th>Berkas</th>
	       
			<th>Verifikasi</th>
			
	    </tr>
    </thead>
    <tbody>
		<?php
		$tarot = $this->uri->segment('3');
							if(!empty($MasterTeknis)){
								$no = 1;
								foreach ($MasterTeknis->result() as $key) {
									if ($no % 2 == 0 )
										$clss = "event";
									else
										$clss = "event2";
									
									$setValChild 	= '';
									$dir_file = "";
									$id_dokumen_permohonan = "";
									if(!empty($DataTeknis)){
										foreach ($DataTeknis->result() as $keyChild) 
										{
											$file = $keyChild->dir_file;
											$id_dokumen_permohonan = $keyChild->id_dokumen_permohonan;
											$status_verifikasi = $keyChild->verifikasi;
											$id_data_teknis = $keyChild->id;
											if($key->id_syarat == $id_dokumen_permohonan)
											{
												if($status_verifikasi == '1'){
													$setValChild = 'checked';
												}
												$id_data_teknis = $id_data_teknis;
												if($file != '' or $file != null){
													$dir_file = $file;
												}
											}
										}
									}
									
						?>
						<tr class="<?=$clss?>" >
							<td align="center"><?php echo $no++;?></td>
							<td ><?php echo $key->nama_syarat;?> </td>
							<td align="center">
								<!-- Download jika memiliki Dokumen IMB dari upload di pendaftaran -->
								<?
									if($key->id_syarat == '14'){
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
											<a href="javascript:void(0);" onClick="javascript:GetPdfPernyataanTeknis('<?php echo $tarot;?>','<?php echo $surat_pernyataan; ?>')" >
											<?php echo 'Download' ?>
										</a>
										</center>
									<?}?>
									<?}
									if($key->id_syarat == '1000') {
										if($DataSummary['id_permohonan'] != '0'){?>
											<center>	
												<a href="javascript:void(0);" onClick="javascript:GetPdfLap('<?php echo $DataSummary['id_permohonan'] ?>','<?php echo $DataSummary['dir_file_imb'] ?>')" >
													<?php echo 'Download' ?>
												</a>
											</center>
										<?}else if ($dir_file != ''){?>
											<center>	
												<a href="javascript:void(0);" onClick="javascript:GetPdfTeknisSLF('<?php echo $tarot;?>','<?php echo $key->id_syarat;?>','<?php echo $dir_file;?>')" >
													<?php echo 'Download' ?>
												</a>
											</center>
										<?}else{?>
											<center>
												<?php echo 'Tidak Ada File' ?>
											</center>
										<?}?>
									<?}else if($dir_file !=''){?>
									<center>	
										<a href="javascript:void(0);" onClick="javascript:GetPdfTeknisSLF('<?php echo $tarot;?>','<?php echo $key->id_syarat;?>','<?php echo $dir_file;?>')" >
											<?php echo 'Lihat' ?>
										</a>
									</center>
									<?}else{?>
										<center>
											<?php echo 'Tidak Ada File' ?>
										</center>
									<?}?>
							</td>
							<td>
								<center>
									<input type="checkbox" name="syarat_<?=$key->id_syarat?>" value="<?=$key->id_syarat?>" id="syarat_<?=$key->id_syarat?>" onchange="check_status_slf('syarat_<?=$key->id_syarat?>','<?=$key->id_syarat?>','tek')" <?=$setValChild?>>
								</center>
							</td>
						</tr>
						<?php			
								}
							}
						?> 
    </tbody>
</table>