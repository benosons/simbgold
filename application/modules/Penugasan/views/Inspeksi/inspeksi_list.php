<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="fa fa-globe"></i>List Data Penugasan Inspeksi</div>
		<div class="tools"><a href="javascript:;" class="reload"></a></div>
	</div>
	<div class="portlet-body">
		<div class="form-actions"></div>
		
		<table class="table table-striped table-bordered table-hover" id="sample_1">
			<?php echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '</div>' : ''; ?>
			<thead>
				<tr>
					<th>No</th>
					<th><center>Jenis Konsultasi</center></th>
					<th><center>No. Persetujuan Bangunan Gedung</center></th>
					<th>Nama Pemilik</th>
					<th><center>Lokasi BG</center></th>
					<th>Status</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no = 1;
				foreach ($Penugasan as $r) { ?>
					<?php
					if ($r->status == 17) {
						$clss = "danger";
					} else {
						$clss = "success";
					}?>
					<tr class="<?= $clss ?>">
						<td align="center"><?php echo $no++; ?></td>
						<td><?php echo $r->nm_konsultasi; ?></td>
						<td align="center"><?php echo $r->no_konsultasi; ?><br><?php echo $r->no_izin_pbg; ?></td>
						<td align="center"><?php echo $r->nm_pemilik; ?></td>
						<td><?php echo $r->almt_bgn; ?></td>
						<td align="center"><?php
							if ($r->status == 17) {
								$class = "label label-sm label-danger";
								$syarat = "Menunggu Penugasan Penilik";
							} else {
								$class = "label label-sm label-success";
								$syarat = "Sudah Penugasan Penilik";
							}; ?>
							<span class="<?php echo $class; ?>"><?php echo $syarat; ?></span>
						</td>
						<?php if ($r->status == 17) { ?>
							<td align="center">
								<a href="#" onClick="href='<?php echo site_url('Inspeksi/penugasan_inspeksi/' . $r->id); ?>'" class="btn btn-success btn-sm" title="Verifikasi Data" id="tombolver" data-toggle="modal" data-target="#modal-edit"><span class="glyphicon glyphicon-edit"></span></a>
							</td>
						<?php } else { ?>
							<td align="center">
								<a href="javascript:;" class="btn btn-info btn-sm detail-penugasan" title="Lihat Data" data-id="<?= $r->id ?>"><span class="glyphicon glyphicon-user"></span></a>
							</td>
						<?php } ?>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<!-- /.modaledit -->
<div id="modal-edit" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog" data-focus-on="input:first">
	<div class="modal-dialog modal-lg">
		<div class="modal-content"></div>
	</div>
</div>

<!-- Begin Data Detail Penugasan Penilik-->
<div id="modalDetail" class="modal fade bs-modal-sm" data-width="50%" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-content">
		<div class="modal-body">
			<div id="content">
				<div class="portlet-title">
					<h4 align="center" class="caption-subject font-blue bold uppercase no-konsultasi"></h4>
					<hr>
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
					<div class="row static-info">
						<div class="col-md-4 name">Lokasi Bangunan Gedung</div>
						<div class="col-md-8 value alamat-bangunan"></div>
					</div>
					<div class="prasarana" style="display:none;">
                        <div class="row static-info">
                            <div class="col-md-4 name">Fungsi Bangunan Gedung</div>
                            <div class="col-md-8 value fungsi-prasarana"></div>
                        </div>
                        <div class="row static-info">
                            <div class="col-md-4 name">Luas dan Tinggi</div>
                            <div class="col-md-8 value luas-prasarana"></div>
                        </div>
                    </div>
					<div class="fungsi-bangunan" style="display:none;">
                        <div class="row static-info">
                            <div class="col-md-4 name">Fungsi Bangunan Gedung</div>
                            <div class="col-md-8 value fungsi-bangunan-gedung"></div>
                        </div>
                        <div class="row static-info">
                            <div class="col-md-4 name">Luas, Tinggi &amp; Jumlah Lantai</div>
                            <div class="col-md-8 value luas-tinggi-lantai">
                            </div>
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
					<h5 class="caption-subject font-blue bold uppercase">Daftar Tim Penilik</h5>
					<table class="table table-bordered table-striped table-hover">
						<thead>
							<tr style="padding-left: 5px; padding-bottom:3px;  font-weight:bold">
								<th>No</th>
								<th>Nama Tim Penilik</th>
								<th>Unsur</th>
								<th>Bidang Keahlian</th>
							</tr>
						</thead>
						<tbody class="detailPetugas"></tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn btn-primary"><i class="fa fa-sign-out"></i> Tutup</button>
		</div>
	</div>
</div>
<!-- End Data Detail Penugasan Penilik-->

<script>
	var site_url = "<?= site_url() ?>";
	$(document).ready(function() {
		var table = $('#tablePenugasan').DataTable({
			"responsive": true,
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
		});
		$(document).on('click', '.detail-penugasan', function(e) {
			e.preventDefault();
			let dataDetail = $(this).data('id');
			$.ajax({
				type: "POST",
				url: `${site_url}DataDetail/DetailPenugasanInpeksi`,
				data: {
					id: dataDetail
				},
				dataType: "json",
				beforeSend: function() {
					Metronic.blockUI({
						animate: true
					});
				},
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
						$(".luas-prasarana").html(`${response.luas_bgp} m<sup>2</sup>, dengan tinggi ${response.tinggi_bgp} meter`);
						$(".fungsi-prasarana").html(`${response.jns_prasarana}`);
						
						$(".tgl-periode").html(`<p><span class="font-blue">${response.tgl_pernyataan}</span> <i class="text-tot">sampai dengan</i> <span class="font-blue">${response.hasil_tgl}</span> <i class="text-tot">, (${response.lama_proses} Hari Kerja) <br>terhitung dari tanggal verifikasi kelengkapan berkas</i></p>`);
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
                        } else if(response.id_jenis_permohonan == 12){
							$('.prasarana').css('display', 'block');
							$('.fungsi-bangunan').css('display', 'none');
                            $('.bangunan-kolektif').css('display', 'none');
						}else {
                            $('.fungsi-bangunan').css('display', 'block');
                            $('.bangunan-kolektif').css('display', 'none');
							$('.prasarana').css('display', 'none');
                        }
						
						var tableDetail;
						let numDetail = 1;
						if (response.penugasan != 0) {
							response.penugasan.forEach(obj => {
								tableDetail += '<tr>';
								tableDetail += `<td>${numDetail++}</td>`;
								tableDetail += `<td>${obj.nama_peg}</td>`;
								tableDetail += `<td>${obj.nama_unsur}</td>`;
								tableDetail += `<td>${obj.nama_bidang}</td>`;
							});
							$('.detailPetugas').html(tableDetail);
						} else {
							$('.detailPetugas').html('');
						}
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
	});
</script>   