

			<table class="table" border="1" id="sample_1">
                <tbody>
					<tr class="warning">
						<th rowspan="2" class="info">No</th>
						<th rowspan="2" class="info"><center>Nama Kabupaten/Kota</center></th>
						<th rowspan="2" class="info"><center>Perda Retribusi PBG</center></th>
						<th colspan="2" class="info"><center>Akun Dinas</center></th>
						<th colspan="4" class="info"><center>Persetujuan Bangunan Gedung</center></th>
						<th colspan="4" class="info"><center>Sertifikat Laik Fungsi</center></th>
						<!--<th colspan="2" class="info"><center>TPA</center></th>-->
					</tr>
					<tr>
                        <th class="danger"><center>Teknis</center></th>
						<th class="info"><center>DPMPTSP</center></th>

						<th class="danger"><center>Diajukan</center></th>
						<th class="info"><center>Diproses</center></th>
						<th class="danger"><center>Diterbitkan</center></th>
						<th class="info"><center>Ditolak</center></th>

						<th class="danger"><center>Diajukan</center></th>
						<th class="info"><center>Diproses</center></th>
						<th class="danger"><center>Diterbitkan</center></th>
						<th class="info"><center>Ditolak</center></th>

						<!--<th class="info"><center>Calon</center></th>
						<th class="danger"><center>Anggota</center></th>-->
					</tr>
					<?php if ($jum_data==0){ ?>
						<tr><td class="clcenter" colspan="5">Data is Empty</td></tr>
					<?php } else {
						$i= 1;
						$loksblm = '';
						$DinasTeknis = 0;
						$DinasPerizinan = 0;
						$Diserahkan = 0; 
						$Ditolak = 0;
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
								$DinasTeknis = $row->DinasTeknis;
								$t_DinasTeknis += $DinasTeknis;
								$DinasPerizinan = $row->DinasPerizinan;
								$t_DinasPerizinan += $DinasPerizinan;
								$TelahTerbit = $row->TelahTerbit;
								$t_TelahTerbit += $TelahTerbit;
								$Ditolak = $row->Ditolak;
								$t_Ditolak += $Ditolak;

								$SDinasTeknis = $row->SDinasTeknis;
								$T_SDinasTeknis += $row->SDinasTeknis;
								$SDinasPerizinan = $row->SDinasPerizinan;
								$T_SDinasPerizinan += $row->SDinasPerizinan;
								$STelahTerbit = $row->STelahTerbit;
								$T_STelahTerbit += $row->STelahTerbit;
								$SDitolak = $row->SDitolak;
								$T_SDitolak += $row->SDitolak;

								$CalonTpa = $row->CalonTpa;
								$T_CalonTpa += $row->CalonTpa;
								$Tpa = $row->Tpa;
								$T_Tpa += $row->Tpa;

								$teknis = $row->status_teknis;
								$perizinan = $row->status_perizinan;
								$perda = $row->Status_perda;

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
								<td><span class="<?php echo $class; ?>"<center><?php echo $StatusPerda; ?></center></span></td>
								<td><span class="<?php echo $class2; ?>"<center><?php echo $AkunTeknis; ?></center></span></td>
                                <td><span class="<?php echo $class3; ?>"<center><?php echo $AkunIzin; ?></center></span></td>
								<td><center>
                                    <?php if ($DinasTeknis == 0){ ?>0<?php } else { ?>
										<?php echo $DinasTeknis;?>
									<?php } ?>
									</center>
								</td>										
								<td><center>
                                    <?php if ($DinasPerizinan == 0){ ?>0<?php } else { ?>
										<?php echo $DinasPerizinan;?>
									<?php } ?>
									</center>
								</td>
								<td><center>
									<?php if ($TelahTerbit == 0){?>0<?php } else { ?>
										<?php echo $TelahTerbit;?>
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
									<?php if ($SDinasTeknis == 0){?>0<?php } else { ?>
										<?php echo $SDinasTeknis;?>
									<?php }?>
									</center>
								</td>
								<td>
									<center>
									<?php if ($SDinasPerizinan == 0){?>0<?php } else { ?>
										<?php echo $SDinasPerizinan;?>
									<?php }?>
									</center>
								</td>
								<td>
									<center>
									<?php if ($STelahTerbit == 0){?>0<?php } else { ?>
										<?php echo $STelahTerbit;?>
									<?php }?>
									</center>
								</td>
								<td>
									<center>
									<?php if ($SDitolak == 0){?>0<?php } else { ?>
										<?php echo $SDitolak;?>
									<?php }?>
									</center>
								</td>
								<!--<td>
									<center>
									<?php if ($CalonTpa == 0){?>0<?php } else { ?>
										<?php echo $CalonTpa;?>
									<?php }?>
									</center>
								</td>
								<td>
									<center>
									<?php if ($Tpa == 0){?>0<?php } else { ?>
										<?php echo $Tpa;?>
									<?php }?>
									</center>
								</td>-->
							</tr>
							<?php $i++;
						}?>
						<tr class="<?=$clss?>" id="record">
						    <td class="clcenter" colspan='2'><b>Total Permohonan</b></td>
							<td></td>
							<td></td>
                            <td></td>
							<td class="clcenter"><center><b><?php echo $t_DinasTeknis; ?></b></center></td>
							<td class="clcenter"><center><b><?php echo $t_DinasPerizinan; ?></b></center></td>				
						    <td class="clcenter"><center><b><?php echo $t_TelahTerbit; ?></b></center></td>
							<td class="clcenter"><center><b><?php echo $t_Ditolak; ?></b></center></td>
							<td class="clcenter"><center><b><?php echo $T_SDinasTeknis; ?></b></center></td>
							<td class="clcenter"><center><b><?php echo $T_SDinasPerizinan; ?></b></center></td>													
							<td class="clcenter"><center><b><?php echo $T_STelahTerbit; ?></b></center></td>
							<td class="clcenter"><center><b><?php echo $T_SDitolak; ?></b></center></td>
							<!--<td class="clcenter"><center><b><?php echo $T_CalonTpa; ?></b></center></td>
							<td class="clcenter"><center><b><?php echo $T_Tpa; ?></b></center></td>-->
						</tr>
					<?php } ?>	
				</tbody>
            </table>


