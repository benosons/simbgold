
	<div id='confirm'></div>
	<div id='confirm2'></div>
		<?php echo form_open_multipart('permohonan/detailt_submit/'.$id_permohonan,array('name'=>'frmdetailt', 'id'=>'frmdetailt')); ?>
			<div class="blank"></div> 
            <div class="spacer"></div>
			<div id="top"></div>
			<div id="confirm" class="confirm" style="display: none;"></div>	
			<input type='hidden' name='id_dtanah' id='id_dtanah' value='<?php echo set_value('id_dtanah', (isset($id_dtanah) ? $id_dtanah : ''))?>' />
			
			<fieldset class="ui-tabs ui-widget ui-widget-content ui-corner-all">
				<fieldset class="panel-form">
					<h3 class="title">Data Kepemilikan Tanah</h3>
					
					<div id="form_data_tanah" style="display: none;">
					
					
					<div id="nama_dok_lain" style="display: none;">
					
					
					
					
					
					
					
					
					
					<div id="izin_pemegang_hak_atas_tanah" style="display: none;">
					<h3 class="title">&nbsp;</h3>
						
						
						
					
					</div>
					
					
					<dl>
						<dt>&nbsp;</dt>
						<dd class="dot2">&nbsp;</dd>
						<dd class="col-right">	
							<?php echo form_submit('save','Simpan');	?>
						</dd>
					</dl>
					<br>
					<br>
					
					</div>	
					
					<div class="blank"></div>
	<div class="blank"></div> 
	<div class="blank"></div>
	<div class="blank"></div>
	<div class="blank"></div> 
	<div class="blank"></div>
	
	<div id="daftar_data_tanah" style="display: none;">
	<dl>
		<table class="tbl" align="center" border="0" cellpadding="2" cellspacing="1" width="100%">			
			<tbody>
				<tr style="padding-left: 5px; padding-bottom:3px; color:#FFF; font-weight:bold">
					<th><center>No.</center></th>
					<th><center>Jenis Dokumen</center></th>
					<th><center>Nomor Dokumen</center></th>
					<th><center>Tgl. Dokumen</center></th>
					<th><center>Luas Tanah (m<sup>2</sup>)</center></th>
					<th><center>Atas Nama</center></th>
					<th><center>Lokasi</center></th>
					<th><center>File</center></th>
					<th><center>File Ijin<br>Pemanfaatan</center></th>
					
				</tr>
					
				<?php
					if(isset($jumdata)==0){?>
						<tr>
							<td class="clcenter" colspan="7">Data is Empty</td>
						</tr>
					<?}else{
						$no= 1;
						for($i=0;$i<count($results);$i++) {
							if ($i % 2== 0 )
							  $clss = "event";
							else
							  $clss = "event2";
				?>	
				<tr class="<?=$clss?>" id="record">
				<td class="clcenter" style="vertical-align:middle;"><?php echo $no ?></td>								
				<td class="clleft" style="vertical-align:middle;"><?php echo $results[$i]['jenis_dokumen'];?></td>								
				<td class="clleft" style="vertical-align:middle;"><?php echo $results[$i]['no_dok'];?></td>				
				<td class="clcenter" style="vertical-align:middle;"><?php echo tgl_eng_to_ind($results[$i]['tanggal_dok']);?></td>				
				<td class="clcenter" style="vertical-align:middle;"><?php echo $results[$i]['luas_tanah'];?></td>
				<td class="clcenter" style="vertical-align:middle;"><?php echo $results[$i]['atas_nama_dok'];?></td>
				<td class="clcenter" style="vertical-align:middle;"><?php echo $results[$i]['lokasi_tanah']; ?>, Kec. <?php echo $results[$i]['nama_kecamatan']; ?>, <?php echo $results[$i]['nama_kabkota']; ?>, Prov. <?php echo $results[$i]['nama_provinsi']; ?></td></td>
				<!--<td class="clcenter" style="vertical-align:middle;"></td>!-->
				<td class="clcenter">
					<a href="javascript:void(0);" onClick="javascript:GetPdf('<?php echo $results[$i]['id_permohonan_detail_tanah']?>','<?php echo $results[$i]['dir_file']?>')" >
						<?php
							if($results[$i]['dir_file'] != ''){
								echo 'Download';
							}
						?>
					</a>
				</td>
				<td class="clcenter">
					<a href="javascript:void(0);" onClick="javascript:GetPdf('<?php echo $results[$i]['id_permohonan_detail_tanah']?>','<?php echo $results[$i]['dir_file_phat']?>')" >
						<?php
							if($results[$i]['dir_file_phat'] != ''){
								echo 'Download';
							}
						?>
					</a>
				</td>
				
				<?php  
					$no++;
					} // endfor result
				} // endif jum_data
				?>
				
				
			</tbody>
		</table>
	</dl>
	</div>
	
	
	
				</fieldset>	
			</fieldset>	
				
			

