<script type="text/javascript">

function getFile(v){
	alert(v);
}

function GetPdf(id,f){
	url = "<?php echo base_url() . index_page() ?>file/imb/pengajuan_imb/"+id+"/"+"data_administrasi"+"/"+f;
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
}
</script>



			<div class="row">
			<div class="col-md-12">
				<div class="portlet box blue">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-gift"></i>Data Pengajuan IMB
						</div>
					</div>
					<div class="portlet box blue">
						<div class="portlet-body form">
							<form class="form-horizontal" role="form">
								<div class="form-body">
									<div class="row">
										<div class="col-md-9">
											<div class="form-group">
												<label class="control-label col-md-5">Nama Permohonan :</label>
												<div class="col-md-7">
													<p class="form-control-static">
														<?php echo $DataSummary->nama_permohonan?>
													</p>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-5">Nama Pemilik :</label>
												<div class="col-md-6">
													<p class="form-control-static">
														<?
														if($DataSummary->nama_pemohon !='' || $DataSummary->nama_pemohon !=null){
															$Pemilik = $DataSummary->nama_pemohon;
														}else{
															$Pemilik = $DataSummary->nama_perusahaan;
														}
														?>
														<?php echo $Pemilik;?>
													</p>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-5">Alamat Pemilik Bangunan :</label>
												<div class="col-md-7">
													<p class="form-control-static">
														<?php echo $DataSummary->alamat_pemohon;?>, Kec. <?php echo $DataSummary->nama_kecamatan;?>, <?php echo ucwords(strtolower($DataSummary->nama_kabkota));?>, Prov. <?php echo $DataSummary->nama_provinsi;?>	
													</p>
												</div>
											</div>
											<?php if($DataSummary->id_jenis_bg == "5"){?>
														<div class="form-group">
															<label class="control-label col-md-5">Nama Bangunan :</label>
															<div class="col-md-7">
																<p class="form-control-static">
																	<?php echo $DataSummary->nama_bangunan;?>
																</p>
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-5">Luas / Tinggi Prasarana :</label>
															<div class="col-md-7">
																<p class="form-control-static">
																	<?php echo $DataSummary->luas_prasarana;?> m<sup>2</sup> / <?php echo $DataSummary->tinggi_prasarana;?> meter.
																</p>
															</div>
														</div>
											<?}else{?>
											<?php if($DataSummary->id_kolektif != "1"){?>
														<div class="form-group">
															<label class="control-label col-md-5">Fungsi Bangunan :</label>
															<div class="col-md-7">
																<p class="form-control-static">
																	<?php echo $DataSummary->fungsi_bg;?> - <?php echo $DataSummary->jns_bangunan;?>
																</p>
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-5">Luas Bangunan :</label>
															<div class="col-md-7">
																<p class="form-control-static">
																	<?php echo $DataSummary->luas_bg;?> m<sup>2</sup>
																</p>
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-5">Tinggi / Jumlah Lantai Bangunan:</label>
															<div class="col-md-7">
																<p class="form-control-static">
																	<?php echo $DataSummary->tinggi_bg;?> Meter / <?php echo $DataSummary->lantai_bg;?>  Lantai
																</p>
															</div>
														</div>
														<?}else{?>
														<div class="form-group">
															<label class="control-label col-md-5">Nama Bangunan :</label>
															<div class="col-md-7">
																<p class="form-control-static">
																	<?php echo $DataSummary->jns_bangunan;?>
																</p>
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-5">Tipe Bangunan :</label>
															<div class="col-md-7">
																<p class="form-control-static">
																	<?php echo $DataSummary->tipeA;?> || <?php echo $DataSummary->tipeB;?> || <?php echo $DataSummary->tipeC;?> || <?php echo $DataSummary->tipeD;?>
																</p>
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-5">Jumlah Unit :</label>
															<div class="col-md-7">
																<p class="form-control-static">
																	
																	<?php echo $DataSummary->unitA;?> || <?php echo $DataSummary->unitB;?> || <?php echo $DataSummary->unitC;?> || <?php echo $DataSummary->unitD;?>
																</p>
															</div>
														</div>
														<!--div class="form-group">
															<label class="control-label col-md-5">Luas Bangunan (m<sup>2</sup>) :</label>
															<div class="col-md-7">
																<p class="form-control-static">
																	<?php echo $DataSummary->luasA;?> m<sup>2</sup> || <?php echo $DataSummary->luasB;?> m<sup>2</sup> || <?php echo $DataSummary->luasC;?> m<sup>2</sup> || <?php echo $DataSummary->luasD;?> m<sup>2</sup>
																</p>
															</div>
														</div-->
														<div class="form-group">
															<label class="control-label col-md-5">Tinggi Bangunan :</label>
															<div class="col-md-7">
																<p class="form-control-static">
																	<?php echo $DataSummary->tinggiA;?> Meter || <?php echo $DataSummary->tinggiB;?> Meter || <?php echo $DataSummary->tinggiC;?> Meter || <?php echo $DataSummary->tinggiD;?> Meter
																</p>
															</div>
														</div>
											<?}?>
											<?}?>
											<div class="form-group">
												<label class="control-label col-md-5">Lokasi Bangunan Gedung :</label>
												<div class="col-md-7">
													<p class="form-control-static">
														<?php echo $DataSummary->alamat_bg;?>, Kec. <?php echo $DataSummary->kecamatan;?>, <?php echo ucwords(strtolower($DataSummary->kabkota));?>, Prov. <?php echo $DataSummary->provinsi;?>
													</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</form>
							
							<input type="hidden" class="form-control" value="<?php echo set_value('id_permohonan', (isset($id_permohonan) ? $id_permohonan : ''))?>" name="id_permohonan" placeholder="id_permohonan" autocomplete="off">
							<input type="hidden" class="form-control" value="<?php echo set_value('id_jenis_permohonan', (isset($id_jenis_permohonan) ? $id_jenis_permohonan : ''))?>" name="Jenis Permohonan" placeholder="id_nama_permohonan" autocomplete="off">
							<div class="portlet box blue-hoki">
								<div class="portlet-title">
									<div class="caption">
										Data Kelengkapan Persyaratan Administrasi
									</div>
								</div>
								<?
								if($DataSummary->id_jenis_permohonan !='' || $DataSummary->id_jenis_permohonan !=''){?>
								<div class="portlet-body">
								<?php
									echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-'.$this->session->flashdata('status').'">'.$this->session->flashdata('message').'</div>' : '';    
								?>
									<div class="table-scrollable"><table id="data_administrasi" class="table table-bordered table-striped table-hover">
										<thead>
											<tr>
												<th>No</th>
												<th>Nama Dokumen</th>
												<th>Berkas</th>
											</tr>
										</thead>
										<tbody>
											<?php
											if(!empty($MasterAdministrasi))
											{
												$no = 1;
												foreach ($MasterAdministrasi->result() as $key) 
												{
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
													
														<!--<span class="btn grey-cascade fileinput-button">
															<input type="file" name="file" id="file" >
															<input type="text" name="file" id="file" style="display: none;" >
														</span>
														<span class="btn grey-cascade fileinput-button">
															<input id="upload"type="submit" name="save" value="Upload" >
														</span>-->
													
													
													<?php echo form_open_multipart('pengajuan/persyaratan_submitadm/'.$id_permohonan.'/'.$key->id_persyaratan_detail.'/1/'.$id_administrasi,array('name'=>'frmup'.$no, 'id'=>'frmup'.$no)); ?>
														<? if($dir_file == '' or $dir_file == null){?>
															<input type="file" name="d_file" id="d_file" placeholder="Unggah Berkas Disini" accept="application/pdf" onchange="form.submit()">		
														<? }else{?>
														<center>
															<a class="btn default btn-xs blue-stripe" onClick="javascript:GetPdf('<?php echo $id_permohonan;?>','<?php echo $dir_file; ?>')" src="<?php echo base_url()?>assets/images/pdf.gif" title='File Pdf' class='link' > 
															Lihat
															</a>
															| 
															<a href="<?php echo site_url('pengajuan/removeDataPersyaratan/'.$id_administrasi.'/adm/'.$id_permohonan);?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ini?')" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a>
															
														</center>	
													<? }?>
													<?php echo form_close(); ?>
													</td>
												</tr>
											<?php			
												}
											}
											?>
										</tbody>
									</table></div>
								</div>
									<?}else{?>
								<div class="portlet-body">
								<table id="data_administrasi" class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<td align="center">
												Tolong Periksa Permohonan Anda
											</td>
										</tr>
									</thead>
								</table>
								</div>
									<?}?>
							</div>
						</div>
						
					</div>
					<center>
						<span class="input-group-btn">
							<button class="btn green" onClick="window.location.href = '<?php echo base_url();?>Pengajuan/FormDataTanah/<?php echo $id_permohonan;?>';return false;">Kembali</button>
						</span>
						
						<span class="input-group-btn">
							<button class="btn green" onClick="window.location.href = '<?php echo base_url();?>pengajuan/FormImbTeknis/<?php echo $id_permohonan;?>';return false;">Selanjutnya</button>
						</span>
					<center>
					<br>
				</div>
			</div>
			</div>	
	
