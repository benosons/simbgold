<div class="portlet box blue-hoki">
	<div class="portlet-title">
		<div class="caption">
			Daftar Hari Libur Kab/Kota
		</div>
	</div>
	<div class="portlet-body">
		<div class="table-toolbar">
			<div class="row">
				<div class="col-md-4">
					<div class="btn-group">											
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#data_hari_libur">Tambah <i class="fa fa-plus"></i></button>
					</div>
				</div>

				<div class="col-md-4">
					<?php
			            echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" class="alert alert-'.$this->session->flashdata('status').'">'.$this->session->flashdata('message').'</div>' : '';
			        ?>
				</div>
			</div>
		</div>
		
		<table id="example1" class="table table-bordered table-striped table-hover">
			<thead>
	            <tr>
	                <th>No</th>
					<th>Periode</th>
					<th>Tanggal Libur</th>
					<th>Keterangan Libur</th>
	                <th>Aksi</th>
	            </tr>
            </thead>
			<tbody>
			<?php

               	if($data_libur->num_rows() > 0){
               		$no = 1;
               		foreach ($data_libur->result() as $key) {
	        ?>
				<tr>
	                <td align="center"><?php echo $no++;?></td>
	                <td><?php echo $key->periode;?></td>
					<td><?php echo $key->tgl_libur;?></td>
					<td><?php echo $key->keterangan_tgl_libur;?></td>
	                <td align="center"><a href="<?php echo site_url('setting/edit_libur/'.$key->id);?>" class="btn btn-warning btn-sm" title="Ubah Data" data-toggle="modal" data-target="#modal-edit-libur"><span class="glyphicon glyphicon-pencil"></span></a> <a href="<?php echo site_url('setting/removeLibur/'.$key->id);?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ini?')" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a></td>
				</tr>
	        <?php			
	            	}
	            }
	        ?>
			</tbody>
		</table>
	</div>
</div>

<div id="data_hari_libur" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog">
	<div class="modal-dialog modal-lg">
		<form action="<?php echo site_url('setting/saveDataHariLibur'); ?>" class="form-horizontal" role="form" method="post" id="from_data_hari_libur">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Form Tambah Data Hari Libur</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 ">
							<div class="form-body">
								<div class="form-group">
									<label class="col-md-3 control-label">Periode</label>
									<div class="col-md-9">
										<div>
											<select name="periode" id="periode" class="form-control">
												<?php 
													if($data_periode_libur->num_rows() > 0){
														foreach ($data_periode_libur->result() as $key2) {
															$plhrole = "";
															
															echo '<option value="'.$key2->id.'" '.$plhrole.'>'.$key2->periode.'</option>';
														}
													}
												?>
											</select>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Tanggal Libur</label>
									<div class="col-md-9">
										<input class="form-control input-medium date-picker" size="16" type="text" name="tgl_libur"/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Keterangan Libur</label>
									<div class="col-md-9">
										<textarea class="form-control" rows="3" name="keterangan_tgl_libur" ></textarea>
									</div>
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
	</div>
</div>

<div id="modal-edit-libur" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
          
         
        </div>
        <!-- /.modal-content -->
	</div>
</div>