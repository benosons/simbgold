<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-repeater/jquery.repeater.js"></script>
<div class="portlet box blue-hoki">
  <div class="portlet-title">
    <div class="caption">
      Form Input Bukti Pembayaran Retribusi
    </div>
  </div>
  <div class="portlet-body">
    <div class="form-group">
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
            <form action="<?php echo site_url('Konsultasi/bayar_retribusi') ?>" method="POST" class="form-horizontal" enctype="multipart/form-data">
              <input type="text" style="display: none;" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >          
              <div class="form-body">
                <div class="col-md-12">
                  <div class="portlet-body">
                      <div class="row">
					              <input type="hidden" class="form-control" value="<?php echo set_value('id', (isset($id) ? $id : '')) ?>" name="id" placeholder="id" autocomplete="off">
					            	<div class="col-md-12 pembayaran-retribusi">
                            <div class="form-group">
                              <label class="control-label col-md-4" style="text-align:left;">Total  Retribusi</label>
                              <div class="col-md-4">
                                <p class="form-control-static shst">Rp. <?php echo number_format(str_replace('.', ',', $retribusi->nilai_retribusi_keseluruhan)) ?></p>
                              </div>
                            </div>
                          </div>
                        <div class="col-md-12 upload-retribusi">
                          <div class="form-group">
                            <label class="control-label col-md-4" style="text-align:left;">SKRD</label>
                            <div class="col-md-4"> 
                              <?php
                                $filename = FCPATH . "object-storage/dekill/Retribution/$skrd->dir_file_penagihan";
                                $dir = '';
                                if (file_exists($filename)) {
                                  $dir = './object-storage/dekill/Retribution/' . $skrd->dir_file_penagihan;
                                } else {
                                  $dir = './object-storage/file/Konsultasi/' . $id . '/SKRD/' . $skrd->dir_file_penagihan;
                                }
                                $dirRetri	= $this->Outh_model->Encryptor('encrypt', $dir);
                              ?>
                              <a href="#PDFViewer" role="button" class="open-PDFViewer btn default btn-xs blue-stripe" data-toggle="modal" data-id="<?php echo site_url('Docreader/ReaderDok/' . $dirRetri); ?>">Lihat</a>
                            </div>
                          </div>
                        </div>
                          <div class="col-md-12 upload-retribusi">
                            <div class="form-group">
                              <label class="control-label col-md-4" style="text-align:left;">Bukti Pembayaran</label>
                              <?php if ($retribusi->bukti_pembayaran =='' || $retribusi->bukti_pembayaran == null){ ?>
                                <div class="col-md-4">
                                  <input type="file" name="bukti_upload" id="bukti" class="bukti-upload">
                                </div>  
                                <?php }else { ?>
                                  <div class="col-md-4">
                                  <?php
                                  $filename = FCPATH . "/dekill/Retribution/$retribusi->bukti_pembayaran";
                                  $dir = '';
                                  if (file_exists($filename)) {
                                    $dir_bayar = base_url('dekill/Retribution/' . $retribusi->bukti_pembayaran);
                                  } else {
                                    $dir_bayar = base_url('file/Konsultasi/' . $id . '/retribusi/' . $retribusi->bukti_pembayaran);
                                  }
                                  ?>
                                    <a href="javascript:void(0);" onClick="javascript:popWin('<?php echo $dir_bayar; ?>')" class="btn default btn-xs blue-stripe">Berkas Bukti Bayar</a>
                                  </div>
                                <?php }?>
                              </div>
                          </div>

                          <div class="row">
                            <div class="col-md-6">
                              <div class="row">
                                <div class="col-md-offset-10 col-md-9">
                                  <button type="submit" name="submit" class="btn green">Simpan</button>
                                  <a href="<?php echo site_url('Konsultasi') ?>" class="btn default">Kembali</a>
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
        q = $('.unit-kegiatan').find(':selected').data('indeks');
      $('.parameter-permanensi').html(`${x} x ${y} = ${r}`);
      h(r);
      u(q);
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


    $('.shst-input').keyup(function(e) {
      let shst = $(this).val();
      cc = $('.unit-kegiatan').find(':selected').data('indeks'),
        u(cc);
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
      console.log(jj);
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

    let u = function(v) {
      let l = parseFloat($('.luas-bangunan').text().split(" ")[0]),
        m = parseInt($('.shst').text().split(" ")[1].replace(/[,.]/g, '')),
        n = parseFloat($('.indeks-lokalitas').text().split(" ")[0]),
        o = parseFloat($('.indeks-terintegrasi').text()),
        z = parseFloat($('.shst-input').val()),
        zx = Number.isNaN(z) == true ? 0 : z,
        q = parseFloat(l * ((n / 100) * zx * o * v) / 1000).toFixed(3).replace(/[,.]/g, ''),
        x = numberWithCommas(q),
        y = terbilang(q);
      $('.perhitungan-retribusi').html(`${parseFloat(l)} x (${n} % x ${zx} x ${o} x ${v}) = Rp. ${x}`);
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
        k = parseFloat($('.jumlah-lantai').text().split(" ")[0]),
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
</div>
</form>
</div>
</div>