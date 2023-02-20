<div class="row profile-account">
	<div class="col-md-3">
		<ul class="ver-inline-menu tabbable margin-bottom-10">
			<li class="active">
				<a data-toggle="tab" href="#tab_1"><i class="fa fa-cog"></i> Periode </a>
				<span class="after"></span>
			</li>
			<li>
				<a data-toggle="tab" href="#tab_2"><i class="fa fa-cog"></i> Hari Libur </a>
			</li>
		</ul>
	</div>
	<div class="col-md-9">
		<div class="tab-content">
			<div id="tab_1" class="tab-pane active">
				<?php 
				$data['data_periode_libur'] = $data_periode_libur;
				$this->load->view('periode_libur_form', $data);?>
			</div>
			<div id="tab_2" class="tab-pane">
				<?php 
				$data['data_periode_libur'] = $data_periode_libur;
				$data['data_libur'] = $data_libur;
				$this->load->view('setting_hari_libur_form', $data);?>
			</div>
		</div>
	</div>
</div>