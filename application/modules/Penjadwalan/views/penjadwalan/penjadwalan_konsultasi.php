<div class="tab-pane fade active in" id="ps">
    <!--?php include "jadwal_konsultasi_form.php"; ?-->
    <br>

    <div class="row">
        <input type="text" style="display: none;" name='id_penjadwalan' id='id_penjadwalan' value='' />
        <div class="col-md-6">
            <form action="<?= site_url("pengawas/jadwal_form/{$id}") ?>" role="form" method="post" id="jsnya" enctype="multipart/form-data">

                <div class="form-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group form-md-line-input">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-circle"></i>
                                    </span>
                                    <input type="text" name="konsultasi_ke" class="form-control" value="<?= $nextKonsultasi ?>" readonly>
                                    <label for="form_control_1">Konsultasi ke</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group form-md-line-input">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input class="form-control" id="thnDatePicker" autocomplete="off" onkeydown="return false" name="tanggal_konsultasi" type="text" data-date-format="yyyy-mm-dd" placeholder="Tanggal Konsultasi" />
                                    <label for="form_control_1">Tanggal Konsultasi</label>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-md-line-input">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </span>
                                    <input name="jam_konsultasi" class="form-control" value='' id="jam_konsultasi" type="text" placeholder="00.00">
                                    <label for="form_control_1">Jam Konsultasi</label>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-md-line-input">
                                <textarea class="form-control" rows="2" placeholder="Tempat / Keterangan" id="ketempat" name="ketempat" value=''></textarea>
                                <label for="form_control_1">Tempat / Keterangan</label>
                            </div>
                        </div>
                        <div class="col-md-12" style="display: none;">
                            <div class="form-group form-md-line-input">
                                <input name="email" class="form-control" value='<?= $email ?>' id="email" type="text" placeholder="00.00">
                                <input name="noreg" class="form-control" value='<?= $no_konsultasi ?>' id="noreg" type="text" placeholder="00.00">
                                <input name="id" class="form-control" value='<?= $id_konsultasi ?>' id="id" type="text" placeholder="00.00">
                                <label for="form_control_1">email</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-md-line-input">
                                <input type="file" class="form-control" name="berkas">
                                <label for="form_control_1">Unggah Undangan Konsultasi</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!--?php echo form_submit('upload','Simpan Jadwal Konsultasi', 'class="btn blue-hoki btn-block"');	?-->

                <input type="submit" name="submit" value="Simpan Jadwal Konsultasi" class="btn blue-hoki btn-block" />

            </form>
        </div>

        <div class="col-md-6">
            <form role="form">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-md-line-input">
                                <input style="display: none;" name='jmlPegawai' id='jmlPegawai' value="1">
                                <input style="display: none;" name='jumPegUp' id='jumPegUp' value="1">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr class="info">
                                            <th>
                                                <center>#</center>
                                            </th>
                                            <th>Nama Tim TABG / Teknis</th>
                                            <th>Unsur</th>
                                            <th>Bidang Keahlian</th>
                                            <th>Kualifikasi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="daftar_pegawai">
                                        <?php
                                        $no = 1;
                                        foreach ($pengawas as $row) : ?>
                                            <tr id="list_peg-0">
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
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </form>


        </div>

        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <hr />
                    <table class="table table-bordered table-striped table-hover">
                        <tbody>

                            <tr class="info">
                                <th>
                                    <center>Konsultasi Ke</center>
                                </th>
                                <th>
                                    <center>Tanggal</center>
                                </th>
                                <th>
                                    <center>Jam</center>
                                </th>
                                <th>
                                    <center>Tempat / Keterangan</center>
                                </th>
                                <th>
                                    <center>Berkas Undangan</center>
                                </th>
                            </tr>

                            <?php
                            $no = 1;
                            foreach ($list_jadwal as $r) :
                            ?>
                                <tr id="record">
                                    <td>
                                        <?php echo $no++; ?>
                                    </td>
                                    <td><?php echo tgl_eng_to_ind($r->tgl_konsultasi) ?></td>
                                    <td><?php echo $r->jam_konsultasi ?></td>
                                    <td><?php echo $r->ket_konsultasi ?></td>
                                    <td align="center">
                                        <a href="javascript:void(0);" class="btn btn-success btn-sm" title="Lihat Berkas" onClick="javascript:popWin('<?php echo base_url('file/PBG/' . $id . '/konsultasi/undangan_konsultasi/' . $r->dir_file_undangan); ?>')"><span class="glyphicon glyphicon-file"></span></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>
<script>
    $("#thnDatePicker").datepicker({
    
    });
</script>