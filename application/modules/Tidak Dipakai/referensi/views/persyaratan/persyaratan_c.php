<form action="<?php echo site_url('referensi/saveDataPersyaratan/').$jenis; ?>" class="form-horizontal" role="form" method="post" id="form_daftar_persyaratan">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
      <h4 class="modal-title">Form Tambah Daftar Persyaratan <?=$jenis;?></h4>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col-md-12 ">
        <div class="form-body">
            <div class="form-group">
              <label class="col-md-3 control-label">Nama Persyaratan</label>
              <div class="col-md-9">

                <input type="text" class="form-control" name="nama_dokumen_permohonan" placeholder="Nama Dokumen Persyaratan" autocomplete="off">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Jenis Persyaratan</label>
            <div class="col-md-4">
              <select class="form-control" name="id_jenis_dok_permohonan" id="id_jenis_dok_permohonan">
                <option value="">--Pilih--</option>
                <option value="1">Persyaratan Administrasi</option>
                <option value="2">Persyaratan Teknis</option>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal-footer">
      <button type="button" data-dismiss="modal" class="btn default">Batal</button>
      <button type="submit" class="btn green">Simpan</button>
    </div>
  </div>
</form>
