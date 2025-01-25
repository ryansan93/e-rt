<div class="modal-header">
	<span class="modal-title"><b>DETAIL SETTING KOMPONEN IURAN</b></span>
	<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
	<div class="row detailed">
		<!-- <h4 class="mb">Add Fitur</h4> -->
		<div class="col-xs-12 detailed no-padding">
			<form role="form" class="form-horizontal">
                <div class="col-xs-12 no-padding" style="margin-bottom: 5px;">
                    <div class="col-xs-3"><label class="label-control">Tgl Berlaku</label></div>
                    <div class="col-xs-9">
                        <label class="label-control tglBerlaku" data-val="<?php echo $data['tgl_berlaku']; ?>">: <?php echo strtoupper(tglIndonesia($data['tgl_berlaku'], '-', ' ')); ?></label>
                    </div>
                </div>
                <div class="col-xs-12 no-padding" style="margin-bottom: 5px;">
                    <div class="col-xs-3"><label class="label-control">Kode Iuran</label></div>
                    <div class="col-xs-9">
                        <label class="label-control kodeIuran" data-val="<?php echo $data['kode_iuran']; ?>">: <?php echo strtoupper($data['kode_iuran']); ?></label>
                    </div>
                </div>
                <div class="col-xs-12 no-padding" style="margin-bottom: 10px;">
                    <div class="col-xs-3"><label class="label-control">Nominal Iuran</label></div>
                    <div class="col-xs-9">
                        <label class="label-control">: <?php echo strtoupper(formatAngka($data['nominal_iuran'])); ?></label>
                    </div>
                </div>
                <div class="col-xs-12">
                    <small>
                        <table class="table table-bordered" style="margin-bottom: 10px;">
                            <thead>
                                <tr>
                                    <th class="col-xs-2">Kode</th>
                                    <th class="col-xs-4">Nama</th>
                                    <th class="col-xs-6">Nominal (Rp.)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tbody>
                                    <?php $total = 0; ?>
                                    <?php foreach ($data['detail'] as $k_det => $v_det) { ?>
                                        <tr>
                                            <td><?php echo $v_det['kode_komponen_iuran']; ?></td>
                                            <td><?php echo $v_det['nama_komponen_iuran']; ?></td>
                                            <td class="text-right"><?php echo formatAngka($v_det['nominal']); ?></td>
                                        </tr>
                                        <?php $total += $v_det['nominal']; ?>
                                    <?php } ?>
                                </tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-right" colspan="2"><b>Total</b></td>
                                    <td class="text-right total"><b><?php echo formatAngka($total); ?></b></td>
                                </tr>
                            </tfoot>
                        </table>
                    </small>
                </div>

                <div class="col-xs-12">
                    <hr style="margin-top: 10px!important; margin-bottom: 10px!important;">
                </div>

                <div class="col-xs-12">
                    <div class="col-xs-6 no-padding" style="padding-right: 5px;">
                        <button type="button" class="btn btn-primary col-xs-12" onclick="ski.editForm(this)"><i class="fa fa-edit"></i> Edit</button>
                    </div>
                    <div class="col-xs-6 no-padding" style="padding-left: 5px;">
                        <button type="button" class="btn btn-danger col-xs-12" onclick="ski.delete(this)" data-tgl="<?php echo $data['tgl_berlaku'] ?>" data-ki="<?php echo $data['kode_iuran'] ?>"><i class="fa fa-trash"></i> Hapus</button>
                    </div>
                </div>
			</form>
		</div>
	</div>
</div>