
			<div class="row"><div class="col-md-12">
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
																	<?php echo $DataSummary->nama_permohonan;?>
																</p>
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-5">Nama Pemilik :</label>
															<div class="col-md-6">
																<p class="form-control-static">
																	<?php echo $DataSummary->nama_pemilik;?>
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
								</div>
							</form>
							<div class="portlet box blue-hoki">
								<div class="portlet-title">
									<div class="caption">
										Konfirmai Data Permohonan SLF
									</div>
								</div>
								<input type="hidden" class="form-control" value="<?php echo set_value('id', (isset($id) ? $id : ''))?>" name="id" placeholder="id" autocomplete="off">		
								<form action="<?php echo site_url('pengajuanSLF/saveKonfirmasiSlf/'.$id); ?>" class="form-horizontal" role="form" method="post" id="FormPernyataan">
									<div class="note note-warning"><h4 class="font-blue">
									<b>Sebelum anda mengkonfirmasi, Mohon memperhatikan informasi berikut:</b><br></h4>
									<h5 class="font-blue"><b>
									
									- Data yang anda berikan adalah benar dan dapat dipertanggungjawabkan.<br>
									- Anda dapat melengkapi data persyaratan dengan cara diunggah melalui situs SIMBG atau datang ke kantor DPMPTSP di kabupaten/kota Anda.<br>
									- Dokumen harus dilengkapi dalam waktu 20 hari terhitung mulai tanggal pendaftaran.<br>
									- Apabila Data yang telah anda konfirmasi belum lengkap, Anda harus melengkapi data dengan cara datang ke kantor DPMPTSP di kabupaten/kota Anda.<br>
									- Apabila terjadi kesalahan data setelah dilakukan konfirmasi, Anda dapat menghubungi petugas perizinan di kabupaten/kota Anda.<br>
									<br>
									<h4 class="font-blue"><b>Berdasarkan konfirmasi setuju yang saya nyatakan:</b><br></h4>
									- Seluruh data dalam berkas/dokumen yang telah saya unggah dan isi, serta saya sampaikan adalah benar.<br>
									- Data yang saya berikan tunduk pada peraturan perundang-undangan.<br>
									- Apabila di kemudian hari terjadi kesalahan terhadap data yang saya sampaikan, maka saya bersedia menerima sanksi sesuai peraturan perundang-undangan.<br>
									</b></h5></div>
									
									<? 
									$pernyataan = set_value('pernyataan', (isset($DataSummary->status_pernyataan) ? $DataSummary->status_pernyataan : ''));
									if($pernyataan == '1'){ 
										echo '<h4 class="note note-success"><b>* Anda Telah Menyetujui Persyaratan Tersebut</b></h4>';
									}else{?>
									
										<input type="hidden" class="form-control" value="<?php echo set_value('id', (isset($id) ? $id : ''))?>" name="id" placeholder="id" autocomplete="off">
										<div class="form-group">
												<div class="col-md-12 note note-success" >
													<center>
														<h4><b><input type="checkbox" name="pernyataan" id="pernyataan" value="1"> Ceklis Jika Setuju</h4></b>
														<input type="submit" class="btn green" id="nyata" name="nyata" onClick="nyata()" value="Simpan">
													</center>
												</div>
										</div>
										
									
									<?}?>
								</form>
							</div>
										
						</div>
						<div class="row">
												<div class="form-group">
														<center>
														<div class="col-md-6">
															<span class="input-group-btn">
															<button class="btn green" onClick="window.location.href = '<?php echo base_url();?>PengajuanSLF/FormTeknisSLF/<?php echo $this->uri->segment(3);?>';return false;">Kembali</button>
															</span>
															
														</div>
														<div class="col-md-6">
															<span class="input-group-btn">
															<button class="btn green" disabled>Selanjutnya</button>
															</span>
														</div>
														</center>
												</div>
										</div>
					</div>
				</div>
			</div></div>
		