<div class="page-content">
    
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
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#border-less"> <i class="fa fa-plus"></i> Ajukan Sertifikasi BGH Baru</button>
                                    </div>
                                    <div class="card-body">
                                        <table class="table" id="table1">
                                            <thead>
                                                <tr>
                                                    <th>Nomor BGH</th>
                                                    <th>Nomor PBG</th>
                                                    <th>Nama Gedung</th>
                                                    <th>Nama Pemilik</th>
                                                    <th>Kategori</th>
                                                    <th>Info</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                           <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <h5 class="mt-3">Soon !</h5>
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <h5 class="mt-3">Soon !</h5>
                            </div>
                            <div class="tab-pane fade" id="bongkar" role="tabpanel" aria-labelledby="bongkar-tab">
                                <h5 class="mt-3">Soon !</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- Basic Tables end -->
</div>

<!-- Modal -->
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
                <a href="<?= base_url('Bgh/mandatorybghbaru') ?>" class="btn btn-primary d-block mb-3">Belum Melakukan Permohonan PBG</a>
                <a href="<?= base_url('Bgh/recommendedbghbaru') ?>" class="btn btn-primary d-block">Sudah Melakukan Permohonan PBG</a>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

<script src="<?= base_url() ?>assets/bgh/vendors/jquery-datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/bgh/vendors/jquery-datatables/custom.jquery.dataTables.bootstrap5.min.js"></script>

<script>
    $(()=>{
        $('#permohonan-menu').addClass('active');

        $('#table1').DataTable();
    })
</script>