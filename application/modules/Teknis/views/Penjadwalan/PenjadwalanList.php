<style>
  table,
  tr,
  td,
  th {
    text-align: center;
  }
  .datepicker {
    z-index: 99999 !important;
  }
</style>

<div class="portlet box blue">
  <div class="portlet-title">
    <div class="caption"><i class="fa fa-globe"></i> Penjadwalan Konsultasi</div>
    <div class="tools"><a href="javascript:;" class="reload"></a></div>
  </div>
  <div class="portlet-body">
    <table class="table table-striped table-bordered table-hover" id="sample_1">
      <?php echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '</div>' : ''; ?>
      <thead>
        <tr>
          <th>No</th>
          <th>Jenis Permohonanaaaa</th>
          <th>No. Registrasi</th>
          <th>Nama Pemilik</th>
          <th>Lokasi BG</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($datapbg as $pbg) :
          if ($pbg->id_stsjadwal == 1 || $pbg->id_stsjadwal == NULL) {
            $ustat = "Belum Dijadwalkan!";
            $bgcolor = "danger";
          } else {
            if ($pbg->id_stsjadwal == 2) {
              $bgcolor = "info";
              $ustat = $pbg->nama_stsjadwal;
            } else if ($pbg->id_stsjadwal == 3) {
              $bgcolor = "warning";
              $ustat = $pbg->nama_stsjadwal;
            } else if ($pbg->id_stsjadwal == 4) {
              $bgcolor = "warning";
              $ustat = $pbg->nama_stsjadwal;
            } else if ($pbg->id_stsjadwal == 5) {
              $bgcolor = "info";
              $ustat = $pbg->nama_stsjadwal;
            } else if ($pbg->id_stsjadwal >= 6) {
              $bgcolor = "success";
              $ustat = $pbg->nama_stsjadwal;
            }
          }?>
          <tr class="<?= $bgcolor ?>">
            <td><?php echo $no++; ?></td>
            <td><?php echo $pbg->nm_konsultasi; ?></td>
            <td><?php echo $pbg->no_konsultasi; ?></td>
            <td><?php echo $pbg->nm_pemilik; ?></td>
            <td><?php echo $pbg->almt_bgn; ?></td>
            <td>
              <?php echo $ustat; ?>
            </td>
            <td>
              <a href="#" onClick="getJadwalKonsultasi('<?php echo $this->Outh_model->Encryptor('encrypt', $pbg->no_konsultasi); ?>')" class="btn btn-warning btn-sm" title="Buat Penjadwalan" data-toggle="modal" data-target="#static"><span class="fa fa-edit"></span></a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- /.modaledit -->
<div id="modal-edit" class="modal fade bs-modal-lg" tabindex="-1" aria-hidden="true" role="dialog" data-focus-on="input:first">
  <div class="modal-dialog">
    <div class="modal-content">
    </div>
  </div>
</div>

