
		
		<form action="<?php echo site_url('Konsultasi/savePelaporan'); ?>" class="form-horizontal" role="form" method="post" id="frm_pelaporan" enctype="multipart/form-data">
			<input type="hidden" id='csrf_id_peng' name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
			<input type="hidden" value="<?php echo !empty($pelaporan->id) ? $pelaporan->id : '' ?>" name="id">
			<input type="hidden" value="<?php echo !empty($pelaporan->id_bgn) ? $pelaporan->id_bgn : '' ?>" name="id_bgn">
			<div class="portlet-body form">
				<div class="form-body">
					<div class="form-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3">Proses Pembangunan<span class="required">*</span></label>
									<div class="col-md-7">
										<?php $list_pem = array(
											'1' => 'Konstruksi Bawah',
											'2' => 'Basement',
											'3' => 'Konstruksi Atas',
											'4' => 'Testing and Comisioning',
										);
										echo form_dropdown('proses_pembangunan', $list_pem, !empty($pelaporan->proses_pembangunan) ? $pelaporan->proses_pembangunan : '', 'class = "form-control"');
										?>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Tanggal Proses<span class="required">*</span></label>
									<div class="col-md-4">
										<input type="date" class="form-control" value="<?php echo !empty($pelaporan->tanggal_proses) ? $pelaporan->tanggal_proses : '' ?>" name="tanggal_proses">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Ketrangan<span class="required">*</span></label>
									<div class="col-md-9">
										<textarea name="keterangan" class="form-control" rows="3"><?php echo !empty($pelaporan->keterangan) ? $pelaporan->keterangan : '' ?></textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
					</div>
				</div>
			</div>
		</form>
