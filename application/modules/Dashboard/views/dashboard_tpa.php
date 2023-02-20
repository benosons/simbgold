<div class="row margin-top-10">
	<div class="col-md-12">
		<div class="profile-sidebar" style="width: 250px;">
			<div class="portlet light profile-sidebar-portlet">
				<div class="profile-userpic">
				<?php if($datatpa->dir_photo !=null || $datatpa->dir_photo !=''){ 
					$filename = FCPATH . "/object-storage/dekill/Tpa/$datatpa->dir_photo";
					$dir = '';
					if (file_exists($filename)) {
						$dir = base_url('object-storage/dekill/Tpa/' . $datatpa->dir_photo);
					} else {
						$dir = base_url('object-storage/file/Tpa/' . $datatpa->id . '/' . $datatpa->dir_photo);
					} ?>
					<img src="<?= $dir ?>" class="img-responsive" alt="">
				<? } else { ?>
					<img src="<?= base_url() ?>assets/admin/pages/media/profile/profile_user.jpg" class="img-responsive" alt="">
				<? } ?>
				</div>
				<div class="profile-usertitle">
					<?php if($datatpa->status =='1'){
						$status_tpa ="Calon TPA";
					}else if($datatpa->status == null){
						$status_tpa ="Calon TPA";
					}else{
						$status_tpa =" TPA";
					}?>
					<div class="profile-usertitle-name">
						<?php echo $status_tpa;?>
					</div>
					<div class="profile-usertitle-job">
						<?php echo set_value('nama_lengkap', (isset($datatpa->nm_tpa) ? $datatpa->nm_tpa : '-'))?>
					</div>	
				</div>
			</div>
			<div class="portlet light">
				<div class="row list-separated profile-stat">
					<div class="col-md-4 col-sm-4 col-xs-4">
						<div class="uppercase profile-stat-title">
							<?php echo set_value('nama_lengkap', (isset($total_proyek) ? $total_proyek : '-'))?>
						</div>
						<div class="uppercase profile-stat-text">Proyek</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-4">
						<div class="uppercase profile-stat-title">
							<?php echo set_value('nama_lengkap', (isset($berjalan) ? $berjalan : '-'))?>
						</div>
						<div class="uppercase profile-stat-text">Berjalan</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-4">
						<div class="uppercase profile-stat-title">
							<?php echo set_value('nama_lengkap', (isset($selesai) ? $selesai : '-'))?>
						</div>
						<div class="uppercase profile-stat-text">Selesai</div>
					</div>
				</div>					
			</div>
		</div>
		<div class="profile-content">
			<div class="row">
				<div class="col-md-12">
					<div class="portlet light">
						<div class="portlet-title tabbable-line">
							<div class="caption caption-md">
								<i class="icon-globe theme-font hide"></i><span class="caption-subject font-blue-madison bold uppercase">Data TPA</span>
							</div>
							<ul class="nav nav-tabs">
								<li class="active"><a href="#tab_personal" data-toggle="tab">Info Personal</a></li>	
								<li ><a href="#tab_proyek" data-toggle="tab">List Penugasan</a></li>	
							</ul>
						</div>
						<div class="portlet-body">
							<div class="tab-content" style="min-height: 460px;">
								<div class="tab-pane active" id="tab_personal">
									<div class="col-md-12">
										<h5 class="caption-subject font-red bold uppercase">Data Umum</h5>
										<div class="row static-info">
											<div class="col-md-4 name">Nama Lengkap</div>
											<div class="col-md-8 value">
												&ensp;<?=(isset($datatpa->nm_tpa) ? $datatpa->nm_tpa : '-');?>
											</div>
										</div>
										<div class="row static-info">
											<div class="col-md-4 name">No. Indentitas</div>
											<div class="col-md-8 value">
												&ensp;<?=(isset($datatpa->no_ktp) ? $datatpa->no_ktp : '-');?>
											</div>
										</div>
										<div class="row static-info">
											<div class="col-md-4 name">Nama Asosiasi Profesi</div>
											<div class="col-md-8 value">
												&ensp;<?=(isset($datatpa->nm_asosiasi) ? $datatpa->nm_asosiasi : '-');?>
											</div>
										</div>
										<div class="row static-info">
											<div class="col-md-4 name">Tempat dan Tgl. Lahir</div>
											<div class="col-md-8 value">
												&ensp;<?=(isset($datatpa->tmpt_lahir) ? $datatpa->tmpt_lahir : '-');?>, &ensp;<?=(isset($datatpa->tgl_lahir) ? $datatpa->tgl_lahir : '-'); ?> 
											</div>
										</div>
										<div class="row static-info">
											<div class="col-md-4 name">Alamat Domisili</div>
											<div class="col-md-8 value">
												&ensp;<?=(isset($datatpa->alamat) ? $datatpa->alamat : '-');?> 
											</div>
										</div>
										<div class="row static-info">
											<div class="col-md-4 name">No Telp / HP</div>
											<div class="col-md-8 value">
												&ensp;<?=(isset($datatpa->no_kontak) ? $datatpa->no_kontak : '-');?>
											</div>
										</div>
										<div class="row static-info">
											<div class="col-md-4 name">E-mail</div>
											<div class="col-md-8 value">
												&ensp;<?=(isset($datatpa->email) ? $datatpa->email : '-');?>
											</div>
										</div>
									</div>
									<br>
									<br>
									<?php if($datatpa->status =='2'){ ?>
										<br>
										<h5 class="caption-subject font-red bold uppercase">Hasil Verifikasi  Tenaga Ahli</h5>
										<div class="table-scrollable table-scrollable-borderless">
										<table id="sample_2" class="table table-bordered table-striped table-hover">
										<input type="hidden" id='csrf_id' name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
											<thead>
												<tr class="">
													<th>#</th>
													<th>Tgl. Verifikasi</th>
													<th>Catatan</th>
													<th>Keterangan</th>
													<th>Verifikator</th>
												</tr>
											</thead>
											<tbody>
												<?php if ($Verifkasi->num_rows() > 0) {
													$no = 1;
													foreach ($Verifkasi->result() as $ver) { ?>
														<tr>
															<td><?= $no++; ?></td>
															<td><?= $ver->tgl_status; ?></td>
															<td><?= $ver->catatan; ?></td>
															<td><?= $ver->status; ?></td>
															<td><?= $ver->post_by; ?></td>
														</tr>
													<?php }
												} ?>
											</tbody>
										</table>
									</div>
									<?php } else if($datatpa->status >='3'){ ?>
									<h5 class="caption-subject font-red bold uppercase">Persetujuan Tenaga Ahli Menjadi  Tenaga Ahli di KAB/KOTA</h5>
									<div class="table-scrollable table-scrollable-borderless">
										<table id="sample_2" class="table table-bordered table-striped table-hover">
										<input type="hidden" id='csrf_id' name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
											<thead>
												<tr class="">
													<th>#</th>
													<th>Kab/Kota Lokasi TPA</th>
													<th>Status</th>
													<th>Aksi</th>
												</tr>
											</thead>
											<tbody>
												<?php if ($dataLokasi->num_rows() > 0) {
													$no = 1;
													foreach ($dataLokasi->result() as $project) { ?>
														<tr>
															<td><?= $no++; ?></td>
															<td><?= $project->nama_kabkota; ?></td>
															<td></td>
															<td>
																<?php if ($project->status == '2'){
																	$checked = "checked";
																} else {
																	$checked = "";
																} ?>
																<input type="checkbox" class="form-control md-check" name="syarat_<?=$project->id_nya?>" value="<?=$project->id_nya?>" id="syarat_<?=$project->id_nya?>" onchange="check_status('syarat_<?=$project->id_nya?>','<?=$project->id_nya?>')" <?=$checked?> >		  
															</td>
														</tr>
													<?php }
												} ?>
											</tbody>
										</table>
									</div>
									<?php } else{?>

									<?php } ?>
									
								</div>
								<div class="tab-pane" id="tab_proyek">
									<div class="table-scrollable table-scrollable-borderless">
										<table class="table table-striped table-bordered table-hover" >
											<thead>
												<tr class="">
													<th>#</th>
													<th>No. Registrasi</th>
													<th>Jenis Pengajuan</th>
													<th>Status</th>
													<th>Detail</th>
												</tr>
											</thead>
											<tbody>
												<?php if ($dataproyek->num_rows() > 0) {
													$no = 1;
													foreach ($dataproyek->result() as $data) { ?>
														<tr>
															<td><?= $no++; ?></td>
															<td><?= $data->no_konsultasi; ?></td>
															<td><?= $data->nm_konsultasi; ?></td>
															<td>
																<?php
																$bg = 'TPA';
																$class = "label label-sm label-danger";
																$syarat = "Menunggu Penugasan TPT/TPA";
																if ($data->status == 4) {
																	$class = "label label-sm label-danger";
																	$syarat = "Menunggu Penugasan {$bg}";
																} else if ($data->status >= 5) {
																	$class = "label label-sm label-success";
																	$syarat = "Sudah Dilakukan Penugasan {$bg}";
																}; ?>
																<span class="<?php echo $class; ?>"><?php echo $syarat; ?></span>
															</td>
															<td align="center">
																<a href="<?php echo site_url('Dashboard/DataDokumen/' . $data->id_pemilik); ?>" class="btn btn-success btn-sm" title="Ubah Data Personil" data-toggle="modal" data-target="#static"><span class="glyphicon glyphicon-edit"></span></a>
															</td>
														</tr>
												<?php }
												} ?>
											</tbody>
										</table>
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
</div>
	<!--<div id="Pemberitahuan" class="modal fade" tabindex="-1" aria-hidden="true" data-width="800px"
		data-backdrop="static" data-keyboard="false">


		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

			<span class="caption-subject text-primary bold uppercase " style="font-size:15px;">
				<center><b>PENGUMUMAN</b></center>
			</span>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-md-12 ">
					<div class="form-body">
						<div class="col-md-12"><br>
							<center>
								<b>TENTANG<br>PEMANFAATAN SIMBG</b>
							</center>
						</div>
						<div class="col-md-12"><br>
							Sehubungan dengan telah diundangkan Peraturan Pemerintah Nomor 16 Tahun 2021 Tentang Peraturan Pelaksanaan
							Undang – Undang Nomor 28 Tahun 2002 Tentang Bangunan Gedung maka terdapat perubahan proses penyelenggaraan
							bangunan gedung di Indonesia, Bersama ini dapat kami sampaikan hal-hal sebagai berikut:
							<ol><br>
								<li>SIMBG akan menyesuaikan dengan proses penyelenggaraan bangunan gedung sesuai ketentuan PP Nomor 16
									Tahun 2021.</li>
								<li>SIMBG sebelumnya dapat diakses pada alamat <a
										href="https://103.211.51.151/">https://103.211.51.151/</a></li>
								<li>Bagi permohonan yang sedang berjalan pada SIMBG sebelumnya, maka diberi tenggat waktu sampai dengan
									6 bulan setelah Peraturan Pemerintah 16/2021 untuk menyelesaikan.</li>
								<li>Demikian agar menjadi maklum.</li>
							</ol>
						</div>
						<br>
					</div>
				</div>
			</div>
		</div>
		<br>
		<div class="modal-footer">
			<center><button type="button" data-dismiss="modal" class="btn yellow-crusta">Tutup</button></center>
		</div>
	</div>-->
<div id="static" class="modal fade bs-modal-lg" data-width="60%" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-content">
		<div class="modal-body"></div>
	</div>    
</div>
<script type="text/javascript">
	$('#Pemberitahuan').modal('show');
</script>
<script>
function check_status(key,id,ss) {
		//alert(key);
		if (document.getElementById(key).checked) {
			$.ajax({
				url: '<?php echo base_url('Dashboard/check_status/'.$this->uri->segment(3)) ?>'+id+'/',
				type: 'POST',
				dataType: 'html',
				data: $('form.form-horizontal').serialize(),
				cache: false,
				success: function(response) {
					const obj = JSON.parse(response);
					$('#csrf_id').val(obj.csrf);
				}
			});
		} else {
			$.ajax({
				url: '<?php echo base_url('Dashboard/uncheck_status/'.$this->uri->segment(3)) ?>/'+id+'/'+ss+'/',
				type: 'POST',
				dataType: 'html',
				data: $('form.form-horizontal').serialize(),
				cache: false,
				success: function(response) {
					const obj = JSON.parse(response);
					$('#csrf_id').val(obj.csrf);
				}
			});
		}
	}
</script>