<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			List Data Peraturan Daerah
		</div>
	</div>
	<div class="portlet-body">

		<div class="btn-group">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#data_perda_form">Tambah <i class="fa fa-plus"></i></button>
		</div>
		<div class="table-scrollable">
		<table id="example1" class="table table-bordered table-striped table-hover">
			<thead>
	            <tr>
	                <th>No</th>
	                <th>Data Peraturan Daerah Kab/Kota</th>
	                <th>Aksi</th>
	            </tr>
            </thead>
			<tbody>
			<?php
				if($data_perda->num_rows() > 0){
					$no = 1;
					foreach ($data_perda->result() as $key) {
			?>
			<tr>
				<td align="center"><?php echo $no++;?></td>
				<td><?php echo $key->nama_perda;?></td>
				<td align="center">
				<a class="btn btn-warning btn-xs" href="#" onClick="UbahPerda('<?php echo $key->id_per;?>')" ><span class="glyphicon glyphicon-pencil"></span></a> 
				<a href="<?php echo site_url('ptsp/removeDataPerda/'.$key->id_per);?>" class="btn btn-danger btn-xs" onclick="return confirm('Yakin Hapus Data ini?')" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a></td>
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

<div id="data_perda_form" class="modal fade" tabindex="-1" aria-hidden="true" data-backdrop="static" data-keyboard="false" role="dialog">
	
		<form action="<?php echo site_url('ptsp/saveDataPerda'); ?>" class="form-horizontal" role="form" method="post" id="from_perda">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Tambah Data Perda</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label col-md-3">Jenis Peraturan<span class="required">* </span></label>
						<div class="col-md-9">
							<select class="form-control" name="urutan" id="urutan">
								<option value="">--Pilih--</option>
								<option value="2">Peraturan Daerah Tentang Bangunan Gedung</option>
								<option value="3">Peraturan Kepala Daerah</option>
								<option value="4">Peraturan Lainnya</option>
							</select>	
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Nama Perda</label>
						<div class="col-md-9">
							<textarea class="form-control" rows="3" name="nama_perda"></textarea>
						</div>
					</div>
							
				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn red" onClick="ResRes()">Batal</button>
					<button type="submit" class="btn green">Simpan</button>
				</div>
			</div>
		</form>
	
</div>
<div id="XwinModal" class="modal fade" tabindex="-1" aria-hidden="true" data-backdrop="static" data-keyboard="false" role="dialog">
	
		<form action="<?php echo site_url('ptsp/saveDataPerda'); ?>" class="form-horizontal" role="form" method="post" id="from_edit_perda">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Ubah Data Perda</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label col-md-3">Jenis Peraturan<span class="required">* </span></label>
						<div class="col-md-9">
							<select class="form-control" name="urutan" id="urutan">
								<option value="">--Pilih--</option>
								<option value="2">Peraturan Daerah Tentang Bangunan Gedung</option>
								<option value="3">Peraturan Kepala Daerah</option>
								<option value="4">Peraturan Lainnya</option>
							</select>	
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-md-3 control-label">Nama Perda</label>
						<div class="col-md-9">
							<input type="hidden" class="form-control" name="id_per" placeholder="id_per" autocomplete="off">
							<textarea class="form-control" rows="4" name="nama_perda"></textarea><br>
						</div>
						
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn red" onClick="ResRes()">Batal</button>
					<button type="submit" class="btn green">Simpan</button>
				</div>
			</div>	
		</form>			
	
</div>

<script>

	 // Setup form validation on the #register-form element
	$("#from_perda").validate({
	    // Specify the validation rules
	    rules: {
			urutan: "required",
			nama_perda: "required",
			
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
			urutan: "Wajib Dipilih",
			nama_perda: "Wajib Diisi",
	    },
	    
	    submitHandler: function(form) {
	    	form.submit();
	    }
	});
	
	function UbahPerda(id){
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('ptsp/editDataPerda2/')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                	$.each(data,function(){
                    	$('#XwinModal').modal('show');
						$('[name="nama_perda"]').val(data.nama_perda);
						$('[name="id_per"]').val(data.id_per);
						$('[name="urutan"]').val(data.urutan);
            		});
                }
            });
            return false;
    };
	 
	$("#from_edit_perda").validate({
	    // Specify the validation rules
	    rules: {
			urutan: "required",
			nama_perda: "required",
			
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
			urutan: "Wajib Dipilih",
			nama_perda: "Wajib Diisi",
	    },
	    
	    submitHandler: function(form) {
	    	form.submit();
	    }
	});
	function ResRes(){
		document.getElementById("from_perda").reset();  
        document.getElementById("from_edit_perda").reset();   
    };	
</script>