<div class="row profile">
	<div class="col-md-12">
		<div class="tabbable-line tabbable-full-width">
			<ul class="nav nav-tabs">
				<!-- <li class="active">
					<a href="#tab_1_1" data-toggle="tab">Profile Summary </a>
				</li> -->
				<li class="active">
					<a href="#tab_1_2" data-toggle="tab">Profile Dinas </a>
				</li>
				<li>
					<a href="#tab_1_3" data-toggle="tab">Dokumen KRK </a>
				</li>
				<li>
					<a href="#tab_1_4" data-toggle="tab">Setting IMB </a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_1_1">
					<div class="row">
						<div class="col-md-3">
							<ul class="list-unstyled profile-nav">
								<li>
									<?php
										$dir_avatar 	= base_url()."assets/admin/pages/media/profile/profile-img.png";
										$logo_profile 	= $profile_dinas->p_logo;
										$user_id		= $this->session->userdata('loc_user_id');
										if($logo_profile != '' || $logo_profile != null){
											$dir_avatar 	= base_url()."file/profile_dinas/".$user_id."/logo_dinas/".$logo_profile;
										}
									?>
									<img src="<?php echo $dir_avatar;?>" class="img-responsive" alt=""/>
								</li>
							</ul>
						</div>
						<div class="col-md-9">
							<div class="row">
								<div class="col-md-8 profile-info">
									<h1><?php echo (isset($profile_dinas->p_nama_dinas) ? $profile_dinas->p_nama_dinas : '');?></h1>
									<p>
										<?php echo (isset($profile_dinas->p_about) ? $profile_dinas->p_about : '');?>
									</p>
									<p>
										<?php echo (isset($profile_dinas->p_tugas) ? $profile_dinas->p_tugas : '');?>
									</p>
									<p>
										<?php echo (isset($profile_dinas->p_fungsi) ? $profile_dinas->p_fungsi : '');?>
									</p>
									<h1>Visi <?php echo (isset($profile_dinas->p_nama_dinas) ? $profile_dinas->p_nama_dinas : '');?></h1>
									<p>
										<?php echo (isset($profile_dinas->p_visi) ? $profile_dinas->p_visi : '');?>
									</p>
									<h1>Misi <?php echo (isset($profile_dinas->p_nama_dinas) ? $profile_dinas->p_nama_dinas : '');?></h1>
									<p>
										<?php echo (isset($profile_dinas->p_misi) ? $profile_dinas->p_misi : '');?>
									</p>
									<p>
										<a href="javascript:;"><?php echo (isset($profile_dinas->domain) ? $profile_dinas->domain : '*');?>.simbg.pu.go.id </a>
									</p>
									<ul class="list-inline">
										<li>
											<i class="fa fa-map-marker"></i> <?php echo (isset($profile_dinas->p_alamat) ? $profile_dinas->p_alamat : '???');?>
										</li>
										<li>
											<i class="fa fa-calendar"></i> Registered SIMBG : <?php echo (isset($profile_dinas->post_date) ? $profile_dinas->post_date : '00-00-0000');?>
										</li>
									</ul>
								</div>
								<div class="col-md-4">
									<div class="portlet sale-summary">
										<div class="portlet-title">
											<div class="caption"><?php echo (isset($profile_dinas->p_nama_dinas) ? $profile_dinas->p_nama_dinas : '');?> Summary</div>
										</div>
										<div class="portlet-body">
											<ul class="list-unstyled">
												<li>
													<span class="sale-info">Permohonan IMB <i class="fa fa-img-up"></i></span>
													<span class="sale-num">23 </span>
												</li>
												<li>
													<span class="sale-info">Permohonan SLF <i class="fa fa-img-up"></i></span>
													<span class="sale-num">23 </span>
												</li>
												<li>
													<span class="sale-info">Permohonan RTB <i class="fa fa-img-up"></i></span>
													<span class="sale-num">23 </span>
												</li>
												<li>
													<span class="sale-info">Total BG <i class="fa fa-img-up"></i></span>
													<span class="sale-num">23 </span>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="tab-pane" id="tab_1_2">
					<?php 
					$data['profile_dinas'] = $profile_dinas;
					$this->load->view('profile_dinas_form', $data);
					?>
				</div>
				<div class="tab-pane" id="tab_1_3">
					<?php $this->load->view('dokumen_krk_form');?>
				</div>
				<div class="tab-pane" id="tab_1_4">
					<?php $this->load->view('setting_imb_form');?>
				</div>
			</div>
		</div>
	</div>
</div>