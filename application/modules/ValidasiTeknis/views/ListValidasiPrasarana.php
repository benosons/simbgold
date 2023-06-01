<style>
    .u-loading {
        width: 50px;
        height: 50px;
        display: block;
        margin: 48px;
    }

    .u-loading__symbol {
        background-color: #030f6b;
        padding: 8px;
        animation: loading 3s infinite;
        border-radius: 5px;
    }

    .u-loading__symbol img {
        display: block;
        max-width: 100%;
        animation: loading-icon 3s infinite;
    }

    @keyframes loading {
        0% {
            transform: perspective(250px) rotateX(0deg) rotateY(0deg);
        }

        15% {
            background-color: #030f6b;
        }

        16% {
            background-color: #F4A42C;
        }

        50% {
            transform: perspective(250px) rotateX(180deg) rotateY(0deg);
            background-color: #F4A42C;
        }

        65% {
            background-color: #F4A42C;
        }

        66% {
            background-color: #030f6b;
        }

        100% {
            transform: perspective(250px) rotateX(180deg) rotateY(-180deg);
        }
    }

    @keyframes loading-icon {
        0% {
            transform: perspective(250px) rotateX(0deg) rotateY(0deg);
        }

        15% {
            transform: perspective(250px) rotateX(0deg) rotateY(0deg);
        }

        16% {
            transform: perspective(250px) rotateX(180deg) rotateY(0deg);
        }

        50% {
            transform: perspective(250px) rotateX(180deg) rotateY(0deg);
        }

        65% {
            transform: perspective(250px) rotateX(180deg) rotateY(0deg);
        }

        66% {
            transform: perspective(250px) rotateX(180deg) rotateY(180deg);
        }

        100% {
            transform: perspective(250px) rotateX(180deg) rotateY(180deg);
        }
    }
</style>
<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption"><i class="fa fa-globe"></i>List Validasi Kepala Dinas Teknis untuk Bangunan Prasarana Baru</div>
        <div class="tools"><a href="javascript:;" class="reload"></a></div>
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
                    <th>Dokumen</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($Kadis->num_rows() > 0) {
                    $no = 1;
                    foreach ($Kadis->result() as $Kadis) { ?>
                        <?php if ($Kadis->status == '10') {
                            if($Kadis->catatan == null || $Kadis->catatan == ''){
                                $clss = "danger";
                            }else{
                                $clss = "warning";
                            }
                        } else {
                            $clss = "success";
                        } ?>
                        <tr class="<?= $clss ?>">
                            <td align="center"><?php echo $no++; ?></td>
                            <td><?php echo $Kadis->nm_konsultasi; ?></td>
                            <td align="center"><?php echo $Kadis->no_konsultasi; ?></td>
                            <td align="center"><?php echo $Kadis->nm_pemilik; ?></td>
                            <td><?php echo $Kadis->almt_bgn; ?></td>
                            <?php if ($Kadis->catatan == null || $Kadis->catatan == ''){ ?>
                                <td>
                                    <a href="javascript:;" class="btn btn-info btn-sm detail-retribusi" title="Lihat Data" data-id="<?= $Kadis->id ?>"><span class="fa fa-file"></span> Lihat Disini</a>
                                </td>
                            <?php } else {?>
                                <td>
                                    <a href="javascript:;" class="btn btn-info btn-sm detail-retribusi" title="Lihat Data" data-id="<?= $Kadis->id ?>"><span class="fa fa-file"></span> Lihat Disini</a>
                                    <div class="data-action"></div><br>
                                    <a href="<?php echo site_url('ValidasiTeknis/Catatan/' . $Kadis->id); ?>" class="btn btn-info btn-sm" title="Lihat Data" id="tombolver" data-toggle="modal" data-target="#modal-edit2"><span class="fa fa-file"></span> Lihat Catatan</a>
                                </td>
                            <?php }?>
                            <?php if ($Kadis->status == 10) { ?>
                                <td align="center">
                                    <a href="#dialog-popup"  onClick="GetVerifikasi(<?php echo $Kadis->id ?>)" class="btn btn-danger btn" title="Verifikasi Permohonan" id="tombolinver" data-toggle="modal">Menunggu Verifikasi</a>
                                    <div class="data-action"></div><br>
                                    <?php if($Kadis->imb == 1){ ?>
                                        <a href="<?php echo site_url('ValidasiTeknis/RollbackKadis/' . $Kadis->id); ?>" class="btn btn-warning btn-sm" onclick="return confirm('Yakin Mengembalikan Permohonan ini ke Proses Perhitungan Retribusi?')"title="Dikembalikan ke Proses Perhitungan Retribusi"><span class="glyphicon glyphicon-edit"></span>
                                    <?php }else{ ?>
                                        <a href="<?php echo site_url('ValidasiTeknis/RollbackKadis/' . $Kadis->id); ?>" class="btn btn-warning btn-sm" onclick="return confirm('Yakin Mengembalikan Permohonan ini ke Proses Perhitungan Retribusi?')"title="Dikembalikan ke Proses Perhitungan Retribusi"><span class="glyphicon glyphicon-edit"></span>
                                    <?php } ?>
                                </td>
                            <?php } else { ?>
                                <td align="center">
                                    <a href="#" onclick="GetCetakRekomtek(<?php echo $Kadis->id ?>)" class="btn btn-info btn" title="Cetak Rekomtek" id="tombolinver"><span class="glyphicon glyphicon-print"> Terverifikasi (Lihat Rekomtek)</span></a>
                                </td>
                            <?php } ?>
                        </tr>
                <?php }
                } ?>
            </tbody>
        </table>
    </div>
