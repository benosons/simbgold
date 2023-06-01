<div id="main-content">
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
                                <a href="<?= base_url() ?>index.html">Dashboard</a>
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
                    <div class="container-fluid" id="grad1">
                        <div class="row justify-content-center mt-0">
                            <div class="col-md-12 text-center p-0 mt-3 mb-2">
                                <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                                    <p>Isi semua bidang untuk melanjutkan ke tahap berikutnya</p>
                                    <div class="row">
                                        <div class="col-md-12 mx-0">
                                            <div id="msform">
                                                <ul id="progressbar">
                                                    <li class="active" id="pemilik"><strong>Data Bangunan dan Pemilik Bangunan</strong></li>
                                                    <li id="account"><strong>Dokumen Dukungan BGH</strong></li>
                                                    <li id="personal"><strong>Dokumen Arsitektur</strong></li>
                                                    <li id="payment"><strong>Dokumen Struktur</strong></li>
                                                    <li id="nodes"><strong>Dokumen MEP</strong></li>
                                                    <li id="confirm"><strong>Selesai</strong></li>
                                                </ul>

                                                <fieldset>
                                                    <form id="formDataBangunan">
                                                        <div class="row p-3">
                                                            <div class="col-md-6">
                                                                <div class="card shadow text-start">
                                                                    <div class="card-header">
                                                                        <h5>Data Bangunan</h5>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div class="form-group">
                                                                            <label for="" class="form-control-label">Nama Gedung</label>
                                                                            <input type="text" class="form-control" name="nama_gedung" id="nama_gedung" placeholder="Masukan Nama Gedung" value="<?= (!empty($pengajuan)) ? $pengajuan->nama_gedung:'' ?>" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="" class="form-control-label">Lantai</label>
                                                                            <input type="number" min="1" max="12" class="form-control" name="lantai" id="lantai" value="<?= (!empty($pengajuan)) ? $pengajuan->lantai:1 ?>" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="" class="form-control-label">Luas Bangunan</label>
                                                                            <input type="text" class="form-control" name="luas_bangunan" value="<?= (!empty($pengajuan)) ? $pengajuan->luas_bangunan:'' ?>" id="luas_bangunan" placeholder="Masukan Luas Bangunan" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="" class="form-control-label">
                                                                                Klas Bangunan <span style="cursor:pointer" id="modalklas" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-question-circle text-main"></i></span>
                                                                            </label>
                                                                            <select name="klas_bangunan" id="klas_bangunan" class="form-control" required>
                                                                                <option value="">PILIH</option>
                                                                                <?php foreach($klas as $k){ ?>
                                                                                <option value="<?= $k->id ?>" <?php if(!empty($pengajuan)){ if($pengajuan->klas_bangunan == $k->id){ echo "selected"; } } ?>><?= $k->klas ?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="card shadow text-start">
                                                                    <div class="card-header">
                                                                        <h5>Data Pemilik Bangunan</h5>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-4">
                                                                                <div class="form-group">
                                                                                    <label for="" class="form-control-label">Gelar Depan</label>
                                                                                    <input type="text" class="form-control" name="glr_depan" id="glr_depan" placeholder="Masukan Gelar Depan" value="<?= (!empty($pengajuan)) ? $pengajuan->glr_depan:'' ?>" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <div class="form-group">
                                                                                    <label for="" class="form-control-label">Nama</label>
                                                                                    <input type="text" class="form-control" name="nm_pemilik" id="nm_pemilik" value="<?= (!empty($pengajuan)) ? $pengajuan->nm_pemilik:'' ?>" placeholder="Masukan Nama Pemilik" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <div class="form-group">
                                                                                    <label for="" class="form-control-label">Gelar Belakang</label>
                                                                                    <input type="text" class="form-control" name="glr_belakang" id="glr_belakang" placeholder="Masukan Gelar Belakang" value="<?= (!empty($pengajuan)) ? $pengajuan->glr_belakang:'' ?>" required>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="" class="form-control-label">No KTP</label>
                                                                            <input type="text" maxlength="16" class="form-control" name="no_ktp" id="no_ktp" placeholder="Masukan No KTP" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="" class="form-control-label">No Kitas</label>
                                                                            <input type="text" class="form-control" name="no_kitas" id="no_kitas" placeholder="(Optional)" >
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="" class="form-control-label">Alamat</label>
                                                                            <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Masukan Alamat" >
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="" class="form-control-label">Provinsi</label>
                                                                            <select name="id_provinsi" id="id_provinsi" class="form-control" required>
                                                                                <option value="">PILIH</option>
                                                                                <?php 
                                                                                    foreach($provinsi as $p){
                                                                                ?>
                                                                                <option value="<?= $p->id_provinsi ?>"><?= $p->nama_provinsi ?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="" class="form-control-label">Kota/Kabupaten</label>
                                                                            <select name="id_kabkot" id="id_kabkot" class="form-control" required>
                                                                                <option value="">PILIH</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="" class="form-control-label">Kecamatan</label>
                                                                            <select name="id_kecamatan" id="id_kecamatan" class="form-control" required>
                                                                                <option value="">PILIH</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="" class="form-control-label">Kelurahan</label>
                                                                            <select name="id_kelurahan" id="id_kelurahan" class="form-control" required>
                                                                                <option value="">PILIH</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="" class="form-control-label">No HP</label>
                                                                            <input type="text" class="form-control" maxlength="12" name="no_hp" id="no_hp" placeholder="Masukan Nomor HP Aktif" >
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="" class="form-control-label">Email</label>
                                                                            <input type="email" class="form-control" name="email" id="email" placeholder="Masukan Email" >
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="" class="form-control-label">Unit Organisasi</label>
                                                                            <input type="text" class="form-control" name="unit_organisasi" id="unit_organisasi" placeholder="Masukan Unit Organisasi" >
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="action-button">Next Step</button>
                                                    </form>
                                                    <input type="button" name="next" class="next action-button" id="nextdatabangunan" value="Next Step" hidden />
                                                </fieldset>
                                                <fieldset>
                                                    <form id="formDokbghMandatory" enctype="multipart/form-data">
                                                        <div class="row p-3">
                                                            <?php
                                                            $i = 1;
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
                                                                                <input type="file" class="with-validation-filepond" name="dokbgh[]" id="dokumen-pembuktian-bgh" <?php 
                                                                                    if($i == 1){
                                                                                ?>
                                                                                accept=".pdf"
                                                                                <?php
                                                                                    }else{
                                                                                ?> accept=".xlsx" <?php } ?> required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php $i++;} ?>
                                                        </div>
                                                        <button type="submit" class="action-button">Next Step</button>
                                                    </form>
                                                    <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                                    <input type="button" name="next" class="next action-button" id="nextdokbgh" value="Next Step" hidden />
                                                </fieldset>
                                                <fieldset>
                                                    <input type="text" id="idpermohonanglobal" hidden>
                                                    <form id="formDokarsitektur" enctype="multipart/form-data">
                                                        <div class="row p-3">
                                                            <?php foreach ($arsitektur as $a) { ?>
                                                                <div class="col-md-6">
                                                                    <div class="card shadow text-start">
                                                                        <div class="card-header">
                                                                            <h5 class="card-title"><?= $a->nama ?></h5>
                                                                            <small><?= $a->keterangan ?></small>
                                                                        </div>
                                                                        <div class="card-content">
                                                                            <div class="card-body">
                                                                                <input type="file" class="form-control" name="dokars[]" accept=".pdf" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                        <button type="submit" class="action-button">Next Step</button>
                                                    </form>
                                                    <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                                    <input type="button" name="next" class="next action-button" value="Next Step" id="nextdokarsitektur" hidden />
                                                </fieldset>
                                                <fieldset>
                                                    <form id="formDokstruktur" enctype="multipart/form-data">
                                                        <div class="row p-3">
                                                            <?php foreach ($struktur as $st) { ?>
                                                                <div class="col-md-6">
                                                                    <div class="card shadow text-start">
                                                                        <div class="card-header">
                                                                            <h5 class="card-title"><?= $st->nama ?></h5>
                                                                            <small><?= $st->keterangan ?></small>
                                                                        </div>
                                                                        <div class="card-content">
                                                                            <div class="card-body">
                                                                                <input type="file" class="form-control" name="dokstruk[]" accept=".pdf">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                        <button type="submit" class="action-button">Next Step</button>
                                                    </form>
                                                    <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                                    <input type="button" name="make_payment" class="next action-button" id="nextdokstruktur" value="Next Step" hidden />
                                                </fieldset>
                                                <fieldset>
                                                    <form id="formDokmep" enctype="multipart/form-data">
                                                        <div class="row p-3">
                                                            <?php foreach ($mep as $m) { ?>
                                                                <div class="col-md-6">
                                                                    <div class="card shadow text-start">
                                                                        <div class="card-header">
                                                                            <h5 class="card-title"><?= $m->nama ?></h5>
                                                                            <small><?= $m->keterangan ?></small>
                                                                        </div>
                                                                        <div class="card-content">
                                                                            <div class="card-body">
                                                                                <input type="file" class="form-control" name="dokmep[]" accept=".pdf">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                        <button type="submit" class="action-button">Next Step</button>
                                                    </form>
                                                    <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                                    <input type="button" name="make_payment" class="next action-button" value="Confirm" id="nextdokmep" hidden />
                                                </fieldset>
                                                <fieldset>
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
                                                                <h5>Permohonan BGH anda akan dicek terlebih dahulu</h5>
                                                            </div>
                                                        </div>
                                                        <a href="<?= base_url('bgh/pengajuan/bangunanbaru') ?>">Kembali</a>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <div class="modal fade" id="exampleModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bangunan Gedung dengan kategori Wajib BGH</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-stripped">
                        <thead class="bg-main">
                            <th>No</th>
                            <th>Klas Bangunan</th>
                            <th>Definisi</th>
                            <th>Contoh Bangunan</th>
                            <th>Ketentuan</th>
                        </thead>
                        <tbody>
                            <?php 
                                $index = 1;
                                foreach($klas as $kl){
                            ?>
                            <tr>
                                <td><?= $index ?></td>
                                <td><?= $kl->klas ?></td>
                                <td><?= $kl->definisi ?></td>
                                <td><?= $kl->contoh_bangunan ?></td>
                                <td><?= $kl->ketentuan ?></td>
                            </tr>
                            <?php $index++;} ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>
        <!-- Basic Tables end -->
    </div>
</div>
</div>