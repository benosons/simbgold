<form action="<?php echo site_url('DinasTeknis/SimpanPenugasan');?>" class="form-horizontal" role="form" method="post">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h4 align="center" class="modal-title"><b>Data Pokok Permohonan PBG-321706-28082020-01</b></h4>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-md-12 ">										
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-3 control-label">Nama Pemilik</label>
							<div class="col-md-9">													
								<input class="form-control" value="<?php echo "Freddy Nixon Sinaga";?>" placeholder="Nama Pemilik" autocomplete="off" readonly>
							</div>
						</div>
					</div>	
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 ">										
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-3 control-label">Alamat Pemilik</label>
							<div class="col-md-9">													
								<textarea class="form-control" readonly placeholder="Alamat Pemilik"><?php echo "Kp. Babakan Mekar Rt.05/Rw. 18 No. 56 Desa Bojong Koneng, Kec. Ngamprah, Kab. Bandung Barat, Prov.Jawa Barat ";?></textarea>
							</div>
						</div>
					</div>	
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 ">										
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-3 control-label">Jenis Permohonan Konsultasi</label>
							<div class="col-md-9">													
								<input class="form-control" value="<?php echo "Rumah Tinggal Bangunan  Sederhana 1 Lantai";?>" readonly>
							</div>
						</div>
					</div>	
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 ">										
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-3 control-label">Lokasi Bangunan Gedung</label>
							<div class="col-md-9">													
								<textarea class="form-control" readonly placeholder="Alamat Bangunan Gedung"><?php echo "Kp. Babakan Mekar Rt.05/Rw. 18 No. 56 Desa Bojong Koneng, Kec. Ngamprah, Kab. Bandung Barat, Prov.Jawa Barat ";?></textarea>
							</div>
						</div>
					</div>	
				</div>	
			</div>
			<div class="row">
				<div class="col-md-12 ">										
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-3 control-label">Fungsi Bangunan Gedung</label>
							<div class="col-md-9">													
								<input class="form-control" value="<?php echo "Fungsi Hunian";?> - <?php echo "Rumah Tinggal Tunggal";?>"  readonly>
							</div>
						</div>
					</div>	
				</div>	
			</div>
			<div class="row">
				<div class="col-md-12 ">										
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-3 control-label">Luas, Tinggi & Jumlah Lantai</label>
							<div class="col-md-9">
								<input class="form-control" value="<?php echo "45";?> meter persegi, dengan tinggi <?php echo "5";?> meter dan berjumlah <?php echo "1";?> lantai." readonly>
							</div>
						</div>
					</div>	
				</div>	
			</div>
			<div class="row">
				<div class="col-md-12 ">
					<div class="form-body">		
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr class="warning">
								  <th align="center" class="caption-subject bold" width="5%">No</th>
								  <th class="caption-subject bold">Nama Tim Terpilih</th>
					  
								</tr>
							</thead>
							<tbody>
								<tr class="info caption-subject bold">
								  <td align="center">1</td>
								  <td>Ryuku Zamzam S.Kom</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-12 ">										
					<div class="form-body">
					<br>
					<h4 class="caption-subject font-red bold uppercase"></h4>
					<br>
						<table class="table table-striped table-bordered table-hover">
							<tr class="warning caption-subject bold">
								<th width="3%">#</th>
								<th width="25%">Daftar Nama</th>
								<th width="20%">Unsur/Sub Unsur</th>
								<th width="20%">Bidang Keahlian</th>
								<th width="20%">Kualifikasi</th>
							</tr>	  
							<tr class="info caption-subject font-blue-hoki bold">
								<td class="clcenter">
								<input type="checkbox" name="tugas_" id="tugas_" value="" onchange="cek_tugas('tugas_','')">
								</td>
								<td class="clleft"><?php echo "Ryuku Zamzam S.Kom"; ?></td>
								<td class="clleft"><?php echo "Aparatur Sipil Negeri"; ?> - <?php echo "Unsur Tenaga Ahli"; ?></td>
								<td class="clleft"><?php echo "Bidang Arsitektur"; ?></td>
								<td class="clleft"><?php echo "Ahli Engenering"; ?></td>
							</tr>	
						</table>
					</div>	
				</div>	
			</div>
			<button id="save" name="save" type="submit" class="btn blue-hoki btn-block">Simpan</button>
		</div>
		<div class="modal-footer">
			<button type="button" onclick="return confirm('Yakin Ingin Keluar?')" data-dismiss="modal" class="btn red"> X Tutup</button>
		</div>
	</div>	
</form>
 <!--MODAL HAPUS-->
<div id="ModalHapus" class="modal fade" tabindex="-1" data-width="50%" data-focus-on="input:first">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12" align="center">
						<h4>Yakin Hapus Pemberitahuan ini?</h4>
						<a class="btn green" href="#stack2"> Ya </a>
						<a  data-dismiss="modal" class="btn red" > Tidak </a>
					</div>
				</div>
			</div>
		</div>		
	</div>
</div>
<script type="text/javascript">
function cek_tugas(kuy,ip){ 	
	  if (document.getElementById(kuy).checked) {
		$.ajax({
			url  : '<?php echo base_url('DinasTeknis/cek_tugas/'.$this->uri->segment(3))?>/'+ip+'/',
			type: 'POST',
			dataType: 'html',
			cache:false,
			success: function( response ) {
				$('div#detail_personal').html('');
				$('div#detail_personal').html(response);
			}
		});
	}else{
		$.ajax({
			url: '<?php echo base_url('DinasTeknis/uncek_tugas/'.$this->uri->segment(3))?>/'+ip+'/',
			type: 'POST',
			dataType: 'html',
			cache:false,
			success: function( response ) {
				$('div#detail_personal').html('');
				$('div#detail_personal').html(response);
			}
		});
		}
	}
</script>