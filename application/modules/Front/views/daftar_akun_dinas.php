
										<div class="portlet-title margin-top-10">
											<div class="caption">
												<span class="caption-subject font-blue-hoki bold uppercase">Masukkan ID & Kata Sandi Baru</span>
											</div>
										</div>
										<div class="portlet-body form">
											<!-- BEGIN FORM-->
											<form action="<?php echo site_url('front/save_daftar_akun_dinas/' . $activation); ?>" class="form-horizontal" role="form" method="post" id="formakundinas">
												<div class="form-body">
												<div class="col-md-12">
												<?php
												echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '<button class="close" data-close="alert">'.'</button>'.'</div>' : '';
												?>
												</div>
												<br>
													<div class="form-group">
														<label class="col-md-3">ID Pengguna <span class="required" style="color:red">* </span></label>
														<div class="col-md-6">
															 <input type="hidden" class="form-control" value="<?= $activation; ?>" autocomplete="off" >
															 <div class="input-icon right">
																<input type="text" class="form-control" name="usernamedinas" placeholder="Username" autocomplete="off" >
															</div>
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3">Kata Sandi Baru <span class="required" style="color:red">* </span></label>
														<div class="col-md-6">
															<div class="input-icon right">
																<input type="password" class="form-control" for="passworddinas" id="passworddinas" name="passworddinas" placeholder="Kata Sandi" autocomplete="off">
															</div>
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3">Konfrimasi Kata Sandi Baru <span class="required" style="color:red">* </span></label>
														<div class="col-md-6">
															<div class="input-icon right">
																<input type="password" class="form-control" name="confirm_dinas" placeholder="Konfirmasi Kata Sandi" autocomplete="off">
															</div>
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3"></label>
														<div class="col-md-6">
															<button type="submit" class="btn green">Simpan</button>
															<button type="button" class="btn red">Batal</button>
														</div>
													</div>
												</div>
											</form>
											<!-- END FORM-->
										</div>
									
								
