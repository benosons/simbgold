<div class="portlet box blue">
	<div class="portlet-body form">
		<form class="form-horizontal" role="form">
			<div class="form-body">
				<div class="row">
					<div class="col-md-9">
						<div class="form-group">
							<label class="control-label col-md-3">Jenis Konsultasi </label>
							<div class="col-md-9">
								<p class="form-control-static"><?php echo $DataBangunan->nm_konsultasi; ?></p>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Nama Pemilik </label>
							<div class="col-md-9">
								<p class="form-control-static"><?php echo $DataPemilik->nm_pemilik; ?></p>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Alamat Pemilik Bangunan </label>
							<div class="col-md-9">
								<p class="form-control-static">
									<?php echo $DataPemilik->alamat; ?>, Kec. <?php echo $DataPemilik->nama_kecamatan; ?>, <?php echo ucwords(strtolower($DataPemilik->nama_kabkota)); ?>, Prov. <?php echo $DataPemilik->nama_provinsi; ?>
								</p>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Lokasi Bangunan Gedung </label>
							<div class="col-md-9">
								<p class="form-control-static">
									<?php echo $DataBangunan->almt_bgn; ?>, Kel/Desa. <?php echo $DataBangunan->nama_kelurahan; ?>, Kec. <?php echo $DataBangunan->nama_kecamatan; ?>, <?php echo ucwords(strtolower($DataBangunan->nama_kabkota)); ?>, Prov. <?php echo $DataBangunan->nama_provinsi; ?>
								</p>
							</div>
						</div>
						<?php if($DataBangunan->id_jenis_permohonan =='12'){ ?>
							<div class="form-group">
								<label class="control-label col-md-3">Data Bangunan Prasarana</label>
								<div class="col-md-9"><p class="form-control-static">Luas : <?php echo $DataBangunan->luas_bgp; ?>m<sup>2</sup>, Tinggi : <?php echo $DataBangunan->tinggi_bgp; ?> Meter</p></div>
							</div>
						<?php }else if($DataBangunan->id_jenis_permohonan =='14'){
							if($DataBangunan->permohonan_slf =='2'){ ?>
								<div class="form-group">
								<label class="control-label col-md-3">Data Bangunan Prasarana</label>
								<div class="col-md-9"><p class="form-control-static">Luas : <?php echo $DataBangunan->luas_bgp; ?>m<sup>2</sup>, Tinggi : <?php echo $DataBangunan->tinggi_bgp; ?> Meter</p></div>
							</div>
							<?php }else{ ?>
								<div class="form-group">
								<label class="control-label col-md-3">Data Bangunan </label>
								<div class="col-md-9"><p class="form-control-static">Luas : <?php echo $DataBangunan->luas_bgn; ?>m<sup>2</sup>, Tinggi : <?php echo $DataBangunan->tinggi_bgn; ?> Meter, Jumlah Lantai : <?php echo $DataBangunan->jml_lantai; ?> Lantai</p></div>
							</div>
							<?php } ?>

						<?php }else if($DataBangunan->id_jenis_permohonan =='35' || $DataBangunan->id_jenis_permohonan =='36'){ ?>
							<div class="form-group">
							<label class="control-label col-md-3">Data Bangunan </label>
							<div class="col-md-9"><p class="form-control-static">Luas : <?php echo $DataBangunan->luas_bgp; ?>m<sup>2</sup>, Tinggi : <?php echo $DataBangunan->tinggi_bgp; ?> Meter</p></div>
						</div>
						<?php } else if ($DataBangunan->id_jenis_permohonan =='11' ||$DataBangunan->id_jenis_permohonan =='29' || $DataBangunan->id_jenis_permohonan =='30' || $DataBangunan->id_jenis_permohonan =='31' ||$DataBangunan->id_jenis_permohonan =='32' ||$DataBangunan->id_jenis_permohonan =='33'){?>
							<div class="form-group">
								<label class="control-label col-md-3">Data Bangunan Kolektif :</label>
								<div class="col-md-9">
								<table class="table table-striped table-bordered dt-responsive wrap" id="tipe_bgn">
								<tr>
									<th>Tipe</th>
									<th>Jumlah Unit</th>
									<th>Luas</th>
									<th>Tinggi</th>
									<th>Lantai</th>
									
								</tr>
								<?php
								$tipe = json_decode($DataBangunan->tipeA);
								$jumlah = json_decode($DataBangunan->jumlahA);
								$luas = json_decode($DataBangunan->luasA);
								$tinggi = json_decode($DataBangunan->tinggiA);
								$lantai = json_decode($DataBangunan->lantaiA);
								$bangunan = array();
								if (!empty($tipe))
									foreach ($tipe as $noo => $val) {
										if ($val != "")
											$bangunan['tipe'][$noo] = $val;
									}
								if (!empty($jumlah))
									foreach ($jumlah as $noo => $val) {
										if ($val != "")
											$bangunan['jumlah'][$noo] = $val;
									}
								if (!empty($luas))
									foreach ($luas as $noo => $val) {
										if ($val != "")
											$bangunan['luas'][$noo] = $val;
									}
								if (!empty($tinggi))
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
								if (!empty($bangunan)) {
									foreach ($bangunan['tipe'] as $dt) {
										$no++; ?>
										<tr id="tr-tipe<?php echo $no ?>">
											<td><?php echo form_input('tipeA[' . $no . ']', !empty($bangunan['tipe'][$no]) ? $bangunan['tipe'][$no] : '', 'style="width:100px;" id="tipe' . $no . '" class="tipe' . $no . ' form-control"'); ?></td>
											<td><?php echo form_input('jumlahA[' . $no . ']', !empty($bangunan['jumlah'][$no]) ? $bangunan['jumlah'][$no] : '', 'style="width:100px;" id="jumlah' . $no . '" class="jumlah' . $no . ' form-control"'); ?></td>
											<td><?php echo form_input('luasA[' . $no . ']', !empty($bangunan['luas'][$no]) ? $bangunan['luas'][$no] : '', 'style="width:100px;" id="luas' . $no . '" class="luas' . $no . ' form-control"'); ?></td>
											<td><?php echo form_input('tinggiA[' . $no . ']', !empty($bangunan['tinggi'][$no]) ? $bangunan['tinggi'][$no] : '', 'style="width:100px;" id="tinggi' . $no . '" class="tinggi' . $no . ' form-control"'); ?></td>
											<td><?php echo form_input('lantaiA[' . $no . ']', !empty($bangunan['lantai'][$no]) ? $bangunan['lantai'][$no] : '', 'style="width:100px;" id="lantai' . $no . '" class="lantai' . $no . ' form-control"'); ?></td>
										</tr>
									<?php }
								} else { ?>
									<tr id="tr-tipe">
										<td><?php echo form_input('tipeA[1]', '', 'style="width:100px;" id="tipe1" class="tipe1 form-control"'); ?></td>
										<td><?php echo form_input('jumlahA[1]', '', 'style="width:100px;" id="jumlah1" class="jumlah1 form-control"'); ?></td>
										<td><?php echo form_input('luasA[1]', '', 'style="width:100px;" id="luas1" class="luas1 form-control"'); ?></td>
										<td><?php echo form_input('tinggiA[1]', '', 'style="width:100px;" id="tinggi1" class="tinggi1 form-control"'); ?></td>
										<td><?php echo form_input('lantaiA[1]', '', 'style="width:100px;" id="lantai1" class="lantai1 form-control"'); ?></td>
									</tr>
								<?php } ?>
							</table>
							</div>
							</div>
						<?php } else { ?>
							<div class="form-group">
								<label class="control-label col-md-3">Data Bangunan :</label>
								<div class="col-md-9"><p class="form-control-static">Luas : <?php echo $DataBangunan->luas_bgn; ?>m<sup>2</sup>, Tinggi : <?php echo $DataBangunan->tinggi_bgn; ?> Meter, Jumlah Lantai : <?php echo $DataBangunan->jml_lantai; ?> Lantai</p></div>
							</div>
						<?php } ?>  
                        <div class="row static-info">
                            <label class="control-label col-md-3">Catatan Perbaikan</label>
                            <div class="col-md-9 value">	
                                <table class="table table-bordered table-striped table-hover" id="sample_editable_1">
                                    <thead>
                                        <tr class="warning">
                                            <th width="5%"><center>No.</center></th>
                                            <th width="15%"><center>Tgl. Verifikasi</center></th>
                                            <th width="75%"><center>Catatan</center></th>
                                            <th width="15%"><center>Berkas</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($DataInformasi->num_rows() > 0) {
                                            $no = 1;
                                            foreach ($DataInformasi->result() as $key) { ?>
                                                <tr>
                                                    <td align="center"> <?php echo $no++; ?></td>
                                                    <td align="center"> <?php echo $key->tgl_status; ?></td>
                                                    <td align="left"> <?php echo $key->catatan; ?></td>
                                                    <td align="center">
														<?php
														$dir = './object-storage/dekill/Consultation/' . $key->dir_file;
														$dirStr	= $this->Outh_model->Encryptor('encrypt', $dir);
								
														?>
                                                        <?php if($key->dir_file !='' && $key->dir_file !=null) { ?>
															<a href="#PDFViewer" role="button" class="open-PDFViewer btn default btn-xs blue-stripe" data-toggle="modal" data-id="<?php echo site_url('Docreader/ReaderDok/'.$dirStr); ?>">Lihat</a>
														<?php } else { ?>
                                                            Tidak Ada Dokumen
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>