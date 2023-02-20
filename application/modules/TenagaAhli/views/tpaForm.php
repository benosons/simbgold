<?php
isset($tpa) ? $data['DataTpa'] = $tpa->row() : $data['DataTpa'] = '';
isset($pendidikan) ? $data['DataPendidikan'] = $pendidikan : $data['DataPendidikan'] = '';
isset($keahlian) ? $data['DataKeahlian'] = $keahlian : $data['DataKeahlian'] = '';
isset($pengalaman) ? $data['DataPengalaman'] = $pengalaman : $data['DataPengalaman'] = '';
?>
<div class="row profile">
	<div class="col-md-12">
		<div class="portlet box red">
			<div class="portlet-title">
				<div class="caption"><i class="fa fa-gift"></i>Detail Data Tenaga Profesional Ahli</div>
			</div>
			<div class="portlet-body">
				<?php echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-' . $this->session->flashdata('status') . '">' .
					$this->session->flashdata('message') . '<button class="close" data-close="alert">' . '</button>' . '</div>' : '';
				?>
				<div class="note note-warning note-bordered">
					<p>
						<span class="label label-danger">Keterangan:</span>
						&nbsp; Setelah mengisi data pada masing-masing Tab, silahkan klik tombol Simpan.
					</p>
				</div>
				<div class="tabbable-full-width tabbable-custom ">
					<ul class="nav nav-tabs nav-justified">
						<li class="active">
							<a href="#tab_2" data-toggle="tab">Data Personil </a>
						</li>
						<?php
						if (isset($tpa)) {
						?>
							<li>
								<a href="#tab_3" data-toggle="tab">Pendidikan</a>
							</li>
							<li>
								<a href="#tab_4" data-toggle="tab">Keahlian</a>
							</li>
							<li>
								<a href="#tab_5" data-toggle="tab">Pengalaman</a>
							</li>
							<li>
								<a href="#tab_6" data-toggle="tab">Photo</a>
							</li>
						<?php
						}
						?>

					</ul>
					<div class="tab-content">

						<div class="tab-pane active" class="active" id="tab_2">
							<?php
							$this->load->view('DataPer', $data);
							?>
						</div>
						<?php
						if (isset($tpa)) {
						?>
							<div class="tab-pane" id="tab_3">
								<?php $this->load->view('DataPendidikan', $data); ?>
							</div>
							<div class="tab-pane" id="tab_4">
								<?php $this->load->view('DataKeahlian', $data); ?>
							</div>
							<div class="tab-pane" id="tab_5">
								<?php $this->load->view('DataPengalaman', $data); ?>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
