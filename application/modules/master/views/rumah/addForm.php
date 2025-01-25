<div class="modal-header">
	<span class="modal-title"><b>Tambah Rumah</b></span>
	<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
	<div class="row detailed">
		<!-- <h4 class="mb">Add Fitur</h4> -->
		<div class="col-xs-12 detailed no-padding">
			<form role="form" class="form-horizontal">
                <div class="col-xs-12 no-padding" style="margin-bottom: 5px;">
                    <div class="col-xs-12"><label class="label-control">No. Rumah</label></div>
                    <div class="col-xs-12">
                        <input type="text" placeholder="No. Rumah (MAX:10)" class="form-control uppercase no_rumah" maxlength="10" data-required="1">
                    </div>
                </div>
                <div class="col-xs-12 no-padding" style="margin-bottom: 5px;">
                    <div class="col-xs-12"><label class="label-control">Pemilik</label></div>
                    <div class="col-xs-12">
                        <input type="text" placeholder="Pemilik (MAX:100)" class="form-control uppercase pemilik" maxlength="100" data-required="1">
                    </div>
                </div>
                <div class="col-xs-12 no-padding" style="margin-bottom: 5px;">
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
                    <hr style="margin-top: 10px!important; margin-bottom: 10px!important;">
                </div>

                <div class="col-xs-12">
                    <button id="btn-add" type="button" class="col-xs-12 pull-right btn btn-primary cursor-p" title="SAVE" onclick="r.cekData(this)" data-jenis="save"> 
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
			</form>
		</div>
	</div>
</div>