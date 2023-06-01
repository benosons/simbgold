<!-- awal ubah kata sandi -->
<div id="ResetPwd" class="modal fade" tabindex="-1" aria-hidden="true" data-width="30%" data-backdrop="static"
	data-keyboard="false">
	
	<?php  echo form_open('Front/Tokill', array('role'=>'form' , 'id'=>'from_data_password', 'class'=>'form-horizontal')); ?>
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"></button>
			<h4 align="center" class="modal-title"><b>Lupa Kata Sandi ?</b></h4>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-md-12 ">
					<div class="form-body">

						<div class="form-group">
							<!--label class="control-label">Masukkan Username <span class="required">* </span></label-->
							<div class="input-icon">
								<i class="fa fa-user"></i>
								<input type="text" class="form-control" name="reset_pass" placeholder="Masukkan Username" autocomplete="username" />
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer" style="background-color:#fff">
			<button class="btn blue" type="button" data-dismiss="modal" data-toggle="modal" data-target="#Daftarin"><i
					class="fa fa-user"></i> Daftar</button>
			<button type="submit" class="btn green" style="float:left"><i class="fa fa-send-o"></i> Kirim</button>
			<button type="button" data-dismiss="modal" class="btn red"><i class="fa fa-times"></i> Batal</button>
		</div>
	<?php echo form_close(); ?>
</div>
<!-- akhir ubah kata sandi -->

<!-- awal pendaftaran -->
<div id="Daftarin" class="modal fade" tabindex="-1" aria-hidden="true" data-width="50%" data-backdrop="static"
	data-keyboard="false">

	
	<?php  echo form_open('Front/One', array('role'=>'form' , 'id'=>'from_biodata', 'class'=>'form-horizontal')); ?>

		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"></button>
			<h4 align="center" class="modal-title"><b>FORM PENDAFTARAN</b></h4>
		</div>
		<div class="modal-body" style="background-color:#fff;">
			<div class="row">
				<div class="col-md-12 ">
					<div class="form-body">
						<br>
						<div class="form-group">
							<label class="control-label col-md-3" style="text-align:left;font-weight:bold;">Daftar Sebagai <span
									class="required" aria-required="true">*
								</span></label>
							<div class="col-md-9">
								<select class="form-control" name="roleplayer">
									<option value="">Pilih...</option>
									<option value="10">Pemohon PBG/SLF/SBKBG/RTB/Pendataan BG</option>
									<option value="17">Calon TPA</option>
									<option value="3" disabled>Peserta Ujian Lisensi Arsitek</option>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-3" style="text-align:left;font-weight:bold;">Alamat Email <span
									class="required">* </span></label>
							<div class="col-md-9">
								<div class="input-icon right">
									<input type="text" class="form-control" name="siapa" placeholder="Masukkan Alamat Email Anda dengan benar" />
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3" style="text-align:left;font-weight:bold;">Kata Sandi <span
									class="required">* </span></label>
							<div class="col-md-9">
								<div class="input-icon right">
									<input type="password" class="form-control" name="anda" placeholder="Masukkan kata sandi Anda (gabungan huruf dan angka)"
										autocomplete="off">
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-offset-3 col-md-12 check">
								<div class="checker">
									<span class="checked"><input type="checkbox" checked disabled></span>
								</div>
								Menyetujui <a href="javascript:;"> Syarat & Ketentuan </a> yang berlaku.
							</label>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<center>

				<button type="submit" name="regis" class="btn green"><i class="fa fa-send-o"></i> Kirim</button>
				<button type="button" data-dismiss="modal" class="btn red"><i class="fa fa-times"></i> Batal</button>
			</center>
		</div>
	<?php echo form_close(); ?>
</div>
<!-- akhir pendaftaran -->


