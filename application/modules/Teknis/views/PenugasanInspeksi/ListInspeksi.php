<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-globe"></i>Data List Pemeriksaan Inspeksi
        </div>
        <div class="tools">
            <a href="javascript:;" class="reload">
            </a>
        </div>
    </div>
    <div class="portlet-body">
        <table class="table table-striped table-bordered table-hover" id="sample_1">
            <?php echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '</div>' : ''; ?>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis Permohonan</th>
                    <th>No. Registrasi</th>
                    <th>Nama Pemilik</th>
                    <th>Lokasi BG</th>
                    <th>Status Konsultasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($Penugasan as $pbg) {
                    $bgcolor = "";
                    $ustat = "";
                    if ($pbg->status == 17 || $pbg->id_stsjadwal == NULL) {
                        $ustat = "Belum Input Hasil Inspeksi";
                        $bgcolor = "danger";
                    } else {
                        if ($pbg->id_stsjadwal == 6) {
                            $bgcolor = "info";
                            $ustat = $pbg->status_dinas;
                        } else if ($pbg->status == 18) {
                            $bgcolor = "success";
                            $ustat = "Validasi Kadis";
                        }
                    } ?>
                    <tr class="<?= $bgcolor ?>">
                        <td align="center"><?php echo $no++; ?></td>
                        <td><?php echo $pbg->nm_konsultasi; ?></td>
                        <td align="center"><?php echo $pbg->no_konsultasi; ?></td>
                        <td align="center"><?php echo $pbg->nm_pemilik; ?></td>
                        <td><?php echo $pbg->almt_bgn; ?></td>
                        <td align="center">
                            <?php echo $ustat; ?>
                        </td>
                        </td>
                        <?php if ($pbg->status == 17) { ?>
                            <td align="center">
                                <a href="<?= site_url("Inspeksi/detail_inspeksi/{$pbg->no_konsultasi}") ?>" class="btn btn-warning btn-sm" title="Lihat Detail Inspeksi"><span class="fa fa-edit"></span></a>
                            </td>
                        <?php } else { ?>
                            <td align="center">
                                <a href="#" onClick="href='<?php echo site_url('Inspeksi/detail_inspeksi/' . $pbg->id); ?>'" class="btn btn-info btn-sm" title="Lihat Data" id="tombolinver" data-toggle="modal" data-target="#modal-edit"><span class="glyphicon glyphicon-user"></span></a>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>