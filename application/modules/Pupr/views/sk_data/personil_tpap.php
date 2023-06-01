<form action="<?php echo site_url('Pupr/simpan_personil_tpap'); ?>" class="form-horizontal" role="form" method="post" id="form_edit_skteknis">
<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
        <div class="form-group">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<span class="caption-subject text-primary bold uppercase " style="font-size:15px;">
				Personil TPA Nomor SK <?php echo set_value('no_sk', (isset($psk->no_sk) ? $psk->no_sk : '')) ?>
			</span>
            <input type="hidden" class="form-control" id="id" value="<?php echo set_value('id_sk', (isset($psk->id_sk) ? $psk->id_sk : '')) ?>" name="id" placeholder="id" autocomplete="off">
        </div><hr><br>
        <div class="form-group">
            <?php
            $element = 'checkbox';
            if (isset($query_syarat_adm) != 0) :
                $var = '<div class="md-checkbox-list col-md-12">';
                foreach ($query_syarat_adm->result() as $row) :
                    if ($element == 'checkbox') {
                        $setVal     = '';
                        foreach ($query_syarat_selected->result() as $key) :
                            if ($row->id_tpanya == $key->id_tpanya) {
                                $setVal = 'checked="checked"';
                            }
                        endforeach;
                        $set    = $disable != '' ? 'disabled="disabled"' : '';
                        $input    = '<input type="checkbox" id="checkbox' . $row->id . '" class="form-control md-check" ' . $setVal . ' name="dok_persyaratan[]" value="' . $row->id . '" ' . $set . '>';
                    }
                    $var .= '<div class="md-checkbox col-md-6">';
                    $var .= $input;
                    $var .= '<label for="checkbox' . $row->id . '">';
                    $var .= '<span class="inc"></span>';
                    $var .= '<span class="check"></span>';
                    $var .= '<span class="box"></span>';
                    $var .= $row->nm_tpa;
                    $var .= '</label>';
                    $var .= '</div>';
                endforeach;
                $var .= '</div>';
                echo $var;
            endif;
            ?>
			
        </div>
		<div class="modal-footer">
            <button type="submit" class="btn green"><i class="fa fa-save"></i> Simpan</button>
            <button type="button" data-dismiss="modal" class="btn red" ><i class="fa fa-sign-out"></i> Batal</button>
        </div>
</form>