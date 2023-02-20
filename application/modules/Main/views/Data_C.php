
<div class="portlet-body">
	<!-- ======= Hero Section ======= -->
	<section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
		<div class="col-md-6 hero-img">
          <img src="<?php echo base_url(); ?>assets/gambar/47860.jpg" class="img-fluid" alt="">
        </div>
        <div class="col-md-6 justify-content-center">
		
		  <br><br>
		  <h1><?=(isset($status) ? $status : 'Not Found');?></h1>
          <ul>
			<b>
				<li> <i class="m-icon-swapright m-icon-black"></i> <?=(isset($nama) ? $nama : 'Nama Pemilik Gedung: -');?></li>
				<li> <i class="m-icon-swapright m-icon-black"></i> <?=(isset($fungsi_bg) ? $fungsi_bg : 'Fungsi Bangunan Gedung :')?></li>
				<li> <i class="m-icon-swapright m-icon-black"></i> <?=(isset($nama_bangunan) ? $nama_bangunan : 'Nama Bangunan Gedung: -')?></li>
				<li> <i class="m-icon-swapright m-icon-black"></i>
					<?=(isset($alamat_bg)? $alamat_bg : 'Lokasi Bangunan Gedung: -') ;?>
				</li>
			</b>
          </ul>
		  <br><br>
          <div>
            <a class="btn-get-started scrollto"><?=(isset($no_imb) ? $no_imb : 'Not Found')?></a>
          </div>
		  
        </div>
      </div>
    </div>

	</section>
	<!-- End Hero -->					
</div>


