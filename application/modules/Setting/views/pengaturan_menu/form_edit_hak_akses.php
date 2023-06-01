<form action="<?php echo site_url('Setting/saveDataPengaturanMenu'); ?>" class="form-horizontal" role="form" method="post" id="frm_edit">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h4 class="modal-title">Form Pengaturan Akses Menu</h4>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-md-6 ">
					<div class="portlet box green ">
						<div class="portlet-title">
							<div class="caption"><i class="fa fa-gift"></i>Pengaturan Akses</div>
							<div class="tools">
								<a href="javascript:;" class="collapse"></a>
								<a href="javascript:;" class="reload"></a>
							</div>
						</div>
						<div class="portlet-body">
							<div class="form-body">
								<div class="form-group">
									<label class="col-md-3 control-label">Nama Role</label>
									<div class="col-md-9">
										<div>
											<input type="hidden" class="form-control" id="id" value="<?php echo $row->id ?>" name="id" placeholder="Nama Role" autocomplete="off">
											<input type="text" class="form-control" id="name_role" value="<?php echo $row->name_role ?>" name="name_role" placeholder="Nama Role" autocomplete="off" disabled>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="portlet green-meadow box">
						<div class="portlet-title">
							<div class="caption"><i class="fa fa-cogs"></i>Pengaturan Menu Akses</div>
							<div class="tools">
								<a href="javascript:;" class="collapse"></a>
								<a href="javascript:;" class="reload"></a>
							</div>
						</div>
						<div class="portlet-body">
							<?php if ($query_menu->num_rows() > 0) : ?>
								<ul class="menu-list">
									<?php foreach ($query_menu->result() as $row) :
										$setVal 	= '';
										foreach ($query_menu_selected->result() as $key) :
											$menu_id = $key->menu_id;
											if ($row->id == $menu_id) {
												$setVal = 'checked="checked"';
											}
										endforeach;
										$input	= '<input type="checkbox" ' . $setVal . ' name="menu[]" value="' . $row->id . '" >'; ?>
										<li class="menu-list"><? echo $input ?><span class="text-menulist"><? echo $row->name_menu; ?></span>
											<?php $query_menu_child = $msetting->get_menu_child($row->id);
												if ($query_menu_child->num_rows() > 0) : ?>
												<ul>
													<?php foreach ($query_menu_child->result() as $rowChild) :
														$setValChild 	= '';
														foreach ($query_menu_selected->result() as $keyChild) :
															$menu_idChild = $keyChild->menu_id;
															if ($rowChild->id == $menu_idChild) {
																$setValChild = 'checked="checked"';
															}
														endforeach;
														$inputChild	= '<input type="checkbox" ' . $setValChild . ' name="menu[]" value="' . $rowChild->id . '" >';
														?>
														<li><? echo $inputChild ?><span class="text-menulist"><? echo $rowChild->name_menu; ?></span>
													<?php endforeach; ?>
												</ul>
											<?php endif; ?>
										</li>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn default">Batal</button>
			<button type="submit" class="btn green">Simpan</button>
		</div>
	</div>
</form>


<script type="text/javascript">
	$("#frm_edit").validate({
	// Specify the validation rules
	rules: {
		name: "required",
		member: "required",
		published: "required",
	},
	highlight: function(element) {
		$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
	},
	unhighlight: function(element) {
		$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
	},
	errorClass: 'help-block',
	// Specify the validation error messages
	messages: {
		name: "Masukan Nama Role",
		member: "Pilih Kelompok Pengguna",
		published: "Pilih Status",
	},

	submitHandler: function(form) {
		form.submit();

	}
	});
</script>