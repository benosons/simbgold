<?php
	echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '</div>' : '';
?>
<div class="portlet-body">
	<!-- ======= Hero Section ======= -->
	<section id="hero" class="d-flex align-items-center">
    <div class="container">
      <div class="row">
		<div class="col-md-6 hero-img">
          <img src="<?php echo base_url(); ?>assets/gambar/47860.jpg" class="img-fluid" alt="">
        </div>
        <div class="col-md-6 justify-content-center">
          <h1>Sistem Informasi Bangunan Gedung Republik Indonesia</h1>
          <ul>
            <li> <i class="m-icon-swapright m-icon-black"></i> Perizinan Bangunan Gedung</li>
            <li> <i class="m-icon-swapright m-icon-black"></i> Sertifikat Laik Fungsi</li>
            <li> <i class="m-icon-swapright m-icon-black"></i> SBKBG, RTB dan Pendataan Bangunan Gedung</li>
          </ul>
		  <br>
          <div class="">
            <a href="#about" class="btn-get-started scrollto">Daftar</a>
            <a href="" class="btn-get-quote" >Masuk</a>
          </div>
        </div>
      </div>
    </div>
	</section>
	<!-- End Hero -->
		<div class="section-title"  id="LP">
          <h2>Layanan Perizinan</h2>
          <p></p>
		 </div>
					<div class="row">
						<div class="col-md-12 news-page">
							
							<div class="row">
								
								<div class="col-md-3">
									<div class="top-news">
										<a href="javascript:;" class="btn" style="color:#fff;background-color:#3178cc;">
										Perizinan Bangunan Gedung
										</a>
									</div>
									<div class="news-blocks">
										<p>
											<img class="news-block-img pull-right" src="<?php echo base_url(); ?>assets/admin/pages/media/gallery/image1.jpg" alt="">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident
										</p>
										<a href="javascript:;" class="news-block-btn">
										selengkapnya <i class="m-icon-swapright m-icon-black"></i>
										</a>
									</div>
									<div class="top-news">
										<a href="javascript:;" class="btn kuning">
										Sertifikat Laik Fungsi
										</a>
									</div>
									<div class="news-blocks">
										<p>
											<img class="news-block-img pull-right" src="<?php echo base_url(); ?>assets/admin/pages/media/gallery/image1.jpg" alt="">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident
										</p>
										<a href="javascript:;" class="news-block-btn">
										selengkapnya <i class="m-icon-swapright m-icon-black"></i>
										</a>
									</div>
							
								</div>
								<!--end col-md-3-->
								<div class="col-md-3">
									<div class="top-news">
										<a href="javascript:;" class="btn hijau">
										Ruang Terbuka Hijau
										</a>
									</div>
									<div class="news-blocks">
										<p>
											<img class="news-block-img pull-right" src="<?php echo base_url(); ?>assets/admin/pages/media/gallery/image1.jpg" alt="">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident
										</p>
										<a href="javascript:;" class="news-block-btn">
										selengkapnya <i class="m-icon-swapright m-icon-black"></i>
										</a>
									</div>
									<div class="top-news">
										<a href="javascript:;" class="btn merah">
										SBKBG
										</a>
									</div>
									<div class="news-blocks">
										<p>
											<img class="news-block-img pull-right" src="<?php echo base_url(); ?>assets/admin/pages/media/gallery/image1.jpg" alt="">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident
										</p>
										<a href="javascript:;" class="news-block-btn">
										selengkapnya <i class="m-icon-swapright m-icon-black"></i>
										</a>
									</div>
									
								</div>
								<!--end col-md-3-->
								<div class="col-md-6">
									<div id="myCarousel" class="carousel image-carousel slide">
										<div class="carousel-inner">
											<div class="active item">
												<img src="<?php echo base_url(); ?>assets/admin/pages/media/gallery/image5.jpg" class="img-responsive" alt="">
												<div class="carousel-caption">
													<h4>
													<a href="page_news_item.html">
													SlideShow 3 </a>
													</h4>
													<p>
														 Cras justo odio, dapibus ac facilisis in, egestas eget quam.
													</p>
												</div>
											</div>
											<div class="item">
												<img src="<?php echo base_url(); ?>assets/admin/pages/media/gallery/image2.jpg" class="img-responsive" alt="">
												<div class="carousel-caption">
													<h4>
													<a href="page_news_item.html">
													SlideShow 2 </a>
													</h4>
													<p>
														 Cras justo odio, dapibus ac facilisis in, egestas eget quam.
													</p>
												</div>
											</div>
											<div class="item">
												<img src="<?php echo base_url(); ?>assets/admin/pages/media/gallery/image1.jpg" class="img-responsive" alt="">
												<div class="carousel-caption">
													<h4>
													<a href="page_news_item.html">
													SlideShow 1 </a>
													</h4>
													<p>
														 Cras justo odio, dapibus ac facilisis in, egestas eget quam.
													</p>
												</div>
											</div>
										</div>
										<!-- Carousel nav -->
										<a class="carousel-control left" href="#myCarousel" data-slide="prev">
										<i class="m-icon-big-swapleft m-icon-white"></i>
										</a>
										<a class="carousel-control right" href="#myCarousel" data-slide="next">
										<i class="m-icon-big-swapright m-icon-white"></i>
										</a>
										<ol class="carousel-indicators">
											<li data-target="#myCarousel" data-slide-to="0" class="active">
											</li>
											<li data-target="#myCarousel" data-slide-to="1">
											</li>
											<li data-target="#myCarousel" data-slide-to="2">
											</li>
										</ol>
									</div>
									<div class="top-news margin-top-10">
										<!--a href="javascript:;" class="btn" style="color:#3178cc;background-color:#fff; border: 2px solid #3178cc;"-->
										<a href="javascript:;" class="btn blue">
										Pendataan Bangunan Gedung
										</a>
									</div>
									<div class="news-blocks">
										<p>
											<img class="news-block-img pull-right" src="<?php echo base_url(); ?>assets/admin/pages/media/gallery/image1.jpg" alt="">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident
										</p>
										
									</div>
									
								</div>
								<!--end col-md-6-->
							</div>

							<div class="space20">
							</div>
							
							
							
						</div>
					</div>
					
					<!--div class="row" style="margin-top:100px;">
						<div class="col-md-3">
							<ul class="ver-inline-menu tabbable margin-bottom-10">
								<li class="active">
									<a data-toggle="tab" href="#tab_1">
									<i class="fa fa-briefcase"></i> General Questions </a>
									<span class="after">
									</span>
								</li>
								<li>
									<a data-toggle="tab" href="#tab_2">
									<i class="fa fa-group"></i> Membership </a>
								</li>
								<li>
									<a data-toggle="tab" href="#tab_3">
									<i class="fa fa-leaf"></i> Terms Of Service </a>
								</li>
								<li>
									<a data-toggle="tab" href="#tab_1">
									<i class="fa fa-info-circle"></i> License Terms </a>
								</li>
								<li>
									<a data-toggle="tab" href="#tab_2">
									<i class="fa fa-tint"></i> Payment Rules </a>
								</li>
								<li>
									<a data-toggle="tab" href="#tab_3">
									<i class="fa fa-plus"></i> Other Questions </a>
								</li>
							</ul>
						</div>
						<div class="col-md-9">
							<div class="tab-content">
								<div id="tab_1" class="tab-pane active">
									<div id="accordion1" class="panel-group">
										<div class="panel panel-default">
											<div class="panel-heading">
												<h4 class="panel-title">
												<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_1">
												1. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ? </a>
												</h4>
											</div>
											<div id="accordion1_1" class="panel-collapse collapse in">
												<div class="panel-body">
													 Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
												</div>
											</div>
										</div>
										<div class="panel panel-default">
											<div class="panel-heading">
												<h4 class="panel-title">
												<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_2">
												2. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ? </a>
												</h4>
											</div>
											<div id="accordion1_2" class="panel-collapse collapse">
												<div class="panel-body">
													 Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
												</div>
											</div>
										</div>
										<div class="panel panel-success">
											<div class="panel-heading">
												<h4 class="panel-title">
												<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_3">
												3. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor ? </a>
												</h4>
											</div>
											<div id="accordion1_3" class="panel-collapse collapse">
												<div class="panel-body">
													 Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
												</div>
											</div>
										</div>
										<div class="panel panel-warning">
											<div class="panel-heading">
												<h4 class="panel-title">
												<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_4">
												4. Wolf moon officia aute, non cupidatat skateboard dolor brunch ? </a>
												</h4>
											</div>
											<div id="accordion1_4" class="panel-collapse collapse">
												<div class="panel-body">
													 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
												</div>
											</div>
										</div>
										<div class="panel panel-danger">
											<div class="panel-heading">
												<h4 class="panel-title">
												<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_5">
												5. Leggings occaecat craft beer farm-to-table, raw denim aesthetic ? </a>
												</h4>
											</div>
											<div id="accordion1_5" class="panel-collapse collapse">
												<div class="panel-body">
													 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et
												</div>
											</div>
										</div>
										<div class="panel panel-default">
											<div class="panel-heading">
												<h4 class="panel-title">
												<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_6">
												6. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth ? </a>
												</h4>
											</div>
											<div id="accordion1_6" class="panel-collapse collapse">
												<div class="panel-body">
													 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et
												</div>
											</div>
										</div>
										<div class="panel panel-default">
											<div class="panel-heading">
												<h4 class="panel-title">
												<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_7">
												7. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft ? </a>
												</h4>
											</div>
											<div id="accordion1_7" class="panel-collapse collapse">
												<div class="panel-body">
													 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et
												</div>
											</div>
										</div>
									</div>
								</div>
								<div id="tab_2" class="tab-pane">
									<div id="accordion2" class="panel-group">
										<div class="panel panel-warning">
											<div class="panel-heading">
												<h4 class="panel-title">
												<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_1">
												1. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ? </a>
												</h4>
											</div>
											<div id="accordion2_1" class="panel-collapse collapse in">
												<div class="panel-body">
													<p>
														 Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
													</p>
													<p>
														 Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
													</p>
												</div>
											</div>
										</div>
										<div class="panel panel-danger">
											<div class="panel-heading">
												<h4 class="panel-title">
												<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_2">
												2. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ? </a>
												</h4>
											</div>
											<div id="accordion2_2" class="panel-collapse collapse">
												<div class="panel-body">
													 Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
												</div>
											</div>
										</div>
										<div class="panel panel-success">
											<div class="panel-heading">
												<h4 class="panel-title">
												<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_3">
												3. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor ? </a>
												</h4>
											</div>
											<div id="accordion2_3" class="panel-collapse collapse">
												<div class="panel-body">
													 Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
												</div>
											</div>
										</div>
										<div class="panel panel-default">
											<div class="panel-heading">
												<h4 class="panel-title">
												<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_4">
												4. Wolf moon officia aute, non cupidatat skateboard dolor brunch ? </a>
												</h4>
											</div>
											<div id="accordion2_4" class="panel-collapse collapse">
												<div class="panel-body">
													 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
												</div>
											</div>
										</div>
										<div class="panel panel-default">
											<div class="panel-heading">
												<h4 class="panel-title">
												<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_5">
												5. Leggings occaecat craft beer farm-to-table, raw denim aesthetic ? </a>
												</h4>
											</div>
											<div id="accordion2_5" class="panel-collapse collapse">
												<div class="panel-body">
													 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et
												</div>
											</div>
										</div>
										<div class="panel panel-default">
											<div class="panel-heading">
												<h4 class="panel-title">
												<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_6">
												6. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth ? </a>
												</h4>
											</div>
											<div id="accordion2_6" class="panel-collapse collapse">
												<div class="panel-body">
													 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et
												</div>
											</div>
										</div>
										<div class="panel panel-default">
											<div class="panel-heading">
												<h4 class="panel-title">
												<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_7">
												7. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft ? </a>
												</h4>
											</div>
											<div id="accordion2_7" class="panel-collapse collapse">
												<div class="panel-body">
													 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et
												</div>
											</div>
										</div>
									</div>
								</div>
								<div id="tab_3" class="tab-pane">
									<div id="accordion3" class="panel-group">
										<div class="panel panel-danger">
											<div class="panel-heading">
												<h4 class="panel-title">
												<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_1">
												1. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ? </a>
												</h4>
											</div>
											<div id="accordion3_1" class="panel-collapse collapse in">
												<div class="panel-body">
													<p>
														 Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
													</p>
													<p>
														 Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
													</p>
													<p>
														 Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
													</p>
												</div>
											</div>
										</div>
										<div class="panel panel-success">
											<div class="panel-heading">
												<h4 class="panel-title">
												<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_2">
												2. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ? </a>
												</h4>
											</div>
											<div id="accordion3_2" class="panel-collapse collapse">
												<div class="panel-body">
													 Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
												</div>
											</div>
										</div>
										<div class="panel panel-default">
											<div class="panel-heading">
												<h4 class="panel-title">
												<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_3">
												3. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor ? </a>
												</h4>
											</div>
											<div id="accordion3_3" class="panel-collapse collapse">
												<div class="panel-body">
													 Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
												</div>
											</div>
										</div>
										<div class="panel panel-default">
											<div class="panel-heading">
												<h4 class="panel-title">
												<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_4">
												4. Wolf moon officia aute, non cupidatat skateboard dolor brunch ? </a>
												</h4>
											</div>
											<div id="accordion3_4" class="panel-collapse collapse">
												<div class="panel-body">
													 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
												</div>
											</div>
										</div>
										<div class="panel panel-default">
											<div class="panel-heading">
												<h4 class="panel-title">
												<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_5">
												5. Leggings occaecat craft beer farm-to-table, raw denim aesthetic ? </a>
												</h4>
											</div>
											<div id="accordion3_5" class="panel-collapse collapse">
												<div class="panel-body">
													 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et
												</div>
											</div>
										</div>
										<div class="panel panel-default">
											<div class="panel-heading">
												<h4 class="panel-title">
												<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_6">
												6. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth ? </a>
												</h4>
											</div>
											<div id="accordion3_6" class="panel-collapse collapse">
												<div class="panel-body">
													 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et
												</div>
											</div>
										</div>
										<div class="panel panel-default">
											<div class="panel-heading">
												<h4 class="panel-title">
												<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_7">
												7. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft ? </a>
												</h4>
											</div>
											<div id="accordion3_7" class="panel-collapse collapse">
												<div class="panel-body">
													 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div-->
</div>


