<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="fa fa-globe"></i>List Data Penugasan Pemeriksan Dokumen</div>
		<div class="tools"><a href="javascript:;" class="reload"></a></div>
	</div>
	<div class="portlet-body">
	<div class="form-actions">
			<?php echo form_open('Penugasan/Penugasan', array('name' => 'frmListVerifikasi', 'id' => 'frmListVerifikasi')); ?>
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
					<div class="form-group col-md-12">
						<label class="control-label col-md-3"><b>Status Penugasan TPA/TPT</b></label>
						<div class="col-md-9">
							<div class="col-md-5">
								<select class="form-control select2me" name="id_proses">
									<option value="0">Semua Proses</option>
									<option value="1" <?php if (isset($id_proses) && $id_proses == 1) echo "selected"; ?>>Belum Ditugaskan</option>
									<option value="2" <?php if (isset($id_proses) && $id_proses == 2) echo "selected"; ?>>Sudah Ditugaskan</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group col-md-12">
						<label class="control-label col-md-3"><b>Tanggal Penugasan</b></label>
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
								<a href="javascript:void(0);" onClick="javascript:GetPdf()" title="cetak" class="btn green">Cetak</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php echo form_close() ?>
		</div>
		<table class="table table-striped table-bordered table-hover" id="tablePenugasan">
			<?php echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '</div>' : ''; ?>
			<thead>
				<tr class="warning">
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
					if ($r->status <= 4) {
						$clss = "danger";
					} elseif ($r->status >= 5) {
						$clss = "success";
					} else {
						$clss = "success";
					}
					?>
					<tr class="<?= $clss ?>">
						<td align="center"><?php echo $no++; ?></td>
						<td><?php echo $r->nm_konsultasi; ?></td>
						<td align="center"><?php echo $r->no_konsultasi; ?></td>
						<td align="left"><?php echo $r->nm_pemilik; ?></td>
						<td><?php echo $r->almt_bgn; ?></td>
						<td align="center">
							<?php if($r->id_izin =='2'){
								if( $r->id_fungsi_bg =='1'){
									$bg = "TPT";
								}else{
									$bg = "TPT";
								}
							}else if($r->id_izin =='7'){
								$bg = "TPT";
							}else if($r->id_izin =='4'){
								$bg = "TPA";
							}else{
								if( $r->id_fungsi_bg =='1'){
									if($r->id_klasifikasi =='2'){
										$bg = "TPA";	
									}else{
										$bg = "TPT";
									}
								}else{
									$bg = "TPA";
								}
							}
							//$class = "label label-sm label-danger";
							//$syarat = "Menunggu Penugasan {$bg}";
							if ($r->status <= 4) {
								$class = "label label-sm label-danger";
								$syarat = "Menunggu Penugasan TPT/TPA";
							} else if ($r->status >= 5) {
								$class = "label label-sm label-success";
								$syarat = "Sudah Dilakukan Penugasan TPT/TPA";
							}; ?>
							<span class="<?php echo $class; ?>"><?php echo $syarat; ?></span>
						</td>
						<?php if ($r->status == 4) { ?>
							<td align="center">
								<a href="javascript:;" class="btn btn-success btn-sm form-penugasan" data-stats="<?= $bg ?>" title="Penugasan TPA/TPt" data-id="<?= $r->id ?>"><span class="glyphicon glyphicon-edit"></span></a>
								<div class="data-action"></div><br>
								<a href="<?php echo site_url('Penugasan/Rollback/' . $r->id); ?>" class="btn btn-warning btn-sm" onclick="return confirm('Yakin Mengembalikan Permohonan ini ke Proses Verifikasi Data?')"title="Kembali"><span class="glyphicon glyphicon-edit"></span>
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
<!-- Begin Data Detail Penugasan -->
<div id="modalDetail" class="modal fade bs-modal-sm" data-width="70%" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-content">
		<div class="modal-body">
			<div id="content">
				<div class="portlet-title">
					<h4 align="center" class="caption-subject font-blue bold uppercase no-konsultasi"></h4>
					<hr>
					<h5 class="caption-subject font-blue bold uppercase">Detail Permohonan</h5>
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
					<div class="pertashop" style="display:none;">
                        <div class="row static-info">
                            <div class="col-md-4 name">Fungsi Bangunan Gedung</div>
                            <div class="col-md-8 value fungsi-bangunan-gedung"></div>
                        </div>
                        <div class="row static-info">
                            <div class="col-md-4 name">Luas dan Tinggi Bangunan</div>
                            <div class="col-md-8 value luas-prasarana">
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
					<h5 class="caption-subject font-blue bold uppercase">Daftar Tim Teknis</h5>
					<table class="table table-bordered table-striped table-hover">
						<thead>
							<tr style="padding-left: 5px; padding-bottom:3px;  font-weight:bold">
								<th>No</th>
								<th>Nama Tim TPA/TPT</th>
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
<!-- End Data Detail Penugasan -->
<!-- Begin Penugasan TPT/TPA -->
<div id="modalPenugasan" class="modal fade bs-modal-sm" data-width="70%" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-content">
		<div class="modal-body">
			<div id="content">
				<div class="portlet-title">
					<h4 align="center" class="caption-subject font-blue bold uppercase no-konsultasi"></h4>
					<h5 class="caption-subject font-blue bold uppercase">Detail Kepemilikan</h5>
					<div class="row static-info">
						<div class="col-md-3 name">Nama Pemilik</div>
						<div class="col-md-8 value nm-pemilik"></div>
					</div>
					<div class="row static-info">
						<div class="col-md-3 name">Alamat Pemilik</div>
						<div class="col-md-8 value alamat-pemilik"></div>
					</div>
					<div class="row static-info">
						<div class="col-md-3 name">Jenis Konsultasi</div>
						<div class="col-md-8 value jenis-konsultasi"></div>
					</div>
					<!--<div class="row static-info">
						<div class="col-md-4 name">Tanggal Verifikasi &amp; Batas Waktu Pelayanan</div>
						<div class="col-md-8 value tgl-periode"></div>
					</div>-->
					<div class="row static-info">
						<div class="col-md-3 name">Lokasi Bangunan Gedung</div>
						<div class="col-md-8 value alamat-bangunan"></div>
					</div>
					<div class="prasarana" style="display:none;">
                        <div class="row static-info">
                            <div class="col-md-3 name">Fungsi Bangunan Gedung</div>
                            <div class="col-md-8 value fungsi-bangunan-gedung"></div>
                        </div>
                        <div class="row static-info">
                            <div class="col-md-3 name">Luas dan Tinggi Bangunan Prasarana</div>
                            <div class="col-md-8 value luas-tinggi">
                            </div>
                        </div>
                    </div>
					<div class="pertashop" style="display:none;">
                        <div class="row static-info">
                            <div class="col-md-3 name">Fungsi Bangunan Gedung</div>
                            <div class="col-md-8 value fungsi-bangunan-gedung"></div>
                        </div>
                        <div class="row static-info">
                            <div class="col-md-3 name">Luas dan Tinggi Bangunan </div>
                            <div class="col-md-8 value luas-tinggi">
                            </div>
                        </div>
                    </div>
					<div class="fungsi-bangunan" style="display:none;">
                        <div class="row static-info">
                            <div class="col-md-3 name">Fungsi Bangunan Gedung</div>
                            <div class="col-md-8 value fungsi-bangunan-gedung"></div>
                        </div>
                        <div class="row static-info">
                            <div class="col-md-3 name">Luas, Tinggi &amp; Jumlah Lantai</div>
                            <div class="col-md-8 value luas-tinggi-lantai"></div>
                        </div>
                    </div>
					<div class="bangunan-kolektif" style="display:none;">
                        <div class="row static-info">
                            <div class="col-md-3 name">Jenis Konsultasi Bangunan</div>
                            <div class="col-md-8 value">Bangunan Gedung Kolektif</div>
                        </div>
                        <div class="row static-info">
                            <div class="col-md-3 name">Data Bangunan Gedung Kolektif</div>
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
					<br>
					<h5 class="caption-subject font-blue bold uppercase daftar-tim-penugasan"></h5>
					<table class="table table-bordered table-hover">
						<thead>
							<tr class="info" style="padding-left: 5px; padding-bottom:3px;  font-weight:bold">
								<th>Pilih</th>
								<th>Nama Personil</th>
								<th>Unsur</th>
								<th>Bidang</th>
								<th>Keahlian</th>
							</tr>
						</thead>
						<tbody class="tim-petugas">
						</tbody>
						<input type="hidden" id="idPemilik" value="">
						<input type="hidden" id="noKonsultasi" value="">
						<input type="hidden" id="statsPenugasan" value="">
					</table>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-success simpan-penugasan ladda-button" data-style="expand-right" data-size="l"><i class="fa fa-save"></i> Simpan</button>
			<button type="button" data-dismiss="modal" class="btn btn-primary btn-cancel"><i class="fa fa-sign-out"></i> Tutup</button>
		</div>
	</div>
</div>
<!-- End Penugasan TPT/TPA -->
<script type="text/javascript">
	function GetPdf() {
		url = "<?php echo base_url() . index_page() ?>Penugasan/cetak/";
		swin = window.open(url, 'win', 'scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
		swin.focus();
	}
</script>
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
				url: `${site_url}DataDetail/DetailPenugasan`,
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
						$(".alamat-bangunan").html(`${response.almt_bgn}, Kel/Desa. ${response.nama_kec_bg}, Kec. ${response.nama_kec_bg},${response.nama_kabkota_bg}, ${response.nama_provinsi_bg}`);
						$(".fungsi-bangunan-gedung").html(`${response.fungsi_bg}`);
						$(".luas-tinggi-lantai").html(`${response.luas_bgn} m<sup>2</sup>, dengan tinggi ${response.tinggi_bgn} meter, dan berjumlah ${response.jml_lantai} lantai.`);
						$(".luas-prasarana").html(`${response.luas_bgp} m<sup>2</sup>, dengan tinggi ${response.tinggi_bgp} meter`);
						$(".fungsi-prasarana").html(`${response.jns_prasarana}`);
						$(".tgl-periode").html(`<p><span class="font-blue">${response.tgl_pernyataan}</span> <i class="text-tot">sampai dengan</i> <span class="font-blue">${response.hasil_tgl}</span> <i class="text-tot">, (${response.lama_proses} Hari Kerja) <br>terhitung dari tanggal verifikasi kelengkapan berkas</i></p>`);
						if (response.id_jenis_permohonan == 11) {
                            $('.fungsi-bangunan').css('display', 'none');
                            $('.bangunan-kolektif').css('display', 'block');
							$('.prasarana').css('display', 'none');
							$('.pertashop').css('display', 'none');
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
                        } else if(response.id_jenis_permohonan == 12 || response.id_jenis_permohonan == 35 ||response.id_jenis_permohonan == 36){
							$('.prasarana').css('display', 'block');
							$('.fungsi-bangunan').css('display', 'none');
                            $('.bangunan-kolektif').css('display', 'none');
							$('.pertashop').css('display', 'none');
						} else if (response.id_jenis_permohonan == 34){
							$('.prasarana').css('display', 'none');
							$('.fungsi-bangunan').css('display', 'none');
                            $('.bangunan-kolektif').css('display', 'none');
							$('.pertashop').css('display', 'block');
						}else{
                            $('.fungsi-bangunan').css('display', 'block');
                            $('.bangunan-kolektif').css('display', 'none');
							$('.prasarana').css('display', 'none');
							$('.pertashop').css('display', 'none');
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
		$(document).on('click', '.form-penugasan', function(e) {
			e.preventDefault();
			let dataDetail = $(this).data('id'),
				stats = $(this).data('stats');
			$.ajax({
				type: "POST",
				url: `${site_url}Penugasan/FormPenugasan`,
				dataType: 'json',
				data: {
					id: dataDetail
				},
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
						$(".alamat-bangunan").html(`${response.almt_bgn}, Kel/Desa. ${response.nama_kel_bg}, Kec. ${response.nama_kec_bg},${response.nama_kabkota_bg}, ${response.nama_provinsi_bg}`);
						$(".fungsi-bangunan-gedung").html(`${response.fungsi_bg}`);
						$(".luas-tinggi-lantai").html(`${response.luas_bgn} m<sup>2</sup>, dengan tinggi ${response.tinggi_bgn} meter, dan berjumlah ${response.jml_lantai} lantai.`);
						$(".tgl-periode").html(`<p><span class="font-blue">${response.tgl_pernyataan}</span> <i class="text-tot">sampai dengan</i> <span class="font-blue">${response.hasil_tgl}</span> <i class="text-tot">, (${response.lama_proses} Hari Kerja) <br>terhitung dari tanggal verifikasi kelengkapan berkas</i></p>`);
						$(".luas-tinggi").html(`${response.luas_bgp} m<sup>2</sup>, dengan tinggi ${response.tinggi_bgp} meter`);
						$(".luas-prasarana").html(response.luas_bgp);
						$(".tinggi-prasarana").html(response.tinggi_bgp);
						$(".jenis-prasarana").html(response.jns_prasarana);
						if (response.id_jenis_permohonan == 11) {
								$('.prasarana').css('display', 'none');
                                $('.fungsi-bangunan').css('display', 'none');
                                $('.bangunan-kolektif').css('display', 'block');
								$('.pertashop').css('display', 'none');
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
                            } else  if(response.id_jenis_permohonan == 12){
								$('.prasarana').css('display', 'block');
								$('.fungsi-bangunan').css('display', 'none');
                                $('.bangunan-kolektif').css('display', 'none');
							}else if(response.id_jenis_permohonan == 34){
								$('.prasarana').css('display', 'none');
								$('.fungsi-bangunan').css('display', 'none');
                                $('.bangunan-kolektif').css('display', 'none');
								$('.pertashop').css('display', 'block');
							}else if (response.id_jenis_permohonan == 35){
								$('.prasarana').css('display', 'none');
								$('.fungsi-bangunan').css('display', 'none');
                                $('.bangunan-kolektif').css('display', 'none');
								$('.pertashop').css('display', 'block');
							}else if(response.id_jenis_permohonan == 36){
								$('.prasarana').css('display', 'none');
								$('.fungsi-bangunan').css('display', 'none');
                                $('.bangunan-kolektif').css('display', 'none');
								$('.pertashop').css('display', 'block');
							}else{
								$('.prasarana').css('display', 'none');
                                $('.fungsi-bangunan').css('display', 'block');
                                $('.bangunan-kolektif').css('display', 'none');
								$('.pertashop').css('display', 'none');
                            }
						
						$(".daftar-tim-penugasan").html(response.daftar_tim_penugasan);
						var table;
						if (response.tim_petugas != 0) {
							response.tim_petugas.forEach(obj => {
								table += '<tr class="clcenter">';
								table += `<td><input type="checkbox" name="cek_petugas[]" data-id="${obj.id_personal}" /></td>`;
								table += `<td>${obj.nama_peg}</td>`;
								table += `<td>${obj.nama_unsur}</td>`;
								table += `<td>${obj.nama_bidang}</td>`;
								table += `<td>${obj.nama_keahlian}</td>`;
							});
							$('.tim-petugas').html(table);
						} else{
							$('.tim-petugas').html('');
						}
						$('#idPemilik').val(response.id_pemilik);
						$('#noKonsultasi').val(response.no_konsultasi);
						$('#statsPenugasan').val(stats);

					} else {
						showToast(response.message, 15000, response.type);
						Metronic.unblockUI();
					}
					$('#modalPenugasan').modal('show');
				}
			});
		});

		$(document).on('click', '.simpan-penugasan', function(e) {
			e.preventDefault();
			var l = Ladda.create(this),
				totalCeklist = [],
				idPemilik = $('#idPemilik').val(),
				noKonsultasi = $('#noKonsultasi').val(),
				statsPenugasan = $('#statsPenugasan').val();
			$.each(($('.tim-petugas').find('input[type=checkbox]:checked')), function() {
				var id = $(this).data('id');
				totalCeklist.push({
					'id': id,
				});
			});
			l.start();
			$(".btn-cancel").attr("disabled", true);
			if (totalCeklist.length > 0) {
				$.ajax({
					type: 'POST',
					url: `${base_url}Penugasan/SimpanPenugasan`,
					data: {
						penugasan: totalCeklist,
						idPemilik: idPemilik,
						noKonsultasi: noKonsultasi,
						statsPenugasan: statsPenugasan,
					},
					success: function(response) {
						setTimeout(function() {
							showToast(response.message, 15000, response.type);
							l.stop();
							$(".btn-cancel").removeAttr("disabled");
							$('#modalPenugasan').modal('hide');
							let a = $(`[data-id="${response.dataId}"]`);
							let b = a.next();
							let c = a.parent();
							let d = c.prev().find('span.label');
							let e = c.parent('tr');
							e.removeClass('danger').addClass('success');
							d.removeClass('label-danger').addClass('label-success').text(`Sudah Dilakukan Penugasan ${response.typePenugasan}`);
							d.find('span').removeClass('label-success');
							b.html(`<a href="javascript:;" class="btn btn-info btn-sm detail-penugasan" title="Lihat Data" data-id="${response.dataId}"><span class="glyphicon glyphicon-user"></span></a>`)
							a.remove();
						}, 1500);
					},
				});
			} else {
				setTimeout(function() {
					$(".btn-cancel").removeAttr("disabled");
					showToast('Silahkan pilih petugas salah satu!', 15000, 'error');
					l.stop();
				}, 1500);
			}
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