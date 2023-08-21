
<div class="portlet-body">
	<section id="hero" class="d-flex align-items-center">
    <div class="container">
      <div class="row">
		<div class="col-md-6 hero-img">
          <img src="<?php echo base_url(); ?>assets/gambar/47860.jpg" class="img-fluid" alt="">
        </div>
        <div class="col-md-6 justify-content-center">
		  <br><br>
		  <h3><?=(isset($status) ? $status : 'Not Found');?></h3>
      <ul>
        <b>
          <li> <i class="m-icon-swapright m-icon-black"></i>Nama Pemilik : <?=(isset($nama) ? $nama : 'Nama Pemilik : -');?></li>
          <?php if($id_izin == '5'){ ?>
            <li> <i class="m-icon-swapright m-icon-black"></i>Fungsi Bangunan : Fungsi Prasarana  </li>
          
          <?php }else{ ?>
            <li> <i class="m-icon-swapright m-icon-black"></i>Fungsi Bangunan : <?=(isset($fungsi_bg) ? $fungsi_bg : 'Fungsi Bangunan Gedung : -')?> </li>
          <?php } ?>
          
          <li> <i class="m-icon-swapright m-icon-black"></i>Nama Bangunan : <?=(isset($nama_bangunan) ? $nama_bangunan : 'Nama Bangunan : -')?></li>
          <li> <i class="m-icon-swapright m-icon-black"></i>Lokasi Bangunan Gedung : <?=(isset($alamat_bg)? $alamat_bg : '-') ;?>, Kel/Desa. <?=(isset($nama_kelurahan)? $nama_kelurahan : '-') ;?>, Kec. <?=(isset($nama_kecamatan)? $nama_kecamatan : '-') ;?>, <?=(isset($nama_kabkota)? ucwords(strtolower($nama_kabkota)) : '-') ;?>, Prov. <?=(isset($nama_provinsi)? $nama_provinsi : '-') ;?></li>
            <!--<li> <i class="m-icon-swapright m-icon-black"></i>Berita Acara : <?=(isset($no_izin_pbg) ? $no_izin_pbg : 'Berita Acara');?></li>
          <li> <i class="m-icon-swapright m-icon-black"></i>Tgl. Berita Acara : <?=(isset($no_izin_pbg) ? $no_izin_pbg : 'Tgl. Berita Acara: -');?></li>-->
        </b>
      </ul>
		  <br>
      <h3><b>Data Pejabat</b></h3>
      <ul>
        <?php if($id_dki =='1'){ ?>
          <b>
          <li> <i class="m-icon-swapright m-icon-black"></i>Nama Kepala Dinas : Heru Hermawanto</li>
          <li> <i class="m-icon-swapright m-icon-black"></i>Nip. Kepala Dinas : 196803121998031010</li>
        </b>
        <?php }else{ ?>
        <b>
          <li> <i class="m-icon-swapright m-icon-black"></i>Nama Kepala Dinas : <?=(isset($nm_kadis) ? $nm_kadis : 'Nama Kepala Dinas : -');?></li>
          <li> <i class="m-icon-swapright m-icon-black"></i>Nip. Kepala Dinas : <?=(isset($nip_kadis) ? $nip_kadis : 'NIP. Kepala Dinas : -')?> </li>
        </b>
        <?php } ?>
      </ul>
      <br><br>
          
        </div>
      </div>
    </div>
	</section>
	<!-- End Hero -->					
</div>


