


$(document).ready(function () {

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
    order: [[2, 'asc']],
    rowGroup: {
      // Uses the 'row group' plugin
      dataSrc: 2,
      startRender: function (rows, group) {
        var collapsed = !!collapsedGroups[group];

        rows.nodes().each(function (r) {
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

  $('#regularTable tbody tr.group-start').each(function () {
    var name = $(this).data('Nomor Registrasi');
    collapsedGroups[name] = !collapsedGroups[name];
  });
  table.draw(false);

  $('#regularTable tbody').on('click', 'tr.group-start', function () {
    var name = $(this).data('Nomor Registrasi');
    collapsedGroups[name] = !collapsedGroups[name];
    table.draw(false);
  });

  $('#modalElement').on('hidden', function () {
    $(this).data('modal', null);
  });

  $('#tglKonsultasi').datepicker();

  $("#tipeKonsultasi").change(function (e) {
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


function getJadwalKonsultasi(id) {
  $.ajax({
    type: "POST",
    url: `${base_url}Penjadwalan/konsultasi`,
    data: {
      id: id
    },
    success: function (data) {
      $(".no-konsultasi").html(data.no_konsultasi);
      $(".nm-pemilik").html(data.nm_pemilik);
      $(".alamat-pemilik").html(`${data.alamat}, Kec. ${data.nama_kecamatan}, <br>${data.nama_kabkota}, ${data.nama_prov_pemilik}`);
      $(".jenis-konsultasi").html(data.nm_konsultasi);
      $(".alamat-bangunan").html(`${data.almt_bgn}, Kec. ${data.nama_kec_bg}, <br>${data.nama_kabkota_bg}, ${data.nama_provinsi_bg}`);
      $(".fungsi-bangunan-gedung").html(`${data.fungsi_bg}`);
      $(".luas-tinggi-lantai").html(`${data.luas_bgn} m<sup>2</sup>, dengan tinggi ${data.tinggi_bgn} meter, dan berjumlah ${data.jml_lantai} lantai.`);
      $(".konsultasi-ke").val(`ke-${data.nextKonsultasi}`);
      $(".tgl-periode").html(`<p class="font-red"> ${data.tgl_pernyataan} <i class="text-tot">sampai dengan</i> ${data.hasil_tgl} <i class="text-tot">, (${data.lama_proses} Hari Kerja) <br>terhitung dari tanggal verifikasi kelengkapan berkas</i></p>`);
      $("#idKonsultasi").val(data.id_konsultasi);
      $("#email").val(data.email);
      $("#noreg").val(data.no_konsultasi);
      let pengawas = data.pengawas;
      const res = $('#pengawas');
      res.empty();
      let num = 1;
      pengawas.forEach(obj => {
        let unsur_ahli = obj.nama_unsur_ahli == null ? `` : ` - ${obj.nama_unsur_ahli}`;
        let keahlian = obj.nama_keahlian == null ? `` : ` - ${obj.nama_keahlian}`;
        res.append(`<tr id="list_peg-0">
        <td align="center">${num++}</td>
        <td>${obj.glr_depan}. ${obj.nama_personal}, ${obj.glr_belakang} </td>
        <td>${obj.nama_unsur}${unsur_ahli}</td>
        <td>${obj.nama_bidang}${keahlian}</td></tr>`);
      });
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
        <td><a href="javascript:void(0);" class="btn btn-success btn-sm" title="Lihat Berkas" onclick="javascript:popWin('${base_url}file/PBG/${data.no_konsultasi}/konsultasi/undangan_konsultasi/${obj.dir_file_undangan}')"><span class="glyphicon glyphicon-file"></span></a></td>
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
