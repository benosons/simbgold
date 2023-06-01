<form action="DinasTeknis/status_dt_teknis" class="form-horizontal" role="form" method="post" id="savestatussyarat" name="savestatussyarat" enctype="multipart/form-data">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 align="center" class="modal-title"><b>No. Registrasi Konsultasi <?php echo $data->no_konsultasi;?></b></h4>
	</div>
	<div class="portlet light bordered margin-top-20">
	<div class="row static-info">
		<input type="hidden" name="id_pemilik" value="<?php echo $data->id; ?>">
		<input type="hidden" name="no_konsultasi" value="<?php echo $data->no_konsultasi; ?>">
	</div>
	<div class="row static-info">
		<div class="col-md-3 name">Jenis Konsultasi</div>
		<div class="col-md-8 value">
			<?= (isset($bangunan->nm_konsultasi) ? $bangunan->nm_konsultasi : ''); ?></div>
	</div>
	<div class="row static-info">
		<div class="col-md-3 name">Lokasi Bangunan</div>
		<div class="col-md-8 value">
			<?= (isset($bangunan->almt_bgn) ? $bangunan->almt_bgn : ''); ?>, Kel. <?= (isset($bangunan->nama_kelurahan) ? $bangunan->nama_kelurahan : ''); ?>, Kec. <?= (isset($bangunan->nama_kecamatan) ? $bangunan->nama_kecamatan : ''); ?>, 
			<?= (isset($bangunan->nama_kabkota) ? $bangunan->nama_kabkota : ''); ?>, Prov. <?= (isset($bangunan->nama_provinsi) ? $bangunan->nama_provinsi : ''); ?>
		</div>
	</div>
	<div class="row static-info">
		<div class="col-md-3 name">Data Bangunan Gedung</div>
		<div class="col-md-8 value">
			Luas <?= (isset($bangunan->luas_bgn) ? $bangunan->luas_bgn : ''); ?> m<sup>2</sup>, Tinggi  <?= (isset($bangunan->tinggi_bgn) ? $bangunan->tinggi_bgn : ''); ?>Meter, Jumlah Lantai <?= (isset($bangunan->jml_lantai) ? $bangunan->jml_lantai : ''); ?> Lantai
		</div>
	</div>
</div>
	<br>
	<div class="portlet-body">
		<div class="tabbable-custom nav-justified">
			<ul class="nav nav-tabs nav-justified">
				<li class="active"><a href="#tabtot" data-toggle="tab">Data Arsitektur</a></li>
				<?php if($bangunan->id_jenis_permohonan !='12'){ ?>
					<li><a href="#tab_2_2" data-toggle="tab">Data Struktur</a></li>
					<li><a href="#tab_2_3" data-toggle="tab">Data MEP</a></li>
				<?php } else { ?>

				<?php } ?>
			</ul>
			<div class="tab-content">
				<div class="tab-pane fade active in" id="tabtot">
					<?php include "FormDokArs.php"; ?>
				</div>
				<div class="tab-pane fade" id="tab_2_2">
					<?php include "FormDokStr.php"; ?>
				</div>
				<div class="tab-pane fade" id="tab_2_3">
				<?php include "FormDokMep.php"; ?>
				</div>
			</div>
		</div>
	</div>
</form>
<div class="modal-footer">
	<button type="button" onclick="return confirm('Yakin Ingin Keluar?')" data-dismiss="modal" class="btn red"> X Tutup</button>
</div>
<script type="text/javascript">
	$('#dir_file_pemberitahuan').change(function() {
		var filename_pemberitahuan = $(this).val();
		var lastIndex = filename_pemberitahuan.lastIndexOf("\\");
		if (lastIndex >= 0) {
			filename_pemberitahuan = filename_pemberitahuan.substring(lastIndex + 1);
		}
		$('#filename_pemberitahuan').val(filename_pemberitahuan);
	});
	function popWin(x) {
		url = x;
		swin = window.open(url, 'win', 'scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
		swin.focus();
	}
	function batal() {
		location.reload();
	}
</script>