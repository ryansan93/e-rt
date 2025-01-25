<?php if ( !empty($data) ) { ?>
    <?php foreach ($data as $key => $value) { ?>
        <tr class="data">
            <td><?php echo $value['kode']; ?></td>
            <td class="text-right"><?php echo formatAngka($value['nominal']); ?></td>
            <td>
                <div class="col-xs-12 no-padding">
                    <div class="col-xs-6 no-padding" style="padding-right: 5px;">
                        <button type="button" class="btn btn-primary col-xs-12" onclick="i.editForm(this)" data-kode="<?php echo $value['kode']; ?>"><i class="fa fa-edit"></i></button>
                    </div>
                    <div class="col-xs-6 no-padding" style="padding-left: 5px;">
                        <button type="button" class="btn btn-danger col-xs-12" onclick="i.delete(this)" data-kode="<?php echo $value['kode']; ?>"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
            </td>
        </tr>
    <?php } ?>
<?php } else { ?>
    <tr>
        <td colspan="3">Data tidak ditemukan.</td>
    </tr>
<?php } ?>