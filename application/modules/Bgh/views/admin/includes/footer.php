</div>
<script src="<?= base_url() ?>assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?= base_url() ?>assets/js/bootstrap.bundle.min.js"></script>

<script src="<?= base_url() ?>assets/js/mazer.js"></script>
<script src="<?= base_url() ?>assets/vendors/apexcharts/apexcharts.js"></script>
<script src="<?= base_url() ?>assets/js/pages/dashboard.js"></script>
<script src="<?= base_url() ?>assets\vendors\jquery\jquery.min.js"></script>
<script src="<?= base_url() ?>assets/vendors/jquery-datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/vendors/jquery-datatables/custom.jquery.dataTables.bootstrap5.min.js"></script>
<script src="<?= base_url() ?>assets/vendors/fontawesome/all.min.js"></script>
<!-- filepond validation -->
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>
<script src="<?= base_url() ?>assets/js/extensions/sweetalert2.js"></script>
<script src="<?= base_url() ?>assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>
<script>
    // Jquery Datatable
    let jquery_datatable = $("#table1").DataTable()
</script>

<script>
    $(document).ready(function() {
        <?php
        if ($page == "bangunanbaru") {
        ?>
            $('#bangunanbaru-menu').addClass('active');
        <?php
        } else if ($page == 'dashboard') {
        ?>
            $('#dashboard-menu').addClass('active');
        <?php

        } else if ($page == 'bgh') {
        ?>
            $('#list-menu').addClass('active');
        <?php
        } else if ($page == 'informasi') {
        ?>
            $('#informasi-menu').addClass('active');
        <?php
        } else if ($page == 'tpa') {
        ?>
            $('#tpa-menu').addClass('active');
        <?php
        } else if ($page == 'juknis') {
        ?>
            $('#juknis-menu').addClass('active');
        <?php
        }
        ?>

        $('#basic-addon2').click(function() {
            $('#status').removeClass('d-none');
            $('#kategori').removeClass('d-none');
            $('#btn-ajukan').removeClass('d-none');
        })

        // FilePond.registerPlugin(
        //     // validates the size of the file...
        //     FilePondPluginFileValidateSize,
        //     // validates the file type...
        //     FilePondPluginFileValidateType,

        //     // calculates & dds cropping info based on the input image dimensions and the set crop ratio...
        //     FilePondPluginImageCrop,
        //     // preview the image file type...
        //     FilePondPluginImagePreview,
        //     // filter the image file
        //     FilePondPluginImageFilter,
        //     // corrects mobile image orientation...
        //     FilePondPluginImageExifOrientation,
        //     // calculates & adds resize information...
        //     FilePondPluginImageResize,
        // );

        // FilePond.create(document.querySelector('input[type="file"]'), {
        //     allowImagePreview: false,
        //     allowMultiple: false,
        //     allowFileEncode: false,
        //     required: false
        // });

        var current_fs, next_fs, previous_fs; //fieldsets
        var opacity;

        $(".next").click(function() {

            current_fs = $(this).parent();
            next_fs = $(this).parent().next();

            //Add Class Active
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

            //show the next fieldset
            next_fs.show();
            //hide the current fieldset with style
            current_fs.animate({
                opacity: 0
            }, {
                step: function(now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    next_fs.css({
                        'opacity': opacity
                    });
                },
                duration: 600
            });
        });

        $(".previous").click(function() {

            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();

            //Remove class active
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

            //show the previous fieldset
            previous_fs.show();

            //hide the current fieldset with style
            current_fs.animate({
                opacity: 0
            }, {
                step: function(now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    previous_fs.css({
                        'opacity': opacity
                    });
                },
                duration: 600
            });
        });

        $('.radio-group .radio').click(function() {
            $(this).parent().find('.radio').removeClass('selected');
            $(this).addClass('selected');
        });

        $(".submit").click(function() {
            return false;
        })

        $(document).on('click', '.detailtpa',function(){
            var id = $(this).data('id');
            $.ajax({
                type:'post',
                dataType:'json',
                data:{id:id},
                url:'<?= base_url('bgh/verifikator/tpa/detail') ?>',
                success:function(result){
                    var unsur = '';
                    if (result.data.id_lembaga == "1") {
                        unsur = 'Akademisi';
                    }else if(result.data.id_lembaga == "2"){
                        unsur = 'Pakar';
                    }else {
                        unsur = 'Profesi Ahli';
                    }
                    var html = `
                        <table class="table table-borderless text-start">
                            <tr>
                                <td> Nama </td>
                                <td> : </td>
                                <td> ${result.data.glr_depan} ${result.data.nm_tpa} ${result.data.glr_blkg} </td>
                            </tr>
                            <tr>
                                <td> Alamat </td>
                                <td> : </td>
                                <td> ${result.data.alamat}</td>
                            </tr>
                            <tr>
                                <td> Tempat Lahir </td>
                                <td> : </td>
                                <td> ${result.data.tmpt_lahir}</td>
                            </tr>
                            <tr>
                                <td> Tanggal Lahir </td>
                                <td> : </td>
                                <td> ${result.data.tgl_lahir}</td>
                            </tr>
                            <tr>
                                <td> Email </td>
                                <td> : </td>
                                <td> ${result.data.email}</td>
                            </tr>
                            <tr>
                                <td> No Telepon </td>
                                <td> : </td>
                                <td> ${result.data.no_kontak}</td>
                            </tr>
                            <tr>
                                <td> Provinsi </td>
                                <td> : </td>
                                <td> ${result.data.nama_provinsi}</td>
                            </tr>
                            <tr>
                                <td> Kab/Kota </td>
                                <td> : </td>
                                <td> ${result.data.nama_kabkota}</td>
                            </tr>
                            <tr>
                                <td> Unsur </td>
                                <td> : </td>
                                <td> ${unsur}</td>
                            </tr>
                            <tr>
                                <td> Sertifikat Keahlian </td>
                                <td> : </td>
                                <td> -</td>
                            </tr>
                    `;
                    Swal.fire({
                        title:'informasi',
                        html: html
                    });
                }
            })
        })

        $('#verifikasi').click(function() {
            Swal.fire({
                icon: 'info',
                title: 'Yakin untuk verifikasi permohonan ini ?',
                text: 'Dokumen BGH akan diteruskan ke SIMBG',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yakin'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Verifikasi Berhasil',
                        text: 'Dokumen BGH telah diteruskan ke SIMBG'
                    });
                }
            })
        })

        $(document).on('click', '.verifikasidokumen', function() {
            Swal.fire({
                icon: 'info',
                title: 'Yakin untuk verifikasi dokumen ini ?',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yakin'
            }).then((result) => {
                if (result.isConfirmed) {
                    var url = $(this).data('url');
                    $.ajax({
                        type: 'post',
                        dataType: 'json',
                        data: {
                            'verifikasi': 2
                        },
                        url: '../' + url,
                        success: function(result) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Verifikasi Berhasil'
                            }).then((response) => {
                                if (response.isConfirmed) {
                                    window.location.href=result.url;
                                }
                            });
                        }
                    })
                }
            })
        })

        $(document).on('click', '.revisidokumen', function() {
            $('#border-less').modal('show');
            var url = $(this).data('url');
            $('#urlrevisi').val(url);
        })

        $('#btn-revisi-submit').click(function() {
            $('#border-less').modal('hide');
            var catatan = $('#catatan').val();
            var url = $('#urlrevisi').val();
            $.ajax({
                type: 'post',
                dataType: 'json',
                data: {
                    catatan: catatan
                },
                url: '../' + url,
                success: function(result) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil direvisi',
                        text: 'Catatan revisi telah dikirmkan kepada pemohon'
                    }).then((results) => {
                        if (results.isConfirmed) {
                            window.location.href=result.url;
                        }
                    })
                }
            })
        })

        $(document).on('click', '.verifikasipermohonan', function() {
            Swal.fire({
                icon: 'info',
                title: 'Yakin untuk verifikasi Permohonan ini ?',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yakin'
            }).then((result) => {
                if (result.isConfirmed) {
                    var id = $(this).data('id');
                    $.ajax({
                        type: 'post',
                        dataType: 'json',
                        data: {
                            'id': id,
                            'status': 3
                        },
                        url: '../verifikasipermohonan',
                        success: function(result) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Verifikasi Berhasil'
                            }).then((response) => {
                                if (response.isConfirmed) {
                                    window.location.href = "../bangunanbaru";
                                }
                            });
                        }
                    })
                }
            })
        })

        $('#tambah-juknis').click(function(){
            $('#modaljuknis').modal('show');
            $('#id').val('0');
            $('#nama_dokumen').val('');
            $('#jenis_dokumen').val('');
            $('#penerbit').val('');
            $('#tahun').val('');
        })

        $('#formjuknis').submit(function(e){
            e.preventDefault();
            $.ajax({
                type:'post',
                dataType:'json',
                data:new FormData(this),
                processData:false,
                contentType:false,
                url:"<?= base_url('bgh/verifikator/informasi/formjuknis') ?>",
                success:function(response){
                    if (response.code === 1) {
                        Swal.fire({
                            icon:'success',
                            title:'Berhasil',
                            text: response.msg
                        }).then((result)=>{
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    }else{
                        Swal.fire({
                            icon:'error',
                            title:'Gagal',
                            text:response.msg
                        });
                    }
                }
            })
        })

        $(document).on('click','.editjuknis',function(){
            let id = $(this).data('id');
            let nama = $(this).data('nama');
            let jenis = $(this).data('jenis');
            let penerbit = $(this).data('penerbit');
            let tahun = $(this).data('tahun');
            let berkas = $(this).data('berkas');

            $('#modaljuknis').modal('show');
            $('#id').val(id);
            $('#nama_dokumen').val(nama);
            $('#jenis_dokumen').val(jenis);
            $('#penerbit').val(penerbit);
            $('#tahun').val(tahun);
        })

        $(document).on('click','.deletejuknis', function(){
            var id = $(this).data('id');
            Swal.fire({
                icon:'question',
                title:'Hapus Data ?',
                text:'Data akan hilang permanen',
                showCancelButton: true
            }).then((response)=>{
                if (response.isConfirmed) {
                    $.ajax({
                        type:'post',
                        dataType:'json',
                        data:{id:id},
                        url:'<?= base_url('bgh/verifikator/informasi/deletejuknis') ?>',
                        success:function(result)
                        {
                            if (result.code === 1) {
                                Swal.fire({
                                    icon:'success',
                                    title:'Berhasi',
                                    text:result.msg
                                }).then((res) => {
                                    if (res.isConfirmed) {
                                        location.reload();
                                    }
                                })
                            }else{
                                Swal.fire({
                                    icon:'error',
                                    title:'Gagal',
                                    text:result.msg
                                });
                            }
                        }
                    })
                }
            })
        })

        $('#tambah-informasi').click(function(){
            $('#modalinformasi').modal('show');
            $('#id').val('0');
            $('#nama_dokumen').val('');
            $('#jenis_dokumen').val('');
            $('#penerbit').val('');
            $('#tahun').val('');
        })

        $('#forminformasi').submit(function(e){
            e.preventDefault();
            $.ajax({
                type:'post',
                dataType:'json',
                data:new FormData(this),
                processData:false,
                contentType:false,
                url:"<?= base_url('bgh/verifikator/informasi/forminformasi') ?>",
                success:function(response){
                    if (response.code === 1) {
                        Swal.fire({
                            icon:'success',
                            title:'Berhasil',
                            text: response.msg
                        }).then((result)=>{
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    }else{
                        Swal.fire({
                            icon:'error',
                            title:'Gagal',
                            text:response.msg
                        });
                    }
                }
            })
        })

        $(document).on('click','.editinformasi',function(){
            let id = $(this).data('id');
            let nama = $(this).data('nama');
            let jenis = $(this).data('jenis');
            let penerbit = $(this).data('penerbit');
            let tahun = $(this).data('tahun');
            let berkas = $(this).data('berkas');

            $('#modalinformasi').modal('show');
            $('#id').val(id);
            $('#nama_dokumen').val(nama);
            $('#jenis_dokumen').val(jenis);
            $('#penerbit').val(penerbit);
            $('#tahun').val(tahun);
        })

        $(document).on('click','.deleteinformasi', function(){
            var id = $(this).data('id');
            Swal.fire({
                icon:'question',
                title:'Hapus Data ?',
                text:'Data akan hilang permanen',
                showCancelButton: true
            }).then((response)=>{
                if (response.isConfirmed) {
                    $.ajax({
                        type:'post',
                        dataType:'json',
                        data:{id:id},
                        url:'<?= base_url('bgh/verifikator/informasi/deleteinformasi') ?>',
                        success:function(result)
                        {
                            if (result.code === 1) {
                                Swal.fire({
                                    icon:'success',
                                    title:'Berhasi',
                                    text:result.msg
                                }).then((res) => {
                                    if (res.isConfirmed) {
                                        location.reload();
                                    }
                                })
                            }else{
                                Swal.fire({
                                    icon:'error',
                                    title:'Gagal',
                                    text:result.msg
                                });
                            }
                        }
                    })
                }
            })
        })

        $(document).on('click','.click-notif',function(){
            let id = $(this).data('id');

            $.ajax({
                type:'post',
                dataType:'json',
                data:{id:id},
                url:'<?= base_url('bgh/verifikator/pengajuan/update_status_notif') ?>',
                success:function(response){
                    console.log(repsonse.msg);
                }
            })
        })
    });
</script>

</body>

</html>