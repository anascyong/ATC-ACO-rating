<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">
			<button type="button" class="btn btn-info btn-sm btn-icon-split" onclick="add_data()">
				<span class="icon text-white-50"><i class="fas fa-plus"></i></span>
				<span class="text">Tambah</span>
			</button>
		</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table id="mytable" class="table table-bordered" width="100%" cellspacing="0">
				<thead>
					<tr>
						<td width="20px">Aksi</td>
						<td width="20px">No</td>
						<td>Airnav</td>
						<td>Alamat</td>
						<td>Telp</td>
						<td>Email</td>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>
<div id="modal_form" class="modal fade" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"></h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="#" id="form">
					<input type="hidden" name="id_lokasi">
					<div class="form-group">
						<label>Nama <span class="red">*</span></label>
						<input type="text" name="nama_lokasi" class="form-control" placeholder="Nama Airnav">
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>Alamat <span class="red">*</span></label>
						<textarea name="alamat" class="form-control" placeholder="Alamat"></textarea>
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>Telepon <span class="red">*</span></label>
						<input type="text" name="telp" class="form-control telp" placeholder="Nomor Telepon">
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>Email <span class="red">*</span></label>
						<input type="text" name="email" class="form-control" placeholder="Email">
						<span class="help-block"></span>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="btnSave" onclick="save()" class="btn btn-info"><i class="fas fa-save"></i> Simpan</button>
				<button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
			</div>
		</div>
	</div>
</div>