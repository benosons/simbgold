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
    <div class="caption"><i class="fa fa-globe"></i> Penjadwalan Konsultasi PBG dan SLF</div>
    <div class="tools"><a href="javascript:;" class="reload"></a></div>
  </div>
  <div class="portlet-body">
    <div class="form-actions">
      <?php echo form_open('Penjadwalan/index', array('name' => 'frmListVerifikasi', 'id' => 'frmListVerifikasi')); ?>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group col-md-12">
            <label class="control-label col-md-3"><b>Fungsi Bangunan</b></label>
            <div class="col-md-9">
              <div class="col-md-5">
                <select class="form-control select2me" name="id_fungsi_bg">
                  <option value="">Semua Fungsi</option>
                  <option value="1" <?php if (isset($id_fungsi_bg) && $id_fungsi_bg == 1) echo "selected"; ?>>Fungsi Hunian</option>
                  <option value="2" <?php if (isset($id_fungsi_bg) && $id_fungsi_bg == 2) echo "selected"; ?>>Fungsi Keagamaan</option>
                  <option value="3" <?php if (isset($id_fungsi_bg) && $id_fungsi_bg == 3) echo "selected"; ?>>Fungsi Usaha</option>
                  <option value="4" <?php if (isset($id_fungsi_bg) && $id_fungsi_bg == 4) echo "selected"; ?>>Fungsi Sosial dan Budaya</option>
                  <option value="5" <?php if (isset($id_fungsi_bg) && $id_fungsi_bg == 5) echo "selected"; ?>>Fungsi Khusus</option>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group col-md-12">
            <label class="control-label col-md-3"><b>Status Penugasan TPA/TPT</b></label>
            <div class="col-md-9">
              <div class="col-md-5">
                <select class="form-control select2me" name="id_proses">
                  <option value="0">Semua Proses</option>
                  <option value="1" <?php if (isset($id_proses) && $id_proses == 1) echo "selected"; ?>>Belum Ditugaskan</option>
                  <option value="2" <?php if (isset($id_proses) && $id_proses == 2) echo "selected"; ?>>Sudah Ditugaskan</option>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group col-md-12">
            <label class="control-label col-md-3"><b>Tgl. Penugasan</b></label>
            <div class="col-md-9">
              <div class="col-md-2">
                <input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" name="tanggalawal" value="<?= (isset($tanggalawal) ? tgl_eng_to_ind($tanggalawal) : ''); ?>" placeholder="01-01-2018" />
              </div>
              <label class="control-label col-md-1">
                <center><b>s/d</b></center>
              </label>
              <div class="col-md-2">
                <input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" name="tanggalakhir" value="<?= (isset($tanggalakhir) ? tgl_eng_to_ind($tanggalakhir) : ''); ?>" placeholder="31-12-2020" />
              </div>
            </div>
          </div>
          <div class="form-group col-md-12">
            <label class="control-label col-md-3"><b></b></label>
            <div class="col-md-9">
              <div class="col-md-12">
                <input type="submit" class="btn green" id="search" name="search" value="Pencarian">
                <button type="submit" class="btn green" onclick="resetCari()">Reset</button>
                <a href="javascript:void(0);" onClick="javascript:GetPdf()" title="cetak" class="btn green">Cetak</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php echo form_close() ?>
    </div>
    <table class="table table-striped table-bordered table-hover" id="regularTable">
      <?php echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '</div>' : ''; ?>
      <thead>
        <tr>
          <th>No</th>
          <th>Jenis Permohonan</th>
          <th>No. Registrasi</th>
          <th>Nama Pemilik</th>
          <th>Lokasi BG</th>
          <th>Status Konsultasi</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($datapbg as $pbg) :
          if ($pbg->status < 6) {
            $ustat = "Belum Dijadwalkan!";
            $bgcolor = "danger";
          } else if ($pbg->status == 7) {
            $ustat = "Dikembalikan Untuk Perbaikan";
            $bgcolor = "warning";
          } else if ($pbg->status == 8) {
            $ustat =  'Penjadwalan Ulang!';
            $bgcolor = "warning";
          } else {
            $ustat =  'Sudah Dijadwalkan!';
            $bgcolor = "success";
          }
        ?>
          <tr class="<?= $bgcolor ?>">
            <td><?php echo $no++; ?></td>
            <td><?php echo $pbg->nm_konsultasi; ?></td>
            <td><?php echo $pbg->no_konsultasi; ?></td>
            <td><?php echo $pbg->nm_pemilik; ?></td>
            <td><?php echo $pbg->almt_bgn; ?></td>
            <td><?php echo $ustat; ?></td>
            <td>
              <?php if ($pbg->status < 6) : ?>
                <a href="#" onClick="getJadwalKonsultasi('<?php echo $this->Outh_model->Encryptor('encrypt', $pbg->id); ?>')" class="btn btn-success btn-sm" title="Buat Penjadwalan" data-toggle="modal" data-target="#static"><span class="fa fa-edit"></span></a>
                <div class="data-action"></div><br>
                <a href="<?php echo site_url('Penjadwalan/Rollback/' . $pbg->id); ?>" class="btn btn-warning btn-sm" onclick="return confirm('Yakin Mengembalikan Permohonan ini ke Proses Penugasan TPA/TPT?')"title="Dikembalikan ke Proses Penugasan TPA/TPT"><span class="glyphicon glyphicon-edit"></span>
                <?php elseif ($pbg->status == 8) : ?>
                <a href="#" onClick="getJadwalKonsultasi('<?php echo $this->Outh_model->Encryptor('encrypt', $pbg->id); ?>')" class="btn btn-warning btn-sm" title="Buat Penjadwalan" data-toggle="modal" data-target="#static"><span class="fa fa-edit"></span></a>
              <?php else : ?>
                <a href="javascript:;" class="btn btn-info btn-sm detail-penjadwalan" title="Lihat Data" data-id="<?= $pbg->id ?>"><span class="glyphicon glyphicon-user"></span></a>
              <?php endif; ?>
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
    <div class="modal-content"></div>
  </div>
