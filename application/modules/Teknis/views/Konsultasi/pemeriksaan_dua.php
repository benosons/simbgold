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

  .form-wizard .steps>li>a.step>.desc {
    display: block;
    font-size: 16px;
    font-weight: 300;
  }
</style>

<div class="row">
  <?php $this->load->view('header_penilaian') ?>
  <div class="col-md-12">
    <div class="portlet light " id="form_wizard_1">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-edit font-red"></i>
          <span class="caption-subject font-red bold uppercase">Penilaian Konsultasi
          </span>
        </div>
      </div>
      <div class="portlet-body form">
        <div class="form-wizard">
          <div class="form-body">
            <ul class="nav nav-pills nav-justified steps">
              <li class="active">
                <a href="#tab1" data-toggle="tab" class="step" aria-expanded="true">
                  <span class="number"> 1 </span>
                  <span class="desc">
                    <i class="fa fa-check"></i> Pemeriksaan Arsitektur </span>
                </a>
              </li>
              <li>
                <a href="#tab2" data-toggle="tab" class="step">
                  <span class="number"> 2 </span>
                  <span class="desc">
                    <i class="fa fa-check"></i> Pemeriksaan Struktur</span>
                </a>
              </li>
              <li>
                <a href="#tab3" data-toggle="tab" class="step">
                  <span class="number"> 3 </span>
                  <?php if ($id_izin == '2') { ?>
                    <span class="desc"><i class="fa fa-check"></i>Data Teknis Gedung Eksisting</span>
                  <?php } else { ?>
                    <span class="desc"><i class="fa fa-check"></i> Data MEP</span>
                  <?php } ?>
                </a>
              </li>
              <li>
                <a href="#tab4" data-toggle="tab" class="step">
                  <span class="number"> 4 </span>
                  <span class="desc">
                    <i class="fa fa-check"></i>Finalisasi Data Bangunan</span>
                </a>
              </li>
              <li>
                <a href="#tab5" data-toggle="tab" class="step">
                  <span class="number"> 5 </span>
                  <span class="desc">
                    <i class="fa fa-check"></i>Tahap Akhir</span>
                </a>
              </li>
            </ul>
            <!-- <div id="bar" class="progress progress-striped" role="progressbar">
              <div class="progress-bar progress-bar-success" style="width: 25%;"> </div>
            </div> -->
            <div class="tab-content">
              <!-- alert -->
              <!-- panel 1 -->
              <div class="tab-pane active" id="tab1">
                <div class="row">
                  <div class="col-md-12">
                    <!-- BEGIN Portlet PORTLET-->
                    <div class="portlet box blue">
                      <div class="portlet-title">
                        <div class="caption">
                          Pemeriksaan Arsitektur
                        </div>
                      </div>
                      <div class="portlet-body">
                        <form action="#" role="form" method="post" class="step-wizard" id="formOne" enctype="multipart/form-data">
                          <div class="form-body">
                            <table class="table table-bordered table-striped table-hover">
                              <tbody>
                                <tr>
                                  <th rowspan="2" class="info">
                                    <center>No</center>
                                  </th>
                                  <th colspan="3" class="info">
                                    <center>Persyaratan</center>
                                  </th>
                                  <th colspan="2" class="danger">
                                    <center>Perbaikan dari TIM TPT/TPA</center>
                                  </th>
                                  <th rowspan="2" class="info">
                                    <center>Aksi</center>
                                  </th>
                                </tr>
                                <tr>
                                  <th class="info" colspan="3">Detail</th>
                                  <th class="danger">Kesesuaian</th>
                                  <th class="danger">
                                    <center>Catatan &amp; Dokumen</center>
                                  </th>
                                </tr>
                                <?php $no = 1;
                                foreach ($arsitektur as $r) : ?>
                                  <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td colspan="3" style="text-align:left;"><?php echo $r->nm_dokumen ?></td>
                                    <td>
                                      <?php
                                      $row_doc1 = $this->Mteknis->getDataPenilaian($id_konsultasi, $r->id_detail, $r->id_detail_jenis_persyaratan)->row();
                                      $cek1 = isset($row_doc1->kesesuaian) ? $row_doc1->kesesuaian : null;
                                      $catatan1 = isset($row_doc1->catatan) ? $row_doc1->catatan : '';
                                      $berkas_file1 = isset($row_doc1->dir_file) ? $row_doc1->dir_file : '';
                                      $css1 = $cek1 != 0 && $cek1 != NULL ? 'none' : 'block';
                                      ?>

                                      <input type="hidden" name="id_konsultasi" id="idKonsultasi" value="<?php echo $id_konsultasi ?>">

                                      <input type="hidden" name="id_jenis" id="idJenis" value="<?= $r->id_jenis_permohonan ?>">
                                      <input type="hidden" name="id_jenis_syarat" id="idSyarat" class="data-syarat" value="<?= $r->id_detail_jenis_persyaratan ?>">
                                      <input type="checkbox" class="make-switch" id="checkData" data-konsultasi="<?= $id_konsultasi ?>" data-val="<?= $r->id_detail_jenis_persyaratan ?>" data-id="<?= $r->id_detail ?>" <?= $cek1 != 0 && $cek1 != NULL ? 'checked' : '' ?> data-on-text="<i class='fa fa-check'></i> Sesuai" data-off-text="<i class='fa fa-times'></i> Tidak" data-on-color="success" data-off-color="danger" data-size="medium">
                                    </td>
                                    <td>
                                      <textarea cols="40" name="catatan[]" rows="10" data-konsultasi="<?= $id_konsultasi ?>" data-val="<?= $r->id_detail_jenis_persyaratan ?>" data-id="<?= $r->id_detail ?>" id="note" class="resize-ta form-control note-persyaratan" placeholder="Isi Catatan" style="width:200px; height:50px;"><?php echo $catatan1 ?></textarea>
                                    </td>
                                    <td>
                                      <?php if ($berkas_file1 != '') : ?>
                                        <a href="javascript:void(0);" id="lihatBerkas" data-val="<?= $r->id_detail ?>" class="btn btn-primary lihat-berkas" onClick="javascript:popWin('<?php echo base_url("file/Konsultasi/{$id_konsultasi}/Dokumen/" . $berkas_file1); ?>')"><i class="fa fa-eye"></i> Lihat Berkas</a>
                                      <?php endif; ?>
                                      &nbsp;
                                      <a href="javascript:void(0);" class="btn btn-warning ubah-berkas" data-id="<?= $r->id_detail ?>" id="ubahBerkas" onclick="clickModal(<?= $id_konsultasi ?>,<?= $r->id_detail_jenis_persyaratan ?>,<?= $r->id_detail ?>)" style="display:<?= $css1 ?>;"><i class="fa fa-edit"></i> Ubah Berkas</a>
                                    </td>
                                  </tr>
                                <?php endforeach; ?>
                              </tbody>
                            </table>
                            <div class="row">
                              <div class="col-md-6">

                                <button type="submit" name="submit" class="btn green btn-block save-step" id="saveStep"><i class="fa fa-save"></i> Simpan dan Lanjutkan</button>
                              </div>
                              <div class="col-md-6">
                                <a href="<?= site_url('Teknis/InputKonsultasi') ?>" class="btn btn-info btn-block btn-back"><i class="fa fa-arrow-left"></i> Kembali</a>
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
              <!-- endpane 1 -->
              <!-- panel 2 -->
              <div class="tab-pane" id="tab2">
                <div class="row">
                  <div class="col-md-12">
                    <!-- BEGIN Portlet PORTLET-->
                    <div class="portlet box blue">
                      <div class="portlet-title">
                        <div class="caption">
                          Pemeriksaan Struktur
                        </div>
                      </div>
                      <div class="portlet-body">
                        <form action="#" role="form" method="post" class="step-wizard" id="formTwo" enctype="multipart/form-data">
                          <div class="form-body">
                            <table class="table table-bordered table-striped table-hover">
                              <tbody>
                                <tr>
                                  <th rowspan="2" class="info">
                                    <center>No</center>
                                  </th>
                                  <th colspan="3" class="info">
                                    <center>Persyaratan</center>
                                  </th>
                                  <th colspan="2" class="danger">
                                    <center>Perbaikan dari TIM TPT/TPA</center>
                                  </th>
                                  <th rowspan="2" class="info">
                                    <center>Aksi</center>
                                  </th>
                                </tr>
                                <tr>
                                  <th class="info" colspan="3">Detail</th>
                                  <th class="danger">Kesesuaian</th>
                                  <th class="danger">
                                    <center>Catatan &amp; Dokumen</center>
                                  </th>
                                </tr>
                                <?php $no = 1;
                                foreach ($struktur as $r) : ?>
                                  <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td colspan="3" style="text-align:left;"><?php echo $r->nm_dokumen ?></td>
                                    <td>
                                      <?php
                                      $row_doc2 = $this->Mteknis->getDataPenilaian($id_konsultasi, $r->id_detail, $r->id_detail_jenis_persyaratan)->row();
                                      $cek2 = isset($row_doc2->kesesuaian) ? $row_doc2->kesesuaian : null;
                                      $catatan2 = isset($row_doc2->catatan) ? $row_doc2->catatan : '';
                                      $berkas_file2 = isset($row_doc2->dir_file) ? $row_doc2->dir_file : '';
                                      $css2 = $cek2 != 0 && $cek2 != NULL ? 'none' : 'block';
                                      ?>
                                      <input type="hidden" name="id_konsultasi" id="idKonsultasi" value="<?php echo $id_konsultasi ?>">
                                      <input type="hidden" name="id_jenis" id="idJenis" value="<?= $r->id_jenis_permohonan ?>">
                                      <input type="hidden" name="id_jenis_syarat" id="idSyarat" class="data-syarat" value="<?= $r->id_detail_jenis_persyaratan ?>">
                                      <input type="checkbox" class="make-switch" id="checkData" data-konsultasi="<?= $id_konsultasi ?>" data-val="<?= $r->id_detail_jenis_persyaratan ?>" data-id="<?= $r->id_detail ?>" <?= $cek2 != 0 && $cek2 != NULL ? 'checked' : '' ?> data-on-text="<i class='fa fa-check'></i> Sesuai" data-off-text="<i class='fa fa-times'></i> Tidak" data-on-color="success" data-off-color="danger" data-size="medium">
                                    </td>
                                    <td>
                                      <textarea cols="40" name="catatan[]" rows="10" data-konsultasi="<?= $id_konsultasi ?>" data-val="<?= $r->id_detail_jenis_persyaratan ?>" data-id="<?= $r->id_detail ?>" id="note" class="resize-ta form-control note-persyaratan" placeholder="Isi Catatan" style="width:200px; height:50px;"><?php echo $catatan2 ?></textarea>
                                    </td>
                                    <td>
                                      <?php if ($berkas_file2 != '') : ?>
                                        <a href="javascript:void(0);" id="lihatBerkas" data-val="<?= $r->id_detail ?>" class="btn btn-primary lihat-berkas" onClick="javascript:popWin('<?php echo base_url("file/Konsultasi/{$id_konsultasi}/Dokumen/" . $berkas_file2); ?>')"><i class="fa fa-eye"></i> Lihat Berkas</a>
                                      <?php endif; ?>
                                      &nbsp;
                                      <a href="javascript:void(0);" class="btn btn-warning ubah-berkas" data-id="<?= $r->id_detail ?>" id="ubahBerkas" onclick="clickModal(<?= $id_konsultasi ?>,<?= $r->id_detail_jenis_persyaratan ?>,<?= $r->id_detail ?>)" style="display:<?= $css2 ?>;"><i class="fa fa-edit"></i> Ubah Berkas</a>
                                    </td>
                                  </tr>
                                <?php endforeach; ?>
                              </tbody>
                            </table>
                            <div class="row">
                              <div class="col-md-6">
                                <button type="submit" name="submit" class="btn green btn-block save-step" id="saveStep"><i class="fa fa-save"></i> Simpan dan Lanjutkan</button>
                              </div>
                              <div class="col-md-6">
                                <a href="javascript:void(0);" class="btn btn-info btn-block back-button"><i class="fa fa-arrow-left"></i> Kembali</a>
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
              <!-- end panel 2 -->
              <!-- panel 2 -->
              <div class="tab-pane" id="tab3">
                <div class="row">
                  <div class="col-md-12">
                    <!-- BEGIN Portlet PORTLET-->
                    <div class="portlet box blue">
                      <div class="portlet-title">
                        <?php if ($id_izin == '2') { ?>
                          <div class="caption">Data Teknis Gedung Eksisting</div>
                        <?php } else { ?>
                          <div class="caption">Mekanikal, Elektrikal, dan Plambing</div>
                        <?php } ?>
                      </div>
                      <div class="portlet-body">
                        <form action="#" role="form" method="post" class="step-wizard" id="formTwo" enctype="multipart/form-data">
                          <div class="form-body">
                            <table class="table table-bordered table-striped table-hover">
                              <tbody>
                                <tr>
                                  <th rowspan="2" class="info"><center>No</center></th>
                                  <th colspan="3" class="info"><center>Persyaratan</center></th>
                                  <th colspan="2" class="danger"><center>Perbaikan dari TIM TPT/TPA</center></th>
                                  <th rowspan="2" class="info"><center>Aksi</center></th>
                                </tr>
                                <tr>
                                  <th class="info" colspan="3"></th>
                                  <th class="danger">Kesesuaian</th>
                                  <th class="danger"><center>Catatan &amp; Dokumen</center></th>
                                </tr>
                                <?php $no = 1;
                                foreach ($mep as $r) : ?>
                                  <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td colspan="3" style="text-align:left;"><?php echo $r->nm_dokumen ?></td>
                                    <td>
                                      <?php
                                        $row_doc3 = $this->Mteknis->getDataPenilaian($id_konsultasi, $r->id_detail, $r->id_detail_jenis_persyaratan)->row();
                                        $cek3 = isset($row_doc3->kesesuaian) ? $row_doc3->kesesuaian : null;
                                        $catatan3 = isset($row_doc3->catatan) ? $row_doc3->catatan : '';
                                        $berkas_file3 = isset($row_doc3->dir_file) ? $row_doc3->dir_file : '';
                                        $css3 = $cek3 != 0 && $cek3 != NULL ? 'none' : 'block';
                                      ?>
                                      <input type="hidden" name="id_konsultasi" id="idKonsultasi" value="<?php echo $id_konsultasi ?>">
                                      <input type="hidden" name="id_jenis" id="idJenis" value="<?= $r->id_jenis_permohonan ?>">
                                      <input type="hidden" name="id_jenis_syarat" id="idSyarat" class="data-syarat" value="<?= $r->id_detail_jenis_persyaratan ?>">
                                      <input type="checkbox" class="make-switch" id="checkData" data-konsultasi="<?= $id_konsultasi ?>" data-val="<?= $r->id_detail_jenis_persyaratan ?>" data-id="<?= $r->id_detail ?>" <?= $cek3 != 0 && $cek3 != NULL ? 'checked' : '' ?> data-on-text="<i class='fa fa-check'></i> Sesuai" data-off-text="<i class='fa fa-times'></i> Tidak" data-on-color="success" data-off-color="danger" data-size="medium">
                                    </td>
                                    <td>
                                      <textarea cols="40" name="catatan[]" rows="10" data-konsultasi="<?= $id_konsultasi ?>" data-val="<?= $r->id_detail_jenis_persyaratan ?>" data-id="<?= $r->id_detail ?>" id="note" class="resize-ta form-control note-persyaratan" placeholder="Isi Catatan" style="width:200px; height:50px;"><?php echo $catatan3 ?></textarea>
                                    </td>
                                    <td>
                                      <?php if ($berkas_file3 != '') : ?>
                                        <a href="javascript:void(0);" id="lihatBerkas" data-val="<?= $r->id_detail ?>" class="btn btn-primary lihat-berkas" onClick="javascript:popWin('<?php echo base_url("file/Konsultasi/{$id_konsultasi}/Dokumen/" . $berkas_file3); ?>')"><i class="fa fa-eye"></i> Lihat Berkas</a>
                                      <?php endif; ?>
                                      &nbsp;
                                      <a href="javascript:void(0);" class="btn btn-warning ubah-berkas" data-id="<?= $r->id_detail ?>" id="ubahBerkas" onclick="clickModal(<?= $id_konsultasi ?>,<?= $r->id_detail_jenis_persyaratan ?>,<?= $r->id_detail ?>)" style="display:<?= $css3 ?>;"><i class="fa fa-edit"></i> Ubah Berkas</a>
                                    </td>
                                  </tr>
                                <?php endforeach; ?>
                              </tbody>
                            </table>
                            <div class="row">
                              <div class="col-md-6">
                                <button type="submit" name="submit" class="btn green btn-block save-step" id="saveStep"><i class="fa fa-save"></i> Simpan dan Lanjutkan</button>
                              </div>
                              <div class="col-md-6">
                                <a href="javascript:void(0);" class="btn btn-info btn-block back-button"><i class="fa fa-arrow-left"></i> Kembali</a>
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
              <!-- end panel 2 -->
              <!-- panel 3 -->
              <div class="tab-pane" id="tab4">
                <!-- <h3 class="block">Finalisasi Data Bangunan</h3> -->
                <div class="row">
                  <div class="col-md-12">
                    <!-- BEGIN Portlet PORTLET-->
                    <div class="portlet box blue">
                      <div class="portlet-title">
                        <div class="caption">
                          Finalisasi Data Bangunan
                        </div>
                      </div>
                      <div class="portlet-body">
                        <form action="#" role="form" method="post" class="final-identity form-horizontal" id="formFourth" enctype="multipart/form-data">

                          <div class="portlet-title margin-bottom-10">
                            <div class="page-title" align="center">
                              <span class="caption font-blue-hoki bold" style="font-size: 22px;"> Data Kepemilikan Bangunan</span>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-3">Jenis Kepemilikan<span class="required">* </span></label>
                            <div class="col-md-5">
                              <select name="jns_kepemilikan" class="form-control">
                                <option value="0" <?php echo $jns_pemilik == '0' ? 'selected' : '' ?>>-Pilih-</option>
                                <option value="1" <?php echo $jns_pemilik == '1' ? 'selected' : '' ?>>Pemerintah</option>
                                <option value="2" <?php echo $jns_pemilik == '2' ? 'selected' : '' ?>>Perorangan/Usaha</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-3">Nama Pemilik</label>
                            <div class="col-md-7">
                              <div>
                                <input type="text" class="form-control" value="<?php echo set_value('luas_basement', (isset($nm_pemilik) ? $nm_pemilik : '')) ?>" name="nama_pemilik" placeholder="Nama Pemilik" autocomplete="off">
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <input type="hidden" class="form-control" value="<?php echo set_value('id', (isset($id_konsultasi) ? $id_konsultasi : '')) ?>" name="id" placeholder="id" autocomplete="off">
                            <input type="hidden" class="form-control" value="<?php echo set_value('id_bgn', (isset($DataBangunan->id_bgn) ? $DataBangunan->id_bgn : '')) ?>" name="id_bgn" placeholder="id Bangunan" autocomplete="off">
                            <label class="col-md-3 control-label">Provinsi</label>
                            <div class="col-md-7">
                              <select name="provinsiPemilik" id="provinsiPemilik" class="form-control select2" data-placeholder="Select...">
                                <option value="">-- Pilih Provinsi --</option>
                                <?php if ($daftar_provinsi->num_rows() > 0) {
                                  foreach ($daftar_provinsi->result() as $key) {
                                    echo '<option value="' . $key->id_provinsi . '">' . $key->nama_provinsi . '</option>';
                                  }
                                } ?>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-md-3 control-label">Kab/Kota</label>
                            <div class="col-md-7">
                              <select name="kabkotaPemilik" id="kabKotaPemilik" class="form-control select2" data-placeholder="Select...">
                                <option value="">-- Pilih Kabupaten / Kota --</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-md-3 control-label">Kecamatan</label>
                            <div class="col-md-7">
                              <select name="kecamatanPemilik" id="kecamatanPemilik" class="form-control select2" data-placeholder="Select...">
                                <option value="">-- Pilih Kecamatan --</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-md-3 control-label">Kelurahan/Desa</label>
                            <div class="col-md-7">
                              <select name="kelurahanPemilik" id="kelurahanPemilik" class="form-control select2" data-placeholder="Select...">
                                <option value="">-- Pilih Kelurahan/Desa --</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-md-3 control-label">Alamat Pemilik</label>
                            <div class="col-md-7">
                              <textarea type="text" class="form-control" name="alamat_pemilik" placeholder="Alamat Pemilik" autocomplete="off"><?php echo set_value('almt_bgn', (isset($alamat) ? $alamat : '')) ?></textarea>
                            </div>
                          </div>
                          <div class="portlet-title margin-top-10">
                            <div class="page-title" align="center">
                              <span class="caption font-blue-hoki bold" style="font-size: 22px;"> Data Bangunan Gedung</span>
                            </div>
                          </div>
                          <div class="form-group">
                            <input type="hidden" class="form-control" value="<?php echo set_value('id', (isset($id_konsultasi) ? $id_konsultasi : '')) ?>" name="id" placeholder="id" autocomplete="off">
                            <input type="hidden" class="form-control" value="<?php echo set_value('id_bgn', (isset($DataBangunan->id_bgn) ? $DataBangunan->id_bgn : '')) ?>" name="id_bgn" placeholder="id Bangunan" autocomplete="off">
                            <label class="col-md-3 control-label">Provinsi</label>
                            <div class="col-md-7">
                              <select name="nama_provinsi" id="nama_provinsi" class="form-control select2" data-placeholder="Select...">
                                <option value="">-- Pilih Provinsi --</option>
                                <?php if ($daftar_provinsi->num_rows() > 0) {
                                  foreach ($daftar_provinsi->result() as $key) {

                                    echo '<option value="' . $key->id_provinsi . '">' . $key->nama_provinsi . '</option>';
                                  }
                                } ?>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-md-3 control-label">Kab/Kota</label>
                            <div class="col-md-7">
                              <select name="nama_kabkota" id="nama_kabkota" class="form-control select2" data-placeholder="Select...">
                                <option value="">-- Pilih Kabupaten / Kota --</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-md-3 control-label">Kecamatan</label>
                            <div class="col-md-7">
                              <select name="nama_kecamatan" id="nama_kecamatan" class="form-control select2" data-placeholder="Select...">
                                <option value="">-- Pilih Kecamatan --</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-md-3 control-label">Kelurahan/Desa</label>
                            <div class="col-md-7">
                              <select name="nama_kelurahan" id="nama_kelurahan" class="form-control select2" data-placeholder="Select...">
                                <option value="">-- Pilih Kelurahan/Desa --</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-md-3 control-label">Alamat</label>
                            <div class="col-md-7">
                              <textarea type="text" class="form-control" name="almt_bgn" placeholder="Alamat Bangunan" autocomplete="off"><?php echo set_value('almt_bgn', (isset($DataBangunan->almt_bgn) ? $DataBangunan->almt_bgn : '')) ?></textarea>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3">Jenis Permohonan Konsultasi<span class="required">* </span></label>
                            <div class="col-md-5">
                              <?php echo form_dropdown('id_izin', $list_JnsPer, isset($DataBangunan->id_izin) ? $DataBangunan->id_izin : '', 'class ="form-control" id="id_izin" onchange="getjenisPermohonan(this.value)"'); ?>
                            </div>
                          </div>

                          <div id="per_imb" style="display: none;">
                            <div class="form-group row">
                              <label class="control-label col-md-3">Memiliki IMB/PBG <span class="required" aria-required="true">* </span></label>
                              <div class="col-md-7">
                                <div class="radio-list">
                                  <label><input type="radio" name="imb" value="1" onchange="show_slf(this);" <?= $DataBangunan->imb == 1 ? 'checked' : ''; ?>> Iya</label>
                                  <label><input type="radio" name="imb" value="0" onchange="show_slf(this);" <?= $DataBangunan->imb == 0 ? 'checked' : ''; ?>> Tidak</label>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div id="per_slf" style="display:none;">
                            <div class="form-group row">
                              <label class="control-label col-md-3">Memiliki SLF<span class="required">* </span></label>
                              <div class="col-md-7">
                                <div class="radio-list">
                                  <label><input type="radio" name="slf" value="1" onchange="show_cetak();" <?= $DataBangunan->slf == 1 ? 'checked' : ''; ?>> Iya</label>
                                  <label><input type="radio" name="slf" value="0" onchange="show_cetak();" <?= $DataBangunan->slf == 0 ? 'checked' : ''; ?>> Tidak</label>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div id="per_cetak" style="display:none;">
                            <?php
                              $cek_imb = '';
                              $cek_slf = '';
                              $cek_sb = '';
                              if ($DataBangunan->cetak_dok != NULL) {
                                $cetak = json_decode($DataBangunan->cetak_dok);
                                foreach ($cetak as $dt_cek) {
                                  if ($dt_cek == 1) $cek_imb = 'checked';
                                  if ($dt_cek == 2) $cek_slf = 'checked';
                                  if ($dt_cek == 3) $cek_sb = 'checked';
                                }
                              }
                            ?>
                            <div class="form-group row">
                              <label class="control-label col-md-3">Cetak Ulang<span class="required">* </span></label>
                              <div class="col-md-7">
                                <div class="radio-list">
                                  <label><input type="checkbox" name="cetak[]" value="1" <?= $cek_imb; ?>> IMB/PBG</label>
                                  <label><input type="checkbox" name="cetak[]" value="2" <?= $cek_slf; ?>> SLF</label>
                                  <label><input type="checkbox" name="cetak[]" value="3" <?= $cek_sb; ?>> SBKBG</label>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div id="KolektifInduk" style="display:none;">
                            <div class="form-group">
                              <label class="control-label col-md-3">Tipe Bangunan<span class="required">* </span></label>
                              <div class="col-md-7">
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <a class="btn btn-info" href="javascript:void(0);" onclick="addTipe();"><i class="fa fa-plus left-icon"> </i>Tambah Tipe</a>
                                  </div>
                                  <table class="table table-striped table-bordered dt-responsive wrap" id="tipe_bgn">
                                    <tr>
                                      <th>Tipe</th>
                                      <th>Luas</th>
                                      <th>Tinggi</th>
                                      <th>Lantai</th>
                                      <th>Jumlah Unit</th>
                                      <th width="5%">Aksi</th>
                                    </tr>
                                    <?php
                                    $tipe = json_decode($DataBangunan->tipeA);
                                    $luas = json_decode($DataBangunan->luasA);
                                    $tinggi = json_decode($DataBangunan->tinggiA);
                                    $lantai = json_decode($DataBangunan->lantaiA);
                                    $jumlah = json_decode($DataBangunan->jumlahA);
                                    $bangunan = array();
                                    foreach ($tipe as $noo => $val) {
                                      if ($val != "")
                                        $bangunan['tipe'][$noo] = $val;
                                    }
                                    foreach ($luas as $noo => $val) {
                                      if ($val != "")
                                        $bangunan['luas'][$noo] = $val;
                                    }
                                    foreach ($tinggi as $noo => $val) {
                                      if ($val != "")
                                        $bangunan['tinggi'][$noo] = $val;
                                    }
                                    if (!empty($lantai))
                                      foreach ($lantai as $noo => $val) {
                                        if ($val != "")
                                          $bangunan['lantai'][$noo] = $val;
                                      }
                                    if (!empty($jumlah))
                                      foreach ($jumlah as $noo => $val) {
                                        if ($val != "")
                                          $bangunan['jumlah'][$noo] = $val;
                                      }
                                    $no = 0;
                                    if (!empty($bangunan)) {
                                      foreach ($bangunan['tipe'] as $dt) {
                                        $no++; ?>
                                        <tr id="tr-tipe<?php echo $no ?>">
                                          <td><?php echo form_input('tipeA[' . $no . ']', $bangunan['tipe'][$no], 'style="width:110px;" id="posisi' . $no . '" class="posisi' . $no . ' form-control"'); ?></td>
                                          <td><?php echo form_input('luasA[' . $no . ']', $bangunan['luas'][$no], 'style="width:110px;" id="luas' . $no . '" class="luas' . $no . ' form-control"'); ?></td>
                                          <td><?php echo form_input('tinggiA[' . $no . ']', $bangunan['tinggi'][$no], 'style="width:110px;" id="tinggi' . $no . '" class="tinggi' . $no . ' form-control"'); ?></td>
                                          <td><?php echo form_input('lantaiA[' . $no . ']', !empty($bangunan['lantai'][$no]) ? $bangunan['lantai'][$no] : '', 'style="width:110px;" id="lantai' . $no . '" class="lantai' . $no . ' form-control"'); ?></td>
                                          <td><?php echo form_input('jumlahA[' . $no . ']', !empty($bangunan['jumlah'][$no]) ? $bangunan['jumlah'][$no] : '', 'style="width:110px;" id="jumlah' . $no . '" class="jumlah' . $no . ' form-control"'); ?></td>
                                          
                                          <td><a class="btn btn-info" href="javascript:void(0);" onclick="if(checkDeleteTipeRow() == true){$(this).parent().parent().remove()}" title="Apakah ini akan dihapus ?"><i class="fa fa-trash left-icon"></i></a></td>
                                        </tr>
                                      <?php }
                                    } else { ?>
                                      <tr id="tr-tipe">
                                        <td><?php echo form_input('tipeA[1]', '', 'style="width:100px;" id="posisi1" class="posisi1 form-control"'); ?></td>
                                        <td><?php echo form_input('luasA[1]', '', 'style="width:100px;" id="luas1" class="unit1 form-control"'); ?></td>
                                        <td><?php echo form_input('tinggiA[1]', '', 'style="width:100px;" id="tinggi1" class="tinggi1 form-control"'); ?></td>
                                        <td><?php echo form_input('lantaiA[1]', '', 'style="width:100px;" id="lantai1" class="tinggi1 form-control"'); ?></td>
                                        <td><?php echo form_input('jumlahA[1]', '', 'style="width:100px;" id="jumlah1" class="tinggi1 form-control"'); ?></td>
                                        <td><a class="btn btn-info" href="javascript:void(0);" onclick="if(checkDeleteTipeRow() == true){$(this).parent().parent().remove()}"><i class="fa fa-trash left-icon"></i></a></td>
                                      </tr>
                                    <?php } ?>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div id="fungsibg" class="form-group" style="display:none;">
                            <label class="control-label col-md-3">Fungsi Bangunan<span class="required">* </span></label>
                            <div class="col-md-5">
                              <?php $id_fungsi_bg = set_value('id', (isset($DataBangunan->id_fungsi_bg) ? $DataBangunan->id_fungsi_bg : '')); ?>
                              <?php
                              $selected = '';
                              if (isset($id_fungsi_bg) && $id_fungsi_bg != '')
                                $selected = $id_fungsi_bg;
                              else
                                $selected = '';
                              $js = 'id="id_fungsi_bg" onchange="set_jns_bg(this.value)" class="form-control"';
                              echo form_dropdown('id_fungsi_bg', $list_fungsi, $selected, $js);
                              ?>
                            </div>
                          </div>
                          <div id="jual_bg" style="display:none;">
                            <div class="form-group row">
                              <label class="control-label col-md-3">Bangunan akan dijual perunit bangunan<span class="required">* </span></label>
                              <div class="col-md-5">
                                <div class="radio-list">
                                  <label><input type="radio" name="jual" value="1" <?= $DataBangunan->jual == 1 ? 'checked' : ''; ?>> Iya</label>
                                  <label><input type="radio" name="jual" value="0" <?= $DataBangunan->jual == 0 ? 'checked' : ''; ?>> Tidak</label>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div id="jns_bg_toggle" class="form-group" style="display:none;">
                            <label class="control-label col-md-3">Jenis Bangunan <span class="required">* </span></label>
                            <div class="col-md-5">
                              <?php
                              echo form_dropdown('id_jns_bg', array('' => '--Pilih--'), isset($DataBangunan->id_jns_bg) ? $DataBangunan->id_jns_bg : '', 'id="id_jns_bg"  onchange="show_detail(this.value)" class="form-control"');
                              ?>
                            </div>
                          </div>
                          <div id="prasarana" style="display: none;">
                            <div class="form-group">
                              <?php $prasarana_bg = !empty($DataBangunan->id_prasarana_bg) ? $DataBangunan->id_prasarana_bg : ''; ?>
                              <label class="control-label col-md-3">Prasarana<span class="required">* </span></label>
                              <div class="col-md-5">
                                <select class="form-control" name="id_prasarana_bg" id="id_prasarana_bg">
                                  <option value="">--Pilih--</option>
                                  <option value="1" <?php if ($prasarana_bg == '1') echo "selected"; ?>>Kontruksi Pembatas/Penahan/Pengaman</option>
                                  <option value="2" <?php if ($prasarana_bg == '2') echo "selected"; ?>>Konstruksi Penanda Masuk Lokasi</option>
                                  <option value="3" <?php if ($prasarana_bg == '3') echo "selected"; ?>>Kontruksi Perkerasan</option>
                                  <option value="4" <?php if ($prasarana_bg == '4') echo "selected"; ?>>Kontruksi Penghubung</option>
                                  <option value="5" <?php if ($prasarana_bg == '5') echo "selected"; ?>>Kontruksi Kolam/Reservoir bawah tanah</option>
                                  <option value="6" <?php if ($prasarana_bg == '6') echo "selected"; ?>>Kontruksi Menara</option>
                                  <option value="7" <?php if ($prasarana_bg == '7') echo "selected"; ?>>Kontruksi Monumen</option>
                                  <option value="8" <?php if ($prasarana_bg == '8') echo "selected"; ?>>Kontruksi Instalasi/gardu</option>
                                  <option value="9" <?php if ($prasarana_bg == '9') echo "selected"; ?>>Kontruksi Reklame / Papan Nama</option>
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3">Luas Bangunan Prasarana<span class="required">* </span></label>
                              <div class="col-md-3">
                                <div class="checkbox-list">
                                  <input type="text" class="form-control" value="<?php echo set_value('luas_bgp', (isset($DataBangunan->luas_bgp) ? $DataBangunan->luas_bgp : '')) ?>" name="luas_bgp" placeholder="Luas Bangunan" autocomplete="off">
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3">Tinggi Bangunan Prasarana<span class="required">* </span></label>
                              <div class="col-md-3">
                                <div class="checkbox-list">
                                  <input type="text" class="form-control" value="<?php echo set_value('tinggi_bgp', (isset($DataBangunan->tinggi_bgp) ? $DataBangunan->tinggi_bgp : '')) ?>" name="tinggi_bgp" placeholder="Tinggi Bangunan" autocomplete="off">
                                </div>
                              </div>
                            </div>
                          </div>
                          <div id="detail_bg" style="display:none;">
                            <div class="form-group">
                              <label class="control-label col-md-3">Nama Bangunan<span class="required">* </span></label>
                              <div class="col-md-5">
                                <input type="text" class="form-control" value="<?php echo set_value('nama_bangunan', (isset($DataBangunan->nm_bgn) ? $DataBangunan->nm_bgn : '')) ?>" name="nama_bangunan" placeholder="Jenis/Nama Usaha" autocomplete="off">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3">Luas Bangunan</label>
                              <div class="col-md-3">
                                <div class="checkbox-list">
                                  <input type="text" class="form-control input-comma" value="<?php echo set_value('luas_bg', (isset($DataBangunan->luas_bgn) ? $DataBangunan->luas_bgn : '')) ?>" name="luas_bg" id="luas_bg" onblur="cek()" placeholder="Luas Bangunan" autocomplete="off">
                                </div>
                              </div>
                              <label class="control-label">m<sup>2</sup></label>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3">Jumlah Lantai Bangunan<span class="required">* </span></label>
                              <div class="col-md-4">
                                <div class="checkbox-list">
                                  <select name="lantai_bg" id="lantai_bg" class="form-control dropdown-lantai">
                                    <?php
                                    for ($i = 1; $i < 11; $i++) {
                                      $selectedLantai = $i == $DataBangunan->jml_lantai ? 'selected' : '';
                                      echo "<option value='{$i}' ${selectedLantai}>{$i} Lantai</option>";
                                    } ?>
                                  </select>
                                  <input type="number" class="form-control input-lantai input-number" style="display: none;" value="<?php echo set_value('lantai_bg', (isset($DataBangunan->jml_lantai) ? $DataBangunan->jml_lantai : '')) ?>" name="lantai_bg" id="lantai_bg" onblur="cek()" placeholder="Jumlah Lantai Bangunan Gedung" autocomplete="off" disabled="">
                                </div>
                                <input type="checkbox" name="pilihan" id="pilihanLantai">
                                <label class="control-label">Centang Apabila lebih dari 10 Lantai</label>
                              </div>
                              <label class="control-label"></label>

                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3">Tinggi Bangunan<span class="required">* </span></label>
                              <div class="col-md-3">
                                <div class="checkbox-list">
                                  <input type="text" class="form-control input-comma" value="<?php echo set_value('tinggi_bg', (isset($DataBangunan->tinggi_bgn) ? $DataBangunan->tinggi_bgn : '')) ?>" name="tinggi_bg" onblur="cek()" placeholder="Tinggi Bangunan" autocomplete="off">
                                </div>
                              </div>
                              <label class="control-label">M</label>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3">Luas Basement Bangunan</label>
                              <div class="col-md-3">
                                <div class="checkbox-list">
                                  <input type="text" class="form-control input-comma" value="<?php echo set_value('luas_basement', (isset($DataBangunan->luas_basement) ? $DataBangunan->luas_basement : '')) ?>" name="luas_basement" placeholder="Luas Basement Bangunan" autocomplete="off">
                                </div>
                              </div>
                              <label class="control-label">m<sup>2</sup></label>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3">Jumlah Lantai Basement Bangunan</label>
                              <div class="col-md-4">
                                <div class="checkbox-list">
                                  <select name="lapis_basement" id="lapis_basement" class="form-control dropdown-basement">
                                    <?php for ($i = 0; $i < 10; $i++) {
                                      $selectedBasement = $i == $DataBangunan->lapis_basement ? 'selected' : '';
                                      echo "<option value='{$i}' {$selectedBasement}>{$i} Lapis</option>";
                                    } ?>
                                  </select>
                                  <input type="number" class="form-control input-basement" style="display:none;" value="<?php echo set_value('lapis_basement', (isset($DataBangunan->lapis_basement) ? $DataBangunan->lapis_basement : '')) ?>" name="lapis_basement" placeholder="Jumlah Lantai Basement Bangunan" autocomplete="off" disabled="">
                                </div>
                                <input type="checkbox" name="pilihan_basement" class="input-number" id="pilihanBasement">
                                <label class="control-label">Centang Apabila lebih dari 10 Lantai</label>
                              </div>
                              <label class="control-label"></label>
                            </div>
                          </div>
                          <div id="per_doc_tek" style="display: none;">
                            <div class="form-group">
                              <label class="col-md-3 control-label">Dokumen Teknis</label>
                              <div class="col-md-7">
                                <select name="id_doc_tek" id="id_doc_tek" onchange="set_prototype(this.value)" class="form-control" data-placeholder="Select..."></select>
                              </div>
                            </div>
                          </div>
                          <div id="prototype" style="display: none;">
                            <div class="form-group">
                              <label class="col-md-3 control-label">Pilih Prototype</label>
                              <div class="col-md-7">
                                <select name="id_prototype" id="id_prototype" class="form-control" data-placeholder="Select..."></select>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <button type="submit" name="submit" class="btn green btn-block" id="saveIdentity"><i class="fa fa-save"></i> Simpan dan Lanjutkan</button>
                            </div>
                            <div class="col-md-6">
                              <a href="javascript:void(0);" class="btn btn-info btn-block back-button"><i class="fa fa-arrow-left"></i> Kembali</a>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                    <!-- END Portlet PORTLET-->
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tab5">
                <div class="row">
                  <div class="col-md-12">
                    <!-- BEGIN Portlet PORTLET-->
                    <div class="portlet box blue">
                      <div class="portlet-title">
                        <div class="caption">Hasil Konsultasi</div>
                      </div>
                      <div class="portlet-body">
                        <form action="<?= site_url('Teknis/save_penilaian') ?>" role="form" method="post" id="formThree" enctype="multipart/form-data">
                          <div class="form-body">
                            <div class="form-group">
                              <label class="control-label col-md-3">No. Berita Acara
                                <input type="hidden" name="id" value="<?= $this->uri->segment(3) ?>">
                                <input type="hidden" name="id_konsultasi" value="<?php echo $id_konsultasi; ?>">
                                <input type="hidden" name="id_izin" value="<?php echo $id_izin; ?>">
                                <input type="hidden" name="status_imb" value="<?php echo $status_imb; ?>">
                                <input type="hidden" name="jns_permohonan" value="<?php echo $id_jenis_permohonan; ?>">
                              </label>
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
                            <?php if($id_izin =='2'){ ?>
                              <div class="form-group">
                                <label class="control-label col-md-3">Okupansi Bangunan Gedung</label>
                                <div class="row">
                                  <div class="col-md-4">
                                    <input type="text" class="form-control" name="okupansi" placeholder="Okupansi Bangunan Gedung" required></span>
                                  </div>
                                </div>
                              </div>
                            <?php } else { ?>

                            <?php } ?>
                            <div class="form-group">
                              <label class="control-label col-md-3">Rekomendasi Hasil Konsultasi</label>
                              <div class="row">
                                <div class="col-md-4">
                                  <input type="file" id="inputFile" name="berkas">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <button type="submit" name="submit" class="btn green btn-block"><i class="fa fa-save"></i> Simpan</button>
                              </div>
                              <div class="col-md-6">
                                <a href="javascript:void(0);" class="btn btn-info btn-block back-button"><i class="fa fa-arrow-left"></i> Kembali</a>
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
              <!-- end panel 3 -->
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
                        <th>No</th>
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
            <button type="submit" id="btnNext" class="btn green btn-next ladda-button" data-style="expand-right" data-size="l"><span class="ladda-label"><i class="fa fa-save"></i> Lanjutkan</span></button>
            <button type="button" data-dismiss="modal" class="btn red btn-info btn-repeat"><i class="fa fa-sign-out"></i> Tutup</button>
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
        <button type="button" data-dismiss="modal" class="btn red btn-cancel"><i class="fa fa-sign-out"></i> Batal</button>
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
        <button type="button" data-dismiss="modal" class="btn red btn-cancel"><i class="fa fa-sign-out"></i> Batal</button>
        <button type="submit" id="perbaikanSurat" class="btn green ladda-button" data-style="expand-right" data-size="l"><span class="ladda-label"><i class="fa fa-save"></i> Kirim</span></button>
      </div>
    </div>
    <?php echo form_close() ?>
