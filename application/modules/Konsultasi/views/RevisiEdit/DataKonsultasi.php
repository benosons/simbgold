<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">Data Bangunan</div>
			</div>
			<div class="portlet box blue">
				<div class="portlet-body form">
					<form class="form-horizontal" role="form">
						<div class="form-body">
							<div class="row static-info">
								<div class="col-md-3 name">Jenis Permohonan Konsultasi</div>
								<div class="col-md-8 value"><?php echo $DataBangunan->nm_konsultasi; ?></div>
							</div>
							<div class="row static-info">
								<div class="col-md-3 name">Nama Bangunan Gedung</div>
								<div class="col-md-8 value"><?php echo $DataBangunan->nm_bgn; ?></div>
							</div>
							<div class="row static-info">
								<div class="col-md-3 name">Lokasi Bangunan Gedung</div>
								<div class="col-md-8 value">
									<?php echo $DataBangunan->almt_bgn; ?>, Kec. <?php echo $DataBangunan->nama_kecamatan; ?>, <?php echo ucwords(strtolower($DataBangunan->nama_kabkota)); ?>, Prov. <?php echo $DataBangunan->nama_provinsi; ?>
								</div>
							</div>
							<?php if ($DataBangunan->id_jenis_permohonan == '11') { ?>
								<div class="row static-info">
									<div class="col-md-3 name">Data Bangunan Kolektif</div>
									<div class="col-md-8 value">
										<table class="table table-striped table-bordered dt-responsive wrap" id="tipe_bgn">
											<tr>
												<th>Tipe</th>
												<th>Luas</th>
												<th>Tinggi</th>
												<th>Lantai</th>
												<th>Jumlah Unit</th>
											</tr>
											<?php
											$tipe = json_decode($DataBangunan->tipeA);
											$jumlah = json_decode($DataBangunan->jumlahA);
											$luas = json_decode($DataBangunan->luasA);
											$tinggi = json_decode($DataBangunan->tinggiA);
											$lantai = json_decode($DataBangunan->lantaiA);
											$bangunan = array();
											foreach ($tipe as $noo => $val) {
												if ($val != "")
													$bangunan['tipe'][$noo] = $val;
											}
											foreach ($jumlah as $noo => $val) {
												if ($val != "")
													$bangunan['jumlah'][$noo] = $val;
											}
											foreach ($luas as $noo => $val) {
												if ($val != "")
													$bangunan['luas'][$noo] = $val;
											}
											foreach ($tinggi as $noo => $val) {
												if ($val != "")
													$bangunan['tinggi'][$noo] = $val;
											}
											if (!empty($lantai))
												foreach ($lantai as $noo => $val) {
													if ($val != "")
														$bangunan['lantai'][$noo] = $val;
												}
											$no = 0;
											$LuasBg = 0;

											if (!empty($bangunan)) {
												foreach ($bangunan['tipe'] as $dt) {
													$no++;
													$LuasBg += $bangunan['luas'][$no] * $bangunan['jumlah'][$no];

											?>
													<tr id="tr-tipe<?php echo $no ?>">
														<td><?php echo form_input('tipeA[' . $no . ']', $bangunan['tipe'][$no], 'style="width:90px;" id="posisi' . $no . '" class="posisi' . $no . ' form-control"'); ?></td>
														<td><?php echo form_input('luasA[' . $no . ']', $bangunan['luas'][$no], 'style="width:100px;" id="luas' . $no . '" class="luas' . $no . ' form-control"'); ?></td>
														<td><?php echo form_input('tinggiA[' . $no . ']', $bangunan['tinggi'][$no], 'style="width:90px;" id="tinggi' . $no . '" class="tinggi' . $no . ' form-control"'); ?></td>
														<td><?php echo form_input('lantaiA[' . $no . ']', !empty($bangunan['lantai'][$no]) ? $bangunan['lantai'][$no] : '', 'style="width:90px;" id="lantai' . $no . '" class="lantai' . $no . ' form-control"'); ?></td>
														<td><?php echo form_input('jumlahA[' . $no . ']', $bangunan['jumlah'][$no], 'style="width:100px;" id="luas' . $no . '" class="jumlah' . $no . ' form-control"'); ?></td>

													</tr>
												<?php }
											} else { ?>
												<tr id="tr-tipe">
													<td><?php echo form_input('tipeA[1]', '', 'style="width:90px;" id="posisi1" class="posisi1 form-control"'); ?></td>
													<td><?php echo form_input('luasA[1]', '', 'style="width:100px;" id="luas1" class="unit1 form-control"'); ?></td>
													<td><?php echo form_input('tinggiA[1]', '', 'style="width:90px;" id="tinggi1" class="tinggi1 form-control"'); ?></td>
													<td><?php echo form_input('lantaiA[1]', '', 'style="width:90px;" id="lantai1" class="tinggi1 form-control"'); ?></td>
													<td><?php echo form_input('jumlahA[1]', '', 'style="width:100px;" id="jumlah1" class="unit1 form-control"'); ?></td>
													<td></td>
												</tr>
											<?php } ?>
										</table>
									</div>
								</div>
							<?php } else { ?>
								<?php if (isset($id_prasarana_bg) == 1) {
									$prasarana = "Kolam/Reservoir bawah tanah";
								} elseif (isset($id_prasarana_bg) == 2) {
									$prasarana = "Menara";
								} elseif (isset($id_prasarana_bg) == 3) {
									$prasarana = "Monument";
								} elseif (isset($id_prasarana_bg) == 4) {
									$prasarana = "Instalasi/Gardu";
								} elseif (isset($id_prasarana_bg) == 5) {
									$prasarana = "Reklame/Papan Nama";
								} else {
									$prasarana = "Bangunan Prasarana";
								} ?>
								<?php if ($DataBangunan->id_izin == '5') { ?>
									<div class="row static-info">
										<div class="col-md-3 name">Klasifikasi Bangunan Gedung</div>
										<div class="col-md-8 value">Tidak Sederhana</div>
									</div>
									<div class="row static-info">
										<div class="col-md-3 name">Luas Bangunan Gedung</div>
										<div class="col-md-8 value"><?php echo $DataBangunan->luas_bgp; ?> m<sup>2</sup></div>
									</div>
									<div class="row static-info">
										<div class="col-md-3 name">Ketinggian Bangunan Gedung</div>
										<div class="col-md-8 value"><?php echo $DataBangunan->tinggi_bgp; ?> Meter</div>
									</div>
								<?php } else if($DataBangunan->id_izin == '2'){
									if($DataBangunan->id_prasarana_bg != '0'){ ?>
										<div class="row static-info">
											<div class="col-md-3 name">Klasifikasi Bangunan Gedung</div>
											<div class="col-md-8 value">Tidak Sederhana</div>
										</div>
										<div class="row static-info">
											<div class="col-md-3 name">Fungsi Bangunan</div>
											<div class="col-md-8 value">Bangunan Prasarana</div>
										</div>
										<div class="row static-info">
											<div class="col-md-3 name">Klasifikasi Bangunan Gedung</div>
											<div class="col-md-8 value"><?php echo $DataBangunan->jns_prasarana; ?></div>
										</div>
											<div class="row static-info">
											<div class="col-md-3 name">Luas Bangunan Prasarana</div>
											<div class="col-md-8 value"><?php echo $DataBangunan->luas_bgp; ?> m<sup>2</sup></div>
										</div>
										<div class="row static-info">
											<div class="col-md-3 name">Ketinggian Bangunan Prasarana</div>
											<div class="col-md-8 value"><?php echo $DataBangunan->tinggi_bgp; ?> Meter</div>
										</div>
									
									<?php }

								}else{ ?>
									<?php if ($DataBangunan->luas_bgn >= '72') {
										$status_bg = 'Tidak Sederhana';
									} else {
										$status_bg = 'Sederhana';
									} ?>
									<div class="row static-info">
										<div class="col-md-3 name">Klasifikasi Bangunan Gedung</div>
										<div class="col-md-8 value"><?php echo $status_bg; ?></div>
									</div>
									<div class="row static-info">
										<div class="col-md-3 name">Fungsi Bangunan Gedung</div>
										<div class="col-md-8 value">
											<?php $queFungsi = $this->Mkonsultasi->get_jenis_fungsi_list($DataBangunan->id_fungsi_bg)->row();
											echo !empty($queFungsi) ? $queFungsi->fungsi_bg : ''; ?>
										</div>
									</div>
									<div class="row static-info">
										<div class="col-md-3 name">Luas Bangunan Gedung</div>
										<div class="col-md-8 value"><?php echo $DataBangunan->luas_bgn; ?> m<sup>2</sup></div>
									</div>
									<div class="row static-info">
										<div class="col-md-3 name">Ketinggian Bangunan Gedung</div>
										<div class="col-md-8 value"><?php echo $DataBangunan->tinggi_bgn; ?> Meter</div>
									</div>
									<div class="row static-info">
										<div class="col-md-3 name">Jumlah Lantai Bangunan Gedung</div>
										<div class="col-md-8 value"><?php echo $DataBangunan->jml_lantai; ?> Lantai</div>
									</div>
									<div class="row static-info">
										<div class="col-md-3 name">Luas Basement</div>
										<div class="col-md-8 value"><?php echo $DataBangunan->luas_basement; ?> - m<sup>2</sup></div>
									</div>
									<div class="row static-info">
										<div class="col-md-3 name">Jumlah Lantai Basement</div>
										<div class="col-md-8 value"><?php echo $DataBangunan->lapis_basement; ?> - Lantai</div>
									</div>
								<?php } ?>
								<div class="row static-info">
									<div class="col-md-3 name">Perancang Dokumen Teknis</div>
									<div class="col-md-8 value">Perencana Kontruksi</div>
								</div>
							<?php } ?>
						</div>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>