</div>
<!-- Begin Penugasan TPT/TPA -->
<div id="static" class="modal fade bs-modal-lg" data-width="80%" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    </div>
    <div class="modal-body">
      <div id="content">
        <div class="col-md-12">
          <div class="portlet-title">
            <h4 align="center" class="caption-subject font-blue bold uppercase no-konsultasi"></h4>
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
              <div class="col-md-4 name">Lokasi Bangunan Gedung</div>
              <div class="col-md-8 value alamat-bangunan"></div>
            </div>
            <div class="fungsi-bangunan" style="display:block;">
              <div class="row static-info">
                <div class="col-md-4 name">Fungsi Bangunan Gedung</div>
                <div class="col-md-8 value fungsi-bangunan-gedung"></div>
              </div>
              <div class="row static-info">
                <div class="col-md-4 name">Luas, Tinggi &amp; Jumlah Lantai</div>
                <div class="col-md-8 value luas-tinggi-lantai"></div>
              </div>
            </div>
            
            <div class="prasarana" style="display:none;">
              <div class="row static-info">
                <div class="col-md-4 name">Fungsi Bangunan Gedung</div>
                <div class="col-md-8 value fungsi-bangunan-gedung"></div>
              </div>
              <div class="row static-info">
                <div class="col-md-4 name">Luas dan Tinggi Bangunan Prasarana</div>
                <div class="col-md-8 value luas-tinggi"></div>
              </div>
            </div>
            <div class="pertashop" style="display:none;">
              <div class="row static-info">
                <div class="col-md-4 name">Fungsi Bangunan Gedung</div>
                <div class="col-md-8 value fungsi-bangunan-gedung"></div>
              </div>
              <div class="row static-info">
                <div class="col-md-4 name">Luas dan Tinggi Bangunan</div>
                <div class="col-md-8 value luas-tinggi"></div>
              </div>
            </div>
            <div class="bangunan-kolektif" style="display:none;">
              <div class="row static-info">
                <div class="col-md-4 name">Jenis Konsultasi Bangunan</div>
                <div class="col-md-8 value">Bangunan Gedung Kolektif</div>
              </div>
              <div class="row static-info">
                <div class="col-md-4 name">Data Bangunan Gedung Kolektif</div>
                <div class="col-md-8 value">
                  <table class="table table-hover table-bordered dt-responsive wrap">
                    <thead>
                      <tr>
                        <th>Tipe</th>
                        <th>Luas (m<sup>2</sup>)</th>
                        <th>Tinggi</th>
                        <th>Lantai</th>
                        <th>Jumlah Unit</th>
                      </tr>
                    </thead>
                    <tbody id="tableKolektif"></tbody>
                  </table>
                </div>
              </div>
              <div class="row static-info">
                <div class="col-md-4 name">Total Luas Bangunan Kolektif</div>
                <div class="col-md-8 value total-luas-kolektif"></div>
              </div>
            </div>
            <hr>
            <div class="tabbable-custom nav-justified">
              <ul id="tabdp3" class="nav nav-tabs nav-justified">
                <li class="active"><a href="#ps" data-toggle="tab">Penjadwalan Konsultasi</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane fade active in" id="ps">
                  <br>
                  <div class="row">
                    <input type="text" style="display: none;" name="id_penjadwalan" id="id_penjadwalan" value="">
                    <div class="col-md-6">
                      <form action="<?= site_url('Penjadwalan/simpan_penjadwalan') ?>" role="form" method="post" id="jsnya" enctype="multipart/form-data">
                        <input type="hidden" id='csrf_id' name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <div class="form-body">
                          <div class="row">
                            <div class="col-md-3">
                              <div class="form-group form-md-line-input">
                                <div class="input-group">
                                  <span class="input-group-addon"><i class="fa fa-circle"></i></span>
                                  <input type="text" name="konsultasi_ke" class="form-control konsultasi-ke" readonly="">
                                  <label for="form_control_1">Konsultasi</label>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-5">
                              <div class="form-group form-md-line-input">
                                <div class="input-group">
                                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                  <input class="form-control" name="tanggal_konsultasi" type="date" data-date-format="yyyy-mm-dd" placeholder="Tanggal Konsultasi">
                                  <label for="form_control_1">Tgl. Konsultasi</label>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group form-md-line-input">
                                <div class="input-group">
                                  <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
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
                                  <option value="1">Onsite</option>
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
                                <label for="form_control_1">Email</label>
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
                        <input type="submit" name="submit" value="Simpan Jadwal Konsultasi" class="btn btn-success btn-block">
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
                                      <th><center>#</center></th>
                                      <th><div class="jenis-penugasan"></div></th>
                                      <th>Unsur</th>
                                      <th>Bidang Keahlian</th>
                                    </tr>
                                  </thead>
                                  <tbody class="data-penugasan"></tbody>
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
                          <table class="table table-bordered table-striped table-hover" id="tableKonsultasi">
                            <thead>
                              <tr class="info">
                                <th>No</th>
                                <th>Sesi Konsultasi</th>
                                <th>Tgl</th>
                                <th>Jam</th>
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
<!-- End Penugasan TPT/TPA -->
<!-- Begin Data Detail Penjadwalan -->
<div id="modalDetail" class="modal fade bs-modal-sm" data-width="70%" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-content">
    <div class="modal-body">
      <div id="content">
        <div class="portlet-title">
          <h4 align="center" class="caption-subject font-blue bold uppercase no-konsultasi"></h4>
          <hr>
          <br>
          <h5 class="caption-subject font-blue bold uppercase">Detail Kepemilikan</h5>
          <div class="row static-info">
            <div class="col-md-4 name">Nama Pemilik</div>
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
          <!--  <div class="row static-info">
            <div class="col-md-4 name">Tanggal Verifikasi &amp; <br> Batas Waktu Pelayanan</div>
            <div class="col-md-8 value tgl-periode">
            </div>
          </div>-->
          <div class="row static-info">
            <div class="col-md-4 name">Lokasi Bangunan Gedung</div>
            <div class="col-md-8 value alamat-bangunan"></div>
          </div>
          <div class="fungsi-bangunan" style="display:none;">
            <div class="row static-info">
              <div class="col-md-4 name">Fungsi Bangunan Gedung</div>
              <div class="col-md-8 value fungsi-bangunan-gedung"></div>
            </div>
            <div class="row static-info">
              <div class="col-md-4 name">Luas, Tinggi &amp; Jumlah Lantai</div>
              <div class="col-md-8 value luas-tinggi-lantai"></div>
            </div>
          </div>

          <div class="bangunan-kolektif" style="display:none;">
            <div class="row static-info">
              <div class="col-md-4 name">Jenis Konsultasi Bangunan</div>
              <div class="col-md-8 value">Bangunan Gedung Kolektif</div>
            </div>
            <div class="row static-info">
              <div class="col-md-4 name">Data Bangunan Gedung Kolektif</div>
              <div class="col-md-8 value">
                <table class="table table-hover table-bordered dt-responsive wrap">
                  <thead>
                    <tr>
                      <th>Tipe</th>
                      <th>Luas (m<sup>2</sup>)</th>
                      <th>Tinggi</th>
                      <th>Lantai</th>
                      <th>Jumlah Unit</th>
                    </tr>
                  </thead>
                  <tbody id="tableKolektif"></tbody>
                </table>
              </div>
            </div>
            <div class="row static-info">
              <div class="col-md-4 name">Total Luas Bangunan Kolektif</div>
              <div class="col-md-8 value total-luas-kolektif"></div>
            </div>
          </div>
          <br>
          <h5 class="caption-subject font-blue bold uppercase">Detail Tim Penugasan</h5>
          <table class="table table-bordered table-striped table-hover data-penugasan">
            <thead>
              <tr style="padding-left: 5px; padding-bottom:3px;  font-weight:bold" class="info">
                <th>No</th>
                <th>Nama Tim TPA/TPT</th>
                <th>Unsur</th>
                <th>Bidang Keahlian</th>
              </tr>
            </thead>
            <tbody class="data-penugasan">
            </tbody>
          </table>
          <br>
          <h5 class="caption-subject font-blue bold uppercase">Data Penjadwalan Konsultasi</h5>
          <table class="table table-bordered table-striped table-hover">
            <thead>
              <tr class="info">
                <th>No</th>
                <th>Sesi Konsultasi</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Tempat / Keterangan</th>
                <th>Tipe Konsultasi</th>
                <th>Link Konsultasi</th>
                <th>Password</th>
                <th>Berkas Undangan</th>
              </tr>
            </thead>
            <tbody id="dataKonsultasi">
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" data-dismiss="modal" class="btn btn-primary" onClick=""><i class="fa fa-sign-out"></i> Tutup</button>
    </div>
  </div>