<div id="static" class="modal fade bs-modal-lg" data-width="60%" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    </div>
    <div class="modal-body">
      <div id="content">
        <div class="col-md-12">
          <div class="portlet-title">
            <h4 align="center" class="caption-subject font-red bold uppercase no-konsultasi"></h4>
            <hr>
            <div class="row static-info">
              <div class="col-md-4">Nama Pemilik</div>
              <div class="col-md-8 value nm-pemilik"></div>
            </div>
            <div class="row static-info">
              <div class="col-md-4 name">Alamat Pemilik</div>
              <div class="col-md-8 value alamat-pemilik"></div>
            </div>
            <div class="row static-info">
              <div class="col-md-4 name">Jenis Konsultasi</div>
              <div class="col-md-8 value jenis-konsultasi"></div>
            </div>
            <div class="row static-info">
              <div class="col-md-4 name">
                Tgl. Verifikasi & Batas Waktu Pelayanan 
              </div>
              <div class="col-md-8 value tgl-periode">
              </div>
            </div>
            <div class="row static-info">
              <div class="col-md-4 name">
                Lokasi Bangunan Gedung
              </div>
              <div class="col-md-8 value alamat-bangunan"></div>
            </div>
            <div class="row static-info">
              <div class="col-md-4 name">
                Fungsi Bangunan Gedung
              </div>
              <div class="col-md-8 value fungsi-bangunan-gedung"></div>
            </div>

            <div class="row static-info">
              <div class="col-md-4 name">
                Luas, Tinggi &amp; Jumlah Lantai
              </div>
              <div class="col-md-8 value luas-tinggi-lantai">
              </div>
            </div>
            <hr>
            <div class="tabbable-custom nav-justified">
              <ul id="tabdp3" class="nav nav-tabs nav-justified">
                <li class="active">
                  <a href="#ps" data-toggle="tab">
                    Penjadwalan Konsultasi</a>
                </li>

              </ul>
              <div class="tab-content">
                <!--//Penjadwalan Konsultasi-->
                <div class="tab-pane fade active in" id="ps">
                  <br>
                  <div class="row">
                    <input type="text" style="display: none;" name="id_penjadwalan" id="id_penjadwalan" value="">
                    <div class="col-md-6">
                      <form action="<?= site_url('Teknis/simpan_penjadwalan') ?>" role="form" method="post" id="jsnya" enctype="multipart/form-data">
                        <div class="form-body">
                          <div class="row">
                            <div class="col-md-3">
                              <div class="form-group form-md-line-input">
                                <div class="input-group">
                                  <span class="input-group-addon">
                                    <i class="fa fa-circle"></i>
                                  </span>
                                  <input type="text" name="konsultasi_ke" class="form-control konsultasi-ke" readonly="">
                                  <label for="form_control_1">Konsultasi</label>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-5">
                              <div class="form-group form-md-line-input">
                                <div class="input-group">
                                  <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </span>
                                  <input class="form-control" name="tanggal_konsultasi" type="date" data-date-format="yyyy-mm-dd" placeholder="Tanggal Konsultasi">
                                  <label for="form_control_1">Tanggal Konsultasi</label>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group form-md-line-input">
                                <div class="input-group">
                                  <span class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                  </span>
                                  <input name="jam_konsultasi" class="form-control" value="" id="jam_konsultasi" type="time">
                                  <label for="form_control_1">Jam Konsultasi</label>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group form-md-line-input">
                                <label for="form_control_1">Tipe Konsultasi</label>
                                <select name="tipe_konsultasi" id="tipeKonsultasi" class="tipe-konsultasi form-control">
                                  <option value="0">Pilih</option>
                                  <option value="1">Ofline</option>
                                  <option value="2">Online</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-12 tempat-konsultasi" style="display: none;">
                              <div class="form-group form-md-line-input">
                                <textarea class="form-control" rows="2" placeholder="Tempat / Keterangan" id="ketempat" name="ketempat" value=""></textarea>
                              </div>
                            </div>
                            <div class="col-md-12 link-konsultasi" style="display: none;">
                              <div class="form-group form-md-line-input">
                                <textarea class="form-control" rows="2" placeholder="Link Konsultasi Daring" id="linkMeeting" name="linkMeeting" value=""></textarea>
                              </div>
                            </div>
                            <div class="col-md-12 password-konsultasi" style="display: none;">
                              <div class="form-group form-md-line-input">
                                <textarea class="form-control" rows="2" placeholder="Password Konsultasi Daring" id="passwordMeeting" name="passwordMeeting" value=""></textarea>
                              </div>
                            </div>
                            <div class="col-md-12" style="display: none;">
                              <div class="form-group form-md-line-input">
                                <input name="email" class="form-control" value="" id="email" type="text">
                                <input name="noreg" class="form-control" value="" id="noreg" type="text">
                                <label for="form_control_1">email</label>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group form-md-line-input">
                                <label>Unggah Undangan Konsultasi</label>
                                <input type="file" class="form-control" name="berkas">
                              </div>
                            </div>
                          </div>
                        </div>
                        <input type="hidden" name="id" id="idKonsultasi">
                        <input type="submit" name="submit" value="Simpan Jadwal Konsultasi" class="btn blue-hoki btn-block">
                      </form>
                    </div>
                    <div class="col-md-6">
                      <form role="form">
                        <div class="form-body">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group form-md-line-input">
                                <input style="display: none;" name="jmlPegawai" id="jmlPegawai" value="1">
                                <input style="display: none;" name="jumPegUp" id="jumPegUp" value="1">
                                <table class="table table-bordered table-striped table-hover">
                                  <thead>
                                    <tr class="info">
                                      <th>
                                        <center>#</center>
                                      </th>
                                      <th>Nama Petugas TPT/TPA</th>
                                      <th>Unsur</th>
                                      <th>Bidang Keahlian</th>
                                    </tr>
                                  </thead>
                                  <tbody id="pengawas">
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-12">
                          <hr>
                          <br>
                          <table class="table table-bordered table-striped table-hover" id="tableKonsultasi">
                            <thead>
                              <tr class="info">
                                <th>No</th>
                                <th>Sesi Konsultasi</th>
                                <th>Tanggal / Jam</th>
                                <th>Tempat / Keterangan</th>
                                <th>Tipe Konsultasi</th>
                                <th>Link Konsultasi</th>
                                <th>Password</th>
                                <th>Berkas Undangan</th>
                              </tr>
                            </thead>
                            <tbody id="konsultasi">
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--//akhir Penjadwalan Konsultasi-->
                <!--//Dokumen Pertimbangan-->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" data-dismiss="modal" class="btn blue" onClick="ResRes2()"><i class="fa fa-sign-out"></i> Tutup</button>
    </div>
  </div>
</div>
<script src="<?= base_url() ?>assets/app/js/Teknis.js" async></script>