</div>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">Data Pemilik Bangunan</div>
	</div>
	<div class="portlet-body form">
		<center><?php echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '<button class="close" data-close="alert">' . '</button>' . '</div>' : '' ?></center>
		<form action="<?php echo site_url('Konsultasi/saveDataPemik'); ?>" class="form-horizontal" role="form" method="post" id="from_biodata">
			<input type="hidden" id='csrf_id' name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
			<div class="form-body">
				<div class="row static-info">
					<div class="col-md-2 name">Status Kepemilikan</div>
					<div class="col-md-4">
						<?php $opt_status = array(
							'' => '--Pilih--',
							'1' => 'Pemerintah',
							'2' => 'Perorangan/Badan Usaha'
						);
						echo form_dropdown('jns_pemilik', $opt_status, set_value('jns_pemilik', (isset($DataPemilik->jns_pemilik) ? $DataPemilik->jns_pemilik : '')), 'class="form-control"'); ?>
					</div>
				</div>
				<div class="row static-info">
					<div class="col-md-2 name">Nama Lengkap</div>
					<div class="col-md-2">
						<input type="hidden" class="form-control" value="<?php echo set_value('id', (isset($DataPemilik->id) ? $DataPemilik->id : '')) ?>" name="id" placeholder="id" autocomplete="off">
						<input type="text" class="form-control" value="<?php echo set_value('glr_depan', (isset($DataPemilik->glr_depan) ? $DataPemilik->glr_depan : $prof->row()->glr_depan)) ?>" name="glr_depan" placeholder="Gelar" autocomplete="off">
					</div>
					<div class="col-md-3">
						<input type="text" class="form-control" value="<?php echo set_value('nm_pemilik', (isset($DataPemilik->nm_pemilik) ? $DataPemilik->nm_pemilik : $prof->row()->nama_lengkap)) ?>" name="nm_pemilik" placeholder="Nama Lengkap Pemilik" autocomplete="off">
					</div>
					<div class="col-md-2">
						<input type="text" class="form-control" value="<?php echo set_value('glr_belakang', (isset($DataPemilik->glr_belakang) ? $DataPemilik->glr_belakang : $prof->row()->glr_belakang)) ?>" name="glr_belakang" placeholder="Gelar" autocomplete="off">
					</div>
				</div>
				<div class="row static-info">
					<label class="col-md-2 name">Jenis ID</label>
					<div class="col-md-3">
						<?php $opt_status = array(
							'1' => 'KTP',
							'2' => 'KITAS'
						);
						echo form_dropdown('jenis_id', $opt_status, set_value('jenis_id', (isset($DataPemilik->jenis_id) ? $DataPemilik->jenis_id : '')), 'class="form-control" id="jenis_id"'); ?>
					</div>
				</div>
				<div class="row static-info" id="ktp" style="display: none;">
					<label class="col-md-2 name">No. KTP</label>
					<div class="col-md-4">
						<input type="text" maxlength="16" class="allownumericwithoutdecimal form-control" value="<?php echo set_value('no_ktp', (isset($DataPemilik->no_ktp) ? $DataPemilik->no_ktp : $prof->row()->no_ktp)) ?>" name="no_ktp" placeholder="Nomor KTP" autocomplete="off">
					</div>
				</div>
				<div class="row static-infop" id="kitas" style="display: none;">
					<label class="col-md-2 name">No. KITAS</label>
					<div class="col-md-4">
						<input type="text" class="form-control" value="<?php echo set_value('no_kitas', (isset($DataPemilik->no_kitas) ? $DataPemilik->no_kitas : '')) ?>" name="no_kitas" placeholder="Nomor KITAS" autocomplete="off">
					</div>
				</div>
				<div class="row static-info">
					<label class="col-md-2 name">Provinsi</label>
					<div class="col-md-4">
						<select name="nama_provinsi" id="nama_provinsi" class="form-control select2" data-placeholder="Select...">
							<option value="">-- Pilih Provinsi --</option>
							<?php if ($daftar_provinsi->num_rows() > 0) {
								foreach ($daftar_provinsi->result() as $key) {
									if ($key->id_provinsi == (isset($DataPemilik->id_provinsi) ? $DataPemilik->id_provinsi : $prof->row()->id_provinsi)) {
										$plhrole = "selected";
									} else {
										$plhrole = "";
									}
									echo '<option value="' . $key->id_provinsi . '" ' . $plhrole . '>' . $key->nama_provinsi . '</option>';
								}
							} ?>
						</select>
					</div>
				</div>
				<div class="row static-info">
					<label class="col-md-2 name">Kab/Kota</label>
					<div class="col-md-4">
						<select name="nama_kabkota" id="nama_kabkota" class="form-control select2" data-placeholder="Select...">
							<option value="">-- Pilih Kabupaten / Kota --</option>
						</select>
					</div>
				</div>
				<div class="row static-info">
					<label class="col-md-2 name">Kecamatan</label>
					<div class="col-md-4">
						<select name="nama_kecamatan" id="nama_kecamatan" class="form-control select2" data-placeholder="Select...">
							<option value="">-- Pilih Kecamatan --</option>
						</select>
					</div>
				</div>
				<div class="row static-info">
					<label class="col-md-2 name">Kelurahan</label>
					<div class="col-md-4">
						<select name="nama_kelurahan" id="nama_kelurahan" class="form-control select2" data-placeholder="Select...">
							<option value="">-- Pilih Kelurahan --</option>
						</select>
					</div>
				</div>
				<div class="row static-info">
					<label class="col-md-2 name">Alamat</label>
					<div class="col-md-7">
						<textarea type="text" class="form-control" name="alamat" placeholder="Alamat" autocomplete="off"><?php echo set_value('alamat', (isset($DataPemilik->alamat) ? $DataPemilik->alamat : $prof->row()->alamat)) ?></textarea>
					</div>
				</div>
				<div class="row static-info">
					<label class="col-md-2 name">No Telp / HP</label>
					<div class="col-md-4">
						<input type="text" class="form-control" value="<?php echo set_value('no_hp', (isset($DataPemilik->no_hp) ? $DataPemilik->no_hp : $prof->row()->no_hp)) ?>" name="no_hp" placeholder="No HP" autocomplete="off">
					</div>
				</div>
				<div class="row static-info">
					<label class="col-md-2 name">Alamat Email</label>
					<div class="col-md-5">
						<input type="email" class="form-control" placeholder="Alamat Email Aktif" value="<?php echo set_value('email', (isset($DataPemilik->email) ? $DataPemilik->email :  $prof->row()->email)) ?>" name="email" readonly>
					</div>
				</div>
			</div>
	</div>
	<div class="portlet box blue-hoki">
		<div class="portlet-title">
			<div class="caption">Data Tanah </div>
		</div>
		<div class="portlet-body">
			<table class="table table-bordered table-striped table-hover" id="sample_editable_1">
				<thead>
					<tr class="warning">
						<th>
							<center>No.</center>
						</th>
						<th>
							<center>Jenis Dokumen</center>
						</th>
						<th>
							<center>No. dan Tgl Dokumen</center>
						</th>
						<th>
							<center>Luas Tanah (m<sup>2</sup>)</center>
						</th>
						<th>
							<center>Atas Nama</center>
						</th>
						<th>
							<center>Berkas</center>
						</th>
						<th>
							<center>Izin Pemanfaatan</center>
						</th>
						<th>
							<center>Aksi</center>
						</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if ($DataTanah->num_rows() > 0) {
						$no = 1;
						foreach ($DataTanah->result() as $key) {
							if ($key->id_dokumen == '1') {
								$jenis_dokumen = "Sertifikat";
							} else if ($key->id_dokumen == '2') {
								$jenis_dokumen = "Akte Jual Beli";
							} else if ($key->id_dokumen == '3') {
								$jenis_dokumen = "Girik";
							} else if ($key->id_dokumen == '4') {
								$jenis_dokumen = "Petuk";
							} else {
								$jenis_dokumen = "Bukti Lain - Lain";
							}
							$filename = FCPATH . "/object-storage/dekill/Earth/$key->dir_file";
							$filenamephat = FCPATH . "/object-storage/dekill/Earth/$key->dir_file_phat";
							$dir = '';
							if (file_exists($filename)) {
								$dir = base_url('object-storage/dekill/Earth/' . $key->dir_file);
							} else {
								$dir = base_url('object-storage/file/Konsultasi/' . $key->id . '/data_tanah/' . $key->dir_file);
							}

							if (file_exists($filenamephat)) {
								$dirphat = base_url('object-storage/dekill/Earth/' . $key->dir_file_phat);
							} else {
								$dirphat = base_url('object-storagefile/Konsultasi/' . $key->id . '/data_tanah/' . $key->dir_file_phat);
							} ?>
							<tr>
								<td align="center"> <?php echo $no++; ?></td>
								<td align="center"> <?php echo $jenis_dokumen; ?></td>
								<td align="center"> <?php echo $key->no_dok; ?><br><?php echo $key->tanggal_dok; ?></td>
								<td align="center"> <?php echo $key->luas_tanah; ?></td>
								<td align="center"> <?php echo $key->atas_nama_dok; ?></td>
								<td align="center"><a href="javascript:void(0);" onClick="javascript:popWin('<?php echo $dir; ?>')" class="btn default btn-xs blue-stripe">Lihat</a></td>
								<?php if ($key->dir_file_phat != "") { ?>
									<td align="center"><a href="javascript:void(0);" onClick="javascript:popWin('<?php echo $dirphat ?>')" class="btn default btn-xs blue-stripe">Lihat</a></td>
								<?php } else { ?>
									<td></td>
								<?php } ?>
								<td align="center">
									<a class="btn btn-warning btn-sm" onClick="Editdatatanah('<?php echo $key->id_detail; ?>')" title="Ubah Data Tanah"> <span class="glyphicon glyphicon-pencil"></span></a>
								</td>
							</tr>
					<?php }
					} ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">Nilai Perhitungan Retribusi</div>
	</div>
	<div class="portlet-body form">
		<form class="form-horizontal" role="form">
			<div class="form-body">
				<div class="row">
					<input type="hidden" class="form-control" value="<?php echo set_value('id', (isset($id) ? $id : '')) ?>" name="id" placeholder="id" autocomplete="off">
					<?php if ($retribusi->status_perhitungan != '1') { ?>
						<div class="col-md-12 pembayaran-retribusi">
							<div class="form-group">
								<label class="control-label col-md-4" style="text-align:left;">Retribusi Bangunan</label>
								<div class="col-md-4">
									<p class="form-control-static shst">Rp. <?php echo number_format(str_replace('.', ',', $retribusi->nilai_retribusi_bangunan)) ?></p>
								</div>
							</div>
						</div>
						<div class="col-md-12 pembayaran-retribusi">
							<div class="form-group">
								<label class="control-label col-md-4" style="text-align:left;">Retribusi Prasarana</label>
								<div class="col-md-4">
									<p class="form-control-static shst">Rp. <?php echo number_format(str_replace('.', ',', $retribusi->nilai_retribusi_prasarana)) ?></p>
								</div>
							</div>
						</div>
						<div class="col-md-12 pembayaran-retribusi">
							<div class="form-group">
								<label class="control-label col-md-4" style="text-align:left;">Total Retribusi</label>
								<div class="col-md-4">
									<p class="form-control-static shst">Rp. <?php echo number_format(str_replace('.', ',', $retribusi->nilai_retribusi_keseluruhan)) ?></p>
								</div>
							</div>
						</div>
						<div class="col-md-12 upload-retribusi">
							<div class="form-group">
								<label class="control-label col-md-4" style="text-align:left;">Dokumen Perhitungan Retribusi</label>
								<div class="col-md-4">
									<a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('object-storage/dekill/Retribution/' . $retribusi->file_retribusi); ?>')" class="btn default btn-md blue-stripe">Dokumen Perhitungan</a>
								</div>
							</div>
						</div>
					<?php } else { ?>
						<div class="portlet-body form">

							<div class="form-body">
								<div class="row static-info">
									<div class="col-md-3 name">Indeks Parameter Fungsi Bangunan</div>
									<div class="col-md-8 value">
										<?php $queFungsi = $this->Mkonsultasi->get_jenis_fungsi_list($DataBangunan->id_fungsi_bg)->row();
										echo !empty($queFungsi) ? $queFungsi->fungsi_bg : '';

										if ($DataBangunan->id_fungsi_bg == 1) {
											$indexParameter = $DataBangunan->id_klasifikasi == 1 ? 0.15 : 0.17;
										} else if ($DataBangunan->id_fungsi_bg == 6) {
											$indexParameter = $DataBangunan->luas_bgn > 500 ? 0.8 : 0.6;
										} else {
											$indexParameter = $DataBangunan->index_parameter == NULL ? 0.15 : $DataBangunan->index_parameter;
										}
										echo " ({$indexParameter})";
										?>

									</div>
								</div>
								<div class="row static-info">
									<div class="col-md-3 name">Indeks Parameter Kompleksitas</div>
									<div class="col-md-8 value">
										<?php
										$parameterDasar = 0.3;
										$parameterKompleksitas = $DataBangunan->id_klasifikasi == 1 ? 1 : 2;
										$hasilParameterKompleksitas = $parameterDasar * $parameterKompleksitas;
										$rumusKompleksitas = "{$parameterDasar} x {$parameterKompleksitas} = $hasilParameterKompleksitas";

										echo $DataBangunan->nm_bgn . " ({$hasilParameterKompleksitas})";


										?></div>
								</div>
								<div class="row static-info">
									<div class="col-md-3 name">Indeks Parameter Permanensi Bangunan</div>
									<?php

									$permanensi = $retribusi->id_permanensi == 1 ? 'Permanen' : 'Non Permanen';
									$parameterPermanensiDasar = 0.2;
									$hasilParameterPermanensi = $parameterPermanensiDasar * intval($retribusi->id_permanensi);
									$rumusPermanensi = "{$parameterPermanensiDasar} x {$retribusi->id_permanensi} = $hasilParameterPermanensi";

									?>
									<div class="col-md-8 value"><?php echo $permanensi . " ({$rumusPermanensi})"; ?></div>
								</div>
								<div class="row static-info">
									<div class="col-md-3 name">Indeks Parameter Ketinggian</div>
									<div class="col-md-8 value">
										<?php
										$jumlahLantai 				= $DataBangunan->jml_lantai;
										$lapisBsement 				= $DataBangunan->lapis_basement;
										$getKoefisienLantai 		= $this->Mkonsultasi->getKoefisienLantai($jumlahLantai)->row();
										$getKoefisienBasement 		= $this->Mkonsultasi->getKoefisienBasement($lapisBsement)->row();
										$kl 						= $getKoefisienLantai === NULL ? 0 : $getKoefisienLantai->koefisien_lantai;
										$kb 						= $getKoefisienBasement === NULL ? 0 : $getKoefisienBasement->koefisien_basement;
										$koefisienLantai 			= ($kl) === true ? number_format((float)$getKoefisienLantai->koefisien_lantai, 3, '.', '') : intval($kl);
										$koefisienBasement 			= ($kb) === true ? number_format((float)$getKoefisienBasement->koefisien_basement, 3, '.', '') : intval($kb);

										if ($DataBangunan->id_jenis_permohonan == '11') {
											$luas_bangunan = $LuasBg;
										} else if ($DataBangunan->id_jenis_permohonan == '12') {
											$luas_bangunan = $DataBangunan->luas_bgp;
										} else {
											$luas_bangunan = $DataBangunan->luas_bgn;
										}

										$pk = 0.5;
										$kl = $koefisienLantai;
										$kb = $koefisienBasement;
										$ll = floatval($luas_bangunan);
										$lb = floatval($DataBangunan->luas_basement);
										$lli = $ll * $kl;
										$lbi = $lb * $kb;
										$dkb = $ll + $lb;
										$dkbif = $dkb <= 0 ? 1 : $dkb;
										$koefisienBG = ($lli + $lbi) / $dkbif;
										$hasilKoefisienBG = bcadd(0, $koefisienBG, 3);
										$hasilPK = $pk * $hasilKoefisienBG;
										$hasilRumusPK = bcadd(0, $hasilPK, 3);
										$rumusPK = "{$pk} x {$hasilKoefisienBG} = $hasilRumusPK";
										echo $DataBangunan->nm_bgn . " ({$rumusPK})"; ?>
									</div>
								</div>
								<div class="row static-info">
									<div class="col-md-3 name">Faktor Kepemilikan</div>
									<div class="col-md-8 value">
										<?php
										$kepemilikan = $DataPemilik->jns_pemilik == 0 && $DataPemilik->jns_pemilik != NULL ? 'Pemerintah' : 'Perorangan/Usaha';
										$faktorKepemilikan = $DataPemilik->jns_pemilik == 0 && $DataPemilik->jns_pemilik != NULL ? 0 : 1;
										echo $kepemilikan . " ({$faktorKepemilikan})"; ?></div>
								</div>
								<div class="row static-info">
									<div class="col-md-3 name">Indeks Terintegrasi</div>
									<div class="col-md-8 value">
										<?php
										$pFungsi = $indexParameter;
										$pKompleksitas = $hasilParameterKompleksitas;
										$pKetinggian  = $hasilRumusPK;
										$pPermanensi = $parameterPermanensiDasar;
										$pKepemilikan = $faktorKepemilikan;
										$hasilIndeksIntegrasi = $retribusi->indeks_integrasi;
										$rumusIndeksIntegrasi = "{$pFungsi} x ({$pKetinggian} + {$pPermanensi} + $pKetinggian) x $pKepemilikan = $hasilIndeksIntegrasi";
										echo $rumusIndeksIntegrasi; ?>
									</div>
								</div>
								<div class="row static-info">
									<div class="col-md-3 name">Luas Bangunan Gedung</div>
									<div class="col-md-8 value"><?php echo $luas_bangunan . " m<sup>2"; ?></div>
								</div>
								<div class="row static-info">
									<div class="col-md-3 name">SHST (Standar Harga Satuan Tertinggi)</div>
									<div class="col-md-8 value">
										<?php
										$shst  = $retribusi !== NULL ? $retribusi->shst : '';

										echo "Rp. " . number_format($shst); ?></div>
								</div>
								<div class="row static-info">
									<div class="col-md-3 name">Indeks Lokalitas</div>
									<div class="col-md-8 value">

										<?php
										$lokalitas = $retribusi !== NULL ? $retribusi->indeks_lokalitas : '';
										$lsplit = $lokalitas !== ''  &&  $lokalitas != 0 ? explode('.', $lokalitas) : '';
										$splitL = $lokalitas !== '' &&  $lokalitas != 0 ? $lsplit[1] : '';
										echo $splitL; ?></div>
								</div>
								<div class="row static-info">
									<div class="col-md-3 name">Kegiatan</div>
									<div class="col-md-8 value">
										<?php
										$id_kegiatan = $retribusi !== NULL ? $retribusi->id_kegiatan : '';	
										echo $id_kegiatan;
										?></div>
								</div>
								<div class="row static-info">
									<div class="col-md-3 name">Nilai Retribusi Bangunan</div>
									<div class="col-md-8 value">Rp. <?php echo number_format(str_replace('.', ',', $retribusi->nilai_retribusi_bangunan)) ?></div>
								</div>
								<div class="row static-info">
									<div class="col-md-3 name">Nilai Retribusi Prasarana</div>
									<div class="col-md-8 value">
										<table class="table table-bordered table-striped table-hover" id="sample_editable_1">
											<thead>
												<tr class="warning">
													<th>
														<center>No.</center>
													</th>
													<th>
														<center>Nama Prasarana</center>
													</th>
													<th>
														<center>Harga Prasarana</center>
													</th>
													<th>
														<center>Panjang/Luas/Volume</center>
													</th>
													<th>
														<center>Nilai Retribusi</center>
													</th>
												</tr>
											</thead>
											<tbody>
												<?php
												if ($Prasarana->num_rows() > 0) {
													$no = 1;
													foreach ($Prasarana->result() as $key) { ?>
														<tr>
															<td align="center"> <?php echo $no++; ?></td>
															<td align="center"> <?php echo $key->nama_prasarana; ?></td>
															<td align="center">Rp. <?php echo $key->harga_prasarana; ?></td>
															<td align="center"> <?php echo $key->plv; ?></td>
															<td align="center">Rp. <?php echo number_format(str_replace('.', ',', $key->total_prasarana)) ?></td>
														</tr>
												<?php }
												} ?>
											</tbody>
										</table>
									</div>
								</div>
								<div class="row static-info">
									<div class="col-md-3 name">Nilai Total Bangunan</div>
									<div class="col-md-8 value">Rp. <?php echo number_format(str_replace('.', ',', $retribusi->nilai_retribusi_keseluruhan)) ?></div>
								</div>

							</div>

						</div>
					<?php } ?>
				</div>
			</div>

	</div>
