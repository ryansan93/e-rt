<?php if ( !empty($data) ) { ?>
    <?php foreach ($data as $key => $value) { ?>
        <tr class="data">
            <td><?php echo $value['no_rumah']; ?></td>
            <td ><?php echo $value['pemilik']; ?></td>
            <td class="text-right"><?php echo formatAngka($value['nominal_iuran']); ?></td>
            <td>
                <div class="col-xs-12 no-padding">
                    <div class="col-xs-6 no-padding" style="padding-right: 5px;">
                        <button type="button" class="btn btn-primary col-xs-12" onclick="r.editForm(this)" data-kode="<?php echo $value['kode']; ?>"><i class="fa fa-edit"></i></button>
                    </div>
                    <div class="col-xs-6 no-padding" style="padding-left: 5px;">
                        <button type="button" class="btn btn-danger col-xs-12" onclick="r.delete(this)" data-kode="<?php echo $value['kode']; ?>"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
            </td>
        </tr>
    <?php } ?>
<?php } else { ?>
    <tr>
        <td colspan="4">Data tidak ditemukan.</td>
    </tr>
<?php } ?>