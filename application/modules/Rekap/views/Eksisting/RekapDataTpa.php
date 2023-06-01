<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="fa fa-globe"></i>List Data Tenaga Ahli Profesi</div>
		<div class="tools"><a href="javascript:;" class="reload"></a></div>
	</div>
	<div class="portlet-body">
		<div class="form-actions">
			<?php echo form_open('Rekap/DataTpa', array('name' => 'frmListVerifikasi', 'id' => 'frmListVerifikasi')); ?>
			<div class="row">
				<div class="col-md-12">
					
					
					
					
				</div>
			</div>
		</div>
		<table class="table table-striped table-bordered table-hover" id="sample_2">
			<?php echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '</div>' : ''; ?>
			<thead>
				<tr>
					<th>No</th>
					<th><center>Nama Tenaga Ahli</center></th>
					<th><center>Alamat</center></th>
					<th><center>E-Mail</center></th>
					<th><center>No. Kontak</center></th>
				</tr>
			</thead>
			<tbody>
				<?php if ($Verifikasi->num_rows() > 0) {
					$no = 1;
					foreach ($Verifikasi->result() as $tpa) { ?>
						<?php if ($tpa->status == '') {
							$clss = "success";
						} elseif ($tpa->status == 1) {
							$clss = "success";
						} elseif ($tpa->status == 2) {
							$clss = "success";
						} elseif ($tpa->status == 3) {
							$clss = "success";
						} elseif ($tpa->status >= 4) {
							$clss = "success";
						} else {
							$clss = "success";
						} ?>
						<tr class="<?= $clss ?>">
							<td align="center"><?php echo $no++; ?></td>
							<td><?php echo $tpa->glr_depan; ?> <?php echo $tpa->nm_tpa; ?> <?php echo $tpa->glr_blkg; ?></td>
							<td><?php echo $tpa->alamat; ?></td>
							<td align="center"><?php echo $tpa->email; ?></td>
							<td><?php echo $tpa->no_kontak; ?></td>
						</tr>
				<?php }
				} ?>
			</tbody>
		</table>
	</div>
</div>
<!-- /.modaledit -->
<div id="modal-edit" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false" data-focus-on="input:first">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		</div>
		<!-- /.modal-content -->
	</div>
