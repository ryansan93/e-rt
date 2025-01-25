<div class="row content-panel detailed">
	<div class="col-xs-12 detailed">
		<form role="form" class="form-horizontal">
			<div class="col-xs-12 no-padding">
				<?php if ( $akses['a_submit'] == 1 ): ?>
					<button id="btn-add" type="button" class="col-xs-12 btn btn-primary cursor-p" title="ADD" onclick="r.addForm(this)"> 
						<i class="fa fa-plus" aria-hidden="true"></i> ADD
					</button>
				<?php endif ?>
			</div>
			<div class="col-xs-12 no-padding">
				<hr>
			</div>
			<!-- <div class="col-xs-12 search left-inner-addon no-padding">
				<i class="fa fa-search"></i><input class="form-control" type="search" data-table="tblRiwayat" placeholder="Search" onkeyup="filter_all(this)">
			</div> -->
			<small>
				<table class="table table-bordered table-hover tblRiwayat" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th class="col-xs-2">No. Rumah</th>
							<th class="col-xs-7">Pemilik</th>
							<th class="col-xs-2">Iuran</th>
							<th class="col-xs-1">Action</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td colspan="4">Data tidak ditemukan.</td>
	                   	</tr>
					</tbody>
				</table>
			</small>
		</form>
	</div>
</div>