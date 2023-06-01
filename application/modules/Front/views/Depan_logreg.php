<div class="portlet-body" id="songong">
	<!-- ======= Hero Section ======= -->
	
    <div class="row" >
		<div class="col-md-5">
		  <br><br><br><br>
          <img src="<?php echo base_url(); ?>assets/gambar/47860.jpg" class="img-responsive" alt=""><br>
        </div>
		<div class="col-md-7">
        
          <div class="tab" role="tabpanel">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#Section1" aria-controls="home" role="tab" data-toggle="tab" id="Pemohon" onclick="tukFunction1()">Pemohon </a></li>
						<li role="presentation"><a href="#Section1" aria-controls="profile" role="tab" data-toggle="tab" id="TPA" onclick="tukFunction2()">Calon TPA</a></li>
					</ul>
					<!-- Tab panes -->
					<div class="tab-content tabs">
						<div role="tabpanel" class="tab-pane fade in active" id="Section1"><br>
						  <form action="<?php echo site_url('front/saveDaftarUser'); ?>" class="form-horizontal" role="form" method="post" id="from_biodataBaru">
							<div class="form-body">
									<div class="form-group form-md-line-input has-info form-md-floating-label">
										<div class="input-group left-addon">
											<span class="input-group-addon">
											<i class="fa fa-envelope"></i>
											</span>
											<input type="text" class="form-control" name="email" id="email" for="email" />
											<input type="text" class="form-control" name="ruleBaru" id="ruleBaru" value="Pemohon" style="display:none;" />
											<input type="text" class="form-control" name="emailBaru" id="emailBaru" style="display:none;" />
											<label id="untuk" for="">Email Pemohon</label>
										</div>
									</div>
									<div class="form-group form-md-line-input has-info form-md-floating-label">
										<div class="input-group left-addon">
											<span class="input-group-addon">
											<i class="fa fa-key"></i>
											</span>
											<input type="password" class="form-control" name="password_user" for="password_user" id="password_user" onchange="addressFunction()">
											<label for="password_user">Kata Sandi</label>
										</div>
									</div>
									<div class="form-group form-md-line-input has-info form-md-floating-label">
										<div class="col-md-4" id="captchaimage">
											<a href="<?php echo htmlEntities(base_url() . ""); ?>" id="refreshimg" title="Ubah Captcha">
                                                <img src="<?= base_url() ?>front/image_captcha?<?php echo time(); ?>" width="183" height="56" alt="Captcha image">
											</a>
										</div>
										
										<div class="col-md-8 input-group left-addon">
											<span class="input-group-addon">
											<i class="fa fa-bell-o"></i>
											</span>
											 <input type="text" class="form-control" name="captcha" for="captcha" />
											<label for="password_user">Masukkan Nama Buah</label>
										</div>
									</div>
									<div class="form-group form-md-line-input">
										<div class="col-md-6">
											<div class="md-checkbox-list">
												<div class="md-checkbox has-info">
													<input type="checkbox" id="checkbox11111" class="md-check" checked disabled>
													<label for="checkbox11111">
													<span class="inc"></span>
													<span class="check"></span>
													<span class="box"></span>
													Menyetujui Syarat & Ketentuan </label>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<button type="submit" name="submit" class="btn btn-lg" style="color:#fff;background-color:#3178cc;width:100%">Daftar</button>
										</div>
									</div>
							</div>
						  </form>
						</div>
					</div>
				</div>
        </div>
	</div>
    
	
	
	<!-- End Hero -->
</div>

<script> 

	function addressFunction() { 
		if (document.getElementById( 
			"checkbox11111").checked) { 
            document.getElementById( 
            "emailBaru").value =  
            document.getElementById( 
            "email").value; 
        } else { 
                    
        } 
    }
	
	function tukFunction1() { 
		document.getElementById("untuk").innerHTML= "Email Pemohon" ;
		document.getElementById("ruleBaru").value= "Pemohon" ; 		
    }
	
	function tukFunction2() { 
		document.getElementById("untuk").innerHTML= "Email Calon TPA" ;
		document.getElementById("ruleBaru").value= "TPA" ;		
    }

	
 </script> 