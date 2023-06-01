<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="fa fa-globe"></i>List Data Konsultasi Perhitungan Retribusi</div>
		<div class="tools"><a href="javascript:;" class="reload"></a></div>
	</div>
	<div class="portlet-body">
		<div class="form-actions">
			
		</div>
		<table class="table table-striped table-bordered table-hover" id="tableRetribusi">
			<?php echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '</div>' : ''; ?>
			<thead>
				<tr>
					<th>No</th>
					<th>Jenis Konsultasi</th>
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
				foreach ($Penugasan as $r) { ?>
					<?php
					if ($r->status == 8) {
						$clss = "danger";
					} else {
						$clss = "success";
					}
					?>
					<tr class="<?= $clss ?>">
						<td align="center"><?php echo $no++; ?></td>
						<td><?php echo $r->nm_konsultasi; ?></td>
						<td align="center"><?php echo $r->no_konsultasi; ?></td>
						<td align="center"><?php echo $r->nm_pemilik; ?></td>
						<td><?php echo $r->almt_bgn; ?></td>
						<td align="center"><?php
											if ($r->status == 8) {
												$class = "label label-sm label-danger";
												$syarat = "Menunggu Perhitungan Retribusi";
											} else if ($r->status >= 9) {
												$class = "label label-sm label-success";
												$syarat = "Selesai Perhitungan Retribusi";
											}; ?>
							<span class="<?php echo $class; ?>"><?php echo $syarat; ?></span>
						</td>
						<?php if ($r->status == 8) { ?>
							<td align="center">
								<a href="javascript:;" class="btn btn-info btn-sm btn-option" data-id="<?= $r->no_konsultasi ?>"><i class="fa fa-edit"></i></a>
								<div class="data-action"></div>
							</td>
						<?php } else { ?>
							<td align="center">
								<a href="javascript:;" class="btn btn-info btn-sm detail-retribusi" title="Lihat Data" data-id="<?= $r->id ?>"><span class="glyphicon glyphicon-user"></span></a>
								<!-- <a href="#" onClick="href='<?php echo site_url('DataDetail/DataKonsultasi/' . $r->id); ?>'" class="btn btn-info btn-sm" title="Lihat Data" id="tombolinver" data-toggle="modal" data-target="#modal-edit"><span class="glyphicon glyphicon-user"></span></a> -->
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
		<div class="modal-content">
		</div>
		<!-- /.modal-content -->
	</div>
</div>

<div id="modalDetail" class="modal fade bs-modal-sm" data-width="70%" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		</div>
		<div class="modal-body">
			<div id="content">
				<div class="portlet-title">
					<h4 align="center" class="caption-subject font-blue bold uppercase no-konsultasi"></h4>
					<hr>
					<br>
					<div class="row static-info">
						<div class="col-md-4 name">
							Nama Pemilik :
						</div>
						<div class="col-md-8 value nm-pemilik"></div>
					</div>
					<div class="row static-info">
						<div class="col-md-4 name">
							Alamat Pemilik :
						</div>
						<div class="col-md-8 value alamat-pemilik"></div>
					</div>
					<div class="row static-info">
						<div class="col-md-4 name">
							Jenis Konsultasi :
						</div>
						<div class="col-md-8 value jenis-konsultasi"></div>
					</div>
					<div class="row static-info">
						<div class="col-md-4 name">
							Tanggal Verifikasi &amp; <br> Batas Waktu Pelayanan :
						</div>
						<div class="col-md-8 value tgl-periode">
						</div>
					</div>
					<div class="row static-info">
						<div class="col-md-4 name">
							Lokasi Bangunan Gedung :
						</div>
						<div class="col-md-8 value alamat-bangunan"></div>
					</div>
					<div class="row static-info">
						<div class="col-md-4 name">
							Fungsi Bangunan Gedung :
						</div>
						<div class="col-md-8 value fungsi-bangunan-gedung"></div>
					</div>

					<div class="row static-info">
						<div class="col-md-4 name">
							Luas, Tinggi &amp; Jumlah Lantai :
						</div>
						<div class="col-md-8 value luas-tinggi-lantai">
						</div>
					</div>
					<hr>
					<h4 align="center" class="caption-subject font-blue bold uppercase">Detail Perhitungan Retribusi</h4>
					<hr>
					<br>
					<div class="row static-info">
						<div class="col-md-4 name">
							Status Perhitungan Retribusi :
						</div>
						<div class="col-md-8 value status-perhitungan"></div>
					</div>
					<div class="manual-retribusi" style="display:none;">
						<div class="row static-info">
							<div class="col-md-4 name">
								Nilai Retribusi Bangunan :
							</div>
							<div class="col-md-8 value nilai-retribusi-bangunan"></div>
						</div>
						<div class="row static-info">
							<div class="col-md-4 name">
								Nilai Retribusi Prasarana:
							</div>
							<div class="col-md-8 value nilai-retribusi-prasarana"></div>
						</div>
						<div class="row static-info">
							<div class="col-md-4 name">
								Nilai Retribusi Keseluruhan:
							</div>
							<div class="col-md-8 value nilai-retribusi-keseluruhan"></div>
						</div>
						<div class="lampiran" style="display:none;">
							<div class="row static-info">
								<div class="col-md-4 name">
									Lampiran Perhitungan Retribusi :
								</div>
								<div class="col-md-8 value">
									<a href="javascript:;" class="btn btn-primary berkas-retribusi"><i class="fa fa-file"></i> Lihat Berkas</a>
								</div>
							</div>
						</div>
					</div>


					<div class="sistem-retribusi" style="display:none;"><br>
						<h5 class="caption-subject font-blue bold uppercase">Detail Indeks Terintegrasi</h5>
						<div class="row static-info">
							<div class="col-md-4 name">
								Indeks Parameter Fungsi Bangunan :
							</div>
							<div class="col-md-8 value parameter-fungsi"></div>
						</div>
						<div class="row static-info">
							<div class="col-md-4 name">
								Indeks Parameter Kompleksitas :
							</div>
							<div class="col-md-8 value parameter-kompleksitas"></div>
						</div>
						<div class="row static-info">
							<div class="col-md-4 name">
								Indeks Parameter Fungsi Bangunan:
							</div>
							<div class="col-md-8 value parameter-permanensi"></div>
						</div>
						<div class="row static-info">
							<div class="col-md-4 name">
								Indeks Parameter Ketinggian:
							</div>
							<div class="col-md-8 value parameter-ketinggian"></div>
						</div>
						<div class="row static-info">
							<div class="col-md-4 name">
								Faktor Kepemilikan:
							</div>
							<div class="col-md-8 value faktor-kepemilikan"></div>
						</div>
						<div class="row static-info">
							<div class="col-md-4 name">
								Indeks Terintegrasi:
							</div>
							<div class="col-md-8 value indeks-integrasi"></div>
						</div>
						<h5 class="caption-subject font-blue bold uppercase">Hasil Perhitungan Retribusi Bangunan</h5>
						<div class="row static-info">
							<div class="col-md-4 name">
								Luas Bangunan Gedung:
							</div>
							<div class="col-md-8 value luas-bangunan"></div>
						</div>
						<div class="row static-info">
							<div class="col-md-4 name">
								SHST (Standar Harga Satuan Tertinggi):
							</div>
							<div class="col-md-8 value shst"></div>
						</div>
						<div class="row static-info">
							<div class="col-md-4 name">
								Indeks Lokalitas:
							</div>
							<div class="col-md-8 value indeks-lokalitas"></div>
						</div>
						<div class="row static-info">
							<div class="col-md-4 name">
								Kegiatan:
							</div>
							<div class="col-md-8 value kegiatan"></div>
						</div>
						<div class="row static-info">
							<div class="col-md-4 name">
								Nilai Retribusi Bangunan:
							</div>
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
							<tbody id="dataPrasarana">
							</tbody>
							</tbody>
						</table>
						<div class="row static-info">
							<div class="col-md-4 name">
								Nilai Retribusi Prasarana:
							</div>
							<div class="col-md-8 value nilai-retribusi-prasarana"></div>
						</div>
						<h5 class="caption-subject font-blue bold uppercase">Hasil Perhitungan Retribusi Keseluruhan</h5>
						<div class="row static-info">
							<div class="col-md-4 name">
								Nilai Retribusi Keseluruhan:
							</div>
							<div class="col-md-8 value nilai-retribusi-keseluruhan"></div>
						</div>
					</div>

				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn btn-secondary" onClick=""><i class="fa fa-sign-out"></i> Tutup</button>
		</div>
	</div>
</div>

<div id="modal-option" class="modal fade bs-modal-sm" data-width="35%" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		</div>
		<div class="modal-body">
			<a href="javascript:;" class="btn btn-primary hitung-sistem">Hitung Berdasarkan Sistem</a>
			<a href="javascript:;" class="btn btn-primary hitung-perda" data-val="">Hitung Berdasarkan PERDA</a>
		</div>
		<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn red" onClick=""><i class="fa fa-sign-out"></i> Tutup</button>
		</div>
	</div>
</div>

<div id="modal-perda" class="modal fade bs-modal-sm" data-width="35%" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-content">
		<div class="modal-header">
			<a class="close btn-close" data-dismiss="modal" aria-hidden="true"></a>
		</div>
		<form action="<?= site_url('Perhitungan/simpan_perda') ?>" id="formPerda" method="POST" enctype="multipart/form-data">
			<div class="modal-body">
				<div class="form-body">
					<div class="form-group">
						<label class="control-label">Jumlah Retribusi Bangunan</label>
						<input class="form-control" type="text" name="retribusi_bangunan" placeholder="Jumlah Retribusi Bangunan" autocomplete="off" required>
					</div>
					<div class="form-group">
						<label class="control-label">Jumlah Retribusi Prasarana</label>
						<input class="form-control" type="text" name="retribusi_prasarana" placeholder="Jumlah Retribusi Prasarana" autocomplete="off" required>
					</div>
					<div class="form-group">
						<input type="hidden" name="id" class="no-konsultasi">
						<label control-label>Lampiran</label>
						<input type="file" name="berkas">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn green form-submit ladda-button" data-style="expand-right" data-size="l"><i class="fa fa-save"></i> Simpan</button>
				<button type="button" data-dismiss="modal" class="btn red btn-cancel"><i class="fa fa-sign-out"></i> Tutup</button>
			</div>
			<?php echo form_close(); ?>
	</div>
</div>



<script>
	var site_url = "<?= site_url() ?>";
	$(document).ready(function() {
		var table = $('#tableRetribusi').DataTable({
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
		});

		$('.btn-option').click(function(e) {
			let dataId = $(this).data('id');
			e.preventDefault();
			$('#modal-option').modal('show');
			$(`a.hitung-sistem`).attr(`href`, `${site_url}/Perhitungan/retribusi/${dataId}`);
			$(`a.hitung-perda`).attr(`data-val`, `${dataId}`);
			$(`a.no-konsultasi`).attr();
		});

		$('.hitung-perda').click(function(e) {
			e.preventDefault();
			let dataKonsultasi = $(this).data('val');
			$('#modal-option').modal('hide');
			$('#modal-perda').modal('show');
			$('.no-konsultasi').val(dataKonsultasi);
		});

		$('.hitung-perda').on('submit', '#perhitunganPerda', function() {
			alert('test');
		});

		$('#formPerda').submit(function(e) {
			e.preventDefault();
			var l = Ladda.create(document.querySelector('.form-submit'));
			$(".btn-cancel").attr("disabled", true);
			$(".btn-close").css("display", "none");
			l.start();
			$.ajax({
				type: "POST",
				url: `${site_url}Perhitungan/simpan_perda`,
				data: new FormData(this),
				dataType: 'json',
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
							$('#modal-perda').modal('hide');
							let a = $(`[data-id="${response.no_konsultasi}"]`);
							let b = a.next();
							let c = a.parent();
							let d = c.prev().find('span.label');
							let e = c.parent('tr');
							e.removeClass('danger').addClass('success');
							d.removeClass('label-danger').addClass('label-success').text('Selesai Perhitungan Retribusi');
							d.find('span').removeClass('label-success');
							b.html(`<a href="javascript:;" class="btn btn-info btn-sm detail-retribusi" title="Lihat Data" data-id="${response.dataId}"><span class="glyphicon glyphicon-user"></span></a>`)
							a.remove();
						}, 1500);
					}
				}
			});
		});



		$(document).on('click', '.detail-retribusi', function(e) {
			e.preventDefault();
			let dataDetail = $(this).data('id');
			$.ajax({
				type: "POST",
				url: `${site_url}DataDetail/DetailRetribusi`,
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