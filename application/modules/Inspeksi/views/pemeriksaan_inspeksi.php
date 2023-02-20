<style>
  table,
  th {
    text-align: center;
  }
  .modal.fade.in {
    top: 20%;
  }
  .modal-pemohon.fade.in {
    top: 50%;
  }
  .portlet.light .form .form-body,
  .portlet.light .portlet-form .form-body {
    padding-left: 15px;
    padding-right: 15px;
  }
  .mt-radio {
    position: unset;
  }
  .mt-repeater .mt-repeater-input {
    display: table-cell;
    vertical-align: top;
    padding: 0 5px 10px;
    width: 1%;
  }
  .mt-repeater .mt-repeater-input.mt-repeater-textarea {
    width: 3%;
  }
  textarea {
    resize: none;
  }
  .clearfix {
    *zoom: 1;
  }
  .clearfix:before,
  .clearfix:after {
    display: table;
    content: "";
    line-height: 0;
  }
  .clearfix:after {
    clear: both;
  }
  .hide-text {
    font: 0/0 a;
    color: transparent;
    text-shadow: none;
    background-color: transparent;
    border: 0;
  }
  .input-block-level {
    display: block;
    width: 100%;
    min-height: 30px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
  }
  .btn-file {
    overflow: hidden;
    position: relative;
    vertical-align: middle;
  }
  .fileupload {
    margin-bottom: 9px;
  }
  .fileupload .uneditable-input {
    display: inline-block;
    margin-bottom: 0px;
    vertical-align: middle;
    cursor: text;
  }
  .fileupload .thumbnail {
    overflow: hidden;
    display: inline-block;
    margin-bottom: 5px;
    vertical-align: middle;
    text-align: center;
  }
  .fileupload .thumbnail>img {
    display: inline-block;
    vertical-align: middle;
    max-height: 100%;
  }
  .fileupload .btn {
    vertical-align: middle;
  }
  .fileupload-exists .fileupload-new,
  .fileupload-new .fileupload-exists {
    display: none;
  }
  .fileupload-inline .fileupload-controls {
    display: inline;
  }
  .fileupload-new .input-append .btn-file {
    -webkit-border-radius: 0 3px 3px 0;
    -moz-border-radius: 0 3px 3px 0;
    border-radius: 0 3px 3px 0;
  }
  .thumbnail-borderless .thumbnail {
    border: none;
    padding: 0;
    -webkit-border-radius: 0;
    -moz-border-radius: 0;
    border-radius: 0;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
  }
  .fileupload-new.thumbnail-borderless .thumbnail {
    border: 1px solid #ddd;
  }
  .control-group.warning .fileupload .uneditable-input {
    color: #a47e3c;
    border-color: #a47e3c;
  }
  .control-group.warning .fileupload .fileupload-preview {
    color: #a47e3c;
  }
  .control-group.warning .fileupload .thumbnail {
    border-color: #a47e3c;
  }
  .control-group.error .fileupload .uneditable-input {
    color: #b94a48;
    border-color: #b94a48;
  }
  .control-group.error .fileupload .fileupload-preview {
    color: #b94a48;
  }
  .control-group.error .fileupload .thumbnail {
    border-color: #b94a48;
  }
  .control-group.success .fileupload .uneditable-input {
    color: #468847;
    border-color: #468847;
  }
  .control-group.success .fileupload .fileupload-preview {
    color: #468847;
  }
  .control-group.success .fileupload .thumbnail {
    border-color: #468847;
  }

  .txt_csrfname {
    display: none;
  }
</style>

