<div class="page-content">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Pengajuan Sertifikasi Bangunan Gedung Hijau</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('bgh/') ?>">Dashboard</a>
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
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Tahap Perencanaan</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Tahap Pelaksanaan</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Tahap Pemanfaatan</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="bongkar-tab" data-bs-toggle="tab" href="#bongkar" role="tab" aria-controls="bongkar" aria-selected="false">Tahap Pembongkaran</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <?= ($this->session->userdata('loc_role_id') == 10) ? '<button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#border-less"> <i class="fa fa-plus"></i> Ajukan Sertifikasi BGH Baru</button>' : '' ?>
                                    </div>
                                    <div class="card-body">
                                    <table class="table" id="table1">
                                            <thead>
                                                <tr>
                                                    <th>Nomor Pengajuan</th>
                                                    <th>Nomor PBG</th>
                                                    <th>Nama Gedung</th>
                                                    <th>Nama Pemilik</th>
                                                    <th>Kategori</th>
                                                    <th>Info</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($list as $l) { ?>
                                                    <tr>
                                                        <td>P<?= $l->kode_bgh ?></td>
                                                        <td><?= $l->kode_pbg ?></td>
                                                        <td>
                                                            <?= $l->nama_gedung ?>
                                                        </td>
                                                        <td>
                                                            <?= $l->nm_pemilik ?>
                                                        </td>
                                                        <td>
                                                            <?= ucfirst($l->kategori) ?>
                                                        </td>
                                                        <td>
                                                            <div class="card shadow">
                                                                <div class="card-body">
                                                                    <p>
                                                                        Lantai : <?= $l->lantai ?> Lantai
                                                                    </p>
                                                                    <p>
                                                                        Luas : <?= $l->luas_bangunan ?> m<sup>2</sup>
                                                                    </p>
                                                                    <p>
                                                                        Klas Bangunan : <?= $l->klas ?>
                                                                    </p>
                                                                    <p>
                                                                        <i class="fa fa-calendar"></i>
                                                                        <?= date('d-m-Y', strtotime($l->create_date)) ?>
                                                                    </p>
                                                                    <p>
                                                                    <?php
                                                                        if ($l->status == 0) {
                                                                            if ($l->step == 0) {
                                                                                echo '<span class="badge bg-primary p-2">Perlu Mengisi Dokumen Dukungan BGH</span>';
                                                                            }else if($l->step == 1){
                                                                                echo '<span class="badge bg-primary p-2">Perlu Mengisi Dokumen Arsitektur</span>';
                                                                            }else if($l->step == 2){
                                                                                echo '<span class="badge bg-primary p-2">Perlu Mengisi Dokumen Struktur</span>';
                                                                            }else if($l->step == 3){
                                                                                echo '<span class="badge bg-primary p-2">Perlu Mengisi Dokumen MEP</span>';
                                                                            }
                                                                        }else if ($l->status == 1) {
                                                                            echo '<span class="badge bg-info p-2">Pemeriksaan Dokumen</span>';
                                                                        } else if ($l->status == 2) {
                                                                            echo '<span class="badge bg-warning p-2">Perlu Direvisi</span>';
                                                                        } else {
                                                                            echo '<span class="badge bg-success p-2">Sertifikat Terbit</span>';
                                                                        }
                                                                    ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="bi bi-list dropdown-icon "></i>
                                                            </button>
                                                            <?php if($l->step >= 4){ ?>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                                                                <?php 
                                                                        if($this->session->userdata('loc_role_id') == 10){
                                                                            echo '<a class="dropdown-item" href="'.base_url().'bgh/pengajuan/detailbgh/'.$l->kode_bgh.'">Detail</a>';
                                                                        }else{
                                                                            echo '<a class="dropdown-item" href="'.base_url().'bgh/pengajuan/detailbghverifikator/'.$l->kode_bgh.'">Detail</a>';
                                                                        }
                                                                    }else{
                                                                        if($this->session->userdata('loc_role_id') == 10){
                                                                            echo '<a class="dropdown-item" href="'.base_url().'bgh/pengajuan/mandatorybghbaru/'.$l->kode_bgh.'">Lanjutkan Proses Pendaftaran</a>';
                                                                        }
                                                                ?>
                                                            </div>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <?= ($this->session->userdata('loc_role_id') == 10) ? '<button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#border-less"> <i class="fa fa-plus"></i> Ajukan Sertifikasi BGH Baru</button>' : '' ?>
                                    </div>
                                    <div class="card-body">
                                    <table class="table" id="table1">
                                            <thead>
                                                <tr>
                                                    <th>Nomor Pengajuan</th>
                                                    <th>Nomor PBG</th>
                                                    <th>Nama Gedung</th>
                                                    <th>Nama Pemilik</th>
                                                    <th>Kategori</th>
                                                    <th>Info</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($list as $l) { ?>
                                                    <tr>
                                                        <td>P<?= $l->kode_bgh ?></td>
                                                        <td><?= $l->kode_pbg ?></td>
                                                        <td>
                                                            <?= $l->nama_gedung ?>
                                                        </td>
                                                        <td>
                                                            <?= $l->nm_pemilik ?>
                                                        </td>
                                                        <td>
                                                            <?= ucfirst($l->kategori) ?>
                                                        </td>
                                                        <td>
                                                            <div class="card shadow">
                                                                <div class="card-body">
                                                                    <p>
                                                                        Lantai : <?= $l->lantai ?> Lantai
                                                                    </p>
                                                                    <p>
                                                                        Luas : <?= $l->luas_bangunan ?> m<sup>2</sup>
                                                                    </p>
                                                                    <p>
                                                                        Klas Bangunan : <?= $l->klas ?>
                                                                    </p>
                                                                    <p>
                                                                        <i class="fa fa-calendar"></i>
                                                                        <?= date('d-m-Y', strtotime($l->create_date)) ?>
                                                                    </p>
                                                                    <p>
                                                                    <?php
                                                                        if ($l->status == 0) {
                                                                            if ($l->step == 0) {
                                                                                echo '<span class="badge bg-primary p-2">Perlu Mengisi Dokumen Dukungan BGH</span>';
                                                                            }else if($l->step == 1){
                                                                                echo '<span class="badge bg-primary p-2">Perlu Mengisi Dokumen Arsitektur</span>';
                                                                            }else if($l->step == 2){
                                                                                echo '<span class="badge bg-primary p-2">Perlu Mengisi Dokumen Struktur</span>';
                                                                            }else if($l->step == 3){
                                                                                echo '<span class="badge bg-primary p-2">Perlu Mengisi Dokumen MEP</span>';
                                                                            }
                                                                        }else if ($l->status == 1) {
                                                                            echo '<span class="badge bg-info p-2">Pemeriksaan Dokumen</span>';
                                                                        } else if ($l->status == 2) {
                                                                            echo '<span class="badge bg-warning p-2">Perlu Direvisi</span>';
                                                                        } else {
                                                                            echo '<span class="badge bg-success p-2">Sertifikat Terbit</span>';
                                                                        }
                                                                    ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="bi bi-list dropdown-icon "></i>
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                                                                <?php 
                                                                    if($l->step >= 4){
                                                                        if($this->session->userdata('loc_role_id') == 10){
                                                                            echo '<a class="dropdown-item" href="'.base_url().'bgh/pengajuan/detailbgh/'.$l->kode_bgh.'">Detail</a>';
                                                                        }else{
                                                                            echo '<a class="dropdown-item" href="'.base_url().'bgh/pengajuan/detailbghverifikator/'.$l->kode_bgh.'">Detail</a>';
                                                                        }
                                                                    }else{
                                                                        if($this->session->userdata('loc_role_id') == 10){
                                                                            echo '<a class="dropdown-item" href="'.base_url().'bgh/pengajuan/mandatorybghbaru/'.$l->kode_bgh.'">Lanjutkan Proses Pendaftaran</a>';
                                                                        }
                                                                    }
                                                                ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <?= ($this->session->userdata('loc_role_id') == 10) ? '<button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#border-less"> <i class="fa fa-plus"></i> Ajukan Sertifikasi BGH Baru</button>' : '' ?>
                                    </div>
                                    <div class="card-body">
                                    <table class="table" id="table1">
                                            <thead>
                                                <tr>
                                                    <th>Nomor Pengajuan</th>
                                                    <th>Nomor PBG</th>
                                                    <th>Nama Gedung</th>
                                                    <th>Nama Pemilik</th>
                                                    <th>Kategori</th>
                                                    <th>Info</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($list as $l) { ?>
                                                    <tr>
                                                        <td>P<?= $l->kode_bgh ?></td>
                                                        <td><?= $l->kode_pbg ?></td>
                                                        <td>
                                                            <?= $l->nama_gedung ?>
                                                        </td>
                                                        <td>
                                                            <?= $l->nm_pemilik ?>
                                                        </td>
                                                        <td>
                                                            <?= ucfirst($l->kategori) ?>
                                                        </td>
                                                        <td>
                                                            <div class="card shadow">
                                                                <div class="card-body">
                                                                    <p>
                                                                        Lantai : <?= $l->lantai ?> Lantai
                                                                    </p>
                                                                    <p>
                                                                        Luas : <?= $l->luas_bangunan ?> m<sup>2</sup>
                                                                    </p>
                                                                    <p>
                                                                        Klas Bangunan : <?= $l->klas ?>
                                                                    </p>
                                                                    <p>
                                                                        <i class="fa fa-calendar"></i>
                                                                        <?= date('d-m-Y', strtotime($l->create_date)) ?>
                                                                    </p>
                                                                    <p>
                                                                    <?php
                                                                        if ($l->status == 0) {
                                                                            if ($l->step == 0) {
                                                                                echo '<span class="badge bg-primary p-2">Perlu Mengisi Dokumen Dukungan BGH</span>';
                                                                            }else if($l->step == 1){
                                                                                echo '<span class="badge bg-primary p-2">Perlu Mengisi Dokumen Arsitektur</span>';
                                                                            }else if($l->step == 2){
                                                                                echo '<span class="badge bg-primary p-2">Perlu Mengisi Dokumen Struktur</span>';
                                                                            }else if($l->step == 3){
                                                                                echo '<span class="badge bg-primary p-2">Perlu Mengisi Dokumen MEP</span>';
                                                                            }
                                                                        }else if ($l->status == 1) {
                                                                            echo '<span class="badge bg-info p-2">Pemeriksaan Dokumen</span>';
                                                                        } else if ($l->status == 2) {
                                                                            echo '<span class="badge bg-warning p-2">Perlu Direvisi</span>';
                                                                        } else {
                                                                            echo '<span class="badge bg-success p-2">Sertifikat Terbit</span>';
                                                                        }
                                                                    ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="bi bi-list dropdown-icon "></i>
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                                                                <?php 
                                                                    if($l->step >= 4){
                                                                        if($this->session->userdata('loc_role_id') == 10){
                                                                            echo '<a class="dropdown-item" href="'.base_url().'bgh/pengajuan/detailbgh/'.$l->kode_bgh.'">Detail</a>';
                                                                        }else{
                                                                            echo '<a class="dropdown-item" href="'.base_url().'bgh/pengajuan/detailbghverifikator/'.$l->kode_bgh.'">Detail</a>';
                                                                        }
                                                                    }else{
                                                                        if($this->session->userdata('loc_role_id') == 10){
                                                                            echo '<a class="dropdown-item" href="'.base_url().'bgh/pengajuan/mandatorybghbaru/'.$l->kode_bgh.'">Lanjutkan Proses Pendaftaran</a>';
                                                                        }
                                                                    }
                                                                ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="bongkar" role="tabpanel" aria-labelledby="bongkar-tab">
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <?= ($this->session->userdata('loc_role_id') == 10) ? '<button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#border-less"> <i class="fa fa-plus"></i> Ajukan Sertifikasi BGH Baru</button>' : '' ?>
                                    </div>
                                    <div class="card-body">
                                    <table class="table" id="table1">
                                            <thead>
                                                <tr>
                                                    <th>Nomor Pengajuan</th>
                                                    <th>Nomor PBG</th>
                                                    <th>Nama Gedung</th>
                                                    <th>Nama Pemilik</th>
                                                    <th>Kategori</th>
                                                    <th>Info</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($list as $l) { ?>
                                                    <tr>
                                                        <td>P<?= $l->kode_bgh ?></td>
                                                        <td><?= $l->kode_pbg ?></td>
                                                        <td>
                                                            <?= $l->nama_gedung ?>
                                                        </td>
                                                        <td>
                                                            <?= $l->nm_pemilik ?>
                                                        </td>
                                                        <td>
                                                            <?= ucfirst($l->kategori) ?>
                                                        </td>
                                                        <td>
                                                            <div class="card shadow">
                                                                <div class="card-body">
                                                                    <p>
                                                                        Lantai : <?= $l->lantai ?> Lantai
                                                                    </p>
                                                                    <p>
                                                                        Luas : <?= $l->luas_bangunan ?> m<sup>2</sup>
                                                                    </p>
                                                                    <p>
                                                                        Klas Bangunan : <?= $l->klas ?>
                                                                    </p>
                                                                    <p>
                                                                        <i class="fa fa-calendar"></i>
                                                                        <?= date('d-m-Y', strtotime($l->create_date)) ?>
                                                                    </p>
                                                                    <p>
                                                                    <?php
                                                                        if ($l->status == 0) {
                                                                            if ($l->step == 0) {
                                                                                echo '<span class="badge bg-primary p-2">Perlu Mengisi Dokumen Dukungan BGH</span>';
                                                                            }else if($l->step == 1){
                                                                                echo '<span class="badge bg-primary p-2">Perlu Mengisi Dokumen Arsitektur</span>';
                                                                            }else if($l->step == 2){
                                                                                echo '<span class="badge bg-primary p-2">Perlu Mengisi Dokumen Struktur</span>';
                                                                            }else if($l->step == 3){
                                                                                echo '<span class="badge bg-primary p-2">Perlu Mengisi Dokumen MEP</span>';
                                                                            }
                                                                        }else if ($l->status == 1) {
                                                                            echo '<span class="badge bg-info p-2">Pemeriksaan Dokumen</span>';
                                                                        } else if ($l->status == 2) {
                                                                            echo '<span class="badge bg-warning p-2">Perlu Direvisi</span>';
                                                                        } else {
                                                                            echo '<span class="badge bg-success p-2">Sertifikat Terbit</span>';
                                                                        }
                                                                    ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="bi bi-list dropdown-icon "></i>
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                                                                <?php 
                                                                    if($l->step >= 4){
                                                                        if($this->session->userdata('loc_role_id') == 10){
                                                                            echo '<a class="dropdown-item" href="'.base_url().'bgh/pengajuan/detailbgh/'.$l->kode_bgh.'">Detail</a>';
                                                                        }else{
                                                                            echo '<a class="dropdown-item" href="'.base_url().'bgh/pengajuan/detailbghverifikator/'.$l->kode_bgh.'">Detail</a>';
                                                                        }
                                                                    }else{
                                                                        if($this->session->userdata('loc_role_id') == 10){
                                                                            echo '<a class="dropdown-item" href="'.base_url().'bgh/pengajuan/mandatorybghbaru/'.$l->kode_bgh.'">Lanjutkan Proses Pendaftaran</a>';
                                                                        }
                                                                    }
                                                                ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
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

<div class="modal fade text-left modal-borderless" id="border-less" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <a href="<?= base_url('bgh/pengajuan/mandatorybghbaru') ?>" class="btn btn-primary d-block mb-3">Belum Melakukan Permohonan PBG</a>
                <a href="<?= base_url('bgh/pengajuan/recommendedbghbaru') ?>" class="btn btn-primary d-block">Sudah Melakukan Permohonan PBG</a>
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        $('#bangunanbaru-menu').addClass('active');
        $('#table1').DataTable();
    })
</script>
