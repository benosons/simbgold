</div>
<script src="<?= base_url() ?>assets/bgh/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?= base_url() ?>assets/bgh/js/bootstrap.bundle.min.js"></script>

<script src="<?= base_url() ?>assets/bgh/js/mazer.js"></script>
<script src="<?= base_url() ?>assets/bgh/vendors/apexcharts/apexcharts.js"></script>
<script src="<?= base_url() ?>assets/bgh/js/pages/dashboard.js"></script>
<script src="<?= base_url() ?>assets\bgh/vendors\jquery\jquery.min.js"></script>
<script src="<?= base_url() ?>assets/bgh/vendors/jquery-datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/bgh/vendors/jquery-datatables/custom.jquery.dataTables.bootstrap5.min.js"></script>
<script src="<?= base_url() ?>assets/bgh/vendors/fontawesome/all.min.js"></script>
<!-- filepond validation -->
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>
<script src="<?= base_url() ?>assets/bgh/js/extensions/sweetalert2.js"></script>
<script src="<?= base_url() ?>assets/bgh/vendors/sweetalert2/sweetalert2.all.min.js"></script>
<script>
    // Jquery Datatable
    let jquery_datatable = $("#table1").DataTable()
    // If you want to use tooltips in your project, we suggest initializing them globally
        // instead of a "per-page" level.
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl,
            {
                html:true
            })
        })
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

        $("#msform").submit(function(e) {
            e.preventDefault(e);
            var fd = new FormData(this);
            fd.append('kategori', $('#kategori').val());
            $.ajax({
                type: 'post',
                dataType: 'json',
                data: fd,
                contentType: false,
                processData: false,
                url: '<?= base_url('pengajuan/savepengajuan') ?>',
                success: function(result) {
                    if (result.code === 1) {
                        $('.next').trigger('click');
                    }else{
                        Swal.fire({
                            icon:"warning",
                            title: 'Perhatian !',
                            text: result.msg
                        });
                    }
                }
            })
        })

        $('#id_provinsi').change(function(){
            var id_prov = $(this).val();
            $.ajax({
                type:'post',
                dataType:'json',
                data:{id_provinsi:id_prov},
                url:"<?= base_url('pengajuan/getkabkot') ?>",
                success:function(response){
                    let html = '<option value="">PILIH</option>';
                    response.data.forEach(e => {
                        html += `<option value="${e.id_kabkot}"> ${e.nama_kabkota}</option>`;
                    });

                    $('#id_kabkot').html(html);
                }
            })
        })

        $('#id_kabkot').change(function(){
            var id = $(this).val();
            getkec(id);
        })
        $('#id_kecamatan').change(function(){
            var id = $(this).val();
            getkel(id);
        })

        function getkec(id)
        {
            if (id===0) {
                $('#id_kecamatan').html('<option value=""> PILIH </option>');
            }else{
                $.ajax({
                    type:'post',
                    dataType:'json',
                    data:{id_kabkot:id},
                    url:"<?= base_url('pengajuan/getkecamatan') ?>",
                    success:function(response){
                        let html = '<option value="">PILIH</option>';
                        response.data.forEach(e => {
                            html += `<option value="${e.id_kecamatan}"> ${e.nama_kecamatan}</option>`;
                        });

                        $('#id_kecamatan').html(html);
                    }
                })
            }
        }
        function getkel(id)
        {
            if (id===0) {
                $('#id_kelurahan').html('<option value=""> PILIH </option>');
            }else{
                $.ajax({
                    type:'post',
                    dataType:'json',
                    data:{id_kecamatan:id},
                    url:"<?= base_url('pengajuan/getkelurahan') ?>",
                    success:function(response){
                        let html = '<option value="">PILIH</option>';
                        response.data.forEach(e => {
                            html += `<option value="${e.id_kelurahan}"> ${e.nama_kelurahan}</option>`;
                        });

                        $('#id_kelurahan').html(html);
                    }
                })
            }
        }

        $('#formDataBangunan').submit(function(e){
            e.preventDefault();
            $.ajax({
                type:'post',
                dataType:'json',
                data: new FormData(this),
                contentType:false,
                processData:false,
                url:'<?= base_url('pengajuan/pengajuanmandatory') ?>',
                success:function(response)
                {
                    if (response.code === 1) {
                        $('#idpermohonanglobal').val(response.id_permohonan);
                        $('#nextdatabangunan').trigger('click');
                    }else{
                        Swal.fire({
                            icon:"warning",
                            title: 'Perhatian !',
                            text: response.msg
                        });
                    }
                }
            })
        })

        $("#formDokbghMandatory").submit(function(e) {
            e.preventDefault();
            var fd = new FormData(this);
            fd.append('idpermohonan', $('#idpermohonanglobal').val());
            $.ajax({
                type: 'post',
                dataType: 'json',
                data: fd,
                contentType: false,
                processData: false,
                url: '<?= base_url('pengajuan/saveformdokbgh') ?>',
                success: function(result) {
                    if (result.code === 1) {
                        $('#idpermohonanglobal').val(result.permohonan);
                        $('#nextdokbgh').trigger('click');
                    }else{
                        Swal.fire({
                            icon:"warning",
                            title: 'Perhatian !',
                            text: result.msg
                        });
                    }
                }
            })
        })

        $("#formDokbgh").submit(function(e) {
            e.preventDefault();
            var fd = new FormData(this);
            $.ajax({
                type: 'post',
                dataType: 'json',
                data: fd,
                contentType: false,
                processData: false,
                url: '<?= base_url('pengajuan/savepengajuan') ?>',
                success: function(result) {
                    if (result.code === 1) {
                        $('#idpermohonanglobal').val(result.permohonan);
                        $('#nextdokbgh').trigger('click');
                    }else{
                        Swal.fire({
                            icon:"warning",
                            title: 'Perhatian !',
                            text: result.msg
                        });
                    }
                }
            })
        })
        $("#formDokarsitektur").submit(function(e) {
            e.preventDefault(e);
            var fd = new FormData(this);
            fd.append('idpermohonan', $('#idpermohonanglobal').val());
            $.ajax({
                type: 'post',
                dataType: 'json',
                data: fd,
                contentType: false,
                processData: false,
                url: '<?= base_url('pengajuan/savearsitektur') ?>',
                success: function(result) {
                    if (result.code === 1) {
                        $('#nextdokarsitektur').trigger('click');
                    }
                }
            })
        })
        $("#formDokstruktur").submit(function(e) {
            e.preventDefault(e);
            var fd = new FormData(this);
            fd.append('idpermohonan', $('#idpermohonanglobal').val());
            $.ajax({
                type: 'post',
                dataType: 'json',
                data: fd,
                contentType: false,
                processData: false,
                url: '<?= base_url('pengajuan/savestruktur') ?>',
                success: function(result) {
                    if (result.code === 1) {
                        $('#nextdokstruktur').trigger('click');
                    }
                }
            })
        })
        $("#formDokmep").submit(function(e) {
            e.preventDefault(e);
            var fd = new FormData(this);
            fd.append('idpermohonan', $('#idpermohonanglobal').val());
            $.ajax({
                type: 'post',
                dataType: 'json',
                data: fd,
                contentType: false,
                processData: false,
                url: '<?= base_url('pengajuan/savemep') ?>',
                success: function(result) {
                    if (result.code === 1) {
                        $('#nextdokmep').trigger('click');
                    }
                }
            })
        })

        $(document).on('click', '.edit-permohonan', function(){
            let url = $(this).data('url');
            let label = $(this).data('label');
            let dok = $(this).data('dok');

            $('#urleditpermohonan').val(url);
            $('#label-dokumen').html(label);
            $('#input-dok').html('<input type="file" name="file-edit" class="form-control" accept=".'+dok+'" required>');
            $('#modaleditpermohonan').modal('show');
        })

        $('#formeditpermohonan').submit(function(e){
            e.preventDefault();
            let url = $('#urleditpermohonan').val();
            
            $.ajax({
                type:'post',
                dataType:'json',
                data:new FormData(this),
                processData:false,
                contentType:false,
                url: '../'+url,
                success:function(response)
                {
                    if (response.code === 1) {
                        Swal.fire({
                            icon:'success',
                            title:'Berhasil !',
                            text: response.msg
                        }).then((res) => {
                            if (res.isConfirmed) {
                                window.location.href=response.url;
                            }
                        })
                    }else{
                        Swal.fire({
                            icon:'error',
                            title:'Warning',
                            text:response.msg
                        });
                    }
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

        $('#btn-revisi-submit').click(function() {
            $('#border-less').modal('hide');
            Swal.fire({
                icon: 'success',
                title: 'Berhasil direvisi',
                text: 'Catatan revisi telah dikirmkan kepada pemohon'
            })
        })

        $(document).on('click','.click-notif',function(){
            let id = $(this).data('id');

            $.ajax({
                type:'post',
                dataType:'json',
                data:{id:id},
                url:'<?= base_url('pengajuan/update_status_notif') ?>',
                success:function(response){
                    console.log(repsonse.msg);
                }
            })
        })

    });
</script>

</body>

</html>