</div>
<div id="modal-detail" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false" data-focus-on="input:first">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-body">
				<div id="content">
					<div class="portlet-title">
						<h4 align="center" class="caption-subject font-blue bold uppercase no-konsultasi"></h4>
						<hr>
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
						<!--<div class="row static-info">
							<div class="col-md-4 name">
								Tanggal Verifikasi &amp; <br> Batas Waktu Pelayanan :
							</div>
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
						<div class="prasarana" style="display:none;">
							<div class="row static-info">
								<div class="col-md-4 name">Fungsi Bangunan Gedung</div>
								<div class="col-md-8 value jns-prasarana"></div>
							</div>
							<div class="row static-info">
								<div class="col-md-4 name">Luas dan Tinggi </div>
								<div class="col-md-8 value luas-tinggi-prasarana"></div>
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
									<tbody id="tableKolektif2"></tbody>
								</table>
							</div>
						</div>
						<div class="row static-info">
							<div class="col-md-4 name">Total Luas Bangunan Kolektif</div>
							<div class="col-md-8 value total-luas-kolektif"></div>
						</div>
					</div>

						<!--<div class="row static-info">
							<div class="col-md-4 name">Fungsi Bangunan Gedung</div>
							<div class="col-md-8 value fungsi-bangunan-gedung"></div>
						</div>
						<div class="row static-info">
							<div class="col-md-4 name">Luas, Tinggi &amp; Jumlah Lantai</div>
							<div class="col-md-8 value luas-tinggi-lantai"></div>
						</div>-->
						<br>
						<h5 class="caption-subject font-blue bold uppercase">Detail Permohonan</h5>
						<div class="portlet-body">
							<div class="tabbable-custom nav-justified">
								<ul class="nav nav-tabs nav-justified">
									<li class="active"><a href="#tabtot" data-toggle="tab">Data Bangunan</a></li>
									<li><a href="#tab_2_1" data-toggle="tab">Data Tanah </a></li>
									<li><a href="#tab_2_2" data-toggle="tab">Data Umum </a></li>
									<li><a href="#tab_2_3" data-toggle="tab">Ketentuan Teknis</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane fade active in" id="tabtot">
										<div class="col-md-12">
											<h5 class="caption-subject font-blue bold uppercase">Data Lengkap Pemilik</h5>
											<div class="row static-info">
												<div class="col-md-4 name">Nama Pemilik</div>
												<div class="col-md-8 value nm-pemilik"></div>
											</div>
											<div class="row static-info">
												<div class="col-md-4 name">Alamat Pemilik Bangunan</div>
												<div class="col-md-8 value alamat-pemilik"></div>
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
												<div class="col-md-4 name">Jenis Konsultasi</div>
												<div class="col-md-8 value jenis-konsultasi"></div>
											</div>
											<div class="row static-info">
												<div class="col-md-4 name">Nama Bangunan Gedung</div>
												<div class="col-md-8 value nm-bgn"></div>
											</div>
											<div class="row static-info">
												<div class="col-md-4 name">Lokasi Bangunan Gedung</div>
												<div class="col-md-8 value alamat-bangunan"></div>
											</div>
											
											<div class="fungsi-bangunan" style="display:none;">
												<div class="row static-info">
													<div class="col-md-4 name">Klasifikasi Bangunan Gedung</div>
													<div class="col-md-8 value klasifikasi-bg"></div>
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
													<div class="col-md-8 value jumlah-lantai">
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
											</div>
											<div class="prasarana" style="display:none;">
												<div class="row static-info">
													<div class="col-md-4 name">Klasifikasi Bangunan Gedung</div>
													<div class="col-md-8 value">Tidak Sederhana</div>
												</div>
												<div class="row static-info">
													<div class="col-md-4 name">Fungsi Bangunan Prasarana</div>
													<div class="col-md-8 value jns-prasarana"></div>
												</div>
												<div class="row static-info">
													<div class="col-md-4 name">Luas Bangunan Prasarana</div>
													<div class="col-md-8 value luas-bgp"></div>
												</div>
												<div class="row static-info">
													<div class="col-md-4 name">Ketinggian Bangunan Prasarana</div>
													<div class="col-md-8 value tinggi-bgp"></div>
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
											<!--<div class="row static-info">
												<div class="col-md-4 name">Perancang Dokumen Teknis</div>
												<div class="col-md-8 value">Perencana Kontruksi</div>
											</div>-->
										</div>
									</div>
									<div class="tab-pane fade" id="tab_2_1">
										<table class="table table-bordered table-striped table-hover">
											<thead>
												<tr class="warning">
													<th><center>No.</center></th>
													<th><center>Jenis Dokumen</center></th>
													<th><center>No. dan Tgl Dokumen</center></th>
													<th><center>Luas Tanah (m2)</center></th>
													<th><center>Atas Nama</center></th>
													<th><center>Berkas</center></th>
													<th><center>Izin Pemanfaatan</center></th>
												</tr>
											</thead>
											<tbody class="data-tanah"></tbody>
										</table>
										<div id="id_izin">
											<table class="table table-bordered table-striped table-hover">
												<thead>
													<tr>
														<th style="text-align:center;">No</th>
														<th style="text-align:center;">Ketentuan Teknis Tanah</th>
														<th style="text-align:center;">Keterangan</th>
														<th style="text-align:center;">Berkas</th>
													</tr>
												</thead>
												<tbody class="ketentuan-tanah"></tbody>
											</table>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_2_2">
										<table class="table table-bordered table-striped table-hover">
											<thead>
												<tr>
													<th>No</th>
													<th>Dokumen Umum</th>
													<th>Keterangan</th>
													<th>Berkas</th>
												</tr>
											</thead>
											<tbody class="data-umum"></tbody>
										</table>
										<table class="table table-bordered table-striped table-hover">
											<thead>
												<tr>
													<th>No</th>
													<th>Dokumen Arsitektur</th>
													<th>Keterangan</th>
													<th>Berkas</th>
												</tr>
											</thead>
											<tbody class="data-arsitektur"></tbody>
										</table>
									</div>
									<div class="tab-pane fade" id="tab_2_3">
										<table class="table table-bordered table-striped table-hover">
											<thead>
												<tr>
													<th>No</th>
													<th>Ketentuan Teknis Struktur</th>
													<th>Keterangan</th>
													<th>Berkas</th>
												</tr>
											</thead>
											<tbody class="data-struktur"></tbody>
										</table>
										<table class="table table-bordered table-striped table-hover">
											<thead>
												<tr>
													<th>No</th>
													<th>Ketentuan Teknis MEP</th>
													<th>Keterangan</th>
													<th>Berkas</th>
												</tr>
											</thead>
											<tbody class="data-mep"></tbody>
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
</div>

