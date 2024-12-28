<div class="col-xs-7 no-padding" style="padding-right: 5px;">
	<div class="col-xs-12 no-padding" style="margin-bottom: 5px;">
		<div class="col-xs-3 no-padding"><label class="control-label">No. Bank Keluar</label></div>
		<div class="col-xs-4 no-padding">
			<input type="text" class="col-xs-12 form-control no_kk uppercase" placeholder="No. Bank Keluar" disabled>
		</div>
	</div>
	<div class="col-xs-12 no-padding" style="margin-bottom: 5px;">
		<div class="col-xs-3 no-padding"><label class="control-label">No. COA</label></div>
		<div class="col-xs-3 no-padding" style="padding-right: 5px;">
			<select class="form-control no_coa_header" data-required="1">
				<option value="">Pilih No. COA</option>
				<?php if ( !empty($coa_header) ): ?>
					<?php foreach ($coa_header as $k_coa => $v_coa): ?>
						<option value="<?php echo $v_coa['no_coa']; ?>" data-nama="<?php echo $v_coa['nama_coa']; ?>"><?php echo $v_coa['no_coa']; ?></option>
					<?php endforeach ?>
				<?php endif ?>
			</select>
		</div>
		<div class="col-xs-6 no-padding" style="padding-left: 5px;">
			<select class="form-control nama_coa_header" data-required="1">
				<option value="">Pilih Nama COA</option>
				<?php if ( !empty($coa_header) ): ?>
					<?php foreach ($coa_header as $k_coa => $v_coa): ?>
						<option value="<?php echo $v_coa['nama_coa']; ?>" data-no="<?php echo $v_coa['no_coa']; ?>"><?php echo $v_coa['nama_coa']; ?></option>
					<?php endforeach ?>
				<?php endif ?>
			</select>
		</div>
	</div>
	<div class="col-xs-12 no-padding" style="margin-bottom: 5px;">
		<div class="col-xs-3 no-padding"><label class="control-label">Tanggal Bank Keluar</label></div>
		<div class="col-xs-4 no-padding">
			<div class="input-group date datetimepicker" name="tglKk" id="TglKk">
				<input type="text" class="form-control text-center" placeholder="Tanggal" data-required="1" data-tgl="<?php echo date('Y-m-d'); ?>" />
				<span class="input-group-addon">
					<span class="glyphicon glyphicon-calendar"></span>
				</span>
			</div>
		</div>
	</div>
	<div class="col-xs-12 no-padding" style="margin-bottom: 5px;">
		<div class="col-xs-3 no-padding"><label class="control-label">Supplier</label></div>
		<div class="col-xs-7 no-padding">
			<select class="form-control supplier">
				<option value="">Pilih Supplier</option>
				<?php if ( !empty($supplier) ): ?>
					<?php foreach ($supplier as $k_supplier => $v_supplier): ?>
						<option value="<?php echo $v_supplier['kode_supl']; ?>" data-nama="<?php echo $v_supplier['nama_supl']; ?>"><?php echo $v_supplier['kode_supl'].' | '.$v_supplier['nama_supl']; ?></option>
					<?php endforeach ?>
				<?php endif ?>
			</select>
		</div>
	</div>
	<div class="col-xs-12 no-padding" style="margin-bottom: 5px;">
		<div class="col-xs-3 no-padding"><label class="control-label">Keterangan</label></div>
		<div class="col-xs-9 no-padding">
			<textarea class="form-control keterangan"></textarea>
		</div>
	</div>
	<div class="col-xs-12 no-padding" style="margin-bottom: 5px;">
		<div class="col-xs-3 no-padding"><label class="control-label">Nama Bank</label></div>
		<div class="col-xs-4 no-padding">
			<input type="text" class="col-xs-12 form-control nama_bank uppercase" placeholder="Nama Bank" maxlength="20" data-required="1">
		</div>
	</div>
	<div class="col-xs-12 no-padding" style="margin-bottom: 5px;">
		<div class="col-xs-3 no-padding"><label class="control-label">No. Giro</label></div>
		<div class="col-xs-4 no-padding">
			<input type="text" class="col-xs-12 form-control no_giro uppercase" placeholder="No. Giro" maxlength="20">
		</div>
	</div>
	<div class="col-xs-12 no-padding" style="margin-bottom: 5px;">
		<div class="col-xs-3 no-padding"><label class="control-label">Tanggal Tempo</label></div>
		<div class="col-xs-4 no-padding">
			<div class="input-group date datetimepicker" name="tglTempo" id="TglTempo">
				<input type="text" class="form-control text-center" placeholder="Tanggal" />
				<span class="input-group-addon">
					<span class="glyphicon glyphicon-calendar"></span>
				</span>
			</div>
		</div>
	</div>
	<div class="col-xs-12 no-padding" style="margin-bottom: 5px;">
		<div class="col-xs-3 no-padding"><label class="control-label">Tanggal Cair</label></div>
		<div class="col-xs-4 no-padding">
			<div class="input-group date datetimepicker" name="tglCair" id="TglCair">
				<input type="text" class="form-control text-center" placeholder="Tanggal" />
				<span class="input-group-addon">
					<span class="glyphicon glyphicon-calendar"></span>
				</span>
			</div>
		</div>
	</div>
