<?php
isset($tpa) ? $DataTpa = $tpa->row() : '';
isset($pendidikan) ? $data['DataPendidikan'] = $pendidikan : $data['DataPendidikan'] = '';
?>
<div class="portlet light margin-top-20">
	<div class="portlet-title tabbable-line">
		<div class="caption caption-md">
			<i class="icon-globe theme-font hide"></i>
			<span class="caption-subject font-blue-madison bold uppercase">Data Diri</span>
		</div>
	</div>
	<div class="portlet-body">
		<div>
			<?php echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-' . $this->session->flashdata('status') . '">' .
				$this->session->flashdata('message') . '<button class="close" data-close="alert">' . '</button>' . '</div>' : '';
			?>
		</div>

		<div id="pluspersonil" style="display: block;">
			<br>
			<div class="portlet box red">
				<div class="portlet-title">
					<div class="caption">
						Riwayat Pendidikan
					</div>
				</div>
				<div class="portlet-body">
					<form action="<?php echo site_url('TenagaAhli/savePendidikan'); ?>" class="form-horizontal" role="form" method="post" id="FormPendidikan" enctype="multipart/form-data">
						<div class="col-md-12 ">
							<div class="form-group">
								<label class="col-md-3 control-label">Jenjang Pendidikan</label>
								<input type="hidden" class="form-control" value="<?php echo set_value('id', (isset($DataTpa->id) ? $DataTpa->id : '')) ?>" name="id" placeholder="id" autocomplete="off">
								<input type="hidden" class="form-control" value="" name="id_riwpend" id="id_riwpend">
								<div class="col-md-4">
									<select name="id_jenjang" id="id_jenjang" class="form-control select2" data-placeholder="Select..." onchange="getjurusan(this.value)">
										<option value="">--Pilih--</option>
										<?php if ($jenjang->num_rows() > 0) {
											foreach ($jenjang->result() as $key) {
												if ($key->id_jenjang == $DataTpa->id_jenjang) {
													$plhrole = "selected";
												} else {
													$plhrole = "";
												}
												echo '<option value="' . $key->id_jenjang . '" ' . $plhrole . '>' . $key->nama_jenjang . '</option>';
											}
										} ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Jurusan</label>
								<div class="col-md-6">
									<input type="text" class="form-control" value="<?php echo set_value('jurusan', (isset($DataTpa->jurusan) ? $DataTpa->jurusan : '')) ?>" name="jurusan" id="jurusan" placeholder="Jurusan Pendidikan" autocomplete="off">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Nama Institusi Pendidikan</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?php echo set_value('nm_sekolah', (isset($DataTpa->nm_sekolah) ? $DataTpa->nm_sekolah : '')) ?>" name="nm_sekolah" id="nm_sekolah" placeholder="Nama Sekolah/Perguruan Tinggi" autocomplete="off">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">No. Ijazah</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?php echo set_value('no_ijazah', (isset($DataTpa->no_ijazah) ? $DataTpa->no_ijazah : '')) ?>" name="no_ijazah" id="no_ijazah" placeholder="No. Ijazah" autocomplete="off">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Tahun Lulus</label>
								<div class="col-md-8">
									<input type="text" maxlength="4" class="allownumericwithoutdecimal form-control" value="<?php echo set_value('thn_lulus', (isset($DataTpa->thn_lulus) ? $DataTpa->thn_lulus : '')) ?>" name="thn_lulus" id="thn_lulus" placeholder="Tahun Kelulusan" autocomplete="off">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">File Ijazah</label>
								<div class="col-md-8">
									<div class="fileinput fileinput-new" data-provides="fileinput">
										<?php
										if (isset($DataTpa->dir_file_ijazah) != '') {
											$file = base_url() . 'file/tpa/' . $DataTpa->id . '/pendidikan/' . $DataTpa->dir_file_ijazah;
											$name = 'Ubah Fle';
											echo '<div class="fileinput-new thumbnail">';
											echo '<a href="' . $file . '" target="_blank" alt="" class="btn default blue-stripe">Lihat</a>';
											echo '</div>';
										} else { ?>
											<input type="file" name="dir_file" id="dir_file">
											<p id="nm_filepend"></p>
											<input type="hidden" name="dir_pendidikan" id="dir_pendidikan">
										<?php } ?>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label"></label>
								<div class="col-md-2">
									<button type="submit" class="btn green">Simpan</button>
								</div>
								<div class="col-md-2" id="batal">
									<input type="button" name="back" value="Batal" onclick="batal()" class="btn red">
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
										<center>Jenjang Pendidikan<br> Jurusan</center>
									</th>
									<th>
										<center>Nama Perguruan Tinggi</center>
									</th>
									<th>
										<center>No. Ijazah & Tahun</center>
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
								foreach ($pendidikan as $r) : ?>
									<tr class="list_<?= $r->id_riwpend; ?>">
										<td><?php echo $no++ ?></td>
										<td><?php echo $r->nama_jenjang ?></td>
										<td><?php echo $r->nm_sekolah ?></td>
										<td><?php echo $r->no_ijazah ?></td>
										<td>
											<a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/Pendidikan/' . $r->id . '/' . $r->dir_file); ?>')" class="btn default btn-xs blue-stripe">Lihat</a>
										</td>
										<td>
											<a onclick="deleteRiwPen(<?= $r->id_riwpend; ?>)" class="btn btn-danger btn-sm" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
					<div class="form-actions">
						<div class="row">
							<div class="form-group">
								<center>
									<div class="col-md-6">
										<span class="input-group-btn">
											<button class="btn green" onClick="window.location.href = '<?php echo base_url(); ?>TenagaAhli';return false;">Kembali</button>
										</span>

									</div>
									<div class="col-md-6">
										<span class="input-group-btn">
											<button class="btn green" onClick="window.location.href = '<?php echo base_url(); ?>TenagaAhli/DataKeahlian';return false;">Selanjutnya</button>
										</span>
									</div>
								</center>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function() {
		$('.select2').select2();
		$('#batal').hide();
	});

	$(".allownumericwithoutdecimal").on("keypress keyup blur", function(event) {
		$(this).val($(this).val().replace(/[^\d].+/, ""));
		if ((event.which < 48 || event.which > 57)) {
			event.preventDefault();
		}
	});

	function getjurusan(v) {
		jQuery.post(base_url + 'TenagaAhli/getDataJurusan/' + v, function(data) {
			var nama_jurusan = '';
			jQuery.each(data, function(key, value) {
				nama_jurusan += '<option value="' + value.id_jurusan + '"> ' + value.nama_jurusan + ' </option>';
			});
			jQuery('#nama_jurusan').html(nama_jurusan);
		}, 'json');
	}

	function batal() {
		document.getElementById("FormPendidikan").reset();
		$('#batal').hide();
		$('#nm_filepend').hide();
	}


	function editRiwPen(v) {
		$.ajax({
			url: '<?php echo base_url() . index_page() ?>TenagaAhli/data_RiwPen/' + v,
			dataType: 'json',
			success: function(data) {
				$('#id_riwpend').val(data.id_riwpend);
				$('#id_jenjang').val(data.id_jenjang).trigger('change');
				$('#jurusan').val(data.jurusan);
				$('#nm_sekolah').val(data.nm_sekolah);
				$('#no_ijazah').val(data.no_ijazah);
				$('#thn_lulus').val(data.thn_lulus);
				$('#dir_pendidikan').val(data.dir_file);
				$("#nm_filepend").html(data.dir_file);
				$('#batal').show();
			}
		});
	}

	function deleteRiwPen(v) {
		if (confirm('Apakah kamu yakin akan menghapus data ini ?')) {
			$.ajax({
				url: '<?php echo base_url() . index_page() ?>TenagaAhli/delete_RiwPen/' + v,
				dataType: 'json',
				success: function(data) {
					if (data.status == "success") {
						alert("File Berhasil Di Delete");
						$(".list_" + v).remove();
					} else {
						alert(data.msg);
					}
				}
			});
		}
	}

	$("#FormPendidikan").validate({
		rules: {
			//jurusan: "required",
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

	function popWin(x) {
		url = x;
		swin = window.open(url, 'win', 'scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	}
</script>