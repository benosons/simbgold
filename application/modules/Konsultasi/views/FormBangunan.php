<div class="portlet light bordered margin-top-20">
	<div class="portlet-title margin-top-10">
		<div class="page-title" align="center"><span class="caption font-blue-hoki bold" style="font-size: 22px;"> Data Alamat Bangunan Gedung</span></div>
	</div>
	<div class="portlet-body form">
		<center>
			<?php echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '<button class="close" data-close="alert">' . '</button>' . '</div>' : ''; ?>
		</center>
		<form action="<?php echo site_url('Konsultasi/saveBangunan'); ?>" class="form-horizontal" role="form" method="post" id="FormBangunan">
			<input type="hidden" class="form-control" value="<?php echo set_value('id', (isset($id) ? $id : '')) ?>" name="id" placeholder="id" autocomplete="off">
			<input type="hidden" class="form-control" value="<?php echo set_value('id_bgn', (isset($DataBangunan->id_bgn) ? $DataBangunan->id_bgn : '')) ?>" name="id_bgn" placeholder="id Bangunan" autocomplete="off">
			<input type="hidden" id='csrf_id' name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
			<div class="form-body">
				<div class="form-group">
					<label class="col-md-3 control-label">Provinsi</label>
					<div class="col-md-7">
						<select name="nama_provinsi" id="nama_provinsi" class="form-control select2" data-placeholder="Select...">
							<option value="">-- Pilih Provinsi --</option>
							<?php if ($Provinsi->num_rows() > 0) {
								foreach ($Provinsi->result() as $key) {
									echo '<option value="' . $key->id_provinsi . '">' . $key->nama_provinsi . '</option>';
								}
							} ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Kab/Kota</label>
					<div class="col-md-7">
						<select name="nama_kabkota" id="nama_kabkota" class="form-control select2" data-placeholder="Select...">
							<option value="">-- Pilih Kabupaten / Kota --</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Kecamatan</label>
					<div class="col-md-7">
						<select name="nama_kecamatan" id="nama_kecamatan" class="form-control select2" data-placeholder="Select...">
							<option value="">-- Pilih Kecamatan --</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Kelurahan/Desa</label>
					<div class="col-md-7">
						<select name="nama_kelurahan" id="nama_kelurahan" class="form-control select2" data-placeholder="Select...">
							<option value="">-- Pilih Kelurahan/Desa --</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Lokasi Bangunan Gedung</label>
					<div class="col-md-7">
						<textarea type="text" class="form-control" name="almt_bgn" placeholder="Alamat Bangunan" autocomplete="off"><?php echo set_value('almt_bgn', (isset($DataBangunan->almt_bgn) ? $DataBangunan->almt_bgn : '')) ?></textarea>
					</div>
				</div>
			</div>
			<div class="portlet-title margin-top-10">
				<div class="page-title" align="center">
					<span class="caption font-blue-hoki bold" style="font-size: 22px;"> Data Bangunan Gedung</span>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3">Jenis Permohonan Konsultasi<span class="required">* </span></label>
				<div class="col-md-5">
					<?php echo form_dropdown('id_izin', $list_JnsPer, isset($DataBangunan->id_izin) ? $DataBangunan->id_izin : '', 'class ="form-control" id="id_izin" onchange="getjenisPermohonan(this.value)"'); ?>
				</div>
				<!--<div class="col-md-2">
					<a class="btn btn-info" data-toggle="modal" data-target="#modalJenis"><i class="fa fa-book left-icon"> </i></a>
				</div>-->
			</div>
			<div id="per_imb" style="display:none;">
				<div class="form-group row">
					<label class="control-label col-md-3">Memiliki IMB/PBG <span class="required">* </span></label>
					<div class="col-md-7">
						<div class="radio-list">
							<label><input type="radio" name="imb" value="1" onchange="show_slf(1);" <?= $DataBangunan->imb == 1 ? 'checked' : ''; ?>> Iya</label>
							<label><input type="radio" name="imb" value="0" onchange="show_slf(0);" <?= $DataBangunan->imb == 0 ? 'checked' : ''; ?>> Tidak</label>
						</div>
					</div>
				</div>
			</div>
			<div id="show_imb" style="display:none;">
				<div class="form-group row">
					<label class="control-label col-md-3">Nomor IMB</label>
					<div class="col-md-5">
						<div class="checkbox-list">
							<input type="text" class="form-control" maxlength="50" value="<?php echo set_value('no_imb', (isset($DataBangunan->no_imb) ? $DataBangunan->no_imb : '')) ?>" name="no_imb" placeholder="No IMB" autocomplete="off">
							<?= form_error('no_imb', '<small class="text-danger pl-3">', '</small>') ?>
						</div>
					</div>
				</div>
			</div>
			<div id="per_slf" style="display:none;">
				<div class="form-group row">
					<label class="control-label col-md-3">Memiliki SLF<span class="required">* </span></label>
					<div class="col-md-7">
						<div class="radio-list">
							<label><input type="radio" name="slf" value="1" onchange="show_cetak();" <?= $DataBangunan->slf == 1 ? 'checked' : ''; ?>> Iya</label>
							<label><input type="radio" name="slf" value="0" onchange="show_cetak();" <?= $DataBangunan->slf == 0 ? 'checked' : ''; ?>> Tidak</label>
						</div>
					</div>
				</div>
			</div>
			<div id="show_slf" style="display:none;">
				<div class="form-group row">
					<label class="control-label col-md-3">Nomor SLF</label>
					<div class="col-md-5">
						<div class="checkbox-list">
							<input type="text" class="form-control" maxlength="50" name="no_slf" placeholder="No SLF" autocomplete="off">
							<?= form_error('no_slf', '<small class="text-danger pl-3">', '</small>') ?>
						</div>
					</div>
				</div>
			</div>
			<div id="per_cetak" style="display:none;">
				<div class="form-group row">
					<label class="control-label col-md-3">Cetak Ulang<span class="required">*</span></label>
					<div class="col-md-7">
						<div class="radio-list">
							<label><input type="checkbox" name="cetak[]" value="1"> IMB/PBG</label>
							<label><input type="checkbox" name="cetak[]" value="2"> SLF</label>
							<label><input type="checkbox" name="cetak[]" value="3"> SBKBG</label>
						</div>
					</div>
				</div>
			</div>
			<div id="permohonan_slf_show" style="display:none;">
				<div class="form-group">
					<label class="control-label col-md-3">Permohonan SLF<span class="required">*</span></label>
					<div class="col-md-5">
						<?php $list_perSlf = array(
							'' => '--Pilih--',
							'1' => 'Bangunan Gedung',
							'2' => 'Bangunan Prasarana',
							'3' => 'Prototipe/Purwarupa SPBU Mikro 3 (TIGA) Kiloliter'
						);
						echo form_dropdown('permohonan_slf', $list_perSlf, isset($DataBangunan->permohonan_slf) ? $DataBangunan->permohonan_slf : '', 'class ="form-control" onchange="set_permohonan_slf(this.value)" id="permohonan_slf"'); ?>
					</div>
				</div>
			</div>
			<div id="KolektifInduk" style="display:none;">
				<div class="form-group">
					<label class="control-label col-md-3">Nama Bangunan<span class="required">*</span></label>
					<div class="col-md-7">
						<input type="text" class="form-control" value="<?php echo set_value('nama_bangunan_kolektif', (isset($DataBangunan->nm_bgn) ? $DataBangunan->nm_bgn : '')) ?>" name="nama_bangunan_kolektif" placeholder="Nama Bangunan" autocomplete="off">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3">Tipe Bangunan<span class="required">* </span></label>
					<div class="col-md-7">
						<div class="col-md-3">
							<!--<div class="form-group"><a class="btn btn-info" href="javascript:void(0);" onclick="addTipe();"><i class="fa fa-plus left-icon"> </i>Tambah Tipe</a></div>-->
							<table class="table table-striped table-bordered dt-responsive wrap" id="tipe_bgn">
								<tr>
									<th>Tipe</th>
									<th>Jumlah Unit</th>
									<th>Luas</th>
									<th>Tinggi</th>
									<th>Lantai</th>
									<th width="5%">Aksi</th>
								</tr>
								<?php
								$tipe = json_decode($DataBangunan->tipeA);
								$jumlah = json_decode($DataBangunan->jumlahA);
								$luas = json_decode($DataBangunan->luasA);
								$tinggi = json_decode($DataBangunan->tinggiA);
								$lantai = json_decode($DataBangunan->lantaiA);
								$bangunan = array();
								if (!empty($tipe))
									foreach ($tipe as $noo => $val) {
										if ($val != "")
											$bangunan['tipe'][$noo] = $val;
									}
								if (!empty($jumlah))
									foreach ($jumlah as $noo => $val) {
										if ($val != "")
											$bangunan['jumlah'][$noo] = $val;
									}
								if (!empty($luas))
									foreach ($luas as $noo => $val) {
										if ($val != "")
											$bangunan['luas'][$noo] = $val;
									}
								if (!empty($tinggi))
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
											<td><?php echo form_input('tipeA[' . $no . ']', !empty($bangunan['tipe'][$no]) ? $bangunan['tipe'][$no] : '', 'style="width:100px;" id="tipe' . $no . '" class="tipe' . $no . ' form-control"'); ?></td>
											<td><?php echo form_input('jumlahA[' . $no . ']', !empty($bangunan['jumlah'][$no]) ? $bangunan['jumlah'][$no] : '', 'style="width:100px;" id="jumlah' . $no . '" class="jumlah' . $no . ' form-control"'); ?></td>
											<td><?php echo form_input('luasA[' . $no . ']', !empty($bangunan['luas'][$no]) ? $bangunan['luas'][$no] : '', 'style="width:100px;" id="luas' . $no . '" class="luas' . $no . ' form-control"'); ?></td>
											<td><?php echo form_input('tinggiA[' . $no . ']', !empty($bangunan['tinggi'][$no]) ? $bangunan['tinggi'][$no] : '', 'style="width:100px;" id="tinggi' . $no . '" class="tinggi' . $no . ' form-control"'); ?></td>
											<td><?php echo form_input('lantaiA[' . $no . ']', !empty($bangunan['lantai'][$no]) ? $bangunan['lantai'][$no] : '', 'style="width:100px;" id="lantai' . $no . '" class="lantai' . $no . ' form-control"'); ?></td>
											<td><a class="btn btn-info" href="javascript:void(0);" onclick="if(checkDeleteTipeRow() == true){$(this).parent().parent().remove()}" title="Apakah ini akan dihapus ?"><i class="fa fa-trash left-icon"></i></a></td>
										</tr>
									<?php }
								} else { ?>
									<tr id="tr-tipe">
										<td><?php echo form_input('tipeA[1]', '', 'style="width:100px;" id="tipe1" class="tipe1 form-control"'); ?></td>
										<td><?php echo form_input('jumlahA[1]', '', 'style="width:100px;" id="jumlah1" class="jumlah1 form-control"'); ?></td>
										<td><?php echo form_input('luasA[1]', '', 'style="width:100px;" id="luas1" class="luas1 form-control"'); ?></td>
										<td><?php echo form_input('tinggiA[1]', '', 'style="width:100px;" id="tinggi1" class="tinggi1 form-control"'); ?></td>
										<td><?php echo form_input('lantaiA[1]', '', 'style="width:100px;" id="lantai1" class="lantai1 form-control"'); ?></td>
										<td><a class="btn btn-info" href="javascript:void(0);" onclick="if(checkDeleteTipeRow() == true){$(this).parent().parent().remove()}"><i class="fa fa-trash left-icon"></i></a></td>
									</tr>
								<?php } ?>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div id="fungsibg" class="form-group" style="display:none;">
				<label class="control-label col-md-3">Fungsi Bangunan<span class="required">* </span></label>
				<div class="col-md-5">
					<?php $id_fungsi_bg = set_value('id', (isset($DataBangunan->id_fungsi_bg) ? $DataBangunan->id_fungsi_bg : '')); ?>
					<?php
					$selected = '';
					if (isset($id_fungsi_bg) && $id_fungsi_bg != '')
						$selected = $id_fungsi_bg;
					else
						$selected = '';
					$js = 'id="id_fungsi_bg" onchange="set_jns_bg(this.value)" class="form-control"';
					echo form_dropdown('id_fungsi_bg', $list_fungsi, $selected, $js);
					?>
				</div>
			</div>

			<div id="jual_bg" style="display:none;">
				<div class="form-group row">
					<label class="control-label col-md-3">Bangunan akan dijual perunit bangunan<span class="required">* </span></label>
					<div class="col-md-5">
						<div class="radio-list">
							<label><input type="radio" name="jual" value="1" <?= $DataBangunan->jual == 1 ? 'checked' : ''; ?>> Iya</label>
							<label><input type="radio" name="jual" value="0" <?= $DataBangunan->jual == 0 ? 'checked' : ''; ?>> Tidak</label>
						</div>
					</div>
				</div>
			</div>
			<div id="jns_bg_toggle" class="form-group" style="display:none;">
				<label class="control-label col-md-3">Jenis Bangunan <span class="required">* </span></label>
				<div class="col-md-5">
					<?php echo form_dropdown('id_jns_bg', array('' => '--Pilih--'), isset($DataBangunan->id_jns_bg) ? $DataBangunan->id_jns_bg : '', 'id="id_jns_bg"  onchange="show_detail(this.value)" class="form-control"'); ?>
				</div>
				<!--<div class="col-md-2">
					<a class="btn btn-info"><i class="fa fa-plus left-icon"> </i></a>
				</div>-->
			</div>
			<div class="form-group" id="campurincek" style="display: none;">
				<?php
				$hunian = '';
				$keagamaan = '';
				$usaha = '';
				$sosbud = '';
				//$khusus = '';
				if ($DataBangunan->id_jns_bg != NULL) {
					$jenis = json_decode($DataBangunan->id_jns_bg);
					foreach ($jenis as $dt_cek) {
						if ($dt_cek == 1) $hunian = 'checked';
						if ($dt_cek == 2) $keagamaan = 'checked';
						if ($dt_cek == 3) $usaha = 'checked';
						if ($dt_cek == 4) $sosbud = 'checked';
						//if ($dt_cek == 5) $khusus = 'checked';
					}
				}
				?>
				<label class="control-label col-md-3">Jenis Bangunan <span class="required">*minimal 2</span></label>
				<div class="col-md-7 checkbox-inline">
					<label><input type="checkbox" class="form-control" name="dcampur[]" value="1" <?= $hunian; ?>> Hunian </label>
					<label><input type="checkbox" class="form-control" name="dcampur[]" value="2" <?= $keagamaan; ?>> Keagamaan </label>
					<label><input type="checkbox" class="form-control" name="dcampur[]" value="3" <?= $usaha; ?>> Usaha </label>
					<label><input type="checkbox" class="form-control" name="dcampur[]" value="4" <?= $sosbud; ?>> Sosial & Budaya </label>
				</div>
			</div>
			<div id="prasarana" style="display: none;">
				<div class="form-group">
					<label class="control-label col-md-3">Nama Bangunan Prasarana<span class="required">*</span></label>
					<div class="col-md-7"><input type="text" class="form-control" value="<?php echo set_value('nama_bangunan_prasarana', (isset($DataBangunan->nm_bgn) ? $DataBangunan->nm_bgn : '')) ?>" name="nama_bangunan_prasarana" placeholder="" autocomplete="off"></div>
				</div>
				<div class="form-group">
					<?php $prasarana_bg = !empty($DataBangunan->id_prasarana_bg) ? $DataBangunan->id_prasarana_bg : ''; ?>
					<label class="control-label col-md-3">Prasarana<span class="required">* </span></label>
					<div class="col-md-5">
						<select class="form-control" name="id_prasarana_bg" id="id_prasarana_bg">
							<option value="">--Pilih--</option>
							<option value="1" <?php if ($prasarana_bg == '1') echo "selected"; ?>>Kontruksi Pembatas/Penahan/Pengaman</option>
							<option value="2" <?php if ($prasarana_bg == '2') echo "selected"; ?>>Konstruksi Penanda Masuk Lokasi</option>
							<option value="3" <?php if ($prasarana_bg == '3') echo "selected"; ?>>Kontruksi Perkerasan</option>
							<option value="4" <?php if ($prasarana_bg == '4') echo "selected"; ?>>Kontruksi Penghubung</option>
							<option value="5" <?php if ($prasarana_bg == '5') echo "selected"; ?>>Kontruksi Kolam/Reservoir bawah tanah</option>
							<option value="6" <?php if ($prasarana_bg == '6') echo "selected"; ?>>Kontruksi Menara</option>
							<option value="7" <?php if ($prasarana_bg == '7') echo "selected"; ?>>Kontruksi Monumen</option>
							<option value="8" <?php if ($prasarana_bg == '8') echo "selected"; ?>>Kontruksi Instalasi/gardu</option>
							<option value="9" <?php if ($prasarana_bg == '9') echo "selected"; ?>>Kontruksi Reklame / Papan Nama</option>
							<option value="10" <?php if ($prasarana_bg == '10') echo "selected"; ?>>Fondasi mesin (diluar bangunan)</option>
							<option value="11" <?php if ($prasarana_bg == '11') echo "selected"; ?>>Kontruksi Menara Televisi</option>
							<option value="12" <?php if ($prasarana_bg == '12') echo "selected"; ?>>Kontruksi Antena Radio</option>
							<option value="13" <?php if ($prasarana_bg == '13') echo "selected"; ?>>Kontruksi Antena (Tower Telekomunikasi)</option>
							<option value="14" <?php if ($prasarana_bg == '14') echo "selected"; ?>>Tangki Tanam Bahan Bakar</option>
							<option value="15" <?php if ($prasarana_bg == '15') echo "selected"; ?>>Pekerjaan Drainase (dalam persil)</option>
							<option value="16" <?php if ($prasarana_bg == '16') echo "selected"; ?>>Kontruksi penyimpanan / silo</option>		
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3">Luas Bangunan Prasarana<span class="required">* </span></label>
					<div class="col-md-3">
						<div class="checkbox-list">
							<input type="text" class="form-control" value="<?php echo set_value('luas_bgp', (isset($DataBangunan->luas_bgp) ? $DataBangunan->luas_bgp : '')) ?>" name="luas_bgp" placeholder="Luas Bangunan" autocomplete="off">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3">Tinggi Bangunan Prasarana<span class="required">* </span></label>
					<div class="col-md-3">
						<div class="checkbox-list">
							<input type="text" class="form-control" value="<?php echo set_value('tinggi_bgp', (isset($DataBangunan->tinggi_bgp) ? $DataBangunan->tinggi_bgp : '')) ?>" name="tinggi_bgp" placeholder="Tinggi Bangunan" autocomplete="off">
						</div>
					</div>
				</div>
			</div>
			<div id="detail_bg" style="display:none;">
				<div class="form-group">
					<label class="control-label col-md-3">Nama Bangunan<span class="required">* </span></label>
					<div class="col-md-5">
						<input type="text" class="form-control" value="<?php echo set_value('nama_bangunan', (isset($DataBangunan->nm_bgn) ? $DataBangunan->nm_bgn : '')) ?>" name="nama_bangunan" placeholder="Nama Bangunan" autocomplete="off">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3">Luas Bangunan</label>
					<div class="col-md-3">
						<div class="checkbox-list">
							<input type="text" class="form-control input-comma" value="<?php echo set_value('luas_bg', (isset($DataBangunan->luas_bgn) ? $DataBangunan->luas_bgn : '')) ?>" name="luas_bg" id="luas_bg" onblur="cek()" placeholder="Luas Bangunan" autocomplete="off" pattern="[0-9]+">
						</div>
					</div>
					<label class="control-label">m<sup>2</sup></label>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3">Jumlah Lantai Bangunan<span class="required">* </span></label>
					<div class="col-md-4">
						<div class="checkbox-list">
							<select name="lantai_bg" id="lantai_bg" class="form-control dropdown-lantai">
								<?php for ($i = 1; $i < 11; $i++) {
									$selectedLantai = $i == $DataBangunan->jml_lantai ? 'selected' : '';
									echo "<option value='{$i}' ${selectedLantai}>{$i} Lantai</option>";
								} ?>
							</select>
							<input type="number" class="form-control input-lantai input-number" style="display: none;" value="<?php echo set_value('lantai_bg', (isset($DataBangunan->jml_lantai) ? $DataBangunan->jml_lantai : '')) ?>" name="lantai_bg" id="lantai_bg" onblur="cek()" placeholder="Jumlah Lantai Bangunan Gedung" autocomplete="off" disabled="">
						</div>
						<input type="checkbox" name="pilihan" id="pilihanLantai">
						<label class="control-label">Centang Apabila lebih dari 10 Lantai</label>
					</div>
					<label class="control-label"></label>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3">Tinggi Bangunan<span class="required">* </span></label>
					<div class="col-md-3">
						<div class="checkbox-list">
							<input type="text" class="form-control input-comma" value="<?php echo set_value('tinggi_bg', (isset($DataBangunan->tinggi_bgn) ? $DataBangunan->tinggi_bgn : '')) ?>" name="tinggi_bg" onblur="cek()" placeholder="Tinggi Bangunan" autocomplete="off" pattern="[0-9]+,">
						</div>
					</div>
					<label class="control-label">Meter</label>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3">Luas Basement Bangunan</label>
					<div class="col-md-3">
						<div class="checkbox-list">
							<input type="text" class="form-control input-comma" value="<?php echo set_value('luas_basement', (isset($DataBangunan->luas_basement) ? $DataBangunan->luas_basement : '')) ?>" name="luas_basement" placeholder="Luas Basement Bangunan" autocomplete="off">
						</div>
					</div>
					<label class="control-label">m<sup>2</sup></label>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3">Jumlah Lantai Basement Bangunan</label>
					<div class="col-md-4">
						<div class="checkbox-list">
							<select name="lapis_basement" id="lapis_basement" class="form-control dropdown-basement">
								<?php for ($i = 0; $i < 10; $i++) {
									$selectedBasement = $i == $DataBangunan->lapis_basement ? 'selected' : '';
									echo "<option value='{$i}' {$selectedBasement}>{$i} Lapis</option>";
								} ?>
							</select>
							<input type="number" class="form-control input-basement" style="display:none;" value="<?php echo set_value('lapis_basement', (isset($DataBangunan->lapis_basement) ? $DataBangunan->lapis_basement : '')) ?>" name="lapis_basement" placeholder="Jumlah Lantai Basement Bangunan" autocomplete="off" disabled="">
						</div>
						<input type="checkbox" name="pilihan_basement" class="input-number" id="pilihanBasement">
						<label class="control-label">Centang Apabila lebih dari 10 Lantai</label>
					</div>
					<label class="control-label"></label>
				</div>
			</div>
			<div id="spbu_micro" style="display: none;">
				<div class="form-group">
					<label class="control-label col-md-3">Nama Bangunan<span class="required">*</span></label>
					<div class="col-md-7">
						<input type="text" class="form-control" value="<?php echo set_value('nama_bangunan_prasarana', (isset($DataBangunan->nm_bgn) ? $DataBangunan->nm_bgn : '')) ?>" name="nama_bangunan_prasarana" placeholder="" autocomplete="off">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3">Luas Bangunan<span class="required">*</span></label>
					<div class="col-md-2">
						<div class="checkbox-list">
							<input type="text" class="form-control" value="10.01" name="luas_bgp1" placeholder="" autocomplete="off" readonly>
						</div>
					</div>
					<div class="col-md-2">m<sup>2</sup></div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3">Tinggi Bangunan<span class="required">*</span></label>
					<div class="col-md-2">
						<div class="checkbox-list">
							<input type="text" class="form-control" value="2.6" name="tinggi_bgp1" placeholder="Tinggi Bangunan" autocomplete="off" readonly>
						</div>
					</div>
					<div class="col-md-2">Meter</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3">Lantai Bangunan<span class="required">*</span></label>
					<div class="col-md-2">
						<div class="checkbox-list">
							<input type="text" class="form-control" value="0" name="lantai_bg1" placeholder="Lantai Bangunan" autocomplete="off" readonly>
						</div>
					</div>
				</div>
			</div>
			<div id="per_doc_tek" style="display: none;">
				<div class="form-group">
					<label class="col-md-3 control-label">Dokumen Teknis</label>
					<div class="col-md-7">
						<select name="id_doc_tek" id="id_doc_tek" onchange="set_prototype(this.value)" value="<?php echo set_value('id_doc_tek', (isset($DataBangunan->id_doc_tek) ? $DataBangunan->id_doc_tek : '')) ?>" class="form-control" data-placeholder="Select...">
						</select>
					</div>
				</div>
			</div>
			<div id="prototype" style="display: none;">
				<div class="form-group">
					<label class="col-md-3 control-label">Pilih Prototype</label>
					<div class="col-md-7">
						<select name="id_prototype" id="id_prototype" class="form-control" data-placeholder="Select...">
						</select>
					</div>
				</div>
			</div>
			<div class="form-actions">
				<center>
					<button type="submit" class="btn green">Lanjut</button>
					<button class="btn red" onClick="window.location.href = '<?php echo base_url(); ?>Konsultasi/FormPendaftaran/<?php echo $id; ?>';return false;">Kembali</button>
				</center>
			</div>
		</form>
	</div>
