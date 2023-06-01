<script language="javascript" type="text/javascript">
$(document).ready(function(){
//let's create arrays
var hunian = [
{display: "--Pilih--", value: "" },
{display: "Rumah tinggal tunggal", value: "Rumah tinggal tunggal" },
{display: "Rumah tinggal deret", value: "Rumah tinggal deret" },
{display: "Rumah tinggal susun", value: "Rumah tinggal susun" },
{display: "Rumah tinggal sementara", value: "Rumah tinggal sementara" }];

var keagamaan = [
	{display: "--Pilih--", value: "" },
	{display: "Bangunan Masjid dan Mushola", value: "Bangunan Masjid dan Mushola" },
	{display: "Bangunan Gereja & Kapel", value: "Bangunan Gereja & Kapel" },
	{display: "Bangunan Pura", value: "Bangunan Pura" },
	{display: "Bangunan Vihara", value: "Bangunan Vihara" },
	{display: "Bangunan Kelenteng", value: "Bangunan Kelenteng" }];

var usaha = [
	{display: "--Pilih--", value: "" },
	{display: "Perkantoran", value: "Perkantoran" },
	{display: "Perdagangan", value: "Perdagangan" },
	{display: "Perindustrian", value: "Perindustrian" },
	{display: "Perhotelan", value: "Perhotelan" },
	{display: "Wisata dan rekreasi", value: "Wisata dan rekreasi" },
	{display: "Terminal", value: "Terminal" },
	{display: "Bangunan gedung tempat penyimpanan", value: "Bangunan gedung tempat penyimpanan" }];

var sosmed = [
	{display: "--Pilih--", value: "" },
	{display: "Pelayanan pendidikan", value: "Pelayanan pendidikan" },
	{display: "Pelayanan kesehatan", value: "Pelayanan kesehatan" },
	{display: "Kebudayaan", value: "Kebudayaan" },
	{display: "Laboratorium", value: "Laboratorium" },
	{display: "Bangunan gedung pelayanan umum", value: "Bangunan gedung pelayanan umum" }];

var khusus = [
	{display: "--Pilih--", value: "" },
	{display: "Bangunan gedung untuk reaktor nuklir", value: "Bangunan gedung untuk reaktor nuklir" },
	{display: "Instalasi pertahanan dan keamanan", value: "Instalasi pertahanan dan keamanan" },
	{display: "Bangunan sejenis yang ditetapkan oleh Menteri", value: "Bangunan sejenis yang ditetapkan oleh Menteri" }];

var parent2 = $(".parent_selection").val();

switch(parent2){ //using switch compare selected option and populate child
		case '1':
		list2(hunian);
		break;
		case '2':
		list2(keagamaan);
		break;
		case '3':
		list2(usaha);
		break;
		case '4':
		list2(sosmed);
		break;
		case '5':
		list2(khusus);
		break;

	default: //default child option is blank
		$("#child_selection").html();
		break;
	 }
//If parent option is changed
$(".parent_selection").change(function() {
	var parent = $(this).val(); //get option value from parent
	switch(parent){ //using switch compare selected option and populate child
			case '1':
			list(hunian);
			break;
			case '2':
			list(keagamaan);
			break;
			case '3':
			list(usaha);
			break;
			case '4':
			list(sosmed);
			break;
			case '5':
			list(khusus);
			break;

		default: //default child option is blank
			$("#child_selection").html();
			break;
		 }
});

//function to populate child select box
function list(array_list)
{
$("#child_selection").html(""); //reset child options
$(array_list).each(function (i) { //populate child options
	$("#child_selection").append("<option value=\""+array_list[i].value+"\">"+array_list[i].display+"</option>");
});
}

function list2(array_list)
{
$(array_list).each(function (i) { //populate child options
	$("#child_selection").append("<option value=\""+array_list[i].value+"\">"+array_list[i].display+"</option>");
});
}

});
</script>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
			<div class="portlet-title">
			<h4 align="center" class="caption-subject font-red bold uppercase">Data Pokok Permohonan <?=(isset($data->no_konsultasi) ? $data->no_konsultasi : '')?></h4><hr/>
			<div class="row static-info">
				<div class="col-md-4 name">
					Nama Pemilik
				</div>
				<div class="col-md-8 value">
					<input class="form-control" value="<?php echo $data->nm_pemilik; ?>" placeholder="Nama Pemilik" autocomplete="off" readonly>
				</div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">
					Alamat Pemilik
				</div>
				<div class="col-md-8 value">
					<textarea class="form-control" placeholder="Alamat Pemilik" readonly><?php echo $data->alamat; ?>, Kec. <?php echo $data->nama_kecamatan; ?>, <?php echo ucwords(strtolower($data->nama_kabkota)); ?>, Prov. <?php echo $data->nama_provinsi; ?></textarea>
				</div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">
					Jenis Permohonan
				</div>
				<div class="col-md-8 value">
					<?=(isset($nama_permohonan) ? $nama_permohonan : '')?>
							<?php
							if(isset($nama_permohonan) != '' || isset($nama_permohonan) != null ){
								$status_syarat = (isset($status_syarat) ? $status_syarat : '');
								if($status_syarat == '1')
								{
									$periode = date('Y', strtotime($tgl_pemberitahuan));
									$lantai_bg = (isset($lantai_bg) ? $lantai_bg : '');
									$lama_proses = (isset($lama_proses) ? $lama_proses : '');
									
									if($lama_proses == '12/30' ){
										$lama_proses = preg_split("#/#", $lama_proses); 
										
										if($lantai_bg > 8){
											$lama_proses = $lama_proses[1];
										}else{
											$lama_proses = $lama_proses[0];
										}
										$total_hari_kerja = $con_set->jangka_waktu_pelayanan($tgl_pemberitahuan,null,$id_kabkot,$periode,$lama_proses);
									}else if($lama_proses == '0' || $lama_proses == '' || $lama_proses == null){
										$total_hari_kerja = $con_set->jangka_waktu_pelayanan($tgl_pemberitahuan,null,$id_kabkot,$periode,null);
									}else{
										$total_hari_kerja = $con_set->jangka_waktu_pelayanan($tgl_pemberitahuan,null,$id_kabkot,$periode,$lama_proses);
									}
									$total_hari_kerja = tgl_eng_to_ind($total_hari_kerja);
								}
							}
					?>
				</div>
			</div>
			<?php
					$status_syarat = (isset($status_syarat) ? $status_syarat : '');
					if($status_syarat == '1')
					{
						$tgl_pemberitahuan = tgl_eng_to_ind($tgl_pemberitahuan);
			?>
			<div class="row static-info">
				<div class="col-md-4 name">
					Tanggal Verifikasi & <br> Batas Waktu Pelayanan	:
				</div>
				<div class="col-md-8 value">
					<p class="font-red"><?=(isset($tgl_pemberitahuan)? $tgl_pemberitahuan : '');?> <i class="text-tot">sampai dengan</i>  <?=(isset($total_hari_kerja)? $total_hari_kerja : '');?><i class="text-tot">, ( <?=(isset($lama_proses)? $lama_proses : '');?> hari kerja ) <br>terhitung dari tanggal verifikasi kelengkapan berkas</i></p>
				</div>
			</div>
			<?}?>
			<div class="row static-info">
				<div class="col-md-4 name">
					Lokasi Bangunan Gedung	:
				</div>
				<div class="col-md-8 value">
					<?=(isset($jalan_lokasi)? $jalan_lokasi : '') ;?>, Kec. <?=(isset($nama_kec_bg) ? $nama_kec_bg : '');?>, <br><?=(isset($nama_kabkota_bg) ? $nama_kabkota_bg : '');?>, <?=(isset($nama_provinsi_bg) ? $nama_provinsi_bg : '') ;?>
				</div>
			</div>
			
			<? if(isset($tsarana) && $tsarana == 5){?>
			<div class="row static-info">
				<div class="col-md-4 name">
					Prasarana	:
				</div>
				<div class="col-md-8 value">
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
					<?php echo set_value('prasarana', (isset($prasarana) ? $prasarana : ''))?>
				</div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">
					Luas & Tinggi Prasarana :
				</div>
				<div class="col-md-8 value">
					<?php echo set_value('luas_prasarana', (isset($luas_prasarana) ? $luas_prasarana : ''))?> meter persegi dan tinggi <?php echo set_value('tinggi_prasarana', (isset($tinggi_prasarana) ? $tinggi_prasarana : ''))?> meter.
				</div>
			</div>
			<?}else{?>
				<? if(isset($id_jenis_permohonan) && $id_jenis_permohonan == 47){?>
				
				<div class="row static-info">
				<div class="col-md-4 name">
					Tipe Bangunan :
				</div>
				<div class="col-md-8 value">
					<?php echo set_value('tipeA', (isset($tipeA) ? $tipeA : ''))?> || <?php echo set_value('tipeB', (isset($tipeB) ? $tipeB : ''))?> || <?php echo set_value('tipeC', (isset($tipeC) ? $tipeC : ''))?> || <?php echo set_value('tipeD', (isset($tipeD) ? $tipeD : ''))?>
				</div>
				</div>
				
				<div class="row static-info">
				<div class="col-md-4 name">
					Jumlah Unit :
				</div>
				<div class="col-md-8 value">
					<?php echo set_value('unitA', (isset($unitA) ? $unitA : ''))?> || <?php echo set_value('unitB', (isset($unitB) ? $unitB : ''))?> || <?php echo set_value('unitC', (isset($unitC) ? $unitC : ''))?> || <?php echo set_value('unitD', (isset($unitD) ? $unitD : ''))?>
				</div>
				</div>
				
				<div class="row static-info" style="display: none;">
				<div class="col-md-4 name">
					Luas Bangunan :
				</div>
				<div class="col-md-8 value">
					<?php echo set_value('luasA', (isset($luasA) ? $luasA : ''))?> M<sup>2</sup> || <?php echo set_value('luasB', (isset($luasB) ? $luasB : ''))?> M<sup>2</sup> || <?php echo set_value('luasC', (isset($luasC) ? $luasC : ''))?> M<sup>2</sup> || <?php echo set_value('luasD', (isset($luasD) ? $luasD : ''))?> M<sup>2</sup>
				</div>
				</div>
				
				<div class="row static-info">
				<div class="col-md-4 name">
					Tinggi Bangunan :
				</div>
				<div class="col-md-8 value">
					<?php echo set_value('tinggiA', (isset($tinggiA) ? $tinggiA : ''))?> Meter || <?php echo set_value('tinggiB', (isset($tinggiB) ? $tinggiB : ''))?> Meter || <?php echo set_value('tinggiC', (isset($tinggiC) ? $tinggiC : ''))?> Meter || <?php echo set_value('tinggiD', (isset($tinggiD) ? $tinggiD : ''))?> Meter
				</div>
				</div>
				<?}else{?>
			<div class="row static-info">
				<div class="col-md-4 name">
					Fungsi Bangunan Gedung	:
				</div>
				<div class="col-md-8 value">
					<?php echo set_value('fungsi_bg', (isset($fungsi_bg) ? $fungsi_bg : ''))?> - <?php echo set_value('jns_bangunan', (isset($jns_bangunan) ? $jns_bangunan : ''))?>
				</div>
			</div>
			
			<div class="row static-info">
				<div class="col-md-4 name">
					Luas, Tinggi & Jumlah Lantai	:
				</div>
				<div class="col-md-8 value">
					<?=(isset($luas_bgn) ? $luas_bgn : '')?> m<sup>2</sup>, dengan tinggi <?=(isset($tinggi) ? $tinggi : '')?> meter dan berjumlah <?=(isset($lantai) ? $lantai : '')?> lantai.
				</div>
			</div>
				<?}?>
			<?}?>
			<hr/>
			<?php
				echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-'.$this->session->flashdata('status').'">'.$this->session->flashdata('message').'</div>' : '';    
			?>
			<div class="tabbable-custom nav-justified">
				<ul id="tabdp3" class="nav nav-tabs nav-justified">
					<li class="active">
						<a href="#ps" data-toggle="tab">
						Penjadwalan Sidang</a>
					</li>
					<li>
						<a href="#simak" data-toggle="tab">
						SIMAK KRK & Persyaratan Teknis
						</a>
					</li>
					<li>
						<a href="#hs" data-toggle="tab">
						Hasil Sidang</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane fade active in" id="ps">
						<br>		
						<div  class="row">
							<input type="text" style="display: none;" name='id_jadwal' id='id_jadwal' value='<?php echo set_value('id_jadwal', (isset($id_jadwal) ? $id_jadwal : ''))?>' />
							<div class="col-md-6">										
								<form action="<?php echo site_url('Pemeriksaan/JadwalForm/'.$id); ?>" role="form" method="post" id="jsnya" enctype="multipart/form-data">
									<div class="form-body">
										<div class="row">
											<div class="col-md-4">
												<div class="form-group form-md-line-input">
												<div class="input-group">
														<span class="input-group-addon">
														<i class="fa fa-circle"></i>
														</span>
												<select class="form-control" name="sidang_ke" id="sidang_ke">
												<option value="" >Pilih</option>
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												</select>	
														<label for="form_control_1">Sidang ke</label>
													</div>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group form-md-line-input">
												<?php 
													if (isset($tanggal_sidang) && $tanggal_sidang != '0000-00-00')
														$tgl =  tgl_eng_to_ind($tanggal_sidang);
													else
														$tgl = '';
												?>
													<div class="input-group">
														<span class="input-group-addon">
														<i class="fa fa-calendar"></i>
														</span>
														<input class="form-control date-picker" id="tanggal_sidang" name="tanggal_sidang" type="text" value='<?=$tgl?>' data-date-format="yyyy-mm-dd" placeholder="2000/12/31"/>
														<label for="form_control_1">Tanggal Sidang</label>
														
													</div>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group form-md-line-input">
													<div class="input-group">
														<span class="input-group-addon">
														<i class="fa fa-clock-o"></i>
														</span>
														<input name="jam_sidang" class="form-control" value='<?php echo set_value('jam_sidang', (isset($jam_sidang) ? $jam_sidang : ''))?>' id="jam_sidang" type="text" placeholder="00.00">
														<label for="form_control_1">Jam Sidang</label>
														
													</div>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group form-md-line-input">
														<textarea class="form-control" rows="2" placeholder="Tempat / Keterangan" id="ketempat" name="ketempat" value='<?php echo set_value('ket_sidang', (isset($ket_sidang) ? $ket_sidang : ''))?>'></textarea>
														<label for="form_control_1">Tempat / Keterangan</label>
												</div>
											</div>
											<div class="col-md-12" style="display: none;">
												<div class="form-group form-md-line-input">
														<input name="email" class="form-control" value='<?php echo set_value('email', (isset($email) ? $email : ''))?>' id="email" type="text" placeholder="00.00">
														<input name="noreg" class="form-control" value='<?php echo set_value('noreg', (isset($nomor_registrasi) ? $nomor_registrasi : ''))?>' id="noreg" type="text" placeholder="00.00">
														<label for="form_control_1">email</label>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group form-md-line-input">	
													
													<input style="display: none;" name="dir_file_u" id="dir_file_u" onchange='cokok()'>
													<input type="file" class="form-control" name="d_file_u" id="d_file_u" onchange='cokok()'>
													<label for="form_control_1">Unggah Undangan Sidang</label>
												</div>
											</div>	
										</div>
									</div>
								</form>	
							</div>
							<div class="col-md-6">										
								<form role="form">
									<div class="form-body">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group form-md-line-input">
													<input  style="display: none;" name='jmlPegawai' id='jmlPegawai' value="<?=set_value('jmlPegawai',isset($jmlPegawai) ? $jmlPegawai : '0')?>">
													<input  style="display: none;" name='jumPegUp' id='jumPegUp' value="<?=set_value('jmlPegawai',isset($jmlPegawai) ? $jmlPegawai : '')?>">
													<table class="table table-bordered table-striped table-hover">
														<thead>
															<tr class="info">
																<th><center>#</center></th>
																<th>Nama Tim TABG / Teknis</th>
																<th>Unsur</th>
																<th>Bidang Keahlian</th>
																<th>Kualifikasi</th>
															</tr>
														</thead>
														<tbody id="daftar_pegawai">
															<?php 
																$idpeg = '';
																if (isset($jmlPegawai) && $jmlPegawai > 0) { 
																	for($j=0;$j<$jmlPegawai;$j++) { 
															?>
															<tr id="list_peg-<?=$j?>">
																<td><input style="display: none;" name='id_peg-<?=$j?>' id='id_peg-<?=$j?>' value='<?=$result_peg[$j]['id_personal']?>'></td>
															<?	
																if (isset($result_peg[$j]['glr_depan']) && trim($result_peg[$j]['glr_depan']) != '')
																	$glrdpn = $result_peg[$j]['glr_depan'].' ';
																else
																	$glrdpn = '';
																			
																if (isset($result_peg[$j]['glr_belakang']) && trim($result_peg[$j]['glr_belakang']) != '')
																	$glrblk = ', '.$result_peg[$j]['glr_belakang'];
																else
																	$glrblk = '';
																			
																if (isset($result_peg[$j]['nama_personal']) && trim($result_peg[$j]['nama_personal']) != '')
																	$nma = $result_peg[$j]['nama_personal'];
																else
																	$nma = '';
																			
																$namapeg = $glrdpn . $nma . $glrblk;	
															?>
																<td><input style="display: none;" name='nama_peg-<?=$j?>' id='nama_peg-<?=$j?>' value='<?=$namapeg?>'><? echo $namapeg;?></td>
																<td><input style="display: none;" name='unsur-<?=$j?>' id='unsur-<?=$j?>' value='<?=$result_peg[$j]['nama_unsur']?>'><? echo $result_peg[$j]['nama_unsur'];?></td>
																<td><input style="display: none;" name='bidang-<?=$j?>' id='bidang-<?=$j?>' value='<?=$result_peg[$j]['nama_bidang']?>'><? echo $result_peg[$j]['nama_bidang'];?></td>
																<td><input style="display: none;" name='keahlian-<?=$j?>' id='keahlian-<?=$j?>' value='<?=$result_peg[$j]['nama_keahlian']?>'><? echo $result_peg[$j]['nama_keahlian'];?></td>
															</tr>
																<?php 
																		$idpeg .= $result_peg[$j]['id_personal']."~";
																	}
																} ?>
														</tbody>
													</table>	
												</div>
											</div>
										</div>
									</div>
								</form>	
							</div>
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12">
										<hr/>
										<table class="table table-bordered table-striped table-hover">
													<tbody>
														<tr class="info">
															<th><center>Sidang Ke</center></th>
															<th><center>Tanggal</center></th>
															<th><center>Jam</center></th>
															<th><center>Tempat / Keterangan</center></th>
															<th><center>Berkas Undangan</center></th>
														</tr>
														<?php
														if($jumdata_penjadwalan==0){?>
															<td colspan=5>
															<br>
															<div class="alert alert-danger" align="center">
																<strong>Pemberitahuan !</strong> ANDA BELUM MEMPUNYAI JADWAL SIDANG AKTIF, MOHON INPUT DAFTAR SIDANG.
															</div>
															</td>
														<?}else{
															$no= 1;
															for($i=0;$i<count($results_penjadwalan);$i++) {
														?>

														<tr id="record">
															
															<td ><center><?php echo $results_penjadwalan[$i]['konsultasi'];?></center></td>
															<td ><?php echo tgl_eng_to_ind($results_penjadwalan[$i]['tgl_konsultasi']);?></td>
															<td ><?php echo $results_penjadwalan[$i]['jam_konsultasi'];?></td>	
															<td ><?php echo $results_penjadwalan[$i]['ket_konsultasi'];?></td>
															<?
																if($results_penjadwalan[$i]['dir_file_undangan'] != null){?>
																<td align="center">
																	<a href="javascript:void(0);" class="btn btn-success btn-sm" title="Lihat Berkas" onClick="javascript:popWin('<?php echo base_url('file/imb/pengajuan_imb/'.$id.'/sidang_n_penilaian/undangan_sidang/'.$results_penjadwalan[$i]['dir_file_undangan']);?>')"><span class="glyphicon glyphicon-file"></span></a>
																</td>	
																<?}else{?>
																<td align="center">
																	<? echo " Tidak Ada Berkas";?>
																</td>
															<?}?>
														</tr>
														<?php  
																$no++;
															} // endfor result
														} // endif jum_data
														?>
													
													</tbody>
												</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="simak">
						<div  class="row">						
							<br>
							<h4 class="caption-subject font-red bold uppercase">Penilaian Ketentuan Teknis</h4><hr/>	
							<form action="<?php echo site_url('penjadwalan/penilaian_form/'.$id); ?>" role="form" method="post" id="penpnya" enctype="multipart/form-data">
								<div class="form-body">
									<table class="table table-bordered table-striped table-hover">
										<tbody>
											<tr>
												<th rowspan="2"class="info"><center>No</center></th>
												<th colspan="3"class="info"><center>Persyaratan</center></th>
												<th colspan="2" class="danger"><center>Perbaikan dari TIM TABG / Teknis</center></th>
												<th rowspan="2"class="info"><center>Berkas Perbaikan</center></th>
											</tr>
											<tr >
												<th class="info">Nama</th>
												<th class="info">Detail</th>
												<th class="info" >Berkas</th>
												<th class="danger">Kesesuaian</th>
												<th class="danger"><center>Catatan & Dokumen</center></th>
											</tr>
							<?php
								$jns_syarat_sblm = '';
								$detail_jns_syarat_sblm = '';
								$cek = '';
								$cek_kesesuaian = 0;
								$i= 1 ;
								foreach ($results as $row) {								
									if ($i % 2== 0 )
										$clss = "info";
									else
										$clss = "";
							?>		  
							<tr class="<?=$clss?>">
								<td><?php echo $i?></td>
										<?
											$detail = $row->id_jenis_persyaratan;
											if($detail != $jns_syarat_sblm){
												if ($detail == '1'){
													echo "";
												}else if ($detail=='2'){
													echo "";
												}
											}else{
												echo '';
											}
										$status = "";
										$query = $this->MPemeriksaan->get_syarat($row->id_detail,$this->uri->segment('3'))->result_array();
										for($n=0;$n<count($query);$n++) {
										$cek = $query[$n]['id_detail'];
										$cek = $query[$n]['id_detail'];
										$dir = $query[$n]['dir_file'];
										$status = $query[$n]['status'];
										}
										?>
								<td >
								<?
									$detail_jenis_persyaratan = $row->id_detail;
									if($detail_jenis_persyaratan != $detail_jns_syarat_sblm){
									if ($detail_jenis_persyaratan == '2'){
										echo "Rencana Arsitektur";
									}else if ($detail_jenis_persyaratan=='3'){
										echo "Rencana Struktur";
									}else if ($detail_jenis_persyaratan=='4'){
										echo "Rencana Utilitas";
									}else if ($detail_jenis_persyaratan=='5'){
										echo "Perizinan dan/ atau Rekomendasi lainnya";
									}
									}else{
										echo '';
									}
								?>
								</td>
								<td ></td>
								<td >
										<? if($row->id_detail == $cek){?>
										<center>	
											<? if($dir != ''){?>
												<a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/imb/pengajuan_imb/'.$id.'/data_teknis/'.$dir);?>')" class="btn default btn-xs blue-stripe" >Lihat</a>
											<?php }?>
										</center>
										<?php }?>
								</td>

								<?
									$cat = "";
									$radio1 = "";
									$radio2 = "";
									$kesesuaian = "";
									$dir_file_hasil_perbaikan = "";
									$id_penilaian = "";
									
									
									$id_detail = $row->id_detail;
									$query_data_penilain = $this->MPemeriksaan->getPenilaianKetentuan($id_detail,$this->uri->segment('3'))->result_array();
									
									for($n=0;$n<count($query_data_penilain);$n++) {
										$cat = $query_data_penilain[$n]['catatan'];
										$kesesuaian = $query_data_penilain[$n]['kesesuaian'];
										$dir_file_hasil_perbaikan = $query_data_penilain[$n]['dir_file_hasil_perbaikan'];
										$id_penilaian = $query_data_penilain[$n]['id_penilaian'];
										$dir_file_hasil_perbaikan_pemohon = $query_data_penilain[$n]['dir_file_hasil_perbaikan_pemohon'];
									}
									
									if($kesesuaian==1)
									{
										$cek_kesesuaian = $cek_kesesuaian+1;
										$radio1 = "checked";
									}else if($kesesuaian==2){
										$radio2 = "checked";
									}
								?>
								
								<td>
									<input type="radio" class="icheck" name="kesesuaian_<?=$id_detail?>" value="1" id="kesesuaian1" <?=$radio1?>> Sesuai
									<br>
									<input type="radio" class="icheck" name="kesesuaian_<?=$id_detail?>" value="2" id="kesesuaian2" <?=$radio2?>> Tidak
								</td>
								<td>
									<?php print form_textarea('cat_'.$id_detail,set_value('cat',(isset($cat)?$cat:'')),'id="cat_<?=$id_detail?>" name="cat_<?=$id_detail?>" class="form-control" placeholder="Isi Catatan" style="width:200px; height:50px;"')?>
									<input type="text" name="id_nilai_<?=$id_detail?>" id="id_nilai_<?=$id_detail?>" value="<?=$id_penilaian?>" style="display: none;">
									<input type="hidden" name="id_penilaian" value="<?=$id_penilaian?>">
								
								<td>
										
										<? if(isset($dir_file_hasil_perbaikan_pemohon) != ""){?>
											<a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/imb/pengajuan_imb/'.$id.'/sidang_n_penilaian/perbaikan_sidang/'.$dir_file_hasil_perbaikan_pemohon);?>')" class="btn default btn-xs blue-stripe" >Lihat</a>
										<?php }else{?>
											
										<?}?>
								
								</td>
							</tr>	
							<?php 

								$i++;
								$jns_syarat_sblm = $detail;
								$detail_jns_syarat_sblm = $detail_jenis_persyaratan;
								}
								
								$total_pt = count($results);
								
							?>
						</tbody>
						</table>
						<button type="submit" class="btn blue-hoki btn-block">Simpan</button>
								</div>
							</form>		
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="hs">
								<br>
								<table class="table table-bordered table-striped table-hover">
								<tbody>
								<tr class="info">
									<th><center>Konsultasi Ke</center></th>
									<th><center>Rekomendasi / Hasil Konsultasi</center></th>
									<th><center>Catatan</center></th>
									<th><center>Berkas Rekomendasi / Hasil KOnsultasi</center></th>
								</tr>
								<?php
								if($jumdata_penjadwalan==0){?>
									<td colspan=4>
									<br>
									<div class="alert alert-danger" align="center">
										<strong>Pemberitahuan !</strong> ANDA BELUM MEMPUNYAI JADWAL SIDANG AKTIF, MOHON INPUT DAFTAR SIDANG.
									</div>
									</td>
								<?}else{
									$no= 1;
									for($i=0;$i<count($results_penjadwalan);$i++) {
										if($results_penjadwalan[$i]['hsl_konsultasi'] == 1){
											$status ="Dengan Perbaikan";
										}else if($results_penjadwalan[$i]['hsl_konsultasi'] == ''){
											$status ="Belum di Input";
										}else if($results_penjadwalan[$i]['hsl_konsultasi'] == 3){
											$status ="Permohonan Ditolak";
										}else{
											$status ="Tanpa Perbaikan";
										}
								?>
								<tr>
									<td ><center><?php echo $results_penjadwalan[$i]['konsultasi'];?></center></td>
									<td ><?php echo $status;?></td>
									<td ><?php echo $results_penjadwalan[$i]['cat_konsultasi'];?></td>
									<td align="center">
									<? if ($status=="Belum di Input"){?>
										<a href="#" onClick="Xwin('<?php echo $results_penjadwalan[$i]['id_jadwal']?>')" class="label label-info" ><span class="glyphicon glyphicon-edit"> Masukan Hasil Sidang</span></a>
									<?}else{?>
										<?
											if($results_penjadwalan[$i]['dir_file_jadwal'] != null){?>
												<a href="javascript:void(0);" class="label label-success btn-sm" title="Lihat Berkas" onClick="javascript:popWin('<?php echo base_url('file/imb/pengajuan_imb/'.$id_permohonan.'/sidang_n_penilaian/rekomendasi_sidang/'.$results_penjadwalan[$i]['dir_file_jadwal']);?>')"><span class="glyphicon glyphicon-file"></span></a>
											<?}else{?>
												<? echo "Tidak Ada File" ;?>
											<?}?>
									<?}?>
									</td>
								</tr>
								<?php  
										$no++;
								}}?>
							</tbody>
						</table>		
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- /.modal -->
<div id="hasilsidangnya" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
        </div>
        <!-- /.modal-content -->
	</div>
