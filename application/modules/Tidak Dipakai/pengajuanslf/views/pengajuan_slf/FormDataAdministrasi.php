<script type="text/javascript">
function GetPdf(id,f){
	url = "<?php echo base_url() . index_page() ?>file/SLF/"+id+"/"+"persyaratan/Administrasi"+"/"+f;
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
}

function del_up(u,n){
	alert (u);
	$.ajax({
		url: baseHref + 'pengajuan/delete_upload_slf/<?=$this->uri->segment(3)?>/'+u+'/adm',
		type: 'POST',
		dataType: 'html',
		cache:false,
		success: function( response ) {
			$('#frmup'+n).html('');
			$('#frmup'+n).html(response);
		}
	});
	$('#textStat').fadeOut();
}
function getFile(v){
	alert(v);
}
</script>

			<div class="row">
			<div class="col-md-12">
				<div class="portlet box blue">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-gift"></i>Data Permohonan
						</div>
					</div>
					<div class="portlet box blue">
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form class="form-horizontal" role="form">
								<div class="form-body">
									<div class="row">
										<div class="col-md-9">
														<div class="form-group">
															<label class="control-label col-md-5">Nama Permohonan :</label>
															<div class="col-md-6">
																<p class="form-control-static">
																	<?
																		if	($DataSummary->id_jenis_permohonan != '0' || $DataSummary->id_jenis_permohonan != null){
																			$JenisPermohonan  = $DataSummary->nama_permohonan;
																			
																		}else{
																			$JenisPermohonan  ="Permohonan Anda Tidak Terdaftar, Silahkan Lengkapi Datanya";
																		}
																	?>
																	<?php echo $JenisPermohonan;?>
																</p>
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-5">Nama Pemilik :</label>
															<div class="col-md-6">
																<p class="form-control-static">
																	<?php echo $DataSummary->nama_pemilik;?>
																	<?php echo $jalan;?>, Kec. <?php echo $nama_kec;?>, <?php echo ucwords(strtolower($nama_kabkota));?>, Prov. <?php echo $nama_provinsi;?>
																</p>
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-5">Alamat Pemilik Bangunan :</label>
															<div class="col-md-7">
																<p class="form-control-static">
																	<?php echo $jalan;?>, Kec. <?php echo $nama_kec;?>, <?php echo ucwords(strtolower($nama_kabkota));?>, Prov. <?php echo $nama_provinsi;?>
																</p>
															</div>
														</div>
														<div class="form-group" style="display:none;">
															<label class="control-label col-md-5">Fungsi Bangunan :</label>
															<div class="col-md-7">
																<p class="form-control-static">
																	<?php 
																		if($DataSummary->id_fungsi_bg_slf == '1'){
																			$Fungsi = "Fungsi Hunian";
																		}else if($DataSummary->id_fungsi_bg_slf == '2'){
																			$Fungsi = "Fungsi Non Hunian";
																		}
																	?>
																	<?php echo $Fungsi;?>
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
																	<?php echo $DataSummary->tinggi_bg;?> Meter / <?php echo $DataSummary->lantai_bg;?> Lantai
																</p>
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-5">Lokasi Bangunan Gedung :</label>
															<div class="col-md-7">
																<p class="form-control-static">
																<?php echo $alamat_bg;?>, Kec. <?php echo $nama_kecamatan;?>, <?php echo ucwords(strtolower($nama_kabkota_bg));?>, Prov. <?php echo $nama_provinsi_bg;?>																
																</p>
															</div>
														</div>
													</div>
									</div>
									<p class="note note-warning">Jika Anda Mengalami Kesulitan dalam mengunggah Dokumen, Silahkan untuk Datang ke DPTSP Daerah dimana Pengajuan Permohonan ditujukan,
										Dengan Membawa Berkas Dokumen yang terlampir di daftar "Data Kelengkapan Persyaratan Administrasi & Teknis".
									</p>
								</div>
							</form>
							
							<div class="portlet box blue-hoki">
								<div class="portlet-title">
									<div class="caption">
										Data Kelengkapan Persyaratan Administrasi
									</div>
								</div>
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
															$id_dokumen_permohonan = $keyChild->id_dokumen_permohonan;
															$status_verifikasi = $keyChild->verifikasi;
															$id_data_administrasi = $keyChild->id;
															if($key->id_syarat == $id_dokumen_permohonan)
															{
																$id_administrasi = $id_data_administrasi;
																if($file != '' or $file != null){
																	$dir_file = $file;
																	$urut_file = $id_dokumen_permohonan;
																}
															}
														}
													}
												?>
												<tr class="<?=$clss?>" >
													<td align="center"><?php echo $no++;?></td>
													<td align="left"><?php echo $key->nama_syarat;?></td>
													<td align="center">
														<?php echo form_open_multipart('pengajuanSLF/persyaratan_submitadm/'.$id.'/'.$key->id_syarat.'/1/'.$id_administrasi,array('name'=>'frmup'.$no, 'id'=>'frmup'.$no)); ?>
														<? if($dir_file == '' or $dir_file == null){?>
															<input type="file" name="d_file" id="d_file" accept="application/pdf" onchange="form.submit()">	
														<? }else{?>
														<center>
															<a class="btn default btn-xs blue-stripe" onClick="javascript:GetPdf('<?php echo $id;?>','<?php echo $dir_file; ?>')" src="<?php echo base_url()?>assets/images/pdf.gif" title='File Pdf' class='link' > 
															Lihat
															</a>
															| 
															<a href="<?php echo site_url('pengajuanSLF/removeDataAdministrasi/'.$id_administrasi.'/adm/'.$id);?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ini?')" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a>
															
														</center>	
														<? }?>
														<?php echo form_close(); ?>
													</td>
												</tr>
											<?php			
											//$no++;
												}
											}
											?>
										</tbody>
									</table></div>
								</div>    
							</div>
						</div>
				<center>
				<span class="input-group-btn">
					<button class="btn green" onClick="window.location.href = '<?php echo base_url();?>PengajuanSLF/FormDataTanah/<?php echo $id;?>';return false;">Kembali</button>
				</span>
							
				<span class="input-group-btn">
					<button class="btn green" onClick="window.location.href = '<?php echo base_url();?>PengajuanSLF/FormTeknisSLF/<?php echo $id;?>';return false;">Selanjutnya</button>
				</span>
				</center>
					</div>
					
				</div>
			</div>
			</div>
