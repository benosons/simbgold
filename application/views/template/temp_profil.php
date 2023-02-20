<!DOCTYPE html>

<html lang="en" class="no-js">

<head>
  <meta charset="utf-8" />
  <title>SIMBG</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <meta content="" name="description" />
  <meta content="" name="author" />
  <!-- BEGIN GLOBAL MANDATORY STYLES -->
  <?php $this->load->view('template/layout/css') ?>
  <!--link rel="shortcut icon" href="favicon.ico" /-->


  <?php
  $assets = $this->uri->segment('1');
  if ($this->uri->segment(2) != '') {
    $assets2 = $this->uri->segment(2);
    if (file_exists(APPPATH . "modules/$assets/views/$assets2/assets" . EXT) === TRUE) {
      $this->load->view("$assets2/assets");
      //echo APPPATH."modules/$assets/views/$assets2/assets".EXT;
    } else if (file_exists(APPPATH . "modules/$assets/views/assets" . EXT) === TRUE) {
      $this->load->view('/assets');
      //echo APPPATH."modules/$assets/views/assets".EXT;
    } else {
      echo "";
    }
  }
  ?>


</head>

<body>
  <?php $this->load->view('template/layout/header') ?>
  <!-- BEGIN CONTAINER -->
  <div class="page-container">
    <!-- BEGIN CONTENT -->
  </div>
<!-- panduan -->
  <div id="PanduanAplikasi" class="modal fade" tabindex="-1" aria-hidden="true" data-width="70%" data-backdrop="static" data-keyboard="false">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h4 align="center" class="modal-title"><b>PANDUAN APLIKASI SIMBG v1.1</b></h4>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-md-12 ">
					<div class="form-body">

						<div class="col-md-4">
							<div class="top-news">
								<a href="https://www.google.com/" target="_blank" class="btn blue">
									<span>Pemohon</span>
									<em>Buku Panduan</em>
									<em>
										<i class="fa fa-tags"></i>
										SIMBG untuk pemohon. </em>
									<i class="fa fa-book top-news-icon"></i>
								</a>
							</div>
						</div>
						<div class="col-md-4">
							<div class="top-news">
								<a href="javascript:;" class="btn blue">
									<span>
										Video Tutorial </span>
									<em>Simulasi Penggunaan</em>
									<em>
										<i class="fa fa-tags"></i>
										SIMBG Versi 1.1 </em>
									<i class="fa fa-youtube-play top-news-icon"></i>
								</a>
							</div>
						</div>
						<div class="col-md-4">
							<div class="top-news">
								<a href="javascript:;" class="btn blue">
									<span>
										Dinas Teknis & DPMPTSP </span>
									<em>Buku Panduan</em>
									<em>
										<i class="fa fa-tags"></i>
										SIMBG untuk antar dinas. </em>
									<i class="fa fa-book top-news-icon"></i>
								</a>
							</div>
						</div>
						<br>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<center><button type="button" data-dismiss="modal" class="btn yellow-crusta">Tutup</button></center>
		</div>
  </div>
  

  <!-- akhir panduan -->
  <div class="page-content">
    <div class="container">
      <?php echo $content; ?>
    </div> <!-- END CONTENT -->
  </div>

  <script>
    var base_url = '<?php echo site_url(); ?>';
  </script>
  <?php $this->load->view('footer'); ?>

  <?php $this->load->view('template/layout/js') ?>

  <script>
    function reloadata() {
      location.reload();
    }

    jQuery(document).ready(function() {
      // initiate layout and plugins
      Metronic.init(); // init metronic core components
      Layout.init(); // init current layout
      //QuickSidebar.init(); // init quick sidebar
      Demo.init(); // init demo features
      Index.init(); // init index page
      //ComponentsPickers.init();
    });
  </script>
  <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->

</html>