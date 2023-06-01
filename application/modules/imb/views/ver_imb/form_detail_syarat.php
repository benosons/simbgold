
			<table id="sample_2" class="table table-bordered table-striped table-hover">
                <thead>
	                <tr>
	                  <th>No</th>
	                  <th>Nama Dokumen</th>
					  <th>Berkas</th>
	                  <?php if($status_syarat != 1){?>
					  <th>Verifikasi</th>
					  <?}?>
	                </tr>
                </thead>
                <tbody>

				<?php
								$jns_syarat_sblm = '';
								$cek = '';
								$i= 1 ;
								foreach ($results as $row) {								
									if ($i % 2== 0 )
										$clss = "event";
									else
										$clss = "event2";	

				?>	
	                <tr >
	                  <td align="center"><?php echo $i?></td>
					<?
						$detail = $row->id_jenis_persyaratan;
						$status = "";
						$query = $this->imb_model->get_syarat($row->id_persyaratan_detail,$this->uri->segment('3'))->result_array();
						for($n=0;$n<count($query);$n++) {
						$cek = $query[$n]['id_persyaratan_detail'];
						$dir = $query[$n]['dir_file'];
						$status = $query[$n]['status'];
						$ipk=$this->uri->segment('3');
						}
					?>
					  <td><?php echo $row->nama_syarat;?> 
					  </td>
					  <td align="center">
										<? if($row->id_persyaratan_detail == $cek){?>
											<? if($dir != ''){?>
												<a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/imb/pengajuan_imb/'.$ipk.'/data_administrasi/'.$dir);?>')" class="btn default btn-xs blue-stripe" >Lihat</a>
											<?php } else {?>
												[KOSONG]
											<?php }?>
										<?php }?>
										
					  </td>
					  <?
									$checked = "";
									if($status == '1')
									{
										$checked = "checked";
									}
					  ?>
					  <?php if($status_syarat != 1){?>
					  <td align="center"><input type="checkbox" name="syarat_<?=$row->id_persyaratan_detail?>" value="<?=$row->id_persyaratan_detail?>" id="syarat_<?=$row->id_persyaratan_detail?>" onchange="check_status('syarat_<?=$row->id_persyaratan_detail?>','<?=$row->id_persyaratan_detail?>','adm')" <?=$checked?>></td>
					  <?}?>
					</tr>
	                <?php
							$i++;
							$jns_syarat_sblm = $detail;
						}
					?>          
                </tbody>
            </table>