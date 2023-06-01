<script type="text/javascript">
function GetPdf(id,id_bg,f){
	url = "<?php echo base_url() . index_page() ?>file/IMB/pengajuan_imb/"+id+"/"+"data_teknis"+"/"+f;
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
}

/*function GetPdf(id_bg,f){
	url = "<?php echo base_url() . index_page() ?>file/Gambar/"+f;
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
}*/
function GetPdf_Catatan(id,id_bg,f){
	url = "<?php echo base_url() . index_page() ?>file/IMB/pengajuan_imb/"+id+"/"+"sidang_n_penilaian/catatan_perbaikan"+"/"+f;
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
}

function GetPdf_Perbaikan(id,f){
	url = "<?php echo base_url() . index_page() ?>file/IMB/pengajuan_imb/"+id+"/"+"sidang_n_penilaian/perbaikan_sidang"+"/"+f;
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
}


function set_daftar_penilaian(v){
		$('#textStat').fadeIn();
		$.ajax({
			url: baseHref + 'penjadwalan/get_penilaian_per_sidang/<?=$this->uri->segment(3)?>/'+v,
			type: 'POST',
			success: function( response ) {
				$('div#detail_pejadwalan_penilaian').html('');
				$('div#detail_pejadwalan_penilaian').html(response);
			}
		});
		$('#textStat').fadeOut();
}

