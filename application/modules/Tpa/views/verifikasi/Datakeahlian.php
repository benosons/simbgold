<script language="javascript" type="text/javascript">
	$(document).ready(function() {
		//let's create arrays
		var Arsitektur = [{
				display: "--Pilih--",
				value: ""
			},
			{
				display: "Hunian",
				value: 1
			},
			{
				display: "Highrise",
				value: 2
			},
			{
				display: "Rumah Sakit",
				value: 3
			},
			{
				display: "Komersial",
				value: 4
			},
			{
				display: "Hotel/Apartemen",
				value: 5
			},
			{
				display: "Cagar Budaya",
				value: 6
			},
			{
				display: "Bangunan Hijau",
				value: 7
			},
			{
				display: "BGN",
				value: 8
			},
			{
				display: "Dan lain-lain",
				value: 9
			}
		];

		var Struktur = [{
				display: "--Pilih--",
				value: ""
			},
			{
				display: "Upper Str",
				value: 1
			},
			{
				display: "Sub Str",
				value: 2
			},
			{
				display: "Dan lain-lain",
				value: 3
			}
		];

		var Mekanikal = [{
				display: "--Pilih--",
				value: ""
			},
			{
				display: "TDG (Transportasi dalam gedung)",
				value: 1
			},
			{
				display: "SDP (Sanitasi, Drainase Pemipaan)",
				value: 2
			},
			{
				display: "TUD (Tata Udara Gedung)",
				value: 3
			}
		];

		var Elektrikal = [{
				display: "--Pilih--",
				value: ""
			},
			{
				display: "LAK (Listrik Arus Kuat)",
				value: 1
			},
			{
				display: "LAL (Listrik Arus Lemah)",
				value: 2
			}
		];

		var TataRuangLuar = [{
			display: "--Pilih--",
			value: ""
		}];

		var parent2 = $(".parent_selection").val();

		switch (parent2) { //using switch compare selected option and populate child
			case '1':
				list2(Arsitektur);
				break;
			case '2':
				list2(Struktur);
				break;
			case '3':
				list2(Mekanikal);
				break;
			case '4':
				list2(Elektrikal);
				break;
			case '5':
				list2(TataRuangLuar);
				break;

			default: //default child option is blank
				$("#child_selection").html();
				break;
		}
		//If parent option is changed
		$(".parent_selection").change(function() {
			var parent = $(this).val(); //get option value from parent
			switch (parent) { //using switch compare selected option and populate child
				case '1':
					list(Arsitektur);
					break;
				case '2':
					list(Struktur);
					break;
				case '3':
					list(Mekanikal);
					break;
				case '4':
					list(Elektrikal);
					break;
				case '5':
					list(TataRuangLuar);
					break;

				default: //default child option is blank
					$("#child_selection").html();
					break;
			}
		});
		//function to populate child select box
		function list(array_list) {
			$("#child_selection").html(""); //reset child options

			$(array_list).each(function(i) { //populate child options
				$("#child_selection").append("<option value=\"" + array_list[i].value + "\">" + array_list[i].display + "</option>");
			});
		}

		function list2(array_list) {
			$(array_list).each(function(i) { //populate child options
				$("#child_selection").append("<option value=\"" + array_list[i].value + "\">" + array_list[i].display + "</option>");
			});
		}

	});
