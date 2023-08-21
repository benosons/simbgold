<div class="portlet light margin-top-20">
	<div class="portlet-title tabbable-line">
		<div class="caption caption-md">
			<i class="icon-globe theme-font hide"></i>
			<span class="caption-subject font-blue-madison bold uppercase">List Data Personil TPT di Seluruh Indonesia Berdasarkan Kab/Kota</span>
		</div>								
	</div>
	<div class="portlet-body">
		<div>
			<?php
				echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-'.$this->session->flashdata('status').'">'.
				$this->session->flashdata('message').'<button class="close" data-close="alert">'.'</button>'.'</div>' : '';
			?>
		</div>
		<button type="button" id="btnplus" class="btn red" onclick="getPlus2()" style="display: none;">Batal X</button>
		<div id="pluspersonil" style="display: none;">
		<br>
		<div class="portlet box red">
			<div class="portlet-title">
				<div class="caption">Tambah Personil</div>
			</div>
			
		</div>
		</div>
		<div class="table-scrollable">
			<table class="table table-bordered table-hover">
				<thead>
						<tr class="warning">
							<th><center>#</center></th>
							<th>Nama Personil</th>
							<th>Wilaya kerja</th>
							<th>Status</th>
							
						</tr>
					</thead>
					<tbody>
						<?php
						if ($asn->num_rows() > 0) {
							$no = 1;
							foreach ($asn->result() as $asn) {
								?>
								<tr>
									<td align="center"><?php echo $no++; ?></td>
									<td><?php echo $asn->glr_depan . ' '; ?><?php echo '<b>' . $asn->nama_personal . '</b>'; ?><?php echo (isset($asn->glr_belakang) && ($asn->glr_belakang != '') ? ', ' . $asn->glr_belakang : '') ?></td>
									<?php if($asn->id_kota_tabg =='31'){
										$nama_kabkota ="Prov. DKI Jakarta";
									}else{
										$nama_kabkota =$asn->nama_kabkota;
									}
									?>
									<td><?php echo $nama_kabkota . ' '; ?></td>
									<td>
										<?php
										if ($asn->stat == 1) {
											echo "ASN";
										} else {
											echo "Non ASN";
										}
										?>
									</td>
								</tr>
							<?php
							}
						}
						?>
					</tbody>
			</table>
		</div>
	
	</div>
</div>
