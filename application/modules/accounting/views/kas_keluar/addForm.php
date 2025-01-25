<div class="modal-header">
	<span class="modal-title"><b>Tambah Kas Keluar</b></span>
	<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
	<div class="row detailed">
		<!-- <h4 class="mb">Add Fitur</h4> -->
		<div class="col-xs-12 detailed no-padding">
			<form role="form" class="form-horizontal">
				<div class="col-xs-12 no-padding" style="margin-bottom: 5px;">
                    <div class="col-xs-12"><label class="control-label">Tgl Masuk</label></div>
                    <div class="col-xs-12">
                        <div class="input-group date datetimepicker" name="tglKeluar" id="TglKeluar">
                            <input type="text" class="form-control text-center" placeholder="Tanggal" data-required="1" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 no-padding" style="margin-bottom: 5px;">
                    <div class="col-xs-12"><label class="label-control">No. Bukti</label></div>
                    <div class="col-xs-12">
						<input type="text" placeholder="No. Bukti (MAX:100)" class="form-control uppercase no_bukti" maxlength="100" data-required="1">
                    </div>
                </div>
                <div class="col-xs-12 no-padding" style="margin-bottom: 5px;">
                    <div class="col-xs-12"><label class="label-control">Lampiran Bukti</label></div>
                    <div class="col-xs-12">
						<label class="lampiran-contain-btn" style="margin-bottom: 0px;">
							<input style="display: none;" placeholder="Dokumen" class="file_lampiran no-check" type="file" onchange="kk.showNameFile(this)" data-name="name" data-allowtypes="jpg|JPG|png|PNG|jpeg|JPEG" data-required="1">
							<i class="fa fa-camera cursor-p" title="Attachment"></i>
						</label>
						<a name="dokumen" class="text-right hide" target="_blank" style="padding-right: 10px;"><i class="fa fa-file"></i></a>
                    </div>
                </div>
				<div class="col-xs-12 no-padding" style="margin-bottom: 5px;">
                    <div class="col-xs-12"><label class="label-control">Uang Masuk (Rp.)</label></div>
                    <div class="col-xs-12">
                        <input type="text" placeholder="Uang Masuk" class="form-control text-right uppercase nominal" maxlength="20" data-tipe="decimal" data-required="1">
                    </div>
                </div>
				<div class="col-xs-12 no-padding" style="margin-bottom: 5px;">
                    <div class="col-xs-12"><label class="label-control">Keterangan</label></div>
                    <div class="col-xs-12">
                        <textarea class="form-control uppercase keterangan" data-required="1" placeholder="keterangan (MAX:250)" maxlength="250"></textarea>
                    </div>
                </div>
                <div class="col-xs-12" style="margin-bottom: 5px;">
					<hr>
				</div>
                <div class="col-xs-12">
                    <button id="btn-add" type="button" class="col-xs-12 pull-right btn btn-primary cursor-p" title="SAVE" onclick="kk.cekData(this)" data-jenis="save"> 
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
			</form>
		</div>
	</div>
</div>