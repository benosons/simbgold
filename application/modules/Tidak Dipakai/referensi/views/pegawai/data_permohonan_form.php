<div class="row profile">
	<div class="col-md-12">
		<div class="tabbable-line tabbable-full-width">
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#tab_1" data-toggle="tab">Permohonan Summary </a>
				</li>
				<li>
					<a href="#tab_2" data-toggle="tab">Data Tanah </a>
				</li>
				<li>
					<a href="#tab_3" data-toggle="tab">Persyaratan Administrasi </a>
				</li>
				<li>
					<a href="#tab_4" data-toggle="tab">Persyaratan Teknis </a>
				</li>
				<li>
					<a href="#tab_5" data-toggle="tab">Status</a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_1">
					<?php 
						$this->load->view('permohonan_summary');
					?>
				</div>
				<div class="tab-pane active" id="tab_2">
					<?php 
						$this->load->view('data_kepemilikan_tanah_form');
					?>
				</div>
				<div class="tab-pane active" id="tab_3">
					<?php 
						$this->load->view('data_administrasi_form');
					?>
				</div>
				<div class="tab-pane active" id="tab_4">
					<?php 
						$this->load->view('data_teknis_form');
					?>
				</div>
				<div class="tab-pane active" id="tab_5">
					
				</div>				
			</div>
		</div>
	</div>
</div>