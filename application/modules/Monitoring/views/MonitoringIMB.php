<style>
	thead>tr>th {
		text-align: center;
	}
</style>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="fa fa-globe"></i>Monitoring IMB</div>
		<div class="tools">
			<a href="javascript:;" class="reload"></a>
		</div>
	</div>
	<div class="portlet-body">
		<table class="table table-striped table-bordered table-hover" id="tablePemeriksaan">
			<?php echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '</div>' : ''; ?>
			<thead>
				<tr>
					<th>No</th>
					<th>Jenis Permohonan</th>
					<th>No. Registrasi</th>
					<th>Lokasi BG</th>
					<th>Status Konsultasi</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if ($imb->num_rows() > 0) {
					$no = 1;
					foreach ($imb->result() as $key) {

						if ($key->status <= 13) {
							$label = "danger";
						} else {
							$label = "success";
						}

						if ($key->nama_permohonan == "" || $key->nama_permohonan == null) {
							$jenis_permohonan = "[Belum Memilih Jenis Permohonan]";
						} else {
							$jenis_permohonan = $key->nama_permohonan;
						}
						if ($key->nomor_registrasi == "" || $key->nomor_registrasi == null) {
							$no_registrasi = "[Belum Memiliki No Registrasi]";
						} else {
							$no_registrasi = $key->nomor_registrasi;
						}
						if ($key->alamat_bg == "" || $key->alamat_bg == null) {
							$lokasi_bg = "[Belum Menetapkan Lokasi Bangunan]";
						} else {
							$lokasi_bg = $key->alamat_bg;
						}
						if ($key->status >= 13) {
							$status = "IMB Terbit";
						} else {
							$status = "IMB Belum Terbit";
						}
				?>
						<tr class="<?php echo $label; ?>">
							<td align="center"><?php echo $no++; ?></td>
							<td><?php echo $jenis_permohonan; ?></td>
							<td><?php echo $no_registrasi; ?></td>
							<td><?php echo $lokasi_bg; ?></td>
							<td align="center"><? echo $status; ?></td>
							<td align="center">
								<a href="javascript:;" class="btn btn-info btn-sm detail-imb" title="Lihat Data" data-id="<?= $key->id_permohonan ?>"><span class="glyphicon glyphicon-user"></span></a>
							</td>
						</tr>
				<?php
					}
				}
				?>
			</tbody>
		</table>
	</div>
</div>


