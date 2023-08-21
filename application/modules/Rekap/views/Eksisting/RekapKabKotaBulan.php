<script type="text/javascript">
function resetCari() {	
	var url = "<?php echo base_url() . index_page() ?>Rekap/RekapKab/";
	$('#loading').fadeIn();
	$.getJSON( baseHref + 'Rekap/killSession/' ,
		function() {
			window.location.replace(url);
		}
	);
	$('#loading').fadeOut();
}
</script>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="fa fa-globe"></i>Rekap Permohonan Persetujuan Bangunan Gedung</div>
		<div class="tools"><a href="javascript:;" class="reload"></a></div>
	</div>
	<div class="portlet-body">
		<div class="form-actions">
			<?php echo form_open('Rekap/RekapKabBulan',array('name'=>'frmListRekapInformasi', 'id'=>'frmListRekapInformasi')); ?>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group col-md-12">
						<label class="control-label col-md-3"><b>Provinsi</b></label>
						<div class="col-md-9">
							<div class="col-md-5">
								<?php echo form_dropdown('provinsi', $opt_prov, ($select_prov != '0') ? $select_prov : '', 'class="form-control select2me"'); ?>
							</div>
						</div>
					</div>
					<div class="form-group col-md-12">
						<label class="control-label col-md-3"><b>Fungsi Bangunan</b></label>
						<div class="col-md-9">
							<div class="col-md-5">
								<?php echo form_dropdown('fungsi_bg', $opt_fungsi, ($select_fungsi != '0') ? $select_fungsi : '', 'class="form-control select2me"'); ?>
							</div>
						</div>
					</div>
					<div class="form-group col-md-12">
						<label class="control-label col-md-3"><b>Tgl. Permohonan Konsultasi</b></label>
						<div class="col-md-9">
							<div class="col-md-2">
								<input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" name="tanggalawal" value="<?= (isset($tanggalawal) ? tgl_eng_to_ind($tanggalawal) : ''); ?>" placeholder="01-01-2018" />
							</div>
							<label class="control-label col-md-1">
								<center><b>s/d</b></center>
							</label>
							<div class="col-md-2">
								<input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" name="tanggalakhir" value="<?= (isset($tanggalakhir) ? tgl_eng_to_ind($tanggalakhir) : ''); ?>" placeholder="31-12-2020" />
							</div>
						</div>
					</div>
					
					<div class="form-group col-md-12">
						<label class="control-label col-md-3"><b></b></label>
						<div class="col-md-9">
							<div class="col-md-12">
								<input  type="submit" class="btn green" id="search" name="search" value="Pencarian">
								<button type="submit" class="btn green" onclick="resetCari()">Reset</button>
								<!--<a class="btn blue" href="<?php echo base_url('Rekap/RekapKabKotBulanCetak/').$select_prov ?>"> Cetak excel</a>-->
							</div>
						</div>
					</div>
				</div>
			</div>
			<table class="table table-striped table-bordered table-hover" id="sample_1">
                <tbody>
					<tr class="warning">
						<th rowspan="2" class="info">No</th>
						<th rowspan="2" class="info"><center>Nama Kabupaten/Kota</center></th>
						<th colspan="13" class="info"><center>Persetujuan Bangunan Gedung</center></th>
					</tr>
					<tr>
						<th class="info"><center>Verifikasi<br> Dokumen</center></th>
                        <th class="danger"><center>Perbaikan</center></th>
						<th class="info"><center>Penugasan <br>TPA/TPT</center></th>
						<th class="danger"><center>Penjadwalan<br>Konsultasi</center></th>
						<th class="info"><center>Konsultasi</center></th>
						<th class="danger"><center>Perhitungan<br>Retribusi</center></th>
						<th class="info"><center>Validasi <br> Kadis Teknis</center></th>
						<th class="danger"><center>Penagihan<br> Retribusi</center></th>
						<th class="info"><center>Validasi <b> Retribusi</center></th>
						<th class="danger"><center>Validasi<b> Kadis/<br>Terbit</center></th>
						<th class="info"><center>Ditolak</center></th>
						<th class="danger"><center>Total</center></th>
					</tr>
					<?php if ($jum_data==0){ ?>
						<tr><td class="clcenter" colspan="5">Data is Empty</td></tr>
					<?php } else {
						$i= 1;
						$loksblm	 			= '';
                        $VerifikasiDokumen 		= 0;
						$PenugasanTPA			= 0;
						$Penjadwalan			= 0;
						$Konsultasi 			= 0;
						$PerhitunganRetribusi	= 0;
						$Valkadintek			= 0;
						$PenagihanRetribusi 	= 0;
						$ValidasiRetribusi		= 0;
						$Terbit 				= 0; 
						$Ditolak 				= 0;
                        $Dikembalikan 			= 0;
						$t_DinasTeknis			= 0;
						$t_Total 				= 0;
						$t_VerifikasiDokumen 	= 0;
						$t_Dikembalikan			= 0;
						$t_PenugasanTPA			= 0;
						$t_Penjadwalan			= 0;
						$t_Konsultasi			= 0;
						$t_PerhitunganRetribusi	= 0;
						$t_Valkadintek			= 0;
						$t_PenagihanRetribusi	= 0;
						$t_ValidasiRetribusi	= 0;
						$t_Terbit				= 0;
						$t_Ditolak				= 0;
						if (isset($status) == ''){
							$status2 = 0;
						} else {
							$status2 = $status;
						}
						foreach ($result as $row) {;
							if ($i % 2== 0 )
								$clss = "event";
							else
								$clss = "event2";
								$Total 	= $row->Total;
								$t_Total += $Total;
								$VerifikasiDokumen = $row->VerifikasiDokumen;
								$t_VerifikasiDokumen += $VerifikasiDokumen;

                                $Dikembalikan = $row->Dikembalikan;
								$t_Dikembalikan += $Dikembalikan;
								
								$PenugasanTPA	= $row->PenugasanTPA;
								$t_PenugasanTPA	+= $PenugasanTPA;
								
								$Penjadwalan	= $row->Penjadwalan;
								$t_Penjadwalan	= $Penjadwalan;
								
								$Konsultasi = $row->Konsultasi;
								$t_Konsultasi += $Konsultasi;
								
								$PerhitunganRetribusi = $row->PerhitunganRetribusi;
								$t_PerhitunganRetribusi += $PerhitunganRetribusi;
								
								$Valkadintek	= $row->Valkadintek;
								$t_Valkadintek	+= $Valkadintek;

								$PenagihanRetribusi = $row->PenagihanRetribusi;
								$t_PenagihanRetribusi += $PenagihanRetribusi;
								
								$ValidasiRetribusi	= $row->ValidasiRetribusi;
								$t_ValidasiRetribusi	+= $ValidasiRetribusi;

                                $Terbit = $row->Terbit;
								$t_Terbit += $Terbit;


								$Ditolak = $row->Ditolak;
								$t_Ditolak += $Ditolak;
							?>		  
							<tr class="<?=$clss?>" id="record">
								<td class="clcenter"><?php echo $i?></td>	
								<td class="clleft"><?php echo $row->nama_kabkota; ?></td>
								
								<td><center>
                                    <?php if ($VerifikasiDokumen == 0){ ?>0<?php } else { ?>
										<?php echo $VerifikasiDokumen;?>
									<?php } ?>
									</center>
								</td>
                                <td><center>
                                    <?php if ($Dikembalikan == 0){ ?>0<?php } else { ?>
										<?php echo $Dikembalikan;?>
									<?php } ?>
									</center>
								</td>
								<td><center>
                                    <?php if ($PenugasanTPA == 0){ ?>0<?php } else { ?>
										<?php echo $PenugasanTPA;?>
									<?php } ?>
									</center>
								</td>
								<td><center>
                                    <?php if ($Penjadwalan == 0){ ?>0<?php } else { ?>
										<?php echo $Penjadwalan;?>
									<?php } ?>
									</center>
								</td>								
								<td><center>
                                    <?php if ($Konsultasi == 0){ ?>0<?php } else { ?>
										<?php echo $Konsultasi;?>
									<?php } ?>
									</center>
								</td>
								<td><center>
                                    <?php if ($PerhitunganRetribusi == 0){ ?>0<?php } else { ?>
										<?php echo $PerhitunganRetribusi;?>
									<?php } ?>
									</center>
								</td>
								<td><center>
									<?php if ($Valkadintek == 0){?>0<?php } else { ?>
										<?php echo $Valkadintek;?>
									<?php }?>
									</center>
								</td>
								<td><center>
									<?php if ($PenagihanRetribusi == 0){?>0<?php } else { ?>
										<?php echo $PenagihanRetribusi;?>
									<?php }?>
									</center>
								</td>
								 <td><center>
									<?php if ($ValidasiRetribusi == 0){?>0<?php } else { ?>
										<?php echo $ValidasiRetribusi;?>
									<?php }?>
									</center>
								</td>
                                <td><center>
									<?php if ($Terbit == 0){?>0<?php } else { ?>
										<?php echo $Terbit;?>
									<?php }?>
									</center>
								</td>
								<td><center>
									<?php if ($Ditolak == 0){?>0<?php } else { ?>
										<?php echo $Ditolak;?>
									<?php }?>
									</center>
								</td>
								<td><center>
                                    <?php if ($Total == 0){ ?>0<?php } else { ?>
										<?php echo $Total;?>
									<?php } ?>
									</center>
								</td>
								
								
							</tr>
							<?php $i++;
						}?>
						<tr class="<?=$clss?>" id="record">
							<td class="clcenter" colspan='2'><b>Total </b></td>
                            <td class="clcenter"><center><b><?php echo $t_VerifikasiDokumen; ?></b></center></td>
							<td class="clcenter"><center><b><?php echo $t_Dikembalikan; ?></b></center></td>
                            <td class="clcenter"><center><b><?php echo $t_PenugasanTPA; ?></b></center></td>
							<td class="clcenter"><center><b><?php echo $t_Penjadwalan; ?></b></center></td>
                            <td class="clcenter"><center><b><?php echo $t_Konsultasi; ?></b></center></td>					
							<td class="clcenter"><center><b><?php echo $t_PerhitunganRetribusi; ?></b></center></td>
							<td class="clcenter"><center><b><?php echo $t_Valkadintek; ?></b></center></td>
							<td class="clcenter"><center><b><?php echo $t_PenagihanRetribusi; ?></b></center></td>
							<td class="clcenter"><center><b><?php echo $t_ValidasiRetribusi; ?></b></center></td>
							<td class="clcenter"><center><b><?php echo $t_Terbit; ?></b></center></td>
							<td class="clcenter"><center><b><?php echo $t_Ditolak; ?></b></center></td>
							<td class="clcenter"><center><b><?php echo $t_Total; ?></b></center></td>
                        </tr>
					<?php } ?>	
				</tbody>
            </table>
        </div>
    </div>
</div>

