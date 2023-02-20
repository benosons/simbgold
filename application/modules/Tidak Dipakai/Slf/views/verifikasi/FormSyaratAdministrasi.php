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
		if(!empty($MasterAdministrasi)){
			$no = 1;
				foreach ($MasterAdministrasi->result() as $key) {
									if ($no % 2 == 0 )
										$clss = "event";
									else
										$clss = "event2";
									
									$setValChild 	= '';
									$id_administrasi 	= '';
									$dir_file		 	= '';
									if(!empty($DataAdministrasi))
									{
										foreach ($DataAdministrasi->result() as $keyChild)
										{
											$file = $keyChild->dir_file;
											$id_dokumen_permohonan = $keyChild->id_dokumen_permohonan;
											$status_verifikasi = $keyChild->verifikasi;
											$id_data_administrasi = $keyChild->id;
											if($key->id_syarat == $id_dokumen_permohonan)
											{
												if($status_verifikasi == '1'){
													$setValChild = 'checked';
												}
												
												$id_administrasi = $id_data_administrasi;
												if($file != '' or $file != null){
													$dir_file = $file;
												}
											}
										}
									}
									?>
				<tr class="<?=$clss?>" >
					<td align="center"><?php echo $no++;?></td>
					<td><?php echo $key->nama_syarat;?></td>
					<td align="center">
						<? if($dir_file !='')
								{?>
									<center>	
										<a href="javascript:void(0);" onClick="javascript:GetPdfAdministrasiSLF('<?php echo $tarot;?>','<?php echo $key->id_syarat;?>','<?php echo $dir_file;?>')" >
											<?php echo 'Lihat' ?>
										</a>
									</center>
								<?}else
								{?>
									<center>
										<?php echo 'Tidak Ada File' ?>
									</center>
								<?}?>
							</td>
							<td>
								<center>
									<input type="checkbox" name="syarat_<?=$key->id_syarat?>" value="<?=$key->id_syarat?>" id="syarat_<?=$key->id_syarat?>" onchange="check_status_slf('syarat_<?=$key->id_syarat?>','<?=$key->id_syarat?>','adm')" <?=$setValChild?>>
								</center>
							</td>
			</tr>
		<?}
		}?>  
    </tbody>
</table>