</div>
<div id="modal-edit2" class="modal fade bs-modal-sm" data-width="40%" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        </div>
        <div class="modal-body">
            <div id="content">
			</div>
        </div>
	</div>
</div>

<div id="dialog-popup" class="modal fade bs-modal-sm" data-width="55%" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-content">
        <form action="<?php echo site_url('ValidasiTeknis/FormVerifikasiBaru'); ?>" class="form-horizontal" role="form" method="post">
            <input type="text" style="display: none;" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >             
            <div class="modal-header">
                <button type="button" onclick="return confirm('Yakin Ingin Keluar?')" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body" id="MyModalBody"></div>
            <div class="modal-footer">
                <input class="form-control" type="hidden" id="id" name="id" style="display: block;">
                <center><button type="submit" onclick="return confirm('Yakin Datanya Telah Benar?')" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-check"></span>Validasi Kepala Dinas</button></center>
            </div>
        </form>
    </div>
</div>

<div id="modalDetail" class="modal fade bs-modal-sm" data-width="70%" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        </div>
        <div class="modal-body">
            <div id="content">
                <div class="portlet-title">
                    <h4 align="center" class="caption-subject font-blue bold uppercase no-konsultasi"></h4>
                    <hr>
                    <br>
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
                        <div class="col-md-4 name">Tanggal Verifikasi &amp; <br> Batas Waktu Pelayanan</div>
                        <div class="col-md-8 value tgl-periode">
                        </div>
                    </div>
                    <div class="row static-info">
                        <div class="col-md-4 name">Lokasi Bangunan Gedung</div>
                        <div class="col-md-8 value alamat-bangunan"></div>
                    </div>
                    <div class="fungsi-bangunan" style="display:none;">
                        <div class="row static-info">
                            <div class="col-md-4 name">Fungsi Bangunan Gedung</div>
                            <div class="col-md-8 value fungsi-bangunan-gedung"></div>
                        </div>

                        <div class="row static-info">
                            <div class="col-md-4 name">Luas, Tinggi &amp; Jumlah Lantai</div>
                            <div class="col-md-8 value luas-tinggi-lantai">
                            </div>
                        </div>
                    </div>
                    <div class="bangunan-kolektif" style="display:none;">
                        <div class="row static-info">
                            <div class="col-md-4 name">Jenis Konsultasi Bangunan</div>
                            <div class="col-md-8 value">Bangunan Gedung Kolektif</div>
                        </div>

                        <div class="row static-info">
                            <div class="col-md-4 name">Data Bangunan Gedung Kolektif</div>
                            <div class="col-md-8 value">
                                <table class="table table-hover table-bordered dt-responsive wrap">
                                    <thead>
                                        <tr>
                                            <th>Tipe</th>
                                            <th>Luas (m<sup>2</sup>)</th>
                                            <th>Tinggi</th>
                                            <th>Lantai</th>
                                            <th>Jumlah Unit</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableKolektif">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row static-info">
                            <div class="col-md-4 name">Total Luas Bangunan Kolektif</div>
                            <div class="col-md-8 value total-luas-kolektif"></div>
                        </div>
                    </div>
                    <hr>
                    <h4 align="center" class="caption-subject font-blue bold uppercase">Detail Perhitungan Retribusi</h4>
                    <hr>
                    <div class="row static-info">
                        <div class="col-md-4 name">Berita Acara/Rekomtek</div>
                        <div class="col-md-8 value berita-acara"></div>
                    </div>
                    <div class="row static-info">
                        <div class="col-md-4 name">Status Perhitungan Retribusi</div>
                        <div class="col-md-8 value status-perhitungan"></div>
                    </div>
                    <div class="manual-retribusi" style="display:none;">
                        <div class="row static-info">
                            <div class="col-md-4 name">Nilai Retribusi Bangunan</div>
                            <div class="col-md-8 value nilai-retribusi-bangunan"></div>
                        </div>
                        <div class="row static-info">
                            <div class="col-md-4 name">Nilai Retribusi Prasarana</div>
                            <div class="col-md-8 value nilai-retribusi-prasarana"></div>
                        </div>
                        <div class="row static-info">
                            <div class="col-md-4 name">Nilai Retribusi Keseluruhan</div>
                            <div class="col-md-8 value nilai-retribusi-keseluruhan"></div>
                        </div>
                        <div class="lampiran" style="display:none;">
                            <div class="row static-info">
                                <div class="col-md-4 name">Lampiran Perhitungan Retribusi</div>
                                <div class="col-md-8 value">
                                    <a href="javascript:;" class="btn btn-primary berkas-retribusi"><i class="fa fa-file"></i> Lihat Berkas</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sistem-retribusi" style="display:none;"><br>
                        <h5 class="caption-subject font-blue bold uppercase">Detail Indeks Terintegrasi</h5>
                        <div class="row static-info">
                            <div class="col-md-4 name">Indeks Parameter Fungsi Bangunan</div>
                            <div class="col-md-8 value parameter-fungsi"></div>
                        </div>
                        <div class="row static-info">
                            <div class="col-md-4 name">Indeks Parameter Kompleksitas</div>
                            <div class="col-md-8 value parameter-kompleksitas"></div>
                        </div>
                        <div class="row static-info">
                            <div class="col-md-4 name">Indeks Parameter Fungsi Bangunan</div>
                            <div class="col-md-8 value parameter-permanensi"></div>
                        </div>
                        <div class="row static-info">
                            <div class="col-md-4 name">Indeks Parameter Ketinggian</div>
                            <div class="col-md-8 value parameter-ketinggian"></div>
                        </div>
                        <div class="row static-info">
                            <div class="col-md-4 name">Faktor Kepemilikan</div>
                            <div class="col-md-8 value faktor-kepemilikan"></div>
                        </div>
                        <div class="row static-info">
                            <div class="col-md-4 name">
                                Indeks Terintegrasi:
                            </div>
                            <div class="col-md-8 value indeks-integrasi"></div>
                        </div>
                        <h5 class="caption-subject font-blue bold uppercase">Hasil Perhitungan Retribusi Bangunan</h5>
                        <div class="row static-info">
                            <div class="col-md-4 name">
                                Luas Bangunan Gedung:
                            </div>
                            <div class="col-md-8 value luas-bangunan"></div>
                        </div>
                        <div class="row static-info">
                            <div class="col-md-4 name">
                                SHST (Standar Harga Satuan Tertinggi):
                            </div>
                            <div class="col-md-8 value shst"></div>
                        </div>
                        <div class="row static-info">
                            <div class="col-md-4 name">
                                Indeks Lokalitas:
                            </div>
                            <div class="col-md-8 value indeks-lokalitas"></div>
                        </div>
                        <div class="row static-info">
                            <div class="col-md-4 name">
                                Kegiatan:
                            </div>
                            <div class="col-md-8 value kegiatan"></div>
                        </div>
                        <div class="row static-info">
                            <div class="col-md-4 name">
                                Nilai Retribusi Bangunan:
                            </div>
                            <div class="col-md-8 value hasil-retribusi-bgn"></div>
                        </div>
                        <h5 class="caption-subject font-blue bold uppercase">Hasil Perhitungan Retribusi Prasarana</h5>
                        <table class="table table-bordered table-striped table-hover">
                            <tbody>
                                <tr style="padding-left: 5px; padding-bottom:3px;  font-weight:bold">
                                    <th>No</th>
                                    <th>Nama Sarana</th>
                                    <th>Harga Prasarana</th>
                                    <th>Panjang/Luas/Volume</th>
                                    <th>Total Prasarana </th>
                                </tr>
                            <tbody id="dataPrasarana">
                            </tbody>
                        </table>
                        <div class="row static-info">
                            <div class="col-md-4 name">
                                Nilai Retribusi Prasarana:
                            </div>
                            <div class="col-md-8 value nilai-retribusi-prasarana"></div>
                        </div>
                        <h5 class="caption-subject font-blue bold uppercase">Hasil Perhitungan Retribusi Keseluruhan</h5>
                        <div class="row static-info">
                            <div class="col-md-4 name">
                                Nilai Retribusi Keseluruhan:
                            </div>
                            <div class="col-md-8 value nilai-retribusi-keseluruhan"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-primary" onClick=""><i class="fa fa-sign-out"></i> Tutup</button>
        </div>
    </div>
