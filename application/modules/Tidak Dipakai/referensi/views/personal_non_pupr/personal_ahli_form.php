<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue" id="form_wizard_1">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-gift"></i> Tambah Personal Tim Ahli<span class="step-title"></span>
				</div>
				<div class="tools hidden-xs">
					<a href="javascript:;" class="collapse"></a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-wizard">
					<div class="row profile">
						<div class="col-md-12">
							<div class="tabbable-line tabbable-full-width">
								<ul class="nav nav-tabs">
									<li class="active">
										<a href="#tab_1" data-toggle="tab">Personil Summary </a>
									</li>
									<li>
										<a href="#tab_2" data-toggle="tab">Data Personil </a>
									</li>
									<li>
										<a href="#tab_3" data-toggle="tab">Pendidikan</a>
									</li>
									<li>
										<a href="#tab_4" data-toggle="tab">Keahlian</a>
									</li>
									<li>
										<a href="#tab_5" data-toggle="tab">Photo</a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="tab_1">
										<?php 
											$this->load->view('personal_summary');
										?>
									</div>
									<div class="tab-pane" id="tab_2">
										<?php 
											$this->load->view('data_personal');
										?>
									</div>
									<div class="tab-pane" id="tab_3">
										<?php 
											$this->load->view('data_pendidikan');
										?>
									</div>
									<div class="tab-pane" id="tab_4">
										<?php 
											$this->load->view('data_keahlian');
										?>
									</div>
									<div class="tab-pane" id="tab_5">
										<?php 
											$this->load->view('data_photo_form');
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>