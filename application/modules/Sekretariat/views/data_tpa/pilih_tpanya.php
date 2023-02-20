<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
<div class="portlet light margin-top-20" style="min-height:550px;">
	<div class="portlet-title tabbable-line">
		<div class="caption caption-md">
			<i class="icon-globe theme-font hide"></i>
			<span class="caption-subject text-primary bold uppercase"><i class=""></i>List Data TPA Seluruh Indonesia</span>
		</div>
		<div class="actions"><a href="<?php echo site_url('Sekretariat/Data_Tpa/'); ?>" class="btn btn-success"><i class="fa fa-save"></i> Selesai </a></div>
	</div>
	<div class="portlet-body">
		<div class="form-actions">
			<form id="formFilter">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group col-md-12">
							<label class="control-label col-md-2"><b>Unsur</b></label>
							<div class="col-md-9">
								<div class="col-md-5">
									<select class="form-control select2me" name="unsur" id="unsurLembaga">
										<option value="">Semua Unsur</option>
										<?php foreach ($unsur as $u) : ?>
											<option value="<?= $u->id_lembaga; ?>"><?= $u->nama_lembaga; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group col-md-12">
							<label class="control-label col-md-2"><b>Provinsi</b></label>
							<div class="col-md-9">
								<div class="col-md-5">
									<select class="form-control select2me" name="provinsi" id="provinsi">
										<option value="">Semua Provinsi</option>
										<?php if ($daftar_provinsi->num_rows() > 0) {
											foreach ($daftar_provinsi->result() as $key) {
												echo '<option value="' . $key->id_provinsi . '">' . $key->nama_provinsi . '</option>';
											}
										} ?>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group col-md-12">
							<label class="control-label col-md-2"><b>Kabupaten/Kota</b></label>
							<div class="col-md-9">
								<div class="col-md-5">
									<select class="form-control select2me" name="kabkota" id="dataKabkota">
										<option value="">Semua Kabupaten/Kota</option>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group col-md-12">
							<label class="control-label col-md-2"><b></b></label>
							<div class="col-md-9">
								<div class="col-md-12">
									<input type="button" class="btn btn-primary" id="btnFilter" value="Filter">
									<button type="button" class="btn btn-default" id="btnReset">Reset</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		<table class="table table-hover table-bordered btable" id="myTable">
			<thead>
				<tr class="info">
					<th>#</th>
					<th>Nama Lengkap</th>
					<th>Unsur</th>
					<th>Provinsi</th>
					<th>Kabupaten/Kota</th>
					<th>Aksi</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
<!--MODAL Pilih-->
<div id="ModalPilih" class="modal fade" tabindex="-1" aria-hidden="true" data-width="30%" data-backdrop="static" data-keyboard="false">
	<div class="modal-content">
		<form class="form-horizontal">
			<div class="modal-body">
				<input type="hidden" name="kode" id="textkode" value="">
				<b>Apakah Anda yakin memilih TPA ini ?</b>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-warning btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
				<button class="btn_pilih btn btn-success btn-sm" id="btn_pilih"><i class="fa fa-save"></i> Pilih</button>
			</div>
		</form>
	</div>
