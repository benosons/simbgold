<div class="table-scrollable">
	<table class="table table-bordered table-striped table-hover" id="sample_editable_1">
		<thead>
			<tr class="warning">
				<th><center>No.</center></th>
				<th><center>Jenjang Pendidikan<br> Jurusan</center></th>
				<th><center>Nama Perguruan Tinggi</center></th>
				<th><center>No. Ijazah & Tahun</center></th>
				<th><center>Berkas</center></th>
				<th><center>Aksi</center>
				</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$no = 1;
			if($DataPendidikan->num_rows() > 0){
				foreach($DataPendidikan->result() as $dtp){ ?>
					<tr class="list_<?= $dtp->id_riwpend; ?>">
						<td><?= $no++; ?></td>
						<td><?= $dtp->jurusan; ?></td>
						<td><?= $dtp->nm_sekolah; ?></td>
						<td><?= $dtp->no_ijazah; ?></td>
						<td><a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/Pendidikan/' . $DataTpa->id . '/' . $dtp->dir_file); ?>')" class="btn default btn-xs blue-stripe">Lihat</a></td>
						<td><a onclick="editRiwPen(<?= $dtp->id_riwpend; ?>)" class="btn btn-warning btn-sm" title="Ubah Data"><span class="glyphicon glyphicon-pencil"></span></a>
						<a onclick="deleteRiwPen(<?= $dtp->id_riwpend; ?>)" class="btn btn-danger btn-sm" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a>
						</td>
					</tr>
				<?php }
			} ?>
		</tbody>
	</table>
</div>
<script type="text/javascript">
	$(function() {
		$('.select2').select2();
		$('#batal').hide();
	});

	function getjurusan(v) {
		jQuery.post(base_url + 'Tpa/getDataJurusan/' + v, function(data) {
			var nama_jurusan = '';
			jQuery.each(data, function(key, value) {
				nama_jurusan += '<option value="' + value.id_jurusan + '"> ' + value.nama_jurusan + ' </option>';
			});
			jQuery('#nama_jurusan').html(nama_jurusan);
		}, 'json');
	}

	function batal(){
		document.getElementById("FormPendidikan").reset();
		$( '#batal' ).hide();
		$( '#nm_filepend' ).hide();
	} 

	$("#FormPendidikan").validate({
		rules: {
			jurusan: "required",
			nm_sekolah: "required",
			id_jenjang: "required",
			no_ijazah: {
				minlength: 6,
				required: true,
			},
		},
		highlight: function(element) {
			$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
		},
		errorClass: 'help-block',
		messages: {
			jurusan: "Masukan Nama Jurusan",
			nm_sekolah: "Masukan Nama Sekolah / Perguruan Tinggi",
			no_ijazah: {
				required: "Ijazah Wajib diisi",
				minlength: "Nomor Ijazah minimal 6 karakter",
			},
			id_jenjang: "Pilih Jenjang Pendidikan",

		},
		submitHandler: function(form) {
			form.submit();
		}
	});
</script>
