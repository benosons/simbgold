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
                <?php if ($konsultasi->num_rows() > 0) {
                    $no = 1;
                    foreach ($konsultasi->result() as $pbg) {
                        $id_penjadwalan = "";
                        $status_perbaikan = "";
                        $tgl_sidang = "";
                        $query2 = $this->Mpemeriksaan->get_data_penjadwalan($pbg->id, null, '1');
                        $mydata2 = $query2->row_array();
                        $baris2 = $query2->num_rows();
                        if ($baris2 >= 1) {
                            $id_penjadwalan = $mydata2['id_jadwal'];
                            $status_perbaikan = $mydata2['hsl_konsultasi'];
                            $tgl_sidang = ($mydata2['tgl_konsultasi']);
                        }
                        $bgcolor = "";
                        $ustat = "";
                        if ($pbg->id_stsjadwal == 1 || $pbg->id_stsjadwal == NULL) {
                            $ustat = "Belum Dijadwalkan!";
                            $bgcolor = "danger";
                        } else {
                            if ($pbg->id_stsjadwal == 2) {
                                $bgcolor = "info";
                                $ustat = $pbg->nama_stsjadwal;
                            } else if ($pbg->id_stsjadwal == 3) {
                                $bgcolor = "warning";
                                $ustat = $pbg->nama_stsjadwal;
                            } else if ($pbg->id_stsjadwal == 4) {
                                $bgcolor = "warning";
                                $ustat = $pbg->nama_stsjadwal;
                            } else if ($pbg->id_stsjadwal == 5) {
                                $bgcolor = "info";
                                $ustat = $pbg->nama_stsjadwal;
                            } else if ($pbg->id_stsjadwal >= 6) {
                                $bgcolor = "success";
                                $ustat = $pbg->nama_stsjadwal;
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
                            <td align="center">
                                <a href="<?= site_url("pemeriksaan/FormRetribusi/{$pbg->no_konsultasi}") ?>" class="btn btn-warning btn-sm" title="Form Perhitungan Retribusi"><span class="fa fa-edit"></span></a>
                            </td>
                        </tr>
					<?php }
                } ?>
            </tbody>
        </table>
    </div>
</div>