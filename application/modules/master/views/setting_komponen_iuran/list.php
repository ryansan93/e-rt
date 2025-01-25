<?php if ( !empty($data) ) { ?>
    <?php foreach ($data as $key => $value) { ?>
        <tr class="data">
            <td class="tgl_berlaku" data-val="<?php echo $value['tgl_berlaku']; ?>"><?php echo tglIndonesia($value['tgl_berlaku'], '-', ' '); ?></td>
            <td class="kode_iuran" data-val="<?php echo $value['kode_iuran']; ?>"><?php echo $value['kode_iuran']; ?></td>
            <td class="text-right"><?php echo formatAngka($value['nominal']); ?></td>
            <td>
                <div class="col-xs-12 no-padding">
                    <button type="button" class="btn btn-primary col-xs-12" onclick="ski.viewForm(this)"><i class="fa fa-file"></i></button>
                    
                    <!-- <div class="col-xs-6 no-padding" style="padding-right: 5px;">
                        <button type="button" class="btn btn-primary col-xs-12" onclick="ski.editForm(this)"><i class="fa fa-edit"></i></button>
                    </div>
                    <div class="col-xs-6 no-padding" style="padding-left: 5px;">
                        <button type="button" class="btn btn-danger col-xs-12" onclick="ski.delete(this)"><i class="fa fa-trash"></i></button>
                    </div> -->
                </div>
            </td>
        </tr>
    <?php } ?>
<?php } else { ?>
    <tr>
        <td colspan="4">Data tidak ditemukan.</td>
    </tr>
<?php } ?>