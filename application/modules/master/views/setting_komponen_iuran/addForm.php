<div class="modal-header">
	<span class="modal-title"><b>TAMBAH SETTING KOMPONEN IURAN</b></span>
	<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
	<div class="row detailed">
		<!-- <h4 class="mb">Add Fitur</h4> -->
		<div class="col-xs-12 detailed no-padding">
			<form role="form" class="form-horizontal">
                <div class="col-xs-12 no-padding" style="margin-bottom: 5px;">
                    <div class="col-xs-12"><label class="control-label">Tgl Berlaku</label></div>
                    <div class="col-xs-12">
                        <div class="input-group date datetimepicker" name="tglBerlaku" id="TglBerlaku">
                            <input type="text" class="form-control text-center" placeholder="Tanggal" data-required="1" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 no-padding" style="margin-bottom: 10px;">
                    <div class="col-xs-12"><label class="label-control">Kode Iuran</label></div>
                    <div class="col-xs-12">
                        <select class="form-control iuran" data-required="1">
                            <option value="">-- Pilih Kode Iuran --</option>
                            <?php foreach ($iuran as $key => $value) { ?>
                                <option value="<?php echo $value['kode']; ?>" data-nominal="<?php echo $value['nominal']; ?>"><?php echo $value['kode'].' | Rp. '.formatAngka($value['nominal']); ?></option>
                            <?php } ?>
                        </select>
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
                                    <?php if ( !empty($komponen_iuran) ) { ?>
                                        <?php foreach ($komponen_iuran as $key => $value) { ?>
                                            <tr class="data">
                                                <td class="kode" data-val="<?php echo $value['kode']; ?>"><?php echo $value['kode']; ?></td>
                                                <td><?php echo $value['nama']; ?></td>
                                                <td>
                                                    <input type="text" class="form-control text-right nominal" data-tipe="decimal" data-required="1" placeholder="Nominal (Rp.)">
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <tr>
                                            <td colspan="3">Data tidak ditemukan.</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-right" colspan="2"><b>Total</b></td>
                                    <td class="text-right total"><b>0</b></td>
                                </tr>
                            </tfoot>
                        </table>
                    </small>
                </div>

                <div class="col-xs-12">
                    <hr style="margin-top: 10px!important; margin-bottom: 10px!important;">
                </div>

                <div class="col-xs-12">
                    <button id="btn-add" type="button" class="col-xs-12 pull-right btn btn-primary cursor-p" title="SAVE" onclick="ski.cekData(this)" data-jenis="save"> 
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
			</form>
		</div>
	</div>
</div>