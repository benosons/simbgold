<div id="content">
  <div class="row">
    <div class="col-md-12">
    <div class="portlet-title">
					<h4 align="center" class="caption-subject font-blue bold uppercase">Detail Perhitungan Retribusi</h4>
					<hr>
					<br>
					<div class="row static-info">
						<div class="col-md-4 name">Status Perhitungan Retribusi</div>
						<div class="col-md-8 value status-perhitungan"></div>
					</div>
					<div class="manual-retribusi" style="display:none;">
						<div class="row static-info">
							<div class="col-md-4 name">Nilai Retribusi Bangunan</div>
							<div class="col-md-8 value nilai-retribusi-bangunan"></div>
						</div>
						<div class="row static-info">
							<div class="col-md-4 name">Nilai Retribusi Prasarana</div>
							<div class="col-md-8 value nilai-retribusi-prasarana"></div>
						</div>
						<div class="row static-info">
							<div class="col-md-4 name">Nilai Retribusi Keseluruhan</div>
							<div class="col-md-8 value nilai-retribusi-keseluruhan"></div>
						</div>
						<div class="lampiran" style="display:none;">
							<div class="row static-info">
								<div class="col-md-4 name">Lampiran Perhitungan Retribusi</div>
								<div class="col-md-8 value"><a href="javascript:;" class="btn btn-primary berkas-retribusi"><i class="fa fa-file"></i> Lihat Berkas</a></div>
							</div>
						</div>
					</div>
					<div class="sistem-retribusi" style="display:none;"><br>
						<h5 class="caption-subject font-blue bold uppercase">Detail Indeks Terintegrasi</h5>
						<div class="row static-info">
							<div class="col-md-4 name">Indeks Parameter Fungsi Bangunan</div>
							<div class="col-md-8 value parameter-fungsi"></div>
						</div>
						<div class="row static-info">
							<div class="col-md-4 name">Indeks Parameter Kompleksitas</div>
							<div class="col-md-8 value parameter-kompleksitas"></div>
						</div>
						<div class="row static-info">
							<div class="col-md-4 name">Indeks Parameter Fungsi Bangunan</div>
							<div class="col-md-8 value parameter-permanensi"></div>
						</div>
						<div class="row static-info">
							<div class="col-md-4 name">Indeks Parameter Ketinggian</div>
							<div class="col-md-8 value parameter-ketinggian"></div>
						</div>
						<div class="row static-info">
							<div class="col-md-4 name">Faktor Kepemilikan</div>
							<div class="col-md-8 value faktor-kepemilikan"></div>
						</div>
						<div class="row static-info">
							<div class="col-md-4 name">Indeks Terintegrasi</div>
							<div class="col-md-8 value indeks-integrasi"></div>
						</div>
						<h5 class="caption-subject font-blue bold uppercase">Hasil Perhitungan Retribusi Bangunan</h5>
						<div class="row static-info">
							<div class="col-md-4 name">Luas Bangunan Gedung</div>
							<div class="col-md-8 value luas-bangunan"></div>
						</div>
						<div class="row static-info">
							<div class="col-md-4 name">SHST (Standar Harga Satuan Tertinggi):</div>
							<div class="col-md-8 value shst"></div>
						</div>
						<div class="row static-info">
							<div class="col-md-4 name">Indeks Lokalitas</div>
							<div class="col-md-8 value indeks-lokalitas"></div>
						</div>
						<div class="row static-info">
							<div class="col-md-4 name"> Kegiatan</div>
							<div class="col-md-8 value kegiatan"></div>
						</div>
						<div class="row static-info">
							<div class="col-md-4 name">Nilai Retribusi Bangunan</div>
							<div class="col-md-8 value hasil-retribusi-bgn"></div>
						</div>
						<h5 class="caption-subject font-blue bold uppercase">Hasil Perhitungan Retribusi Prasarana</h5>
						<table class="table table-bordered table-striped table-hover">
							<tbody>
								<tr style="padding-left: 5px; padding-bottom:3px;  font-weight:bold">
									<th>No</th>
									<th>Nama Sarana</th>
									<th>Harga Prasarana</th>
									<th>Panjang/Luas/Volume</th>
									<th>Total Prasarana </th>
								</tr>
								<tbody id="dataPrasarana"></tbody>
							</tbody>
						</table>
						<div class="row static-info">
							<div class="col-md-4 name">Nilai Retribusi Prasarana</div>
							<div class="col-md-8 value nilai-retribusi-prasarana"></div>
						</div>
						<h5 class="caption-subject font-blue bold uppercase">Hasil Perhitungan Retribusi Keseluruhan</h5>
						<div class="row static-info">
							<div class="col-md-4 name">Nilai Retribusi Keseluruhan</div>
							<div class="col-md-8 value nilai-retribusi-keseluruhan"></div>
						</div>
					</div>
				</div>

    </div>
  </div>
</div>