</div>
<!--END MODAL Pilih-->
<!-- MODAL DETAIL -->
<div id="ModalDetail" class="modal fade" tabindex="-1" aria-hidden="true" data-width="50%" data-backdrop="static" data-keyboard="false">
	<div class="modal-content">
		<div class="modal-body">
			<div id="content">
				<div class="portlet-title">
					<h5 class="caption-subject font-blue bold uppercase">Detail TPA</h5>
					<div class="row static-info">
						<div class="col-md-3 name">Nama Lengkap</div>
						<div class="col-md-9 value nm-tpa"></div>
					</div>
					<div class="row static-info">
						<div class="col-md-3 name">Alamat</div>
						<div class="col-md-9 value alamat"></div>
					</div>
					<div class="row static-info">
						<div class="col-md-3 name">Tempat Lahir</div>
						<div class="col-md-9 value tmpt-lahir"></div>
					</div>
					<div class="row static-info">
						<div class="col-md-3 name">Tgl. Lahir</div>
						<div class="col-md-9 value tgl-lahir"></div>
					</div>
					<div class="row static-info">
						<div class="col-md-3 name">E-mail</div>
						<div class="col-md-9 value email"></div>
					</div>
					<div class="row static-info">
						<div class="col-md-3 name">No. Telp</div>
						<div class="col-md-9 value no-kontak"></div>
					</div>
					<div class="row static-info">
						<div class="col-md-3 name">Unsur</div>
						<div class="col-md-9 value unsur"></div>
					</div>
					<div class="row static-info">
						<div class="col-md-3 name">Keahlian</div>
						<div class="col-md-9 value keahlian"></div>
					</div>
					<div class="row static-info">
						<div class="col-md-3 name">Sertifikat Ahli</div>
						<div class="col-md-9 value sertifikat"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn btn-primary" onclick=""><i class="fa fa-sign-out"></i> Tutup</button>
		</div>
	</div>
