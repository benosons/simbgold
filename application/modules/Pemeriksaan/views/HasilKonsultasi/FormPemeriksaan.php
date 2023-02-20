<style>
  th {
    text-align: center;
  }

  .modal.fade.in {
    top: 20%;
  }

  .modal-pemohon.fade.in {
    top: 50%;
  }

  .form-wizard .steps>li>a.step>.desc {
    display: block;
    font-size: 16px;
    font-weight: 300;
  }

  .txt_csrfname {
    display: none;
  }

  textarea.resize-ta {
    resize: vertical;
  }
</style>

<div class="row">
  <?php $this->load->view('HeaderPemeriksaan') ?>
  <div class="col-md-12">
    <div class="portlet light" id="form_wizard_1">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-edit font-blue"></i><span class="caption-subject font-blue bold uppercase">Pemeriksaan Hasil Konsultasi</span>
        </div>
      </div>
      <div class="portlet-body form">
        <div class="form-wizard">
          <div class="form-body">
            <ul class="nav nav-pills nav-justified steps">
              <li class="active">
                <a href="#tab1" data-toggle="tab" data-step="0" class="step" aria-expanded="true">
                  <span class="number"> 1 </span>
                  <span class="desc">
                    <i class="fa fa-check"></i> Pemeriksaan Arsitektur </span>
                </a>
              </li>
              <?php
              $finalisasi = $group == 0 ? '2' : '4';
              $tahapAkhir = $group == 0 ? '3' : '5';
              if ($group !== 0) : ?>
                <li>
                  <a href="#tab2" data-toggle="tab" data-step="1" class="step">
                    <span class="number"> 2 </span>
                    <span class="desc"><i class="fa fa-check"></i> Pemeriksaan Struktur</span>
                  </a>
                </li>

                <li>
                  <a href="#tab3" data-toggle="tab" data-step="2" class="step">
                    <span class="number"> 3 </span>
                    <span class="desc"><i class="fa fa-check"></i>Pemeriksaan MEP</span>
                  </a>
                </li>
              <?php endif; ?>
              <li>
                <a href="#tab4" data-toggle="tab" data-step="3" class="step">
                  <span class="number"> <?= $finalisasi ?> </span>
                  <span class="desc"><i class="fa fa-check"></i>Finalisasi Data Bangunan</span>
                </a>
              </li>
              <li>
                <a href="#tab5" data-toggle="tab" data-step="4" class="step">
                  <span class="number"> <?= $tahapAkhir ?> </span>
                  <span class="desc"><i class="fa fa-check"></i>Tahap Akhir</span>
                </a>
              </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab1">
                <div class="row">
                  <div class="col-md-12">
                    <div class="portlet box blue">
                      <div class="portlet-title">
                        <div class="caption">Pemeriksaan Arsitektur</div>
                      </div>
                      <div class="portlet-body">
                        <form action="#" role="form" method="post" class="step-wizard" id="formOne" enctype="multipart/form-data">
                          <div class="form-body">
                            <table class="table table-bordered table-striped table-hover">
                              <thead>
                                <tr>
                                  <th rowspan="2" class="info"><center>No</center></th>
                                  <th colspan="3" class="info"><center>Persyaratan</center></th>
                                  <th colspan="2" class="warning"><center>Perbaikan dari TIM TPT/TPA</center></th>
                                  <th rowspan="2" class="info" width="12%"><center>Aksi</center></th>
                                </tr>
                                <tr>
                                  <th class="info" colspan="3">Detail</th>
                                  <th class="warning">Kesesuaian</th>
                                  <th class="warning"><center>Catatan &amp; Dokumen</center></th>
                                </tr>
                              </thead>
                              <tbody class="table-persyaratan"></tbody>
                            </table>
                            <div class="row">
                              <div class="col-md-6">
                                <a href="<?= site_url('Pemeriksaan/Penilaian') ?>" class="btn btn-primary btn-block btn-back"><i class="fa fa-arrow-left"></i> Kembali</a>
                              </div>
                              <div class="col-md-6">
                                <input type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                <button type="submit" name="submit" class="btn green btn-block save-step" id="saveStep"><i class="fa fa-save"></i> Simpan dan Lanjutkan</button>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php if ($group !== 0) : ?>
                <div class="tab-pane" id="tab2">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="portlet box blue">
                        <div class="portlet-title">
                          <div class="caption">Pemeriksaan Struktur</div>
                        </div>
                        <div class="portlet-body">
                          <form action="#" role="form" method="post" class="step-wizard" id="formTwo" enctype="multipart/form-data">
                            <div class="form-body">
                              <table class="table table-bordered table-striped table-hover">
                                <thead>
                                  <tr>
                                    <th rowspan="2" class="info"><center>No</center></th>
                                    <th colspan="3" class="info"><center>Persyaratan</center></th>
                                    <th colspan="2" class="warning"><center>Perbaikan dari TIM TPT/TPA</center></th>
                                    <th rowspan="2" class="info" width="10%"><center>Aksi</center></th>
                                  </tr>
                                  <tr>
                                    <th class="info" colspan="3">Detail</th>
                                    <th class="warning">Kesesuaian</th>
                                    <th class="warning"><center>Catatan &amp; Dokumen</center></th>
                                  </tr>
                                </thead>
                                <tbody class="table-persyaratan"></tbody>
                              </table>
                              <div class="row">
                                <div class="col-md-6"><a href="javascript:void(0);" class="btn btn-primary btn-block back-button"><i class="fa fa-arrow-left"></i> Kembali</a></div>
                                <div class="col-md-6">
                                  <input type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                  <button type="submit" name="submit" class="btn green btn-block save-step" id="saveStep"><i class="fa fa-save"></i>Simpan dan Lanjutkan</button>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="tab3">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="portlet box blue">
                        <div class="portlet-title">
                          <div class="caption">Pemeriksaan MEP</div>
                        </div>
                        <div class="portlet-body">
                          <form action="#" role="form" method="post" class="step-wizard" id="formThree" enctype="multipart/form-data">
                            <div class="form-body">
                              <table class="table table-bordered table-striped table-hover">
                                <thead>
                                  <tr>
                                    <th rowspan="2" class="info"><center>No</center></th>
                                    <th colspan="3" class="info"><center>Persyaratan</center></th>
                                    <th colspan="2" class="warning"><center>Perbaikan dari TIM TPT/TPA</center></th>
                                    <th rowspan="2" class="info" width="10%"><center>Aksi</center></th>
                                  </tr>
                                  <tr>
                                    <th class="info" colspan="3">Detail</th>
                                    <th class="warning">Kesesuaian</th>
                                    <th class="warning"><center>Catatan &amp; Dokumen</center></th>
                                  </tr>
                                </thead>
                                <tbody class="table-persyaratan">
                                </tbody>
                              </table>
                              <div class="row">
                                <div class="col-md-6">
                                  <a href="javascript:void(0);" class="btn btn-primary btn-block back-button"><i class="fa fa-arrow-left"></i> Kembali</a>
                                </div>
                                <div class="col-md-6">
                                  <input type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                  <button type="submit" name="submit" class="btn green btn-block save-step" id="saveStep"><i class="fa fa-save"></i> Simpan dan Lanjutkan</button>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endif; ?>
              <div class="tab-pane" id="tab4">
                <div class="row">
                  <div class="col-md-12">
                    <div class="portlet box blue">
                      <div class="portlet-title">
                        <div class="caption">Finalisasi Data Bangunan</div>
                      </div>
                      <div class="portlet-body">
                        <form action="#" role="form" method="post" class="final-identity form-horizontal" id="formFourth">
                          <input type="hidden" class="form-control" name="id" id="idPemilik" placeholder="id" autocomplete="off">
                          <input type="hidden" class="form-control" name="id_bgn" id="idBangunan" placeholder="id Bangunan" autocomplete="off">
                          <div class="portlet-title margin-bottom-10">
                            <div class="page-title" align="center">
                              <span class="caption font-blue-hoki bold" style="font-size: 22px;"> Data Kepemilikan Bangunan</span>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-3" for="jenisKepemilikan">Jenis Kepemilikan<span class="required">* </span></label>
                            <div class="col-md-7">
                              <select name="jns_kepemilikan" id="jenisKepemilikan" class="form-control">
                                <option value="0">-Pilih-</option>
                                <option value="1">Pemerintah</option>
                                <option value="2">Badan Usaha</option>
                                <option value="3">Perorangan</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-3">Nama Pemilik<span class="required">*</label>
                            <div class="col-md-7">
                              <div><input type="text" class="form-control" id="namaPemilik" name="nama_pemilik" placeholder="Nama Pemilik" autocomplete="off"></div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-md-3 control-label">Jenis ID</label>
                            <div class="col-md-7">
                              <select name="jenis_id" class="form-control" id="jenisID" aria-invalid="false">
                                <option value="1">KTP</option>
                                <option value="2">KITAS</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group" id="ktp" style="display: none;">
                            <label class="col-md-3 control-label">Nomor KTP</label>
                            <div class="col-md-7">
                              <input type="text" maxlength="16" class="allownumericwithoutdecimal form-control" name="no_ktp" id="noKTP" placeholder="Nomor KTP" autocomplete="off">
                            </div>
                          </div>
                          <div class="form-group" id="kitas" style="display: none;">
                            <label class="col-md-3 control-label">No. KITAS</label>
                            <div class="col-md-7">
                              <input type="text" class="form-control" name="no_kitas" id="noKITAS" placeholder="Nomor KITAS" autocomplete="off">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-md-3 control-label" for="provinsiPemilik">Provinsi<span class="required">*</label>
                            <div class="col-md-7">
                              <select name="provinsiPemilik" id="provinsiPemilik" class="form-control select2" data-placeholder="Select...">
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-md-3 control-label">Kabupaten/Kota<span class="required">*</label>
                            <div class="col-md-7">
                              <select name="kabkotaPemilik" id="kabKotaPemilik" class="form-control select2" data-placeholder="Select...">
                                <option value="">-- Pilih Kabupaten / Kota --</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-md-3 control-label">Kecamatan<span class="required">*</label>
                            <div class="col-md-7">
                              <select name="kecamatanPemilik" id="kecamatanPemilik" class="form-control select2" data-placeholder="Select...">
                                <option value="">-- Pilih Kecamatan --</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-md-3 control-label">Kelurahan/Desa<span class="required">*</label>
                            <div class="col-md-7">
                              <select name="kelurahanPemilik" id="kelurahanPemilik" class="form-control select2" data-placeholder="Select...">
                                <option value="">-- Pilih Kelurahan/Desa --</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-md-3 control-label">Alamat Pemilik<span class="required">*</label>
                            <div class="col-md-7">
                              <textarea type="text" class="form-control" name="alamat_pemilik" id="alamatPemilik" placeholder="Alamat Pemilik" autocomplete="off"><?php echo set_value('almt_bgn', (isset($alamat) ? $alamat : '')) ?></textarea>
                            </div>
                          </div>
                          <div class="portlet-title margin-top-10">
                            <div class="page-title" align="center">
                              <span class="caption font-blue-hoki bold" style="font-size: 22px;"> Data Bangunan Gedung</span>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-md-3 control-label" for="nama_provinsi">Provinsi<span class="required">*</label>
                            <div class="col-md-7">
                              <select name="nama_provinsi" id="nama_provinsi" class="form-control select2" data-placeholder="Select...">
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-md-3 control-label">Kabupaten/Kota<span class="required">*</label>
                            <div class="col-md-7">
                              <select name="nama_kabkota" id="nama_kabkota" class="form-control select2" data-placeholder="Select...">
                                <option value="">-- Pilih Kabupaten / Kota --</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-md-3 control-label">Kecamatan<span class="required">*</label>
                            <div class="col-md-7">
                              <select name="nama_kecamatan" id="nama_kecamatan" class="form-control select2" data-placeholder="Select...">
                                <option value="">-- Pilih Kecamatan --</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-md-3 control-label">Kelurahan/Desa<span class="required">*</label>
                            <div class="col-md-7">
                              <select name="nama_kelurahan" id="nama_kelurahan" class="form-control select2" data-placeholder="Select...">
                                <option value="">-- Pilih Kelurahan/Desa --</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-md-3 control-label">Alamat Bangunan</label>
                            <div class="col-md-7">
                              <textarea type="text" class="form-control" name="almt_bgn" id="alamatBangunan" placeholder="Alamat Bangunan" autocomplete="off"><?php echo set_value('almt_bgn', (isset($DataBangunan->almt_bgn) ? $DataBangunan->almt_bgn : '')) ?></textarea>
                            </div>
                          </div>
                          <div class="form-group">
                            <input type="hidden" name="jenis_konsultasi" id="jenisKonsultasi">
                            <label class="control-label col-md-3">Jenis Permohonan Konsultasi<span class="required">* </span></label>
                            <div class="col-md-7">
                              <select name="id_izin" class="form-control" id="selectJenisKonsultasi">
                                <option value="">--Pilih--</option>
                              </select>
                            </div>
                          </div>
                          <div id="perIMB" style="display: none;">
                            <div class="form-group row">
                              <label class="control-label col-md-3">Memiliki IMB/PBG <span class="required" aria-required="true">* </span></label>
                              <div class="col-md-7">
                                <div class="radio-list">
                                  <label><input type="radio" name="imb" class="radio-imb" value="1"> Iya</label>
                                  <label><input type="radio" name="imb" class="radio-imb" value="0"> Tidak</label>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div id="showIMB" style="display:none;">
                            <div class="form-group row">
                              <label class="control-label col-md-3">No. IMB</label>
                              <div class="col-md-7">
                                <div class="checkbox-list">
                                  <input type="text" class="form-control" id="nomorIMB" maxlength="50" name="no_imb" placeholder="No IMB" autocomplete="off">
                                </div>
                              </div>
                            </div>
                          </div>
                          <div id="perSLF" style="display:none;">
                            <div class="form-group row">
                              <label class="control-label col-md-3">Memiliki SLF<span class="required">* </span></label>
                              <div class="col-md-7">
                                <div class="radio-list">
                                  <label><input type="radio" name="slf" class="radio-slf" value="1"> Iya</label>
                                  <label><input type="radio" name="slf" class="radio-slf" value="0"> Tidak</label>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div id="showSLF" style="display:none;">
                            <div class="form-group row">
                              <label class="control-label col-md-3">No. SLF</label>
                              <div class="col-md-5">
                                <div class="checkbox-list">
                                  <input type="text" class="form-control" maxlength="50" id="nomorSLF" name="no_slf" placeholder="No SLF" autocomplete="off">
                                </div>
                              </div>
                            </div>
                          </div>

                          <div id="perCetak" style="display:none;">
                            <div class="form-group row">
                              <label class="control-label col-md-3">Cetak Ulang<span class="required">* </span></label>
                              <div class="col-md-7">
                                <div class="radio-list">
                                  <label><input type="checkbox" name="cetak[]" value="1"> IMB/PBG</label>
                                  <label><input type="checkbox" name="cetak[]" value="2"> SLF</label>
                                  <label><input type="checkbox" name="cetak[]" value="3"> SBKBG</label>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div id="permohonan_slf_show" style="display: block;">
                            <div class="form-group">
                              <label class="control-label col-md-3">Permohonan SLF<span class="required" aria-required="true">*</span></label>
                              <div class="col-md-7">
                                <select name="permohonan_slf" class="form-control" id="permohonanSLF">
                                  <option value="">--Pilih--</option>
                                  <option value="1">Bangunan Gedung</option>
                                  <option value="2">Bangunan Prasarana</option>
                                  <option value="3">Prototipe/Purwarupa SPBU Mikro 3 (TIGA) Kiloliter</option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div id="KolektifInduk" style="display:none;">
                            <div class="form-group">
                              <label class="control-label col-md-3">Nama Bangunan<span class="required">* </span></label>
                              <div class="col-md-7">
                                <input type="text" class="form-control nama-bangunan" name="nama_bangunan_kolektif" placeholder="Nama Bangunan" autocomplete="off">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3">Tipe Bangunan<span class="required">* </span></label>
                              <div class="col-md-7">
                                <div class="col-md-3">
                                  <table class="table table-striped table-bordered dt-responsive wrap" id="tipe_bgn">
                                    <tr>
                                      <th>Tipe</th>
                                      <th>Luas</th>
                                      <th>Tinggi</th>
                                      <th>Lantai</th>
                                      <th>Jumlah Unit</th>
                                      <th width="5%">Aksi</th>
                                    </tr>
                                    <tr id="tr-tipe">
                                      <td><input type="text" name="tipeA[1]" value="" style="width:80px;" id="posisi1" class="posisi1 form-control" /></td>
                                      <td><input type="text" name="luasA[1]" value="" style="width:80px;" id="luas1" class="unit1 form-control" /></td>
                                      <td><input type="text" name="tinggiA[1]" value="" style="width:80px;" id="tinggi1" class="tinggi1 form-control" /></td>
                                      <td><input type="text" name="lantaiA[1]" value="" style="width:80px;" id="lantai1" class="lantai1 form-control" /></td>
                                      <td><input type="text" name="jumlahA[1]" value="" style="width:80px;" id="jumlah1" class="jumlah1 form-control" /></td>
                                      <td><a class="btn btn-info" href="javascript:void(0);" onclick="if(checkDeleteTipeRow() == true){$(this).parent().parent().remove()}"><i class="fa fa-trash left-icon"></i></a></td>
                                    </tr>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div id="fungsibg" class="form-group" style="display:none;">
                            <label class="control-label col-md-3">Fungsi Bangunan<span class="required">* </span></label>
                            <div class="col-md-7">
                              <select name="id_fungsi_bg" id="selectFungsiBG" class="form-control"></select>
                            </div>
                          </div>
                          <div id="jual_bg" style="display:none;">
                            <div class="form-group row">
                              <label class="control-label col-md-3">Bangunan akan dijual perunit bangunan<span class="required">* </span></label>
                              <div class="col-md-5">
                                <div class="radio-list">
                                  <label><input type="radio" name="jual" class="radio-jual" value="1"> Iya</label>
                                  <label><input type="radio" name="jual" class="radio-jual" value="0"> Tidak</label>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div id="jns_bg_toggle" class="form-group" style="display:none;">
                            <label class="control-label col-md-3">Jenis Bangunan <span class="required">* </span></label>
                            <div class="col-md-7">
                              <select name="id_jns_bg" id="selectJenisBangunan" class="form-control"></select>
                            </div>
                          </div>
                          <div class="form-group" id="campurincek" style="display: none;">
                            <label class="control-label col-md-3">Jenis Bangunan <span class="required">*minimal 2</span></label>
                            <div class="col-md-7 checkbox-inline">
                              <label><input type="checkbox" id="checkBoxBangunan1" class="form-control" data-id="1" name="dcampur[]" value="1"> Hunian </label>
                              <label><input type="checkbox" id="checkBoxBangunan2" class="form-control" data-id="2" name="dcampur[]" value="2"> Keagamaan </label>
                              <label><input type="checkbox" id="checkBoxBangunan3" class="form-control" data-id="3" name="dcampur[]" value="3"> Usaha </label>
                              <label><input type="checkbox" id="checkBoxBangunan4" class="form-control" data-id="4" name="dcampur[]" value="4"> Sosial & Budaya </label>
                            </div>
                          </div>
                          <div id="prasarana" style="display: none;">
                            <div class="form-group">
                              <label class="control-label col-md-3">Prasarana<span class="required">* </span></label>
                              <div class="col-md-5">
                                <select class="form-control" name="id_prasarana_bg" id="idPrasaranaBG">
                                  <option value="">--Pilih--</option>
                                  <option value="1">Kontruksi Pembatas/Penahan/Pengaman</option>
                                  <option value="2">Konstruksi Penanda Masuk Lokasi</option>
                                  <option value="3">Kontruksi Perkerasan</option>
                                  <option value="4">Kontruksi Penghubung</option>
                                  <option value="5">Kontruksi Kolam/Reservoir bawah tanah</option>
                                  <option value="6">Kontruksi Menara</option>
                                  <option value="7">Kontruksi Monumen</option>
                                  <option value="8">Kontruksi Instalasi/gardu</option>
                                  <option value="9">Kontruksi Reklame / Papan Nama</option>
                                  <option value="10">Fondasi mesin (diluar bangunan)</option>
                                  <option value="11">Kontruksi Menara Televisi</option>
                                  <option value="12">Kontruksi Antena Radio</option>
                                  <option value="13">Kontruksi Antena (Tower Telekomunikasi)</option>
                                  <option value="14">Tangki Tanam Bahan Bakar</option>
                                  <option value="15">Pekerjaan Drainase (dalam persil)</option>
                                  <option value="16">Kontruksi penyimpanan / silo</option>
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3">Luas Bangunan Prasarana<span class="required">* </span></label>
                              <div class="col-md-3">
                                <div class="checkbox-list">
                                  <input type="text" class="form-control luas-bgp" value="" id="luasBGP" name="luas_bgp" placeholder="Luas Bangunan" autocomplete="off">
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3">Tinggi Bangunan Prasarana<span class="required">* </span></label>
                              <div class="col-md-3">
                                <div class="checkbox-list">
                                  <input type="text" class="form-control tinggi-bgp" value="" name="tinggi_bgp" placeholder="Tinggi Bangunan" autocomplete="off">
                                </div>
                              </div>
                            </div>
                          </div>
                          <div id="detail_bg" style="display:none;">
                            <div class="form-group">
                              <label class="control-label col-md-3">Nama Bangunan<span class="required">* </span></label>
                              <div class="col-md-7">
                                <input type="text" class="form-control nama-bangunan" id="namaBangunan" name="nama_bangunan" placeholder="Jenis/Nama Usaha" autocomplete="off">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3">Luas Bangunan</label>
                              <div class="col-md-7">
                                <div class="checkbox-list">
                                  <input type="text" class="form-control input-comma" name="luas_bg" id="luasBG" onblur="loadDocTeknis()" placeholder="Luas Bangunan" autocomplete="off">
                                </div>
                              </div>
                              <label class="control-label">m<sup>2</sup></label>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3">Jumlah Lantai Bangunan<span class="required">* </span></label>
                              <div class="col-md-7">
                                <div class="checkbox-list">
                                  <select name="lantai_bg" id="selectLantaiBG" onblur="loadDocTeknis()" class="form-control dropdown-lantai">

                                  </select>
                                  <input type="number" class="form-control input-lantai input-number" style="display: none;" name="lantai_bg" id="lantaiBG" onblur="loadDocTeknis()" placeholder="Jumlah Lantai Bangunan Gedung" autocomplete="off" disabled="">
                                </div>
                                <input type="checkbox" name="pilihan" id="pilihanLantai">
                                <label class="control-label">Centang Apabila lebih dari 10 Lantai</label>
                              </div>
                              <label class="control-label"></label>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3">Tinggi Bangunan<span class="required">* </span></label>
                              <div class="col-md-7">
                                <div class="checkbox-list">
                                  <input type="text" class="form-control input-comma" name="tinggi_bg" id="tinggiBG" onblur="loadDocTeknis()" placeholder="Tinggi Bangunan" autocomplete="off">
                                </div>
                              </div>
                              <label class="control-label">M</label>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3">Luas Basement Bangunan</label>
                              <div class="col-md-7">
                                <div class="checkbox-list">
                                  <input type="text" class="form-control input-comma" id="luasBasement" name="luas_basement" placeholder="Luas Basement Bangunan" autocomplete="off">
                                </div>
                              </div>
                              <label class="control-label">m<sup>2</sup></label>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3">Jumlah Lapis Basement Bangunan</label>
                              <div class="col-md-7">
                                <div class="checkbox-list">
                                  <select name="lapis_basement" id="selectBasement" class="form-control dropdown-basement">
                                  </select>
                                  <input type="number" class="form-control input-basement" id="lapisBasement" style="display:none;" name="lapis_basement" placeholder="Jumlah Lapis Basement Bangunan" autocomplete="off" disabled="">
                                </div>
                                <input type="checkbox" name="pilihan_basement" class="input-number" id="pilihanBasement">
                                <label class="control-label">Centang Apabila lebih dari 10 Lapis</label>
                              </div>
                              <label class="control-label"></label>
                            </div>
                          </div>
                          <div id="spbu_micro" style="display: none;">
                            <div class="form-group">
                              <label class="control-label col-md-3">Nama Bangunan<span class="required" aria-required="true">*</span></label>
                              <div class="col-md-7">
                                <input type="text" class="form-control nama-bangunan" name="nama_bangunan_prasarana" placeholder="Nama Bangunan" autocomplete="off">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3">Luas Bangunan<span class="required" aria-required="true">*</span></label>
                              <div class="col-md-7">
                                <div class="checkbox-list">
                                  <input type="text" class="form-control luas-bgp" name="luas_bgp1" placeholder="" autocomplete="off" readonly="">
                                </div>
                              </div>
                              <div class="col-md-2">
                                m<sup>2</sup>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3">Tinggi Bangunan<span class="required" aria-required="true">*</span></label>
                              <div class="col-md-7">
                                <div class="checkbox-list">
                                  <input type="text" class="form-control tinggi-bgp" name="tinggi_bgp1" placeholder="Tinggi Bangunan" autocomplete="off" readonly="">
                                </div>
                              </div>
                              <div class="col-md-2">
                                m<sup>2</sup>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3">Lantai Bangunan<span class="required" aria-required="true">*</span></label>
                              <div class="col-md-7">
                                <div class="checkbox-list">
                                  <input type="text" class="form-control lantai-bgp" name="lantai_bg1" placeholder="Lantai Bangunan" autocomplete="off" readonly="">
                                </div>
                              </div>
                            </div>
                          </div>
                          <div id="dokumenTeknis" style="display: none;">
                            <div class="form-group">
                              <label class="col-md-3 control-label">Dokumen Teknis</label>
                              <div class="col-md-7">
                                <select name="id_doc_tek" id="selectDokumenTeknis" class="form-control" data-placeholder="Select..."></select>
                              </div>
                            </div>
                          </div>
                          <div id="prototype" style="display: none;">
                            <div class="form-group">
                              <label class="col-md-3 control-label">Pilih Prototype</label>
                              <div class="col-md-7">
                                <select name="id_prototype" id="selectPrototype" class="form-control" data-placeholder="Select..."></select>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <a href="javascript:void(0);" class="btn btn-primary btn-block back-button"><i class="fa fa-arrow-left"></i> Kembali</a>
                            </div>
                            <div class="col-md-6">
                              <button type="submit" name="submit" class="btn green btn-block" id="saveIdentity"><i class="fa fa-save"></i> Simpan dan Lanjutkan</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tab5">
                <div class="row">
                  <div class="col-md-12">
                    <div class="portlet box blue">
                      <div class="portlet-title">
                        <div class="caption">
                          Pemeriksaan Tahap Akhir
                        </div>
                      </div>
                      <div class="portlet-body">
                        <form action="<?= site_url('Pemeriksaan/SavePenilaian') ?>" role="form" method="post" id="formThree" enctype="multipart/form-data">
                          <div class="form-body">
                            <input type="hidden" name="id" value="<?= $this->uri->segment(3) ?>">
                            <input type="hidden" name="email" value="<?php echo $email; ?>">
                            <input type="hidden" name="no_konsultasi" value="<?php echo $no_konsultasi; ?>">
                            <input type="hidden" name="imb" value="<?php echo $imb; ?>">
                            <input type="hidden" name="id_jenis_permohonan" value="<?php echo $id_jenis_permohonan; ?>">
                            <div class="form-group">
                              <label class="control-label col-md-3">No.Berita Acara</label>
                              <div class="row">
                                <div class="col-md-4">
                                  <input type="text" class="form-control" name="nomor_berita" placeholder="Nomor Berita Acara" required></span>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3">Tgl.Berita Acara</label>
                              <div class="row">
                                <div class="col-md-4">
                                  <input class="form-control date-picker" data-date-format="yyyy-mm-dd" type="text" name="tgl_berita" placeholder="Tanggal Berita Acara" autocomplete="off" onkeydown="return false" required>
                                </div>
                              </div>
                            </div>
                            <?php if ($id_izin == '2') : ?>
                              <div class="form-group">
                                <label class="control-label col-md-3">Okupansi Bangunan Gedung</label>
                                <div class="row">
                                  <div class="col-md-4">
                                    <input type="text" class="form-control" name="okupansi" placeholder="Okupansi Bangunan Gedung" required></span>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-md-3">Luas Dasar Bangunan</label>
                                <div class="row">
                                  <div class="col-md-4">
                                    <input type="text" class="form-control" name="luas_dasar" placeholder="Luas Dasar Bangunan" required></span>
                                  </div>
                                </div>
                              </div>
                            <?php endif; ?>
                            <div class="form-group">
                              <label class="control-label col-md-3">Berita Acara/Rekomendasi Hasil Konsultasi
                              </label>
                              <div class="row">
                                <div class="col-md-4"><input type="file" id="inputFile" name="berkas"></div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <a href="javascript:void(0);" class="btn btn-primary btn-block back-button"><i class="fa fa-arrow-left"></i> Kembali</a>
                              </div>
                              <div class="col-md-6">
                                <input type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                <button type="submit" name="submit" class="btn green btn-block"><i class="fa fa-save"></i> Simpan</button>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                    <!-- END Portlet PORTLET-->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="ajax" class="modal container fade" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close btn-close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">Hasil Penilaian Konsultasi</h4>
          </div>
          <div class="modal-body">
            <div class="caption-message"></div>
            <img src="<?php echo base_url() ?>assets/global/img/loading-spinner-grey.gif" alt="" class="loading">
            <span class="text-loader"> &nbsp;&nbsp;Loading... </span>
            <div class="list-group">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr class="info">
                        <th>
                          No
                        </th>
                        <th>Persyaratan</th>
                        <th>Kesesuaian</th>
                      </tr>
                    </thead>
                    <tbody class="data-kesesuaian">
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn blue btn-info btn-maintain"><i class="fa fa-edit"></i> Kembalikan Ke Pemohon</button>
            <button type="button" data-dismiss="modal" class="btn red btn-reject"><i class="fa fa-times"></i> Tolak Permohonan</button>
            <button type="submit" id="btnNext" class="btn green btn-next-step ladda-button" data-style="expand-right" data-size="l"><span class="ladda-label"><i class="fa fa-save"></i> Lanjutkan</span></button>
            <button type="button" data-dismiss="modal" class="btn btn-primary btn-repeat"><i class="fa fa-sign-out"></i> Tutup</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="responsive" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false">
  <form action="#" role="form" method="post" id="changeBerkas" enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close btn-close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Ubah Berkas</h4>
      </div>
      <div class="modal-body">
        <div class="form-body">
          <p style="text-align:center;color:red;"> Note: Harap Memasukan Lampiran Menggunakan Format PDF</p>
          <div class="form-group">
            <input type="hidden" name="dataKonsultasi" id="dataKonsultasi">
            <input type="hidden" name="dataId" id="dataId">
            <input type="hidden" name="dataVal" id="dataVal">
            <label class="col-md-3 control-label">Lampiran</label>
            <div class="col-md-9">
              <input type="file" id="inputFile" name="berkas">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <input type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>"><br>
        <button type="button" data-dismiss="modal" class="btn btn-primary btn-cancel"><i class="fa fa-sign-out"></i> Batal</button>
        <button type="submit" id="form-submit" class="btn green ladda-button" data-style="expand-right" data-size="l"><span class="ladda-label"><i class="fa fa-save"></i> Simpan</span></button>
        <!-- <a href="javascript:void(0);" id="form-submit" class="btn green ladda-button" data-style="expand-right" data-size="l"><span class="ladda-label"><i class="fa fa-save"></i> Simpan</span></a> -->
      </div>
    </div>
    <?php echo form_close(); ?>
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
            <label class="col-md-3 control-label">Nomor SK</label>
            <div class="col-md-9">
              <input class="form-control" type="text" name="no_skperbaikan" placeholder="Nomor SK Perbaikan" autocomplete="off">
              <input type="hidden" name="konsultasi" id="noKonsultasi">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Tanggal Perbaikan</label>
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
        <input type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>"><br>
        <button type="button" data-dismiss="modal" class="btn btn-primary btn-cancel"><i class="fa fa-sign-out"></i> Batal</button>
        <button type="submit" id="perbaikanSurat" class="btn green ladda-button" data-style="expand-right" data-size="l"><span class="ladda-label"><i class="fa fa-save"></i> Kirim</span></button>
      </div>
    </div>
    <?php echo form_close() ?>
