<?php
isset($tpa) ? $DataTpa = $tpa->row() : '';
isset($keahlian) ? $data['DataKeahlian'] = $keahlian : $data['DataKeahlian'] = '';
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
						Data Keahlian
					</div>
				</div>
				<div class="portlet-body">
					<form action="<?php echo site_url('TenagaAhli/saveKeahlian'); ?>" class="form-horizontal" role="form" method="post" id="FormKeahlian" enctype="multipart/form-data">
						<div class="col-md-12 ">
						<input type="hidden" class="form-control" value="<?php echo set_value('id', (isset($DataTpa->id) ? $DataTpa->id : '')) ?>" name="id" placeholder="id" autocomplete="off">
						<input type="hidden" class="form-control" value="" name="id_riwkeahlian" id="id_riwkeahlian">
						<input type="hidden" class="form-control" value="" name="spcl" id="spcl">
							<div class="form-group">
								<label class="col-md-3 control-label">Kompetensi</label>
								<div class="col-md-4">
								<?php
								$js = 'id="id_keahlian" onchange="set_spesialist(this.value)" class="form-control"';
								echo form_dropdown('id_keahlian', $list_keahlian, isset($DataTpa->id_keahlian) ? $DataTpa->id_keahlian : '', $js);
								?>
								</div>
							</div>
							<div class="form-group" id="spesialist_toggle">
								<label class="control-label col-md-3">Keahlian Lainnya</label>
								<div class="col-md-6">
									<textarea class="form-control" rows="4" name="spesialisasi"><?php echo set_value('spesialisasi', $DataTpa->spesialisasi ? $DataTpa->spesialisasi : '') ?></textarea>			
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Kualifikasi SKA</label>
								<div class="col-md-4">
										<?php
										echo form_dropdown('id_kualifikasi', $list_kualifikasi, isset($DataTpa->id_kualifikasi) ? $DataTpa->id_kualifikasi : '', 'class ="form-control" id="id_kualifikasi" ');
										?>
									</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">No. SKA</label>
								<div class="col-md-5">
									<input type="text" class="form-control" value="<?php echo set_value('no_ska', (isset($DataTpa->no_ska) ? $DataTpa->no_ska : '')) ?>" name="no_ska" id="no_ska" placeholder="No. SKA" autocomplete="off">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Masa Berlaku</label>
								<div class="col-md-3">
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
										} else {?>
											<input type="file" name="dir_file" id="dir_file" >
											<p id="nm_filekeahlian"></p>
											<input type="hidden" name="dir_keahlian" id="dir_keahlian" >
										<?php } ?>

									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label"></label>
								<div class="col-md-2">
									<button type="submit" class="btn green">Simpan</button>
								</div>
								<div  class="col-md-2" id ="batal_keahlian">
									<input type="button" name="back" value="Batal" onclick="batal_keahlian()" class="btn red">
								</div>
							</div>
						</div>
					</form>
					<div class="table-scrollable">
						<table class="table table-bordered table-striped table-hover" id="sample_editable_1">
							<thead>
								<tr class="warning">
									<th><center>No.</center></th>
									<th><center>Bidang Keahlian</center></th>
									<th><center>Spesialisasi</center></th>
									<th><center>No. SKA / Masa Berlaku</center></th>
									<th><center>Berkas</center></th>
									<th><center>Aksi</center></th>
								</tr>
							</thead>
							<tbody>
								
							<?php 
								$no = 1;
								foreach ($Keahlian as $r) : ?>
									<tr>
										<td><?php echo $no++ ?></td>
										<td><?php echo $r->keahlian ?></td>
										<td><?php echo $r->spesialisasi ?></td>
										<td><?php echo $r->no_ska ?></td>
										<td>
											<a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/Keahlian/' . $r->id . '/' . $r->dir_file); ?>')" class="btn default btn-xs blue-stripe">Lihat</a>
										</td>
										<td>
											<a onclick="delete_RiwKeahlian(<?= $r->id_ahli; ?>)" class="btn btn-danger btn-sm" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a>
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
												<button class="btn green" onClick="window.location.href = '<?php echo base_url(); ?>TenagaAhli/DataPendidikan';return false;">Kembali</button>
											</span>

										</div>
										<div class="col-md-6">
											<span class="input-group-btn">
												<button class="btn green" onClick="window.location.href = '<?php echo base_url(); ?>TenagaAhli/DataPengalaman';return false;">Selanjutnya</button>
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
<script language="javascript" type="text/javascript">
	function popWin(x) {
		url = x;
		swin = window.open(url, 'win', 'scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
		swin.focus();
	}

$(function() {
		$('#batal_keahlian').hide();
	});
	function set_spesialist(v) {
		var spcl = $('#spcl').val();
		$("#spesialist_toggle").fadeIn()
		jQuery.post(base_url + 'TenagaAhli/getDataSpesialis/' + v, function(data) {
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
			//spesialist: "required",
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
			//spesialist: "Specialist",
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

	function delete_RiwKeahlian(v) {
		// jQuery.post(base_url + 'tpa/delete_RiwPen/' + v, function(data) {}, 'json')
		if (confirm('Apakah kamu yakin akan menghapus data ini ?')) {
			$.ajax({
				url: '<?php echo base_url() . index_page() ?>TenagaAhli/delete_RiwKeahlian/' + v,
				dataType: 'json',
				success: function(data) {
					if (data.status == "success") {
						alert("File Berhasil Di Delete");
						$(".list_keah"+v).remove();
					} else {
						alert(data.msg);
					}
				}
			});
		}
	}

	function batal_keahlian(){
		document.getElementById("FormKeahlian").reset();
		$( '#batal_keahlian' ).hide();
		set_spesialist() ;
	}
</script>