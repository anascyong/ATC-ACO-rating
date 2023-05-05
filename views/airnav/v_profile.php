<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary"></h6>
	</div>
	<div class="card-body">
		<form action="#" id="form">
			<input type="hidden" name="id_user">
			<div class="form-group">
				<label>Nama <span class="red">*</span></label>
				<input type="text" name="nama_user" class="form-control form-control-user" placeholder="Nama">
				<span class="help-block"></span>
			</div>
			<div class="form-group">
				<label>No. Hp <span class="red">*</span></label>
				<input type="text" name="no_hp" class="form-control form-control-user" placeholder="No. Hp">
				<span class="help-block"></span>
			</div>
			<div class="form-group">
				<label>Email <span class="red">*</span></label>
				<input type="text" name="email" class="form-control form-control-user" placeholder="Email">
				<span class="help-block"></span>
			</div>
			<div class="form-group">
				<label>Username <span class="red">*</span></label>
				<input type="text" name="username" class="form-control form-control-user" placeholder="Username">
				<span class="help-block"></span>
			</div>
			<button type="button" id="btnSave" onclick="save()" class="btn btn-info"><i class="fas fa-save"></i> Simpan</button>
			<button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
		</form>
	</div>
</div>