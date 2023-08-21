<div class="col-md-12">
	<h5 class="caption-subject font-red bold uppercase">Data Lengkap Pemilik</h5>
	<div class="row static-info">
		<div class="col-md-4 name">Nama Pemilik</div>
		<div class="col-md-8 value">
			<?php echo $data->nm_pemilik; ?>
		</div>
	</div>
	<div class="row static-info">
		<div class="col-md-4 name">Alamat Pemilik Bangunan</div>
		<div class="col-md-8 value">
			<?php echo $data->alamat; ?>, Kel/Desa. <?php echo $data->nama_kelurahan;?>, Kec. <?php echo $data->nama_kecamatan; ?>, <?php echo ucwords(strtolower($data->nama_kabkota)); ?>, Prov. <?php echo $data->nama_provinsi; ?>
		</div>
	</div>
	<div class="row static-info">
		<div class="col-md-4 name">Nomor Telp / Hp</div>
		<div class="col-md-8 value">
			<?php echo $data->no_hp; ?>
		</div>
	</div>
	<div class="row static-info">
		<div class="col-md-4 name">Alamat Email</div>
		<div class="col-md-8 value">
			<?php echo $data->email; ?>
		</div>
	</div>
	<?php if ($data->jenis_id =='2'){ ?>
		<div class="row static-info">
			<div class="col-md-4 name">No. KITAS</div>
			<div class="col-md-8 value"><?php echo $data->no_kitas; ?></div>
		</div>
	<?php } else { ?>
		<div class="row static-info">
			<div class="col-md-4 name">No. Identitas</div>
			<div class="col-md-8 value"><?php echo $data->no_ktp; ?></div>
		</div>
	<?php } ?>
	<div class="row static-info">
		<div class="col-md-4 name">Bentuk Kepemilikan</div>
		<div class="col-md-8 value">
			<?php echo $data->nm_pemilik; ?>
		</div>
	</div>
	<br>
	<h5 class="caption-subject font-red bold uppercase">Data Umum Bangunan Gedung</h5>
	<div class="row static-info">
		<div class="col-md-4 name">Jenis Permohonan Konsultasi</div>
		<div class="col-md-8 value">
			<?php echo $data->nm_konsultasi; ?>
		</div>
	</div>
	<div class="row static-info">
		<div class="col-md-4 name">Nama Bangunan Gedung</div>
		<div class="col-md-8 value">
			<?php echo $data->nm_bgn; ?>
		</div>
	</div>
	<div class="row static-info">
		<div class="col-md-4 name">Lokasi Bangunan Gedung</div>
		<div class="col-md-8 value">
			<?php echo $data->almt_bgn; ?>, Kel/Desa. <?php echo $data->nm_kel_bgn; ?>, Kec. <?php echo $data->nm_kec_bgn; ?>, <?php echo ucwords(strtolower($data->nm_kabkot_bgn)); ?>, Prov. <?php echo $data->nm_prov_bgn; ?>
		</div>
	</div>
	<?php if($data->id_jenis_permohonan =='11' || $data->id_jenis_permohonan =='29' || $data->id_jenis_permohonan =='30' || $data->id_jenis_permohonan =='31' || $data->id_jenis_permohonan =='32' || $data->id_jenis_permohonan =='33'){ ?>
		<div class="row static-info">
			<div class="col-md-4 name">Data Bangunan Kolektif</div>
			<div class="col-md-8 value">
				<table class="table table-striped table-bordered dt-responsive wrap" id="tipe_bgn">
					<tr>
						<th>Tipe</th>
						<th>Luas</th>
						<th>Tinggi</th>
						<th>Lantai</th>
						<th>Jumlah Unit</th>
					</tr>
					<?php
					$tipe = json_decode($data->tipeA);
					$jumlah = json_decode($data->jumlahA);
					$luas = json_decode($data->luasA);
					$tinggi = json_decode($data->tinggiA);
					$lantai = json_decode($data->lantaiA);
					$bangunan = array();
					foreach ($tipe as $noo => $val) {
						if ($val != "")
						$bangunan['tipe'][$noo] = $val;
					}
					foreach ($jumlah as $noo => $val) {
						if ($val != "")
						$bangunan['jumlah'][$noo] = $val;
					}
					foreach ($luas as $noo => $val) {
						if ($val != "")
						$bangunan['luas'][$noo] = $val;
					}
					foreach ($tinggi as $noo => $val) {
						if ($val != "")
						$bangunan['tinggi'][$noo] = $val;
					}
					if (!empty($lantai))
					foreach ($lantai as $noo => $val) {
						if ($val != "")
						$bangunan['lantai'][$noo] = $val;
					}
					$no = 0;
					if (!empty($bangunan)) {
						foreach ($bangunan['tipe'] as $dt) {
							$no++; ?>
							<tr id="tr-tipe<?php echo $no ?>">
								<td><?php echo form_input('tipeA[' . $no . ']', $bangunan['tipe'][$no], 'style="width:90px;" id="posisi' . $no . '" class="posisi' . $no . ' form-control"'); ?></td>
								<td><?php echo form_input('luasA[' . $no . ']', $bangunan['luas'][$no], 'style="width:100px;" id="luas' . $no . '" class="luas' . $no . ' form-control"'); ?></td>
								<td><?php echo form_input('tinggiA[' . $no . ']', $bangunan['tinggi'][$no], 'style="width:90px;" id="tinggi' . $no . '" class="tinggi' . $no . ' form-control"'); ?></td>
								<td><?php echo form_input('lantaiA[' . $no . ']', !empty($bangunan['lantai'][$no]) ? $bangunan['lantai'][$no] : '', 'style="width:90px;" id="lantai' . $no . '" class="lantai' . $no . ' form-control"'); ?></td>
								<td><?php echo form_input('jumlahA[' . $no . ']', $bangunan['jumlah'][$no], 'style="width:100px;" id="luas' . $no . '" class="jumlah' . $no . ' form-control"'); ?></td>
								
							</tr>
						<?php }
					} else { ?>
						<tr id="tr-tipe">
							<td><?php echo form_input('tipeA[1]', '', 'style="width:90px;" id="posisi1" class="posisi1 form-control"'); ?></td>
							<td><?php echo form_input('luasA[1]', '', 'style="width:100px;" id="luas1" class="unit1 form-control"'); ?></td>
							<td><?php echo form_input('tinggiA[1]', '', 'style="width:90px;" id="tinggi1" class="tinggi1 form-control"'); ?></td>
							<td><?php echo form_input('lantaiA[1]', '', 'style="width:90px;" id="lantai1" class="tinggi1 form-control"'); ?></td>
							<td><?php echo form_input('jumlahA[1]', '', 'style="width:100px;" id="jumlah1" class="unit1 form-control"'); ?></td>
							<td></td>
						</tr>
					<?php } ?>
				</table>
			</div>
		</div>
	<?php } else if($data->id_jenis_permohonan =='34'){ ?>
		<div class="row static-info">
			<div class="col-md-4 name">Luas Bangunan Gedung</div>
			<div class="col-md-8 value"><?php echo $data->luas_bgp; ?> m<sup>2</sup></div>
		</div>
		<div class="row static-info">
			<div class="col-md-4 name">Ketinggian Bangunan Gedung</div>
			<div class="col-md-8 value"><?php echo $data->tinggi_bgp; ?> Meter</div>
		</div>
	<?php } else { ?>
		<?php
		if(isset($id_prasarana_bg) ==1){
			$prasarana = "Kolam/Reservoir bawah tanah";
		}elseif (isset($id_prasarana_bg) ==2){
			$prasarana = "Menara";
		}elseif(isset($id_prasarana_bg) ==3){
			$prasarana = "Monument";
		}elseif(isset($id_prasarana_bg) ==4){
			$prasarana = "Instalasi/Gardu";
		}elseif(isset($id_prasarana_bg) ==5){
			$prasarana = "Reklame/Papan Nama";
		}else{
			$prasarana = "Bangunan Prasarana";
		}		
		?>
		<?php if($data->id_izin =='5'){?>
			<div class="row static-info">
				<div class="col-md-4 name">Klasifikasi Bangunan Gedung</div>
				<div class="col-md-8 value">Tidak Sederhana</div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">Luas Bangunan Gedung</div>
				<div class="col-md-8 value"><?php echo $data->luas_bgp; ?> m<sup>2</sup></div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">Ketinggian Bangunan Gedung</div>
				<div class="col-md-8 value"><?php echo $data->tinggi_bgp; ?> Meter</div>
			</div>
		<?php } else if($data->id_izin =='2'){
			if($data->permohonan_slf =='1'){ ?>
				<?php if($data->luas_bgn >='72'){
					$status_bg = 'Tidak Sederhana';
				}else{
					$status_bg ='Sederhana';
				}?>
				<div class="row static-info">
					<div class="col-md-4 name">Klasifikasi Bangunan Gedung</div>
					<div class="col-md-8 value"><?php echo $status_bg; ?></div>
				</div>
				<div class="row static-info">
					<div class="col-md-4 name">Fungsi Bangunan Gedung</div>
					<div class="col-md-8 value">
						<?php $queFungsi = $this->MDinasTeknis->get_jenis_fungsi_list($data->id_fungsi_bg)->row();
						echo $queFungsi->fungsi_bg; ?>
					</div>
				</div>
				<div class="row static-info">
					<div class="col-md-4 name">Luas Bangunan Gedung</div>
					<div class="col-md-8 value"><?php echo $data->luas_bgn; ?> m<sup>2</sup></div>
				</div>
				<div class="row static-info">
					<div class="col-md-4 name">Ketinggian Bangunan Gedung</div>
					<div class="col-md-8 value"><?php echo $data->tinggi_bgn; ?> Meter</div>
				</div>
				<div class="row static-info">
					<div class="col-md-4 name">Jumlah Lantai Bangunan Gedung</div>
					<div class="col-md-8 value"><?php echo $data->jml_lantai; ?> Lantai</div>
				</div>
				<?php if($data->luas_basement =='' || $data->luas_basement == null || $data->luas_basement =='0'){ ?>
	
				<?php } else { ?>
					<div class="row static-info">
						<div class="col-md-4 name">Luas Basement</div>
						<div class="col-md-8 value"><?php echo $data->luas_basement; ?> - m<sup>2</sup></div>
					</div>
				<?php } ?>
				<?php if($data->lapis_basement =='' || $data->lapis_basement == null || $data->lapis_basement =='0'){ ?>
	
				<?php } else { ?>
					<div class="row static-info">
						<div class="col-md-4 name">Jumlah Lantai Basement</div>
						<div class="col-md-8 value"><?php echo $data->lapis_basement; ?> - Lantai</div>
					</div>
				<?php } ?> 
			<?php }else{ ?>
				<div class="row static-info">
				<div class="col-md-4 name">Luas Bangunan Gedung</div>
					<div class="col-md-8 value"><?php echo $data->luas_bgp; ?> m<sup>2</sup></div>
				</div>
				<div class="row static-info">
					<div class="col-md-4 name">Ketinggian Bangunan Gedung</div>
					<div class="col-md-8 value"><?php echo $data->tinggi_bgp; ?> Meter</div>
				</div>
				<div class="row static-info">
					<div class="col-md-4 name">Jumlah Lantai Bangunan Gedung</div>
					<div class="col-md-8 value"><?php echo $data->jml_lantai; ?> Lantai</div>
				</div>
			<?php } ?>

		<?php }else{ ?>
			<?php if($data->luas_bgn >='72'){
				$status_bg = 'Tidak Sederhana';
			}else{
				$status_bg ='Sederhana';
			}?>
			<div class="row static-info">
				<div class="col-md-4 name">Klasifikasi Bangunan Gedung</div>
				<div class="col-md-8 value"><?php echo $status_bg; ?></div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">Fungsi Bangunan Gedung</div>
				<div class="col-md-8 value">
					<?php $queFungsi = $this->MDinasTeknis->get_jenis_fungsi_list($data->id_fungsi_bg)->row();
					echo $queFungsi->fungsi_bg; ?>
				</div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">Luas Bangunan Gedung</div>
				<div class="col-md-8 value"><?php echo $data->luas_bgn; ?> m<sup>2</sup></div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">Ketinggian Bangunan Gedung</div>
				<div class="col-md-8 value"><?php echo $data->tinggi_bgn; ?> Meter</div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">Jumlah Lantai Bangunan Gedung</div>
				<div class="col-md-8 value"><?php echo $data->jml_lantai; ?> Lantai</div>
			</div>
			<?php if($data->luas_basement =='' || $data->luas_basement == null || $data->luas_basement =='0'){ ?>

			<?php } else { ?>
				<div class="row static-info">
					<div class="col-md-4 name">Luas Basement</div>
					<div class="col-md-8 value"><?php echo $data->luas_basement; ?> - m<sup>2</sup></div>
				</div>
			<?php } ?>
			<?php if($data->lapis_basement =='' || $data->lapis_basement == null || $data->lapis_basement =='0'){ ?>

			<?php } else { ?>
				<div class="row static-info">
					<div class="col-md-4 name">Jumlah Lantai Basement</div>
					<div class="col-md-8 value"><?php echo $data->lapis_basement; ?> - Lantai</div>
				</div>
			<?php } ?>
			
		<?php } ?>
		<!--<div class="row static-info">
			<div class="col-md-4 name">Perancang Dokumen Teknis</div>
			<div class="col-md-8 value">
				Perencana Kontruksi
			</div>
		</div>-->
	<?php } ?>
</div>
