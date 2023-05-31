<div id="main-content">
    <div class="page-content">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Juknis BGH</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?= base_url() ?>index.html">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Juknis BGH
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
                            <table class="table" id="table1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Dokumen</th>
                                        <th>Jenis Dokumen</th>
                                        <th>Penerbit</th>
                                        <th>Tahun Terbit</th>
                                        <th>Lihat / Unduh</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach($juknis as $j){ ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $j->nama_dokumen ?></td>
                                        <td><?= $j->jenis_dokumen ?></td>
                                        <td><?= $j->penerbit ?></td>
                                        <td><?= $j->tahun ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bi bi-list dropdown-icon "></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                                                <a class="dropdown-item" href="<?= base_url('assets/bgh/juknis/'.$j->file) ?>" target="_blank"><i class="fa fa-download"></i> Unduh / Lihat</a>
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

        </section>
        <!-- Basic Tables end -->
    </div>

</div>
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