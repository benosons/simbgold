<form action="<?php echo site_url('imb/simpanpenugasan/'.$raw->id_permohonan);?>" class="form-horizontal" role="form" method="post">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h4 align="center" class="modal-title"><b>Data Pokok Permohonan <?php echo $raw->nomor_registrasi;?></b></h4>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-md-12 ">										
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-3 control-label">Nama Pemilik</label>
							<div class="col-md-9">													
								<input class="form-control" value="<?php echo $raw->id_permohonan;?>" id="id_permohonan" name="id_permohonan" style="display: none;">
								<input class="form-control" value="<?php echo $raw->nama_pemohon;?>" placeholder="Nama Pemilik" autocomplete="off" readonly>
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
								<textarea class="form-control" readonly placeholder="Alamat Pemilik"><?php echo $raw->alamat_pemohon;?></textarea>
							</div>
						</div>
					</div>	
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 ">										
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-3 control-label">Jenis Permohonan</label>
							<div class="col-md-9">													
								<input class="form-control" value="<?php echo $raw->nama_permohonan;?>" readonly>
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
								<textarea class="form-control" readonly><?php echo $raw->alamat_bg;?> Desa/Kel. <?php echo $raw->kelurahan;?>, Kec. <?php echo $raw->kecamatan;?>, <?php echo $raw->nama_kabkota;?>.</textarea>
							</div>
						</div>
					</div>	
				</div>	
			</div>
			<? if(trim($tsarana) == 5){?>
			<div class="row">
				<div class="col-md-12 ">										
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-3 control-label">Prasarana</label>
							<div class="col-md-9">
					<?
							if($id_prasarana_bg == 1){
								$prasarana = "Kontruksi Pembatas/Penahan/Pengaman";
							}elseif ($id_prasarana_bg == 2){
								$prasarana = "Konstruksi Penanda Masuk Lokasi";
							}elseif($id_prasarana_bg == 3){
								$prasarana = "Kontruksi Perkerasan";
							}elseif($id_prasarana_bg == 4){
								$prasarana = "Kontruksi Penghubung";
							}elseif($id_prasarana_bg == 5){
								$prasarana = "Kontruksi Kolam/Reservoir bawah tanah";
							}elseif ($id_prasarana_bg == 6){
								$prasarana = "Kontruksi Menara";
							}elseif ($id_prasarana_bg== 7){
								$prasarana = "Kontruksi Monumen";
							}elseif ($id_prasarana_bg == 8){
								$prasarana = "Kontruksi Instalasi/gardu";
							}elseif ($id_prasarana_bg == 9){
								$prasarana = "Kontruksi Reklame / Papan Nama";
							}else{
								$prasarana = "Belum ditentukan";
							}		
						?>						
								<input class="form-control" value="<?php echo set_value('prasarana', (isset($prasarana) ? $prasarana : ''))?>"  readonly>
							</div>
						</div>
					</div>	
				</div>	
			</div>
			<div class="row">
				<div class="col-md-12 ">										
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-3 control-label">Luas & Tinggi Prasarana</label>
							<div class="col-md-9">
								
								<input class="form-control" value="<?php echo set_value('luas_prasarana', (isset($luas_prasarana) ? $luas_prasarana : ''))?> meter persegi dan tinggi <?php echo set_value('tinggi_prasarana', (isset($tinggi_prasarana) ? $tinggi_prasarana : ''))?> meter." readonly>
							</div>
						</div>
					</div>	
				</div>	
			</div>
			<?}else{?>
				<? if(trim($id_kolektif) == 1){?>
				<div class="row">
				<div class="col-md-12 ">										
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-3 control-label">Tipe Bangunan</label>
							<div class="col-md-9">													
								<input class="form-control"
								value="<?php echo set_value('tipeA', (isset($tipeA) ? $tipeA : ''))?> || <?php echo set_value('tipeB', (isset($tipeB) ? $tipeB : ''))?> || <?php echo set_value('tipeC', (isset($tipeC) ? $tipeC : ''))?> || <?php echo set_value('tipeD', (isset($tipeD) ? $tipeD : ''))?>"
								readonly>
							</div>
						</div>
					</div>	
				</div>	
				</div>
				<div class="row">
				<div class="col-md-12 ">										
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-3 control-label">Jumlah Unit</label>
							<div class="col-md-9">													
								<input class="form-control"
								value="<?php echo set_value('unitA', (isset($unitA) ? $unitA : ''))?> || <?php echo set_value('unitB', (isset($unitB) ? $unitB : ''))?> || <?php echo set_value('unitC', (isset($unitC) ? $unitC : ''))?> || <?php echo set_value('unitD', (isset($unitD) ? $unitD : ''))?>" 
								readonly>
							</div>
						</div>
					</div>	
				</div>	
				</div>
				<div class="row" style="display: none;">
				<div class="col-md-12 ">										
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-3 control-label">Luas (m<sup>2</sup>)</label>
							<div class="col-md-9">
								<input class="form-control"
								value="<?php echo set_value('luasA', (isset($luasA) ? $luasA : ''))?> || <?php echo set_value('luasB', (isset($luasB) ? $luasB : ''))?> || <?php echo set_value('luasC', (isset($luasC) ? $luasC : ''))?> || <?php echo set_value('luasD', (isset($luasD) ? $luasD : ''))?>"
								readonly>
							</div>
						</div>
					</div>	
				</div>	
				</div>
				<div class="row">
				<div class="col-md-12 ">										
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-3 control-label">Tinggi (m)</label>
							<div class="col-md-9">
								<input class="form-control"
								value="<?php echo set_value('tinggiA', (isset($tinggiA) ? $tinggiA : ''))?> || <?php echo set_value('tinggiB', (isset($tinggiB) ? $tinggiB : ''))?> || <?php echo set_value('tinggiC', (isset($tinggiC) ? $tinggiC : ''))?> || <?php echo set_value('tinggiD', (isset($tinggiD) ? $tinggiD : ''))?>"
								readonly>
							</div>
						</div>
					</div>	
				</div>	
				</div>
				
				<?}else{?>
			<div class="row">
				<div class="col-md-12 ">										
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-3 control-label">Fungsi Bangunan Gedung</label>
							<div class="col-md-9">													
								<input class="form-control" value="<?php echo $raw->fungsi_bg;?> - <?php echo $raw->jns_bangunan;?>"  readonly>
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
								<input class="form-control" value="<?php echo $raw->luas_bg;?> meter persegi, dengan tinggi <?php echo $raw->tinggi_bg;?> meter dan berjumlah <?php echo $raw->lantai_bg;?> lantai." readonly>
							</div>
						</div>
					</div>	
				</div>	
			</div>
				<?}?>
			<?}?>
			
			<?php if($raw->status_penugasan == 1){?>
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

				<?php
					if($rew->num_rows() > 0){
                	$no = 1;
                	foreach ($rew->result() as $bolot) {
	            ?>
	                <tr class="info caption-subject bold">
	                  <td align="center"><?php echo $no++;?></td>
					  <td><?php echo $bolot->nama_personal;?></td>
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
			<?}else{?>
			<?}?>
			<hr>
			<div class="row">
				<div class="col-md-12 ">										
					<div class="form-body">
					<br>
					<h4 class="caption-subject font-red bold uppercase"><?php echo $judul;?></h4>
					<br>
						<table class="table table-striped table-bordered table-hover">
						<tr class="warning caption-subject bold">
							<th width="3%">#</th>
							<th width="25%">Daftar Nama</th>
							<th width="20%">Unsur/Sub Unsur</th>
							<th width="20%">Bidang Keahlian</th>
							<th width="20%">Kualifikasi</th>
						</tr>
	<?php
		$i= 1 ;
		$id_sblm  = 0;
		foreach ($result as $row) {
			$id_skrg = $row->id_personal;
			if ($i % 2== 0 )
				$clss = "event";
			else
				$clss = "event2";
			
			if (isset($row->glr_depan) && trim($row->glr_depan) != '')
				$glr_dpn = $row->glr_depan.' ';
			else
				$glr_dpn = '';
				
			if (isset($row->glr_belakang) && trim($row->glr_belakang) != '')
				$glr_blk = ', '.$row->glr_belakang;
			else
				$glr_blk = '';
				
			if (isset($row->nama_personal) && trim($row->nama_personal) != '')
				$nm = $row->nama_personal;
			else
				$nm = '';
			$unsur = $row->nama_unsur." - ".$row->nama_unsur_ahli;	
			$nama_peg = $glr_dpn . $nm . $glr_blk;
			
			$check = '';
			$dataChk = array(
				'name'		  => 'pegawai-'.$row->id_personal,
				'id'          => 'pegawai-'.$row->id_personal,
				'class'       => 'selectable',
				'value'       => $row->id_personal."^".$nama_peg."^".$unsur."^".$row->nama_bidang."^".$row->nama_keahlian,
				'checked'	  => $check
			);	
	?>		  
					<tr class="info caption-subject font-blue-hoki bold">
						<!--td class="clcenter"><?php echo form_checkbox($dataChk); ?></td-->
						<td class="clcenter">
						<input type="checkbox" name="tugas_<?php echo $row->id_personal;?>" id="tugas_<?php echo $row->id_personal;?>" value="<?php echo $row->id_personal; ?>" onchange="cek_tugas('tugas_<?php echo $row->id_personal;?>','<?php echo $row->id_personal;?>')">
						</td>
						<td class="clleft"><?php echo $nama_peg; ?></td>
						<td class="clleft"><?php echo $row->nama_unsur; ?> - <?php echo $row->nama_unsur_ahli; ?></td>
						<td class="clleft"><?php echo $row->nama_bidang; ?></td>
						<td class="clleft"><?php echo $row->nama_keahlian; ?></td>
					</tr>	
	<?php 
			$id_sblm = $id_skrg;
			$i++;
		}
	?>	
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
			url  : '<?php echo base_url('imb/cek_tugas/'.$this->uri->segment(3))?>/'+ip+'/',
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
			url: '<?php echo base_url('imb/uncek_tugas/'.$this->uri->segment(3))?>/'+ip+'/',
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