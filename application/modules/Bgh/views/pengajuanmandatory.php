<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Pengajuan Sertifikasi Bangunan Gedung Hijau</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.html">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Pengajuan BGH
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
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
                                            <h5>Upload Dokumen Persyaratan BGH</h5>
                                            <!-- <form action=""> -->
                                            <div class="form-group">
                                                <label for="" class="form-control-label">Dokumen Pembuktian</label>
                                                <input type="file" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="form-control-label">Dokumen OTTV</label>
                                                <input type="file" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="form-control-label">Kalkulator Neraca Air</label>
                                                <input type="file" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="form-control-label">Kalkulator Energi</label>
                                                <input type="file" class="form-control" required>
                                            </div>
                                            <a href="<?= base_url('pengajuan/uploadsuccess') ?>" class="btn btn-primary btn-sm float-end">Upload Dokumen</a>
                                            <!-- </form> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <h5>Soon !</h5>
                                </div>
                                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                    <form action="#" class="mt-5">
                                        <div class="form-group">
                                            <label for="" class="form-control-label">Upload Laporan Pemeriksaan Berkala (12 Bulan
                                                Sekali)</label>
                                            <input type="file" class="form-control" />
                                        </div>
                                    </form>
                                    <button class="btn btn-primary btn-sm float-end">
                                        Ajukan
                                    </button>

                                    <form action="#" class="mt-5">
                                        <h5>Pengajuan Sertifikasi Pemanfaatan</h5>
                                        <div class="form-group">
                                            <label for="" class="form-control-label">Upload Laporan Akhir tahap pemanfaatan</label>
                                            <input type="file" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="form-control-label">Upload Dokumen Tahap Perencanaan</label>
                                            <input type="file" class="form-control" />
                                        </div>
                                    </form>
                                    <button class="btn btn-primary btn-sm float-end">
                                        Ajukan Sertifikasi
                                    </button>
                                </div>
                                <div class="tab-pane fade" id="bongkar" role="tabpanel" aria-labelledby="bongkar-tab">
                                    <form action="#" class="mt-5">
                                        <div class="form-group">
                                            <label for="" class="form-control-label">Kode Penerbitan PBG</label>
                                            <input type="text" class="form-control" value="PBG-1234-5678" />
                                        </div>
                                    </form>
                                    <table class="table table-borderless">
                                        <tr>
                                            <td width="20%">Status PBG</td>
                                            <td width="5%">:</td>
                                            <td>
                                                <span class="badge bg-success p-2">
                                                    Telah Terbit
                                                </span>
                                            </td>
                                        </tr>
                                    </table>
                                    <button class="btn btn-primary btn-sm float-end">
                                        Ajukan Pembongkaran
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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