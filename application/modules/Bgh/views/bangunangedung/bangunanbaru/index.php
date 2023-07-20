<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Bangunan Baru
                </h2>
            </div>
        </div>
    </div>
</div>
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <?php if ($this->session->userdata('loc_role_id') == 10) { ?>
                            <a href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/permohonan" class="btn btn-teal btn-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-rounded-plus-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M12 2l.324 .001l.318 .004l.616 .017l.299 .013l.579 .034l.553 .046c4.785 .464 6.732 2.411 7.196 7.196l.046 .553l.034 .579c.005 .098 .01 .198 .013 .299l.017 .616l.005 .642l-.005 .642l-.017 .616l-.013 .299l-.034 .579l-.046 .553c-.464 4.785 -2.411 6.732 -7.196 7.196l-.553 .046l-.579 .034c-.098 .005 -.198 .01 -.299 .013l-.616 .017l-.642 .005l-.642 -.005l-.616 -.017l-.299 -.013l-.579 -.034l-.553 -.046c-4.785 -.464 -6.732 -2.411 -7.196 -7.196l-.046 -.553l-.034 -.579a28.058 28.058 0 0 1 -.013 -.299l-.017 -.616c-.003 -.21 -.005 -.424 -.005 -.642l.001 -.324l.004 -.318l.017 -.616l.013 -.299l.034 -.579l.046 -.553c.464 -4.785 2.411 -6.732 7.196 -7.196l.553 -.046l.579 -.034c.098 -.005 .198 -.01 .299 -.013l.616 -.017c.21 -.003 .424 -.005 .642 -.005zm0 6a1 1 0 0 0 -1 1v2h-2l-.117 .007a1 1 0 0 0 .117 1.993h2v2l.007 .117a1 1 0 0 0 1.993 -.117v-2h2l.117 -.007a1 1 0 0 0 -.117 -1.993h-2v-2l-.007 -.117a1 1 0 0 0 -.993 -.883z" fill="currentColor" stroke-width="0"></path>
                                </svg>
                                Ajukan Permohonan
                            </a>
                        <?php } ?>
                    </div>
                    <div class="card-body">
                        <!-- <div class="table-responsive"> -->
                        <table class="table card-table table-vcenter text-nowrap datatable" id="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>No Permohonan</th>
                                    <th>Nama Gedung</th>
                                    <th>Info</th>
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        <!-- </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="modalpenugasan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="" class="form-control-label">Tanggal Mulai Assesmen</label>
                        <input type="date" class="form-control" id="tanggal_mulai" value="<?= date('Y-m-d') ?>" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-control-label">Tanggal Selesai Assesmen</label>
                        <input type="date" class="form-control" id="tanggal_selesai" required>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="table-tpa">
                        <thead>
                            <th></th>
                            <th>Nama</th>
                            <th>Alamat</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Cancel</button>
                <input type="text" id="id_permohonan" hidden>
                <button type="button" id="subm" class="btn btn-success">Simpan
                    <div class="spinner-border spinner-border-sm text-white d-none ms-3" id="loaderupload" role="status"></div>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="modal-jadwalsidang" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" id="modal-size" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="" class="form-control-label">Tanggal Jadwal Sidang</label>
                        <input type="date" class="form-control" id="tanggal_sidang" required>
                    </div>

                    <div class="col-md-12" id="body-sidangtpa">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Cancel</button>
                <input type="text" id="id_permohonan_jadwal" hidden>
                <input type="text" id="statustpa" hidden>
                <button type="button" id="submit-jadwal" class="btn btn-success">Simpan
                    <div class="spinner-border spinner-border-sm text-white d-none ms-3" id="loaderupload" role="status"></div>
                </button>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url() ?>assets/bgh/dist/libs/jQuery-3.6.0/jquery-3.6.0.min.js"></script>
