<form action="DinasTeknis/status_dt_teknis" class="form-horizontal" role="form" method="post" id="savestatussyarat" name="savestatussyarat" enctype="multipart/form-data">
	<div class="modal-header"><h4 align="center" class="modal-title"><b>Download Dokumen</b></h4></div>
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<div class="row">
		<div class="modal-body">
			<div class="col-md-12 ">
				<div class="form-body">
					<?php if($Konsultasi->status == '11' || $Konsultasi->status == '12' || $Konsultasi->status == '13' || $Konsultasi->status == '14'){ ?>
						<div class="form-group">
							<label class="col-md-9 control-label">Pernyataan Pemenuhan Standar Teknis</label>
							<div class="col-md-4">
								<a href="#" onclick="GetCetakRekomendasiTeknis(<?php echo $id ?>)" class="btn btn-info btn" title="Cetak Persetujuan Bangunan Gedung" id="tombolinver"><span class="glyphicon glyphicon-print">Download</span></a>
							</div>
						</div>
					<?php }else if($Konsultasi->status == '15' || $Konsultasi->status == '16' || $Konsultasi->status == '17' || $Konsultasi->status == '18' || $Konsultasi->status == '19' || $Konsultasi->status == '20'){?>
						<div class="form-group">
							<label class="col-md-9 control-label">Pernyataan Pemenuhan Standar Teknis</label>
							<div class="col-md-7">
								<a href="#" onclick="GetCetakRekomendasiTeknis(<?php echo $id ?>)" class="btn btn-info btn" title="Cetak Rekomendasi Teknis Bangunan Gedung" id="tombolinver"><span class="glyphicon glyphicon-print">Download</span></a>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-9 control-label">Dokumen Persetujuan Bangunan Gedung</label>
							<div class="col-md-7">
								<a href="#" onclick="GetCetakPersetujuanBangunanGedung(<?php echo $id ?>)" class="btn btn-info btn" title="Cetak Persetujuan Bangunan Gedung" id="tombolinver"><span class="glyphicon glyphicon-print">Download</span></a>
							</div>
						</div>
					<?php } else if ($Konsultasi->status == '21'){ ?>
						<div class="form-group">
							<label class="col-md-9 control-label">Pernyataan Pemenuhan Standar Teknis</label>
							<div class="col-md-7">
								<a href="#" onclick="GetCetakRekomendasiTeknis(<?php echo $id ?>)" class="btn btn-info btn" title="Cetak Rekomendasi Teknis Bangunan Gedung" id="tombolinver"><span class="glyphicon glyphicon-print">Download</span></a>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-9 control-label">Dokumen Persetujuan Bangunan Gedung</label>
							<div class="col-md-7">
								<a href="#" onclick="GetCetakPersetujuanBangunanGedung(<?php echo $id ?>)" class="btn btn-info btn" title="Cetak Persetujuan Bangunan Gedung" id="tombolinver"><span class="glyphicon glyphicon-print">Download</span></a>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-9 control-label">Dokumen Sertifikat Laik Fungsi</label>
							<div class="col-md-7">
								<a href="#" onclick="GetCetakPersetujuanBangunanGedung(<?php echo $id ?>)" class="btn btn-info btn" title="Cetak Persetujuan Bangunan Gedung" id="tombolinver"><span class="glyphicon glyphicon-print">Download</span></a>
							</div>
						</div>
					<?php }?>
				</div>
			</div>
		</div>
	</div>
</form>
<div class="modal-footer">
	<button type="button" onclick="return confirm('Yakin Ingin Keluar?')" data-dismiss="modal" class="btn red"> X Tutup</button>
</div>
<script>
    function GetCetakRekomendasiTeknis(id) {
        var url = "<?php echo base_url() . index_page() ?>Dokumen/CetakVerifikasiBangunan/" + id;
        swin = window.open(url, 'win', 'scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
        swin.focus();
    }
    function GetCetakPersetujuanBangunanGedung(id) {
        var url = "<?php echo base_url() . index_page() ?>Dokumen/CetakPersetujuanBangunanGedung/" + id;
        swin = window.open(url, 'win', 'scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
        swin.focus();
    }
    function GetCetakLaikFungsi(id) {
        var url = "<?php echo base_url() . index_page() ?>Dokumen/CetakDokumenLaikFungsi/" + id;
        swin = window.open(url, 'win', 'scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
        swin.focus();
    }
</script>