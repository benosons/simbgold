<script type="text/javascript">

function getjenisPermohonan(v){
	if(v == '5'){
		document.getElementById('bukan_prasarana').style.display="none";
		document.getElementById('prasarana').style.display="block";
	}else{
		document.getElementById('bukan_prasarana').style.display="block";
		document.getElementById('prasarana').style.display="none";
	}
}

function getFungsiBg(v){
	if(v == '3'){
		document.getElementById('fungsi_usaha').style.display="block";
	}else{
		document.getElementById('fungsi_usaha').style.display="none";
	}
}
</script>
<form action="<?php echo site_url('pengajuan/saveDataJenisPermohonan'); ?>" class="form-horizontal" role="form" method="post" id="from_DataBg">
	<div class="col-md-12 ">
		<div class="form-group">
			<label class="col-md-3 control-label">Jenis Permohonan</label>
			<div class="col-md-9">	
				<input type="hidden" class="form-control" value="<?php echo set_value('id', (isset($DataJenisPermohonan->id) ? $DataJenisPermohonan->id : ''))?>" name="id" placeholder="id" autocomplete="off">
				<input type="hidden" class="form-control" value="<?php echo set_value('pengajuan_id', (isset($pengajuan_id) ? $pengajuan_id : ''))?>" name="pengajuan_id" placeholder="id" autocomplete="off">
				<input type="hidden" class="form-control" value="<?php echo set_value('code_pengajuan', (isset($code_pengajuan) ? $code_pengajuan : ''))?>" name="code_pengajuan" placeholder="code_pengajuan" autocomplete="off">
				<select class="form-control" name="id_jenis_permohonan" id="id_jenis_permohonan" onchange="getjenisPermohonan(this.value)">
					<?php $id_jenis_permohonan = set_value('id_jenis_permohonan', (isset($DataJenisPermohonan->id_jenis_permohonan) ? $DataJenisPermohonan->id_jenis_permohonan : ''));?>
					<option value="">--Pilih--</option>
					<option value="1" <?php if($id_jenis_permohonan == '1') echo "selected";?>>Mendirikan Bangunan Gedung Baru</option>
					<option value="2" <?php if($id_jenis_permohonan == '2') echo "selected";?>>Bangunan Gedung Existing Belum Ber-IMB</option>
					<option value="3" <?php if($id_jenis_permohonan == '3') echo "selected";?>>Bangunan Gedung Perubahan</option>
					<option value="4" <?php if($id_jenis_permohonan == '4') echo "selected";?>>Bangunan Gedung Kolektif</option>
					<option value="5" <?php if($id_jenis_permohonan == '5') echo "selected";?>>Bangunan Gedung Prasarana</option>
					<option value="6" <?php if($id_jenis_permohonan == '6') echo "selected";?>>Bangunan Gedung IMB Bertahap</option>
				</select>
			</div>
		</div>
		
		<div id="bukan_prasarana" style="display: none;">
			<div class="form-group">
				<label class="col-md-3 control-label">Fungsi Bangunan</label>
				<div class="col-md-9">	
					<select class="form-control" name="id_fungsi_bg" id="id_fungsi_bg" onchange="getFungsiBg(this.value)">
						<?php $id_fungsi_bg = set_value('id', (isset($DataJenisPermohonan->id_fungsi_bg) ? $DataJenisPermohonan->id_fungsi_bg : ''));?>
						<option value="">--Pilih--</option>
						<option value="1" <?php if($id_fungsi_bg == '1') echo "selected";?>>Fungsi Hunian</option>
						<option value="2" <?php if($id_fungsi_bg == '2') echo "selected";?>>Fungsi Keagamaan</option>
						<option value="3" <?php if($id_fungsi_bg == '3') echo "selected";?>>Fungsi Usaha</option>
						<option value="4" <?php if($id_fungsi_bg == '4') echo "selected";?>>Fungsi Sosial dan Budaya</option>
						<option value="5" <?php if($id_fungsi_bg == '5') echo "selected";?>>Fungsi Khusus</option>
					</select>
				</div>
			</div>
			<div id="fungsi_usaha" style="display: none;">
				<div class="form-group">
					<label class="col-md-3 control-label">Jenis/Nama Usaha</label>
					<div class="col-md-9">	
						<input type="text" class="form-control" value="<?php echo set_value('nama_usaha', (isset($DataJenisPermohonan->nama_usaha) ? $DataJenisPermohonan->nama_usaha : ''))?>" name="nama_usaha" placeholder="Jenis/Nama Usaha" autocomplete="off">
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Nama Bangunan</label>
				<div class="col-md-9">	
					<input type="text" class="form-control" value="<?php echo set_value('nama_bangunan', (isset($DataJenisPermohonan->nama_bangunan) ? $DataJenisPermohonan->nama_bangunan : ''))?>" name="nama_bangunan" placeholder="Nama Bangunan Gedung Jika Memiliki Nama Bangunan" autocomplete="off">
				</div>
			</div>
		</div>
		<div id="prasarana" style="display: none;">
			<div class="form-group">
				<label class="col-md-3 control-label">Jenis Bangunan Prasarana</label>
				<div class="col-md-9">	
					<select class="form-control" name="id_jenis_bg_prasarana" id="id_jenis_bg_prasarana">
						<?php $id_jenis_bg_prasarana = set_value('id_jenis_bg_prasarana', (isset($DataJenisPermohonan->id_jenis_bg_prasarana) ? $DataJenisPermohonan->id_jenis_bg_prasarana : ''));?>
						<option value="">--Pilih--</option>
						<option value="1" <?php if($id_jenis_bg_prasarana == '1') echo "selected";?>>Kontruksi Pembatas/Penahan/Pengaman</option>
						<option value="2" <?php if($id_jenis_bg_prasarana == '2') echo "selected";?>>Konstruksi Penanda Masuk Lokasi</option>
						<option value="3" <?php if($id_jenis_bg_prasarana == '3') echo "selected";?>>Kontruksi Perkerasan</option>
						<option value="4" <?php if($id_jenis_bg_prasarana == '4') echo "selected";?>>Kontruksi Penghubung</option>
						<option value="5" <?php if($id_jenis_bg_prasarana == '5') echo "selected";?>>Kontruksi Kolam/Reservoir bawah tanah</option>
						<option value="6" <?php if($id_jenis_bg_prasarana == '6') echo "selected";?>>Kontruksi Menara</option>
						<option value="7" <?php if($id_jenis_bg_prasarana == '7') echo "selected";?>>Kontruksi Monumen</option>
						<option value="8" <?php if($id_jenis_bg_prasarana == '8') echo "selected";?>>Kontruksi Instalasi/gardu</option>
						<option value="9" <?php if($id_jenis_bg_prasarana == '9') echo "selected";?>>Kontruksi Reklame / Papan Nama</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Klasifikasi Bangunan Prasarana</label>
				<div class="col-md-9">	
					<select class="form-control" name="id_klasifikasi_bg" id="id_klasifikasi_bg">
						<?php $id_klasifikasi_bg = set_value('id_klasifikasi_bg', (isset($DataJenisPermohonan->id_klasifikasi_bg) ? $DataJenisPermohonan->id_klasifikasi_bg : ''));?>
						<option value="">--Pilih--</option>
						<option value="1" <?php if($id_klasifikasi_bg == '1') echo "selected";?>>Untuk Kepentingan Umum</option>
						<option value="2" <?php if($id_klasifikasi_bg == '2') echo "selected";?>>Bukan Untuk Kepentingan Umum</option>
					</select>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Rencana Waktu Pelaksanaan Konstruksi</label>
			<div class="col-md-9">	
				<input class="form-control input-medium date-picker" size="16" type="text" name="waktu_pelaksanaan" value="<?php echo date('m/d/Y',strtotime(set_value('waktu_pelaksanaan', (isset($DataJenisPermohonan->waktu_pelaksanaan) ? $DataJenisPermohonan->waktu_pelaksanaan : date("m/d/Y")))));?>"/>
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


<script>

$(document).ready(function() {
	
	var id_jenis_permohonan	 = "<?=(isset($DataJenisPermohonan->id_jenis_permohonan) ? $DataJenisPermohonan->id_jenis_permohonan : '')?>";
	var id_fungsi_bg		 = "<?=(isset($DataJenisPermohonan->id_fungsi_bg) ? $DataJenisPermohonan->id_fungsi_bg : '')?>";
	
	getjenisPermohonan(id_jenis_permohonan);
	getFungsiBg(id_fungsi_bg);

});

</script>