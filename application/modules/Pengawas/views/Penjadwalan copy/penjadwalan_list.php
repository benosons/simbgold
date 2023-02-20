<!-- BEGIN PAGE CONTENT-->

<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-globe"></i>Penjadwalan Sidang PBG
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
                    <th>Tanggal Sidang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($datapbg->num_rows() > 0) {
                    $no = 1;
                    foreach ($datapbg->result() as $pbg) {
                        $id_penjadwalan = "";
                        $status_perbaikan = "";
                        $tgl_sidang = "";
                        $query2 = $this->Mpenjadwalan->get_data_penjadwalan($pbg->id, null, '1');
                        $mydata2 = $query2->row_array();
                        $baris2 = $query2->num_rows();
                        if ($baris2 >= 1) {
                            $id_penjadwalan = $mydata2['id_penjadwalan'];
                            $status_perbaikan = $mydata2['status_perbaikan'];
                            $tgl_sidang = ($mydata2['tgl_sidang']);
                        }
                        $bgcolor = "";
                        $ustat = "";

                        if ($pbg->id_progress <= 6 || $pbg->id_progress == NULL) {
                            $bgcolor = "danger";
                            $ustat = "Belum Dijadwalkan";
                        } else {
                            if ($pbg->id_progress == 7) {
                                $bgcolor = "info";
                                $ustat = "Sudah Dijadwalkan <br> $tgl_sidang";
                            } else if ($pbg->id_progress == 8) {
                                $bgcolor = "warning";
                                $ustat = "Perlu Perbaikan";
                            } else if ($pbg->id_progress == 9) {
                                $bgcolor = "warning";
                                $ustat = "Sudah Diperbaiki &<br> Belum Dijadwalkan Ulang";
                            } else if ($pbg->id_progress == 10) {
                                $bgcolor = "info";
                                $ustat = "Sudah Dijadwalkan Ulang <br> $tgl_sidang";
                            } else if ($pbg->id_progress >= 11) {
                                $bgcolor = "success";
                                $ustat = "Selesai Persidangan";
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
                                <a href="#" onClick="href='<?php echo site_url('penjadwalan/sidang/' . $pbg->no_konsultasi); ?>'" class="btn btn-info btn-sm" title="Buat Penjadwalan Sidang" id="tombolinver" data-toggle="modal" data-target="#static"><span class="fa fa-edit"></span></a>
                                <a href="#" onClick="getJadwalSidang('<?php echo $pbg->no_konsultasi; ?>')" class="btn btn-warning btn-sm" title="Buat Penjadwalan Sidang" data-toggle="modal" data-target="#static"><span class="fa fa-edit"></span></a>

                                <!-- <a href="#" class="btn btn-warning btn-sm" title="Buat Penjadwalan"><span class="glyphicon glyphicon-edit" data-target="#modal-edit"></span></a> -->
                                <!-- <a href="#" onClick="href='<?php echo site_url('penjadwalanpbg/sidang/' . $pbg->no_konsultasi); ?>'" class="btn btn-warning btn-sm" title="Buat Penjadwalan" id="tombolver"><span class="glyphicon glyphicon-edit" data-target="#modal-edit"></span></a> -->
                                <a href="#" onClick="href='<?php echo site_url('detail/detail_imb/' . $pbg->no_konsultasi); ?>'" class="btn btn-info btn-sm" title="Lihat Data" id="tombolinver" data-toggle="modal" data-target="#modal-edit"><span class="glyphicon glyphicon-user"></span></a>
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





<!-- /.modal -->

<!-- /.modaledit -->
<div id="modal-edit" class="modal fade bs-modal-lg" tabindex="-1" aria-hidden="true" role="dialog" data-focus-on="input:first">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
        <!-- /.modal-content -->
    </div>
</div>


<div id="static" class="modal fade bs-modal-lg" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Penjadwalan </h4>
            </div>
            <div class="modal-body">
                <div class="modal-content">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn dark btn-outline">Tutup</button>
            </div>
        </div>
    </div>
</div>


<script>
    function getJadwalSidang(id) {
        $.ajax({
            type: "POST",
            url: `<?php echo site_url('pengawas/sidang/') ?>${id}`,
            dataType: "JSON",
            data: {
                id: id
            },
            success: function(data) {
                $.each(data, function() {
                    $('#static').modal('show');

                });
            }
        });
        return false;
    };
</script>