<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption"><i class="fa fa-globe"></i>Data Konsultasi</div>
        <div class="tools">
            <a href="javascript:;" class="reload"></a>
        </div>
    </div>
    <div class="portlet-body">
        <table class="table table-striped table-bordered table-hover" id="tablePemeriksaan">
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
                <?php if ($konsultasi->num_rows() > 0) {
                    $no = 1;
                    foreach ($konsultasi->result() as $pbg) {
                        $bgcolor = "";
                        $ustat = "";
                        if ($pbg->status <= 9) {
                            if ($pbg->data_step == 0) {
                                $ustat = "Pemeriksaan Tahap Arsitektur";
                                $bgcolor = "warning";
                            } else if ($pbg->data_step == 1) {
                                $ustat = "Pemeriksaan Tahap Struktur";
                                $bgcolor = "warning";
                            } else if ($pbg->data_step == 2) {
                                $ustat = "Pemeriksaan Tahap MEP";
                                $bgcolor = "warning";
                            } else if ($pbg->data_step == 3) {
                                $ustat = "Finalisasi Data Bangunan";
                                $bgcolor = "warning";
                            } else if ($pbg->data_step == 4) {
                                $ustat = "Pemeriksaan Tahap Akhir";
                                $bgcolor = "warning";
                            } else {
                                $ustat = "Input Hasil Konsultasi";
                                $bgcolor = "danger";
                            }
                        } else {
                            $ustat = "Selesai Penilaian Konsultasi";
                            $bgcolor = "success";
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
                                <a href="<?= site_url("Teknis/detail_penilaian/{$pbg->no_konsultasi}") ?>" class="btn btn-warning btn-sm" title="Buat List Konsultasi"><span class="fa fa-edit"></span></a>
                            </td>
                        </tr>
                <?php }
                } ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {
        var table = $('#tablePemeriksaan').DataTable({
            "responsive": false,
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "Data Belum Tersedia",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ jumlah data",
                "infoEmpty": "Data Tidak Ditemukan",
                "infoFiltered": "",
                "lengthMenu": "Tampilkan _MENU_ Baris",
                "search": "Cari:",
                "zeroRecords": "Data Tidak Ditemukan",
                "oPaginate": {
                    "sNext": 'Selanjutnya',
                    "sLast": 'Terakhir',
                    "sFirst": 'Pertama',
                    "sPrevious": 'Sebelumnya'
                }
            },
        });

    });
</script>
