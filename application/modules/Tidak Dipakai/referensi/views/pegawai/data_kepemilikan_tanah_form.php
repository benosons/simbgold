<script type="text/javascript">

function get_jenis_dok(v)
{
	if(v == '5'){
		document.getElementById('nama_dok_lain').style.display="block";
	}else{
		document.getElementById('nama_dok_lain').style.display="none";
	}

}

function set_id_status_izin_pemanfaatan(v)
{

	if(v == '1'){
		document.getElementById('izin_pemegang_hak_atas_tanah').style.display="block";
	}else{
		document.getElementById('izin_pemegang_hak_atas_tanah').style.display="none";
	}
}

</script>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					Data Kepemilikan Tanah
				</div>
			</div>
			<div class="portlet-body">
				<div class="table-toolbar">
					<div class="row">
						<div class="col-md-4">
							<div class="btn-group">											
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#responsive">Tambah <i class="fa fa-plus"></i></button>
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
							<th>Jenis Dokumen</th>
							<th>No. Dokumen</th>
							<th>Atas Nama</th>
							<th>Lokasi</th>
							<th>Luas Tanah</th>
							<th>File</th>
							<th>File Izin Pemanfaatan</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
					<?php
					if($DataTanah->num_rows() > 0){
						$no = 1;
						foreach ($DataTanah->result() as $key) {
						$jenis_dokumen	= "";
						if($key->id_jenis_dokumen != "" || $key->id_jenis_dokumen != null){
							if($key->id_jenis_dokumen == "1"){
								$jenis_dokumen	= "Sertifikat";
							}else if($key->id_jenis_dokumen == "2"){
								$jenis_dokumen	= "Akta Jual Beli";
							}else if($key->id_jenis_dokumen == "3"){
								$jenis_dokumen	= "Girik";
							}else if($key->id_jenis_dokumen == "4"){
								$jenis_dokumen	= "Petuk";
							}else if($key->id_jenis_dokumen == "5"){
								$jenis_dokumen	= "Bukti Lain - Lain";
							}
						}
					?>
					<tr>
						<td align="center"><?php echo $no++;?></td>
						<td><?php echo $jenis_dokumen;?></td>
						<td><?php echo $key->nomor_dokumen;?></td>
						<td><?php echo $key->nama_pemegang_hak_atas_tanah;?></td>
						<td><?php echo $key->lokasi_tanah;?></td>
						<td align="center"><?php echo $key->luas_tanah;?></td>
						<td></td>
						<td></td>
						<td><a href="<?php echo site_url('pengajuan/edit_data_tanah/'.$key->id);?>" class="btn btn-warning btn-sm" title="Ubah Data" data-toggle="modal" data-target="#modal-edit"><span class="glyphicon glyphicon-pencil"></span></a> <a href="<?php echo site_url('pengajuan/removeDataTanah/'.$key->id);?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ini?')" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a></td>
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
</div>

<div id="responsive" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog">
	<div class="modal-dialog modal-lg">
		<form action="<?php echo site_url('pengajuan/saveDataTanah'); ?>" class="form-horizontal" role="form" method="post" id="from_data_tanah" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Form Tambah Data Kepemilikan Tanah</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 ">
							<div class="form-body">
								<div class="form-group">
									<label class="col-md-3 control-label">Jenis Dokumen</label>
									<div class="col-md-9">
										<input type="hidden" class="form-control" value="<?php echo set_value('pengajuan_id', (isset($pengajuan_id) ? $pengajuan_id : ''))?>" name="pengajuan_id" placeholder="id" autocomplete="off">
										<input type="hidden" class="form-control" value="<?php echo set_value('code_pengajuan', (isset($code_pengajuan) ? $code_pengajuan : ''))?>" name="code_pengajuan" placeholder="code_pengajuan" autocomplete="off">
										<select class="form-control" name="id_jenis_dokumen" id="id_jenis_dokumen" onchange="get_jenis_dok(this.value)" >
											<option value="">--Pilih--</option>
											<option value="1">Sertifikat</option>
											<option value="2">Akta Jual Beli</option>
											<option value="3">Girik</option>
											<option value="4">Petuk</option>
											<option value="5">Bukti Lain - Lain</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">File Dokumen</label>
									<div class="col-md-9">													
										<input type="file" name="file_tanah_upload" id="file_izin_pemanfaatan">
									</div>
								</div>
								<div id="nama_dok_lain" style="display: none;">
									<div class="form-group">
										<label class="col-md-3 control-label">Nama Jenis Dokumen Lain</label>
										<div class="col-md-9">													
											<input type="text" class="form-control" name="nama_jns_dok_lain" placeholder="Nama Jenis Dokumen Lain" autocomplete="off">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Nomor Dokumen</label>
									<div class="col-md-9">													
										<input type="text" class="form-control" name="nomor_dokumen" placeholder="Nomor Dokumen" autocomplete="off">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Tanggal Terbit</label>
									<div class="col-md-9">
										<input class="form-control input-medium date-picker" size="16" type="text" name="tgl_terbit_dokumen"/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Lokasi Tanah</label>
									<div class="col-md-9">													
										<input type="text" class="form-control" name="lokasi_tanah" placeholder="Lokasi Tanah" autocomplete="off">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Provinsi</label>
									<div class="col-md-9">	
										<select name="nama_provinsi_tanah" id="nama_provinsi_tanah" class="form-control select2me" data-placeholder="Select..." onchange="getkabkota(this.value)">
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Kab/Kota</label>
									<div class="col-md-9">	
										<select name="nama_kabkota_tanah" id="nama_kabkota_tanah" class="form-control select2me" data-placeholder="Select..." onchange="getkecamatan(this.value)">
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Kecamatan</label>
									<div class="col-md-9">	
										<select name="nama_kecamatan_tanah" id="nama_kecamatan_tanah" class="form-control select2me" data-placeholder="Select..." >
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Luas Tanah</label>
									<div class="col-md-9">													
										<input type="text" class="form-control" name="luas_tanah" placeholder="Luas Tanah" autocomplete="off">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Nama Pemegang Hak Atas Tanah</label>
									<div class="col-md-9">													
										<input type="text" class="form-control" name="nama_pemegang_hak_atas_tanah" placeholder="Nama Pemegang Hak Atas Tanah" autocomplete="off">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">No KTP Pemegang Hak Atas Tanah</label>
									<div class="col-md-9">													
										<input type="text" class="form-control" name="no_ktp_pemegang_hak_atas_tanah" placeholder="No KTP Pemegang Hak Atas Tanah" autocomplete="off">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Izin pemanfaatan dari pemegang hak atas tanah</label>
									<div class="col-md-9">													
										<div class="radio-list">
											<label><input type="radio" name="id_status_izin_pemanfaatan" id="id_status_izin_pemanfaatan1" onclick="set_id_status_izin_pemanfaatan(this.value)" value="1" > YA</label>
											<label><input type="radio" name="id_status_izin_pemanfaatan" id="id_status_izin_pemanfaatan2" onclick="set_id_status_izin_pemanfaatan(this.value)" value="2" > TIDAK </label>
										</div>
									</div>
								</div>
								<div id="izin_pemegang_hak_atas_tanah" style="display: none;">
									<hr>
									<div class="form-group">
										<label class="col-md-3 control-label">File Izin Pemanfaatan</label>
										<div class="col-md-9">													
											<input type="file" name="file_izin_pemanfaatan" id="file_izin_pemanfaatan">
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">No Dokumen izin pemanfaatan</label>
										<div class="col-md-9">													
											<input type="text" class="form-control" name="no_dok_izin_pemanfaatan" placeholder="No Dokumen izin pemanfaatan" autocomplete="off">
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Tanggal Terbi Pemanfaatan</label>
										<div class="col-md-9">
											<input class="form-control input-medium date-picker" size="16" type="text" name="tgl_terbit_pemanfaatan"/>
										</div>
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

<div id="modal-edit" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
          
         
        </div>
        <!-- /.modal-content -->
	</div>
</div>	