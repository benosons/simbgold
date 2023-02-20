<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption"><i class="fa fa-globe"></i>Data Konsultasi</div>
        <div class="tools"><a href="javascript:;" class="reload"></a></div>
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
                        if ($pbg->status == 6) {
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
                            <td align="center"><?php echo $ustat; ?></td>
                            <td align="center">
                                <?php if ($pbg->status == 6) : ?>
                                    <a href="<?= site_url("Pemeriksaan/FormPemeriksaan/{$this->secure->encrypt_url($pbg->id)}") ?>" class="btn btn-primary btn-sm" title="Input Hasil Konsultasi"><span class="fa fa-edit"></span></a>
                                    <div class="data-action"></div><br>
                                    <a href="<?php echo site_url('Pemeriksaan/Rollback/' . $pbg->id); ?>" class="btn btn-warning btn-sm" onclick="return confirm('Yakin Mengembalikan Permohonan ini ke Proses Penugasan TPA/TPT?')" title="Dikembalikan ke Proses Penjadwalan TPA/TPT"><span class="fa fa-arrow-left"></span>
                                <?php else : ?>
                                    <a href="javascript:;" class="btn btn-info btn-sm detail-pemeriksaan" title="Lihat Data" data-id="<?= $pbg->id ?>"><span class="glyphicon glyphicon-user"></span></a>
                                <?php endif; ?>
                            </td>
                        </tr>
                <?php }
                } ?>
            </tbody>
        </table>
    </div>
