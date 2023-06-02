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
                            <a href="<?= base_url('bgh/') ?>index.html">Dashboard</a>
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
                <!-- MultiStep Form -->
                <div class="container-fluid" id="grad1">
                    <div class="row justify-content-center mt-0">
                        <div class="col-lg-12 text-center p-0 mt-3 mb-2">
                            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                                <p>Fill all form field to go to next step</p>
                                <div class="row">
                                    <div class="col-md-12 mx-0">
                                        <div id="msform">
                                            <!-- progressbar -->
                                            <ul id="progressbar" class="d-flex justify-content-center">
                                                <li class="active" id="account"><strong>Cek Permohonan PBG</strong></li>
                                                <li <?php if(!empty($pengajuan)){ if($pengajuan->step>=0){echo "class='active'";}} ?> id="personal"><strong>Upload Dokumen BGH</strong></li>
                                                <li id="confirm"><strong>Finish</strong></li>
                                            </ul>
                                            <!-- fieldsets -->
                                            <fieldset>
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-lg-12 text-start">
                                                                <div class="form-group">
                                                                    <input type="text" id="kategori" value="recommended" hidden>
                                                                    <label for="kodepbg" class="form-control-label">Kode Permohonan PBG</label>
                                                                    <input type="text" class="form-control" id="kodepbg" name="kodepbg" placeholder="Masukan Kode PBG">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" id="cek-pbg" class="action-button">Next Step</button>
                                                <input type="button" name="next" class="next action-button" id="nextstep1" value="Next Step" hidden/>
                                            </fieldset>
                                            <fieldset id="dokbgh">
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
                                                                            <form class="formdokbgh" enctype="multipart/form-data">
                                                                                <input type="text" name="id_syarat_bgh" value="<?= $s->id ?>" hidden>
                                                                            <?php 
                                                                            $nilai = 0;
                                                                            if (!empty($file_bgh)) {
                                                                                foreach($file_bgh as $fb){
                                                                                    if ($fb->id_syarat_bgh == $s->id) {
                                                                                        $nilai = $fb->nilai;
                                                                                        echo "<strong> Nama File: ".$fb->file.'</strong>';
                                                                                        echo "</br>";
                                                                                        break;
                                                                                    }
                                                                                }
                                                                            } ?>
                                                                            <?php 
                                                                                if ($i > 1) {
                                                                            ?>
                                                                            <div class="form-group">
                                                                            <label for="nilai" class="form-control-label">Nilai <?=$s->nama?> (<?= $s->satuan?>)</label>
                                                                            <input type="number" class="form-control" value="<?= $nilai ?>" name="nilai" <?= ($i==2) ? 'max="35"':'' ?>>
                                                                            </div>
                                                                            <?php 
                                                                                }else{
                                                                            ?>
                                                                            <div class="form-group">
                                                                            <input type="number" class="form-control" value="0" name="nilai" hidden>
                                                                            </div>
                                                                            <?php
                                                                                }
                                                                            ?>
                                                                            <label for="nilai" class="form-control-label">Upload Dokumen <?=$s->nama?></label>
                                                                            <input type="file" class="with-validation-filepond" name="file" <?php 
                                                                                if($i == 1){
                                                                            ?>
                                                                            accept=".pdf"
                                                                            <?php
                                                                                }else{
                                                                            ?> accept=".xlsx" <?php } ?> required>
                                                                            <button type="submit" class="btn btn-primary btn-sm">Upload</button>
                                                                        </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php $i++;} ?>
                                                    </div>
                                                    <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                                    <a href="<?= base_url() ?>bgh/pengajuan/bangunanbaru" type="button" class="action-button bg-warning text-dark simpan" onclick="confirm('Simpan Dahulu Progres Permohonan ?')" >Simpan</a>
                                                    <button type="button" class="action-button" id="nextstepdokbgh">Next Step</button>
                                                <input type="button" name="next" class="next action-button" id="nextdokbgh" value="Next Step" hidden />
                                            </fieldset>
                                            <fieldset id="stepsuccess">
                                                <input type="text" id="idpermohonanglobal" value="<?= (!empty($pengajuan)) ? $pengajuan->id:'0' ?>" hidden>
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
                                                            <h5>Permohonan BGH anda akan dicek terlebih dahulu. </h5>
                                                        </div>
                                                    </div>
                                                    <a href="<?= base_url('bgh/pengajuan/bangunanbaru') ?>">Lihat List Permonohonan</a>
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
    $(function(){
        $('#bangunanbaru-menu').addClass('active');

        if (step == "0") {
            $('#nextstep1').trigger('click');
        }else if(step == "1"){
            $('#nextstep1').trigger('click');
            $('#nextdokbgh').trigger('click');
        }

        $('#cek-pbg').click(function(){
            let no_pbg = $('#kodepbg').val();
            saverecommendedbgh(no_pbg);
        })

        // DOKBGH

        $('.formdokbgh').submit(function(e){
            e.preventDefault();

            let fd = new FormData(this);
            fd.append('id_permohonan', $('#idpermohonanglobal').val());
            $.ajax({
                url: '<?= base_url() ?>bgh/pengajuan/savedokbgh',
                type: 'POST',
                data: fd,
                processData:false,
                contentType:false,
                success: function(response) {
                    location.reload();
                },
                error: function(xhr, status, error) {
                // Handle the error
                }
            });
        })

        $('#nextstepdokbgh').click(function(){
            let id_permohonan = $('#idpermohonanglobal').val();
            $.ajax({
                type:'post',
                dataType: 'json',
                data: {id_permohonan: id_permohonan, step: 1},
                url: '<?= base_url()?>bgh/pengajuan/updatestep',
                success:function(response){
                    location.reload();
                }

            })
        })
    })

    function saverecommendedbgh(no_pbg)
    {
        $.ajax({
            type:'post',
            dataType:'json',
            data:{no_pbg:no_pbg},
            url:'<?= base_url()?>bgh/pengajuan/savepengajuanrecommended',
            success:function(response){
                if (response.code === 1) {
                    Swal.fire({
                        'icon':'success',
                        'title':'Berhasil',
                        'text': response.msg
                    }).then((res) => {
                        if (res.isConfirmed) {
                            $('#nextstep1').trigger('click');
                            $('#idpermohonanglobal').val(response.id_permohonan);
                        }else{
                            $('#nextstep1').trigger('click');
                            $('#idpermohonanglobal').val(response.id_permohonan);
                        }
                    })
                }else{
                    Swal.fire({
                        'icon':'error',
                        'title':'Gagal',
                        'text': response.msg
                    })
                }
            }
        })
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
</script>