</script>
<form action="<?php echo site_url('tpa/saveKeahlian'); ?>" class="form-horizontal" role="form" method="post" id="FormKeahlian" enctype="multipart/form-data">
	<div class="col-md-12 ">
		<input type="hidden" class="form-control" value="<?php echo set_value('id', (isset($DataTpa->id) ? $DataTpa->id : '')) ?>" name="id" placeholder="id" autocomplete="off">
		<input type="hidden" class="form-control" value="" name="id_riwkeahlian" id="id_riwkeahlian">
		<input type="hidden" class="form-control" value="" name="spcl" id="spcl">
		<div class="form-group">
			<label class="col-md-3 control-label">Bidang Keahlian</label>
			<div class="col-md-8">
				<?php
				$js = 'id="id_keahlian" onchange="set_spesialist(this.value)" class="form-control"';
				echo form_dropdown('id_keahlian', $list_keahlian, isset($DataTpa->id_keahlian) ? $DataTpa->id_keahlian : '', $js);
				?>
			</div>
		</div>
		<div class="form-group" id="spesialist_toggle">
			<label class="control-label col-md-3">Spesialist <span class="required">* </span></label>
			<div class="col-md-7">
				<?php
				echo form_dropdown('spesialist', array('' => '--Pilih--'), isset($DataTpa->spesialist) ? $DataTpa->spesialist : '', 'id="spesialist" class="form-control"');

				?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Kualifikasi SKA</label>
			<div class="col-md-7">
				<?php
				echo form_dropdown('id_kualifikasi', $list_kualifikasi, isset($DataTpa->id_kualifikasi) ? $DataTpa->id_kualifikasi : '', 'class ="form-control" id="id_kualifikasi" ');
				?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Asal Kelembagaan</label>
			<div class="col-md-7">
				<?php $list_kelembagaan = array(
					"0" => "--Pilih--",
					"1" => "Asosiasi Profesi Khusus",
					"2" => "Perguruan Tinggi",
					"3" => "Lainnya",
				);
				echo form_dropdown('id_lembaga', $list_kelembagaan, isset($DataTpa->id_lembaga) ? $DataTpa->id_lembaga : '', 'class ="form-control" id="id_lembaga" ');
				?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Nama Asosiasi</label>
			<div class="col-md-8">
				<input type="text" class="form-control" value="<?php echo set_value('nm_asosiasi', (isset($DataTpa->nm_asosiasi) ? $DataTpa->nm_asosiasi : '')) ?>" name="nm_asosiasi" id="nm_asosiasi" placeholder="Nama Asosiasi" autocomplete="off">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">No. SKA</label>
			<div class="col-md-8">
				<input type="text" class="form-control" value="<?php echo set_value('no_ska', (isset($DataTpa->no_ska) ? $DataTpa->no_ska : '')) ?>" name="no_ska" id="no_ska" placeholder="No. SKA" autocomplete="off">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Masa Berlaku</label>
			<div class="col-md-8">
				<input type="text" class="form-control" value="<?php echo set_value('thn_berlaku', (isset($DataTpa->thn_berlaku) ? $DataTpa->thn_berlaku : '')) ?>" name="thn_berlaku" id="thn_berlaku" placeholder="Masa Berlaku" autocomplete="off">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">File SKA</label>
			<div class="col-md-8">
				<div class="fileinput fileinput-new" data-provides="fileinput">
					<?php
					if (isset($DataTpa->dir_file_ska) != '') {
						$file = base_url() . 'file/tpa/' . $DataTpa->id . '/ska/' . $DataTpa->dir_file_ska;
						$name = 'Ubah Fle';
						echo '<div class="fileinput-new thumbnail">';
						echo '<a href="' . $file . '" target="_blank" alt="" class="btn default blue-stripe">Lihat</a>';
						echo '</div>';
					} else { ?>
						<input type="file" name="dir_file" id="dir_file">
						<p id="nm_filekeahlian"></p>
						<input type="hidden" name="dir_keahlian" id="dir_keahlian">
					<?php } ?>

				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label"></label>
			<div class="col-md-2">
				<button type="submit" class="btn green">Simpan</button>
			</div>
			<div class="col-md-2" id="batal_keahlian">
				<input type="button" name="back" value="Batal" onclick="batal_keahlian()" class="btn red">
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
					<center>Bidang Keahlian</center>
				</th>
				<th>
					<center>Spesialis</center>
				</th>
				<th>
					<center>Asosiasi</center>
				</th>
				<th>
					<center>No. SKA / Masa Berlaku</center>
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
			if ($DataKeahlian->num_rows() > 0) {
				foreach ($DataKeahlian->result() as $dtk) {
					$keahlian =	$this->mglobals->getData('*', 'tr_keahlian', array('id_keahlian' => $dtk->id_keahlian))->row()->keahlian;
					$spesialis =	$this->mglobals->getData('*', 'tr_spesialis', array('id_keahlian' => $dtk->id_keahlian, 'id_spesialis' => $dtk->spesialist))->row()->spesialis;
			?>
					<tr class="list_keah<?= $dtk->id_riwkeahlian; ?>">
						<td><?= $no++; ?></td>
						<td><?= $keahlian; ?></td>
						<td><?= $spesialis; ?></td>
						<td><?= $dtk->nm_asosiasi; ?></td>
						<td><?= $dtk->no_ska; ?>/<?= $dtk->thn_berlaku; ?></td>
						<td><?php if ($dtk->dir_file != '') { ?><a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/Keahlian/' . $DataTpa->id . '/' . $dtk->dir_file); ?>')" class="btn default btn-xs blue-stripe">Lihat</a><?php } ?></td>
						<td><a onclick="editRiwKeahlian(<?= $dtk->id_riwkeahlian; ?>)" class="btn btn-warning btn-sm" title="Ubah Data"><span class="glyphicon glyphicon-pencil"></span></a>
							<a onclick="deleteRiwKeahlian(<?= $dtk->id_riwkeahlian; ?>)" class="btn btn-danger btn-sm" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a>
						</td>
					</tr>
			<?php }
			}
			?>
		</tbody>
	</table>