</div>
<!-- END MODAL DETAIL -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
	var site_url = '<?php echo site_url(); ?>';
	$(document).ready(function() {
		tampil_data_pilihTPA(); //pemanggilan fungsi tampil barang.
		//$('#mydata').dataTable();
		$('#btnFilter').click(function() {
			table.ajax.reload();
		});
		$('#btnReset').click(function() {
			$(':input', '#formFilter')
				.not(':button, :submit, :reset, :hidden')
				.val('')
				.prop('checked', false)
				.prop('selected', false)
			table.ajax.reload();
		});
		table = $("#myTable").DataTable({
			processing: true,
			serverSide: true,
			destroy: true,
			language: {
				aria: {
					sortAscending: ": activate to sort column ascending",
					sortDescending: ": activate to sort column descending"
				},
				emptyTable: "<br><b>Data TPA Tidak Ditemukan<br>Silahkan Klik Tombol Pilih Untuk Memilih TPA<b>",
				info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ jumlah data",
				infoEmpty: "Data Tidak Ditemukan",
				infoFiltered: "",
				lengthMenu: "Tampilkan _MENU_ Baris",
				search: "Cari:",
				zeroRecords: "Data Tidak Ditemukan",
				oPaginate: {
					sNext: 'Selanjutnya',
					sLast: 'Terakhir',
					sFirst: 'Pertama',
					sPrevious: 'Sebelumnya'
				}
			},
			ajax: {
				url: `${site_url}Sekretariat/Tampil_Pilih_Tpa`,
				type: "POST",
				data: function(data) {
					data.lembaga = $('#unsurLembaga').val();
					data.provinsi = $('#provinsi').val();
					data.kabkota = $('#dataKabkota').val();
				}
			},
			columns: [{
					"data": 'id',
					name: 'id',
					render: function(data, type, row, meta) {
						return meta.row + meta.settings._iDisplayStart + 1;
					}
				},
				{
					"data": "nm_tpa"
				},
				{
					"data": "nama_lembaga"
				},
				{
					"data": "nama_provinsi",
				},
				{
					"data": "nama_kabkota",
				},
				{
					"data": null,
				},
			],
			columnDefs: [{
					data: {
						'id': 'id'
					},
					targets: 5,
					orderable: false,
					searchable: false,
					render: function(data, type, row, meta) {
						return `<a href="javascript:;" class="btn btn-primary btn-sm item-detail" data="${data.id}">Lihat</a>
						<a href="javascript:;" class="btn btn-success btn-sm item_pilih" data="${data.id}">Pilih</a>`;
					}
				},
				{
					targets: 0,
					searchable: false,
				},
			],
			"createdRow": function(row, data, index) {
				$('td', row).eq(1).html(`${data.glr_depan} ${data.nm_tpa} ${data.glr_blkg}`);
			},
		});
		function tampil_data_pilihTPA() {
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url() ?>Sekretariat/Tampil_Pilih_Tpa',
				async: false,
				dataType: 'json',
				//cache	: false,
				success: function(data) {
					var html = '';
					var i;
					var no = 1;
					var unsur = '';
					for (i = 0; i < data.length; i++, no++) {
						if (data[i].id_lembaga == 1) {
							unsur = 'Akademisi';
						} else if (data[i].id_lembaga == 2) {
							unsur = 'Pakar';
						} else {
							unsur = 'Profesi Ahli';
						}
						html += '<tr>' +
							'<td style="text-align:center;">' + no + '</td>' +
							'<td>' + data[i].glr_depan + ' ' + data[i].nm_tpa + ' ' + data[i].glr_blkg + '</td>' +
							'<td>' + unsur + '</td>' +
							'<td>' + '-' + '</td>' +
							'<td>' + data[i].nama_kabkota + '</td>' +
							'<td style="text-align:center;">' +
							'<a href="javascript:;" class="btn btn-warning btn-xs item_detail" data="' + data[i].id + '">Lihat</a>' +
							'</td>' +
							'<td>' +
							'<a href="javascript:;" class="btn btn-success btn-xs item_pilih" data="' + data[i].id + '">Pilih</a>' +
							'</td>' +
							'</tr>';
					}
					$('#show_data').html(html);
				}
				//.reload();
			});
		}
		//Konfirmasi Pilih
		$(document).on('click', '.item_pilih', function(e) {
			var id = $(this).attr('data');
			$('#ModalPilih').modal('show');
			$('[name="kode"]').val(id);
		});
		//Pilih TPA
		$('#btn_pilih').on('click', function() {
			var kode = $('#textkode').val();
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('Sekretariat/Pilih_Simpan_Tpa') ?>",
				dataType: "JSON",
				data: {
					kode: kode
				},
				success: function(data) {
					$('#ModalPilih').modal('hide');
					tampil_data_pilihTPA();
					toastr.success('TPA Berhasil Terpilih !', '', {
						positionClass: "toast-bottom-right",
						timeOut: 3000
					});
				}
			});
			return false;
		});
		$(document).on('click', '.item-detail', function(e) {
			var id = $(this).attr('data');
			$.ajax({
				type: "POST",
				url: `${site_url}DataDetail/DetailTPA`,
				data: {
					id: id
				},
				dataType: "json",
				success: function(response) {
					$(".nm-tpa").html(response.nama);
					$(".alamat").html(response.alamat);
					$(".unsur").html(response.unsur);
					$(".keahlian").html(response.keahlian);
					$(".tgl-lahir").html(response.tgl_lahir);
					$(".tmpt-lahir").html(response.tmpt_lahir);
					$(".email").html(response.email);
					$(".no-kontak").html(response.no_kontak);

					let berkas = response.dir_file == false ? 'Tidak ada dokumen' : `<a href="javascript:void(0);" class="btn default btn-xs blue-stripe" title="Lihat Berkas" onclick="javascript:popWin('${site_url}file/Tpa/${response.id}/${response.dir_file}')">Lihat</a>`;
					$('.sertifikat').html(berkas);
				}
			});
			$('#ModalDetail').modal('show');
		});

		$('#provinsi').change(function() {
			var v = $(this).val();
			var select = "<?= isset($id_kabkota) ? $id_kabkota : ""; ?>";
			jQuery.post(base_url + 'Sekretariat/getDataKabKota/' + v, function(data) {
				$('select[name="kabkota"]').empty();
				$.each(data, function(key, value) {
					if (select == value.id_kabkot) {
						$('select[name="kabkota"]').append('<option value="' + value.id_kabkot + '" selected>' + value.nama_kabkota + '</option>').trigger('change');
					} else {
						$('select[name="kabkota"]').append('<option value="' + value.id_kabkot + '">' + value.nama_kabkota + '</option>');
					}
				});
			}, 'json');
		});

	});

	function popWin(x) {
		url = x;
		swin = window.open(url, 'win', 'scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
		swin.focus();
	}
</script>