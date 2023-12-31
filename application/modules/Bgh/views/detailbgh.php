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
                            <a href="<?= base_url('bgh/') ?>">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('bgh/') ?>">Pengajuan BGH Bangunan Baru</a>
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
                        <h5> <a href="<?= base_url('bgh/pengajuan/bangunanbaru') ?>"><i class="fa fa-arrow-left me-3"></i></a> <?= $permohonan->kode_bgh ?> <span class="badge bg-success float-end"><?= ucfirst($permohonan->kategori) ?></span></h5>
                    </div>
                    <div class="card-body mt-4">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <?php 
                                $k = 'pemilik';
                                if (isset($_GET['k'])) {
                                    $k=$_GET['k'];
                                }
                            ?>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link <?= $k == 'pemilik' ? 'active' : '' ?>" id="pemilik-tab" data-bs-toggle="tab" href="#pemilik" role="tab" aria-controls="pemilik" aria-selected="true">Data Bangunan <?= ($permohonan->kategori == "mandatory") ? 'dan Data Pemilik':''?></a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link <?= $k == 'home' ? 'active' : '' ?>" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Dokumen BGH</a>
                            </li>
                            <?php if ($permohonan->kategori == "mandatory") { ?>
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
                            <?php }else{ ?>
                                <div class="tab-pane p-3 fade show <?= $k == 'pemilik' ? 'active' : '' ?>" id="pemilik" role="tabpanel" aria-labelledby="pemilik-tab">
                                    <div class="row">
                                        <h5>Data Bangunan </h5>
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
                                    $i = 1;
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
                                                            <h6><?= $s->nama ?></h6>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <?php 
                                                                        if($i != 1){
                                                                            echo "                                                                    <p>
                                                                                Nilai : ".$f->nilai." ".$s->satuan."</p>";
                                                                        }
                                                                    ?>
                                                                    <a target="_blank" href="<?= base_url('assets/bgh/files/'.$permohonan->id.'/dokbgh/' . $f->file) ?>"><i class="fa fa-download"></i> Lihat File</a>
                                                                </div>
                                                                <div class="col-6">
                                                                    <?php
                                                                        if ($f->verifikasi == 1 && $f->new == 0) {
                                                                            $ext = explode('.', $f->file);
                                                                            echo '<a href="javascript:;" class="link-primary edit-permohonan" data-url="editpermohonan/1/'.$f->id.'/'.$permohonan->id.'/'.$permohonan->kode_bgh.'" data-label="'.$s->nama.'" data-dok="'.$ext[1].'">| <i class="fa fa-pen"></i> Edit</a>';
                                                                        }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <small class="text-muted d-block mt-3"><em>Waktu Upload : <?= $f->update_date ?> </em></small>
                                                        </div>
                                                        <?php 
                                                            if ($f->verifikasi == 1) {
                                                        ?>
                                                            <div class=" card-footer">
                                                                Catatan Revisi :
                                                                <p>
                                                                    <?= $f->catatan ?>
                                                                </p>
                                                                <small class="text-muted">
                                                                Waktu Revisi : <?=   date('d-m-Y H:i', strtotime($f->date_catatan)) ?> WIB
                                                                </small>
                                                            </div>
                                                        <?php
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                    <?php }
                                        $i++;}
                                    } ?>
                                </div>
                            </div>
                        <?php if ($permohonan->kategori == "mandatory") { ?>
                            <div class="tab-pane p-3 fade show <?= $k == 'arsitektur' ? 'active' : '' ?>" id="arsitektur" role="tabpanel" aria-labelledby="arsitektur-tab">
                                <div class="row">
                                    <h5>Dokumen Arsitektur</h5>
                                    <?php
                                    if (isset($sarsitektur)) {
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
                                                                echo '<span class="badge bg-success p-1" style="white-space:normal !important;"><i class="fa fa-check me-1"></i>Terverifikasi</span>';
                                                            }
                                                        ?>
                                                        </div>
                                                        <div class="card-body">
                                                            <h6><?= $sa->nama ?></h6>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <a target="_blank" href="<?= base_url('assets/bgh/files/'.$permohonan->id.'/dokarsitektur/' . $fa->file) ?>"><i class="fa fa-download"></i> Lihat File</a>
                                                                </div>
                                                                <div class="col-6">
                                                                    <?php
                                                                        if ($fa->verifikasi == 1 && $fa->new == 0) {
                                                                            $ext = explode('.', $fa->file);
                                                                            echo '<a href="javascript:;" class="link-primary edit-permohonan" data-url="editpermohonan/2/'.$fa->id.'/'.$permohonan->id.'/'.$permohonan->kode_bgh.'" data-label="'.$sa->nama.'" data-dok="'.$ext[1].'">| <i class="fa fa-pen"></i> Edit</a>';
                                                                        }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <small class="text-muted d-block mt-3"><em>Waktu Upload : <?= $fa->update_date ?> </em></small>
                                                        </div>
                                                        <?php 
                                                            if ($fa->verifikasi == 1) {
                                                        ?>
                                                            <div class=" card-footer">
                                                                Catatan Revisi :
                                                                <p>
                                                                    <?= $fa->catatan ?>
                                                                </p>
                                                                <small class="text-muted">
                                                                Waktu Revisi : <?=   date('d-m-Y H:i', strtotime($fa->date_catatan)) ?> WIB
                                                                </small>
                                                            </div>
                                                        <?php
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                    <?php }
                                            }
                                        }
                                    } ?>
                                </div>
                            </div>
                            <div class="tab-pane p-3 fade show <?= $k == 'struktur' ? 'active' : '' ?>" id="struktur" role="tabpanel" aria-labelledby="struktur-tab">
                                <div class="row">
                                    <h5>Dokumen Struktur</h5>
                                    <?php
                                    if (isset($sstruktur)) {
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
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <a target="_blank" href="<?= base_url('assets/bgh/files/'.$permohonan->id.'/dokstruktur/' . $fs->file) ?>"><i class="fa fa-download"></i> Lihat File</a>
                                                                </div>
                                                                <div class="col-6">
                                                                    <?php
                                                                        if ($fs->verifikasi == 1 && $fs->new == 0) {
                                                                            $ext = explode('.', $fs->file);
                                                                            echo '<a href="javascript:;" class="link-primary edit-permohonan" data-url="editpermohonan/3/'.$fs->id.'/'.$permohonan->id.'/'.$permohonan->kode_bgh.'" data-label="'.$ss->nama.'" data-dok="'.$ext[1].'">| <i class="fa fa-pen"></i> Edit</a>';
                                                                        }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <small class="text-muted d-block mt-3"><em>Waktu Upload : <?= $fs->update_date ?> </em></small>
                                                        </div>
                                                        <?php 
                                                            if ($fs->verifikasi == 1) {
                                                        ?>
                                                            <div class=" card-footer">
                                                                Catatan Revisi :
                                                                <p>
                                                                    <?= $fs->catatan ?>
                                                                </p>
                                                                <small class="text-muted">
                                                                Waktu Revisi : <?=   date('d-m-Y H:i', strtotime($fs->date_catatan)) ?> WIB
                                                                </small>
                                                            </div>
                                                        <?php
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                    <?php }
                                            }
                                        }
                                    } ?>
                                </div>
                            </div>
                            <div class="tab-pane p-3 fade show <?= $k == 'mep' ? 'active' : '' ?>" id="mep" role="tabpanel" aria-labelledby="mep-tab">
                                <div class="row">
                                    <h5>Dokumen MEP</h5>
                                    <?php
                                    if (isset($smep)) {
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
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <a target="_blank" href="<?= base_url('assets/bgh/files/'.$permohonan->id.'/dokmep/' . $fm->file) ?>"><i class="fa fa-download"></i> Lihat File</a>
                                                                </div>
                                                                <div class="col-6">
                                                                    <?php
                                                                        if ($fm->verifikasi == 1 && $fm->new == 0) {
                                                                            $ext = explode('.', $fm->file);
                                                                            echo '<a href="javascript:;" class="link-primary edit-permohonan" data-url="editpermohonan/4/'.$fm->id.'/'.$permohonan->id.'/'.$permohonan->kode_bgh.'" data-label="'.$sm->nama.'" data-dok="'.$ext[1].'">| <i class="fa fa-pen"></i> Edit</a>';
                                                                        }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <small class="text-muted d-block mt-3"><em>Waktu Upload : <?= $fm->update_date ?> </em></small>
                                                        </div>
                                                        <?php 
                                                            if ($fm->verifikasi == 1) {
                                                        ?>
                                                            <div class=" card-footer">
                                                                Catatan Revisi :
                                                                <p>
                                                                    <?= $fm->catatan ?>
                                                                </p>
                                                                <small class="text-muted">
                                                                Waktu Revisi : <?=   date('d-m-Y H:i', strtotime($fm->date_catatan)) ?> WIB
                                                                </small>
                                                            </div>
                                                        <?php
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                    <?php }
                                            }
                                        }
                                    } ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
</div>

<div class="modal fade text-left modal-borderless" id="modaleditpermohonan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Edit Permohonan</h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="formeditpermohonan">
                    <div class="form-group">
                        <input type="text" id="urleditpermohonan" hidden>
                        <label for="catatan" class="form-control-label" id="label-dokumen"></label>
                        <div id="input-dok">
                            
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm" id="btn-edit-submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
                                    
<script>
    $(function(){
        $('#bangunanbaru-menu').addClass('active');
        
    })
    
    
</script>