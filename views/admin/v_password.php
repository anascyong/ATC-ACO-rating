<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary"></h6>
	</div>
	<div class="card-body">
		<form action="#" id="form">
			<input type="hidden" name="id_user">
			<div class="form-group">
				<label>Password Lama <span class="red">*</span></label>
				<input type="password" name="password" class="form-control form-control-user" placeholder="Masukkan Password Lama">
				<span class="help-block"></span>
			</div>
			<div class="form-group">
				<label>Password Baru <span class="red">*</span></label>
				<input type="password" name="password_baru" class="form-control form-control-user" placeholder="Masukkan Password Baru">
				<span class="help-block"></span>
			</div>
			<div class="form-group">
				<label>Ulangi Password Baru <span class="red">*</span></label>
				<input type="password" name="ulangi_password_baru" class="form-control form-control-user" placeholder="Masukkan Password Baru">
				<span class="help-block"></span>
			</div>
			<button type="button" id="btnSave" onclick="save()" class="btn btn-info"><i class="fas fa-save"></i> Simpan</button>
			<button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
		</form>
	</div>
</div>