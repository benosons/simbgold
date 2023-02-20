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
        <div class="caption">
          <i class="fa fa-calculator"></i>Form Perhitungan Retribusi
        </div>
        <div class="tools">

        </div>
      </div>
      <div class="portlet-body form">
        <form class="form-horizontal" role="form">
          <div class="form-body">
            <h4 class="form-section" style="text-align: center;">
              <strong>Data Bangunan - <?php echo $row->no_konsultasi ?></strong>
            </h4>
            <div class="row">
              <div class="col-md-8 ket-bangunan">
                <div class="form-group">
                  <label class="control-label col-md-4">Nama Pemilik:</label>
                  <div class="col-md-6">
                    <p class="form-control-static"><?php echo $row->nm_pemilik ?></p>
                  </div>
                </div>
              </div>
              <!--/span-->
              <div class="col-md-8 ket-bangunan">
                <div class="form-group">
                  <label class="control-label col-md-4">Alamat Bangunan:</label>
                  <div class="col-md-8">
                    <p class="form-control-static"> Jl. Menuju Kebahagian , Kec. Ngamprah,Kab. Bandung Barat
                    </p>
                  </div>
                </div>
              </div>
              <!--/span-->
            </div>
            <!--/row-->
            <div class="row">
              <div class="col-md-8 ket-bangunan">
                <div class="form-group">
                  <label class="control-label col-md-4">Fungsi Bangunan Gedung:</label>
                  <div class="col-md-8">
                    <p class="form-control-static">
                      <?php echo $row->fungsi_bg ?> - Sederhana
                    </p>
                  </div>
                </div>
              </div>
              <!--/span-->
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
              <!--/span-->
            </div>
            <div class="row">
              <div class="col-md-8 ket-bangunan">
                <div class="form-group">
                  <label class="control-label col-md-4">Jenis Kepemilikan:</label>
                  <div class="col-md-8">
                    <p class="form-control-static"> Perorangan</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </form>

      </div>

    </div>
    <form action="<?php echo site_url('Perhitungan/simpan_retribusi') ?>" method="POST" class="form-horizontal">
      <div class="form-body">
        <h4 class="form-section" style="text-align:center;"><strong>Indeks Terintegrasi</strong></h4>
        <div class="row">
          <div class="col-md-6">
            <div class="portlet box purple">
              <div class="portlet-title">
                <div class="caption">
                  <i class="fa fa-list"></i> Data Indeks Terintegrasi
                </div>
              </div>
              <div class="portlet-body" style="max-height:250px;height:250px;">
                <div class="row">
                  <div class="col-md-12 ket-bangunan">
                    <div class="form-group">
                      <label class="control-label col-md-4 " style="text-align:left;">Fungsi Bangunan</label>
                      <div class="col-md-6">
                        <p class="form-control-static"><?php echo $row->fungsi_bg ?></p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 ket-bangunan">
                    <div class="form-group">
                      <label class="control-label col-md-4" style="text-align:left;">Kompleksitas</label>
                      <div class="col-md-8">
                        <p class="form-control-static">Sederhana</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 ket-bangunan">
                    <div class="form-group">
                      <label class="control-label col-md-4" style="text-align:left;">Permanensi</label>
                      <div class="col-md-8">
                        <div class="radio-list">
                          <label class="radio-inline">
                            <input type="radio" name="permanensi" class="radio-permanensi" value="1" /> Permanen </label>
                          <label class="radio-inline">
                            <input type="radio" name="permanensi" class="radio-permanensi" value="2" checked /> Non Permanen </label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 ket-bangunan">
                    <div class="form-group">
                      <label class="control-label col-md-4" style="text-align:left;">Jumlah Lantai</label>
                      <div class="col-md-8">
                        <p class="form-control-static jumlah-lantai"><?php echo $row->jml_lantai ?> - Lantai</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 ket-bangunan">
                    <div class="form-group">
                      <label class="control-label col-md-4" style="text-align:left;">Basemen</label>
                      <div class="col-md-8">
                        <p class="form-control-static"><?php echo $row->lapis_basement ?> - Lapis</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 ket-bangunan">
                    <div class="form-group">
                      <label class="control-label col-md-4" style="text-align:left;">Jenis Kepemilikan</label>
                      <div class="col-md-8">
                        <p class="form-control-static">Perorangan</p>
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
                        <p class="form-control-static parameter-fungsi">0.15</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 ket-bangunan">
                    <div class="form-group">
                      <label class="control-label col-md-8" style="text-align:left;">Indeks Parameter Kompleksitas :</label>
                      <div class="col-md-3">
                        <p class="form-control-static parameter-kompleksitas">0.3 x 1 = 0.3</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 ket-bangunan">
                    <div class="form-group">
                      <label class="control-label col-md-8" style="text-align:left;">Indeks Parameter Permanensi :</label>
                      <div class="col-md-3">
                        <p class="form-control-static parameter-permanensi">0.2 x 2 = 0.4</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 ket-bangunan">
                    <div class="form-group">
                      <label class="control-label col-md-8" style="text-align:left;">Indeks Parameter Ketinggian :</label>
                      <div class="col-md-3">
                        <p class="form-control-static parameter-ketinggian">0.5 x 1 = 0.5</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 ket-bangunan">
                    <div class="form-group">
                      <label class="control-label col-md-8" style="text-align:left;">Faktor Kepemilikan :</label>
                      <div class="col-md-3">
                        <p class="form-control-static faktor-kepemilikan">1</p>
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
                      <p class="form-control-static luas-bangunan"><?php echo floatval($row->luas_bgn) ?> m2</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-12 ket-bangunan">
                  <div class="form-group">
                    <label class="control-label col-md-4" style="text-align:left;">SHST (Standar Harga Satuan Tertinggi) :</label>
                    <div class="col-md-4">
                      <input type="number" name="shst" id="shstValue" class="form-control" placeholder="Silahkan Isi Nilai SHST">
                      <p class="form-control-static" style="color:red;">*SHST Wajib Diisi!</p>

                    </div>
                  </div>
                </div>
                <div class="col-md-12 ket-bangunan">
                  <div class="form-group">
                    <label class="control-label col-md-4" style="text-align:left;">Indeks Lokalitas :</label>
                    <div class="col-md-4">
                      <!-- <input type="number" name="shst" id="lokalitasValue" class="form-control" placeholder="Silahkan Isi Nilai SHST">
                      <p class="form-control-static" style="color:red;">*Indeks Lokalitas Wajib Diisi! (Maksimal 0.5%)</p> -->

                      <p class="form-control-static indeks-lokalitas"><?php echo $shst->indeks_lokalitas ?> %</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-12 ket-bangunan">
                  <div class="form-group">
                    <label class="control-label col-md-4" style="text-align:left;">Kegiatan</label>
                    <div class="col-md-4">
                      <select name="kegiatan" class="form-control unit-kegiatan">
                        <?php foreach ($kegiatan as $r) : ?>
                          <option value="<?php echo $r->id_kegiatan ?>" data-prefix1="<?php echo $r->prefix1 ?>" data-prefix2="<?php echo $r->prefix2 ?>" data-indeks="<?php echo $r->index_kegiatan ?>"><?php echo $r->nama_kegiatan ?></option>
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
                              <input type="text" name="nama_prasarana" placeholder="Nama Prasarana" class="form-control nama-prasarana" required />
                            </div>
                            <div class="col-md-2 vlt-input">
                              <label class="control-label">Luas/Tinggi/Volume</label>
                              <input type="number" name="vlt" placeholder="Luas/Tinggi/Volume" class="form-control vlt-prasarana" required />
                            </div>
                            <div class="col-md-3">
                              <label class="control-label">Harga Prasarana (Rp.)</label>
                              <input type="number" name="harga" placeholder="Harga Prasarana" class="form-control harga-prasarana" required />
                            </div>
                            <div class="col-md-3">
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
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-offset-10 col-md-9">
                      <button type="submit" name="submit" class="btn green">Simpan</button>
                      <a href="<?php echo site_url('perhitungan') ?>" class="btn default">Kembali</a>
                    </div>
                  </div>
                </div>
                <div class="col-md-6"> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
  </form>
