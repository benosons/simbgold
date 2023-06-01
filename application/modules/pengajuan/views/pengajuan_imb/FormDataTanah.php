<div class="row">
	<div class="col-md-12">
					
						
							<div class="portlet box blue">
								<div class="portlet-title">
									<div class="caption">
										Data Pengajuan IMB
									</div>
								</div>
								<?php
								$nama_per = "";
								$id_jenis_bg = $DataSummary->id_jenis_bg; //Jenis Permohonan BG
								$sub_tipe = $DataSummary->id_kolektif; // Jenis Kolektif
								//$jml_lantai = $DataSummary->lantai_bg; // Jml Lantai
								$id_dok_tek = $DataSummary->id_dok_tek; //  Jenis Dok Teknis
								$id_pemanfaatan_bg = $DataSummary->id_pemanfaatan_bg; // Kepentingan Umum / Bukan Kepentingan Umum

								$jml_lantai ="";
								
								if ($DataSummary->id_fungsi_bg == 1){
									if($DataSummary->lantai_bg == 1){
										$jml_lantai = $DataSummary->lantai_bg;
									}else if($DataSummary->lantai_bg == 2){
										$jml_lantai = $DataSummary->lantai_bg;
									}else{
										$jml_lantai = 3;
									}
								}else{
									$jml_lantai = '1';
								}
								
								if($DataSummary->id_jenis_bg == 2){
									if($DataSummary->lantai_bg > 8){
										$jml_lantai = 2;
									}else{
										$jml_lantai = 1;
									}
								}
								
								if($DataSummary->id_jenis_bg == 2){
									if($DataSummary->lantai_bg == 1){
										$jml_lantai = 1;
									}else if ($DataSummary->lantai_bg == 2){
										$jml_lantai = 1;
									}else {
										$jml_lantai = 3;
									}
								}
								if($DataSummary->id_jenis_bg == 3){
									if($DataSummary->lantai_bg > 8){
										$jml_lantai = 2;
									}else{
										$jml_lantai = 1;
									}
								}
								
								if($DataSummary->id_jenis_bg == 1){
									if($DataSummary->lantai_bg > 8){
										$jml_lantai = 2;
									}else{
										$jml_lantai = 1;
									}
								}
								
								if (($DataSummary->luas_bg <= 500) and ($DataSummary->lantai_bg <= 2)){
									$pemanfaatan='1';
								}else{
									$pemanfaatan='2';
								}
								
								if($DataSummary->id_jenis_bg == 4){
									$SQLcari = "AND b.id_jenis_bg = '$id_jenis_bg'  AND b.id_kolektif = '$sub_tipe' ";
								}else if($DataSummary->id_jenis_bg == 5){
									$SQLcari = "AND b.id_jenis_bg = '$id_jenis_bg'";
								}else{
									if($DataSummary->id_fungsi_bg == 0 OR $DataSummary->id_fungsi_bg == '0'){
										$SQLcari = " AND b.id_klasifikasi_bg = '$pemanfaatan' AND b.id_pemanfaatan_bg = '$id_pemanfaatan_bg' AND b.id_jenis_bg = '$id_jenis_bg' AND b.id_dok_tek = '$id_dok_tek' AND b.jml_lantai = '$jml_lantai'";
										//$SQLcari = " AND b.id_klasifikasi_bg = '$pemanfaatan' AND b.id_pemanfaatan_bg = '$id_pemanfaatan_bg2' AND b.id_jenis_bg = '$id_jenis_bg' AND b.id_dok_tek = '$id_dok_tek' AND b.jml_lantai = '$jml_lantai'";
									}else{
										//$SQLcari = " AND b.id_klasifikasi_bg = '$pemanfaatan' AND b.id_pemanfaatan_bg = '$id_pemanfaatan_bg' AND b.id_jenis_bg = '$id_jenis_bg' AND b.id_dok_tek = '$id_dok_tek' AND b.jml_lantai = '$jml_lantai'";
										$SQLcari = " AND b.id_pemanfaatan_bg = '$id_pemanfaatan_bg' AND b.id_jenis_bg = '$id_jenis_bg' AND b.id_dok_tek = '$id_dok_tek' AND b.jml_lantai = '$jml_lantai'";
									}
								}
									$query = $this->mpengajuan->getPermohonan(null,$SQLcari)->row_array();
									if(isset($query['nama_permohonan']) != ''){
										$nama_per = $query['nama_permohonan'];
										$id_jenis_permohonan  = $query['id_jenis_permohonan'];
										$dataIn = array (
										'id_jenis_permohonan' => $id_jenis_permohonan,
										);
										$this->mpengajuan->update_permohonan($dataIn,$id_permohonan);
										}else{
										$nama_per = "<b><span class='hightlight'>Permohonan Anda Tidak Terdaftar, Silahkan Lengkapi Datanya</span></b>";
										$dataIn = array (
										'id_jenis_permohonan' => null,
										);
										$this->mpengajuan->update_permohonan($dataIn,$id_permohonan);
										}
								?>
								
								<div class="portlet box blue">
									<div class="portlet-body form">
										<form class="form-horizontal" role="form">
											<div class="form-body">
												<div class="row">
													<div class="col-md-9">
														<div class="form-group">
															<label class="control-label col-md-5">Nama Permohonan :</label>
															<div class="col-md-6">
																<p class="form-control-static">
																	<?php echo $nama_per?>
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
								</div>
									<?php
												echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-'.$this->session->flashdata('status').'">'.$this->session->flashdata('message').'</div>' : '';    
									?>
								
									<div class="portlet box blue-hoki">
										<div class="portlet-title">
											<div class="caption">
												Data Tanah 
											</div>
										</div>
									
									 <div class="portlet-body">
									  <a href="#tanahIMBnya" role="button" class="btn red" data-toggle="modal">Tambah Data</a>
									  <div class="table-scrollable"><table class="table table-bordered table-striped table-hover" id="sample_editable_1">
										<thead>
											<tr class="warning">
												<th><center>No.</center></th>
												<th><center>Jenis Dokumen</center></th>
												<th><center>Nomor Dokumen</center></th>
												<th><center>Tgl. Dokumen</center></th>
												<th><center>LT (m2)</center></th>
												<th><center>Atas Nama</center></th>
												<th><center>Berkas</center></th>
												<th><center>Izin Pemanfaatan</center></th>
												<th><center>Hapus</center></th>
											</tr>
											
										</thead>
										<tbody>
										<?php
											if($DataTanah->num_rows() > 0)
											{
												$no = 1;
												foreach ($DataTanah->result() as $key) 
												{
													if($key->id_dokumen == '1'){
														$jenis_dokumen = "Sertifikat";
													}else if ($key->id_dokumen == '2'){
														$jenis_dokumen = "Akte Jual Beli";
													}else if ($key->id_dokumen == '3'){
														$jenis_dokumen = "Girik";
													}else if ($key->id_dokumen == '4'){
														$jenis_dokumen = "Petuk";
													}else{
														$jenis_dokumen = "Bukti Lain - Lain";
													}
											?>
													<tr>
														<td align="center"> <?php echo $no++;?></td>
														<td align="center"> <?php echo $jenis_dokumen;?></td>
														<td align="center"> <?php echo $key->no_dok;?></td>
														<td align="center"> <?php echo $key->tanggal_dok;?></td>
														<td align="center"> <?php echo $key->luas_tanah;?></td>
														<td align="center"> <?php echo $key->atas_nama_dok;?></td>
														<td align="center"><a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/imb/pengajuan_imb/'.$key->id_permohonan.'/data_tanah/'.$key->dir_file);?>')" class="btn default btn-xs blue-stripe" >Lihat</a></td>
														<?php if($key->dir_file_phat != ""){?>
														<td align="center"><a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/imb/pengajuan_imb/'.$key->id_permohonan.'/data_tanah/'.$key->dir_file_phat);?>')" class="btn default btn-xs blue-stripe" >Lihat</a></td>
														<?}else{?>
														<td></td>
														<?}?>
														<td align="center">
														<!--a href="#" onClick="href='<?php echo site_url('pengajuan/FormEditDataTanah/');?>'" class="btn btn-info btn-sm" title="Verifikasi Data" id="tombolver" role="dialog" data-toggle="modal" data-target="#tanahnyaedit"><span class="glyphicon glyphicon-edit"></span></a-->
														<a href="<?php echo site_url('pengajuan/removeDataTanah/'.$key->id_permohonan_detail_tanah.'/'.$key->id_permohonan);?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ini?')" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a>
														</td>
														
													</tr>
											<?php			
												}
											}
											?>
										</tbody>
									  </table></div>
									 </div>
									</div>
									
									<center>
									<span class="input-group-btn">
										<button class="btn green" onClick="window.location.href = '<?php echo base_url();?>Pengajuan/PermohonanImbForm/<?php echo $id_permohonan;?>';return false;">Kembali</button>
									</span>
									
									<span class="input-group-btn">
										<button class="btn green" onClick="window.location.href = '<?php echo base_url();?>pengajuan/FormImbAdministrasi/<?php echo $id_permohonan;?>';return false;">Selanjutnya</button>
									</span>
									</center>
									<br>
							</div>
						
	</div>