</div>
<!-- End Data Detail Penjawdwalan -->
<script type="text/javascript">
  function GetPdf() {
    url = "<?php echo base_url() . index_page() ?>Penjadwalan/cetak/";
    swin = window.open(url, 'win', 'scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
    swin.focus();
  }
</script>
<script>
  var site_url = "<?= site_url() ?>";
  $(document).ready(function() {
    var collapsedGroups = {};
    var table = $('#regularTable').DataTable({
      "responsive": false,
      "language": {
        "aria": {
          "sortAscending": ": activate to sort column ascending",
          "sortDescending": ": activate to sort column descending"
        },
        "emptyTable": "Data Belum Tersedia",
        "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ jumlah data",
        "infoEmpty": "Data Tidak Ditemukan",
        "infoFiltered": "",
        "lengthMenu": "Tampilkan _MENU_ Baris",
        "search": "Cari:",
        "zeroRecords": "Data Tidak Ditemukan",
        "oPaginate": {
          "sNext": 'Selanjutnya',
          "sLast": 'Terakhir',
          "sFirst": 'Pertama',
          "sPrevious": 'Sebelumnya'
        }
      },
      order: [
        [2, 'asc']
      ],
      rowGroup: {
        // Uses the 'row group' plugin
        dataSrc: 2,
        startRender: function(rows, group) {
          var collapsed = !!collapsedGroups[group];

          rows.nodes().each(function(r) {
            r.style.display = collapsed ? 'none' : '';
          });

          // Add category name to the <tr>. NOTE: Hardcoded colspan
          return $('<tr/>')
            .append('<td colspan="8"> Total Permohonan: (' + rows.count() + ')</td>')
            .attr('data-name', group)
            .toggleClass('collapsed', collapsed);
        }
      }
    });
    $(document).on('click', '.detail-penjadwalan', function(e) {
      e.preventDefault();
      let dataDetail = $(this).data('id');
      $.ajax({
        type: "POST",
        url: `${site_url}DataDetail/DetailPenjadwalan`,
        data: {
          id: dataDetail
        },
        beforeSend: function() {
          Metronic.blockUI({
            animate: true
          });
        },
        dataType: "json",
        success: function(response) {
          if (response.res == true) {
            Metronic.unblockUI();
            $(".no-konsultasi").html(response.no_konsultasi);
            $(".nm-pemilik").html(response.nm_pemilik);
            $(".jenis-konsultasi").html(response.nm_konsultasi);
            $(".alamat-pemilik").html(`${response.alamat}, Kec. ${response.nama_kecamatan},${response.nama_kabkota}, ${response.nama_prov_pemilik}`);
            $(".alamat-bangunan").html(`${response.almt_bgn}, Kec. ${response.nama_kec_bg},${response.nama_kabkota_bg}, ${response.nama_provinsi_bg}`);
            $(".fungsi-bangunan-gedung").html(`${response.fungsi_bg}`);
            $(".luas-tinggi-lantai").html(`${response.luas_bgn} m<sup>2</sup>, dengan tinggi ${response.tinggi_bgn} meter, dan berjumlah ${response.jml_lantai} lantai.`);
            $(".tgl-periode").html(`<p><span class="font-blue">${response.tgl_pernyataan}</span> <i class="text-tot">sampai dengan</i> <span class="font-blue">${response.hasil_tgl}</span> <i class="text-tot">, (${response.lama_proses} Hari Kerja) <br>terhitung dari tanggal verifikasi kelengkapan berkas</i></p>`);
            var table;
            let num = 1;
            if (response.penugasan != 0) {
              response.penugasan.forEach(obj => {
                table += '<tr>';
                table += `<td>${num++}</td>`;
                table += `<td>${obj.nama_peg}</td>`;
                table += `<td>${obj.nama_unsur}</td>`;
                table += `<td>${obj.nama_bidang}</td>`;
                $('.data-penugasan').html(table);
              });
            }
            let jadwal = response.list_jadwal;
            const konsul = $('#dataKonsultasi');
            konsul.empty();
            let numB = 1;
            jadwal.forEach(obj => {
              let tgl_konsultasi = obj.tgl_konsultasi === null ? `` : obj.tgl_konsultasi;
              let jam_konsultasi = obj.jam_konsultasi === null ? `` : obj.jam_konsultasi;
              let ket_konsultasi = obj.ket_konsultasi === null ? `` : obj.ket_konsultasi;
              let tipe_konsultasi = obj.tipe_konsultasi == 1 ? `Onsite` : `Online`;
              let link_meeting = obj.link_meeting === null ? `Belum Diset` : `<a href="${obj.link_meeting}">Klik Disini</a>`;
              let password_meeting = obj.password_meeting === null ? `Belum Diset` : obj.password_meeting;
              konsul.append(`<tr>
                <td>${numB++}</td>
                <td>ke-${obj.konsultasi}</td>
                <td>${tgl_konsultasi}</td>
                <td>${jam_konsultasi}</td>
                <td>${ket_konsultasi}</td>
                <td>${tipe_konsultasi}</td>
                <td>${link_meeting}</td>
                <td>${password_meeting}</td>
                <td><a href="javascript:void(0);" class="btn btn-success btn-sm" title="Lihat Berkas" onclick="javascript:popWin('${base_url}object-storage/dekill/Schedule/${obj.dir_file_undangan}')"><span class="glyphicon glyphicon-file"></span></a></td>
                </tr>`);
            });

            $('#modalDetail').modal('show');
          } else {
            showToast(response.message, 15000, response.type);
            Metronic.unblockUI();
          }
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

    $('#regularTable tbody tr.group-start').each(function() {
      var name = $(this).data('Nomor Registrasi');
      collapsedGroups[name] = !collapsedGroups[name];
    });
    table.draw(false);

    $('#regularTable tbody').on('click', 'tr.group-start', function() {
      var name = $(this).data('Nomor Registrasi');
      collapsedGroups[name] = !collapsedGroups[name];
      table.draw(false);
    });

    $('#modalElement').on('hidden', function() {
      $(this).data('modal', null);
    });

    $('#tglKonsultasi').datepicker();

    $("#tipeKonsultasi").change(function(e) {
      e.preventDefault();
      let val = $(this).val();
      if (val == 1) {
        $(".tempat-konsultasi").css("display", "block");
        $(".link-konsultasi").css("display", "none");
        $(".password-konsultasi").css("display", "none");
      } else if (val == 2) {
        $(".tempat-konsultasi").css("display", "none");
        $(".link-konsultasi").css("display", "block ");
        $(".password-konsultasi").css("display", "block");
      } else {
        $(".tempat-konsultasi").css("display", "none");
        $(".link-konsultasi").css("display", "none");
        $(".password-konsultasi").css("display", "none");
      }
    });
  });

  var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
    csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';

  function getJadwalKonsultasi(id) {

    $.ajax({
      type: "POST",
      url: `${base_url}Penjadwalan/konsultasi`,
      data: {
        [csrfName]: csrfHash,
        id: id
      },
      beforeSend: function() {
        Metronic.blockUI({
          animate: true
        });
      },
      success: function(data) {
        Metronic.unblockUI();
        let csrf_token = data.csrf;
        $('#csrf_id').val(csrf_token);
        $(".no-konsultasi").html(data.no_konsultasi);
        $(".nm-pemilik").html(data.nm_pemilik);
        $(".alamat-pemilik").html(`${data.alamat}, Kec. ${data.nama_kecamatan}, ${data.nama_kabkota}, ${data.nama_prov_pemilik}`);
        $(".jenis-konsultasi").html(data.nm_konsultasi);
        $(".alamat-bangunan").html(`${data.almt_bgn}, Kec. ${data.nama_kec_bg}, ${data.nama_kabkota_bg}, ${data.nama_provinsi_bg}`);
        $(".fungsi-bangunan-gedung").html(`${data.fungsi_bg}`);
        $(".luas-tinggi-lantai").html(`${data.luas_bgn} m<sup>2</sup>, dengan tinggi ${data.tinggi_bgn} meter, dan berjumlah ${data.jml_lantai} lantai.`);
        $(".luas-tinggi").html(`${data.luas_bgp} m<sup>2</sup>, dengan tinggi ${data.tinggi_bgp} meter`);
        $(".luas-prasarana").html(data.luas_bgp);
        $(".tinggi-prasarana").html(data.tinggi_bgp);
        $(".jenis-prasarana").html(data.jns_prasarana);
        $(".konsultasi-ke").val(`ke-${data.nextKonsultasi}`);
        $(".tgl-periode").html(`<p class="font-blue"> ${data.tgl_pernyataan} <i class="text-tot">sampai dengan</i> ${data.hasil_tgl} <i class="text-tot">, (${data.lama_proses} Hari Kerja) <br>terhitung dari tanggal verifikasi kelengkapan berkas</i></p>`);
        $("#idKonsultasi").val(data.id_konsultasi);
        $("#email").val(data.email);
        $("#noreg").val(data.no_konsultasi);
        if (data.id_jenis_permohonan == 11) {
          $('.prasarana').css('display', 'none');
          $('.fungsi-bangunan').css('display', 'none');
          $('.bangunan-kolektif').css('display', 'block');
          $('.pertashop').css('display', 'none');
          $('.total-luas-kolektif').html(`${data.luas_total_kolektif} m<sup>2</sup>`);
          var tableKolektif;
          if (data.hasil_kolektif != 0) {
            data.hasil_kolektif.forEach(obj => {
              tableKolektif += '<tr>';
              tableKolektif += `<td>${obj.tipe}</td>`;
              tableKolektif += `<td>${obj.luas}</td>`;
              tableKolektif += `<td>${obj.tinggi}</td>`;
              tableKolektif += `<td>${obj.lantai}</td>`;
              tableKolektif += `<td>${obj.jumlah}</td></tr>`;
              $('#tableKolektif').html(tableKolektif);
            });
          }
        } else if (data.id_jenis_permohonan == 12) {
          $('.prasarana').css('display', 'block');
          $('.fungsi-bangunan').css('display', 'none');
          $('.bangunan-kolektif').css('display', 'none');
          $('.pertashop').css('display', 'none');
        } else if(data.id_jenis_permohonan == 21){
          $('.prasarana').css('display', 'none');
          $('.fungsi-bangunan').css('display', 'none');
          $('.bangunan-kolektif').css('display', 'none');
          $('.pertashop').css('display', 'block');
        } else if(data.id_jenis_permohonan == 34){
          $('.prasarana').css('display', 'none');
          $('.fungsi-bangunan').css('display', 'none');
          $('.bangunan-kolektif').css('display', 'none');
          $('.pertashop').css('display', 'block');
        }else{
          $('.prasarana').css('display', 'none');
          $('.fungsi-bangunan').css('display', 'block');
          $('.bangunan-kolektif').css('display', 'none');
          $('.pertashop').css('display', 'none');
        }

        $(".jenis-penugasan").html(data.daftar_tim_penugasan);
        let pengawas = data.pengawas;

        const res = $('#pengawas');
        res.empty();
        let num = 1;
        var table;
        if (data.penugasan != 0) {
          data.penugasan.forEach(obj => {
            table += '<tr>';
            table += `<td>${num++}</td>`;
            table += `<td>${obj.nama_peg}</td>`;
            table += `<td>${obj.nama_unsur}</td>`;
            table += `<td>${obj.nama_bidang}</td>`;
            $('.data-penugasan').html(table);
          });
        }
        let konsultasi = data.list_jadwal;
        const konsul = $('#konsultasi');
        konsul.empty();
        let numB = 1;
        konsultasi.forEach(obj => {
          let tgl_konsultasi = obj.tgl_konsultasi === null ? `` : obj.tgl_konsultasi;
          let jam_konsultasi = obj.jam_konsultasi === null ? `` : obj.jam_konsultasi;
          let ket_konsultasi = obj.ket_konsultasi === null ? `` : obj.ket_konsultasi;
          let tipe_konsultasi = obj.tipe_konsultasi == 1 ? `Onsite` : `Online`;
          let link_meeting = obj.link_meeting === null ? `Belum Diset` : `<a href="${obj.link_meeting}">Klik Disini</a>`;
          let password_meeting = obj.password_meeting === null ? `Belum Diset` : obj.password_meeting;
          konsul.append(`<tr>
      <td>${numB++}</td>
      <td>ke-${obj.konsultasi}</td>
      <td>${tgl_konsultasi}</td>
      <td>${jam_konsultasi}</td>
      <td>${ket_konsultasi}</td>
      <td>${tipe_konsultasi}</td>
      <td>${link_meeting}</td>
      <td>${password_meeting}</td>
      <td><a href="javascript:void(0);" class="btn btn-success btn-sm" title="Lihat Berkas" onclick="javascript:popWin('${base_url}object-storage/file/PBG/${data.no_konsultasi}/konsultasi/undangan_konsultasi/${obj.dir_file_undangan}')"><span class="glyphicon glyphicon-file"></span></a></td>
      </tr>`);
        });
      }
    });
    return false;
  };

  function popWin(x) {
    url = x;
    swin = window.open(url, 'win', 'scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
    swin.focus();
  }
</script>
<!-- <script src="<?= base_url() ?>assets/app/js/penjadwalan.js" async></script> -->