</div>


<script>
  var segment = '<?= $this->uri->segment(3) ?>';
  $.ajax({
    method: 'POST',
    url: `${base_url}Teknis/cek_step`,
    data: {
      id: segment
    },
    success: function(response) {
      var wizard = $('#form_wizard_1').bootstrapWizard();
      wizard.bootstrapWizard('show', response.result);
      getStepFunction(response.result);
    }
  });

  var getStep;
  var returnFail;

  function getFailFunc(response) {
    returnFail = response;
  }

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
        var l = Ladda.create(document.querySelector('.btn-next'));
        var wizard = $('#form_wizard_1').bootstrapWizard();
        let res;
        let current = wizard.bootstrapWizard('currentIndex');
        let curr = getStep;
        let nextStep = current + 1;
        if (returnFail > 0) {
          var isGood = confirm('Penilaian Masih Ada Yang Belum Sesuai, Tetap Lanjutkan?');
          if (isGood) {
            var wizard = $('#form_wizard_1').bootstrapWizard();
            l.start();
            setTimeout(function() {
              l.stop();
              $('#ajax').modal('hide');
            }, 1500);
            res = true;
          } else {
            res = false;
          }
        } else {
          l.start();
          setTimeout(function() {
            l.stop();
            $('#ajax').modal('hide');
          }, 1500);
          res = true
        }
        $.ajax({
          type: "POST",
          data: {
            step: nextStep,
            dataVal: segment
          },
          url: `${base_url}Teknis/save_step`,
          success: function(response) {}
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

    $("input.make-switch").on('change.bootstrapSwitch', function(e) {
      var mode = $(this).prop('checked');
      var dataId = $(this).data("id");
      var dataKonsultasi = $(this).data("konsultasi");
      var dataVal = $(this).attr('data-val');
      $.ajax({
        type: "POST",
        url: `${base_url}Teknis/cek_kesesuaian`,
        data: {
          mode: mode,
          dataId: dataId,
          dataVal: dataVal,
          dataKonsultasi: dataKonsultasi
        },
        success: function(response) {
          if (response.status === false) {
            $(`a[data-id=${dataId}]`).css("display", "block");
          } else {
            $(`a[data-id=${dataId}]`).css("display", "none");
          }
          toastr.options = {
            "closeButton": true,
            "debug": false,
            "positionClass": "toast-top-right",
            "onclick": null,
            "showDuration": "1000",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
          }
          toastr.success(response.message);
        }
      });
    });
    //setup before functions
    var typingTimer; //timer identifier
    var doneTypingInterval = 1500; //time in ms (1.5 seconds)
    //on keyup, start the countdown
    $('textarea#note').keyup(function() {
      var dataKonsultasi = $(this).data('konsultasi');
      var dataId = $(this).data("id");
      var dataVal = $(this).attr('data-val');
      var text = $(this).val();
      clearTimeout(typingTimer);
      if ($('textarea#note').val()) {
        typingTimer = setTimeout(function() {
          doneTyping(dataKonsultasi, dataId, dataVal, text)
        }, doneTypingInterval);
      }
    });

    //user is "finished typing," do something
    function doneTyping(dataKonsultasi, dataId, dataVal, text) {
      $.ajax({
        type: "POST",
        url: `${base_url}Teknis/simpan_catatan`,
        data: {
          syarat: text,
          dataId: dataId,
          dataVal: dataVal,
          dataKonsultasi: dataKonsultasi
        },
        success: function(response) {
          if (response.status === true) {
            toastr.options = {
              "closeButton": true,
              "debug": false,
              "positionClass": "toast-top-right",
              "onclick": null,
              "showDuration": "1000",
              "hideDuration": "1000",
              "timeOut": "5000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            }
            toastr.success(response.message);
          }
        }
      });
    }
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

  const textArea = document.querySelectorAll(".resize-ta");
  for (let i = 0; i < textArea.length; i++) {
    textArea[i].addEventListener("keyup", () => {
      textArea[i].style.height = calcHeight(textArea[i].value) + "px";
    });
  }

  function clickModal(z, a, b) {
    $('#responsive').modal('show');
    $('#dataKonsultasi').val(z);
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

  $("#changeBerkas").submit(function(e) {
    var l = Ladda.create(document.querySelector('#form-submit'));
    l.start();
    e.preventDefault();
    var dataVal = $('#dataVal').val();
    $(".btn-cancel").attr("disabled", true);

    $(".btn-close").css("display", "none");
    $.ajax({
      type: "POST",
      url: `${base_url}Teknis/simpan_berkas`,
      data: new FormData(this),
      processData: false,
      contentType: false,
      enctype: 'multipart/form-data',
      success: function(response) {
        if (response.status == false) {
          setTimeout(function() {
            showToast(response.message, 15000, response.type);
            l.stop();
            $(".btn-cancel").removeAttr("disabled");
            $(".btn-close").css("display", "block")
          }, 1500);
        } else {
          setTimeout(function() {
            showToast(response.message, 15000, response.type);
            l.stop();
            $(".btn-cancel").removeAttr("disabled");
            $(".btn-close").css("display", "block")
            $('#responsive').modal('hide');
            $(`a.lihat-berkas[data-val=${dataVal}]`).attr(`onClick`, `javascript:popWin('${base_url}${response.result}')`);
          }, 1500);
        }
      }
    });
  });

  $("#perbaikanBerkas").submit(function(e) {
    e.preventDefault();
    var l = Ladda.create(document.querySelector('#perbaikanSurat'));
    l.start();
    e.preventDefault();
    var dataVal = $('#dataVal').val();
    $(".btn-cancel").attr("disabled", true);
    $(".btn-close").css("display", "none");
    $.ajax({
      type: "POST",
      url: `${base_url}Teknis/kirim_perbaikan`,
      data: new FormData(this),
      processData: false,
      contentType: false,
      enctype: 'multipart/form-data',
      success: function(response) {
        if (response.status == false) {
          setTimeout(function() {
            showToast(response.message, 15000, response.type);
            l.stop();
            $(".btn-cancel").removeAttr("disabled");
            $(".btn-close").css("display", "block")
          }, 1500);
        } else {
          setTimeout(function() {
            showToast(response.message, 15000, response.type);
            l.stop();
            $(".btn-cancel").removeAttr("disabled");
            $(".btn-close").css("display", "block")
            $('#pemohon').modal('hide');
            setTimeout(function() {
              window.location.replace(`${base_url}Teknis/penilaian`);
            }, 3000);
          }, 1500);
        }
      }
    });
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
        url: `${base_url}Teknis/save_step`,
        success: function(response) {}
      });
    }
  });
  // $('.save-step').click(function(e) {
  $(document).on('submit', 'form.step-wizard', function(e) {
    e.preventDefault();
    var $form = $(this);
    var syr = $form.find('.data-syarat');
    var syarat = $form.find('#idSyarat').val(); // example
    var jenis = $form.find('#idJenis').val();
    var dataKonsultasi = $form.find('#idKonsultasi').val();
    var valueArray = $form.find(".data-syarat").map(function() {
      return this.value;
    }).get();

    let uniqueArray = valueArray.filter((item, pos, self) => self.indexOf(item) == pos);

    var cb = [],
      post_cb = []

    $form.find('#idJenis')
    // syarat = $('#idSyarat').val();
    $.each($($form.find('input[type=checkbox]:checked')), function() {
      var id = $(this).data('id'),
        val = $(this).data('val')
      cb.push(id + ' -> ' + val);
      post_cb.push({
        'id': id,
        'val': val
      });
    });

    $.ajax({
      type: 'POST',
      url: `${base_url}Teknis/simpan_penilaian`,
      data: {
        data: post_cb,
        syarat: syarat,
        jenis: jenis,
        dataKonsultasi: dataKonsultasi
      },
      beforeSend: function() {
        $(".loading").css("display", "block");
        $(".text-loader").css("display", "block");
        $(".btn-close").css("display", "none");
        $(".list-group").css("display", "none");
        $(".caption-message").css("display", "none");
        $(".btn-next").css("display", "none");
        $(".btn-repeat").css("display", "none");
        $(".btn-maintain").css("display", "none");
      },
      success: function(response) {
        let fail = response.not;
        setTimeout(function() {
          if (response.not > 0) {
            $(".btn-repeat").css("display", "inline-block");
            $(".btn-maintain").css("display", "inline-block");
          } else {
            $(".btn-repeat").css("display", "none");
          }
          $('.btn-maintain').click(function(e) {
            e.preventDefault();
            $('#pemohon').modal('show');
            $('#noKonsultasi').val(segment);
          });
          $(".list-group").css("display", "block");
          $(".btn-close").css("display", "block");
          $(".loading").css("display", "none");
          $(".text-loader").css("display", "none");
          $(".caption-message").css("display", "block");
          let result = response.result;
          const message = $('.caption-message');
          let sts = response.status == true ? 'green' : 'red';
          let msgRes = response.status == true ? 'Penilaian Berhasil' : 'Penilaian Gagal';
          message.html(`<h4 align="center" class="caption-subject font-${sts} bold uppercase">${msgRes}</h4>`);
          const res = $('.data-kesesuaian');
          res.empty();
          let table;
          let num = 1;
          result.forEach(obj => {
            let status = obj.kesesuaian == 1 ? 'Sesuai <i class="fa fa-check"></i>' : 'Tidak <i class="fa fa-times"></i>';
            let label = obj.kesesuaian == 1 ? 'success' : 'danger';
            table += '<tr>';
            table += `<td>${num++}</td>`;
            table += `<td style="text-align:left;">${obj.nm_dokumen}</td>`;
            table += `<td><span class="badge badge-${label}"> ${status}</span></td></tr>`;
            $('.data-kesesuaian').html(table);
          });
          if (response.status == true) {
            $(".btn-next").css("display", "inline-block");
          } else {
            $(".btn-maintain").css("display", "inline-block");
            $(".btn-repeat").css("display", "inline-block");
          }
        }, 1500);
        $('#ajax').modal('show');
        getFailFunc(fail);
      }
    });
  });

  $(document).on('submit', 'form.final-identity', function(e) {
    e.preventDefault();
    var $form = $(this);
    var serialize = $form.serialize();
    var isGood = confirm('Apakah data bangunan yang diperiksa sudah benar?');
    if (isGood) {
      $.ajax({
        type: "POST",
        data: serialize,
        url: `${base_url}Teknis/saveDataBangunan`,
        success: function(res) {
          var wizard = $('#form_wizard_1').bootstrapWizard();
          let current = wizard.bootstrapWizard('currentIndex');
          let nextStep = current + 1;
          if (res.res == true) {
            wizard.bootstrapWizard('next')
            $.ajax({
              type: "POST",
              data: {
                step: nextStep,
                dataVal: segment
              },
              url: `${base_url}Teknis/save_step`,
              success: function(response) {
                showToast(res.message, 15000, res.type);
              }
            });
          } else {
            showToast(res.message, 15000, res.type);
          }
        }
      });

    }
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
<script>
  $(function() {
    get_data_edit();
    get_data_edit_pemilik();
    $(() => {
      let lantaiBangunan = $('.input-lantai').val();
      let basementBangunan = $('.input-basement').val();
      if (parseInt(lantaiBangunan) > 10) {
        $("#uniform-pilihanLantai").find('span').addClass('checked');
        $('#pilihanLantai').attr('checked', true);
        $(".dropdown-lantai").css("display", "none");
        $(".dropdown-lantai ").attr("disabled", true);
        $(".input-lantai").attr("disabled", false);
        $(".input-lantai").css("display", "block");
      } else {
        $('#pilihanLantai').attr('checked', false);
        $(".dropdown-lantai").css("display", "block");
        $(".dropdown-lantai ").attr("disabled", false);
        $(".input-lantai").attr("disabled", true);
        $(".input-lantai").css("display", "none");
      }

      if (parseInt(basementBangunan) > 10) {
        $("#uniform-pilihanBasement").find('span').addClass('checked');
        $('#pilihanBasement').attr('checked', true);
        $(".dropdown-basement").attr("disabled", true);
        $(".input-basement").attr("disabled", false);
        $(".dropdown-basement").css("display", "none");
        $(".input-basement").css("display", "block");
      } else {
        $('#pilihanBasement').prop('checked', true);
        $(".dropdown-basement").attr("disabled", false);
        $(".input-basement").attr("disabled", true);
        $(".dropdown-basement").css("display", "block");
        $(".input-basement").css("display", "none");

      }

      console.log(lantaiBangunan);
    });

    $(".input-number").keypress(function(e) {
      var charCode = (e.which) ? e.which : e.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
      }
    });

    const regex = /[^\d.]|\.(?=.*\.)/g;
    const subst = ``;
    $('.input-comma').keyup(function() {
      const str = this.value;
      const result = str.replace(regex, subst);
      this.value = result;

    });

    $('#pilihanLantai').change(function(e) {
      e.preventDefault();
      if (this.checked) {
        $(".dropdown-lantai").css("display", "none");
        $(".dropdown-lantai ").attr("disabled", true);
        $(".input-lantai").attr("disabled", false);
        $(".input-lantai").css("display", "block");
      } else {
        $(".dropdown-lantai").css("display", "block");
        $(".dropdown-lantai ").attr("disabled", false);
        $(".input-lantai").attr("disabled", true);
        $(".input-lantai").css("display", "none");
      }
    });

    $('#pilihanBasement').change(function(e) {
      e.preventDefault();
      if (this.checked) {
        $(".dropdown-basement").attr("disabled", true);
        $(".input-basement").attr("disabled", false);
        $(".dropdown-basement").css("display", "none");
        $(".input-basement").css("display", "block");
      } else {
        $(".dropdown-basement").attr("disabled", false);
        $(".input-basement").attr("disabled", true);
        $(".dropdown-basement").css("display", "block");
        $(".input-basement").css("display", "none");
      }
    });

    $('.select2').select2();
    // Setup form validation on the #register-form element
    $("#FormBangunan").validate({
      // Specify the validation rules
      rules: {
        id_fungsi: "required",
        nib: {
          minlength: 13,
          maxlength: 13,
          required: true
        },
        'dcampur[]': {
          minlength: 2,
          required: true
        },
        nib_detail: "required",
        id_akun: "required",
        nama_pemilik: {
          required: true
        },
        id_jenis_usaha: "required",
        id_kolektif: "required",
        id_jenis_bg: "required",
        id_fungsi_bg: "required",
        alamat_bg: "required",
        nama_provinsi_bg: "required",
        nama_kabkota_bg: "required",
        nama_kecamatan_bg: "required",
        id_jns_bg: "required",
        no_tlp: "required",
        email: {
          required: true,
          email: true
        },
        //no_ktp : "required",
        no_ktp: {
          minlength: 2,
          required: true
        },
        id_dok_tek1: {
          required: true,
        },
        nama_idp: "required",
        nama_bangunan: "required",
        luas_bg: "required",
        tinggi_bg: "required",
        lantai_bg: "required",
      },
      highlight: function(element) {
        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
      },
      unhighlight: function(element) {
        $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
      },
      errorClass: 'help-block',

      // Specify the validation error messages
      messages: {
        id_fungsi: "Pilih Memiliki NIB Atau Tidak",
        nib: "NIB tidak terdaftar pada sistem OSS",
        nib_detail: "*",
        id_akun: "Silahkan Memilih",
        'dcampur[]': "",
        id_jenis_usaha: "Pilih Jenis Kepemilikan",
        id_jenis_bg: "Pilih Jenis Permohonan IMB",
        id_fungsi_bg: "Pilih Fungsi Bangunan",
        id_jns_bg: "Pilih Jenis Bangunan",
        id_kolektif: "Pilih Tipe Kolektif",
        nama_idp: "Pilih Tipe Prototipe",
        alamat_bg: "Masukkan Alamat Bangunan Gedung",
        nama_provinsi_bg: "Pilih Provinsi Alamat Bangunan Gedung",
        nama_kabkota_bg: "Pilih Kabupaten/Kota Alamat Bangunan Gedung",
        nama_kecamatan_bg: "Pilih Kecamatan Alamat Bangunan Gedung",
        id_dok_tek1: "Pilih Jenis Dokumen Teknis",
        nama_bangunan: "Masukkan Nama Bangunan",
        luas_bgn: "Masukkan Luas Bangunan",
        tinggi_bgn: "Masukkan Tinggi Bangunan",
        lantai_bg: "Masukkan Lantai Bangunan",
      },
      submitHandler: function(form) {
        form.submit();
      }
    });

    var izin = $('#id_izin').val();
    getjenisPermohonan(izin);
    if (izin == '2') {
      var imb = '<?= $DataBangunan->imb; ?>';
      if (imb == '1') {
        show_slf(imb);
      }
    }
    if (izin != 4 && izin != 5) {
      set_jns_bg($('#id_fungsi_bg').val());
      show_detail();
      cek_load();
    }
  });



  function get_data_edit() {
    $('#nama_provinsi').val('<?= isset($DataBangunan->id_prov_bgn) ? $DataBangunan->id_prov_bgn : ""; ?>').trigger('change');
    $('#nama_kabkota').val('<?= isset($DataBangunan->id_kabkot_bgn) ? $DataBangunan->id_kabkot_bgn : ""; ?>').trigger('change');
    $('#nama_kecamatan').val('<?= isset($DataBangunan->id_kec_bgn) ? $DataBangunan->id_kec_bgn : ""; ?>').trigger('change');
    $('#nama_kelurahan').val('<?= isset($DataBangunan->id_kel_bgn) ? $DataBangunan->id_kel_bgn : ""; ?>').trigger('change');
  
  }

  function get_data_edit_pemilik() {
    $('#provinsiPemilik').val('<?= isset($id_provinsi) ? $id_provinsi : ""; ?>').trigger('change');
    $('#kabkotaPemilik').val('<?= isset($id_kabkota) ? $id_kabkota : ""; ?>').trigger('change');
    $('#kecamatanPemilik').val('<?= isset($id_kecamatan) ? $id_kecamatan : ""; ?>').trigger('change');
    $('#kelurahanPemilik').val('<?= isset($id_kelurahan) ? $id_kelurahan : ""; ?>').trigger('change');
  }


  $('#provinsiPemilik').change(function() {
    var v = $(this).val();
    var select = "<?= isset($id_kabkota) ? $id_kabkota : ""; ?>";
    jQuery.post(base_url + 'Teknis/getDataKabKota/' + v, function(data) {
      $('select[name="kabkotaPemilik"]').empty();
      $.each(data, function(key, value) {
        if (select == value.id_kabkot) {
          $('select[name="kabkotaPemilik"]').append('<option value="' + value.id_kabkot + '" selected>' + value.nama_kabkota + '</option>').trigger('change');
        } else {
          $('select[name="kabkotaPemilik"]').append('<option value="' + value.id_kabkot + '">' + value.nama_kabkota + '</option>');
        }
      });
    }, 'json');
  });


  $('#kabKotaPemilik').change(function() {
    var v = $(this).val();
    var select = "<?= isset($id_kecamatan) ? $id_kecamatan : ""; ?>";
    jQuery.post(base_url + 'Teknis/getDataKecamatan/' + v, function(data) {
      $('select[name="kecamatanPemilik"]').empty();
      $.each(data, function(key, value) {
        if (select == value.id_kecamatan) {
          $('select[name="kecamatanPemilik"]').append('<option value="' + value.id_kecamatan + '" selected>' + value.nama_kecamatan + '</option>').trigger('change');
        } else {
          $('select[name="kecamatanPemilik"]').append('<option value="' + value.id_kecamatan + '">' + value.nama_kecamatan + '</option>');
        }
      });
    }, 'json');
  });

  $('#kecamatanPemilik').change(function() {
    var v = $(this).val();
    var select = "<?= isset($id_kelurahan) ? $id_kelurahan : ""; ?>";
    jQuery.post(base_url + 'Teknis/getDataKelurahan/' + v, function(data) {
      $('select[name="kelurahanPemilik"]').empty();
      $.each(data, function(key, value) {
        if (select == value.id_kelurahan) {
          $('select[name="kelurahanPemilik"]').append('<option value="' + value.id_kelurahan + '" selected>' + value.nama_kelurahan + '</option>').trigger('change');
        } else {
          $('select[name="kelurahanPemilik"]').append('<option value="' + value.id_kelurahan + '">' + value.nama_kelurahan + '</option>');
        }
      });
    }, 'json');
  });


  $('#nama_provinsi').change(function() {
    var v = $(this).val();
    var select = "<?= isset($DataBangunan->id_kabkot_bgn) ? $DataBangunan->id_kabkot_bgn : ""; ?>";
    jQuery.post(base_url + 'Teknis/getDataKabKota/' + v, function(data) {
      $('select[name="nama_kabkota"]').empty();
      $.each(data, function(key, value) {
        if (select == value.id_kabkot) {
          $('select[name="nama_kabkota"]').append('<option value="' + value.id_kabkot + '" selected>' + value.nama_kabkota + '</option>').trigger('change');
        } else {
          $('select[name="nama_kabkota"]').append('<option value="' + value.id_kabkot + '">' + value.nama_kabkota + '</option>');
        }
      });
    }, 'json');
  });

  $('#nama_kabkota').change(function() {
    var v = $(this).val();
    var select = "<?= isset($DataBangunan->id_kec_bgn) ? $DataBangunan->id_kec_bgn : ""; ?>";
    jQuery.post(base_url + 'Teknis/getDataKecamatan/' + v, function(data) {
      $('select[name="nama_kecamatan"]').empty();
      $.each(data, function(key, value) {
        if (select == value.id_kecamatan) {
          $('select[name="nama_kecamatan"]').append('<option value="' + value.id_kecamatan + '" selected>' + value.nama_kecamatan + '</option>').trigger('change');
        } else {
          $('select[name="nama_kecamatan"]').append('<option value="' + value.id_kecamatan + '">' + value.nama_kecamatan + '</option>');
        }
      });
    }, 'json');
  });

  $('#nama_kecamatan').change(function() {
    var v = $(this).val();
    var select = "<?= isset($DataBangunan->id_kel_bgn) ? $DataBangunan->id_kel_bgn : ""; ?>";
    jQuery.post(base_url + 'Teknis/getDataKelurahan/' + v, function(data) {
      $('select[name="nama_kelurahan"]').empty();
      $.each(data, function(key, value) {
        if (select == value.id_kelurahan) {
          $('select[name="nama_kelurahan"]').append('<option value="' + value.id_kelurahan + '" selected>' + value.nama_kelurahan + '</option>').trigger('change');
        } else {
          $('select[name="nama_kelurahan"]').append('<option value="' + value.id_kelurahan + '">' + value.nama_kelurahan + '</option>');
        }
      });
    }, 'json');
  });

  function cek() {
    var luas_bg = $('#luas_bg').val();
    var lantai_bg = $('#lantai_bg').val();
    if ($("#id_izin").val() == 1) {
      if ($("#id_fungsi_bg").val() == 1) {
        if (luas_bg <= 100 && lantai_bg <= 2) {
          document.getElementById('per_doc_tek').style.display = "block";
          document.getElementById('prototype').style.display = "none";
          var select_tek = '';
          var select_tek2 = '';
          var select_tek3 = '';
          var select_tek4 = '';

          var id_doc_tek = '<option value="1" ' + select_tek + '>Disediakan oleh Penyedia Jasa Konstruksi</option>';
          id_doc_tek += '<option value="2" ' + select_tek2 + '>Menggunakan Desain Prototipe dari Pemda</option>';
          id_doc_tek += '<option value="3" ' + select_tek3 + '>Mengembangan Desain Prototipe dari Pemda</option>';
          id_doc_tek += '<option value="4" ' + select_tek4 + '>Desain Berdasarkan Ketetuan Pokok Tahan Gempa</option>';
        } else {
          document.getElementById('per_doc_tek').style.display = "block";
          document.getElementById('prototype').style.display = "none";
          var id_doc_tek = '<option value="1" selected>Disediakan oleh Penyedia Jasa Konstruksi</option>';

        }
      } else {
        document.getElementById('per_doc_tek').style.display = "block";
        document.getElementById('prototype').style.display = "none";
        var id_doc_tek = '<option value="1" selected>Disediakan oleh Penyedia Jasa Konstruksi</option>';
      }

      $('#id_doc_tek').html(id_doc_tek);
    }
  }

  function cek_load() {

    var luas_bg = $('#luas_bg').val();
    var lantai_bg = $('#lantai_bg').val();
    if ($("#id_izin").val() == 1) {
      if ($("#id_fungsi_bg").val() == 1) {
        if (luas_bg <= 100 && lantai_bg <= 2) {
          document.getElementById('per_doc_tek').style.display = "block";
          document.getElementById('prototype').style.display = "none";
          if ('<?= $DataBangunan->id_doc_tek; ?>' == 1) {
            select_tek = "selected";
          } else if ('<?= $DataBangunan->id_doc_tek; ?>' == 2) {
            select_tek2 = "selected";
          } else if ('<?= $DataBangunan->id_doc_tek; ?>' == 3) {
            select_tek3 = "selected";
          } else if ('<?= $DataBangunan->id_doc_tek; ?>' == 4) {
            select_tek4 = "selected";
          } else {
            var select_tek = '';
            var select_tek2 = '';
            var select_tek3 = '';
            var select_tek4 = '';
          }
          var id_doc_tek = '<option value="1" ' + select_tek + '>Disediakan oleh Penyedia Jasa Konstruksi</option>';
          id_doc_tek += '<option value="2" ' + select_tek2 + '>Menggunakan Desain Prototipe dari Pemda</option>';
          id_doc_tek += '<option value="3" ' + select_tek3 + '>Mengembangan Desain Prototipe dari Pemda</option>';
          id_doc_tek += '<option value="4" ' + select_tek4 + '>Desain Berdasarkan Ketetuan Pokok Tahan Gempa</option>';
        } else {
          document.getElementById('per_doc_tek').style.display = "block";
          document.getElementById('prototype').style.display = "none";
          var id_doc_tek = '<option value="1" selected>Disediakan oleh Penyedia Jasa Konstruksi</option>';

        }
      } else {
        document.getElementById('per_doc_tek').style.display = "block";
        document.getElementById('prototype').style.display = "none";
        var id_doc_tek = '<option value="1" selected>Disediakan oleh Penyedia Jasa Konstruksi</option>';
      }
      $('#id_doc_tek').html(id_doc_tek);
      Load_prototype('<?= $DataBangunan->id_doc_tek; ?>');
    }
  }
  /**
   * Custom validator for contains at least one lower-case letter
   */
  $.validator.addMethod("atLeastOneLowercaseLetter", function(value, element) {
    return this.optional(element) || /[a-z]+/.test(value);
  }, "Must have at least one lowercase letter");

  /**
   * Custom validator for contains at least one upper-case letter.
   */
  $.validator.addMethod("atLeastOneUppercaseLetter", function(value, element) {
    return this.optional(element) || /[A-Z]+/.test(value);
  }, "Must have at least one uppercase letter");

  $.validator.addMethod("atLeastOneLetter", function(value, element) {
    return this.optional(element) || /[a-zA-Z]+/.test(value);
  }, "Must have at least one letter");

  /**
   * Custom validator for contains at least one number.
   */
  $.validator.addMethod("atLeastOneNumber", function(value, element) {
    return this.optional(element) || /[0-9]+/.test(value);
  }, "Must have at least one number");

  /**
   * Custom validator for contains at least one symbol.
   */
  $.validator.addMethod("atLeastOneSymbol", function(value, element) {
    return this.optional(element) || /[!@#$%^&*()]+/.test(value);
  }, "Must have at least one symbol");

  function getjenisPermohonan(v) {

    if (v == '1' || v == '3') {
      document.getElementById('prasarana').style.display = "none";
      document.getElementById('fungsibg').style.display = "block";
      document.getElementById('per_doc_tek').style.display = "none";
      document.getElementById('prototype').style.display = "none";
      document.getElementById('jual_bg').style.display = "none";
      document.getElementById('per_imb').style.display = "none";
      document.getElementById('KolektifInduk').style.display = "none";
      document.getElementById('per_slf').style.display = "none";
      document.getElementById('per_cetak').style.display = "none";
    } else if (v == '2') {
      document.getElementById('prasarana').style.display = "none";
      document.getElementById('per_imb').style.display = "block";
      document.getElementById('fungsibg').style.display = "block";
      document.getElementById('jns_bg_toggle').style.display = "none";
      document.getElementById('detail_bg').style.display = "none";
      document.getElementById('per_doc_tek').style.display = "none";
      document.getElementById('prototype').style.display = "none";
      document.getElementById('jual_bg').style.display = "none";
      document.getElementById('KolektifInduk').style.display = "none";
      document.getElementById('per_slf').style.display = "none";
      document.getElementById('per_cetak').style.display = "none";
    } else if (v == '4') {
      document.getElementById('prasarana').style.display = "none";
      document.getElementById('KolektifInduk').style.display = "block";
      document.getElementById('per_imb').style.display = "none";
      document.getElementById('fungsibg').style.display = "none";
      document.getElementById('jns_bg_toggle').style.display = "none";
      document.getElementById('detail_bg').style.display = "none";
      document.getElementById('per_doc_tek').style.display = "none";
      document.getElementById('prototype').style.display = "none";
      document.getElementById('jual_bg').style.display = "none";
      document.getElementById('per_slf').style.display = "none";
      document.getElementById('per_cetak').style.display = "none";
    } else if (v == '5') {
      document.getElementById('prasarana').style.display = "block";
      document.getElementById('KolektifInduk').style.display = "none";
      document.getElementById('per_imb').style.display = "none";
      document.getElementById('fungsibg').style.display = "none";
      document.getElementById('jns_bg_toggle').style.display = "none";
      document.getElementById('detail_bg').style.display = "none";
      document.getElementById('per_doc_tek').style.display = "none";
      document.getElementById('prototype').style.display = "none";
      document.getElementById('jual_bg').style.display = "none";
      document.getElementById('per_slf').style.display = "none";
      document.getElementById('per_cetak').style.display = "none";
    } else if (v == '6') {
      document.getElementById('prasarana').style.display = "none";
      document.getElementById('per_imb').style.display = "none";
      document.getElementById('fungsibg').style.display = "block";
      document.getElementById('jns_bg_toggle').style.display = "none";
      document.getElementById('detail_bg').style.display = "none";
      document.getElementById('per_doc_tek').style.display = "none";
      document.getElementById('prototype').style.display = "none";
      document.getElementById('jual_bg').style.display = "none";
      document.getElementById('KolektifInduk').style.display = "none";
      document.getElementById('per_slf').style.display = "none";
      document.getElementById('per_cetak').style.display = "none";
    } else {
      document.getElementById('prasarana').style.display = "none";
      document.getElementById('per_imb').style.display = "none";
      document.getElementById('fungsibg').style.display = "none";
      document.getElementById('jns_bg_toggle').style.display = "none";
      document.getElementById('detail_bg').style.display = "none";
      document.getElementById('per_doc_tek').style.display = "none";
      document.getElementById('prototype').style.display = "none";
      document.getElementById('jual_bg').style.display = "none";
      document.getElementById('KolektifInduk').style.display = "none";
      document.getElementById('per_slf').style.display = "none";
      document.getElementById('per_cetak').style.display = "none";
    }
  }

  function show_slf(v) {
    var slf = v.value;
    if (slf == '1') {
      document.getElementById('per_slf').style.display = "block";
      document.getElementById('per_cetak').style.display = "none";
    } else {
      document.getElementById('per_slf').style.display = "block";
    }
    show_cetak()
  }

  function show_cetak() {
    var imb = document.getElementsByName('imb');
    for (i = 0; i < imb.length; i++) {
      if (imb[i].checked)
        imb = imb[i].value;
    }
    var slf = document.getElementsByName('slf');
    for (i = 0; i < slf.length; i++) {
      if (slf[i].checked)
        slf = slf[i].value;
    }

    if (imb == '1' && slf == '1') {
      document.getElementById('per_cetak').style.display = "block";
    } else {
      document.getElementById('per_cetak').style.display = "none";
    }
  }

  function addTipe() {
    var lastRow = $('#tipe_bgn').find("tr").length;
    var emptyrows = 0;
    for (i = 1; i < lastRow; i++) {
      if ($("#posisi" + i).val() == '') {
        emptyrows += 1;
      }
    }
    var isi = `<td><?php echo form_input("tipeA[`+lastRow+`]", "", "class=\"form-control\" style=\"width:110px;\" id=\"posisi`+lastRow+`\""); ?></td>'`;
    isi += `<td><?php echo form_input("luasA[`+lastRow+`]", "", "class=\"form-control\" class=\"form-control\" style=\"width:110px;\" id=\"luas`+lastRow+`\""); ?></td>'`;
    isi += `<td><?php echo form_input("lantaiA[`+lastRow+`]", "", "class=\"form-control\" style=\"width:110px;\" id=\"lantai`+lastRow+`\""); ?></td>'`;
    isi += `<td><?php echo form_input("tinggiA[`+lastRow+`]", "", "class=\"form-control\" class=\"form-control\" style=\"width:110px;\" id=\"tinggi`+lastRow+`\""); ?></td>'`;
    isi += `<td><?php echo form_input("jumlahA[`+lastRow+`]", "", "class=\"form-control\" class=\"form-control\" style=\"width:110px;\" id=\"jumlah`+lastRow+`\""); ?></td>'`;
    isi += `<td><a class="btn btn-info" href="javascript:void(0);" onclick="if(checkDeleteTipeRow() == true){$(this).parent().parent().remove()}" ><i class="fa fa-trash left-icon"></i></a></td>`;

    if (emptyrows == 0) {
      $('#tipe_bgn').children().append("<tr id='tr-tipe'>" + isi + "</tr>")
    } else {
      $('#dialog-message').attr('title', 'Perhatian').html("Silahkan mengisi data pada baris yang tersedia terlebih dahulu, sebelum menambah baris.").dialog();
    }
  }

  function checkDeleteTipeRow() {
    var tbl = $('#tipe_bgn');
    var lastRow = tbl.find("tr").length;
    if (lastRow > 2) {
      return true
    } else {
      $('#dialog-message').attr('title', 'Perhatian').html("Data tim audit tidak boleh kosong.").dialog();
      return false;
    }
  }

  function addUnit() {
    var lastRow = $('#unit_bgn').find("tr").length;
    var emptyrows = 0;
    for (i = 1; i < lastRow; i++) {
      if ($("#unit" + i).val() == '') {
        emptyrows += 1;
      }
    }
    var isi = `<td><?php echo form_input("unitA[`+lastRow+`]", "", "class=\"form-control\" style=\"width:150px;\" id=\"unit`+lastRow+`\""); ?></td>'`;

    isi += `<td><a class="btn btn-info" href="javascript:void(0);" onclick="if(checkDeleteUnitRow() == true){$(this).parent().parent().remove()}" ><i class="fa fa-trash left-icon"></i></a></td>`;

    if (emptyrows == 0) {
      $('#unit_bgn').children().append("<tr id='tr-unit'>" + isi + "</tr>")
    } else {
      $('#dialog-message').attr('title', 'Perhatian').html("Silahkan mengisi data pada baris yang tersedia terlebih dahulu, sebelum menambah baris.").dialog();
    }
  }

  function checkDeleteUnitRow() {
    var tbl = $('#unit_bgn');
    var lastRow = tbl.find("tr").length;
    if (lastRow > 2) {
      return true
    } else {
      $('#dialog-message').attr('title', 'Perhatian').html("Data tim audit tidak boleh kosong.").dialog();
      return false;
    }
  }

  function addTinggi() {
    var lastRow = $('#tinggi_bgn').find("tr").length;
    var emptyrows = 0;
    for (i = 1; i < lastRow; i++) {
      if ($("#tinggi" + i).val() == '') {
        emptyrows += 1;
      }
    }
    var isi = `<td><?php echo form_input("tinggiA[`+lastRow+`]", "", "class=\"form-control\" class=\"form-control\" style=\"width:150px;\" id=\"tinggi`+lastRow+`\""); ?></td>'`;

    isi += `<td><a class="btn btn-info" href="javascript:void(0);" onclick="if(checkDeleteTinggieRow() == true){$(this).parent().parent().remove()}" ><i class="fa fa-trash left-icon"></i></a></td>`;

    if (emptyrows == 0) {
      $('#tinggi_bgn').children().append("<tr id='tr-tinggi'>" + isi + "</tr>")
    } else {
      $('#dialog-message').attr('title', 'Perhatian').html("Silahkan mengisi data pada baris yang tersedia terlebih dahulu, sebelum menambah baris.").dialog();
    }
  }

  function checkDeleteTinggieRow() {
    var tbl = $('#tinggi_bgn');
    var lastRow = tbl.find("tr").length;
    if (lastRow > 2) {
      return true
    } else {
      $('#dialog-message').attr('title', 'Perhatian').html("Data tim audit tidak boleh kosong.").dialog();
      return false;
    }
  }

  function set_jns_bg(v) {
    $("#jns_bg_toggle").fadeIn()
    jQuery.post(base_url + 'Teknis/getDataJnsBg/' + v, function(data) {
      var jenis_bg = '<option value="">-- Pilih --</option>';
      jQuery.each(data, function(key, value) {
        if (value.id_jns_bg == '<?= $DataBangunan->id_jns_bg; ?>') {
          select = "selected";
        } else {
          select = "";
        }
        jenis_bg += '<option value="' + value.id_jns_bg + '" ' + select + ' > ' + value.nm_jenis_bg + ' </option>';
      });
      jQuery('#id_jns_bg').html(jenis_bg);
      $('#id_jns_bg').prop("disabled", false);
    }, 'json');
    if (v == '') {
      document.getElementById('jual_bg').style.display = "none";
      document.getElementById('prototype').style.display = "none";
    } else if (v == '3') {
      document.getElementById('jual_bg').style.display = "block";
      document.getElementById('per_doc_tek').style.display = "none";
      document.getElementById('prototype').style.display = "none";
    } else {
      document.getElementById('jual_bg').style.display = "none";
      document.getElementById('per_doc_tek').style.display = "none";
      document.getElementById('prototype').style.display = "none";
    }
  }

  function show_detail(v) {
    if (v == '') {
      document.getElementById('detail_bg').style.display = "none";
    } else {
      document.getElementById('detail_bg').style.display = "block";
    }
  }

  function set_prototype(v) {
    if (v == 2 || v == 3) {
      document.getElementById('prototype').style.display = "block";
      var select_1 = '';
      var select_2 = '';

      var id_type = '<option value="1" ' + select_1 + '>Type 45</option>';
      id_type += '<option value="2" ' + select_2 + '>Type 50</option>';
    } else {
      document.getElementById('prototype').style.display = "none";
    }
    $('#id_prototype').html(id_type);
  }

  function Load_prototype(v) {
    if (v == 2 || v == 3) {
      document.getElementById('prototype').style.display = "block";
      if ('<?= $DataBangunan->id_prototype; ?>' == 1) {
        select_1 = "selected";
      } else if ('<?= $DataBangunan->id_prototype; ?>' == 2) {
        select_2 = "selected";
      } else {
        var select_1 = '';
        var select_2 = '';
        var select_3 = '';
      }

      var id_type = '<option value="1" ' + select_1 + '>Type 36</option>';
      id_type += '<option value="2" ' + select_2 + '>Type 54</option>';
      id_type += '<option value="3" ' + select_3 + '>Type 72</option>';
    } else {
      document.getElementById('prototype').style.display = "none";
    }
    $('#id_prototype').html(id_type);

  }
</script>