<script>
  var csrfToken;
  $(() => {
    getCSRFtoken();
  });
  const getCSRFtoken = () => {
    $.ajax({
      type: "GET",
      url: `${base_url}CSRF/generateCSRF`,
      dataType: "json",
      success: function(response) {
        $('.txt_csrfname').val(response.token);
      }
    });
  }

  const getDataRetribusi = () => {

    let dataDetail = segments;
    $.ajax({
      type: "POST",
      url: `${base_url}DataDetail/DetailRetri`,
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
          $(".luas-tinggi-prasarana").html(`${response.luas_bgp} m<sup>2</sup>, dengan tinggi ${response.tinggi_bgp} meter`);
          $(".jns-prasarana").html(`${response.jns_prasarana}`);
          if (response.id_jenis_permohonan == 11) {
            $('.fungsi-bangunan').css('display', 'none');
            $('.bangunan-kolektif').css('display', 'block');
            $('.prasarana').css('display', 'none');
            $('.total-luas-kolektif').html(`${response.luas_total_kolektif} m<sup>2</sup>`);
            var tableKolektif;
            if (response.hasil_kolektif != 0) {
              response.hasil_kolektif.forEach(obj => {
                tableKolektif += '<tr>';
                tableKolektif += `<td>${obj.tipe}</td>`;
                tableKolektif += `<td>${obj.luas}</td>`;
                tableKolektif += `<td>${obj.tinggi}</td>`;
                tableKolektif += `<td>${obj.lantai}</td>`;
                tableKolektif += `<td>${obj.jumlah}</td></tr>`;
                $('#tableKolektif').html(tableKolektif);
              });
            }
          } else if (response.id_jenis_permohonan == 12) {
            $('.bangunan-kolektif').css('display', 'none');
            $('.fungsi-bangunan').css('display', 'none');
            $('.prasarana').css('display', 'block');
          } else {
            $('.bangunan-kolektif').css('display', 'none');
            $('.fungsi-bangunan').css('display', 'block');
            $('.prasarana').css('display', 'none');
          }
          $(".tgl-periode").html(`<p><span class="font-blue">${response.tgl_pernyataan}</span> <i class="text-tot">sampai dengan</i> <span class="font-blue">${response.hasil_tgl}</span> <i class="text-tot">, (${response.lama_proses} Hari Kerja) <br>terhitung dari tanggal verifikasi kelengkapan berkas</i></p>`);
          $(".nilai-retribusi-bangunan").html(`Rp. ${response.nilai_retribusi_bangunan}`);
          $(".status-perhitungan").html(response.status_perhitungan);
          $(".nilai-retribusi-prasarana").html(`Rp. ${response.nilai_retribusi_prasarana}`);
          $(".nilai-retribusi-keseluruhan").html(`Rp. ${response.nilai_retribusi_keseluruhan}`);
          if (response.stats_retribusi == 2) {
            $(`a.berkas-retribusi`).attr(`onClick`, `javascript:popWin('${base_url}${response.berkas_retribusi}')`);
            $('.lampiran').css('display', 'block');
            $('.sistem-retribusi').css('display', 'none');
            $('.manual-retribusi').css('display', 'block');
          } else {
            $('.lampiran').css('display', 'none');
            $('.sistem-retribusi').css('display', 'block');
            $('.manual-retribusi').css('display', 'none');
            $(".parameter-fungsi").html(`${response.fungsi_bg} (${response.parameter_fungsi})`);
            $(".parameter-permanensi").html(`${response.permanensi} (${response.parameter_permanensi})`);
            $(".parameter-kompleksitas").html(`${response.klasifikasi_bg} (${response.parameter_kompleksitas})`);
            $(".parameter-ketinggian").html(`${response.tinggi_bgn} Meter (${response.parameter_ketinggian})`);
            $(".faktor-kepemilikan").html(response.kepemilikan);
            $(".indeks-integrasi").html(response.indeks_integrasi);
            $(".luas-bangunan").html(`${response.luas_bgn} m<sup>2</sup>`);
            $(".shst").html(`Rp. ${response.shst}`);
            $(".indeks-lokalitas").html(response.indeks_lokalitas);
            $(".kegiatan").html(`${response.kegiatan} (${response.parameter_kegiatan})`);
            $(".hasil-retribusi-bgn").html(response.hasil_retribusi_bgn);
            var table;
            let num = 1;
            if (response.prasarana != 0) {
              response.prasarana.forEach(obj => {
                table += '<tr>';
                table += `<td>${num++}</td>`;
                table += `<td>${obj.nama_prasarana}</td>`;
                table += `<td>Rp. ${obj.harga_prasarana}</td>`;
                table += `<td>${obj.plv}</td>`;
                table += `<td>Rp. ${obj.total_prasarana}</td>`;
                $('#dataPrasarana').html(table);
              });
            }
          }
          $('#modalDetail').modal('show');
        } else {
          showToast(response.message, 15000, response.type);
          Metronic.unblockUI();
        }
      }
    });
  };

  $(document).ready(function() {
    $(() => {
      getCSRFtoken();
      getDataRetribusi();
    });
  });


  function popWin(x) {
    url = x;
    swin = window.open(url, 'win', 'scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
    swin.focus();
  }

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