<div class="row">
  <?php $this->load->view('header_inspeksi') ?>
  <div class="col-md-12">
    <div class="portlet light " id="form_wizard_1">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-edit font-blue"></i><span class="caption-subject font-blue bold uppercase">Input Hasil Inspeksi</span>
        </div>
      </div>
      <div class="portlet-body form">
        <div class="form-wizard">
          <div class="form-body">
            <ul class="nav nav-pills nav-justified steps">
              <li class="active">
                <a href="#tab1" data-toggle="tab" class="step" aria-expanded="true">
                  <span class="number"> 1 </span><span class="desc"><i class="fa fa-check"></i> Struktur Bawah </span>
                </a>
              </li>
              <li>
                <a href="#tab2" data-toggle="tab" class="step">
                  <span class="number"> 2 </span><span class="desc"><i class="fa fa-check"></i> Basement </span>
                </a>
              </li>
              <li>
                <a href="#tab3" data-toggle="tab" class="step">
                  <span class="number"> 3 </span><span class="desc"><i class="fa fa-check"></i> Struktur Atas </span>
                </a>
              </li>
              <li>
                <a href="#tab4" data-toggle="tab" class="step">
                  <span class="number"> 4 </span><span class="desc"><i class="fa fa-check"></i> Testing </span>
                </a>
              </li>
              <li>
                <a href="#tab5" data-toggle="tab" class="step">
                  <span class="number"> 5 </span><span class="desc"><i class="fa fa-check"></i>Hasil Akhir</span>
                </a>
              </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab1">
                <div class="portlet box blue">
                  <div class="portlet-title">
                    <div class="caption"><i class="fa fa-building"></i>Struktur Bawah</div>
                  </div>
                  <div class="portlet-body form">
                    <div class="form-body">
                      <div class="form-group">
                        <form action="#" role="form" method="post" class="step-wizard mt-repeater form-horizontal" id="formOne" enctype="multipart/form-data">
                          <input type="hidden" name="id" id="jenisInspeksi" value="1">
                          <input type="hidden" name="idKonsultasi" value="<?= $this->uri->segment(3) ?>">
                          <input type="hidden" name="struktur" value="1" />
                          <div>
                            <?php $pemeriksaan = $struktur_bawah != NULL ? $struktur_bawah->nama_pemeriksaan : '';
                            $kesesuaian = $struktur_bawah != NULL ? $struktur_bawah->kesesuaian : '';
                            $catatan_berkas = $struktur_bawah != NULL ? $struktur_bawah->catatan : '';
                            $berkas_file = $struktur_bawah != NULL ? $struktur_bawah->berkas_file : '';
                            $berkas_justifikasi = $struktur_bawah != NULL ? $struktur_bawah->berkas_justifikasi : '';
                            $id_struktur = $struktur_bawah != NULL ? $struktur_bawah->id_struktur : '';
                            $id_inspeksi_1 = $struktur_bawah != NULL ? $struktur_bawah->id_inspeksi : '';
                            ?>
                            <!-- jQuery Repeater Container -->
                          </div>
                          <input type="hidden" name="id_inspeksi" value="<?= $id_inspeksi_1 ?>">

                          <table class="table table-bordered table-striped table-hover">
                            <thead>
                              <tr>
                                <th class="info">Pemeriksaan</th>
                                <th class="info">Kesesuaian</th>
                                <th class="info">Berkas</th>
                                <th class="info">Catatan</th>
                                <th class="info">Justifikasi</th>
                                <th class="info">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>
                                  <textarea name="pemeriksaan" class="form-control" rows="3" cols="50" required><?= $pemeriksaan ?></textarea>
                                </td>
                                <td style="text-align:center;">
                                  <input type="hidden" name="struktur" value="1" />
                                  <input type="checkbox" name="kesesuaian" id="kesesuaianData" class="make-switch" <?= $kesesuaian != 0 && $kesesuaian != NULL ? 'checked' : '' ?> data-on-text="<i class='fa fa-check'></i> Sesuai" data-off-text="<i class='fa fa-times'></i> Tidak" data-on-color="success" data-off-color="danger" data-size="medium">
                                </td>
                                <td>
                                  <?php if ($berkas_file != '') : ?>
                                    <a href="javascript:void(0);" id="lihatBerkas" class="btn btn-info info-berkas" style="margin-bottom:10px;" onClick="javascript:popWin('<?php echo base_url($pathInspeksi . '/' . $berkas_file); ?>')"><i class="fa fa-eye"></i> Lihat File</a>
                                    <div class="fileupload fileupload-new input-berkas" data-provides="fileupload" style="display:none;">
                                      <span class="btn btn-primary btn-file"><span class="fileupload-new"><i class="fa fa-file"></i> Pilih File</span>
                                        <span class="fileupload-exists">Ubah</span> <input type="file" name="berkas" /></span><br>
                                      <span class="fileupload-preview"></span>
                                      <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                                    </div>
                                  <?php else : ?>
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                      <span class="btn btn-primary btn-file"><span class="fileupload-new"><i class="fa fa-file"></i> Pilih File</span>
                                        <span class="fileupload-exists">Ubah</span> <input type="file" name="berkas" /></span><br>
                                      <span class="fileupload-preview"></span>
                                      <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                                    </div>
                                  <?php endif; ?>
                                </td>
                                <td>
                                  <?php if ($catatan_berkas != '') : ?>
                                    <a href="javascript:void(0);" id="catatanBerkas" class="btn btn-info info-catatan" style="margin-bottom:10px;" onClick="javascript:popWin('<?php echo base_url($pathCatatan . '/' . $catatan_berkas); ?>')"><i class="fa fa-eye"></i> Lihat File</a>
                                    <div class="fileupload fileupload-new input-catatan" data-provides="fileupload" style="display:none;">
                                      <span class="btn btn-primary btn-file"><span class="fileupload-new"><i class="fa fa-file"></i> Pilih File</span>
                                        <span class="fileupload-exists">Ubah</span> <input type="file" name="catatan" /></span><br>
                                      <span class="fileupload-preview"></span>
                                      <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                                    </div>
                                  <?php else : ?>
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                      <span class="btn btn-primary btn-file"><span class="fileupload-new"><i class="fa fa-file"></i> Pilih File</span>
                                        <span class="fileupload-exists">Ubah</span> <input type="file" name="catatan" /></span><br>
                                      <span class="fileupload-preview"></span>
                                      <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                                    </div>
                                  <?php endif; ?>
                                </td>

                                <td>
                                  <?php if ($berkas_justifikasi != '') : ?>
                                    <a href="javascript:void(0);" id="berkasJustifikasi" class="btn btn-info info-justifikasi" style="margin-bottom:10px;" onClick="javascript:popWin('<?php echo base_url($pathJustifikasi . '/' . $berkas_justifikasi); ?>')"><i class="fa fa-eye"></i> Lihat File</a>
                                    <div class="fileupload fileupload-new input-justifikasi" data-provides="fileupload" style="display:none;">
                                      <span class="btn btn-primary btn-file"><span class="fileupload-new"><i class="fa fa-file"></i> Pilih File</span>
                                        <span class="fileupload-exists">Ubah</span> <input type="file" name="justifikasi" /></span><br>
                                      <span class="fileupload-preview"></span>
                                      <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                                    </div>
                                  <?php else : ?>
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                      <span class="btn btn-primary btn-file"><span class="fileupload-new"><i class="fa fa-file"></i> Pilih File</span>
                                        <span class="fileupload-exists">Ubah</span> <input type="file" name="justifikasi" /></span><br>
                                      <span class="fileupload-preview"></span>
                                      <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                                    </div>
                                  <?php endif; ?>
                                </td>
                                <td>
                                  <?php if ($id_inspeksi_1 != NULL) : ?>
                                    <a href="javascript:;" class="btn btn-warning mt-repeater-delete berkas-file" style="margin-bottom: 10px;">
                                      <i class="fa fa-edit"></i> Ubah Berkas Berita Acara</a>
                                    <a href="javascript:;" class="btn grey-cascade mt-repeater-delete delete-file" style="display: none;margin-bottom:10px;">
                                      <i class="fa fa-close"></i> Batal</a>
                                    <a href="javascript:;" class="btn btn-warning mt-repeater-delete catatan-file" style="margin-bottom: 10px;">
                                      <i class="fa fa-edit"></i> Ubah Berkas Catatan</a>
                                    <a href="javascript:;" class="btn grey-cascade mt-repeater-delete delete-catatan" style="display: none;margin-bottom:10px;">
                                      <i class="fa fa-close"></i> Batal</a>
                                    <?php if ($berkas_justifikasi != '') : ?>
                                      <a href="javascript:;" class="btn btn-warning mt-repeater-delete justifikasi-file" style="margin-bottom:10px;">
                                        <i class="fa fa-edit"></i> Ubah Berkas Justifikasi</a>
                                      <a href="javascript:;" class="btn grey-cascade mt-repeater-delete delete-justifikasi" style="display: none;margin-bottom:10px;">
                                        <i class="fa fa-close"></i> Batal</a>
                                    <?php endif; ?>
                                  <?php else : ?>
                                  <?php endif; ?>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                          <input type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                          <button type="submit" name="submit" class="btn btn-success save-step" id="saveStep"><i class="fa fa-save"></i> Simpan dan Lanjutkan</button>
                          &nbsp;
                          <?php if ($id_inspeksi_1 != NULL) : ?>
                            <button type="button" id="btnNext" class="btn purple btn-next o-button" tyle="expand-right" data-size="l"><span class="ladda-label"><i class="fa fa-arrow-right"></i> Langkah Berikutnya</span></button>
                            &nbsp;
                          <?php endif; ?>
                          <a href="<?= site_url('Inspeksi/list_inspeksi') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>

                        </form>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
              <!-- endpane 1 -->
              <!-- panel 2 -->
              <div class="tab-pane" id="tab2">
                <div class="portlet box blue">
                  <div class="portlet-title">
                    <div class="caption">
                      <i class="fa fa-building"></i>Basement
                    </div>
                  </div>
                  <div class="portlet-body form">
                    <div class="form-body">
                      <div class="form-group">
                        <form action="#" role="form" method="post" class="step-wizard mt-repeater form-horizontal" id="formTwo" enctype="multipart/form-data">
                          <input type="hidden" name="id" id="jenisInspeksi" value="2">
                          <input type="hidden" name="idKonsultasi" value="<?= $this->uri->segment(3) ?>">
                          <?php $pemeriksaan2 = $basement != NULL ? $basement->nama_pemeriksaan : '' ?>
                          <?php $kesesuaian2 = $basement != NULL ? $basement->kesesuaian : '' ?>
                          <?php $catatan_berkas2 = $basement != NULL ? $basement->catatan : '' ?>
                          <?php $berkas_file2 = $basement != NULL ? $basement->berkas_file : '' ?>
                          <?php $berkas_justifikasi2 = $basement != NULL ? $basement->berkas_justifikasi : '' ?>
                          <?php $id_struktur2 = $basement != NULL ? $basement->id_struktur : '' ?>
                          <?php $id_inspeksi_2 = $basement != NULL ? $basement->id_inspeksi : '' ?>
                          <input type="hidden" name="id_inspeksi" value="<?= $id_inspeksi_2 ?>">
                          <input type="hidden" name="struktur" value="2" />

                          <table class="table table-bordered table-striped table-hover">
                            <thead>
                              <tr>
                                <th class="info">Pemeriksaan</th>
                                <th class="info">Kesesuaian</th>
                                <th class="info">Berkas</th>
                                <th class="info">Catatan</th>
                                <th class="info">Justifikasi</th>
                                <th class="info">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>
                                  <textarea name="pemeriksaan" class="form-control" rows="3" cols="50" required><?= $pemeriksaan2 ?></textarea>
                                </td>
                                <td style="text-align:center;">
                                  <input type="checkbox" name="kesesuaian" id="kesesuaianData" class="make-switch" <?= $kesesuaian2 != 0 && $kesesuaian2 != NULL ? 'checked' : '' ?> data-on-text="<i class='fa fa-check'></i> Sesuai" data-off-text="<i class='fa fa-times'></i> Tidak" data-on-color="success" data-off-color="danger" data-size="medium">
                                </td>
                                <td>
                                  <?php if ($berkas_file2 != '') : ?>
                                    <a href="javascript:void(0);" id="lihatBerkas" class="btn btn-info info-berkas" style="margin-bottom:10px;" onClick="javascript:popWin('<?php echo base_url($pathInspeksi . '/' . $berkas_file2); ?>')"><i class="fa fa-eye"></i> Lihat File</a>
                                    <div class="fileupload fileupload-new input-berkas" data-provides="fileupload" style="display:none;">
                                      <span class="btn btn-primary btn-file"><span class="fileupload-new"><i class="fa fa-file"></i> Pilih File</span>
                                        <span class="fileupload-exists">Ubah</span> <input type="file" name="berkas" /></span><br>
                                      <span class="fileupload-preview"></span>
                                      <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                                    </div>
                                  <?php else : ?>
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                      <span class="btn btn-primary btn-file"><span class="fileupload-new"><i class="fa fa-file"></i> Pilih File</span>
                                        <span class="fileupload-exists">Ubah</span> <input type="file" name="berkas" /></span><br>
                                      <span class="fileupload-preview"></span>
                                      <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                                    </div>
                                  <?php endif; ?>
                                </td>
                                <td>
                                  <?php if ($catatan_berkas2 != '') : ?>
                                    <a href="javascript:void(0);" id="catatanBerkas" class="btn btn-info info-catatan" style="margin-bottom:10px;" onClick="javascript:popWin('<?php echo base_url($pathCatatan . '/' . $catatan_berkas2); ?>')"><i class="fa fa-eye"></i> Lihat File</a>
                                    <div class="fileupload fileupload-new input-catatan" data-provides="fileupload" style="display:none;">
                                      <span class="btn btn-primary btn-file"><span class="fileupload-new"><i class="fa fa-file"></i> Pilih File</span>
                                        <span class="fileupload-exists">Ubah</span> <input type="file" name="catatan" /></span><br>
                                      <span class="fileupload-preview"></span>
                                      <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                                    </div>
                                  <?php else : ?>
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                      <span class="btn btn-primary btn-file"><span class="fileupload-new"><i class="fa fa-file"></i> Pilih File</span>
                                        <span class="fileupload-exists">Ubah</span> <input type="file" name="catatan" /></span><br>
                                      <span class="fileupload-preview"></span>
                                      <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                                    </div>
                                  <?php endif; ?>
                                </td>

                                <td>
                                  <?php if ($berkas_justifikasi2 != '') : ?>
                                    <a href="javascript:void(0);" id="berkasJustifikasi" class="btn btn-info info-justifikasi" style="margin-bottom:10px;" onClick="javascript:popWin('<?php echo base_url($pathJustifikasi . '/' . $berkas_justifikasi2); ?>')"><i class="fa fa-eye"></i> Lihat File</a>
                                    <div class="fileupload fileupload-new input-justifikasi" data-provides="fileupload" style="display:none;">
                                      <span class="btn btn-primary btn-file"><span class="fileupload-new"><i class="fa fa-file"></i> Pilih File</span>
                                        <span class="fileupload-exists">Ubah</span> <input type="file" name="justifikasi" /></span><br>
                                      <span class="fileupload-preview"></span>
                                      <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                                    </div>
                                  <?php else : ?>
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                      <span class="btn btn-primary btn-file"><span class="fileupload-new"><i class="fa fa-file"></i> Pilih File</span>
                                        <span class="fileupload-exists">Ubah</span> <input type="file" name="justifikasi" /></span><br>
                                      <span class="fileupload-preview"></span>
                                      <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                                    </div>
                                  <?php endif; ?>
                                </td>
                                <td>
                                  <?php if ($id_inspeksi_2 != NULL) : ?>
                                    <a href="javascript:;" class="btn btn-warning mt-repeater-delete berkas-file" style="margin-bottom: 10px;">
                                      <i class="fa fa-edit"></i> Ubah Berkas Berita Acara</a>
                                    <a href="javascript:;" class="btn grey-cascade mt-repeater-delete delete-file" style="display: none;margin-bottom:10px;">
                                      <i class="fa fa-close"></i> Batal</a>
                                    <a href="javascript:;" class="btn btn-warning mt-repeater-delete catatan-file" style="margin-bottom: 10px;">
                                      <i class="fa fa-edit"></i> Ubah Berkas Catatan</a>
                                    <a href="javascript:;" class="btn grey-cascade mt-repeater-delete delete-catatan" style="display: none;margin-bottom:10px;">
                                      <i class="fa fa-close"></i> Batal</a>

                                    <?php if ($berkas_justifikasi2 != '') : ?>
                                      <a href="javascript:;" class="btn btn-warning mt-repeater-delete justifikasi-file" style="margin-bottom:10px;">
                                        <i class="fa fa-edit"></i> Ubah Berkas Justifikasi</a>
                                      <a href="javascript:;" class="btn grey-cascade mt-repeater-delete delete-justifikasi" style="display: none;margin-bottom:10px;">
                                        <i class="fa fa-close"></i> Batal</a>
                                    <?php endif; ?>
                                  <?php else : ?>
                                  <?php endif; ?>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                          <input type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                          <button type="submit" name="submit" class="btn btn-success save-step" id="saveStep"><i class="fa fa-save"></i> Simpan dan Lanjutkan</button>
                          &nbsp;
                          <?php if ($id_inspeksi_2 != NULL) : ?>
                            <button type="button" id="btnNext" class="btn purple btn-next ladda-button" tyle="expand-right" data-size="l"><span class="ladda-label"><i class="fa fa-arrow-right"></i> Langkah Berikutnya</span></button>
                            &nbsp;
                          <?php endif; ?>
                          <a href="javascript:void(0);" class="btn btn-info  back-button"><i class="fa fa-arrow-left"></i> Kembali</a>

                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end panel 3 -->
              <!-- panel 2 -->
              <div class="tab-pane" id="tab3">
                <div class="portlet box blue">
                  <div class="portlet-title">
                    <div class="caption">
                      <i class="fa fa-building"></i>Struktur Atas
                    </div>
                  </div>
                  <div class="portlet-body form">
                    <div class="form-body">
                      <div class="form-group">
                        <form action="#" role="form" method="post" class="step-wizard mt-repeater form-horizontal" id="formThree" enctype="multipart/form-data">
                          <div>
                            <input type="hidden" name="id" id="jenisInspeksi" value="3">
                            <input type="hidden" name="idKonsultasi" value="<?= $this->uri->segment(3) ?>">
                            <?php $pemeriksaan3 = $struktur_atas != NULL ? $struktur_atas->nama_pemeriksaan : '' ?>
                            <?php $kesesuaian3 = $struktur_atas != NULL ? $struktur_atas->kesesuaian : '' ?>
                            <?php $catatan_berkas3 = $struktur_atas != NULL ? $struktur_atas->catatan : '' ?>
                            <?php $berkas_file3 = $struktur_atas != NULL ? $struktur_atas->berkas_file : '' ?>
                            <?php $berkas_justifikasi3 = $struktur_atas != NULL ? $struktur_atas->berkas_justifikasi : '' ?>
                            <?php $id_struktur3 = $struktur_atas != NULL ? $struktur_atas->id_struktur : '' ?>
                            <?php $id_inspeksi_3 = $struktur_atas != NULL ? $struktur_atas->id_inspeksi : '' ?>
                            <input type="hidden" name="id_inspeksi" value="<?= $id_inspeksi_3 ?>">
                            <input type="hidden" name="struktur" value="3" />
                            <table class="table table-bordered table-striped table-hover">
                              <thead>
                                <tr>
                                  <th class="info">Pemeriksaan</th>
                                  <th class="info">Kesesuaian</th>
                                  <th class="info">Berkas</th>
                                  <th class="info">Catatan</th>
                                  <th class="info">Justifikasi</th>
                                  <th class="info">Aks</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>
                                    <textarea name="pemeriksaan" class="form-control" rows="3" cols="50" required><?= $pemeriksaan3 ?></textarea>
                                  </td>
                                  <td style="text-align:center;">
                                    <input type="checkbox" name="kesesuaian" id="kesesuaianData" class="make-switch" <?= $kesesuaian3 != 0 && $kesesuaian3 != NULL ? 'checked' : '' ?> data-on-text="<i class='fa fa-check'></i> Sesuai" data-off-text="<i class='fa fa-times'></i> Tidak" data-on-color="success" data-off-color="danger" data-size="medium">
                                  </td>

                                  <td>
                                    <?php if ($berkas_file3 != '') : ?>
                                      <a href="javascript:void(0);" id="lihatBerkas" class="btn btn-info info-berkas" style="margin-bottom:10px;" onClick="javascript:popWin('<?php echo base_url($pathInspeksi . '/' . $berkas_file3); ?>')"><i class="fa fa-eye"></i> Lihat File</a>
                                      <div class="fileupload fileupload-new input-berkas" data-provides="fileupload" style="display:none;">
                                        <span class="btn btn-primary btn-file"><span class="fileupload-new"><i class="fa fa-file"></i> Pilih File</span>
                                          <span class="fileupload-exists">Ubah</span> <input type="file" name="berkas" /></span><br>
                                        <span class="fileupload-preview"></span>
                                        <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                                      </div>
                                    <?php else : ?>
                                      <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <span class="btn btn-primary btn-file"><span class="fileupload-new"><i class="fa fa-file"></i> Pilih File</span>
                                          <span class="fileupload-exists">Ubah</span> <input type="file" name="berkas" /></span><br>
                                        <span class="fileupload-preview"></span>
                                        <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                                      </div>
                                    <?php endif; ?>
                                  </td>
                                  <td>
                                    <?php if ($catatan_berkas3 != '') : ?>
                                      <a href="javascript:void(0);" id="catatanBerkas" class="btn btn-info info-catatan" style="margin-bottom:10px;" onClick="javascript:popWin('<?php echo base_url($pathCatatan . '/' . $catatan_berkas3); ?>')"><i class="fa fa-eye"></i> Lihat File</a>
                                      <div class="fileupload fileupload-new input-catatan" data-provides="fileupload" style="display:none;">
                                        <span class="btn btn-primary btn-file"><span class="fileupload-new"><i class="fa fa-file"></i> Pilih File</span>
                                          <span class="fileupload-exists">Ubah</span> <input type="file" name="catatan" /></span><br>
                                        <span class="fileupload-preview"></span>
                                        <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                                      </div>
                                    <?php else : ?>
                                      <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <span class="btn btn-primary btn-file"><span class="fileupload-new"><i class="fa fa-file"></i> Pilih File</span>
                                          <span class="fileupload-exists">Ubah</span> <input type="file" name="catatan" /></span><br>
                                        <span class="fileupload-preview"></span>
                                        <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                                      </div>
                                    <?php endif; ?>
                                  </td>
                                  <td>
                                    <?php if ($berkas_justifikasi3 != '') : ?>
                                      <a href="javascript:void(0);" id="berkasJustifikasi" class="btn btn-info info-justifikasi" style="margin-bottom:10px;" onClick="javascript:popWin('<?php echo base_url($pathJustifikasi . '/' . $berkas_justifikasi3); ?>')"><i class="fa fa-eye"></i> Lihat File</a>
                                      <div class="fileupload fileupload-new input-justifikasi" data-provides="fileupload" style="display:none;">
                                        <span class="btn btn-primary btn-file"><span class="fileupload-new"><i class="fa fa-file"></i> Pilih File</span>
                                          <span class="fileupload-exists">Ubah</span> <input type="file" name="justifikasi" /></span><br>
                                        <span class="fileupload-preview"></span>
                                        <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                                      </div>
                                    <?php else : ?>
                                      <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <span class="btn btn-primary btn-file"><span class="fileupload-new"><i class="fa fa-file"></i> Pilih File</span>
                                          <span class="fileupload-exists">Ubah</span> <input type="file" name="justifikasi" /></span><br>
                                        <span class="fileupload-preview"></span>
                                        <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                                      </div>
                                    <?php endif; ?>
                                  </td>
                                  <td>
                                    <?php if ($id_inspeksi_3 != NULL) : ?>
                                      <a href="javascript:;" class="btn btn-warning mt-repeater-delete berkas-file" style="margin-bottom: 10px;">
                                        <i class="fa fa-edit"></i> Ubah Berkas Berita Acara</a>
                                      <a href="javascript:;" class="btn grey-cascade mt-repeater-delete delete-file" style="display: none;margin-bottom:10px;">
                                        <i class="fa fa-close"></i> Batal</a>
                                      <a href="javascript:;" class="btn btn-warning mt-repeater-delete catatan-file" style="margin-bottom: 10px;">
                                        <i class="fa fa-edit"></i> Ubah Berkas Catatan</a>
                                      <a href="javascript:;" class="btn grey-cascade mt-repeater-delete delete-catatan" style="display: none;margin-bottom:10px;">
                                        <i class="fa fa-close"></i> Batal</a>
                                      <?php if ($berkas_justifikasi3 != '') : ?>
                                        <a href="javascript:;" class="btn btn-warning mt-repeater-delete justifikasi-file" style="margin-bottom:10px;">
                                          <i class="fa fa-edit"></i> Ubah Berkas Justifikasi</a>
                                        <a href="javascript:;" class="btn grey-cascade mt-repeater-delete delete-justifikasi" style="display: none;margin-bottom:10px;">
                                          <i class="fa fa-close"></i> Batal</a>
                                      <?php endif; ?>
                                    <?php else : ?>
                                    <?php endif; ?>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                            <!-- jQuery Repeater Container -->
                          </div>
                          <input type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                          <button type="submit" name="submit" class="btn btn-success save-step" id="saveStep"><i class="fa fa-save"></i> Simpan dan Lanjutkan</button>
                          &nbsp;
                          <?php if ($id_inspeksi_3 != NULL) : ?>
                            <button type="button" id="btnNext" class="btn purple btn-next ladda-button" tyle="expand-right" data-size="l"><span class="ladda-label"><i class="fa fa-arrow-right"></i> Langkah Berikutnya</span></button>
                            &nbsp;
                          <?php endif; ?>
                          <a href="javascript:void(0);" class="btn btn-info  back-button"><i class="fa fa-arrow-left"></i> Kembali</a>

                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tab4">
                <div class="portlet box blue">
                  <div class="portlet-title">
                    <div class="caption">
                      <i class="fa fa-building"></i>Testing
                    </div>
                  </div>
                  <div class="portlet-body form">
                    <div class="form-body">
                      <div class="form-group">
                        <form action="#" role="form" method="post" class="step-wizard mt-repeater form-horizontal" id="formFour" enctype="multipart/form-data">
                          <input type="hidden" name="id" id="jenisInspeksi" value="4">
                          <input type="hidden" name="idKonsultasi" value="<?= $this->uri->segment(3) ?>">
                          <?php $pemeriksaan4 = $testing != NULL ? $testing->nama_pemeriksaan : '' ?>
                          <?php $kesesuaian4 = $testing != NULL ? $testing->kesesuaian : '' ?>
                          <?php $catatan_berkas4 = $testing != NULL ? $testing->catatan : '' ?>
                          <?php $berkas_file4 = $testing != NULL ? $testing->berkas_file : '' ?>
                          <?php $berkas_justifikasi4 = $testing != NULL ? $testing->berkas_justifikasi : '' ?>
                          <?php $id_struktur4 = $testing != NULL ? $testing->id_struktur : '' ?>
                          <?php $id_inspeksi_4 = $testing != NULL ? $testing->id_inspeksi : '' ?>
                          <input type="hidden" name="id_inspeksi" value="<?= $id_inspeksi_4 ?>">
                          <input type="hidden" name="struktur" value="4" />
                          <table class="table table-bordered table-striped table-hover">
                            <thead>
                              <tr>
                                <th class="info">
                                  Pemeriksaan
                                </th>
                                <th class="info">
                                  Kesesuaian
                                </th>
                                <th class="info">
                                  Berkas
                                </th>
                                <th class="info">
                                  Catatan
                                </th>
                                <th class="info">
                                  Justifikasi
                                </th>
                                <th class="info">
                                  Aksi
                                </th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>
                                  <textarea name="pemeriksaan" class="form-control" rows="3" cols="50" required><?= $pemeriksaan4 ?></textarea>
                                </td>
                                <td style="text-align:center;">
                                  <input type="checkbox" name="kesesuaian" id="kesesuaianData" class="make-switch" <?= $kesesuaian4 != 0 && $kesesuaian4 != NULL ? 'checked' : '' ?> data-on-text="<i class='fa fa-check'></i> Sesuai" data-off-text="<i class='fa fa-times'></i> Tidak" data-on-color="success" data-off-color="danger" data-size="medium">
                                </td>
                                <td>
                                  <?php if ($berkas_file4 != '') : ?>
                                    <a href="javascript:void(0);" id="lihatBerkas" class="btn btn-info info-berkas" style="margin-bottom:10px;" onClick="javascript:popWin('<?php echo base_url($pathInspeksi . '/' . $berkas_file4); ?>')"><i class="fa fa-eye"></i> Lihat File</a>
                                    <div class="fileupload fileupload-new input-berkas" data-provides="fileupload" style="display:none;">
                                      <span class="btn btn-primary btn-file"><span class="fileupload-new"><i class="fa fa-file"></i> Pilih File</span>
                                        <span class="fileupload-exists">Ubah</span> <input type="file" name="berkas" /></span><br>
                                      <span class="fileupload-preview"></span>
                                      <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                                    </div>
                                  <?php else : ?>
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                      <span class="btn btn-primary btn-file"><span class="fileupload-new"><i class="fa fa-file"></i> Pilih File</span>
                                        <span class="fileupload-exists">Ubah</span> <input type="file" name="berkas" /></span><br>
                                      <span class="fileupload-preview"></span>
                                      <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                                    </div>
                                  <?php endif; ?>
                                </td>
                                <td>
                                  <?php if ($catatan_berkas4 != '') : ?>
                                    <a href="javascript:void(0);" id="catatanBerkas" class="btn btn-info info-catatan" style="margin-bottom:10px;" onClick="javascript:popWin('<?php echo base_url($pathCatatan . '/' . $catatan_berkas4); ?>')"><i class="fa fa-eye"></i> Lihat File</a>
                                    <div class="fileupload fileupload-new input-catatan" data-provides="fileupload" style="display:none;">
                                      <span class="btn btn-primary btn-file"><span class="fileupload-new"><i class="fa fa-file"></i> Pilih File</span>
                                        <span class="fileupload-exists">Ubah</span> <input type="file" name="catatan" /></span><br>
                                      <span class="fileupload-preview"></span>
                                      <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                                    </div>
                                  <?php else : ?>
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                      <span class="btn btn-primary btn-file"><span class="fileupload-new"><i class="fa fa-file"></i> Pilih File</span>
                                        <span class="fileupload-exists">Ubah</span> <input type="file" name="catatan" /></span><br>
                                      <span class="fileupload-preview"></span>
                                      <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                                    </div>
                                  <?php endif; ?>
                                </td>
                                <td>
                                  <?php if ($berkas_justifikasi4 != '') : ?>
                                    <a href="javascript:void(0);" id="berkasJustifikasi" class="btn btn-info info-justifikasi" style="margin-bottom:10px;" onClick="javascript:popWin('<?php echo base_url($pathJustifikasi . '/' . $berkas_justifikasi4); ?>')"><i class="fa fa-eye"></i> Lihat File</a>
                                    <div class="fileupload fileupload-new input-justifikasi" data-provides="fileupload" style="display:none;">
                                      <span class="btn btn-primary btn-file"><span class="fileupload-new"><i class="fa fa-file"></i> Pilih File</span>
                                        <span class="fileupload-exists">Ubah</span> <input type="file" name="justifikasi" /></span><br>
                                      <span class="fileupload-preview"></span>
                                      <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                                    </div>
                                  <?php else : ?>
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                      <span class="btn btn-primary btn-file"><span class="fileupload-new"><i class="fa fa-file"></i> Pilih File</span>
                                        <span class="fileupload-exists">Ubah</span> <input type="file" name="justifikasi" /></span><br>
                                      <span class="fileupload-preview"></span>
                                      <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                                    </div>
                                  <?php endif; ?>
                                </td>
                                <td>
                                  <?php if ($id_inspeksi_4 != NULL) : ?>
                                    <a href="javascript:;" class="btn btn-warning mt-repeater-delete berkas-file" style="margin-bottom: 10px;">
                                      <i class="fa fa-edit"></i> Ubah Berkas Berita Acara</a>
                                    <a href="javascript:;" class="btn grey-cascade mt-repeater-delete delete-file" style="display: none;margin-bottom:10px;">
                                      <i class="fa fa-close"></i> Batal</a>
                                    <a href="javascript:;" class="btn btn-warning mt-repeater-delete catatan-file" style="margin-bottom: 10px;">
                                      <i class="fa fa-edit"></i> Ubah Berkas Catatan</a>
                                    <a href="javascript:;" class="btn grey-cascade mt-repeater-delete delete-catatan" style="display: none;margin-bottom:10px;">
                                      <i class="fa fa-close"></i> Batal</a>
                                    <?php if ($berkas_justifikasi4 != '') : ?>
                                      <a href="javascript:;" class="btn btn-warning mt-repeater-delete justifikasi-file" style="margin-bottom:10px;">
                                        <i class="fa fa-edit"></i> Ubah Berkas Justifikasi</a>
                                      <a href="javascript:;" class="btn grey-cascade mt-repeater-delete delete-justifikasi" style="display: none;margin-bottom:10px;">
                                        <i class="fa fa-close"></i> Batal</a>
                                      <a href="<?= site_url("Inspeksi/hapus_inspeksi/{$id_inspeksi_4}") ?>" onclick="return confirm('Yakin Hapus Data ini?')" class="btn btn-danger mt-repeater-delete">
                                        <i class="fa fa-trash"></i> Hapus</a>
                                    <?php endif; ?>
                                  <?php else : ?>
                                  <?php endif; ?>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                          <input type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                          <button type="submit" name="submit" class="btn btn-success save-step" id="saveStep"><i class="fa fa-save"></i> Simpan dan Lanjutkan</button>
                          &nbsp;
                          <?php if ($id_inspeksi_4 != NULL) : ?>
                            <button type="button" id="btnNext" class="btn purple btn-next ladda-button" tyle="expand-right" data-size="l"><span class="ladda-label"><i class="fa fa-arrow-right"></i> Langkah Berikutnya</span></button>
                            &nbsp;
                          <?php endif; ?>
                          <a href="javascript:void(0);" class="btn btn-info  back-button"><i class="fa fa-arrow-left"></i> Kembali</a>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end panel 3 -->
              <!-- panel 3 -->
              <div class="tab-pane" id="tab5">
                <h3 class="block">Hasil Inspeksi</h3>
                <form action="<?= site_url('Inspeksi/save_data_inspeksi') ?>" class="final-wizard" role="form" method="post" id="formFive" enctype="multipart/form-data">
                  <div class="form-body">
                    <div class="form-group">
                      <input type="hidden" name="id" value="<?= $this->uri->segment(3) ?>">
                      <label class="control-label col-md-3">No. Berita Acara</label>
                      <div class="row">
                        <div class="col-md-4">
                          <input type="text" class="form-control" name="nomor_berita" placeholder="Nomor Berita Acara" required></span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3">Tgl Berita Acara</label>
                      <div class="row">
                        <div class="col-md-4">
                          <input class="form-control date-picker" data-date-format="yyyy-mm-dd" type="text" name="tgl_berita" placeholder="Tanggal Berita Acara" autocomplete="off" onkeydown="return false" required>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3">Okupansi Bangunan Gedung</label>
                      <div class="row">
                        <div class="col-md-3">
                          <input type="number" class="form-control input-lantai input-number" name="okupansi" placeholder="Okupansi dalam Bangunan" required></span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3">As Build Drawing Final
                      </label>
                      <div class="row">
                        <div class="col-md-4">
                          <input type="file" id="inputFile" name="berkas1">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3">Surat Pernyataan Penyedia Jasa Kepada Pemilik Bangunan
                      </label>
                      <div class="row">
                        <div class="col-md-4">
                          <input type="file" id="inputFile" name="berkas2">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3">Surat Pernyataan Pemilik Kepada Pemda
                      </label>
                      <div class="row">
                        <div class="col-md-4">
                          <input type="file" id="inputFile" name="berkas3">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <input type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                        <button type="submit" name="submit" class="btn blue-hoki btn-block"><i class="fa fa-save"></i> Simpan</button>
                      </div>
                      <div class="col-md-6">
                        <a href="javascript:void(0);" class="btn btn-info btn-block back-button"><i class="fa fa-arrow-left"></i> Kembali</a>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="ajax" class="modal container fade" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close btn-close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">Hasil Inspeksi</h4>
          </div>
          <div class="modal-body">
            <div class="caption-message"></div>
            <img src="<?php echo base_url() ?>assets/global/img/loading-spinner-grey.gif" alt="" class="loading">
            <span class="text-loader"> &nbsp;&nbsp;Loading... </span>
            <div class="list-group">
              <div class="row" id="result">
              </div>
              <table class="table table-bordered table-hover">
                <thead>
                  <tr class="info">
                    <th>No</th>
                    <th>Pemeriksaan</th>
                    <th>Kesesuaian</th>
                    <th>Berkas Berita Acara</th>
                    <th>Catatan</th>
                    <th>Justifikasi</th>
                  </tr>
                </thead>
                <tbody class="result-inspeksi"></tbody>
                <tbody class="data-kesesuaian"></tbody>
              </table>
            </div>
          </div>
          <div class="modal-footer">
            <input type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
            <button type="submit" id="btnNext" class="btn green btn-next next-step ladda-button" data-style="expand-right" data-size="l"><span class="ladda-label"><i class="fa fa-save"></i> Lanjutkan</span></button>
            <button type="button" data-dismiss="modal" class="btn red btn-info btn-repeat"><i class="fa fa-sign-out"></i> Tutup</button>
          </div>
        </div>
      </div>

      <div id="ajax2" class="modal container fade" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close btn-close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">Inspeksi Telah Selesai</h4>
          </div>
          <div class="modal-body">
            <div class="caption-message"></div>
            <img src="<?php echo base_url() ?>assets/global/img/loading-spinner-grey.gif" alt="" class="loading">
            <span class="text-loader"> &nbsp;&nbsp;Loading... </span>
            <div class="list-group">
              <div class="row" id="resultInspeksi">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <a href="<?= site_url("Inspeksi/list_inspeksi") ?>" class="btn-done btn btn-success" onclick="return confirm('Apakah Data Yang Diperiksa Sudah Benar?')" class="btn btn-success">
              <i class="fa fa-check"></i> selesai</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div id="pemohon" class="modal modal-pemohon fade" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false">
  <form action="#" role="form" method="post" id="perbaikanBerkas" class="form-horizontal" enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close btn-close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Formulir Perbaikan Persyaratan</h4>
      </div>
      <div class="modal-body">
        <div class="form-body">
          <div class="form-group">
            <label class="col-md-3 control-label">No. Surat</label>
            <div class="col-md-9">
              <input class="form-control" type="text" name="no_skperbaikan" placeholder="Nomor SK Perbaikan" autocomplete="off">
              <input type="hidden" name="konsultasi" id="noKonsultasi">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Tgl Perbaikan</label>
            <div class="col-md-9">
              <input class="form-control date-picker" data-date-format="yyyy-mm-dd" type="text" name="tgl_perbaikan" placeholder="Tanggal Perbaikan" autocomplete="off" onkeydown="return false">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Lampiran</label>
            <div class="col-md-9">
              <input type="file" name="berkas">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <input type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
        <button type="button" data-dismiss="modal" class="btn red btn-cancel"><i class="fa fa-sign-out"></i> Batal</button>
        <button type="submit" id="perbaikanSurat" class="btn green ladda-button" data-style="expand-right" data-size="l"><span class="ladda-label"><i class="fa fa-save"></i> Kirim</span></button>
      </div>
    </div>
  </form>