<div id="modalDetail" class="modal fade bs-modal-sm" data-width="70%" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-content">
		<div class="modal-body">
			<div id="content">
				<div class="portlet-title">
					<h4 align="center" class="caption-subject font-blue bold uppercase no-konsultasi"></h4>
					<hr>
					<br>
					<div class="row static-info">
						<div class="col-md-4 name">
							Nama Pemohon :
						</div>
						<div class="col-md-8 value nm-pemohon"></div>
					</div>
					<div class="row static-info">
						<div class="col-md-4 name">
							Alamat Pemilik :
						</div>
						<div class="col-md-8 value alamat-pemohon"></div>
					</div>
					<div class="row static-info">
						<div class="col-md-4 name">
							Jenis Permohonan :
						</div>
						<div class="col-md-8 value jenis-permohonan"></div>
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
					<br>
					<h5 class="caption-subject font-blue bold uppercase">Detail Permohonan</h5>
					<div class="portlet-body">
						<div class="tabbable-custom nav-justified">
							<ul class="nav nav-tabs nav-justified">
								<li class="active"><a href="#tabtot" data-toggle="tab">Data Bangunan</a></li>
								<li><a href="#tab_2_1" data-toggle="tab">Data Tanah </a></li>
								<li>
									<a href="#tab_2_2" data-toggle="tab">
										Persyaratan Administrasi </a>
								</li>
								<li>
									<a href="#tab_2_3" data-toggle="tab">
										Persyaratan Teknis </a>
								</li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane fade active in" id="tabtot">
									<div class="col-md-12">
										<h5 class="caption-subject font-blue bold uppercase">Data Lengkap Pemilik</h5>
										<div class="row static-info">
											<div class="col-md-4 name">Nama Pemilik</div>
											<div class="col-md-8 value nm-pemohon"></div>
										</div>
										<div class="row static-info">
											<div class="col-md-4 name">Alamat Pemilik Bangunan</div>
											<div class="col-md-8 value alamat-pemohon"></div>
										</div>
										<div class="row static-info">
											<div class="col-md-4 name">Nomor Telp / Hp</div>
											<div class="col-md-8 value no-telp"></div>
										</div>
										<div class="row static-info">
											<div class="col-md-4 name">Alamat Email</div>
											<div class="col-md-8 value email"></div>
										</div>
										<div class="row static-info">
											<div class="col-md-4 name">Nomor Identitas</div>
											<div class="col-md-8 value no-identitas"></div>
										</div>

										<br>
										<h5 class="caption-subject font-blue bold uppercase">Data Umum Bangunan Gedung</h5>
										<div class="row static-info">
											<div class="col-md-4 name">Jenis Permohonan</div>
											<div class="col-md-8 value jenis-permohonan"></div>
										</div>
										<div class="row static-info">
											<div class="col-md-4 name">Nama Bangunan Gedung</div>
											<div class="col-md-8 value nm-bangunan"></div>
										</div>
										<div class="row static-info">
											<div class="col-md-4 name">Klasifikasi Bangunan Gedung</div>
											<div class="col-md-8 value klasifikasi-bg"></div>
										</div>
										<div class="row static-info">
											<div class="col-md-4 name">Lokasi Bangunan Gedung</div>
											<div class="col-md-8 value alamat-bangunan"></div>
										</div>
										<div class="row static-info">
											<div class="col-md-4 name">Fungsi Bangunan Gedung</div>
											<div class="col-md-8 value fungsi-bangunan-gedung"></div>
										</div>
										<div class="row static-info">
											<div class="col-md-4 name">Luas Bangunan Gedung</div>
											<div class="col-md-8 value luas-bg"></div>
										</div>
										<div class="row static-info">
											<div class="col-md-4 name">Ketinggian Bangunan Gedung</div>
											<div class="col-md-8 value tinggi-bg"></div>
										</div>
										<div class="row static-info">
											<div class="col-md-4 name">Jumlah Lantai Bangunan Gedung</div>
											<div class="col-md-8 value">
												4 Lantai
											</div>
										</div>
										<div class="row static-info">
											<div class="col-md-4 name">Luas Basement</div>
											<div class="col-md-8 value luas-basement"></div>
										</div>
										<div class="row static-info">
											<div class="col-md-4 name">Jumlah Lantai Basement</div>
											<div class="col-md-8 value lapis-basement"></div>
										</div>
										<div class="row static-info">
											<div class="col-md-4 name">Perancang Dokumen Teknis</div>
											<div class="col-md-8 value">
												Perencana Kontruksi
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane fade" id="tab_2_1">
									<table id="sample_1" class="table table-bordered table-striped table-hover">
										<thead>
											<tr class="warning">
												<th>
													<center>No.</center>
												</th>
												<th>
													<center>Jenis Dokumen</center>
												</th>
												<th>
													<center>No. dan Tgl Dokumen</center>
												</th>
												<th>
													<center>Luas Tanah (m2)</center>
												</th>
												<th>
													<center>Atas Nama</center>
												</th>
												<th>
													<center>Berkas</center>
												</th>
												<th>
													<center>Izin Pemanfaatan</center>
												</th>

											</tr>
										</thead>
										<tbody class="data-tanah">
										</tbody>
									</table>

								</div>
								<div class="tab-pane fade" id="tab_2_2">
									<table id="sample_2" class="table table-bordered table-striped table-hover">
										<thead>
											<tr>
												<th>No</th>
												<th>Nama Dokumen</th>
												<th>Berkas</th>
											</tr>
										</thead>
										<tbody class="syarat-administrasi">

										</tbody>
									</table>

								</div>
								<div class="tab-pane fade" id="tab_2_3">
									<table id="sample_2" class="table table-bordered table-striped table-hover">
										<thead>
											<tr>
												<th>No</th>
												<th>Detail Persyaratan</th>
												<th>Berkas</th>
											</tr>
										</thead>
										<tbody class="syarat-teknis">
										</tbody>
									</table>

								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn btn-primary"><i class="fa fa-sign-out"></i> Tutup</button>
		</div>
	</div>
</div>

