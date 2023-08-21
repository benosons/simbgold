<div class="portlet-body">
	<section id="hero" class="d-flex align-items-center">
		<div class="container">
            <div class="row">
                <div class="col-md-6 hero-img"><img src="<?php echo base_url(); ?>assets/gambar/47860.jpg" class="img-fluid" alt=""></div>
				<div class="col-md-6 justify-content-center">
					<h3><b>Silahkan Login</b></h3>
					<ul>
						<?php  echo form_open('Front/LoginAkses', array('role'=>'form' , 'id'=>'frmLogin', 'class'=>'form-horizontal')); ?>
							<input type="text" class="form-control" value="<?= (isset($SPPST) ? $SPPST : ''); ?>" name="SPPST" style="display: none;" autocomplete="off">
						
							<div class="form-group">
								<div class="input-icon"><i class="fa fa-user"></i>
									<input type="text" class="form-control" name="saya" placeholder="Masukkan Email/Username" autocomplete="Masukan email/username" />
								</div>
							</div>
							<div class="form-group">
								<div class="input-icon"><i class="fa fa-lock"></i>
									<input type="password" class="form-control" name="bukan" placeholder="Masukan Kata Sandi" autocomplete="current-password" />
								</div>
							</div>
							<div class="modal-footer" style="background-color:#fff">
								<button type="submit" class="btn green" style="float:left"><i class="fa fa-sign-in"></i> Masuk</button>
							</div>
						<?php echo form_close(); ?>
					</ul>
					<br><br>
				</div>
			</div>
		</div>
	</section>
</div>
<script type="text/javascript">
	function popWin(x){
		url = x;
		swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
		swin.focus();
	}
</script>


