
		<form action="<?php echo site_url('referensi/saveDataPersyaratanPermohonan');?>" class="form-horizontal" role="form" method="post" id="form_edit_persyaratan_permohonan">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Form Persyaratan Permohonan</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 ">
							<div class="portlet box grey-cascade">
								<div class="portlet-title">
									<div class="caption">
										<i class="fa fa-gift"></i>Pengaturan Syarat Permohonan
									</div>
									<div class="tools">
										<a href="javascript:;" class="collapse">
										</a>
										<a href="javascript:;" class="reload">
										</a>
									</div>
								</div>
								<div class="portlet-body">
									<div class="form-body">
										<div class="form-group">
											<label class="col-md-3 control-label">Jenis Permohonan</label>
											<div class="col-md-9">
												<div>
												<input type="hidden" class="form-control" id="id" value="<?php echo $jenis_permohonan->row()->id_jenis_permohonan?>" name="id">
													<input type="hidden" class="form-control" id="id" value="<?php echo $id_detail_jenis_persyaratan?>" name="id_detail_jenis_persyaratan">
													<?php
													if(isset($id_persyaratan->id_persyaratan)){
													?>
													<input type="hidden" class="form-control" id="id" value="<?php echo $id_persyaratan->id_persyaratan?>" name="id_persyaratan">
													<?php
													}
													?>
													<input type="text" class="form-control" id="nama_permohonan" value="<?php echo $jenis_permohonan->row()->nama_permohonan?>" name="nama_permohonan" placeholder="Nama Permohonan" autocomplete="off" disabled>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						
						<div class="col-md-12 ">
							<div class="portlet light bordered">
								<div class="portlet-title">
									<div class="caption">
										<i class="fa fa-cogs"></i>Persyaratan Teknis
									</div>
									<div class="tools">
										<a href="javascript:;" class="collapse">
										</a>
										<a href="javascript:;" class="reload">
										</a>
									</div>
								</div>
								<div class="portlet-body">
									<!-- <div id="show_listmenueditAdm"></div> -->
									<!-- <div id="show_listmenueditTeknis"></div> -->
									<?php
									$element = 'checkbox';
									if($query_syarat_teknis->num_rows() > 0):
										$var = '<div class="md-checkbox-list">';
										foreach($query_syarat_teknis->result() as $row):
											if($element == 'checkbox')
											{
												$setVal 	= '';
												foreach($query_syarat_selected->result() as $key):
													$id_dokumen_permohonan = $key->id_syarat;
													if($row->id_syarat == $id_dokumen_permohonan)
													{
														$setVal = 'checked="checked"';
													}
												endforeach;
												$set	= $disable != '' ? 'disabled="disabled"' : '';
												$input	= '<input type="checkbox" id="checkbox'.$row->id_syarat.'" class="md-check" '.$setVal.' name="dok_persyaratan[]" value="'.$row->id_syarat.'" '.$set.'>';
											}
											$var .= '<div class="md-checkbox"  style="border-bottom: 1px solid #e5e5e5;">';

												// $var .= '';
												// $var .= '<li class="'.$class.'">'.$input.'<span class="text-menulist">'.$row->nama_syarat.'</span>';
												$var .= $input;
												$var .= '<label for="checkbox'.$row->id_syarat.'">';
												$var .= '<span class="inc"></span>';
												$var .= '<span class="check"></span>';
												$var .= '<span class="box"></span>';
												$var .= $row->nama_syarat;
												$var .= '</label>';
											$var .= '</div>';
										endforeach;
										$var .= '</div>';
									endif;
									echo $var;
									?>
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
	var id = $('#id').val();
	// console.log(id);
	// function listadm() {
	// 	jQuery.post(base_url+'referensi/listPersyaratanAdmShow',{value:id,disable:'N'},function(data){
	// 			jQuery('#show_listmenueditAdm').append(data);
	// 	});
	// }

	jQuery.post(base_url+'referensi/listPersyaratanAdmShow',{value:id,disable:'N'},function(data){
			jQuery('#show_listmenueditAdm').append(data);
	});

	jQuery.post(base_url+'referensi/listPersyaratanTeknisShow',{value:id,disable:'N'},function(data){
			jQuery('#show_listmenueditTeknis').append(data);
	});
	function listakses(id,name){
		jQuery('#title').text(name);
		jQuery.post(base_url+'setting/listMenushow',{value:id},function(data){
			jQuery('#ajax-element').html(data);
		});
	}

	$("#form_edit_persyaratan_permohonan").validate({
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
