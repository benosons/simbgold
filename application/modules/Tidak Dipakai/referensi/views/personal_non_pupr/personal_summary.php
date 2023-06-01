<div class="row">
	<div class="col-md-3">
		<ul class="list-unstyled profile-nav">
			<li class="active">
				<a data-toggle="tab" href="#tab_1_1"><i class="fa fa-cog"></i> Data Personil </a>
				<span class="after"></span>
			</li>
			<li>
				<a data-toggle="tab" href="#tab_1_2"><i class="fa fa-cog"></i> Pendidikan </a>
			</li>
			<li>
				<a data-toggle="tab" href="#tab_1_3"><i class="fa fa-cog"></i> Keahlian</a>
			</li>
			<li>
				<a data-toggle="tab" href="#tab_1_4"><i class="fa fa-cog"></i> Photo </a>
			</li>
		</ul>
	</div>
	<div class="col-md-9">
		<div class="tab-content">
			<div id="tab_1_1" class="tab-pane active">
				<form action="#" class="form-horizontal" role="form" >
					<div class="form-group input-xlarge">
						<label class="control-label">Nama Personil</label>
						<div class="input-icon right">
							<i class="fa fa-warning tooltips" data-original-title="Data Kosong!" data-container="body"></i>
							<input type="text" class="form-control" value="" placeholder="" disabled="false">
						</div>
					</div>
					<div class="form-group input-xlarge">
						<label class="control-label">No Identitas</label>
						<div class="input-icon right">
							<i class="fa fa-warning tooltips" data-original-title="Data Kosong!" data-container="body"></i>
							<input type="text" class="form-control" value="" placeholder="" disabled="false">
						</div>
					</div>
					<div class="form-group input-xlarge">
						<label class="control-label">Alamat</label>
						<div class="input-icon right">
							<i class="fa fa-warning tooltips" data-original-title="Data Kosong!" data-container="body"></i>
							<textarea class="form-control" rows="2" disabled="false"></textarea>
						</div>
					</div>
					<div class="form-group input-xlarge">
						<label class="control-label">No Kontak</label>
						<div class="input-icon right">
							<i class="fa fa-warning tooltips" data-original-title="Data Kosong!" data-container="body"></i>
							<input type="text" class="form-control" value="" placeholder="" disabled="false">
						</div>
					</div>
					<div class="form-group input-xlarge">
						<label class="control-label">Email</label>
						<div class="input-icon right">
							<i class="fa fa-warning tooltips" data-original-title="Data Kosong!" data-container="body"></i>
							<input type="text" class="form-control" value="" placeholder="" disabled="false">
						</div>
					</div>
				</form>
			</div>
			<div id="tab_1_2" class="tab-pane">
				<table id="example1" class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>No</th>
							<th>Jenjang</th>
							<th>Jurusan</th>
							<th>Nama Sekolah</th>
							<th>No. Ijazah</th>
							<th>Tahun Lulus</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td align="center"></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>                
					</tbody>
				</table>
			</div>
			<div id="tab_1_3" class="tab-pane">
				<table id="example1" class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>No</th>
							<th>Unsur</th>
							<th>Sub Unsur</th>
							<th>Bidang Keahlian</th>
							<th>Kualifikasi/Jabatan</th>
							<th>Tgl. Sertifikat</th>
							<th>FileSertifikat</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td align="center"></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>                
					</tbody>
				</table>
			</div>
			<div id="tab_1_4" class="tab-pane">
				<form action="#" class="form-horizontal" role="form" >
					<div class="col-md-3">
							<!--<ul class="list-unstyled profile-nav">
								<li>
									<?php
										$dir_avatar 	= base_url()."assets/admin/pages/media/profile/profile-img.png";
										$logo_profile 	= $profile_personil->p_logo;
										$user_id		= $this->session->userdata('loc_user_id');
										if($logo_profile != '' || $logo_profile != null){
											$dir_avatar 	= base_url()."file/profile_dinas/".$user_id."/logo_dinas/".$logo_profile;
										}
									?>
									<img src="<" class="img-responsive" alt=""/>
								</li>
							</ul>-->
						</div>
				</form>
			</div>
		</div>
	</div>
</div>
