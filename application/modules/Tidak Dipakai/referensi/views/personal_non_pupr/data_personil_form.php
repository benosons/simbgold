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
						$this->load->view('permohonan_summary');
					?>
				</div>
				<div class="tab-pane" id="tab_2">
					<?php 
						$this->load->view('data_personal');
					?>
				</div>
				<div class="tab-pane" id="tab_3">
					<?php 
						$this->load->view('data_lokasi_bg');
					?>
				</div>
				<div class="tab-pane" id="tab_4">
					<?php 
						$this->load->view('data_keahlian');
					?>
				</div>
				<div class="tab-pane" id="tab_5">
					<?php 
						$this->load->view('data_permohonan_imb');
					?>
				</div>
			</div>
		</div>
	</div>
</div>