</div>
</div>
<div class="form-actions">
	<center>
		<h4><b><input type="checkbox" name="pernyataan" id="pernyataan" value="1">Dengan ini saya mengkonfirmasi bahwa data tersebut di atas sudah benar dan Saya menyatakan kesanggupan untuk membayar Retibusi PBG senilai sebagaimana tercantum.</h4></b>
		<button type="submit" class="btn green">Terkonfirmasi</button>
	</center>
</div>
</form>
</div>
</div>
<div id="modal_psk_edit" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-width="50%" data-keyboard="false">
	<?php echo form_open_multipart('Konsultasi/simpanedittanah', [
		'class' => 'form-horizontal',
		'role' => 'form',
		'id' => 'edit_psk'
	]) ?>
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onClick="ResRes2()"></button>
			<span class="caption-subject text-primary bold uppercase " style="font-size:15px;">Form Ubah Data SK</span>
		</div>
		<div class="modal-body">
			<div class="form-body">
				<div class="row">
					<br>
					<div class="col-md-6">
						<div class="form-group form-md-line-input">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-circle"></i></span>
								<select name="id_dokumen" class="form-control">
									<option value="1">Sertifikat</option>
									<option value="2">Akte Jual Beli</option>
									<option value="3">Girik</option>
									<option value="4">Petuk</option>
									<option value="5">Bukti Lain-Lain</option>
								</select>
								<label for="form_control_1">Jenis Dokumen Kepemilikan Data Tanah <span class="required" aria-required="true"> * </span></label>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group form-md-line-input">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-circle"></i></span>
								<input class="form-control" name="no_dok" type="text" placeholder="0-9 / A-Z" autocomplete="off">
								<input style="display:none;" class="form-control" name="id_detail" placeholder="id_detail" autocomplete="off">
								<label for="form_control_1">No. Dokumen Data Tanah<span class="required" aria-required="true"> * </span></label>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group form-md-line-input">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								<input class="form-control datepicker" type="text" name="tanggal_dok" data-date-format="yyyy-mm-dd" autocomplete="off" placeholder="2000/12/31" onkeydown="return false">
								<label for="form_control_1">Tgl. Terbit Dokumen<span class="required" aria-required="true"> * </span></label>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group form-md-line-input">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								<input class="form-control" id="luas_tanah" name="luas_tanah" type="text" placeholder="Luas Tanah 00.00" autocomplete="off">
								<label for="form_control_1">Luas Tanah m<sup>2</sup><span class="required" aria-required="true"> * </span></label>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group form-md-line-input">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-circle"></i></span>
								<select name="hat" class="form-control">
									<option value="1">Hak Milik</option>
									<option value="2">Hak Pakai</option>
									<option value="3">Hak Pengelolaan</option>
									<option value="4">Hak Guna Bangunan</option>
									<option value="5">Hak Guna Usaha</option>
									<option value="6">Hak Wakaf</option>
								</select>
								<label for="form_control_1">Hak Kepemilikikan Atas Tanah <span class="required" aria-required="true"> * </span></label>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group form-md-line-input">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-circle"></i></span>
								<input class="form-control" id="atas_nama_dok" name="atas_nama_dok" type="text" placeholder="Nama Pemegang Hak Atas Tanah" autocomplete="off">
								<label for="form_control">Nama Pemilik Hak Atas Tanah</label>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group form-md-line-input">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-circle"></i></span>
								<input type="text" class="form-control" rows="1" placeholder="Lokasi Tanah" id="lokasi_tanah" name="lokasi_tanah" readonly>
								<label for="form_control_1">Alamat Lokasi Tanah</label>
							</div>
						</div>
					</div>

					<div class="col-md-12">
						<div class="form-group form-md-line-input">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-circle"></i>
								</span>
								<input type="file" class="form-control" name="berkas" accept="application/pdf">
								<label for="form_control_1">Lampiran SK <span class="required" aria-required="true"> * </span></label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn red" onClick="ResRes2()"><i class="fa fa-sign-out"></i> Batal</button>
			<button type="submit" class="btn green"><i class="fa fa-save"></i> Simpan</button>
		</div>
	</div>
	<?php echo form_close(); ?>
