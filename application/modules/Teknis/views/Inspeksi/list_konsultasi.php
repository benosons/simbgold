<!-- BEGIN PAGE CONTENT-->

<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-globe"></i>Data Konsultasi
        </div>
        <div class="tools">
            <a href="javascript:;" class="reload">
            </a>
        </div>
    </div>
    <div class="portlet-body">
        <table class="table table-striped table-bordered table-hover" id="sample_1">
            <?php
            echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '</div>' : '';
            ?>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis Permohonan</th>
                    <th>Nomor Registrasi</th>
                    <th>Nama Pemilik</th>
                    <th>Lokasi BG</th>
                    <th>Status Konsultasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($konsultasi->num_rows() > 0) {
                    $no = 1;
                    foreach ($konsultasi->result() as $pbg) {
                        $bgcolor = "";
                        $ustat = "";
                        if ($pbg->status == 1 || $pbg->id_stsjadwal == NULL) {
                            $ustat = "Belum Dijadwalkan!";
                            $bgcolor = "danger";
                        } else {
                            if ($pbg->id_stsjadwal == 2) {
                                $bgcolor = "info";
                                $ustat = $pbg->status_dinas;
                            } else if ($pbg->status == 3) {
                                $bgcolor = "warning";
                                $ustat = $pbg->status_dinas;
                            } else if ($pbg->status == 4) {
                                $bgcolor = "warning";
                                $ustat = $pbg->status_dinas;
                            } else if ($pbg->status == 5) {
                                $bgcolor = "info";
                                $ustat = $pbg->status_dinas;
                            } else if ($pbg->status == 6) {
                                $bgcolor = "success";
                                $ustat = $pbg->status_dinas;
                            } else if ($pbg->status == 7) {
                                $bgcolor = "info";
                                $ustat = $pbg->status_dinas;
                            } else if ($pbg->status == 8) {
                                $bgcolor = "warning";
                                $ustat = $pbg->status_dinas;
                            } else if ($pbg->status == 11){
                                $bgcolor = "success";
                                $ustat = $pbg->status_dinas;
                            }
                        }
                ?>
                        <tr class="<?= $bgcolor ?>">
                            <td align="center"><?php echo $no++; ?></td>
                            <td><?php echo $pbg->nm_konsultasi; ?></td>
                            <td align="center"><?php echo $pbg->no_konsultasi; ?></td>
                            <td align="center"><?php echo $pbg->nm_pemilik; ?></td>
                            <td><?php echo $pbg->almt_bgn; ?></td>
                            <td align="center">
                                <?php echo $ustat; ?>
                            </td>
                            <td align="center">
								<a href="<?= site_url("Teknis/detail_inspeksi/{$pbg->no_konsultasi}") ?>" class="btn btn-warning btn-sm" title="Lihat Detail Inspeksi"><span class="fa fa-edit"></span></a>
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