<style type="text/css">
    th {
        text-align: center;
    }
	td {
        text-align: center;
    }
</style>
<div class="portlet light margin-top-20">
	<div class="portlet-title tabbable-line">
		<div class="caption caption-md">
			<i class="icon-globe theme-font hide"></i>
			<span class="caption-subject font-blue-madison bold uppercase">SK Tim Teknis</span>
		</div>
										
	</div>
	<div class="portlet-body">
		<div>
			<?php
				echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-'.$this->session->flashdata('status').'">'.
				$this->session->flashdata('message').'<button class="close" data-close="alert">'.'</button>'.'</div>' : '';
			?>
		</div>
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#responsive">Tambah <i class="fa fa-plus"></i></button>
		<div class="table-scrollable">
			<table class="table table-bordered table-hover">
			
                    <thead>
                        <tr class="warning">
                            <th >#</th>
                            <th>Nomor SK</th>
                            <th>Tanggal Penerbitan</th>
                            <th>Masa Berlaku</th>
                            <th>Personil</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($sk_tabg->num_rows() > 0) {
                            $no = 1;
                            foreach ($sk_tabg->result() as $sk_tabg) {
                                ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $sk_tabg->no_sk_tabg; ?></td>
                                    <td><?php echo $sk_tabg->tgl_sk_tabg; ?></td>
                                    <td><?php echo $sk_tabg->untuk_tahun; ?></td>
                                    <td><a href="<?php echo site_url('pupr/pengaturan_sk_tim_teknis_edit/' . $sk_tabg->id_sk_tabg); ?>" class="btn btn-success btn-sm" title="Ubah Data Personil" data-toggle="modal" data-target="#modal-edit-personal"><span class="glyphicon glyphicon-user"></span></a></td>
                                    <td>
										<a class="btn btn-warning btn-sm" href="#" onClick="UbahSKteknis('<?php echo $sk_tabg->id_sk_tabg;?>')" ><span class="glyphicon glyphicon-pencil"></span></a>
										<a href="<?php echo site_url('pupr/sk_tim_teknis_delete/' . $sk_tabg->id_sk_tabg); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ini?')" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a>
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

<!-- /.modaledit -->
<div id="modal-edit-personal" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog"  data-backdrop="static" data-keyboard="false">
	<div class="modal-content">
        <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Data Personil</h4>
         </div>
		<?php
			//$row = "";
			$this->load->view('personil');
			//include "personil.php"; 
		?>
	</div>	
	
</div>

<!-- /.modal -->
<div id="responsive" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false">
    
        <form action="<?php echo site_url('pupr/sk_tim_teknis_save'); ?>" class="form-horizontal" role="form" method="post" id="plus_skteknis">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Form Data SK</h4>
                </div>
                <div class="modal-body">
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Nomor SK</label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" name="no_sk_tabg" placeholder="Nomor SK" autocomplete="off">
										<input type="hidden" class="form-control" name="id_sk_tabg" placeholder="id" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Tanggal Penerbitan</label>
                                    <div class="col-md-9">
                                        <input  class="form-control date-picker" data-date-format="yyyy-mm-dd" type="text" name="tgl_sk_tabg" placeholder="Tanggal Penerbitan" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Masa Berlaku</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="thndatepicker"  type="text" name="untuk_tahun" placeholder="Masa Berlaku" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                </div>

                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn red" onClick="ResRes2()">Batal</button>
                    <button type="submit" class="btn green">Simpan</button>
                </div>
            </div>
        </form>
  
</div>

<script>

    $("#thndatepicker").datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years"
    });
	
	
	$("#plus_skteknis").validate({
		
	    // Specify the validation rules
	   rules: {
			no_sk_tabg : "required",
			tgl_sk_tabg: "required",
			untuk_tahun: "required",
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
			no_sk_tabg: "Masukan Nomor SK",
			tgl_sk_tabg : "Masukan Tanggal Penerbitan",
			untuk_tahun: "Masukan Masa Berlaku",
	    },
	    submitHandler: function(form) {
	    	form.submit();
	    }
	});
	
	function UbahSKteknis(id){
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('pupr/sk_tim_teknis_edit2/')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                	$.each(data,function(){
                    	$('#responsive').modal('show');
						$('[name="id_sk_tabg"]').val(data.id_sk_tabg);
						$('[name="no_sk_tabg"]').val(data.no_sk_tabg);
						$('[name="tgl_sk_tabg"]').val(data.tgl_sk_tabg);
						$('[name="untuk_tahun"]').val(data.untuk_tahun);
            		});
                }
            });
            return false;
    };
	
	function ResRes2(){
		document.getElementById("plus_skteknis").reset();
    };
	
</script>