</div>
<script language="javascript" type="text/javascript">
	$(function() {
		$('#batal_keahlian').hide();
	});

	function set_spesialist(v) {
		var spcl = $('#spcl').val();
		$("#spesialist_toggle").fadeIn()
		jQuery.post(base_url + 'tpa/getDataSpesialis/' + v, function(data) {
			var spesialis = '<option value="">-- Pilih --</option>';
			jQuery.each(data, function(key, value) {

				if (value.id_spesialis == spcl) {
					select = "selected";
				} else {
					select = "";
				}
				spesialis += '<option value="' + value.id_spesialis + '" ' + select + ' > ' + value.spesialis + ' </option>';
			});
			jQuery('#spesialist').html(spesialis);
			$('#spesialist').prop("disabled", false);
		}, 'json');
	}
	$("#FormKeahlian").validate({
		rules: {
			id_keahlian: "required",
			spesialist: "required",
		},
		highlight: function(element) {
			$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
		},
		errorClass: 'help-block',

		messages: {
			id_keahlian: "Bidang Keahlian",
			spesialist: "Specialist",
		},
		submitHandler: function(form) {
			form.submit();
		}
	});

	function editRiwKeahlian(v) {
		$.ajax({
			url: '<?php echo base_url() . index_page() ?>tpa/data_RiwKeahlian/' + v,
			dataType: 'json',
			success: function(data) {
				$('#id_riwkeahlian').val(data.id_riwkeahlian);
				$('#spcl').val(data.spesialist);
				$('#id_keahlian').val(data.id_keahlian).trigger('change');
				// editspesialist(data.spesialist);
				$('#id_kualifikasi').val(data.id_kualifikasi).trigger('change');
				$('#id_lembaga').val(data.id_lembaga).trigger('change');
				$('#nm_asosiasi').val(data.nm_asosiasi);
				$('#no_ska').val(data.no_ska);
				$('#thn_berlaku').val(data.thn_berlaku);
				$('#dir_keahlian').val(data.dir_file);
				$('#nm_filekeahlian').html(data.dir_file);
				$('#batal_keahlian').show();
			}
		});
	}

	function deleteRiwKeahlian(v) {
		// jQuery.post(base_url + 'tpa/delete_RiwPen/' + v, function(data) {}, 'json')

		if (confirm('Apakah kamu yakin akan menghapus data ini ?')) {
			$.ajax({
				url: '<?php echo base_url() . index_page() ?>tpa/delete_RiwKeahlian/' + v,
				dataType: 'json',
				success: function(data) {
					if (data.status == "success") {
						alert("File Berhasil Di Delete");
						$(".list_keah" + v).remove();
					} else {
						alert(data.msg);
					}
				}
			});
		}
	}

	function batal_keahlian() {
		document.getElementById("FormKeahlian").reset();
		$('#batal_keahlian').hide();
		set_spesialist();
	}
</script>