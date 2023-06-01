<form action="<?php echo site_url('pupr/pengaturan_sk_tabg_save'); ?>" class="form-horizontal" role="form" method="post" id="form_edit_sktabg">
	<div class="modal-body">
			<div class="form-group">
				<label class="bold uppercase"> Nomor SK <?php echo set_value('no_sk_tabg', (isset($row->no_sk_tabg) ? $row->no_sk_tabg : ''))?></label>
				<input type="hidden" class="form-control" id="id" value="<?php echo set_value('id_sk_tabg', (isset($row->id_sk_tabg) ? $row->id_sk_tabg : ''))?>" name="id" placeholder="id" autocomplete="off">				
			</div>
			<div class="form-group">	
							<?php
							$element = 'checkbox';

							if(isset($query_syarat_adm)!=0):
								$var = '<div class="md-checkbox-list">';
								foreach ($query_syarat_adm->result() as $row) :
									if ($element == 'checkbox') {
										$setVal 	= '';
										foreach ($query_syarat_selected->result() as $key) :
											// $id_dokumen_permohonan == $key->id_personal;
											if ($row->id_personal == $key->id_personal) {
												$setVal = 'checked="checked"';
											}
										endforeach;
										$set	= $disable != '' ? 'disabled="disabled"' : '';
										$input	= '<input type="checkbox" id="checkbox' . $row->id_personal . '" class="form-control md-check" ' . $setVal . ' name="dok_persyaratan[]" value="' . $row->id_personal . '" ' . $set . '>';
									}
									$var .= '<div class="md-checkbox"  style="border-bottom: 1px solid #e5e5e5;">';
									$var .= $input;
									$var .= '<label for="checkbox' . $row->id_personal . '">';
									$var .= '<span class="inc"></span>';
									$var .= '<span class="check"></span>';
									$var .= '<span class="box"></span>';
									$var .= $row->nama_personal;
									$var .= '</label>';
									$var .= '</div>';
								endforeach;
								$var .= '</div>';
								echo $var;
							endif;
							?>
			</div>
			<div class="form-group" align="right">
				<button type="button" data-dismiss="modal" class="btn red">Batal</button>
				<button type="submit" class="btn green">Simpan</button>
			</div>
	</div>
</form>