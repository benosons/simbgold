
			<div class="row profile"><div class="col-md-12">
				<div class="portlet box blue">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-gift"></i>Data Summary Permohonan SLF
						</div>
					</div>
				</div>
				<?php
									echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-'.$this->session->flashdata('status').'">'.$this->session->flashdata('message').'</div>' : '';    
				?>
				<div class="tabbable tabbable-custom tabbable-noborder">
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="#tab1" data-toggle="tab" class="step">
								<span class="desc"><i class="fa fa-check"></i>Data Permohonan SLF</span>
							</a>
						</li>
						<li>
							<a href="#tab2" data-toggle="tab" class="step">
								<span class="desc"><i class="fa fa-check"></i> Data Tanah</span>
							</a>
						</li>
						
						<li>
							<a href="#tab3" data-toggle="tab" class="step active">
							<?php if (trim($status_progress) == 2){?>
								<span class="desc"><i class="fa fa-close"></i>Perbaikan Persyaratan</span>
							<?}else{?>
								<span class="desc"><i class="fa fa-check"></i>Data Persyaratan</span>
							<?}?>
							</a>
						</li>
						<?php if (trim($status_progress) == 8){?>
						<li>
							<a href="#tab5" data-toggle="tab" class="step">	
								<span class="desc"><i class="fa fa-close"></i>Perbaikan Persidangan</span>
							</a>
						</li>
						<?}else{?>
						
						<?}?>
						
					</ul>	
						<div class="tab-content">
							<div class="tab-pane active" id="tab1">
								
								<?php 
										$this->load->view('Summary/detailin');
								?>
							</div>
							<div class="tab-pane" id="tab2">
								
								<?php 
									$this->load->view('Summary/FormDataTanah');
								?>
							</div>
							<div class="tab-pane" id="tab3">
								<?php 
									$this->load->view('Summary/FormPerbaikanPersyaratan2');
								?>
							</div>
							
							<div class="tab-pane" id="tab5">
								<?php 
									$this->load->view('Summary/data_teknis_form');
								?>
							</div>
							
						</div>
					</div>
				<!--END TABS-->
			</div></div>
	