<!-- awal masuk -->
<div id="Loginnya" class="modal fade" tabindex="-1" aria-hidden="true" data-width="30%" data-backdrop="static"
	data-keyboard="false">

	<?php  echo form_open('Front/Skill', array('role'=>'form' , 'id'=>'frmLogin', 'class'=>'form-horizontal')); ?>
	
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"></button>
			<h4 align="center" class="modal-title"><b>MASUK</b></h4>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-md-12 ">

					<div class="form-body">
						<div class="form-group">
							
							<div class="input-icon">
								<i class="fa fa-user"></i>
								<input type="text" class="form-control" name="saya" placeholder="Masukkan Email/Username"
									autocomplete="off" />
							</div>
						</div>
						<div class="form-group">
							
							<div class="input-icon">
								<i class="fa fa-lock"></i>
								<input type="password" class="form-control" name="bukan" placeholder="Masukan Kata Sandi"
									autocomplete="off" />
									<br>
								<a data-dismiss="modal" data-toggle="modal" data-target="#ResetPwd" style="float:right">Lupa Kata
									Sandi?</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer" style="background-color:#fff">
			<button type="submit" class="btn green" style="float:left"><i class="fa fa-sign-in"></i> Masuk</button>
			<button class="btn blue" type="button" data-dismiss="modal" data-toggle="modal" data-target="#Daftarin"><i
					class="fa fa-user"></i> Daftar</button>
			<button type="button" data-dismiss="modal" class="btn red"><i class="fa fa-times"></i> Batal</button>
		</div>
		
	<!--/form-->
	<?php echo form_close(); ?>
</div>
<!-- akhir masuk -->

<!-- awal konfirmasi -->
<div id="konfirmasi" class="modal fade" tabindex="-1" aria-hidden="true" data-width="30%" data-backdrop="static"
	data-keyboard="false" style="background-color:#dff0d8">
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12 ">
				<div class="form-body">
					<h4 class="form-title" align="center"><b>Pendaftaran Berhasil</b></h4>
					<div class='alert alert-success'>
						<span>
							<div class="pesanOutput"></div>
						</span>
					</div>
				</div>
			</div>
			<center>OK</center>
		</div>
	</div>
</div>

<div id="confirmationData" class="modal fade" tabindex="-1" aria-hidden="true" data-width="30%" data-backdrop="static"
	data-keyboard="false" style="background-color:#f2dede">
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12 ">
				<div class="form-body">
					<h4 class="form-title" align="center"><b>Pendaftaran Gagal</b></h4>
					<div class='alert alert-danger'>
						<span>
							<div class="pesanOutput"></div>
						</span>
					</div>
				</div>
			</div>
			<center><button type="button" data-dismiss="modal" class="btn red">Ok</button></center>
		</div>
	</div>
</div>

<div id="notif" class="modal fade" tabindex="-1" aria-hidden="true" data-width="25%" data-backdrop="static"
	data-keyboard="false" style="background-color:#f2dede">
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12 ">
				<div class="form-body">
					<!--h4 class="form-title" align="center"><b>informasi</b></h4-->
					
					<?php
						echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" style="margin-bottom:0px;" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '</div>' : '';
					?>
				</div>
			</div>
		</div><br>
		<center><button type="button" data-dismiss="modal" data-toggle="modal" data-target="#Loginnya" class="btn red">Coba Lagi</button></center>
	</div>
</div>

<div id="notifBerhasil" class="modal fade" tabindex="-1" aria-hidden="true" data-width="25%" data-backdrop="static"
	data-keyboard="false" style="background-color:#dff0d8">
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12 ">
				<div class="form-body">
					<!--h4 class="form-title" align="center"><b>informasi</b></h4-->
					<?php
						echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" style="margin-bottom:0px;" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '</div>' : '';
					?>
				</div>
			</div>
		</div><br>
		<center>
			
			<?php if(!$this->session->userdata('sku')) {?>
				<button type="button" data-dismiss="modal" class="btn green">Ok</button>
			<?php } else { ?>

				<button type="button" onclick="delsku()" class="btn green">Selesai</button>
				<a href="<?php echo site_url('Front/kirim_ulang'); ?>" type="button" class="btn blue">Kirim Ulang</a>

			<?php } ?>
		
		</center>
	</div>
</div>

<!-- .modal-profile -->
	<div class="modal fade modal-profile" tabindex="-1" aria-hidden="true" data-width="900px" data-backdrop="static"
	data-keyboard="false">
			
				<div class="modal-content">
					<div class="modal-header">
						<button class="close" type="button" data-dismiss="modal">×</button>
						<h3 class="modal-title"></h3>
					</div>
					<div class="modal-body">
					</div>
					<div class="modal-footer">
						<button class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
        
			
	</div>
<!-- //.modal-profile -->