<script src="<?= base_url() ?>assets/bgh/dist/libs/DataTables-1.13.4/js/datatables.min.js"></script>
<script>
    let role = "<?= $role ?>";
    $(() => {
        $('#menu-bangunan').addClass('active');
        $('#table').DataTable();

        loaddata();

        $(document).on('click', '.penugasantpa', function() {
            var id_permohonan = $(this).data('permohonan');
            var provinsi = $(this).data('provinsi');
            var kabkota = $(this).data('kabkota');
            penugasantpa(id_permohonan, provinsi, kabkota);
        })

        $(document).on('click', '.batalkan', function() {
            var id_permohonan = $(this).data('permohonan');
            var poin_diajukan = $(this).data('poindiajukan');
            var status = 0;
            batalkan(id_permohonan, status, poin_diajukan);
        })

        $(document).on('click', '.ajukansidang', function() {
            var id_permohonan = $(this).data('permohonan');
            var poin_diajukan = $(this).data('poindiajukan');
            var status = 43;
            ajukansidang(id_permohonan, status, poin_diajukan);
        })

        $(document).on('click', '.jadwalsidang', function() {
            var id_permohonan = $(this).data('permohonan');
            var tpa = $(this).data('tpa');
            var id_provinsi = $(this).data('provinsi');
            var id_kabkota = $(this).data('kabkota');
            $('#id_permohonan_jadwal').val(id_permohonan);
            var contentTpa = "";
            if (tpa == "0") {
                $('#modal-size').addClass('modal-lg');
                contentTpa += `
                <div class="table-responsive mt-3">
                    <table class="table table-bordered" id="table-sidangtpa">
                        <thead>
                            <th></th>
                            <th>Nama</th>
                            <th>Alamat</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                `;
                $('#statustpa').val(0);
            } else {
                $('#modal-size').addClass('modal-sm');
                $('#statustpa').val(1);
            }

            $('#body-sidangtpa').html(contentTpa);

            var myModal = new bootstrap.Modal(document.getElementById('modal-jadwalsidang'), {
                keyboard: false,
                backdrop: false
            })
            myModal.show();

            gettpasidang(id_provinsi, id_kabkota);
        })

        $(document).on('click', '.cek-kelengkapan', function() {
            if (confirm('Cek Kelengkapan Data Pada Permohonan ini ? ')) {
                let urlredirect = $(this).data('url');
                let form = new FormData();

                form.append('id_permohonan', $(this).data('idpermohonan'));
                form.append('status', 31);

                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    data: form,
                    processData: false,
                    contentType: false,
                    url: '<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/updateverifikasidata',
                    success: function(response) {
                        if (response.code === 1) {
                            window.location.href = urlredirect;
                            // console.log('berhgasi0');
                        } else {
                            alert('gagal');
                        }
                    }
                })
            }
        })

        $('#subm').click(function() {
            var pilihantpa = [];

            if ($('input[type="checkbox"]:checked').length > 0) {
                $('input[type="checkbox"]:checked').each(function() {
                    pilihantpa.push($(this).val());
                })

                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    data: {
                        pilihantpa: pilihantpa,
                        id_permohonan: $('#id_permohonan').val(),
                        tanggal_mulai: $('#tanggal_mulai').val(),
                        tanggal_selesai: $('#tanggal_selesai').val()
                    },
                    url: '<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/penugasantpa',
                    success: function(response) {
                        alert('Berhasil');
                        location.reload();
                    }

                })
            } else {
                alert('Tidak Ada Yang Dipilih');
            }

        })

        $('#submit-jadwal').click(function() {
            var pilihantpa = [];

            if ($('#statustpa').val() == "1") {
                if ($('#tanggal_sidang').val() != "") {
                    let formdata = new FormData();

                    $.ajax({
                        type: 'post',
                        dataType: 'json',
                        data: {
                            pilihantpa: "0",
                            id_permohonan: $('#id_permohonan_jadwal').val(),
                            tanggal_sidang: $('#tanggal_sidang').val(),
                            status: 5
                        },
                        url: '<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/updatejadwalsidang',
                        success: function(response) {
                            if (response.code === 1) {
                                alert('Berhasil !');
                                location.reload();
                            }
                        }
                    })
                } else {
                    alert('Jadwal Belum Diisi');
                }
            } else {
                if ($('input[type="checkbox"]:checked').length > 0) {
                    $('input[type="checkbox"]:checked').each(function() {
                        pilihantpa.push($(this).val());
                    })
                    if ($('#tanggal_sidang').val() != "") {

                        $.ajax({
                            type: 'post',
                            dataType: 'json',
                            data: {
                                pilihantpa: pilihantpa,
                                id_permohonan: $('#id_permohonan_jadwal').val(),
                                tanggal_sidang: $('#tanggal_sidang').val(),
                                status: 5
                            },
                            url: '<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/updatejadwalsidang',
                            success: function(response) {
                                if (response.code === 1) {
                                    alert('Berhasil !');
                                    location.reload();
                                }
                            }
                        })
                    } else {
                        alert('Jadwal Belum Diisi');
                    }
                } else {
                    alert('TPA Belum Dipilih');
                }
            }

        })

        function batalkan(id_permohonan, status, poin_diajukan) {
            if (confirm('Batalkan Permohonan Ini ?')) {
                let fd = new FormData();
                fd.append('id_permohonan', id_permohonan);
                fd.append('status', status);
                fd.append('poinhead', poin_diajukan);

                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    data: fd,
                    processData: false,
                    contentType: false,
                    url: '<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/updatestatuspermohonan',
                    success: function(response) {
                        if (response.code === 1) {
                            alert('Berhasil!');
                            window.location.href = '<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/';
                        }
                    }
                })
            }
        }

        function ajukansidang(id_permohonan, status, poin_diajukan) {
            if (confirm('Ajukan Sidang Untuk Permohonan Ini ?')) {
                let fd = new FormData();
                fd.append('id_permohonan', id_permohonan);
                fd.append('status', status);
                fd.append('poinhead', poin_diajukan);

                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    data: fd,
                    processData: false,
                    contentType: false,
                    url: '<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/updatestatuspermohonan',
                    success: function(response) {
                        if (response.code === 1) {
                            alert('Berhasil!');
                            window.location.href = '<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/';
                        }
                    }
                })
            }
        }

        function penugasantpa(id_permohonan, id_provinsi, id_kabkota) {
            var myModal = new bootstrap.Modal(document.getElementById('modalpenugasan'), {
                keyboard: false,
                backdrop: false
            })
            myModal.show();
            $('#id_permohonan').val(id_permohonan);
            gettpa(id_provinsi, id_kabkota);
        }

        function gettpa(id_provinsi, id_kabkota) {
            $.ajax({
                type: "post",
                dataType: "json",
                url: "<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/gettpa",
                data: {
                    id_provinsi: id_provinsi,
                    id_kabkota: id_kabkota
                },
                success: function(result) {
                    let data = result.data;
                    var dt = $("#table-tpa").DataTable({
                        destroy: true,
                        paging: true,
                        lengthChange: false,
                        searching: true,
                        ordering: true,
                        info: true,
                        autoWidth: false,
                        responsive: false,
                        pageLength: 10,
                        aaData: data,
                        aoColumns: [{
                                mDataProp: "id",
                                width: "10px",
                            },
                            {
                                mDataProp: "nm_tpa",
                            },
                            {
                                mDataProp: "alamat",
                            },
                        ],
                        order: [
                            [0, "ASC"]
                        ],
                        fixedColumns: true,
                        aoColumnDefs: [{
                                mRender: function(data, type, row) {

                                    var el = `
                                        <input type="checkbox" value="${row.id_user}">
                                    `;

                                    return el;
                                },
                                aTargets: [0],
                            },
                            {
                                mRender: function(data, type, row) {

                                    var el = `
                                        ${row.glr_depan} ${row.nm_tpa} ${row.glr_blkg}
                                    `;

                                    return el;
                                },
                                aTargets: [1],
                            },
                        ],
                        fnRowCallback: function(
                            nRow,
                            aData,
                            iDisplayIndex,
                            iDisplayIndexFull
                        ) {
                            // var index = iDisplayIndexFull + 1;
                            // $("td:eq(0)", nRow).html("#" + index);
                            // return index;
                        },
                        fnInitComplete: function() {
                            var that = this;
                            var td;
                            var tr;
                            this.$("td").click(function() {
                                td = this;
                            });
                            this.$("tr").click(function() {
                                tr = this;
                            });
                        },
                    });
                },
            });
        }

        function gettpasidang(id_provinsi, id_kabkota) {
            $.ajax({
                type: "post",
                dataType: "json",
                url: "<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/gettpa",
                data: {
                    id_provinsi: id_provinsi,
                    id_kabkota: id_kabkota
                },
                success: function(result) {
                    let data = result.data;
                    var dt = $("#table-sidangtpa").DataTable({
                        destroy: true,
                        paging: true,
                        lengthChange: false,
                        searching: true,
                        ordering: true,
                        info: true,
                        autoWidth: false,
                        responsive: false,
                        pageLength: 10,
                        aaData: data,
                        aoColumns: [{
                                mDataProp: "id",
                                width: "10px",
                            },
                            {
                                mDataProp: "nm_tpa",
                            },
                            {
                                mDataProp: "alamat",
                            },
                        ],
                        order: [
                            [0, "ASC"]
                        ],
                        fixedColumns: true,
                        aoColumnDefs: [{
                                mRender: function(data, type, row) {

                                    var el = `
                                        <input type="checkbox" value="${row.id_user}">
                                    `;

                                    return el;
                                },
                                aTargets: [0],
                            },
                            {
                                mRender: function(data, type, row) {

                                    var el = `
                                        ${row.glr_depan} ${row.nm_tpa} ${row.glr_blkg}
                                    `;

                                    return el;
                                },
                                aTargets: [1],
                            },
                        ],
                        fnRowCallback: function(
                            nRow,
                            aData,
                            iDisplayIndex,
                            iDisplayIndexFull
                        ) {
                            // var index = iDisplayIndexFull + 1;
                            // $("td:eq(0)", nRow).html("#" + index);
                            // return index;
                        },
                        fnInitComplete: function() {
                            var that = this;
                            var td;
                            var tr;
                            this.$("td").click(function() {
                                td = this;
                            });
                            this.$("tr").click(function() {
                                tr = this;
                            });
                        },
                    });
                },
            });
        }
    })

    function loaddata() {
        var tabel = $("#table").DataTable({
            destroy: true,
            searching: false,
            processing: true,
            responsive: true,
            serverSide: true,
            bInfo: true,
            ordering: true, // Set true agar bisa di sorting
            order: [
                [0, "asc"]
            ], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
            paging: true,
            pageLength: 10,
            ajax: {
                url: "<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/loadbangunanbaru", // URL file untuk proses select datanya
                type: "POST",
                data: {
                    param: "data_berita",
                },
            },
            deferRender: true,
            lengthMenu: [
                [5, 10],
                [5, 10],
            ],
            columns: [{
                    data: "id"
                },
                {
                    data: "kode_bgh"
                },
                {
                    data: "nama_gedung"
                },
                {
                    data: "status",
                    render: function(data, type, row, meta) {
                        var $rowData = "";
                        var $stat = '';
                        var $asses = '';
                        var mulaiasses = '';
                        var selesaiasses = '';
                        var tanggalsidang = '';

                        if (row.tanggal_mulai === null) {
                            mulaiasses += 'Belum Tersedia';
                        } else {
                            mulaiasses = row.tanggal_mulai;
                        }

                        if (row.tanggal_selesai === null) {
                            selesaiasses += 'Belum Tersedia';
                        } else {
                            selesaiasses = row.tanggal_selesai;
                        }

                        if (row.tanggal_sidang === null) {
                            tanggalsidang = 'Menunggu Jadwal Sidang';
                        } else {
                            tanggalsidang = row.tanggal_sidang;
                        }

                        if (row.nomor_status == "0") {
                            $stat += `<span class="badge bg-danger">${row.nama_status}</span>`;
                        } else if (row.nomor_status == "1") {
                            $stat += `<span class="badge bg-danger">${row.nama_status}</span>`;
                        } else if (row.nomor_status == "2") {
                            $stat += `<span class="badge bg-azure">${row.nama_status}</span>`;
                        } else if (row.nomor_status == "3") {
                            $stat += `<span class="badge bg-cyan">${row.nama_status}</span>`;
                        } else if (row.nomor_status == "31") {
                            $stat += `<span class="badge bg-cyan">${row.nama_status}</span>`;
                            $asses += `
                                <p>
                                    Tanggal Mulai Verifikasi : ${row.tanggal_mulai_verifikasi}
                                </p>
                                <p> 
                                    Estimasi Selesai Verifikasi : ${row.tanggal_selesai_verifikasi}
                                </p>
                            `;
                        } else if (row.nomor_status == "32") {
                            $stat += `<span class="badge bg-cyan">${row.nama_status}</span>`;
                        } else if (row.nomor_status == "33") {
                            $stat += `<span class="badge bg-cyan">${row.nama_status}</span>`;
                        } else if (row.nomor_status == "4") {
                            $stat += `<span class="badge bg-blue">${row.nama_status}</span>`;
                            $asses += `
                                <p>
                                    Tanggal Mulai : ${mulaiasses}
                                </p>
                                <p> 
                                    Estimasi Selesai : ${selesaiasses}
                                </p>
                            `;
                        } else if (row.nomor_status == "41") {
                            $stat += `<span class="badge bg-orange">${row.nama_status}</span>`;
                            $asses += `
                                <p>
                                    Tanggal Mulai Konsultasi/Assesment : <strong>${mulaiasses}</strong>
                                </p>
                                <p> 
                                    Estimasi Selesai Konsultasi/Assesment : <strong>${selesaiasses}</strong>
                                </p>
                            `;
                        } else if (row.nomor_status == "42") {
                            $stat += `<span class="badge bg-blue text-wrap">${row.nama_status}</span>`;
                        } else if (row.nomor_status == "43") {
                            $stat += `<span class="badge bg-blue">${row.nama_status}</span>`;
                            $asses += `
                                <p>
                                    Tanggal Sidang : <strong>${tanggalsidang}</strong>
                                </p>
                            `;
                        } else if (row.nomor_status == "5") {
                            $stat += `<span class="badge bg-azure">${row.nama_status}</span>`;
                            $asses += `
                                <p>
                                    Tanggal Sidang : <strong>${tanggalsidang}</strong>
                                </p>
                            `;
                        } else if (row.nomor_status == "6") {
                            $stat += `<span class="badge bg-azure">${row.nama_status}</span>`;
                        }

                        $rowData +=
                            `<div class="card">
                                    <div class="card-body">
                                        <p>
                                            ${$stat}
                                        </p>
                                        ${$asses}
                                    </div>
                            </div>`;
                        return $rowData;
                    }
                },
                {
                    data: "id",
                    render: function(data, type, row, meta) {
                        var $rowData = "";
                        let continuechecklist = "";
                        let databangunanpemilik = "";
                        let batalkan = "";
                        let sidang = "";
                        let penugasantpa = "";
                        let menu = "";

                        if (role == "10") {
                            if (row.status == "1") {
                                banding += `<a class="dropdown-item" href="javascript:;">
                                    Ajukan Banding
                                </a>`;
                                menu += `${banding}`;
                            } else if (row.status == "2") {
                                continuechecklist = `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/penilaian/${row.kode_bgh}">
                                    Lanjutkan Pengisian Daftar Simak
                                </a>`;
                                databangunanpemilik += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/permohonan/${row.kode_bgh}">
                                    Edit Data Bangunan, Pemilik dan Penyedia Jasa
                                </a>`;
                                batalkan += `<a class="dropdown-item batalkan" data-permohonan="${row.id_permohonan}" data-poindiajukan="${row.poin_diajukan}" href="javascript:void(0)">
                                    Batalkan Permohonan
                                </a>`;

                                menu += `${databangunanpemilik} ${continuechecklist} ${batalkan}`;
                            } else if (row.status == "3") {
                                databangunanpemilik += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/permohonan/${row.kode_bgh}">
                                    Lihat Data Bangunan, Pemilik dan Penyedia Jasa
                                </a>`;
                                continuechecklist += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/detailform/${row.kode_bgh}">
                                Detail Hasil Pengisian Daftar Simak
                                </a>`;

                                menu += `${databangunanpemilik} ${continuechecklist}`;
                            } else if (row.status == "32") {
                                databangunanpemilik += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/permohonan/${row.kode_bgh}">
                                    Lihat Data Bangunan, Pemilik dan Penyedia Jasa
                                </a>`;
                                continuechecklist += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/penilaian/${row.kode_bgh}">
                                Revisi Pengisian Daftar Simak
                                </a>`;

                                menu += `${databangunanpemilik} ${continuechecklist}`;
                            } else if (row.status == "33") {
                                databangunanpemilik += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/permohonan/${row.kode_bgh}">
                                    Lihat Data Bangunan, Pemilik dan Penyedia Jasa
                                </a>`;
                                continuechecklist += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/detailform/${row.kode_bgh}">
                                Detail Hasil Pengisian Daftar Simak
                                </a>`;

                                menu += `${databangunanpemilik} ${continuechecklist}`;
                            } else if (row.status == "4") {
                                databangunanpemilik += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/permohonan/${row.kode_bgh}">
                                    Lihat Data Bangunan, Pemilik dan Penyedia Jasa
                                </a>`;
                                continuechecklist += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/detailform/${row.kode_bgh}">
                                Detail Hasil Pengisian Daftar Simak
                                </a>`;

                                menu += `${databangunanpemilik} ${continuechecklist}`;
                            } else if (row.status == "41") {
                                databangunanpemilik += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/permohonan/${row.kode_bgh}">
                                    Lihat Data Bangunan, Pemilik dan Penyedia Jasa
                                </a>`;
                                continuechecklist += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/penilaian/${row.kode_bgh}">
                                Revisi Daftar Simak
                                </a>`;

                                menu += `${databangunanpemilik} ${continuechecklist}`;
                            } else if (row.status == "42") {
                                databangunanpemilik += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/permohonan/${row.kode_bgh}">
                                    Lihat Data Bangunan, Pemilik dan Penyedia Jasa
                                </a>`;
                                continuechecklist += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/hasil/${row.kode_bgh}">
                                Lihat Hasil Assesmen
                                </a>`;
                                sidang += `<a class="dropdown-item ajukansidang" data-permohonan="${row.id_permohonan}" data-poindiajukan="${row.poin_diajukan}" href="javascript:void(0)">
                                Ajukan Sidang
                                </a>`;

                                menu += `${databangunanpemilik} ${continuechecklist} ${sidang}`;
                            } else if (row.status == "43") {
                                databangunanpemilik += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/permohonan/${row.kode_bgh}">
                                    Lihat Data Bangunan, Pemilik dan Penyedia Jasa
                                </a>`;
                                continuechecklist += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/hasil/${row.kode_bgh}">
                                Lihat Hasil Assesmen
                                </a>`;

                                menu += `${databangunanpemilik} ${continuechecklist}`;
                            }
                        } else if (role == "11") {
                            if (row.status == "3") {
                                databangunanpemilik += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/permohonan/${row.kode_bgh}">
                                Lihat Data Bangunan, Pemilik dan Penyedia Jasa
                                </a>`;
                                continuechecklist += `<a class="dropdown-item cek-kelengkapan" href="javascript:;" data-url="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/kelengkapan/${row.kode_bgh}" data-idpermohonan="${row.id_permohonan}" data-poindiajukan="${row.poin_diajukan}">
                                Cek Kelengkapan Data Daftar Simak
                                </a>`;

                                menu += `${databangunanpemilik} ${continuechecklist}`;
                            } else if (row.status == "31") {
                                databangunanpemilik += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/permohonan/${row.kode_bgh}">
                                Lihat Data Bangunan, Pemilik dan Penyedia Jasa
                                </a>`;
                                continuechecklist += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/kelengkapan/${row.kode_bgh}">
                                Lanjutkan Cek Kelengkapan Data Daftar Simak
                                </a>`;

                                menu += `${databangunanpemilik} ${continuechecklist}`;
                            } else if (row.status == "32" || row.status == "33") {
                                databangunanpemilik += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/permohonan/${row.kode_bgh}">
                                Lihat Data Bangunan, Pemilik dan Penyedia Jasa
                                </a>`;
                                continuechecklist += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/kelengkapan/${row.kode_bgh}">
                                Detail Hasil Verifikasi Kelengkapan Data Daftar Simak
                                </a>`;

                                menu += `${databangunanpemilik} ${continuechecklist}`;
                            } else if (row.status == "4") {
                                databangunanpemilik += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/permohonan/${row.kode_bgh}">
                                Lihat Data Bangunan, Pemilik dan Penyedia Jasa
                                </a>`;
                                continuechecklist += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/kelengkapan/${row.kode_bgh}">
                                Detail Hasil Verifikasi Kelengkapan Data Daftar Simak
                                </a>`;
                                if (row.id_tpa === "0") {
                                    penugasantpa = `<a class="dropdown-item penugasantpa" data-permohonan="${row.id_permohonan}" data-provinsi="${row.id_provinsi}" data-kabkota="${row.id_kabkota}" href="javascript:void(0)">Penugasan TPA</a>`;
                                } else {
                                    penugasantpa = '';
                                }

                                menu += `${databangunanpemilik} ${continuechecklist} ${penugasantpa}`;
                            } else if (row.status == "43") {
                                databangunanpemilik += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/permohonan/${row.kode_bgh}">
                                Lihat Data Bangunan, Pemilik dan Penyedia Jasa
                                </a>`;
                                continuechecklist += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/hasil/${row.kode_bgh}">
                                Lihat Hasil Assesmen
                                </a>`;
                                sidang += `<a class="dropdown-item jadwalsidang" data-permohonan="${row.id_permohonan}" data-tpa="${row.id_tpa}" data-provinsi="${row.id_provinsi}" data-kabkota="${row.id_kabkota}" href="javascript:void(0)">
                                Tentukan Jadwal Sidang
                                </a>`;


                                menu += `${databangunanpemilik} ${continuechecklist} ${sidang}`;
                            }
                        } else if (role == "17") {
                            if (row.status == "4") {
                                databangunanpemilik += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/permohonan/${row.kode_bgh}">
                                Lihat Data Bangunan, Pemilik dan Penyedia Jasa
                                </a>`;
                                continuechecklist += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/assesment/${row.kode_bgh}">
                                     Assesment Permohonan
                                </a>`;

                                menu += `${databangunanpemilik} ${continuechecklist}`;
                            } else if (row.status == "42") {
                                databangunanpemilik += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/permohonan/${row.kode_bgh}">
                                    Lihat Data Bangunan, Pemilik dan Penyedia Jasa
                                </a>`;
                                continuechecklist += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/hasil/${row.kode_bgh}">
                                Lihat Hasil Assesmen
                                </a>`;

                                menu += `${databangunanpemilik} ${continuechecklist}`;
                            } else if (row.status == "43") {
                                databangunanpemilik += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/permohonan/${row.kode_bgh}">
                                    Lihat Data Bangunan, Pemilik dan Penyedia Jasa
                                </a>`;
                                continuechecklist += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/hasil/${row.kode_bgh}">
                                Lihat Hasil Assesmen
                                </a>`;

                                menu += `${databangunanpemilik} ${continuechecklist}`;
                            } else if (row.status == "5") {
                                databangunanpemilik += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/permohonan/${row.kode_bgh}">
                                    Lihat Data Bangunan, Pemilik dan Penyedia Jasa
                                </a>`;
                                continuechecklist += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/hasil/${row.kode_bgh}">
                                Lihat Hasil Assesmen
                                </a>`;

                                menu += `${databangunanpemilik} ${continuechecklist}`;
                            }
                        }

                        // if (role == "10") {
                        //     let downloadsertifikat = '';
                        //     if (row.status == 0) {
                        //         databangunanpemilik += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/permohonan/${row.kode_bgh}">
                        //             Edit Data Bangunan & Pemilik
                        //         </a>`;
                        //         continuechecklist += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/penilaian/${row.kode_bgh}">
                        //         Lanjutkan Pengisian Checklist
                        //         </a>`;
                        //     } else if (row.status == 1) {
                        //         databangunanpemilik += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/permohonan/${row.kode_bgh}">
                        //             Lihat Data Bangunan & Pemilik
                        //         </a>`;
                        //         continuechecklist += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/detailform/${row.kode_bgh}">
                        //         Detail Hasil Pengisian Daftar Simak
                        //         </a>`;
                        //     } else if (row.status == 2) {
                        //         databangunanpemilik += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/permohonan/${row.kode_bgh}">
                        //             Lihat Data Bangunan & Pemilik
                        //         </a>`;
                        //         continuechecklist += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/penilaian/${row.kode_bgh}">
                        //         Revisi Pengisian Checklist
                        //         </a>`;
                        //     } else if (row.status == 3) {
                        //         databangunanpemilik += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/permohonan/${row.kode_bgh}">
                        //             Lihat Data Bangunan & Pemilik
                        //         </a>`;
                        //         continuechecklist += ``;
                        //     } else if (row.status == 4) {
                        //         databangunanpemilik += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/permohonan/${row.kode_bgh}">
                        //             Lihat Data Bangunan & Pemilik
                        //         </a>`;
                        //         continuechecklist += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/hasil/${row.kode_bgh}">
                        //         Lihat Hasil Assesmen
                        //         </a>`;
                        //         downloadsertifikat += `<a class="dropdown-item" href="javascript:;">
                        //         Download Sertifikat
                        //         </a>`;
                        //     }

                        //     menu = `${continuechecklist}${databangunanpemilik}${downloadsertifikat}`;
                        // } else if (role == "11") {
                        //     if (row.status == 1) {
                        //         continuechecklist += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/assesment/${row.kode_bgh}">
                        //             Assesment Permohonan
                        //         </a>`;
                        //         databangunanpemilik += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/permohonan/${row.kode_bgh}">
                        //             Lihat Data Bangunan & Pemilik
                        //         </a>`;
                        //         if (row.id_tpa == "0") {
                        //             penugasantpa = `<a class="dropdown-item penugasantpa" data-permohonan="${row.id_permohonan}" data-provinsi="${row.id_provinsi}" data-kabkota="${row.id_kabkota}" href="javascript:void(0)">
                        //                 Penugasan TPA
                        //             </a>`;
                        //         } else {
                        //             penugasantpa = '';
                        //         }

                        //     } else if (row.status == 3) {
                        //         continuechecklist += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/hasil/${row.kode_bgh}">
                        //             Verifikasi Assesment Permohonan
                        //         </a>`;
                        //         databangunanpemilik += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/permohonan/${row.kode_bgh}">
                        //             Lihat Data Bangunan & Pemilik
                        //         </a>`;
                        //         penugasantpa = '';
                        //     } else if (row.status == 4 || row.status == 2) {
                        //         continuechecklist += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/hasil/${row.kode_bgh}">
                        //         Lihat Hasil Assesmen
                        //         </a>`;
                        //         databangunanpemilik += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/permohonan/${row.kode_bgh}">
                        //             Lihat Data Bangunan & Pemilik
                        //         </a>`;
                        //         penugasantpa = '';
                        //     }
                        //     menu = `${continuechecklist}${databangunanpemilik}${penugasantpa}`;
                        // } else if (role == "17") {
                        //     if (row.status == 3 || row.status == 2 || row.status == 4) {
                        //         continuechecklist += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/hasil/${row.kode_bgh}">
                        //         Lihat Hasil Assesmen
                        //         </a>`;
                        //         databangunanpemilik += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/permohonan/${row.kode_bgh}">
                        //             Lihat Data Bangunan & Pemilik
                        //         </a>`;
                        //     } else if (row.status == 1) {
                        //         continuechecklist += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/assesment/${row.kode_bgh}">
                        //             Assesment Permohonan
                        //         </a>`;
                        //         databangunanpemilik += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/permohonan/${row.kode_bgh}">
                        //             Lihat Data Bangunan & Pemilik
                        //         </a>`;
                        //     }

                        //     menu = `${continuechecklist}${databangunanpemilik}`;
                        // }
                        // if (row.status < 3) {
                        // $continuechecklist +=`<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/penilaian/${row.kode_bgh}">
                        //     Lanjutkan Pengisian Checklist
                        // </a>`;

                        // continuechecklist +=`<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/assesment/${row.kode_bgh}">
                        //     Assesment Permohonan
                        // </a>`;
                        // databangunanpemilik ++ `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/permohonan/${row.kode_bgh}">
                        //             Edit Data Bangunan & Pemilik
                        //         </a>`;
                        // databangunanpemilik += `<a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/permohonan/${row.kode_bgh}">
                        //     Lihat Data Bangunan & Pemilik
                        // </a>`;
                        // }else if(row.status )
                        $rowData +=
                            `<div class="dropdown">
                                <button class="btn btn-facebook w-100 btn-icon dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-label="Facebook">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                                    </svg>
                                </button>
                                <div class="dropdown-menu dropdown-menu-demo" style="z-index:9" aria-labelledby="dropdownMenuButton1">
                                    ${menu}
                                </div>
                            </div>`;

                        return $rowData
                    }
                },
                // {
                //     data: "id",
                //     render: function (data, type, row, meta) {
                //         var $rowData = '<div class="row">';
                //         var col = 12;
                //         if (typeof row.files != "undefined") {
                //             if (row.files.length == 2) {
                //                 col = 6;
                //             } else if (row.files.length > 2) {
                //                 col = 4;
                //             }
                //             for (var key in row.files) {
                //                 $rowData +=
                //                     `
                //                     <div class="col-sm-` +
                //                     col +
                //                     `">
                //                     <div class="card">
                //                         <img id="" name="" class="img-fluid" src="` +
                //                     row.files[key].path +
                //                     "/" +
                //                     row.files[key].filename +
                //                     `" alt="">
                //                     </div>
                //                     </div>
                //                     `;
                //             }
                //         } else {
                //             if (row.image != null) {
                //                 let text = row.image;
                //                 var myArray = text.split(",");
                //                 row.files = myArray;

                //                 for (var key in row.files) {
                //                     var img = $('<img src="' + row.files[key] + '" />');

                //                     img.on("load", function (e) {}).on("error", function (e) {});

                //                     $rowData +=
                //                         `
                //                     <div class="col-sm-` +
                //                         col +
                //                         `">
                //                         <div class="card">
                //                         <img id="" name="" class="img-fluid" src="` +
                //                         row.files[key] +
                //                         `" alt="">
                //                         </div>
                //                     </div>
                //                         `;
                //                 }
                //             }
                //         }

                //         $rowData += "</div>";

                //         return $rowData;
                //     }, width: "10" 
                // },
                // { data: "judul", width: "200" },
                // {
                //     data: "date",
                //     render: function (data, type, row, meta) {
                //         var mydate = new Date(row.date);
                //         var date = ("0" + mydate.getDate()).slice(-2);
                //         var month = ("0" + (mydate.getMonth() + 1)).slice(-2);
                //         var year = mydate.getFullYear();
                //         var str = date + "/" + month + "/" + year;

                //         var stat = row.status;
                //         if (stat == 1) {
                //             var st = "Publish";
                //             var tex = "text-success";
                //         } else {
                //             var st = "No Publish";
                //             var tex = "text-danger";
                //         }
                //         var $rowData = "";
                //         $rowData +=
                //             `<div class="card">
                //                     <div class="card-body">
                //                     <div class="d-flex justify-content-between">
                //                         <p class="text-success text-sm">
                //                         <i class="far fa-user"></i>
                //                         </p>
                //                         <p class="d-flex flex-column">
                //                             <span class="text-muted" style="font-size:12px;">${
                //                                 row.nama_satker ? row.nama_satker : row.username
                //                             }</span>
                //                         </p>
                //                     </div>
                //                     <div class="d-flex justify-content-between">
                //                         <p class="text-primary text-sm">
                //                         <i class="far fa-calendar-alt"></i>
                //                         </p>
                //                         <p class="d-flex flex-column">
                //                         <span class="text-muted"> ` +
                //             str +
                //             `</span>
                //                         </p>
                //                     </div>
                //                     <div class="d-flex justify-content-between">
                //                         <p class="` +
                //             tex +
                //             ` text-sm">
                //                         <i class="fas fa-sign-in-alt"></i>
                //                         </p>
                //                         <p class="d-flex flex-column ">
                //                         <span class="text-muted">` +
                //             st +
                //             `</span>
                //                         </p>
                //                     </div>
                //                     </div>
                //                 </div>`;

                //         return $rowData;
                //     },width: "300" 
                // },
                // {
                //     data: "bagian", 
                //     render: function (data, type, row, meta) {
                //         // var bag = ['0','SETDITJEN','TIDUR','BPB','PKP','PPLP','PSPAM','PSP-POP'];
                //         var $rowData = "";

                //         switch (row.bagian) {
                //             case "420138":
                //                 $rowData += "DIREKTORAT BINA TEKNIK PERMUKIMAN DAN PERUMAHAN";
                //                 break;
                //             case "420139":
                //                 $rowData += "DIREKTORAT KEPATUHAN INTERN";
                //                 break;
                //             case "452771":
                //                 $rowData += "DIREKTORAT PENGEMBANGAN KAWASAN PERMUKIMAN";
                //                 break;
                //             case "452780":
                //                 $rowData += "DIREKTORAT BINA PENATAAN BANGUNAN";
                //                 break;
                //             case "466162":
                //                 $rowData += "DIREKTORAT KETERPADUAN INFRASTRUKTUR PERMUKIMAN";
                //                 break;
                //             case "466178":
                //                 $rowData += "DIREKTORAT AIR MINUM";
                //                 break;
                //             case "466190":
                //                 $rowData += "DIREKTORAT SANITASI";
                //                 break;
                //             case "622213":
                //                 $rowData += "SEKRETARIAT DIREKTORAT JENDERAL CIPTA KARYA";
                //                 break;
                //             case "631097":
                //                 $rowData +=
                //                     "PUSAT PENGEMBANGAN SARANA PRASARANA PENDIDIKAN, OLAHRAGA DAN PASAR";
                //                 break;
                //             default:
                //                 $rowData = "---";
                //                 break;
                //         }

                //         return $rowData;
                //     }, width: "10" 
                // },
                // {
                //     data: "id",
                //     render: function (data, type, row, meta) {
                //         if(type == 'display'){
                //                 if (typeof row.files != "undefined") {
                //                     var imgFile = [];
                //                     var idImg = [];
                //                     var captImg = [];
                //                     var id_file = row.files[0].id;
                //                     var path = row.files[0].path + "/" + row.files[0].filename;
                //                     var idfile = ''

                //                     var stat = row.status;
                //                     var file = "";
                //                     for (var key in row.files) {
                //                         file = row.files[key].path + "/" + row.files[key].filename;
                //                         idfile = row.files[key].id;
                //                         caption = row.files[key].caption;
                //                         imgFile.push(row.files[key].path + "/" + row.files[key].filename);
                //                         idImg.push(row.files[key].id);
                //                         captImg.push(row.files[key].caption);
                //                     }
                //                 } else {
                //                     if (row.image != null) {
                //                         let text = row.image;
                //                         var myArray = text.split(",");
                //                         row.files = myArray;

                //                         file = myArray[0];
                //                         idfile = 0;
                //                         caption = "";
                //                     } else {
                //                         file = "";
                //                         idfile = 0;
                //                         caption = "";
                //                     }
                //                 }

                //                 var st = "";

                //                 if ($("#role-user").val() == 10) {
                //                     if (row.create_by == $("#id-user").val()) {
                //                         if (stat == 1) {
                //                             st =
                //                                 `<a class="dropdown-item" href="#" onclick="updatepublish('${row.id}',0)"><i class="fas fa-sign-out-alt"></i> No Publish</a>`;
                //                         } else {
                //                             st =
                //                                 `<a class="dropdown-item" href="#" onclick="updatepublish('${row.id}',1)"><i class="fas fa-sign-out-alt"></i> Publish</a>`;
                //                         }
                //                     } else {
                //                         if (row.bagian != 0) {
                //                             if (stat == 1) {
                //                                 st =
                //                                     `<a class="dropdown-item" href="#" onclick="updatepublish('${row.id}',0)"><i class="fas fa-sign-out-alt"></i> No Publish</a>`;
                //                             } else {
                //                                 st =
                //                                     `<a class="dropdown-item" href="#" onclick="updatepublish('${row.id}',1)"><i class="fas fa-sign-out-alt"></i> Publish</a>`;
                //                             }
                //                         }
                //                     }
                //                 } else {
                //                     if (row.bagian == 0) {
                //                         if (stat == 1) {
                //                             st =
                //                                 `<a class="dropdown-item" href="#" onclick="updatepublish('${row.id}',0)"><i class="fas fa-sign-out-alt"></i> No Publish</a>`;
                //                         } else {
                //                             st =
                //                                 `<a class="dropdown-item" href="#" onclick="updatepublish('${row.id}',1)"><i class="fas fa-sign-out-alt"></i> Publish</a>`;
                //                         }
                //                     }
                //                 }

                //                 if (row.isi) {
                //                     var isinya = row.isi.replace(/</g, "~");
                //                     var isinya_1 = isinya.replace(/"/g, "`");
                //                 } else {
                //                     var isinya_1 = "";
                //                 }

                //                 var $rowData = "";
                //                 $rowData +=
                //                     `
                //                 <div class="btn-group" ${
                //                                             row.create_by != $("#id-user").val()
                //                                                 ? row.bagian == 0
                //                                                     ? "hidden"
                //                                                     : ""
                //                                                 : ""
                //                                         }>
                //                 <button type="button" class="btn btn-info">Action</button>
                //                 <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown">
                //                 <span class="sr-only">Toggle Dropdown</span>
                //                 </button>
                //                 <div class="dropdown-menu" role="menu">
                //                 <a class="dropdown-item" href="javascript:void(0)" onclick="editdong('` +
                //                     row.id +
                //                     `','` +
                //                     row.judul +
                //                     `','` +
                //                     row.tag +
                //                     // `','` +
                //                     // isinya_1 +
                //                     `','` +
                //                     file +
                //                     `','` +
                //                     idfile +
                //                     `','` +
                //                     row.bagian +
                //                     `','` +
                //                     row.status +
                //                     `','` +
                //                     imgFile +
                //                     `','` +
                //                     idImg +
                //                     `','` +
                //                     captImg +
                //                     `','` +
                //                     row.date +
                //                     `','` +
                //                     caption +
                //                     `')"><i class="far fa-edit"></i> Edit</a>
                //                 <a class="dropdown-item" href="#" onclick="deleteData('${row.id}', '${idImg}', '${imgFile}')"><i class="far fa-trash-alt"></i> Hapus</a>
                //                     <div class="dropdown-divider"></div>
                //                 ${st}
                //                 </div>
                //             </div>`;

                //         return $rowData
                //         }
                //         return data;
                //     }, width: "10"
                // },
            ],
            fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                var index = iDisplayIndexFull + 1;
                $("td:eq(0)", nRow).html(" " + index);

                return;
            },
            initComplete: function() {
                // this.api().columns().every( function () {
                //     var column = this;
                //     var select = $('<select><option value=""></option></select>')
                //         .appendTo( $(column.header()).empty() )
                //         .on( 'change', function () {
                // 			var val = $.fn.dataTable.util.escapeRegex(
                // 				$(this).val()
                // 				);
                // 				alert(val)
                //             column
                //                 .search( val ? '^'+val+'$' : '', true, false )
                //                 .draw();
                //         } );
                //     column.data().unique().sort().each( function ( d, j ) {
                //         select.append( '<option value="'+d+'">'+d+'</option>' )
                //     } );
                // } );
            },
        });
    }
</script>