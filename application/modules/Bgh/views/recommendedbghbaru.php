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
                                        <form id="msform" enctype="multipart/form-data">
                                            <!-- progressbar -->
                                            <ul id="progressbar" class="d-flex justify-content-center">
                                                <li class="active" id="account"><strong>Cek Permohonan PBG</strong></li>
                                                <li id="personal"><strong>Upload Dokumen BGH</strong></li>
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
                                                                    <input type="text" class="form-control" id="kodepbg" name="kodepbg" value="PBG-1234-5678">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="button" name="next" class="next action-button" value="Next Step" />
                                            </fieldset>
                                            <fieldset>
                                                <div class="row p-3">
                                                    <?php
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
                                                                        <input type="file" class="with-validation-filepond" name="dokbgh[]" id="dokumen-pembuktian-bgh" required data-max-file-size="1MB">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <!-- <div class="col-md-6">
                                                        <div class="card shadow">
                                                            <div class="card-header">
                                                                <h5 class="card-title">Dokumen OTTV</h5>
                                                                <small><em>File yang diperbolehkan hanya file yang berekstensi XLXS</em></small>
                                                            </div>
                                                            <div class="card-content">
                                                                <div class="card-body">
                                                                    <input type="file" class="with-validation-filepond" id="dokumen-ottv" required multiple data-max-file-size="1MB" data-max-files="1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="card shadow">
                                                            <div class="card-header">
                                                                <h5 class="card-title">Dokumen Kalkulator Neraca Air</h5>
                                                                <small><em>File yang diperbolehkan hanya file yang berekstensi XLXS</em></small>
                                                            </div>
                                                            <div class="card-content">
                                                                <div class="card-body">
                                                                    <input type="file" class="with-validation-filepond" id="dokumen-neraca-air" required multiple data-max-file-size="1MB" data-max-files="1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="card shadow">
                                                            <div class="card-header">
                                                                <h5 class="card-title">Dokumen Kalkulator Energi</h5>
                                                                <small><em>File yang diperbolehkan hanya file yang berekstensi XLXS</em></small>
                                                            </div>
                                                            <div class="card-content">
                                                                <div class="card-body">
                                                                    <input type="file" class="with-validation-filepond" id="dokumen-energi" required multiple data-max-file-size="1MB" data-max-files="1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                </div>
                                                <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                                <button class="action-button" type="submit" id="submitrecomm">Confirm</button>
                                                <input type="button" name="make_payment" class="next action-button" id="confirmrecomm" value="Confirm" hidden />
                                            </fieldset>
                                            <fieldset>
                                                <input type="text" id="idpermohonanglobal" hidden>
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
                                        </form>
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

<script>
    $(function(){
        $('#bangunanbaru-menu').addClass('active');
    })
</script>