</div>
<div class="col-xs-5 no-padding" style="padding-left: 5px;">
	<div class="col-xs-12 no-padding" style="margin-bottom: 5px;">
		<div class="col-xs-3">&nbsp;</div>
		<div class="col-xs-3 no-padding"><label class="control-label">Total</label></div>
		<div class="col-xs-6 no-padding nilai">
			<input type="text" class="col-xs-12 form-control text-right nilai uppercase" placeholder="Total" disabled>
		</div>
	</div>
</div>

<div class="col-xs-12 no-padding"><hr style="margin-top: 10px; margin-bottom: 10px;"></div>

<div class="col-xs-12 no-padding">
	<div class="col-xs-12 no-padding" style="overflow-x: auto;">
		<small>
			<table class="table table-bordered tbl_detail" style="margin-bottom: 0px; max-width: 100%; width: 100%;">
				<thead>
					<tr>
						<th>No. COA</th>
						<th>Nama. COA</th>
						<th>Keterangan</th>
						<th>No. Invoice</th>
						<th>Nilai Invoice</th>
						<th>Nilai</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<tr class="data" data-urut="">
						<td style="width: 10%; max-width: 10%;">
							<select class="form-control no_coa" data-required="1">
								<option value="">Pilih No. COA</option>
								<?php if ( !empty($coa) ): ?>
									<?php foreach ($coa as $k_coa => $v_coa): ?>
										<option value="<?php echo $v_coa['no_coa']; ?>" data-nama="<?php echo $v_coa['nama_coa']; ?>"><?php echo $v_coa['no_coa']; ?></option>
									<?php endforeach ?>
								<?php endif ?>
							</select>
						</td>
						<td style="width: 20%; max-width: 20%;">
							<select class="form-control nama_coa" data-required="1">
								<option value="">Pilih Nama COA</option>
								<?php if ( !empty($coa) ): ?>
									<?php foreach ($coa as $k_coa => $v_coa): ?>
										<option value="<?php echo $v_coa['nama_coa']; ?>" data-no="<?php echo $v_coa['no_coa']; ?>"><?php echo $v_coa['nama_coa']; ?></option>
									<?php endforeach ?>
								<?php endif ?>
							</select>
						</td>
						<td style="width: 20%; max-width: 20%;">
							<input type="text" class="form-control keterangan uppercase" placeholder="Keterangan" maxlength="50">
						</td>
						<td style="width: 20%; max-width: 20%;">
							<select class="form-control lpb">
								<option value="">Pilih No. Invoice</option>
							</select>
						</td>
						<td style="width: 10%; max-width: 10%;">
							<input type="text" class="form-control text-right nilai_lpb uppercase" placeholder="Nilai Invoice" data-tipe="decimal" maxlength="19" disabled>
						</td>
						<td style="width: 10%; max-width: 10%;">
							<input type="text" class="form-control text-right nilai uppercase" placeholder="Nilai" data-tipe="decimal" maxlength="19" data-required="1" onblur="bk.hitGrandTotal(this)">
						</td>
						<td style="width: 10%; max-width: 10%;">
							<div class="col-xs-12 no-padding">
								<div class="col-xs-6 no-padding" style="padding-right: 3px;">
									<button type="button" class="col-xs-12 btn btn-danger" onclick="bk.removeRow(this)"><i class="fa fa-times"></i></button>
								</div>
								<div class="col-xs-6 no-padding" style="padding-left: 3px;">
									<button type="button" class="col-xs-12 btn btn-primary" onclick="bk.addRow(this)"><i class="fa fa-plus"></i></button>
								</div>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</small>
	</div>
</div>

<div class="col-xs-12 no-padding"><hr></div>

<div class="col-xs-12 no-padding">
	<button type="button" class="btn btn-primary pull-right" onclick="bk.save()"><i class="fa fa-save"></i> Simpan</button>
</div>