</div>
<script>
	$(function() {
		get_data_edit();
		$(() => {
			let lantaiBangunan = $('.input-lantai').val();
			let basementBangunan = $('.input-basement').val();
			if (parseInt(lantaiBangunan) > 10) {
				$("#uniform-pilihanLantai").find('span').addClass('checked');
				$('#pilihanLantai').attr('checked', true);
				$(".dropdown-lantai").css("display", "none");
				$(".dropdown-lantai ").attr("disabled", true);
				$(".input-lantai").attr("disabled", false);
				$(".input-lantai").css("display", "block");
			} else {
				$('#pilihanLantai').attr('checked', false);
				$(".dropdown-lantai").css("display", "block");
				$(".dropdown-lantai ").attr("disabled", false);
				$(".input-lantai").attr("disabled", true);
				$(".input-lantai").css("display", "none");
			}
			if (parseInt(basementBangunan) > 10) {
				$("#uniform-pilihanBasement").find('span').addClass('checked');
				$('#pilihanBasement').attr('checked', true);
				$(".dropdown-basement").attr("disabled", true);
				$(".input-basement").attr("disabled", false);
				$(".dropdown-basement").css("display", "none");
				$(".input-basement").css("display", "block");
			} else {
				$('#pilihanBasement').prop('checked', true);
				$(".dropdown-basement").attr("disabled", false);
				$(".input-basement").attr("disabled", true);
				$(".dropdown-basement").css("display", "block");
				$(".input-basement").css("display", "none");
			}
		});
		$(".input-number").keypress(function(e) {
			var charCode = (e.which) ? e.which : e.keyCode;
			if (charCode > 31 && (charCode < 48 || charCode > 57)) {
				return false;
			}
		});
		const regex = /[^\d.]|\.(?=.*\.)/g;
		const subst = ``;
		$('.input-comma').keyup(function() {
			const str = this.value;
			const result = str.replace(regex, subst);
			this.value = result;
		});
		$('#pilihanLantai').change(function(e) {
			e.preventDefault();
			if (this.checked) {
				$(".dropdown-lantai").css("display", "none");
				$(".dropdown-lantai ").attr("disabled", true);
				$(".input-lantai").attr("disabled", false);
				$(".input-lantai").css("display", "block");
			} else {
				$(".dropdown-lantai").css("display", "block");
				$(".dropdown-lantai ").attr("disabled", false);
				$(".input-lantai").attr("disabled", true);
				$(".input-lantai").css("display", "none");
			}
		});
		$('#pilihanBasement').change(function(e) {
			e.preventDefault();
			if (this.checked) {
				$(".dropdown-basement").attr("disabled", true);
				$(".input-basement").attr("disabled", false);
				$(".dropdown-basement").css("display", "none");
				$(".input-basement").css("display", "block");
			} else {
				$(".dropdown-basement").attr("disabled", false);
				$(".input-basement").attr("disabled", true);
				$(".dropdown-basement").css("display", "block");
				$(".input-basement").css("display", "none");
			}
		});
		$('.select2').select2();
		// Setup form validation on the #register-form element
		$("#FormBangunan").validate({
			// Specify the validation rules
			rules: {
				id_fungsi: "required",
				nib: {
					minlength: 13,
					maxlength: 13,
					required: true
				},
				'dcampur[]': {
					minlength: 2,
					required: true
				},
				nib_detail: "required",
				id_akun: "required",
				nama_pemilik: {
					required: true
				},
				id_jenis_usaha: "required",
				id_kolektif: "required",
				id_jenis_bg: "required",
				id_fungsi_bg: "required",
				almt_bgn: "required",
				nama_provinsi: "required",
				nama_kabkota: "required",
				nama_kecamatan: "required",
				nama_kelurahan: "required",
				id_jns_bg: "required",
				no_tlp: "required",
				email: {
					required: true,
					email: true
				},
				//no_ktp : "required",
				no_ktp: {
					minlength: 2,
					required: true
				},
				id_dok_tek1: {
					required: true,
				},
				nama_idp: "required",
				nama_bangunan: "required",
				luas_bg: "required",
				tinggi_bg: "required",
				lantai_bg: "required",
				no_imb: "required",
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
				id_fungsi: "Pilih Memiliki NIB Atau Tidak",
				nib: "NIB tidak terdaftar pada sistem OSS",
				nib_detail: "*",
				id_akun: "Silahkan Memilih",
				'dcampur[]': "",
				id_jenis_usaha: "Pilih Jenis Kepemilikan",
				id_jenis_bg: "Pilih Jenis Permohonan IMB",
				id_fungsi_bg: "Pilih Fungsi Bangunan",
				id_jns_bg: "Pilih Jenis Bangunan",
				id_kolektif: "Pilih Tipe Kolektif",
				nama_idp: "Pilih Tipe Prototipe",
				almt_bgn: "Masukkan Alamat Bangunan Gedung",
				nama_provinsi: "Pilih Provinsi Alamat Bangunan Gedung",
				nama_kabkota: "Pilih Kabupaten/Kota Alamat Bangunan Gedung",
				nama_kecamatan: "Pilih Kecamatan Alamat Bangunan Gedung",
				nama_kelurahan: "Pilih Kelurahan/Desa Alamat Bangunan Gedung",
				id_dok_tek1: "Pilih Jenis Dokumen Teknis",
				nama_bangunan: "Masukkan Nama Bangunan",
				luas_bgn: "Masukkan Luas Bangunan",
				tinggi_bgn: "Masukkan Tinggi Bangunan",
				lantai_bg: "Masukkan Lantai Bangunan",
				no_imb: "Masukkan No IMB/PBG",
			},
			submitHandler: function(form) {
				form.submit();
			}
		});
		var izin = $('#id_izin').val();

		getjenisPermohonan(izin);
		if (izin != 2 && izin != 4 && izin != 5 && izin != 7) {
			set_jns_bg($('#id_fungsi_bg').val());
			show_detail();
			cek_load();
		}
		if (izin == '2') {
			var permo_slf = $('#permohonan_slf').val();
			var imb = '<?= $DataBangunan->imb; ?>';
			if (imb == '1') {
				show_slf(imb);
			}
			set_permohonan_slf(permo_slf);
			if (permo_slf == '1') {
				set_jns_bg($('#id_fungsi_bg').val());
				show_detail();
				cek_load();
			}
		}
	});

	function get_data_edit() {
		$('#nama_provinsi').val('<?= isset($DataBangunan->id_prov_bgn) ? $DataBangunan->id_prov_bgn : ""; ?>').trigger('change');
		$('#nama_kabkota').val('<?= isset($DataBangunan->id_kabkot_bgn) ? $DataBangunan->id_kabkot_bgn : ""; ?>').trigger('change');
		$('#nama_kecamatan').val('<?= isset($DataBangunan->id_kec_bgn) ? $DataBangunan->id_kec_bgn : ""; ?>').trigger('change');
		$('#nama_kelurahan').val('<?= isset($DataBangunan->id_kel_bgn) ? $DataBangunan->id_kel_bgn : ""; ?>').trigger('change');
	}

	$('#nama_provinsi').change(function() {
		var v = $(this).val();
		var select = "<?= isset($DataBangunan->id_kabkot_bgn) ? $DataBangunan->id_kabkot_bgn : ""; ?>";
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>Konsultasi/getDataKabKota/' + v,
			data: $('form.form-horizontal').serialize(),
			success: function(response) {
				let data = JSON.parse(response);
				let csrf_token = data.csrf;
				$('#csrf_id').val(csrf_token);
				$('#nama_kabkota').empty();
				$('#nama_kabkota').append('<option value=""> -- Pilih -- </option>');
				delete data.csrf;
				$.each(data, function(key, value) {
					if (select == value.id_kabkot) {
						$('#nama_kabkota').append('<option value="' + value.id_kabkot + '" selected>' + value.nama_kabkota + '</option>').trigger('change');
					} else {
						$('#nama_kabkota').append('<option value="' + value.id_kabkot + '">' + value.nama_kabkota + '</option>');
					}
				});

			},
			error: function(error) {
				console.log(' Tidak Ditemukan');
			}
		});

	});


	$('#nama_kabkota').change(function() {
		var v = $(this).val();
		var select = "<?= isset($DataBangunan->id_kec_bgn) ? $DataBangunan->id_kec_bgn : ""; ?>";

		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>Konsultasi/getDataKecamatan/' + v,
			data: $('form.form-horizontal').serialize(),
			success: function(response) {
				let data = JSON.parse(response);
				let csrf_token = data.csrf;
				$('#csrf_id').val(csrf_token);
				$('#nama_kecamatan').empty();
				$('#nama_kecamatan').append('<option value=""> -- Pilih -- </option>');
				delete data.csrf;
				$.each(data, function(key, value) {
					if (select == value.id_kecamatan) {
						$('#nama_kecamatan').append('<option value="' + value.id_kecamatan + '" selected>' + value.nama_kecamatan + '</option>').trigger('change');
					} else {
						$('#nama_kecamatan').append('<option value="' + value.id_kecamatan + '">' + value.nama_kecamatan + '</option>');
					}
				});
			},
			error: function(error) {
				console.log(' Tidak Ditemukan');
			}
		});
	});

	$('#nama_kecamatan').change(function() {
		var v = $(this).val();
		var select = "<?= isset($DataBangunan->id_kel_bgn) ? $DataBangunan->id_kel_bgn : ""; ?>";

		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>Konsultasi/getDataKelurahan/' + v,
			data: $('form.form-horizontal').serialize(),
			success: function(response) {
				let data = JSON.parse(response);
				let csrf_token = data.csrf;
				$('#csrf_id').val(csrf_token);
				$('#nama_kelurahan').empty();
				$('#nama_kelurahan').append('<option value=""> -- Pilih -- </option>');
				delete data.csrf;
				$.each(data, function(key, value) {
					if (select == value.id_kelurahan) {
						$('#nama_kelurahan').append('<option value="' + value.id_kelurahan + '" selected>' + value.nama_kelurahan + '</option>').trigger('change');
					} else {
						$('#nama_kelurahan').append('<option value="' + value.id_kelurahan + '">' + value.nama_kelurahan + '</option>');
					}
				});
			},
			error: function(error) {
				console.log(' Tidak Ditemukan');
			}
		});

	});

	function cek() {
		var luas_bg = $('#luas_bg').val();
		var lantai_bg = $('#lantai_bg').val();
		if ($("#id_izin").val() == 1) {
			if ($("#id_fungsi_bg").val() == 1) {
				if (luas_bg <= 100 && lantai_bg <= 2) {
					document.getElementById('per_doc_tek').style.display = "block";
					document.getElementById('prototype').style.display = "none";
					var select_tek = '';
					var select_tek2 = '';
					var select_tek3 = '';
					var select_tek4 = '';
					var id_doc_tek = '<option value="1" ' + select_tek + '>Disediakan oleh Penyedia Jasa Konstruksi</option>';
					id_doc_tek += '<option value="2" ' + select_tek2 + '>Menggunakan Desain Prototipe</option>';
					id_doc_tek += '<option value="3" ' + select_tek3 + '>Mengembangan Desain Prototipe</option>';
					id_doc_tek += '<option value="4" ' + select_tek4 + '>Desain Berdasarkan Ketetuan Pokok Tahan Gempa</option>';
				} else {
					document.getElementById('per_doc_tek').style.display = "block";
					document.getElementById('prototype').style.display = "none";
					var id_doc_tek = '<option value="1" selected>Disediakan oleh Penyedia Jasa Konstruksi</option>';
				}
			} else {
				document.getElementById('per_doc_tek').style.display = "block";
				document.getElementById('prototype').style.display = "none";
				var id_doc_tek = '<option value="1" selected>Disediakan oleh Penyedia Jasa Konstruksi</option>';
			}
			$('#id_doc_tek').html(id_doc_tek);
		}
	}

	function cek_load() {
		var luas_bg = $('#luas_bg').val();
		var lantai_bg = $('#lantai_bg').val();
		if ($("#id_izin").val() == 1) {
			if ($("#id_fungsi_bg").val() == 1) {
				if (luas_bg <= 100 && lantai_bg <= 2) {
					document.getElementById('per_doc_tek').style.display = "block";
					document.getElementById('prototype').style.display = "none";
					if ('<?= $DataBangunan->id_doc_tek; ?>' == 1) {
						select_tek = "selected";
					} else if ('<?= $DataBangunan->id_doc_tek; ?>' == 2) {
						select_tek2 = "selected";
					} else if ('<?= $DataBangunan->id_doc_tek; ?>' == 3) {
						select_tek3 = "selected";
					} else if ('<?= $DataBangunan->id_doc_tek; ?>' == 4) {
						select_tek4 = "selected";
					} else {
						var select_tek = '';
						var select_tek2 = '';
						var select_tek3 = '';
						var select_tek4 = '';
					}
					var id_doc_tek = '<option value="1" ' + select_tek + '>Disediakan oleh Penyedia Jasa Konstruksi</option>';
					id_doc_tek += '<option value="2" ' + select_tek2 + '>Menggunakan Desain Prototipe dari Pemda</option>';
					id_doc_tek += '<option value="3" ' + select_tek3 + '>Mengembangan Desain Prototipe dari Pemda</option>';
					id_doc_tek += '<option value="4" ' + select_tek4 + '>Desain Berdasarkan Ketetuan Pokok Tahan Gempa</option>';
				} else {
					document.getElementById('per_doc_tek').style.display = "block";
					document.getElementById('prototype').style.display = "none";
					var id_doc_tek = '<option value="1" selected>Disediakan oleh Penyedia Jasa Konstruksi</option>';

				}
			} else {
				document.getElementById('per_doc_tek').style.display = "block";
				document.getElementById('prototype').style.display = "none";
				var id_doc_tek = '<option value="1" selected>Disediakan oleh Penyedia Jasa Konstruksi</option>';
			}
			$('#id_doc_tek').html(id_doc_tek);
			Load_prototype('<?= $DataBangunan->id_doc_tek; ?>');
		}
	}
	/**
	 * Custom validator for contains at least one lower-case letter
	 */
	$.validator.addMethod("atLeastOneLowercaseLetter", function(value, element) {
		return this.optional(element) || /[a-z]+/.test(value);
	}, "Must have at least one lowercase letter");
	/**
	 * Custom validator for contains at least one upper-case letter.
	 */
	$.validator.addMethod("atLeastOneUppercaseLetter", function(value, element) {
		return this.optional(element) || /[A-Z]+/.test(value);
	}, "Must have at least one uppercase letter");
	$.validator.addMethod("atLeastOneLetter", function(value, element) {
		return this.optional(element) || /[a-zA-Z]+/.test(value);
	}, "Must have at least one letter");
	/**
	 * Custom validator for contains at least one number.
	 */
	$.validator.addMethod("atLeastOneNumber", function(value, element) {
		return this.optional(element) || /[0-9]+/.test(value);
	}, "Must have at least one number");
	/**
	 * Custom validator for contains at least one symbol.
	 */
	$.validator.addMethod("atLeastOneSymbol", function(value, element) {
		return this.optional(element) || /[!@#$%^&*()]+/.test(value);
	}, "Must have at least one symbol");

	function getjenisPermohonan(v) {
		if (v == '1' || v == '3' || v == '8') {
			document.getElementById('prasarana').style.display = "none";
			document.getElementById('fungsibg').style.display = "block";
			document.getElementById('permohonan_slf_show').style.display = "none";
			document.getElementById('per_doc_tek').style.display = "none";
			document.getElementById('prototype').style.display = "none";
			document.getElementById('jual_bg').style.display = "none";
			document.getElementById('per_imb').style.display = "none";
			document.getElementById('KolektifInduk').style.display = "none";
			document.getElementById('per_slf').style.display = "none";
			document.getElementById('per_cetak').style.display = "none";
			document.getElementById('spbu_micro').style.display = "none";
		} else if (v == '2') {
			document.getElementById('prasarana').style.display = "none";
			document.getElementById('per_imb').style.display = "block";
			document.getElementById('fungsibg').style.display = "none";
			document.getElementById('permohonan_slf_show').style.display = "block";
			document.getElementById('jns_bg_toggle').style.display = "none";
			document.getElementById('detail_bg').style.display = "none";
			document.getElementById('per_doc_tek').style.display = "none";
			document.getElementById('prototype').style.display = "none";
			document.getElementById('jual_bg').style.display = "none";
			document.getElementById('KolektifInduk').style.display = "none";
			document.getElementById('per_slf').style.display = "none";
			document.getElementById('per_cetak').style.display = "none";
			document.getElementById('spbu_micro').style.display = "none";
		} else if (v == '4') {
			document.getElementById('prasarana').style.display = "none";
			document.getElementById('KolektifInduk').style.display = "block";
			document.getElementById('per_imb').style.display = "none";
			document.getElementById('fungsibg').style.display = "none";
			document.getElementById('permohonan_slf_show').style.display = "none";
			document.getElementById('jns_bg_toggle').style.display = "none";
			document.getElementById('detail_bg').style.display = "none";
			document.getElementById('per_doc_tek').style.display = "none";
			document.getElementById('prototype').style.display = "none";
			document.getElementById('jual_bg').style.display = "none";
			document.getElementById('per_slf').style.display = "none";
			document.getElementById('per_cetak').style.display = "none";
			document.getElementById('spbu_micro').style.display = "none";
		} else if (v == '5') {
			document.getElementById('prasarana').style.display = "block";
			document.getElementById('KolektifInduk').style.display = "none";
			document.getElementById('per_imb').style.display = "none";
			document.getElementById('fungsibg').style.display = "none";
			document.getElementById('permohonan_slf_show').style.display = "none";
			document.getElementById('jns_bg_toggle').style.display = "none";
			document.getElementById('detail_bg').style.display = "none";
			document.getElementById('per_doc_tek').style.display = "none";
			document.getElementById('prototype').style.display = "none";
			document.getElementById('jual_bg').style.display = "none";
			document.getElementById('per_slf').style.display = "none";
			document.getElementById('per_cetak').style.display = "none";
			document.getElementById('spbu_micro').style.display = "none";
		} else if (v == '6') {
			document.getElementById('prasarana').style.display = "none";
			document.getElementById('per_imb').style.display = "none";
			document.getElementById('fungsibg').style.display = "block";
			document.getElementById('permohonan_slf_show').style.display = "none";
			document.getElementById('jns_bg_toggle').style.display = "none";
			document.getElementById('detail_bg').style.display = "none";
			document.getElementById('per_doc_tek').style.display = "none";
			document.getElementById('prototype').style.display = "none";
			document.getElementById('jual_bg').style.display = "none";
			document.getElementById('KolektifInduk').style.display = "none";
			document.getElementById('per_slf').style.display = "none";
			document.getElementById('per_cetak').style.display = "none";
			document.getElementById('spbu_micro').style.display = "none";
		} else if (v == '7') {
			document.getElementById('prasarana').style.display = "none";
			document.getElementById('per_imb').style.display = "none";
			document.getElementById('fungsibg').style.display = "none";
			document.getElementById('permohonan_slf_show').style.display = "none";
			document.getElementById('jns_bg_toggle').style.display = "none";
			document.getElementById('detail_bg').style.display = "none";
			document.getElementById('per_doc_tek').style.display = "none";
			document.getElementById('prototype').style.display = "none";
			document.getElementById('jual_bg').style.display = "none";
			document.getElementById('KolektifInduk').style.display = "none";
			document.getElementById('per_slf').style.display = "none";
			document.getElementById('per_cetak').style.display = "none";
			document.getElementById('spbu_micro').style.display = "block";
		} else {
			document.getElementById('prasarana').style.display = "none";
			document.getElementById('per_imb').style.display = "none";
			document.getElementById('fungsibg').style.display = "none";
			document.getElementById('permohonan_slf_show').style.display = "none";
			document.getElementById('jns_bg_toggle').style.display = "none";
			document.getElementById('detail_bg').style.display = "none";
			document.getElementById('per_doc_tek').style.display = "none";
			document.getElementById('prototype').style.display = "none";
			document.getElementById('jual_bg').style.display = "none";
			document.getElementById('KolektifInduk').style.display = "none";
			document.getElementById('per_slf').style.display = "none";
			document.getElementById('per_cetak').style.display = "none";
			document.getElementById('spbu_micro').style.display = "none";
		}
	}

	function show_slf(v) {
		var slf = v;
		if (slf == '1') {
			document.getElementById('show_imb').style.display = "block";
			document.getElementById('per_slf').style.display = "block";
			document.getElementById('per_cetak').style.display = "none";
		} else {
			document.getElementById('show_imb').style.display = "none";
			document.getElementById('per_slf').style.display = "block";
		}
		show_cetak()
	}

	function show_cetak() {
		var imb = document.getElementsByName('imb');
		for (i = 0; i < imb.length; i++) {
			if (imb[i].checked)
				imb = imb[i].value;
		}
		var slf = document.getElementsByName('slf');
		for (i = 0; i < slf.length; i++) {
			if (slf[i].checked)
				slf = slf[i].value;
		}

		if (imb == '1' && slf == '1') {
			document.getElementById('per_cetak').style.display = "block";
		} else {
			document.getElementById('per_cetak').style.display = "none";
		}

		if (slf == '1') {
			document.getElementById('show_slf').style.display = "block";
		} else {
			document.getElementById('show_slf').style.display = "none";
		}
	}

	function addTipe() {
		var lastRow = $('#tipe_bgn').find("tr").length;
		var emptyrows = 0;
		for (i = 1; i < lastRow; i++) {
			if ($("#tipe" + i).val() == '') {
				emptyrows += 1;
			}
		}
		var isi = `<td><?php echo form_input("tipeA[` + lastRow +`]", "", "class=\'form-control\' style=\'width:100px;\' id=\'tipe` + lastRow + `\'"); ?></td>'`;
		isi += `<td><?php echo form_input("jumlahA[` + lastRow +`]", "", "class=\'form-control\' style=\'width:100px;\' id=\'jumlah` + lastRow + `\'"); ?></td>'`;
		isi += `<td><?php echo form_input("luasA[` + lastRow +`]", "", "class=\'form-control\' style=\'width:100px;\' id=\'luas` + lastRow + `\'"); ?></td>'`;
		isi += `<td><?php echo form_input("tinggiA[` + lastRow +`]", "", "class=\'form-control\' style=\'width:100px;\' id=\'tinggi` + lastRow +`\'"); ?></td>'`;
		isi += `<td><?php echo form_input("lantaiA[` + lastRow +`]", "", "class=\'form-control\' style=\'width:100px;\' id=\'lantai` + lastRow + `\'"); ?></td>'`;
		isi += `<td><a class="btn btn-info" href="javascript:void(0);" onclick="if(checkDeleteTipeRow() == true){$(this).parent().parent().remove()}" ><i class="fa fa-trash left-icon"></i></a></td>`;

		if (emptyrows == 0) {
			$('#tipe_bgn').children().append("<tr id='tr-tipe'>" + isi + "</tr>")
		} else {
			$('#dialog-message').attr('title', 'Perhatian').html("Silahkan mengisi data pada baris yang tersedia terlebih dahulu, sebelum menambah baris.").dialog();
		}
	}

	function checkDeleteTipeRow() {
		var tbl = $('#tipe_bgn');
		var lastRow = tbl.find("tr").length;
		if (lastRow > 2) {
			return true
		} else {
			$('#dialog-message').attr('title', 'Perhatian').html("Data tim audit tidak boleh kosong.").dialog();
			return false;
		}
	}

	function addUnit() {
		var lastRow = $('#unit_bgn').find("tr").length;
		var emptyrows = 0;
		for (i = 1; i < lastRow; i++) {
			if ($("#unit" + i).val() == '') {
				emptyrows += 1;
			}
		}
		var isi = `<td><?php echo form_input("unitA[`+lastRow+`]", "", "class=\"form-control\" style=\"width:150px;\" id=\"unit`+lastRow+`\""); ?></td>'`;

		isi += `<td><a class="btn btn-info" href="javascript:void(0);" onclick="if(checkDeleteUnitRow() == true){$(this).parent().parent().remove()}" ><i class="fa fa-trash left-icon"></i></a></td>`;

		if (emptyrows == 0) {
			$('#unit_bgn').children().append("<tr id='tr-unit'>" + isi + "</tr>")
		} else {
			$('#dialog-message').attr('title', 'Perhatian').html("Silahkan mengisi data pada baris yang tersedia terlebih dahulu, sebelum menambah baris.").dialog();
		}
	}

	function checkDeleteUnitRow() {
		var tbl = $('#unit_bgn');
		var lastRow = tbl.find("tr").length;
		if (lastRow > 2) {
			return true
		} else {
			$('#dialog-message').attr('title', 'Perhatian').html("Data tim audit tidak boleh kosong.").dialog();
			return false;
		}
	}

	function addTinggi() {
		var lastRow = $('#tinggi_bgn').find("tr").length;
		var emptyrows = 0;
		for (i = 1; i < lastRow; i++) {
			if ($("#tinggi" + i).val() == '') {
				emptyrows += 1;
			}
		}
		var isi = `<td><?php echo form_input("tinggiA[`+lastRow+`]", "", "class=\"form-control\" class=\"form-control\" style=\"width:150px;\" id=\"tinggi`+lastRow+`\""); ?></td>'`;

		isi += `<td><a class="btn btn-info" href="javascript:void(0);" onclick="if(checkDeleteTinggieRow() == true){$(this).parent().parent().remove()}" ><i class="fa fa-trash left-icon"></i></a></td>`;

		if (emptyrows == 0) {
			$('#tinggi_bgn').children().append("<tr id='tr-tinggi'>" + isi + "</tr>")
		} else {
			$('#dialog-message').attr('title', 'Perhatian').html("Silahkan mengisi data pada baris yang tersedia terlebih dahulu, sebelum menambah baris.").dialog();
		}
	}

	function checkDeleteTinggieRow() {
		var tbl = $('#tinggi_bgn');
		var lastRow = tbl.find("tr").length;
		if (lastRow > 2) {
			return true
		} else {
			$('#dialog-message').attr('title', 'Perhatian').html("Data tim audit tidak boleh kosong.").dialog();
			return false;
		}
	}

	function set_jns_bg(v) {
		if (v == 6) {
			document.getElementById('detail_bg').style.display = "block";
			document.getElementById('campurincek').style.display = "block";
			document.getElementById('jns_bg_toggle').style.display = "none";
		} else {
			document.getElementById('detail_bg').style.display = "none";
			document.getElementById('campurincek').style.display = "none";
			document.getElementById('jns_bg_toggle').style.display = "block";
			$("#jns_bg_toggle").fadeIn()

			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>Konsultasi/getDataJnsBg/" + v,
				data: $('form.form-horizontal').serialize(),
				success: function(response) {
					let data = JSON.parse(response);
					let csrf_token = data.csrf;
					$('#csrf_id').val(csrf_token);
					var jenis_bg = '<option value="">-- Pilih --</option>';
					delete data.csrf;
					$.each(data, function(key, value) {
						if (value.id_jns_bg == '<?= $DataBangunan->id_jns_bg; ?>') {
							select = "selected";
						} else {
							select = "";
						}
						jenis_bg += '<option value="' + value.id_jns_bg + '" ' + select + ' > ' + value.nm_jenis_bg + ' </option>';
					});
					$('#id_jns_bg').html(jenis_bg);
				},
				error: function(error) {
					alert(' Tidak Ditemukan');
				}
			});

			// jQuery.post(base_url + 'Konsultasi/getDataJnsBg/' + v, function(data) {
			// 	var jenis_bg = '<option value="">-- Pilih --</option>';
			// 	jQuery.each(data, function(key, value) {
			// 		if (value.id_jns_bg == '<?= $DataBangunan->id_jns_bg; ?>') {
			// 			select = "selected";
			// 		} else {
			// 			select = "";
			// 		}
			// 		jenis_bg += '<option value="' + value.id_jns_bg + '" ' + select + ' > ' + value.nm_jenis_bg + ' </option>';
			// 	});
			// 	jQuery('#id_jns_bg').html(jenis_bg);
			// 	$('#id_jns_bg').prop("disabled", false);
			// }, 'json');
		}
		if (v == '') {
			document.getElementById('jual_bg').style.display = "none";
			document.getElementById('prototype').style.display = "none";
		} else if (v == '3') {
			document.getElementById('jual_bg').style.display = "block";
			document.getElementById('per_doc_tek').style.display = "none";
			document.getElementById('prototype').style.display = "none";
		} else {
			document.getElementById('jual_bg').style.display = "none";
			document.getElementById('per_doc_tek').style.display = "none";
			document.getElementById('prototype').style.display = "none";
		}
	}

	function set_permohonan_slf(v) {
		if (v == '1') {
			document.getElementById('fungsibg').style.display = "block";
			document.getElementById('prasarana').style.display = "none";
		} else if (v == '2') {
			document.getElementById('prasarana').style.display = "block";
			document.getElementById('fungsibg').style.display = "none";
			document.getElementById('jns_bg_toggle').style.display = "none";
			document.getElementById('detail_bg').style.display = "none";
			document.getElementById('per_doc_tek').style.display = "none";
			document.getElementById('prototype').style.display = "none";
			document.getElementById('jual_bg').style.display = "none";
			document.getElementById('KolektifInduk').style.display = "none";
		} else if(v == '3'){
			document.getElementById('fungsibg').style.display = "none";
			document.getElementById('prasarana').style.display = "none";
			document.getElementById('spbu_micro').style.display = "block";
		}else{
			document.getElementById('prasarana').style.display = "none";
			document.getElementById('fungsibg').style.display = "none";
			document.getElementById('jns_bg_toggle').style.display = "none";
			document.getElementById('detail_bg').style.display = "none";
			document.getElementById('per_doc_tek').style.display = "none";
			document.getElementById('prototype').style.display = "none";
			document.getElementById('jual_bg').style.display = "none";
			document.getElementById('KolektifInduk').style.display = "none";
		}
	}
	function show_detail(v) {
		if (v == '') {
			document.getElementById('detail_bg').style.display = "none";
		} else {
			document.getElementById('detail_bg').style.display = "block";
		}
	}

	function set_prototype(v) {
		if (v == 2 || v == 3) {
			document.getElementById('prototype').style.display = "block";
			var select_1 = '';
			var select_2 = '';

			var id_type = '<option value="1" ' + select_1 + '>Type 45</option>';
			id_type += '<option value="2" ' + select_2 + '>Type 50</option>';
		} else {
			document.getElementById('prototype').style.display = "none";
		}
		$('#id_prototype').html(id_type);
	}

	function Load_prototype(v) {
		if (v == 2 || v == 3) {
			document.getElementById('prototype').style.display = "block";
			if ('<?= $DataBangunan->id_prototype; ?>' == 1) {
				select_1 = "selected";
			} else if ('<?= $DataBangunan->id_prototype; ?>' == 2) {
				select_2 = "selected";
			} else {
				var select_1 = '';
				var select_2 = '';
				var select_3 = '';
			}

			var id_type = '<option value="1" ' + select_1 + '>Type 36</option>';
			id_type += '<option value="2" ' + select_2 + '>Type 54</option>';
			id_type += '<option value="3" ' + select_3 + '>Type 72</option>';
		} else {
			document.getElementById('prototype').style.display = "none";
		}
		$('#id_prototype').html(id_type);

	}
</script>