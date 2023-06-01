<div class="page-content">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Upload Dokumen BGH</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url() ?>index.html">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Pengajuan BGH Bangunan Baru
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Basic Tables start -->
    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <!-- MultiStep Form -->
                <div class="container-fluid" id="grad1">
                    <div class="row justify-content-center mt-0">
                        <div class="col-md-12 text-center p-0 mt-3 mb-2">
                            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                                <p>Isi semua bidang untuk melanjutkan ke tahap berikutnya</p>
                                <div class="row">
                                    <div class="col-md-12 mx-0">
                                        <div id="msform">
                                            <ul id="progressbar">
                                                <li class="active" id="pemilik"><strong>Data Bangunan dan Pemilik Bangunan</strong></li>
                                                <li <?php if(!empty($pengajuan)){ if($pengajuan->step>=0){echo "class='active'";}} ?> id="account"><strong>Dokumen Dukungan BGH</strong></li>
                                                <li <?php if(!empty($pengajuan)){ if($pengajuan->step>=1){echo "class='active'";}} ?> id="personal"><strong>Dokumen Arsitektur</strong></li>
                                                <li <?php if(!empty($pengajuan)){ if($pengajuan->step>=2){echo "class='active'";}} ?> id="payment"><strong>Dokumen Struktur</strong></li>
                                                <li <?php if(!empty($pengajuan)){ if($pengajuan->step>=3){echo "class='active'";}} ?> id="nodes"><strong>Dokumen MEP</strong></li>
                                                <li id="confirm"><strong>Selesai</strong></li>
                                            </ul>

                                            <fieldset>
                                                <form id="formDataBangunan">
                                                    <div class="row p-3">
                                                        <div class="col-md-6">
                                                            <div class="card shadow text-start">
                                                                <div class="card-header">
                                                                    <h5>Data Bangunan</h5>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <label for="" class="form-control-label">Nama Gedung</label>
                                                                        <input type="text" class="form-control" name="nama_gedung" id="nama_gedung" placeholder="Masukan Nama Gedung" value="<?= (!empty($pengajuan)) ? $pengajuan->nama_gedung:'' ?>" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="" class="form-control-label">Lantai</label>
                                                                        <input type="number" min="1" max="12" class="form-control" name="lantai" id="lantai" value="<?= (!empty($pengajuan)) ? $pengajuan->lantai:1 ?>" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="" class="form-control-label">Luas Bangunan</label>
                                                                        <input type="text" class="form-control" name="luas_bangunan" value="<?= (!empty($pengajuan)) ? $pengajuan->luas_bangunan:'' ?>" id="luas_bangunan" placeholder="Masukan Luas Bangunan" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="" class="form-control-label">
                                                                            Klas Bangunan <span style="cursor:pointer" id="modalklas" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-question-circle text-main"></i></span>
                                                                        </label>
                                                                        <select name="klas_bangunan" id="klas_bangunan" class="form-control" required>
                                                                            <option value="">PILIH</option>
                                                                            <?php foreach($klas as $k){ ?>
                                                                            <option value="<?= $k->id ?>" <?php if(!empty($pengajuan)){ if($pengajuan->klas_bangunan == $k->id){ echo "selected"; } } ?>><?= $k->klas ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="card shadow text-start">
                                                                <div class="card-header">
                                                                    <h5>Data Pemilik Bangunan</h5>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-4">
                                                                            <div class="form-group">
                                                                                <label for="" class="form-control-label">Gelar Depan</label>
                                                                                <input type="text" class="form-control" name="glr_depan" id="glr_depan" placeholder="Masukan Gelar Depan" value="<?= (!empty($pengajuan)) ? $pengajuan->glr_depan:'' ?>" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-4">
                                                                            <div class="form-group">
                                                                                <label for="" class="form-control-label">Nama</label>
                                                                                <input type="text" class="form-control" name="nm_pemilik" id="nm_pemilik" value="<?= (!empty($pengajuan)) ? $pengajuan->nm_pemilik:'' ?>" placeholder="Masukan Nama Pemilik" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-4">
                                                                            <div class="form-group">
                                                                                <label for="" class="form-control-label">Gelar Belakang</label>
                                                                                <input type="text" class="form-control" name="glr_belakang" id="glr_belakang" placeholder="Masukan Gelar Belakang" value="<?= (!empty($pengajuan)) ? $pengajuan->glr_belakang:'' ?>" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="" class="form-control-label">No KTP</label>
                                                                        <input type="text" maxlength="16" class="form-control" name="no_ktp" id="no_ktp" placeholder="Masukan No KTP" value="<?= (!empty($pengajuan)) ? $pengajuan->no_ktp:'' ?>" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="" class="form-control-label">No Kitas</label>
                                                                        <input type="text" class="form-control" name="no_kitas" id="no_kitas" value="<?= (!empty($pengajuan)) ? $pengajuan->no_kitas:'' ?>" placeholder="(Optional)" >
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="" class="form-control-label">Alamat</label>
                                                                        <input type="text" class="form-control" name="alamat" id="alamat" value="<?= (!empty($pengajuan)) ? $pengajuan->alamat:'' ?>" placeholder="Masukan Alamat" >
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="" class="form-control-label">Provinsi</label>
                                                                        <select name="id_provinsi" id="id_provinsi" class="form-control" required>
                                                                            <option value="">PILIH</option>
                                                                            <?php 
                                                                                foreach($provinsi as $p){
                                                                            ?>
                                                                            <option value="<?= $p->id_provinsi ?>"><?= $p->nama_provinsi ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="" class="form-control-label">Kota/Kabupaten</label>
                                                                        <select name="id_kabkot" id="id_kabkot" class="form-control" required>
                                                                            <option value="">PILIH</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="" class="form-control-label">Kecamatan</label>
                                                                        <select name="id_kecamatan" id="id_kecamatan" class="form-control" required>
                                                                            <option value="">PILIH</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="" class="form-control-label">Kelurahan</label>
                                                                        <select name="id_kelurahan" id="id_kelurahan" class="form-control" required>
                                                                            <option value="">PILIH</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="" class="form-control-label">No HP</label>
                                                                        <input type="text" class="form-control" maxlength="12" name="no_hp" id="no_hp" value="<?= (!empty($pengajuan)) ? $pengajuan->no_hp:'' ?>" placeholder="Masukan Nomor HP Aktif" >
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="" class="form-control-label">Email</label>
                                                                        <input type="email" class="form-control" name="email" id="email" value="<?= (!empty($pengajuan)) ? $pengajuan->email:'' ?>" placeholder="Masukan Email" >
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="" class="form-control-label">Unit Organisasi</label>
                                                                        <input type="text" class="form-control" name="unit_organisasi" id="unit_organisasi" value="<?= (!empty($pengajuan)) ? $pengajuan->unit_organisasi:'' ?>" placeholder="Masukan Unit Organisasi" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="action-button">Next Step</button>
                                                </form>
                                                <input type="button" name="next" class="next action-button" id="nextdatabangunan" value="Next Step" hidden />
                                            </fieldset>
                                            <fieldset>
                                                <form id="formDokbghMandatory" enctype="multipart/form-data">
                                                    <div class="row p-3">
                                                        <?php
                                                        $i = 1;
                                                        foreach ($syarat as $s) {
                                                        ?>
                                                            <div class="col-md-6">
                                                                <div class="card shadow">
                                                                    <div class="card-header">
                                                                        <h5 class="card-title"><?= $s->nama ?></h5>
                                                                        <small><em><?= $s->keterangan ?></em></small>
                                                                    </div>
                                                                    <div class="card-content">
                                                                        <div class="card-body">
                                                                            <input type="file" class="with-validation-filepond" name="dokbgh[]" id="dokumen-pembuktian-bgh" <?php 
                                                                                if($i == 1){
                                                                            ?>
                                                                            accept=".pdf"
                                                                            <?php
                                                                                }else{
                                                                            ?> accept=".xlsx" <?php } ?> required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php $i++;} ?>
                                                    </div>
                                                    <button type="submit" class="action-button">Next Step</button>
                                                </form>
                                                <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                                <input type="button" name="next" class="next action-button" id="nextdokbgh" value="Next Step" hidden />
                                            </fieldset>
                                            <fieldset>
                                                <input type="text" id="idpermohonanglobal" hidden>
                                                <form id="formDokarsitektur" enctype="multipart/form-data">
                                                    <div class="row p-3">
                                                        <?php foreach ($arsitektur as $a) { ?>
                                                            <div class="col-md-6">
                                                                <div class="card shadow text-start">
                                                                    <div class="card-header">
                                                                        <h5 class="card-title"><?= $a->nama ?></h5>
                                                                        <small><?= $a->keterangan ?></small>
                                                                    </div>
                                                                    <div class="card-content">
                                                                        <div class="card-body">
                                                                            <input type="file" class="form-control" name="dokars[]" accept=".pdf" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                    <button type="submit" class="action-button">Next Step</button>
                                                </form>
                                                <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                                <input type="button" name="next" class="next action-button" value="Next Step" id="nextdokarsitektur" hidden />
                                            </fieldset>
                                            <fieldset>
                                                <form id="formDokstruktur" enctype="multipart/form-data">
                                                    <div class="row p-3">
                                                        <?php foreach ($struktur as $st) { ?>
                                                            <div class="col-md-6">
                                                                <div class="card shadow text-start">
                                                                    <div class="card-header">
                                                                        <h5 class="card-title"><?= $st->nama ?></h5>
                                                                        <small><?= $st->keterangan ?></small>
                                                                    </div>
                                                                    <div class="card-content">
                                                                        <div class="card-body">
                                                                            <input type="file" class="form-control" name="dokstruk[]" accept=".pdf">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                    <button type="submit" class="action-button">Next Step</button>
                                                </form>
                                                <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                                <input type="button" name="make_payment" class="next action-button" id="nextdokstruktur" value="Next Step" hidden />
                                            </fieldset>
                                            <fieldset>
                                                <form id="formDokmep" enctype="multipart/form-data">
                                                    <div class="row p-3">
                                                        <?php foreach ($mep as $m) { ?>
                                                            <div class="col-md-6">
                                                                <div class="card shadow text-start">
                                                                    <div class="card-header">
                                                                        <h5 class="card-title"><?= $m->nama ?></h5>
                                                                        <small><?= $m->keterangan ?></small>
                                                                    </div>
                                                                    <div class="card-content">
                                                                        <div class="card-body">
                                                                            <input type="file" class="form-control" name="dokmep[]" accept=".pdf">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                    <button type="submit" class="action-button">Next Step</button>
                                                </form>
                                                <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                                <input type="button" name="make_payment" class="next action-button" value="Confirm" id="nextdokmep" hidden />
                                            </fieldset>
                                            <fieldset>
                                                <div class="form-card">
                                                    <h2 class="fs-title text-center">Success !</h2>
                                                    <br><br>
                                                    <div class="row justify-content-center">
                                                        <div class="col-3">
                                                            <img src="https://img.icons8.com/color/96/000000/ok--v2.png" class="fit-image">
                                                        </div>
                                                    </div>
                                                    <br><br>
                                                    <div class="row justify-content-center">
                                                        <div class="col-7 text-center">
                                                            <h5>Permohonan BGH anda akan dicek terlebih dahulu</h5>
                                                        </div>
                                                    </div>
                                                    <a href="<?= base_url('bgh/pengajuan/bangunanbaru') ?>">Kembali</a>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <div class="modal fade" id="exampleModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bangunan Gedung dengan kategori Wajib BGH</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-stripped">
                    <thead class="bg-main">
                        <th>No</th>
                        <th>Klas Bangunan</th>
                        <th>Definisi</th>
                        <th>Contoh Bangunan</th>
                        <th>Ketentuan</th>
                    </thead>
                    <tbody>
                        <?php 
                            $index = 1;
                            foreach($klas as $kl){
                        ?>
                        <tr>
                            <td><?= $index ?></td>
                            <td><?= $kl->klas ?></td>
                            <td><?= $kl->definisi ?></td>
                            <td><?= $kl->contoh_bangunan ?></td>
                            <td><?= $kl->ketentuan ?></td>
                        </tr>
                        <?php $index++;} ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
    <!-- Basic Tables end -->
</div>
<?php if(!empty($pengajuan)){ ?>
    <script>
        var step = "<?= $pengajuan->step ?>";
        var id_prov = "<?= $pengajuan->id_provinsi ?>";
        var id_kabkot = "<?= $pengajuan->id_kabkota ?>";
        var id_kec = "<?= $pengajuan->id_kecamatan ?>";
        var id_kel = "<?= $pengajuan->id_kelurahan ?>";
    </script>
<?php
}else {
?>
    <script>
        var step = "10";
        var id_prov = "0";
        var id_kabkot = "0";
        var id_kec = "0";
        var id_kel = "0";
    </script>
<?php } ?>

<script>
    $(document).ready(function(){

        $('#bangunanbaru-menu').addClass('active');

        if (id_prov !== "0") {
            $('#id_provinsi').val(id_prov);
            handleprov(id_prov);
        }


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
                url: '<?= base_url('bgh/pengajuan/savepengajuan') ?>',
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
            var id_provin = $(this).val();
            handleprov(id_provin);
        })

        $('#id_kabkot').change(function(){
            var id = $(this).val();
            handlekabkot(id);
        })

        function handleprov(id_prov){
            
            $.ajax({
                type:'post',
                dataType:'json',
                data:{id_provinsi:id_prov},
                url:"<?= base_url('bgh/pengajuan/getkabkot') ?>",
                success:function(response){
                    let html = '<option value="">PILIH</option>';
                    response.data.forEach(e => {
                        html += `<option value="${e.id_kabkot}"> ${e.nama_kabkota}</option>`;
                    });

                    $('#id_kabkot').html(html);

                    if (id_kabkot !== "0") {
                        $('#id_kabkot').val(id_kabkot);
                        getkec(id_kabkot);
                    }
                }
            })
        }

        function handlekabkot(id){
            getkec(id);
        }

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
                    url:"<?= base_url('bgh/pengajuan/getkecamatan') ?>",
                    success:function(response){
                        let html = '<option value="">PILIH</option>';
                        response.data.forEach(e => {
                            html += `<option value="${e.id_kecamatan}"> ${e.nama_kecamatan}</option>`;
                        });

                        $('#id_kecamatan').html(html);

                        if (id_kec !== "0") {
                            $('#id_kecamatan').val(id_kec);
                            getkel(id_kec);
                        }
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
                    url:"<?= base_url('bgh/pengajuan/getkelurahan') ?>",
                    success:function(response){
                        let html = '<option value="">PILIH</option>';
                        response.data.forEach(e => {
                            html += `<option value="${e.id_kelurahan}"> ${e.nama_kelurahan}</option>`;
                        });

                        $('#id_kelurahan').html(html);
                        if (id_kel !== "0") {
                            $('#id_kelurahan').val(id_kel);
                        }
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
                url:'<?= base_url('bgh/pengajuan/pengajuanmandatory') ?>',
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
                url: '<?= base_url('bgh/pengajuan/saveformdokbgh') ?>',
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
                url: '<?= base_url('bgh/pengajuan/savepengajuan') ?>',
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
                url: '<?= base_url('bgh/pengajuan/savearsitektur') ?>',
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
                url: '<?= base_url('bgh/pengajuan/savestruktur') ?>',
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
                url: '<?= base_url('bgh/pengajuan/savemep') ?>',
                success: function(result) {
                    if (result.code === 1) {
                        $('#nextdokmep').trigger('click');
                    }
                }
            })
        })
    })
</script>