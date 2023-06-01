<div id="main-content">
    <div class="page-content">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Informasi BGH</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?= base_url('bgh/') ?>index.html">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Informasi BGH
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
                            <button class="btn btn-primary btn-sm" id="tambah-informasi"><i class="fa fa-plus"></i> Tambah Data</button>
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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach($informasi as $j){ ?>
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
                                                <a class="dropdown-item editinformasi" href="javascript:;" data-id="<?= $j->id ?>" data-nama="<?= $j->nama_dokumen ?>" data-jenis="<?= $j->jenis_dokumen ?>" data-penerbit="<?= $j->penerbit ?>" data-tahun="<?= $j->tahun ?>" data-berkas="<?= $j->file ?>"><i class="fa fa-pen"></i> Edit</a>
                                                <a class="dropdown-item deleteinformasi" href="javascript:;" data-id="<?= $j->id ?>"><i class="fa fa-trash"></i> Delete</a>
                                                <a class="dropdown-item" href="<?= base_url('assets/bgh/informasi/'.$j->file) ?>" target="_blank"><i class="fa fa-download"></i> Unduh / Lihat</a>
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

        <div class="modal fade text-left modal-borderless" id="modalinformasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" data-bs-backdrop="static" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Form Informasi</h5>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x">X</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="forminformasi">
                            <div class="form-group">
                                <input type="text" name="id" id="id" value="0" hidden>
                                <label for="" class="form-control-label">Nama Dokumen</label>
                                <input type="text" class="form-control" name="nama_dokumen" id="nama_dokumen" required>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-control-label">Jenis Dokumen</label>
                                <input type="text" class="form-control" name="jenis_dokumen" id="jenis_dokumen" required>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-control-label">Penerbit</label>
                                <input type="text" class="form-control" name="penerbit" id="penerbit" required>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-control-label">Tahun Terbit</label>
                                <select name="tahun" id="tahun" class="form-control" id="tahun" required>
                                    <option value="">PILIH</option>
                                    <?php 
                                        for($i=2023; $i>=2010; $i--)
                                        {
                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-control-label">File</label>
                                <input type="file" class="form-control" name="file">
                            </div>
                            <button class="btn btn-primary btn-sm mt-3 float-end" type="submit">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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