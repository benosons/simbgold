<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"  />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" ></script>
<?php
isset($asn) ? $data['DataPersonil'] = $asn->row() : $data['DataPersonil'] = '';
?>
<div class="portlet light margin-top-20">
	<div class="portlet-title tabbable-line">
		<div class="caption caption-md">
			<i class="icon-globe theme-font hide"></i>
			<span class="caption-subject font-blue-madison bold uppercase">Detail Data Personil</span>
		</div>
		<div class="actions">
			<a href="<?php echo site_url('Sekretariat/ASN_Sekretariat'); ?>" class="btn red" ><i class="fa fa-reply"></i> Kembali </a>	
		</div>								
	</div>
	<div class="portlet-body">
		<div>
			<?php
				echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-'.$this->session->flashdata('status').'">'.
				$this->session->flashdata('message').'<button class="close" data-close="alert">'.'</button>'.'</div>' : '';
			?>
		</div>
		<div class="note note-warning note-bordered">
				<p>
					<span class="label label-warning"><b>Keterangan :</span>
					&nbsp; Setelah mengisi data pada masing-masing Tab, silahkan klik tombol Simpan.</b>
				</p>
		</div>
		
				<div class="tabbable-custom nav-justified ">
					<ul class="nav nav-tabs nav-justified">
						
						<li class="active">
							<a href="#tab_2" data-toggle="tab">Data Personil </a>
						</li>
						<?php
						if (isset($asn)) {
							?>
							<li>
								<a href="#tab_3" data-toggle="tab">Data Pendidikan</a>
							</li>
							<li>
								<a href="#tab_4" data-toggle="tab">Data Keahlian</a>
							</li>
							<!--li>
								<a href="#tab_5" data-toggle="tab">Photo</a>
							</li-->
						<?php
						}
						?>

					</ul>
					<div class="tab-content">
						<br>
						<div class="tab-pane active" class="active" id="tab_2">
							<?php
							$this->load->view('data_personal', $data);
							?>
						</div>
						<?php
						if (isset($asn)) {
							?>
							<div class="tab-pane" id="tab_3">
								<?php
								$this->load->view('data_pendidikan', $data);
								?>
							</div>
							<div class="tab-pane" id="tab_4">
								<?php
								$this->load->view('data_keahlian', $data);
								?>
							</div>
							<!--div class="tab-pane" id="tab_5">
								<?php
								$this->load->view('data_photo_form', $data);
								?>
							</div-->
						<?php
						}
						?>
					</div>
				</div>
	</div>
</div>
<script type="text/javascript">

	$(document).ready(function () {

		$( ".datepicker" ).datepicker({
			autoclose: true, 
			todayHighlight: true
		});
		
		$(".yearpicker").datepicker({
			format: "yyyy",
			maxViewMode: "years",
			minViewMode: "years",
			todayHighlight: true,
			autoclose: true
		});
	});
</script>