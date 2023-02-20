<form action="<?php echo site_url('DataSetting/saveDataDokumen'); ?>" class="form-horizontal" role="form" method="post" id="form_daftar_persyaratan">
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
              <label class="col-md-3 control-label">Nama Ketentuan Teknis</label>
              <div class="col-md-9">
					     <textarea rows="5" cols="30" class="form-control" name="nm_dokumen" placeholder="Nama Dokumen Persyaratan" autocomplete="off"></textarea>
				      </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Jenis Dokumen</label>
            <div class="col-md-4">
              <select class="form-control" name="jns_dokumen" id="jns_dokumen">
                <option value="">--Pilih Jenis Dokumen--</option>
                <option value="1">Data Umum</option>
			         	<option value="2">Data Teknis Tanah</option>
                <option value="3">Data Teknis Arsitektur</option>
				        <option value="4">Data Teknis Struktur</option>
				        <option value="5">Data Teknis Mekanikal, Elektrikal, dan Plambing</option>
              </select>
            </div>
          </div>
           <div class="form-body">
            <div class="form-group">
              <label class="col-md-3 control-label">Keterangan</label>
              <div class="col-md-9">
               <textarea rows="5" cols="30" class="form-control" name="keterangan" placeholder="Keterangan Dokumen Persyaratan" autocomplete="off"></textarea>
              </div>
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