</div>

<div id="tolak" class="modal modal-pemohon fade" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false">
  <form action="<?= site_url('Pemeriksaan/tolakPermohonan') ?>" role="form" method="post" id="tolakPermohonan" class="form-horizontal" enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close btn-close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Tolak Permohonan</h4>
      </div>
      <div class="modal-body">
        <div class="form-body">
          <div class="form-group">
            <label class="col-md-3 control-label">Keterangan*</label>
            <div class="col-md-9">
              <input class="form-control" type="text" name="catatan" required placeholder="Keterangan / Catatan" autocomplete="off">
              <input type="hidden" name="konsultasi" id="konsultasiID">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Tanggal *</label>
            <div class="col-md-9">
              <input class="form-control date-picker" data-date-format="yyyy-mm-dd" required type="text" name="tanggal" placeholder="Tanggal Permohonan Ditolak" autocomplete="off" onkeydown="return false">
            </div>
          </div>

        </div>
      </div>
      <div class="modal-footer">
        <input type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>"><br>
        <button type="button" data-dismiss="modal" class="btn btn-primary btn-cancel"><i class="fa fa-sign-out"></i> Batal</button>
        <button type="submit" id="tolakPermohonanBerkas" class="btn green ladda-button" data-style="expand-right" data-size="l"><span class="ladda-label"><i class="fa fa-save"></i> Kirim</span></button>
      </div>
    </div>
    <?php echo form_close() ?>
</div>
<script>
  var site_url = '<?php echo site_url(); ?>';
  var segment = '<?= $this->uri->segment(3) ?>';
</script>
<script defer src="<?php echo base_url()?>assets/app/js/pemeriksaan.min.js"></script>