<form action="<?php echo site_url('referensi/saveDataPersonil'); ?>" class="form-horizontal" role="form" method="post" id="form_personil">
	
		<div class="col-md-12 ">
			<div class="form-group">
				<label class="col-md-3 control-label">Nama Personil PUPR</label>
				<div class="col-md-9">	
					<input type="hidden" class="form-control" value="<?php echo set_value('id', (isset($DataPersonil->id) ? $DataPersonil->id : ''))?>" name="id" placeholder="id" autocomplete="off">
					<input type="text" class="form-control" value="<?php echo set_value('nama_pemohon', (isset($DataPersonil->nama_pemohon) ? $DataPersonil->nama_pemohon : ''))?>" name="nama_pemohon" placeholder="Nama Pemohon" autocomplete="off">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">No KTP</label>
				<div class="col-md-9">	
					<input type="text" class="form-control" value="<?php echo set_value('no_ktp', (isset($DataPersonil->no_ktp) ? $DataPersonil->no_ktp : ''))?>" name="no_ktp" placeholder="No Identitas" autocomplete="off">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Alamat</label>
				<div class="col-md-9">	
					<textarea class="form-control" rows="3" name="alamat" ><?php echo set_value('alamat', (isset($DataPersonil->alamat) ? $DataPersonil->alamat : ''))?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Provinsi</label>
				<div class="col-md-9">	
					<select name="nama_provinsi" id="nama_provinsi" class="form-control select2me" data-placeholder="Select..." onchange="getkabkota(this.value)">
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Kab/Kota</label>
				<div class="col-md-9">	
					<select name="nama_kabkota" id="nama_kabkota" class="form-control select2me" data-placeholder="Select..." onchange="getkecamatan(this.value)">
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Kecamatan</label>
				<div class="col-md-9">	
					<select name="nama_kecamatan" id="nama_kecamatan" class="form-control select2me" data-placeholder="Select...">
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">No Kontak</label>
				<div class="col-md-9">	
					<input type="text" class="form-control" value="<?php echo set_value('no_kontak', (isset($DataPersonil->no_kontak) ? $DataPersonil->no_kontak : ''))?>" name="no_kontak" placeholder="No Kontak" autocomplete="off">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Email</label>
				<div class="col-md-9">	
					<input type="text" class="form-control" value="<?php echo set_value('email', (isset($DataPersonil->email) ? $DataPersonil->email : ''))?>" name="email" placeholder="Mohon untuk Menginput Email Aktif" autocomplete="off">
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-md-3 control-label"></label>
				<div class="col-md-9">	
					<button type="submit" class="btn green">Simpan</button>
				</div>
			</div>
			
		</div>	
	
</form>
	
