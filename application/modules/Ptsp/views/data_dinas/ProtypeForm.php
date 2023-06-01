<script type="text/javascript">
function getProtype(f){
	url = "<?php echo base_url() . index_page() ?>file/Protype/"+f;
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
}
</script>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			List Data Type Protype Bangunan
		</div>
		<div class="actions" style="display: none;">
			<a href="javascript:;" class="btn red" data-toggle="modal" data-target="#dataprotypeform"><i class="fa fa-plus"></i> Tambah </a>
			<a class="btn btn-icon-only btn-default btn-sm fullscreen" href="javascript:;" data-original-title="" title="Layar Penuh"></a>
		</div>
	</div>
	<div class="portlet-body">
		
		<div class="btn-group">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#dataprotypeform">Tambah <i class="fa fa-plus"></i></button>
		</div>
		<div class="table-scrollable">
		<table id="example1" class="table table-bordered table-striped table-hover">
			<thead>
	            <tr>
	                <th><center>No</center></th>
	                <th>Data Type Protype Bangunan Gedung</th>
	                <th><center>Dokumen</center></th>
					<th><center>Aksi</center></th>
	            </tr>
            </thead>
			<tbody>
			<?php
				if($dataProtype->num_rows() > 0){
					$no = 1;
					foreach ($dataProtype->result() as $key) {
			?>
			<tr>
				<td align="center"><?php echo $no++;?></td>
				<td><?php echo $key->type_protype;?></td>
				<td align="center">
					<a class="btn default btn-xs blue-stripe" onClick="javascript:getProtype('<?php echo $key->dir_file;?>')" src="<?php echo base_url()?>assets/images/pdf.gif" title='File Pdf' class='link' > 
						Lihat
					</a>
				
				</td>
				<td align="center">
				<? if(isset($key->id_kabkot) && $key->id_kabkot != "pupr"){?>
				<a href="<?php echo site_url('ptsp/removeDataProtype/'.$key->idp);?>" class="btn btn-danger btn-xs" onclick="return confirm('Yakin Hapus Data ini?')" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a>
				<?}else{?>
				<a class="btn btn-danger btn-xs" disabled><span class="glyphicon glyphicon-minus"></span></a>
				<?}?>
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

<div id="dataprotypeform" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false">
	
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Tambah Type Protype Bangunan Gedung</h4>
			</div>
			<div class="modal-body form">
				<form action="<?php echo site_url('ptsp/saveDataProtype'); ?>" class="form-horizontal" role="form" method="post" id="FormProtype" enctype="multipart/form-data">
						<div class="portlet-body form">
						<div class="form-body">
							<br>
							<input type="text" class="form-control" value="<?=(isset($id_kabkot) ? $id_kabkot_bg : '');?>" name="nama_kabkota" style="display: none;" autocomplete="off">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group form-md-line-input">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-circle"></i></span>
											<input class="form-control" id="type_protype" name="type_protype" type="text" placeholder="0-9 / A-Z" autocomplete="off">
											<label for="form_control_1">Type Protype Bangunan Gedung</label>	
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group form-md-line-input">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-circle"></i></span>
											<input type="file" class="form-control" name="d_file_tan" id="d_file_tan" accept="application/pdf">
											<label for="form_control_1">Dokumen Type Protype Bangunan</label>
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" data-dismiss="modal" class="btn red">Batal</button>
								<button type="submit" class="btn btn-primary">Simpan</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	
</div>
<script>
$(function () {    
	 // Setup form validation on the #register-form element
	$("#FormProtype").validate({
	    // Specify the validation rules
	    rules: {
			type_protype: "required",
			d_file_tan: "required",
			
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
			type_protype: "Wajib Diisi",
			d_file_tan: "Wajib Diisi",
	    },
	    
	    submitHandler: function(form) {
	    	form.submit();
	    }
	});
	});
</script>
