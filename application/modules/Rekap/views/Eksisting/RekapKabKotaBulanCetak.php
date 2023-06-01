

			<table class="table" border="1" id="sample_1">
                <tbody>
					<tr class="warning">
						<th rowspan="2" class="info">No</th>
						<th rowspan="2" class="info"><center>Nama Kabupaten/Kota</center></th>
						<th colspan="6" class="info"><center>Persetujuan Bangunan Gedung</center></th>
					</tr>
					<tr>
                    <th class="info"><center>Total Permohonan</center></th>
						<th class="danger"><center>Verifikasi Dokumen</center></th>
                        <th class="danger"><center>Perbaikan Oleh Pemohon </center></th>
						<th class="info"><center>Konsultasi</center></th>
						<th class="danger"><center>Retribusi</center></th>
						<th class="info"><center>Terbit</center></th>
						<th class="danger"><center>Ditolak</center></th>
                    </tr>
					<?php if ($jum_data==0){ ?>
						<tr><td class="clcenter" colspan="5">Data is Empty</td></tr>
					<?php } else {
						$i= 1;
						$loksblm = '';
                        $VerifikasiDokumen = 0;
						$Konsultasi = 0;
						$Retribusi = 0;
						$Terbit = 0; 
						$Ditolak = 0;
                        $Dikembalikan = 0;
						$t_DinasTeknis= 0;
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

								$Konsultasi = $row->Konsultasi;
								$t_Konsultasi += $Konsultasi;

								$Retribusi = $row->Retribusi;
								$t_Retribusi += $Retribusi;

                                $Terbit = $row->Terbit;
								$t_Terbit += $Terbit;


								$Ditolak = $row->Ditolak;
								$t_Ditolak += $Ditolak;

								if($teknis == '1'){
									$AkunTeknis ="Sudah";
									$class2 = "label label-sm label-info";
								}else{
									$AkunTeknis ="Belum";
									$class2 = "label label-sm label-danger";
								}

								if($perizinan == '1'){
									$AkunIzin ="Sudah";
									$class3 = "label label-sm label-info";
								}else{
									$AkunIzin ="Belum";
									$class3 = "label label-sm label-danger";
								}
                                if($perda == '1'){
									$StatusPerda ="Sudah";
									$class = "label label-sm label-info";
								}else{
									$StatusPerda ="Belum";
									$class = "label label-sm label-danger";
								}
							?>		  
							<tr class="<?=$clss?>" id="record">
                            <td class="clcenter"><?php echo $i?></td>	
								<td class="clleft"><?php echo $row->nama_kabkota; ?></td>
								<td><center>
                                    <?php if ($Total == 0){ ?>0<?php } else { ?>
										<?php echo $Total;?>
									<?php } ?>
									</center>
								</td>
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
                                    <?php if ($Konsultasi == 0){ ?>0<?php } else { ?>
										<?php echo $Konsultasi;?>
									<?php } ?>
									</center>
								</td>
								<td><center>
									<?php if ($Retribusi == 0){?>0<?php } else { ?>
										<?php echo $Retribusi;?>
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
							</tr>
							<?php $i++;
						}?>
						<tr class="<?=$clss?>" id="record">
						    <td class="clcenter" colspan='2'><b>Total Permohonan</b></td>
                            <td class="clcenter"><center><b><?php echo $t_Total; ?></b></center></td>
							<td class="clcenter"><center><b><?php echo $t_VerifikasiDokumen; ?></b></center></td>
                            <td class="clcenter"><center><b><?php echo $t_Dikembalikan; ?></b></center></td>
							<td class="clcenter"><center><b><?php echo $t_Konsultasi; ?></b></center></td>
                            <td class="clcenter"><center><b><?php echo $t_Retribusi; ?></b></center></td>					
							<td class="clcenter"><center><b><?php echo $t_Terbit; ?></b></center></td>
							<td class="clcenter"><center><b><?php echo $t_Ditolak; ?></b></center></td>
						</tr>
					<?php } ?>	
				</tbody>
            </table>


