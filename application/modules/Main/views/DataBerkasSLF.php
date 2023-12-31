
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
        <?php if($id_jenis_permohonan =='12'){
                $luas_bg = $luas_bgp;
                $tinggi_bg = $tinggi_bgp;
                $fungsi = "Prasarana";
              } else if($id_jenis_permohonan =='14'){
                  if($permohonan_slf =='1'){
                    $luas_bg = $luas_bgn;
                    $tinggi_bg = $tinggi_bgn;
                    $fungsi = $fungsi_bg;
                  } else if($permohonan_slf =='2'){
                    $luas_bg = $luas_bgp;
                    $tinggi_bg = $tinggi_bgp;
                    $fungsi = "Prasarana";
                  }  else if($permohonan_slf =='3'){
                    $luas_bg = $luas_bgp;
                    $tinggi_bg = $tinggi_bgp;
                    $fungsi = "Usaha";
                  }
              }else{
                $luas_bg = $luas_bgn;
                $tinggi_bg = $tinggi_bgn;
                $fungsi = $fungsi_bg;
              } 
              if($no_imb =='' || $no_imb == null){
                $sk_imb = $no_izin_pbg;
              }else{
                $sk_imb = $no_imb;
              }
              ?>
              
          <li> <i class="m-icon-swapright m-icon-black"></i>Nama Pemilik : <?=(isset($nama) ? $nama : 'Nama Pemilik : -');?></li>
          <li> <i class="m-icon-swapright m-icon-black"></i> Fungsi Bangunan : <?=(isset($fungsi) ? $fungsi : 'Fungsi Bangunan Gedung : -')?> </li>
          <li> <i class="m-icon-swapright m-icon-black"></i> <?=(isset($nama_bangunan) ? $nama_bangunan : 'Nama Bangunan : -')?></li>
          <li> <i class="m-icon-swapright m-icon-black"></i>Lokasi Bangunan Gedung : <?=(isset($alamat_bg)? $alamat_bg : 'Lokasi Bangunan : -') ;?></li>
          <li> <i class="m-icon-swapright m-icon-black"></i>No IMB/PBG : <?=(isset($sk_imb) ? $sk_imb : 'No Izin PBG: -');?></li>
          <?php if($id_jenis_permohonan =='11' || $id_jenis_permohonan =='29' || $id_jenis_permohonan =='30' || $id_jenis_permohonan =='31' || $id_jenis_permohonan =='32' || $id_jenis_permohonan =='33'){ ?>
                <h4><b>Data Bangunan Kolektif</b></h4>
                <table class="table table-striped table-bordered dt-responsive wrap" id="tipe_bgn">
                  <tr>
                    <th>Tipe</th>
                    <th>Luas</th>
                    <th>Tinggi</th>
                    <th>Lantai</th>
                    <th>Jumlah Unit</th>
                  </tr>
                  <?php
                  $tipe = json_decode($tipeA);
                  $jumlah = json_decode($jumlahA);
                  $luas = json_decode($luasA);
                  $tinggi = json_decode($tinggiA);
                  $lantai = json_decode($lantaiA);
                  $bangunan = array();
                  foreach ($tipe as $noo => $val) {
                    if ($val != "")
                    $bangunan['tipe'][$noo] = $val;
                  }
                  foreach ($jumlah as $noo => $val) {
                    if ($val != "")
                    $bangunan['jumlah'][$noo] = $val;
                  }
                  foreach ($luas as $noo => $val) {
                    if ($val != "")
                    $bangunan['luas'][$noo] = $val;
                  }
                  foreach ($tinggi as $noo => $val) {
                    if ($val != "")
                    $bangunan['tinggi'][$noo] = $val;
                  }
                  if (!empty($lantai))
                  foreach ($lantai as $noo => $val) {
                    if ($val != "")
                    $bangunan['lantai'][$noo] = $val;
                  }
                  $no = 0;
                  if (!empty($bangunan)) {
                    foreach ($bangunan['tipe'] as $dt) {
                      $no++; ?>
                      <tr id="tr-tipe<?php echo $no ?>">
                        <td><?php echo form_input('tipeA[' . $no . ']', $bangunan['tipe'][$no], 'style="width:90px;" id="posisi' . $no . '" class="posisi' . $no . ' form-control"'); ?></td>
                        <td><?php echo form_input('luasA[' . $no . ']', $bangunan['luas'][$no], 'style="width:100px;" id="luas' . $no . '" class="luas' . $no . ' form-control"'); ?></td>
                        <td><?php echo form_input('tinggiA[' . $no . ']', $bangunan['tinggi'][$no], 'style="width:90px;" id="tinggi' . $no . '" class="tinggi' . $no . ' form-control"'); ?></td>
                        <td><?php echo form_input('lantaiA[' . $no . ']', !empty($bangunan['lantai'][$no]) ? $bangunan['lantai'][$no] : '', 'style="width:90px;" id="lantai' . $no . '" class="lantai' . $no . ' form-control"'); ?></td>
                        <td><?php echo form_input('jumlahA[' . $no . ']', $bangunan['jumlah'][$no], 'style="width:100px;" id="luas' . $no . '" class="jumlah' . $no . ' form-control"'); ?></td>
                        
                      </tr>
                    <?php }
                  } else { ?>
                    <tr id="tr-tipe">
                      <td><?php echo form_input('tipeA[1]', '', 'style="width:90px;" id="posisi1" class="posisi1 form-control"'); ?></td>
                      <td><?php echo form_input('luasA[1]', '', 'style="width:100px;" id="luas1" class="unit1 form-control"'); ?></td>
                      <td><?php echo form_input('tinggiA[1]', '', 'style="width:90px;" id="tinggi1" class="tinggi1 form-control"'); ?></td>
                      <td><?php echo form_input('lantaiA[1]', '', 'style="width:90px;" id="lantai1" class="tinggi1 form-control"'); ?></td>
                      <td><?php echo form_input('jumlahA[1]', '', 'style="width:100px;" id="jumlah1" class="unit1 form-control"'); ?></td>
                      <td></td>
                    </tr>
                  <?php } ?>
                </table> 
              <?php } else if($id_jenis_permohonan == '14'){ 
                  if($permohonan_slf == '1'){ ?>
                    <li> <i class="m-icon-swapright m-icon-black"></i>Luas Bangunan : <?=(isset($luas_bg )? $luas_bg : '-') ;?> m<sup>2</sup></li>
                    <li> <i class="m-icon-swapright m-icon-black"></i>Tinggi Bangunan : <?=(isset($tinggi_bg)? $tinggi_bg : '-') ;?> Meter</li>
                    <li> <i class="m-icon-swapright m-icon-black"></i>Jumlah Lantai : <?=(isset($jml_lantai)? $jml_lantai : '-') ;?> Lantai</li>
                 <?php }else if($permohonan_slf =='2'){ ?>
                    <li> <i class="m-icon-swapright m-icon-black"></i>Luas Bangunan Prasarana : <?=(isset($luas_bgp )? $luas_bgp : '-') ;?> m<sup>2</sup></li>
                    <li> <i class="m-icon-swapright m-icon-black"></i>Tinggi Bangunan Prasarana: <?=(isset($tinggi_bgp)? $tinggi_bgp : '-') ;?> Meter</li>
                    <li> <i class="m-icon-swapright m-icon-black"></i>Jumlah Lantai : <?=(isset($jml_lantai)? $jml_lantai : '-') ;?> Lantai</li>
                 <?php }else if($permohonan_slf == '3'){ ?>
                    <li> <i class="m-icon-swapright m-icon-black"></i>Luas Bangunan  : <?=(isset($luas_bgp )? $luas_bgp : '-') ;?> m<sup>2</sup></li>
                    <li> <i class="m-icon-swapright m-icon-black"></i>Tinggi Bangunan : <?=(isset($tinggi_bgp)? $tinggi_bgp : '-') ;?> Meter</li>
                    <li> <i class="m-icon-swapright m-icon-black"></i>Jumlah Lantai : <?=(isset($jml_lantai)? $jml_lantai : '-') ;?> Lantai</li>
                 <?php } ?>
               
              <?php } else { ?>
              <li> <i class="m-icon-swapright m-icon-black"></i>Luas Bangunan : <?=(isset($luas_bg )? $luas_bg : '-') ;?> m<sup>2</sup></li>
              <li> <i class="m-icon-swapright m-icon-black"></i>Tinggi Bangunan : <?=(isset($tinggi_bg)? $tinggi_bg : '-') ;?> Meter</li>
              <li> <i class="m-icon-swapright m-icon-black"></i>Jumlah Lantai : <?=(isset($jml_lantai)? $jml_lantai : '-') ;?> Lantai</li>
            <?php } ?> 
          
        </b>
      </ul>
		  <br>
      <h3><b>Data Pejabat</b></h3>
	  <?php if($id_dki =='1'){
			$nama_kadis 		="Heru Hermawanto";
			$nip_kepala_dinas 	="196803121998031010";
	  }else{
			$nama_kadis 		= $nm_kadis;
			$nip_kepala_dinas 	= $nip_kadis;
	  } ?>
      <ul>
        <b>
          <li> <i class="m-icon-swapright m-icon-black"></i>Nama Kepala Dinas : <?=(isset($nama_kadis) ? $nama_kadis : 'Nama Kepala Dinas : -');?></li>
          <li> <i class="m-icon-swapright m-icon-black"></i>Nip. Kepala Dinas : <?=(isset($nip_kepala_dinas) ? $nip_kepala_dinas : 'NIP. Kepala Dinas : -')?> </li>
        </b>
      </ul>
      <br><br>
          <div>
            <a class="btn-get-started scrollto"><?=(isset($no_slf) ? $no_slf : 'Not Found')?></a>
          </div>
        </div>
      </div>
    </div>

	</section>
	<!-- End Hero -->					
</div>


