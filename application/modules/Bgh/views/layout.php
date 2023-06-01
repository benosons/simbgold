<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Modul BGH</title>

    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/bgh/css/bootstrap.css" />

    <link rel="stylesheet" href="<?= base_url() ?>assets/bgh/vendors/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/bgh/vendors/bootstrap-icons/bootstrap-icons.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/bgh/css/app.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/bgh/vendors/jquery-datatables/jquery.dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/bgh/vendors/fontawesome/all.min.css">
    <link rel="shortcut icon" href="<?= base_url() ?>assets/bgh/images/favicon.svg" type="image/x-icon" />
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">

    <link rel="stylesheet" href="<?= base_url() ?>assets/bgh/vendors/sweetalert2/sweetalert2.min.css">
    <style>
        /*form styles*/
        #msform {
            text-align: center;
            position: relative;
            margin-top: 20px;
        }

        #msform fieldset .form-card {
            background: white;
            border: 0 none;
            border-radius: 0px;
            box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
            padding: 20px 40px 30px 40px;
            box-sizing: border-box;
            width: 94%;
            margin: 0 3% 20px 3%;

            /*stacking fieldsets above each other*/
            position: relative;
        }

        #msform fieldset {
            background: white;
            border: 0 none;
            border-radius: 0.5rem;
            box-sizing: border-box;
            width: 100%;
            margin: 0;
            padding-bottom: 20px;

            /*stacking fieldsets above each other*/
            position: relative;
        }

        /*Hide all except first fieldset*/
        #msform fieldset:not(:first-of-type) {
            display: none;
        }

        #msform fieldset .form-card {
            text-align: left;
            color: #9E9E9E;
        }

        #msform input,
        #msform textarea {
            padding: 0px 8px 4px 8px;
            border: none;
            border-bottom: 1px solid #ccc;
            border-radius: 0px;
            margin-bottom: 25px;
            margin-top: 2px;
            width: 100%;
            box-sizing: border-box;
            color: #2C3E50;
            font-size: 16px;
            letter-spacing: 1px;
        }

        #msform input:focus,
        #msform textarea:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            border: none;
            font-weight: bold;
            border-bottom: 2px solid #25396f;
            outline-width: 0;
        }

        /*Blue Buttons*/
        #msform .action-button {
            width: 100px;
            background: #25396f;
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 0px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 10px 5px;
        }

        #msform .action-button:hover,
        #msform .action-button:focus {
            box-shadow: 0 0 0 2px white, 0 0 0 3px #25396f;
        }

        /*Previous Buttons*/
        #msform .action-button-previous {
            width: 110px;
            background: #616161;
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 0px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 10px 5px;
        }

        #msform .action-button-previous:hover,
        #msform .action-button-previous:focus {
            box-shadow: 0 0 0 2px white, 0 0 0 3px #616161;
        }

        /*Dropdown List Exp Date*/
        select.list-dt {
            border: none;
            outline: 0;
            border-bottom: 1px solid #ccc;
            padding: 2px 5px 3px 5px;
            margin: 2px;
        }

        select.list-dt:focus {
            border-bottom: 2px solid #25396f;
        }

        /*The background card*/
        .card {
            z-index: 0;
            border: none;
            border-radius: 0.5rem;
            position: relative;
        }

        /*FieldSet headings*/
        .fs-title {
            font-size: 25px;
            color: #2C3E50;
            margin-bottom: 10px;
            font-weight: bold;
            text-align: left;
        }

        /*progressbar*/
        #progressbar {
            margin-bottom: 30px;
            overflow: hidden;
            color: lightgrey;
        }

        #progressbar .active {
            color: #000000;
        }

        #progressbar li {
            list-style-type: none;
            font-size: 12px;
            width: 16%;
            float: left;
            position: relative;
        }

        /*Icons in the ProgressBar*/
        #progressbar #pemilik:before {
            font-family: FontAwesome;
            content: "\f016";
        }
        #progressbar #account:before {
            font-family: FontAwesome;
            content: "\f016";
        }

        #progressbar #personal:before {
            font-family: FontAwesome;
            content: "\f016";
        }

        #progressbar #payment:before {
            font-family: FontAwesome;
            content: "\f016";
        }

        #progressbar #nodes:before {
            font-family: FontAwesome;
            content: "\f016";
        }

        #progressbar #confirm:before {
            font-family: FontAwesome;
            content: "\f00c";
        }

        /*ProgressBar before any progress*/
        #progressbar li:before {
            width: 50px;
            height: 50px;
            line-height: 45px;
            display: block;
            font-size: 18px;
            color: #ffffff;
            background: lightgray;
            border-radius: 50%;
            margin: 0 auto 10px auto;
            padding: 2px;
        }

        /*ProgressBar connectors*/
        #progressbar li:after {
            content: '';
            width: 100%;
            height: 2px;
            background: lightgray;
            position: absolute;
            left: 0;
            top: 25px;
            z-index: -1;
        }

        /*Color number of the step and the connector before it*/
        #progressbar li.active:before,
        #progressbar li.active:after {
            background: #25396f;
        }

        /*Imaged Radio Buttons*/
        .radio-group {
            position: relative;
            margin-bottom: 25px;
        }

        .radio {
            display: inline-block;
            width: 204;
            height: 104;
            border-radius: 0;
            background: lightblue;
            box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
            box-sizing: border-box;
            cursor: pointer;
            margin: 8px 2px;
        }

        .radio:hover {
            box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.3);
        }

        .radio.selected {
            box-shadow: 1px 1px 2px 2px rgba(0, 0, 0, 0.1);
        }

        /*Fit image in bootstrap div*/
        .fit-image {
            width: 100%;
            object-fit: cover;
        }
    </style>
    <script src="<?= base_url() ?>assets/bgh/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?= base_url() ?>assets/bgh/js/bootstrap.bundle.min.js"></script>

    <script src="<?= base_url() ?>assets/bgh/js/mazer.js"></script>
    <script src="<?= base_url() ?>assets/bgh/vendors/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/bgh/vendors/jquery-datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>assets/bgh/vendors/jquery-datatables/custom.jquery.dataTables.bootstrap5.min.js"></script>
    <script src="<?= base_url() ?>assets/bgh/vendors/fontawesome/all.min.js"></script>
    <!-- filepond validation -->
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script src="<?= base_url() ?>assets/bgh/vendors/sweetalert2/sweetalert2.all.min.js"></script>
    <script>
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

    <!-- <script>
        $(document).ready(function() {
        

            // $('#basic-addon2').click(function() {
            //     $('#status').removeClass('d-none');
            //     $('#kategori').removeClass('d-none');
            //     $('#btn-ajukan').removeClass('d-none');
            // })

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
                    url:'<?= base_url('bgh/pengajuan/update_status_notif') ?>',
                    success:function(response){
                        console.log(repsonse.msg);
                    }
                })
            })

        });
    </script> -->

</head>

<body>
    <div id="app">
        <?= $this->load->view('includes/sidebar') ?>
        <div id="main" class='layout-navbar'>
        <?= $this->load->view('includes/header') ?>
            <div id="main-content">
                <?= $page_content ?>
                <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                    <p>2023 &copy;</p>
                    </div>
                    <div class="float-end">
                    <p>
                    </p>
                    </div>
                </div>
                </footer>
            </div>

        </div>
    </div>
</body>

</html>