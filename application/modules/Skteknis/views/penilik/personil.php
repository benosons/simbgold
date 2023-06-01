<form action="<?php echo site_url('Skteknis/pengaturan_skpenilik_save'); ?>" class="form-horizontal" role="form" method="post" id="form_edit_skteknis">
    <div class="modal-body">
        <div class="form-group">
            <label class="bold uppercase"> Nomor SK <?php echo set_value('no_skp', (isset($row->no_skp) ? $row->no_skp : '')) ?></label>
            <input type="hidden" class="form-control" id="id" value="<?php echo set_value('id_skp', (isset($row->id_skp) ? $row->id_skp : '')) ?>" name="id" placeholder="id" autocomplete="off">
        </div>
        <div class="form-group">
            <?php
            $element = 'checkbox';
            if (isset($query_syarat_adm) != 0) :
                $var = '<div class="md-checkbox-list">';
                foreach ($query_syarat_adm->result() as $row) :
                    if ($element == 'checkbox') {
                        $setVal     = '';
                        foreach ($query_syarat_selected->result() as $key) :
                            if ($row->id_personal == $key->id_personal) {
                                $setVal = 'checked="checked"';
                            }
                        endforeach;
                        $set    = $disable != '' ? 'disabled="disabled"' : '';
                        $input    = '<input type="checkbox" id="checkbox' . $row->id_personal . '" class="form-control md-check" ' . $setVal . ' name="dok_persyaratan[]" value="' . $row->id_personal . '" ' . $set . '>';
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