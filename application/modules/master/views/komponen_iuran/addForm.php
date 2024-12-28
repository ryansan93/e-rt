<div class="modal-header">
	<span class="modal-title"><b>Tambah Komponen Iuran</b></span>
	<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
	<div class="row detailed">
		<!-- <h4 class="mb">Add Fitur</h4> -->
		<div class="col-xs-12 detailed no-padding">
			<form role="form" class="form-horizontal">
                <div class="col-xs-12 no-padding" style="margin-bottom: 10px;">
                    <div class="col-xs-12"><label class="label-control">Kode</label></div>
                    <div class="col-xs-12">
                        <input type="text" placeholder="Kode" class="form-control kode" readonly>
                    </div>
                </div>
                <div class="col-xs-12 no-padding">
                    <div class="col-xs-12"><label class="label-control">Keterangan</label></div>
                    <div class="col-xs-12">
                        <input type="text" placeholder="Keterangan (MAX : 100)" class="form-control keterangan" data-required="1" maxlength="100">
                    </div>
                </div>

                <div class="col-xs-12">
                    <hr style="margin-top: 10px!important; margin-bottom: 10px!important;">
                </div>

                <div class="col-xs-12">
                    <button id="btn-add" type="button" class="col-xs-12 pull-right btn btn-primary cursor-p" title="SAVE" onclick="ki.save(this)"> 
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
			</form>
		</div>
	</div>
</div>