</div>
<div id="modalDetail" class="modal fade bs-modal-sm" data-width="70%" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-content">
        <div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button></div>
        <div class="modal-body">
            <div id="content">
                <div class="portlet-title">
                    <h4 align="center" class="caption-subject font-blue bold uppercase no-konsultasi"></h4>
                    <hr>
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
                    <!--<div class="row static-info">
                        <div class="col-md-4 name">Tgl. Verifikasi &amp; <br> Batas Waktu Pelayanan</div>
                        <div class="col-md-8 value tgl-periode"></div>
                    </div>-->
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
                            <div class="col-md-8 value luas-tinggi-lantai"></div>
                        </div>
                    </div>
                    <div class="prasarana" style="display:none;">
                        <div class="row static-info">
                            <div class="col-md-4 name">Fungsi Bangunan Gedung</div>
                            <div class="col-md-8 value jns-prasarana"></div>
                        </div>
                        <div class="row static-info">
                            <div class="col-md-4 name">Luas dan Tinggi </div>
                            <div class="col-md-8 value luas-tinggi-prasarana"></div>
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
                                    <tbody id="tableKolektif2"></tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row static-info">
                            <div class="col-md-4 name">Total Luas Bangunan Kolektif</div>
                            <div class="col-md-8 value total-luas-kolektif"></div>
                        </div>
                    </div>

                    <h5 class="caption-subject font-blue bold uppercase">Detail Permohonan</h5>
                    <div class="portlet-body">
                        <div class="tabbable-custom nav-justified">
                            <ul class="nav nav-tabs nav-justified">
                                <li class="active"><a href="#tabtot" data-toggle="tab">Data Bangunan</a></li>
                                <li><a href="#tab_2_1" data-toggle="tab">Data Tanah </a></li>
                                <li><a href="#tab_2_2" data-toggle="tab">Data Umum </a></li>
                                <li><a href="#tab_2_3" data-toggle="tab">Data Arsitektur</a></li>
                                <li><a href="#tab_2_4" data-toggle="tab">Data Struktur</a></li>
                                <li><a href="#tab_2_5" data-toggle="tab">Data MEP</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="tabtot">
                                    <div class="col-md-12">
                                        <h5 class="caption-subject font-blue bold uppercase">Data Lengkap Pemilik</h5>
                                        <div class="row static-info">
                                            <div class="col-md-4 name">Nama Pemilik</div>
                                            <div class="col-md-8 value nm-pemilik"></div>
                                        </div>
                                        <div class="row static-info">
                                            <div class="col-md-4 name">Alamat Pemilik Bangunan</div>
                                            <div class="col-md-8 value alamat-pemilik"></div>
                                        </div>
                                        <div class="row static-info">
                                            <div class="col-md-4 name">Nomor Telp / Hp</div>
                                            <div class="col-md-8 value no-telp"></div>
                                        </div>
                                        <div class="row static-info">
                                            <div class="col-md-4 name">E-mail</div>
                                            <div class="col-md-8 value email"></div>
                                        </div>
                                        <div class="row static-info">
                                            <div class="col-md-4 name">No. Identitas</div>
                                            <div class="col-md-8 value no-identitas"></div>
                                        </div>
                                        <br>
                                        <h5 class="caption-subject font-blue bold uppercase">Data Umum Bangunan Gedung</h5>
                                        <div class="row static-info">
                                            <div class="col-md-4 name">Jenis Konsultasi</div>
                                            <div class="col-md-8 value jenis-konsultasi"></div>
                                        </div>
                                        <div class="row static-info">
                                            <div class="col-md-4 name">Nama Bangunan Gedung</div>
                                            <div class="col-md-8 value nm-bgn"></div>
                                        </div>

                                        <div class="row static-info">
                                            <div class="col-md-4 name">Lokasi Bangunan Gedung</div>
                                            <div class="col-md-8 value alamat-bangunan"></div>
                                        </div>
                                        <div class="fungsi-bangunan" style="display:none;">
                                            <div class="row static-info">
                                                <div class="col-md-4 name">Klasifikasi Bangunan Gedung</div>
                                                <div class="col-md-8 value klasifikasi-bg"></div>
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-4 name">Fungsi Bangunan Gedung</div>
                                                <div class="col-md-8 value fungsi-bangunan-gedung"></div>
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-4 name">Luas, Tinggi &amp; Jumlah Lantai</div>
                                                <div class="col-md-8 value luas-tinggi-lantai"></div>
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-4 name">Luas Basement</div>
                                                <div class="col-md-8 value luas-basement"></div>
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-4 name">Jumlah Lantai Basement</div>
                                                <div class="col-md-8 value lapis-basement"></div>
                                            </div>
                                        </div>
                                        <div class="prasarana" style="display:none;">
                                            <div class="row static-info">
                                                <div class="col-md-4 name">Fungsi Bangunan Gedung</div>
                                                <div class="col-md-8 value jns-prasarana"></div>
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-4 name">Luas dan Tinggi </div>
                                                <div class="col-md-8 value luas-tinggi-prasarana"></div>
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
                                                        <tbody id="tableKolektif"></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-4 name">Total Luas Bangunan Kolektif</div>
                                                <div class="col-md-8 value total-luas-kolektif"></div>
                                            </div>
                                        </div>
                                        <!--<div class="row static-info">
                                            <div class="col-md-4 name">Perancang Dokumen Teknis</div>
                                            <div class="col-md-8 value">Perencana Kontruksi</div>
                                        </div>-->
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab_2_1">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr class="warning">
                                                <th><center>No.</center></th>
                                                <th><center>Jenis Dokumen</center></th>
                                                <th><center>No. dan Tgl Dokumen</center></th>
                                                <th><center>Luas Tanah (m2)</center></th>
                                                <th><center>Atas Nama</center></th>
                                                <th><center>Berkas</center></th>
                                                <th><center>Izin Pemanfaatan</center></th>
                                            </tr>
                                        </thead>
                                        <tbody class="data-tanah"></tbody>
                                    </table>
                                    <div id="id_izin">
                                        <table class="table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th style="text-align:center;">No</th>
                                                    <th style="text-align:center;">Ketentuan Teknis Tanah</th>
                                                    <th style="text-align:center;">Keterangan</th>
                                                    <th style="text-align:center;">Berkas</th>
                                                </tr>
                                            </thead>
                                            <tbody class="ketentuan-tanah"></tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab_2_2">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Dokumen Umum</th>
                                                <th>Keterangan</th>
                                                <th>Berkas</th>
                                            </tr>
                                        </thead>
                                        <tbody class="data-umum"></tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="tab_2_3">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Persyaratan</th>
                                                <th>Catatan</th>
                                                <th>Berkas</th>
                                                <th>Kesesuaian</th>
                                            </tr>
                                        </thead>
                                        <tbody class="data-arsitektur"></tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="tab_2_4">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Persyaratan</th>
                                                <th>Catatan</th>
                                                <th>Berkas</th>
                                                <th>Kesesuaian</th>
                                            </tr>
                                        </thead>
                                        <tbody class="data-struktur"></tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="tab_2_5">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Persyaratan</th>
                                                <th>Catatan</th>
                                                <th>Berkas</th>
                                                <th>Kesesuaian</th>
                                            </tr>
                                        </thead>
                                        <tbody class="data-mep"></tbody>
                                    </table>
                                </div>
                            </div>
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
    var site_url = "<?= site_url() ?>";
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
        $(document).on('click', '.detail-pemeriksaan', function(e) {
            e.preventDefault();
            let dataDetail = $(this).data('id');
            $.ajax({
                type: "POST",
                url: `${site_url}DataDetail/DetailPemeriksaan`,
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
                        $(".alamat-pemilik").html(`${response.alamat}, Kec. ${response.nama_kecamatan}, ${response.nama_kabkota}, ${response.nama_prov_pemilik}`);
                        $(".jenis-konsultasi").html(response.nm_konsultasi);
                        $(".alamat-bangunan").html(`${response.almt_bgn}, Kec. ${response.nama_kec_bg}, ${response.nama_kabkota_bg}, ${response.nama_provinsi_bg}`);
                        $(".fungsi-bangunan-gedung").html(`${response.fungsi_bg}`);
                        $(".luas-tinggi-lantai").html(`${response.luas_bgn} m<sup>2</sup>, dengan tinggi ${response.tinggi_bgn} meter, dan berjumlah ${response.jml_lantai} lantai.`);
                        $(".luas-tinggi-prasarana").html(`${response.luas_bgp} m<sup>2</sup>, dengan tinggi ${response.tinggi_bgp} meter.`);
                        $(".jns-prasarana").html(`${response.jns_prasarana}`);
                        if (response.id_jenis_permohonan == 11 || response.id_jenis_permohonan == 29 || response.id_jenis_permohonan == 30 || response.id_jenis_permohonan == 31 || response.id_jenis_permohonan == 32) {
                            $('.fungsi-bangunan').css('display', 'none');
                            $('.bangunan-kolektif').css('display', 'block');
                            $('.prasarana').css('display', 'none');
                            $('.total-luas-kolektif').html(`${response.luas_total_kolektif} m<sup>2</sup>`);
                            var tableKolektif2;
                            if (response.hasil_kolektif != 0) {
                                response.hasil_kolektif.forEach(obj => {
                                    tableKolektif2 += '<tr>';
                                    tableKolektif2 += `<td>${obj.tipe}</td>`;
                                    tableKolektif2 += `<td>${obj.luas}</td>`;
                                    tableKolektif2 += `<td>${obj.tinggi}</td>`;
                                    tableKolektif2 += `<td>${obj.lantai}</td>`;
                                    tableKolektif2 += `<td>${obj.jumlah}</td></tr>`;
                                    $('#tableKolektif2').html(tableKolektif2);
                                });
                            }
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
                        } else if (response.id_jenis_permohonan == 12) {
                            $('.bangunan-kolektif').css('display', 'none');
                            $('.fungsi-bangunan').css('display', 'none');
                            $('.prasarana').css('display', 'block');
                        } else {
                            $('.bangunan-kolektif').css('display', 'none');
                            $('.fungsi-bangunan').css('display', 'block');
                            $('.prasarana').css('display', 'none');
                        }
                        $(".konsultasi-ke").val(`ke-${response.nextKonsultasi}`);
                        $(".tgl-periode").html(`<p class="font-blue"> ${response.tgl_pernyataan} <i class="text-tot">sampai dengan</i> ${response.hasil_tgl} <i class="text-tot">, (${response.lama_proses} Hari Kerja) <br>terhitung dari tanggal verifikasi kelengkapan berkas</i></p>`);
                        $("#idKonsultasi").val(response.id_konsultasi);
                        $("#email").val(response.email);
                        $("#noreg").val(response.no_konsultasi);
                        $(".no-telp").html(`${response.no_hp}`);
                        $(".email").html(`${response.email}`);
                        $(".no-identitas").html(`${response.no_ktp}`);
                        $(".nm-bgn").html(`${response.nm_bgn}`);
                        $(".klasifikasi-bg").html(`${response.klasifikasi_bg}`);
                        $(".luas-bg").html(`${response.luas_bgn} m<sup>2</sup>`);
                        $(".tinggi-bg").html(`${response.tinggi_bgn} Meter`);
                        $(".jumlah-lantai").html(`${response.jml_lantai} Lantai`);
                        $(".tinggi-bg").html(`${response.tinggi_bgn} m<sup>2</sup>`);
                        $(".luas-basement").html(`${response.luas_basement} Meter`);
                        $(".lapis-basement").html(`${response.lapis_basement} Lantai`);
                        $(".lantai-bgn").html(`${response.jml_lantai} Lantai`);
                        var tableTanah;
                        let numTanah = 1;
                        if (response.tanah != 0) {
                            response.tanah.forEach(obj => {
                                tableTanah += '<tr style="text-align: center;">';
                                tableTanah += `<td>${numTanah++}</td>`;
                                tableTanah += `<td>${obj.jenis_dokumen}</td>`;
                                tableTanah += `<td>${obj.no_dok}<br>${obj.tanggal_dok}</td>`;
                                tableTanah += `<td>${obj.luas_tanah} m<sup>2</sup></td>`;
                                tableTanah += `<td>${obj.atas_nama_dok}</td>`;
                                let berkas = obj.dir_file == false ? 'Tidak ada dokumen' : `<a href="javascript:void(0);" class="btn btn-success btn-sm" title="Lihat Berkas" onclick="javascript:popWin('${site_url}${obj.dir_file}')"><span class="glyphicon glyphicon-file"></span></a>`;
                                let pemanfaatan = obj.dir_file_phat == false ? 'Tidak ada dokumen' : `<a href="javascript:void(0);" class="btn btn-success btn-sm" title="Lihat Berkas" onclick="javascript:popWin('${site_url}${obj.dir_file_phat}')"><span class="glyphicon glyphicon-file"></span></a>`;
                                tableTanah += `	<td>${berkas}</td>`;
                                tableTanah += `	<td>${pemanfaatan}</td></tr>`;
                            });
                            $('.data-tanah').html(tableTanah);
                        } else {
                            $('.data-tanah').html('');
                        }

                        if (response.id_izin != 2) {
                            var teknisTanah;
                            let numTanahTeknis = 1;
                            response.syarat_tanah.forEach(obj => {
                                teknisTanah += '<tr>';
                                teknisTanah += `<td style="text-align:center;">${numTanahTeknis++}</td>`;
                                teknisTanah += `<td>${obj.nm_dokumen}</td>`;
                                teknisTanah += `<td>${obj.keterangan}</td>`;
                                let berkas = obj.dir_file == false ? 'Tidak ada dokumen' : `<a href="javascript:void(0);" class="btn default btn-xs blue-stripe" title="Lihat Berkas" onclick="javascript:popWin('${site_url}${obj.dir_file}')"><span class="glyphicon glyphicon-file"></span>Lihat</a>`;
                                teknisTanah += `<td style="text-align:center;">${berkas}</td></tr>`;
                            });
                            $('.ketentuan-tanah').html(teknisTanah);
                            document.getElementById('id_izin').style.display = "block";
                        } else {
                            document.getElementById('id_izin').style.display = "none";
                        }
                        var tableUmum;
                        let numTableUmum = 1;
                        response.syarat_umum.forEach(obj => {
                            tableUmum += '<tr>';
                            tableUmum += `<td style="text-align:center;">${numTableUmum++}</td>`;
                            tableUmum += `<td>${obj.nm_dokumen}</td>`;
                            tableUmum += `<td>${obj.keterangan}</td>`;
                            let berkas = obj.dir_file == false ? 'Tidak ada dokumen' : `<a href="javascript:void(0);" class="btn default btn-xs blue-stripe" title="Lihat Berkas" onclick="javascript:popWin('${site_url}${obj.dir_file}')"><span class="glyphicon glyphicon-file"></span>Lihat</a>`;
                            tableUmum += `<td style="text-align:center;">${berkas}</td></tr>`;
                        });
                        $('.data-umum').html(tableUmum);
                        var tableArsitektur;
                        let numArsitektur = 1;
                        response.syarat_arsitektur.forEach(obj => {
                            let status = obj.kesesuaian == 1 ? '<span class="badge badge-success"> Sesuai <i class="fa fa-check"></i></span>' : '<span class="badge badge-danger"> Tidak <i class="fa fa-times"></i></span>';
                            tableArsitektur += '<tr>';
                            tableArsitektur += `<td style="text-align:center;">${numArsitektur++}</td>`;
                            tableArsitektur += `<td>${obj.nm_dokumen}</td>`;
                            tableArsitektur += `<td>${obj.catatan}</td>`;
                            let berkas = obj.dir_file == false ? 'Tidak ada dokumen' : `<a href="javascript:void(0);" class="btn default btn-xs blue-stripe" title="Lihat Berkas" onclick="javascript:popWin('${site_url}${obj.dir_file}')"><span class="glyphicon glyphicon-file"></span>Lihat</a>`;
                            tableArsitektur += `<td style="text-align:center;">${berkas}</td>`;
                            tableArsitektur += `<td>${status}</td></tr>`;
                        });
                        $('.data-arsitektur').html(tableArsitektur);
                        var tableStruktur;
                        let numStruktur = 1;
                        response.syarat_struktur.forEach(obj => {
                            let status = obj.kesesuaian == 1 ? '<span class="badge badge-success"> Sesuai <i class="fa fa-check"></i></span>' : '<span class="badge badge-danger"> Tidak <i class="fa fa-times"></i></span>';
                            tableStruktur += '<tr>';
                            tableStruktur += `<td style="text-align:center;">${numStruktur++}</td>`;
                            tableStruktur += `<td>${obj.nm_dokumen}</td>`;
                            tableStruktur += `<td>${obj.catatan}</td>`;
                            let berkas = obj.dir_file == false ? 'Tidak ada dokumen' : `<a href="javascript:void(0);" class="btn default btn-xs blue-stripe" title="Lihat Berkas" onclick="javascript:popWin('${site_url}${obj.dir_file}')"><span class="glyphicon glyphicon-file"></span>Lihat</a>`;
                            tableStruktur += `<td style="text-align:center;">${berkas}</td>`;
                            tableStruktur += `<td>${status}</td></tr>`;
                        });
                        $('.data-struktur').html(tableStruktur);
                        var tableMep;
                        let numMep = 1;
                        response.syarat_mep.forEach(obj => {
                            let status = obj.kesesuaian == 1 ? '<span class="badge badge-success"> Sesuai <i class="fa fa-check"></i></span>' : '<span class="badge badge-danger"> Tidak <i class="fa fa-times"></i></span>';
                            tableMep += '<tr>';
                            tableMep += `<td style="text-align:center;">${numMep++}</td>`;
                            tableMep += `<td>${obj.nm_dokumen}</td>`;
                            tableMep += `<td>${obj.catatan}</td>`;
                            let berkas = obj.dir_file == false ? 'Tidak ada dokumen' : `<a href="javascript:void(0);" class="btn default btn-xs blue-stripe" title="Lihat Berkas" onclick="javascript:popWin('${site_url}${obj.dir_file}')"><span class="glyphicon glyphicon-file"></span>Lihat</a>`;
                            tableMep += `<td style="text-align:center;">${berkas}</td>`;
                            tableMep += `<td>${status}</td></tr>`;
                        });
                        $('.data-mep').html(tableMep);
                        $('#modalDetail').modal('show');
                    } else {
                        showToast(response.message, 15000, response.type);
                        Metronic.unblockUI();
                    }
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