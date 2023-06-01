

<div class="row">
    <div class="col-md-12">
            <div class="portlet-title">
                <h4 align="center" class="caption-subject font-red bold uppercase">Data Pokok <?= $no_konsultasi ?></h4>
                <hr />
                <div class="row static-info">
                    <div class="col-md-4 name">
                        Nama Pemilik :
                    </div>
                    <div class="col-md-8 value">
                        <?= $nm_pemilik ?>
                    </div>
                </div>
                <div class="row static-info">
                    <div class="col-md-4 name">
                        Alamat Pemilik :
                    </div>
                    <div class="col-md-8 value">
                        <?= (isset($alamat) ? $alamat : ''); ?>, Kec. <?= (isset($nama_kecamatan) ? $nama_kecamatan : ''); ?>,<br> <?= (isset($nama_kabkota) ? $nama_kabkota : ''); ?>, <?= (isset($nama_provinsi) ? $nama_provinsi : ''); ?>
                    </div>
                </div>
                <div class="row static-info">
                    <div class="col-md-4 name">
                        Jenis Konsultasi :
                    </div>
                    <div class="col-md-8 value">
                        <?= $nm_konsultasi ?>
                    </div>
                </div>
                <div class="row static-info">
                    <div class="col-md-4 name">
                        Tanggal Verifikasi & <br> Batas Waktu Pelayanan :
                    </div>
                    <div class="col-md-8 value">
                        <p class="font-red">25-02-2020 <i class="text-tot">sampai dengan</i> 04-03-2020<i class="text-tot">, ( hari kerja ) <br>terhitung dari tanggal verifikasi kelengkapan berkas</i></p>
                    </div>
                </div>
                <div class="row static-info">
                    <div class="col-md-4 name">
                        Lokasi Bangunan Gedung :
                    </div>
                    <div class="col-md-8 value">
                        <?= (isset($almt_bgn) ? $almt_bgn : ''); ?>, Kec. <?= (isset($nama_kec_bg) ? $nama_kec_bg : ''); ?>,<br> <?= (isset($nama_kabkota_bg) ? $nama_kabkota_bg : ''); ?>, <?= (isset($nama_provinsi) ? $nama_provinsi : ''); ?>
                    </div>
                </div>
                <div class="row static-info">
                    <div class="col-md-4 name">
                        Fungsi Bangunan Gedung :
                    </div>
                    <div class="col-md-8 value">
                        <?php echo set_value('fungsi_bg', (isset($fungsi_bg) ? $fungsi_bg : '')) ?> - <?php echo set_value('jns_bangunan', (isset($jns_bangunan) ? $jns_bangunan : '')) ?>
                    </div>
                </div>

                <div class="row static-info">
                    <div class="col-md-4 name">
                        Luas, Tinggi & Jumlah Lantai :
                    </div>
                    <div class="col-md-8 value">
                        <?= (isset($luas_bgn) ? $luas_bgn : '') ?> m<sup>2</sup>, dengan tinggi <?= (isset($tinggi_bgn) ? $tinggi_bgn : '') ?> meter dan berjumlah <?= (isset($jml_lantai) ? $jml_lantai : '') ?> lantai.
                    </div>
                </div>
                <hr />
                <?php
                echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '</div>' : '';
                ?>
                <div class="tabbable-custom nav-justified">
                    <ul id="tabdp3" class="nav nav-tabs nav-justified">
                        <li class="active">
                            <a href="#ps" data-toggle="tab">
                                Penjadwalan Sidang</a>
                        </li>
                        <li style="display: none;">
                            <a href="#doc" data-toggle="tab">
                                Dokumen</a>
                        </li>

                        <li>
                            <a href="#pdata" data-toggle="tab">
                                Perubahan Data</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <!--//Penjadwalan Sidang-->
                        <?php $this->load->view('penjadwalan_sidang') ?>
                        <!--//akhir Penjadwalan Sidang-->
                        <!--//Dokumen Pertimbangan-->
                        <?php $this->load->view('dokumen_pertimbangan') ?>
                        <!--//akhir Dokumen Pertimbangan-->
                        <!--//perubahan data-->
                        <?php $this->load->view('perubahan_data') ?>
                        <!--//akhir perubahan data-->
                        <!--//perubahan data-->
                        <!--//akhir perubahan data-->
                    </div>

                </div>

            </div>
    </div>


    <!-- /.modal -->
    <div id="hasilsidangnya" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
            </div>
            <!-- /.modal-content -->
        </div>
    </div>

    <div id="responsive" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog">
        <div class="modal-dialog ">
            <form action="http://localhost:80/simbg/penjadwalan/hasil_sidang_form/24798" class="form-horizontal" role="form" method="post" id="hsnya" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="caption-subject font-red bold uppercase" align="center">Hasil Sidang</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="form-body">
                                    <input name="email" style="display: none;" class="form-control" value='akbarspl08@gmail.com' id="email" type="text" placeholder="00.00">
                                    <input name="noreg" style="display: none;" class="form-control" value='IMB-321701-25022020-01' id="noreg" type="text" placeholder="00.00">

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Sidang Ke</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="x_id_p" id="x_id_p" style="display: none;">

                                            <input type="text" class="form-control" name="x_sidangke_p" id="x_sidangke_p" autocomplete="off" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Hasil Sidang</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="x_status_p" id="x_status_p">
                                                <option value="">Pilih</option>
                                                <option value="1">Dengan Perbaikan</option>
                                                <option value="2">Tanpa Perbaikan</option>
                                                <option value="3">Permohonan Ditolak / Dikembalikan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Catatan & Berkas Rekomendasi / Hasil Sidang</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" rows="2" placeholder="Keterangan Hasil Sidang" name="x_cat_p" id="x_cat_p"></textarea>
                                            <input style="display: none;" name="dir_file_x" id="dir_file_x" onchange='coxek()'>
                                            <input type="file" class="form-control" name="d_file_x" id="d_file_x" onchange='coxek()'>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" onclick="return confirm('Yakin Ingin Membatalkan?')" data-dismiss="modal" class="btn default">Batal</button>
                        <input type="submit" name="savesidang" value="Simpan" class="btn green" />
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        $('#d_file_jad').change(function() {
            var filename_jad = $(this).val();
            var lastIndex = filename_jad.lastIndexOf("\\");
            if (lastIndex >= 0) {
                filename_jad = filename_jad.substring(lastIndex + 1);
            }
            $('#filename_jad').val(filename_jad);
        });

        function popWin(x) {
            url = x;
            swin = window.open(url, 'win', 'scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
            swin.focus();
        }

        function cokok() {

            $('#dir_file_u').val(d_file_u.value);
        }

        function cokek() {

            $('#dir_file_dok').val(d_file_dok.value);
        }

        function cocok() {

            $('#dir_file1').val(d_file1.value);
        }

        function coxek() {

            $('#dir_file_x').val(d_file_x.value);
        }

        function Xwin(id) {
            $.ajax({
                type: "GET",
                url: "http://localhost:80/simbg/penjadwalan/hasil_sidangnya/",
                dataType: "JSON",
                data: {
                    id: id
                },
                success: function(data) {
                    $.each(data, function() {
                        $('#responsive').modal('show');
                        $('[name="x_id_p"]').val(data.id_penjadwalan);
                        $('[name="x_sidangke_p"]').val(data.sidang_ke);
                    });
                }
            });
            return false;
        };

        $(function() {
            // Setup form validation on the #register-form element
            $("#hsnya").validate({
                // Specify the validation rules
                rules: {
                    x_status_p: "required",
                    //x_cat_p: "required",
                    d_file_x: "required",
                },
                highlight: function(element) {
                    $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                },
                unhighlight: function(element) {
                    $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
                },
                errorClass: 'help-block',

                // Specify the validation error messages
                messages: {
                    x_status_p: "Tentukan Hasil Sidang",
                    //x_cat_p: "Masukan Catatan",
                    d_file_x: "Unggah Hasil Sidang",
                },

                submitHandler: function(form) {
                    form.submit();
                }
            });
        });

        $(function() {
            // Setup form validation on the #register-form element
            $("#jsnya").validate({
                // Specify the validation rules
                rules: {
                    sidang_ke: "required",
                    tanggal_sidang: "required",
                    jam_sidang: "required",

                },
                highlight: function(element) {
                    $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                },
                unhighlight: function(element) {
                    $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
                },
                errorClass: 'help-block',

                // Specify the validation error messages
                messages: {
                    sidang_ke: "Pilih Sidang",
                    tanggal_sidang: "Tentukan Tanggal Sidang",
                    jam_sidang: "Tentukan Jam Sidang",

                },

                submitHandler: function(form) {
                    form.submit();
                }
            });
        });



        function getkabkota_bg(v) {
            $("#nama_kabkota_toggle").fadeIn()
            jQuery.post(base_url + 'penjadwalan/getDataKabKota/' + v, function(data) {
                var nama_kabkota_bg = '<option value="">-- Pilih Kabupaten / Kota --</option>';
                jQuery.each(data, function(key, value) {
                    nama_kabkota_bg += '<option value="' + value.id_kabkot + '"> ' + value.nama_kabkota + ' </option>';
                });

                jQuery('#nama_kabkota_bg').html(nama_kabkota_bg);
                $('#nama_kabkota_bg').prop("disabled", false);
            }, 'json');
        }

        function getkecamatan_bg(v) {
            $("#nama_kecamatan_toggle").fadeIn()
            jQuery.post(base_url + 'penjadwalan/getDataKecamatan/' + v, function(data) {
                var nama_kecamatan_bg = '<option value="">-- Pilih Kecamatan --</option>';
                jQuery.each(data, function(key, value) {
                    nama_kecamatan_bg += '<option value="' + value.id_kecamatan + '"> ' + value.nama_kecamatan + ' </option>';
                });
                jQuery('#nama_kecamatan_bg').html(nama_kecamatan_bg);
                $('#nama_kecamatan_bg').prop("disabled", false);
            }, 'json');
        }

        function getkabkota(v) {
            $("#nama_kabkota_toggle").fadeIn()
            jQuery.post(base_url + 'penjadwalan/getDataKabKota/' + v, function(data) {
                var nama_kabkota = '<option value="">-- Pilih Kabupaten / Kota --</option>';
                jQuery.each(data, function(key, value) {
                    nama_kabkota += '<option value="' + value.id_kabkot + '"> ' + value.nama_kabkota + ' </option>';
                });

                jQuery('#nama_kabkota').html(nama_kabkota);
                $('#nama_kabkota').prop("disabled", false);
            }, 'json');
        }

        function getkecamatan(v) {
            $("#nama_kecamatan_toggle").fadeIn()
            jQuery.post(base_url + 'penjadwalan/getDataKecamatan/' + v, function(data) {
                var nama_kecamatan = '<option value="">-- Pilih Kecamatan --</option>';
                jQuery.each(data, function(key, value) {
                    nama_kecamatan += '<option value="' + value.id_kecamatan + '"> ' + value.nama_kecamatan + ' </option>';
                });
                jQuery('#nama_kecamatan').html(nama_kecamatan);
                $('#nama_kecamatan').prop("disabled", false);
            }, 'json');
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {

            var gjp = document.getElementById("id_jenis_bg").value;
            var tpknya = document.getElementById("id_kolektif").value;
            var manfaatnya = document.getElementById("id_fungsi_bg").value;
            getjenisPermohonan(gjp);
            tpk(tpknya);
            set_pemanfaatan(manfaatnya);

        });

        function getAkun(v) {
            if (v == '1') {
                document.getElementById('Pemilik').style.display = "none";
                document.getElementById('NonPemilik').style.display = "block";
            } else {
                document.getElementById('Pemilik').style.display = "block";
                document.getElementById('NonPemilik').style.display = "none";
            }
        }

        function getNib(v) {
            if (v == '1') {
                document.getElementById('Nib').style.display = "block";
                document.getElementById('NonNib').style.display = "none";
            } else {
                document.getElementById('Nib').style.display = "none";
                document.getElementById('NonNib').style.display = "block";
            }
        }

        function set_pemanfaatan(v) {
            if (v == '1') {
                document.getElementById('dokumen_teknis').style.display = "block";
            } else {
                document.getElementById('dokumen_teknis').style.display = "none";
                //document.getElementById("id_dok_tek").value = "1";	
            }
        }

        function getjenisPermohonan(v) {
            if (v == '5') {
                document.getElementById('NonPrasarana').style.display = "none";
                document.getElementById('prasarana').style.display = "block";
                document.getElementById('Kolektif').style.display = "none";
                document.getElementById('KolektifPecah').style.display = "none";
                document.getElementById('KolektifInduk').style.display = "none";
                document.getElementById('dokumen_teknis').style.display = "none";
                //document.getElementById("id_dok_tek").value = "1";	
            } else if (v == '4') {
                document.getElementById('Kolektif').style.display = "block";
                document.getElementById('NonPrasarana').style.display = "none";
                document.getElementById('prasarana').style.display = "none";
                document.getElementById('dokumen_teknis').style.display = "none";
                //document.getElementById("id_dok_tek").value = "1";	
            } else if (v == '') {
                document.getElementById('Kolektif').style.display = "none";
                document.getElementById('NonPrasarana').style.display = "none";
                document.getElementById('prasarana').style.display = "none";
                document.getElementById('KolektifInduk').style.display = "none";
                document.getElementById('KolektifPecah').style.display = "none";

            } else if (v == '6') {
                document.getElementById('Kolektif').style.display = "none";
                document.getElementById('NonPrasarana').style.display = "none";
                document.getElementById('prasarana').style.display = "none";
                document.getElementById('KolektifInduk').style.display = "none";
                document.getElementById('KolektifPecah').style.display = "none";
                document.getElementById('dokumen_teknis').style.display = "none";
                //document.getElementById("id_dok_tek").value = "1";	

            } else {
                document.getElementById('Kolektif').style.display = "none";
                document.getElementById('NonPrasarana').style.display = "block";
                document.getElementById('prasarana').style.display = "none";
                document.getElementById('KolektifInduk').style.display = "none";
                document.getElementById('KolektifPecah').style.display = "none";
            }
        }

        function tpk(v) {
            if (v == '1') {
                document.getElementById('KolektifInduk').style.display = "block";
                document.getElementById('KolektifPecah').style.display = "none";
                document.getElementById('NonPrasarana').style.display = "none";
                document.getElementById('prasarana').style.display = "none";
                document.getElementById('dokumen_teknis').style.display = "none";
            } else if (v == '2') {
                document.getElementById('KolektifPecah').style.display = "block";
                document.getElementById('KolektifInduk').style.display = "none";
                document.getElementById('NonPrasarana').style.display = "block";
                document.getElementById('prasarana').style.display = "none";
            } else {
                //document.getElementById('Kolektif').style.display="block";
                document.getElementById('KolektifInduk').style.display = "none";
                document.getElementById('KolektifPecah').style.display = "none";
                //document.getElementById('NonPrasarana').style.display="none";
                //document.getElementById('prasarana').style.display="none";
            }
        }

        function popupNIB() {
            $.ajax({
                type: "POST",
                url: "http://localhost:80/simbg/pengajuan/list_nib_popup",
                data: $('form.form-horizontal').serialize(),
                success: function(response) {
                    if (response == '') {
                        alert("NIB tidak terdaftar pada sistem OSS, Silahkan isi manual jika telah memiliki NIB, jika belum memiliki NIB silahkan Lakukan Pendaftaran pada sistem OSS");
                        document.getElementById('nib_list').style.display = "none";
                    } else {
                        $('#table_IMB tbody').html(response);
                        document.getElementById('nib_list').style.display = "block";
                    }
                },
                error: function(error) {
                    alert('NIB tidak terdaftar pada sistem OSS');
                }
            });
        }
    </script>

    <script language="javascript" type="text/javascript">
        $(document).ready(function() {
            //let's create arrays
            var hunian = [{
                    display: "--Pilih--",
                    value: ""
                },
                {
                    display: "Rumah tinggal tunggal",
                    value: "Rumah tinggal tunggal"
                },
                {
                    display: "Rumah tinggal deret",
                    value: "Rumah tinggal deret"
                },
                {
                    display: "Rumah tinggal susun",
                    value: "Rumah tinggal susun"
                },
                {
                    display: "Rumah tinggal sementara",
                    value: "Rumah tinggal sementara"
                }
            ];

            var keagamaan = [{
                    display: "--Pilih--",
                    value: ""
                },
                {
                    display: "Bangunan Masjid dan Mushola",
                    value: "Bangunan Masjid dan Mushola"
                },
                {
                    display: "Bangunan Gereja & Kapel",
                    value: "Bangunan Gereja & Kapel"
                },
                {
                    display: "Bangunan Pura",
                    value: "Bangunan Pura"
                },
                {
                    display: "Bangunan Vihara",
                    value: "Bangunan Vihara"
                },
                {
                    display: "Bangunan Kelenteng",
                    value: "Bangunan Kelenteng"
                }
            ];

            var usaha = [{
                    display: "--Pilih--",
                    value: ""
                },
                {
                    display: "Perkantoran",
                    value: "Perkantoran"
                },
                {
                    display: "Perdagangan",
                    value: "Perdagangan"
                },
                {
                    display: "Perindustrian",
                    value: "Perindustrian"
                },
                {
                    display: "Perhotelan",
                    value: "Perhotelan"
                },
                {
                    display: "Wisata dan rekreasi",
                    value: "Wisata dan rekreasi"
                },
                {
                    display: "Terminal",
                    value: "Terminal"
                },
                {
                    display: "Bangunan gedung tempat penyimpanan",
                    value: "Bangunan gedung tempat penyimpanan"
                }
            ];

            var sosmed = [{
                    display: "--Pilih--",
                    value: ""
                },
                {
                    display: "Pelayanan pendidikan",
                    value: "Pelayanan pendidikan"
                },
                {
                    display: "Pelayanan kesehatan",
                    value: "Pelayanan kesehatan"
                },
                {
                    display: "Kebudayaan",
                    value: "Kebudayaan"
                },
                {
                    display: "Laboratorium",
                    value: "Laboratorium"
                },
                {
                    display: "Bangunan gedung pelayanan umum",
                    value: "Bangunan gedung pelayanan umum"
                }
            ];

            var khusus = [{
                    display: "--Pilih--",
                    value: ""
                },
                {
                    display: "Bangunan gedung untuk reaktor nuklir",
                    value: "Bangunan gedung untuk reaktor nuklir"
                },
                {
                    display: "Instalasi pertahanan dan keamanan",
                    value: "Instalasi pertahanan dan keamanan"
                },
                {
                    display: "Bangunan sejenis yang ditetapkan oleh Menteri",
                    value: "Bangunan sejenis yang ditetapkan oleh Menteri"
                }
            ];

            var parent2 = $(".parent_selection").val();

            switch (parent2) { //using switch compare selected option and populate child
                case '1':
                    list2(hunian);
                    break;
                case '2':
                    list2(keagamaan);
                    break;
                case '3':
                    list2(usaha);
                    break;
                case '4':
                    list2(sosmed);
                    break;
                case '5':
                    list2(khusus);
                    break;

                default: //default child option is blank
                    $("#child_selection").html();
                    break;
            }
            //If parent option is changed
            $(".parent_selection").change(function() {
                var parent = $(this).val(); //get option value from parent
                switch (parent) { //using switch compare selected option and populate child
                    case '1':
                        list(hunian);
                        break;
                    case '2':
                        list(keagamaan);
                        break;
                    case '3':
                        list(usaha);
                        break;
                    case '4':
                        list(sosmed);
                        break;
                    case '5':
                        list(khusus);
                        break;

                    default: //default child option is blank
                        $("#child_selection").html();
                        break;
                }
            });

            //function to populate child select box
            function list(array_list) {
                $("#child_selection").html(""); //reset child options
                $(array_list).each(function(i) { //populate child options
                    $("#child_selection").append("<option value=\"" + array_list[i].value + "\">" + array_list[i].display + "</option>");
                });
            }

            function list2(array_list) {
                $(array_list).each(function(i) { //populate child options
                    $("#child_selection").append("<option value=\"" + array_list[i].value + "\">" + array_list[i].display + "</option>");
                });
            }

        });
    </script>
</div> <!-- END CONTENT -->