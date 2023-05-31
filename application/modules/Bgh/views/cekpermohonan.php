<div id="main">
    <header class="mb-3">
        <a href="<?= base_url() ?>#" class="burger-btn d-block d-xl-none">
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
                                <a href="<?= base_url() ?>index.html">Dashboard</a>
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
                        <div class="card-body">
                            <h5>Cek Permohonan PBG</h5>
                            <!-- <form action="<?= base_url('pengajuan/permohonanbgh') ?>" method="post"> -->
                            <table class="table table-borderless">
                                <tr>
                                    <td width="20%">Kode Permohonan PBG</td>
                                    <td width="5%">:</td>
                                    <td>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="cek_permohonan" value="<?= isset($kode) ? $kode : 'PBG-1234-5678' ?>" placeholder="Masukan Kode Permohonan PBG" <?= isset($kode) ? 'readonly' : '' ?>>
                                            <span class="input-group-text" id="basic-addon2" style="cursor:pointer">
                                                <i class="bi bi-search"></i>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="status" class="d-none">
                                    <td width="20%">Status BGH</td>
                                    <td width="5%">:</td>
                                    <td>
                                        <span class="badge bg-danger p-2">
                                            Mandatory
                                        </span>
                                        <input type="text" name="status" value="mandatory" hidden>
                                    </td>
                                </tr>
                                <tr id="kategori" class="d-none">
                                    <td width="20%">Kategori BGH</td>
                                    <td width="5%">:</td>
                                    <td>
                                        Bangunan Gedung kelas 4 (empat) dan 5 (lima)
                                        diatas 4 (empat) lantai dengan luas paling sedikit
                                        50.000 m2 (Lima Puluh Ribu Meter Persegi)
                                    </td>
                                </tr>
                            </table>

                            <a href="<?= base_url('pengajuan/permohonanbgh') ?>" id="btn-ajukan" class="btn btn-primary btn-sm float-end d-none">Ajukan Permohonan BGH</a>
                            <!-- </form> -->
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
                <a href="<?= base_url() ?>http://ahmadsaugi.com">A. Saugi</a>
              </p>
            </div>
          </div>
        </footer> -->
</div>