</div>				

<!-- /.modal -->

	<div id="tanahIMBnya" class="modal fade" role="dialog" aria-hidden="true" data-width="60%" data-backdrop="static" data-keyboard="false">
		
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Tambah Data Tanah</h4>
				</div>
				<div class="modal-body form">
					<form action="<?php echo site_url('pengajuan/saveDataTanah'); ?>" class="form-horizontal" role="form" method="post" id="FormTambahTanah" enctype="multipart/form-data">
						<div class="portlet-body form">
						<div class="form-body">
						<br>
						<input type="text" class="form-control" value="<?=(isset($id_permohonan) ? $id_permohonan : '');?>" name="id_permohonan" style="display: none;" autocomplete="off">
						<input type="text" class="form-control" value="<?=(isset($id_provinsi_bg) ? $id_provinsi_bg : '');?>" name="nama_provinsi" style="display: none;" autocomplete="off">
						<input type="text" class="form-control" value="<?=(isset($id_kec_bg) ? $id_kec_bg : '');?>" name="nama_kecamatan" style="display: none;" autocomplete="off">
						<input type="text" class="form-control" value="<?=(isset($id_kabkot_bg) ? $id_kabkot_bg : '');?>" name="nama_kabkota" style="display: none;" autocomplete="off">
						<div class="row">
							<div class="col-md-6">
											<div class="form-group form-md-line-input">
											<div class="input-group">
													<span class="input-group-addon">
													<i class="fa fa-circle"></i>
													</span>
											<select name="id_dokumen" id="id_dokumen" class="form-control" onchange="">
											<option value="">Pilih</option>
											<option value="1">Sertifikat</option>
											<option value="2">Akte Jual Beli</option>
											<option value="3">Girik</option>
											<option value="4">Petuk</option>
											<option value="5">Bukti Lain - Lain</option>
											</select>	
													<label for="form_control_1">Jenis Dokumen</label>
												</div>
											</div>
							</div>
							
							<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<div class="input-group">
													<span class="input-group-addon">
													<i class="fa fa-circle"></i>
													</span>
													<input class="form-control" id="nomor_dokumen" name="nomor_dokumen" type="text" placeholder="0-9 / A-Z" autocomplete="off">
													<label for="form_control_1">Nomor Dokumen</label>
													
												</div>
											</div>
							</div>
							<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<div class="input-group">
													<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
													</span>
													<input class="form-control date-picker" type="text" id="tgl_terbit_dokumen" name="tgl_terbit_dokumen" data-date-format="yyyy-mm-dd" autocomplete="off" placeholder="2000/12/31"/>
													<label for="form_control_1">Tanggal Terbit Dokumen</label>
													
												</div>
											</div>
							</div>
							<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<div class="input-group">
													<span class="input-group-addon">
													<i class="fa fa-circle"></i>
													</span>
													<input class="form-control" id="luas_tanah" name="luas_tanah" type="text" placeholder="Luas Tanah 00.00" autocomplete="off">
													<label for="form_control">Luas Tanah (<i> meter<sup> 2 </sup></i>)</label>
													
												</div>
											</div>
							</div>
							<div class="col-md-6">
											<div class="form-group form-md-line-input">
											<div class="input-group">
													<span class="input-group-addon">
													<i class="fa fa-circle"></i>
													</span>
											<select name="hat" id="hat" class="form-control" onchange="">
											<option value="">Pilih</option>
											<option value="1">Hak Milik</option>
											<option value="2">Hak Pakai</option>
											<option value="3">Hak Pengelolaan</option>
											<option value="4">Hak Guna Bangunan</option>
											<option value="5">Hak Guna Usaha</option>
											<option value="6">Hak Wakaf</option>
											</select>	
													<label for="form_control_1">Hak Atas Tanah</label>
												</div>
											</div>
							</div>
							<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<div class="input-group">
													<span class="input-group-addon">
													<i class="fa fa-circle"></i>
													</span>
													<input class="form-control" id="atas_nama" name="atas_nama" type="text" placeholder="Nama Pemegang Hak Atas Tanah" autocomplete="off">
													<label for="form_control">Nama Pemegang Hak Atas Tanah</label>
													
												</div>
											</div>
							</div>
							
						
							<div class="col-md-12">
											<div class="form-group form-md-line-input">
											<div class="input-group">
													<span class="input-group-addon">
													<i class="fa fa-circle"></i>
													</span>
													<input  type="text" class="form-control" value="<?=(isset($alamat_bg) ? $alamat_bg : '');?>" rows="1" placeholder="Lokasi Tanah" id="lokasi_tanah" name="lokasi_tanah" >
													<label for="form_control_1">Lokasi Tanah</label>
											</div>
											</div>
							</div>
							<div class="col-md-6">
											<div class="form-group form-md-line-input">
											<div class="input-group">
													<span class="input-group-addon">
													<i class="fa fa-circle"></i>
													</span>
												<input style="display: none;" name="dir_file_tan" id="dir_file_tan" onchange='coktan()'>
												<input type="file" class="form-control" name="d_file_tan" id="d_file_tan" accept="application/pdf" onchange='coktan()'>
												<label for="form_control_1">Berkas Kepemilikan Tanah</label>
											</div>
											</div>
							</div>
							<div class="col-md-6">
											<div class="form-group form-md-line-input">
											<div class="input-group">
													<span class="input-group-addon">
													<i class="fa fa-circle"></i>
													</span>
											<select name="hat2" id="hat2" class="form-control" onclick="set_status_izin_pemanfaatan(this.value)">
											<option value="">Pilih</option>
											<option value="1">YA</option>
											<option value="2">Tidak</option>
											</select>	
													<label for="form_control_1">Izin pemanfaatan dari pemegang hak atas tanah</label>
												</div>
											</div>
											
							</div>
							
							<div id="izinjing" style="display: none;">
							<h3 class="title">&nbsp;</h3>
							
							<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<div class="input-group">
													<span class="input-group-addon">
													<i class="fa fa-circle"></i>
													</span>
													<input class="form-control" id="no_dok_izin_pemanfaatan" name="no_dok_izin_pemanfaatan" type="text" placeholder="0-9 / A-Z" autocomplete="off">
													<label for="form_control_1">Nomor Dokumen Izin Pemanfaatan</label>
													
												</div>
											</div>
							</div>
							<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<div class="input-group">
													<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
													</span>
													<input class="form-control date-picker" type="text" id="tgl_terbit_phat" name="tgl_terbit_phat" data-date-format="yyyy-mm-dd" placeholder="2000/12/31" autocomplete="off"/>
													<label for="form_control_1">Tanggal Terbit Izin Pemanfaatan</label>
													
												</div>
											</div>
							</div>
							<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<div class="input-group">
													<span class="input-group-addon">
													<i class="fa fa-circle"></i>
													</span>
													<input class="form-control" id="nama_penerima_kuasa" name="nama_penerima_kuasa" type="text" placeholder="Nama Penerima Izin Pemanfaatan" autocomplete="off">
													<label for="form_control">Nama Penerima Izin Pemanfaatan</label>
													
												</div>
											</div>
							</div>
							<div class="col-md-6">
							
											<div class="form-group form-md-line-input">
											<div class="input-group">
													<span class="input-group-addon">
													<i class="fa fa-circle"></i>
													</span>
												<input style="display: none;" name="dir_file_phat" id="dir_file_phat" onchange='cokphat()'>
												<input type="file" class="form-control" name="d_file_phat" id="d_file_phat" accept="application/pdf" onchange='cokphat()'>
												<label for="form_control_1">Berkas Izin Pemanfaatan</label>
											</div>
											</div>
							</div>
							
							</div>
							
							</div>
							
							
								<div class="modal-footer">
									<button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
								</div>
							
						</div>
						</div>
					</form>
				
			</div>
		</div>
	
	</div>

