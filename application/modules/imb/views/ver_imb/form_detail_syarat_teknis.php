		
			<table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
	                <tr>
	                  <th>No</th>
	                  <th>Nama Persyaratan</th>
					  <th>Detail Persyaratan</th>
					  <th>Berkas</th>
					  <?php if($status_syarat != 1){?>
					  <th>Verifikasi</th>
					  <?}?>
	                </tr>
                </thead>
                <tbody>

				<?php
					$jns_syarat_sblm = '';
					$detail_jns_syarat_sblm = '';
					$cek = '';
					//$status_syarat ='';
					$i= 1 ;
					foreach ($resultses as $row) {								
							if ($i % 2== 0 )
								$clss = "event";
							else
								$clss = "event2";	
				?>
	                <tr class="<?=$clss?>">
	                  <td align="center"><?php echo $i?></td>
					<?
						$detail = $row->id_jenis_persyaratan;
						//$fileProtype = $row->dir_file;
						$status = "";
						$query = $this->imb_model->get_syarat($row->id_persyaratan_detail,$this->uri->segment('3'))->result_array();
						for($n=0;$n<count($query);$n++) {
							$cek = $query[$n]['id_persyaratan_detail'];
							$dir = $query[$n]['dir_file'];
							$status = $query[$n]['status'];
							$ipk=$this->uri->segment('3');
						}
						$QueryProtype = $this->imb_model->getProtype($this->uri->segment('3'))->result_array();
						for($s=0;$s<count($QueryProtype);$s++) {
							$fileProtype = $QueryProtype[$s]['dir_file'];
						}
					?>
					  <td>
								<?php
											$detail_jenis_persyaratan = $row->id_detail_jenis_persyaratan;
											if($detail_jenis_persyaratan != $detail_jns_syarat_sblm){
												if ($detail_jenis_persyaratan == '1'){
													echo "Rencana Arsitektur";
												}else if ($detail_jenis_persyaratan=='2'){
													echo "Rencana Struktur";
												}else if ($detail_jenis_persyaratan=='3'){
													echo "Rencana Utilitas";
												}else if ($detail_jenis_persyaratan=='4'){
													echo "Perizinan dan/ atau Rekomendasi lainnya";
												}else if ($detail_jenis_persyaratan=='6'){
													echo "Optional";
												}
											}else{
												echo '';
											}
										?>
					  </td>
					  <td><?php echo $row->nama_syarat;?></td>
					  <td align="center">
					  <?	
							if($row->id_persyaratan_detail =='1858'){?>
								<a class="btn default btn-xs blue-stripe" onClick="javascript:getProtype('<?php echo $fileProtype;?>')" src="<?php echo base_url()?>assets/images/pdf.gif" title='File Pdf' class='link' > 
									Lihat
								</a>
						
							<? }else if($row->id_persyaratan_detail == $cek){?>
								<? if($dir != ''){?>
									<a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/imb/pengajuan_imb/'.$ipk.'/data_teknis/'.$dir);?>')" class="btn default btn-xs blue-stripe" >Lihat</a>
									<?php } else {?>
										[KOSONG]
									<?php }?>
							<?php }?>
										
					   </td>
					  <?
									$checked = "";
									$kkl = "";
									if($status == '1')
									{
										$checked = "checked";
										$kkl ="1";
									}
					  ?>
					  <?php if($status_syarat != 1){?>
					  
						<td align="center">
							<input type="checkbox" name="syarat_<?=$row->id_persyaratan_detail?>" value="<?=$row->id_persyaratan_detail?>" id="syarat_<?=$row->id_persyaratan_detail?>" onchange="check_status('syarat_<?=$row->id_persyaratan_detail?>','<?=$row->id_persyaratan_detail?>','tek')" <?=$checked?>>
						</td>
					  <?}?>
					</tr>
	                <?php
							$i++;
							$jns_syarat_sblm = $detail;
							$detail_jns_syarat_sblm = $detail_jenis_persyaratan;
						}
					?>          
                </tbody>
            </table>
	