</div>

<script>
	function Editdatatanah(id) {
		$.ajax({
			type: "GET",
			url: "<?php echo base_url('Konsultasi/Editdatatanah/') ?>",
			dataType: "JSON",
			data: {
				id: id
			},
			success: function(data) {
				$.each(data, function() {
					$('#modal_psk_edit').modal('show');
					$('[name="id_detail"]').val(data.id_detail);
					$('[name="id"]').val(data.id);
					$('[name="id_dokumen"]').val(data.id_dokumen);
					$('[name="no_dok"]').val(data.no_dok);
					$('[name="luas_tanah"]').val(data.luas_tanah);
					$('[name="atas_nama_dok"]').val(data.atas_nama_dok);
					$('[name="hat"]').val(data.hat);
					$('[name="lokasi_tanah"]').val(data.lokasi_tanah);
				});
			}
		});
		return false;
	};


	$(function() {
		get_data_edit();
		$('.select2').select2();
		// Setup form validation on the #register-form element
		$("#from_biodata").validate({

			// Specify the validation rules
			rules: {
				jns_pemilik: "required",
				nm_pemilik: "required",
				alamat: "required",

				nama_provinsi: "required",
				nama_kabkota: "required",

				nama_kecamatan: "required",

				no_hp: {
					minlength: 6,
					required: true,
					number: true
				},
				email: {
					required: true,
					email: true
				},
				//no_ktp : "required",
				no_ktp: {
					minlength: 6,
					required: true,
					number: true
				},

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
				jns_pemilik: "Status Kepemilikan Tidak Boleh Kosong",
				nm_pemilik: "Masukkan Nama Anda",
				alamat: "Masukkan Alamat Anda",
				no_ktp: {
					required: "Wajib diisi",
					minlength: "Nomor Identitas minimal 6 karakter",
					//atLeastOneLetter: "Password harus berupa gabungan huruf dan angka",
					number: "ID harus berupa angka",
				},
				no_hp: {
					required: "Masukkan Nomor Telp/HP Aktif",
					minlength: "Nomor Identitas minimal 6 karakter",
					//atLeastOneLetter: "Password harus berupa gabungan huruf dan angka",
					number: "ID harus berupa angka",
				},
				nama_provinsi: "Pilih Provinsi",
				nama_kabkota: "Pilih Kabupaten/Kota",
				nama_kecamatan: "Pilih Kecamatan",

				email: "Masukkan Alamat E-Mail Anda",

			},
			submitHandler: function(form) {
				form.submit();
			}
		});
		var jenis_id = $('#jenis_id').val();
		if (jenis_id == '' || jenis_id == 1) {
			$('#ktp').show();
		}

		$('#jenis_id').change(function() {
			var v = $(this).val();
			if (v == 1) {
				$('#ktp').show();
				$('#kitas').hide();
			}
			if (v == 2) {
				$('#ktp').hide();
				$('#kitas').show();
			}
		});
	});

	function get_data_edit() {
		$('#nama_provinsi').val('<?= isset($DataPemilik->id_provinsi) ? $DataPemilik->id_provinsi : $prof->row()->id_provinsi; ?>').trigger('change');
		$('#nama_kabkota').val('<?= isset($DataPemilik->id_kabkota) ? $DataPemilik->id_kabkota : $prof->row()->id_kabkota; ?>').trigger('change');
		$('#nama_kecamatan').val('<?= isset($DataPemilik->id_kecamatan) ? $DataPemilik->id_kecamatan : $prof->row()->id_kecamatan; ?>').trigger('change');
		$('#nama_kelurahan').val('<?= isset($DataPemilik->id_kelurahan) ? $DataPemilik->id_kelurahan : $prof->row()->id_kelurahan; ?>').trigger('change');
	}

	$('#nama_provinsi').change(function() {
		var v = $(this).val();
		var select = "<?= isset($DataPemilik->id_kabkota) ? $DataPemilik->id_kabkota : $prof->row()->id_kabkota; ?>";
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>Konsultasi/getDataKabKota/' + v,
			data: $('form.form-horizontal').serialize(),
			success: function(response) {
				let data = JSON.parse(response);
				let csrf_token = data.csrf;
				$('#csrf_id').val(csrf_token);
				$('select[name="nama_kabkota"]').empty();
				$('select[name="nama_kabkota"]').append('<option value=""> -- Pilih -- </option>');
				delete data.csrf;
				$.each(data, function(key, value) {
					if (select == value.id_kabkot) {
						$('select[name="nama_kabkota"]').append('<option value="' + value.id_kabkot + '" selected>' + value.nama_kabkota + '</option>').trigger('change');
					} else {
						$('select[name="nama_kabkota"]').append('<option value="' + value.id_kabkot + '">' + value.nama_kabkota + '</option>');
					}
				});

			},
			error: function(error) {
				console.log(' Tidak Ditemukan');
			}
		});
		// jQuery.post(base_url + 'Konsultasi/getDataKabKota/' + v, function(data) {
		// 	$('select[name="nama_kabkota"]').empty();
		// 	$.each(data, function(key, value) {
		// 		if (select == value.id_kabkot) {
		// 			$('select[name="nama_kabkota"]').append('<option value="' + value.id_kabkot + '" selected>' + value.nama_kabkota + '</option>').trigger('change');
		// 		} else {
		// 			$('select[name="nama_kabkota"]').append('<option value="' + value.id_kabkot + '">' + value.nama_kabkota + '</option>');
		// 		}
		// 	});
		// }, 'json');
	});


	$('#nama_kabkota').change(function() {
		var v = $(this).val();
		var select = "<?= isset($DataPemilik->id_kecamatan) ? $DataPemilik->id_kecamatan : $prof->row()->id_kecamatan; ?>";

		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>Konsultasi/getDataKecamatan/' + v,
			data: $('form.form-horizontal').serialize(),
			success: function(response) {
				let data = JSON.parse(response);
				let csrf_token = data.csrf;
				$('#csrf_id').val(csrf_token);
				$('select[name="nama_kecamatan"]').empty();
				$('select[name="nama_kecamatan"]').append('<option value=""> -- Pilih -- </option>');
				delete data.csrf;
				$.each(data, function(key, value) {
					if (select == value.id_kecamatan) {
						$('select[name="nama_kecamatan"]').append('<option value="' + value.id_kecamatan + '" selected>' + value.nama_kecamatan + '</option>').trigger('change');
					} else {
						$('select[name="nama_kecamatan"]').append('<option value="' + value.id_kecamatan + '">' + value.nama_kecamatan + '</option>');
					}
				});
			},
			error: function(error) {
				console.log(' Tidak Ditemukan');
			}
		});
	});

	$('#nama_kecamatan').change(function() {
		var v = $(this).val();
		var select = "<?= isset($DataPemilik->id_kelurahan) ? $DataPemilik->id_kelurahan : $prof->row()->id_kelurahan; ?>";

		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>Konsultasi/getDataKelurahan/' + v,
			data: $('form.form-horizontal').serialize(),
			success: function(response) {
				let data = JSON.parse(response);
				let csrf_token = data.csrf;
				$('#csrf_id').val(csrf_token);
				$('select[name="nama_kelurahan"]').empty();
				$('select[name="nama_kelurahan"]').append('<option value=""> -- Pilih -- </option>');
				delete data.csrf;
				$.each(data, function(key, value) {
					if (select == value.id_kelurahan) {
						$('select[name="nama_kelurahan"]').append('<option value="' + value.id_kelurahan + '" selected>' + value.nama_kelurahan + '</option>').trigger('change');
					} else {
						$('select[name="nama_kelurahan"]').append('<option value="' + value.id_kelurahan + '">' + value.nama_kelurahan + '</option>');
					}
				});
			},
			error: function(error) {
				console.log(' Tidak Ditemukan');
			}
		});

		// jQuery.post(base_url + 'Konsultasi/getDataKelurahan/' + v, function(data) {
		// 	$('select[name="nama_kelurahan"]').empty();
		// 	$.each(data, function(key, value) {
		// 		if (select == value.id_kelurahan) {
		// 			$('select[name="nama_kelurahan"]').append('<option value="' + value.id_kelurahan + '" selected>' + value.nama_kelurahan + '</option>').trigger('change');
		// 		} else {
		// 			$('select[name="nama_kelurahan"]').append('<option value="' + value.id_kelurahan + '">' + value.nama_kelurahan + '</option>');
		// 		}
		// 	});
		// }, 'json');
	});

	/**
	 * Custom validator for contains at least one lower-case letter
	 */
	$.validator.addMethod("atLeastOneLowercaseLetter", function(value, element) {
		return this.optional(element) || /[a-z]+/.test(value);
	}, "Must have at least one lowercase letter");

	/**
	 * Custom validator for contains at least one upper-case letter.
	 */
	$.validator.addMethod("atLeastOneUppercaseLetter", function(value, element) {
		return this.optional(element) || /[A-Z]+/.test(value);
	}, "Must have at least one uppercase letter");

	$.validator.addMethod("atLeastOneLetter", function(value, element) {
		return this.optional(element) || /[a-zA-Z]+/.test(value);
	}, "Must have at least one letter");

	/**
	 * Custom validator for contains at least one number.
	 */
	$.validator.addMethod("atLeastOneNumber", function(value, element) {
		return this.optional(element) || /[0-9]+/.test(value);
	}, "Must have at least one number");

	/**
	 * Custom validator for contains at least one symbol.
	 */
	$.validator.addMethod("atLeastOneSymbol", function(value, element) {
		return this.optional(element) || /[!@#$%^&*()]+/.test(value);
	}, "Must have at least one symbol");

	$(".allownumericwithoutdecimal").on("keypress keyup blur", function(event) {
		$(this).val($(this).val().replace(/[^\d].+/, ""));
		if ((event.which < 48 || event.which > 57)) {
			event.preventDefault();
		}
	});

	function simpan() {
		alert('xx');
	}
</script>