</div>

<script>
  ! function(e) {
    var t = function(t, n) {
      this.$element = e(t), this.type = this.$element.data("uploadtype") || (this.$element.find(".thumbnail").length > 0 ? "image" : "file"), this.$input = this.$element.find(":file");
      if (this.$input.length === 0) return;
      this.name = this.$input.attr("name") || n.name, this.$hidden = this.$element.find('input[type=hidden][name="' + this.name + '"]'), this.$hidden.length === 0 && (this.$hidden = e('<input type="hidden" />'), this.$element.prepend(this.$hidden)), this.$preview = this.$element.find(".fileupload-preview");
      var r = this.$preview.css("height");
      this.$preview.css("display") != "inline" && r != "0px" && r != "none" && this.$preview.css("line-height", r), this.original = {
        exists: this.$element.hasClass("fileupload-exists"),
        preview: this.$preview.html(),
        hiddenVal: this.$hidden.val()
      }, this.$remove = this.$element.find('[data-dismiss="fileupload"]'), this.$element.find('[data-trigger="fileupload"]').on("click.fileupload", e.proxy(this.trigger, this)), this.listen()
    };
    t.prototype = {
      listen: function() {
        this.$input.on("change.fileupload", e.proxy(this.change, this)), e(this.$input[0].form).on("reset.fileupload", e.proxy(this.reset, this)), this.$remove && this.$remove.on("click.fileupload", e.proxy(this.clear, this))
      },
      change: function(e, t) {
        if (t === "clear") return;
        var n = e.target.files !== undefined ? e.target.files[0] : e.target.value ? {
          name: e.target.value.replace(/^.+\\/, "")
        } : null;
        if (!n) {
          this.clear();
          return
        }
        this.$hidden.val(""), this.$hidden.attr("name", ""), this.$input.attr("name", this.name);
        if (this.type === "image" && this.$preview.length > 0 && (typeof n.type != "undefined" ? n.type.match("image.*") : n.name.match(/\.(gif|png|jpe?g)$/i)) && typeof FileReader != "undefined") {
          var r = new FileReader,
            i = this.$preview,
            s = this.$element;
          r.onload = function(e) {
            i.html('<img src="' + e.target.result + '" ' + (i.css("max-height") != "none" ? 'style="max-height: ' + i.css("max-height") + ';"' : "") + " />"), s.addClass("fileupload-exists").removeClass("fileupload-new")
          }, r.readAsDataURL(n)
        } else this.$preview.text(n.name), this.$element.addClass("fileupload-exists").removeClass("fileupload-new")
      },
      clear: function(e) {
        this.$hidden.val(""), this.$hidden.attr("name", this.name), this.$input.attr("name", "");
        if (navigator.userAgent.match(/msie/i)) {
          var t = this.$input.clone(!0);
          this.$input.after(t), this.$input.remove(), this.$input = t
        } else this.$input.val("");
        this.$preview.html(""), this.$element.addClass("fileupload-new").removeClass("fileupload-exists"), e && (this.$input.trigger("change", ["clear"]), e.preventDefault())
      },
      reset: function(e) {
        this.clear(), this.$hidden.val(this.original.hiddenVal), this.$preview.html(this.original.preview), this.original.exists ? this.$element.addClass("fileupload-exists").removeClass("fileupload-new") : this.$element.addClass("fileupload-new").removeClass("fileupload-exists")
      },
      trigger: function(e) {
        this.$input.trigger("click"), e.preventDefault()
      }
    }, e.fn.fileupload = function(n) {
      return this.each(function() {
        var r = e(this),
          i = r.data("fileupload");
        i || r.data("fileupload", i = new t(this, n)), typeof n == "string" && i[n]()
      })
    }, e.fn.fileupload.Constructor = t, e(document).on("click.fileupload.data-api", '[data-provides="fileupload"]', function(t) {
      var n = e(this);
      if (n.data("fileupload")) return;
      n.fileupload(n.data());
      var r = e(t.target).closest('[data-dismiss="fileupload"],[data-trigger="fileupload"]');
      r.length > 0 && (r.trigger("click.fileupload"), t.preventDefault())
    })
  }(window.jQuery)