<script type="text/javascript">
	function GetPdf() {
		url = "<?php echo base_url() . index_page() ?>DinasTeknis/cetak/";
		swin = window.open(url, 'win', 'scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
		swin.focus();
	}
</script>
<script>
	var site_url = "<?= site_url() ?>";
	$(document).ready(function() {
		var table = $('#tableVerifikasi').DataTable({
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
		$(document).on('click', '.detail-verifikasi', function(e) {
			e.preventDefault();
			let dataDetail = $(this).data('id');
			$.ajax({
				type: "POST",
				url: `${site_url}DataDetail/DetailVerifikasi`,
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
						$(".alamat-pemilik").html(`${response.alamat}, Kec. ${response.nama_kecamatan}, ${response.nama_kabkota}, ${response.nama_prov_pemilik}`);
						$(".jenis-konsultasi").html(response.nm_konsultasi);
						$(".alamat-bangunan").html(`${response.almt_bgn}, Desa/Kel. ${response.nama_kel_bg}, Kec. ${response.nama_kec_bg}, ${response.nama_kabkota_bg}, ${response.nama_provinsi_bg}`);
						$(".fungsi-bangunan-gedung").html(`${response.fungsi_bg}`);
						$(".luas-tinggi-lantai").html(`${response.luas_bgn} m<sup>2</sup>, dengan tinggi ${response.tinggi_bgn} meter, dan berjumlah ${response.jml_lantai} lantai.`);
						$(".luas-tinggi-prasarana").html(`${response.luas_bgp} m<sup>2</sup>, dengan tinggi ${response.tinggi_bgp} meter.`);
						$(".konsultasi-ke").val(`ke-${response.nextKonsultasi}`);
						$(".tgl-periode").html(`<p class="font-blue"> ${response.tgl_pernyataan} <i class="text-tot">sampai dengan</i> ${response.hasil_tgl} <i class="text-tot">, (${response.lama_proses} Hari Kerja) <br>terhitung dari tanggal verifikasi kelengkapan berkas</i></p>`);
						$("#idKonsultasi").val(response.id_konsultasi);
						$("#email").val(response.email);
						$("#noreg").val(response.no_konsultasi);
						$('#modal-detail').modal('show');
						$(".no-telp").html(`${response.no_hp}`);
						$(".email").html(`${response.email}`);
						$(".no-identitas").html(`${response.no_ktp}`);
						$(".nm-bgn").html(`${response.nm_bgn}`);
						$(".klasifikasi-bg").html(`${response.klasifikasi_bg}`);

						$(".jns-prasarana").html(`${response.jns_prasarana}`);
						$(".luas-bg").html(`${response.luas_bgn} m<sup>2</sup>`);
						$(".tinggi-bg").html(`${response.tinggi_bgn} Meter`);
						$(".jumlah-lantai").html(`${response.jml_lantai} Lantai`);
						$(".tinggi-bg").html(`${response.tinggi_bgn} Meter`);
						$(".luas-basement").html(`${response.luas_basement} m<sup>2</sup>`);
						$(".lapis-basement").html(`${response.lapis_basement} Lantai`);

						$(".luas-bgp").html(`${response.luas_bgp} m<sup>2</sup>`);
						$(".tinggi-bgp").html(`${response.tinggi_bgp} Meter`);
						if (response.id_jenis_permohonan == 11) {
                            $('.fungsi-bangunan').css('display', 'none');
                            $('.bangunan-kolektif').css('display', 'block');
							$('.prasarana').css('display', 'none');
                            $('.total-luas-kolektif').html(`${response.luas_total_kolektif} m<sup>2</sup>`);
                            var tableKolektif2;
                            if (response.hasil_kolektif != 0) {
                                response.hasil_kolektif.forEach(obj => {
                                    tableKolektif2 += '<tr>';
                                    tableKolektif2 += `<td>${obj.tipe}</td>`;
                                    tableKolektif2 += `<td>${obj.luas}</td>`;
                                    tableKolektif2 += `<td>${obj.tinggi}</td>`;
                                    tableKolektif2 += `<td>${obj.lantai}</td>`;
                                    tableKolektif2 += `<td>${obj.jumlah}</td></tr>`;
                                    $('#tableKolektif2').html(tableKolektif2);
                                });
                            }
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
                        } else if (response.id_jenis_permohonan == 12)  {
							$('.fungsi-bangunan').css('display', 'none');
							$('.bangunan-kolektif').css('display', 'none');
                            $('.prasarana').css('display', 'block');
						}else{
							$('.fungsi-bangunan').css('display', 'block');
							$('.bangunan-kolektif').css('display', 'none');
                            $('.prasarana').css('display', 'none');
						}
						var tableTanah;
						let numTanah = 1;
						if (response.tanah != 0) {
							response.tanah.forEach(obj => {
								tableTanah += '<tr style="text-align: center;">';
								tableTanah += `<td>${numTanah++}</td>`;
								tableTanah += `<td>${obj.jenis_dokumen}</td>`;
								tableTanah += `<td>${obj.no_dok}<br>${obj.tanggal_dok}</td>`;
								tableTanah += `<td>${obj.luas_tanah} m<sup>2</sup></td>`;
								tableTanah += `<td>${obj.atas_nama_dok}</td>`;
								let berkas = obj.dir_file == false ? 'Tidak ada dokumen' : `<a href="javascript:void(0);" class="btn btn-success btn-sm" title="Lihat Berkas" onclick="javascript:popWin('${site_url}${obj.dir_file}')"><span class="glyphicon glyphicon-file"></span></a>`;
								let pemanfaatan = obj.dir_file_phat == false ? 'Tidak ada dokumen' : `<a href="javascript:void(0);" class="btn btn-success btn-sm" title="Lihat Berkas" onclick="javascript:popWin('${site_url}${obj.dir_file_phat}')"><span class="glyphicon glyphicon-file"></span></a>`;
								tableTanah += `	<td>${berkas}</td>`;
								tableTanah += `	<td>${pemanfaatan}</td></tr>`;
							});
							$('.data-tanah').html(tableTanah);
						} else {
							$('.data-tanah').html('');
						}
						if (response.id_izin != 2) {
							var teknisTanah;
							let numTanahTeknis = 1;
							response.syarat_tanah.forEach(obj => {
								teknisTanah += '<tr>';
								teknisTanah += `<td style="text-align:center;">${numTanahTeknis++}</td>`;
								teknisTanah += `<td>${obj.nm_dokumen}</td>`;
								teknisTanah += `<td>${obj.keterangan}</td>`;
								let berkas = obj.dir_file == false ? 'Tidak ada dokumen' : `<a href="javascript:void(0);" class="btn default btn-xs blue-stripe" title="Lihat Berkas" onclick="javascript:popWin('${site_url}${obj.dir_file}')"><span class="glyphicon glyphicon-file"></span>Lihat</a>`;
								teknisTanah += `<td style="text-align:center;">${berkas}</td></tr>`;
							});
							$('.ketentuan-tanah').html(teknisTanah);
							document.getElementById('id_izin').style.display = "block";
						} else {
							document.getElementById('id_izin').style.display = "none";
						}

						var tableUmum;
						let numTableUmum = 1;
						response.syarat_umum.forEach(obj => {
							tableUmum += '<tr>';
							tableUmum += `<td style="text-align:center;">${numTableUmum++}</td>`;
							tableUmum += `<td>${obj.nm_dokumen}</td>`;
							tableUmum += `<td>${obj.keterangan}</td>`;
							let berkas = obj.dir_file == false ? 'Tidak ada dokumen' : `<a href="javascript:void(0);" class="btn default btn-xs blue-stripe" title="Lihat Berkas" onclick="javascript:popWin('${site_url}${obj.dir_file}')"><span class="glyphicon glyphicon-file"></span>Lihat</a>`;
							tableUmum += `<td style="text-align:center;">${berkas}</td></tr>`;
						});
						$('.data-umum').html(tableUmum);

						var tableArsitektur;
						let numArsitektur = 1;
						response.syarat_arsitektur.forEach(obj => {
							tableArsitektur += '<tr>';
							tableArsitektur += `<td style="text-align:center;">${numArsitektur++}</td>`;
							tableArsitektur += `<td>${obj.nm_dokumen}</td>`;
							tableArsitektur += `<td>${obj.keterangan}</td>`;
							let berkas = obj.dir_file == false ? 'Tidak ada dokumen' : `<a href="javascript:void(0);" class="btn default btn-xs blue-stripe" title="Lihat Berkas" onclick="javascript:popWin('${site_url}${obj.dir_file}')"><span class="glyphicon glyphicon-file"></span>Lihat</a>`;
							tableArsitektur += `<td style="text-align:center;">${berkas}</td></tr>`;
						});
						$('.data-arsitektur').html(tableArsitektur);

						var tableStruktur;
						let numStruktur = 1;
						response.syarat_struktur.forEach(obj => {
							tableStruktur += '<tr>';
							tableStruktur += `<td style="text-align:center;">${numStruktur++}</td>`;
							tableStruktur += `<td>${obj.nm_dokumen}</td>`;
							tableStruktur += `<td>${obj.keterangan}</td>`;
							let berkas = obj.dir_file == false ? 'Tidak ada dokumen' : `<a href="javascript:void(0);" class="btn default btn-xs blue-stripe" title="Lihat Berkas" onclick="javascript:popWin('${site_url}${obj.dir_file}')"><span class="glyphicon glyphicon-file"></span>Lihat</a>`;
							tableStruktur += `<td style="text-align:center;">${berkas}</td></tr>`;
						});
						$('.data-struktur').html(tableStruktur);
						
						var tableMep;
						let numMep = 1;
						response.syarat_mep.forEach(obj => {
							tableMep += '<tr>';
							tableMep += `<td style="text-align:center;">${numMep++}</td>`;
							tableMep += `<td>${obj.nm_dokumen}</td>`;
							tableMep += `<td>${obj.keterangan}</td>`;
							let berkas = obj.dir_file == false ? 'Tidak ada dokumen' : `<a href="javascript:void(0);" class="btn default btn-xs blue-stripe" title="Lihat Berkas" onclick="javascript:popWin('${site_url}${obj.dir_file}')"><span class="glyphicon glyphicon-file"></span>Lihat</a>`;
							tableMep += `<td style="text-align:center;">${berkas}</td></tr>`;
						});
						$('.data-mep').html(tableMep);
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