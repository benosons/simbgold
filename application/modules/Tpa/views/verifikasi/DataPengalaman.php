<form action="<?php echo site_url('tpa/savePengalaman'); ?>" class="form-horizontal" role="form" method="post" id="FormPengalaman" enctype="multipart/form-data">
	<div class="col-md-12 ">
		<input type="hidden" class="form-control" value="<?php echo set_value('id', (isset($DataTpa->id) ? $DataTpa->id : '')) ?>" name="id" placeholder="Jurusan" autocomplete="off">
		<input type="hidden" class="form-control" value="" name="id_riwpeng" id="id_riwpeng">
		<div class="form-group">
			<label class="col-md-3 control-label">Kabupaten/Kota</label>
			<div class="col-md-6">
				<?php $kabkot = ['' => '-- Pilih Kabupaten / Kota --'];
				foreach ($opt_kabkota->result() as $key) {
					$kabkot[$key->id_kabkot] = $key->nama_kabkota;
				}
				echo form_dropdown('id_kabkot', $kabkot, '', 'id="id_kabkot" class="form-control select2"');
				?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">No. SK</label>
			<div class="col-md-8">
				<input type="text" class="form-control" value="<?php echo set_value('no_sk', (isset($DataTpa->no_sk) ? $DataTpa->no_sk : '')) ?>" name="no_sk" id="no_sk" placeholder="No. SK" autocomplete="off">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">File SK TPA/TABG</label>
			<div class="col-md-8">
				<div class="fileinput fileinput-new" data-provides="fileinput">
					<?php
					if (isset($DataTpa->dir_file_sk) != '') {
						$file = base_url() . 'file/tpa/' . $DataTpa->id . '/sk/' . $DataTpa->dir_file_sk;
						$name = 'Ubah Fle';
						echo '<div class="fileinput-new thumbnail">';
						echo '<a href="' . $file . '" target="_blank" alt="" class="btn default blue-stripe">Lihat</a>';
						echo '</div>';
					} else { ?>
						<input type="file" name="dir_file" id="dir_file">
						<p id="nm_filepengalaman"></p>
						<input type="hidden" name="dir_pengalaman" id="dir_pengalaman">
					<?php } ?>

				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label"></label>
			<div class="col-md-2">
				<button type="submit" class="btn green">Simpan</button>
			</div>
			<div class="col-md-2" id="batal_peng">
				<input type="button" name="back" value="Batal" onclick="batal_peng()" class="btn red">
			</div>
		</div>
	</div>
</form>
<div class="table-scrollable">
	<table class="table table-bordered table-striped table-hover" id="sample_editable_1">
		<thead>
			<tr class="warning">
				<th>
					<center>No.</center>
				</th>
				<th>
					<center>Kabupaten/Kota</center>
				</th>
				<th>
					<center>No. SK /Tahun</center>
				</th>
				<th>
					<center>Berkas</center>
				</th>
				<th>
					<center>Aksi</center>
				</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$no = 1;
			if ($DataPengalaman->num_rows() > 0) {
				foreach ($DataPengalaman->result() as $dtpeng) {
			?>
					<tr class="list_peng<?= $dtpeng->id_riwpeng; ?>">
						<td><?= $no++; ?></td>
						<td><?= $dtpeng->id_kabkot; ?></td>
						<td><?= $dtpeng->no_sk; ?></td>
						<td><?php if ($dtpeng->dir_file != '') { ?><a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/Pengalaman/' . $DataTpa->id . '/' . $dtpeng->dir_file); ?>')" class="btn default btn-xs blue-stripe">Lihat</a><?php } ?></td>
						<td><a onclick="editRiwPengalaman(<?= $dtpeng->id_riwpeng; ?>)" class="btn btn-warning btn-sm" title="Ubah Data"><span class="glyphicon glyphicon-pencil"></span></a> <a onclick="deleteRiwPeng(<?= $dtpeng->id_riwpeng; ?>)" class="btn btn-danger btn-sm" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a>
						</td>
					</tr>
			<?php
				}
			}
			?>
		</tbody>
	</table>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('#batal_peng').hide();

	});

	function editRiwPengalaman(v) {
		$.ajax({
			url: '<?php echo base_url() . index_page() ?>tpa/data_RiwPeng/' + v,
			dataType: 'json',
			success: function(data) {
				$('#id_riwpeng').val(data.id_riwpeng);
				$('#id_kabkot').val(data.id_kabkot).trigger('change');
				$('#no_sk').val(data.no_sk);
				$('#dir_pengalaman').val(data.dir_file);
				$('#nm_filepengalaman').html(data.dir_file);
				$('#batal_peng').show();
			}
		});
	}

	function deleteRiwPeng(v) {
		// jQuery.post(base_url + 'tpa/delete_RiwPen/' + v, function(data) {}, 'json')
		if (confirm('Apakah kamu yakin akan menghapus data ini ?')) {
			$.ajax({
				url: '<?php echo base_url() . index_page() ?>tpa/delete_RiwPeng/' + v,
				dataType: 'json',
				success: function(data) {
					if (data.status == "success") {
						alert("File Berhasil Di Delete");
						$(".list_peng" + v).remove();
					} else {
						alert(data.msg);
					}
				}
			});
		}
	}

	function batal_peng() {
		document.getElementById("FormPengalaman").reset();
		$('#id_kabkot').val('').trigger('change');
		$('#batal_peng').hide();
		$('#nm_filepengalaman').hide();
	}

	$("#FormPengalaman").validate({

		// Specify the validation rules
		rules: {
			id_kabkot: "required",
			no_sk: "required",

		},
		highlight: function(element) {
			$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
		},
		errorClass: 'help-block',

		// Specify the validation error messages
		messages: {
			id_kabkot: "Masukan Kota",
			no_sk: "Masukan No SK",
		},
		submitHandler: function(form) {
			form.submit();
		}
	});

	function popWin(x) {
		url = x;
		swin = window.open(url, 'win', 'scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	}
</script>