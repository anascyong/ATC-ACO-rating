<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-info">
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
						<td>Nama</td>
						<td>Tipe</td>
						<td>Airnav</td>
						<td>Handphone</td>
						<td>Email</td>
						<td>Last Login</td>
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
					<input type="hidden" name="id_user">
					<div class="form-group">
						<label>Nama <span class="red">*</span></label>
						<input type="text" name="nama_user" class="form-control form-control-user" placeholder="Masukkan Nama">
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>Tipe <span class="red">*</span></label>
						<select id="id_tipe" name="id_tipe" class="form-control"></select>
						<span class="help-block"></span>
					</div>
					<div id="lokasi" class="form-group" style="display: none;">
						<label>Airnav <span class="red">*</span></label>
						<select id="id_lokasi" name="id_lokasi" class="form-control"></select>
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>No. Hp <span class="red">*</span></label>
						<input type="text" name="no_hp" class="form-control form-control-user" placeholder="Masukkan No. Hp">
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>Email <span class="red">*</span></label>
						<input type="text" name="email" class="form-control form-control-user" placeholder="Masukkan Email">
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>Username <span class="red">*</span></label>
						<input type="text" name="username" class="form-control form-control-user" placeholder="Masukkan Username">
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>Password <span class="edit-info red">*</span></label>
						<input type="password" name="password" class="form-control form-control-user" placeholder="Masukkan Password">
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label>Ulangi Password <span class="edit-info red">*</span></label>
						<input type="password" name="ulangi_password" class="form-control form-control-user" placeholder="Masukkan Password">
						<span class="help-block"></span>
					</div>
					<div id="edit-info" class="form-group" style="display: none;">
						<small style="color: red;">* Kosongkan password jika tidak ingin merubah</small>
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