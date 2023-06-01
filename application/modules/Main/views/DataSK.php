
<div class="portlet-body">
	<section id="hero" class="d-flex align-items-center">
		<div class="container">
			<div class="row">
				<div class="col-md-6 hero-img"><img src="<?php echo base_url(); ?>assets/gambar/47860.jpg" class="img-fluid" alt=""></div>
				<div class="col-md-6 justify-content-center">
					<h1><?=(isset($status) ? $status : 'Not Found');?></h1>
					<ul>
						<b>
							<li> <i class="m-icon-swapright m-icon-black"></i> <?=(isset($nama) ? $nama : 'Nama Pemilik : -');?></li>
							<li> <i class="m-icon-swapright m-icon-black"></i> <?=(isset($fungsi_bg) ? $fungsi_bg : 'Fungsi Bangunan Gedung :')?> -
							<?=(isset($jns_bangunan) ? $jns_bangunan : '')?></li>
							<li> <i class="m-icon-swapright m-icon-black"></i> <?=(isset($nama_bangunan) ? $nama_bangunan : 'Nama Bangunan : -')?></li>
							<li> <i class="m-icon-swapright m-icon-black"></i> <?=(isset($luas_bg) ? $luas_bg : 'Luas Bangunan : -')?> m<sup>2</sup></li>
							<li> <i class="m-icon-swapright m-icon-black"></i> <?=(isset($tinggi_bg) ? $tinggi_bg : 'Tinggi Bangunan : -')?> Meter</li>
							<li> <i class="m-icon-swapright m-icon-black"></i> <?=(isset($alamat_bg) ? $alamat_bg : 'Alamat Bangunan : -')?>, Kec.  <?=(isset($nama_kecamatan_bg) ? $nama_kecamatan_bg : 'Kecamatan Bangunan : -')?>, <?=(isset($nama_kabkota_bg) ? $nama_kabkota_bg : 'Kab/Kota Bangunan : -') ?>, Prov. <?=(isset($nama_provinsi_bg) ? $nama_provinsi_bg : 'Kab/Kota Bangunan : -') ?></li>
						</b>
					</ul>
					<div>
						<a class="btn-get-started scrollto"><?=(isset($no_imb) ? $no_imb : 'Not Found')?></a>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>


