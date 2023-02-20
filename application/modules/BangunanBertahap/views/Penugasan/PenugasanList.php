<style>
    table,
    thead,
    tr,
    th,
    td {
        text-align: center;
    }
</style>

<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption"><i class="fa fa-globe"></i>List Data Penugasan Pemeriksan Dokumen Oleh TPA</div>
        <div class="tools">
            <a href="javascript:;" class="reload"></a>
        </div>
    </div>
    <div class="portlet-body">
        <table class="table table-striped table-bordered table-hover" id="tablePenugasan">
            <?php echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '</div>' : ''; ?>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis Konsultasi</th>
                    <th>Nomor Registrasi</th>
                    <th>Nama Pemilik</th>
                    <th>Lokasi BG</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($Penugasan as $r) { ?>
                    <?php
                    if ($r->status <= 4) {
                        $clss = "danger";
                    } elseif ($r->status >= 5) {
                        $clss = "success";
                    } else {
                        $clss = "success";
                    }
                    ?>
                    <tr class="<?= $clss ?>">
                        <td align="center"><?php echo $no++; ?></td>
                        <td><?php echo $r->nm_konsultasi; ?></td>
                        <td align="center"><?php echo $r->no_konsultasi; ?></td>
                        <td align="center"><?php echo $r->nm_pemilik; ?></td>
                        <td><?php echo $r->almt_bgn; ?></td>
                        <td align="center">
                            <?php
                            $bg = 'TPA';
                            $syarat = "Menunggu Penugasan {$bg}";
                            if ($r->status <= 4) {
                                $class = "label label-sm label-danger";
                                $syarat = "Menunggu Penugasan {$bg}";
                            } else if ($r->status >= 5) {
                                $class = "label label-sm label-success";
                                $syarat = "Sudah Dilakukan Penugasan {$bg} ";
                            }; ?>
                            <span class="<?php echo $class; ?>"><?php echo $syarat; ?> Tahap <?php echo $r->tahap_pbg; ?></span>
                        </td>
                        <?php if ($r->status == 4) { ?>
                            <td align="center">
                                <a href="javascript:;" class="btn btn-success btn-sm form-penugasan" data-stats="<?= $bg ?>" title="Verifikasi Data" data-id="<?= $r->id ?>"><span class="glyphicon glyphicon-edit"></span></a>
                                <div class="data-action"></div>
                            </td>
                        <?php } else { ?>
                            <td align="center">
                                <a href="javascript:;" class="btn btn-info btn-sm detail-penugasan" title="Lihat Data" data-id="<?= $r->id ?>"><span class="glyphicon glyphicon-user"></span></a>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<!-- /.modaledit -->
<div id="modal-edit" class="modal fade bs-modal-sm" data-width="75%" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        </div>
        <div class="modal-body">
            <div id="content-penugasan">
                <div class="portlet-title">
                    <h4 align="center" class="caption-subject font-blue bold uppercase no-konsultasi"></h4>
                    <hr>
                    <br>
                    <h5 class="caption-subject font-blue bold uppercase">Detail Kepemilikan</h5>
                    <div class="row static-info">
                        <div class="col-md-4 name">Nama Pemilik</div>
                        <div class="col-md-8 value nm-pemilik"></div>
                    </div>
                    <div class="row static-info">
                        <div class="col-md-4 name">Alamat Pemilik</div>
                        <div class="col-md-8 value alamat-pemilik"></div>
                    </div>
                    <div class="row static-info">
                        <div class="col-md-4 name">Jenis Konsultasi</div>
                        <div class="col-md-8 value jenis-konsultasi"></div>
                    </div>
                    <div class="row static-info">
                        <div class="col-md-4 name">Lokasi Bangunan Gedung</div>
                        <div class="col-md-8 value alamat-bangunan"></div>
                    </div>
                    <div class="row static-info">
                        <div class="col-md-4 name">Fungsi Bangunan Gedung</div>
                        <div class="col-md-8 value fungsi-bangunan-gedung"></div>
                    </div>
                    <div class="row static-info">
                        <div class="col-md-4 name">Luas, Tinggi &amp; Jumlah Lantai</div>
                        <div class="col-md-8 value luas-tinggi-lantai"></div>
                    </div>
                    <br>
                    <h5 class="caption-subject font-blue bold uppercase">Detail Tim Penugasan</h5>
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr style="font-weight:bold">
                                <th>No</th>
                                <th>Nama Tim TPA</th>
                                <th>Unsur</th>
                                <th>Bidang Keahlian</th>
                            </tr>
                        </thead>
                        <tbody id="dataPenugasan">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-secondary" onClick=""><i class="fa fa-sign-out"></i> Tutup</button>
        </div>
    </div>
</div>
<div id="modalDetail" class="modal fade bs-modal-sm" data-width="70%" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-content">
        <div class="modal-body">
            <div id="content">
                <div class="portlet-title">
                    <h4 align="center" class="caption-subject font-blue bold uppercase no-konsultasi"></h4>
                    <hr>
                    <br>
                    <h5 class="caption-subject font-blue bold uppercase">Detail Kepemilikan</h5>
                    <div class="row static-info">
                        <div class="col-md-4 name">Nama Pemilik</div>
                        <div class="col-md-8 value nm-pemilik"></div>
                    </div>
                    <div class="row static-info">
                        <div class="col-md-4 name">
                            Alamat Pemilik :
                        </div>
                        <div class="col-md-8 value alamat-pemilik"></div>
                    </div>
                    <div class="row static-info">
                        <div class="col-md-4 name">
                            Jenis Konsultasi :
                        </div>
                        <div class="col-md-8 value jenis-konsultasi"></div>
                    </div>
                    <div class="row static-info">
                        <div class="col-md-4 name">
                            Tanggal Verifikasi &amp; <br> Batas Waktu Pelayanan :
                        </div>
                        <div class="col-md-8 value tgl-periode">
                        </div>
                    </div>
                    <div class="row static-info">
                        <div class="col-md-4 name">
                            Lokasi Bangunan Gedung :
                        </div>
                        <div class="col-md-8 value alamat-bangunan"></div>
                    </div>
                    <div class="row static-info">
                        <div class="col-md-4 name">
                            Fungsi Bangunan Gedung :
                        </div>
                        <div class="col-md-8 value fungsi-bangunan-gedung"></div>
                    </div>

                    <div class="row static-info">
                        <div class="col-md-4 name">
                            Luas, Tinggi &amp; Jumlah Lantai :
                        </div>
                        <div class="col-md-8 value luas-tinggi-lantai">
                        </div>
                    </div>
                    <br>
                    <h5 class="caption-subject font-blue bold uppercase">Daftar Tim Teknis</h5>
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr style="font-weight:bold">
                                <th>No</th>
                                <th>Nama Tim TPA</th>
                                <th>Unsur</th>
                                <th>Bidang Keahlian</th>
                            </tr>
                        </thead>
                        <tbody class="detailPetugas">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-primary"><i class="fa fa-sign-out"></i> Tutup</button>
        </div>
    </div>
</div>


<div id="modalPenugasan" class="modal fade bs-modal-sm" data-width="70%" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-content">
        <div class="modal-body">
            <div id="content">
                <div class="portlet-title">
                    <h4 align="center" class="caption-subject font-blue bold uppercase no-konsultasi"></h4>
                    <hr>
                    <br>
                    <h5 class="caption-subject font-blue bold uppercase">Detail Kepemilikan</h5>
                    <div class="row static-info">
                        <div class="col-md-4 name">
                            Nama Pemilik :
                        </div>
                        <div class="col-md-8 value nm-pemilik"></div>
                    </div>
                    <div class="row static-info">
                        <div class="col-md-4 name">
                            Alamat Pemilik :
                        </div>
                        <div class="col-md-8 value alamat-pemilik"></div>
                    </div>
                    <div class="row static-info">
                        <div class="col-md-4 name">
                            Jenis Konsultasi :
                        </div>
                        <div class="col-md-8 value jenis-konsultasi"></div>
                    </div>
                    <div class="row static-info">
                        <div class="col-md-4 name">
                            Tanggal Verifikasi &amp; <br> Batas Waktu Pelayanan :
                        </div>
                        <div class="col-md-8 value tgl-periode">
                        </div>
                    </div>
                    <div class="row static-info">
                        <div class="col-md-4 name">
                            Lokasi Bangunan Gedung :
                        </div>
                        <div class="col-md-8 value alamat-bangunan"></div>
                    </div>
                    <div class="row static-info">
                        <div class="col-md-4 name">
                            Fungsi Bangunan Gedung :
                        </div>
                        <div class="col-md-8 value fungsi-bangunan-gedung"></div>
                    </div>

                    <div class="row static-info">
                        <div class="col-md-4 name">
                            Luas, Tinggi &amp; Jumlah Lantai :
                        </div>
                        <div class="col-md-8 value luas-tinggi-lantai">
                        </div>
                    </div>
                    <br>
                    <h5 class="caption-subject font-blue bold uppercase daftar-tim-penugasan"></h5>
                    <table class="table table-bordered table-hover">
                        <thead style="text-align:center;">
                            <tr class="info" style="font-weight:bold;">
                                <th>Nama Personil</th>
                                <th>Unsur</th>
                                <th>Bidang</th>
                                <th>Keahlian</th>
                                <th>Pilih</th>
                            </tr>
                        </thead>
                        <tbody class="tim-petugas">
                        </tbody>
                        <input type="hidden" id="idPemilik" value="">
                        <input type="hidden" id="noKonsultasi" value="">
                        <input type="hidden" id="statsPenugasan" value="">

                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-primary btn-cancel">Tutup</button>
            <button type="button" class="btn btn-success simpan-penugasan ladda-button" data-style="expand-right" data-size="l">Simpan</button>
        </div>
    </div>
</div>

<script>
    var site_url = "<?= site_url() ?>";

    $(document).ready(function() {
        var table = $('#tablePenugasan').DataTable({
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


        $(document).on('click', '.detail-penugasan', function(e) {
            e.preventDefault();
            let dataDetail = $(this).data('id');
            $.ajax({
                type: "POST",
                url: `${site_url}DataDetail/DetailPenugasan`,
                data: {
                    id: dataDetail
                },
                dataType: "json",
                beforeSend: function() {
                    Metronic.blockUI({
                        animate: true
                    });
                },
                success: function(response) {
                    if (response.res == true) {
                        Metronic.unblockUI();
                        $(".no-konsultasi").html(response.no_konsultasi);
                        $(".nm-pemilik").html(response.nm_pemilik);
                        $(".jenis-konsultasi").html(response.nm_konsultasi);
                        $(".alamat-pemilik").html(`${response.alamat}, Kec. ${response.nama_kecamatan},${response.nama_kabkota}, ${response.nama_prov_pemilik}`);
                        $(".alamat-bangunan").html(`${response.almt_bgn}, Kec. ${response.nama_kec_bg},${response.nama_kabkota_bg}, ${response.nama_provinsi_bg}`);
                        $(".fungsi-bangunan-gedung").html(`${response.fungsi_bg}`);
                        $(".luas-tinggi-lantai").html(`${response.luas_bgn} m<sup>2</sup>, dengan tinggi ${response.tinggi_bgn} meter, dan berjumlah ${response.jml_lantai} lantai.`);
                        $(".tgl-periode").html(`<p><span class="font-blue">${response.tgl_pernyataan}</span> <i class="text-tot">sampai dengan</i> <span class="font-blue">${response.hasil_tgl}</span> <i class="text-tot">, (${response.lama_proses} Hari Kerja) <br>terhitung dari tanggal verifikasi kelengkapan berkas</i></p>`);
                        var tableDetail;
                        let numDetail = 1;
                        if (response.penugasan != 0) {
                            response.penugasan.forEach(obj => {
                                tableDetail += '<tr>';
                                tableDetail += `<td>${numDetail++}</td>`;
                                tableDetail += `<td>${obj.nama_peg}</td>`;
                                tableDetail += `<td>${obj.nama_unsur}</td>`;
                                tableDetail += `<td>${obj.nama_bidang}</td>`;
                            });
                            $('.detailPetugas').html(tableDetail);
                        } else {
                            $('.detailPetugas').html('');
                        }
                        $('#modalDetail').modal('show');
                    } else {
                        showToast(response.message, 15000, response.type);
                        Metronic.unblockUI();
                    }
                }
            });
        });

        $(document).on('click', '.form-penugasan', function(e) {
            e.preventDefault();
            let dataDetail = $(this).data('id'),
                stats = $(this).data('stats');

            $.ajax({
                type: "POST",
                url: `${site_url}BangunanBertahap/FormPenugasan`,
                dataType: 'json',
                data: {
                    id: dataDetail
                },
                beforeSend: function() {
                    Metronic.blockUI({
                        animate: true
                    });
                },
                success: function(response) {
                    if (response.res == true) {
                        Metronic.unblockUI();
                        $(".no-konsultasi").html(response.no_konsultasi);
                        $(".nm-pemilik").html(response.nm_pemilik);
                        $(".jenis-konsultasi").html(response.nm_konsultasi);
                        $(".alamat-pemilik").html(`${response.alamat}, Kec. ${response.nama_kecamatan},${response.nama_kabkota}, ${response.nama_prov_pemilik}`);
                        $(".alamat-bangunan").html(`${response.almt_bgn}, Kec. ${response.nama_kec_bg},${response.nama_kabkota_bg}, ${response.nama_provinsi_bg}`);
                        $(".fungsi-bangunan-gedung").html(`${response.fungsi_bg}`);
                        $(".luas-tinggi-lantai").html(`${response.luas_bgn} m<sup>2</sup>, dengan tinggi ${response.tinggi_bgn} meter, dan berjumlah ${response.jml_lantai} lantai.`);
                        $(".tgl-periode").html(`<p><span class="font-blue">${response.tgl_pernyataan}</span> <i class="text-tot">sampai dengan</i> <span class="font-blue">${response.hasil_tgl}</span> <i class="text-tot">, (${response.lama_proses} Hari Kerja) <br>terhitung dari tanggal verifikasi kelengkapan berkas</i></p>`);
                        $(".daftar-tim-penugasan").html(response.daftar_tim_penugasan);
                        var table;
                        if (response.tim_petugas != 0) {
                            response.tim_petugas.forEach(obj => {
                                table += '<tr class="clcenter">';
                                table += `<td>${obj.nama_peg}</td>`;
                                table += `<td>${obj.nama_unsur}</td>`;
                                table += `<td>${obj.nama_bidang}</td>`;
                                table += `<td>${obj.nama_keahlian}</td>`;
                                table += `<td><input type="checkbox" name="cek_petugas[]" data-id="${obj.id_personal}" /></tr>`;
                            });
                            $('.tim-petugas').html(table);
                        } else {
                            $('.tim-petugas').html('');
                        }
                        $('#idPemilik').val(response.id_pemilik);
                        $('#noKonsultasi').val(response.no_konsultasi);
                        $('#statsPenugasan').val(stats);

                    } else {
                        showToast(response.message, 15000, response.type);
                        Metronic.unblockUI();
                    }
                    $('#modalPenugasan').modal('show');
                }
            });
        });

        $(document).on('click', '.simpan-penugasan', function(e) {
            e.preventDefault();
            var l = Ladda.create(this),
                totalCeklist = [],
                idPemilik = $('#idPemilik').val(),
                noKonsultasi = $('#noKonsultasi').val(),
                statsPenugasan = $('#statsPenugasan').val();
            $.each(($('.tim-petugas').find('input[type=checkbox]:checked')), function() {
                var id = $(this).data('id');
                totalCeklist.push({
                    'id': id,
                });
            });
            l.start();
            $(".btn-cancel").attr("disabled", true);
            if (totalCeklist.length > 0) {
                $.ajax({
                    type: 'POST',
                    url: `${base_url}BangunanBertahap/SimpanPenugasan`,
                    data: {
                        penugasan: totalCeklist,
                        idPemilik: idPemilik,
                        noKonsultasi: noKonsultasi,
                        statsPenugasan: statsPenugasan,
                    },
                    success: function(response) {
                        setTimeout(function() {
                            showToast(response.message, 15000, response.type);
                            l.stop();
                            $(".btn-cancel").removeAttr("disabled");
                            $('#modalPenugasan').modal('hide');
                            let a = $(`[data-id="${response.dataId}"]`);
                            let b = a.next();
                            let c = a.parent();
                            let d = c.prev().find('span.label');
                            let e = c.parent('tr');
                            e.removeClass('danger').addClass('success');
                            d.removeClass('label-danger').addClass('label-success').text(`Sudah Dilakukan Penugasan ${response.typePenugasan}`);
                            d.find('span').removeClass('label-success');
                            b.html(`<a href="javascript:;" class="btn btn-info btn-sm detail-penugasan" title="Lihat Data" data-id="${response.dataId}"><span class="glyphicon glyphicon-user"></span></a>`)
                            a.remove();
                        }, 1500);
                    },
                });
            } else {
                setTimeout(function() {
                    $(".btn-cancel").removeAttr("disabled");
                    showToast('Silahkan pilih petugas salah satu!', 15000, 'error');
                    l.stop();
                }, 1500);
            }
        });
        function showToast(message, timeout, type) {
            type = (typeof type === 'undefined') ? 'info' : type;
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "positionClass": "toast-top-right",
                "onclick": null,
                "showDuration": "1000",
                "hideDuration": "1000",
                "timeOut": timeout,
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            toastr[type](message);
        }
    });
</script>