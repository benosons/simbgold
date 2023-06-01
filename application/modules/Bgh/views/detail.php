<div class="page-content">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Detail Pengajuan BGH</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url() ?>index.html">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?= base_url() ?>index.html">Pengajuan BGH Bangunan Baru</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Detail
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
                <div class="card">
                    <div class="card-header">
                        <h5> 
                            <a href="<?= base_url('verifikator/pengajuan/bangunanbaru') ?>"><i class="fa fa-arrow-left me-3"></i></a><?= $permohonan->kode_bgh ?>
                            <span class="float-end">
                                <?php 
                                if ($permohonan->kategori == "mandatory") {
                                    if ($vfile == 0 && $vfilears == 0 && $vfilestruktur == 0 && $vfilemep == 0 && $permohonan->status != 3) {
                                        echo '<button class="btn btn-primary btn-sm verifikasipermohonan" data-id="' . $permohonan->id . '">Verifikasi Permohonan</button>';
                                    }
                                } else {
                                    if ($vfile == 0 && $permohonan->status != 3) {
                                        echo '<button class="btn btn-primary btn-sm verifikasipermohonan" data-id="' . $permohonan->id . '">Verifikasi Permohonan</button>';
                                    }
                                }
                                ?>
                            </span>
                    </h5>
                    </div>
                    <div class="card-body mt-4">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <?php 
                                $k = 'pemilik';
                                if (isset($_GET['k'])) {
                                    $k=$_GET['k'];
                                }
                            if($permohonan->kategori == "mandatory"){
                                ?>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link <?= $k == 'pemilik' ? 'active' : '' ?>" id="pemilik-tab" data-bs-toggle="tab" href="#pemilik" role="tab" aria-controls="pemilik" aria-selected="true">Data Bangunan dan Pemilik</a>
                            </li>
                            <?php } ?>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link <?= $k == 'home' ? 'active' : '' ?>" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Dokumen BGH</a>
                            </li>
                            <?php 
                            if ($permohonan->kategori == "mandatory") { ?>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link <?= $k == 'arsitektur' ? 'active' : '' ?>" id="arsitektur-tab" data-bs-toggle="tab" href="#arsitektur" role="tab" aria-controls="arsitektur" aria-selected="false">Dokumen Arsitektur</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link <?= $k == 'struktur' ? 'active' : '' ?>" id="struktur-tab" data-bs-toggle="tab" href="#struktur" role="tab" aria-controls="struktur" aria-selected="false">Dokumen Struktur</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link <?= $k == 'mep' ? 'active' : '' ?>" id="mep-tab" data-bs-toggle="tab" href="#mep" role="tab" aria-controls="mep" aria-selected="false">Dokumen MEP</a>
                            </li>
                            <?php } ?>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                        <?php if($permohonan->kategori == "mandatory"){ ?>
                                <div class="tab-pane p-3 fade show <?= $k == 'pemilik' ? 'active' : '' ?>" id="pemilik" role="tabpanel" aria-labelledby="pemilik-tab">
                                    <div class="row">
                                        <h5>Data Bangunan dan Pemilik</h5>
                                        <div class="col-md-6">
                                            <div class="card shadow">
                                                <div class="card-header">
                                                    <h6>Data Bangunan</h6>
                                                </div>
                                                <div class="card-body">
                                                    <table class="table table-borderless">
                                                        <tr>
                                                            <td width="40%">Kode BGH</td>
                                                            <td width="3%">:</td>
                                                            <td><?= $permohonan->kode_bgh ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="40%">Kode PBG</td>
                                                            <td width="3%">:</td>
                                                            <td><?= $permohonan->kode_pbg ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="40%">Nama Gedung</td>
                                                            <td width="3%">:</td>
                                                            <td><?= $permohonan->nama_gedung ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="40%">Jumlah Lantai</td>
                                                            <td width="3%">:</td>
                                                            <td><?= $permohonan->lantai ?> Lantai</td>
                                                        </tr>
                                                        <tr>
                                                            <td width="40%">Luas</td>
                                                            <td width="3%">:</td>
                                                            <td><?= $permohonan->luas_bangunan ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="40%">Klas Bangunan</td>
                                                            <td width="3%">:</td>
                                                            <td><?= $klas->klas ?></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card shadow">
                                                <div class="card-header">
                                                    <h6>Data Pemilik</h6>
                                                </div>
                                                <div class="card-body">
                                                    <table class="table table-borderless">
                                                        <tr>
                                                            <td width="40%">Nama Pemilik</td>
                                                            <td width="3%">:</td>
                                                            <td>
                                                                <?= $pemilik->glr_depan ?>.
                                                                <?= $pemilik->nm_pemilik ?>
                                                                <?= $pemilik->glr_belakang ?>.
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="40%">Nomor KTP</td>
                                                            <td width="3%">:</td>
                                                            <td><?= $pemilik->no_ktp ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="40%">Nomor Kitas</td>
                                                            <td width="3%">:</td>
                                                            <td><?= $pemilik->no_kitas ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="40%">Alamat</td>
                                                            <td width="3%">:</td>
                                                            <td><?= $pemilik->alamat ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="40%">Email</td>
                                                            <td width="3%">:</td>
                                                            <td><?= $pemilik->email ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="40%">Nomor Telepon</td>
                                                            <td width="3%">:</td>
                                                            <td><?= $pemilik->no_hp ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="40%">Unit Organisasi</td>
                                                            <td width="3%">:</td>
                                                            <td><?= $pemilik->unit_organisasi ?></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="tab-pane p-3 fade show <?= $k == 'home' ? 'active' : '' ?>" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <h5>Dokumen BGH</h5>
                                    <?php
                                    foreach ($syarat as $s) {
                                        foreach ($file as $f) {
                                            if ($f->id_syarat_bgh == $s->id) {
                                    ?>
                                                <div class="col-md-4">
                                                    <div class="card shadow">
                                                        <div class="card-header">
                                                        <?php 
                                                            if ($f->verifikasi == 1 && $f->new == 0) {
                                                                echo '<span class="badge bg-danger p-1" style="white-space:normal !important;">Perlu Revisi</span>';
                                                            }else if($f->verifikasi == 1 && $f->new == 1){
                                                                echo '<span class="badge bg-warning p-1" style="white-space:normal !important;">Telah Diperbaiki</span>';
                                                            }else if($f->verifikasi == 0 && $f->new == 0){
                                                                echo '<span class="badge bg-primary p-1" style="white-space:normal !important;">Perlu Tinjauan</span>';
                                                            } else if($f->verifikasi == 2){
                                                                echo '<span class="badge bg-success p-1" style="white-space:normal !important;"><i class="fa fa-check me-1"></i>Terverifikasi</span>';
                                                            }
                                                        ?>
                                                        </div>
                                                        <div class="card-body">
                                                            <h6>
                                                                <?= $s->nama ?>
                                                            </h6>
                                                            <a href="<?= base_url('assets/bgh/files/'.$permohonan->id.'/dokbgh/' . $f->file) ?>" target="_blank"><i class="fa fa-download"></i> Lihat File</a>
                                                            <small class="text-muted d-block"><em>Last Updated : <?= $f->update_date ?></em></small>
                                                        </div>
                                                        <?php if ($f->verifikasi == 0) { ?>
                                                            <div class="card-footer">
                                                                <a href="javascript:void(0)" class="d-block revisidokumen" data-url="revisidokumen/1/<?= $f->id ?>/<?= $permohonan->id ?>/<?= $permohonan->kode_bgh ?>"><i class="fa fa-edit"></i> Revisi Dokumen ini</a>
                                                                <a href="javascript:void(0)" class="d-block verifikasidokumen" data-url="verifikasidokumen/1/<?= $f->id ?>/<?= $permohonan->kode_bgh ?>"><i class="fa fa-check"></i> Verifikasi Dokumen ini</a>
                                                            </div>
                                                        <?php } else if ($f->verifikasi == 1) { ?>
                                                            <div class=" card-footer">
                                                                <a href="javascript:void(0)" class="d-block verifikasidokumen" data-url="verifikasidokumen/1/<?= $f->id ?>/<?= $permohonan->kode_bgh ?>"><i class="fa fa-check"></i> Verifikasi Dokumen ini</a>
                                                                <a href="javascript:void(0)" class="d-block revisidokumen" data-url="revisidokumen/1/<?= $f->id ?>/<?= $permohonan->id ?>/<?= $permohonan->kode_bgh ?>"><i class="fa fa-edit"></i>Edit Revisi</a>
                                                                Catatan Revisi :
                                                                <p>
                                                                    <?= $f->catatan ?>
                                                                </p>
                                                                <small class="text-muted">
                                                                Waktu Revisi : <?=   date('d-m-Y H:i', strtotime($f->date_catatan)) ?> WIB
                                                                </small>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                    <?php }
                                        }
                                    } ?>
                                </div>
                            </div>
                        <?php if ($permohonan->kategori == "mandatory") { ?>
                            <div class="tab-pane p-3 fade show <?= $k == 'arsitektur' ? 'active' : '' ?>" id="arsitektur" role="tabpanel" aria-labelledby="arsitektur-tab">
                                <div class="row">
                                    <h5>Dokumen Arsitektur</h5>
                                    <?php
                                    foreach ($sarsitektur as $sa) {
                                        foreach ($filears as $fa) {
                                            if ($fa->id_syarat_bgh == $sa->id) {
                                                ?>
                                                <div class="col-md-4">
                                                    <div class="card shadow">
                                                        <div class="card-header">
                                                        <?php 
                                                            if ($fa->verifikasi == 1 && $fa->new == 0) {
                                                                echo '<span class="badge bg-danger p-1" style="white-space:normal !important;">Perlu Revisi</span>';
                                                            }else if($fa->verifikasi == 1 && $fa->new == 1){
                                                                echo '<span class="badge bg-warning p-1" style="white-space:normal !important;">Telah Diperbaiki</span>';
                                                            }else if($fa->verifikasi == 0 && $fa->new == 0){
                                                                echo '<span class="badge bg-primary p-1" style="white-space:normal !important;">Perlu Tinjauan</span>';
                                                            } else if($fa->verifikasi == 2){
                                                                echo '<span class="badge bg-success p-1" style="white-space:normal !important;"><i class="fa fa-check" me-1></i> Terverifikasi</span>';
                                                            }
                                                        ?>
                                                        </div>
                                                        <div class="card-body">
                                                            <h6><?= $sa->nama ?></h6>
                                                            <a href="<?= base_url('assets/bgh/files/'.$permohonan->id.'/dokarsitektur/' . $fa->file) ?>" target="_blank"><i class="fa fa-download"></i> Lihat File</a>
                                                            <small class="text-muted d-block"><em>Last Updated : <?= $fa->update_date ?></em></small>
                                                        </div>
                                                        <?php if ($fa->verifikasi == 0) { ?>
                                                            <div class="card-footer">
                                                                <a href="javascript:void(0)" class="d-block revisidokumen" data-url="revisidokumen/2/<?= $fa->id ?>/<?= $permohonan->id ?>/<?= $permohonan->kode_bgh ?>"><i class="fa fa-edit"></i> Revisi Dokumen ini</a>
                                                                <a href="javascript:void(0)" class="d-block verifikasidokumen" data-url="verifikasidokumen/2/<?= $fa->id ?>/<?= $permohonan->kode_bgh ?>"><i class="fa fa-check"></i> Verifikasi Dokumen ini</a>
                                                            </div>
                                                        <?php } else if ($fa->verifikasi == 1) { ?>
                                                            <div class=" card-footer">
                                                                <a href="javascript:void(0)" class="d-block verifikasidokumen" data-url="verifikasidokumen/2/<?= $fa->id ?>/<?= $permohonan->kode_bgh ?>"><i class="fa fa-check"></i> Verifikasi Dokumen ini</a>
                                                                <a href="javascript:void(0)" class="d-block revisidokumen" data-url="revisidokumen/2/<?= $fa->id ?>/<?= $permohonan->id ?>/<?= $permohonan->kode_bgh ?>"><i class="fa fa-edit"></i>Edit Revisi</a>
                                                                Catatan Revisi :
                                                                <p>
                                                                    <?= $fa->catatan ?>
                                                                </p>
                                                                <small class="text-muted">
                                                                Waktu Revisi : <?=   date('d-m-Y H:i', strtotime($fa->date_catatan)) ?> WIB
                                                                </small>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                    <?php }
                                        }
                                    } ?>
                                </div>
                            </div>
                            <div class="tab-pane p-3 fade show <?= $k == 'struktur' ? 'active' : '' ?>" id="struktur" role="tabpanel" aria-labelledby="struktur-tab">
                                <div class="row">
                                    <h5>Dokumen Struktur</h5>
                                    <?php
                                    foreach ($sstruktur as $ss) {
                                        foreach ($filestruktur as $fs) {
                                            if ($fs->id_syarat_bgh == $ss->id) {
                                                ?>
                                                <div class="col-md-4">
                                                    <div class="card shadow">
                                                    <div class="card-header">
                                                        <?php 
                                                            if ($fs->verifikasi == 1 && $fs->new == 0) {
                                                                echo '<span class="badge bg-danger p-1" style="white-space:normal !important;">Perlu Revisi</span>';
                                                            }else if($fs->verifikasi == 1 && $fs->new == 1){
                                                                echo '<span class="badge bg-warning p-1" style="white-space:normal !important;">Telah Diperbaiki</span>';
                                                            }else if($fs->verifikasi == 0 && $fs->new == 0){
                                                                echo '<span class="badge bg-primary p-1" style="white-space:normal !important;">Perlu Tinjauan</span>';
                                                            } else if($fs->verifikasi == 2){
                                                                echo '<span class="badge bg-success p-1" style="white-space:normal !important;"><i class="fa fa-check me-1"></i>Terverifikasi</span>';
                                                            }
                                                        ?>
                                                        </div>
                                                        <div class="card-body">
                                                            <h6><?= $ss->nama ?></h6>
                                                            <a href="<?= base_url('assets/bgh/files/'.$permohonan->id.'/dokstruktur/' . $fs->file) ?>" target="_blank"><i class="fa fa-download"></i> Lihat File</a>
                                                            <small class="text-muted d-block"><em>Last Updated : <?= $fs->update_date ?></em></small>
                                                        </div>
                                                        <?php if ($fs->verifikasi == 0) { ?>
                                                            <div class="card-footer">
                                                                <a href="javascript:void(0)" class="d-block revisidokumen" data-url="revisidokumen/3/<?= $fs->id ?>/<?= $permohonan->id ?>/<?= $permohonan->kode_bgh ?>"><i class="fa fa-edit"></i> Revisi Dokumen ini</a>
                                                                <a href="javascript:void(0)" class="d-block verifikasidokumen" data-url="verifikasidokumen/3/<?= $fs->id ?>/<?= $permohonan->kode_bgh ?>"><i class="fa fa-check"></i> Verifikasi Dokumen ini</a>
                                                            </div>
                                                        <?php } else if ($fs->verifikasi == 1) { ?>
                                                            <div class=" card-footer">
                                                                <a href="javascript:void(0)" class="d-block verifikasidokumen" data-url="verifikasidokumen/3/<?= $fs->id ?>/<?= $permohonan->kode_bgh ?>"><i class="fa fa-check"></i> Verifikasi Dokumen ini</a>
                                                                <a href="javascript:void(0)" class="d-block revisidokumen" data-url="revisidokumen/3/<?= $fs->id ?>/<?= $permohonan->id ?>/<?= $permohonan->kode_bgh ?>"><i class="fa fa-edit"></i>Edit Revisi</a>
                                                                Catatan Revisi :
                                                                <p>
                                                                    <?= $fs->catatan ?>
                                                                </p>
                                                                <small class="text-muted">
                                                                Waktu Revisi : <?=   date('d-m-Y H:i', strtotime($fs->date_catatan)) ?> WIB
                                                                </small>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                    <?php }
                                        }
                                    } ?>
                                </div>
                            </div>
                            <div class="tab-pane p-3 fade show <?= $k == 'mep' ? 'active' : '' ?>" id="mep" role="tabpanel" aria-labelledby="mep-tab">
                                <div class="row">
                                    <h5>Dokumen MEP</h5>
                                    <?php
                                    foreach ($smep as $sm) {
                                        foreach ($filemep as $fm) {
                                            if ($fm->id_syarat_bgh == $sm->id) {
                                    ?>
                                                <div class="col-md-4">
                                                    <div class="card shadow">
                                                    <div class="card-header">
                                                        <?php 
                                                            if ($fm->verifikasi == 1 && $fm->new == 0) {
                                                                echo '<span class="badge bg-danger p-1" style="white-space:normal !important;">Perlu Revisi</span>';
                                                            }else if($fm->verifikasi == 1 && $fm->new == 1){
                                                                echo '<span class="badge bg-warning p-1" style="white-space:normal !important;">Telah Diperbaiki</span>';
                                                            }else if($fm->verifikasi == 0 && $fm->new == 0){
                                                                echo '<span class="badge bg-primary p-1" style="white-space:normal !important;">Perlu Tinjauan</span>';
                                                            } else if($fm->verifikasi == 2){
                                                                echo '<span class="badge bg-success p-1" style="white-space:normal !important;"><i class="fa fa-check me-1"></i>Terverifikasi</span>';
                                                            }
                                                        ?>
                                                        </div>
                                                        <div class="card-body">
                                                            <h6><?= $sm->nama ?></h6>
                                                            <a href="<?= base_url('assets/bgh/files/'.$permohonan->id.'/dokmep/' . $fm->file) ?>" target="_blank"><i class="fa fa-download"></i> Lihat File</a>
                                                            <small class="text-muted d-block"><em>Last Updated : <?= $fm->update_date ?></em></small>
                                                        </div>
                                                        <?php if ($fm->verifikasi == 0) { ?>
                                                            <div class="card-footer">
                                                                <a href="javascript:void(0)" class="d-block revisidokumen" data-url="revisidokumen/4/<?= $fm->id ?>/<?= $permohonan->id ?>/<?= $permohonan->kode_bgh ?>"><i class="fa fa-edit"></i> Revisi Dokumen ini</a>
                                                                <a href="javascript:void(0)" class="d-block verifikasidokumen" data-url="verifikasidokumen/4/<?= $fm->id ?>/<?= $permohonan->kode_bgh ?>"><i class="fa fa-check"></i> Verifikasi Dokumen ini</a>
                                                            </div>
                                                        <?php } else if ($fm->verifikasi == 1) { ?>
                                                            <div class=" card-footer">
                                                                <a href="javascript:void(0)" class="d-block verifikasidokumen" data-url="verifikasidokumen/4/<?= $fm->id ?>/<?= $permohonan->kode_bgh ?>"><i class="fa fa-check"></i> Verifikasi Dokumen ini</a>
                                                                <a href="javascript:void(0)" class="d-block revisidokumen" data-url="revisidokumen/4/<?= $fm->id ?>/<?= $permohonan->id ?>/<?= $permohonan->kode_bgh ?>"><i class="fa fa-edit"></i>Edit Revisi</a>
                                                                Catatan Revisi :
                                                                <p>
                                                                    <?= $fm->catatan ?>
                                                                </p>
                                                                <small class="text-muted">
                                                                Waktu Revisi : <?= date('d-m-Y H:i', strtotime($fm->date_catatan)) ?> WIB
                                                                </small>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                    <?php }
                                        }
                                    } ?>
                                </div>
                            </div>
                        </div>
                            <?php

                        } ?>
                    </div>
                </div>
            </div>
        </div>

    </section>


    <div class="modal fade text-left modal-borderless" id="border-less" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Revisi</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" id="urlrevisi" hidden>
                        <label for="catatan" class="form-control-label">Catatan Revisi</label>
                        <textarea name="" id="catatan" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                    <button class="btn btn-primary btn-sm" id="btn-revisi-submit">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Basic Tables end -->
</div>

<script>
    $(function(){
        $('#bangunanbaru-menu').addClass('active');
        $(document).on('click', '.edit-permohonan', function(){
            let url = $(this).data('url');
            let label = $(this).data('label');
            let dok = $(this).data('dok');

            $('#urleditpermohonan').val(url);
            $('#label-dokumen').html(label);
            $('#input-dok').html('<input type="file" name="file-edit" class="form-control" accept=".'+dok+'" required>');
            $('#modaleditpermohonan').modal('show');
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
    })
</script>