<!-- /.modaledit -->
<div id="tanahnyaedit" class="modal fade" tabindex="-1"  role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
        </div>
        <!-- /.modal-content -->
	</div>
</div>	

<script>
function popWin(x){
	url = x;
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
	}
function set_status_izin_pemanfaatan(v)
{
	if(v == '1'){
		document.getElementById('izinjing').style.display="block";
	}else{
		document.getElementById('izinjing').style.display="none";
	}
}

function coktan(){
		
		$('#dir_file_tan').val(d_file_tan.value);
	}
	function cokphat(){
		
		$('#dir_file_phat').val(d_file_phat.value);
	}
	
$(function () {    
	 // Setup form validation on the #register-form element
	$("#FormTambahTanah").validate({
	    // Specify the validation rules
	    rules: {
			 
			id_dokumen: "required",
			nomor_dokumen: "required",
			tgl_terbit_dokumen: "required",
			luas_tanah: "required",
			hat2: "required",
			hat: "required",
			atas_nama: "required",
			lokasi_tanah: "required",
			d_file_tan: "required",
			
	    },
	        highlight: function(element) {
	            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
	    },
	        unhighlight: function(element) {
	            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
	    },
	      errorClass: 'help-block',
	    
	    // Specify the validation error messages
	    messages: {
			id_dokumen: "",
			nomor_dokumen: "",
			tgl_terbit_dokumen: "",
			luas_tanah: "",
			hat2: "",
			hat: "",
			atas_nama: "",
			lokasi_tanah: "",
			d_file_tan: "",
			
	    },
	    
	    submitHandler: function(form) {
	    	form.submit();
	    }
	});
	});
</script>



