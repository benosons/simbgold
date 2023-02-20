<form action="<?php echo site_url('pupr/pengaturan_sk_tabg_save'); ?>" class="form-horizontal" role="form" method="post" id="form_edit_persyaratan_permohonan">
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
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="javascript:;" class="reload">
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<div class="form-body">
								<div class="form-group">
									<div class="col-md-12">
										<div>
											<input type="text" class="form-control" id="nm_konsultasi" value="<?php echo $result->row()->nm_konsultasi; ?>" name="Nama Konsultasi" placeholder="Nama Permohonan" autocomplete="off" disabled>
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
								<i class="fa fa-cogs"></i>Data Umum
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="javascript:;" class="reload">
								</a>
							</div>
						</div>
						<div class="portlet-body">
						<?php
							$i=1;
                            $element = 'checkbox';
                            if ($result->num_rows() > 0) :
                                $var = '<div class="md-checkbox-list">';
                                foreach ($result->result() as $row) :
								if ($row->id_detail_jenis_persyaratan == 5) {
									$var .= '<div class="md-checkbox"  style="border-bottom: 1px solid #e5e5e5;">';
                                    $var .= '<label for="checkbox' . $row->id_syarat. '">';
                                    $var .= '<span class="inc"></span>';
                                    $var .= '<span class="check"></span>';
									$var .= '<span>'.$i++.'. </span>';
									$var .= $row->nm_dokumen;
                                    $var .= '</label>';
									$var .= '</div>';
								}
                                endforeach;
                                $var .= '</div>';
                                echo $var;
                                else :
                                  echo 'Belum ada data';
                            endif;
                            ?>						
						</div>
					</div>
				</div>
				<!-- End Data Umum -->
				<!-- Begin Data Teknis Tanah -->
				<div class="col-md-12 ">
					<div class="portlet light bordered">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs"></i>Data Teknis Tanah
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="javascript:;" class="reload">
								</a>
							</div>
						</div>
						<div class="portlet-body">
						<?php
							$i=1;
                            $element = 'checkbox';
                            if ($result->num_rows() > 0) :
                                $var = '<div class="md-checkbox-list">';
                                foreach ($result->result() as $row) :
								if ($row->id_detail_jenis_persyaratan == 1) {
									$var .= '<div class="md-checkbox"  style="border-bottom: 1px solid #e5e5e5;">';
                                    $var .= '<label for="checkbox' . $row->id_syarat. '">';
                                    $var .= '<span class="inc"></span>';
                                    $var .= '<span class="check"></span>';
									$var .= '<span>'.$i++.'. </span>';
									$var .= $row->nm_dokumen;
                                    $var .= '</label>';
									$var .= '</div>';
								}
                                endforeach;
                                $var .= '</div>';
                                echo $var;
                                else :
                                  echo 'Belum ada data';
                            endif;
                            ?>						
						</div>
					</div>
				</div>
				<!-- End Data Teknis Tanah -->
				<!-- Begin Data Teknis Arsitektur -->
				<div class="col-md-12 ">
					<div class="portlet light bordered">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs"></i>Data Teknis Arsitektur
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="javascript:;" class="reload">
								</a>
							</div>
						</div>
						<div class="portlet-body">
						<?php
							$i=1;
                            $element = 'checkbox';
                            if ($result->num_rows() > 0) :
                                $var = '<div class="md-checkbox-list">';
                                foreach ($result->result() as $row) :
								if ($row->id_detail_jenis_persyaratan == 2) {
									$var .= '<div class="md-checkbox"  style="border-bottom: 1px solid #e5e5e5;">';
                                    $var .= '<label for="checkbox' . $row->id_syarat. '">';
                                    $var .= '<span class="inc"></span>';
                                    $var .= '<span class="check"></span>';
									$var .= '<span>'.$i++.'. </span>';
									$var .= $row->nm_dokumen;
                                    $var .= '</label>';
									$var .= '</div>';
								}
                                endforeach;
                                $var .= '</div>';
                                echo $var;
                                else :
                                  echo 'Belum ada data';
                            endif;
                            ?>						
						</div>
					</div>
				</div>
				<!-- End Data Teknis Arsitektur -->
				<!-- Begin Data Teknis Struktur -->
				<div class="col-md-12 ">
					<div class="portlet light bordered">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs"></i>Data Teknis Struktur
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="javascript:;" class="reload">
								</a>
							</div>
						</div>
						<div class="portlet-body">
						<?php
							$i=1;
                            $element = 'checkbox';
                            if ($result->num_rows() > 0) :
                                $var = '<div class="md-checkbox-list">';
                                foreach ($result->result() as $row) :
								if ($row->id_detail_jenis_persyaratan == 3) {
									$var .= '<div class="md-checkbox"  style="border-bottom: 1px solid #e5e5e5;">';
                                    $var .= '<label for="checkbox' . $row->id_syarat. '">';
                                    $var .= '<span class="inc"></span>';
                                    $var .= '<span class="check"></span>';
									$var .= '<span>'.$i++.'. </span>';
									$var .= $row->nm_dokumen;
                                    $var .= '</label>';
									$var .= '</div>';
								}
                                endforeach;
                                $var .= '</div>';
                                echo $var;
                                else :
                                  echo 'Belum ada data';
                            endif;
                            ?>						
						</div>
					</div>
				</div>
				<!-- End Data Teknis Struktur -->
				<!-- Begin Data Teknis Mekanikal, Elektrikal, dan Plambing -->
				<div class="col-md-12 ">
					<div class="portlet light bordered">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs"></i>Data Teknis Mekanikal, Elektrikal, dan Plambing
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="javascript:;" class="reload">
								</a>
							</div>
						</div>
						<div class="portlet-body">
						<?php
							$i=1;
                            $element = 'checkbox';
                            if ($result->num_rows() > 0) :
                                $var = '<div class="md-checkbox-list">';
                                foreach ($result->result() as $row) :
								if ($row->id_detail_jenis_persyaratan == 4) {
									$var .= '<div class="md-checkbox"  style="border-bottom: 1px solid #e5e5e5;">';
                                    $var .= '<label for="checkbox' . $row->id_syarat. '">';
                                    $var .= '<span class="inc"></span>';
                                    $var .= '<span class="check"></span>';
									$var .= '<span>'.$i++.'. </span>';
									$var .= $row->nm_dokumen;
                                    $var .= '</label>';
									$var .= '</div>';
								}
                                endforeach;
                                $var .= '</div>';
                                echo $var;
                                else :
                                  echo 'Belum ada data';
                            endif;
                            ?>						
						</div>
					</div>
				</div>
				<!-- End Data Teknis Mekanikal, Elektrikal, dan Plambing -->
				<!-- Persyaratan Teknis -->
			</div>
		</div>
	</div>
</form>
