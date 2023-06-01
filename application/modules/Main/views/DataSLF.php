<div class="portlet-body">
	<!-- ======= Hero Section ======= -->
	<section id="hero" class="d-flex align-items-center">
    <div class="container">
      <div class="row">
        <div class="col-md-6 hero-img">
          <img src="<?php echo base_url(); ?>assets/gambar/47860.jpg" class="img-fluid" alt="">
        </div>
        <div>
          <a class="btn-get-started scrollto"><?=(isset($no_imb) ? $no_imb : 'Not Found')?></a>
        </div>
        <div class="col-md-6 justify-content-center">
          <h3><b>Data Bangunan Gedung</b></h3>
          <ul>
            <b>
              <li> <i class="m-icon-swapright m-icon-black"></i>Nama Pemilik : <?=(isset($nama) ? $nama : 'Nama Pemilik : -');?></li>
              <li> <i class="m-icon-swapright m-icon-black"></i>Fungsi Bangunan : <?=(isset($fungsi_bg) ? $fungsi_bg : 'Fungsi Bangunan Gedung : -')?> </li>
              <li> <i class="m-icon-swapright m-icon-black"></i>Nama Bangunan : <?=(isset($nama_bangunan) ? $nama_bangunan : 'Nama Bangunan : -')?></li>
              <li> <i class="m-icon-swapright m-icon-black"></i>Lokasi Bangunan Gedung : <?=(isset($alamat_bg)? $alamat_bg : '-') ;?>, Kel/Desa. <?=(isset($nama_kelurahan)? $nama_kelurahan : '-') ;?>, Kec. <?=(isset($nama_kecamatan)? $nama_kecamatan : '-') ;?>, <?=(isset($nama_kabkota)? ucwords(strtolower($nama_kabkota)) : '-') ;?>, Prov. <?=(isset($nama_provinsi)? $nama_provinsi : '-') ;?></li>
              <li> <i class="m-icon-swapright m-icon-black"></i>Luas Bangunan : <?=(isset($luas_bgn)? $luas_bgn : 'Luas Bangunan : -') ;?> m<sup>2</sup></li>
              <li> <i class="m-icon-swapright m-icon-black"></i>Tinggi Bangunan : <?=(isset($tinggi_bgn)? $tinggi_bgn : 'Tinggi Bangunan : -') ;?> Meter</li>
              <li> <i class="m-icon-swapright m-icon-black"></i>Jumlah Lantai : <?=(isset($jml_lantai)? $jml_lantai : 'Tinggi Bangunan : -') ;?> Lantai</li>
            </b>
          </ul>
          <h3><b>Data Pejabat</b></h3>
          <ul>
            <b>
              <li> <i class="m-icon-swapright m-icon-black"></i>Nama Kepala Dinas : <?=(isset($nm_kadis_teknis) ? $nm_kadis_teknis : 'Nama Kepala Dinas : -');?></li>
              <li> <i class="m-icon-swapright m-icon-black"></i>Nip. Kepala Dinas : <?=(isset($nip_kadis_teknis) ? $nip_kadis_teknis : 'NIP. Kepala Dinas : -')?> </li>
            </b>
          </ul>
          <h1><?=(isset($status) ? $status : 'Not Found');?></h1>
        </div>
      </div>
    </div>
	</section>			
</div>