<script>
	var site_url = "<?= site_url() ?>";

	$(document).ready(function() {
		var table = $('#tablePemeriksaan').DataTable({
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


		$(document).on('click', '.detail-imb', function(e) {
			e.preventDefault();
			let dataDetail = $(this).data('id');
			$.ajax({
				type: "POST",
				url: `${site_url}DataDetail/DetailIMB`,
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
						$(".no-konsultasi").html(response.nomor_registrasi);
						$(".nm-pemohon").html(response.nama_pemohon);
						$(".jenis-permohonan").html(response.nama_permohonan);
						$(".alamat-pemohon").html(`${response.alamat_pemohon}, Kec. ${response.kecamatan_pemohon},${response.kabkot_pemohon}, ${response.provinsi_pemohon}`);
						$(".alamat-bangunan").html(`${response.alamat_bg}, Kec. ${response.kecamatan_bg},${response.kabkot_bg}, ${response.provinsi_bg}`);
						$(".fungsi-bangunan-gedung").html(`${response.fungsi_bg}`);
						$(".luas-tinggi-lantai").html(`${response.luas_bg} m<sup>2</sup>, dengan tinggi ${response.tinggi_bg} meter, dan berjumlah ${response.lantai_bg} lantai.`);
						$(".no-telp").html(`${response.no_tlp}`);
						$(".email").html(`${response.email}`);
						$(".no-identitas").html(`${response.no_identitas}`);
						$(".nm-bangunan").html(`${response.nama_bangunan}`);
						$(".klasifikasi-bg").html(`${response.klasifikasi_bg}`);
						$(".luas-bg").html(`${response.luas_bg} m<sup>2</sup>`);
						$(".tinggi-bg").html(`${response.tinggi_bg} Meter`);
						$(".jumlah-lantai").html(`${response.lantai_bg} Lantai`);
						$(".tinggi-bg").html(`${response.tinggi_bg} m<sup>2</sup>`);
						$(".luas-basement").html(`${response.luas_basement} Meter`);
						$(".lapis-basement").html(`${response.lapis_basement} Lantai`);
						var tableTanah;
						let numTanah = 1;
						if (response.tanah != 0) {
							response.tanah.forEach(obj => {
								tableTanah += '<tr style="text-align: center;">';
								tableTanah += `<td>${numTanah++}</td>`;
								tableTanah += `<td>${obj.jenis_dokumen}</td>`;
								tableTanah += `<td>${obj.nomor_dokumen}<br>${obj.tgl_dokumen}</td>`;
								tableTanah += `<td>${obj.luas_tanah} m<sup>2</sup></td>`;
								tableTanah += `<td>${obj.atas_nama}</td>`;
								let berkas = obj.dir_file == false ? 'Tidak ada dokumen' : `<a href="javascript:void(0);" class="btn btn-success btn-sm" title="Lihat Berkas" onclick="javascript:popWin('https://103.211.51.151:443/file/IMB/pengajuan_imb/${response.id_permohonan}/data_tanah/${obj.dir_file}')"><span class="glyphicon glyphicon-file"></span></a>`;
								let pemanfaatan = obj.dir_file_phat == false ? 'Tidak ada dokumen' : `<a href="javascript:void(0);" class="btn btn-success btn-sm" title="Lihat Berkas" onclick="javascript:popWin('https://103.211.51.151:443/file/IMB/pengajuan_imb/${response.id_permohonan}/data_tanah/${obj.dir_file_phat}')"><span class="glyphicon glyphicon-file"></span></a>`;
								tableTanah += `	<td>${berkas}</td>`;
								tableTanah += `	<td>${pemanfaatan}</td></tr>`;
							});
							$('.data-tanah').html(tableTanah);
						} else {
							$('.data-tanah').html('');
						}

						var tableAdmin;
						let numAdmin = 1;
						response.adm.forEach(obj => {
							
							tableAdmin += '<tr>';
							tableAdmin += `<td>${numAdmin++}</td>`;
							tableAdmin += `<td>${obj.nama_syarat}</td>`;
							let berkas = obj.dir_file == false ? 'Tidak ada dokumen' : `<a href="javascript:void(0);" class="btn default btn-xs blue-stripe" title="Lihat Berkas" onclick="javascript:popWin('https://103.211.51.151:443/file/imb/pengajuan_imb/${response.id_permohonan}/data_administrasi/${obj.dir_file}')"><span class="glyphicon glyphicon-file"></span>Lihat</a>`;
							tableAdmin += `<td style="text-align:center;">${berkas}</td></tr>`;
						});

						$('.syarat-administrasi').html(tableAdmin);


						var tableTeknis;
						let numTeknis = 1;
						response.tkn.forEach(obj => {
							tableTeknis += '<tr>';
							tableTeknis += `<td>${numTeknis++}</td>`;
							tableTeknis += `<td>${obj.nama_syarat}</td>`;
							let berkasTeknis = obj.dir_file == false ? 'Tidak ada dokumen' : `<a href="javascript:void(0);" class="btn default btn-xs blue-stripe" title="Lihat Berkas" onclick="javascript:popWin('https://103.211.51.151:443/file/imb/pengajuan_imb/${response.id_permohonan}/data_administrasi/${obj.dir_file}')"><span class="glyphicon glyphicon-file"></span>Lihat</a>`;
							tableTeknis += `<td style="text-align:center;">${berkasTeknis}</td></tr>`;
						});

						$('.syarat-teknis').html(tableTeknis);
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

	function popWin(x) {
		url = x;
		swin = window.open(url, 'win', 'scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
		swin.focus();
	}
</script>