</div>	

<div id="responsive" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog">
	<div class="modal-dialog ">
		<form action="<?php echo site_url('Pemeriksaan/HasilKonsultasiForm/'.$id); ?>" class="form-horizontal" role="form" method="post" id="hsnya" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="caption-subject font-red bold uppercase" align="center">Hasil Sidang</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 ">										
							<div class="form-body">
								<input name="email" style="display: none;" class="form-control" value='<?php echo set_value('email', (isset($email) ? $email : ''))?>' id="email" type="text" placeholder="00.00">
								<input name="noreg" style="display: none;" class="form-control" value='<?php echo set_value('noreg', (isset($nomor_registrasi) ? $nomor_registrasi : ''))?>' id="noreg" type="text" placeholder="00.00">			
								<div class="form-group">
									<label class="col-md-3 control-label">Sidang Ke</label>
									<div class="col-md-9">
										<input type="text" class="form-control" name="x_id_p" id="x_id_p" style="display: none;">
										<input type="text" class="form-control" name="x_sidangke_p" id="x_sidangke_p" autocomplete="off" readonly>
									</div>
								</div>
							</div>	
						</div>
						<div class="col-md-12 ">										
							<div class="form-body">
								<div class="form-group">
									<label class="col-md-3 control-label">Hasil Sidang</label>
									<div class="col-md-9">
										<select class="form-control" name="hsl_konsultasi" id="hsl_konsultasi">
											<option value="" >Pilih</option>
											<option value="1">Dengan Perbaikan</option>
											<option value="2">Tanpa Perbaikan</option>
											<option value="3">Permohonan Ditolak / Dikembalikan</option>
									</select>
									</div>
								</div>
							</div>	
						</div>
						<div class="col-md-12 ">										
							<div class="form-body">
								<div class="form-group">
									<label class="col-md-3 control-label">Catatan & Berkas Rekomendasi / Hasil Sidang</label>
									<div class="col-md-9">
										<textarea class="form-control" rows="2" placeholder="Keterangan Hasil Sidang" name="cat_konsultasi" id="cat_konsultasi"></textarea>
										<input style="display: none;" name="dir_file_x" id="dir_file_x" onchange='coxek()'>
										<input type="file" class="form-control" name="d_file_x" id="d_file_x" onchange='coxek()'>
									</div>
								</div>
							</div>	
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" onclick="return confirm('Yakin Ingin Membatalkan?')" data-dismiss="modal" class="btn default">Batal</button>
					<?php echo form_submit('Simpan','Simpan','class="btn green"');	?>
				</div>
			</div>	
		</form>			
	</div>
