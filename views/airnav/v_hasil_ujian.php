<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary"></h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table id="mytable" class="table table-bordered" width="100%" cellspacing="0">
				<thead>
					<tr>
						<td width="20px">Aksi</td>
						<td width="20px">No</td>
						<td>Nama</td>
						<td>Jumlah Soal</td>
						<td>Terjawab</td>
						<td>Belum Terjawab</td>
						<td>Ragu</td>
						<td>Nilai</td>
						<td>Status</td>
						<td>Keterangan</td>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>
<div id="modal_nilai" class="modal fade" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"></h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table id="mytable" class="table table-bordered" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th></th>
								<th>No</th>
								<th>Nama</th>
								<th>Nilai Ujian</th>
								<th>Keterangan</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
			</div>
		</div>
	</div>
</div>