</script>	
	<center>
		<?php echo form_open_multipart('permohonan_disabled/perbaikan_sidang/'.$id_permohonan,array('name'=>'frmperbaikansidang', 'id'=>'frmperbaikansidang')); ?>
			<div class="blank"></div> 
            <div class="spacer"></div>
			<div id="top"></div>
			<div id="confirm" class="confirm" style="display: none;"></div>	
			<h3 class="title">Penilaian Rencana Teknis</h3>
			<?php 
				if (isset($err_msg) && $err_msg != '' ) { ?>
					<div class="errwarning"><?=$err_msg?></div>
			<?php } ?>
			
			<fieldset class="ui-tabs ui-widget ui-widget-content ui-corner-all">
				<fieldset class="panel-form">
					<div class="blank"></div> 
					<dl>
						<table class="tbl2" id="tabelbiasa" border="0" cellpadding="2" cellspacing="1">
						<tbody>
							<tr style="padding-left: 5px; padding-bottom:3px; color:#FFF; font-weight:bold">
								<th width="3%">No.</th>
								<th width="10%">Nama Persyaratan</th>
								<th width="20%">Detail Persyaratan</th>
								<th width="10%">Dokumen Awal Rencana Teknis</th>
								<th width="10%"><center>Kesesuaian</center></th>
								<th width="30%">Catatan</th>
								<th width="10%"><center>File Catatan<br>Perbaikan dari TIM TABG/Teknis</center></th>
								<th width="10%"><center>Hasil Perbaikan<br>Dokumen Rencana Teknis</center></th>
							</tr>
							<tr>
							</tr>
							<?php
								$jns_syarat_sblm = '';
								$detail_jns_syarat_sblm = '';
								$cek = '';
								$cek_kesesuaian = 0;
								$i= 1 ;
								$jml_perbaikan = count($results);
								$sudah_diperbaiki = 0;
								foreach ($results as $row) {								
									if ($i % 2== 0 )
										$clss = "event";
									else
										$clss = "event2";
							?>		  
							<tr class="<?=$clss?>">
								<td class="clcenter"><?php echo $i?></td>
										<?
											
										$status = "";
										$query = $this->mpermohonan->get_syarat($row->id_persyaratan_detail,$this->uri->segment('3'))->result_array();
										for($n=0;$n<count($query);$n++) {
										$cek = $query[$n]['id_persyaratan_detail'];
										$cek = $query[$n]['id_persyaratan_detail'];
										$dir = $query[$n]['dir_file'];
										$status = $query[$n]['status'];
										}
										?>
								
								<td class="clleft">
								<?
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
									}
									}else{
										echo '';
									}
								?>
								</td>
								<td class="clleft"><?php echo $row->nama_syarat;?></td>
								<td class="clleft">
										<? if($row->id_persyaratan_detail == $cek){?>
										<center>	
											<? if($dir != ''){?>
													<img id="gambar3" onClick="javascript:GetPdf('<?php echo $this->uri->segment(3)?>','<?php echo $row->id_persyaratan_detail; ?>','<?php echo $dir; ?>')" src="<?php echo base_url()?>assets/images/pdf.gif" title='File Pdf' class='link' > &nbsp; 
											<?php }?>
										</center>
										<?php }?>
								</td>

								<?
									$cat = $row->catatan;
									$kesesuaian = $row->kesesuaian;
									$dir_file_hasil_perbaikan = $row->dir_file_hasil_perbaikan;
									$id_penilaian = $row->id_penilaian;
									$dir_file_hasil_perbaikan_pemohon = $row->dir_file_hasil_perbaikan_pemohon;
								
									if($kesesuaian==1)
									{
										$kesesuaian_val = "Sesuai";
									}else if($kesesuaian==2){
										$kesesuaian_val = "Tidak Sesuai";
									}else{
										$kesesuaian_val = "";
									}
								?>
								
								<td>
									<?=$kesesuaian_val?>
								</td>
								<td>
									<?=$cat?>
								</td>
								<td class="clleft">									
									<center>
										<? if($dir_file_hasil_perbaikan != ""){?>
											<img id="gambar3" onClick="javascript:GetPdf_Catatan('<?php echo $id_permohonan; ?>','<?php echo $id_penilaian; ?>','<?php echo $dir_file_hasil_perbaikan; ?>')" src="<?php echo base_url()?>assets/images/pdf.gif" title='File Pdf' class='link' > &nbsp; 
										<?php }?>
									</center>
								</td>
								<td class="clleft">
									<?php echo form_open_multipart('permohonan_disabled/simpan_upload_teknis_perbaikan/'.$this->uri->segment(3),array('name'=>'frmup'.$i, 'id'=>'frmup'.$i)); ?>
									<? if($kesesuaian == 2){?>
									<center>
										<? if($dir_file_hasil_perbaikan_pemohon != ""){?>
											<img id="gambar3" onClick="javascript:GetPdf_Perbaikan('<?php echo $id_permohonan; ?>','<?php echo $dir_file_hasil_perbaikan_pemohon; ?>')" src="<?php echo base_url()?>assets/images/pdf.gif" title='File Pdf' class='link' > &nbsp; 
											<a href="<?php echo base_url() . index_page();?>permohonan_disabled/delete_file_hasil_pemeriksaan/<?php echo $this->uri->segment(3)?>/<?php echo $id_penilaian?>" onClick="return confirm('Anda Yakin Akan Menghapus Data Ini ?')">
												<div class="delete2" title="Delete Data"  id='<?php echo $id_penilaian?>'></div>
											</a>
										<?php }else{?>
									</center>
										<?php }?>
									<?php }?>
									<?php echo form_close(); ?>
									
									<?php echo form_open_multipart('permohonan_disabled/simpan_upload_teknis_perbaikan2/'.$this->uri->segment(3),array('name'=>'frmup'.$i, 'id'=>'frmup'.$i)); ?>
									<? if($kesesuaian == 2){?>
									<center>
										<? if($dir_file_hasil_perbaikan_pemohon != ""){?>
										
										<?php }else{?>
											<input type="hidden" name="id_penilaian" value="<?=$id_penilaian?>">
											<input type="file" name="d_file" id="d_file">
											</br>
											<input id="upload"type="submit" name="upload" value="Upload" >
										<?php }?>
									</center>
									<?php }?>
									<?php echo form_close(); ?>
								</td>
							</tr>	
							<?php 

								$i++;
								$detail_jns_syarat_sblm = $detail_jenis_persyaratan;
								}
							?>
						</tbody>
					</table>
					</dl>
					<div class="blank"></div>
				</fieldset>
			</fieldset>	
			<div>	
				<div class="space-line"></div>
				<div class="blank"></div>
				<div class="spacer"></div> 
			</div>
			<!--
			<fieldset class="ui-tabs ui-widget ui-widget-content ui-corner-all">
				<fieldset class="panel-form">
					<dl>
						<p>Konfirmasi Perbaikan, Mohon memperhatikan informasi berikut:</p>
						<ul>
							<li>Anda telah Melengkapi semua perbaikan yang diunggah pada kolom di atas.</li>
							<li>Anda menyetujui dan mengkonfirmasi untuk dilanjutkan pada proses selanjutnya.</li>
							<li>Dokumen perbaikan yang Anda unggah merupakan perbaikan dengan saran TIM TABG/Teknis.</li>
						</ul>
					</dl>
					
					<dl>
						<dt>&nbsp;</dt>
						<dd class="dot2">&nbsp;</dd>
						<dd class="col-right">
					
							<? if($pernyataan == 1){ echo '<font color=green><b>* Anda Telah Menyetujui Perbaikan Tersebut</b></color>';}else{?>
								<input type="checkbox" name="setuju" value="1"> Jika Setuju<br>
							<?}?>
						</dd>
					</dl>
					<dl>
						<dt>&nbsp;</dt>
						<dd class="dot2">&nbsp;</dd>
						<dd class="col-right">	
							<?php if($pernyataan != 1){  ?>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="submit" value="Konfirmasi">
							<?}else{}?>
						</dd>
					</dl>
				</fieldset>	
			</fieldset>	-->
			

		<?php echo form_close(); ?>
	</center>