</script>
<script>
  var segment = segments;
  $(() => {
    getCSRFtoken();
    getStep();
  });
  function getCSRFtoken() {
    $.ajax({
      type: "GET",
      url: `${base_url}CSRF/generateCSRF`,
      dataType: "json",
      success: function(response) {
        $('.txt_csrfname').val(response.token);
      }
    });
  }

  function getStep() {
    $.ajax({
      method: 'POST',
      url: `${base_url}Inspeksi/cek_step`,
      data: {
        id: segment
      },
      success: function(response) {
        getCSRFtoken();
        var wizard = $('#form_wizard_1').bootstrapWizard();
        wizard.bootstrapWizard('show', response.result);
        getStepFunction(response.result);
      }
    });
  }
  var getStep;
  var returnFail;
  function getStepFunction(response) {
    getStep = response;
  }
  $(document).ready(function() {
    $("#form_wizard_1").bootstrapWizard({
      nextSelector: ".btn-next",
      previousSelector: ".button-previous",
      onTabClick: function(e, r, t, i) {
        return !1
      },
      onNext: function(e, a, n) {
        let l = Ladda.create(document.querySelector('.next-step')),
          wizard = $('#form_wizard_1').bootstrapWizard(),
          res,
          current = wizard.bootstrapWizard('currentIndex'),
          nextStep = current + 1;
        l.start();
        setTimeout(function() {
          l.stop();
          $('#ajax').modal('hide');
        }, 1500);
        res = true
        $.ajax({
          type: "POST",
          data: {
            step: nextStep,
            dataVal: segment
          },
          url: `${base_url}Inspeksi/save_step`,
          success: function(response) {
            getCSRFtoken();
          }
        });
        return res;
      },
      onPrevious: function(e, r, a) {},
      onTabShow: function(e, r, t) {
        var i = r.find("li").length,
          a = t + 1,
          o = a / i * 100;
        $("#form_wizard_1").find(".progress-bar").css({
          width: o + "%"
        })
      }
    });



  });


  function popWin(x) {
    url = x;
    swin = window.open(url, 'win', 'scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
    swin.focus();
  }

  // Dealing with Textarea Height
  function calcHeight(value) {
    let numberOfLineBreaks = (value.match(/\n/g) || []).length;
    // min-height + lines x line-height + padding + border
    let newHeight = 20 + numberOfLineBreaks * 20 + 12 + 2;
    return newHeight;
  }

  function clickModal(a, b) {
    $('#responsive').modal('show');
    $('#dataId').val(a);
    $('#dataVal').val(b);
  }

  $('#responsive').on('hidden.bs.modal', function() {
    $(this)
      .find("input,textarea,select")
      .val('')
      .end()
      .find("input[type=checkbox], input[type=radio]")
      .prop("checked", "")
      .end();
  });


  $('.catatan-file').click(function(e) {
    $(".info-catatan").css("display", "none");
    $(".input-catatan").css("display", "block");
    $(".catatan-file").css("display", "none");
    $(".delete-catatan").css("display", "block");
  });

  $('.delete-catatan').click(function(e) {
    $(".info-catatan").css("display", "block");
    $(".input-catatan").css("display", "none");
    $(".catatan-file").css("display", "block");
    $(".delete-catatan").css("display", "none");
  });

  $('.berkas-file').click(function(e) {
    $(".info-berkas").css("display", "none");
    $(".input-berkas").css("display", "block");
    $(".berkas-file").css("display", "none");
    $(".delete-file").css("display", "block");
  });

  $('.delete-file').click(function(e) {
    $(".info-berkas").css("display", "block");
    $(".input-berkas").css("display", "none");
    $(".berkas-file").css("display", "block");
    $(".delete-file").css("display", "none");
  });

  $('.justifikasi-file').click(function(e) {
    $(".info-justifikasi").css("display", "none");
    $(".input-justifikasi").css("display", "block");
    $(".justifikasi-file").css("display", "none");
    $(".delete-justifikasi").css("display", "block");
  });

  $('.delete-justifikasi').click(function(e) {
    $(".info-justifikasi").css("display", "block");
    $(".input-justifikasi").css("display", "none");
    $(".justifikasi-file").css("display", "block");
    $(".delete-justifikasi").css("display", "none");
  });



  $('.back-button').click(function(e) {
    var isGood = confirm('Kembali Ke Tahap Sebelumnya?');
    if (isGood) {
      var wizard = $('#form_wizard_1').bootstrapWizard();
      wizard.bootstrapWizard('previous')
      let current = wizard.bootstrapWizard('currentIndex');
      $.ajax({
        type: "POST",
        data: {
          step: current,
          dataVal: segment
        },
        url: `${base_url}Inspeksi/save_step`,
        success: function(response) {
          getCSRFtoken();
        }
      });
    }
  });

  $(document).on('submit', 'form.step-wizard', function(e) {
    e.preventDefault();
    var $form = $(this);

    $.ajax({
      type: 'POST',
      url: `${base_url}Inspeksi/simpan_inspeksi`,
      data: new FormData(this),
      processData: false,
      contentType: false,
      enctype: 'multipart/form-data',
      beforeSend: function() {
        $(".loading").css("display", "block");
        $(".text-loader").css("display", "block");
        $(".btn-close").css("display", "none");
        $(".list-group").css("display", "none");
        $(".caption-message").css("display", "none");
        $(".btn-next").css("display", "none");
        $(".btn-repeat").css("display", "none");
      },
      success: function(response) {
        console.log(response);
        getCSRFtoken();
        if (response.status == false) {
          showToast(response.message, 15000, response.type);
        } else {
          setTimeout(function() {
            $(".list-group").css("display", "block");
            $(".btn-close").css("display", "block");
            $(".loading").css("display", "none");
            $(".text-loader").css("display", "none");
            $(".caption-message").css("display", "block");
            if (response.status == true) {
              $(".btn-next").css("display", "inline-block");
              let result = response.result;
              const message = $('.caption-message');
              message.html(`<h4 align="center" class="caption-subject font-green bold uppercase">Inspeksi Berhasil Diperiksa!</h4>`);
              const res = $('#result');
              res.empty();
              var tableResult;
              let numResult = 1;
              response.result.forEach(obj => {
                let status = obj.kesesuaian == 1 ? 'Sesuai <i class="fa fa-check"></i>' : 'Tidak <i class="fa fa-times"></i>';
                let label = obj.kesesuaian == 1 ? 'success' : 'danger';
                tableResult += '<tr style="text-align: center;">';
                tableResult += `<td>${numResult++}</td>`;
                tableResult += `<td>${obj.pemeriksaan}</td>`;
                tableResult += `<td><span class="badge badge-${label}"> ${status}</span></td>`;
                let oldFileBerkas = `${base_url}file/Konsultasi/${obj.id_pemilik}/Inspeksi/Dokumen/${obj.berkas_file}`;
                let newFileBerkas = `${base_url}dekill/Inspection/berkas/${obj.berkas_file}`;
                let resultBerkas = !checkFileExist(oldFileBerkas) ? newFileBerkas : oldFileBerkas;
                 //  baca file masih belum jalan / bug
                var resultOutput;
                function checkFileExist(url) {
                  var http = new XMLHttpRequest();

                    http.open('HEAD', url, false);
                    http.send();
                    if (http.status === 200) {
                      resultOutput = true;
                    } else {
                      resultOutput = false;
                    }
                  return resultOutput;
                }

                console.log(checkFileExist(oldFileBerkas));
                let berkas = obj.berkas_file == false ? 'Tidak ada dokumen' : `<a href="javascript:void(0);" class="btn default btn-xs blue-stripe" title="Lihat Berkas" onclick="javascript:popWin('${base_url}file/Konsultasi/${obj.id_pemilik}/Inspeksi/Dokumen/${obj.berkas_file}')"><span class="glyphicon glyphicon-file"></span>Lihat</a>`;
                let catatan = obj.catatan == false ? 'Tidak ada dokumen' : `<a href="javascript:void(0);" class="btn default btn-xs blue-stripe" title="Lihat Berkas" onclick="javascript:popWin('${base_url}file/Konsultasi/${obj.id_pemilik}/Inspeksi/Catatan/${obj.catatan}')"><span class="glyphicon glyphicon-file"></span>Lihat</a>`;
                let justifikasi = obj.berkas_justifikasi == false ? 'Tidak ada dokumen' : `<a href="javascript:void(0);" class="btn default btn-xs blue-stripe" title="Lihat Berkas" onclick="javascript:popWin('${base_url}file/Konsultasi/${obj.id_pemilik}/Inspeksi/Justifikasi/${obj.berkas_justifikasi}')"><span class="glyphicon glyphicon-file"></span>Lihat</a>`;
                tableResult += `<td>${berkas}</td>`;
                tableResult += `<td>${catatan}</td>`;
                tableResult += `<td>${justifikasi}</td></tr>`;
              });
              $('.result-inspeksi').html(tableResult);

            } else {
              $(".btn-repeat").css("display", "inline-block");
              let result = response.result;
              const message = $('.caption-message');
              message.html(`<h4 align="center" class="caption-subject font-red bold uppercase">Inspeksi Gagal</h4>`);
              const res = $('#result');
              res.empty();
              result.forEach(obj => {
                let status = obj.kesesuaian == 1 ? 'Sesuai <i class="fa fa-check"></i>' : 'Tidak <i class="fa fa-times"></i>';
                let label = obj.kesesuaian == 1 ? 'success' : 'danger';
                res.append(`<a href="javascript:;" class="list-group-item list-group-item-default"> ${obj.nm_dokumen}
                            <span class="badge badge-${label}"> ${status}</span>`);
              });
            }
          }, 1500);
          $('#ajax').modal('show');
        }

      }
    });
  });


  $(document).on('submit', 'form.final-wizard', function(e) {
    e.preventDefault();
    var $form = $(this);
    $.ajax({
      type: 'POST',
      url: `${base_url}Inspeksi/cek_data_inspeksi`,
      data: new FormData(this),
      processData: false,
      contentType: false,
      enctype: 'multipart/form-data',
      beforeSend: function() {
        $(".loading").css("display", "block");
        $(".text-loader").css("display", "block");
        $(".btn-close").css("display", "none");
        $(".list-group").css("display", "none");
        $(".caption-message").css("display", "none");
        $(".btn-next").css("display", "none");
        $(".btn-repeat").css("display", "none");
        $(".btn-maintain").css("display", "none");
        $(".btn-done").css("display", "none");
      },
      success: function(response) {
        getCSRFtoken();
        setTimeout(function() {
          if (response.res == false) {
            setTimeout(function() {
              showToast(response.message, 15000, response.type);
              l.stop();
              $(".btn-cancel").removeAttr("disabled");
              $(".btn-close").css("display", "block")
            }, 1500);
          } else {
            $(".list-group").css("display", "block");
            $(".btn-close").css("display", "block");
            $(".loading").css("display", "none");
            $(".text-loader").css("display", "none");
            $(".btn-done").css("display", "inline-block");
            $(".caption-message").css("display", "block");
            $('#ajax2').modal('show');
          }
        }, 1500);
      }
    });
  });

  function showToast(message, timeout, type) {
    type = (typeof type === 'undefined') ? 'info' : type;
    toastr.options = {
      "closeButton": true,
      "debug": false,
      "positionClass": "toast-top-right",
      "onclick": null,
      "showDuration": "1000",
      "hideDuration": "1000",
      "timeOut": timeout,
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
    toastr[type](message);
  }
</script>