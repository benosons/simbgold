<form action="<?php echo site_url('permohonan/saveDataPersyaratanPermohonan'); ?>" class="form-horizontal" role="form" method="post" id="form_edit_persyaratan_permohonan">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h4 class="modal-title">Pengaturan Syarat Permohonan</h4>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-md-12 ">
					<div class="portlet box grey-cascade">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i>Nama Permohonan
							</div>
						</div>
						<div class="portlet-body">
							<div class="form-body">
								<div class="form-group">
									<div class="col-md-12">
										<div>
											<!-- <input type="hidden" class="form-control" id="id" value="<?php echo $row->id_sk_tabg ?>" name="id" placeholder="id" autocomplete="off"> -->
											<input type="text" class="form-control" id="nama_permohonan" value="<?php echo $jenis_permohonan->row()->nama_permohonan; ?>" name="nama_permohonan" placeholder="Nama Permohonan" autocomplete="off" disabled>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Persyaratan Administrasi -->
				<div class="col-md-12 ">
					<div class="portlet light bordered">
						<div class="portlet-title">
							<div class="caption">
							<?
											// $detail_jenis_persyaratan = $row->id_detail_jenis_persyaratan;
											// if($detail_jenis_persyaratan != $detail_jns_syarat_sblm || $id_jenis_permohonan != $id_jenis_permohonan_sblm){
											// 	if ($detail_jenis_persyaratan == '1'){
											// 		echo "Rencana Arsitektur";
											// 	}else if ($detail_jenis_persyaratan=='2'){
											// 		echo "Rencana Struktur";
											// 	}else if ($detail_jenis_persyaratan=='3'){
											// 		echo "Rencana Utilitas";
											// 	}else if ($detail_jenis_persyaratan=='4'){
											// 		echo "Perizinan dan/ atau Rekomendasi lainnya";
											// 	}else if ($detail_jenis_persyaratan=='5'){
											// 		echo "Adm";
											// 	}
											// }else{
											// 	echo '';
											// }
										?>
								<i class="fa fa-cogs"></i>Persyaratan Administrasi
							</div>
                            &nbsp;
                            
                            <!-- <div class="btn-group">
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#responsive">Tambah / Ubah</button>
							</div> -->
						</div>
                        <a href="<?php echo site_url('referensi/edit_persyaratan_imb_adm/'.$id_permohonan.'/5'); ?>" class="btn btn-info btn-sm" title="Tambah / Ubah Data" data-toggle="modal" data-target="#modal-edit">Tambah / Ubah Syarat Administrasi</a>
						<div class="portlet-body">
                        
						<?php
							$i=1;
                            $element = 'checkbox';
                            // if ($result->num_rows() > 0) :
                                $var = '<div class="md-checkbox-list">';
                                foreach ($result->result() as $row) :
                                    // if ($element == 'checkbox') {
                                    //     $setVal     = '';
                                        // foreach ($query_syarat_selected->result() as $key) :
                                            // $id_dokumen_permohonan == $key->id_personal;
                                            // if ($row->nama_permohonan == $key->nama_permohonan) {
                                            //     $setVal = 'checked="checked"';
                                            // }
                                        // endforeach;
                                    //     $set    = $disable != '' ? 'disabled="disabled"' : '';
                                    //     $input    = '<input type="checkbox" id="checkbox' . $row->id_personal . '" class="md-check" ' . $setVal . ' name="dok_persyaratan[]" value="' . $row->id_personal . '" ' . $set . '>';
									// }
									if ($row->id_detail_jenis_persyaratan == 5) {
                                    // $var .= '<a href="'.site_url("referensi/edit_persyaratan_imb_adm/".$id_permohonan."/5").'" class="btn btn-info btn-sm" title="Tambah / Ubah Data" data-toggle="modal" data-target="#modal-edit">Tambah / Ubah</a>';
									$var .= '<div class="md-checkbox"  style="border-bottom: 1px solid #e5e5e5;">';
									// $var .= '<div style="border-bottom: 1px solid #e5e5e5;">';
									// $var .=	$i++;
                                    // $var .= '';
                                    // $var .= '<li class="'.$class.'">'.$input.'<span class="text-menulist">'.$row->nama_personal.'</span>';
                                    // $var .= $input;
                                    $var .= '<label for="checkbox' . $row->id_syarat. '">';
                                    $var .= '<span class="inc"></span>';
                                    $var .= '<span class="check"></span>';
									$var .= '<span>'.$i++.'. </span>';
									$var .= $row->nama_syarat;
                                    $var .= '</label>';
									$var .= '</div>';
								}
                                endforeach;
                                $var .= '</div>';
                                echo $var;
                            //     else :
                            //       echo 'Belum ada data';
                            // endif;
                            ?>						
						</div>
					</div>
				</div>
				
				<!-- Persyaratan Teknis -->
				<div class="col-md-12 ">
					<div class="portlet light bordered">
						<div class="portlet-title">
							<div class="caption">
							<?
											// $detail_jenis_persyaratan = $row->id_detail_jenis_persyaratan;
											// if($detail_jenis_persyaratan != $detail_jns_syarat_sblm || $id_jenis_permohonan != $id_jenis_permohonan_sblm){
											// 	if ($detail_jenis_persyaratan == '1'){
											// 		echo "Rencana Arsitektur";
											// 	}else if ($detail_jenis_persyaratan=='2'){
											// 		echo "Rencana Struktur";
											// 	}else if ($detail_jenis_persyaratan=='3'){
											// 		echo "Rencana Utilitas";
											// 	}else if ($detail_jenis_persyaratan=='4'){
											// 		echo "Perizinan dan/atau Rekomendasi lainnya";
											// 	}else if ($detail_jenis_persyaratan=='5'){
											// 		echo "Adm";
											// 	}
											// }else{
											// 	echo '';
											// }
										?>
								<i class="fa fa-cogs"></i>Persyaratan Teknis
							</div>
						</div>
						<div class="portlet-body">
                        <a href="<?php echo site_url('referensi/edit_persyaratan_imb_teknis/'.$id_permohonan.'/1'); ?>" class="btn btn-info btn-sm" title="Tambah / Ubah Data" data-toggle="modal" data-target="#modal-edit">Tambah / Ubah Rencana Arsitektur</a>
						<a href="<?php echo site_url('referensi/edit_persyaratan_imb_teknis/'.$id_permohonan.'/2'); ?>" class="btn btn-info btn-sm" title="Tambah / Ubah Data" data-toggle="modal" data-target="#modal-edit">Tambah / Ubah Rencana Struktur</a>
                        <a href="<?php echo site_url('referensi/edit_persyaratan_imb_teknis/'.$id_permohonan.'/3'); ?>" class="btn btn-info btn-sm" title="Tambah / Ubah Data" data-toggle="modal" data-target="#modal-edit">Tambah / Ubah Rencana Utilitas</a>
                        <a href="<?php echo site_url('referensi/edit_persyaratan_imb_teknis/'.$id_permohonan.'/4'); ?>" class="btn btn-info btn-sm" title="Tambah / Ubah Data" data-toggle="modal" data-target="#modal-edit">Tambah / Ubah Perizinan dan/atau Rekomendasi lainnya</a>
                        <?php
							$i=1;
                            $element = 'checkbox';
                            // if ($result->num_rows() > 0) :
								$var = '<div class="md-checkbox-list">';
								
                                    $var .= '<div class="caption"><h4><b>Rencana Arsitektur</b></h2></div>';
									foreach ($result->result() as $row) :
										if ($row->id_detail_jenis_persyaratan == 1) {
											$var .= '<div class="md-checkbox"  style="border-bottom: 1px solid #e5e5e5;">';
											$var .= '<label for="checkbox' . $row->id_syarat. '">';
											$var .= '<span class="inc"></span>';
											$var .= '<span class="check"></span>';
											$var .= '<span>'.$i++.'. </span>';
											$var .= $row->nama_syarat;
											$var .= '</label>';
											$var .= '</div>';
											
									}
								endforeach;
                                    
									$var .= '<div class="caption"><h4><b>Rencana Struktur</b></h2></div>';
                                	foreach ($result->result() as $row) :
										if ($row->id_detail_jenis_persyaratan=='2') {
											$var .= '<div class="md-checkbox"  style="border-bottom: 1px solid #e5e5e5;">';
											$var .= '<label for="checkbox' . $row->id_syarat. '">';
											$var .= '<span class="inc"></span>';
											$var .= '<span class="check"></span>';
											$var .= '<span>'.$i++.'. </span>';
											$var .= $row->nama_syarat;
											$var .= '</label>';
											$var .= '</div>';
											}
										endforeach;
								
									$var .= '<div class="caption"><h4><b>Rencana Utilitas</b></h2></div>';
                                	foreach ($result->result() as $row) :
										if ($row->id_detail_jenis_persyaratan=='3') {
											$var .= '<div class="md-checkbox"  style="border-bottom: 1px solid #e5e5e5;">';
											$var .= '<label for="checkbox' . $row->id_syarat. '">';
											$var .= '<span class="inc"></span>';
											$var .= '<span class="check"></span>';
											$var .= '<span>'.$i++.'. </span>';
											$var .= $row->nama_syarat;
											$var .= '</label>';
											$var .= '</div>';
									}
								endforeach;
								
									$var .= '<div class="caption"><h4><b>Rencana Perizinan dan/atau Rekomendasi lainnya</b></h2></div>';
                                	foreach ($result->result() as $row) :
										if ($row->id_detail_jenis_persyaratan=='4') {
											$var .= '<div class="md-checkbox"  style="border-bottom: 1px solid #e5e5e5;">';
											$var .= '<label for="checkbox' . $row->id_syarat. '">';
											$var .= '<span class="inc"></span>';
											$var .= '<span class="check"></span>';
											$var .= '<span>'.$i++.'. </span>';
											$var .= $row->nama_syarat;
											$var .= '</label>';
											$var .= '</div>';
									}
								endforeach;
								
                                $var .= '</div>';
                                echo $var;
                            //     else :
                            //       echo 'Belum ada data';
                            // endif;
                            ?>						
						</div>
					</div>
				</div>
                
			</div>
		</div>
	</div>
</form>

<!-- /.modaledit -->
<div id="modal-edit" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">



			</div>
			<!-- /.modal-content -->
		</div>
	</div>