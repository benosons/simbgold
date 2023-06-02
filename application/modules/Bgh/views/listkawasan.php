<div class="page-content">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Pengajuan Sertifikasi Bangunan Gedung Hijau Kawasan Hijau</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('bgh/') ?>">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Pengajuan BGH Kawasan Hijau
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
                                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Kawasan Hijau</a>
                            </li>
                            <!-- <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Tahap Pelaksanaan</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Tahap Pemanfaatan</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="bongkar-tab" data-bs-toggle="tab" href="#bongkar" role="tab" aria-controls="bongkar" aria-selected="false">Tahap Pembongkaran</a>
                            </li> -->
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <?= ($this->session->userdata('loc_role_id') == 10) ? '<a href="'.base_url().'bgh/pengajuan/formkawasanhijau" class="btn btn-primary btn-sm"> <i class="fa fa-plus"></i> Ajukan Sertifikasi BGH Kawasan Hijau</a>' : '' ?>
                                    </div>
                                    <div class="card-body">
                                    <table class="table" id="table1">
                                            <thead>
                                                <tr>
                                                    <th>Nomor BGH</th>
                                                    <th>Info</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($list as $l) { ?>
                                                    <tr>
                                                        <td><?= $l->kode_bgh ?></td>
                                                        <td>
                                                            <div class="card shadow">
                                                                <div class="card-body">
                                                                    <p>
                                                                        <i class="fa fa-calendar"></i>
                                                                        <?= date('d-m-Y', strtotime($l->create_date)) ?>
                                                                    </p>
                                                                    <p>
                                                                        <?php 
                                                                             if ($l->status == 0) {
                                                                                if ($l->step == 0) {
                                                                                    echo '<span class="badge bg-primary p-2">Perlu Mengisi Dokumen Dukungan BGH</span>';
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

<script>
    $(function(){
        $('#kawasan-menu').addClass('active');
        $('#table1').DataTable();
    })
</script>
