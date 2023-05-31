<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <h3>List BGH</h3>
    </div>
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
                                        <div class="card-body">
                                            <table class="table" id="table1">
                                                <thead>
                                                    <tr>
                                                        <th>Nomor BGH</th>
                                                        <th>Kode Permohonan PBG</th>
                                                        <th>Status Permohonan BGH</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>RBGH-1234-5678</td>
                                                        <td>PBG-1234-5678</td>
                                                        <td>
                                                            <span class="badge bg-success p-2">Sertifikat Terbit</span>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="bi bi-list dropdown-icon "></i>
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                                                                <a class="dropdown-item" href="<?= base_url('admin/listbgh/detail') ?>">Detail</a>
                                                                <a class="dropdown-item" href="#">Lihat Sertifikat</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>RBGH-4544-9586</td>
                                                        <td>PBG-2321-1123</td>
                                                        <td>
                                                            <span class="badge bg-info p-2">Pemeriksaan Dokumen</span>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="bi bi-list dropdown-icon "></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="<?= base_url('admin/listbgh/detail') ?>">Detail</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>RBGH-9842-5436</td>
                                                        <td>PBG-4569-9982</td>
                                                        <td>
                                                            <span class="badge bg-warning p-2">Perlu Revisi Permohonan</span>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="bi bi-list dropdown-icon "></i>
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                                                                <a class="dropdown-item" href="<?= base_url('admin/listbgh/detail') ?>">Detail</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
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

    <!-- <footer>
          <div class="footer clearfix mb-0 text-muted">
            <div class="float-start">
              <p>2021 &copy; Mazer</p>
            </div>
            <div class="float-end">
              <p>
                Crafted with
                <span class="text-danger"><i class="bi bi-heart"></i></span> by
                <a href="http://ahmadsaugi.com">A. Saugi</a>
              </p>
            </div>
          </div>
        </footer> -->
</div>