<div class="col-md-12">
    <div class="portlet light">
        <div class="portlet-title">
            <h4 align="center" class="caption-subject font-blue bold uppercase">Data <?= $no_konsultasi ?></h4>
            <hr />
            <div class="row static-info">
                <div class="col-md-3 name">Nama Pemilik</div>
                <div class="col-md-9 value"><?= $nm_pemilik ?></div>
            </div>
            <div class="row static-info">
                <div class="col-md-3 name">Alamat Pemilik</div>
                <div class="col-md-9 value">
                    <?= (isset($alamat) ? $alamat : ''); ?>, Kec. <?= (isset($nama_kecamatan) ? $nama_kecamatan : ''); ?>, <?= (isset($nama_kabkota) ? ucwords(strtolower($nama_kabkota)) : ''); ?>, <?= (isset($nama_provinsi) ? $nama_provinsi : ''); ?>
                </div>
            </div>
            <div class="row static-info">
                <div class="col-md-3 name">Jenis Konsultasi</div>
                <div class="col-md-9 value"><?= $nm_konsultasi ?></div>
            </div>
            <div class="row static-info">
                <div class="col-md-3 name">Lokasi Bangunan Gedung</div>
                <div class="col-md-9 value">
                    <?= (isset($almt_bgn) ? $almt_bgn : ''); ?>, Kec. <?= (isset($nama_kec_bg) ? $nama_kec_bg : ''); ?>, <?= (isset($nama_kabkota_bg) ? ucwords(strtolower($nama_kabkota_bg)) : ''); ?>, <?= (isset($nama_provinsi) ? $nama_provinsi : ''); ?>
                </div>
            </div>
            <?php if($id_jenis_permohonan =='11'){ ?>
            <div class="row static-info">
                <div class="col-md-3 name">Fungsi Bangunan Gedung</div>
                <div class="col-md-9 value">Fungsi Hunian</div>
            </div>
            <div class="row static-info">
                <div class="col-md-3 name">Data Bangunan Kolektif</div>
                    <div class="col-md-9 value">
                        <table class="table table-striped table-bordered dt-responsive wrap" id="tipe_bgn2">
                            <tr>
                                <th>Tipe</th>
                                <th>Jumlah Unit</th>
                                <th>Luas</th>
                                <th>Tinggi</th>
                                <th>Lantai</th>
                            </tr>
                            <?php
                            $tipe = json_decode($tipeA);
                            $jumlah = json_decode($jumlahA);
                            $luas = json_decode($luasA);
                            $tinggi = json_decode($tinggiA);
                            $lantai = json_decode($lantaiA);
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
                                    $LuasBg += $bangunan['luas'][$no]*$bangunan['jumlah'][$no];
                                    $no++; ?>
                                    <tr id="tr-tipe<?php echo $no ?>">
                                        <td><?php echo form_input('tipeA[' . $no . ']', $bangunan['tipe'][$no], 'style="width:75px;" id="posisi' . $no . '" class="posisi' . $no . ' form-control"'); ?></td>
                                        <td><?php echo form_input('jumlahA[' . $no . ']', $bangunan['jumlah'][$no], 'style="width:75px;" id="posisi' . $no . '" class="posisi' . $no . ' form-control"'); ?></td>
                                        <td><?php echo form_input('luasA[' . $no . ']', $bangunan['luas'][$no], 'style="width:75px;" id="luas' . $no . '" class="luas' . $no . ' form-control"'); ?></td>
                                        <td><?php echo form_input('tinggiA[' . $no . ']', $bangunan['tinggi'][$no], 'style="width:75px;" id="tinggi' . $no . '" class="tinggi' . $no . ' form-control"'); ?></td>
                                        <td><?php echo form_input('lantaiA[' . $no . ']', !empty($bangunan['lantai'][$no]) ? $bangunan['lantai'][$no] : '', 'style="width:75px;" id="lantai' . $no . '" class="lantai' . $no . ' form-control"'); ?></td>
                                    </tr>
                                <?php }
                            } else { ?>
                                <tr id="tr-tipe">
                                    <td><?php echo form_input('tipeA[1]', '', 'style="width:70px;" id="posisi1" class="posisi1 form-control"'); ?></td>
                                    <td><?php echo form_input('jumlahA[1]', '', 'style="width:70px;" id="posisi1" class="posisi1 form-control"'); ?></td>
                                    <td><?php echo form_input('luasA[1]', '', 'style="width:70px;" id="luas1" class="unit1 form-control"'); ?></td>
                                    <td><?php echo form_input('tinggiA[1]', '', 'style="width:70px;" id="tinggi1" class="tinggi1 form-control"'); ?></td>
                                    <td><?php echo form_input('lantaiA[1]', '', 'style="width:70px;" id="lantai1" class="tinggi1 form-control"'); ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
                <div class="row static-info">
                    <div class="col-md-3 name">Total Luas Bangunan Kolektif</div>
                    <div class="col-md-9 value"><?= $LuasBg ?> m<sup>2</sup></div>
                </div> 
            <?php } else { ?>
                <div class="row static-info">
                    <div class="col-md-3 name">Fungsi Bangunan Gedung</div>
                    <div class="col-md-9 value">
                        <?php echo set_value('fungsi_bg', (isset($fungsi_bg) ? $fungsi_bg : '')) ?> - <?php echo set_value('jns_bangunan', (isset($jns_bangunan) ? $jns_bangunan : '')) ?>
                    </div>
                </div>
                <div class="row static-info">
                    <div class="col-md-3 name">Luas, Tinggi & Jumlah Lantai</div>
                    <div class="col-md-9 value">
                        <?= (isset($luas_bgn) ? $luas_bgn : '') ?> m<sup>2</sup>, dengan tinggi <?= (isset($tinggi_bgn) ? $tinggi_bgn : '') ?> meter dan berjumlah <?= (isset($jml_lantai) ? $jml_lantai : '') ?> lantai.
                    </div>
                </div> 
            <?php } ?>         
        </div>
        <?php if($status =='7'){ ?>
            <div class="row static-info">
				<div class="col-md-3 name">Catatan Perbaikan</div>
				<div class="col-md-9 value">	
					<table class="table table-bordered table-striped table-hover" id="sample_editable_1">
						<thead>
							<tr class="warning">
								<th width="5%"><center>No.</center></th>
								<th width="15%"><center>Tgl. Input</center></th>
								<th width="65%"><center>No. SK</center></th>
								<th width="15%"><center>Berkas</center></th>
							</tr>
						</thead>
						<tbody>
							<?php if ($History->num_rows() > 0) {
								$no = 1;
								foreach ($History->result() as $key) { 
									$filename = FCPATH . "/object-storage/dekill/Consultation/$key->lampiran_perbaikan";
									$dir = '';
									if (file_exists($filename)) {
										$dir = './object-storage/dekill/Consultation/' . $key->lampiran_perbaikan;
									} else {
										$dir = './public/uploads/penilaian/perbaikan/' . $key->lampiran_perbaikan;
									}
                                    $dirPen	= $this->Outh_model->Encryptor('encrypt', $dir);
									?>
									<tr>
										<td align="center"> <?php echo $no++; ?></td>
										<td align="center"> <?php echo $key->tgl_perbaikan; ?></td>
										<td align="left"> <?php echo $key->catatan; ?></td>
										<td align="center">
                                            <?php if($key->lampiran_perbaikan !='' && $key->lampiran_perbaikan !=null) { ?>
                                                <a href="#PDFViewer" role="button" class="open-PDFViewer btn default btn-xs blue-stripe" data-toggle="modal" data-id="<?php echo site_url('Docreader/ReaderDok/'.$dirPen); ?>">Lihat</a>
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
        <?php } else { ?>

        <?php } ?>
    </div>
</div>