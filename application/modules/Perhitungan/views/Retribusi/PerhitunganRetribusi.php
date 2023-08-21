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
    .ket-bangunan {
      margin-bottom: -20px;
    }
    body>div.page-content>div>div>div>div {
      font-size: 15px;
    }
  </style>
  <div class="row">
    <div class="col-md-12">
      <div class="portlet box blue">
        <div class="portlet-title">
          <div class="caption"><i class="fa fa-calculator"></i>Form Perhitungan Retribusi</div>
          <div class="tools"></div>
        </div>
        <div class="portlet-body form">
          <form class="form-horizontal" role="form">
            <div class="form-body">
              <h4 class="form-section" style="text-align: center;"><strong>Data Bangunan - <?php echo $row->no_konsultasi ?></strong></h4>
              <div class="row">
                <div class="col-md-8 ket-bangunan">
                  <div class="form-group">
                    <label class="control-label col-md-4">Nama Pemilik:</label>
                    <div class="col-md-6">
                      <p class="form-control-static"><?php echo $row->nm_pemilik ?></p>
                    </div>
                  </div>
                </div>
                <div class="col-md-8 ket-bangunan">
                  <div class="form-group">
                    <label class="control-label col-md-4">Alamat Bangunan:</label>
                    <div class="col-md-8">
                      <p class="form-control-static"> <?php echo $row->almt_bgn; ?></p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-8 ket-bangunan">
                  <div class="form-group">
                    <label class="control-label col-md-4">Fungsi Bangunan Gedung:</label>
                    <div class="col-md-8">
                      <p class="form-control-static"><?php echo $row->fungsi_bg ?></p>
                    </div>
                  </div>
                </div>
                <?php if ($row->id_jenis_permohonan == '11' || $row->id_jenis_permohonan == '29' || $row->id_jenis_permohonan == '30' || $row->id_jenis_permohonan == '31' || $row->id_jenis_permohonan == '32' || $row->id_jenis_permohonan == '33') { ?>
                  <div class="row">
                    <div class="col-md-8 ket-bangunan">
                      <div class="form-group">
                        <div class="control-label col-md-4">Data Bangunan Kolektif</div>
                        <div class="col-md-8 value">
                          <table class="table table-striped table-bordered dt-responsive wrap" id="tipe_bgn">
                            <tr>
                              <th>Tipe</th>
                              <th>Jumlah Unit</th>
                              <th>Luas</th>
                              <th>Tinggi</th>
                              <th>Lantai</th>
                            </tr>
                            <?php
                            $tipe = json_decode($row->tipeA);
                            $jumlah = json_decode($row->jumlahA);
                            $luas = json_decode($row->luasA);
                            $tinggi = json_decode($row->tinggiA);
                            $lantai = json_decode($row->lantaiA);
                            $bangunan = array();
                            foreach ($tipe as $noo => $val) {
                              if ($val != "")
                                $bangunan['tipe'][$noo] = $val;
                            }
                            foreach ($jumlah as $noo => $val) {
                              if ($val != "")
                                $bangunan['jumlah'][$noo] = $val;
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
                            $no = 0;
                            $LuasBg = 0;
                            $jumlahLantai = 0;
                            if (!empty($bangunan)) {
                              foreach ($bangunan['tipe'] as $dt) {
                                $no++;
                                $LuasBg += $bangunan['luas'][$no] * $bangunan['jumlah'][$no];
                                $jumlahLantai += $bangunan['lantai'][$no];
                            ?>
                                <tr id="tr-tipe<?php echo $no ?>">
                                  <td><?php echo form_input('tipeA[' . $no . ']', $bangunan['tipe'][$no], 'style="width:90px;" id="posisi' . $no . '" class="posisi' . $no . ' form-control"'); ?></td>
                                  <td><?php echo form_input('jumlahA[' . $no . ']', $bangunan['jumlah'][$no], 'style="width:100px;" id="luas' . $no . '" class="luas' . $no . ' form-control"'); ?></td>
                                  <td><?php echo form_input('luasA[' . $no . ']', $bangunan['luas'][$no], 'style="width:100px;" id="luas' . $no . '" class="luas' . $no . ' form-control"'); ?></td>
                                  <td><?php echo form_input('tinggiA[' . $no . ']', $bangunan['tinggi'][$no], 'style="width:90px;" id="tinggi' . $no . '" class="tinggi' . $no . ' form-control"'); ?></td>
                                  <td><?php echo form_input('lantaiA[' . $no . ']', !empty($bangunan['lantai'][$no]) ? $bangunan['lantai'][$no] : '', 'style="width:90px;" id="lantai' . $no . '" class="lantai' . $no . ' form-control"'); ?></td>
                                </tr>
                              <?php }
                            } else { ?>
                              <tr id="tr-tipe">
                                <td><?php echo form_input('tipeA[1]', '', 'style="width:90px;" id="posisi1" class="posisi1 form-control"'); ?></td>
                                <td><?php echo form_input('jumlahA[1]', '', 'style="width:100px;" id="jumlah1" class="unit1 form-control"'); ?></td>
                                <td><?php echo form_input('luasA[1]', '', 'style="width:100px;" id="luas1" class="unit1 form-control"'); ?></td>
                                <td><?php echo form_input('tinggiA[1]', '', 'style="width:90px;" id="tinggi1" class="tinggi1 form-control"'); ?></td>
                                <td><?php echo form_input('lantaiA[1]', '', 'style="width:90px;" id="lantai1" class="tinggi1 form-control"'); ?></td>
                                <td></td>
                              </tr>
                            <?php } ?>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-8 ket-bangunan">
                    <div class="form-group">
                      <label class="control-label col-md-4">Total Luas:</label>
                      <div class="col-md-8">
                        <p class="form-control-static">
                          <?= (isset($LuasBg) ? str_replace('.', ',', floatval($LuasBg)) : '') ?> m<sup>2</sup>
                        </p>
                      </div>
                    </div>
                  </div>
                <?php } else if ($row->id_jenis_permohonan == '12') { ?>
                  <div class="col-md-8 ket-bangunan">
                    <div class="form-group">
                      <label class="control-label col-md-4">Luas dan Tinggi Prasarana</label>
                      <div class="col-md-8">
                        <p class="form-control-static">
                          <?= (isset($row->luas_bgp) ? str_replace('.', ',', floatval($row->luas_bgp)) : '') ?> m<sup>2</sup>, dengan tinggi <?= (isset($row->tinggi_bgp) ? $row->tinggi_bgp : '') ?> meter dan berjumlah <?= (isset($row->jml_lantai) ? $row->jml_lantai : '') ?> lantai.
                        </p>
                      </div>
                    </div>
                  </div>
                <?php } else if($row->id_jenis_permohonan == '21' || $row->id_jenis_permohonan == '34' || $row->id_jenis_permohonan == '35' || $row->id_jenis_permohonan == '36'){ ?>
                  <div class="col-md-8 ket-bangunan">
                    <div class="form-group">
                      <label class="control-label col-md-4">Luas dan Tinggi </label>
                      <div class="col-md-8">
                        <p class="form-control-static">
                          <?= (isset($row->luas_bgp) ? str_replace('.', ',', floatval($row->luas_bgp)) : '') ?> m<sup>2</sup>, dengan tinggi <?= (isset($row->tinggi_bgp) ? $row->tinggi_bgp : '') ?> meter
                        </p>
                      </div>
                    </div>
                  </div>
                <?php } else { ?>
                  <div class="col-md-8 ket-bangunan">
                    <div class="form-group">
                      <label class="control-label col-md-4">Luas, Tinggi & Jumlah Lantai:</label>
                      <div class="col-md-8">
                        <p class="form-control-static">
                          <?= (isset($row->luas_bgn) ? str_replace('.', ',', floatval($row->luas_bgn)) : '') ?> m<sup>2</sup>, dengan tinggi <?= (isset($row->tinggi_bgn) ? $row->tinggi_bgn : '') ?> meter dan berjumlah <?= (isset($row->jml_lantai) ? $row->jml_lantai : '') ?> lantai.
                        </p>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
              <div class="row">
                <div class="col-md-8 ket-bangunan">
                  <div class="form-group">
                    <label class="control-label col-md-4">Jenis Kepemilikan:</label>
                    <div class="col-md-8">
                      <p class="form-control-static"> <?php echo $jns_kepemilikan == 0 && $jns_kepemilikan != NULL ? 'Pemerintah' : 'Perorangan/Usaha'; ?></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <form action="<?php echo site_url('Perhitungan/SimpanRetribusi') ?>" method="POST" class="form-horizontal" id="formRetribusi">
        <div class="form-body">
          <h4 class="form-section" style="text-align:center;"><strong>Indeks Terintegrasi</strong></h4>
          <div class="row">
            <div class="col-md-6">
              <div class="portlet box purple">
                <div class="portlet-title">
                  <div class="caption"><i class="fa fa-list"></i> Data Indeks Terintegrasi</div>
                </div>
                <div class="portlet-body" style="max-height:250px;height:250px;">
                  <div class="row">
                    <div class="col-md-12 ket-bangunan">
                      <div class="form-group">
                        <label class="control-label col-md-4 " style="text-align:left;">Jenis Usaha</label>
                        <div class="col-md-8">
                          <?php if ($row->id_fungsi_bg == 3) : ?>
                            <div class="radio-list">
                              <label class="radio-inline">
                                <?php $parameter_usaha = $retribusi != NULL ? $retribusi->parameter_usaha : '' ?>
                                <input type="radio" name="usaha" class="radio-usaha" value="0.5" <?= $parameter_usaha == '0.5' ? 'checked' : '' ?> /> UMKM </label>
                              <label class="radio-inline">
                                <input type="radio" name="usaha" class="radio-usaha" value="0.7" <?= $parameter_usaha == '0.7' ? 'checked' : '' ?> /> Usaha Besar </label>
                            </div>
                          <?php else : ?>
                            <p class="form-control-static"><?php echo $row->fungsi_bg; ?></p>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                    <!--<div class="col-md-12 ket-bangunan">
                      <div class="form-group">
                        <label class="control-label col-md-4" style="text-align:left;">Kompleksitas</label>
                        <div class="col-md-8">
                          <p class="form-control-static"><?php echo $row->klasifikasi_bg; ?></p>
                        </div>
                      </div>
                    </div>-->
                    <div class="col-md-12 ket-bangunan">
                      <div class="form-group">
                        <label class="control-label col-md-4" style="text-align:left;">Permanensi</label>
                        <div class="col-md-8">
                          <div class="radio-list">
                            <label class="radio-inline">
                              <?php $id_permanensi = $retribusi != NULL ? $retribusi->id_permanensi : '' ?>
                              <input type="radio" name="permanensi" class="radio-permanensi" value="1" <?= $id_permanensi == '1' ? 'checked' : '' ?> required/> Permanen </label>
                            <label class="radio-inline">
                              <input type="radio" name="permanensi" class="radio-permanensi" value="2" <?= $id_permanensi == '2' ? 'checked' : '' ?> selected required/> Non Permanen </label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 ket-bangunan">
                      <div class="form-group">
                        <label class="control-label col-md-4" style="text-align:left;">Jumlah Lantai</label>
                        <div class="col-md-8">
                          <p class="form-control-static jumlah-lantai"><?php echo $jumlahLantai ?> - Lantai (Koefisien Jumlah Lantai : <?= $koefisienLantai ?>)</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 ket-bangunan">
                      <div class="form-group">
                        <label class="control-label col-md-4" style="text-align:left;">Basemen</label>
                        <div class="col-md-8">
                          <p class="form-control-static"><?php echo $row->lapis_basement ?> - Lapis (Koefisien Lapis Basement : <?= $koefisienBasement ?>)</p>
                        </div>
                      </div>
                    </div>
                    <?php
                    if ($row->id_jenis_permohonan == '11') {
                      $luas_bangunan = $LuasBg;
                    } else if ($row->id_jenis_permohonan == '12') {
                      $luas_bangunan = $row->luas_bgp;
                    } else if ($row->id_jenis_permohonan == '21' ){
                      $luas_bangunan = $row->luas_bgp;
                    }
                    else if($row->id_jenis_permohonan == '29'){
                      $luas_bangunan = $LuasBg;
                    } else if($row->id_jenis_permohonan == '30'){
                      $luas_bangunan = $LuasBg;
                    } 
                    else if($row->id_jenis_permohonan == '31'){
                      $luas_bangunan = $LuasBg;
                    }  
                    else if($row->id_jenis_permohonan == '32'){
                      $luas_bangunan = $LuasBg;
                    }  
                    else if($row->id_jenis_permohonan == '33'){
                      $luas_bangunan = $LuasBg;
                    }  
                    else if($row->id_jenis_permohonan == '34'){
                      $luas_bangunan = $row->luas_bgp;
                    }else if ($row->id_jenis_permohonan == '35'){
                      $luas_bangunan = $row->luas_bgp;
                    } else if ($row->id_jenis_permohonan == '36'){
                      $luas_bangunan = $row->luas_bgp;
                    } else {
                      $luas_bangunan = $row->luas_bgn;
                    }
                    $pk = 0.5;
                    $kl = $koefisienLantai;
                    $kb = $koefisienBasement;
                    $ll = floatval($luas_bangunan);
                    $lb = floatval($row->luas_basement);
                    $lli = $ll * $kl;
                    $lbi = $lb * $kb;
                    $dkb = $ll + $lb;
                    $dkbif = $dkb <= 0 ? 1 : $dkb;
                    $koefisienBG = ($lli + $lbi) / $dkbif;
                    $hasilKoefisienBG = bcadd(0, $koefisienBG, 3);
                    $hasilPK = $pk * $hasilKoefisienBG;
                    $hasilRumusPK = bcadd(0, $hasilPK, 3);
                    $rumusPK = "{$pk} x {$hasilKoefisienBG} = $hasilRumusPK";
                    ?>
                    <div class="col-md-12 ket-bangunan">
                      <div class="form-group">
                        <label class="control-label col-md-4" style="text-align:left;">Koefisien Ketinggian Bangunan</label>
                        <div class="col-md-8">
                          <p class="form-control-static"><?= "({$lli} + {$lbi}) / {$dkbif} = {$hasilKoefisienBG}" ?> </p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 ket-bangunan">
                      <div class="form-group">
                        <label class="control-label col-md-4" style="text-align:left;">Jenis Kepemilikan</label>
                        <div class="col-md-8">
                          <p class="form-control-static"> <?php echo $jns_kepemilikan == 0 && $jns_kepemilikan != NULL ? 'Pemerintah' : 'Perorangan/Usaha'; ?></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="portlet box green">
                <div class="portlet-title">
                  <div class="caption">
                    <i class="fa fa-edit"></i> Hasil Perhitungan Indeks Terintegrasi
                  </div>
                </div>
                <div class="portlet-body" style="max-height:250px;height:250px;">
                  <div class="row">
                    <div class="col-md-12 ket-bangunan">
                      <div class="form-group">
                        <label class="control-label col-md-8" style="text-align:left;">Indeks Parameter Fungsi Bangunan :</label>
                        <div class="col-md-3">
                          <p class="form-control-static parameter-fungsi">
                            <?php
                            if ($row->id_fungsi_bg == 1) {
                              $indexParameter = $row->id_klasifikasi == 1 ? 0.15 : 0.17;
                            } else if ($row->id_fungsi_bg == 6) {
                              $indexParameter = $row->luas_bgn > 500 ? 0.8 : 0.6;
                            } else {
                              $indexParameter = $row->index_parameter == NULL ? 0.15 : $row->index_parameter;
                            }
                            echo $indexParameter; ?></p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 ket-bangunan">
                      <div class="form-group">
                        <label class="control-label col-md-8" style="text-align:left;">Indeks Parameter Kompleksitas :</label>
                        <div class="col-md-4">
                          <?php
                          $parameterDasar = 0.3;
                          $parameterKompleksitas = $row->id_klasifikasi == 1 ? 1 : 2;
                          $hasilParameterKompleksitas = $parameterDasar * $parameterKompleksitas;
                          $rumusKompleksitas = "{$parameterDasar} x {$parameterKompleksitas} = $hasilParameterKompleksitas";
                          ?>
                          <p class="form-control-static parameter-kompleksitas"><?= $rumusKompleksitas; ?></p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 ket-bangunan">
                      <div class="form-group">
                        <label class="control-label col-md-8" style="text-align:left;">Indeks Parameter Permanensi :</label>
                        <div class="col-md-4">
                          <p class="form-control-static parameter-permanensi">0.2 x 1 = 0.2</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 ket-bangunan">
                      <div class="form-group">
                        <label class="control-label col-md-8" style="text-align:left;">Indeks Parameter Ketinggian :</label>
                        <div class="col-md-4">

                          <p class="form-control-static parameter-ketinggian"><?= $rumusPK ?></p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 ket-bangunan">
                      <div class="form-group">
                        <label class="control-label col-md-8" style="text-align:left;">Faktor Kepemilikan :</label>
                        <div class="col-md-4">
                          <p class="form-control-static faktor-kepemilikan"></p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 ket-bangunan">
                      <div class="form-group">
                        <label class="control-label col-md-6" style="text-align:left;">Indeks Integrasi</label>
                        <div class="col-md-6">
                          <p class="form-control-static indeks-integrasi"></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <h4 class="form-section" style="text-align:center;"><strong>Perhitungan Nilai Retribusi</strong></h4>
          <div class="col-md-12">
            <div class="portlet box yellow">
              <div class="portlet-title">
                <div class="caption">
                  <i class="fa fa-edit"></i> Hasil Perhitungan Nilai Retribusi
                </div>
              </div>
              <div class="portlet-body">
                <div class="row">
                  <div class="col-md-12 ket-bangunan">
                    <div class="form-group">
                      <label class="control-label col-md-4" style="text-align:left;">Luas Bangunan Gedung :</label>
                      <div class="col-md-6">
                        <?php if ($row->id_jenis_permohonan == '11' || $row->id_jenis_permohonan == '29' || $row->id_jenis_permohonan == '30' || $row->id_jenis_permohonan == '31' || $row->id_jenis_permohonan == '32' || $row->id_jenis_permohonan == '33') {
                          $luas_bangunan = $LuasBg;
                        } else if ($row->id_jenis_permohonan == '12') {
                          $luas_bangunan = $row->luas_bgp;
                        } else if ($row->id_jenis_permohonan == '21'){
                          $luas_bangunan = $row->luas_bgp;
                        } else if($row->id_jenis_permohonan == '34'){
                          $luas_bangunan = $row->luas_bgp;
                        }else if ($row->id_jenis_permohonan == '35'){
                          $luas_bangunan = $row->luas_bgp;
                        } else if ($row->id_jenis_permohonan == '36'){
                          $luas_bangunan = $row->luas_bgp;
                        } else{
                          $luas_bangunan = $row->luas_bgn + $row->luas_basement;
                        } ?>
                        <p class="form-control-static luas-bangunan"><?php echo floatval($luas_bangunan) ?> m2</p>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12 ket-bangunan">
                    <?php
                    $lokalitas = $retribusi !== NULL ? $retribusi->indeks_lokalitas : '';
                    $lsplit = $lokalitas !== ''  &&  $lokalitas != 0 ? explode('.', $lokalitas) : '';
                    $splitL = $lokalitas !== '' &&  $lokalitas != 0 ? $lsplit[1] : '';
                    ?>
                    <div class="form-group">
                      <label class="control-label col-md-4" style="text-align:left;">Indeks Lokalitas :</label>
                      <div class="col-md-1">
                        <input type="text" name="lokalitas" id="indeksLokalitas" class="form-control" value="0," disabled>
                      </div>
                      <div class="col-md-2">
                        <input type="number" name="lokalitas" id="inputData" value="<?= $splitL ?>" class="form-control" required>
                      </div>
                      <div class="col-md-5">
                        <p class="form-control-static" style="color:red;">*Indeks Lokalitas Wajib Diisi! (Maksimal 0.5%)</p>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12 ket-bangunan" style="padding-top:10px;">
                    <?php $shst  = $retribusi !== NULL ? $retribusi->shst : '' ?>
                    <div class="form-group">
                      <label class="control-label col-md-4" style="text-align:left;">SHST (Standar Harga Satuan Tertinggi) :</label>
                      <div class="col-md-4">
                        <input type="number" name="shst" value="<?= $shst ?>" id="shstValue" class="form-control" placeholder="Silahkan Isi Nilai SHST" required>
                        <p class="form-control-static" style="color:red;">*SHST Wajib Diisi!</p>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12 ket-bangunan">
                    <div class="form-group">

                      <label class="control-label col-md-4" style="text-align:left;">Kegiatan</label>
                      <div class="col-md-4">
                        <?php
                        $id_kegiatan = $retribusi !== NULL ? $retribusi->id_kegiatan : '';
                        ?>
                        <select name="kegiatan" class="form-control unit-kegiatan">
                          <?php foreach ($kegiatan as $r) : ?>
                            <option value="<?php echo $r->id_kegiatan ?>" data-prefix1="<?php echo $r->prefix1 ?>" data-prefix2="<?php echo $r->prefix2 ?>" data-indeks="<?php echo $r->index_kegiatan ?>" <?= $id_kegiatan == $r->id_kegiatan ? 'selected' : '' ?>><?php echo $r->nama_kegiatan ?></option>
                          <?php endforeach; ?>
                        </select>
                        <label class="control-label col-md-12 hasil-kegiatan" style="text-align:left;">Indeks Parameter : 1</label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 ket-bangunan">
                    <div class="form-group">
                      <label class="control-label col-md-4" style="text-align:left;">Indeks Terintegrasi :</label>
                      <div class="col-md-6">
                        <p class="form-control-static indeks-terintegrasi">0.18</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 ket-bangunan">
                    <div class="form-group">
                      <label class="control-label col-md-4" style="text-align:left;"><strong>Nilai Retribusi Bangunan :<strong></label>
                      <div class="col-md-6">
                        <p class="form-control-static perhitungan-retribusi"></p>
                        <br>
                        <input type="hidden" name="faktor-kepemilkan" class="form-control indeks-kepemilikan" value="<?= $row->jns_pemilik ?>">
                        <input type="hidden" name="nilai-retribusi" class="form-control nilai-retribusi">
                        <input type="hidden" name="indeks-integrasi" class="form-control indeks-integrasi">
                        <input type="hidden" name="indeks-lokalitas" class="form-control indeks-lokalitas">
                        <input type="hidden" name="indeks-kegiatan" class="form-control indeks-kegiatan">
                        <input type="hidden" name="parameter-fungsi" class="form-control parameter-fungsi">
                        <input type="hidden" name="parameter-kompleksitas" class="form-control parameter-kompleksitas">
                        <input type="hidden" name="parameter-permanensi" class="form-control parameter-permanensi">
                        <input type="hidden" name="parameter-ketinggian" class="form-control parameter-ketinggian">
                        <input type="hidden" name="id" class="form-control" value="<?php echo $row->id_pemilik ?>">
                        <input type="hidden" name="total-retribusi-input" class="total-retribusi-input">
                        <input type="hidden" name="retribusi-bangunan-input" class="retribusi-bangunan-input">
                        <input type="hidden" name="total-retribusi-keseluruhan" class="total-retribusi-keseluruhan">
                        <input type="hidden" name="koefisien-jumlah-lantai" class="koefisien-jumlah-lantai" value="<?= $koefisienLantai ?>">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 prasarana">
                    <div class="form-group">
                      <div class="col-md-12">
                        <div class="mt-repeater">
                          <div data-repeater-list="group-b">
                            <div data-repeater-item class="row repeater-get">
                              <div class="col-md-12">
                                <label class="control-label" style="text-align:center;">Prasarana Bangunan:</label>
                              </div>
                              <div class="col-md-3">
                                <label class="control-label">Nama Prasarana</label>
                                <input type="text" name="nama_prasarana" placeholder="Nama Prasarana" class="form-control nama-prasarana" />
                              </div>
                              <div class="col-md-2 vlt-input">
                                <label class="control-label">Luas/Tinggi/Volume</label>
                                <input type="number" name="vlt" placeholder="Luas/Tinggi/Volume" class="form-control vlt-prasarana" />
                              </div>
                              <div class="col-md-2">
                                <label class="control-label">Harga Prasarana (Rp.)</label>
                                <input type="number" name="harga" placeholder="Harga Prasarana" class="form-control harga-prasarana" />
                              </div>
                              <div class="col-md-2">
                                <label class="control-label">Faktor Kepemilikan</label>
                                <input type="number" name="jumlah" placeholder="Faktor Kepemilikan" class="form-control faktor-kepemilikan" readonly />
                              </div>
                              <div class="col-md-2">
                                <label class="control-label">Jumlah Retribusi (Rp.)</label>
                                <input type="text" name="jumlah" placeholder="Jumlah Retribusi Prasarana" class="form-control jumlah-retribusi" readonly />
                              </div>
                              <div class="col-md-1">
                                <label class="control-label">Aksi</label>
                                <a href="javascript:;" data-repeater-delete class="btn btn-danger">
                                  <i class="fa fa-close"></i>
                                </a>
                              </div>
                            </div>
                          </div>
                          <hr><br>
                          <a href="javascript:;" data-repeater-create class="btn btn-primary mt-repeater-add">
                            <i class="fa fa-plus"></i> Tambah Data Prasarana</a>
                          <br>
                          <br>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 nilai-prasarana">
                    <div class="form-group">
                      <label class="control-label col-md-4" style="text-align:left;"><strong>Nilai Retribusi Prasarana :<strong></label>
                      <div class="col-md-6">
                        <p class="form-control-static total-retribusi-prasarana"></p>
                        <br>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 total-retribusi">
                    <div class="form-group">
                      <label class="control-label col-md-4" style="text-align:left;"><strong>Total Retribusi :<strong></label>
                      <div class="col-md-6">
                        <p class="form-control-static penjumlahan-retribusi"></p>
                        <p class="form-control-static terbilang" style="text-align:center;"></p>
                        <br>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-offset-4 col-md-9">
                        <label><input type="checkbox" class="checkbox-acc"> Pastikan data yang diisi sudah benar</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-offset-10 col-md-9">
                      <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>"><br>
                      <button type="submit" name="submit" class="btn green">Simpan</button>
                      <a href="<?php echo site_url('Perhitungan') ?>" class="btn default">Kembali</a>
                    </div>
                  </div>
                </div>
                <div class="col-md-6"> </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    </form>
  </div>
  </div>
  </div>
  <script>
    $(document).ready(function() {
      var par;
      $(() => {
        let p = parseInt($('.radio-permanensi').filter(":checked").val()),
          q = $('.unit-kegiatan').find(':selected').data('indeks'),

          yy = $('.indeks-kepemilikan').val() == 1 ? 0 : 1,
          xx = p == 1 ? 2 : 1;

        $('.faktor-kepemilikan').html(yy);
        $('.faktor-kepemilikan').val(yy);

        h(0.2 * xx, yy);
        u(q);
        sum();

      });

      $('.radio-usaha').change(function(e) {
        e.preventDefault();
        let a = $(this).val(),
          v = parseInt($('.radio-permanensi').filter(":checked").val()),
          q = $('.unit-kegiatan').find(':selected').data('indeks'),
          x = 0.2,
          y = v == 1 ? 2 : 1,
          r = x * y,
          yy = $('.indeks-kepemilikan').val() == 1 ? 0 : 1,
          zz = $('#shstValue').val();
        $('.parameter-fungsi').html(a);
        h(r, yy);
        u(q, zz);
        sum();
      });

      $('.radio-permanensi').change(function(e) {
        e.preventDefault();
        let v = $(this).val(),
          x = 0.2,
          y = v == '1' ? 2 : 1,
          r = x * y,
          q = $('.unit-kegiatan').find(':selected').data('indeks'),
          yy = $('.indeks-kepemilikan').val() == 1 ? 0 : 1,
          zz = $('#shstValue').val();
        $('.parameter-permanensi').html(`${x} x ${y} = ${r}`);
        h(r, yy);
        u(q, zz);
        sum();
      });

      $(document).on("keyup", ".mt-repeater input[type=number]", function() {
        var $parent = $(this).parents('div.repeater-get');
        var allInputs = $("input[type=number]", $parent);
        var total = 1;
        $.each(allInputs, function(e) {
          let r = $(this).val();
          res = $(this).val() === '' ? 0 : parseInt($(this).val());
          total *= res;
        });

        $(".jumlah-retribusi", $parent).val(total);
        sum();
      });

      const sum = () => {
        var sum = 0;
        let f, g, h, i, j, k, re, ii, jj, kk;
        $('.jumlah-retribusi').each(function() {
          sum += parseFloat(this.value);
        });
        let l = Number.isNaN(sum) == true ? 0 : numberWithCommas(sum);
        let ll = Number.isNaN(l) == true ? 0 : l;
        $('.total-retribusi-input').val(sum);
        $('.total-retribusi-prasarana').html(`Rp. ${ll}`);
        f = $('.total-retribusi-input').val() != '' && Number.isNaN(parseFloat($('.total-retribusi-input').val())) == false ? parseFloat($('.total-retribusi-input').val()) : 0;
        g = $('.retribusi-bangunan-input').val() != '' ? parseFloat($('.retribusi-bangunan-input').val()) : 0;
        h = f + g;
        i = numberWithCommas(f);
        j = numberWithCommas(g);
        k = numberWithCommas(h);
        ii = Number.isNaN(i) == true ? 0 : i;
        jj = Number.isNaN(j) == true ? 0 : j;
        kk = Number.isNaN(k) == true ? 0 : k;
        re = terbilang(h);
        $('.total-retribusi-keseluruhan').val(k);
        $('.penjumlahan-retribusi').html(`Rp. ${ii} + Rp. ${jj} = Rp. ${kk}`);
        $('.terbilang').html(`Terbilang (${re})`);
      }

      $(".unit-kegiatan").change(function() {
        let k = $(this).val(),
          a = $(this).find(':selected').data('prefix1'),
          b = $(this).find(':selected').data('prefix2'),
          c = $(this).find(':selected').data('indeks'),
          p = a == 1 ? `Indeks Parameter : ${a}` : `Indeks Parameter : ${a} x ${b} = ${c}`,
          shst = $('#shstValue').val(),
          vl = $('#inputData').val();
        $('.hasil-kegiatan').html(p)
        u(c, shst, vl);
        sum();
      });

      $('#shstValue').keyup(function(e) {
        let shst = $(this).val(),
          q = $('.unit-kegiatan').find(':selected').data('indeks'),
          vl = $('#inputData').val();
        u(q, shst, vl);
        sum();
      });


      let u = function(v, shst, vals) {
        let l = parseFloat($('.luas-bangunan').text().split(" ")[0]),
          m = $('#shstValue').val() == '' ? 0 : parseInt($('#shstValue').val()),
          lv = ($('#inputData').val() + '').replace('.', '').length,
          ld = lv == 2 ? 100 : 10,
          lx = ld == 2 ? 10 : 100,
          n = $('#inputData').val() == '' ? 0 : parseFloat($('#inputData').val() / ld),
          o = parseFloat($('.indeks-terintegrasi').text()),
          q = parseFloat(l * ((n / lx) * m * o * v) / 1000).toFixed(3).replace(/[,.]/g, ''),
          x = numberWithCommas(q),
          y = terbilang(q);
        $('.perhitungan-retribusi').html(`${parseFloat(l)} x (${n} % x ${m} x ${o} x ${v}) = Rp. ${x}`);
        $('.nilai-retribusi').val(x);
        $('.indeks-lokalitas').val(n);
        $('.indeks-kegiatan').val(v);
        $('.retribusi-bangunan-input').val(q);
        $('.terbilang').html(`Terbilang (${y})`);
      }

      $('#inputData').change(function(e) {
        let shst = $('#shstValue').val(),
          q = $('.unit-kegiatan').find(':selected').data('indeks');
        let vl = parseInt($(this).val());
        if (vl < 1) $(this).val(1);
        if (vl > 50) $(this).val(50);
        u(q, shst, vl);
        sum();

      });



      let h = function(num, per) {
        let f = parseFloat($('.parameter-fungsi').text()),
          g = parseFloat($('.parameter-kompleksitas').text().split(" ")[4]),
          h = parseFloat($('.parameter-ketinggian').text().split(" ")[4]),
          i = per,
          k = parseInt($('.jumlah-lantai').text().split(" ")[0]),
          j = f * (g + num + h) * i,
          m = parseFloat(j).toFixed(3);
        l = $('.indeks-integrasi').html(`${f} x (${g} + ${num} + ${h}) x ${i} = ${m}`);
        $('.indeks-integrasi').val(j);
        $('.parameter-fungsi').val(f);
        $('.parameter-ketinggian').val(h);
        $('.indeks-terintegrasi').html(m);
        $('.parameter-kompleksitas').val(g);
        $('.parameter-permanensi').val(num);
      }

      function numberWithCommas(x) {
        return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",").replace(".", ",");
      }

      function terbilang(bilangan) {

        bilangan = String(bilangan);
        var angka = new Array('0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');
        var kata = new Array('', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan');
        var tingkat = new Array('', 'Ribu', 'Juta', 'Milyar', 'Triliun');
        var panjang_bilangan = bilangan.length;
        /* pengujian panjang bilangan */
        if (panjang_bilangan > 15) {
          kaLimat = "Diluar Batas";
          return kaLimat;
        }

        /* mengambil angka-angka yang ada dalam bilangan, dimasukkan ke dalam array */
        for (i = 1; i <= panjang_bilangan; i++) {
          angka[i] = bilangan.substr(-(i), 1);
        }

        i = 1;
        j = 0;
        kaLimat = "";


        /* mulai proses iterasi terhadap array angka */
        while (i <= panjang_bilangan) {

          subkaLimat = "";
          kata1 = "";
          kata2 = "";
          kata3 = "";

          /* untuk Ratusan */
          if (angka[i + 2] != "0") {
            if (angka[i + 2] == "1") {
              kata1 = "Seratus";
            } else {
              kata1 = kata[angka[i + 2]] + " Ratus";
            }
          }

          /* untuk Puluhan atau Belasan */
          if (angka[i + 1] != "0") {
            if (angka[i + 1] == "1") {
              if (angka[i] == "0") {
                kata2 = "Sepuluh";
              } else if (angka[i] == "1") {
                kata2 = "Sebelas";
              } else {
                kata2 = kata[angka[i]] + " Belas";
              }
            } else {
              kata2 = kata[angka[i + 1]] + " Puluh";
            }
          }

          /* untuk Satuan */
          if (angka[i] != "0") {
            if (angka[i + 1] != "1") {
              kata3 = kata[angka[i]];
            }
          }

          /* pengujian angka apakah tidak nol semua, lalu ditambahkan tingkat */
          if ((angka[i] != "0") || (angka[i + 1] != "0") || (angka[i + 2] != "0")) {
            subkaLimat = kata1 + " " + kata2 + " " + kata3 + " " + tingkat[j] + " ";
          }

          /* gabungkan variabe sub kaLimat (untuk Satu blok 3 angka) ke variabel kaLimat */
          kaLimat = subkaLimat + kaLimat;
          i = i + 3;
          j = j + 1;
        }

        if ((angka[5] == "0") && (angka[6] == "0")) {
          kaLimat = kaLimat.replace("Satu Ribu", "Seribu");
        }

        return kaLimat;
      }


      $('#formRetribusi').submit(function(e) {
        if ($('.checkbox-acc').is(':checked')) {
          var isGood = confirm('Pastikan data yang diisi sudah benar?');
          if (!isGood) {
            e.preventDefault();
          }
        } else {
          alert('Harap centang checkbox dibawah sebelum melanjutkan');
          e.preventDefault();
        }
      });

      var FormRepeater = function() {
        return {
          init: function() {
            $(".mt-repeater").each(function() {
              $(this).repeater({
                show: function(e) {
                  let $div = $(this).prev('.repeater-get'),
                    n = $div.find("input.vlt-prasarana[type=number]").val(),
                    v = $div.find("input.harga-prasarana[type=number]").val(),
                    h = $div.find("input.nama-prasarana").val(),
                    ik = $('.indeks-kepemilikan').val() == 1 ? 0 : 1

                  if (n != '' && v != '' && h != '') {
                    $(this).slideDown();
                    $('.faktor-kepemilikan').val(ik);
                  } else {
                    alert('Harap Isi Prasarana Bangunan Terlebih Dahulu!');
                    $(this).remove();
                  }
                },
                hide: function(e) {
                  confirm("Apakah Anda Yakin?") && $(this).slideUp(e) && $(this).remove() && sum()
                },
                ready: function(e) {}
              })
            })
          }
        }
      }();
      jQuery(document).ready(function() {
        FormRepeater.init();
      });
    });
  </script>