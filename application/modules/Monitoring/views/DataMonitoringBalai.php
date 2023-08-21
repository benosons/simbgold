<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="fa fa-globe"></i>List Data Permohonan Untuk Bangunan Baru</div>
		<div class="tools"><a href="javascript:;" class="reload"></a></div>
	</div>
	<div class="portlet-body">
		<div class="form-actions">
			<?php echo form_open('Monitoring/Konsultasi', array('name' => 'frmListVerifikasi', 'id' => 'frmListVerifikasi')); ?>
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
					<!--<div class="form-group col-md-12">
						<label class="control-label col-md-3"><b>Tahap Proses Verifikasi</b></label>
						<div class="col-md-9">
							<div class="col-md-5">
								<select class="form-control select2me" name="id_proses">
									<option value="">Semua Proses permohonan</option>
									<option value="1" <?php if (isset($id_proses) && $id_proses == 1) echo "selected"; ?>>Belum DiVerifikasi</option>
									<option value="2" <?php if (isset($id_proses) && $id_proses == 2) echo "selected"; ?>>Sudah Diverifikasi</option>
								</select>
							</div>
						</div>
					</div>-->
					<div class="form-group col-md-12">
						<label class="control-label col-md-3"><b>Tgl. Permohonan Konsultasi.</b></label>
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
								<a href="<?php echo base_url('Monitoring/cetak_excel/'.$fungsi.'/'.$awal.'/'.$akhir);?>"  title="cetak" class="btn green">Cetak Excel</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<table class="table table-striped table-bordered table-hover" id="sample_1">
			<?php echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '</div>' : ''; ?>
			<thead>
				<tr>
					<th>No</th>
					<th>Jenis Konsultasi</th>
					<th>No. Registrasi</th>
					<th>Nama Pemilik</th>
					<th>Lokasi BG</th>
					<th>Fungsi BG</th>
					<th>Nama Bangunan</th>
					<th>Tgl Permohonan</th>
					<th>Status</th>
					<th>Detail</th>
				</tr>
			</thead>
			<tbody>
				<?php if ($Verifikasi->num_rows() > 0) {
					$no = 1;
					foreach ($Verifikasi->result() as $Konsultasi) { ?>
						<?php if ($Konsultasi->status == '') {
							$clss = "danger";
						}else {
							$clss = "success";
						} ?>
						<tr class="<?= $clss ?>">
							<td align="center"><?php echo $no++; ?></td>
							<td><?php echo $Konsultasi->nm_konsultasi; ?></td>
							<td align="center"><?php echo $Konsultasi->no_konsultasi; ?></td>
							<td align="center"><?php echo $Konsultasi->nm_pemilik; ?></td>
							<td><?php echo $Konsultasi->almt_bgn; ?></td>
							<td><?php echo $Konsultasi->fungsi_bg; ?></td>
							<td><?php echo $Konsultasi->nm_bgn; ?></td>
							<td align="center"><?php echo  date('d-m-Y', strtotime($Konsultasi->tgl_pernyataan)); ?></td>
							<td align="center">
								<?php echo $Konsultasi->status_dinas; ?>
							</td>
							<td align="center">
								<a href="javascript:;" class="btn btn-info btn-sm detail-verifikasi" title="Lihat Data" data-id="<?= $Konsultasi->id ?>"><span class="glyphicon glyphicon-user"></span></a>
							</td>
						</tr>
				<?php }
				} ?>
			</tbody>
		</table>
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
						<div class="row static-info">
							<div class="col-md-4 name">Lokasi Bangunan Gedung</div>
							<div class="col-md-8 value alamat-bangunan"></div>
						</div>
						<div class="row static-info">
							<div class="col-md-4 name">Fungsi Bangunan Gedung</div>
							<div class="col-md-8 value fungsi-bangunan-gedung"></div>
						</div>
                        <div class="fungsi-bangunan" style="display:none;">
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
						<h5 class="caption-subject font-blue bold uppercase">Detail Permohonan</h5>
						<div class="portlet-body">
							<div class="tabbable-custom nav-justified">
								<ul class="nav nav-tabs nav-justified">
									<li Class="active"><a href="#tab_2_1" data-toggle="tab">Data Tanah </a></li>
									<li><a href="#tab_2_2" data-toggle="tab">Data Umum </a></li>
									<li><a href="#tab_2_3" data-toggle="tab">Ketentuan Teknis</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane fade active in" id="tab_2_1">
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
						$(".alamat-bangunan").html(`${response.almt_bgn}, Kec. ${response.nama_kec_bg}, ${response.nama_kabkota_bg}, ${response.nama_provinsi_bg}`);
						$(".fungsi-bangunan-gedung").html(`${response.fungsi_bg}`);
						$(".luas-tinggi-lantai").html(`${response.luas_bgn} m<sup>2</sup>, dengan tinggi ${response.tinggi_bgn} meter, dan berjumlah ${response.jml_lantai} lantai.`);
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
						$(".luas-bg").html(`${response.luas_bgn} m<sup>2</sup>`);
						$(".tinggi-bg").html(`${response.tinggi_bgn} Meter`);
						$(".jumlah-lantai").html(`${response.jml_lantai} Lantai`);
						$(".tinggi-bg").html(`${response.tinggi_bgn} m<sup>2</sup>`);
						$(".luas-basement").html(`${response.luas_basement} Meter`);
						$(".lapis-basement").html(`${response.lapis_basement} Lantai`);
						if (response.id_jenis_permohonan == 11 || response.id_jenis_permohonan == 29 || response.id_jenis_permohonan == 30 || response.id_jenis_permohonan == 31 || response.id_jenis_permohonan == 32 || response.id_jenis_permohonan == 33) {
                            $('.fungsi-bangunan').css('display', 'none');
                            $('.bangunan-kolektif').css('display', 'block');
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
                        }else{
                            $('.fungsi-bangunan').css('display', 'block');
                            $('.bangunan-kolektif').css('display', 'none');
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