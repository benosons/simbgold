
		<input type="hidden" class="form-control" value="<?php echo set_value('id_permohonan', (isset($id_permohonan) ? $id_permohonan : ''))?>" name="id_permohonan" placeholder="id_permohonan" autocomplete="off">
		<input type="hidden" class="form-control" value="<?php echo set_value('id_jenis_permohonan', (isset($id_jenis_permohonan) ? $id_jenis_permohonan : ''))?>" name="Jenis Permohonan" placeholder="id_nama_permohonan" autocomplete="off">
		</form>
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					Perbaikan Dokumen Persyaratan Teknis
				</div>
			</div>
			<div class="portlet-body">
			<?php
									echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-'.$this->session->flashdata('status').'">'.$this->session->flashdata('message').'</div>' : '';    
			?>
				<div class="table-scrollable"><table id="data_teknis" class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
									<th rowspan="2"class="info"><center>No</center></th>
									<th colspan="3"class="info"><center>Persyaratan</center></th>
									<th colspan="2" class="danger"><center>Perbaikan dari TIM TABG / Teknis</center></th>
									<th rowspan="2"class="info"><center>Berkas Perbaikan</center></th>
							</tr>
							<tr >
								
								<th class="info">Nama</th>
								<th class="info">Detail</th>
								<th class="info" >Berkas</th>
								<th class="danger">Kesesuaian</th>
								<th class="danger"><center>Catatan</center></th>
								
								
							</tr>
					</thead>
					<tbody>
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
										$query = $this->mpengajuan->get_syarat($row->id_persyaratan_detail,$this->uri->segment('3'))->result_array();
										for($n=0;$n<count($query);$n++) {
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
													<a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/imb/pengajuan_imb/'.$id_permohonan.'/persyaratan/Teknis/'.$dir);?>')" class="btn default btn-xs blue-stripe" >Lihat</a>
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
									<?php print form_textarea('cat_',set_value('cat',(isset($cat)?$cat:'')),'class="form-control" readonly style="width:200px; height:50px;"')?>
								</td>
			
								<td class="clleft">
									<?php echo form_open_multipart('pengajuan/simpanRevisiTeknis/'.$this->uri->segment(3),array('name'=>'frmup'.$i, 'id'=>'frmup'.$i)); ?>
									<? if($kesesuaian == 2){?>
									<center>
										<? if($dir_file_hasil_perbaikan_pemohon != ""){?>
											<a class="btn default btn-xs blue-stripe" onClick="javascript:GetPdf_Perbaikan('<?php echo $id_permohonan; ?>','<?php echo $dir_file_hasil_perbaikan_pemohon; ?>')" src="<?php echo base_url()?>assets/images/pdf.gif" title='File Pdf' class='link' > 
											Lihat	
											&nbsp;<a href="<?php echo site_url('pengajuan/removeDataRevisi/'.$id_permohonan.'/'.$id_penilaian);?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ini?')" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a>
														
										<?php }else{?>
									</center>
										<?php }?>
									<?php }?>
									<?php echo form_close(); ?>
									
									<?php echo form_open_multipart('pengajuan/simpanRevisiTeknis2/'.$this->uri->segment(3),array('name'=>'frmup'.$i, 'id'=>'frmup'.$i)); ?>
									<? if($kesesuaian == 2){?>
									<center>
										<? if($dir_file_hasil_perbaikan_pemohon != ""){?>
										
										<?php }else{?>
											<input type="hidden" name="id_penilaian" value="<?=$id_penilaian?>">
											<input type="file" name="d_file" id="d_file" onchange="form.submit()">
											</br>
											
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
				</table></div>
			</div>
		</div>
	
<?php if (trim($status_progress) == 8){?>
<button class="col-md-12 btn blue" onClick="window.location.href = '<?php echo base_url();?>Pengajuan/simpanperbaikansidang/<?php echo $id_permohonan;?>';return false;">Simpan Perbaikan</button>
<hr>
<?}else{?>
						
<?}?>

<script type="text/javascript">
function GetPdf(id,id_bg,f){
	url = "<?php echo base_url() . index_page() ?>file/IMB/"+id+"/"+"data_teknis"+"/"+f;
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
}

function GetPdf_Catatan(id,id_bg,f){
	url = "<?php echo base_url() . index_page() ?>file/IMB/"+id+"/"+"sidang_n_penilaian/catatan_perbaikan"+"/"+f;
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
}

function GetPdf_Perbaikan(id,f){
	url = "<?php echo base_url() . index_page() ?>file/IMB/pengajuan_imb/"+id+"/"+"sidang_n_penilaian/perbaikan_sidang"+"/"+f;
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
}


</script>