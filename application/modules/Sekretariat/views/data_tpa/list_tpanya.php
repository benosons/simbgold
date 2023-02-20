<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
<div class="portlet light margin-top-20" style="min-height:550px;">
	<div class="portlet-title tabbable-line">
		<div class="caption caption-md">
			<i class="icon-globe theme-font hide"></i>
			<span class="caption-subject text-primary bold uppercase">
				<i class=""></i>List Data TPA Sekretariat
			</span>
		</div>
		<div class="actions">
		<a href="<?php echo site_url('Sekretariat/Pilih_Tpa/'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Pilih TPA dari Database TPA</a>

		</div>
	</div>
	<div class="portlet-body">
		<div class="">
			<? if (count($data_tpa) > 0) { ?>
				<table class="table table-bordered btable">
					<thead>
						<tr class="warning">
							<th style="text-align:center;width:5%">#</th>
							<th>Nama Lengkap</th>
							<th>Unsur</th>
							<th>Keahlian</th>
							<th style="text-align:center;width:5%">Detail</th>
							<th style="text-align:center;width:5%">Aksi</th>
						</tr>
					</thead>
					<tbody id="show_data">

					</tbody>
				</table>


			<? } else { ?>

				<!--<blockquote><br>
				<p>
					<b><?php echo $nama_kabkota; ?> Belum Memilih TPA !
					<br>Silahkan Klik Tombol Dibawah ini Untuk Memilih TPA.</b>
				</p>
				s<a href="<?php echo site_url('Sekretariat/Pilih_Tpa/'); ?>" class="btn btn-primary btn-large"><i class="fa fa-plus"></i> Pilih TPA </a> <br>
			</blockquote>-->

			<? } ?>

		</div>

	</div>
</div>

<!--MODAL HAPUS-->
<div id="ModalHapus" class="modal fade" tabindex="-1" aria-hidden="true" data-width="30%" data-backdrop="static" data-keyboard="false">
	<div class="modal-content">
		<form class="form-horizontal">
			<div class="modal-body">
				<input type="hidden" name="kode" id="textkode" value="">
				<b>Apakah Anda yakin menghapus TPA ini ?</b>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-warning btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
				<button class="btn_hapus btn btn-danger btn-sm" id="btn_hapus"><i class="fa fa-trash-o"></i> Hapus</button>
			</div>
		</form>
	</div>

</div>
<!--END MODAL HAPUS-->
<!-- MODAL DETAIL -->
<div id="ModalDetail" class="modal fade" tabindex="-1" aria-hidden="true" data-width="50%" data-backdrop="static" data-keyboard="false">

	<div class="modal-content">
		<div class="modal-body">
			<div id="content">
				<div class="portlet-title">
					<h5 class="caption-subject font-blue bold uppercase">Detail TPA</h5>
					<div class="row static-info">
						<div class="col-md-3 name">
							Nama Lengkap :
						</div>
						<div class="col-md-9 value nm-tpa"></div>
					</div>
					<div class="row static-info">
						<div class="col-md-3 name">
							Alamat :
						</div>
						<div class="col-md-9 value alamat"></div>
					</div>
					<div class="row static-info">
						<div class="col-md-3 name">
							Tempat Lahir :
						</div>
						<div class="col-md-9 value tmpt-lahir"></div>
					</div>
					<div class="row static-info">
						<div class="col-md-3 name">
							Tanggal Lahir :
						</div>
						<div class="col-md-9 value tgl-lahir"></div>
					</div>
					<div class="row static-info">
						<div class="col-md-3 name">
							Email :
						</div>
						<div class="col-md-9 value email"></div>
					</div>
					<div class="row static-info">
						<div class="col-md-3 name">
							No Telp :
						</div>
						<div class="col-md-9 value no-kontak"></div>
					</div>
					<div class="row static-info">
						<div class="col-md-3 name">
							Unsur :
						</div>
						<div class="col-md-9 value unsur"></div>
					</div>
					<div class="row static-info">
						<div class="col-md-3 name">
							Keahlian :
						</div>
						<div class="col-md-9 value keahlian"></div>
					</div>
					<div class="row static-info">
						<div class="col-md-3 name">
							Sertifikat Ahli :
						</div>
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

		tampil_data_TPA();

		$(".btableX").DataTable({
			'columnDefs': [{
				//'targets': [0, 2, 3, 4, 5],
				/* column index */
				'orderable': false,
				/* true or false */
			}],

			"language": {
				"aria": {
					"sortAscending": ": activate to sort column ascending",
					"sortDescending": ": activate to sort column descending"
				},

				"emptyTable": "<br><b>Data TPA Tidak Ditemukan<br>Silahkan Klik Tombol Pilih Untuk Memilih TPA<b>",
				"info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ jumlah data",
				"infoEmpty": "Data Tidak Ditemukan",
				"infoFiltered": "",
				"lengthMenu": "Tampilkan _MENU_ Data",
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

		function tampil_data_TPA() {

			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url() ?>Sekretariat/Tampilin_Tpa',
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
							'<td style="text-align:center;">' +
							'<a href="javascript:;" class="btn btn-success btn-xs item_detail" data="' + data[i].id + '">Lihat</a>' +
							'</td>' +
							'<td>' +
							'<a href="javascript:;" class="btn btn-danger btn-xs item_hapus" data="' + data[i].id_nya + '">Hapus</a>' +
							'</td>' +
							'</tr>';
					}
					$('#show_data').html(html);
				}
			});

		}

		//Konfirmasi Hapus
		$('#show_data').on('click', '.item_hapus', function() {
			var id = $(this).attr('data');
			$('#ModalHapus').modal('show');
			$('[name="kode"]').val(id);
		});

		//Pilih TPA
		$('#btn_hapus').on('click', function() {
			var kode = $('#textkode').val();
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('Sekretariat/Pilih_Hapus_Tpa') ?>",
				dataType: "JSON",
				data: {
					kode: kode
				},
				success: function(data) {
					$('#ModalHapus').modal('hide');
					tampil_data_TPA();
					toastr.success('TPA Berhasil Terhapus !', '', {
						positionClass: "toast-bottom-right",
						timeOut: 3000
					});


				}
			});
			return false;
		});

		$('#show_data').on('click', '.item_detail', function() {
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

	});
	function popWin(x) {
		url = x;
		swin = window.open(url, 'win', 'scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
		swin.focus();
	}
</script>