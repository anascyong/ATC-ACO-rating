<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary"></h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table id="mytable" class="table table-bordered" width="100%" cellspacing="0">
				<thead>
					<tr>
						<td width="20px">No</td>
						<td>No. SK</td>
						<td>Tanggal Terbit</td>
						<td>Tanggal Berlaku</td>
						<td>Airnav</td>
						<td>Lihat SK</td>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>
<div id="modal_form" class="modal fade" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"></h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="#" id="form">
					<div class="form-group">
						<label>No. SK <span class="red">*</span></label>
						<input type="text" name="no_sk" class="form-control" placeholder="Nomor SK" readonly="true">
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>Tgl. Terbit <span class="red">*</span></label>
						<input type="text" name="tgl_terbit" class="form-control tgl" placeholder="Tanggal Terbit" readonly="true">
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>Airnav <span class="red">*</span></label>
						<select id="id_lokasi" name="id_lokasi" class="form-control" disabled="true"></select>
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>Jadwal Ujian <span class="red">*</span></label>
						<select id="id_permohonan" name="id_permohonan" class="form-control" readonly="true"></select>
						<span class="help-block"></span>
					</div>
					<table id="mytable_peserta" class="table table-bordered" width="100%" cellspacing="0">
						<thead>
							<tr>
								<td width="20px">No</td>
								<td>Nama</td>
								<td>No. Lisensi</td>
								<td>Airnav</td>
								<td>File SK</td>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</form>
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
			</div>
		</div>
	</div>
</div>