<div class="portlet-title">
	<div class="caption">
		<i class="fa fa-cogs"></i>Hubungi Kami
	</div>

</div>

<div class="portlet-body">
	<div class="row">
		<div class="col-md-5">
			<h2 class="h-ultra">Hubungi Kami</h2>
			<br>
			<h6>Kirim Pertanyaan / Pengaduan Anda</h6>
			<form class="form-horizontal" method="POST" id="submit_form_kontak">
				<fieldset>
					<div class="control-group">
						<label class="control-label">Nama</label>
						<div class="controls">
							<input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap" class="form-control">
						</div>
					</div>
					<br>
					<div class="control-group">
						<!-- E-mail -->
						<label class="control-label">E-mail</label>
						<div class="controls">
							<input type="text" id="email" name="email" placeholder="Masukkan e-mail" class="form-control">
						</div>
					</div>
					<br>
					<div class="control-group">
						<label class="control-label" for="pertanyaan">Pertanyaan/Pengaduan</label>
						<div class="controls">
							<textarea type="text" id="pertanyaan" name="pertanyaan" placeholder="Isi pertanyaan/pengaduan Anda" class="form-control"></textarea>
						</div>
					</div>
					<br>
					<div class="control-group">
						<label class="control-label">&nbsp;</label>
						<!-- Button -->
						<div class="controls">
							<input class="btn btn-success" type="submit" name="save" value="Kirim">
						</div>
					</div>
				</fieldset>
			</form>
		</div>
		<div class="col-md-1">
			<hr class="garis">
		</div>
		<div class="col-md-5">
			<br>
			<iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.2068648497!2d106.79829551427277!3d-6.236441595485679!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f143c20b6d7d%3A0x4ecd3cac9729012!2sKementerian+Pekerjaan+Umum+dan+Perumahan+Rakyat!5e0!3m2!1sid!2sid!4v1518493582810"></iframe>
			<br><br>
			<address>
				<strong>Kementerian Pekerjaan Umum dan Perumahan Rakyat</strong><br>
				Jalan Pattimura No.20 Kebayoran Baru<br>Jakarta Selatan Indonesia<br>
				(021) 7273649
			</address>
		</div>
		
		<?php 
function youtube($url){
	$link=str_replace('http://www.youtube.com/watch?v=', '', $url);
	$link=str_replace('https://www.youtube.com/watch?v=', '', $link);
	$data='<object width="800" height="500" data="http://www.youtube.com/v/'.$link.'" type="application/x-shockwave-flash">
	<param name="src" value="http://www.youtube.com/v/'.$link.'" />
	</object>';
	return $data;
}
 
?>

	</div>
</div>