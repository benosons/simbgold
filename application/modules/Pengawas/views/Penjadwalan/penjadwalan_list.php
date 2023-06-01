<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-globe"></i>Penjadwalan Konsultasi PBG
        </div>
        <div class="tools">
            <a href="javascript:;" class="reload"></a>
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
                    <th>Jenis Konsultasi</th>
                    <th>No. Registrasi</th>
                    <th>Nama Pemilik</th>
                    <th>Lokasi BG</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($datapbg->num_rows() > 0) {
                    $no = 1;
                    foreach ($datapbg->result() as $pbg) {
                        
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
                        }
                ?>
                        <tr class="<?= $bgcolor ?>">
                            <td align="center"><?php echo $no++; ?></td>
                            <td align="left"><?php echo $pbg->nm_konsultasi; ?></td>
                            <td align="center"><?php echo $pbg->no_konsultasi; ?></td>
                            <td align="center"><?php echo $pbg->nm_pemilik; ?></td>
                            <td><?php echo $pbg->almt_bgn; ?></td>
                            <td align="center">
                                <?php echo $ustat; ?>
                            </td>
                            <?php if ($pbg->status == 5) { ?>
                            <td align="center">
                                <a href="#" onClick="getJadwalSidang('<?php echo $pbg->no_konsultasi; ?>')" class="btn btn-warning btn-sm" title="Buat Penjadwalan Konsultasi" data-toggle="modal" data-target="#static"><span class="fa fa-edit"></span></a>
                                
                            </td>
                        <?php } else { ?>
                            <td>
                            <a href="#" onClick="href='<?php echo site_url('penugasan/detailpenugasan/' . $pbg->id); ?>'" class="btn btn-info btn-sm" title="Lihat Data" id="tombolinver" data-toggle="modal" data-target="#modal-edit"><span class="glyphicon glyphicon-user"></span></a>
                          
                       </td>
                        <?php } ?>

                           
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

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
            </div>
            <div class="modal-body">
                <div id="content"></div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-primary">Tutup</button>
            </div>
        </div>
    </div>
</div>


<script>
    function getJadwalSidang(id) {
        $.ajax({
            type: "POST",
            url: `<?php echo site_url('pengawas/sidang/') ?>${id}`,
            data: {
                id: id
            },
            success: function(data) {
                $("#content").html(data);
            }
        });
        return false;
    };
    $(document).ready(function() {
        $('#modalElement').on('hidden', function() {
            $(this).data('modal', null);
        });
    });
</script>