</div>

<script type="text/javascript">
	
	$('#d_file_jad').change(function() {
    var filename_jad = $(this).val();
    var lastIndex = filename_jad.lastIndexOf("\\");
    if (lastIndex >= 0) {
        filename_jad = filename_jad.substring(lastIndex + 1);
    }
    $('#filename_jad').val(filename_jad);
	});
	
	function popWin(x){
	url = x;
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
	}
	
	function cokok(){
		
		$('#dir_file_u').val(d_file_u.value);
	}
	
	function cokek(){
		
		$('#dir_file_dok').val(d_file_dok.value);
	}
	
	function cocok(){
		
		$('#dir_file1').val(d_file1.value);
	}
	
	function coxek(){
		
		$('#dir_file_x').val(d_file_x.value);
	}
	
	function Xwin(id){
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('Pemeriksaan/hasil_sidangnya/')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                	$.each(data,function(){
                    	$('#responsive').modal('show');
						$('[name="x_id_p"]').val(data.id_jadwal);
						$('[name="x_sidangke_p"]').val(data.konsultasi);
            		});
                }
            });
            return false;
        };
	
	$(function () {    
	 // Setup form validation on the #register-form element
	$("#hsnya").validate({
	    // Specify the validation rules
	    rules: {
			x_status_p: "required",
	        //x_cat_p: "required",
			d_file_x: "required",
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
			x_status_p: "Tentukan Hasil Sidang",
	        //x_cat_p: "Masukan Catatan",
			d_file_x: "Unggah Hasil Sidang",
	    },
	    
	    submitHandler: function(form) {
	    	form.submit();
	    }
	});
	});
	
	$(function () {    
	 // Setup form validation on the #register-form element
	$("#jsnya").validate({
	    // Specify the validation rules
	    rules: {
			sidang_ke: "required",
			tanggal_sidang: "required",
			jam_sidang: "required",
			
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
			sidang_ke: "Pilih Sidang",
			tanggal_sidang: "Tentukan Tanggal Sidang",
			jam_sidang: "Tentukan Jam Sidang",
			
	    },
	    
	    submitHandler: function(form) {
	    	form.submit();
	    }
	});
	});
	
	$(function () {    
	 // Setup form validation on the #register-form element
	$("#simaknya").validate({
	    // Specify the validation rules
	    rules: {
			sidang_ke: "required",
			jns_tabg: "required",
			no_dok: "required",
			tanggal_dok: "required",
			
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
			sidang_ke: "Pilih Sidang",
			jns_tabg: "Tentukan Jenis",
			no_dok: "Masukan Nomor Dokumen",
			tanggal_dok: "Tentukan Tanggal Dokumen",
			
	    },
	    
	    submitHandler: function(form) {
	    	form.submit();
	    }
	});
	});

	function getkabkota_bg(v) {
		$("#nama_kabkota_toggle").fadeIn()
		jQuery.post(base_url + 'penjadwalan/getDataKabKota/' + v, function(data) {
			var nama_kabkota_bg = '<option value="">-- Pilih Kabupaten / Kota --</option>';
			jQuery.each(data, function(key, value) {
				nama_kabkota_bg += '<option value="' + value.id_kabkot + '"> ' + value.nama_kabkota + ' </option>';
			});

			jQuery('#nama_kabkota_bg').html(nama_kabkota_bg);
			$('#nama_kabkota_bg').prop("disabled", false);
		}, 'json');
	}

	function getkecamatan_bg(v) {
		$("#nama_kecamatan_toggle").fadeIn()
		jQuery.post(base_url + 'penjadwalan/getDataKecamatan/' + v, function(data) {
			var nama_kecamatan_bg = '<option value="">-- Pilih Kecamatan --</option>';
			jQuery.each(data, function(key, value) {
				nama_kecamatan_bg += '<option value="' + value.id_kecamatan + '"> ' + value.nama_kecamatan + ' </option>';
			});
			jQuery('#nama_kecamatan_bg').html(nama_kecamatan_bg);
			$('#nama_kecamatan_bg').prop("disabled", false);
		}, 'json');
	}
	function getkabkota(v) {
		$("#nama_kabkota_toggle").fadeIn()
		jQuery.post(base_url + 'penjadwalan/getDataKabKota/' + v, function(data) {
			var nama_kabkota = '<option value="">-- Pilih Kabupaten / Kota --</option>';
			jQuery.each(data, function(key, value) {
				nama_kabkota += '<option value="' + value.id_kabkot + '"> ' + value.nama_kabkota + ' </option>';
			});

			jQuery('#nama_kabkota').html(nama_kabkota);
			$('#nama_kabkota').prop("disabled", false);
		}, 'json');
	}

	function getkecamatan(v) {
		$("#nama_kecamatan_toggle").fadeIn()
		jQuery.post(base_url + 'penjadwalan/getDataKecamatan/' + v, function(data) {
			var nama_kecamatan = '<option value="">-- Pilih Kecamatan --</option>';
			jQuery.each(data, function(key, value) {
				nama_kecamatan += '<option value="' + value.id_kecamatan + '"> ' + value.nama_kecamatan + ' </option>';
			});
			jQuery('#nama_kecamatan').html(nama_kecamatan);
			$('#nama_kecamatan').prop("disabled", false);
		}, 'json');
	}
</script>

<script type="text/javascript">

$(document).ready(function(){
	
	var gjp = document.getElementById("id_jenis_bg").value;
	var tpknya = document.getElementById("id_kolektif").value;
	var manfaatnya = document.getElementById("id_fungsi_bg").value;
	getjenisPermohonan(gjp);
	tpk(tpknya);
	set_pemanfaatan(manfaatnya);
	
});

</script>