</div>

<script>
    function GetCetakRekomtek(id) {
        var url = "<?php echo base_url() . index_page() ?>Dokumen/CetakVerifikasiBangunanPrasaranaBaru/" + id;
        swin = window.open(url, 'win', 'scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
        swin.focus();
    }
    function GetVerifikasi(id) {
        $("#MyModalBody").html('<iframe src="<?php echo base_url(); ?>Dokumen/CetakVerifikasiBangunanPrasaranaBaru/' + id + '" frameborder="no" width="860" height="540"></iframe>');
        $('[name="id"]').val(id);
    }
</script>
<script>
    var site_url = "<?= site_url() ?>";
    $(document).ready(function() {
        var table = $('#sample_1').DataTable({
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

        $('.btn-option').click(function(e) {
            let dataId = $(this).data('id');
            e.preventDefault();
            $('#modal-option').modal('show');
            $(`a.hitung-sistem`).attr(`href`, `${site_url}/Perhitungan/retribusi/${dataId}`);
            $(`a.hitung-perda`).attr(`data-val`, `${dataId}`);
            $(`a.no-konsultasi`).attr();
        });

        $('.hitung-perda').click(function(e) {
            e.preventDefault();
            let dataKonsultasi = $(this).data('val');
            $('#modal-option').modal('hide');
            $('#modal-perda').modal('show');
            $('.no-konsultasi').val(dataKonsultasi);
        });

        $('.hitung-perda').on('submit', '#perhitunganPerda', function() {});

        $('#formPerda').submit(function(e) {
            e.preventDefault();
            var l = Ladda.create(document.querySelector('.form-submit'));
            $(".btn-cancel").attr("disabled", true);
            $(".btn-close").css("display", "none");
            l.start();
            $.ajax({
                type: "POST",
                url: `${site_url}Perhitungan/simpan_perda`,
                data: new FormData(this),
                dataType: 'json',
                processData: false,
                contentType: false,
                enctype: 'multipart/form-data',
                success: function(response) {
                    if (response.status == false) {
                        setTimeout(function() {
                            showToast(response.message, 15000, response.type);
                            l.stop();
                            $(".btn-cancel").removeAttr("disabled");
                            $(".btn-close").css("display", "block")
                        }, 1500);
                    } else {
                        setTimeout(function() {
                            showToast(response.message, 15000, response.type);
                            l.stop();
                            $(".btn-cancel").removeAttr("disabled");
                            $(".btn-close").css("display", "block")
                            $('#responsive').modal('hide');
                            $('#modal-perda').modal('hide');
                            let a = $(`[data-id="${response.no_konsultasi}"]`);
                            let b = a.next();
                            let c = a.parent();
                            let d = c.prev().find('span.label');
                            let e = c.parent('tr');
                            e.removeClass('danger').addClass('success');
                            d.removeClass('label-danger').addClass('label-success').text('Selesai Perhitungan Retribusi');
                            d.find('span').removeClass('label-success');
                            b.html(`<a href="javascript:;" class="btn btn-info btn-sm detail-retribusi" title="Lihat Data" data-id="${response.dataId}"><span class="glyphicon glyphicon-user"></span></a>`)
                            a.remove();
                        }, 1500);
                    }
                }
            });
        });

        $(document).on('click', '.detail-retribusi', function(e) {
            e.preventDefault();
            let dataDetail = $(this).data('id');
            $.ajax({
                type: "POST",
                url: `${site_url}DataDetail/DetailValidasi`,
                data: {
                    id: dataDetail
                },
                beforeSend: function() {
                    $.blockUI({
                        message: `<div class="u-loading__symbol" style="width:70px;"><img src="${base_url}assets/logo/pupr.jpg"></div></div>`,
                        css: {
                            width: '70px',
                            position: 'fixed',
                            top: '45%',
                            bottom: '45%',
                            left: '45%',
                            border: 'none',
                            backgroundColor: false,
                            '-webkit-border-radius': '10px',
                            '-moz-border-radius': '10px',
                            color: '#fff'
                        }
                    });
                },
                dataType: "json",
                success: function(response) {
                    setTimeout(function() {
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
                            $(".nilai-retribusi-bangunan").html(`Rp. ${response.nilai_retribusi_bangunan}`);
                            $(".status-perhitungan").html(response.status_perhitungan);
                            $(".nilai-retribusi-prasarana").html(`Rp. ${response.nilai_retribusi_prasarana}`);
                            $(".nilai-retribusi-keseluruhan").html(`Rp. ${response.nilai_retribusi_keseluruhan}`);
                            $(".berita-acara").html(`<a href="javascript:void(0);" class="btn default btn-xs blue-stripe" title="Lihat Berkas" onclick="javascript:popWin('${site_url}/${response.dir_file_konsultasi}')"><span class="glyphicon glyphicon-file"></span>Lihat</a>`);
                            if (response.id_jenis_permohonan == 11) {
                                $('.fungsi-bangunan').css('display', 'none');
                                $('.bangunan-kolektif').css('display', 'block');
                                $('.total-luas-kolektif').html(`${response.luas_total_kolektif} m<sup>2</sup>`);
                                var tableKolektif;
                                if (response.hasil_kolektif != 0) {
                                    response.hasil_kolektif.forEach(obj => {
                                        tableKolektif += '<tr>';
                                        tableKolektif += `<td>${obj.tipe}</td>`;
                                        tableKolektif += `<td>${obj.luas}</td>`;
                                        tableKolektif += `<td>${obj.tinggi}</td>`;
                                        tableKolektif += `<td>${obj.lantai}</td>`;
                                        tableKolektif += `<td>${obj.jumlah}</td></tr>`;
                                        $('#tableKolektif').html(tableKolektif);
                                    });
                                }
                            } else {
                                $('.fungsi-bangunan').css('display', 'block');
                                $('.bangunan-kolektif').css('display', 'none');
                            }

                            if (response.stats_retribusi == 2) {
                                $(`a.berkas-retribusi`).attr(`onClick`, `javascript:popWin('${base_url}${response.berkas_retribusi}')`);
                                $('.lampiran').css('display', 'block');
                                $('.sistem-retribusi').css('display', 'none');
                                $('.manual-retribusi').css('display', 'block');
                            } else {
                                $('.lampiran').css('display', 'none');
                                $('.sistem-retribusi').css('display', 'block');
                                $('.manual-retribusi').css('display', 'none');
                                $(".parameter-fungsi").html(`${response.fungsi_bg} (${response.parameter_fungsi})`);
                                $(".parameter-permanensi").html(`${response.permanensi} (${response.parameter_permanensi})`);
                                $(".parameter-kompleksitas").html(`${response.klasifikasi_bg} (${response.parameter_kompleksitas})`);
                                $(".parameter-ketinggian").html(`${response.tinggi_bgn} Meter (${response.parameter_ketinggian})`);
                                $(".faktor-kepemilikan").html(response.kepemilikan);
                                $(".indeks-integrasi").html(response.indeks_integrasi);
                                $(".luas-bangunan").html(`${response.luas_bgn} m<sup>2</sup>`);
                                $(".shst").html(`Rp. ${response.shst}`);
                                $(".indeks-lokalitas").html(response.indeks_lokalitas);
                                $(".kegiatan").html(`${response.kegiatan} (${response.parameter_kegiatan})`);
                                $(".hasil-retribusi-bgn").html(response.hasil_retribusi_bgn);
                                var table;
                                let num = 1;
                                if (response.prasarana != 0) {
                                    response.prasarana.forEach(obj => {
                                        table += '<tr>';
                                        table += `<td>${num++}</td>`;
                                        table += `<td>${obj.nama_prasarana}</td>`;
                                        table += `<td>Rp. ${obj.harga_prasarana}</td>`;
                                        table += `<td>${obj.plv}</td>`;
                                        table += `<td>Rp. ${obj.total_prasarana}</td>`;
                                        $('#dataPrasarana').html(table);
                                    });
                                }
                            }
                            $('#modalDetail').modal('show');
                        } else {
                            showToast(response.message, 15000, response.type);
                            Metronic.unblockUI();
                        }
                    }, 500);

                }
            });
        });

    });

    function popWin(x) {
        url = x;
        swin = window.open(url, 'win', 'scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
        swin.focus();
    }

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
</script>