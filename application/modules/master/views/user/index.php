<div class="row content-panel detailed">
	<!-- <h4 class="mb">Master User</h4> -->
	<div class="col-xs-12 detailed">
		<form role="form" class="form-horizontal">
			<div class="col-xs-12 action no-padding">
			<?php if ( $akses['a_submit'] == 1 ): ?>
				<button id="btn-add" type="button" class="col-xs-12 btn btn-primary cursor-p" title="ADD" onclick="user.add_form(this)"> 
					<i class="fa fa-plus" aria-hidden="true"></i> ADD
				</button>
				<div class="col-xs-12 no-padding">
					<hr>
				</div>
			<?php else: ?>
				<div class="col-xs-2 action no-padding">
					&nbsp
				</div>
			<?php endif ?>
			</div>
			<div class="col-xs-2 search left-inner-addon pull-right no-padding">
				<i class="glyphicon glyphicon-search"></i><input class="form-control" type="search" data-table="tbl_user" placeholder="Search" onkeyup="filter_all(this)">
			</div>
			<div class="col-xs-2 search pull-right">
				<select class="form-control" type="search" onchange="filter_all(this)" data-table="tbl_user">
					<option value="">-- ALL --</option>
					<option value="aktif">AKTIF</option>
					<option value="tidak aktif">NON AKTIF</option>
				</select>
			</div>
			<small>
				<table class="table table-bordered table-hover tbl_user" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>Kode</th>
							<th>Nama</th>
							<th>Username</th>
							<th>Password</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<!-- UNTUK ISI DARI LIST GROUP -->
						<tr>
							<td colspan="6">Data tidak ditemukan.</td>
	                   </tr>
					</tbody>
				</table>
			</small>
		</form>
	</div>
</div>