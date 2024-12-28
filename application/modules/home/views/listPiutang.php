<?php if ( !empty($data) ) { ?>
    <?php foreach ($data as $key => $value) { ?>
        <div class="col-xs-4 notif_contain">
            <div class="col-xs-12 notif_contain_border cursor-p" onclick="home.openModal(this)" data-kodecust="<?php echo $value['kode_cust']; ?>">
                <div class="col-xs-12 no-padding" style="font-size: 12pt;"><label class="control-label" style="margin-bottom: 0px;"><?php echo strtoupper($value['nama_cust']); ?></label></div>
                <div class="col-xs-12 no-padding"><hr></div>
                <div class="col-xs-12 no-padding">
                    <div class="col-xs-3 no-padding"><label class="control-label">TOT PIUTANG</label></div>
                    <div class="col-xs-1 no-padding text-center"><label class="control-label">:</label></div>
                    <div class="col-xs-8 no-padding"><label class="control-label"><?php echo 'Rp. '.formatAngka($value['sisa']); ?></label></div>
                </div>
                <div class="col-xs-12 no-padding">
                    <div class="col-xs-3 no-padding"><label class="control-label">JML INV</label></div>
                    <div class="col-xs-1 no-padding text-center"><label class="control-label">:</label></div>
                    <div class="col-xs-8 no-padding"><label class="control-label"><?php echo formatAngka( $value['jumlah'] ); ?></label></div>
                </div>
                <div class="col-xs-12 no-padding">
                    <div class="col-xs-3 no-padding"><label class="control-label">TGL INV TERLAMA</label></div>
                    <div class="col-xs-1 no-padding text-center"><label class="control-label">:</label></div>
                    <div class="col-xs-8 no-padding"><label class="control-label"><?php echo tglIndonesia( $value['tgl_faktur_terlama'], '-', ' ', true ); ?></label></div>
                </div>
            </div>

            <div id="<?php echo $value['kode_cust']; ?>" class="modal" tabindex="-1">
                <div class="modal-dialog" style="max-width: 100%; width:80%;">
                    <div class="modal-content">
                        <div class="modal-header" style="padding-top: 15px;">
                            <h4 class="modal-title">Detail</h4>
                            <button type="button" class="close" data-dismiss="modal">x</button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="col-xs-2">No. Faktur</th>
                                        <th class="col-xs-2">Tanggal</th>
                                        <th class="col-xs-2">Tanggal Tempo</th>
                                        <th class="col-xs-2">Nilai Piutang</th>
                                        <th class="col-xs-2">Bayar</th>
                                        <th class="col-xs-2">Sisa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($value['detail'] as $k_det => $v_det) { ?>
                                        <tr>
                                            <td><?php echo $v_det['no_faktur']; ?></td>
                                            <td><?php echo tglIndonesia($v_det['tgl_faktur'], '-', ' '); ?></td>
                                            <td><?php echo tglIndonesia($v_det['tgl_tempo'], '-', ' '); ?></td>
                                            <td class="text-right"><?php echo formatAngka($v_det['nil_piut']); ?></td>
                                            <td class="text-right"><?php echo formatAngka($v_det['bayar']); ?></td>
                                            <td class="text-right"><?php echo formatAngka($v_det['sisa']); ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
<?php } else { ?>
    <label class="control-label" style="padding: 5px; font-size: 10pt;">TIDAK ADA DATA PIUTANG</label>
<?php } ?>