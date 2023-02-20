
			<div class="row">
				<div class="col-md-12">
				<div class="portlet box blue">
					<div class="portlet-title">
						<div class="caption">
							Data Permohonan IMB
						</div>
					</div>
					<div class="portlet box blue">
						<div class="portlet-body form">
							<form class="form-horizontal">
								<div class="form-body">
									<div class="row">
										<div class="col-md-9">
											<div class="form-group">
												<label class="control-label col-md-5">Nama Permohonan :</label>
												<div class="col-md-7">
													<p class="form-control-static">
														<?php echo $DataSummary->nama_permohonan;?>
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
						</div>
						<? if($DataSummary->id_jenis_permohonan == '') {?>
							<div class="portlet-body">
								<table id="" class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<td align="center">
												Tolong Periksa Permohonan Anda
											</td>
										</tr>
									</thead>
								</table>
								</div>
								
						<?}else{?>
							
						
							<div class="portlet box blue-hoki">
								<div class="portlet-title">
									<div class="caption">
										Konfirmai Data Permohonan IMB
									</div>
								</div>
								<input type="hidden" class="form-control" value="<?php echo set_value('id', (isset($id) ? $id : ''))?>" name="id" placeholder="id" autocomplete="off">		
								<form action="<?php echo site_url('pengajuan/saveDataPernyataan'); ?>" class="form-horizontal" role="form" method="post" id="FormPernyataan">
									<div class="note note-warning"><h4 class="font-blue">
									<b>Sebelum anda mengkonfirmasi, Mohon memperhatikan informasi berikut:</b><br></h4>
									<h5 class="font-blue"><b>
									- Data yang anda berikan adalah benar dan dapat dipertanggungjawabkan.<br>
									- Anda dapat melengkapi data persyaratan dengan cara diunggah melalui situs SIMBG atau datang ke kantor DPMPTSP di kabupaten/kota Anda.<br>
									- Dokumen harus dilengkapi dalam waktu 20 hari terhitung mulai tanggal pendaftaran.<br>
									- Apabila data yang telah dikonfirmasi belum lengkap, Anda bisa melengkapinya dengan cara datang ke kantor DPMPTSP di kabupaten/kota Anda.<br>
									- Apabila terjadi kesalahan data setelah dilakukan konfirmasi, Anda dapat menghubungi petugas perizinan di kabupaten/kota Anda.<br>
									</h5></b><hr>
									<b><h4 class="font-blue">Berdasarkan konfirmasi setuju yang saya nyatakan:</b><br></h4>
									<h5 class="font-blue"><b>
									- Seluruh data dalam berkas/dokumen yang telah saya unggah dan isi, serta saya sampaikan adalah benar.<br>
									- Data yang saya berikan tunduk pada peraturan perundang-undangan.<br>
									- Apabila di kemudian hari terjadi kesalahan terhadap data yang saya sampaikan, maka saya bersedia menerima sanksi sesuai peraturan perundang-undangan.<br>
									</h5></b></div>
									
									<? 
									$pernyataan = set_value('pernyataan', (isset($DataSummary->pernyataan) ? $DataSummary->pernyataan : ''));
									if($pernyataan == '1'){ 
										echo '<h4 class="note note-success"><b>* Anda Telah Menyetujui Persyaratan Tersebut</b></h4>';
									}else{?>
										
										<input style="display: none;" class="form-control" value="<?php echo set_value('id_permohonan', (isset($id_permohonan) ? $id_permohonan : ''))?>" name="id_permohonan" placeholder="id" autocomplete="off">
											
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
							<?}?>
					</div>
					<div class="row">
								<div class="form-group">
														<center>
														<div class="col-md-6">
															<span class="input-group-btn">
															<button class="btn green" onClick="window.location.href = '<?php echo base_url();?>Pengajuan/FormImbTeknis/<?php echo $this->uri->segment(3);?>';return false;">Kembali</button>
															</span>
														</div>
														<div class="col-md-6">
															<span class="input-group-btn">
															<!--<button class="btn green" disabled>Selanjutnya</button>-->
															</span>
														</div>
														</center>
												</div>
							</div><br>
				</div>	
				</div>
			</div>