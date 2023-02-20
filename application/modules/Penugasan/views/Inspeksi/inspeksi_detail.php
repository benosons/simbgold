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

                <br>
                <h5 class="caption-subject font-red bold uppercase">Daftar Tim Penilik</h5>
                <table class="table table-bordered table-striped table-hover">
                    <tbody>
                        <tr style="padding-left: 5px; padding-bottom:3px;  font-weight:bold">
                            <th>
                                <center>#</center>
                            </th>
                            <th>Nama TIm Penilik</th>
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
            </div>
        </div>
    </div>
</div>