</div>
</div>

<script>
  $(document).ready(function() {
    var par;
    $(() => {
      let p = parseInt($('.radio-permanensi').filter(":checked").val()),
        q = $('.unit-kegiatan').find(':selected').data('indeks');
      h(0.2 * p);
      u(q);
    });

    $('.radio-permanensi').change(function(e) {
      e.preventDefault();
      let v = $(this).val(),
        x = 0.2,
        y = v == '1' ? 1 : 2,
        r = x * y,
        q = $('.unit-kegiatan').find(':selected').data('indeks'),
        zz = $('#shstValue').val()
      $('.parameter-permanensi').html(`${x} x ${y} = ${r}`);
      h(r);
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
        p = a == 1 ? `Indeks Parameter : ${a}` : `Indeks Parameter : ${a} x ${b} = ${c}`;
      $('.hasil-kegiatan').html(p)
      u(c);
      sum();
    });

    $('#shstValue').keyup(function(e) {
      let shst = $(this).val(),
        q = $('.unit-kegiatan').find(':selected').data('indeks');
      u(q, shst);
    });

    let u = function(v, shst) {
      let l = parseFloat($('.luas-bangunan').text().split(" ")[0]),
        // m = parseInt($('.shst').text().split(" ")[1].replace(/[,.]/g, '')),
        m = $('#shstValue').val() == '' ? 0 : parseInt($('#shstValue').val()),
        n = parseFloat($('.indeks-lokalitas').text().split(" ")[0]),
        o = parseFloat($('.indeks-terintegrasi').text()),
        q = parseFloat(l * ((n / 100) * m * o * v) / 1000).toFixed(3).replace(/[,.]/g, ''),
        x = numberWithCommas(q),
        y = terbilang(q);
      $('.perhitungan-retribusi').html(`${parseFloat(l)} x (${n} % x ${m} x ${o} x ${v}) = Rp. ${x}`);
      $('.nilai-retribusi').val(x);
      $('.indeks-lokalitas').val(n);
      $('.indeks-kegiatan').val(v);
      $('.retribusi-bangunan-input').val(q);
      $('.terbilang').html(`Terbilang (${y})`);
    }

    let h = function(num) {
      let f = parseFloat($('.parameter-fungsi').text()),
        g = parseFloat($('.parameter-kompleksitas').text().split(" ")[0]),
        h = parseFloat($('.parameter-ketinggian').text().split(" ")[0]),
        i = parseInt($('.faktor-kepemilikan').text()),
        k = parseInt($('.jumlah-lantai').text().split(" ")[0]),
        j = f * (g + num + (k * h) * i),
        l = $('.indeks-integrasi').html(`${f} x (${g} + ${num} + (${k} x ${h})) x ${i} = ${j}`);
      $('.indeks-integrasi').val(j);
      $('.parameter-fungsi').val(f);
      $('.parameter-ketinggian').val(h);
      $('.indeks-terintegrasi').html(j);
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

    var FormRepeater = function() {
      return {
        init: function() {
          $(".mt-repeater").each(function() {
            $(this).repeater({
              show: function(e) {
                let $div = $(this).prev('.repeater-get'),
                  n = $div.find("input.vlt-prasarana[type=number]").val(),
                  v = $div.find("input.harga-prasarana[type=number]").val(),
                  h = $div.find("input.nama-prasarana").val();
                if (n != '' && v != '' && h != '') {
                  $(this).slideDown(),
                    $(".date-picker").datepicker({
                      orientation: "left",
                      autoclose: !0
                    });
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
      FormRepeater.init()
    });
  });
</script>