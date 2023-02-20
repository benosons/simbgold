
				<input class="form-control" value="<?php echo $this->uri->segment(3);?>" id="toid" name="toid" style="display: none;">
				<input class="form-control" value="<?php echo $this->uri->segment(4);?>" id="toid2" name="toid2" style="display: none;">
				<table id="" class="table table-bordered table-striped table-hover">		
					<thead>
						<tr >
							<th >No.</th>
							<th >Nama Dokumen</th>
							<th width="7%">Berkas</th>
							<th width="18%">Hasil Pemeriksaan</th>
							<th >Berkas Perbaikan</th>
						</tr>
					</thead>
					<tbody>
						<?php
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
							<td ><?php echo $key->nama_syarat,$key->id_persyaratan_detail;?></td>
							<td align="center">
							<? if($dir_file !='')
								{?>
									<center>	
										<a class="btn default btn-xs blue-stripe" onClick="javascript:Getut('<?php echo $id;?>','<?php echo $dir_file; ?>')" src="<?php echo base_url()?>assets/images/pdf.gif" title='File Pdf' class='link' > 
										Lihat</a>
									</center>
								<?}else
								{?>
									<center>
										<?php echo 'Kosong' ?>
									</center>
								<?}?>
							</td>
							<td>
								<?
									
									$radio1 = "";
									$radio2 = "";
									$kesesuaian = "";
									$dir_file_perbaikan = "";
									$id_penilaian = "";
									
									
									$id_persyaratan_detail = $key->id_persyaratan_detail;
									$query_pemeriksaan = $this->mpengajuan->get_penilaian_teknis($id_persyaratan_detail,$this->uri->segment(3))->result_array();
									
									for($n=0;$n<count($query_pemeriksaan);$n++) {
										$kesesuaian = $query_pemeriksaan[$n]['kesesuaian'];
										$id_penilaian = $query_pemeriksaan[$n]['id_penilaian'];
										$dir_file_perbaikan = $query_pemeriksaan[$n]['dir_file_perbaikan'];
									}
									
									$cek_kesesuaian ='';
									if($kesesuaian==1)
									{
										$cek_kesesuaian = $cek_kesesuaian+1;
										$radio = "TERVERIFIKASI";
									}else if($kesesuaian==2){
										$radio = "PERBAIKI";
									}else{
										$radio = "PERBAIKI";
									}
								?>
								<input type="text" name="id_nilai_<?=$id_persyaratan_detail?>" id="id_nilai_<?=$id_persyaratan_detail?>" value="<?=$id_penilaian?>" style="display: none;">
								<?php echo $radio; ?>
							</td>
							<td align="center" width="10%">		
										<?php echo form_open_multipart('pengajuanSLF/simpanRevisiTeknis2/'.$id.'/'.$key->id_syarat.'/1/'.$id,array('name'=>'frmup'.$no, 'id'=>'frmup'.$no)); ?>
											<? if($dir_file_perbaikan == '' or $dir_file_perbaikan == null){?>
												<input type="hidden" name="id_penilaian" value="<?=$id_penilaian?>">
												<input type="file" name="d_file" id="d_file" placeholder="Unggah Berkas Disini" accept="application/pdf" onchange="form.submit()">		
											<? }else{?>
												<a class="btn default btn-xs blue-stripe" onClick="javascript:Getrev('<?php echo $id;?>','<?php echo $dir_file_perbaikan; ?>')" src="<?php echo base_url()?>assets/images/pdf.gif" title='File Pdf' class='link' > 
												Lihat</a>| 
												<a href="<?php echo site_url('pengajuanSLF/removeDataRevisi/'.$id.'/'.$id_penilaian);?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ini?')" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a>
											<? }?>
										<?php echo form_close(); ?>
							</td>
						</tr>
						<?php			
								}
							}
								
						?>
				</table>
	<br>
<?php if (trim($status_progress) == 8){?>
	<button class="col-md-12 btn blue" onClick="window.location.href = '<?php echo base_url();?>pengajuanSLF/simpanperbaikansidang/<?php echo $id;?>';return false;">Simpan Perbaikan</button>
	<hr>
<?}else{?>
						
<?}?>


<script type="text/javascript">

function Getrev(id,f){
	url = "<?php echo base_url() . index_page() ?>file/slf/"+id+"/"+"persyaratan/perbaikan_sidang"+"/"+f;
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
}

</script>