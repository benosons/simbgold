<div class="row">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-title">
                <h4 align="center" class="caption-subject font-red bold uppercase">Data Pokok Konsultasi <?= (isset($row->no_konsultasi) ? $row->no_konsultasi : '') ?></h4>
                <hr />
                <h5 class="caption-subject font-red bold uppercase">Data Pemilik</h5>
                <div class="row static-info">
                    <div class="col-md-4 name">
                        Nama Pemilik :
                    </div>
                    <div class="col-md-8 value">
                        <?= (isset($row->nm_pemilik) ? $row->nm_pemilik : ''); ?>
                    </div>
                </div>
                <div class="row static-info">
                    <div class="col-md-4 name">
                        Alamat Pemilik :
                    </div>
                    <div class="col-md-8 value">
                        <?= (isset($row->alamat) ? $row->alamat : ''); ?>, Kec. <?= (isset($row->nama_kecamatan) ? $row->nama_kecamatan : ''); ?>,<br> <?= (isset($row->nama_kabkota) ? $row->nama_kabkota : ''); ?>, <?= (isset($row->nama_provinsi) ? $row->nama_provinsi : ''); ?>
                    </div>
                </div>
                <div class="row static-info">
                    <div class="col-md-4 name">
                        Nomor Telp / Hp :
                    </div>
                    <div class="col-md-8 value">
                        <?= (isset($row->no_hp) ? $row->no_hp : ''); ?>
                    </div>
                </div>
                <div class="row static-info">
                    <div class="col-md-4 name">
                        Alamat Email :
                    </div>
                    <div class="col-md-8 value">
                        <p class="font-red"><i><?= (isset($row->email) ? $row->email : ''); ?></i></p>
                    </div>
                </div>
                <div class="row static-info">
                    <div class="col-md-4 name">
                        Nomor Identitas :
                    </div>
                    <div class="col-md-8 value">
                        <?= (isset($row->no_ktp) ? $row->no_ktp : ''); ?>
                    </div>
                </div>



                <div class="row static-info">
                    <div class="col-md-4 name">
                        Kepemilikan :
                    </div>
                    <div class="col-md-8 value">
                        <?= (isset($usaha) ? $usaha : ''); ?>
                    </div>
                </div>
                <?php if (isset($usaha2) != null) { ?>


                <?php  } else { ?>

                <?php  } ?>
                <br>
                <h5 class="caption-subject font-red bold uppercase">Data Umum Bangunan Gedung</h5>
                <div class="row static-info">
                    <div class="col-md-4 name">
                        Jenis Permohonan :
                    </div>
                    <div class="col-md-8 value">
                        <?= (isset($row->nm_konsultasi) ? $row->nm_konsultasi : '') ?>
                    </div>
                </div>
                <div class="row static-info">
                    <div class="col-md-4 name">
                        Nama Bangunan :
                    </div>
                    <div class="col-md-8 value">
                        <?= (isset($row->nm_bgn) ? $row->nm_bgn : '') ?>
                    </div>
                </div>
                <!-- <div class="row static-info">
					<div class="col-md-4 name">
						Klasifikasi Bangunan Gedung :
					</div>
					<div class="col-md-8 value">
						<?php echo set_value('klasifikasi_bg', (isset($klasifikasi_bg) ? $klasifikasi_bg : '')) ?>
					</div>
				</div> -->
                <div class="row static-info">
                    <div class="col-md-4 name">
                        Lokasi Bangunan Gedung :
                    </div>
                    <div class="col-md-8 value">
                        <?= (isset($row->almt_bgn) ? $row->almt_bgn : ''); ?>, Kec. <?= (isset($nama_kecamatan_bg) ? $nama_kecamatan_bg : ''); ?>,<br> <?= (isset($nama_kabkota_bg) ? $nama_kabkota_bg : ''); ?>, <?= (isset($nama_provinsi_bg) ? $nama_provinsi_bg : ''); ?>
                    </div>
                </div>


                <div class="row static-info">
                    <div class="col-md-4 name">
                        Fungsi Bangunan Gedung :
                    </div>
                    <div class="col-md-8 value">
                        <?php echo set_value('fungsi_bg', (isset($row->fungsi_bg) ? $row->fungsi_bg : '')) ?> - <?php echo set_value('jns_bangunan', (isset($row->jns_bangunan) ? $row->jns_bangunan : '')) ?>
                    </div>
                </div>
                <div class="row static-info">
                    <div class="col-md-4 name">
                        Luas Bangunan Gedung :
                    </div>
                    <div class="col-md-8 value">
                        <?php echo set_value('luas_bg', (isset($row->luas_bgn) ? $row->luas_bgn : '')) ?> M<sup>2</sup>
                    </div>
                </div>
                <div class="row static-info">
                    <div class="col-md-4 name">
                        Ketinggian Bangunan Gedung :
                    </div>
                    <div class="col-md-8 value">
                        <?php echo set_value('tinggi_bg', (isset($row->tinggi_bgn) ? $row->tinggi_bgn : '')) ?> Meter
                    </div>
                </div>
                <div class="row static-info">
                    <div class="col-md-4 name">
                        Jumlah Lantai Bangunan Gedung :
                    </div>
                    <div class="col-md-8 value">
                        <?php echo set_value('lantai_bg', (isset($row->jml_lantai) ? $row->jml_lantai : '')) ?> Lantai
                    </div>
                </div>
                <div class="row static-info">
                    <div class="col-md-4 name">
                        Luas Basement :
                    </div>
                    <div class="col-md-8 value">
                        <?php echo set_value('luas_basement', (isset($row->luas_basement) ? $row->luas_basement : '')) ?>
                    </div>
                </div>
                <div class="row static-info">
                    <div class="col-md-4 name">
                        Jumlah Lantai Basement :
                    </div>
                    <div class="col-md-8 value">
                        <?php echo set_value('lantai_basement', (isset($row->lapis_basement) ? $row->lapis_basement : '')) ?>
                    </div>
                </div>
                <br>
                <h5 class="caption-subject font-red bold uppercase">Data Tanah</h5>
                <table class="table table-bordered table-striped table-hover">
                    <tbody>
                        <tr style="padding-left: 5px; padding-bottom:3px;  font-weight:bold">
                            <th>
                                <center>No.</center>
                            </th>
                            <th>
                                <center>Jenis Dokumen</center>
                            </th>
                            <th>
                                <center>Nomor Dokumen</center>
                            </th>
                            <th>
                                <center>Tgl. Dokumen</center>
                            </th>
                            <th>
                                <center>Luas Tanah (m<sup>2</sup>)</center>
                            </th>
                            <th>
                                <center>Atas Nama</center>
                            </th>
                            <th>
                                <center>Lokasi</center>
                            </th>
                            <th>
                                <center>Berkas</center>
                            </th>
                            <th>
                                <center>Berkas Izin<br>Pemanfaatan</center>
                            </th>
                        </tr>

                        <?php
                        if (isset($jmltanah) == 0) { ?>
                            <tr>
                                <td class="clcenter" colspan="9">Data is Empty</td>
                            </tr>
                            <?php  } else {
                            $no = 1;
                            for ($i = 0; $i < count($result_tanah); $i++) {
                                if ($i % 2 == 0)
                                    $clss = "event";
                                else
                                    $clss = "event2";
                            ?>
                                <tr class="<?= $clss ?>" id="record">
                                    <td style="vertical-align:middle;">
                                        <center><?php echo $no ?></center>
                                    </td>
                                    <td style="vertical-align:middle;"><?php echo $result_tanah[$i]['jenis_dokumen']; ?></td>
                                    <td style="vertical-align:middle;"><?php echo $result_tanah[$i]['no_dok']; ?></td>
                                    <td style="vertical-align:middle;"><?php echo tgl_eng_to_ind($result_tanah[$i]['tanggal_dok']); ?></td>
                                    <td style="vertical-align:middle;"><?php echo $result_tanah[$i]['luas_tanah']; ?></td>
                                    <td style="vertical-align:middle;"><?php echo $result_tanah[$i]['atas_nama_dok']; ?></td>
                                    <td style="vertical-align:middle;"><?php echo $result_tanah[$i]['lokasi_tanah']; ?>, Kec. <?php echo $result_tanah[$i]['nama_kecamatan']; ?>, <?php echo $result_tanah[$i]['nama_kabkota']; ?>, Prov. <?php echo $result_tanah[$i]['nama_provinsi']; ?></td>
                                    </td>

                                    <td class="clcenter">
                                        <center>
                                            <?php if ($result_tanah[$i]['dir_file'] != '') { ?>
                                                <a href="javascript:void(0);" class="label label-success btn-sm" title="Lihat Berkas" onClick="javascript:GetPdfTanah('<?php echo $id_permohonan ?>','<?php echo $result_tanah[$i]['id_permohonan_detail_tanah'] ?>','<?php echo $result_tanah[$i]['dir_file'] ?>')"><span class="glyphicon glyphicon-file"></span>Unduh</a>
                                            <?php  } ?>
                                        </center>
                                    </td>
                                    <td class="clcenter">

                                        <center>
                                            <?php if ($result_tanah[$i]['dir_file_phat'] != '') { ?>
                                                <a href="javascript:void(0);" class="label label-success btn-sm" title="Lihat Berkas" onClick="javascript:GetPdfTanah('<?php echo $id_permohonan ?>','<?php echo $result_tanah[$i]['id_permohonan_detail_tanah'] ?>','<?php echo $result_tanah[$i]['dir_file_phat'] ?>')"><span class="glyphicon glyphicon-file"></span>Unduh</a>
                                            <?php  } ?>
                                        </center>
                                    </td>
                                </tr>
                        <?php
                                $no++;
                            } // endfor result
                        } // endif jum_data
                        ?>
                    </tbody>
                </table>
                <br>
                <h5 class="caption-subject font-red bold uppercase">Daftar Tim Teknis</h5>
                <table class="table table-bordered table-striped table-hover">
                    <tbody>
                        <?php if (isset($id_fbg) == 1) {
                            $nama = 'Nama-nama TABG';
                        } else {
                            $nama = 'Nama-nama Tim Teknis';
                        } ?>
                        <tr style="padding-left: 5px; padding-bottom:3px;  font-weight:bold">
                            <th>
                                <center>#</center>
                            </th>
                            <th><?= $nama ?></th>
                            <th>Unsur</th>
                            <th>Bidang Keahlian</th>
                            <th>Kualifikasi</th>
                        </tr>
                    </tbody>
                    <tbody id="daftar_pegawai">
                        <?php
                        if ($rew->num_rows() > 0) {
                            $no = 1;
                            foreach ($rew->result() as $row) {
                        ?>
                                <tr class="info caption-subject bold">
                                    <td align="center"><?php echo $no++; ?></td>
                                    <td>

                                        <?php

                                        if (isset($row->glr_depan) && trim($row->glr_depan) != '')
                                            $glr_dpn = $row->glr_depan . ' ';
                                        else
                                            $glr_dpn = '';
                                        if (isset($row->glr_belakang) && trim($row->glr_belakang) != '')
                                            $glr_blk = ', ' . $row->glr_belakang;
                                        else
                                            $glr_blk = '';

                                        if (isset($row->nama_personal) && trim($row->nama_personal) != '')
                                            $nm = $row->nama_personal;
                                        else
                                            $nm = '';
                                        $nama_peg = $glr_dpn . $nm . $glr_blk;
                                        echo $nama_peg; ?>
                                    </td>
                                    <td>
                                        <?php echo $row->nama_unsur ?> - <?php echo $row->nama_unsur_ahli; ?>
                                    </td>

                                    <td>
                                        <?php echo $row->nama_bidang ?>
                                    </td>
                                    <td>
                                        <?php echo $row->nama_keahlian ?>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <br>
                <h5 class="caption-subject font-red bold uppercase">Penilaian Tim Teknis/Sidang TABG</h5>
                <table class="table table-bordered table-striped table-hover">
                    <tbody>
                        <tr style="padding-left: 5px; padding-bottom:3px; font-weight:bold">

                            <th colspan="4">
                                <center>Jadwal Sidang</center>
                            </th>
                            <th colspan="3">
                                <center>Hasil Sidang</center>
                            </th>
                        </tr>
                        <tr>
                            <th rowspan="1">
                                <center>Sidang Ke</center>
                            </th>
                            <th rowspan="1">
                                <center>Tgl</center>
                            </th>
                            <th rowspan="1">
                                <center>Jam</center>
                            </th>
                            <th rowspan="1">
                                <center>Keterangan</center>
                            </th>
                            <th rowspan="1">
                                <center>Perbaikan</center>
                            </th>
                            <th rowspan="1">
                                <center>Catatan Perbaikan</center>
                            </th>
                            <th>
                                <center>Berkas BA</center>
                            </th>
                        </tr>
                        <?php
                        if (isset($jumdata_penjadwalan) == 0) { ?>
                            <tr>
                                <td class="clcenter" colspan="8">Data is Empty</td>
                            </tr>
                            <?php  } else {
                            $no = 1;
                            for ($i = 0; $i < count($results_penjadwalan); $i++) {
                                if ($i % 2 == 0)
                                    $clss = "event";
                                else
                                    $clss = "event2";
                            ?>
                                <tr class="<?= $clss ?>" id="record">

                                    <td class="clcenter" style="vertical-align:middle;">
                                        <center><?php echo $results_penjadwalan[$i]['sidang_ke']; ?></center>
                                    </td>
                                    <td class="clcenter" style="vertical-align:middle;"><?php echo tgl_eng_to_ind($results_penjadwalan[$i]['tgl_sidang']); ?></td>
                                    <td class="clcenter" style="vertical-align:middle;"><?php echo $results_penjadwalan[$i]['jam_sidang']; ?></td>
                                    <td class="clcenter" style="vertical-align:middle;"><?php echo $results_penjadwalan[$i]['keterangan_sidang']; ?></td>
                                    <td class="clcenter" style="vertical-align:middle;">
                                        <?php
                                        if ($results_penjadwalan[$i]['status_perbaikan'] == '1') {
                                            echo "ADA";
                                        } else if ($results_penjadwalan[$i]['status_perbaikan'] == '2') {
                                            echo "TIDAK ADA";
                                        } ?></td>
                                    <td class="clcenter" style="vertical-align:middle;"><?php echo $results_penjadwalan[$i]['catatan']; ?></td>

                                    <td class="clcenter">
                                        <center>
                                            <?php if ($results_penjadwalan[$i]['dir_file_jadwal'] != '') { ?>
                                                <a href="javascript:void(0);" class="label label-success btn-sm" title="Lihat Berkas" onClick="javascript:popWin('<?php echo base_url('file/imb/pengajuan_imb/' . $id_permohonan . '/sidang_n_penilaian/rekomendasi_sidang/' . $results_penjadwalan[$i]['dir_file_jadwal']); ?>')"><span class="glyphicon glyphicon-file"></span>Unduh</a>
                                            <?php  } ?>
                                        </center>
                                    </td>
                                </tr>
                        <?php
                                $no++;
                            } // endfor result
                        } // endif jum_data
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>